
<section class="section flex-ver-blocks__section">
    <div class="container">

        <?php if(get_field('flex-ver-blocks_title')){?>
            <h2 class="section-title text-align-left"><?php the_field('flex-ver-blocks_title');?></h2>
        <?php } ?>

        <?php if(get_field('flex-ver-blocks_text')){?>
            <div class="default-page__text">
                <?php the_field('flex-ver-blocks_text');?>
            </div>
        <?php } ?>
        <?php if( have_rows('flex-ver-blocks_item') ): ?>
        <div class="flex-ver-blocks flex-ver-blocks--col-<?php the_field('flex-ver-blocks_col');?><?php if(get_sub_field('flex-ver-blocks_item_img')){echo' flex-ver-blocks--with-img';} ?>">
            <?php while( have_rows('flex-ver-blocks_item') ): the_row(); ?>
                <?php if(get_sub_field('flex-ver-blocks_item_link')){//если ссылка заполнена?>
                        <a href="<?php the_sub_field('flex-ver-blocks_item_link');?>" class="flex-ver-blocks__item content">
                            <?php if(get_sub_field('flex-ver-blocks_item_title')){?>
                                <h3><?php the_sub_field('flex-ver-blocks_item_title');?></h3>
                            <?php } ?>
                            <?php if(get_sub_field('flex-ver-blocks_item_text')){?>
                                <p><?php the_sub_field('flex-ver-blocks_item_text');?></p>
                            <?php } ?>
                            <?php if(get_sub_field('flex-ver-blocks_item_img')){
                                $flex_ver_blocks_img = get_sub_field('flex-ver-blocks_item_img');?>
                                <span class="flex-ver-blocks__item__img-wrap">
                                    <img src="<?php echo esc_url($flex_ver_blocks_img['sizes']['medium_large']); ?>" width="340" alt="<?php echo esc_attr($flex_ver_blocks_img['alt']); ?>" class="flex-ver-blocks__item__img">
                                </span>
                            <?php } ?>
                        </a>
                <?php } else { //иначе, обычный блок?>
                        <div class="flex-ver-blocks__item content">
                            <?php if(get_sub_field('flex-ver-blocks_item_title')){?>
                                <h3><?php the_sub_field('flex-ver-blocks_item_title');?></h3>
                            <?php } ?>
                            <?php if(get_sub_field('flex-ver-blocks_item_text')){?>
                                <p><?php the_sub_field('flex-ver-blocks_item_text');?></p>
                            <?php } ?>
                            <?php if(get_sub_field('flex-ver-blocks_item_img')){
                                $flex_ver_blocks_img = get_sub_field('flex-ver-blocks_item_img');?>
                                <span class="flex-ver-blocks__item__img-wrap">
                                    <img src="<?php echo esc_url($flex_ver_blocks_img['sizes']['medium_large']); ?>" width="340" alt="<?php echo esc_attr($flex_ver_blocks_img['alt']); ?>" class="flex-ver-blocks__item__img">
                                </span>
                            <?php } ?>
                        </div>
                <?php } ?>

            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>