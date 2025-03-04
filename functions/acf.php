<?php

// Добавляем свой раздел блоков
add_filter( 'block_categories_all', 'custom_block_category', 10, 2 );
function custom_block_category( $default_categories, $post ) {
    $res =  array_merge(
        $default_categories,
        [
            [
                'slug'  => 'kometetek-category',     // Слаг категории который будем использовать при регистрации блока
                'title' => __( 'KOMETATEK Blocks', 'my-plugin' ),      // Отображаемое название категории
                'icon'  => 'wordpress'      // Иконка для категории
            ],
        ]
    );

    return array_reverse ($res);
}
add_action('acf/init', 'my_acf_init');
function my_acf_init() {

    if( function_exists('acf_register_block') ) {

        // register block
        acf_register_block(array(
            'name'              => 'main-banner',
            'title'             => __('Главный баннер'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));

        // register block
        acf_register_block(array(
            'name'              => 'menu-header',
            'title'             => __('Меню в под шапкой'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'main-info',
            'title'             => __('Информационные блоки'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));

        // register block
        acf_register_block(array(
            'name'              => 'advantages-cards',
            'title'             => __('Преимущества карточки'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));

        // register block
        acf_register_block(array(
            'name'              => 'iframe-full-video',
            'title'             => __('iframe Видео на весь экран'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));

        // register block
        acf_register_block(array(
            'name'              => 'flex-partners',
            'title'             => __('Блок с партнёрами'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'slider-images-5',
            'title'             => __('Слайдер изображений 5'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));

        // register block
        acf_register_block(array(
            'name'              => 'flex-col-3',
            'title'             => __('Изображения 3 в ряд'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        
        // register block
        acf_register_block(array(
            'name'              => 'review-slider',
            'title'             => __('Слайдер отзывов'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'blog-slider',
            'title'             => __('Слайдер блог'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'contact-form-1',
            'title'             => __('Контактная форма 1'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'contact-form-2',
            'title'             => __('Контактная форма 2'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'contacts-block',
            'title'             => __('Блок контактов'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'contacts-flex',
            'title'             => __('Блок контактов 2'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'benefit-cards',
            'title'             => __('Преимущества 2'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'benefit-links',
            'title'             => __('Блок с ссылками'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'flex-orange-col-3',
            'title'             => __('Блок с колонками 1'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'checkboxes-block',
            'title'             => __('Блок с чекбоксами'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'price-block',
            'title'             => __('Блок с ценами'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'flex-ver-blocks',
            'title'             => __('Блок с колонками 2'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'flex-ver-desc',
            'title'             => __('Блок с описанием в колонках'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'slider-logos',
            'title'             => __('Слайдер логотипов'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'block-text-slider',
            'title'             => __('Текст и слайдер'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'info-block-1',
            'title'             => __('Инфоблок 1'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'info-block-2',
            'title'             => __('Инфоблок 2'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'before-after-cards',
            'title'             => __('Карточки До и После'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'advantages-block-1',
            'title'             => __('Блок с цифрами'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'faq-block',
            'title'             => __('FAQ блок'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'main-wrap',
            'title'             => __('Заголовок h1 и описание'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'price-table--site',
            'title'             => __('Таблица цен (Общая)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'price-table--2-col',
            'title'             => __('Таблица цен (2 колонки)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'price-table--4-col',
            'title'             => __('Таблица цен (4 колонки)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'banner-1',
            'title'             => __('Баннер 1'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'banner-2',
            'title'             => __('Баннер 2'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'banner-3',
            'title'             => __('Баннер 3'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        // register block
        acf_register_block(array(
            'name'              => 'banner-4',
            'title'             => __('Баннер 4'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'catalog-with-filter',
            'title'             => __('Каталог с фильтром'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'catalog-tax',
            'title'             => __('Каталог категории'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'catalog-arenda',
            'title'             => __('Каталог аренды'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'info-block-3',
            'title'             => __('Инфоблок 3'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'info-block-3--col-3',
            'title'             => __('Инфоблок (3 колонки)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'map-gallery',
            'title'             => __('Карта и галерея'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'info-block-4',
            'title'             => __('Инфоблок 4'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'info-block-5',
            'title'             => __('Инфоблок 5'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'info-block-6',
            'title'             => __('Инфоблок 6'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'info-block-7',
            'title'             => __('Инфоблок 7'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'info-block-8',
            'title'             => __('Инфоблок 8'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'info-block-9',
            'title'             => __('Инфоблок 9'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'info-block-10',
            'title'             => __('Инфоблок 10'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'accordion-block',
            'title'             => __('Прайс аккордеон'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'api-prodazha-cat',
            'title'             => __('API категории Продажа'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
        acf_register_block(array(
            'name'              => 'iframe-block',
            'title'             => __('iframe-блок'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'kometetek-category',
        ));
    }
}

function my_acf_block_render_callback( $block ) {
    $slug = str_replace('acf/', '', $block['name']);
    if( file_exists( get_theme_file_path("/template-parts/block/{$slug}.php") ) ) {
        include( get_theme_file_path("/template-parts/block/{$slug}.php") );
    }
}

?>