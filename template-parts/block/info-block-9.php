<section class="section info-block-9__section">
    <div class="container">

        <?php if(get_field('info-block-9_title')){?>
            <h2 class="section-title text-align-left"><?php the_field('info-block-9_title');?></h2>
        <?php } ?>

        <?php if( have_rows('info-block-9_item') ): ?>
        <div class="info-block-9">
            <?php while( have_rows('info-block-9_item') ): the_row(); ?>
            <div class="info-block-9__item">
                <?php if(get_sub_field('info-block-9_item_text')){?>
                    <div class="info-block-9__item__text">
                        <?php the_sub_field('info-block-9_item_text');?>
                    </div>
                <?php } ?>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif;?>

    </div>
</section>