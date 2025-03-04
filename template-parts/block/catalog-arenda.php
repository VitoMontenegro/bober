<?php
    $term_arenda = get_field('catalog-arenda_term');
?>
<section class="section catalog__section is-catalog-arenda">
    <div class="container">
        <?php if(get_field('catalog-arenda_title')){?>
            <div class="catalog__list-wrap__title is-mobile"><?php the_field('catalog-arenda_title')?></div>
        <?php } ?>


        <div class="catalog catalog-with-filter">

            <div class="catalog__filter">
                <button class="close-modal catalog__filter__close-modal close-modal__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <path d="M1 1L21 21M21 1L1 21" stroke="#262626" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
                <button class="btn catalog__filter__mobile">
                    <span class="catalog__filter__mobile--text-open">Фильтры</span>
                    <span class="catalog__filter__mobile--text-close">Свернуть фильтры</span>
                </button>

                <div class="catalog__filter__wrap">
                    <!-- ON OFF -->
                    <div class="catalog__filter__item filter-item__on-off">
                        <div class="filter-item__on-off__title">Фильтры</div>
                        <label class="filter-item__on-off__label">
                            <input type="checkbox" name="filter_on-off" class="filter-item__on-off__label__checkbox" checked>
                            <div class="filter-item__on-off__label__checkbox-decoration">
                                <svg width="27" height="16" viewBox="0 0 27 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="26.9714" height="16" rx="8" fill="#D9DBE2" />
                                    <circle cx="8.00042" cy="7.99993" r="5.71429" fill="white" />
                                </svg>
                            </div>
                        </label>
                    </div>

                    <div class="catalog__filter__wrap__custom-scroll catalog-custom-scroll">

                        <!-- SORT -->
                        <div class="catalog__filter__item catalog__filter__item--sort">
                            <div class="catalog__filter__item__title">
                                Сортировать по
                            </div>
                            <div class="catalog__filter__item__list">
                                <button class="filter-item filter-item__sort" data-sort="asc">
                                    <i class="icon">
                                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.4627 6.15502C11.4627 5.59784 11.9304 5.14616 12.5075 5.14616H18.9552C19.5322 5.14616 20 5.59784 20 6.15502V12.1417C20 12.6989 19.5322 13.1506 18.9552 13.1506C18.3782 13.1506 17.9104 12.6989 17.9104 12.1417V8.52467L11.0824 14.8645C10.6779 15.24 10.0385 15.24 9.63407 14.8645L6.0597 11.5457L1.76892 15.5297C1.35299 15.9158 0.691602 15.9033 0.291668 15.5017C-0.108265 15.1001 -0.0952968 14.4614 0.320634 14.0752L5.33556 9.41891C5.74 9.04339 6.3794 9.04339 6.78385 9.41891L10.3582 12.7377L16.3613 7.16389H12.5075C11.9304 7.16389 11.4627 6.7122 11.4627 6.15502Z" fill="#262626"></path>
                                        </svg>
                                    </i>
                                    <span>Возрастанию цены</span>
                                </button>
                                <button class="filter-item filter-item__sort" data-sort="desc">
                                    <i class="icon">
                                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.4627 14.802C11.4627 15.3592 11.9304 15.8109 12.5075 15.8109H18.9552C19.5322 15.8109 20 15.3592 20 14.802V8.81534C20 8.25816 19.5322 7.80647 18.9552 7.80647C18.3782 7.80647 17.9104 8.25816 17.9104 8.81534V12.4324L11.0824 6.09256C10.6779 5.71703 10.0385 5.71703 9.63407 6.09256L6.0597 9.41131L1.76892 5.42737C1.35299 5.04118 0.691602 5.05371 0.291668 5.45534C-0.108265 5.85697 -0.0952968 6.49563 0.320634 6.88182L5.33556 11.5381C5.74 11.9136 6.3794 11.9136 6.78385 11.5381L10.3582 8.21936L16.3613 13.7931H12.5075C11.9304 13.7931 11.4627 14.2448 11.4627 14.802Z" fill="#262626"></path>
                                        </svg>
                                    </i>
                                    <span>Убыванию цены</span>
                                </button>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="catalog__filter__item catalog__filter__item--price">
                            <div class="catalog__filter__item__title">
                                Цена
                            </div>
                            <div class="catalog__filter__item__price">
                                <input type="number" name="filter_price_from" class="catalog__filter__item__price--from" placeholder="от">
                                <input type="number" name="filter_price_to" class="catalog__filter__item__price--to" placeholder="до">
                            </div>
                        </div>

                        <div class="catalog__filter__item">
                            <div class="catalog__filter__item__title is-accordion">Кофейный аппарат</div>
                            <div class="catalog__filter__item__list" style="display:none">

                                <?php if(in_array('arenda-superavtomaticheskikh', $term_arenda)){?>
                                    <label class="filter-item"><input type="checkbox" value="arenda-superavtomaticheskikh" class="filter-item__checkbox is-product_arenda_type">
                                        <div class="filter-item__checkbox-decoration"></div>
                                        <div class="filter-item__name">Суперавтоматические</div>
                                    </label>
                                <?php } ?>

                                <?php if(in_array('arenda-rozhkovikh', $term_arenda)){?>
                                    <label class="filter-item">
                                        <input type="checkbox" value="arenda-rozhkovikh" class="filter-item__checkbox is-product_arenda_type">
                                        <div class="filter-item__checkbox-decoration"></div>
                                        <div class="filter-item__name">Рожковые</div>
                                    </label>

                                    <label class="filter-item filter-item__child">
                                        <input type="checkbox" value="automatic" class="filter-item__checkbox is-product_arenda_subtype">
                                        <div class="filter-item__checkbox-decoration"></div>
                                        <div class="filter-item__name">Автоматические</div>
                                    </label>

                                    <label class="filter-item filter-item__child">
                                        <input type="checkbox" value="semi-automatic" class="filter-item__checkbox is-product_arenda_subtype">
                                        <div class="filter-item__checkbox-decoration"></div>
                                        <div class="filter-item__name">Полуавтоматические</div>
                                    </label>

                                    <label class="filter-item filter-item__child">
                                        <input type="checkbox" value="multiboiler" class="filter-item__checkbox is-product_arenda_subtype">
                                        <div class="filter-item__checkbox-decoration"></div>
                                        <div class="filter-item__name">Мультибойлер</div>
                                    </label>
                                <?php } ?>

                            </div>
                        </div>


                <?php
                //Фильтры
                $args = array(
                    'post_type' => 'product_arenda',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'product_arenda_type',
                            'value' => $term_arenda,
                            'compare' => 'IN'
                        )
                    )
                );

                $posts_filter = get_posts($args);

                $product_arenda_performance_values = array();
                $product_arenda_brands_values = array();
                $product_arenda_group_values = array();
                $product_arenda_group_label = array();
                $product_arenda_group_height_values = array();
                $product_arenda_group_height_label = array();
                $product_arenda_func_values = array();
                $product_arenda_func_label = array();

                foreach ($posts_filter as $post) {
                    $performance_value = get_field('product_arenda_performance', $post->ID);
                    if ($performance_value && !in_array($performance_value, $product_arenda_performance_values)) {
                        $product_arenda_performance_values[] = $performance_value;
                    }
                    $brands_value = get_field('product_arenda_mark', $post->ID);
                    if ($brands_value  && !in_array($brands_value , $product_arenda_brands_values)) {
                        $product_arenda_brands_values[] = $brands_value;
                    }
                    $group_value = get_field('product_arenda_group', $post->ID);
                    if ($group_value  && !in_array($group_value , $product_arenda_group_values)) {
                        $product_arenda_group_values[] = $group_value;
                    }
                    $group_height_value = get_field('product_arenda_group_height', $post->ID);
                    if ($group_height_value  && !in_array($group_height_value , $product_arenda_group_height_values)) {
                        $product_arenda_group_height_values[] = $group_height_value;
                    }
                    $func_value = get_field('product_arenda_func', $post->ID);
                    if ($func_value  && !in_array($func_value , $product_arenda_func_values)) {
                        $product_arenda_func_values[] = $func_value;
                    }
                }


                //Бренды
