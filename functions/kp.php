<?php

//КП
add_action('wp', 'cart_to_kp', 10);
function cart_to_kp(){
    $post_type = is_cart();
    if($post_type && isset($_GET['kp_post'])){
        $kp_id = $_GET['kp_post'];
        $prods = get_field('kp_products', $kp_id);

        if($prods && count($prods)){
            WC()->cart->empty_cart($clear_persistent_cart = true);
            foreach($prods as $item){
                $k = $item['product'];
                $count = $item['count'];
                $product = wc_get_product( $k );
                WC()->cart->add_to_cart($k, $count);
                WC()->cart->kp = $kp_id;
            }
            add_filter( 'body_class', function($classes){
                $classes[] = 'kp-page';
                return $classes;
            });
            global $custom_dt;
            $custom_dt = get_the_date('d.m.y', $kp_id);
            add_filter( 'the_title', function($title, $page){
                if($page == 10){
                    global $custom_dt;
                    $title = 'Коммерческое предложение от '.$custom_dt;
                }
                return $title;
            }, 1, 2 );

            global $manager;
            $manager = get_field('kp_manager', $kp_id);
            if($manager){
                add_action('wp_footer', function(){
                    global $manager;
                    echo '<div class="kp_manager" style="display:none;">
						<p>Менеджер: '.get_the_title($manager).'</p>
						<p>Телефон: <a href="tel:'.get_field('manager_phone', $manager).'">'.get_field('manager_phone', $manager).'</a></p>
						<p>Email: <a href="mailto:'.get_field('manager_email', $manager).'">'.get_field('manager_email', $manager).'</a></p>
					</div>';
                });
            }
        }
    }
}

add_action('woocommerce_before_calculate_totals', 'calculate_cart_kp', 50);
function calculate_cart_kp($cart){
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    $user_id = get_current_user_id();
    if($user_id && get_field('id_kp', 'user_'.$user_id))
        $kp_id = get_field('id_kp', 'user_'.$user_id);
    if(isset($_GET['kp_post'])){
        $kp_id = $_GET['kp_post'];
        update_field('id_kp', $_GET['kp_post'], 'user_'.$user_id);
    }

    if (isset($kp_id)){
        $prods = get_field('kp_products', $kp_id);
        if($prods && count($prods)){
            $prods_arr = [];
            $orig_prices = [];
            foreach($prods as $item) {
                $k = $item['product'];
                $type = $item['type'];
                $sale = $item['sale'];
                $orig_price = $item['price'];

                $_product = wc_get_product($k);
                $price = 0;
                if ($_product instanceof WC_Product){
                    $price = $_product->get_price();
                }
                if(isset($orig_price)&&$orig_price){
                    $orig_prices[$k] = $orig_price;
                    $price = $orig_price;
                }
                if($sale) {
                    $sale_price = ($type == 'percent') ? round($price - $price * $sale / 100) : $price - $sale;
                    $prods_arr[$k] = $sale_price;
                } elseif (isset($orig_price)&&$orig_price) {
                    $prods_arr[$k] = $orig_price;
                }
            }
            foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
                $product_id = $cart_item['product_id'];

                if(isset($orig_prices[$product_id]) && $orig_prices[$product_id]){
                    if($prods_arr[$product_id]) {
                        $cart_item['data']->set_price($prods_arr[$product_id]);
                    }
                    if($orig_prices[$product_id]) {
                        $cart_item['data']->set_regular_price($orig_prices[$product_id]);
                    }
                    if($prods_arr[$product_id]) {
                        $cart_item['data']->set_sale_price($prods_arr[$product_id]);
                    }
                } elseif(isset($prods_arr[$product_id]) && $prods_arr[$product_id]){
                    $cart_item['data']->set_price($prods_arr[$product_id]);
                }
            }
        }
    } elseif(isset($_GET['kp'])){

    }
}

