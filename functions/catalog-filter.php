<?php

// КАТАЛОГ Аренды
add_action( 'wp_ajax_arenda_filter', 'true_arenda_filter' );
add_action( 'wp_ajax_nopriv_arenda_filter', 'true_arenda_filter' );

function true_arenda_filter() {
    $args_meta_key = '';

//    echo '<pre>';
//    echo print_r($_POST);
//    echo '</pre>';

    $args = array(
        'posts_per_page' => 12,
        'post_type' => 'product',
        'post_status' => 'publish',
        'paged' => 1,
        'meta_key' => $args_meta_key,

    );

//    //sort
    if (!empty($_POST['sort'])) {
        $args['orderby'] = 'meta_value_num name';
        $args['order'] = $_POST['sort'];
        $args['meta_key'] = '_price';
    }

//    //Цена
    $filter_price_from = 0;
    $filter_price_to = 1000000000;
    if (!empty($_POST['filter_price_from'])) {
        $filter_price_from = $_POST['filter_price_from'];
    }
    if (!empty($_POST['filter_price_to'])) {
        $filter_price_to = $_POST['filter_price_to'];
    }
    $args_price = array(
        'key' => '_price',
        'value' => array($filter_price_from, $filter_price_to),
        'type' => 'numeric',
        'compare' => 'BETWEEN',
    );


    $meta_query = array($args_price);
    $tax_query = array('relation' => 'AND');


    //Страница
    if (!empty($_POST['term_arenda'])) {
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $_POST['term_arenda']
        );
    }


    // Фильтрация по Тип
    if (!empty($_POST['product_arenda_type'])) {
        $meta_query[] = array(
            'key' => 'product_arenda_type',
            'value' => $_POST['product_arenda_type'],
            'compare' => 'IN',
        );
    }

    // Фильтрация по Подтип
    if (!empty($_POST['product_arenda_subtype'])) {
        $meta_query[] = array(
            'key' => 'product_arenda_subtype',
            'value' => $_POST['product_arenda_subtype'],
            'compare' => 'IN',
        );
    }
    // Фильтрация по Маркам
    if (!empty($_POST['product_arenda_mark'])) {
        $meta_query[] = array(
            'key' => 'product_arenda_mark',
            'value' => $_POST['product_arenda_mark'],
            'compare' => 'IN',
        );
    }

    // Фильтрация по Количество групп
    if (!empty($_POST['product_arenda_group'])) {
        $meta_query[] = array(
            'key' => 'product_arenda_group',
            'value' => $_POST['product_arenda_group'],
            'compare' => 'IN',
        );
    }
    // Фильтрация по Высота группы
    if (!empty($_POST['product_arenda_group_height'])) {
        $meta_query[] = array(
            'key' => 'product_arenda_group_height',
            'value' => $_POST['product_arenda_group_height'],
            'compare' => 'IN',
        );
    }
    // Фильтрация по Функции
    if (!empty($_POST['product_arenda_func'])) {
        $meta_query[] = array(
            'key' => 'product_arenda_func',
//            'value' => $_POST['product_arenda_func'],
            'value' => 'chocolate',
            'compare' => 'LIKE',
        );
    }

    //Производительность чашек в час
    if (!empty($_POST['product_arenda_performance'])) {
        $meta_query[] = array(
            'key' => 'product_arenda_performance',
            'value' => $_POST['product_arenda_performance'],
            'type' => 'numeric',
            'compare' => '>=',
        );
    }

    $args['meta_query'] = $meta_query;
    $args['tax_query'] = $tax_query;


//    echo '<pre>';
//    echo print_r($args);
//    echo '</pre>';

    ?>

    <?php
    $loop = new WP_Query($args);

    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            get_template_part('/template-parts/loop-product-item');
        }
    }

    if ($loop->max_num_pages <= $args['paged']) {
        echo '<div id="no-more-products" style="display: none;"></div>';
    }

    wp_reset_postdata(); ?>
    <?php
    die;
}





// КАТАЛОГ Продажа

add_action( 'wp_ajax_product_catalog_filter', 'true_product_catalog_filter' );
add_action( 'wp_ajax_nopriv_product_catalog_filter', 'true_product_catalog_filter' );

