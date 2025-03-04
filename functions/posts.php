<?php

function cptui_register_my_cpts_product()
{
    /**
     * Post Type: Товары (Аренда).
     */

    $labels = [
        "name" => esc_html__("Товары (Аренда)", "custom-post-type-ui"),
        "singular_name" => esc_html__("Товар (Аренда)", "custom-post-type-ui"),
    ];

    $args = [
        "label" => esc_html__("Товары (Аренда)", "custom-post-type-ui"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => true,
        "rewrite" => [
            "slug" => "arenda-kofemashin/%product_arenda_type%",
            "with_front" => false
        ],
        "query_var" => true,
        "supports" => ["title", "thumbnail"],
        "taxonomies" => [],
        "show_in_graphql" => false,
    ];

    register_post_type("product_arenda", $args);
}
add_action('init', 'cptui_register_my_cpts_product');

function custom_product_arenda_permalink($post_link, $post) {
    if ($post->post_type == 'product_arenda') {
        $product_arenda_type = get_field('product_arenda_type', $post->ID);

        if ($product_arenda_type) {
            $post_link = str_replace('%product_arenda_type%', $product_arenda_type, $post_link);
        } else {
            $post_link = str_replace('%product_arenda_type%', '', $post_link);
        }
    }
    return $post_link;
}
add_filter('post_type_link', 'custom_product_arenda_permalink', 10, 2);

function custom_product_arenda_rewrite_rules($rules) {
    $new_rules = array(
        'arenda-kofemashin/([^/]+)/([^/]+)/?$' => 'index.php?product_arenda=$matches[2]',
        'arenda-kofemashin/([^/]+)/?$' => 'index.php?product_arenda=$matches[1]',
    );
    return $new_rules + $rules;
}
add_filter('rewrite_rules_array', 'custom_product_arenda_rewrite_rules');

function cptui_register_my_cpts_kp(){
    $labels = array(
        "name" => __( "КП", "bober" ),
        "singular_name" => __( "КП", "bober" ),
        "menu_name" => __( "КП", "bober" ),
        "all_items" => __( "Все КП", "bober" ),
        "add_new" => __( "Добавить КП", "bober" ),
        "add_new_item" => __( "Добавить новое КП", "bober" ),
        "edit_item" => __( "Редактировать КП", "bober" ),
        "new_item" => __( "Новое КП", "bober" ),
        "view_item" => __( "Смотреть КП", "bober" ),
        "view_items" => __( "Смотреть КП", "bober" ),
        "search_items" => __( "Найти КП", "bober" ),
        "not_found" => __( "КП не найдены", "bober" ),
        "not_found_in_trash" => __( "КП не найдены в корзине", "bober" ),
        "parent_item_colon" => __( "Родительское КП", "bober" ),
        "featured_image" => __( "Изображение", "bober" ),
        "set_featured_image" => __( "Установить изображение", "bober" ),
        "remove_featured_image" => __( "Удалить изображение", "bober" ),
        "use_featured_image" => __( "Использовать как изображение к КП", "bober" ),
        "archives" => __( "Архив КП", "bober" ),
        "insert_into_item" => __( "Вставить в КП", "bober" ),
        "uploaded_to_this_item" => __( "Загружено к этому КП", "bober" ),
        "filter_items_list" => __( "Фильтровать список КП", "bober" ),
        "items_list_navigation" => __( "Навигация по списку КП", "bober" ),
        "items_list" => __( "Список КП", "bober" ),
        "attributes" => __( "Атрибуты КП", "bober" ),
        "name_admin_bar" => __( "КП", "bober" ),
        "parent_item_colon" => __( "Родительское КП", "bober" ),
    );

    $args = array(
        "label" => __( "КП", "bober" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
//        "rewrite" => false,
        "rewrite" => array("slug" => "kp", "with_front" => false),
        "query_var" => false,
		'menu_icon' => 'dashicons-media-text',
        "supports" => array( "title"),
    );

    register_post_type( "kp", $args );
}
add_action('init', 'cptui_register_my_cpts_kp');
//add_action('wp', function(){
//	if(get_post_type()=='kp'){
//	global $wp_query;
//    $wp_query->set_404();
//    status_header(404);
//	}
//});

function cptui_register_my_cpts_managers(){
    $labels = array(
        "name" => __( "Менеджеры", "bober" ),
        "singular_name" => __( "Менеджеры", "bober" ),
        "menu_name" => __( "Менеджеры", "bober" ),
        "all_items" => __( "Все Менеджеры", "bober" ),
        "add_new" => __( "Добавить Менеджера", "bober" ),
        "add_new_item" => __( "Добавить нового Менеджера", "bober" ),
        "edit_item" => __( "Редактировать Менеджера", "bober" ),
        "new_item" => __( "Новый Менеджеры", "bober" ),
        "view_item" => __( "Смотреть Менеджера", "bober" ),
        "view_items" => __( "Смотреть Менеджера", "bober" ),
        "search_items" => __( "Найти Менеджера", "bober" ),
        "not_found" => __( "Менеджеры не найдены", "bober" ),
        "not_found_in_trash" => __( "Менеджеры не найдены в корзине", "bober" ),
        "parent_item_colon" => __( "Родительский Менеджер", "bober" ),
        "featured_image" => __( "Изображение", "bober" ),
        "set_featured_image" => __( "Установить изображение", "bober" ),
        "remove_featured_image" => __( "Удалить изображение", "bober" ),
        "use_featured_image" => __( "Использовать как изображение к Менеджеру", "bober" ),
        "archives" => __( "Архив Менеджеров", "bober" ),
        "insert_into_item" => __( "Вставить в Менеджера", "bober" ),
        "uploaded_to_this_item" => __( "Загружено к этому Менеджеру", "bober" ),
        "filter_items_list" => __( "Фильтровать список Менеджеров", "bober" ),
        "items_list_navigation" => __( "Навигация по списку Менеджеров", "bober" ),
        "items_list" => __( "Список Менеджеров", "bober" ),
        "attributes" => __( "Атрибуты Менеджеров", "bober" ),
        "name_admin_bar" => __( "Менеджеры", "bober" ),
        "parent_item_colon" => __( "Родительский Менеджер", "bober" ),
    );

    $args = array(
        "label" => __( "Менеджеры", "bober" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => false,
        "query_var" => false,
		'menu_icon' => 'dashicons-admin-users',
        "supports" => array( "title"),
    );

    register_post_type( "managers", $args );
}
add_action('init', 'cptui_register_my_cpts_managers');
add_action('wp', function(){
	if(get_post_type()=='managers'){
	global $wp_query;
    $wp_query->set_404();
    status_header(404);
	}
});