<section class="section info-block-4__section">
    <div class="container">

        <?php if(get_field('info-block-4_title')){?>
            <h2 class="section-title text-align-left"><?php the_field('info-block-4_title');?></h2>
        <?php } ?>

        <div class="info-block-4">
            <?php if( have_rows('info-block-4_ul') ): ?>
            <div class="info-block-4__left">
                <ul class="info-block-4__ul">
                    <?php while( have_rows('info-block-4_ul') ): the_row(); ?>
                        <?php if(get_sub_field('info-block-4_ul_li')){?>

                            <?php //С изображением?>
                            <?php if(get_sub_field('info-block-4_ul_li_img')){
                                $flex_orange_col_3_image = get_sub_field('info-block-4_ul_li_img');
                                ?>
                                <li class="info-block-4__ul__li--with-img">
                                    <img src="<?php echo esc_url($flex_orange_col_3_image['url']); ?>" width="50" alt="<?php echo esc_attr($flex_orange_col_3_image['alt']); ?>" class="info-block-4__ul__li__img">
                                    <?php the_sub_field('info-block-4_ul_li');?>
                                </li>
                            <?php } else { //Без изображения?>
                            <li>
                                <?php the_sub_field('info-block-4_ul_li');?>
                            </li>
                            <?php } ?>
                        <?php } ?>
                    <?php endwhile; ?>
                </ul>
            </div>
            <?php endif; ?>

            <div class="info-block-4__right">
                <?php if(get_field('info-block-4_info')){?>
                <div class="info-block-4__info"><?php the_field('info-block-4_info');?></div>
                <?php } ?>
                <?php the_field('info-block-4_text');?>
            </div>
        </div>
    </div>
</section>