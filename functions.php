<?php

if ( ! defined( '_S_VERSION' ) ) {
    define('_S_VERSION', '0.0+230');
}
$GLOBALS['youtube_id'] = 0; //Глобавльная переменная для id youtube видео
$GLOBALS['page-template'] = ''; //Текущий шаблон (если нужен)


// ===== Подключение стилей и скриптов =====
//Подключение js и css
function theme_styles() {
    wp_enqueue_style( 'style_main', get_template_directory_uri().'/css/style.min.css', array(), _S_VERSION);
    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), _S_VERSION);
}
function theme_scripts() {
    wp_deregister_script('jquery');
    wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', false, null, true);
    wp_enqueue_script( 'jquery' );

    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', ['jquery'], null, true);
    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', ['jquery'], null, true);
    wp_enqueue_script( 'mCustomScrollbar', get_template_directory_uri() . '/js/mCustomScrollbar.min.js', ['jquery'], null, true);
    wp_enqueue_script( 'jquery-cookie', get_template_directory_uri() . '/js/jquery.cookie.js', ['jquery'], null, true);
    wp_enqueue_script( 'ion-rangeSlider', get_template_directory_uri() . '/js/ion.rangeSlider.min.js', ['jquery'], null, true);
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox.umd.js', ['jquery'], null, true);
    wp_enqueue_script( 'main-script', get_template_directory_uri() . '/js/scripts.js', false, _S_VERSION, true);

    if (current_user_can('editor') || current_user_can('administrator')) {//Скрипт для Модераторской части
        wp_enqueue_script('scripts-moderator', get_template_directory_uri() . '/js/scripts-moderator.js', false, _S_VERSION, true);
        wp_localize_script('scripts-moderator', 'ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce('ajax_nonce')
        ));
    }
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

//Свои стили для админки
add_action('admin_enqueue_scripts', 'admin_stylesheet');
function admin_stylesheet(){
    wp_enqueue_style("style-admin", get_template_directory_uri() . '/css/style-admin.css', array(), _S_VERSION);
}

//add_editor_style('css/style.min.css');
add_theme_support( 'editor-styles' );

//Отключение файлов
add_action( 'wp_print_styles', 'deregister_styles_and_scripts', 100 );
function deregister_styles_and_scripts() {
    wp_dequeue_style('wp-block-library'); //Удалить блоки Гутенберга id:wp-block-library-css
    wp_deregister_script( 'wp-embed' ); //Отключаем скрипт wp-embed.js
}
add_action( 'wp_enqueue_scripts', 'mywptheme_child_deregister_styles', 20 );
function mywptheme_child_deregister_styles() {
    wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );
function wps_deregister_styles() {
    wp_dequeue_style( 'global-styles' );
}
remove_action( 'wp_head', 'print_emoji_detection_script', 7);
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'rest_api_init', 'wp_oembed_register_route' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );


//=================
// ===== Меню =====
function my_menu() {
    register_nav_menu( 'header-menu', 'Меню в шапке' );
//  register_nav_menu( 'footer-menu', 'Меню в подвале' );
}
add_action ( 'after_setup_theme', 'my_menu' );

// Удаляем элемент меню, если страница в статусе "черновик"
function exclude_draft_pages_from_menu($items, $args) {
    foreach ($items as $key => $item) {
        $page = get_post($item->object_id);
        if ($page && $page->post_status == 'draft') {
            unset($items[$key]);
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'exclude_draft_pages_from_menu', 10, 2);

//Menu - активный пункт
function custom_menu_item($item_output, $item, $depth, $args) {
    $current_url = trailingslashit(home_url($_SERVER['REQUEST_URI']));
    $item_url = trailingslashit($item->url);

    $is_active = ($current_url === $item_url);

    // Дополнительная проверка для категорий продуктов
    if (!$is_active && is_tax('product_cat')) {
        $current_term = get_queried_object();
        $category_link = get_term_link($current_term);
        $is_active = ($category_link === $item_url);
    }

    // Заменяем тег только если это активный пункт верхнего уровня
    if ($is_active) {
        $item_output = preg_replace('/<a.*?>(.*)<\/a>/', '<div class="menu-item-text active-menu-item">$1</div>', $item_output, 1);
    }

    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'custom_menu_item', 10, 4);


//======================
// ===== Настройки =====
//разрешаем загружать svg
add_filter( 'upload_mimes', 'svg_upload_allow' );
function svg_upload_allow( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';
    return $mimes;
}
//Решение проблемы с ошибкой у размеров - SVG
add_filter('woocommerce_resize_images', static function() {
    return false;
});

//Не заменять на длинное тире
add_filter( 'run_wptexturize', '__return_false' );

//отключим требования сложности к паролям
function wc_ninja_remove_password_strength() {
    if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
        wp_dequeue_script( 'wc-password-strength-meter' );
    }
}
add_action( 'wp_print_scripts', 'wc_ninja_remove_password_strength', 100 );

// ================
// ===== Блог =====
//добавим миниатюру для записей
add_theme_support( 'post-thumbnails', array( 'post','reviews' ) );
add_theme_support( 'post-thumbnails', array( 'post','product' ) );
add_theme_support( 'post-thumbnails', array( 'post','product_arenda' ) );
//уберём обрамление <p>
remove_filter('the_excerpt', 'wpautop');

//Ограничиваем по количеству слов
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function custom_excerpt_length( $length ) {
    return 8; // Количество слов, которым хотим ограничить вывод функции
}

//концовка отрывка
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more) {
    return '...';
}

