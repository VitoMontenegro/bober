<section class="section info-block-6__section">
    <div class="container">
        <?php if(get_field('info-block-6_title')){?>
            <h2 class="section-title text-align-left"><?php the_field('info-block-6_title');?></h2>
        <?php } ?>

        <?php if(get_field('info-block-6_text')){?>
            <div class="default-page__text"><?php the_field('info-block-6_text');?></div>
        <?php } ?>



        <?php if( have_rows('info-block-6_item') ): ?>
            <?php while( have_rows('info-block-6_item') ): the_row(); ?>

        <div class="info-block-6">

            <?php if(get_sub_field('info-block-6_item_title')){?>
            <div class="info-block-6__mobile info-block-6__info__title">
                <?php the_sub_field('info-block-6_item_title');?>
            </div>
            <?php } ?>


                <div class="info-block-6__img-wrap"><?php if(get_sub_field('info-block-6_item_img')){
                    $i6_item_image = get_sub_field('info-block-6_item_img');?>
                    <img src="<?php echo esc_url($i6_item_image['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($i6_item_image['alt']); ?>">
                    <?php } ?>
                </div>

            <div class="info-block-6__info">
                <?php if(get_sub_field('info-block-6_item_title')){?>
                <div class="info-block-6__info__title">
                      <?php the_sub_field('info-block-6_item_title');?>
                </div>
                <?php } ?>


                <?php if( have_rows('info-block-6_item_flex') ): ?>
                <div class="info-block-6__info__flex">
                    <?php while( have_rows('info-block-6_item_flex') ): the_row(); ?>
                    <div class="info-block-6__info__flex__item">
                        <?php if(get_sub_field('info-block-6_item_flex_name')){?>
                            <div class="info-block-6__info__flex_title">
                                <div class="name"><?php the_sub_field('info-block-6_item_flex_name');?></div>
                            </div>
                        <?php } ?>
                        <?php if(get_sub_field('info-block-6_item_flex_text')){?>
                            <div class="info-block-6__info__flex_title">
                                <div class="text"><?php the_sub_field('info-block-6_item_flex_text');?></div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php endif;?>


                <div class="info-block-6__info__btns">
                    <?php $i6_link = get_sub_field('info-block-6_item_btn-1');
                    $i6_link_url = $i6_link['url'];
                    $i6_link_title = $i6_link['title'];
                    $i6_link_target = $i6_link['target'] ? $i6_link['target'] : '_self';
                    ?>
                    <a href="<?php echo esc_url($i6_link_url); ?>" class="btn btn-orange info-block-6__info__btns__link" target="<?php echo esc_attr($i6_link_target); ?>">
                        <?php echo esc_html($i6_link_title); ?>
                    </a>
                    <?php if(get_sub_field('info-block-6_item_btn-2')){?>
                    <button class="btn btn-orange info-block-6__info__btns__btn btn-modal-open--contact-form-popup"><?php the_sub_field('info-block-6_item_btn-2');?></button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        <?php endif;?>
    </div>
</section>