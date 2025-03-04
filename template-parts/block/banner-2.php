<section class="section banner-2__section">
    <div class="container">
        <?php
        $banner_2_img = get_field('banner-2_img');
        $banner_2_bcg_img = get_field('banner-2_bcg-img');?>
        <div class="banner-2<?php if (empty( $banner_2_img ) && empty( $banner_2_bcg_img )){echo' banner-2--without-img';}?>">
            <div class="banner-2__info">

                <?php if(get_field('banner-2_title')){?>
                    <h2 class="banner-2__info__title"><?php the_field('banner-2_title');?></h2>
                <?php } ?>
                <?php if(get_field('banner-2_text')){?>
                    <div class="banner-2__info__text"><?php the_field('banner-2_text');?></div>
                <?php } ?>

            </div>
            <div class="banner-2__img-wrap">
                <?php if( !empty( $banner_2_img ) ): ?>
                    <img src="<?php echo esc_url($banner_2_img['url']); ?>" alt="<?php echo esc_attr($banner_2_img['alt']); ?>" class="banner-2__img">
                <?php endif; ?>
                <?php if( !empty( $banner_2_bcg_img ) ): ?>
                    <img src="<?php echo esc_url($banner_2_bcg_img['url']); ?>" alt="<?php echo esc_attr($banner_2_bcg_img['alt']); ?>" class="banner-2__bcg-img">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>