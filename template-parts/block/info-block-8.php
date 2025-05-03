<?php
$fields = get_fields();
$left_title = (isset($fields['info-block-8_left_title']) && !empty($fields['info-block-8_left_title'])) ? $fields['info-block-8_left_title'] : '';
$left_text = (isset($fields['info-block-8_left_text']) && !empty($fields['info-block-8_left_text'])) ? $fields['info-block-8_left_text'] : '';
$right_title = (isset($fields['info-block-8_right_title']) && !empty($fields['info-block-8_right_title'])) ? $fields['info-block-8_right_title'] : '';
$right_text = (isset($fields['info-block-8_right_text']) && !empty($fields['info-block-8_right_text'])) ? $fields['info-block-8_right_text'] : '';


?>
<section class="section info-block-8__section">
    <div class="container">
        <?php if($left_title || $left_text): ?>
            <div class="info-block-8">
                <div class="info-block-8__left">
                    <?php if($left_title){?>
                        <h2 class="section-title"><?php echo $left_title;?></h2>
                    <?php } ?>

                    <?php if($left_text){?>
                        <div class="info-block-8__left__text"><?php echo $left_text;?></div>
                    <?php } ?>
                </div>
                <div class="info-block-8__right">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/info-block-8_bcg.svg" alt="icon" class="info-block-8__right__background">
                </div>
            </div>
        <?php endif; ?>

        <?php if($right_title || $right_text){?>
        <div class="info-block-8__bottom">
            <div class="info-block-8__bottom__wrap">
                <?php if($right_title){?>
                    <div class="info-block-8__bottom__title"><?php echo $right_title;?></div>
                <?php } ?>
                <?php if($right_text){?>
                    <div class="info-block-8__bottom__text"><?php echo $right_text;?></div>
                <?php } ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/info-block-8_bcg.svg" alt="icon" class="info-block-8__bottom__background">
            </div>
        </div>
        <?php } ?>

    </div>
</section>
