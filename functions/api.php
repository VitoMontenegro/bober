<?php


// Функция для добавления страницы в меню администратора
add_action('admin_menu', 'api_update_custom_page_add');
function api_update_custom_page_add() {
    add_menu_page(
        __('API Update', 'textdomain'),
        __('API Update', 'textdomain'),
        'manage_options', // Капабилити, необходимая для доступа к странице
        'api-update', // Слаг страницы
        'api_update_custom_page', // Функция, которая будет выводить содержимое страницы
        'dashicons-update',
        10,
    );
}

// Функция для вывода содержимого страницы
function api_update_custom_page() { ?>
    <div class="api-update">
        <h1>Обновление товаров по API</h1>
        <div class="api-update__panel">
            <div class="api-update__panel__num">1</div>
            <button class="api-update__panel__btn api-update__btn--get-all-id">Категории BIO</button>
            <div class="api-update__panel__indicator"></div>
        </div>
        <div class="api-update__panel">
            <div class="api-update__panel__num">2</div>
            <button class="api-update__panel__btn api-update__btn--get-all-product-id btn-disabled">Все товары BIO</button>
            <div class="api-update__panel__indicator"></div>
        </div>
        <div class="api-update__panel">
            <div class="api-update__panel__num">Фильтр</div>
            <button class="api-update__panel__btn api-update__btn--difference btn-disabled">Показать новые товары</button>
        </div>
<!--        <div class="api-update__panel">-->
<!--            <button class="api-update__panel__btn api-update__panel__btn-main-4">Убрать существующие</button>-->
<!--        </div>-->
        <?php /*
        //TODO
        <div class="api-update__current">

            <?php //Вывод sku товаров
            $posts = new WP_Query(array(
                'posts_per_page'	=> -1,
                'post_type'		=> 'product',
                "post_status"      => "publish",
            ));
            ?>
            <?php if ($posts->have_posts()) : ?>
            <div class="api-update__current__sku">
                <?php while ($posts->have_posts()) : $posts->the_post();
                    $product = wc_get_product( get_the_ID() );
                echo '<span data-sku="' . $product->get_sku() . '"></span>';
                 endwhile; ?>
            </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        */?>


        <div class="api-update__info"></div>
    </div>
    <?php
}

//Подключим скрипт для API
add_action('admin_enqueue_scripts', 'enqueue_my_custom_script');
function enqueue_my_custom_script($hook) {
    // Проверяем, что мы находимся на нужной странице админки
    if ('toplevel_page_api-update' !== $hook) {
        return;
    }

    wp_deregister_script('jquery');
    wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', false, null, true);
    wp_enqueue_script( 'jquery' );

    wp_register_script('api-script', get_template_directory_uri() . '/js/admin-api-script.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('api-script');
}



//Ошибка при загрузке изображения: cURL error 60: Peer's Certificate issuer is not recognized.
//решается так:
add_action('http_request_args', function($args, $url) {
    $args['sslverify'] = false;
    return $args;
}, 10, 2);









add_action( 'wp_ajax_api_update_products', 'api_update_products' );
add_action( 'wp_ajax_nopriv_api_update_products', 'api_update_products' );

function api_update_products(){

    $all_product = [];

    // доступы к API
    $login = 'kruassan-rf@mail.ru';
    $password = 'do9qa1wu';
    $data_auth = json_encode(array("login" => $login, "password" => $password));


    //Получим Инфу о Товаре по CODE
    $api_product_id = $_POST['products_id'];
    $data_auth_prod = json_encode(array("login" => $login, "password" => $password, "code" => $api_product_id));

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_PORT => "8030",
        CURLOPT_URL => "http://api.bioshop.ru:8030/product",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_auth_prod,
        CURLOPT_HTTPHEADER => [
            "content-type: application/json; charset=utf-8"
        ],
    ]);

    $response_3 = curl_exec($curl); // Получаем все товары из всех категорий
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "ERROR - products cURL('.$err.')---";
    }

    // Декодируем JSON-строку в массив
    $all_product[] = json_decode($response_3, true);
//    echo '<pre>';
//    echo print_r($all_product);
//    echo '</pre>';


    //Получим Инфу о Планируемых поступлений по CODE
    $data_auth_ext = json_encode(array("login" => $login, "password" => $password, "code" => $api_product_id));

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_PORT => "8030",
        CURLOPT_URL => "http://api.bioshop.ru:8030/product/expected",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_auth_ext,
        CURLOPT_HTTPHEADER => [
            "content-type: application/json; charset=utf-8"
        ],
    ]);

    $response_2 = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "ERROR - expected cURL('.$err.')---";
    }

    // Декодируем JSON-строку в массив
    $all_date = [];
    $all_date = json_decode($response_2, true);
