<?php
/**
 * product_cat (taxonomy-product_cat-kofeynoe-oborudovanie.php)
 * @package WordPress
 */

?>
<?php get_header();?>

    <main>
                <?php
                // Получаем объект поста с ID
                $page = get_post(8561);

                // Проверяем, есть ли содержимое у поста
                if ($page) {
                    // Извлекаем содержимое блоков
                    $blocks = parse_blocks($page->post_content);

                    // Перебираем блоки и выводим их содержимое
                    foreach ($blocks as $block) {
                        // Проверяем, является ли текущий блок блоком "Каталог с Фильтром"
                        if ($block['blockName'] === 'acf/catalog-with-filter') {

                            //Выводим Каталог
                            get_template_part('/template-parts/catalog-prodazha');

                        } else {

                            // Выводим содержимое других блоков
                            echo render_block($block);
                        }
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
                        'href'  => get_edit_post_link(8561),
                        'meta'  => array(
                            'class' => 'edit-page-link',
                        ),
                    ));
                }
                add_action('admin_bar_menu', 'add_edit_page_link_to_admin_bar', 999);
                ?>

    </main>

<?php get_footer(); ?>