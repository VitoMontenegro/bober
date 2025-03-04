<?php
/*
 Template Name: search.php
 */
?>
<?php //get_header(); ?>
<!--    <main>-->
<!--        <section class="section search__section">-->
<!--            <div class="container">-->
<!--                <h1>Результаты поиска по: <span>--><?php //echo get_search_query(); ?><!--</span></h1>-->
<!--                <form action="/" method="get" id="search-page-form" class="search-page__form">-->
<!--                    <input type="text" id="search-page-input" class="search-page__form__input" name="s" placeholder="Поиск" value="--><?php //echo get_search_query(); ?><!--" autocomplete="off">-->
<!--                </form>-->
<!--                <div id="search-page-result-inner" class="catalog__list">-->
<!--                    --><?php //if (get_search_query()) : ?>
<!--                        --><?php //if (have_posts()) : ?>
<!--                                --><?php //while (have_posts()) : the_post(); ?>
<!--                                --><?php //endwhile; ?>
<!--                        --><?php //else : ?>
<!--                            <p>Ничего не найдено.</p>-->
<!--                        --><?php //endif; ?>
<!--                    --><?php //endif; ?>
<!--                </div>-->
<!--            </div>-->
<!--        </section>-->
<!--    </main>-->
<?php //get_footer(); ?>
<!---->
<!---->

<?php get_header(); ?>
<main>
    <section class="section search__section">
        <div class="container">
            <h1>Результаты поиска по: <span><?php echo get_search_query(); ?></span></h1>
            <form action="/" method="get" id="search-page-form" class="search-page__form">
                <label class="search-page__form__label" for="search-page-input">Поиск</label>
                <input type="text" id="search-page-input" class="search-page__form__input" name="s" placeholder="Поиск" value="<?php echo get_search_query(); ?>" autocomplete="off">
            </form>
            <div class="search__page__result">
                <div class="search__page__result__spinner"></div>
                <div id="search-page-result-inner" class="product-flex catalog__list">
                    <?php if (get_search_query()) : ?>
                        <?php
                        // Получаем поисковый запрос
                        $search_query = get_search_query();
                        //и приводим его к нижнему регистру
                        $search_query_lower = mb_strtolower($search_query);

                        // для поиска только в заголовках
                        //add_filter('posts_where', 'title_filter', 10, 2);

                        // Флаг для проверки наличия слова "аренда" и его вариаций в поисковом запросе
                        $is_arenda_search = stripos($search_query_lower, 'аренда') !== false ||
                            stripos($search_query_lower, 'аренд') !== false ||
                            stripos($search_query_lower, 'арен') !== false ||
                            stripos($search_query_lower, 'rent') !== false;

                        // Запрос для постов типа 'product_arenda'
                        if ($is_arenda_search) {
                            $args_arenda = array(
                                'post_type' => 'product_arenda',
                                'posts_per_page' => 400,
                            );
                        } else {
                            $args_arenda = array(
                                'post_type' => 'product_arenda',
                                's' => $search_query,
                                'posts_per_page' => 400,
                            );
                        }
                            $query_arenda = new WP_Query($args_arenda);
							
                            if ($query_arenda->have_posts()) : ?>
                                <h2 class="catalog__list__title">Аренда</h2>
                                <?php foreach ($query_arenda->posts as $post) : setup_postdata($post); ?>
                                    <?php get_template_part('/template-parts/loop-arenda-item'); ?>
                                <?php endforeach; wp_reset_postdata(); ?>
                                <?php if (!$is_arenda_search) {?>
                                    <h2 class="catalog__list__title">Продажа</h2>
                                <?php } ?>
                            <?php endif;


                        // Запрос для постов типа 'product'
                        $args_product = array(
                            'post_type' => 'product',
                            's' => $search_query,
                            'posts_per_page' => 400,
                        );
                        $query_product = new WP_Query($args_product);


                        //Бумажный стакан
                        if (strpos('бумажный стаканы', $search_query_lower) !== false ) {
                            $args_add = array(
                                'post_type' => 'product',
                                's' => 'Стакан бумажный',
                            );
                            $query_add = new WP_Query($args_add);
                            //Объединяем с Бумажный стакан с Продажа
                            $query_product->posts = array_merge($query_product->posts, $query_add->posts);
                            $query_product->post_count = count($query_product->posts);
                        }




                        ?>
                        <?php if ($query_product->have_posts()) : ?>
                            <?php foreach ($query_product->posts as $post) : setup_postdata($post); ?>
                                <?php get_template_part('/template-parts/loop-product-item'); ?>
                            <?php endforeach; wp_reset_postdata(); ?>
                        <?php endif; ?>


                        <?php

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
                            echo '<a href="/price/" class="search__page__result__list-page__item">Прайс</a>';
                            $is_page_search = true;
                        }
                        if (strpos('контакт', $search_query_lower) !== false ) {
                            echo '<a href="' . get_permalink(425) . '" class="search__page__result__list-page__item">Контакты</a>';
                            $is_page_search = true;
                        }
                        if (strpos('кофейное оборудование', $search_query_lower) !== false ) {
                            echo '<a href="/prodazha/kofeynoe-oborudovanie/" class="search__page__result__list-page__item">Кофейное оборудование</a>';
                            $is_page_search = true;
                        }
                        echo '</div>';
                        ?>


                        <?php if(!$is_page_search && !$is_arenda_search && !$query_product->have_posts()){?>
                        <p>По запросу "<?php echo get_search_query(); ?>" ничего не найдено. Попробуйте ввести другой запрос</p>
                        <?php } ?>





                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
