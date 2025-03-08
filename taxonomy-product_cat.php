<?php
/*
 Template Name: taxonomy-product_cat
 */


$term = get_queried_object();
$term_id = $term->term_id; // Получаем заголовок метки
$term_title = $term->name; // Получаем заголовок метки
$term_slug = $term->slug;
$product_cat_parent = get_term_by( 'id', $term->parent, 'product_cat' );

if($product_cat_parent && $product_cat_parent->slug == 'prodazha'){
    $product_cat_parent = '';
}
?>
<?php get_header();?>

    <main>

        <section class="section catalog__section margin-top-0">

            <div class="container">

                <ul class="breadcrumbs">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/prodazha/">Продажа</a></li>
                    <?php if($product_cat_parent){?>
                    <li>
                        <a href="<?php echo get_category_link($product_cat_parent->term_id);?>">
                            <?php
                            $product_cat_parent_name = $product_cat_parent->name;
                            $product_cat_parent_name = str_replace('.', '.<wbr>', $product_cat_parent_name);
                            echo $product_cat_parent_name;
                            ?>
                        </a>
                    </li>
                    <?php } ?>
                    <li>
                        <?php
                        $term_title_wbr = $term_title;
                        $term_title_wbr = str_replace('.', '.<wbr>', $term_title_wbr);
                        echo $term_title_wbr;
                        ?>
                    </li>
                </ul>

                <br class="is-desktop">

                <div class="catalog__list-wrap__title is-mobile">
                    <?php $single_cat_title_wbr = single_cat_title('', 0);
                    $single_cat_title_wbr = str_replace('.', '.<wbr>', $single_cat_title_wbr);
                    echo $single_cat_title_wbr;
                    ?>
                </div>

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

                                <?php
                                /*
                                // Продукция - Чай
                                $current_category = get_queried_object();
                                if($current_category->parent == 4371 || $current_category->term_id == 4371){ //Чай ?>
                                    <div class="catalog__filter__item is-open">
                                        <div class="catalog__filter__item__title is-accordion">Виды чая</div>
                                        <div class="catalog__filter__item__list">
                                            <label class="filter-item"><input type="checkbox" name="black" value="black" class="filter-item__checkbox is-production_tea_color">
                                                <div class="filter-item__checkbox-decoration"></div>
                                                <div class="filter-item__name">Чёрный</div>
                                            </label>
                                            <label class="filter-item"><input type="checkbox" name="green" value="green" class="filter-item__checkbox is-production_tea_color">
                                                <div class="filter-item__checkbox-decoration"></div>
                                                <div class="filter-item__name">Зелёный</div>
                                            </label>
                                            <label class="filter-item"><input type="checkbox" name="fruit" value="fruit" class="filter-item__checkbox is-production_tea_color">
                                                <div class="filter-item__checkbox-decoration"></div>
                                                <div class="filter-item__name">Фруктовый</div>
                                            </label>
                                        </div>
                                    </div>
                                <?php } */ ?>

                                <?php
                                function is_category_descendant_of($cat_id, $ancestor_id) {
                                    $term = get_term($cat_id, 'product_cat');
                                    if ($term->parent == $ancestor_id) {
                                        return true;
                                    } elseif ($term->term_id == $ancestor_id) {
                                        return true;
                                    } elseif ($term->parent == 0) {
                                        return false;
                                    } else {
                                        return is_category_descendant_of($term->parent, $ancestor_id);
                                    }
                                }

                                ?>





                                <div class="catalog__filter__item catalog__filter__item__cat<?php if(is_category_or_subcategory(4366)){echo ' is-open';}?>">
                                <?php
                                // Получаем текущую категорию
                                $current_category = get_queried_object();

                                // Проверяем, является ли текущая категория категорией продуктов
                                if ( $current_category && $current_category->taxonomy === 'product_cat' ) {
                                    // Получаем родительскую категорию
                                    $parent_category = get_term_by( 'id', $current_category->parent, 'product_cat' );

                                    // Если текущая категория является родительской, используем ее
                                    if ( ! $parent_category ) {
                                        $parent_category = $current_category;
                                    }

                                    if($current_category->parent == 17){//prodazha
                                        $parent_category = $current_category;
                                    }


                                    // Определяем активный класс для текущей подкатегории
                                    $active_parent_class = is_product_category( $parent_category->slug ) ? ' class="catalog__filter__item__cat__parent is-accordion active"' : ' class="catalog__filter__item__cat__parent is-accordion"';

                                    // Выводим название родительской категории
                                    echo '<div '.$active_parent_class.'>' . $parent_category->name . '</div>';

                                    // Получаем подкатегории для текущей родительской категории
                                    $child_categories = get_terms( 'product_cat', array(
                                        'parent' => $parent_category->term_id,
                                        'hide_empty' => true,
                                    ) );

                                    // Проверяем, есть ли подкатегории
                                    if ( ! empty( $child_categories ) ) {
                                        if(is_category_or_subcategory(4366)) {
                                            echo '<ul class="catalog__filter__item__cat__ul">';
                                        } else {
                                            echo '<ul class="catalog__filter__item__cat__ul" style="display:none">';
                                        }

                                        // Проходим по каждой подкатегории
                                        foreach ( $child_categories as $key => $child_category ) {
                                            if($key > 9){break;}// Выведем несколько штук
                                            // Получаем ссылку на подкатегорию
                                            $category_link = get_term_link( $child_category );
                                            // Получаем количество продуктов в подкатегории
                                            $product_count = $child_category->count;

                                            // Определяем активный класс для текущей подкатегории
                                            $active_class = is_product_category( $child_category->slug ) ? ' class="catalog__filter__item__cat__child active"' : ' class="catalog__filter__item__cat__child"';

                                            // Выводим ссылку на подкатегорию wbrdiv
                                            $child_category_name_wbr = $child_category->name;
                                            $child_category_name_wbr = str_replace('.', '.<wbr>', $child_category_name_wbr);
                                            echo '<li><a href="' . esc_url( $category_link ) . '"' . $active_class . '>' . $child_category_name_wbr . ' (' . $product_count . ')</a></li>';
                                        }

                                        echo '</ul>';
                                    }
                                }
                                ?>
                                </div>

                                    <?php
                                            $production_degree_roasting = array();//production_degree_roasting
                                            $production_country = array();//production_country
                                            $production_weight = array();//production_weight
                                            $production_tea_weight = array();//production_tea_weight
                                            $production_tea_bagged = array();//production_tea_bagged
                                            $production_tea_color = array();//production_tea_color

                                            $product_countries = array();//страны
                                            $product_tags = array(); // Метки
                                            $min_price = PHP_INT_MAX; // Инициализация минимальной цены
                                            $max_price = PHP_INT_MIN; // Инициализация максимальной цены

                                            // Сначала получаем все товары из текущего запроса
                                            $loop_filter = new WP_Query(array(
                                                'posts_per_page' => 555,
                                                'post_type' => 'product',
                                                'post_status' => 'publish',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'product_cat',
                                                        'field' => 'slug',
                                                        'terms' => $term_slug,
                                                    ),
                                                ),
                                            ));


                                            // Собираем все используемые атрибуты и их значения
                                            $used_attributes = array();
                                            if ($loop_filter->have_posts()) {
                                                while ($loop_filter->have_posts()) {
                                                    $loop_filter->the_post();
                                                    global $product;


//                                                    //Товары из Продукция
//                                                    //Степень обжарки
//                                                    $production_degree_roasting_item = get_field('production_degree_roasting');
//                                                    foreach ($production_degree_roasting_item as $item) {
//                                                        $production_degree_roasting[] = $item;
//                                                    }
//                                                    //Страна выращивания
//                                                    $production_country_item = get_field('production_country');
//                                                    foreach ($production_country_item as $item) {
//                                                        $production_country[] = $item;
//                                                    }
//                                                    //Вес
//                                                    $production_weight_item = get_field('production_weight');
//                                                    if ($production_weight_item) {
//                                                        $production_weight[] = $production_weight_item;
//                                                    }
//                                                    //
//                                                    // Чай
                                                    $production_tea_color_item = get_field('production_tea_color');
                                                    foreach ($production_tea_color_item as $item) {
                                                        $production_tea_color[] = $item;
                                                    }
                                                    $production_tea_weight_item = get_field('production_tea_weight');
                                                    foreach ($production_tea_weight_item as $item) {
                                                        $production_tea_weight[] = $item;
                                                    }
//                                                    //
                                                    $production_tea_bagged_item = get_field('production_tea_bagged');
                                                    if(isset($production_tea_bagged_item) && is_array($production_tea_bagged_item)) {
                                                        foreach ($production_tea_bagged_item as $item) {
                                                            $production_tea_bagged[] = $item;
                                                        }
                                                    }

                                                    //Товары по API
                                                    //Атрибуты
                                                    $attributes = $product->get_attributes();
                                                    foreach ($attributes as $attribute) {
                                                        if ($attribute->is_taxonomy()) {
                                                            $taxonomy = $attribute->get_name();
                                                            $terms = wp_get_post_terms($product->get_id(), $taxonomy);
                                                            foreach ($terms as $term) {
                                                                if (!isset($used_attributes[$taxonomy])) {
                                                                    $used_attributes[$taxonomy] = array();
                                                                }
                                                                $used_attributes[$taxonomy][$term->slug] = $term->name;
                                                            }
                                                        }
                                                    }

                                                    //Страны
                                                    $country = get_field('product_country');
                                                    if ($country) {
                                                        $product_countries[] = $country;
                                                    }

                                                    // Метки
                                                    $tags = wp_get_post_terms($product->get_id(), 'product_tag');
                                                    foreach ($tags as $tag) {
                                                        $product_tags[$tag->slug] = $tag->name;
                                                    }

                                                    // Цены
//                                            $price = $product->get_price();
//                                            if ($price < $min_price) {
//                                                $min_price = $price;
//                                            }
//                                            if ($price > $max_price) {
//                                                $max_price = $price;
//                                            }
                                                }
                                                wp_reset_postdata();
                                            }

                                            //Товары из Продукция
                                            //Степень обжарки
                                            if (!empty($production_degree_roasting)) {

                                                $production_degree_roasting = array_unique($production_degree_roasting);// Удаляем дубликаты
                                                echo '<div class="catalog__filter__item">';
                                                echo '<div class="catalog__filter__item__title is-accordion">Степень обжарки</div>';
                                                echo '<div class="catalog__filter__item__list" style="display:none">';
                                                foreach ($production_degree_roasting as $key => $item) {
                                                    $item_name = $item;
                                                    if($item == 'espresso'){
                                                        $item_name = 'Под эспрессо';
                                                    } elseif($item == 'alternatively') {
                                                        $item_name = 'Под альтернативу';
                                                    }
                                                    $item_slug = sanitize_title($item);
                                                    echo '<label class="filter-item">';
                                                    echo '<input type="checkbox" name="' . esc_attr($item) . '" value="' . esc_attr($item) . '" id="id_' . esc_attr($item_slug) . '" class="filter-item__checkbox is-production_degree_roasting">';
                                                    echo '<div class="filter-item__checkbox-decoration"></div>';
                                                    echo '<div class="filter-item__name">' . esc_html($item_name) . '</div>';
                                                    echo '</label>';
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                            }

                                            //Продукция: Страна выращивания
                                            if (!empty($production_country)) {

                                                $production_country = array_unique($production_country);// Удаляем дубликаты
                                                echo '<div class="catalog__filter__item">';
                                                echo '<div class="catalog__filter__item__title is-accordion">Страна выращивания</div>';
                                                echo '<div class="catalog__filter__item__list" style="display:none">';
                                                foreach ($production_country as $key => $item) {
                                                    $item_name = $item;
                                                    if($item == 'brazil'){
                                                        $item_name = 'Бразилия';
                                                    } elseif($item == 'peru') {
                                                        $item_name = 'Перу';
                                                    } elseif($item == 'colombia') {
                                                        $item_name = 'Колумбия';
                                                    }
                                                    $item_slug = sanitize_title($item);
                                                    echo '<label class="filter-item">';
                                                    echo '<input type="checkbox" name="' . esc_attr($item) . '" value="' . esc_attr($item) . '" id="id_' . esc_attr($item_slug) . '" class="filter-item__checkbox is-production_country">';
                                                    echo '<div class="filter-item__checkbox-decoration"></div>';
                                                    echo '<div class="filter-item__name">' . esc_html($item_name) . '</div>';
                                                    echo '</label>';
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                            }

                                    //Продукция: Вес
                                    $production_weight = array_unique($production_weight);
                                    asort($production_weight);
                                    if (!empty($production_weight)) {
                                        echo '<div class="catalog__filter__item">';
                                        echo '<div class="catalog__filter__item__title is-accordion">Вес</div>';
                                        echo '<div class="catalog__filter__item__list" style="display:none">';
                                        foreach ($production_weight as $key => $item) {
//                                                    if ($key == 5) {
//                                                        echo '<button class="filter-item filter-item__more"><i class="icon"><svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.351293 0.351294C0.819685 -0.117098 1.5791 -0.117098 2.04749 0.351293L10.6012 8.90498L10.6011 2.67455C10.6011 2.01215 11.1381 1.47515 11.8005 1.47514C12.4629 1.47513 12.9999 2.01211 12.9999 2.67452L13 11.8006C13 12.1187 12.8736 12.4238 12.6487 12.6487C12.4238 12.8736 12.1187 13 11.8006 13L2.80433 13C2.14192 13 1.60494 12.463 1.60494 11.8006C1.60494 11.1382 2.14192 10.6012 2.80433 10.6012L8.90502 10.6012L0.351294 2.04749C-0.117098 1.5791 -0.117098 0.819685 0.351293 0.351294Z" fill="#EB6025" /></svg></i><span class="filter-item__name">Развернуть</span></button>';
//                                                    };
                                            $item_slug = sanitize_title($item);
                                            echo '<label class="filter-item">';
                                            echo '<input type="checkbox" name="' . esc_attr($item) . '" value="' . esc_attr($item) . '" id="id_' . esc_attr($item_slug) . '" class="filter-item__checkbox is-production_weight">';
                                            echo '<div class="filter-item__checkbox-decoration"></div>';
                                            echo '<div class="filter-item__name">' . esc_html($item) . '</div>';
                                            echo '</label>';
                                        }
                                        echo '</div>';
                                        echo '</div>';
                                    }



                                    //Продукция: Чай
                                    if (!empty($production_tea_color)) {

                                        $production_tea_color = array_unique($production_tea_color);// Удаляем дубликаты

                                        // Все возможные варианты и их переводы
                                        $tea_types = [
                                            'black' => 'Чёрный',
                                            'black-based' => 'На основе черного',
                                            'green' => 'Зелёный',
                                            'green-based' => 'На основе зеленого',
                                            'milk-oolong' => 'Молочный улун',
                                            'puerh' => 'Пуэр',
                                            'herbal' => 'Травяной',
                                            'fruit' => 'Фруктовый'
                                        ];

                                        echo '<div class="catalog__filter__item is-open">';
                                        echo '<div class="catalog__filter__item__title is-accordion">Виды чая</div>';
                                        echo '<div class="catalog__filter__item__list">';
                                        // Выводим только те варианты, которые есть в $production_tea_color
                                        foreach ($tea_types as $key => $name) {
                                            if (in_array($key, $production_tea_color)) {
                                                $item_slug = sanitize_title($key);
                                                echo '<label class="filter-item">';
                                                echo '<input type="checkbox" name="' . esc_attr($key) . '" value="' . esc_attr($key) . '" id="id_' . esc_attr($item_slug) . '" class="filter-item__checkbox is-production_tea_color">';
                                                echo '<div class="filter-item__checkbox-decoration"></div>';
                                                echo '<div class="filter-item__name">' . esc_html($name) . '</div>';
                                                echo '</label>';
                                            }
                                        }
                                        echo '</div>';
                                        echo '</div>';
                                    }


                                    //Продукция: Весовой
                                            if (!empty($production_tea_weight)) {

                                                $production_tea_weight = array_unique($production_tea_weight);// Удаляем дубликаты
                                                echo '<div class="catalog__filter__item is-open">';
                                                echo '<div class="catalog__filter__item__title is-accordion">Тип чая</div>';
                                                echo '<div class="catalog__filter__item__list">';
                                                foreach ($production_tea_weight as $key => $item) {
                                                    $item_name = $item;
                                                    if($item == 'bagged'){
                                                        $item_name = 'Пакетированный';
                                                    } elseif($item == 'weight') {
                                                        $item_name = 'Весовой';
                                                    }
                                                    $item_slug = sanitize_title($item);
                                                    echo '<label class="filter-item">';
                                                    echo '<input type="checkbox" name="' . esc_attr($item) . '" value="' . esc_attr($item) . '" id="id_' . esc_attr($item_slug) . '" class="filter-item__checkbox is-production_tea_weight">';
                                                    echo '<div class="filter-item__checkbox-decoration"></div>';
                                                    echo '<div class="filter-item__name">' . esc_html($item_name) . '</div>';
                                                    echo '</label>';
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                            }

                                            //Продукция: Пакетированный
                                            if (!empty($production_tea_bagged)) {

                                                $production_tea_bagged = array_unique($production_tea_bagged);// Удаляем дубликаты
                                                echo '<div class="catalog__filter__item">';
                                                echo '<div class="catalog__filter__item__title is-accordion">Пакетированный</div>';
                                                echo '<div class="catalog__filter__item__list" style="display:none">';
                                                foreach ($production_tea_bagged as $key => $item) {
                                                    $item_name = $item;
                                                    if($item == 'thyme'){
                                                        $item_name = 'Чабрец';
                                                    } elseif($item == 'raspberry') {
                                                        $item_name = 'С малиной';
                                                    } elseif($item == 'molasses') {
                                                        $item_name = 'С мелиссой';
                                                    }
                                                    $item_slug = sanitize_title($item);
                                                    echo '<label class="filter-item">';
                                                    echo '<input type="checkbox" name="' . esc_attr($item) . '" value="' . esc_attr($item) . '" id="id_' . esc_attr($item_slug) . '" class="filter-item__checkbox is-production_tea_bagged">';
                                                    echo '<div class="filter-item__checkbox-decoration"></div>';
                                                    echo '<div class="filter-item__name">' . esc_html($item_name) . '</div>';
                                                    echo '</label>';
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                            }

                                            //Товары по API
                                            // Фильтр по меткам
                                            if (!empty($product_tags)) {

                                                asort($product_tags);
                                                echo '<div class="catalog__filter__item">';
                                                echo '<div class="catalog__filter__item__title is-accordion">Бренды</div>';
                                                echo '<div class="catalog__filter__item__list" style="display:none">';
                                                $count_brand = 0;
                                                foreach ($product_tags as $slug => $name) {
                                                    $count_brand++;
//                                                    if ($count_brand == 6) {
//                                                        echo '<button class="filter-item filter-item__more"><i class="icon"><svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.351293 0.351294C0.819685 -0.117098 1.5791 -0.117098 2.04749 0.351293L10.6012 8.90498L10.6011 2.67455C10.6011 2.01215 11.1381 1.47515 11.8005 1.47514C12.4629 1.47513 12.9999 2.01211 12.9999 2.67452L13 11.8006C13 12.1187 12.8736 12.4238 12.6487 12.6487C12.4238 12.8736 12.1187 13 11.8006 13L2.80433 13C2.14192 13 1.60494 12.463 1.60494 11.8006C1.60494 11.1382 2.14192 10.6012 2.80433 10.6012L8.90502 10.6012L0.351294 2.04749C-0.117098 1.5791 -0.117098 0.819685 0.351293 0.351294Z" fill="#EB6025" /></svg></i><span class="filter-item__name">Развернуть</span></button>';
//                                                    };
                                                    echo '<label class="filter-item">';
                                                    echo '<input type="checkbox" name="tag_' . esc_attr($slug) . '" value="' . esc_attr($slug) . '" class="filter-item__checkbox is-brand">';
                                                    echo '<div class="filter-item__checkbox-decoration"></div>';
                                                    echo '<div class="filter-item__name">' . esc_html($name) . '</div>';
                                                    echo '</label>';
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                            }

                                            //Фильтр по странам
                                            $product_countries = array_unique($product_countries);
                                            asort($product_countries);
                                            if (!empty($product_countries)) {
                                                echo '<div class="catalog__filter__item">';
                                                echo '<div class="catalog__filter__item__title is-accordion">Страна</div>';
                                                echo '<div class="catalog__filter__item__list" style="display:none">';
                                                foreach ($product_countries as $key => $country) {
//                                                    if ($key == 5) {
//                                                        echo '<button class="filter-item filter-item__more"><i class="icon"><svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.351293 0.351294C0.819685 -0.117098 1.5791 -0.117098 2.04749 0.351293L10.6012 8.90498L10.6011 2.67455C10.6011 2.01215 11.1381 1.47515 11.8005 1.47514C12.4629 1.47513 12.9999 2.01211 12.9999 2.67452L13 11.8006C13 12.1187 12.8736 12.4238 12.6487 12.6487C12.4238 12.8736 12.1187 13 11.8006 13L2.80433 13C2.14192 13 1.60494 12.463 1.60494 11.8006C1.60494 11.1382 2.14192 10.6012 2.80433 10.6012L8.90502 10.6012L0.351294 2.04749C-0.117098 1.5791 -0.117098 0.819685 0.351293 0.351294Z" fill="#EB6025" /></svg></i><span class="filter-item__name">Развернуть</span></button>';
//                                                    };
                                                    $country_slug = sanitize_title($country);
                                                    echo '<label class="filter-item">';
                                                    echo '<input type="checkbox" name="' . esc_attr($country) . '" value="' . esc_attr($country) . '" id="id_' . esc_attr($country_slug) . '" class="filter-item__checkbox is-country">';
                                                    echo '<div class="filter-item__checkbox-decoration"></div>';
                                                    echo '<div class="filter-item__name">' . esc_html($country) . '</div>';
                                                    echo '</label>';
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                            }


                                            // Выводим фильтры только для используемых атрибутов и их значений
//                                            $count_attrs = 0;
                                            foreach ($used_attributes as $taxonomy => $terms) {
//                                                $count_attrs++;
//                                                if($count_attrs > 10){break;}
                                                // Получаем объект атрибута
                                                $attribute_taxonomy = get_taxonomy($taxonomy);
                                                if ($attribute_taxonomy) {
                                                    asort($terms);
                                                    echo '<div class="catalog__filter__item">';
                                                    echo '<div class="catalog__filter__item__title is-accordion">' . $attribute_taxonomy->labels->singular_name . '</div>';
                                                    echo '<div class="catalog__filter__item__list" style="display:none">';
                                                    $count_attribute = 0;
                                                    foreach ($terms as $slug => $name) {
                                                        $count_attribute++;
//                                                        if ($count_attribute == 6) {
//                                                            echo '<button class="filter-item filter-item__more"><i class="icon"><svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.351293 0.351294C0.819685 -0.117098 1.5791 -0.117098 2.04749 0.351293L10.6012 8.90498L10.6011 2.67455C10.6011 2.01215 11.1381 1.47515 11.8005 1.47514C12.4629 1.47513 12.9999 2.01211 12.9999 2.67452L13 11.8006C13 12.1187 12.8736 12.4238 12.6487 12.6487C12.4238 12.8736 12.1187 13 11.8006 13L2.80433 13C2.14192 13 1.60494 12.463 1.60494 11.8006C1.60494 11.1382 2.14192 10.6012 2.80433 10.6012L8.90502 10.6012L0.351294 2.04749C-0.117098 1.5791 -0.117098 0.819685 0.351293 0.351294Z" fill="#EB6025" /></svg></i><span class="filter-item__name">Развернуть</span></button>';
//                                                        };
                                                        echo '<label class="filter-item">';
                                                        echo '<input type="checkbox" name="attribute_' . $taxonomy . '[]" value="' . $slug . '" class="filter-item__checkbox is-attribute">';
                                                        echo '<div class="filter-item__checkbox-decoration"></div>';
                                                        echo '<div class="filter-item__name">' . $name . '</div>';
                                                        echo '</label>';
                                                    }
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                            }
                                    ?>


                            </div>
                        </div>
                    </div>

                    <div class="catalog__list-wrap">

                        <h1 class="catalog__list-wrap__title is-desktop"><?php single_cat_title();?></h1>
                        <div class="catalog__list-wrap__current-filter">

                        </div>
                        <div class="catalog__list" data-term="<?php echo $term_slug;?>">
                            <?php

                            $loop = new WP_Query(array(
                                'posts_per_page' => 12,
                                'post_type' => 'product',
                                'post_status' => 'publish',
                                'paged' => get_query_var('paged') ?: 1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field' => 'slug',
                                        'terms' => $term_slug,
                                    ),
                                ),
                                'meta_key' => 'product_sort',//TODO
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
                            } else {
                                echo 'Товары не найдены';
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

        <section class="section contact-form__section contact-form-1__section decoration_6 decoration_7">
            <div class="container">
                <h2 class="section-title is-desktop">Оставьте заявку на консультацию со специалистом</h2>
                <div class="section-title is-mobile">Написать специалисту</div>
                <div class="contact-form__text">Ответим на любые ваши вопросы, при необходимости с комментариями инженеров и других специалистов сервиса.</div>

                <div class="contact-form">
                    <?php echo do_shortcode('[contact-form-7 id="2a55fe9" title="Заявка на консультацию (whatsapp)"]');?>
                </div>

                <div class="contact-form__text">Свяжемся в течение 60 минут после получения вашей заявки</div>
            </div>
        </section>


    </main>

<?php get_footer(); ?>
