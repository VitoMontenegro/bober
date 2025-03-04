<?php

//catalog-with-filter.php

//Вывод стран в фильтр catalog-with-filter.php
// Функция для получения уникальных значений поля "product_country"
function get_unique_product_countries() {
    global $wpdb;

    // Получаем все уникальные значения поля "product_country"
    $results = $wpdb->get_col("
        SELECT DISTINCT meta_value 
        FROM {$wpdb->postmeta} 
        WHERE meta_key = 'product_country' AND meta_value IS NOT NULL
    ");

    return $results;
}

// Функция для вывода значений в шаблон
function display_product_country_filters() {
    $countries = get_unique_product_countries();

    if (!empty($countries)) {
        echo '<div class="catalog__filter__item">';
        echo '<div class="catalog__filter__item__title is-accordion">Страна</div>';
        echo '<div class="catalog__filter__item__list" style="display:none">';

        $count_country = 0;
        foreach ($countries as $country) {
            if (!is_null($country) && $country !== '') {
                $count_country++;
//                if($count_country == 6){echo '<button class="filter-item filter-item__more"><i class="icon"><svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.351293 0.351294C0.819685 -0.117098 1.5791 -0.117098 2.04749 0.351293L10.6012 8.90498L10.6011 2.67455C10.6011 2.01215 11.1381 1.47515 11.8005 1.47514C12.4629 1.47513 12.9999 2.01211 12.9999 2.67452L13 11.8006C13 12.1187 12.8736 12.4238 12.6487 12.6487C12.4238 12.8736 12.1187 13 11.8006 13L2.80433 13C2.14192 13 1.60494 12.463 1.60494 11.8006C1.60494 11.1382 2.14192 10.6012 2.80433 10.6012L8.90502 10.6012L0.351294 2.04749C-0.117098 1.5791 -0.117098 0.819685 0.351293 0.351294Z" fill="#EB6025" /></svg></i><span class="filter-item__name">Развернуть</span></button>';};

                $country_slug = sanitize_title($country);
                $country_escaped = esc_attr($country);
                $country_id = 'id_' . $country_slug;

                echo '<label class="filter-item">';
                echo '<input type="checkbox" name="' . $country_escaped . '" value="' . $country_escaped . '" id="' . $country_id . '" class="filter-item__checkbox is-country">';
                echo '<div class="filter-item__checkbox-decoration"></div>';
                echo '<div class="filter-item__name">' . esc_html($country) . '</div>';
                echo '</label>';
            }
        }

        echo '</div>';
        echo '</div>';
    }
}


//Вывод всех Меток (Бренды)
// Функция для получения всех меток товаров
function get_all_product_tags() {
    $tags = get_terms(array(
        'taxonomy' => 'product_tag',
        'hide_empty' => false,
    ));
    return $tags;
}


// Функция для вывода меток в шаблон
function display_product_tags_filters() {
    $tags = get_all_product_tags();

    if (!empty($tags) && !is_wp_error($tags)) {
        echo '<div class="catalog__filter__item">';
        echo '<div class="catalog__filter__item__title is-accordion">Бренды</div>';
        echo '<div class="catalog__filter__item__list" style="display:none">';
        $count_brand = 0;
        foreach ($tags as $tag) {
            $count_brand++;
//            if($count_brand == 6){echo '<button class="filter-item filter-item__more"><i class="icon"><svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.351293 0.351294C0.819685 -0.117098 1.5791 -0.117098 2.04749 0.351293L10.6012 8.90498L10.6011 2.67455C10.6011 2.01215 11.1381 1.47515 11.8005 1.47514C12.4629 1.47513 12.9999 2.01211 12.9999 2.67452L13 11.8006C13 12.1187 12.8736 12.4238 12.6487 12.6487C12.4238 12.8736 12.1187 13 11.8006 13L2.80433 13C2.14192 13 1.60494 12.463 1.60494 11.8006C1.60494 11.1382 2.14192 10.6012 2.80433 10.6012L8.90502 10.6012L0.351294 2.04749C-0.117098 1.5791 -0.117098 0.819685 0.351293 0.351294Z" fill="#EB6025" /></svg></i><span class="filter-item__name">Развернуть</span></button>';};

            $tag_slug = esc_attr($tag->slug);
            $tag_name = esc_html($tag->name);

            echo '<label class="filter-item">';
            echo '<input type="checkbox" name="' . $tag_slug . '" value="' . $tag_slug . '" class="filter-item__checkbox is-brand">';
            echo '<div class="filter-item__checkbox-decoration"></div>';
            echo '<div class="filter-item__name">' . $tag_name . '</div>';
            echo '</label>';
        }

        echo '</div>';
        echo '</div>';
    }
}



//Проверка является ли категория вложенной в $cat_id
function is_category_or_subcategory($cat_id) {
    if (is_product_category()) {
        $current_category = get_queried_object();
        if ($current_category->term_id == $cat_id) {
            return true;
        }
        $ancestors = get_ancestors($current_category->term_id, 'product_cat');
        if (in_array($cat_id, $ancestors)) {
            return true;
        }
    }
    return false;
}