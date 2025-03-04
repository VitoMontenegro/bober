<?php
/*
 Template Name: brands
 */
?>
<?php get_header(); ?>

<main>

    <?php the_content();?>

    <section class="section brands__section">
        <div class="container">
            <h1 class="section-title">Бренды</h1>

            <div class="content">
                <div class="brands__list">
                <?php

                    // Получаем все метки товаров в алфавитном порядке
                    $terms = get_terms( array(
                        'taxonomy' => 'product_tag',
                        'orderby' => 'name',
                        'order' => 'ASC',
                    ) );
                    ?>
                    <div class="brands-alphabet">

                        <?php

                        // Задаем порядок букв
                        $order = array('1','2','3','4','5','6','7','8','9','0','А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

                        // Функция для получения индекса первой буквы в заданном порядке
                        function get_order_index($term, $order) {
                            $first_letter = mb_substr($term->name, 0, 1, 'UTF-8');
                            $index = array_search($first_letter, $order);
                            return $index !== false ? $index : count($order);
                        }

                        // Сортируем метки по первой букве в заданном порядке
                        usort($terms, function($a, $b) use ($order) {
                            $index_a = get_order_index($a, $order);
                            $index_b = get_order_index($b, $order);
                            return $index_a - $index_b;
                        });

                        // Группируем метки по первой букве
                        $grouped_terms = array();
                        foreach ($terms as $term) {
                            $first_letter = mb_substr($term->name, 0, 1, 'UTF-8');
                            if (!isset($grouped_terms[$first_letter])) {
                                $grouped_terms[$first_letter] = array();
                            }
                            $grouped_terms[$first_letter][] = $term;
                        }

                        // Выводим метки с заголовками для каждой буквы

                        foreach ($order as $letter) {
                            if (isset($grouped_terms[$letter])) {
                                echo '<div class="brands-alphabet__item">';
                                    echo '<div class="brands-alphabet__item__title"><strong>' . $letter . '</strong></div>';
                                    echo '<div class="brands-alphabet__item__list">';
                                    foreach ($grouped_terms[$letter] as $term) {
                                        echo '<a href="' . get_term_link($term) . '">' . $term->name . '</a>';
                                    }
                                    echo '</div>';
                                echo '</div class=brands-alphabet__item>';
                            }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

  <?php the_content();?>

</main>

<?php get_footer(); ?>