// ==========================
// ===== contact form 7 =====
add_filter('wpcf7_autop_or_not', '__return_false');
//удаляем "Уведомления при отправке формы"
function disable_wpcf7_response_output($output, $class, $content) {
    // Возвращаем пустую строку
    return '';
}
add_filter('wpcf7_form_response_output', 'disable_wpcf7_response_output', 10, 3);




//====================
// ===== Функции =====
//Разделение на тысячные
function numberWithSpaces($price) {
    $formatted_price = (float)$price;
    $formatted_price = (int)round($formatted_price);
    $formatted_price = number_format($formatted_price, 0, '.', ' ');
    return $formatted_price;
}


//Wishlist
function getCookiesArr()
{
    $wishlist = [];
    if (isset($_COOKIE["wishlist"])) {
        $wishlist = explode(" ", $_COOKIE["wishlist"]);
        if (($wishlist[0] == '') and (empty($wishlist[1]))) {//если пустой массив
            $wishlist = null;
        }
    }
    return $wishlist;
}


//===============================================
// ===== Товары, Категории, Кастомные посты =====
include('functions/posts.php');

// ===== Shortcode =====
include('functions/shortcode.php');

// ===== ACF Fields =====
include('functions/acf.php');

// ===== Gutenberg =====
include('functions/gutenberg.php');

// ===== Коммерческое предложение КП+PDF+оформление =====
include('functions/kp.php');

// ===== APP-FORM =====
include('functions/app-form.php');

// ===== wooocommerce =====
add_theme_support( 'woocommerce' );
//Предзаказ -> Подзаказ
function custom_rename_preorder_status( $status ) {
    if ( isset( $status['onbackorder'] ) ) {
        $status['onbackorder'] = 'Подзаказ';
    }
    return $status;
}
add_filter( 'woocommerce_product_stock_status_options', 'custom_rename_preorder_status' );



// ===== Пункт Продукция =====
include('functions/production.php');

// ===== catalog-loadmore =====
include('functions/catalog-loadmore.php');

// ===== catalog-functions =====
include('functions/catalog-functions.php');

// ===== catalog-filter =====
include('functions/catalog-filter.php');

// ===== Отсрочка (Оформление заказа) =====
include('functions/postponement.php');


// Удаление мета-блока (Галерея) woocommerce-product-images из страницы редактирования товара
function remove_woocommerce_product_images_metabox() {
    remove_meta_box('woocommerce-product-images', 'product', 'side');
}
add_action('add_meta_boxes', 'remove_woocommerce_product_images_metabox', 40);

//WOOCOMMERCE
//woocommerce в single-product - добавление товара в корзину,
add_action( 'wp_ajax_add_to_cart', 'custom_add_to_cart' );
add_action( 'wp_ajax_nopriv_add_to_cart', 'custom_add_to_cart' );
function custom_add_to_cart() {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $result = WC()->cart->add_to_cart( $product_id, $quantity );

    if ( $result ) { ?>
        <script>
            //$('.wish-modal-block__product-name').html('<?php echo get_the_title( $product_id); ?>');
            $('.modal-block__cart-add').addClass('modal-open');
            $('.modal-blur-wrapper').addClass('modal-open');
            setTimeout(()=> {
                $('.modal-block__cart-add').removeClass('modal-open');
                $('.modal-blur-wrapper').removeClass('modal-open');
            },2000)
        </script>
        <?php
    } else {
        echo '<span class="added-to-cart-message">Ошибка при добавлении товара в корзину</span>';
    }

    die();
}

//Отключим страницы меток (бренды)
function disable_product_tag_pages() {
    if (is_tax('product_tag')) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
        include(get_query_template('404'));
        exit;
    }
}
add_action('template_redirect', 'disable_product_tag_pages');


//вывод Скидки
function get_discount_price($price_html) {
    // Определяем регулярное выражение для поиска цифр после "Текущая цена: "
    $pattern = '/Текущая цена: ([\d\s.,]+)/';
    // Ищем совпадения с помощью регулярного выражения
    preg_match($pattern, $price_html, $matches);

    // Если найдены совпадения
    if (!empty($matches[1])) {
        // заменяем запятые
        $price = str_replace([','], ['.'], $matches[1]);
        $price = rtrim($price, '0');
        $price = rtrim($price, '.');
        return $price;
    }
    return false;
}


// Woocommerce убираем оплату
add_filter( 'woocommerce_cart_needs_payment', '__return_false' );

// Добавление чекбокса
add_action( 'woocommerce_review_order_before_submit', 'privacy_checkbox', 25 );

function privacy_checkbox() {

    woocommerce_form_field( 'privacy_policy_checkbox', array(
        'type'          => 'checkbox',
        'class'         => array( 'form-row' ),
        'label_class'   => array( 'woocommerce-form__label-for-checkbox' ),
        'input_class'   => array( 'woocommerce-form__input-checkbox' ),
        'required'      => true,
        'label'         => 'Принимаю <a href="' . get_privacy_policy_url() . '">Политику конфиденциальности</a>',
    ));

}