//    echo '<pre>';
//    echo print_r($all_date);
//    echo '</pre>';


    function create_or_update_product_attributes($product_id, $secondaryProps) {
        $wc_product = wc_get_product($product_id);
        $attributes = array();

        foreach ($secondaryProps as $prop) {
            $attribute_name = 'pa_' . wc_sanitize_taxonomy_name($prop['prop']);
            $attribute_value = $prop['value'];

            if (!taxonomy_exists($attribute_name)) {
                $attribute_id = wc_create_attribute(array(
                    'name' => $prop['prop'],
                    'slug' => $attribute_name,
                    'type' => 'select',
                    'order_by' => 'menu_order',
                    'has_archives' => false,
                ));

                // Регистрируем таксономию для атрибута
                register_taxonomy(
                    $attribute_name,
                    'product',
                    array(
                        'label' => $prop['prop'],
                        'public' => true,
                        'hierarchical' => false,
                        'show_ui' => true,
                    )
                );
            } else {
                $attribute_id = wc_attribute_taxonomy_id_by_name($attribute_name);
            }

            if (!term_exists($attribute_value, $attribute_name)) {
                wp_insert_term($attribute_value, $attribute_name);
            }

            $term = get_term_by('name', $attribute_value, $attribute_name);
            if ($term && !is_wp_error($term)) {
                $attribute = new WC_Product_Attribute();
                $attribute->set_id($attribute_id);
                $attribute->set_name($attribute_name);
                $attribute->set_options(array($term->term_id));
                $attribute->set_visible(true);
                $attribute->set_variation(false);
                $attributes[$attribute_name] = $attribute;
            }
        }

        $wc_product->set_attributes($attributes);
        $wc_product->save();
    }

    function create_or_update_product_image($product_id, $product_img) {
        $image_url = 'https://portal.holdingbio.ru' . $product_img; // Полный URL изображения
        // Загрузка и установка изображения товара
        // Проверяем, является ли URL изображения действительным
            // Загружаем изображение в WordPress
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');

            // Временно загружаем файл изображения
            $tmp = download_url($image_url);

            // Проверяем на наличие ошибок
            if (is_wp_error($tmp)) {
                // Записываем сообщение об ошибке в лог ошибок WordPress
                error_log($tmp->get_error_message());

                // Для отладки: выводим сообщение об ошибке на экран (не рекомендуется для рабочего сайта)
                echo 'Ошибка при загрузке изображения: ' . $tmp->get_error_message();

                // Очищаем временный файл, если он существует
                if (@file_exists($tmp)) {
                    @unlink($tmp);
                }

                // Прекращаем выполнение скрипта или возвращаемся к другой части кода
                return;
            }
            // Подготавливаем массив данных файла для загрузки
            $file_array = array(
                'name'     => basename($image_url), // Имя файла
                'tmp_name' => $tmp                  // Путь к временному файлу
            );

            // Загружаем файл в медиатеку WordPress
            $attachment_id = media_handle_sideload($file_array, $product_id);

            // Проверяем на наличие ошибок
            if (is_wp_error($attachment_id)) {
                //echo '// Очищаем временный файл и выводим ошибку';
                if (file_exists($tmp)) {
                    @unlink($tmp);
                }
                return $attachment_id;
            }

            // Устанавливаем изображение как изображение товара (featured image)
            set_post_thumbnail($product_id, $attachment_id);
    }






    foreach ($all_product as $product) {
//        echo '<pre>';
//        echo print_r($product);
//        echo '</pre>';

        $product_id = wc_get_product_id_by_sku($product['code']);
//        $product_id_real = wc_get_product_id_by_sku($product['code']);
//        echo $product_id . '<br>';

        if ($product_id) { // --- Обновление существующего товара

            //Основные Значения
            $wc_product = wc_get_product($product_id);
            $wc_product->set_name($product['name']);
            $wc_product->set_description($product['description']);

            $price = $product['priceRUB'];
            $price = (float)$price;
            $price = (int)round($price);
            $price = number_format($price, 0, '.', ' ');
            $wc_product->set_regular_price($price); // Цена
            $wc_product->set_price($price); // Цена
            $wc_product->set_sku($product['code']);
            $wc_product->set_status('publish');

            //Атрибуты
            create_or_update_product_attributes($product_id, $product['secondaryProps']);

            //Категория
            $category_id = get_term_by('slug', $product['categorySlug'], 'product_cat')->term_id;
            if ($category_id) {
                $wc_product->set_category_ids(array($category_id));

                //Сортировка
                $sort_num = 0;
                if($product['categorySlug'] == 'kofemashiny-superavtomaty'){
                    $sort_num = 5;
                } elseif ($product['categorySlug'] == 'kofemashiny-traditsionnye'){
                    $sort_num = 4;

                    if($product['brand'] == 'Sanremo'){
                        $sort_num = 6;
                    }
                    if($product['brand'] == 'sanremo'){
                        $sort_num = 6;
                    }

                } elseif ($product['categorySlug'] == 'kofemolki'){
                    $sort_num = 3;
                } elseif ($product['categorySlug'] == 'kofevarki'){
                    $sort_num = 2;
                }
                update_post_meta($product_id, 'product_sort', $sort_num);
            }


            //Метки - бренды
            $brand_name = $product['brand'];
            wp_set_object_terms($product_id, $brand_name, 'product_tag', true);

            //Поля
            update_post_meta($product_id, 'api_product', true);
            update_post_meta($product_id, 'product_fullName', $product['fullName']);
            update_post_meta($product_id, 'product_model', $product['model']);
            update_post_meta($product_id, 'product_country', $product['country']);

            update_post_meta($product_id, 'product_isOrdered', $product['isOrdered']);
            update_post_meta($product_id, 'product_inAccess', $product['inAccess']);
//            update_post_meta($product_id, 'product_receiptDate', $product['receiptDate']);
            update_post_meta($product_id, 'product_isSale', $product['isSale']);
            update_post_meta($product_id, 'product_inReserve', $product['inReserve']);
//            update_post_meta($product_id, 'product_inWait', $product['inWait']);
            update_post_meta($product_id, 'product_isMarkdown', $product['isMarkdown']);
            update_post_meta($product_id, 'product_inStock', $product['inStock']);
//            update_post_meta($product_id, 'product_deliveryTime', $product['deliveryTime']);
            update_post_meta($product_id, 'product_warranty', $product['warranty']);
            //вес
            update_post_meta($product_id, 'product_unit', $product['unit']);
            update_post_meta($product_id, 'product_weightNet', $product['weightNet']);
            update_post_meta($product_id, 'product_weightGross', $product['weightGross']);
            update_post_meta($product_id, 'product_weightUnit', $product['weightUnit']);
            //разделённый размер
            $sizesNet = explode('х', $product['sizeNet']);
            update_post_meta($product_id, 'product_sizeNet_length', $sizesNet[0]);
            update_post_meta($product_id, 'product_sizeNet_width', $sizesNet[1]);
            update_post_meta($product_id, 'product_sizeNet_height', $sizesNet[2]);
            $sizesGross = explode('х', $product['sizeGross']);
            update_post_meta($product_id, 'product_sizeGross_length', $sizesGross[0]);
            update_post_meta($product_id, 'product_sizeGross_width', $sizesGross[1]);
            update_post_meta($product_id, 'product_sizeGross_height', $sizesGross[2]);
            //Массив
            if(is_array($product['spareParts'])){
                $spareParts_string = implode(',', $product['spareParts']);
                update_post_meta($product_id, 'product_spareParts', $spareParts_string);
            } else {
                update_post_meta($product_id, 'product_spareParts', '');
            }
            if(is_array($product['accessories'])){
                $accessories_string = implode(',', $product['accessories']);
                update_post_meta($product_id, 'product_accessories', $accessories_string);
            } else {
                update_post_meta($product_id, 'product_accessories', '');
            }
            if(is_array($product['sparePartOfProducts'])){
                $sparePartOfProducts_string = implode(',', $product['sparePartOfProducts']);
                update_post_meta($product_id, 'product_sparePartOfProducts', $sparePartOfProducts_string);
            } else {
                update_post_meta($product_id, 'product_sparePartOfProducts', '');
            }

            //Изображение товара
            if ($product['img']) {
                if($product['img'] !== get_field('product_img',$product_id)){
                    update_post_meta($product_id, 'product_img', $product['img']);
                    create_or_update_product_image($product_id, $product['img']);
                }
            }

            //Файлы
            $files = $product['files'];
            // Пройдемся по массиву $product['files'] и сохраним данные в repeater field
            if (!empty($product['files'])) {
                // Очистим существующие данные в repeater field
                delete_field('product_files', $product_id);//TODO

                foreach ($product['files'] as $index => $file) {
                    // Добавляем новую строку в repeater field
                    add_row('product_files', [
                        'product_files_name' => $file['name'],
                        'product_files_ref' => $file['ref'],
                        'product_files_type' => $file['type']
                    ], $product_id);
                }
            }

            //Планируемые поступления
            if(!empty($all_date)){
                delete_field('product_expected', $product_id);
                foreach ($all_date as $date_item) {
                    // Добавляем новую строку в repeater field
                    $date_item__expectedDate = explode("T",$date_item['expectedDate']);//убираем текст после T
                    add_row('product_expected', [
                        'product_expected_date' => $date_item__expectedDate[0],
                        'product_expected_quantity' => $date_item['available'],
                    ], $product_id);
                }
            }

            $wc_product->save(); //Сохраняем стандартные поля
            wc_delete_product_transients($product_id);// Очистка кэша товара


        } else { // --- Создание нового товара

            //Основные Значения
            $new_product = new WC_Product_Simple();
            $new_product->set_name($product['name']);
            $new_product->set_description($product['description']);

            $price = $product['priceRUB'];
            $price = (float)$price;
            $price = (int)round($price);
            $price = number_format($price, 0, '.', ' ');
            $new_product->set_regular_price($price);
            $new_product->set_price($price);
            $new_product->set_sku($product['code']);
            $new_product->set_status('publish'); // или 'draft' в зависимости от требований

            $product_id = $new_product->save();

            //Атрибуты
            create_or_update_product_attributes($product_id, $product['secondaryProps']);

            //Категория
            $category_id = get_term_by('slug', $product['categorySlug'], 'product_cat')->term_id;
            if ($category_id) {
                $new_product->set_category_ids(array($category_id));

                //Сортировка
                $sort_num = 0;
                if($product['categorySlug'] == 'kofemashiny-superavtomaty'){
                    $sort_num = 5;
                } elseif ($product['categorySlug'] == 'kofemashiny-traditsionnye'){
                    $sort_num = 4;


                    if($product['brand'] == 'Sanremo'){
                        $sort_num = 6;
                    }
                    if($product['brand'] == 'sanremo'){
                        $sort_num = 6;
                    }
                } elseif ($product['categorySlug'] == 'kofemolki'){
                    $sort_num = 3;
                } elseif ($product['categorySlug'] == 'kofevarki'){
                    $sort_num = 2;
                }
                update_post_meta($product_id, 'product_sort', $sort_num);
            }

            //Метки - бренды
            $brand_name = $product['brand'];
            wp_set_object_terms($product_id, $brand_name, 'product_tag', true);

            //Поля
            update_field('field_6664588b03fc2', true, $product_id); //api_product
            update_field('field_6656e230ee270', $product['fullName'], $product_id); //product_fullName
            update_field('field_6660a88286544', $product['model'], $product_id); //product_model
            update_field('field_6660a8bd86545', $product['country'], $product_id); //product_country

            update_field('field_666458cf03fc3', $product['isOrdered'], $product_id); //product_isOrdered
            update_field('field_66645a4a9eb17', $product['inAccess'], $product_id); //product_inAccess
//            update_field('field_66645a9e9eb1a', $product['receiptDate'], $product_id); //product_receiptDate
            update_field('field_6664599403fc4', $product['isSale'], $product_id); //product_isSale
            update_field('field_66645a5b9eb18', $product['inReserve'], $product_id); //product_inReserve
//            update_field('field_66645ac59eb1b', $product['inWait'], $product_id); //product_inWait
            update_field('field_666459ab03fc5', $product['isMarkdown'], $product_id); //product_isMarkdown
            update_field('field_66645a7d9eb19', $product['inStock'], $product_id); //product_inStock
//            update_field('field_66645ae69eb1c', $product['deliveryTime'], $product_id); //product_deliveryTime
            update_field('field_66645b089eb1d', $product['warranty'], $product_id); //product_warranty
            //вес
            update_field('field_6660a8c786546', $product['unit'], $product_id); //product_unit
            update_field('field_6660aa078654e', $product['weightNet'], $product_id); //product_weightNet
            update_field('field_6660aa178654f', $product['weightGross'], $product_id); //product_weightGross
            update_field('field_6660aa3186550', $product['weightUnit'], $product_id); //product_weightUnit
            //разделённый размер
            $sizesNet = explode('х', $product['sizeNet']);
            update_field('field_6660a91086547', $sizesNet[0], $product_id); //product_sizeNet_length
            update_field('field_6660a95786549', $sizesNet[1], $product_id); //product_sizeNet_width
            update_field('field_6660a9648654a', $sizesNet[2], $product_id); //product_sizeNet_height
            $sizesGross = explode('х', $product['sizeGross']);
            update_field('field_6660a9828654b', $sizesGross[0], $product_id); //product_sizeGross_length
            update_field('field_6660a99a8654c', $sizesGross[1], $product_id); //product_sizeGross_width
            update_field('field_6660a9b48654d', $sizesGross[2], $product_id); //product_sizeGross_height
            //Массив
            if(is_array($product['spareParts'])){
                $spareParts_string = implode(',', $product['spareParts']);
                update_field('field_666466ef2760c', $spareParts_string, $product_id);
            } else {
                update_field('field_666466ef2760c', '', $product_id); //product_spareParts
            }
            if(is_array($product['accessories'])){
                $accessories_string = implode(',', $product['accessories']);
                update_field('field_666469c97f9b1', $accessories_string, $product_id);
            } else {
                update_field('field_666469c97f9b1', '', $product_id); //product_accessories
            }
            if(is_array($product['sparePartOfProducts'])){
                $sparePartOfProducts_string = implode(',', $product['sparePartOfProducts']);
                update_field('field_66646ac554bf2', $sparePartOfProducts_string, $product_id);
            } else {
                update_field('field_66646ac554bf2', '', $product_id); //product_sparePartOfProducts
            }

            //Изображение товара
            if ($product['img']) {
                if($product['img'] !== get_field('product_img',$product_id)){
                    update_post_meta($product_id, 'product_img', $product['img']);
                    create_or_update_product_image($product_id, $product['img']);
                }
            }


            //Файлы
            $files = $product['files'];
            // Пройдемся по массиву $product['files'] и сохраним данные в repeater field
            if (!empty($product['files'])) {
                // Очистим существующие данные в repeater field
//                delete_field('product_files', $product_id);//TODO

                foreach ($product['files'] as $index => $file) {
                    // Добавляем новую строку в repeater field
                    add_row('product_files', [
                        'product_files_name' => $file['name'],
                        'product_files_ref' => $file['ref'],
                        'product_files_type' => $file['type']
                    ], $product_id);
                }
            }

            //Планируемые поступления
            if(!empty($all_date)){
                delete_field('product_expected', $product_id);
                foreach ($all_date as $date_item) {
                    // Добавляем новую строку в repeater field
                    $date_item__expectedDate = explode("T",$date_item['expectedDate']);//убираем текст после T
                    add_row('product_expected', [
                        'product_expected_date' => $date_item__expectedDate[0],
                        'product_expected_quantity' => $date_item['available'],
                    ], $product_id);
                }
            }

            $new_product->save();

            wc_delete_product_transients($product_id); // Очистка кэша товара

        }


    }
