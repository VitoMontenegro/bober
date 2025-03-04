<?php
/*
 Template Name: index
 */
?>
<?php get_header(); ?>
<?php if(is_woocommerce()){?>
    <main>
        <section class="section main-banner__section">
            <div class="container">
                <h1><?php the_title();?></h1>
                <div class="content">
                    <?php the_content();?>
                </div>
            </div>
        </section>

    </main>
    <?php } ?>

<?php get_footer(); ?>