<?php
/*
 Template Name: Отзывы
 */
?>
<?php get_header(); ?>

<main>
    <section class="section">
        <div class="container">
            <h1><?php the_title();?></h1>
            <div class="content">
                <?php the_content();?>
                <div class="review-slider__wrap">
                <?php
                $blog_list = get_posts(array(
                    'posts_per_page'	=> -1,
                    'post_type'		=> 'reviews',
                ));
                if( $blog_list ): ?>
                    <?php foreach( $blog_list as $featured_post ):
                        $title = get_the_title( $featured_post->ID );
                        $thumbnail_url = get_the_post_thumbnail_url( $featured_post->ID );
                        $content = get_the_content( null, null, $featured_post->ID );
                        $review_logo = get_field( 'review_logo', $featured_post->ID );

                        ?>
                        <div class="review-slider__item">
                            <div class="review-slider__item__preview">
                                <img src="<?php echo $thumbnail_url; ?>" class="review-slider__item__preview__img" alt="<?php echo $title; ?>">
                            </div>
                            <div class="review-slider__item__name">
                                <?php echo $title; ?>
                            </div>
                            <div class="review-slider__item__text">
                                <?php echo $content;?>
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

            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