echo  $api_product_id;


die();

}


















add_action( 'wp_ajax_api_update_cat_products', 'api_update_cat_products' );
add_action( 'wp_ajax_nopriv_api_update_cat_products', 'api_update_cat_products' );

function api_update_cat_products(){

    // доступы к API
    $login = 'kruassan-rf@mail.ru';
    $password = 'do9qa1wu';
    $data_auth = json_encode(array("login" => $login, "password" => $password));

        $categoryId = $_POST['cat_id'];
        $data_auth_cat = json_encode(array("login" => $login, "password" => $password, "categoryId" => $categoryId));

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_PORT => "8030",
            CURLOPT_URL => "http://api.bioshop.ru:8030/products",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data_auth_cat,
            CURLOPT_HTTPHEADER => [
                "content-type: application/json; charset=utf-8"
            ],
        ]);

        $response_2 = curl_exec($curl); // ПОлучаем все товары из всех категорий
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "ERROR^^^" . $_POST['cat_id'] .'^^^';
        } else {
            $decodedResponse = json_decode($response_2, true);
            // Вывод декодированного ответа
                echo '<pre>';
                print_r($decodedResponse);
                echo '</pre>';
            echo $_POST['cat_id'] . '---';
            //echo '<span class="count">(' . count($decodedResponse) . '):</span> ';
            $prod_count = 0;
            foreach ($decodedResponse as $item){
                if($item['priceRUB'] == '0'){continue;}
                $prod_count++;
                echo '<span class="product-item" id="'.$item['code'].'">|</span>';
            }
//            $prod_count++;

            echo ' <span class="count">(' . $prod_count . '):</span> ';
            echo '---';
        }

        // Декодируем JSON-строку в массив
