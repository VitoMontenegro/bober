<section class="section api-cat-list__section">
    <div class="container">

        <?php if(get_field('api-prodazha-cat')){?>
        <h1 class="main-title"><?php the_field('api-prodazha-cat');?></h1>
        <?php } ?>
        <div class="api-cat-list">
            <?php

            // Вызов функции в шаблоне с пользовательским порядком
            //Продукция, Кофейное оборудование, его потомки 3лвл                 //id - категорий 2 лвл
            $custom_order = array(4366,182,186,185,187,184,188,183,         22,51,124,135,160,189);
            display_product_categories_with_count(17, 0, $custom_order);//prodazha

            //prodazha
            function display_product_categories_with_count($parent_id = 0, $level = 0, $custom_order = array()) {
                // Получаем категории товаров
                $args = array(
                    'taxonomy'     => 'product_cat',
                    'parent'       => $parent_id,
                    'hide_empty'   => false,
                );

                $product_categories = get_terms($args);

                if (!empty($product_categories) && !is_wp_error($product_categories)) {
                    // Преобразуем массив категорий в ассоциативный массив с ID в качестве ключей
                    $categories_by_id = array();
                    foreach ($product_categories as $category) {
                        $categories_by_id[$category->term_id] = $category;
                    }

                    // Сортируем категории по пользовательскому порядку
                    $sorted_categories = array();
                    foreach ($custom_order as $cat_id) {
                        if (isset($categories_by_id[$cat_id])) {
                            $sorted_categories[] = $categories_by_id[$cat_id];
                            unset($categories_by_id[$cat_id]); // Удаляем из общего списка, чтобы не дублировать
                        }
                    }

                    // Добавляем оставшиеся категории
                    $remaining_categories = array_values($categories_by_id);
                    $sorted_categories = array_merge($sorted_categories, $remaining_categories);

                    echo '<ul class="api-cat-list__item api-cat-list__item--lvl-'.$level.'">';
                    foreach ($sorted_categories as $key => $category) {
                        // Получаем ссылку на категорию
                        $category_link = get_term_link($category);

                        if($key == 6 && $level == 1){
                            $cat_count = count($sorted_categories) - 6;
                            //Склонение
                            $number = abs($cat_count) % 100;
                            $lastDigit = $number % 10;
                            $text_cat_count = "Категорий";
                            if ($number > 10 && $number < 20) {
                                $text_cat_count = "Категорий";
                            } elseif ($lastDigit > 1 && $lastDigit < 5) {
                                $text_cat_count = "Категории";
                            } elseif ($lastDigit == 1) {
                                $text_cat_count = "Категория";
                            }
                            echo '<button class="api-cat-list__item__more">Ещё '.$cat_count.' ' . $text_cat_count . '</button>';
                        }

                        // Выводим название категории с ссылкой и количество товаров в ней


                        $category_name_wbr = $category->name;
                        $category_name_wbr = str_replace('.', '.<wbr>', $category_name_wbr);

                        echo '<li>';
                        if($category->count !== 0) {
                            echo '<a href="' . esc_url($category_link) . '">' . $category_name_wbr . '</a> <span class="count">(' . $category->count . ')</span>';
                        }
                        // Рекурсивно вызываем функцию для подкатегорий
                        display_product_categories_with_count($category->term_id, $level + 1, $custom_order);

                        echo '</li>';
                    }
                    if($key >= 6 && $level == 1){
                        echo '<button class="api-cat-list__item__more__close">Скрыть</button>';
                    }
                    echo '</ul>';
                }
            }

        ?>
        </div>

    </div>
</section>
