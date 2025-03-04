<div class="section banner-3__section">
    <div class="container">
        <?php if( have_rows('banner-3_item') ): ?>
        <div class="banner-3">
            <?php while( have_rows('banner-3_item') ): the_row(); ?>
                <?php if(get_sub_field('banner-3_item_text')){?>
                    <div class="banner-3__side">
                        <?php the_sub_field('banner-3_item_text');?>
                    </div>
                <?php } ?>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</div>