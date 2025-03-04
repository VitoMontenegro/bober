<section class="section catalog__section">

    <div class="container">
        <?php if(get_field('catalog-filter_title')){?>
            <h2 class="section-title"><?php the_field('catalog-filter_title')?></h2>
        <?php } ?>

        <div class="catalog catalog-with-filter">

<!--            <div class="catalog__filter">-->
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
                            <label class="filter-item">
                                <input type="checkbox" name="inAccess" value="inAccess" class="filter-item__checkbox is-inAccess">
                                <div class="filter-item__checkbox-decoration"></div>
                                <div class="filter-item__name">В наличии</div>
                            </label>
                        </div>

                        <?php if(is_page('57491')){//страница - Оборудование?>
                        <!-- тип оборудования -->
                        <div class="catalog__filter__item catalog__filter__item__cat">
                            <div class="catalog__filter__item__cat__parent is-accordion">Тип оборудования</div>
                            <ul class="catalog__filter__item__cat__ul" style="display: none;">
                                <li><a href="/prodazha/kofeynoe-oborudovanie/" class="catalog__filter__item__cat__child">Кофейное оборудование</a></li>
                                <li><a href="/prodazha/teplovoe-oborudovanie/" class="catalog__filter__item__cat__child">Тепловое оборудование</a></li>
                                <li><a href="/prodazha/kholodilnoe-oborudovanie/" class="catalog__filter__item__cat__child">Холодильное оборудование</a></li>
                                <li><a href="/prodazha/barnoe-oborudovanie/" class="catalog__filter__item__cat__child">Барное оборудование</a></li>
                                <li><a href="/prodazha/fast-fud-oborudovanie/" class="catalog__filter__item__cat__child">Фаст-фуд оборудование</a></li>
                                <li><a href="/prodazha/neytralnoe-oborudovanie/" class="catalog__filter__item__cat__child">Нейтральное оборудование</a></li>
                                <li><a href="/prodazha/gastroemkosti-i-protivni/" class="catalog__filter__item__cat__child">Гастроемкости и противни</a></li>
                                <li><a href="/prodazha/vesovoe-oborudovanie/" class="catalog__filter__item__cat__child">Весовое оборудование</a></li>
                                <li><a href="/prodazha/zapchasti-i-komplektuyushchie/" class="catalog__filter__item__cat__child">Запчасти и комплектующие</a></li>
                                <li><a href="/prodazha/linii-razdachi-pitaniya/" class="catalog__filter__item__cat__child">Линии раздачи питания</a></li>
                                <li><a href="/prodazha/oborudovanie-dlya-vodopodgotovki/" class="catalog__filter__item__cat__child">Оборудование для водоподготовки</a></li>
                                <li><a href="/prodazha/posuda/" class="catalog__filter__item__cat__child">Посуда</a></li>
                                <li><a href="/prodazha/posudomoechnoe-oborudovanie/" class="catalog__filter__item__cat__child">Посудомоечное оборудование</a></li>
                                <li><a href="/prodazha/prachechnoe-oborudovanie/" class="catalog__filter__item__cat__child">Прачечное оборудование</a></li>
                                <li><a href="/prodazha/sanitarno-gigienicheskoe-oborudovanie/" class="catalog__filter__item__cat__child">Санитарно-гигиеническое оборудование</a></li>
                                <li><a href="/prodazha/torgovoe-oborudovanie/" class="catalog__filter__item__cat__child">Торговое оборудование</a></li>
                                <li><a href="/prodazha/upakovochnoe-oborudovanie/" class="catalog__filter__item__cat__child">Упаковочное оборудование</a></li>
                                <li><a href="/prodazha/elektromekhanicheskoe-oborudovanie/" class="catalog__filter__item__cat__child">Электромеханическое оборудование</a></li>
                            </ul>
                        </div>
                        <?php } ?>

                        <!-- Вывод всех Меток (Бренды) -->
                        <?php display_product_tags_filters(); ?>

                        <!-- вывод всех стран -->
                        <?php display_product_country_filters(); ?>

                        <!-- вывод всех атрибутов  -->
                        <?php if(!is_page('57491')){//не на странице - Оборудование?>

                        <div class="catalog__filter__item filter--product_attributes">
                            <?php
                            $attributes = wc_get_attribute_taxonomies();
                            foreach ($attributes as $attribute) {
                                $terms = get_terms(array('taxonomy' => 'pa_' . $attribute->attribute_name, 'hide_empty' => true));
                                if (!empty($terms)) {
                                    echo '<div class="attribute-group catalog__filter__item">';
                                    echo '<div class="attribute-title catalog__filter__item__title">' . $attribute->attribute_label . '</div>';
                                    echo '<div class="catalog__filter__item__list">';

                                    // Сортируем термины по их именам, сначала числа, затем текст
                                    usort($terms, function($a, $b) {
                                        $a_is_num = is_numeric($a->name);
                                        $b_is_num = is_numeric($b->name);

                                        if ($a_is_num && $b_is_num) {
                                            return intval($a->name) - intval($b->name);
                                        } elseif ($a_is_num) {
                                            return -1;
                                        } elseif ($b_is_num) {
                                            return 1;
                                        } else {
                                            return strcmp($a->name, $b->name);
                                        }
                                    });

                                    $count_attribute = 0;
                                    foreach ($terms as $term) {
                                        $count_attribute++;
//                                        if($count_attribute == 6){echo '<button class="filter-item filter-item__more"><i class="icon"><svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.351293 0.351294C0.819685 -0.117098 1.5791 -0.117098 2.04749 0.351293L10.6012 8.90498L10.6011 2.67455C10.6011 2.01215 11.1381 1.47515 11.8005 1.47514C12.4629 1.47513 12.9999 2.01211 12.9999 2.67452L13 11.8006C13 12.1187 12.8736 12.4238 12.6487 12.6487C12.4238 12.8736 12.1187 13 11.8006 13L2.80433 13C2.14192 13 1.60494 12.463 1.60494 11.8006C1.60494 11.1382 2.14192 10.6012 2.80433 10.6012L8.90502 10.6012L0.351294 2.04749C-0.117098 1.5791 -0.117098 0.819685 0.351293 0.351294Z" fill="#EB6025" /></svg></i><span class="filter-item__name">Развернуть</span></button>';};

                                        echo '<label class="filter-item">';
                                        echo '<input type="checkbox" name="attribute_pa_' . $attribute->attribute_name . '[]" value="' . $term->slug . '" class="filter-item__checkbox is-attribute">';
                                        echo '<div class="filter-item__checkbox-decoration"></div>';
                                        echo '<div class="filter-item__name">' . $term->name . '</div>';
                                        echo '</label>';
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>

                        <?php } ?>

                        <?php /*

                        <!-- filter 1 -->
                        <div class="catalog__filter__item filter__cat">
                            <div class="catalog__filter__item__title">
                                Кофейный аппарат
                            </div>
                            <div class="catalog__filter__item__list">

                                <?php $taxonomies = get_terms( array(
                                    'taxonomy' => 'product_type',
                                    'hide_empty' => false,
                                    'orderby'  => 'name',
                                    'order'    => 'DESC'
                                ) );

                                if ( !empty($taxonomies) ) :
                                    $output = '';
                                    foreach( $taxonomies as $category ) {
                                        if( $category->parent == 0 ) {
                                            $output.= '
                                    <label class="filter-item">
                                        <input type="checkbox" name="'. $category->slug.'" id="tax_'.$category->slug.'" class="filter-item__checkbox">
                                        <div class="filter-item__checkbox-decoration"></div>
                                        <div class="filter-item__name">'.$category->name.'</div>
                                    </label>';
                                            foreach( $taxonomies as $subcategory ) {
                                                if($subcategory->parent == $category->term_id) {
                                                $output.= '
                                    <label class="filter-item filter-item__child">
                                        <input type="checkbox" name="'. $subcategory->slug.'" id="tax_'.$subcategory->slug.'" class="filter-item__checkbox">
                                        <div class="filter-item__checkbox-decoration"></div>
                                        <div class="filter-item__name">'.$subcategory->name.'</div>
                                    </label>';
                                                }
                                            }
                                        }
                                    }
                                    echo $output;
                                endif;
                                ?>

                            </div>
                        </div>


                        <!-- filter 2 -->
                        <div class="catalog__filter__item ">
                            <div class="catalog__filter__item__title">
                                Марка
                            </div>
                            <div class="catalog__filter__item__list">
                                <label class="filter-item">
                                    <input type="checkbox" name="Fiorenzato" id="mark_Fiorenzato" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">Fiorenzato</div>
                                </label>
                                <label class="filter-item">
                                    <input type="checkbox" name="Saeco" id="mark_Saeco" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">Saeco</div>
                                </label>
                                <label class="filter-item">
                                    <input type="checkbox" name="Franke" id="mark_Franke" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">Franke</div>
                                </label>
                                <label class="filter-item">
                                    <input type="checkbox" name="LaCarimali" id="mark_LaCarimali" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">LaCarimali</div>
                                </label>
                                <label class="filter-item">
                                    <input type="checkbox" name="Ottima" id="mark_Ottima" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">Ottima</div>
                                </label>

                                <button class="filter-item filter-item__more">
                                    <i class="icon">
                                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.351293 0.351294C0.819685 -0.117098 1.5791 -0.117098 2.04749 0.351293L10.6012 8.90498L10.6011 2.67455C10.6011 2.01215 11.1381 1.47515 11.8005 1.47514C12.4629 1.47513 12.9999 2.01211 12.9999 2.67452L13 11.8006C13 12.1187 12.8736 12.4238 12.6487 12.6487C12.4238 12.8736 12.1187 13 11.8006 13L2.80433 13C2.14192 13 1.60494 12.463 1.60494 11.8006C1.60494 11.1382 2.14192 10.6012 2.80433 10.6012L8.90502 10.6012L0.351294 2.04749C-0.117098 1.5791 -0.117098 0.819685 0.351293 0.351294Z" fill="#EB6025" />
                                        </svg>
                                    </i>
                                    <span class="filter-item__name">Развернуть</span>
                                </button>

                                <label class="filter-item">
                                    <input type="checkbox" name="Sanremo" id="mark_Sanremo" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">Sanremo</div>
                                </label>
                            </div>
                        </div>

                        <!-- filter 3 -->
                        <div class="catalog__filter__item filter--product_rozok">
                            <div class="catalog__filter__item__title">
                                Количество групп
                            </div>
                            <div class="catalog__filter__item__list">
                                <label class="filter-item">
                                    <input type="checkbox" name="rozok1" id="rozok1" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">1 группа</div>
                                </label>
                                <label class="filter-item">
                                    <input type="checkbox" name="rozok2" id="rozok2" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">2 группы</div>
                                </label>
                                <label class="filter-item">
                                    <input type="checkbox" name="rozok3" id="rozok3" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">3 группы</div>
                                </label>
                            </div>
                        </div>

                        <!-- filter -->
                        <div class="catalog__filter__item filter--product_group">
                            <div class="catalog__filter__item__title">
                                Высота группы
                            </div>
                            <div class="catalog__filter__item__list">
                                <label class="filter-item">
                                    <input type="checkbox" name="high_group" id="high_group" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">Высокая</div>
                                </label>
                                <label class="filter-item">
                                    <input type="checkbox" name="low_group" id="low_group" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">Низкая</div>
                                </label>
                            </div>
                        </div>

                        <!-- filter 4 -->
                        <div class="catalog__filter__item filter--filter_func">
                            <div class="catalog__filter__item__title">
                                Функции
                            </div>
                            <div class="catalog__filter__item__list mobile-column">
                                <label class="filter-item">
                                    <input type="checkbox" name="chocolate" id="chocolate" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">С приготовлением шоколада</div>
                                </label>
                            </div>
                        </div>


                        <!-- filter 5 -->
                        <div class="catalog__filter__item filter--filter_performance">
                            <div class="catalog__filter__item__title">
                                Производительность
                            </div>
                            <div class="catalog__filter__item__list">
                                <label class="filter-item">
                                    <input type="checkbox" name="product_performance-100" id="product_performance-100" data-performance="100" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">100 чашек/час</div>
                                </label>
                                <label class="filter-item">
                                    <input type="checkbox" name="product_performance-200" id="product_performance-200" data-performance="200" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">200 чашек/час</div>
                                </label>
                                <label class="filter-item">
                                    <input type="checkbox" name="product_performance-300" id="product_performance-300" data-performance="300" class="filter-item__checkbox">
                                    <div class="filter-item__checkbox-decoration"></div>
                                    <div class="filter-item__name">300 чашек/час</div>
                                </label>
                            </div>
                        </div>


                        */ ?>


                    </div>
                </div>
            </div>

            <div class="catalog__list-wrap">
            <div class="catalog__list-wrap__current-filter">

            </div>
                <?php
                //определённые товары
                $catalog_filter_only_api = get_field('catalog-filter_only-api');
                $meta_query = array();
                if ($catalog_filter_only_api == 'site') {
                    $meta_query = array(
                        array(
                            'key' => 'api_product',
                            'value' => '1',
                            'compare' => '!=',
                        ),
                    );
                } elseif ($catalog_filter_only_api == 'api') {
                    $meta_query = array(
                        array(
                            'key' => 'api_product',
                            'value' => '1',
                            'compare' => '=',
                        ),
                    );
                } else {}
                ?>

                <div class="catalog__list"<?php if(get_field('catalog-filter_only-api')){?> data-productApi="<?php the_field('catalog-filter_only-api');?>"<?php } ?>>

                    <?php
                    $loop = new WP_Query(array(
                        'posts_per_page' => 12,
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'paged' => get_query_var('paged') ?: 1,
//                        'tax_query' => array(
//                            array(
//                                'taxonomy' => 'product_cat',
//                                'field' => 'slug',
//                                'terms' => $term->slug,
//                            ),
//                        ),
                        'meta_query' => $meta_query,

                        'meta_key' => 'product_sort',
                        'orderby' => array(
                            'meta_value_num' => 'DESC',
                            'date' => 'DESC'  // Добавляем вторичную сортировку по дате
                        ),
                    ));

                    $total_products = $loop->found_posts;

                    if ($loop->have_posts()) {
                        while ($loop->have_posts()) {
                            $loop->the_post();
                            get_template_part('/template-parts/loop-product-item');
                        }
                    }

                    wp_reset_postdata();
                    ?>
                </div>
                <?php if($total_products > 12){?>
                <button id="load-more" class="see-more-product">Загрузить ещё</button>
                <?php } ?>
            </div>


        </div>


    </div>
</section>