//        $data_2 = json_decode($response_2, true);
//echo print_r($data_2);

        //$allProductIds

        // Извлекаем все id товаров
//        extractProductIds($data_2, $allProductIds);

//    echo $allProductIds;
//    echo print_r($allProductIds);

//    die;
}






add_action( 'wp_ajax_api_update_category', 'api_update_category' );
add_action( 'wp_ajax_nopriv_api_update_category', 'api_update_category' );

function api_update_category(){

    // Опции
    $all_product = [];

    // доступы к API
    $login = 'kruassan-rf@mail.ru';
    $password = 'do9qa1wu';
    $data_auth = json_encode(array("login" => $login, "password" => $password));

    // Получим все категории
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_PORT => "8030",
        CURLOPT_URL => "http://api.bioshop.ru:8030/categories",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_auth,
        CURLOPT_HTTPHEADER => [
            "content-type: application/json; charset=utf-8"
        ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) { //возникла ошибка
        echo "ERROR - categories cURL('.$err.')---";
//        return false
    }
//    if ($err) {
//        echo "cURL Error #:" . $err;
//    } else {
//        echo $response;
//    }
//    echo "cURL Info: " . print_r(curl_getinfo($curl), true);


    // Декодируем JSON-строку в массив
    $data_response = json_decode($response);
//            echo '<pre>';
//            print_r($data_response);
//            echo '</pre>';


    //Вывод id-товаров в верстку
    foreach ($data_response as $key => $item){
        echo '<div class="api-update__info__main" data-idсat="'.$item->id.'">';
            echo '<div class="api-update__info__main__head">';
                echo '<div class="api-cat-main-item__title">' . $item->name . '</div>';
            echo '</div>';

            echo '<div class="api-update__info__main__btn">';
                echo '<button class="api-update__info__btn api-update__info__btn--get-ids-prod" data-idсat="'.$item->id.'">Товары BIO</button>';
                echo '<button class="api-update__info__btn api-update__info__btn--get-ids-prods-all" data-idсat="'.$item->id.'">Обновить</button>';
                echo '<div class="api-update__info__message"></div>';
            echo '</div>';

            echo '<div class="api-update__info__main__accordion">';
            echo '<div class="api-update__info__main__accordion__head">Доп информация</div>';
            echo '<div id="'.$item->id.'" class="parent api-cat-main-item">';
                foreach ($item->categories as $key_cats => $item_child){
                    echo '<div id="'.$item_child->id.'" class="child api-cat-item"><span class="cat_name">' . $item_child->name . '</span></div>';
                }
            echo '</div>';
            echo '</div>';

            echo '<div class="api-cat-main-item__cats-count">Категорий: ' . $key_cats . '</div>';
            echo '<div class="api-cat-main-item__prods-count">Товаров: <span class="prods-count"></span></div>';

        echo '</div>';
    }

//
//    //РУБРИКИ
    function create_or_update_categories_from_array($data_response)
    {
        // Получаем ID категории "Продажа"
        $parent_term = term_exists('prodazha', 'product_cat');
        $parent_id = is_array($parent_term) ? $parent_term['term_id'] : $parent_term['term_id'];

        // Если категория "Продажа" не существует, создаем ее
        if (!$parent_term) {
            $parent_term = wp_insert_term(
                'Продажа', // Название категории
                'product_cat', // Таксономия
                array(
                    'slug' => 'prodazha', // Слаг категории
                )
            );
            $parent_id = is_array($parent_term) ? $parent_term['term_id'] : $parent_term['term_id'];
        }

        foreach ($data_response as $key => $category_data) {
            // Проверяем, существует ли категория
            $term = term_exists($category_data->slug, 'product_cat');

            // Если категория не существует, создаем ее
            if (!$term) {
                $term = wp_insert_term(
                    $category_data->name, // Название категории
                    'product_cat', // Таксономия
                    array(
                        'slug' => $category_data->slug, // Слаг категории
                        'parent' => $parent_id, // ID родительской категории "Продажа"
                    )
                );
            }

            // Получаем ID категории
            $current_parent_id = is_array($term) ? $term['term_id'] : $term['term_id'];

            // Обрабатываем подкатегории
            foreach ($category_data->categories as $subcategory_data) {
                // Проверяем, существует ли подкатегория
                $subterm = term_exists($subcategory_data->slug, 'product_cat');

                // Если подкатегория не существует, создаем ее
                if (!$subterm) {
                    $subterm = wp_insert_term(
                        $subcategory_data->name, // Название подкатегории
                        'product_cat', // Таксономия
                        array(
                            'slug' => $subcategory_data->slug, // Слаг подкатегории
                            'parent' => $current_parent_id, // ID родительской категории
                        )
                    );
                } else {
                    // Если подкатегория существует, обновляем ее
                    $subterm_id = is_array($subterm) ? $subterm['term_id'] : $subterm['term_id'];
                    wp_update_term(
                        $subterm_id, // ID подкатегории
                        'product_cat', // Таксономия
                        array(
                            'name' => $subcategory_data->name, // Название подкатегории
                            'slug' => $subcategory_data->slug, // Слаг подкатегории
                            'parent' => $current_parent_id, // ID родительской категории
                        )
                    );
                }

                // Обновляем ACF-поле для подкатегории
                $subterm_id = is_array($subterm) ? $subterm['term_id'] : $subterm['term_id'];
                update_field('product_cat_api_id', $subcategory_data->id, 'product_cat_' . $subterm_id);
            }
        }
    }

// Вызываем функцию с массивом данных о рубриках
    //create_or_update_categories_from_array($data_response); //TODO - -включить создание категорий

/*
    // --- Функция для рекурсивного сбора ВСЕХ id категорий (РЕКУРСИВНАЯ)
//    function extractIds($element, &$ids)
//    {
//        if (is_array($element) || is_object($element)) {
//            foreach ($element as $value) {
//                // Если это объект и у него есть свойство id, добавляем его в массив
//                if (is_object($value) && isset($value->id)) {
//                    $ids[] = $value->id;
//                }
//                // Рекурсивно вызываем функцию для вложенных элементов
//                extractIds($value, $ids);
//            }
//        }
//    }

    // Массив для хранения всех id
//    $allIds = [];

    // Извлекаем все id
//    extractIds($data_response, $allIds);
*/
    die;
}






































