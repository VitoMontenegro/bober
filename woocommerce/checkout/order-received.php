<?php
/**
 * "Order received" message.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/order-received.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.8.0
 *
 * @var WC_Order|false $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-notice__wrap">
<div class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
    <div class="woocommerce-notice__title">Ваш заказ принят! Благодарим&nbsp;вас.</div>
    <p>Скоро мы с вами свяжемся для обсуждения деталей.<br>
        Если не хотите ждать - позвоните или напиши нам</p>

    <div class="contacts-flex__item">
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
    </div>
</div>
    <div class="woocommerce-notice__wrap__right">
        <img decoding="async" src="/wp-content/uploads/2024/04/frame-123.svg" class="main-info__img" alt="Бобёр">
    </div>
</div>