function true_product_catalog_filter() {

//    echo '<pre>';
//    echo print_r($_POST);
//    echo '</pre>';

    //изначальная сортировка
    $args_meta_key = 'product_sort';
//    if($_POST['term_cat']=='kofeynoe-oborudovanie'){ //Если это "Кофейное оборудование"
//        $args_meta_key = 'product_inAccess';
//    }

    $args = array(
        'posts_per_page' => 12,
        'post_type' => 'product',
        'post_status' => 'publish',
        'paged' => 1,

        'meta_key' => $args_meta_key,
        'orderby' => array(
            'meta_value_num' => 'DESC',
            'date' => 'DESC'  // Добавляем вторичную сортировку по дате
        ),
    );

//    //sort
    if (!empty($_POST['sort'])) {
        $args['orderby'] = 'meta_value_num name';
        $args['order'] = $_POST['sort'];
        $args['meta_key'] = '_price';
    }
//


//    //Цена
    $filter_price_from = 0;
    $filter_price_to = 1000000000;
    if (!empty($_POST['filter_price_from'])) {
        $filter_price_from = $_POST['filter_price_from'];
    }
    if (!empty($_POST['filter_price_to'])) {
        $filter_price_to = $_POST['filter_price_to'];
    }
    $args_price = array(
        'key' => '_price',
        'value' => array($filter_price_from, $filter_price_to),
        'type' => 'numeric',
        'compare' => 'BETWEEN',
    );

    $meta_query = array($args_price);
    $tax_query = array('relation' => 'AND');


    // Добавление фильтров по атрибутам
    $attributes = wc_get_attribute_taxonomies();
    foreach ($attributes as $attribute) {
//        echo $attribute->attribute_name . '<br>';
        $attribute_name = 'attribute_pa_' . $attribute->attribute_name;
        if (!empty($_POST[$attribute_name])) {
            $tax_query[] = array(
                'taxonomy' => 'pa_' . $attribute->attribute_name,
                'field' => 'slug',
                'terms' => $_POST[$attribute_name],
                'operator' => 'IN',
            );
        }
    }

    // Таксономия (категория рубрик)
    if (!empty($_POST['term_cat'])) {
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $_POST['term_cat'],
        );
    }
    // Таксономия (метки товаров)
    if (!empty($_POST['term_tag'])) {
        $tax_query[] = array(
            'taxonomy' => 'product_tag',
            'field' => 'slug',
            'terms' => $_POST['term_tag'],
        );
    }

    // Фильтрация по странам
    if (!empty($_POST['product_country'])) {
        $meta_query[] = array(
            'key' => 'product_country',
            'value' => $_POST['product_country'],
            'compare' => 'IN',
        );
    }

    // Фильтрация по брендам
    if (!empty($_POST['product_brand'])) {
        $tax_query[] = array(
            'taxonomy' => 'product_tag',
            'field' => 'slug',
            'terms' => $_POST['product_brand'],
        );
    }

    // Фильтрация по Наличию
    if (!empty($_POST['inAccess']) && $_POST['inAccess'] == 'on') {
        $meta_query[] = array(
            'key' => 'product_inAccess',
            'value' => '0',
            'compare' => '!=',
        );
        $meta_query[] = array(
            'key' => 'product_inAccess',
            'compare' => 'EXISTS',
        );
    }

    if (!empty($_POST['product_api'])) {
        if ($_POST['product_api'] == 'site') {
            $meta_query[] = array(
                'key' => 'api_product',
                'value' => '1',
                'compare' => '!=',
            );
        } elseif ($_POST['product_api'] == 'api') {
            $meta_query[] = array(
                'key' => 'api_product',
                'value' => '1',
                'compare' => '=',
            );
        } else {}
    }


    // Продукция
    // Фильтрация по степени обжарки
    if (!empty($_POST['production_degree_roasting'])) {
        $production_degree_roasting = array('relation' => 'OR');
        foreach ($_POST['production_degree_roasting'] as $item) {
            $production_degree_roasting[] = array(
                'key' => 'production_degree_roasting',
                'value' => '"' . $item . '"',
                'compare' => 'LIKE'
            );
        }
        $meta_query[] = $production_degree_roasting;
    }
    // Фильтрация по страна выращивания
    if (!empty($_POST['production_country'])) {
        $production_country = array('relation' => 'OR');
        foreach ($_POST['production_country'] as $item) {
            $production_country[] = array(
                'key' => 'production_country',
                'value' => '"' . $item . '"',
                'compare' => 'LIKE'
            );
        }
        $meta_query[] = $production_country;
    }

//    // Фильтрация по Весу
//    if (!empty($_POST['production_weight'])) {
//        $meta_query[] = array(
//            'key' => 'production_weight',
//            'value' => $_POST['production_weight'],
//            'compare' => 'IN',
//        );
//    }
//    // Фильтрация по весовой
    if (!empty($_POST['production_tea_weight'])) {
        $production_tea_weight = array('relation' => 'OR');
        foreach ($_POST['production_tea_weight'] as $item) {
            $production_tea_weight[] = array(
                'key' => 'production_tea_weight',
                'value' => '"' . $item . '"',
                'compare' => 'LIKE'
            );
        }
        $meta_query[] = $production_tea_weight;
    }
//    // Фильтрация по пакетированный
    if (!empty($_POST['production_tea_bagged'])) {
        $production_tea_bagged = array('relation' => 'OR');
        foreach ($_POST['production_tea_bagged'] as $item) {
            $production_tea_bagged[] = array(
                'key' => 'production_tea_bagged',
                'value' => '"' . $item . '"',
                'compare' => 'LIKE'
            );
        }
        $meta_query[] = $production_tea_bagged;
    }
    // Чай
    if (!empty($_POST['production_tea_color'])) {
        $production_tea_color = array('relation' => 'OR');
        foreach ($_POST['production_tea_color'] as $item) {
            $production_tea_color[] = array(
                'key' => 'production_tea_color',
                'value' => '"' . $item . '"',
                'compare' => 'LIKE'
            );
        }
        $meta_query[] = $production_tea_color;
    }


    $args['meta_query'] = $meta_query;
    $args['tax_query'] = $tax_query;

    $loop = new WP_Query($args);
//    echo '<pre>';
//    echo print_r($args);
//    echo '</pre>';
    ?>

    <?php
    $loop = new WP_Query($args);

    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            get_template_part('/template-parts/loop-product-item');
        }
    } else {
        echo 'Товаров не найдено';
    }

    if ($loop->max_num_pages <= $args['paged']) {
        echo '<div id="no-more-products" style="display: none;"></div>';
    }

    wp_reset_postdata(); ?>
    <?php
    die;
}