add_action( 'wp_ajax_api_update', 'true_api_update' );
add_action( 'wp_ajax_nopriv_api_update', 'true_api_update' );

function true_api_update() {
//    echo $_POST['sort'];


    // Опции
    $all_product = [];

    // наш WooCommerce API
//    $consumer_key = 'ck_ebdd9d1d1f02dc5f6756394c3b0955c88573c110';
//    $consumer_secret = 'cs_4ce5dbd121fbdb373a83d8211ae033e0efbcb554';

    // доступы к API
    $login = 'kruassan-rf@mail.ru';
    $password = 'do9qa1wu';
    $data_auth = json_encode(array("login" => $login, "password" => $password));


    //=== Получим все категории ===

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_PORT => "8030",
        CURLOPT_URL => "http://api.bioshop.ru:8030/categories",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_auth,
        CURLOPT_HTTPHEADER => [
            "content-type: application/json; charset=utf-8"
        ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "'CURLOPT_URL - categories' cURL Error #:" . $err;
    } else {
        $decodedResponse = json_decode($response);
//            echo '<pre>';
//            print_r($decodedResponse);
//            echo '</pre>';
    }
    // Декодируем JSON-строку в массив
    $data_response = json_decode($response);



    //РУБРИКИ
    function create_or_update_categories_from_array($data_response) {
        foreach ($data_response as $key => $category_data) {

            // Проверяем, существует ли категория
            $term = term_exists($category_data->slug, 'product_cat');

            // Если категория не существует, создаем ее
            if (!$term) {
                $term = wp_insert_term(
                    $category_data->name, // Название категории
                    'product_cat', // Таксономия
                    array(
                        'slug' => $category_data->slug, // Слаг категории
                    )
                );
            }

            // Получаем ID категории
            $parent_id = is_array($term) ? $term['term_id'] : $term['term_id'];

            // Обрабатываем подкатегории
            foreach ($category_data->categories as $subcategory_data) {
                // Проверяем, существует ли подкатегория
                $subterm = term_exists($subcategory_data->slug, 'product_cat');

                // Если подкатегория не существует, создаем ее
                if (!$subterm) {
                    $subterm = wp_insert_term(
                        $subcategory_data->name, // Название подкатегории
                        'product_cat', // Таксономия
                        array(
                            'slug' => $subcategory_data->slug, // Слаг подкатегории
                            'parent' => $parent_id, // ID родительской категории
                        )
                    );
                } else {
                    // Если подкатегория существует, обновляем ее
                    $subterm_id = is_array($subterm) ? $subterm['term_id'] : $subterm['term_id'];
                    wp_update_term(
                        $subterm_id, // ID подкатегории
                        'product_cat', // Таксономия
                        array(
                            'name' => $subcategory_data->name, // Название подкатегории
                            'slug' => $subcategory_data->slug, // Слаг подкатегории
                            'parent' => $parent_id, // ID родительской категории
                        )
                    );
                }
            }
        }
    }

// Вызываем функцию с массивом данных о рубриках
    create_or_update_categories_from_array($data_response);






    // --- Функция для рекурсивного сбора ВСЕХ id категорий (РЕКУРСИВНАЯ)
    function extractIds($element, &$ids)
    {
        if (is_array($element) || is_object($element)) {
            foreach ($element as $value) {
                // Если это объект и у него есть свойство id, добавляем его в массив
                if (is_object($value) && isset($value->id)) {
                    $ids[] = $value->id;
                }
                // Рекурсивно вызываем функцию для вложенных элементов
                extractIds($value, $ids);
            }
        }
    }

    // Массив для хранения всех id
    $allIds = [];

    // Извлекаем все id
    extractIds($data_response, $allIds);
    //
    //    echo '<pre>';
    //    echo print_r($allIds); //Все ID категорий
    //    echo '</pre>';


    // --- Функция для рекурсивного сбора ВСЕХ code товаров
    function extractProductIds($element, &$ids)
    {
        if (is_array($element) || is_object($element)) {
            foreach ($element as $value) {
                $ids[] = $value['code'];

            }
        }
    }

    // Массив для хранения всех id товаров
    $allProductIds = [];

    // Перебираем все id категорий
    foreach ($allIds as $key => $id) {
        //    echo $id . PHP_EOL;
        //    echo '<br>';
        if ($key > 1) {
            break;
        } //небольше двух категорий

        $categoryId = $id;
        $data_auth_cat = json_encode(array("login" => $login, "password" => $password, "categoryId" => $categoryId));

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_PORT => "8030",
            CURLOPT_URL => "http://api.bioshop.ru:8030/products",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data_auth_cat,
            CURLOPT_HTTPHEADER => [
                "content-type: application/json; charset=utf-8"
            ],
        ]);

        $response_2 = curl_exec($curl); // ПОлучаем все товары из всех категорий
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "'CURLOPT_URL - products' cURL Error #:" . $err;
        } else {
            $decodedResponse = json_decode($response_2);
            // Вывод декодированного ответа
//                echo '<pre>';
//                print_r($decodedResponse);
//                echo '</pre>';
        }

        // Декодируем JSON-строку в массив
        $data_2 = json_decode($response_2, true);
