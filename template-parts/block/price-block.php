<section class="section price-block__section">
    <div class="container">
        <div class="section__header">
            <?php if(get_field('price-block_title')){?>
                <h2 class="section-title"><?php the_field('price-block_title');?></h2>
            <?php } ?>
            <a href="/price/" class="btn btn-orange">Прайс на все услуги</a>
        </div>
        <?php if(get_field('price-block_text')){?>
        <div class="default-page__text">
            <?php the_field('price-block_text');?>
        </div>
        <?php } ?>

        <?php if( have_rows('price-block_item') ): ?>
        <div class="price-block">
            <?php while( have_rows('price-block_item') ): the_row(); ?>
            <div class="price-block__item">
                <div class="price-block__item__top">
                    <?php if(get_sub_field('price-block_item_name')){?>
                    <div class="price-block__item__top__name">
                        <?php the_sub_field('price-block_item_name');?>
                    </div>
                    <?php } ?>
                    <?php if(get_sub_field('price-block_item_time')){?>
                    <div class="price-block__item__top__text">
                        Время: <span class="color-orange"><?php the_sub_field('price-block_item_time');?></span>
                    </div>
                    <?php } ?>
                </div>
                <div class="price-block__item__bottom">
                    <?php if(get_sub_field('price-block_item_price')){?>
                    <div class="price-block__item__bottom__price">
                        <?php the_sub_field('price-block_item_price');?>
                    </div>
                    <?php } ?>
                    <?php if(get_sub_field('price-block_item_price-text')){?>
                    <div class="price-block__item__bottom__text">
                        <?php the_sub_field('price-block_item_price-text');?>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <?php endwhile; ?>
        </div>
        <?php endif; ?>

    </div>

    <a href="/price/" class="btn btn-orange btn-full-width btn__after-section">Прайс на все услуги</a>
</section>