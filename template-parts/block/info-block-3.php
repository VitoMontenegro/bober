<section class="section info-block-3__section">
    <div class="container">
        <?php if (get_field('info-block-3_title')){?>
        <h2 class="section-title text-align-left"><?php the_field('info-block-3_title');?></h2>
        <?php } ?>
        <?php if (get_field('info-block-3_text')){?>
        <div class="default-page__text">
            <?php the_field('info-block-3_text');?>
        </div>
        <?php } ?>

        <?php if( have_rows('info-block-3_item') ): ?>

        <div class="info-block-3">
            <div class="info-block-3__side">

                <?php while( have_rows('info-block-3_item') ): the_row(); ?>
                    <?php if(get_sub_field('info-block-3_item_text_left') || get_sub_field('info-block-3_item_img_left')){?>
                        <div class="info-block-3__side__item">
                            <div>
                        <?php the_sub_field('info-block-3_item_text_left');?>
                            </div>
                            <?php if(get_sub_field('info-block-3_item_img_left')){
                                $infoblock_3_left_img = get_sub_field('info-block-3_item_img_left');?>
                                <div class="info-block-3__side__item_img-wrap">
                                <img src="<?php echo esc_url($infoblock_3_left_img['url']); ?>"alt="<?php echo esc_attr($infoblock_3_left_img['alt']); ?>" class="info-block-3__side__item__img" width="200">
                                </div>
                            <?php } ?>

                        </div>
                    <?php } ?>
                <?php endwhile; ?>

            </div>
            <div class="info-block-3__side">

                <?php while( have_rows('info-block-3_item') ): the_row(); ?>
                    <?php if(get_sub_field('info-block-3_item_text_right') || get_sub_field('info-block-3_item_img_right')){?>
                        <div class="info-block-3__side__item">
                        <div>
                            <?php the_sub_field('info-block-3_item_text_right');?>
                        </div>
                            <?php if(get_sub_field('info-block-3_item_img_right')){
                                $infoblock_3_right_img = get_sub_field('info-block-3_item_img_right');?>
                                <div class="info-block-3__side__item_img-wrap">
                                <img src="<?php echo esc_url($infoblock_3_right_img['url']); ?>"alt="<?php echo esc_attr($infoblock_3_right_img['alt']); ?>" class="info-block-3__side__item__img" width="200">
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php endwhile; ?>

            </div>
        </div>

        <?php endif; ?>

    </div>
</section>