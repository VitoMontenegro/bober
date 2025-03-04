<section class="section block-text-slider__section">
    <div class="container">
        <div class="block-text-slider">
            <div class="block-text-slider__desc">
                <?php if(get_field('block-text-slider_title')){?>
                    <h2 class="block-text-slider__desc__title"><?php the_field('block-text-slider_title');?></h2>
                <?php } ?>

                <?php if(get_field('block-text-slider_text')){?>
                <div class="block-text-slider__desc__text"><?php the_field('block-text-slider_text');?></div>
                <?php } ?>
            </div>

            <?php
            $block_text_slider = get_field('block-text-slider_gallery');
            //$size = 'full'; // (thumbnail, medium, large, full or custom size)
            if( $block_text_slider ): ?>
                <div class="block-text-slider__slider-wrap">
                    <div class="slider-default block-text-slider__slider owl-carousel">
                        <?php foreach( $block_text_slider as $item ): ?>

                            <a href="<?php echo esc_url($item['url']); ?>" class="slider-default__item block-text-slider__slider__item" data-fancybox="gallery_cert">
                                <img src="<?php echo esc_url($item['url']); ?>" alt="<?php echo esc_attr($item['alt']); ?>">
                            </a>

                        <?php endforeach; ?>

                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