// Валидация
add_action( 'woocommerce_checkout_process', 'privacy_checkbox_error', 25 );

function privacy_checkbox_error() {

    if ( empty( $_POST[ 'privacy_policy_checkbox' ] ) ) {
        wc_add_notice( 'Ваш нужно принять политику конфиденциальности.', 'error' );
    }

}

// Хук для изменения цены товара в письме
add_filter('woocommerce_order_item_get_formatted_meta_data', 'change_order_item_price_in_email', 10, 2);
function change_order_item_price_in_email($formatted_meta, $item) {
    if (is_admin() && !defined('DOING_AJAX')) {
        return $formatted_meta;
    }

    $product_id = $item->get_product_id();
    $discounted_price = get_discounted_price($product_id);

    // Изменяем цену товара в письме
    $item->set_subtotal($discounted_price * $item->get_quantity());
    $item->set_total($discounted_price * $item->get_quantity());

    return $formatted_meta;
}

// Хук для добавления текста к названию товара в письме
add_filter('woocommerce_order_item_name', 'add_discount_text_to_product_name', 10, 2);
function add_discount_text_to_product_name($item_name, $item) {
    $product_id = $item->get_product_id();
    $original_price = wc_get_product($product_id)->get_price();
    $discounted_price = get_discounted_price($product_id);

    if ($discounted_price < $original_price) {
        $item_name .= ' <b>(Скидка)</b>';
    }

    return $item_name;
}


