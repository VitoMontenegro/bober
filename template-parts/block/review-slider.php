
<section class="section review-slider__section">
    <div class="container">
        <div class="section__header">
            <?php if(get_field('review-slider_title')){?>
                <h2 class="section-title"><?php the_field('review-slider_title');?></h2>
            <?php } ?>
            <a href="/reviews/" class="btn btn-orange">Все отзывы</a>
        </div>

        <div class="slider-default review-slider">
            <div class="swiper-wrapper">

        <?php
        $featured_posts = get_field('review-slider');?>
        <?php if( $featured_posts ): ?>
                <?php foreach( $featured_posts as $featured_post ):
                $title = get_the_title( $featured_post->ID );
                $thumbnail_url = get_the_post_thumbnail_url( $featured_post->ID );
                $content = get_the_content( null, null, $featured_post->ID );
                $review_content = get_field( 'review_content', $featured_post->ID );
                $review_logo = get_field( 'review_logo', $featured_post->ID );
                $review_video = get_field( 'review_iframe-code', $featured_post->ID );
                ?>
                <div class="review-slider__item swiper-slide">
                    <div class="review-slider__item__preview">
                        <img src="<?php echo $thumbnail_url; ?>" class="review-slider__item__preview__img" alt="<?php echo $title; ?>">
                    </div>
                    <div class="review-slider__item__content custom-scroll">
                        <div class="review-slider__item__name">
                            <?php echo $title; ?>
                        </div>
                        <?php if($review_content){?>
                        <div class="review-slider__item__text">
                            <?php echo $review_content;?>
                        </div>
                        <?php } ?>

                        <?php if($review_video){?>

                        <div class="review-slider__item__video youtube-video__wrap">

                            <img src="//img.youtube.com/vi/<?php echo $review_video;?>/maxresdefault.jpg" data-idYoutube="<?php echo $review_video;?>" class="review-slider__item__video__preview youtube-video__preview">
                            <div class="youtube-video__iframe-block" id="youtube-video__iframe-block__id-<?php echo $GLOBALS['youtube_id'];?>"></div><?php $GLOBALS['youtube_id']++;?>

                            <button class="review-slider__item__video__btn-play youtube-video__hidden-btn-play">
                                <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="110" height="110" rx="55" fill="white"></rect>
                                    <path d="M43 67.5032V42.4968C43 39.7778 43 38.4183 43.5588 37.6543C44.0458 36.9884 44.7919 36.5694 45.605 36.5051C46.5379 36.4314 47.6676 37.1564 49.927 38.6064L69.409 51.1096C71.4214 52.4011 72.4276 53.0469 72.7734 53.8719C73.0755 54.5925 73.0755 55.4075 72.7734 56.1281C72.4276 56.9531 71.4214 57.5989 69.409 58.8904L49.927 71.3936C47.6676 72.8436 46.5379 73.5686 45.605 73.4949C44.7919 73.4306 44.0458 73.0116 43.5588 72.3457C43 71.5817 43 70.2222 43 67.5032Z" fill="#EB6025"></path>
                                </svg>
                            </button>
                        </div>

                        <?php } ?>

                    </div>
                    <?php if($review_logo){?>
                    <div class="review-slider__item__logo">
                        <img src="<?php echo $review_logo;?>" class="review-slider__item__logo__img" alt="лого">
                    </div>
                    <?php } ?>
                </div>
                <?php endforeach; ?>
        <?php endif; ?>

    </div>

            <div class="swiper-pagination"></div>
            <div class="swiper-button__nav">
                <div class="swiper-button__nav__button swiper-button__nav__button--prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                        <rect width="44" height="44" rx="22" fill="#EB6025"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5633 23.025C15.9834 22.4539 15.9834 21.5279 16.5633 20.9568L23.1922 14.4283C23.7721 13.8572 24.7122 13.8572 25.2921 14.4283C25.872 14.9994 25.872 15.9254 25.2921 16.4965L19.7132 21.9909L25.2921 27.4853C25.872 28.0564 25.872 28.9824 25.2921 29.5535C24.7122 30.1246 23.7721 30.1246 23.1922 29.5535L16.5633 23.025Z" fill="white"/>
                    </svg>
                </div>
                <div class="swiper-button__nav__button swiper-button__nav__button--next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44" fill="none">
                        <rect width="44" height="44" rx="22" transform="matrix(-1 0 0 1 44 0)" fill="#EB6025"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M27.4367 23.025C28.0166 22.4539 28.0166 21.5279 27.4367 20.9568L20.8078 14.4283C20.2279 13.8572 19.2878 13.8572 18.7079 14.4283C18.128 14.9994 18.128 15.9254 18.7079 16.4965L24.2868 21.9909L18.7079 27.4853C18.128 28.0564 18.128 28.9824 18.7079 29.5535C19.2878 30.1246 20.2279 30.1246 20.8078 29.5535L27.4367 23.025Z" fill="white"/>
                    </svg>
                </div>
            </div>
    </div>

    <a href="/reviews/" class="btn btn-orange btn-full-width btn__after-section">Все отзывы</a>

</section>

