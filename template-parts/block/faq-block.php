<section class="section faq-block__section">
    <div class="container">
        <div class="section__header">
            <?php if(get_field('faq-block_title')){?>
                <h2 class="section-title"><?php the_field('faq-block_title');?></h2>
            <?php } ?>
            <button class="btn btn-orange faq-block__btn--js faq-block__btn--open-all">Открыть все</button>
        </div>
        <?php if(get_field('faq-block_subtitle')){?>
            <div class="default-page__text"><?php the_field('faq-block_subtitle');?></div>
        <?php } ?>


        <?php if( have_rows('faq-block_item') ): ?>
        <div class="faq-block">
            <?php while( have_rows('faq-block_item') ): the_row(); ?>
            <div class="faq-block__item">
                <div class="faq-block__item__head">
                    <i class="icon icon-faq">
                        <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5004 5.0261C12.0296 5.0261 5.16269 11.893 5.16269 20.3638C5.16269 28.8346 12.0296 35.7015 20.5004 35.7015C28.9712 35.7015 35.8381 28.8346 35.8381 20.3638C35.8381 11.893 28.9712 5.0261 20.5004 5.0261ZM0.802734 20.3638C0.802734 9.48509 9.62168 0.666138 20.5004 0.666138C31.3791 0.666138 40.1981 9.48509 40.1981 20.3638C40.1981 31.2425 31.3791 40.0615 20.5004 40.0615C9.62168 40.0615 0.802734 31.2425 0.802734 20.3638ZM20.5004 12.6901C19.324 12.6901 18.301 13.6732 18.301 14.9722C18.301 16.1762 17.325 17.1522 16.121 17.1522C14.917 17.1522 13.941 16.1762 13.941 14.9722C13.941 11.3425 16.8395 8.33013 20.5004 8.33013C24.1613 8.33013 27.0598 11.3425 27.0598 14.9722C27.0598 17.8424 25.2474 20.3267 22.6788 21.2406C22.6786 21.5993 22.6785 21.9943 22.6785 22.4091C22.6785 23.6131 21.7025 24.5891 20.4985 24.5891C19.2945 24.5891 18.3185 23.6131 18.3185 22.4091C18.3185 21.5869 18.319 20.8425 18.3195 20.3037L18.3204 19.4315C18.3221 18.2288 19.2976 17.2544 20.5004 17.2544C21.6769 17.2544 22.6999 16.2713 22.6999 14.9722C22.6999 13.6732 21.6769 12.6901 20.5004 12.6901ZM20.4985 26.9427C21.7025 26.9427 22.6785 27.9187 22.6785 29.1227V29.1996C22.6785 30.4036 21.7025 31.3796 20.4985 31.3796C19.2945 31.3796 18.3185 30.4036 18.3185 29.1996V29.1227C18.3185 27.9187 19.2945 26.9427 20.4985 26.9427Z" fill="white" />
                        </svg>
                    </i>
                    <?php if(get_sub_field('faq-block_item_head')){?>
                    <div class="faq-block__item__head__name">
                        <?php the_sub_field('faq-block_item_head');?>
                    </div>
                    <?php } ?>
                    <i class="icon icon-caret">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="46" viewBox="0 0 45 46" fill="none">
                            <rect class="icon-caret__circle" y="0.86377" width="45" height="45" rx="22.5" fill="#99807A"/>
                            <path class="icon-caret__arrow" fill-rule="evenodd" clip-rule="evenodd" d="M29.2114 23.3531C29.2114 23.7975 29.0322 24.2237 28.7131 24.538L21.1175 32.0185C20.453 32.6729 19.3758 32.6729 18.7113 32.0185C18.0469 31.3641 18.0469 30.3032 18.7113 29.6488L25.1038 23.3531L18.7113 17.0575C18.0469 16.4031 18.0469 15.3422 18.7113 14.6878C19.3758 14.0334 20.453 14.0334 21.1175 14.6878L28.7131 22.1683C29.0322 22.4825 29.2114 22.9087 29.2114 23.3531Z" fill="white"/>
                        </svg>
                    </i>
                </div>
                <?php if(get_sub_field('faq-block_item_content')){?>
                <div class="faq-block__item__content">
                    <?php the_sub_field('faq-block_item_content');?>
                </div>
                <?php } ?>
            </div>
            <?php endwhile; ?>

        </div>
        <?php endif; ?>

    </div>

   <!-- <button class="btn btn-orange btn-full-width btn__after-section faq-block__btn--js faq-block__btn--open-all">Открыть все</button>-->
</section>
