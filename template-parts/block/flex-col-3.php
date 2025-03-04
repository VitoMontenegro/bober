<section class="section default-block__section flex-col-3__section decoration_5">
    <div class="container">
        <?php if(get_field('flex-col-3_title_desktop')){?>
            <h2 class="section-title<?php if(get_field('flex-col-3_title_mobile')){echo' is-desktop';}?>"><?php the_field('flex-col-3_title_desktop');?></h2>
            <?php if(get_field('flex-col-3_title_mobile')){?>
            <div class="section-title is-mobile"><?php the_field('flex-col-3_title_mobile');?></div>
            <?php } ?>
        <?php } ?>
        <?php if(get_field('flex-col-3_text')){?>
            <div class="default-block__text">
                <?php the_field('flex-col-3_text');?>
            </div>
        <?php } ?>

        <?php
        $images_flex_col_3 = get_field('flex-col-3_gallery');
        if( $images_flex_col_3 ): ?>
            <div class="flex-col-3">
                <?php foreach( $images_flex_col_3 as $image ): ?>
                    <div class="flex-col-3__item">
                        <img src="<?php echo $image; ?>" class="flex-col-3__item__img" alt="изображение">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
