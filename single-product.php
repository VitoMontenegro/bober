<?php
/**
 * sigle-product (sigle-product.php)
 * @package WordPress
 */

// Получаем все настройки для используемых полей
$fields = [
    'production_degree_roasting',
    'production_country',
    'production_tea_weight',
//                                        'production_tea_bagged',
    'production_tea_color'
];
$field_settings = [];
foreach ($fields as $field_name) {
    $field_settings[$field_name] = acf_get_field($field_name);
}
// Функция для вывода значений
function render_field_values($field_name, $field_settings) {
    $values = get_field($field_name); // Получаем значение поля
    if (!empty($values) && isset($field_settings[$field_name]['choices'])) {
        $choices = $field_settings[$field_name]['choices']; // Возможные значения
        if (is_array($values)) {
            // Если массив, преобразуем ключи в значения
            return implode(', ', array_map(function($key) use ($choices) {
                return $choices[$key] ?? $key;
            }, $values));
        } else {
            // Если одно значение
            return $choices[$values] ?? $values;
        }
    }
    return $values;
}
?>
<?php get_header(); ?>

<?php
$product_id = get_the_ID();
$product = wc_get_product($product_id);
//Галерея товара
$attachment_ids = $product->get_gallery_image_ids();

//Изображение
$preview = '/wp-content/uploads/2024/04/color-1.jpg';
if (has_post_thumbnail()) {
    $preview = get_the_post_thumbnail_url();
}

//Цена
$regular_price = $product->get_regular_price();
$sale_price = $product->get_sale_price();
// Форматируем цену, убирая десятичные знаки и добавляя разделитель тысяч
$formatted_price = '';

if ((!empty($regular_price) || $regular_price == 0) or (!empty($sale_price) || $sale_price == 0)) {
    $formatted_price = (float)$regular_price;
    $formatted_price = (int)round($formatted_price);
    $formatted_price = number_format($formatted_price, 0, '.', ' ');
}

//Категории
$product_cat = wp_get_post_terms($product->get_id(), 'product_cat');
$product_cat_parent = get_term_by( 'id', $product_cat[0]->parent, 'product_cat' );

//Атрибуты
$prod_attr = $product->get_attributes();

//Цена за
if(get_field('production_price_currency') == 'package'){
    $currency_value = 'руб/уп';//Упаковку
} elseif(get_field('production_price_currency') == 'rub'){
    $currency_value = 'руб';//Упаковку
} else {
    $currency_value = 'руб/шт';//Штуку
}

?>

<div id="add-to-cart-message"></div>