add_action('wp', 'clear_user_kp', 10);
function clear_user_kp(){
    if (is_admin()) {
        return;
    }

    $user_id = get_current_user_id();
    if($user_id && get_field('id_kp', 'user_'.$user_id))
        $kp_id = get_field('id_kp', 'user_'.$user_id);

    if(isset($kp_id) && function_exists('is_post')){
        if(stripos($_SERVER['REQUEST_URI'], 'wc-ajax') === false && stripos($_SERVER['REQUEST_URI'], 'checkout') === false
            && stripos($_SERVER['REQUEST_URI'], 'cart') === false && (is_page() || is_post() || is_product()))
            update_field('id_kp', 0, 'user_'.$user_id);
    }
}

add_action( 'wp_ajax_send_kp', 'send_kp' );
function send_kp(){
    if(!$_POST['email']) return;

    $html = '
		<p>Коммерческое предолжение от компании Бобёр-сервис:</p>
		<p><a target="_blank" href="https://bober.services/kp/'.$_POST['id'].'">Помотреть на сайте</a></p>
		<p><a target="_blank" href="https://bober.services/wp-content/kp_pdf/kp_'.$_POST['id'].'.pdf">Скачать в формате PDF</a></p>
	';

    $headers = array(
        'From: Bober Service <info@vh428.timeweb.ru >',
        'content-type: text/html',
    );

    wp_mail($_POST['email'], '«Бобёр-сервис». Коммерческое предложение', $html, $headers);

    echo 'ok';
    die();
}

add_action('wp', 'kp_pdf_2', 100);
function kp_pdf_2(){
    if(stripos($_SERVER['REQUEST_URI'], '/kp_pdf/?kp=')!==false){
        global $wpdb;

        $kp_id = $_GET['kp'];
        $results = $wpdb->get_results( "SELECT * FROM kp WHERE hash = '".$kp_id."'");
        status_header(200);

        require_once('template-parts/kp-pdf.php');
        die();
    }
}

add_action('wp_ajax_pdf_gen_pure', 'create_pdf_kp_pure');
function create_pdf_kp_pure(){
    global $cart;
    global $wpdb;

    $cart_items = WC()->cart->get_cart();
    $arr = [];

    foreach($cart_items as $item){
        $prod = wc_get_product($item['product_id']);
        $orig_pice = $prod->get_price();
        $sale_price = get_discounted_price($item['product_id']);
        $arr[] = [
            'id' => $item['product_id'],
            'count' => $item['quantity'],
            'orig_pice' => $orig_pice,
            'sale_price' => $sale_price
        ];
    }

    $str = json_encode($arr);
    $hash = md5($str);
    //$hash = 'bd954f46dcf8c10f81ab8819af35b4d0';

    $results = $wpdb->get_results( "SELECT * FROM kp WHERE hash = '".$hash."'");

    if(!count($results)){
        $wpdb->query(
            $wpdb->prepare(
                "
				INSERT INTO kp
				(hash, json, created)
				VALUES ( %s, %s, %s )
				",
                $hash,
                $str,
                time()
            )
        );
    }
    //var_dump($results);
    usleep(500);

    $pdf_dir = get_home_path().'/wp-content/kp_pdf/kp_'.$hash.'.pdf';
    if(file_exists($pdf_dir)){
        echo 'https://bober.services/wp-content/kp_pdf/kp_'.$hash.'.pdf'; die();
    }

    $apikey = 'd026901c70b8206fae196429fc0e2e49';
    $postdata = http_build_query(
        array(
            'apikey' => $apikey,
            'value' => 'https://bober.services/kp_pdf/?kp='.$hash,
            'MarginBottom' => '0',
            'MarginTop' => '0',
            'MarginLeft' => '0',
            'MarginRight' => '0'
        )
    );

    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded;',
            'content' => $postdata
        )
    );
    $context  = stream_context_create($opts);
    $result = file_get_contents('http://api.pdf4b.ru/pdf', false, $context);
    file_put_contents($pdf_dir, $result);

    echo 'https://bober.services/wp-content/kp_pdf/kp_'.$hash.'.pdf';
    die();
}