//                if (!empty($product_arenda_brands_values)) {
//                    echo '<div class="catalog__filter__item">';
//                    echo '<div class="catalog__filter__item__title">Марка</div>';
//                    echo '<div class="catalog__filter__item__list">';
//
//                    foreach ($product_arenda_brands_values as $key => $value) {
//                        if($key == 5){echo '<button class="filter-item filter-item__more"><i class="icon"><svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.351293 0.351294C0.819685 -0.117098 1.5791 -0.117098 2.04749 0.351293L10.6012 8.90498L10.6011 2.67455C10.6011 2.01215 11.1381 1.47515 11.8005 1.47514C12.4629 1.47513 12.9999 2.01211 12.9999 2.67452L13 11.8006C13 12.1187 12.8736 12.4238 12.6487 12.6487C12.4238 12.8736 12.1187 13 11.8006 13L2.80433 13C2.14192 13 1.60494 12.463 1.60494 11.8006C1.60494 11.1382 2.14192 10.6012 2.80433 10.6012L8.90502 10.6012L0.351294 2.04749C-0.117098 1.5791 -0.117098 0.819685 0.351293 0.351294Z" fill="#EB6025" /></svg></i><span class="filter-item__name">Развернуть</span></button>';};
//                        echo '<label class="filter-item">';
//                        echo '<input type="checkbox" value="' . esc_attr($value) . '" class="filter-item__checkbox is-product_arenda_mark">';
//                        echo '<div class="filter-item__checkbox-decoration"></div>';
//                        echo '<div class="filter-item__name">' . esc_html($value) . '</div>';
//                        echo '</label>';
//                    }
//
//                    echo '</div>';
//                    echo '</div>';
//                }

                //Количество групп
                if (!empty($product_arenda_group_values)) {
                    $product_arenda_group = get_field_object('product_arenda_group', $post->ID);
                    sort($product_arenda_group_values, SORT_STRING);

                    echo '<div class="catalog__filter__item">';
                    echo '<div class="catalog__filter__item__title is-accordion">Количество групп</div>';
                    echo '<div class="catalog__filter__item__list" style="display:none">';

                    foreach ($product_arenda_group_values as $value) {
                        echo '<label class="filter-item">';
                        echo '<input type="checkbox" value="' . esc_attr($value) . '" class="filter-item__checkbox is-product_arenda_group">';
                        echo '<div class="filter-item__checkbox-decoration"></div>';
                        echo '<div class="filter-item__name">' . $product_arenda_group['choices'][ $value ] . '</div>';
                        echo '</label>';
                    }

                    echo '</div>';
                    echo '</div>';
                }

                //Высота группы
                if (!empty($product_arenda_group_height_values)) {
                    $product_arenda_group_height = get_field_object('product_arenda_group_height', $post->ID);

                    echo '<div class="catalog__filter__item">';
                    echo '<div class="catalog__filter__item__title is-accordion">Высота группы</div>';
                    echo '<div class="catalog__filter__item__list" style="display:none">';

                    foreach ($product_arenda_group_height_values as $value) {
                        echo '<label class="filter-item">';
                        echo '<input type="checkbox" value="' . esc_attr($value) . '" class="filter-item__checkbox is-product_arenda_group_height">';
                        echo '<div class="filter-item__checkbox-decoration"></div>';
                        echo '<div class="filter-item__name">' . $product_arenda_group_height['choices'][ $value ] . '</div>';
                        echo '</label>';
                    }

                    echo '</div>';
                    echo '</div>';
                }

                //Функции
                if (!empty($product_arenda_func_values)) {
                    $product_arenda_func = get_field_object('product_arenda_func', $post->ID);

                    echo '<div class="catalog__filter__item">';
                    echo '<div class="catalog__filter__item__title is-accordion">Функции</div>';
                    echo '<div class="catalog__filter__item__list" style="display:none">';

                    foreach ($product_arenda_func_values as $value) {
                        $value_0 = $value[0];
                        echo '<label class="filter-item">';
                        echo '<input type="checkbox" value="' . $value[0] . '" class="filter-item__checkbox is-product_arenda_func">';
                        echo '<div class="filter-item__checkbox-decoration"></div>';
                        echo '<div class="filter-item__name">' . $product_arenda_func['choices'][ $value_0 ] . '</div>';
                        echo '</label>';
                    }

                    echo '</div>';
                    echo '</div>';
                }

                //Производительность чашек в час
                if (!empty($product_arenda_performance_values)) {
                    sort($product_arenda_performance_values, SORT_NUMERIC);// Сортировка значений по возрастанию
                    echo '<div class="catalog__filter__item">';
                    echo '<div class="catalog__filter__item__title is-accordion">Производительность</div>';
                    echo '<div class="catalog__filter__item__list" style="display:none">';

                    foreach ($product_arenda_performance_values as $value) {
                        echo '<label class="filter-item">';
                        echo '<input type="checkbox" value="' . esc_attr($value) . '" class="filter-item__checkbox is-product_arenda_performance">';
                        echo '<div class="filter-item__checkbox-decoration"></div>';
                        echo '<div class="filter-item__name">' . esc_html($value) . ' чашек/час</div>';
                        echo '</label>';
                    }

                    echo '</div>';
                    echo '</div>';
                }

                ?>

                    </div>
                </div>
            </div>

            <div class="catalog__list-wrap">
                <?php if(get_field('catalog-arenda_title')){?>
                <h2 class="catalog__list-wrap__title is-desktop"><?php the_field('catalog-arenda_title')?></h2>
                <?php } ?>
                <div class="catalog__list-wrap__current-filter">

                </div>
                <div class="catalog__list" data-type="<?php foreach ($term_arenda as $item){echo ''. $item . ',';};?>">
                    <?php

                    $loop = new WP_Query(array(
                        'posts_per_page' => 12,
                        'post_type' => 'product_arenda',
                        'post_status' => 'publish',
                        'paged' => get_query_var('paged') ?: 1,
                        'meta_query' => array(
                            array(
                                'key' => 'product_arenda_type',
                                'value' => $term_arenda,
                                'compare' => 'IN'
                            )
                        )
                    ));

                    $total_products = $loop->found_posts;

                    if ($loop->have_posts()) {
                        while ($loop->have_posts()) {
                            $loop->the_post();
                            get_template_part('/template-parts/loop-arenda-item');
                        }
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <?php if($total_products > 12){?>
                    <button id="load-more-arenda" class="see-more-product">Загрузить ещё</button>
                <?php } ?>
            </div>


        </div>
    </div>
</section>