//echo print_r($data_2);

        //$allProductIds

        // Извлекаем все id товаров
        extractProductIds($data_2, $allProductIds);

    }

    //    echo '<pre>';
    //    echo print_r($allProductIds);
    //    echo '</pre>';

    //foreach ($allProductIds as $key => $id){
    //    echo $id;
    //}


    // Перебираем массив всех товаров
    foreach ($allProductIds as $key_3 => $id) {

        if ($key_3 > 5) {
            break;
        } //небольше 5 товаров

        //Получим Инфу о Товаре по CODE
        $api_product_id = $id;
        $data_auth_prod = json_encode(array("login" => $login, "password" => $password, "code" => $api_product_id));

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_PORT => "8030",
            CURLOPT_URL => "http://api.bioshop.ru:8030/product",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data_auth_prod,
            CURLOPT_HTTPHEADER => [
                "content-type: application/json; charset=utf-8"
            ],
        ]);

        $response_3 = curl_exec($curl); // Получаем все товары из всех категорий
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "'CURLOPT_URL - products' cURL Error #:" . $err;
        } else {
            $decodedResponse = json_decode($response_3);
            // Вывод декодированного ответа
//                echo '<pre>';
//                print_r($decodedResponse);
//                echo '</pre>';
        }

        // Декодируем JSON-строку в массив
        $all_product[] = json_decode($response_3, true);
    }

    //    echo '<pre>';
    //    echo print_r($all_product);
    //    echo '</pre>';









    function create_or_update_product_attributes($product_id, $secondaryProps) {
        $wc_product = wc_get_product($product_id);
        $attributes = array();

        foreach ($secondaryProps as $prop) {
            $attribute_name = 'pa_' . wc_sanitize_taxonomy_name($prop['prop']);
            $attribute_value = $prop['value'];

            if (!taxonomy_exists($attribute_name)) {
                $attribute_id = wc_create_attribute(array(
                    'name' => $prop['prop'],
                    'slug' => $attribute_name,
                    'type' => 'select',
                    'order_by' => 'menu_order',
                    'has_archives' => false,
                ));

                // Регистрируем таксономию для атрибута
                register_taxonomy(
                    $attribute_name,
                    'product',
                    array(
                        'label' => $prop['prop'],
                        'public' => true,
                        'hierarchical' => false,
                        'show_ui' => true,
                    )
                );
            } else {
                $attribute_id = wc_attribute_taxonomy_id_by_name($attribute_name);
            }

            if (!term_exists($attribute_value, $attribute_name)) {
                wp_insert_term($attribute_value, $attribute_name);
            }

            $term = get_term_by('name', $attribute_value, $attribute_name);
            if ($term && !is_wp_error($term)) {
                $attribute = new WC_Product_Attribute();
                $attribute->set_id($attribute_id);
                $attribute->set_name($attribute_name);
                $attribute->set_options(array($term->term_id));
                $attribute->set_visible(true);
                $attribute->set_variation(false);
                $attributes[$attribute_name] = $attribute;
            }
        }

        $wc_product->set_attributes($attributes);
        $wc_product->save();
    }







    foreach ($all_product as $product) {
//        echo '<pre>';
//        echo print_r($product);
//        echo '</pre>';
        $product_id = wc_get_product_id_by_sku($product['code']);
//        $product_id_real = wc_get_product_id_by_sku($product['code']);

        if ($product_id) { // --- Обновление существующего товара

            //Основные Значения
            $wc_product = wc_get_product($product_id);
            $wc_product->set_name($product['name']);
            $wc_product->set_description($product['description']);

            $price = $product['priceRUB'];
            $price = (float)$price;
            $price = (int)round($price);
            $price = number_format($price, 0, '.', ' ');
            $wc_product->set_regular_price($price); // Цена
            $wc_product->set_price($price); // Цена
            $wc_product->set_sku($product['code']);
            $wc_product->set_status('publish');

            //Атрибуты
            create_or_update_product_attributes($product_id, $product['secondaryProps']);

            //Категория
            $category_id = get_term_by('slug', $product['categorySlug'], 'product_cat')->term_id;
            if ($category_id) {
                $wc_product->set_category_ids(array($category_id));
            }

            //Метки - бренды
            $brand_name = $product['brand'];
            wp_set_object_terms($product_id, $brand_name, 'product_tag', true);

            //Поля
            update_post_meta($product_id, 'api_product', true);
            update_post_meta($product_id, 'product_fullName', $product['fullName']);
            update_post_meta($product_id, 'product_model', $product['model']);
            update_post_meta($product_id, 'product_country', $product['country']);

            update_post_meta($product_id, 'product_isOrdered', $product['isOrdered']);
            update_post_meta($product_id, 'product_inAccess', $product['inAccess']);
//            update_post_meta($product_id, 'product_receiptDate', $product['receiptDate']);
            update_post_meta($product_id, 'product_isSale', $product['isSale']);
            update_post_meta($product_id, 'product_inReserve', $product['inReserve']);
//            update_post_meta($product_id, 'product_inWait', $product['inWait']);
            update_post_meta($product_id, 'product_isMarkdown', $product['isMarkdown']);
            update_post_meta($product_id, 'product_inStock', $product['inStock']);
//            update_post_meta($product_id, 'product_deliveryTime', $product['deliveryTime']);
            update_post_meta($product_id, 'product_warranty', $product['warranty']);
            //вес
            update_post_meta($product_id, 'product_unit', $product['unit']);
            update_post_meta($product_id, 'product_weightNet', $product['weightNet']);
            update_post_meta($product_id, 'product_weightGross', $product['weightGross']);
            update_post_meta($product_id, 'product_weightUnit', $product['weightUnit']);
            //разделённый размер
            $sizesNet = explode('х', $product['sizeNet']);
            update_post_meta($product_id, 'product_sizeNet_length', $sizesNet[0]);
            update_post_meta($product_id, 'product_sizeNet_width', $sizesNet[1]);
            update_post_meta($product_id, 'product_sizeNet_height', $sizesNet[2]);
            $sizesGross = explode('х', $product['sizeGross']);
            update_post_meta($product_id, 'product_sizeGross_length', $sizesGross[0]);
            update_post_meta($product_id, 'product_sizeGross_width', $sizesGross[1]);
            update_post_meta($product_id, 'product_sizeGross_height', $sizesGross[2]);
            //Массив
            if(is_array($product['spareParts'])){
                $spareParts_string = implode(',', $product['spareParts']);
                update_post_meta($product_id, 'product_spareParts', $spareParts_string);
            } else {
                update_post_meta($product_id, 'product_spareParts', '');
            }
            if(is_array($product['accessories'])){
                $accessories_string = implode(',', $product['accessories']);
                update_post_meta($product_id, 'product_accessories', $accessories_string);
            } else {
                update_post_meta($product_id, 'product_accessories', '');
            }
            if(is_array($product['sparePartOfProducts'])){
                $sparePartOfProducts_string = implode(',', $product['sparePartOfProducts']);
                update_post_meta($product_id, 'product_sparePartOfProducts', $sparePartOfProducts_string);
            } else {
                update_post_meta($product_id, 'product_sparePartOfProducts', '');
            }


            $wc_product->save(); //Сохраняем стандартные поля
            wc_delete_product_transients($product_id);// Очистка кэша товара


        } else { // --- Создание нового товара

            //Основные Значения
            $new_product = new WC_Product_Simple();
            $new_product->set_name($product['name']);
            $new_product->set_description($product['description']);

            $price = $product['priceRUB'];
            $price = (float)$price;
            $price = (int)round($price);
            $price = number_format($price, 0, '.', ' ');
            $new_product->set_regular_price($price);
            $new_product->set_price($price);
            $new_product->set_sku($product['code']);
            $new_product->set_status('publish'); // или 'draft' в зависимости от требований

            $product_id = $new_product->save();

            //Атрибуты
            create_or_update_product_attributes($product_id, $product['secondaryProps']);

            //Категория
            $category_id = get_term_by('slug', $product['categorySlug'], 'product_cat')->term_id;
            if ($category_id) {
                $new_product->set_category_ids(array($category_id));
            }

            //Метки - бренды
            $brand_name = $product['brand'];
            wp_set_object_terms($product_id, $brand_name, 'product_tag', true);

            //Поля
            update_field('field_6664588b03fc2', true, $product_id); //api_product
            update_field('field_6656e230ee270', $product['fullName'], $product_id); //product_fullName
            update_field('field_6660a88286544', $product['model'], $product_id); //product_model
            update_field('field_6660a8bd86545', $product['country'], $product_id); //product_country

            update_field('field_666458cf03fc3', $product['isOrdered'], $product_id); //product_isOrdered
            update_field('field_66645a4a9eb17', $product['inAccess'], $product_id); //product_inAccess
//            update_field('field_66645a9e9eb1a', $product['receiptDate'], $product_id); //product_receiptDate
            update_field('field_6664599403fc4', $product['isSale'], $product_id); //product_isSale
            update_field('field_66645a5b9eb18', $product['inReserve'], $product_id); //product_inReserve
//            update_field('field_66645ac59eb1b', $product['inWait'], $product_id); //product_inWait
            update_field('field_666459ab03fc5', $product['isMarkdown'], $product_id); //product_isMarkdown
            update_field('field_66645a7d9eb19', $product['inStock'], $product_id); //product_inStock
//            update_field('field_66645ae69eb1c', $product['deliveryTime'], $product_id); //product_deliveryTime
            update_field('field_66645b089eb1d', $product['warranty'], $product_id); //product_warranty
            //вес
            update_field('field_6660a8c786546', $product['unit'], $product_id); //product_unit
            update_field('field_6660aa078654e', $product['weightNet'], $product_id); //product_weightNet
            update_field('field_6660aa178654f', $product['weightGross'], $product_id); //product_weightGross
            update_field('field_6660aa3186550', $product['weightUnit'], $product_id); //product_weightUnit
            //разделённый размер
            $sizesNet = explode('х', $product['sizeNet']);
            update_field('field_6660a91086547', $sizesNet[0], $product_id); //product_sizeNet_length
            update_field('field_6660a95786549', $sizesNet[1], $product_id); //product_sizeNet_width
            update_field('field_6660a9648654a', $sizesNet[2], $product_id); //product_sizeNet_height
            $sizesGross = explode('х', $product['sizeGross']);
            update_field('field_6660a9828654b', $sizesGross[0], $product_id); //product_sizeGross_length
            update_field('field_6660a99a8654c', $sizesGross[1], $product_id); //product_sizeGross_width
            update_field('field_6660a9b48654d', $sizesGross[2], $product_id); //product_sizeGross_height
            //Массив
            if(is_array($product['spareParts'])){
                $spareParts_string = implode(',', $product['spareParts']);
                update_field('field_666466ef2760c', $spareParts_string, $product_id);
            } else {
                update_field('field_666466ef2760c', '', $product_id); //product_spareParts
            }
            if(is_array($product['accessories'])){
                $accessories_string = implode(',', $product['accessories']);
                update_field('field_666469c97f9b1', $accessories_string, $product_id);
            } else {
                update_field('field_666469c97f9b1', '', $product_id); //product_accessories
            }
            if(is_array($product['sparePartOfProducts'])){
                $sparePartOfProducts_string = implode(',', $product['sparePartOfProducts']);
                update_field('field_66646ac554bf2', $sparePartOfProducts_string, $product_id);
            } else {
                update_field('field_66646ac554bf2', '', $product_id); //product_sparePartOfProducts
            }


            $new_product->save();

            wc_delete_product_transients($product_id); // Очистка кэша товара

        }


    }

    echo 'DONE!';

    die;
}








