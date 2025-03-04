<section class="section banner-1__section">
    <div class="container">
        <?php if(get_field('banner-1_title')){?>
            <h2 class="section-title"><?php the_field('banner-1_title');?></h2>
        <?php } ?>

        <?php if( have_rows('banner-1_item') ):
            $count_col = count(get_field('banner-1_item'));
            if ($count_col > 3){$count_col = 3;}
            ?>
        <div class="banner-1 banner-1__decoration banner-1--col-<?php echo $count_col;?>">
            <?php while( have_rows('banner-1_item') ): the_row(); ?>
                <?php if(get_sub_field('banner-1_item_text')){?>
                    <div class="banner-1__item">
                        <?php the_sub_field('banner-1_item_text');?>
                    </div>
                <?php } ?>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>