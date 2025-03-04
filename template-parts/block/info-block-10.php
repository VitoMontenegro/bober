<section class="section info-block-10__section">
    <div class="container">
        <div class="info-block-10">

            <?php if( have_rows('info-block-10_short') ): ?>
            <div class="info-block-10__item info-block-10__item--short">
                <?php while( have_rows('info-block-10_short') ): the_row(); ?>
                <div class="info-block-10__item__left">
                        <?php the_sub_field('info-block-10_short_left');?>
                </div>
                <div class="info-block-10__item__right">
                        <?php the_sub_field('info-block-10_short_right');?>
                </div>
                <?php endwhile; ?>
            </div>
            <?php endif;?>

            <?php if( have_rows('info-block-10_long') ): ?>
            <div class="info-block-10__item info-block-10__item--long">
                <?php while( have_rows('info-block-10_long') ): the_row(); ?>
                <div class="info-block-10__item__left">
                        <?php the_sub_field('info-block-10_long_left');?>
                </div>
                <div class="info-block-10__item__right">
                        <?php the_sub_field('info-block-10_long_right');?>
                </div>
                <?php endwhile; ?>
            </div>
            <?php endif;?>

            <?php if(get_field('info-block-10_text')){?>
            <div class="info-block-10__item info-block-10__item--desc">
                <?php the_field('info-block-10_text');?>
            </div>
            <?php } ?>
        </div>
    </div>
</section>