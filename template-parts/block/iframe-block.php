<section class="section iframe-block__section">
    <div class="container">
        <?php if(get_field('iframe-block_title')){?>
            <h2 class="section-title"><?php the_field('iframe-block_title');?></h2>
        <?php } ?>

        <?php if(get_field('iframe-block_code')){?>
            <div class="iframe-block_code-wrap">
                <?php echo get_field('iframe-block_code');?>
            </div>
        <?php } ?>
    </div>
</section>
