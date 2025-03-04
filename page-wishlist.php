<?php
/*
 Template Name: Стрнаица - Избранное
 */
?>
<?php
    $acfdata = '';
    if (isset($_COOKIE["wishlist"])) {
        $acfdata = explode(" ", $_COOKIE["wishlist"]);
    }
?>
<?php get_header(); ?>

    <main class="main__wishlist">
        <div class="content">
            <?php the_content();?>
        </div>

        <section class="section wishlist__section">
            <div class="container">

                <h1><?php the_title();?></h1>
                <?php if($acfdata){?>
                    <div class="product-flex catalog__list wishlist">
                        <?php // Аренда
                        $args = array( 'post_type' => 'product_arenda', 'order_by' => 'date', 'order' => 'ASC', 'post__in' => $acfdata, );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                            ?>

                            <?php get_template_part('/template-parts/loop-arenda-item'); ?>

                        <?php endwhile; ?>

                        <?php //Продажа
                        $args = array( 'post_type' => 'product', 'order_by' => 'date', 'order' => 'ASC', 'post__in' => $acfdata, );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                            ?>

                            <?php get_template_part('/template-parts/loop-product-item'); ?>

                        <?php endwhile; ?>

                    </div>
                <?php } else { ?>
                    <p>В избранном пока ничего нет</p>
                <?php }  ?>


            </div>
        </section>

    </main>

<?php get_footer(); ?>