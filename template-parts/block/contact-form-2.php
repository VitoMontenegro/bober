<section class="section contact-form__section contact-form-2__section">
    <div class="container">

        <?php if( get_field('option-contact-form-2_is-mobile','option') ) {?>
        <div class="contact-form__is-mobile">
			<?php /*
            <a href="#" class="btn contact-form__is-mobile__btn contact-form__is-mobile__btn--whatsapp btn-with-icon" target="_blank">
                <i class="icon">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.0387 2.8777C15.1487 1.05757 12.6339 0.0280826 10.009 0C7.38309 0 4.86474 1.0422 3.00794 2.89732C1.15115 4.75245 0.108011 7.26854 0.108011 9.89209C0.107572 11.6345 0.573734 13.3454 1.45815 14.8471L0 20L5.31953 18.6511C6.78434 19.4481 8.43136 19.8509 10.099 19.8201C11.3992 19.8201 12.6867 19.5643 13.888 19.0672C15.0892 18.57 16.1807 17.8414 17.1001 16.9228C18.0195 16.0043 18.7488 14.9138 19.2463 13.7136C19.7439 12.5134 20 11.2271 20 9.92806C19.9362 7.29375 18.871 4.78252 17.0207 2.90468L17.0387 2.8777ZM13.6544 11.5737C14.0144 11.7536 14.3744 11.9335 14.5095 11.9784L14.5185 11.9964C14.6919 12.0575 14.8746 12.0879 15.0585 12.0863C15.0528 12.4825 14.9922 12.8759 14.8785 13.2554C14.4587 13.8287 13.8552 14.2412 13.1683 14.4245C12.6588 14.5239 12.1325 14.4929 11.6382 14.3345C11.4581 14.2446 11.2556 14.1772 11.0194 14.0985C10.7831 14.0198 10.5131 13.9299 10.198 13.795C8.45458 13.002 6.98106 11.7174 5.9586 10.0989C5.39448 9.36796 5.05098 8.49127 4.9685 7.57194C4.95338 7.18177 5.02644 6.79322 5.18227 6.43514C5.3381 6.07706 5.57268 5.75866 5.86859 5.5036C6.03885 5.34021 6.26281 5.24432 6.49865 5.23381H6.9487C7.12871 5.23381 7.21872 5.23381 7.48875 5.68345C7.75878 6.13309 8.29883 7.30216 8.29883 7.48201C8.29883 7.54573 8.31013 7.59816 8.32071 7.64729C8.34001 7.73687 8.35695 7.81551 8.29883 7.93165C8.25383 8.02158 8.20882 8.08903 8.16382 8.15647C8.11881 8.22392 8.07381 8.29137 8.0288 8.38129C7.93149 8.54799 7.81018 8.69949 7.66877 8.83093C7.6472 8.87403 7.62047 8.91196 7.59476 8.94844C7.51316 9.06421 7.44187 9.16536 7.57876 9.3705C7.91206 10.0231 8.37085 10.6038 8.92889 11.0791C9.47703 11.653 10.1566 12.0851 10.9091 12.3381C11.1791 12.4281 11.2691 12.4281 11.4491 12.2482C11.7409 11.9369 12.0115 11.6064 12.2592 11.259C12.4392 11.0791 12.5293 11.0791 12.7993 11.1691C12.9343 11.214 13.2943 11.3939 13.6544 11.5737Z" fill="white" />
                    </svg>
                </i>
                <span>Написать в WhatsApp</span>
            </a> */ ?>
            <button class="btn btn-orange contact-form__is-mobile__btn">
                <?php if( get_field('option-contact-form-2_is-mobile_text','option')){ the_field('option-contact-form-2_is-mobile_text','option'); } else { echo 'Бесплатная консультация';}?>
            </button>
        </div>
        <?php }?>

        <div class="contact-form-2<?php if(get_field('option-contact-form-2_is-mobile','option')){echo ' contact-form__is-desktop';}?>">

            <div class="contact-form">
                <?php if(get_field('option-contact-form-2_title','option')){?>
                <h2 class="section-title text-align-left"><?php the_field('option-contact-form-2_title','option');?></h2>
                <?php } ?>
                <?php if(get_field('option-contact-form-2_text','option')){?>
                <div class="contact-form__text">
                    <?php the_field('option-contact-form-2_text','option');?>
                </div>
                <?php } ?>
                <div class="contact-form__head__flex">
                    <div class="contact-form__head__flex__div">
                        24/7
                    </div>

                    <?php if(get_field('option_soc_whatsapp', 'option')) { ?>
                    <a href="<?php the_field('option_soc_whatsapp', 'option'); ?>" class="contact-form__head__flex__btn contact-form__head__flex__btn--whatsapp btn-with-icon" target="_blank">
                        <i class="icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.0387 2.8777C15.1487 1.05757 12.6339 0.0280826 10.009 0C7.38309 0 4.86474 1.0422 3.00794 2.89732C1.15115 4.75245 0.108011 7.26854 0.108011 9.89209C0.107572 11.6345 0.573734 13.3454 1.45815 14.8471L0 20L5.31953 18.6511C6.78434 19.4481 8.43136 19.8509 10.099 19.8201C11.3992 19.8201 12.6867 19.5643 13.888 19.0672C15.0892 18.57 16.1807 17.8414 17.1001 16.9228C18.0195 16.0043 18.7488 14.9138 19.2463 13.7136C19.7439 12.5134 20 11.2271 20 9.92806C19.9362 7.29375 18.871 4.78252 17.0207 2.90468L17.0387 2.8777ZM13.6544 11.5737C14.0144 11.7536 14.3744 11.9335 14.5095 11.9784L14.5185 11.9964C14.6919 12.0575 14.8746 12.0879 15.0585 12.0863C15.0528 12.4825 14.9922 12.8759 14.8785 13.2554C14.4587 13.8287 13.8552 14.2412 13.1683 14.4245C12.6588 14.5239 12.1325 14.4929 11.6382 14.3345C11.4581 14.2446 11.2556 14.1772 11.0194 14.0985C10.7831 14.0198 10.5131 13.9299 10.198 13.795C8.45458 13.002 6.98106 11.7174 5.9586 10.0989C5.39448 9.36796 5.05098 8.49127 4.9685 7.57194C4.95338 7.18177 5.02644 6.79322 5.18227 6.43514C5.3381 6.07706 5.57268 5.75866 5.86859 5.5036C6.03885 5.34021 6.26281 5.24432 6.49865 5.23381H6.9487C7.12871 5.23381 7.21872 5.23381 7.48875 5.68345C7.75878 6.13309 8.29883 7.30216 8.29883 7.48201C8.29883 7.54573 8.31013 7.59816 8.32071 7.64729C8.34001 7.73687 8.35695 7.81551 8.29883 7.93165C8.25383 8.02158 8.20882 8.08903 8.16382 8.15647C8.11881 8.22392 8.07381 8.29137 8.0288 8.38129C7.93149 8.54799 7.81018 8.69949 7.66877 8.83093C7.6472 8.87403 7.62047 8.91196 7.59476 8.94844C7.51316 9.06421 7.44187 9.16536 7.57876 9.3705C7.91206 10.0231 8.37085 10.6038 8.92889 11.0791C9.47703 11.653 10.1566 12.0851 10.9091 12.3381C11.1791 12.4281 11.2691 12.4281 11.4491 12.2482C11.7409 11.9369 12.0115 11.6064 12.2592 11.259C12.4392 11.0791 12.5293 11.0791 12.7993 11.1691C12.9343 11.214 13.2943 11.3939 13.6544 11.5737Z" fill="white" />
                            </svg>
                        </i>
                        <span>WhatsApp</span>
                    </a>
                    <?php } ?>
                    <?php if(get_field('option_soc_telegram', 'option')) { ?>
                        <a href="<?php the_field('option_soc_telegram', 'option'); ?>" class="contact-form__head__flex__btn contact-form__head__flex__btn--telegram btn-with-icon" target="_blank">
                            <i class="icon">
                                <svg width="21" height="20" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.884691 6.69256L17.7346 0.574874C18.5167 0.308828 19.1997 0.754524 18.9463 1.86808L18.9477 1.86671L16.0787 14.5944C15.8661 15.4968 15.2967 15.7162 14.5001 15.2911L10.131 12.259L8.02369 14.1706C7.79068 14.3901 7.59407 14.5752 7.14261 14.5752L7.45281 10.3884L15.5501 3.50001C15.9025 3.20791 15.4714 3.04334 15.0069 3.33407L5.00032 9.26662L0.686628 7.99948C-0.249802 7.71972 -0.270191 7.11768 0.884691 6.69256Z" fill="white"></path>
                                </svg>
                            </i>
                            <span>Telegram</span>
                        </a>
                    <?php } ?>

                </div>

                <?php echo do_shortcode('[contact-form-7 id="c293a3a" title="Заявка на консультацию"]');?>


                <?php if(get_field('option-contact-form-2_text_under','option')){?>
                    <div class="contact-form__text contact-form__text__under">
                        <?php the_field('option-contact-form-2_text_under','option');?>
                    </div>
                <?php } ?>
            </div>

            <div class="contact-form-2__right">
                <?php if(get_field('option-contact-form-2_img','option')){
                    $cf2_image = get_field('option-contact-form-2_img','option');?>
                    <img src="<?php echo esc_url($cf2_image['url']); ?>"alt="<?php echo esc_attr($cf2_image['alt']); ?>" class="contact-form-2__right__img">
                <?php } ?>
            </div>

        </div>
    </div>
</section>


