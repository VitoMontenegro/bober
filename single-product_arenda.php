<?php
/**
 * sigle-product (sigle-product_arenda.php)
 * @package WordPress
 */

$product_id = get_the_ID();
$product = wc_get_product($product_id);
?>
<?php get_header(); ?>

    <main>

        <section class="section product-detail__section">
            <div class="container">

                    <ul class="breadcrumbs">
                        <li><a href="/">Главная</a></li>
                        <li><a href="/arenda-kofemashin/">Аренда</a></li>

                        <?php if(get_field('product_arenda_type')){
                        $product_arenda_type = get_field_object('product_arenda_type');
                        $product_arenda_type_value = $product_arenda_type['value'];
                        $product_arenda_type_label = $product_arenda_type['choices'][ $product_arenda_type_value ];
                        ?>
                        <li><a href="/arenda-kofemashin/<?php echo esc_attr($product_arenda_type_value); ?>/"><?php echo esc_html($product_arenda_type_label); ?></a></li>
                        <?php } ?>

                        <li><?php the_title(); ?></li>
                    </ul>

                <div class="product-detail">

                    <div class="product-detail__info__mobile">
                        <div class="product-detail__info__title"><?php the_title(); ?></div>

                        <div class="product-detail__info__flex ">
                            <?php if(get_field('product_arenda_type')){
                                ?>
                                <a href="/arenda-kofemashin/<?php echo esc_attr($product_arenda_type_value); ?>/" class="product-detail__info__flex__item item-text"><?php echo esc_html($product_arenda_type_label); ?></a></li>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="product-detail__gallery">

                        <div class="gallery-container product-detail__gallery-container">

                            <?php //Только одно изображеие ?>
                            <?php if (!get_field('product_arenda_gallery') && get_the_post_thumbnail()) {?>

                                <div class="product-detail__gallery-one pointer">
                                    <img data-fancybox="gallery" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
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

                            <?php //Галерея и Изображение ?>
                            <?php } elseif (get_field('product_arenda_gallery') && get_the_post_thumbnail()) { //Изображение и Галерея?>

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
                                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                        </div>
                                        <?php
                                        $images = get_field('product_arenda_gallery');
                                        if( $images ): ?>
                                            <?php foreach( $images as $image ): ?>
                                                <div class="swiper-slide">
                                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="swiper-container gallery-thumbs product-detail__gallery-thumbs">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                        </div>
                                        <?php
                                        $images = get_field('product_arenda_gallery');
                                        if( $images ): ?>
                                                <?php foreach( $images as $image ): ?>
                                                    <div class="swiper-slide">
                                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                                    </div>
                                                <?php endforeach; ?>
                                        <?php endif; ?>

                                    </div>
                                </div>

                            <?php //Нет изображений ?>
                            <?php } else { ?>

                                <div class="product-detail__gallery-one">
                                    <img src="/wp-content/uploads/2024/04/color-1.jpg" alt="<?php the_title(); ?>">
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

                            <?php } ?>

                        </div>
                    </div>


                    <div class="product-detail__info">
                        <h1 class="product-detail__info__title is-desktop"><?php the_title(); ?></h1>
                        <div class="product-detail__info__flex is-desktop">

                            <?php if(get_field('product_arenda_type')){
                                ?>
                                <a href="/arenda-kofemashin/<?php echo esc_attr($product_arenda_type_value); ?>/" class="product-detail__info__flex__item item-text"><?php echo esc_html($product_arenda_type_label); ?></a></li>
                            <?php } ?>


                            <div class="product-detail__info-block__price">

                                <?php //Цена
                                $product_id = $product->get_id();

                                $discounted_price = get_discounted_price($product_id);
                                if ($discounted_price) {

                                    $discounted_price = (float)$discounted_price;
                                    $discounted_price = (int)round($discounted_price);
                                    $discounted_price = number_format($discounted_price, 0, '.', ' ');
                                    ?>

                                    <div class="product-detail__info-block__price__current">
                                        <span class="value"><?php echo $discounted_price; ?></span>
                                        <span class="currency">руб/мес</span>
                                    </div>
                                <?php } ?>

                            </div>

                        </div>
                        <?php /*
                        <div class="product-detail__info-block">
                            <div class="product-detail__info-block__table__wrap">
                                <div class="product-detail__info-block__table">
                                    <div class="product-detail__info-block__table__head">
                                        <div class="product-detail__info-block__table__head__left">
                                            <span class="is-desktop">Технические характеристики</span>
                                            <span class="is-mobile">Тех. характеристики</span>
                                        </div>
                                        <button data-scroll="#product-desc__faq"
                                                class="product-detail__info-block__table__head__right js-smooth-scrolling">
                                            Подробнее
                                        </button>
                                    </div>
                                    <div class="product-detail__info-block__table__body custom-scroll<?php // custom-scroll ?>">

                                        <?php if(get_field('product_arenda_type')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Тип
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php echo esc_html($product_arenda_type_label); ?>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_subtype')){
                                            $product_arenda_subtype = get_field_object('product_arenda_subtype');
                                            $product_arenda_subtype_value = $product_arenda_subtype['value'];
                                            $product_arenda_subtype_label = $product_arenda_subtype['choices'][ $product_arenda_subtype_value ];
                                            ?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Подтип
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php echo esc_html($product_arenda_subtype_label); ?>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_func')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Функции
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    С приготовлением шоколада
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_mark')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Бренд
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_mark');?>
                                                </div>
                                            </div>
                                        <?php } ?>


                                        <?php if(get_field('product_arenda_group')){?>
                                            <?php
                                            $product_arenda_group = get_field_object('product_arenda_group');

                                            $product_arenda_group_value = $product_arenda_group['value'];
                                            $product_arenda_group_label = $product_arenda_group['choices'][ $product_arenda_group_value ];
                                            ?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Количество групп
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php echo $product_arenda_group_label;?>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_group_height')){?>
                                            <?php
                                            $product_arenda_group_height = get_field_object('product_arenda_group_height');

                                            $product_arenda_group_height_value = $product_arenda_group_height['value'];
                                            $product_arenda_group_height_label = $product_arenda_group_height['choices'][ $product_arenda_group_height_value ];
                                            ?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Высота группы
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php echo $product_arenda_group_height_label;?>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_color')){?>
                                            <?php
                                            $product_arenda_color = get_field_object('product_arenda_color');
                                            $product_arenda_color_arr = $product_arenda_color['value'];
                                            ?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Цвет
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php foreach( $product_arenda_color_arr as $key => $color ):
                                                    if( $key > 0){echo ', ';}echo $product_arenda_color['choices'][ $color ];endforeach; ?>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_size')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Размеры
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_size');?>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_weight')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Вес
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_weight');?> кг
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_power')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Мощность
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_power');?> Вт
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if(get_field('product_arenda_power_kvt')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Мощность
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_power_kvt');?> кВт
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_boiler_capacity')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Объём бойлера
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_boiler_capacity');?> л.
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_bunker')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Объём бункера
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_bunker');?> г.
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_millstone_diameter')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Диаметр жерновов
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_millstone_diameter');?> мм.
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_max_height_group')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Max. высота группы
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_max_height_group');?> см.
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_water_capacity')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Объём контейнера для воды
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_water_capacity');?> л.
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_grain_capacity')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Объём контейнера для зёрен
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_grain_capacity');?> г.
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_performance')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Производительность
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_performance');?> чашек/час
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_performance_day')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Производительность
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_performance_day');?> чашек/день
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php if(get_field('product_arenda_voltage')){?>
                                            <div class="product-detail__info-block__table__body__row">
                                                <div class="product-detail__info-block__table__body__row__left">
                                                    Напряжение
                                                </div>
                                                <div class="product-detail__info-block__table__body__row__right">
                                                    <?php the_field('product_arenda_voltage');?>В
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php
                                        if( have_rows('product_arenda_char') ):
                                            while ( have_rows('product_arenda_char') ) : the_row();?>
                                                <div class="product-detail__info-block__table__body__row">
                                                    <div class="product-detail__info-block__table__body__row__left">
                                                        <?php the_sub_field('product_arenda_char_name');?>
                                                    </div>
                                                    <div class="product-detail__info-block__table__body__row__right">
                                                        <?php the_sub_field('product_arenda_char_val');?>
                                                    </div>
                                                </div>
                                            <?php
                                            endwhile;
                                        endif;
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        */ ?>

                        <div class="product-detail__info__btns">

                            <button type="button" class="btn product-detail__info__btns__item btn-buy" onclick="addToCart(<?php echo esc_attr( $product->get_id() ) ?>)">
                                В корзину
                                <span class="icon-preloader" data-preloader="<?php echo $product->get_id();?>" data-title="<?php the_title(); ?>"></span>
                            </button>

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


        <section class="section calc-leasing__section product-detail__calc">
            <div class="container">
                <h2 class="section-title">Калькулятор лизинга</h2>
                <div class="calc-leasing">
                    <div class="calc-leasing__item">
                        <div class="calc-leasing__item__title">
                            Стоимость оборудования
                        </div>
                        <div class="calc-leasing__item__slide">
                            <input type="text" id="calc-leasing-1" name="calc-leasing-1" value="" class="calc-leasing-slide"
                                   data-skin="round"
                                   data-min="100000"
                                   data-max="15000000"
                                   data-from="1400000"
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
                            <div class="calc-leasing__item__slide__avans-price" data-avansPrice="350000">350 000 руб</div>
                            <input type="text" id="calc-leasing-2" name="calc-leasing-2" value="" class="calc-leasing-slide"
                                   data-skin="round"
                                   data-min="0"
                                   data-max="49"
                                   data-from="25"
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
                                   data-from="20"
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
                            <span>63 875</span> руб
                        </div>
                    </div>
                    <div class="calc-leasing-info__item">
                        <div class="calc-leasing-info__item__text">
                            Сумма договора лизинга
                        </div>
                        <div class="calc-leasing-info__item__price calc-leasing-2-result">
                            <span>1 627 500</span> руб
                        </div>
                    </div>
                    <div class="calc-leasing-info__item">
                        <div class="calc-leasing-info__item__text">
                            Налоговая экономия по договору
                        </div>
                        <div class="calc-leasing-info__item__price calc-leasing-3-result">
                            До <span>542 500</span> руб
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="section product-desc__section">
            <div class="container">
                <div id="product-desc__faq" class="product-desc__faq">

                    <?php if(get_field('product_arenda_desc')){//Вывод описания?>
                        <div class="product-desc__faq__item">
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
                            <div class="product-desc__faq__item__content">
                                <?php the_field('product_arenda_desc');?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="product-desc__faq__item">
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
                        <div class="product-desc__faq__item__content">

                            <?php if(get_field('product_arenda_type')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Тип
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php echo esc_html($product_arenda_type_label); ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_func')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Функции
                                    </div>
                                    <div class="product-desc__row__right">
                                        С приготовлением шоколада
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_mark')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Бренд
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_mark');?>
                                    </div>
                                </div>
                            <?php } ?>


                            <?php if(get_field('product_arenda_group')){?>
                                <?php
                                $product_arenda_group = get_field_object('product_arenda_group');

                                $product_arenda_group_value = $product_arenda_group['value'];
                                $product_arenda_group_label = $product_arenda_group['choices'][ $product_arenda_group_value ];
                                ?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Количество групп
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php echo $product_arenda_group_label;?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_group_height')){?>
                                <?php
                                $product_arenda_group_height = get_field_object('product_arenda_group_height');

                                $product_arenda_group_height_value = $product_arenda_group_height['value'];
                                $product_arenda_group_height_label = $product_arenda_group_height['choices'][ $product_arenda_group_height_value ];
                                ?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Высота группы
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php echo $product_arenda_group_height_label;?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_color')){?>
                                <?php
                                $product_arenda_color = get_field_object('product_arenda_color');
                                $product_arenda_color_arr = $product_arenda_color['value'];
                                ?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Цвет
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php foreach( $product_arenda_color_arr as $key => $color ):
                                            if( $key > 0){echo ', ';}echo $product_arenda_color['choices'][ $color ];endforeach; ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_size')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Размеры
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_size');?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_weight')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Вес
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_weight');?> кг
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_power')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Мощность
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_power');?> Вт
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(get_field('product_arenda_power_kvt')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Мощность
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_power_kvt');?> кВт
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_boiler_capacity')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Объём бойлера
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_boiler_capacity');?> л.
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_bunker')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Объём бойлера
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_bunker');?> г.
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_millstone_diameter')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Диаметр жерновов
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_millstone_diameter');?> мм.
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_max_height_group')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Max. высота группы
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_max_height_group');?> см.
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_water_capacity')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Объём контейнера для воды
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_water_capacity');?> л.
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_grain_capacity')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Объём контейнера для зёрен
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_grain_capacity');?> г.
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_performance')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Производительность
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_performance');?> чашек/час
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(get_field('product_arenda_performance_day')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Производительность
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_performance_day');?> чашек/день
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if(get_field('product_arenda_voltage')){?>
                                <div class="product-desc__row">
                                    <div class="product-desc__row__left">
                                        Напряжение
                                    </div>
                                    <div class="product-desc__row__right">
                                        <?php the_field('product_arenda_voltage');?>В
                                    </div>
                                </div>
                            <?php } ?>

                            <?php
                            if( have_rows('product_arenda_char') ):
                                while ( have_rows('product_arenda_char') ) : the_row();?>
                                    <div class="product-desc__row">
                                        <div class="product-desc__row__left">
                                            <?php the_sub_field('product_arenda_char_name');?>
                                        </div>
                                        <div class="product-desc__row__right">
                                            <?php the_sub_field('product_arenda_char_val');?>
                                        </div>
                                    </div>
                            <?php
                                endwhile;
                            endif;
                            ?>

                        </div>
                    </div>


                </div>

                <h2 class="product-desc__title">В стоимость входит:</h2>
                <div class="product-desc__flex product-desc__flex--hide-items-mobile">
                    <div class="product-desc__flex__item">
                        Доставка, установка и демонтаж оборудования, настройка и запуск
                    </div>
                    <div class="product-desc__flex__item">
                        Обучение сотрудников пользованию кофемашиной и приготовлению напитков
                    </div>
                    <div class="product-desc__flex__item">
                        Установка аналогичного оборудования на время ремонта в течение 1 часа
                    </div>
                    <div class="product-desc__flex__item">
                        Обслуживание и замена запчастей в нашем сервисном центре
                    </div>
                    <div class="product-desc__flex__item">
                        Выезд специалиста по требованию 24/7 в выходные и праздники
                    </div>
                    <div class="product-desc__flex__item">
                        Капитальный плановый технический осмотр 1 раз в месяц
                    </div>
                    <div class="product-desc__flex__item">
                        Скидки от партнеров на зерновой кофе и сопутствующие товары
                    </div>
                    <div class="product-desc__flex__item">
                        Скидки от партнеров на зерновой кофе и сопутствующие товары
                    </div>
                    <button class="product-desc__flex__item product-desc__flex__item--last">
                        <i class="icon">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M1.2747 2.36029C1.70256 2.36029 2.04941 2.69865 2.04941 3.11603V3.12467C2.04941 3.54206 1.70256 3.88042 1.2747 3.88042C0.846847 3.88042 0.5 3.54206 0.5 3.12467V3.11603C0.5 2.69865 0.846847 2.36029 1.2747 2.36029ZM4.0415 3.11603C4.0415 2.69865 4.38835 2.36029 4.81621 2.36029H13.7253C14.1532 2.36029 14.5 2.69865 14.5 3.11603C14.5 3.53342 14.1532 3.87178 13.7253 3.87178H4.81621C4.38835 3.87178 4.0415 3.53342 4.0415 3.11603ZM1.2747 6.73282C1.70256 6.73282 2.04941 7.07118 2.04941 7.48857V7.49721C2.04941 7.91459 1.70256 8.25295 1.2747 8.25295C0.846847 8.25295 0.5 7.91459 0.5 7.49721V7.48857C0.5 7.07118 0.846847 6.73282 1.2747 6.73282ZM4.0415 7.48857C4.0415 7.07118 4.38835 6.73282 4.81621 6.73282H13.7253C14.1532 6.73282 14.5 7.07118 14.5 7.48857C14.5 7.90596 14.1532 8.24432 13.7253 8.24432H4.81621C4.38835 8.24432 4.0415 7.90596 4.0415 7.48857ZM1.2747 11.1054C1.70256 11.1054 2.04941 11.4437 2.04941 11.8611V11.8697C2.04941 12.2871 1.70256 12.6255 1.2747 12.6255C0.846847 12.6255 0.5 12.2871 0.5 11.8697V11.8611C0.5 11.4437 0.846847 11.1054 1.2747 11.1054ZM4.0415 11.8611C4.0415 11.4437 4.38835 11.1054 4.81621 11.1054H13.7253C14.1532 11.1054 14.5 11.4437 14.5 11.8611C14.5 12.2785 14.1532 12.6169 13.7253 12.6169H4.81621C4.38835 12.6169 4.0415 12.2785 4.0415 11.8611Z"
                                      fill="#EB6025"/>
                            </svg>
                        </i>
                        <span>Показать еще</span>
                    </button>

                </div>
        </section>

    </main>

<?php get_footer(); ?>
