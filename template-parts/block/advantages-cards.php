<section class="section advantages-cards__section decoration_3">
    <div class="container">
        <?php if(get_field('advantages-cards_title')){?>
        <h2 class="section-title"><?php the_field('advantages-cards_title');?></h2>
        <?php } ?>
        <?php if(get_field('advantages-cards_ext')){?>
            <div class="default-block__text">
                <?php the_field('advantages-cards_ext');?>
            </div>
        <?php } ?>

        <?php if( have_rows('advantages-cards_item') ): ?>
        <div class="advantages-cards advantages-cards--col-<?php the_field('advantages-cards_col'); ?><?php if(get_field('advantages-cards_justify-content')){echo' advantages-cards--justify-content-flex-start';}?><?php if(get_field('advantages-cards_padding-icon')){echo' advantages-cards--padding-icon';}?>">
            <?php $count=0;?>
            <?php while( have_rows('advantages-cards_item') ): the_row(); ?>

                <div class="advantages-cards__item">
                    <?php if(get_sub_field('advantages-cards_item_title')){?>
                    <div class="advantages-cards__item__title">
                        <?php the_sub_field('advantages-cards_item_title');?>
                    </div>
                    <?php } ?>
                    <?php if(get_sub_field('advantages-cards_item_text')){?>
                    <div class="advantages-cards__item__text">
                        <?php the_sub_field('advantages-cards_item_text');?>
                    </div>
                    <?php } ?>
                    <?php if(get_sub_field('advantages-cards_item_icon')){?>
                    <img src="<?php the_sub_field('advantages-cards_item_icon');?>" class="advantages-cards__item__icon" alt="icon">
                    <?php } ?>
                    <?php if(get_sub_field('advantages-cards_item_icon_color')){?>
                    <div class="advantages-cards__item__svg-wrap">
                        <svg width="478" height="478" viewBox="0 0 478 478" fill="none" xmlns="http://www.w3.org/2000/svg" style="">
                            <g opacity="0.2">
                                <!-- php - advantages-cards__item_id_УНИКАЛЬНЫЙ-KEY (первый)--> <!-- php - advantages-cards__item_radial_УНИКАЛЬНЫЙ-KEY (первый)-->
                                <mask id="advantages-cards__item_id_<?php echo $count;?>" style="mask-type:alpha" x="0" y="0" width="478" height="478"><circle cx="239" cy="239" r="239" fill="url(#advantages-cards__item_radial_<?php echo $count;?>)"></circle></mask>
                                <g mask="url(#advantages-cards__item_id_<?php echo $count;?>)"><!-- php - advantages-cards__item_id_УНИКАЛЬНЫЙ-KEY (второй)-->
                                    <rect width="478" height="478" fill="<?php the_sub_field('advantages-cards_item_icon_color');?>"></rect><!-- php - fill выбор цвета -->
                                </g>
                            </g>
                            <defs><!-- php - advantages-cards__item_RADIAL_УНИКАЛЬНЫЙ-KEY (второй)-->
                                <radialGradient id="advantages-cards__item_radial_<?php echo $count;?>" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(239 239) rotate(90) scale(239)">
                                    <stop stop-color="#D9D9D9"></stop>
                                    <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"></stop>
                                </radialGradient>
                            </defs>
                        </svg>
                    </div>
                    <?php } ?>
                </div>
            <?php $count++;?>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>