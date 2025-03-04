<section class="section contact-form__section contact-form-1__section decoration_6 decoration_7">
    <div class="container">
        <?php if(get_field('option-contact-form-1_title_desktop','option')){?>
            <h2 class="section-title<?php if(get_field('option-contact-form-1_title_mobile','option')){echo' is-desktop';}?>"><?php the_field('option-contact-form-1_title_desktop','option');?></h2>
            <?php if(get_field('option-contact-form-1_title_mobile','option')){?>
            <div class="section-title is-mobile"><?php the_field('option-contact-form-1_title_mobile','option');?></div>
            <?php } ?>
        <?php } ?>

        <?php if(get_field('option-contact-form-1_text','option')){?>
        <div class="contact-form__text">
            <?php the_field('option-contact-form-1_text','option');?>
        </div>
        <?php } ?>

        <div class="contact-form">
            <?php echo do_shortcode('[contact-form-7 id="2a55fe9" title="Заявка на консультацию (whatsapp)"]');?>
        </div>

        <?php if(get_field('option-contact-form-1_text_under','option')){?>
            <div class="contact-form__text">
                <?php the_field('option-contact-form-1_text_under','option');?>
            </div>
        <?php } ?>
    </div>
</section>