<div class="container benefit-cards__contaner">

    <?php $count=0;?>
    <?php if( have_rows('benefit-cards_item') ): ?>
    <div class="benefit-cards benefit-cards--col-4">

        <?php while( have_rows('benefit-cards_item') ): the_row(); ?>
        <div class="benefit-cards__item">
            <?php if(get_sub_field('benefit-cards_item_text')){?>
            <div class="benefit-cards__item__text">
                <?php the_sub_field('benefit-cards_item_text');?>
            </div>
            <?php } ?>

            <?php if(get_sub_field('benefit-cards_item_text')){?>
            <i class="icon icon-content">
                <img src="<?php the_sub_field('benefit-cards_item_icon');?>" alt="иконка">
            </i>
            <?php } ?>
            <div class="icon benefit-cards__item__svg-wrap">
                <svg width="358" height="358" viewBox="0 0 358 358" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.2">
                        <mask id="mask0_<?php echo $count;?>" style="mask-type:alpha" x="0" y="0" width="358" height="358">
                            <circle cx="178.572" cy="178.572" r="178.572" fill="url(#paint0_radial_<?php echo $count;?>)" />
                        </mask>
                        <g mask="url(#mask0_<?php echo $count;?>)">
                            <rect width="357.144" height="357.144" fill="#EB6025" />
                        </g>
                    </g>
                    <defs>
                        <radialGradient id="paint0_radial_<?php echo $count;?>" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(178.572 178.572) rotate(90) scale(178.572)">
                            <stop stop-color="#D9D9D9" />
                            <stop offset="1" stop-color="#D9D9D9" stop-opacity="0" />
                        </radialGradient>
                    </defs>
                </svg>
            </div>
        </div>

        <?php $count++; ?>
        <?php endwhile; ?>

    </div>
    <?php endif;?>
</div>