add_action('wp_ajax_pdf_gen', 'create_pdf_kp');
//add_action('post_updated', 'create_pdf_kp', 10, 1);
function create_pdf_kp($id=0){
    if(isset($_POST['id_kp']))
        $id = $_POST['id_kp'];

    if(get_post_type($id)!='kp') return;

    file_get_contents('https://bober.services/kp_pdf/?kp_post='.$id);
    if($http_response_header[0]!='HTTP/1.1 200 OK') return;

    $pdf_dir = get_home_path().'/wp-content/kp_pdf/kp_'.$id.'.pdf';

    $apikey = 'd026901c70b8206fae196429fc0e2e49';
    $postdata = http_build_query(
        array(
            'apikey' => $apikey,
            'value' => 'https://bober.services/kp_pdf/?kp_post='.$id,
            'MarginBottom' => '0',
            'MarginTop' => '0',
            'MarginLeft' => '0',
            'MarginRight' => '0'
        )
    );

    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded;',
            'content' => $postdata
        )
    );
    $context  = stream_context_create($opts);
    $result = file_get_contents('http://api.pdf4b.ru/pdf', false, $context);
    file_put_contents($pdf_dir, $result);
}

add_action( 'add_meta_boxes', 'kp_add_metabox' );
function kp_add_metabox() {
    add_meta_box(
        'kp_btns',
        'Поделиться КП', // заголовок
        'kp_metabox_callback', // функция, которая будет выводить поля в мета боксе
        'kp', // типы постов, для которых его подключим
        'normal', // расположение (normal, side, advanced)
        'default' // приоритет (default, low, high, core)
    );
}
function kp_metabox_callback( $post ) {
    if(get_post_status($post->ID) == 'auto-draft') return;

    $pdf_dir = get_home_path().'/wp-content/kp_pdf/kp_'.$post->ID.'.pdf';
    ?>
    <div class="kp__update">
        <?php if(file_exists($pdf_dir)): ?>
            <input type="submit" name="save" id="publish" class="publish_kp button button-primary button-large" value="Обновить PDF">
        <?php else: ?>

            <input type="button" id="button_publish_add_pdf_post" class="publish_kp_add button button-primary button-large" value="Создать PDF">

            <a data-kp="<?=$post->ID?>" target="_blank" href="/wp-content/kp_pdf/kp_<?=$post->ID?>.pdf" class="kp_pdf kp_pdf-gen kp_pdf-gen-hidden">Сгенерировать PDF</a>
            <input type="submit" name="publish" id="publish" class="publish_kp_add-hidden button button-primary button-large" value="Создать PDF">

        <?php endif ?>
        <span class="spinner spinner-duplicate"></span>
    </div>
    <div class="kp__wrap<?php if(!file_exists($pdf_dir)){echo ' is-disabled';}?>">
        <div class="kp">
            <a target="_blank" href="/kp/<?=$post->ID?>" class="">Перейти на КП</a>
            <a href="#" data-kp="<?=$post->ID?>" class="kp_copy">Копировать ссылку на КП</a>
            <a target="_blank" href="/wp-content/kp_pdf/kp_<?=$post->ID?>.pdf?<?=time()?>" class="kp_pdf">Скачать КП в PDF</a>
            <a target="_blank" href="https://wa.me/?text=Коммерческое+предложение+от+компании+bober.service.+Ссылка:https://bober.services/kp/<?=$post->ID?>" class="kp_wa">Отправить в WhatsApp</a>
        </div>
        <h5 style="margin: 20px 0 6px 0px;font-size: 12px;">Отправить КП на email</h5>
        <div class="submit_kp">
            <input type="email" name="submit_kp_email" placeholder="Введите email">
            <a data-kp="<?=$post->ID?>" href="#" class="submit_kp__btn">Отправить</a>
        </div>
    </div>
    <?php
}

