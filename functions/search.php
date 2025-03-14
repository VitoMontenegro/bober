<?php

//SEARCH - NEW

function ajax_product_search() {
    $search_query = sanitize_text_field($_POST['query']);
    $context = sanitize_text_field($_POST['context']); // Получаем контекст запроса
    $search_query_lower = mb_strtolower($search_query);

    // Количество товаров
    $posts_per_page = 20;
    if ($context === 'search-page') {
        $posts_per_page = 400;
    }

    add_filter('posts_where', 'title_filter', 10, 2); // для поиска только в заголовках

    // Основной запрос для 'product'
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $posts_per_page,
        's' => $search_query,
    );
    $query = new WP_Query($args);

    //Бумажный стакан
    if (strpos('бумажный стаканы', $search_query_lower) !== false ) {
        $args_add = array(
            'post_type' => 'product',
            'posts_per_page' => $posts_per_page,
            's' => 'Стакан бумажный',
        );
        $query_add = new WP_Query($args_add);
        //Объединяем с Бумажный стакан с Продажа
        $query->posts = array_merge($query->posts, $query_add->posts);
        $query->post_count = count($query->posts);
    }

    if (preg_match('/\d/', $search_query_lower)) {
        $args_add = array(
            'post_type' => 'product',
            'posts_per_page' => 10, // Количество выводимых товаров
            'meta_query' => array(
                array(
                    'key' => '_sku', // Поиск по SKU
                    'value' => $search_query_lower,
                    'compare' => 'LIKE'
                )
            )
        );
        $query_add = new WP_Query($args_add);
        // Объединяем результаты основного запроса и поиска по SKU
        $query->posts = array_merge($query->posts, $query_add->posts);
        $query->post_count = count($query->posts);
    }



    // Дополнительный запрос для 'product_arenda'
    $search_query_lower = mb_strtolower($search_query);
    $is_arenda_search = stripos($search_query_lower, 'аренда') !== false ||
        stripos($search_query_lower, 'аренд') !== false ||
        stripos($search_query_lower, 'арен') !== false ||
        stripos($search_query_lower, 'rent') !== false;


    if ($is_arenda_search) {
        $args_2 = array(
            'post_type' => 'product_arenda',
            'posts_per_page' => $posts_per_page,
        );
    } else {
        $args_2 = array(
            'post_type' => 'product_arenda',
            'posts_per_page' => $posts_per_page,
            's' => $search_query,
        );
    }
    $query_2 = new WP_Query($args_2);





    if ($context === 'header') {
        echo '<div class="header__search__result__list search--padding">';

        //Доп Вывод для Страниц
        $is_page_search = false;
        echo '<div class="header__search__result__list-page">';
        if (strpos('ремонт сервис', $search_query_lower) !== false ) {
            echo '<a href="' . get_permalink(417) . '" class="header__search__result__list-page__item">Ремонт и сервис</a>';
            $is_page_search = true;
        }
        if (strpos('ремонт обслуживание суперавтоматических кофемашин', $search_query_lower) !== false ) {
            echo '<a href="' . get_permalink(420) . '" class="header__search__result__list-page__item">Ремонт и обслуживание суперавтоматических кофемашин</a>';
            $is_page_search = true;
        }
        if (strpos('ремонт обслуживание капсульных кофемашин', $search_query_lower) !== false ) {
            echo '<a href="' . get_permalink(421) . '" class="header__search__result__list-page__item">Ремонт и обслуживание капсульных кофемашин</a>';
            $is_page_search = true;
        }
        if (strpos('ремонт обслуживание рожковых кофемашин', $search_query_lower) !== false ) {
            echo '<a href="' . get_permalink(422) . '" class="header__search__result__list-page__item">Ремонт и обслуживание рожковых кофемашин</a>';
            $is_page_search = true;
        }
        if (strpos('ремонт кофемолок', $search_query_lower) !== false ) {
            echo '<a href="' . get_permalink(419) . '" class="header__search__result__list-page__item">Ремонт кофемолок</a>';
            $is_page_search = true;
        }
        if (strpos('прайс цена цены стоимость', $search_query_lower) !== false ) {
            echo '<a href="/price/" class="search__page__result__list-page__item">Прайс</a>';
            $is_page_search = true;
        }
        if (strpos('контакт', $search_query_lower) !== false ) {
            echo '<a href="' . get_permalink(425) . '" class="header__search__result__list-page__item">Контакты</a>';
            $is_page_search = true;
        }
        if (strpos('кофейное оборудование', $search_query_lower) !== false ) {
            echo '<a href="/prodazha/kofeynoe-oborudovanie/" class="header__search__result__list-page__item">Кофейное оборудование</a>';
            $is_page_search = true;
        }
        echo '</div>';


        // Вывод записей 'product_arenda'
        if ($query_2->have_posts()) {
            echo '<div class="search-page__title">Аренда</div>';
            while ($query_2->have_posts()) {
                $query_2->the_post();
                $product = wc_get_product(get_the_ID());
                echo '<a href="' . get_permalink() . '" class="header__search__result__list__item">';
                if (get_the_post_thumbnail_url(get_the_ID())) {
                    echo '<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'medium') . '" alt="' . get_the_title() . '" class="header__search__result__list__item__img">';
                }
                echo '<span class="header__search__result__list__item__title">' . get_the_title() . '</span>';
                echo '</a>';
            }
            if (!$is_arenda_search) {
                echo '<div class="search-page__title">Продажа</div>';
            }
        }

        // Вывод записей 'product'
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $product = wc_get_product(get_the_ID());
                echo '<a href="' . get_permalink() . '" class="header__search__result__list__item">';
                if (get_the_post_thumbnail_url(get_the_ID())) {
                    echo '<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'medium') . '" alt="' . get_the_title() . '" class="header__search__result__list__item__img">';
                }
                echo '<span class="header__search__result__list__item__title">' . get_the_title() . '</span>';
                echo '</a>';
            }

            $total_products = $query->found_posts;
            if ($total_products > 20) {
                echo '<a href="/?s=' . urlencode($search_query) . '" class="btn btn-orange header__search__result__list__more">Смотреть ещё <br>(найдено ' . $total_products . ')</a>';
            }
        }

        if(!$is_page_search && !$query_2->have_posts() && !$query->have_posts()){?>
            По запросу "<?php echo $search_query; ?>" ничего не найдено. Попробуйте ввести другой запрос
        <?php }

        echo '</div>';
    } elseif ($context === 'search-page') {

        //Доп Вывод для Страниц
        $is_page_search = false;
        echo '<div class="search__page__result__list-page">';
        if (strpos('ремонт сервис', $search_query_lower) !== false ) {
            echo '<a href="' . get_permalink(417) . '" class="search__page__result__list-page__item">Ремонт и сервис</a>';
            $is_page_search = true;
        }
        if (strpos('ремонт обслуживание суперавтоматических кофемашин', $search_query_lower) !== false ) {
            echo '<a href="' . get_permalink(420) . '" class="search__page__result__list-page__item">Ремонт и обслуживание суперавтоматических кофемашин</a>';
            $is_page_search = true;
        }
        if (strpos('ремонт обслуживание капсульных кофемашин', $search_query_lower) !== false ) {
            echo '<a href="' . get_permalink(421) . '" class="search__page__result__list-page__item">Ремонт и обслуживание капсульных кофемашин</a>';
            $is_page_search = true;
        }
        if (strpos('ремонт обслуживание рожковых кофемашин', $search_query_lower) !== false ) {
            echo '<a href="' . get_permalink(422) . '" class="search__page__result__list-page__item">Ремонт и обслуживание рожковых кофемашин</a>';
            $is_page_search = true;
        }
        if (strpos('ремонт кофемолок', $search_query_lower) !== false ) {
            echo '<a href="' . get_permalink(419) . '" class="search__page__result__list-page__item">Ремонт кофемолок</a>';
            $is_page_search = true;
        }
        if (strpos('прайс цена цены стоимость', $search_query_lower) !== false ) {
            echo '<a href="' . get_permalink(8474) . '" class="search__page__result__list-page__item">Контакты</a>';
            $is_page_search = true;
        }
        if (strpos('калькулятор', $search_query_lower) !== false ) {
            echo '<a href="' . get_permalink(425) . '" class="search__page__result__list-page__item">Контакты</a>';
            $is_page_search = true;
        }
        if (strpos('кофейное оборудование', $search_query_lower) !== false ) {
            echo '<a href="/prodazha/kofeynoe-oborudovanie/" class="search__page__result__list-page__item">Кофейное оборудование</a>';
            $is_page_search = true;
        }
        echo '</div>';


        // Вывод записей 'product_arenda'
        if ($query_2->have_posts()) {
            echo '<div class="catalog__list__title">Аренда</div>';
            while ($query_2->have_posts()) {
                $query_2->the_post();
                get_template_part('/template-parts/loop-arenda-item');
            }
            echo '<div class="catalog__list__title">Продажа</div>';
        }

        // Вывод записей 'product'
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('/template-parts/loop-product-item');
            }
        }

        if(!$is_page_search && !$query_2->have_posts() && !$query->have_posts()){?>
            По запросу "<?php echo $search_query; ?>" ничего не найдено. Попробуйте ввести другой запрос
        <?php }


    } else {
        echo '<div class="search-result-item search--padding">По запросу "'.$search_query.'" ничего не найдено. Попробуйте ввести другой запрос</div>';
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_product_search', 'ajax_product_search');
add_action('wp_ajax_nopriv_product_search', 'ajax_product_search');

// для поиска только в заголовках
function title_filter($where, $wp_query) {
    global $wpdb;
    if ($search_term = $wp_query->get('s')) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql($wpdb->esc_like($search_term)) . '%\'';
    }
    return $where;
}
