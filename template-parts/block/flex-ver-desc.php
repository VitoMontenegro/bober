<section class="section flex-ver-desc__section">
    <div class="container">
        <?php if(get_field('flex-ver-desc_title')){?>
            <h2 class="section-title text-align-left"><?php the_field('flex-ver-desc_title');?></h2>
        <?php } ?>
        <?php if(get_field('flex-ver-desc_text')){?>
            <div class="default-page__text">
                <?php the_field('flex-ver-desc_text');?>
            </div>
        <?php } ?>
        <?php if( have_rows('flex-ver-desc_item') ): ?>
            <div class="flex-ver-desc flex-ver-desc--col-2">
                <?php while( have_rows('flex-ver-desc_item') ): the_row(); ?>
                    <div class="flex-ver-desc__item content">
                        <?php if(get_sub_field('flex-ver-desc_item_title')){?>
                            <h3>Выполняем уникальные виды работ</h3>
                        <?php } ?>
                    <?php the_sub_field('flex-ver-desc_item_content');?>
                        <?php
                        $images = get_sub_field('flex-ver-desc_item_gallery');
                        if( $images ): ?>
                            <div class="flex-ver-desc__item__gallery">
                                <?php foreach( $images as $image ): ?>
                                    <img src="<?php echo  wp_get_attachment_image_src($image, 'medium')[0]; ?>" class="flex-ver-desc__item__gallery__img" />
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    </div>

                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>