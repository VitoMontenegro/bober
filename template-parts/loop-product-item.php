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

        <?php //Инфо про Категории
//        $terms = get_the_terms(get_the_ID(), 'product_type');
//        if (!empty($terms)) {
//            foreach ($terms as $key => $term) {
//                // Проверяем, есть ли у рубрики потомки
//                $children = get_term_children($term->term_id, 'product_type');
//                if (!empty($children)) {
//                    continue;
//                }
//
//                $category_short_name = get_field('category_short-name', $term);
//                // поле 'category_short-name' заполнено, выводим его, иначе выводим обычное имя рубрики
//                $name_to_display = $category_short_name ? $category_short_name : $term->name;
//                ?>
<!--                <span class="product-card__attr__item">--><?php //echo esc_html($name_to_display) . ' '; ?><!--</span>-->
<!--                --><?php
//            }
//        }
        ?>

        <?php $product_cat = wp_get_post_terms(get_the_ID(), 'product_cat');?>
        <span class="product-card__attr__item">
            <?php
            $product_name = $product_cat[0]->name;
            $product_name = str_replace('.', '.<wbr>', $product_name);
            echo $product_name;
            ?>
        </span>



    </div>

    <div class="product-card__price">
        <?php if($GLOBALS['page-template'] == 'calculator'){?>
            <div class="product-card__price__real"><span class="price">55 125</span> <span class="currency">₽ / Мес</span></div>
<!--            <div class="product-card__price__old">2 000 <span class="currency">₽ / Мес</span></div>-->
        <?php } else { ?>

            <?php //Цена

            global $product;
            //Цена
            $regular_price = $product->get_regular_price();
            if (!empty($regular_price) || $regular_price == 0) {
            $formatted_price = (float)$regular_price;
            $formatted_price = (int)round($formatted_price);
            $formatted_price = number_format($formatted_price, 0, '.', ' ');

            $product_id = $product->get_id();

            //Цена за
            if(get_field('production_price_currency') == 'package'){
                $currency_value = 'руб/уп';//Упаковку
            } elseif(get_field('production_price_currency') == 'rub'){
                $currency_value = 'руб';//Упаковку
            } else {
                $currency_value = 'руб/шт';//Штуку
            }

            $discounted_price = get_discounted_price($product_id);
            $discounted_price = (float)$discounted_price;
            $discounted_price = (int)round($discounted_price);
            $discounted_price = number_format($discounted_price, 0, '.', ' ');


            ?>

            <div class="product-card__price__real">
                <span class="price"><?php echo $discounted_price; ?></span>
                <span class="currency"><?php echo $currency_value;?></span>
            </div>

            <?php if (get_discounted_price($product_id) < $regular_price) {?>
                <div class="product-card__price__old">
                    <span class="price"><?php echo $formatted_price; ?></span>
                    <span class="currency"><?php echo $currency_value;?></span>
                </div>
            <?php } ?>
            <?php } ?>

        <?php } ?>
    </div>


    <?php if($GLOBALS['page-template'] == 'calculator'){?>
    <div class="product-card__btns">
        <a href="<?php the_permalink(); ?>" class="product-card__btns__main">Подробнее</a>

        <?php if(get_field('option_soc_whatsapp', 'option')) { ?>
        <a href="<?php the_field('option_soc_whatsapp', 'option'); ?>" class="product-card__btns__whatsapp" target="_blank">
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7047 3.3777C15.8148 1.55757 13.2999 0.528083 10.675 0.5C8.04911 0.5 5.53076 1.5422 3.67396 3.39732C1.81716 5.25245 0.774026 7.76854 0.774026 10.3921C0.773588 12.1345 1.23975 13.8454 2.12416 15.3471L0.666016 20.5L5.98555 19.1511C7.45036 19.9481 9.09738 20.3509 10.765 20.3201C12.0652 20.3201 13.3527 20.0643 14.554 19.5672C15.7552 19.07 16.8467 18.3414 17.7661 17.4228C18.6855 16.5043 19.4148 15.4138 19.9123 14.2136C20.4099 13.0134 20.666 11.7271 20.666 10.4281C20.6023 7.79375 19.537 5.28252 17.6867 3.40468L17.7047 3.3777ZM14.3204 12.0737C14.6804 12.2536 15.0405 12.4335 15.1755 12.4784L15.1845 12.4964C15.3579 12.5575 15.5406 12.5879 15.7245 12.5863C15.7188 12.9825 15.6583 13.3759 15.5445 13.7554C15.1247 14.3287 14.5212 14.7412 13.8343 14.9245C13.3249 15.0239 12.7985 14.9929 12.3042 14.8345C12.1242 14.7446 11.9216 14.6772 11.6854 14.5985C11.4491 14.5198 11.1791 14.4299 10.864 14.295C9.1206 13.502 7.64707 12.2174 6.62461 10.5989C6.06049 9.86796 5.717 8.99127 5.63451 8.07194C5.61939 7.68177 5.69246 7.29322 5.84829 6.93514C6.00411 6.57706 6.2387 6.25866 6.5346 6.0036C6.70487 5.84021 6.92882 5.74432 7.16467 5.73381H7.61471C7.79473 5.73381 7.88474 5.73381 8.15476 6.18345C8.42479 6.63309 8.96485 7.80216 8.96485 7.98201C8.96485 8.04573 8.97614 8.09816 8.98673 8.14729C9.00603 8.23687 9.02297 8.31551 8.96485 8.43165C8.91984 8.52158 8.87484 8.58903 8.82983 8.65647C8.78483 8.72392 8.73982 8.79137 8.69482 8.88129C8.5975 9.04799 8.47619 9.19949 8.33478 9.33093C8.31322 9.37403 8.28648 9.41196 8.26077 9.44844C8.17918 9.56421 8.10789 9.66536 8.24477 9.8705C8.57808 10.5231 9.03687 11.1038 9.59491 11.5791C10.1431 12.153 10.8226 12.5851 11.5751 12.8381C11.8451 12.9281 11.9351 12.9281 12.1152 12.7482C12.4069 12.4369 12.6776 12.1064 12.9252 11.759C13.1053 11.5791 13.1953 11.5791 13.4653 11.6691C13.6003 11.714 13.9603 11.8939 14.3204 12.0737Z" fill="#25D366" />
            </svg>
        </a>
        <?php } ?>
    </div>
    <?php } else { ?>
        <div class="product-card__btns">
            <a href="<?php the_permalink(); ?>" class="product-card__btns__main product-card__btns__main--catalog">Подробнее</a>

            <button type="button" class="product-card__btns__main--buy btn-buy" onclick="addToCart(<?php echo esc_attr( $product_id ) ?>)">
                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 50 50" fill="none" class="header__flex__right__cart__svg__cart">
                    <path d="M31.722 33.1607C29.7952 33.1589 28.2318 34.6885 28.2299 36.5771C28.228 38.4656 29.7885 39.9981 31.7152 40C33.642 40.0018 35.2054 38.4723 35.2073 36.5837C35.2073 36.5826 35.2073 36.5815 35.2073 36.5804C35.2055 34.6938 33.6466 33.1644 31.722 33.1607Z" fill="#EB6025"></path>
                    <path d="M37.9097 16.7858C37.8263 16.7699 37.7414 16.7619 37.6564 16.7618H16.4148L16.0783 14.5556C15.8687 13.0905 14.5902 12.0005 13.0808 12H10.3457C9.60247 12 9 12.5905 9 13.319C9 14.0475 9.60247 14.6381 10.3457 14.6381H13.0842C13.2553 14.6369 13.4001 14.7617 13.4206 14.9283L15.493 28.8508C15.7771 30.6199 17.3295 31.925 19.1566 31.9308H33.1551C34.9142 31.933 36.4317 30.7212 36.7851 29.0322L38.9752 18.3314C39.1164 17.6162 38.6394 16.9242 37.9097 16.7858Z" fill="#EB6025"></path>
                    <path d="M23.1755 36.4339C23.0936 34.6007 21.5501 33.1576 19.6781 33.164C17.7529 33.2403 16.2553 34.8319 16.3331 36.7189C16.4077 38.5296 17.9104 39.9688 19.7588 40H19.8429C21.7678 39.9173 23.2598 38.3207 23.1755 36.4339Z" fill="#EB6025"></path>
                </svg>
                <span class="icon-preloader" data-preloader="<?php echo $product->get_id();?>" data-title="<?php the_title(); ?>"></span>
            </button>

        </div>
    <?php } ?>
</div>