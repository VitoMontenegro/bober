<?php
/**
 * product_cat (taxonomy-product_cat-prodazha.php)
 * @package WordPress
 */
get_header(); ?>
<main>
        <?php
        // Получаем объект поста с ID
        $page = get_post(533);

        // Проверяем, есть ли содержимое у поста
        if ($page) {
            // Извлекаем содержимое блоков
            $blocks = parse_blocks($page->post_content);

            // Перебираем блоки и выводим их содержимое
            foreach ($blocks as $block) {
                echo render_block($block);
            }
        }
        ?>

        <?php


        function add_edit_page_link_to_admin_bar($wp_admin_bar) {
            // Получаем объект текущей страницы
            $current_page = get_queried_object();

            // Добавляем пункт "Редактировать контент" в верхнюю панель администратора
            $wp_admin_bar->add_menu(array(
                'id'    => 'edit-page',
                'title' => 'Редактировать контент',
                'href'  => get_edit_post_link(533),
                'meta'  => array(
                    'class' => 'edit-page-link',
                ),
            ));
        }
        add_action('admin_bar_menu', 'add_edit_page_link_to_admin_bar', 999);

        ?>
</main>
<?php
get_footer();