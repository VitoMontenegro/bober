<?php
if( have_rows('main-info') ):?>

<section class="section main-info__section decoration_1 decoration_2">
    <div class="container">
    <?php $count=0; ?>
    <?php while( have_rows('main-info') ) : the_row(); ?>

        <div class="main-info<?php if($count % 2 !== 0 ){echo' main-info--reverse';}?>">
            <?php if(get_sub_field('main-info_img_desktop')){?>
            <div class="main-info__img-wrap">
                <img src="<?php the_sub_field('main-info_img_desktop'); ?>" class="main-info__img" alt="Бобёр">

            </div>
            <?php } ?>
            <div class="main-info__content">

                <?php if(get_sub_field('main-info_title') && get_sub_field('main-info_title_link') ){?>
                    <h2 class="main-info__content__title section-title"><a href="<?php the_sub_field('main-info_title_link');?>"><?php the_sub_field('main-info_title');?></a></h2>
                <?php } elseif(get_sub_field('main-info_title')){ ?>
                    <h2 class="main-info__content__title section-title"><?php the_sub_field('main-info_title');?></h2>
                <?php } ?>

                <?php if(get_sub_field('main-info_text')){?>
                <div class="main-info__content__text">
                    <?php the_sub_field('main-info_text');?>
                </div>
                <?php } ?>
                <?php if( have_rows('main-info_link') ){?>
                    <div class="main-info__content__links">
                        <?php
                            while( have_rows('main-info_link') ) { the_row();
                            $link = get_sub_field('main-info_link-item');
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>

                                <?php if($link_url == '#'){//Если ссылка = #?>
                                    <div class="main-info__content__links__item"><?php echo esc_html( $link_title ); ?></div>
                                <?php } elseif ($link_title == 'Подробнее'){ //подробнее?>
                                    <a class="main-info__content__links__item-last" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                            <path d="M3.33451 21.5L0.5 19.3309L7.35211 10.9881L0.5 2.66913L3.33451 0.5L11.9613 10.9881L3.33451 21.5ZM12.8732 21.5L10.0141 19.3309L16.8908 10.9881L10.0141 2.66913L12.8732 0.5L21.5 10.9881L12.8732 21.5Z" fill="#EB6025"/>
                                        </svg>
                                        <span><?php echo esc_html( $link_title ); ?></span>
                                    </a>
                                <?php } else { //Обычная ссылка ?>
                                    <a class="main-info__content__links__item is-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                <?php } ?>
                            <?php } ?>
                    </div>
                <?php } ?>

            </div>
        </div>
        <?php $count++;?>
        <?php endwhile;?>

    </div>
</section>

<?php endif;?>