// Изменение текста
add_filter('gettext', 'change_quantity_text_in_email', 20, 3);
function change_quantity_text_in_email($translated_text, $text, $domain) {
    // Изменение текста "Количество" на "Кол-во"
    if ($domain === 'woocommerce' && $text === 'Quantity') {
        $translated_text = 'Кол&#8209;во';
    }
    // Изменение текста "Цена" на "Цена руб (с пробелами)"
    if ($domain === 'woocommerce' && $text === 'Price') {
        $translated_text = 'Цена&nbsp;руб.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    return $translated_text;
}


//Пользователи
function add_custom_menu_item() {
    // Добавляем новый пункт меню
    add_menu_page(
        'Пользователи', // Название страницы
        'Пользователи', // Название меню
        'manage_options', // Способность (capability)
        'custom-users-list', // Слаг (slug)
        'custom_users_list_page', // Функция, которая выводит содержимое страницы
        'dashicons-admin-users', // Иконка меню
        2 // Позиция в меню (чем меньше число, тем выше в меню)
    );
}
function custom_users_list_page() {
    // Перенаправляем на нужную страницу
    wp_redirect(get_site_url() . '/users-list/');
    exit;
}
add_action('admin_menu', 'add_custom_menu_item');


function restrict_custom_editor_page() {// Ограничение доступа к странице
    global $pagenow;
    $page = isset($_GET['page']) ? $_GET['page'] : '';

    if ($pagenow == 'admin.php' && $page == 'custom_editor_page' && !current_user_can('editor')) {
        wp_die(__('У вас нет доступа к этой странице.'));
    }
}
add_action('admin_init', 'restrict_custom_editor_page');


//пункты меню
function restrict_editor_access() {
    if (current_user_can('editor')) {
        global $menu, $submenu;

        // Удаляем пункты меню
        remove_menu_page('edit.php'); // Записи
//        remove_menu_page('edit.php?post_type=page'); // Страницы
        remove_menu_page('edit.php?post_type=reviews'); // Отзывы
//        remove_menu_page('edit.php?post_type=product'); // Товары (WooCommerce)
//        remove_menu_page('edit.php?post_type=product_arenda'); // Аренда
        remove_menu_page('edit.php?post_type=acf-field-group'); // acf
        remove_menu_page('profile.php'); // Профиль
//        remove_menu_page('upload.php'); // Медиафайлы
        remove_menu_page('wpseo_dashboard'); // Yoast SEO
        remove_menu_page('wpseo_workouts'); // Yoast SEO
        remove_menu_page('tools.php'); // Инструменты
        remove_menu_page('options-general.php'); // Настройки
        remove_menu_page('wpcf7'); // Contact Form 7
        remove_menu_page('edit-comments.php'); // Комментарии
        remove_menu_page('premmerce'); // premmerce
        remove_menu_page('api-update'); // api

        // Цены - acf option
        remove_menu_page('price_site');
        // Настройки сайта - acf option
        remove_menu_page('settings');
        remove_menu_page('contact_form_option');
        // Убираем пункт меню "Консоль"
//        remove_menu_page('index.php');


        remove_submenu_page('woocommerce', 'wc-settings');
        remove_submenu_page('woocommerce', 'wc-status');
        remove_submenu_page('woocommerce', 'wc-reports');
//        remove_menu_page( 'woocommerce-marketing' );

//        remove_submenu_page('woocommerce', 'wc-admin');
    }
}

add_action('admin_menu', 'restrict_editor_access', 999);
//редирект с страниц
function redirect_editor_access() {
    if (current_user_can('editor')) {
        $restricted_pages = array(
//            'wp-admin.php', //"Консоль"
//            'index.php', //"Консоль"
            'about.php',
//            'edit.php',
//            'post.php',
//            'edit.php?post_type=page',
            'edit.php?post_type=reviews',
//            'edit.php?post_type=product',
//            'edit.php?post_type=product_arenda',
//            'upload.php',
//            'admin.php?page=price_site',
            'admin.php?page=settings',
            'admin.php?page=contact_form_option',
            'admin.php?page=wpseo_dashboard',
            'profile.php',
//            'tools.php',
            'export-personal-data.php',
            'options-general.php',
            'options-writing.php',
            'options-reading.php',
            'options-discussion.php',
            'options-media.php',
            'options-permalink.php',
            'options-privacy.php',
            'options-general.php?page=menu_editor',
            'admin.php?page=premmerce-url-manager-admin',
            'admin.php?page=wpcf7',
            'admin.php?page=wpseo_workouts',
            'edit-comments.php',
//            'post-new.php', // "Создание записи"
//            'post-new.php?post_type=page', // "Создание страницы"
//            'admin.php?page=wc-settings', // Woocommerce
//            'admin.php?page=wc-status', // Woocommerce
//            'admin.php?page=wc-reports&range=month', // Woocommerce
        );

        $current_page = $_SERVER['REQUEST_URI'];
        foreach ($restricted_pages as $page) {
            if (strpos($current_page, $page) !== false) {
                wp_redirect('/wp-admin/admin.php?page=custom_editor_page');
                exit;
            }
        }
    }
}
add_action('admin_init', 'redirect_editor_access');

//Консоль
function remove_dashboard_widgets() {
    // Удаляем стандартные виджеты
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');   // Активность
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');  // Обзор публикаций
    remove_meta_box('wpseo-dashboard-overview', 'dashboard', 'normal');      // Yoast SEO
    remove_meta_box('wpseo-wincher-dashboard-overview', 'dashboard', 'normal');      // Yoast SEO
    remove_meta_box('wincher_dashboard_widget', 'dashboard', 'normal'); // Yoast SEO / Wincher: популярные ключевые фразы
    remove_meta_box('woocommerce_dashboard_status', 'dashboard', 'normal'); // Статус WooCommerce
    remove_meta_box('wordfence_activity_report_widget', 'dashboard', 'normal'); // Wordfence
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // Быстрый черновик
    remove_meta_box('dashboard_primary', 'dashboard', 'side');      // Новости и мероприятия WordPress
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

// Админ бар (Один раз)
function remove_admin_bar_items_for_editor($wp_admin_bar) {
    if (current_user_can('editor')) {
//        $wp_admin_bar->remove_node('edit');
        $wp_admin_bar->remove_node('new-content');
        $wp_admin_bar->remove_node('comments');
        $wp_admin_bar->remove_node('wpseo-menu');
        $wp_admin_bar->remove_node('search');
//        $wp_admin_bar->remove_node('site-name');
//        $wp_admin_bar->remove_node('wp-logo');
    }
}
add_action('admin_bar_menu', 'remove_admin_bar_items_for_editor', 999);


//Откроем woocommerce
function add_wc_orders_capability_to_editors() {
    $role = get_role('editor');
    // Добавляем возможности для редакторов
    if ($role) {
        $caps = array(
            'manage_woocommerce',
            'view_woocommerce_reports',
            'edit_shop_orders',
            'read_shop_order',
            'delete_shop_orders',
            'publish_shop_orders',
            'read_private_shop_orders',
            'edit_products',
            'edit_others_shop_orders',
            'edit_published_shop_orders',
            'delete_published_shop_orders',
            'delete_private_shop_orders',
            'delete_others_shop_orders',
            'manage_woocommerce_orders',
            'manage_woocommerce_products',
            'manage_woocommerce_coupons',
            'manage_woocommerce_settings'
        );
        foreach ($caps as $cap) {
            $role->add_cap($cap);
        }
    }
}
add_action('init', 'add_wc_orders_capability_to_editors');

//разрешим редактировать категории продуктов
function add_woocommerce_capabilities_to_editors() {
    $role = get_role('editor');

    // Права для управления товарами
    $role->add_cap('edit_product');
    $role->add_cap('read_product');
    $role->add_cap('delete_product');
    $role->add_cap('edit_products');
    $role->add_cap('edit_others_products');
    $role->add_cap('publish_products');
    $role->add_cap('read_private_products');
    $role->add_cap('delete_products');
    $role->add_cap('delete_private_products');
    $role->add_cap('delete_published_products');
    $role->add_cap('delete_others_products');
    $role->add_cap('edit_private_products');
    $role->add_cap('edit_published_products');

    // Права для управления метками товаров
    $role->add_cap('manage_product_terms');
    $role->add_cap('edit_product_terms');
    $role->add_cap('delete_product_terms');
    $role->add_cap('assign_product_terms');

    // Права для управления атрибутами товаров
    $role->add_cap('manage_product_attributes');
    $role->add_cap('edit_product_attributes');
    $role->add_cap('delete_product_attributes');
    $role->add_cap('assign_product_attributes');
}
add_action('admin_init', 'add_woocommerce_capabilities_to_editors');


//Добавим пункт Админка в Личном кабинете
function add_custom_discount_link_for_editors( $items ) {
    if ( current_user_can( 'editor' ) ) {
        // Создаем новый массив с нашим элементом в начале
        $new_items = array(
//                'custom_admin_editor' => __( 'Админка', 'woocommerce' ),
            'users_list' => __( 'Список пользователей', 'woocommerce' ),
        );

        // Добавляем остальные элементы меню
        foreach ( $items as $endpoint => $label ) {
            $new_items[ $endpoint ] = $label;
        }

        return $new_items;
    }
    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'add_custom_discount_link_for_editors' );
function custom_discount_link_url( $url, $endpoint, $value, $permalink ) {
//    if ( $endpoint === 'custom_admin_editor' ) {
//        $url = admin_url( 'admin.php?page=custom_editor_page' );
//    }
    if ( $endpoint === 'users_list' ) {
        $url = '/users-list/';
    }
    return $url;
}
add_filter( 'woocommerce_get_endpoint_url', 'custom_discount_link_url', 10, 4 );
function rename_my_account_dashboard($items) {
    if (isset($items['dashboard'])) {
        $items['dashboard'] = 'Мой аккаунт';
    }
    return $items;
}
add_filter('woocommerce_account_menu_items', 'rename_my_account_dashboard', 10, 1);

//function custom_discount_endpoint_content() {
//    // Контент для нового элемента меню, если требуется
//    echo '<a href="/wp-admin/admin.php?page=custom_discount">Перейти к скидкам</a>';
//}
//add_action( 'woocommerce_account_custom_discount_endpoint', 'custom_discount_endpoint_content' );
//// Регистрируем новый endpoint
//function add_custom_discount_endpoint() {
//    add_rewrite_endpoint( 'custom_discount', EP_ROOT | EP_PAGES );
//}
//add_action( 'init', 'add_custom_discount_endpoint' );


//Добавлен класс в body
function add_editor_body_class($classes) {
    if (current_user_can('editor') && !current_user_can('administrator')) {
        $classes .= ' is-user-editor';
    }
    return $classes;
}
add_filter('admin_body_class', 'add_editor_body_class');



//Пользователь

// Добавление полей в форму регистрации (Компания, Телефон)
// Проверка полей при регистрации
//add_filter('woocommerce_registration_errors', 'validate_custom_registration_fields', 10, 3);
//function validate_custom_registration_fields($errors, $username, $email) {
//    if (isset($_POST['user_company']) && empty($_POST['user_company'])) {
//        $errors->add('company_error', __('Компания обязательна для заполнения.', 'woocommerce'));
//    }
//    if (isset($_POST['user_phone']) && empty($_POST['user_phone'])) {
//        $errors->add('phone_error', __('Телефон обязателен для заполнения.', 'woocommerce'));
//    }
//    return $errors;
//}

// Сохранение полей при регистрации
add_action('woocommerce_created_customer', 'save_custom_registration_fields');
function save_custom_registration_fields($customer_id) {
    if (isset($_POST['user_company'])) {
        update_user_meta($customer_id, 'user_company', sanitize_text_field($_POST['user_company']));
    }
    if (isset($_POST['billing_phone'])) {
        update_user_meta($customer_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
    }
}
add_action('woocommerce_register_post', function ($username, $email, $errors) {
    if (empty($_POST['billing_phone'])) {
        $errors->add('billing_phone_error', 'Ошибка: Пожалуйста, укажите номер телефона.');
    }
}, 10, 3);
// Сохранение полей в профиле пользователя в админке
add_action('personal_options_update', 'save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'save_custom_user_profile_fields');
function save_custom_user_profile_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    if (isset($_POST['user_company'])) {
        update_user_meta($user_id, 'user_company', sanitize_text_field($_POST['user_company']));
    }

    if (isset($_POST['billing_phone'])) {
        update_user_meta($user_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
    }
}
// Сохранение полей "Компания" и "Телефон" при редактировании аккаунта
add_action('woocommerce_save_account_details', 'save_custom_account_fields');
function save_custom_account_fields($user_id) {
    if (isset($_POST['user_company'])) {
        update_user_meta($user_id, 'user_company', sanitize_text_field($_POST['user_company']));
    }

    if (isset($_POST['billing_phone'])) {
        update_user_meta($user_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
    }
}

//Заполнение поля user_moderator у пользователя после создания нового заказа
add_action('woocommerce_checkout_order_processed', 'assign_user_moderator', 10, 1);
function assign_user_moderator($order_id) {
    $order = wc_get_order($order_id);
    $user_id = $order->get_user_id();

    if ($user_id) {

        // Получаем данные пользователя с ID 23
        $moderator_user = get_user_by('ID', 23);

        // Создаем массив данных пользователя
        $moderator_data = array(
            'ID' => $moderator_user->ID,
            'user_login' => $moderator_user->user_login,
            'user_email' => $moderator_user->user_email,
            'user_nicename' => $moderator_user->user_nicename,
            'display_name' => $moderator_user->display_name,
        );
        // Обновляем поле ACF
        update_field('user_moderator', $moderator_data, 'user_' . $user_id);
    }
}
//Вывод поля user_moderator в админке на странице редактирования заказа
add_action('woocommerce_admin_order_data_after_billing_address', 'display_user_moderator_in_order_admin', 10, 1);

function display_user_moderator_in_order_admin($order) {
    $user_id = $order->get_user_id();

    if ($user_id) {
        $moderator_id = get_user_meta($user_id, 'user_moderator', true);
        if ($moderator_id) {
            $moderator = get_user_by('ID', $moderator_id);
            if ($moderator) {
                echo '<p><strong>Менеджер:</strong> ' . esc_html($moderator->display_name) . '</p>';
            }
        }
    }
}

// Убираем обязательность полей "Имя", "Фамилия" и "Отображаемое имя" на странице редактирования аккаунта
add_filter('woocommerce_save_account_details_required_fields', 'remove_required_fields');
function remove_required_fields($required_fields) {
    unset($required_fields['account_first_name']);
    unset($required_fields['account_last_name']);
    unset($required_fields['account_display_name']);
    return $required_fields;
}

//Woocommerce Личный кабинет
function my_woocommerce_account_menu_items($items) {
    // unset($items['dashboard']);         // убрать вкладку Консоль
    // unset($items['orders']);             // убрать вкладку Заказы
    unset($items['downloads']);         // убрать вкладку Загрузки
    unset($items['edit-address']);         // убрать вкладку Адреса
    // unset($items['edit-account']);         // убрать вкладку Детали учетной записи
    // unset($items['customer-logout']);     // убрать вкладку Выйти
    return $items;
}

add_filter( 'woocommerce_account_menu_items', 'my_woocommerce_account_menu_items', 10 );

// Разрешить символ @ в логинах пользователей
function custom_allow_at_in_user_login($username, $raw_username, $strict) {
    $username = wp_strip_all_tags($raw_username);
    $username = remove_accents($username);
    // Разрешить символ @
    $username = preg_replace('/[^a-zA-Z0-9 _.\-@]/', '', $username);
    $username = trim($username);
    return $username;
}
add_filter('sanitize_user', 'custom_allow_at_in_user_login', 10, 3);

// Обновить логин пользователя после регистрации
function custom_woocommerce_registration_save($customer_id) {
    if (isset($_POST['email'])) {
        $user_email = sanitize_email($_POST['email']);
        $user_data = array(
            'ID' => $customer_id,
            'user_login' => $user_email
        );
        wp_update_user($user_data);
    }
}
add_action('woocommerce_created_customer', 'custom_woocommerce_registration_save');


//Users list
function save_user_data() {
    check_ajax_referer('ajax_nonce', 'security');

    $current_user = $_POST['current_user'];
    $user_id = intval($_POST['user_id']);
    $user_phone = sanitize_text_field($_POST['user_phone']);
    $user_company = sanitize_text_field($_POST['user_company']);
    $user_comment = sanitize_textarea_field($_POST['user_comment']);

    if (current_user_can('edit_user', $current_user)) {
        update_user_meta($user_id, 'billing_phone', $user_phone);
        update_user_meta($user_id, 'user_company', $user_company);
        update_user_meta($user_id, 'user_comment', $user_comment);

        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_save_user_data', 'save_user_data');

function add_custom_order_info( $order ) {
    // Скрываем оригинальный текст
    echo '<style>
        .woocommerce-order-data__meta.order_number {
            display: none !important;
        }
    </style>';

    // Получаем дату и время оплаты
    $date_paid = $order->get_date_paid();
    if ( $date_paid ) {
        $date_string = $date_paid->date_i18n( get_option( 'date_format' ) . ' в ' . get_option( 'time_format' ) );

        // Выводим новый блок
        echo '<p class="woocommerce-order-data__meta custom-order-number">';
        echo esc_html( $date_string ) . '. IP клиента: ';
        echo '<span class="woocommerce-Order-customerIP">' . esc_html( $order->get_customer_ip_address() ) . '</span>';
        echo '</p>';
    }
}

// Добавляем наш блок в начало секции после платежной информации
add_action( 'woocommerce_admin_order_data_after_payment_info', 'add_custom_order_info', 1 );

function send_user_email() {
    // Проверяем nonce для безопасности
//    check_ajax_referer('send_user_email_nonce', 'nonce');
    check_ajax_referer('ajax_nonce', 'security');

    // Получаем данные из AJAX запроса
    $user_id = intval($_POST['user_id']);
    $user_email = sanitize_email($_POST['user_email']);

    // Получаем данные пользователя
    $user = get_userdata($user_id);
    if ($user) {
        $new_password = wp_generate_password();
        wp_set_password($new_password, $user_id);

        // Отправляем письмо
        $message = "Ваши данные для входа в личный кабинет <a href='" . get_site_url() . "/my-account/' target='_blank'>" . get_site_url() . "/my-account/</a><br>";
        $message .= "Ваша почта: $user_email<br>Ваш пароль: $new_password";

        $headers = array(
            'From: Bober Service <info@vh428.timeweb.ru >',
            'Content-Type: text/html; charset=UTF-8',
        );

        wp_mail($user_email, '«Бобёр-сервис». Пароль', $message, $headers);

        // Обновляем поле ACF user_get_pass на true
        update_field('user_get_pass', true, 'user_' . $user_id);

        wp_send_json_success('Письмо отправлено');
    } else {
        wp_send_json_error('Пользователь не найден');
    }
}
add_action('wp_ajax_send_user_email', 'send_user_email');
add_action('wp_ajax_nopriv_send_user_email', 'send_user_email');





//РЕГИСТРАЦИЯ
// Отключаем проверку пароля при регистрации
add_filter('woocommerce_registration_errors', 'custom_woocommerce_registration_errors', 10, 3);
function custom_woocommerce_registration_errors($errors, $username, $email) {
    if (isset($errors->errors['registration-error-missing-password'])) {
        unset($errors->errors['registration-error-missing-password']);
    }
    return $errors;
}

// Устанавливаем случайный пароль при регистрации
add_action('woocommerce_created_customer', 'custom_woocommerce_created_customer');
function custom_woocommerce_created_customer($customer_id) {
    $random_password = wp_generate_password();
    wp_set_password($random_password, $customer_id);
}

// Убираем поле пароля из формы регистрации
//add_filter('woocommerce_registration_fields', 'custom_woocommerce_registration_fields');
//function custom_woocommerce_registration_fields($fields) {
//    if (isset($fields['account_password'])) {
//        unset($fields['account_password']);
//    }
//    if (isset($fields['account_password-2'])) {
//        unset($fields['account_password-2']);
//    }
//    return $fields;
//}

// Отключаем автоматический вход после регистрации
add_filter('woocommerce_registration_auth_new_customer', '__return_false');
// Показать сообщение после регистрации
add_action('woocommerce_before_customer_login_form', 'custom_registration_message');
function custom_registration_message() {
    if (isset($_GET['registered']) && $_GET['registered'] == 'true') {
        echo '<div class="woocommerce-message">С вами свяжется менеджер, отправит пароль для входа в личный кабинет и размер скидок на ваши заказы.</div>';
    }
}
// Функция для изменения текста
function custom_woocommerce_text_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Ваша учетная запись создана. Данные для входа отправлены на ваш адрес электронной почты.' :
            $translated_text = 'С вами свяжется менеджер, отправит пароль для входа в личный кабинет и размер скидок на ваши заказы.';
            break;
    }
    return $translated_text;
}
add_filter( 'gettext', 'custom_woocommerce_text_strings', 20, 3 );


// Перенаправление после регистрации
//add_action('woocommerce_registration_redirect', 'custom_registration_redirect');
//function custom_registration_redirect($redirect) {
//    return add_query_arg('registered', 'true', wc_get_page_permalink('myaccount'));
//}

// Письмо после регистрации нового пользователя
function custom_user_registration_email($user_id) {
    // Получаем данные пользователя
    $user_info = get_userdata($user_id);
    $user_email = $user_info->user_email;
//    $billing_phone = get_user_meta($user_id, 'billing_phone', true);
//    $user_company = get_user_meta($user_id, 'user_company', true);

    $headers = array(
        'From: Bober Service <info@vh428.timeweb.ru >',
        'Content-Type: text/html; charset=UTF-8',
    );

    // Формируем текст письма
    $message = "Зарегистрирован новый пользователь:<br>";
    $message .= "id: " . $user_id . "<br>";
    $message .= "Почта: " . $user_email . "<br>";
//    $message .= "Телефон: " . $billing_phone . "\n";
//    $message .= "Компания: " . $user_company . "\n";
    $message .= "Посмотреть:" . get_site_url() . "/users-list/";

    // Отправляем письмо
    wp_mail('info@bober-service.ru, testdev@kometatek.ru', '«Бобёр-сервис». Новый пользователь', $message, $headers);


}
add_action('user_register', 'custom_user_registration_email');


// Отключам возможность сброс пароля, для user_get_pass=false
// Проверка значения поля user_get_pass при попытке сброса пароля
function custom_validate_password_reset($errors, $user) {
    if ($user) {
        $user_id = $user->ID;
        $user_get_pass = get_field('user_get_pass', 'user_' . $user_id); // Получаем значение поля ACF

        if (!$user_get_pass) {
            $errors->add('user_get_pass_error', __('Сброс пароля запрещен для вашего аккаунта. Пожалуйста, свяжитесь с администратором.', 'textdomain'));
        }
    }
}
add_action('validate_password_reset', 'custom_validate_password_reset', 10, 2);

// Отключение возможности сброса пароля, если user_get_pass = false
function custom_disable_password_reset($allow, $user_id) {
    $user_get_pass = get_field('user_get_pass', 'user_' . $user_id); // Получаем значение поля ACF

    if (!$user_get_pass) {
        return false;
    }
    return $allow;
}
add_filter('allow_password_reset', 'custom_disable_password_reset', 10, 2);













add_action( 'wp_footer', 'schema_product', 20 );
function schema_product(){
    if(is_product_category(17)){return false;}//prodazha

    if(get_post_type()=='product' && is_single()){
        global $post;

        //$desc = get_post_meta($post->ID, '_yoast_wpseo_metadesc', true);
        $desc = wp_trim_words(get_the_content($post->ID), $num_words = 20, $more = null );
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-post-thumbnail' )[0];
        $_product = wc_get_product($post->ID);
        ?>
        <script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "Product",
			"description": "<?=$desc?>",
			"name": "<?=get_the_title($post->ID)?>",
			"image": "<?=$image?>",
			"offers": {
				"@type": "Offer",
				"availability": "https://schema.org/InStock",
				"price": "<?=$_product->get_price()?>",
				"priceCurrency": "RUB"
			}
		}
		</script>
        <?php
    } elseif(get_post_type()=='product' && is_archive()){
        $o = get_queried_object();
        $min_price = 999999999999999999;
        $max_price = 0;
        $prods = get_posts([
            'numberposts' => -1,
            'post_type' => 'product',
            'post_status' => 'publish',
            'fields' => 'ids',
            'tax_query' => [
                [
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $o->term_id
                ]
            ]
        ]);
        foreach($prods as $item){
            $_prod = wc_get_product($item);
            $price = $_prod->get_price();

            if($min_price>$price){
                $min_price = $price;
            }
            if($max_price<$price){
                $max_price = $price;
            }
        }
        ?>
        <script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "Product",
			"name": "<?=$o->name?>",
			"offers": {
				"@type": "AggregateOffer",
				"offerCount": "<?=$o->count?>",
				"highPrice": "<?=$max_price?>",
				"lowPrice": "<?=$min_price?>",
				"priceCurrency": "RUB"
			}
		}
		</script>
        <?php
    }
}

function alter_existing_opengraph_image( $image ) {
    global $post;
    if ( is_single() && get_post_thumbnail_id($post->ID)) {
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium')[0];
    }
    return $image;
}
add_filter( 'wpseo_opengraph_image', 'alter_existing_opengraph_image', 50 );


//yoast seo shortcode
function register_custom_yoast_variables() {
    wpseo_register_var_replacement( '%%arenda_type%%', 'get_arenda_type', 'advanced', ' ' );
    wpseo_register_var_replacement( '%%arenda_price%%', 'get_arenda_price', 'advanced', ' ' );
}
add_action('wpseo_register_extra_replacements', 'register_custom_yoast_variables');

function get_arenda_type() {
    global $post;
    $arenda_type = get_field('product_arenda_type', $post->ID);

    if ($arenda_type == 'arenda-superavtomaticheskikh') {
        return 'суперавтоматической';
    } elseif ($arenda_type == 'arenda-rozhkovikh') {
        return 'рожковой';
    } else {
        return '';
    }
}
function get_arenda_price() {
    global $post;
    $discounted_price = get_field('product_arenda_price', $post->ID);
    if ($discounted_price) {

        $discounted_price = (float)$discounted_price;
        $discounted_price = (int)round($discounted_price);
        $discounted_price = number_format($discounted_price, 0, '.', ' ');

        return ' - ' . $discounted_price . ' руб/мес';
    } else {
        return '';
    }
}



add_action('wp_footer', function() {
    if (!is_cart()) return;

    $cart = WC()->cart->get_cart();
    $categories_data = [];

    foreach ($cart as $cart_item) {
        $product = $cart_item['data'];
        $terms = get_the_terms($product->get_id(), 'product_cat');
        $parent_category = 'Без категории';

        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                // Поднимаемся вверх, пока не найдём самую верхнюю родительскую категорию
                while ($term->parent != 0) {
                    $term = get_term($term->parent, 'product_cat');
                    if (!$term || is_wp_error($term)) break;
                }
                // Теперь $term содержит корневую категорию
                $parent_category = $term->name;
                break; // Достаточно первой найденной корневой категории
            }
        }

        $categories_data[$product->get_name()] = $parent_category;
    }

    $json_categories = json_encode($categories_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    ?>
    <div id="cart-product-categories" style="display: none;" data-categories='<?php echo $json_categories; ?>'></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log("🔥 WooCommerce блоковая корзина загружена!");

            function groupCartItems() {
                let cartTable = document.querySelector('.wc-block-cart-items');
                let cartTableBody = document.querySelector('.wc-block-cart-items tbody');
                let cartHeaderRow = document.querySelector('.wc-block-cart-items__header');
                if (cartHeaderRow) {
                    cartHeaderRow.style.display = 'none';
                }

                if (!cartTable || !cartTableBody || !cartHeaderRow) {
                    console.error("❌ Ошибка: таблица корзины не найдена!");
                    return;
                }

                let columnCount = cartHeaderRow.querySelectorAll('th').length; // Определяем количество колонок

                let cartRows = document.querySelectorAll('.wc-block-cart-items__row');
                let categoriesData = document.getElementById('cart-product-categories');
                if (!categoriesData) {
                    console.error("❌ Ошибка: данные категорий не найдены!");
                    return;
                }

                let categories = JSON.parse(categoriesData.getAttribute('data-categories'));
                let grouped = {};

                cartRows.forEach(row => {
                    let productLink = row.querySelector('.wc-block-components-product-name');
                    if (!productLink) return;

                    let productName = productLink.textContent.trim();
                    let category = categories[productName] || "Без категории";

                    if (!grouped[category]) {
                        grouped[category] = [];
                    }
                    grouped[category].push(row);
                });

                // Очищаем tbody, но оставляем структуру таблицы
                cartTableBody.innerHTML = "";

                for (let category in grouped) {
                    let categoryRow = document.createElement("tr");
                    categoryRow.className = "wc-block-cart-items__row";
                    categoryRow.innerHTML = `<td colspan="${columnCount}" style="padding: 10px 4px 10px 16px;font-weight: bold;font-size: 23px;"><div>${category}</div></td>`;
                    cartTableBody.appendChild(categoryRow);

                    grouped[category].forEach(el => cartTableBody.appendChild(el));
                }
            }

            setTimeout(groupCartItems, 500);
        });
    </script>
    <style>
        .cart-category-header td {
            font-size: 22px;
            font-weight: bold;
            border-bottom: 2px solid #ddd;
            padding: 10px 0;
            margin-top: 20px;
            text-align: left;
        }
    </style>
    <?php
});