add_action('admin_enqueue_scripts', 'admin_custom_scripts');
function admin_custom_scripts($hook) {
    wp_register_script('admin-custom-script', get_template_directory_uri() . '/js/admin.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('admin-custom-script');
}

add_action('wp', 'kp_pdf', 100);
function kp_pdf(){
    if(stripos($_SERVER['REQUEST_URI'], '/kp_pdf/?kp_post=')!==false){
        $kp_id = $_GET['kp_post'];
        $prods = get_field('kp_products', $kp_id);
        $date = get_the_date('d.m.y', $kp_id);
        status_header(200);

        require_once('template-parts/kp-pdf-post.php');
        die();
    }
}

add_action( 'add_meta_boxes', 'upd_pdf_add_metabox' );
function upd_pdf_add_metabox() {
    add_meta_box(
        'kp_upd_pdf',
        'Поделиться КП', // заголовок
        'upd_pdf_metabox_callback', // функция, которая будет выводить поля в мета боксе
        'kp', // типы постов, для которых его подключим
        'side', // расположение (normal, side, advanced)
        'default' // приоритет (default, low, high, core)
    );
}
function upd_pdf_metabox_callback( $post ) {
    if(get_post_status($post->ID) == 'auto-draft') return;
    $pdf_dir = get_home_path().'/wp-content/kp_pdf/kp_'.$post->ID.'.pdf';
    ?>
    <div class="pdf_upd kp">
        <?php if(file_exists($pdf_dir)): ?>
            <a data-kp="<?=$post->ID?>" target="_blank" href="/wp-content/kp_pdf/kp_<?=$post->ID?>.pdf?<?=time()?>" class="kp_pdf kp_pdf-gen">Обновить файл PDF</a>
        <?php endif ?>
    </div>
    <?php
}






//Выбранный менеджер при создании записи в админке
function set_default_kp_manager($value, $post_id, $field) {
    // Проверяем, что мы находимся на странице создания новой записи
    if (get_post_type($post_id) == 'kp' && get_post_status($post_id) == 'auto-draft') {
        // Получаем текущего пользователя
        $current_user = wp_get_current_user();
        // Получаем значение поля 'kp_manager'
        $kp_manager_value = get_field('kp_manager', 'user_' . $current_user->ID);
        // устанавливаем его как значение по умолчанию
        if ($kp_manager_value) {
            $value = $kp_manager_value;
        }
    }
    return $value;
}
add_filter('acf/load_value/name=kp_manager', 'set_default_kp_manager', 10, 3);

//Кнопка .kp_create
function kp_create_post() {
    // Получение товаров из корзины
    $cart = WC()->cart->get_cart();
    if (empty($cart)) {
        wp_send_json_error('Корзина пуста');
    }

    // Создание новой записи типа 'kp'
    $post_id = wp_insert_post(array(
        'post_title' => 'КП от ' . date('d.m.y'),
        'post_type' => 'kp',
        'post_status' => 'draft'
    ));

    // Обновление ярлыка (slug) поста
    wp_update_post(array(
        'ID' => $post_id,
        'post_name' => $post_id
    ));

    // Получаем текущего пользователя
    $current_user = wp_get_current_user();
    // Получаем значение поля 'kp_manager' у текущего пользователя
    $kp_manager_value = get_field('kp_manager', 'user_' . $current_user->ID);
    // Устанавливаем значение поля 'kp_manager' для нового поста
    if ($post_id && $kp_manager_value) {
        update_field('kp_manager', $kp_manager_value, $post_id);
//        update_post_meta($post_id, 'kp_manager', $kp_manager_value);
    }


    if (is_wp_error($post_id)) {
        wp_send_json_error('Ошибка при создании записи');
    }

    // Добавление товаров в поле повторитель ACF
    if (have_rows('kp_products', $post_id)) {
        while (have_rows('kp_products', $post_id)) {
            the_row();
            delete_row('kp_products', get_row_index(), $post_id);
        }
    }

    foreach ($cart as $cart_item) {
        $product_id = $cart_item['product_id'];
        $quantity = $cart_item['quantity'];
        add_row('kp_products', array(
            'product' => $product_id,
            'count' => $quantity
        ), $post_id);
    }

    // Возвращаем URL для редиректа
    $edit_url = get_edit_post_link($post_id, 'redirect');
    wp_send_json_success(array('redirect_url' => $edit_url));
}

add_action('wp_ajax_kp_create_post', 'kp_create_post');
add_action('wp_ajax_nopriv_kp_create_post', 'kp_create_post');

// AJAX обработчик для получения данных о товаре
function get_product_details() {

    // Получение ID товара из запроса
    $product_id = intval($_POST['product_id']);

    // Получение данных о товаре
    $product = wc_get_product($product_id);

    if ($product) {
        $product_data = array(
            'title' => $product->get_name(),
            'image' => wp_get_attachment_image_src($product->get_image_id(), 'medium')[0],
            'price' => $product->get_price(),
            'link' => get_permalink($product_id),
        );

        wp_send_json_success($product_data);
    } else {
        wp_send_json_error('Product not found');
    }
}

add_action('wp_ajax_get_product_details', 'get_product_details');
add_action('wp_ajax_nopriv_get_product_details', 'get_product_details');


// 2. Принудительное использование single-kp.php
add_filter('template_include', function($template) {
    if (get_query_var('post_type') === 'kp' || get_post_type() === 'kp') {
        return get_template_directory() . '/single-kp.php';
    }
    return $template;
});
// 3. Добавляем редирект с cart/?kp_post=ID на kp/ID
add_action('template_redirect', function() {
    if (isset($_GET['kp_post'])) {
        wp_redirect(site_url('/kp/' . intval($_GET['kp_post'])), 301);
        exit;
    }
});

// 3. Функция оформления заказа из КП
add_action('wp_ajax_kp_checkout', 'kp_checkout');
add_action('wp_ajax_nopriv_kp_checkout', 'kp_checkout');
function kp_checkout() {
    if (!isset($_POST['kp_id'])) {
        wp_send_json_error('Ошибка: отсутствует ID КП');
    }
    $kp_id = intval($_POST['kp_id']);
    $products = get_field('kp_products', $kp_id);
    if (!$products) {
        wp_send_json_error('Ошибка: нет товаров');
    }

    // Создание заказа
    $order = wc_create_order();
    foreach ($products as $item) {
        $product = wc_get_product($item['product']);
        if ($product) {
            $order->add_product($product, $item['count']);
        }
    }
    $order->set_status('pending');
    $order->save();

    wp_send_json_success(['redirect' => wc_get_checkout_url() . '?order_id=' . $order->get_id()]);
}
//АДМИНКА
//Изменение отображения номера заказа
add_filter('woocommerce_order_number', 'custom_woocommerce_order_number', 10, 2);
function custom_woocommerce_order_number($order_number, $order) {
    // Получаем название КП из мета-данных заказа
    $kp_title = $order->get_meta('_kp_title');

    if ($kp_title) {
        // Возвращаем номер заказа с названием КП
        return $order_number . ' ' . $kp_title;
    }

    return $order_number;
}
//Для отображения ссылки на КП в админке заказа
add_action('woocommerce_admin_order_data_after_order_details', 'display_kp_link_in_admin_order_meta', 10, 1);
function display_kp_link_in_admin_order_meta($order) {
    $kp_link = $order->get_meta('_kp_link');
    $kp_title = $order->get_meta('_kp_title');
    if ($kp_link && $kp_title) {
        echo '<div class="kp-order__link_to_kp"><div class="name">' . esc_html($kp_title) . '</div><div class="text">Ссылка на КП:</div> <a class="link" href="' . esc_url($kp_link) . '" target="_blank">' . esc_html($kp_link) . '</a></div>';
    }
}

// Отображение ссылки на КП в деталях заказа
add_action('woocommerce_order_details_after_order_table', 'display_kp_link_in_order_details', 10, 1);
function display_kp_link_in_order_details($order) {
    $kp_link = $order->get_meta('_kp_link');
    $kp_title = $order->get_meta('_kp_title');
    if ($kp_link) {
        echo '<div class="kp-order__link_to_kp"><strong>' . esc_html($kp_title) . '</strong><div class="text">Ссылка на КП: <a class="link" href="' . esc_url($kp_link) . '" target="_blank">' . esc_html($kp_link) . '</a></div></div>';
    }
}



