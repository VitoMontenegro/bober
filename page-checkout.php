<?php
/*
 Template Name: Оформление заказа
 */
?>
<?php get_header(); ?>

<main>
    <section class="section main-banner__section">
        <div class="container woocommerce-checkout__container">
            <h1>Корзина</h1>
            <div class="content">

                <?php  echo do_shortcode('[woocommerce_checkout]');?>

                <?php // the_content();?>
            </div>
        </div>

    </section>
</main>

<?php get_footer(); ?>

