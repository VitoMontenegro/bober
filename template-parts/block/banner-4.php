<section class="section banner-4__section">
    <div class="container">
        <div class="banner-4">
            <?php if(get_field('banner-4_title')){?>
            <h2 class="banner-4__title"><?php the_field('banner-4_title');?></h2>
            <?php } ?>
            <?php if(get_field('banner-4_text')){?>
            <div class="banner-4__text"><?php the_field('banner-4_text');?></div>
            <?php } ?>
            <?php if(get_field('banner-4_btn-text')){?>
            <button class="btn btn-orange banner-4__btn"><?php the_field('banner-4_btn-text');?></button>
            <?php } ?>

            <img src="<?php echo get_template_directory_uri(); ?>/images/banner-4_main.svg" class="banner-4__img-main" alt="">
            <img src="<?php echo get_template_directory_uri(); ?>/images/banner-4_background.png" class="banner-4__img-background" alt="">
            <div class="banner-4__svg-background">
                <svg width="891" height="380" viewBox="0 0 891 380" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="194" cy="190" r="697" fill="url(#paint0_radial_6408_11204)" />
                    <defs>
                        <radialGradient id="paint0_radial_6408_11204" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(194 190) rotate(90) scale(697)">
                            <stop stop-color="#FAF0EB" />
                            <stop offset="1" stop-color="#FAF0EB" stop-opacity="0" />
                        </radialGradient>
                    </defs>
                </svg>
            </div>
        </div>
    </div>
</section>