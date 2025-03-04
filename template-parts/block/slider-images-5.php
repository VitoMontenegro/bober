<section class="section default-block__section custom-1__section <?php // echo ' decoration_4';?>">
    <div class="container">
        <?php if(get_field('slider-images-5_title_desktop')){?>
            <h2 class="section-title<?php if(get_field('slider-images-5_title_mobile')){echo' is-desktop';}?>"><?php the_field('slider-images-5_title_desktop');?></h2>
            <?php if(get_field('slider-images-5_title_mobile')){?>
            <div class="section-title is-mobile"><?php the_field('slider-images-5_title_mobile');?></div>
            <?php } ?>
        <?php } ?>
        <?php if(get_field('slider-images-5_text')){?>
            <div class="default-block__text">
                <?php the_field('slider-images-5_text');?>
            </div>
        <?php } ?>
    </div>

    <?php
    $images_logos = get_field('slider-images-5_logos');
    if( $images_logos ): ?>
    <div class="slider-logos__container">
        <div class="slider-default slider-logos owl-carousel">
            <?php foreach( $images_logos as $image ): ?>
                <div class="slider-logos__item"><img src="<?php echo $image; ?>" class="slider-logos__item__img" alt=""></div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="container">
        <?php if(get_field('slider-images-5_slider_title')){?>
            <h3 class="custom-1__slider-title"><?php the_field('slider-images-5_slider_title');?></h3>
        <?php } ?>
    </div>

    <?php
    $images_slider = get_field('slider-images-5_slider');
    if( $images_slider ): ?>
        <div class="slider-default slider-default--cert owl-carousel">
            <?php foreach( $images_slider as $image ): ?>
                <a href="<?php echo $image; ?>" class="slider-default__item" data-fancybox="gallery_cert">
                    <img src="<?php echo $image; ?>" alt="сертификат">
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</section>