<?php

add_action('admin_menu', 'custom_admin_menu');

function custom_admin_menu() {
    add_menu_page(
        'Продукция', // Название страницы
        'Продукция', // Название пункта меню
        'manage_options', // Способность
        'custom-produkcziya', // Слаг
        'custom_produkcziya_page', // Функция, которая выводит содержимое страницы
        'dashicons-products', // Иконка меню
        9 // Позиция в меню
    );
    add_menu_page(
        'Товары Аренда (woocommerce)',
        'Товары Аренда (woocommerce)',
        'manage_woocommerce',
        'edit.php?post_type=product&product_cat=arenda-kofemashin',
        '',
        'dashicons-cart',
        9
    );
    add_menu_page(
        'Товары (Ремонт)',
        'Товары (Ремонт)',
        'manage_woocommerce',
        'edit.php?post_type=product&product_cat=remont',
        '',
        'dashicons-cart',
        9
    );
}
function exclude_categories_from_products_list($query) {
    global $pagenow, $post_type;

    if (is_admin() && $pagenow == 'edit.php' && $post_type == 'product' && !isset($_GET['product_cat'])) {
        $query->set('tax_query', array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => array('arenda-kofemashin', 'remont'),
                'operator' => 'NOT IN'
            )
        ));
    }
}
add_action('pre_get_posts', 'exclude_categories_from_products_list');
function custom_produkcziya_page() {
    $category = get_term_by('slug', 'produkcziya', 'product_cat');
    if (!$category) {
        echo '<p>Категория "produkcziya" не найдена.</p>';
        return;
    }

    $category_id = $category->term_id;

    // Получаем все подкатегории
    $args = array(
        'taxonomy' => 'product_cat',
        'child_of' => $category_id,
        'hide_empty' => false,
    );
    $subcategories = get_terms($args);

    // Функция для вывода товаров
    function display_products($category_id, $level = 0) {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $category_id,
                    'include_children' => false, // Важно: исключаем товары из подкатегорий
                ),
            ),
        );
        $products = new WP_Query($args);

        if ($products->have_posts()) {
            echo '<div class="accordion__content">';
            echo '<table class="widefat custom-produkcziya__posts custom-produkcziya__posts--lvl-' . $level . '">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col" id="image" class="manage-column column-image">Фото</th>';
            echo '<th scope="col" id="title" class="manage-column column-title column-primary">Название</th>';
            echo '<th scope="col" id="sku" class="manage-column column-sku">Артикул</th>';
            echo '<th scope="col" id="price" class="manage-column column-price">Цена</th>';
            echo '<th scope="col" id="tags" class="manage-column column-tags">Бренд</th>';
            echo '<th scope="col" id="date" class="manage-column column-date">Дата</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody id="the-list">';

            while ($products->have_posts()) {
                $products->the_post();
                $product = wc_get_product(get_the_ID());
                $edit_link = get_edit_post_link(get_the_ID());
                $sku = $product->get_sku();
                $price = $product->get_price();
                $tags = get_the_term_list(get_the_ID(), 'product_tag', '', ', ');
                $date = get_the_date();
                $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                $status = get_post_status();
                $status_label = ($status == 'publish') ? '' : 'Черновик';
                $status_class = ($status == 'publish') ? ' custom-produkcziya__item--status-publisher' : ' custom-produkcziya__item--status-draft';

                echo '<tr class="custom-produkcziya__item' . $status_class . '">';
                echo '<td class="image column-image">';
                if($thumbnail) {
                    echo '<a class="column-image__link" href="' . $edit_link . '">';
                    echo '<img width="60" height="60" src="' . $thumbnail . '">';
                    echo '</a>';
                }
                echo '</td>';
                echo '<td class="title column-title has-row-actions column-primary"><strong><a class="row-title" href="' . $edit_link . '">' . get_the_title() . '</a></strong> ' . $status_label . '</td>';
                echo '<td class="sku column-sku">' . $sku . '</td>';
                echo '<td class="price column-price">' . custom_wc_price($price) . '</td>';
                echo '<td class="tags column-tags">' . $tags . '</td>';
                echo '<td class="date column-date">' . $date . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        }

        // Восстанавливаем оригинальные данные поста
        wp_reset_postdata();
    }

    // Функция для форматирования цены
    function custom_wc_price($price) {
        if (strpos($price, '.') !== false) {
            return number_format($price, 2, '.', ' ');
        } else {
            return number_format($price, 0, '', ' ');
        }
    }

    echo '<div class="custom-produkcziya">';
    // Вывод товаров из категории "Продукция"
    echo '<h1 class="custom-produkcziya__title-h1">Продукция</h1>';
    //display_products(array($category_id), 0);

    // Функция для вывода подкатегорий
    function display_subcategories($parent_id, $level) {
        $args = array(
            'taxonomy' => 'product_cat',
            'parent' => $parent_id,
            'hide_empty' => false,
        );
        $subcategories = get_terms($args);

        foreach ($subcategories as $subcategory) {
            // Получаем количество товаров в подкатегории
            $product_count = $subcategory->count;

            // Добавляем класс accordion--empty, если товаров нет
            $accordion_class = ($product_count == 0) ? ' posts--empty' : '';

            echo '<div class="accordion accordion--lvl-' . $level . '">';
            echo '<div class="accordion__head' . $accordion_class . '">';
            echo '<h2 class="custom-produkcziya__title-h2">' . $subcategory->name . ' (' . $product_count . ')</h2>';
            $create_product_link = admin_url('post-new.php?post_type=product&product_cat=' . $subcategory->term_id);
            echo '<a href="' . $create_product_link . '" class="custom-produkcziya__title__link">Создать товар</a>';
            echo '</div>';
            display_products($subcategory->term_id, $level);
            display_subcategories($subcategory->term_id, $level + 1);
            echo '</div>';
        }
    }

    // Вывод товаров и подкатегорий из категории "Продукция"
    display_subcategories($category_id, 1);

    echo '</div>';
}

