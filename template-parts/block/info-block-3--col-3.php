<section class="section info-block-3__section info-block-3--col-3__section">
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

            <div class="info-block-3 info-block-3--col-3 info-block-3--grid">

            <?php //<div class="info-block-3__side">wrap</div>?>

                <?php while( have_rows('info-block-3_item') ): the_row(); ?>
                    <?php if(get_sub_field('info-block-3_item_text_left')){?>
                        <div class="info-block-3__side__item">
                            <?php the_sub_field('info-block-3_item_text_left');?>
                        </div>
                    <?php } ?>
                <?php endwhile; ?>

                <?php while( have_rows('info-block-3_item') ): the_row(); ?>
                    <?php if(get_sub_field('info-block-3_item_text_mid')){?>
                        <div class="info-block-3__side__item">
                            <?php the_sub_field('info-block-3_item_text_mid');?>
                        </div>
                    <?php } ?>
                <?php endwhile; ?>

                <?php while( have_rows('info-block-3_item') ): the_row(); ?>
                    <?php if(get_sub_field('info-block-3_item_text_right')){?>
                        <div class="info-block-3__side__item">
                            <?php the_sub_field('info-block-3_item_text_right');?>
                        </div>
                    <?php } ?>
                <?php endwhile; ?>

            </div>

        <?php endif; ?>

    </div>
</section>