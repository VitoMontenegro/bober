<section class="section info-block-7__section">
    <div class="container">

        <?php if(get_field('info-block-7_title')){?>
        <h2 class="section-title"><?php the_field('info-block-7_title');?></h2>
        <?php } ?>

        <?php if(get_field('info-block-7_text-above')){?>
        <div class="info-block-7__text-above">
            <i class="icon">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.87857 0.5C5.4889 0.5 5.98368 0.995495 5.98368 1.60672V2.02455H13.8284V1.60672C13.8284 0.995495 14.3232 0.5 14.9335 0.5C15.5439 0.5 16.0386 0.995495 16.0386 1.60672V2.10588C17.7375 2.46773 18.9987 3.99342 18.9987 5.79926V16.7253C18.9987 18.797 17.3388 20.5 15.2624 20.5H4.73761C2.6612 20.5 1.0013 18.797 1.0013 16.7253V5.79926C1.0013 4.06067 2.17031 2.58175 3.77346 2.1511V1.60672C3.77346 0.995495 4.26824 0.5 4.87857 0.5ZM4.85808 4.23799H4.73761C3.90767 4.23799 3.21151 4.92399 3.21151 5.79926V6.34412H16.7885V5.79926C16.7885 4.92399 16.0924 4.23799 15.2624 4.23799H4.89906C4.89224 4.23812 4.88541 4.23818 4.87857 4.23818C4.87173 4.23818 4.8649 4.23812 4.85808 4.23799ZM16.7885 8.55756H3.21151V16.7253C3.21151 17.6006 3.90767 18.2866 4.73761 18.2866H15.2624C16.0924 18.2866 16.7885 17.6006 16.7885 16.7253V8.55756Z" fill="#EB6025" />
                </svg>
            </i>
            <span><?php the_field('info-block-7_text-above');?></span>
        </div>
        <?php } ?>

        <?php $count = 0;?>
        <?php $color[0] = '#EB6025';?>
        <?php $color[1] = '#99807A';?>
        <?php $color[2] = '#F3981A';?>
        <?php $color[3] = '#664D47';?>
        <?php $color[4] = '#F3981A';?>
        <?php $color[5] = '#EB6025';?>
        <?php $color[6] = '#EB6025';?>
        <?php if( have_rows('info-block-7_item') ): ?>
        <div class="info-block-7<?php if(get_field('info-block-7_item-mob')) {echo' info-block-7--with-mob-icon';}?>">
            <?php while( have_rows('info-block-7_item') ): the_row();
                $count++;
                ?>

            <div class="info-block-7__item">

                <?php if(get_sub_field('info-block-7_item_text')){?>
                    <div class="info-block-7__item__text"><?php the_sub_field('info-block-7_item_text');?></div>
                <?php } ?>

                <?php if($count == 1){//Только первый ?>


                <?php if(get_field('info-block-7_item-whatsapp')) { ?>
                    <?php if(get_field('option_soc_whatsapp', 'option')) { ?>
                    <a href="<?php the_field('option_soc_whatsapp', 'option'); ?>" class="info-block-7__item__whatsapp" target="_blank">
                        <i class="icon">
                            <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4829 2.94604C12.8764 1.39894 10.7388 0.52387 8.50765 0.5C6.27563 0.5 4.13503 1.38587 2.55675 2.96273C0.978476 4.53958 0.0918092 6.67826 0.0918092 8.90827C0.0914363 10.3893 0.487674 11.8435 1.23942 13.1201L0 17.5L4.5216 16.3534C5.76669 17.0309 7.16666 17.3733 8.58416 17.3471C9.68934 17.3471 10.7837 17.1296 11.8048 16.7071C12.8258 16.2845 13.7536 15.6652 14.5351 14.8844C15.3165 14.1036 15.9364 13.1767 16.3594 12.1566C16.7823 11.1364 17 10.043 17 8.93885C16.9458 6.69968 16.0403 4.56514 14.4676 2.96897L14.4829 2.94604ZM11.6062 10.3377C11.9122 10.4906 12.2183 10.6434 12.333 10.6817L12.3407 10.6969C12.4881 10.7488 12.6434 10.7747 12.7997 10.7734C12.7949 11.1101 12.7434 11.4445 12.6467 11.7671C12.2899 12.2544 11.7769 12.605 11.1931 12.7608C10.76 12.8453 10.3126 12.819 9.89244 12.6844C9.73942 12.6079 9.56728 12.5506 9.36645 12.4837C9.16562 12.4168 8.93609 12.3404 8.66832 12.2257C7.18639 11.5517 5.9339 10.4598 5.06481 9.08408C4.58531 8.46277 4.29333 7.71758 4.22322 6.93615C4.21037 6.60451 4.27248 6.27423 4.40493 5.96987C4.53738 5.6655 4.73678 5.39486 4.9883 5.17806C5.13302 5.03918 5.32339 4.95767 5.52385 4.94874H5.90639C6.05941 4.94874 6.13591 4.94874 6.36544 5.33093C6.59496 5.71313 7.05401 6.70683 7.05401 6.85971C7.05401 6.91387 7.06361 6.95843 7.07261 7.0002C7.08901 7.07634 7.10341 7.14318 7.05401 7.24191C7.01575 7.31834 6.9775 7.37567 6.93924 7.433C6.90099 7.49033 6.86274 7.54766 6.82448 7.6241C6.74176 7.76579 6.63865 7.89456 6.51845 8.00629C6.50012 8.04292 6.4774 8.07516 6.45554 8.10617C6.38619 8.20458 6.32559 8.29056 6.44194 8.46493C6.72525 9.01968 7.11522 9.51319 7.58956 9.91727C8.05548 10.405 8.63313 10.7723 9.27273 10.9874C9.50225 11.0638 9.57876 11.0638 9.73177 10.911C9.97978 10.6463 10.2098 10.3654 10.4203 10.0701C10.5734 9.91726 10.6499 9.91726 10.8794 9.9937C10.9941 10.0319 11.3002 10.1848 11.6062 10.3377Z" fill="white" />
                            </svg>
                        </i>
                        <span>Написать в WhatsApp</span>
                    </a>
                    <?php } ?>
                <?php } ?>


                <?php } elseif ($count < 7){ ?>
                    <?php if(get_field('info-block-7_item-mob')) { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/info-block-7-icon-<?php echo $count - 1;?>.svg" alt="icon" class="info-block-7__item__icon">
                    <?php } ?>
                <?php } ?>

                <div class="info-block-7__item__num"><?php echo $count;?></div>
                <?php if(get_sub_field('info-block-7_item_tg')): ?>
                    <a href="<?php the_field('option_soc_telegram', 'option'); ?>" class="tg_btn" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" viewBox="0 0 16 13" fill="none">
                            <path d="M0.746989 5.51062L14.9345 0.725235C15.593 0.517128 16.1681 0.865761 15.9548 1.73681L15.956 1.73573L13.5403 11.6916C13.3613 12.3975 12.8818 12.5691 12.2111 12.2366L8.53236 9.86478L6.758 11.3602C6.5618 11.5318 6.39626 11.6766 6.01613 11.6766L6.27731 8.4016L13.0952 3.01334C13.3919 2.78485 13.029 2.65613 12.6378 2.88354L4.21233 7.52411L0.580221 6.53292C-0.208249 6.31409 -0.225416 5.84317 0.746989 5.51062Z" fill="white"/>
                        </svg>
                        <span>Написать в Telegram</span>
                    </a>
                <?php endif; ?>

                <div class="info-block-7__item__svg-wrap">
                    <svg width="478" height="478" viewBox="0 0 478 478" fill="none" xmlns="http://www.w3.org/2000/svg" style="">
                        <g opacity="0.2">
                            <mask id="info-block-7__item_id_<?php echo $count;?>" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="478" height="478"><circle cx="239" cy="239" r="239" fill="url(#info-block-7__item_radial_<?php echo $count;?>)"></circle></mask>
                            <g mask="url(#info-block-7__item_id_<?php echo $count;?>)">
                                <?php if($color[$count]){?>
                                <rect width="478" height="478" fill="<?php echo $color[$count];?>"></rect>
                                <?php } ?>
                            </g>
                        </g>
                        <defs>
                            <radialGradient id="info-block-7__item_radial_<?php echo $count;?>" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(239 239) rotate(90) scale(239)">
                                <stop stop-color="#D9D9D9"></stop>
                                <stop offset="1" stop-color="#D9D9D9" stop-opacity="0"></stop>
                            </radialGradient>
                        </defs>
                    </svg>
                </div>


            </div>
            <?php endwhile; ?>

        </div>

        <?php endif;?>
    </div>
</section>
