
<section class="section flex-ver-blocks__section">
    <div class="container">

        <?php if(get_field('flex-orange-col-2_title')){?>
            <h2 class="section-title text-align-left"><?php the_field('flex-orange-col-2_title');?></h2>
        <?php } ?>

        <?php if( have_rows('flex-orange-col-2_item') ): ?>
        <div class="flex-orange-col-2_wrap">
            <?php while( have_rows('flex-orange-col-2_item') ): the_row(); ?>
                <div class="flex-orange-col-2_item content">
                    <?php if(get_sub_field('flex-orange-col-2_item_title')){?>
                        <h3><?php the_sub_field('flex-orange-col-2_item_title');?></h3>
                    <?php } ?>
                    <?php if(get_sub_field('flex-orange-col-2_item_text')){?>
                        <p><?php the_sub_field('flex-orange-col-2_item_text');?></p>
                    <?php } ?>
                </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