//ИЗОБРАЖЕНИЕ 1
//
//                $image_url = 'https://portal.holdingbio.ru' . $product['img']; // URL изображения
//                $upload_dir = wp_upload_dir(); // Получаем базовый путь к папке uploads

//Другая загрузка из-за ошибки
//-----
//          $image_data = file_get_contents($image_url); // Скачиваем изображение
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, $image_url);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
//            $image_data = curl_exec($ch);
//            $error = curl_error($ch);
//            curl_close($ch);
//            $context = stream_context_create([
//                'ssl' => [
//                    'verify_peer' => false,
//                    'verify_peer_name' => false,
//                ],
//            ]);
//            $image_data = file_get_contents($image_url, false, $context);
//
//
//
//                if ($image_data === false) {
//                    // Не удалось скачать изображение
////                    continue;
//                }
//
//                // Проверяем, существует ли папка, если нет - создаем ее
//                $custom_dir = $upload_dir['basedir'] . '/api-images';
//                if (!file_exists($custom_dir)) {
//                    wp_mkdir_p($custom_dir);
//                }
//
//                // Определяем путь к новому файлу изображения
//                $filename = basename($image_url);
//                $file = $custom_dir . '/' . $filename;
//
//                // Сохраняем файл изображения
//                $saved = file_put_contents($file, $image_data);
//
//                if ($saved === false) {
//                    // Не удалось сохранить файл
////                    continue;
//                }
//
//                // Проверяем тип файла, присваиваем правильный тип файла изображению
//                $wp_filetype = wp_check_filetype($filename, null);
//                $attachment = array(
//                    'post_mime_type' => $wp_filetype['type'],
//                    'post_title' => sanitize_file_name($filename),
//                    'post_content' => '',
//                    'post_status' => 'inherit'
//                );
//
//                // Создаем вложение и получаем ID
//                $attach_id = wp_insert_attachment($attachment, $file, $product_id);
//                if ($attach_id === 0) {
//                    // Не удалось создать вложение
////                    continue;
//                }
//
//                // Подключаем необходимые функции для работы с изображениями
//                require_once(ABSPATH . 'wp-admin/includes/image.php');
//
//                // Устанавливаем метаданные для вложения и обновляем размеры изображения
//                $attach_data = wp_generate_attachment_metadata($attach_id, $file);
//                wp_update_attachment_metadata($attach_id, $attach_data);
//
//                // Присваиваем изображение товару
//                set_post_thumbnail($product_id, $attach_id);



//Изображение 2
//
//            $image_url = 'https://portal.holdingbio.ru' . $product['img']; // Полный URL изображения
//
//            // Загрузка и установка изображения товара
//            // Проверяем, является ли URL изображения действительным
//            if (!empty($image_url)) {
//                echo 'GO=';
//                // Загружаем изображение в WordPress
//                require_once(ABSPATH . 'wp-admin/includes/image.php');
//                require_once(ABSPATH . 'wp-admin/includes/file.php');
//                require_once(ABSPATH . 'wp-admin/includes/media.php');
//
//                // Временно загружаем файл изображения
//                $tmp = download_url($image_url);
//
//                // Проверяем на наличие ошибок
//                if (is_wp_error($tmp)) {
//                    // Записываем сообщение об ошибке в лог ошибок WordPress
//                    error_log($tmp->get_error_message());
//
//                    // Для отладки: выводим сообщение об ошибке на экран (не рекомендуется для рабочего сайта)
//                    echo 'Ошибка при загрузке изображения: ' . $tmp->get_error_message();
//
//                    // Очищаем временный файл, если он существует
//                    if (@file_exists($tmp)) {
//                        @unlink($tmp);
//                    }
//
//                    // Прекращаем выполнение скрипта или возвращаемся к другой части кода
//                    return;
//                }
//                // Подготавливаем массив данных файла для загрузки
//                $file_array = array(
//                    'name'     => basename($image_url), // Имя файла
//                    'tmp_name' => $tmp                  // Путь к временному файлу
//                );
//
//                // Загружаем файл в медиатеку WordPress
//                $attachment_id = media_handle_sideload($file_array, $product_id);
//
//                // Проверяем на наличие ошибок
//                if (is_wp_error($attachment_id)) {
//                    echo '// Очищаем временный файл и выводим ошибку';
//                    if (file_exists($tmp)) {
//                        @unlink($tmp);
//                    }
//                    return $attachment_id;
//                }
//
//                // Устанавливаем изображение как изображение товара (featured image)
//                set_post_thumbnail($product_id, $attachment_id);
//            }


