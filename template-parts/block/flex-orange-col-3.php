<section class="section flex-orange-col-3__section">
    <div class="container">
        <?php if(get_field('flex-orange-col-3_title')){?>
        <h2 class="section-title"><?php the_field('flex-orange-col-3_title');?></h2>
        <?php } ?>

        <?php if( have_rows('flex-orange-col-3_item') ): ?>
        <div class="flex-orange-col-3">
            <?php while( have_rows('flex-orange-col-3_item') ): the_row(); ?>
            <div class="flex-orange-col-3__item">
                <?php if(get_sub_field('flex-orange-col-3_item_title')){?>
                <a href="<?php the_sub_field('flex-orange-col-3_item_link');?>" class="flex-orange-col-3__item__title text-decoration-none"><?php the_sub_field('flex-orange-col-3_item_title');?></a>
                <?php } ?>

                <?php if(get_sub_field('flex-orange-col-3_item_text')){?>
                <span class="flex-orange-col-3__item__text"><?php the_sub_field('flex-orange-col-3_item_text');?></span>
                <?php } ?>

                <?php if(get_sub_field('flex-orange-col-3_item_img')){
                    $flex_orange_image = get_sub_field('flex-orange-col-3_item_img');?>
                    <a href="<?php the_sub_field('flex-orange-col-3_item_link');?>" class="flex-orange-col-3__item__img-wrap text-decoration-none">
                        <img src="<?php echo esc_url($flex_orange_image['sizes']['medium_large']); ?>" width="340" alt="<?php echo esc_attr($flex_orange_image['alt']); ?>" class="flex-orange-col-3__item__img">
                    </a>
                <?php } ?>

                <?php if(get_sub_field('flex-orange-col-3_item_link_btn')){ ?>
                    <a href="<?php the_sub_field('flex-orange-col-3_item_link_btn');?>" class="product-card__btns__revert">
                        Узнать стоимость
                    </a>
                <?php } ?>

            </div>
            <?php endwhile; ?>
        </div>
        <?php endif;?>
    </div>
</section>
