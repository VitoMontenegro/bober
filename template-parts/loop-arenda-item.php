<div class="product-card">
    <div class="product-card__preview">
        <a href="<?php the_permalink(); ?>" class="product-card__preview__img-wrap">
            <?php if (get_the_post_thumbnail_url()){?>
                <img src="<?php echo the_post_thumbnail_url();?>" class="product-card__preview__img" alt="<?php the_title(); ?>">
            <?php } ?>
        </a>
        <span class="product-card__preview__stickers">
            <span class="product-card__preview__stickers__wish btn-modal-open--wish-add wish-btn item-card__btn-wish<?php if(getCookiesArr()){if (in_array(get_the_ID(), getCookiesArr())) { echo ' active'; }} ?>" data-id="<?php echo get_the_ID(); ?>" data-title="<?php the_title();?>">
                <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect width="34" height="34" rx="17" fill="#FFE4D9" />
                  <path d="M17.8631 23.8031C17.5218 24.0239 17.2285 24.2048 17.0033 24.3402C16.7777 24.2028 16.4835 24.0193 16.1409 23.7953C15.3189 23.258 14.228 22.4944 13.142 21.5849C12.0512 20.6715 10.9945 19.6351 10.2177 18.5566C9.43332 17.4675 9 16.4268 9 15.4838C9 13.2669 10.7609 11.5002 12.896 11.5002V11.5002L12.904 11.5001C14.2096 11.4898 15.4379 12.158 16.1569 13.2854C16.3401 13.5726 16.6568 13.7468 16.9974 13.7477C17.338 13.7486 17.6556 13.5761 17.8403 13.2899C18.5657 12.1657 19.7934 11.4973 21.1003 11.5001C23.2326 11.5114 24.9881 13.2728 25 15.4862C24.9993 16.4497 24.5635 17.4996 23.7815 18.5886C23.0055 19.6692 21.9497 20.7026 20.8598 21.6109C19.7747 22.5152 18.6846 23.2716 17.8631 23.8031Z" stroke="#EB6025" stroke-width="2" stroke-linejoin="round" />
                </svg>
            </span>
        </span>
    </div>

    <a href="<?php the_permalink(); ?>" class="product-card__title">
        <?php the_title(); ?>
    </a>

    <div class="product-card__attr">

        <?php if (get_field('product_arenda_type',get_the_ID())){
            $product_arenda_type = get_field_object('product_arenda_type',get_the_ID());
            $product_arenda_type_value = $product_arenda_type['value'];
            $product_arenda_type_label = $product_arenda_type['choices'][ $product_arenda_type_value ];
            ?>
            <span class="product-card__attr__item">
                <?php echo esc_html($product_arenda_type_label);
                if (get_field('product_arenda_subtype',get_the_ID())){
                    $product_arenda_subtype = get_field_object('product_arenda_subtype',get_the_ID());
                    $product_arenda_subtype_value = $product_arenda_subtype['value'];
                    $product_arenda_subtype_label = $product_arenda_subtype['choices'][ $product_arenda_subtype_value ];
                    echo ', ' . esc_html($product_arenda_subtype_label); ?>
                <?php } ?>
            </span>
        <?php } ?>

    </div>

    <div class="product-card__price">

        <?php if($GLOBALS['page-template'] == 'calculator'){?>
            <div class="product-card__price__real"><span class="price">55 125</span> <span class="currency">₽ / Мес</span></div>
            <!--            <div class="product-card__price__old">2 000 <span class="currency">₽ / Мес</span></div>-->
        <?php } else { ?>

        <?php //Цена

        $discounted_price = get_field('product_arenda_price',get_the_ID());
        if ($discounted_price) {

            $discounted_price = (float)$discounted_price;
            $discounted_price = (int)round($discounted_price);
            $discounted_price = number_format($discounted_price, 0, '.', ' ');
            ?>

            <div class="product-card__price__real">
                <span class="price"><?php echo $discounted_price; ?></span>
                <span class="currency">руб/мес</span>
            </div>
        <?php } ?>

        <?php } ?>

    </div>

    <div class="product-card__btns">
        <a href="<?php the_permalink(); ?>" class="product-card__btns__main product-card__btns__main--catalog">Подробнее</a>
    </div>
</div>