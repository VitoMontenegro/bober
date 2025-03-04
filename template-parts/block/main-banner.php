<?php //Добавочный класс, если есть изображение
$main_banner_class = '';
if (get_field('main-banner_img_desktop') or get_field('main-banner_img_mobile')){
    $main_banner_class = ' main-banner--default-height';
} else if(get_field('main-banner_img_bcg')) {
    $main_banner_class = ' main-banner--text-height';
}
?>


<section class="section main-banner__section">
    <div class="container">
        <div class="main-banner<?php echo $main_banner_class;?>">

                <?php if(get_field('main-banner_img_bcg')){?>
                <img src="<?php the_field('main-banner_img_bcg');?>" alt="Бобёр Сервис" class="main-banner__background-img">
                <?php } ?>
                <div class="main-banner__background"></div>

            <div class="main-banner__wrap<?php if(get_field('main-banner_iframe-code')){echo' has-iframe-code';}?><?php if(get_field('main-banner_full-width')){echo' has-full-width';}?>">
                <?php if(get_field('main-banner_img_desktop') or get_field('main-banner_img_mobile')){?>
                <div class="main-banner__img-wrap">
                    <?php if(get_field('main-banner_img_desktop')){?>
                        <img src="<?php the_field('main-banner_img_desktop'); ?>" class="main-banner__img<?php if(get_field('main-banner_img_mobile')){echo' main-banner__img--desktop';}?>" alt="Бобёр Сервис">
                        <?php if(get_field('main-banner_img_mobile')){?>
                        <img src="<?php the_field('main-banner_img_mobile'); ?>" class="main-banner__img main-banner__img--mobile" alt="Бобёр Сервис">
                        <?php } ?>
                    <?php } ?>
                </div>
                <?php } ?>
                <?php if(get_field('main-banner_title')){?>
                    <h1 class="main-banner__title">
                        <?php the_field('main-banner_title');?>
                    </h1>
                <?php } elseif (is_front_page()) {?>
                <h1 class="display-none">Бобёр Сервис</h1>
                <?php  } ?>
                <?php if(get_field('main-banner_text')){?>
                    <div class="main-banner__text">
                        <?php the_field('main-banner_text');?>
                    </div>
                <?php } ?>


                <?php if(get_field('main-banner_iframe-code')){?>
                    <div class="main-banner__iframe-code">
                        <?php echo get_field('main-banner_iframe-code');?>
                    </div>
                <?php } ?>


            </div>

        </div>
    </div>
</section>

<?php if(is_front_page()){?>
    <div class="container under-main-banner__container">
        <button class="btn btn-orange under-main-banner__btn btn-modal-open--contact-form-popup">Вызвать мастера</button>
    </div>
<?php }?>