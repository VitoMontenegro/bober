<?php

$blog_list = get_posts(array(
    'posts_per_page'	=> -1,
    'post_type'		=> 'post',
));


?>
<?php if( $blog_list ): ?>
<section class="section blog-slider__section">
    <div class="container">
        <div class="section__header">
            <?php if(get_field('blog-slider_title_mobile')){?>
            <h2 class="section-title<?php if(get_field('blog-slider_title_mobile')){echo' is-desktop';}?>"><?php the_field('blog-slider_title_desktop');?></h2>
                <?php if(get_field('blog-slider_title_mobile')){?>
                <div class="section-title is-mobile"><?php the_field('blog-slider_title_mobile');?></div>
                <?php } ?>
            <?php } ?>
            <a href="/blog/" class="btn btn-orange">Перейти в блог</a>
        </div>


        <div class="slider-default blog-slider">
            <div class="swiper-wrapper">

            <?php foreach( $blog_list as $featured_post ):

                $title = get_the_title( $featured_post->ID );
                $permalink = get_the_permalink( $featured_post->ID );
                $thumbnail_url = get_the_post_thumbnail_url( $featured_post->ID );
                $excerpt = get_the_excerpt( $featured_post->ID );
                $post_minutes = get_field( 'blog-single_minutes', $featured_post->ID );

                ?>
                <div class="blog-slider__item swiper-slide">
                    <a href="<?php echo $permalink; ?>" class="blog-slider__item__preview">
                        <img src="<?php echo $thumbnail_url; ?>" class="blog-slider__item__preview__img" alt="<?php echo $title;?>">
                    </a>
                    <?php $tags = get_the_tags( $featured_post->ID );
                    if($tags){?>
                        <div class="blog-slider__item__tags">
                            <?php foreach($tags as $tag){?>
                                <div class="blog-slider__item__tags__item"><?php echo $tag->name;?></div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <a href="<?php echo $permalink; ?>" class="blog-slider__item__title">
                        <?php echo $title;?>
                    </a>
                    <div class="blog-slider__item__excerpt"><?php echo $excerpt;?></div>
                    <div class="blog-slider__item__time">
                        <i class="icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.9987 1.10672C17.9987 0.495495 17.5047 0 16.8954 0H3.10427C2.49494 0 2.00098 0.495495 2.00098 1.10672C2.00098 1.71794 2.49494 2.21344 3.10427 2.21344H3.72487V3.72256C3.72487 4.65918 4.04683 5.56716 4.63646 6.29341L7.46865 9.78184C7.63211 9.98317 7.6291 10.257 7.45889 10.4556L4.70575 13.6682C4.07288 14.4066 3.72487 15.3482 3.72487 16.3221V17.7866H3.10427C2.49494 17.7866 2.00098 18.2821 2.00098 18.8933C2.00098 19.5045 2.49494 20 3.10427 20H16.8954C17.5047 20 17.9987 19.5045 17.9987 18.8933C17.9987 18.2821 17.5047 17.7866 16.8954 17.7866H16.2748V16.3221C16.2748 15.3482 15.9268 14.4066 15.2939 13.6682L12.5408 10.4556C12.3706 10.257 12.3676 9.98317 12.531 9.78184L15.3632 6.29341C15.9529 5.56716 16.2748 4.65918 16.2748 3.72256V2.21344H16.8954C17.5047 2.21344 17.9987 1.71794 17.9987 1.10672ZM14.0682 2.21344V3.72256C14.0682 4.14995 13.9213 4.56427 13.6523 4.89567L10.8201 8.3841C9.98087 9.41774 10.0017 10.8882 10.8675 11.8985L13.6206 15.1111C13.9094 15.448 14.0682 15.8777 14.0682 16.3221V17.7866H5.93145V16.3221C5.93145 15.8777 6.09025 15.448 6.37904 15.1111L9.13217 11.8985C9.99799 10.8882 10.0188 9.41774 9.17961 8.3841L6.34742 4.89567C6.07837 4.56427 5.93145 4.14995 5.93145 3.72256V2.21344H14.0682Z" fill="#99807A" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8954 0H3.10427C2.49494 0 2.00098 0.495495 2.00098 1.10672C2.00098 1.71794 2.49494 2.21344 3.10427 2.21344H3.72487V3.72256C3.72487 4.65918 4.04683 5.56716 4.63646 6.29341L7.46865 9.78184C7.63211 9.98317 7.6291 10.257 7.45889 10.4556L4.70575 13.6682C4.07288 14.4066 3.72487 15.3482 3.72487 16.3221V17.7866H3.10427C2.49494 17.7866 2.00098 18.2821 2.00098 18.8933C2.00098 19.5045 2.49494 20 3.10427 20H16.8954C17.5047 20 17.9987 19.5045 17.9987 18.8933C17.9987 18.2821 17.5047 17.7866 16.8954 17.7866H16.2748V16.3221C16.2748 15.3482 15.9268 14.4066 15.2939 13.6682L12.5408 10.4556C12.3706 10.257 12.3676 9.98317 12.531 9.78184L15.3632 6.29341C15.9529 5.56716 16.2748 4.65918 16.2748 3.72256V2.21344H16.8954C17.5047 2.21344 17.9987 1.71794 17.9987 1.10672C17.9987 0.495495 17.5047 0 16.8954 0ZM14.0682 3.72256V2.21344H5.93145V3.72256C5.93145 4.14995 6.07837 4.56427 6.34742 4.89567L9.17961 8.3841C10.0188 9.41774 9.99799 10.8882 9.13217 11.8985L6.37904 15.1111C6.09025 15.448 5.93145 15.8777 5.93145 16.3221V17.7866H14.0682V16.3221C14.0682 15.8777 13.9094 15.448 13.6206 15.1111L10.8675 11.8985C10.0017 10.8882 9.98087 9.41774 10.8201 8.3841L13.6523 4.89567C13.9213 4.56427 14.0682 4.14995 14.0682 3.72256Z" fill="#99807A" />
                            </svg>
                        </i>
                        <div class="blog-slider__item__time__minutes"><?php echo $post_minutes;?></div>
                    </div>
                </div>

            <?php endforeach; ?>

            </div>

            <div class="swiper-pagination"></div>


        </div>
        <a href="/blog/" class="btn btn-orange btn-full-width btn__after-section">Перейти в блог</a>
</section>
<?php endif; ?>
