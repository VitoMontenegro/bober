<section class="section contacts-flex__section">
    <div class="container">
        <div class="contacts-flex">

            <?php if(get_field('option_address', 'option')) { ?>
            <div class="contacts-flex__item">
                <div class="contacts-flex__item__name">
                    Адрес офиса
                </div>
                <div class="contacts-flex__item__text">
                    <?php
                    $address = get_field('option_address', 'option');
                    if ($address) {
                        $modified_address = preg_replace('/Санкт-Петербург,/', 'Санкт-Петербург,<br>', $address);
                        echo $modified_address;
                    }
                    ?>
                </div>
            </div>
            <?php } ?>

            <?php if(get_field('option_schedule', 'option') or get_field('option_schedule_departure', 'option')) { ?>
            <div class="contacts-flex__item">
                <div class="contacts-flex__item__name">
                    График работы
                </div>
                <div class="contacts-flex__item__text">
                    <?php if(get_field('option_schedule', 'option')){?>
                        <p><?php the_field('option_schedule', 'option'); ?></p>
                    <?php } ?>
                    <?php if(get_field('option_schedule_departure', 'option')){?>
                        <p><?php the_field('option_schedule_departure', 'option'); ?></p>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>

            <div class="contacts-flex__item">
                <div class="contacts-flex__item__name">
                    Телефоны
                </div>
                <div class="contacts-flex__item__messenger">
                    <?php if(get_field('option_soc_whatsapp', 'option')) { ?>
                    <a href="<?php the_field('option_soc_whatsapp', 'option'); ?>" class="contacts-flex__item__messenger__item is--whatsapp" target="_blank">
                        <i class="icon">
                            <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.779 2.65827C11.3616 1.29318 9.47541 0.521062 7.50675 0.5C5.53732 0.5 3.64855 1.28165 2.25596 2.67299C0.863361 4.06434 0.0810081 5.95141 0.0810081 7.91906C0.0806791 9.22589 0.4303 10.509 1.09361 11.6353L0 15.5L3.98965 14.4883C5.08826 15.086 6.32352 15.3882 7.57426 15.3651C8.54942 15.3651 9.51503 15.1732 10.416 14.8004C11.3169 14.4275 12.1355 13.881 12.825 13.1921C13.5146 12.5032 14.0616 11.6853 14.4347 10.7852C14.8079 9.88507 15 8.92033 15 7.94604C14.9522 5.97031 14.1532 4.08689 12.7655 2.67851L12.779 2.65827ZM10.2408 9.1803C10.5108 9.3152 10.7808 9.45009 10.8821 9.48381L10.8888 9.4973C11.0189 9.5431 11.156 9.56592 11.2939 9.56475C11.2896 9.86184 11.2442 10.1569 11.1589 10.4415C10.844 10.8715 10.3914 11.1809 9.87624 11.3183C9.49413 11.3929 9.09935 11.3697 8.72862 11.2509C8.59361 11.1835 8.44172 11.1329 8.26451 11.0739C8.08731 11.0148 7.88479 10.9474 7.64851 10.8462C6.34094 10.2515 5.23579 9.28802 4.46895 8.07419C4.04586 7.52597 3.78824 6.86845 3.72637 6.17896C3.71503 5.88633 3.76983 5.59491 3.8867 5.32635C4.00357 5.05779 4.17951 4.81899 4.40144 4.6277C4.52914 4.50516 4.69711 4.43324 4.87399 4.42536H5.21152C5.34653 4.42536 5.41404 4.42536 5.61656 4.76259C5.81908 5.09982 6.22412 5.97662 6.22412 6.11151C6.22412 6.1593 6.23259 6.19862 6.24053 6.23547C6.25501 6.30265 6.26771 6.36163 6.22412 6.44874C6.19037 6.51619 6.15662 6.56677 6.12286 6.61736C6.08911 6.66794 6.05536 6.71852 6.0216 6.78597C5.94862 6.91099 5.85763 7.02462 5.75157 7.1232C5.7354 7.15552 5.71535 7.18397 5.69607 7.21133C5.63487 7.29816 5.5814 7.37402 5.68407 7.52788C5.93405 8.01736 6.27814 8.45282 6.69667 8.80935C7.10778 9.23974 7.61747 9.5638 8.18182 9.7536C8.38434 9.82104 8.45184 9.82104 8.58686 9.68615C8.80569 9.45264 9.00866 9.20479 9.19442 8.94424C9.32943 8.80935 9.39694 8.80935 9.59946 8.8768C9.70072 8.91052 9.97075 9.04541 10.2408 9.1803Z" fill="white" />
                            </svg>
                        </i>
                        <span>WhatsApp</span>
                    </a>
                    <?php } ?>
                    <?php if(get_field('option_soc_telegram', 'option')) { ?>
                    <a href="<?php the_field('option_soc_telegram', 'option'); ?>" class="contacts-flex__item__messenger__item is--telegram" target="_blank">
                        <i class="icon">
                            <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.884691 6.69256L17.7346 0.574874C18.5167 0.308828 19.1997 0.754524 18.9463 1.86808L18.9477 1.86671L16.0787 14.5944C15.8661 15.4968 15.2967 15.7162 14.5001 15.2911L10.131 12.259L8.02369 14.1706C7.79068 14.3901 7.59407 14.5752 7.14261 14.5752L7.45281 10.3884L15.5501 3.50001C15.9025 3.20791 15.4714 3.04334 15.0069 3.33407L5.00032 9.26662L0.686628 7.99948C-0.249802 7.71972 -0.270191 7.11768 0.884691 6.69256Z" fill="white" />
                            </svg>
                        </i>
                        <span>Telegram</span>
                    </a>
                    <?php } ?>
                </div>
                <div class="contacts-flex__item__tel">
                    <?php if(get_field('option_tel3_num', 'option')) { ?>
                        <?php $option_tel3_link = str_replace(array(' ', '(' , ')', '-'), '', get_field('option_tel3_num', 'option')); ?>
                        <a href="tel:<?php echo $option_tel3_link; ?>" class="contacts-flex__item__tel__item">
                            <span class="contacts-flex__item__tel__item__num"><?php the_field('option_tel3_num', 'option');?></span>
                            <?php if(get_field('option_tel3_text', 'option')){?>
                            <span class="contacts-flex__item__tel__item__text"><?php the_field('option_tel3_text', 'option');?></span>
                            <?php } ?>
                        </a>
                    <?php } ?>

                    <?php if(get_field('option_tel2_num', 'option')) { ?>
                        <?php $option_tel2_link = str_replace(array(' ', '(' , ')', '-'), '', get_field('option_tel2_num', 'option')); ?>
                        <a href="tel:<?php echo $option_tel2_link; ?>" class="contacts-flex__item__tel__item">
                            <span class="contacts-flex__item__tel__item__num"><?php the_field('option_tel2_num', 'option');?></span>
                            <?php if(get_field('option_tel2_text2', 'option')){?>
                                <span class="contacts-flex__item__tel__item__text"><?php the_field('option_tel2_text2', 'option');?></span>
                            <?php } ?>
                        </a>
                    <?php } ?>
                    
                    <?php if(get_field('option_tel1_num', 'option')) { ?>
                        <?php $option_tel1_link = str_replace(array(' ', '(' , ')', '-'), '', get_field('option_tel1_num', 'option')); ?>
                        <a href="tel:<?php echo $option_tel1_link; ?>" class="contacts-flex__item__tel__item">
                            <span class="contacts-flex__item__tel__item__num"><?php the_field('option_tel1_num', 'option');?></span>
                            <?php if(get_field('option_tel1_text', 'option')){?>
                                <span class="contacts-flex__item__tel__item__text"><?php the_field('option_tel1_text', 'option');?></span>
                            <?php } ?>
                        </a>
                    <?php } ?>

                </div>
            </div>


            <div class="contacts-flex__item with--background">
                <div class="contacts-flex__item__name">
                    Мы в соц. сетях
                </div>

                <div class="contacts-flex__item__messenger">

                    <?php if(get_field('option_soc_vk', 'option')) { ?>
                    <a href="<?php the_field('option_soc_vk', 'option'); ?>" class="contacts-flex__item__messenger__item is--vk" target="_blank">
                        <i class="icon">
                            <svg width="22" height="12" viewBox="0 0 22 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21.4968 0.81375C21.6479 0.345 21.4968 0 20.7699 0H18.3645C17.752 0 17.4702 0.29625 17.3191 0.62625C17.3191 0.62625 16.094 3.3675 14.3625 5.145C13.803 5.65875 13.5457 5.82375 13.2395 5.82375C13.0884 5.82375 12.8556 5.65875 12.8556 5.19V0.81375C12.8556 0.25125 12.6841 0 12.1777 0H8.39616C8.01228 0 7.7836 0.2625 7.7836 0.50625C7.7836 1.03875 8.64935 1.1625 8.73919 2.6625V5.9175C8.73919 6.63 8.60034 6.76125 8.29406 6.76125C7.47731 6.76125 5.49262 4.00875 4.31651 0.85875C4.07965 0.2475 3.84688 0 3.23023 0H0.824914C0.138847 0 0 0.29625 0 0.62625C0 1.21125 0.816747 4.1175 3.80196 7.9575C5.79073 10.5788 8.59217 12 11.1404 12C12.6718 12 12.8597 11.685 12.8597 11.1412C12.8597 8.63625 12.7208 8.4 13.4886 8.4C13.8439 8.4 14.4564 8.565 15.8857 9.82875C17.5192 11.3288 17.7887 12 18.7035 12H21.1088C21.7949 12 22.142 11.685 21.9419 11.0625C21.4845 9.75375 18.3931 7.06125 18.2543 6.88125C17.899 6.46125 18.0011 6.27375 18.2543 5.89875C18.2584 5.895 21.1946 2.1 21.4968 0.81375Z" fill="#EB6025" />
                            </svg>
                        </i>
                        <span>Вконтакте</span>
                    </a>
                    <?php } ?>

                    <?php if(get_field('option_soc_inst', 'option')) { ?>
                    <a href="<?php the_field('option_soc_inst', 'option'); ?>" class="contacts-flex__item__messenger__item is--inst" target="_blank">
                        <i class="icon">
                            <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.50243 17.3997C10.0381 17.4034 11.4481 17.3647 12.8178 17.2814C13.7902 17.2223 14.6333 16.9068 15.324 16.3437C15.9624 15.8231 16.4022 15.1048 16.6308 14.2089C16.8575 13.3207 16.8706 12.367 16.8832 11.4447C16.8931 10.7227 16.9034 9.86747 16.9055 9.00007C16.9034 8.13251 16.8931 7.27741 16.8832 6.55539C16.8706 5.63315 16.8575 4.67946 16.6308 3.79109C16.4022 2.89513 15.9624 2.1769 15.324 1.65631C14.6333 1.09333 13.7902 0.777817 12.8178 0.718724C11.4481 0.635326 10.0381 0.596893 8.50608 0.600235C6.97074 0.596589 5.5606 0.635326 4.19088 0.718724C3.21847 0.777817 2.37537 1.09333 1.68466 1.65631C1.04621 2.1769 0.606503 2.89513 0.377836 3.79109C0.151145 4.67946 0.138078 5.63299 0.125467 6.55539C0.115591 7.27802 0.105259 8.13373 0.103132 9.00189C0.105259 9.86625 0.115591 10.7221 0.125467 11.4447C0.138078 12.367 0.151145 13.3207 0.377836 14.2089C0.606503 15.1048 1.04621 15.8231 1.68466 16.3437C2.37537 16.9066 3.21847 17.2222 4.19088 17.2813C5.5606 17.3647 6.97104 17.4035 8.50243 17.3997ZM3.60333 9.00007C3.60333 11.6805 5.78456 13.8612 8.46536 13.8612C11.1463 13.8612 13.3274 11.6805 13.3274 9.00007C13.3274 6.31962 11.1463 4.13896 8.46536 4.13896C5.78456 4.13896 3.60333 6.31962 3.60333 9.00007ZM12.705 3.75008C12.705 3.10568 13.2276 2.58341 13.8719 2.58341C14.5165 2.58341 15.0388 3.10568 15.0388 3.75008C15.0388 4.39448 14.5165 4.91674 13.8719 4.91674C13.2276 4.91674 12.705 4.39448 12.705 3.75008Z" fill="#EB6025" />
                                <path d="M8.46536 5.69452C6.6424 5.69452 5.15918 7.17746 5.15918 9.00007C5.15918 10.8227 6.6424 12.3056 8.46536 12.3056C10.2885 12.3056 11.7715 10.8227 11.7715 9.00007C11.7715 7.17746 10.2885 5.69452 8.46536 5.69452Z" fill="#EB6025" />
                            </svg>
                        </i>
                        <span>Instagram</span>
                    </a>
                    <?php } ?>

                    <?php if(get_field('option_soc_youtube', 'option')) { ?>
                    <a href="<?php the_field('option_soc_youtube', 'option'); ?>" class="contacts-flex__item__messenger__item is--youtube" target="_blank">
                        <i class="icon">
                            <svg width="23" height="18" viewBox="0 0 23 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.4843 3.23851L22.5131 3.42452C22.2352 2.44798 21.485 1.69446 20.5317 1.42019L20.5116 1.41545C18.7189 0.933346 11.5053 0.933347 11.5053 0.933347C11.5053 0.933347 4.30985 0.923856 2.49901 1.41545C1.52748 1.69446 0.776318 2.44798 0.503255 3.40459L0.498465 3.42452C-0.171258 6.88939 -0.176048 11.0527 0.528166 14.7624L0.498465 14.5745C0.776318 15.5511 1.52652 16.3046 2.47985 16.5789L2.49997 16.5836C4.29068 17.0667 11.5063 17.0667 11.5063 17.0667C11.5063 17.0667 18.7007 17.0667 20.5125 16.5836C21.485 16.3046 22.2362 15.5511 22.5092 14.5945L22.514 14.5745C22.8187 12.9631 22.9931 11.1087 22.9931 9.21448C22.9931 9.14521 22.9931 9.07498 22.9921 9.00475C22.9931 8.94022 22.9931 8.86335 22.9931 8.78648C22.9931 6.89129 22.8187 5.0369 22.4843 3.23851ZM9.2039 12.4649V5.54368L15.2074 9.0095L9.2039 12.4649Z" fill="#EB6025" />
                            </svg>
                        </i>
                        <span>YouTube</span>
                    </a>
                    <?php } ?>

                </div>
            </div>

        </div>

        <?php if(get_field('option_iframe-map', 'option')) { ?>
        <div class="contacts-flex__map">
            <?php echo get_field('option_iframe-map', 'option'); ?>
        </div>
        <?php } ?>


    </div>
</section>