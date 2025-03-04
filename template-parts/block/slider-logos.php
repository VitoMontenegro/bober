<section class="section slider-logos__section">
    <div class="container">

        <?php if(get_field('slider-logos_title')){?>
            <h2 class="section-title text-align-left"><?php the_field('slider-logos_title');?></h2>
        <?php } ?>
        <?php if(get_field('slider-logos_text')){?>
        <div class="default-page__text"><?php the_field('slider-logos_text');?></div>
        <?php } ?>
    </div>

    <?php
    $slider_logo = get_field('slider-logos_gallery');
    //$size = 'full'; // (thumbnail, medium, large, full or custom size)
    if( $slider_logo ): ?>
        <div class="slider-logos__container">
            <div class="slider-default slider-logos owl-carousel">
                <?php foreach( $slider_logo as $item ): ?>
                    <div class="slider-logos__item">
                        <img src="<?php echo esc_url($item['url']); ?>" class="slider-logos__item__img" alt="<?php echo esc_attr($item['alt']); ?>" />

                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    <?php endif; ?>

</section>
