<?php
/*
 Template Name: page-default
 */
?>
<?php get_header(); ?>

<main>

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

</main>

<?php get_footer(); ?>
