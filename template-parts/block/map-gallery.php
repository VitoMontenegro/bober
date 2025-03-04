<section class="section map-gallery__section" id="map-gallery__section">
    <div class="container">
        <?php if(get_field('map-gallery_title')){?>
        <h2 class="section-title text-align-left"><?php the_field('map-gallery_title');?></h2>
        <?php } ?>
        <?php if(get_field('map-gallery_text')){?>
        <div class="default-page__text">
            <?php the_field('map-gallery_text');?>
        </div>
        <?php } ?>

        <div class="map-gallery">
            <div class="map-gallery__map-block">
                <div class="map-gallery__map-block__wrap">
                    <?php if(get_field('iframe-block_code')): ?>
                        <div class="map-gallery__map grid grid-cols-12 gap-32">
                            <div class="col-span-12 md-col-span-6 ">
                                <div class="iframe-block_code-wrap h-full">
                                    <?php echo get_field('iframe-block_code');?>
                                </div>
                            </div>
                            <div class="col-span-12 md-col-span-6 ">
                                <img src="/wp-content/uploads/2024/08/map-gallery_map-img-desk.jpg" alt="Карта" class="map-gallery__map__img">
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="map-gallery__map">
                            <img src="/wp-content/uploads/2024/08/map-gallery_map-img-desk.jpg" alt="Карта" class="map-gallery__map__img">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="map-gallery__map-block__info">
                    <?php if(get_field('map-gallery_map_address')){?>
                    <div class="map-gallery__map-block__info__text"><?php the_field('map-gallery_map_address');?></div>
                    <?php } ?>
                    <button class="map-gallery__map-block__info__btn btn-modal-open--contact-form-popup">Запись на тестирование</button>
                </div>
            </div>

            <?php /*
            $map_gallery_gallery = get_field('map-gallery_gallery');
            if( $map_gallery_gallery ): ?>

            <div class="map-gallery__gallery">
                <div class="swiper mySwiper map-gallery__slider">
                    <div class="swiper-wrapper">

                        <?php foreach( $map_gallery_gallery as $item ): ?>
                        <div class="swiper-slide">
                            <a href="<?php echo esc_url($item['url']); ?>" data-fancybox="map_gallery">
                                <img src=<?php echo esc_url($item['url']); ?>" alt="<?php echo esc_attr($item['alt']); ?>">
                            </a>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

            <?php endif; */ ?>

            <div class="map-gallery__slider__pagination"></div>
        </div>

    </div>
</section>


