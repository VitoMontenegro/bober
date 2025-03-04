<section class="section contacts-block__section decoration_8">
    <div class="container-1080">
        <div class="contacts-block">
            <div class="contacts-block__left">
                <div class="contacts-block__item contacts-block__item--half">
                    <div class="contacts-block__item__head">Номера телефона</div>
                    <div class="contacts-block__item__body">
                        <?php if(get_field('option_tel3_num', 'option')) { ?>
                            <?php $option_tel3_link = str_replace(array(' ', '(' , ')', '-'), '', get_field('option_tel3_num', 'option')); ?>
                            <a class="contacts-block__item__body__link" href="tel:<?php echo $option_tel3_link; ?>">
                                <?php if(get_field('option_tel3_text', 'option')){?>
                                <span class="contacts-block__item__body__link__text"><?php the_field('option_tel3_text', 'option');?></span>
                                <?php } ?>
                                <?php the_field('option_tel3_num', 'option');?>
                            </a>
                            <br>
                        <?php } ?>
                        <?php if(get_field('option_tel2_num', 'option')) { ?>
                            <?php $option_tel2_link = str_replace(array(' ', '(' , ')', '-'), '', get_field('option_tel2_num', 'option')); ?>
                            <a class="contacts-block__item__body__link" href="tel:<?php echo $option_tel2_link; ?>">
                                <?php if(get_field('option_tel2_text2', 'option')){?>
                                <span class="contacts-block__item__body__link__text"><?php the_field('option_tel2_text2', 'option');?></span>
                                <?php } ?>
                                <?php the_field('option_tel2_num', 'option');?>
                            </a>
                        <?php } ?>
                    </div>
                </div>

                <div class="contacts-block__item contacts-block__item--half">
                    <div class="contacts-block__item__head">Электронная почта</div>
                    <div class="contacts-block__item__body">
                        <?php if(get_field('option_mail', 'option')) { ?>
                            <a href="mailto:<?php the_field('option_mail', 'option'); ?>"><?php the_field('option_mail', 'option'); ?></a>
                        <?php } ?>
                    </div>
                </div>
                <?php if(get_field('option_soc_whatsapp', 'option')) { ?>
                    <a href="<?php the_field('option_soc_whatsapp', 'option'); ?>" class="contacts-block__messenger contacts-block__messenger--whatsapp" target="_blank">
                        <i class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M23.0022 3.88489C20.4508 1.42772 17.0557 0.0379116 13.5121 0C9.96718 0 6.5674 1.40697 4.06072 3.91139C1.55405 6.41581 0.145815 9.81253 0.145815 13.3543C0.145222 15.7066 0.774541 18.0162 1.9685 20.0436L0 27L7.18137 25.179C9.15887 26.2549 11.3823 26.7987 13.6337 26.7572C15.389 26.7572 17.1271 26.4118 18.7487 25.7407C20.3704 25.0695 21.8439 24.0859 23.0851 22.8458C24.3263 21.6057 25.3108 20.1336 25.9825 18.5134C26.6543 16.8931 27 15.1566 27 13.4029C26.9139 9.84656 25.4758 6.45639 22.9779 3.92131L23.0022 3.88489ZM18.4334 15.6245C18.9194 15.8674 19.4055 16.1102 19.5878 16.1709L19.5999 16.1951C19.834 16.2776 20.0807 16.3187 20.329 16.3165C20.3213 16.8513 20.2395 17.3824 20.086 17.8948C19.5193 18.6687 18.7046 19.2257 17.7772 19.473C17.0894 19.6072 16.3788 19.5655 15.7115 19.3516C15.4685 19.2302 15.1951 19.1392 14.8761 19.0329C14.5572 18.9267 14.1926 18.8053 13.7673 18.6232C11.4137 17.5527 9.42443 15.8184 8.0441 13.6335C7.28254 12.6467 6.81882 11.4632 6.70747 10.2221C6.68706 9.69539 6.7857 9.17084 6.99607 8.68743C7.20643 8.20402 7.52312 7.77419 7.92259 7.42986C8.15245 7.20929 8.45479 7.07983 8.77318 7.06565H9.38074C9.62376 7.06565 9.74527 7.06565 10.1098 7.67266C10.4743 8.27968 11.2034 9.85791 11.2034 10.1007C11.2034 10.1867 11.2187 10.2575 11.233 10.3238C11.259 10.4448 11.2819 10.5509 11.2034 10.7077C11.1427 10.8291 11.0819 10.9202 11.0212 11.0112C10.9604 11.1023 10.8996 11.1933 10.8389 11.3147C10.7075 11.5398 10.5437 11.7443 10.3528 11.9218C10.3237 11.9799 10.2876 12.0311 10.2529 12.0804C10.1428 12.2367 10.0465 12.3732 10.2313 12.6502C10.6813 13.5312 11.3006 14.3151 12.054 14.9568C12.794 15.7315 13.7114 16.3148 14.7273 16.6565C15.0918 16.7779 15.2133 16.7779 15.4563 16.5351C15.8502 16.1148 16.2156 15.6686 16.55 15.1996C16.793 14.9568 16.9145 14.9568 17.279 15.0782C17.4613 15.1389 17.9473 15.3817 18.4334 15.6245Z" fill="#25D366"/>
                            </svg>
                        </i>
                        <span>WhatsApp</span>
                    </a>
                <?php } ?>
                <?php if(get_field('option_soc_telegram', 'option')) { ?>
                    <a href="<?php the_field('option_soc_telegram', 'option'); ?>" class="contacts-block__messenger contacts-block__messenger--telegram" target="_blank">
                        <i class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
                                <path d="M1.80723 13.6436L26.6354 5.26916C27.7878 4.90497 28.7942 5.51508 28.4208 7.03941L28.423 7.03753L24.1955 24.4603C23.8822 25.6956 23.0432 25.9959 21.8694 25.414L15.4316 21.2634L12.3265 23.8803C11.9831 24.1806 11.6935 24.4341 11.0282 24.4341L11.4853 18.7028L23.4166 9.27334C23.9359 8.87349 23.3007 8.64822 22.6161 9.0462L7.87158 17.1672L1.51539 15.4326C0.135564 15.0497 0.105522 14.2255 1.80723 13.6436Z" fill="#229ACC"/>
                            </svg>
                        </i>
                        <span>Telegram</span>
                    </a>
                <?php } ?>

                <?php if(get_field('option_address', 'option')) { ?>
                    <div class="contacts-block__item">
                        <div class="contacts-block__item__head">Адрес</div>
                        <div class="contacts-block__item__body">
                            <?php the_field('option_address', 'option'); ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if(get_field('option_schedule', 'option') or get_field('option_schedule_departure', 'option')) { ?>
                    <div class="contacts-block__item">
                        <div class="contacts-block__item__head">График работы</div>
                        <div class="contacts-block__item__body">
                            <?php if(get_field('option_schedule', 'option')){?>
                                <?php the_field('option_schedule', 'option'); ?><br>
                            <?php } ?>
                            <?php if(get_field('option_schedule_departure', 'option')){?>
                                <span class="color-orange"><?php the_field('option_schedule_departure', 'option'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <?php if(get_field('option_iframe-map', 'option')) { ?>
                <div class="contacts-block__right">
                    <?php echo get_field('option_iframe-map', 'option'); ?>
                </div>
            <?php } ?>

        </div>
    </div>
</section>