<main>

    <section class="section product-detail__section">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="/">Главная</a></li>
                <li><a href="/prodazha/">Продажа</a></li>
                <?php if($product_cat_parent) : ?>
                    <li>
                        <a href="<?php echo get_category_link($product_cat_parent->term_id);?>">
                            <?php
                            $product_cat_parent_name = $product_cat_parent->name;
                            $product_cat_parent_name = str_replace('.', '.<wbr>', $product_cat_parent_name);
                            echo $product_cat_parent_name;
                            ?>
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="<?php echo get_term_link($product_cat[0], 'product_cat');?>">
                        <?php
                        $product_cat_0_name = $product_cat[0]->name;
                        $product_cat_0_name = str_replace('.', '.<wbr>', $product_cat_0_name);
                        echo $product_cat_0_name;
                        ?>
                    </a>
                </li>
                <li><?php the_title(); ?></li>
            </ul>

            <div class="product-detail">

                <div class="product-detail__info__mobile">
                    <div class="product-detail__info__title"><?php the_title(); ?></div>
                    <div class="product-detail__info__flex ">
                        <?php
                        if($product->get_tag_ids()){
                            $brand_terms = get_terms( [
                                'taxonomy' => 'product_tag',
                                'include'  => $product->get_tag_ids()
                            ] );
                            foreach ($brand_terms as $term) {?>
                                <?php /* <a href="<?php echo get_term_link($term->term_id);?>" class="product-detail__info__flex__item item-text"><?php echo $term->name;?></a> */?>
                                <div class="product-detail__info__flex__item item-text"><?php echo $term->name;?></div>
                            <?php } ?>
                        <?php } ?>

                    </div>
                </div>

                <div class="product-detail__gallery">

                    <div class="gallery-container product-detail__gallery-container">


                        <?php if (empty($attachment_ids)) {//Только одно изображеие?>

                            <div class="product-detail__gallery-one pointer">
                                <img data-fancybox="gallery" src="<?php echo $preview; ?>" alt="<?php the_title(); ?>">
                            </div>

                            <div class="product-detail__stikers">
                                        <span class="product-detail__stikers__wish btn-modal-open--wish-add wish-btn item-card__btn-wish<?php if (getCookiesArr()) {
                                            if (in_array(get_the_ID(), getCookiesArr())) {
                                                echo ' active';
                                            }
                                        } ?>" data-id="<?php echo get_the_ID(); ?>" data-title="<?php the_title(); ?>">
                                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                          <path d="M9.86309 13.8031C9.52178 14.0239 9.22849 14.2048 9.00332 14.3402C8.77769 14.2028 8.48348 14.0193 8.14094 13.7953C7.31893 13.258 6.22804 12.4944 5.14203 11.5849C4.05125 10.6715 2.99445 9.63505 2.21769 8.55659C1.43332 7.46755 1 6.4268 1 5.48383C1 3.26692 2.76095 1.50015 4.89602 1.50015V1.50018L4.90395 1.50012C6.20955 1.48975 7.43789 2.15804 8.15691 3.2854C8.34006 3.57256 8.65677 3.74676 8.99737 3.74766C9.33797 3.74857 9.6556 3.57605 9.84027 3.28987C10.5657 2.16566 11.7934 1.49735 13.1003 1.50014C15.2326 1.5114 16.9881 3.27282 17 5.48619C16.9993 6.44968 16.5635 7.49965 15.7815 8.58863C15.0055 9.66922 13.9497 10.7026 12.8598 11.6109C11.7747 12.5152 10.6846 13.2716 9.86309 13.8031Z"
                                                stroke="#EB6025" stroke-width="2" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                            </div>

                        <?php } else { //Изображение и Галерея?>

                            <div class="swiper-container gallery-main product-detail__gallery-main">

                                <div class="product-detail__stikers">
                                    <div class="product-detail__stikers__new">
                                        <i class="icon">
                                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.7179 5.9382C12.9738 5.69793 13.0641 5.34529 12.9537 5.01749C12.8431 4.68969 12.5549 4.45569 12.2009 4.40603L9.05324 3.96537C8.91918 3.94656 8.80335 3.86555 8.74348 3.74842L7.33624 1.00061C7.17824 0.691866 6.85753 0.5 6.50013 0.5C6.14298 0.5 5.82228 0.691866 5.66428 1.00061L4.25678 3.74867C4.19691 3.8658 4.08082 3.94681 3.94676 3.96562L0.799096 4.40628C0.445335 4.45569 0.156912 4.68994 0.046281 5.01774C-0.0640901 5.34555 0.0262372 5.69818 0.282121 5.93845L2.55957 8.07731C2.65666 8.1686 2.70118 8.30002 2.67827 8.42844L2.14099 11.4486C2.09335 11.7145 2.16572 11.9731 2.34429 12.177C2.62178 12.4947 3.10622 12.5915 3.49356 12.3954L6.30854 10.9693C6.4262 10.9099 6.57432 10.9104 6.69172 10.9693L9.50696 12.3954C9.64389 12.4649 9.78992 12.5 9.94064 12.5C10.2158 12.5 10.4766 12.3821 10.656 12.177C10.8348 11.9731 10.9069 11.714 10.8593 11.4486L10.3217 8.42844C10.2988 8.29977 10.3433 8.1686 10.4404 8.07731L12.7179 5.9382Z"
                                                      fill="white"/>
                                            </svg>
                                        </i>
                                        <span>New</span>
                                    </div>
                                    <span class="product-detail__stikers__wish btn-modal-open--wish-add wish-btn item-card__btn-wish<?php if (getCookiesArr()) {
                                        if (in_array(get_the_ID(), getCookiesArr())) {
                                            echo ' active';
                                        }
                                    } ?>" data-id="<?php echo get_the_ID(); ?>" data-title="<?php the_title(); ?>">
                                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                          <path d="M9.86309 13.8031C9.52178 14.0239 9.22849 14.2048 9.00332 14.3402C8.77769 14.2028 8.48348 14.0193 8.14094 13.7953C7.31893 13.258 6.22804 12.4944 5.14203 11.5849C4.05125 10.6715 2.99445 9.63505 2.21769 8.55659C1.43332 7.46755 1 6.4268 1 5.48383C1 3.26692 2.76095 1.50015 4.89602 1.50015V1.50018L4.90395 1.50012C6.20955 1.48975 7.43789 2.15804 8.15691 3.2854C8.34006 3.57256 8.65677 3.74676 8.99737 3.74766C9.33797 3.74857 9.6556 3.57605 9.84027 3.28987C10.5657 2.16566 11.7934 1.49735 13.1003 1.50014C15.2326 1.5114 16.9881 3.27282 17 5.48619C16.9993 6.44968 16.5635 7.49965 15.7815 8.58863C15.0055 9.66922 13.9497 10.7026 12.8598 11.6109C11.7747 12.5152 10.6846 13.2716 9.86309 13.8031Z"
                                                stroke="#EB6025" stroke-width="2" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </div>

                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="<?php echo $preview; ?>" alt="Slide">
                                    </div>
                                    <?php
                                    foreach ($attachment_ids as $attachment_id) {
                                        $image_link = wp_get_attachment_url($attachment_id);
                                        ?>
                                        <div class="swiper-slide">
                                            <img src="<?php echo esc_url($image_link); ?>" alt="Slide">
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="swiper-container gallery-thumbs product-detail__gallery-thumbs">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="<?php echo $preview; ?>" alt="Slide">
                                    </div>
                                    <?php
                                    foreach ($attachment_ids as $attachment_id) {
                                        $image_link = wp_get_attachment_url($attachment_id);
                                        ?>
                                        <div class="swiper-slide">
                                            <img src="<?php echo esc_url($image_link); ?>" alt="Slide">
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        <?php } //?>

                    </div>
                </div>


                <div class="product-detail__info">
                    <div class="product-detail__info__sale-link__wrap">
                        <a href="/my-account/" class="product-detail__info__sale-link">
                            % Скидка <span class="product-detail__info__sale-link--underlink">после регистрации</span>
                        </a>
                    </div>

                    <h1 class="product-detail__info__title is-desktop"><?php the_title(); ?></h1>
                    <div class="product-detail__info__flex is-desktop">

                        <?php
                        if($product->get_tag_ids()){
                            $brand_terms = get_terms( [
                                'taxonomy' => 'product_tag',
                                'include'  => $product->get_tag_ids()
                            ] );
                            foreach ($brand_terms as $term) {?>
                                <?php /*<a href="<?php echo get_term_link($term->term_id);?>" class="product-detail__info__flex__item item-text"><?php echo $term->name;?></a> */?>
                                <div class="product-detail__info__flex__item item-text"><?php echo $term->name;?></div>
                            <?php } ?>
                        <?php } ?>

                        <div class="product-detail__info-block__price">
                            <?php //Цена
                            $product_id = $product->get_id();

                            $discounted_price = get_discounted_price($product_id);
                            if (!empty($discounted_price) || $discounted_price == 0) {
//                                $discounted_price = rtrim($discounted_price, '0');
//                                $discounted_price = rtrim($discounted_price, '.');
//                                $discounted_price = (int)round((float)$discounted_price);
//                                $discounted_price = number_format($discounted_price, 2, '.', ' ');

                                $discounted_price = (float)$discounted_price;
                                $discounted_price = (int)round($discounted_price);
                                $discounted_price = number_format($discounted_price, 0, '.', ' ');
                                ?>

                                <div class="product-detail__info-block__price__current">
                                    <span class="value"><?php echo $discounted_price; ?></span>
                                    <span class="currency"><?php echo $currency_value;?></span>
                                </div>

                                <?php if (get_discounted_price($product_id) < $regular_price) {?>
                                    <div class="product-detail__info-block__price__old">
                                        <span class="value"><?php echo $formatted_price; ?></span>
                                        <span class="currency"><?php echo $currency_value;?></span>
                                    </div>
                                <?php } ?>


                            <?php } ?>
                        </div>

                    </div>

                    <?php if (get_field('api_product')){ //Обычный товар?>
                        <div class="product-detail__info-block">
                            <div class="product-detail__info-block__table__wrap">
                                <div class="product-detail__info-block__table product-detail__info-block__table--blue">
                                    <div class="product-detail__info-block__table__head">
                                        <div class="product-detail__info-block__table__head__left">
                                            <span>Наличие</span>
                                        </div>
                                        <div class="product-detail__info-block__table__head__right">

                                            <div class="product-detail__info-block__table__head__right__inAccess">

                                                <?php if (!get_field('api_product')){
                                                    //Обычный товар

//                                                    $stock_status = $product->get_stock_status();
//                                                    $stock_status_text = '';
//                                                    if ($stock_status == 'instock') {?>
                                                    <!--                                                        <span>В наличии</span>-->
                                                    <!--                                                        <i class="icon">-->
                                                    <!--                                                            <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">-->
                                                    <!--                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5981 5.09001C14.9982 5.47812 15 6.10913 14.6022 6.49943L8.07248 12.9062C7.88075 13.0943 7.62006 13.2001 7.34815 13.2001C7.07624 13.2001 6.81555 13.0943 6.62383 12.9062L4.39803 10.7223C4.00024 10.332 4.00207 9.701 4.4021 9.3129C4.80214 8.9248 5.4489 8.92658 5.84668 9.31687L7.34815 10.7901L13.1535 5.09399C13.5513 4.70369 14.1981 4.70191 14.5981 5.09001Z" fill="#00AECD" />-->
                                                    <!--                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.6022 6.49943C15 6.10913 14.9982 5.47812 14.5981 5.09001C14.1981 4.70191 13.5513 4.70369 13.1535 5.09399L7.34815 10.7901L5.84668 9.31687C5.4489 8.92658 4.80214 8.9248 4.4021 9.3129C4.00207 9.701 4.00024 10.332 4.39803 10.7223L6.62383 12.9062C6.81555 13.0943 7.07624 13.2001 7.34815 13.2001C7.62006 13.2001 7.88075 13.0943 8.07248 12.9062L14.6022 6.49943Z" fill="#00AECD" />-->
                                                    <!--                                                            </svg>-->
                                                    <!--                                                        </i>-->
                                                    <!--                                                    --><?php //} else if ($stock_status == 'outofstock') {?>
                                                    <!--                                                        <span>Нет в наличии</span>-->
                                                    <!--                                                    --><?php //} else if ($stock_status == 'onbackorder') {?>
                                                    <!--                                                        <span>Под заказ</span>-->
                                                    <!--                                                    --><?php //} ?>

                                                <?php } else { //Товар API?>

                                                    <?php if(get_field('product_inAccess')){?>
                                                        <span>В наличии</span>
                                                        <i class="icon">
                                                            <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5981 5.09001C14.9982 5.47812 15 6.10913 14.6022 6.49943L8.07248 12.9062C7.88075 13.0943 7.62006 13.2001 7.34815 13.2001C7.07624 13.2001 6.81555 13.0943 6.62383 12.9062L4.39803 10.7223C4.00024 10.332 4.00207 9.701 4.4021 9.3129C4.80214 8.9248 5.4489 8.92658 5.84668 9.31687L7.34815 10.7901L13.1535 5.09399C13.5513 4.70369 14.1981 4.70191 14.5981 5.09001Z" fill="#00AECD" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.6022 6.49943C15 6.10913 14.9982 5.47812 14.5981 5.09001C14.1981 4.70191 13.5513 4.70369 13.1535 5.09399L7.34815 10.7901L5.84668 9.31687C5.4489 8.92658 4.80214 8.9248 4.4021 9.3129C4.00207 9.701 4.00024 10.332 4.39803 10.7223L6.62383 12.9062C6.81555 13.0943 7.07624 13.2001 7.34815 13.2001C7.62006 13.2001 7.88075 13.0943 8.07248 12.9062L14.6022 6.49943Z" fill="#00AECD" />
                                                            </svg>
                                                        </i>
                                                    <?php } else { ?>
                                                        <span>Под заказ</span>
                                                    <?php } ?>

                                                <?php } ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="product-detail__info-block__table__body custom-scroll<?php // custom-scroll ?>">


                                        <?php if(get_field('product_inAccess')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    На складе
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_inAccess');?> шт
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if(get_field('product_inReserve')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Резерв на складе
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_inReserve');?> шт
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php /*
                                        <?php if(get_field('product_isSale')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Распродажа
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_isMarkdown')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Уценка
                                                </div>
                                            </div>
                                        <?php } ?>
                                        */?>

                                        <?php if( have_rows('product_expected') ):?>
                                            <div class="product-detail__info-block__table__body__row row-title">
                                                <div class="row-title__inner">
                                                    Планируемые поступления
                                                </div>
                                            </div>

                                            <?php while ( have_rows('product_expected') ) : the_row();
                                                $product_expected_quantity = get_sub_field('product_expected_quantity');
                                                $product_expected_date = get_sub_field('product_expected_date');
                                                if (strpos($product_expected_date, '-') !== false) {
                                                    //форматируем дату
                                                    list($year, $month, $day) = explode('-', $product_expected_date);
                                                    $product_expected_date = sprintf('%02d.%02d.%04d', $day, $month, $year);
                                                }

                                                ?>
                                                <div class="product-detail__info-block__table__body__row">
                                                    <div class="product-detail__info-block__table__body__row__left">
                                                        <?php echo $product_expected_date;?>
                                                    </div>
                                                    <div class="product-detail__info-block__table__body__row__right">
                                                        <?php echo $product_expected_quantity;?> шт
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        <?php endif; ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="product-detail__info__btns">
                        <button type="button" class="btn product-detail__info__btns__item btn-buy" onclick="addToCart(<?php echo esc_attr( $product->get_id() ) ?>)">
                            В корзину
                            <span class="icon-preloader" data-preloader="<?php echo $product->get_id();?>" data-title="<?php the_title(); ?>"></span>
                        </button>

                        <?php
                        //  echo '<div class="quantity">';
                        //  echo '<input type="number" step="1" min="1" name="quantity" value="1" title="Количество" class="input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric" />';
                        //  echo '</div>';
                        ?>

                        <?php if(get_field('option_soc_whatsapp', 'option')) { ?>
                            <a href="<?php the_field('option_soc_whatsapp', 'option'); ?>" target="_blank" class="btn product-detail__info__btns__item btn-whatsapp" target="_blank">
                                <i class="icon">
                                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M15.8348 2.58993C14.1339 0.951814 11.8705 0.0252744 9.5081 0C7.14479 0 4.87827 0.937979 3.20715 2.60759C1.53603 4.27721 0.59721 6.54169 0.59721 8.90288C0.596815 10.4711 1.01636 12.0108 1.81233 13.3624L0.5 18L5.28758 16.786C6.60591 17.5033 8.08823 17.8658 9.58911 17.8381C10.7593 17.8381 11.918 17.6078 12.9992 17.1604C14.0803 16.713 15.0626 16.0572 15.8901 15.2305C16.7175 14.4038 17.3739 13.4224 17.8217 12.3422C18.2695 11.2621 18.5 10.1044 18.5 8.93525C18.4426 6.56437 17.4839 4.30426 15.8186 2.61421L15.8348 2.58993ZM12.7889 10.4164C13.113 10.5782 13.437 10.7401 13.5585 10.7806L13.5666 10.7968C13.7227 10.8517 13.8872 10.8791 14.0527 10.8777C14.0475 11.2342 13.993 11.5883 13.8906 11.9299C13.5128 12.4458 12.9697 12.8171 12.3515 12.982C11.893 13.0715 11.4192 13.0436 10.9743 12.9011C10.8123 12.8201 10.6301 12.7594 10.4174 12.6886C10.2048 12.6178 9.96175 12.5369 9.67822 12.4155C8.10912 11.7018 6.78295 10.5456 5.86274 9.08903C5.35503 8.43116 5.04588 7.64214 4.97165 6.81475C4.95804 6.4636 5.0238 6.11389 5.16404 5.79162C5.30429 5.46935 5.51541 5.18279 5.78173 4.95324C5.93497 4.80619 6.13653 4.71989 6.34878 4.71043H6.75383C6.91584 4.71043 6.99685 4.71043 7.23987 5.11511C7.4829 5.51978 7.96895 6.57194 7.96895 6.73381C7.96895 6.79115 7.97911 6.83834 7.98864 6.88257C8.00601 6.96318 8.02126 7.03396 7.96895 7.13849C7.92844 7.21942 7.88794 7.28013 7.84743 7.34083C7.80693 7.40153 7.76643 7.46223 7.72592 7.54317C7.63834 7.69319 7.52916 7.82954 7.40189 7.94784C7.38248 7.98663 7.35842 8.02076 7.33528 8.05359C7.26185 8.15779 7.19768 8.24882 7.32088 8.43345C7.62086 9.02083 8.03377 9.54338 8.536 9.97122C9.02933 10.4877 9.64096 10.8766 10.3182 11.1043C10.5612 11.1853 10.6422 11.1853 10.8042 11.0234C11.0668 10.7432 11.3104 10.4457 11.5333 10.1331C11.6953 9.97122 11.7763 9.97122 12.0194 10.0522C12.1409 10.0926 12.4649 10.2545 12.7889 10.4164Z"
                                              fill="#25D366"/>
                                    </svg>
                                </i>
                                <span>Консультация</span>
                            </a>
                        <?php } ?>
                        <?php if(get_field('option_soc_telegram', 'option')) { ?>
                            <a href="<?php the_field('option_soc_telegram', 'option'); ?>" target="_blank" class="btn product-detail__info__btns__item btn-tg" target="_blank">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
                                        <rect width="50" height="50" rx="25" fill="#E3F4FF"></rect>
                                        <path d="M8.49398 23.5212L36.8691 13.9505C38.1861 13.5343 39.3363 14.2315 38.9095 15.9736L38.912 15.9715L34.0806 35.8832C33.7226 37.2949 32.7636 37.6382 31.4221 36.9731L24.0647 32.2296L20.516 35.2203C20.1236 35.5636 19.7925 35.8532 19.0323 35.8532L19.5546 29.3032L33.1904 18.5267C33.7839 18.0697 33.0579 17.8123 32.2756 18.2671L15.4247 27.5482L8.16044 25.5658C6.5835 25.1282 6.54917 24.1863 8.49398 23.5212Z" fill="#00BBFF"></path>
                                    </svg>
                                </i>
                                <span>Консультация</span>
                            </a>
                        <?php } ?>
                    </div>


                </div>


            </div>
        </div>
    </section>

    <section class="section product-desc__section">
        <div class="container">
            <div id="product-desc__faq" class="product-desc__faq">

                <?php if(get_the_content()){ //Вывод описания?>
                    <div class="product-desc__faq__item js-faq-item-open">
                        <div class="product-desc__faq__item__head">
                            <div class="product-desc__faq__item__head__name">
                                Описание
                            </div>
                            <i class="icon icon-caret">
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34"
                                     fill="none">
                                    <rect class="icon-caret__circle" y="34" width="33.9995" height="33.9995"
                                          rx="16.9998" transform="rotate(-90 0 34)" fill="#DBC3B7"/>
                                    <path class="icon-caret__arrow" fill-rule="evenodd" clip-rule="evenodd"
                                          d="M14.5799 23.6235C14.1227 23.1933 14.0915 22.4637 14.5102 21.994L18.9571 17.0056L14.5104 12.0189C14.0916 11.5492 14.1226 10.8197 14.5798 10.3894C15.0369 9.95916 15.747 9.99108 16.1658 10.4607L21.3072 16.2264C21.7002 16.6672 21.7003 17.3435 21.3073 17.7844L16.1659 23.5519C15.7472 24.0216 15.0371 24.0537 14.5799 23.6235Z"
                                          fill="white"/>
                                </svg>
                            </i>
                        </div>
                        <div class="product-desc__faq__item__content" style="display: block;">
                            <?php the_content();?>
                        </div>
                    </div>
                <?php } ?>


                <?php if(get_field('production_degree_roasting') ||
                    get_field('production_country') ||
                    have_rows('production_char_bottom') ||
                    have_rows('production_char') ||
                    get_field('production_tea_weight') ||
                    get_field('production_tea_bagged') ||
                    get_field('production_tea_color') ||
                    $product->get_tag_ids() ||
                    get_field('product_model') ||
                    get_field('product_country') ||
                    get_field('product_unit') ||
                    get_field('product_weightUnit') ||
                    get_field('product_sizeNet_length') ||
                    get_field('product_sizeNet_width') ||
                    get_field('product_sizeNet_height') ||
                    get_field('product_weightNet') ||
                    get_field('product_sizeGross_length') ||
                    get_field('product_sizeGross_width') ||
                    get_field('product_sizeGross_height') ||
                    get_field('product_weightGross') ||
                    get_field('product_warranty')){?>
                    <div class="product-desc__faq__item js-faq-item-open">
                        <div class="product-desc__faq__item__head">
                            <div class="product-desc__faq__item__head__name">Характеристики</div>
                            <i class="icon icon-caret">
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34"
                                     fill="none">
                                    <rect class="icon-caret__circle" y="34" width="33.9995" height="33.9995"
                                          rx="16.9998" transform="rotate(-90 0 34)" fill="#DBC3B7"/>
                                    <path class="icon-caret__arrow" fill-rule="evenodd" clip-rule="evenodd"
                                          d="M14.5799 23.6235C14.1227 23.1933 14.0915 22.4637 14.5102 21.994L18.9571 17.0056L14.5104 12.0189C14.0916 11.5492 14.1226 10.8197 14.5798 10.3894C15.0369 9.95916 15.747 9.99108 16.1658 10.4607L21.3072 16.2264C21.7002 16.6672 21.7003 17.3435 21.3073 17.7844L16.1659 23.5519C15.7472 24.0216 15.0371 24.0537 14.5799 23.6235Z"
                                          fill="white"/>
                                </svg>
                            </i>
                        </div>
                        <div class="product-desc__faq__item__content" style="display: block;">

                            <?php //Поля Продукция?>

                            <?php $product_get_article_char = false; ?>

                            <?php if( have_rows('production_char_bottom') ): ?>
                                <?php while( have_rows('production_char_bottom') ): the_row(); ?>

                                    <?php if($product->get_sku() && get_sub_field('production_char_bottom_right') == $product->get_sku()){
                                        $product_get_article_char = true;
                                    }?>

                                    <div class="product-desc__row">
                                        <div class="product-desc__row__left">
                                            <?php the_sub_field('production_char_bottom_left');?></php>
                                        </div>
                                        <div class="product-desc__row__right">
                                            <?php the_sub_field('production_char_bottom_right');?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>


                            <?php if( have_rows('production_char') && !have_rows('production_char_bottom') ): ?>
                                <?php while( have_rows('production_char') ): the_row(); ?>

                                    <?php if($product->get_sku() && get_sub_field('production_char_bottom_right') == $product->get_sku()){
                                        $product_get_article_char = true;
                                    }?>

                                    <div class="product-desc__row">
                                        <div class="product-desc__row__left">
                                            <?php the_sub_field('production_char_left');?></php>
                                        </div>
                                        <div class="product-desc__row__right">
                                            <?php the_sub_field('production_char_right');?>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>


                            <?php //Код = Артикул?>
                            <?php if($product->get_sku() && !$product_get_article_char){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Код
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php echo $product->get_sku();?>
                                    </div>
                                </div>
                            <?php } ?>



                            <?php if ($values = get_field('production_degree_roasting')) { ?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Степень обжарки
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php echo render_field_values('production_degree_roasting', $field_settings); ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if ($values = get_field('production_country')) { ?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Страна выращивания
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php echo render_field_values('production_country', $field_settings); ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php /* if(get_field('production_weight')) { ?>
                                        <div class="product-desc__row">
                                            <div class="product-desc__row__left">
                                                Вес
                                            </div>
                                            <div class="product-desc__row__right">
                                                <?php the_field('production_weight'); ?>
                                            </div>
                                        </div>
                                    <?php } */ ?>


                            <?php if ($values = get_field('production_tea_weight')) { ?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Весовой
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php echo render_field_values('production_tea_weight', $field_settings); ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php /* if ($values = get_field('production_tea_bagged')) { ?>
                                        <div class="product-desc__row">
                                            <div class="product-desc__row__left">
                                                Пакетированный
                                            </div>
                                            <div class="product-desc__row__right">
                                                <?php echo render_field_values('production_tea_bagged', $field_settings); ?>
                                            </div>
                                        </div>
                                    <?php }*/ ?>

                            <?php if ($values = get_field('production_tea_color')) { ?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Вид чая
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php echo render_field_values('production_tea_color', $field_settings); ?>
                                    </div>
                                </div>
                            <?php } ?>




                            <?php //Атрибуты
                            foreach ($prod_attr as $key => $value) {
                                echo '<div class="product-desc__row">';
                                echo '<div class="product-desc__row__left">';
                                echo wc_attribute_label( $value['name'] ) . ": "; // Выводим наименование атрибута
                                echo '</div>';
                                echo '<div class="product-desc__row__right">';
                                foreach ( $value->get_terms() as $pa ) { // Выборка значения заданного атрибута
                                    echo ' '.$pa->name.' '; // Выводим значение атрибута
                                }
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>

                            <?php if (isset($current_cat_wbr)){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Категория
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php  echo $current_cat_wbr;  ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if($product->get_tag_ids()){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Бренд
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php

                                        $terms = get_terms( [
                                            'taxonomy' => 'product_tag',
                                            'include'  => $product->get_tag_ids()
                                        ] );
                                        foreach ($terms as $term){
                                            echo $term->name;
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_model')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Модель
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_model');?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_country')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Страна
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_country');?>
                                    </div>
                                </div>
                            <?php } ?>

                            <!--                            <div class="product-desc__row">-->
                            <!--                                <div class="product-desc__row__left">-->
                            <!--                                    Артикул-->
                            <!--                                </div>-->
                            <!--                                <div class="product-desc__row__right">-->
                            <!--                                    --->
                            <!--                                </div>-->
                            <!--                            </div>-->

                            <?php if(get_field('product_unit')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Единица измерения
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_unit');?>
                                    </div>
                                </div>
                            <?php } ?>


                            <?php if(get_field('product_weightUnit')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Единица измерения веса
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_weightUnit');?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_sizeNet_length')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Габариты (Длина)
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_sizeNet_length');?>
                                    </div>
                                </div>
                            <?php } ?>


                            <?php if(get_field('product_sizeNet_width')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Габариты (Ширина)
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_sizeNet_width');?>
                                    </div>
                                </div>
                            <?php } ?>


                            <?php if(get_field('product_sizeNet_height')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Габариты (Высота)
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_sizeNet_height');?>
                                    </div>
                                </div>
                            <?php } ?>


                            <?php if(get_field('product_weightNet')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Вес
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_weightNet');?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_sizeGross_length')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Габариты в упаковке (Длина)
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_sizeGross_length');?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_sizeGross_width')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Габариты в упаковке (Ширина)
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_sizeGross_width');?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_sizeGross_height')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Габариты в упаковке (Высота)
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_sizeGross_height');?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(get_field('product_weightGross')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Вес в упаковке
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_weightGross');?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_warranty')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Гарантия
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_warranty');?>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                <?php } ?>

                <?php // echo do_shortcode('[custom_download url="https://portal.holdingbio.ru/api/img/file/d201d2d0-ea80-11ed-b78f-a71b31222ae6.pdf" filename="my_file.pdf"]');?>


                <?php if( have_rows('product_files') ):?>
                    <div class="product-desc__faq__item">
                        <div class="product-desc__faq__item__head">
                            <div class="product-desc__faq__item__head__name">
                                Файлы
                            </div>
                            <i class="icon icon-caret">
                                <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34"
                                     fill="none">
                                    <rect class="icon-caret__circle" y="34" width="33.9995" height="33.9995"
                                          rx="16.9998" transform="rotate(-90 0 34)" fill="#DBC3B7"/>
                                    <path class="icon-caret__arrow" fill-rule="evenodd" clip-rule="evenodd"
                                          d="M14.5799 23.6235C14.1227 23.1933 14.0915 22.4637 14.5102 21.994L18.9571 17.0056L14.5104 12.0189C14.0916 11.5492 14.1226 10.8197 14.5798 10.3894C15.0369 9.95916 15.747 9.99108 16.1658 10.4607L21.3072 16.2264C21.7002 16.6672 21.7003 17.3435 21.3073 17.7844L16.1659 23.5519C15.7472 24.0216 15.0371 24.0537 14.5799 23.6235Z"
                                          fill="white"/>
                                </svg>
                            </i>
                        </div>
                        <div class="product-desc__faq__item__content">
                            <div class="product-desc__files">

                                <?php while ( have_rows('product_files') ) : the_row();
                                    $file_url = get_sub_field('product_files_ref');
                                    $file_name = get_sub_field('product_files_name');
                                    $file_type = get_sub_field('product_files_type');

                                    // Генерируем скрытый URL для скачивания
                                    $download_url = 'https://portal.holdingbio.ru/api/img/file/' . $file_url;

                                    ?>

                                    <a href="<?php echo get_template_directory_uri(); ?>/download.php?url=<?php echo base64_encode($download_url); ?>&name=<?php echo urlencode($file_name); ?>&type=<?php echo urlencode($file_type); ?>" class="product-desc__files__item" rel="nofollow">
                                        <i class="icon">
                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 384 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm64 236c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-64c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-72v8c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm96-114.1v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z"></path></svg>
                                        </i>
                                        <?php if($file_name) : ?>
                                            <span class="product-desc__files__item__name"><?php echo esc_html($file_name); ?></span>
                                        <?php endif; ?>
                                        <?php if($file_type) : ?>
                                            <span class="product-desc__files__item__type">(<?php echo esc_html($file_type); ?>)</span>
                                        <?php endif; ?>
                                    </a>
                                <?php endwhile; ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

            <?php
            $calc_leasing = false;
            $terms = get_the_terms($product_id, 'product_cat');
            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
//                            if ($term->slug == 'kofeynoe-oborudovanie' || term_is_ancestor_of(get_term_by('slug', 'kofeynoe-oborudovanie', 'product_cat')->term_id, $term->term_id, 'product_cat')) {
                    if ($term->slug == 'kofemashiny-traditsionnye' || $term->slug == 'kofemashiny-superavtomaty') {
                        $calc_leasing = true;
                    }
                }
            }
            ?>


            <?php /* if($calc_leasing){?>
                <div class="section calc-leasing__section product-detail__calc">
                    <div class="container">
                        <h2 class="section-title">Калькулятор лизинга</h2>
                        <div class="calc-leasing">
                            <div class="calc-leasing__item">
                                <div class="calc-leasing__item__title">
                                    Стоимость оборудования
                                </div>

                                <?php
                                //Цена
                                $product_id = $product->get_id();
                                $discounted_price = get_discounted_price($product_id);

                                // Функция для форматирования чисел с пробелами
                                function numberWithCommas($x) {
                                    return number_format($x, 0, '', ' ');
                                }

                                // Значения по умолчанию
                                $avansovii_platyozh_percent = 25; // 25%
                                $srok_lizinga = 20; // 20 месяцев

                                // Расчеты
                                $stoimost_obrudovaniya = $discounted_price;
                                $avansovii_platyozh_field = ($stoimost_obrudovaniya / 100) * $avansovii_platyozh_percent;
                                $summa_finansirovaniya = $stoimost_obrudovaniya - $avansovii_platyozh_field;
                                $udorozhanie = $summa_finansirovaniya * 0.13 / 12 * $srok_lizinga;
                                $summa_dogovora = $stoimost_obrudovaniya + $udorozhanie;
                                $yezhemesyachnii_platyozh = ($summa_dogovora - $avansovii_platyozh_field) / $srok_lizinga;
                                $ekonomiya_na_NDS = ($stoimost_obrudovaniya + $udorozhanie) / 120 * 20;
                                $raskhodi_na_protsenti = ($udorozhanie) / 120 * 100;
                                $amortizatsiya = $stoimost_obrudovaniya / 120 * 100 / $srok_lizinga * $srok_lizinga;
                                $ekonomiya_na_naloge_na_pribil = ($raskhodi_na_protsenti + $amortizatsiya) * 0.2;
                                $obshchaya_ekonomiya_na_nalogakh = $ekonomiya_na_NDS + $ekonomiya_na_naloge_na_pribil;

                                // Форматирование результатов
                                $avansovii_platyozh_field_formatted = numberWithCommas($avansovii_platyozh_field);
                                $yezhemesyachnii_platyozh_formatted = numberWithCommas($yezhemesyachnii_platyozh);
                                $summa_dogovora_formatted = numberWithCommas($summa_dogovora);
                                $obshchaya_ekonomiya_na_nalogakh_formatted = numberWithCommas($obshchaya_ekonomiya_na_nalogakh);
                                ?>

                                <div class="calc-leasing__item__slide calc-leasing__item__slide--prodazha-kofe">
                                    <input type="text" id="calc-leasing-1" name="calc-leasing-1" value="" class="calc-leasing-slide"
                                           data-skin="round"
                                           data-min="0"
                                           data-max="99000000"
                                           data-from="<?php echo $discounted_price?>"
                                           data-step="100000"
                                           data-postfix=" руб"
                                    />
                                </div>
                            </div>
                            <div class="calc-leasing__item">
                                <div class="calc-leasing__item__title">
                                    Авансовый платёж
                                </div>
                                <div class="calc-leasing__item__slide">
                                    <div class="calc-leasing__item__slide__avans-price" data-avansPrice="<?php echo $avansovii_platyozh_field; ?>"><?php echo $avansovii_platyozh_field_formatted; ?> руб</div>
                                    <input type="text" id="calc-leasing-2" name="calc-leasing-2" value="" class="calc-leasing-slide"
                                           data-skin="round"
                                           data-min="0"
                                           data-max="49"
                                           data-from="<?php echo $avansovii_platyozh_percent;?>"
                                           data-step="1"
                                           data-postfix="%"
                                    />
                                </div>
                            </div>
                            <div class="calc-leasing__item">
                                <div class="calc-leasing__item__title">
                                    Срок лизинга
                                </div>
                                <div class="calc-leasing__item__slide">
                                    <input type="text" id="calc-leasing-3" name="calc-leasing-3" value="" class="calc-leasing-slide"
                                           data-skin="round"
                                           data-min="6"
                                           data-max="36"
                                           data-from="<?php echo $srok_lizinga;?>"
                                           data-step="1"
                                           data-postfix=" мес"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="calc-leasing-info">
                            <div class="calc-leasing-info__item">
                                <div class="calc-leasing-info__item__text">
                                    Ежемесячный платеж, включая НДС
                                </div>
                                <div class="calc-leasing-info__item__price calc-leasing-1-result">
                                    <span><?php echo $yezhemesyachnii_platyozh_formatted; ?></span> руб
                                </div>
                            </div>
                            <div class="calc-leasing-info__item">
                                <div class="calc-leasing-info__item__text">
                                    Сумма договора лизинга
                                </div>
                                <div class="calc-leasing-info__item__price calc-leasing-2-result">
                                    <span><?php echo $summa_dogovora_formatted; ?></span> руб
                                </div>
                            </div>
                            <div class="calc-leasing-info__item">
                                <div class="calc-leasing-info__item__text">
                                    Налоговая экономия по договору
                                </div>
                                <div class="calc-leasing-info__item__price calc-leasing-3-result">
                                    До <span><?php echo $obshchaya_ekonomiya_na_nalogakh_formatted; ?></span> руб
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } */ ?>

    </section>

</main>

<?php get_footer(); ?>
