<?php

// app-form
// Обработчик формы app-form
add_action('wp_ajax_submit_form', 'handle_form_submission');
add_action('wp_ajax_nopriv_submit_form', 'handle_form_submission');

function handle_form_submission() {
    if (!isset($_POST['step1-phone'])) {
        wp_send_json_error('Ошибка: номер телефона обязателен');
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'app_form';

    // Устанавливаем путь загрузки в wp-content/uploads/app-form/img/
    $upload_dir = wp_upload_dir()['basedir'] . '/app-form/img';
    $upload_url = wp_upload_dir()['baseurl'] . '/app-form/img';

    // Создаём папку, если её нет
    if (!file_exists($upload_dir)) {
        wp_mkdir_p($upload_dir);
    }

    $uploaded_files = [];
    if (!empty($_FILES['uploaded_files']['name'][0])) {
        foreach ($_FILES['uploaded_files']['name'] as $key => $file_name) {
            $file_tmp = $_FILES['uploaded_files']['tmp_name'][$key];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Разрешённые форматы
            $allowed_extensions = ['jpeg', 'jpg', 'png', 'gif', 'webp'];
            if (!in_array($file_ext, $allowed_extensions)) {
                continue;
            }

            // Генерируем уникальное имя файла
            $unique_name = uniqid('img_', true) . '.' . $file_ext;
            $file_path = $upload_dir . '/' . $unique_name;
            $file_url = $upload_url . '/' . $unique_name;

            // Оптимизация изображения перед сохранением
            $compressed = compress_image($file_tmp, $file_path, $file_ext);
            if ($compressed) {
                $uploaded_files[] = $file_url; // Сохраняем URL в БД
            }
        }
    }

    // Записываем в БД
    $data = array(
        'step1_phone'       => sanitize_text_field($_POST['step1-phone']),
        'step2_address'     => sanitize_text_field($_POST['step2-address']),
        'step2_place_name'  => sanitize_text_field($_POST['step2-place-name']),
        'step2_working_hours' => sanitize_text_field($_POST['step2-working-hours']),
        'step2_place_phone' => sanitize_text_field($_POST['step2-place-phone']),
        'step3_status'      => sanitize_text_field($_POST['step3-status']),
        'step3_desc'        => sanitize_textarea_field($_POST['step3-desc']),
        'step3_datepicker'  => sanitize_textarea_field($_POST['step3_datepicker']),
        'uploaded_files'    => maybe_serialize($uploaded_files),
        'created_at'        => current_time('mysql')
    );

    $result = $wpdb->insert($table_name, $data);

    if ($result === false) {
        wp_send_json_error('Ошибка при записи в базу данных: ' . $wpdb->last_error);
    } else {
        wp_send_json_success('Форма успешно отправлена!');
    }
}

//  Функция сжатия изображений (из твоего `иии.txt`)
function compress_image($source, $destination, $ext) {
    $quality = 70; // Устанавливаем качество сжатия

    // Определяем тип файла и сжимаем
    if ($ext == 'jpeg' || $ext == 'jpg') {
        $image = imagecreatefromjpeg($source);
        imagejpeg($image, $destination, $quality);
    } elseif ($ext == 'png') {
        $image = imagecreatefrompng($source);
        imagepng($image, $destination, 7); // PNG: 0 (лучшее качество) - 9 (худшее)
    } elseif ($ext == 'webp') {
        $image = imagecreatefromwebp($source);
        imagewebp($image, $destination, $quality);
    } else {
        return false; // Если формат не поддерживается
    }

    imagedestroy($image);
    return true;
}




function app_form_page() {
    add_menu_page(
        'Заявки',
        'Заявки',
        'manage_options',
        'form-submissions',
        'display_form_submissions',
        'dashicons-list-view',
        6
    );
}
add_action('admin_menu', 'app_form_page');

function display_form_submissions() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'app_form';
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC");

    echo '<div class="wrap">';
    echo '<h1>Заявки</h1>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr>
            <th style="width:60px">ID</th>
            <th style="width: 150px;">Телефон</th>
            <th style="width: 200px;">Адрес</th>
            <th>Название</th>
            <th>Время работы</th>
            <th style="width: 130px;">Телефон торговой точки</th>
            <th>Status</th>
            <th>Описание</th>
            <th>Желаемая дата</th>
            <th>Изображения</th>
            <th>Дата заявки</th>
          </tr></thead>';
    echo '<tbody>';

    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . esc_html($row->id) . '</td>';
        echo '<td>' . esc_html($row->step1_phone) . '</td>';
        echo '<td>' . esc_html($row->step2_address) . '</td>';
        echo '<td>' . esc_html($row->step2_place_name) . '</td>';
        echo '<td>' . esc_html($row->step2_working_hours) . '</td>';
        echo '<td>' . esc_html($row->step2_place_phone) . '</td>';
        echo '<td>' . esc_html($row->step3_status) . '</td>';
        echo '<td>' . esc_html($row->step3_desc) . '</td>';
        echo '<td>' . esc_html($row->step3_datepicker) . '</td>';

        //  Вывод изображений
        echo '<td>';
        $images = maybe_unserialize($row->uploaded_files); // Достаем массив из БД
        if (!empty($images) && is_array($images)) {
            foreach ($images as $image_url) {
                echo '<a href="' . esc_url($image_url) . '" target="_blank">
                        <img src="' . esc_url($image_url) . '" width="50">
                      </a> ';
            }
        } else {
            echo 'Нет изображений';
        }
        echo '</td>';
        $formatted_date = date('d.m.Y H:i:s', strtotime($row->created_at));
        echo '<td>' . esc_html($formatted_date) . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table></div>';
}