//шаблон для аренды
add_filter('template_include', function($template) {
    if (is_singular('product')) {
        global $post;
        $terms = wp_get_post_terms($post->ID, 'product_cat');

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                if ($term->slug === 'arenda-superavtomaticheskikh') {
                    return get_template_directory() . '/single-product_arenda.php';
                }
                if ($term->slug === 'arenda-rozhkovikh') {

                    return get_template_directory() . '/single-product_arenda.php';
                }
            }
        }
    }
    return $template;
}, 99);


//Исключение товаров "ремонт" из каталога, поиска и виджетов
add_action('template_redirect', function() {
    if (is_singular('product')) {
        global $post;
        $terms = wp_get_post_terms($post->ID, 'product_cat');

        foreach ($terms as $term) {
            if (term_is_ancestor_of(get_term_by('slug', 'remont', 'product_cat')->term_id, $term->term_id, 'product_cat') || $term->slug === 'remont') {
                wp_redirect(home_url()); // Перенаправляем на главную
                exit;
            }
        }
    }
});

//Исключение товаров из каталога, поиска и виджетов
add_action('pre_get_posts', function($query) {
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category() || is_search())) {
        $term = get_term_by('slug', 'remont', 'product_cat');
        if ($term) {
            $query->set('tax_query', array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'id',
                    'terms'    => $term->term_id,
                    'operator' => 'NOT IN',
                    'include_children' => true
                ),
            ));
        }
    }
});
///Исключение категорий из списка категорий (виджеты, меню, архивы)
add_filter('woocommerce_product_categories_widget_args', function($args) {
    $term = get_term_by('slug', 'remont', 'product_cat');
    if ($term) {
        $args['exclude'] = array_merge($args['exclude'] ?? [], [$term->term_id]);
    }
    return $args;
});

/*add_filter('get_terms', function($terms, $taxonomies, $args) {
    if (in_array('product_cat', (array)$taxonomies)) {
        $term = get_term_by('slug', 'remont', 'product_cat');
        if ($term) {
            $terms = array_filter($terms, function($t) use ($term) {
                return !term_is_ancestor_of($term->term_id, $t->term_id, 'product_cat') && $t->term_id !== $term->term_id;
            });
        }
    }
    return $terms;
}, 10, 3);*/
add_action('template_redirect', function() {
    if (is_product_category()) {
        $term = get_queried_object();
        $remont_term = get_term_by('slug', 'remont', 'product_cat');

        if ($remont_term && (term_is_ancestor_of($remont_term->term_id, $term->term_id, 'product_cat') || $term->slug === 'remont')) {
            wp_redirect(home_url()); // Перенаправляем на главную
            exit;
        }
    }
});


add_filter('post_type_link', function ($url, $post) {
    if ($post->post_type === 'product') {
        $terms = wp_get_post_terms($post->ID, 'product_cat');

        // Проверяем, есть ли товар в категории "prodazha" (или её дочерних)
        $in_prodazha = false;
        foreach ($terms as $term) {
            if ($term->slug === 'prodazha' || term_is_ancestor_of(get_term_by('slug', 'prodazha', 'product_cat')->term_id, $term->term_id, 'product_cat')) {
                $in_prodazha = true;
                break;
            }
        }

        if ($in_prodazha) {
            // Берём только основную (первая в списке) категорию
            $main_category = $terms[0]->slug;
            $url = home_url('/' . $main_category . '/' . $post->post_name . '/');
        }
    }
    return $url;
}, 10, 2);
add_action('template_redirect', function () {
    if (is_singular('product')) {
        $correct_url = get_permalink();
        $current_url = home_url($_SERVER['REQUEST_URI']);

        if (strpos($current_url, '/prodazha/') !== false && $correct_url !== $current_url) {
            wp_redirect($correct_url, 301);
            exit;
        }
    }
});
