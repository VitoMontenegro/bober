<section class="section advantages-block-1__section">
    <div class="container">
        <?php if(get_field('advantages-block-1_title')){?>
            <h2 class="section-title"><?php the_field('advantages-block-1_title');?></h2>
        <?php } ?>


        <?php if( have_rows('advantages-block-1_item') ): ?>
        <div class="advantages-block-1">
            <?php while( have_rows('advantages-block-1_item') ): the_row(); ?>
            <div class="advantages-block-1__item">
                <div class="advantages-block-1__item__preview">
                    <?php if(get_sub_field('advantages-block-1_item_img_text')){?>
                    <div class="advantages-block-1__item__preview__text">
                        <?php the_sub_field('advantages-block-1_item_img_text');?>
                    </div>
                    <?php } ?>
                    <?php
                    $advantages_block_1_image = get_sub_field('advantages-block-1_item_img');?>
                    <?php if( !empty($advantages_block_1_image) ){ ?>
                        <img src="<?php echo $advantages_block_1_image['url']; ?>"  class="advantages-block-1__item__preview__img">
                    <?php } ?>
                </div>
                <?php if(get_sub_field('advantages-block-1_item_text')){?>
                <div class="advantages-block-1__item__text">
                    <?php the_sub_field('advantages-block-1_item_text');?>
                </div>
                <?php } ?>
            </div>

            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>