//Изображение 3
//            $image_url = 'https://portal.holdingbio.ru' . $product['img']; // Полный URL изображения
//
//            // Загрузка и установка изображения товара
//            // Проверяем, является ли URL изображения действительным
//            if (!empty($image_url)) {
//                echo 'GO=';
//                // Загружаем изображение в WordPress
//                require_once(ABSPATH . 'wp-admin/includes/image.php');
//                require_once(ABSPATH . 'wp-admin/includes/file.php');
//                require_once(ABSPATH . 'wp-admin/includes/media.php');
//
//                // Временно загружаем файл изображения
//                $tmp = download_url($image_url);
//
//                // Проверяем на наличие ошибок
//                if (is_wp_error($tmp)) {
//                    // Записываем сообщение об ошибке в лог ошибок WordPress
//                    error_log($tmp->get_error_message());
//
//                    // Для отладки: выводим сообщение об ошибке на экран (не рекомендуется для рабочего сайта)
//                    echo 'Ошибка при загрузке изображения: ' . $tmp->get_error_message();
//
//                    // Очищаем временный файл, если он существует
//                    if (@file_exists($tmp)) {
//                        @unlink($tmp);
//                    }
//
//                    // Прекращаем выполнение скрипта или возвращаемся к другой части кода
//                    return;
//                }
//                // Подготавливаем массив данных файла для загрузки
//                $file_array = array(
//                    'name'     => basename($image_url), // Имя файла
//                    'tmp_name' => $tmp                  // Путь к временному файлу
//                );
//
//                // Загружаем файл в медиатеку WordPress
//                $attachment_id = media_handle_sideload($file_array, $product_id);
//
//                // Проверяем на наличие ошибок
//                if (is_wp_error($attachment_id)) {
//                    echo '// Очищаем временный файл и выводим ошибку';
//                    if (file_exists($tmp)) {
//                        @unlink($tmp);
//                    }
//                    return $attachment_id;
//                }
//
//                // Устанавливаем изображение как изображение товара (featured image)
//                set_post_thumbnail($product_id, $attachment_id);
//            }


//==================================    ИЗОБРАЖЕНИЕ - 4
/*
$image_url = 'https://portal.holdingbio.ru' . $product['img']; // Полный URL изображения

                        // Загрузка и установка изображения товара
                        // Проверяем, является ли URL изображения действительным
                        if (!empty($image_url)) {
                            echo 'GO=';
                            // Загружаем изображение в WordPress
                            require_once(ABSPATH . 'wp-admin/includes/image.php');
                            require_once(ABSPATH . 'wp-admin/includes/file.php');
                            require_once(ABSPATH . 'wp-admin/includes/media.php');

                            // Временно загружаем файл изображения
                            $tmp = download_url($image_url);

                            // Проверяем на наличие ошибок
                            if (is_wp_error($tmp)) {
                                // Записываем сообщение об ошибке в лог ошибок WordPress
                                error_log($tmp->get_error_message());

                                // Для отладки: выводим сообщение об ошибке на экран (не рекомендуется для рабочего сайта)
                                echo 'Ошибка при загрузке изображения: ' . $tmp->get_error_message();

                                // Очищаем временный файл, если он существует
                                if (@file_exists($tmp)) {
                                    @unlink($tmp);
                                }

                                // Прекращаем выполнение скрипта или возвращаемся к другой части кода
                                return;
                            }
                            // Подготавливаем массив данных файла для загрузки
                            $file_array = array(
                                'name'     => basename($image_url), // Имя файла
                                'tmp_name' => $tmp                  // Путь к временному файлу
                            );

                            // Загружаем файл в медиатеку WordPress
                            $attachment_id = media_handle_sideload($file_array, $product_id);

                            // Проверяем на наличие ошибок
                            if (is_wp_error($attachment_id)) {
                                echo '// Очищаем временный файл и выводим ошибку';
                                if (file_exists($tmp)) {
                                    @unlink($tmp);
                                }
                                return $attachment_id;
                            }

                            // Устанавливаем изображение как изображение товара (featured image)
                            set_post_thumbnail($product_id, $attachment_id);
                        }
            */


//==================================    СТАРОЕ

//                    $new_post_id = wp_insert_post(array(
//                        'post_type'    => 'product', // Или любой другой тип записи
//                        'post_title'   => $item['name'],
//                        'post_content' => $item['priceRUB'],
//                        'sku' => $item['code'],
////                        'type' => 'simple', //TODO
//
//                        'post_status'  => 'publish',
//                        // Другие поля, которые вы хотите установить...
//                    ));
//                    // Устанавливаем ACF поля
//                    update_field('code', $item['code'], $new_post_id);


//                // Данные о товаре
//                    $product_data = [
////                        'sku' => $item['code'],
//                        'name' => $item['name'],
//                        'type' => 'simple', //TODO
////                        'regular_price' => $item['priceRUB'],
//                        'description' => $item['priceRUB'],
//                        // Добавьте другие поля в соответствии с документацией WooCommerce REST API
//                    ];


//                    $curl_wc = curl_init();
//                    //добавляем товары в WC
//                    curl_setopt_array($curl_wc, [
//                        CURLOPT_URL => 'https://bober.wde.es/wp-json/wc/v3/products',
//                        CURLOPT_RETURNTRANSFER => true,
//                        CURLOPT_ENCODING => '',
//                        CURLOPT_MAXREDIRS => 10,
//                        CURLOPT_TIMEOUT => 0,
//                        CURLOPT_FOLLOWLOCATION => true,
//                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                        CURLOPT_CUSTOMREQUEST => 'POST',
//                        CURLOPT_POSTFIELDS => json_encode($product_data),
//                        CURLOPT_HTTPHEADER => [
//                            'Content-Type: application/json',
//                            'Authorization: Basic ' . base64_encode($consumer_key . ':' . $consumer_secret)
//                        ],
//                    ]);
//
//                    $response = curl_exec($curl_wc);
//
//                    curl_close($curl_wc);

// echo $response;
//                    echo print_r($product_data);


// Выводим все id
//        foreach ($ids as $key => $id) {
////            if($key > 1000){break;}
//            $key_all++;
//            echo $key_all . ' = ';
//            echo $key . ' - ';
//            echo $id . PHP_EOL;
//            echo '<br>';
//
//        }

//            } else {
//                echo "Ошибка декодирования JSON: " . json_last_error_msg();
//            }
//
//
//        }

