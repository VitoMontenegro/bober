<section class="section info-block-2__section">
    <div class="container">
        <div class="info-block-2">
            <?php if(get_field('infoblock-2_title')){?>
                <h2 class="section-title"><?php the_field('infoblock-2_title');?></h2>
            <?php } ?>
            <?php if(get_field('infoblock-2_text')){?>
            <div class="info-block-2__text">
                <?php the_field('infoblock-2_text');?>
            </div>
            <?php } ?>

            <?php $infoblock_2_image = get_field('infoblock-2_img');?>
            <?php if( !empty($infoblock_2_image) ){ ?>
                <img src="<?php echo $infoblock_2_image['url']; ?>" alt="<?php echo $infoblock_2_image['alt']; ?>" class="info-block-2__img">
            <?php } ?>

        </div>
    </div>
</section>