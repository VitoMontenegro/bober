<section class="section flex-partners__section">
    <div class="container">
        <?php if(get_field('flex-partners_title_desktop')){?>
            <h2 class="section-title<?php if(get_field('flex-partners_title_mobile')){echo' is-desktop';}?>"><?php the_field('flex-partners_title_desktop');?></h2>
            <?php if(get_field('flex-partners_title_dmobile')){?>
            <div class="section-title is-mobile"><?php the_field('flex-partners_title_mobile');?></div>
            <?php } ?>
        <?php } ?>

        <?php if( have_rows('flex-partners') ): ?>
            <div class="flex-partners">
                <?php while( have_rows('flex-partners') ): the_row(); ?>
                <div class="flex-partners__item">
                    <?php if( have_rows('flex-partners_item_left') ){ ?>
                            <?php while( have_rows('flex-partners_item_left') ){ the_row(); ?>
                            <h3 class="flex-partners__item__title">
                                <?php the_sub_field('flex-partners_item_title');?>
                            </h3>
                            <div class="flex-partners__item__text">
                                <?php the_sub_field('flex-partners_item_text');?>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <?php $images_flex_partners = get_sub_field('flex-partners_item_gallery');
                    if( $images_flex_partners ): ?>
                    <div class="flex-partners__item__links items-hide">
                        <?php $count=0;?>
                            <?php foreach( $images_flex_partners as $image ): ?>
                                    <div class="flex-partners__item__links__item">
                                        <img src="<?php echo $image;?>" class="flex-partners__item__links__item__img" alt="партнёр">
                                    </div>
                            <?php $count++;?>
                            <?php endforeach; ?>
                        <?php if ($count > 9){?>
                        <div class="flex-partners__item__links__item flex-partners__item__links__item--last">
                            <span class="num"><?php echo $count;?>+</span>
                        </div>
                        <?php } ?>
                        </div>
                    <?php endif; ?>

                </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    </div>
</section>