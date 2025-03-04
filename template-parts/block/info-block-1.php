<section class="section info-block-1__section">
    <div class="container">
        <?php if(get_field('info-block-1_title')){?>
            <h2 class="section-title text-align-left"><?php the_field('info-block-1_title');?></h2>
        <?php } ?>

        <?php if( have_rows('info-block-1_item') ): ?>
        <div class="info-block-1">
            <?php while( have_rows('info-block-1_item') ): the_row();
                $info_block_1_image = get_sub_field('info-block-1_item_img');?>
            <div class="info-block-1__item<?php if(!get_sub_field('info-block-1_item_title')){ echo ' info-block-1__item--without-title'; } ?>">
                <div class="info-block-1__item__preview">
                    <?php if($info_block_1_image){?>
                    <img src="<?php echo esc_url($info_block_1_image['url']); ?>" class="info-block-1__item__preview__img" alt="<?php echo esc_attr($info_block_1_image['alt']); ?>">
                    <?php } ?>
                    <?php if(get_sub_field('info-block-1_item_pos')){?>
                    <div class="info-block-1__item__preview__count"><?php the_sub_field('info-block-1_item_pos');?></div>
                    <?php } ?>
                </div>
                <div class="info-block-1__item__desc">
                    <?php if(get_sub_field('info-block-1_item_title')){?>
                    <div class="info-block-1__item__desc__title">
                        <?php the_sub_field('info-block-1_item_title');?>
                    </div>
                    <?php } ?>
                    <?php if(get_sub_field('info-block-1_item_text')){?>
                    <div class="info-block-1__item__desc__text">
                        <?php the_sub_field('info-block-1_item_text');?>
                    </div>
                    <?php } ?>

                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <?php endif; ?>
    </div>
</section>


