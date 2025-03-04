<section class="section info-block-8__section">
    <div class="container">
        <div class="info-block-8">
            <div class="info-block-8__left">
                <?php if(get_field('info-block-8_left_title')){?>
                    <h2 class="section-title"><?php the_field('info-block-8_left_title');?></h2>
                <?php } ?>

                <?php if(get_field('info-block-8_left_text')){?>
                    <div class="info-block-8__left__text"><?php the_field('info-block-8_left_text');?></div>
                <?php } ?>
            </div>
            <div class="info-block-8__right">
                <img src="<?php echo get_template_directory_uri(); ?>/images/info-block-8_bcg.svg" alt="icon" class="info-block-8__right__background">
            </div>
        </div>

        <?php if(get_field('info-block-8_right_title') || get_field('info-block-8_right_text')){?>
        <div class="info-block-8__bottom">
            <div class="info-block-8__bottom__wrap">
                <?php if(get_field('info-block-8_right_title')){?>
                    <div class="info-block-8__bottom__title"><?php the_field('info-block-8_right_title');?></div>
                <?php } ?>
                <?php if(get_field('info-block-8_right_text')){?>
                    <div class="info-block-8__bottom__text"><?php the_field('info-block-8_right_text');?></div>
                <?php } ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/info-block-8_bcg.svg" alt="icon" class="info-block-8__bottom__background">
            </div>
        </div>
        <?php } ?>

    </div>
</section>
