<section class="section checkboxes-block__section">
    <div class="container">
        <?php if(get_field('checkboxes-block_title')){?>
            <h2 class="section-title text-align-left"><?php the_field('checkboxes-block_title');?></h2>
        <?php } ?>

        <div class="checkboxes-block">
            <?php $count=0;?>
            <?php if( have_rows('checkboxes-block_item') ): ?>

                <?php while( have_rows('checkboxes-block_item') ): the_row(); ?>
                    <label class="checkboxes-block__item">
                        <input type="checkbox" name="name_<?php echo $count;?>" class="checkboxes-block__item__checkbox">
                        <span class="checkboxes-block__item__checkbox-decoration"></span>
                        <span class="checkboxes-block__item__background"></span>
                        <span class="checkboxes-block__item__text"><?php the_sub_field('checkboxes-block_item_text');?></span>
                    </label>
                    <?php $count++;?>
                <?php endwhile; ?>

            <?php endif;?>

            <button class="checkboxes-block__item checkboxes-block__item--link btn-modal-open--contact-form-popup btn-add-hidden-info--checkboxes-block">Другая проблема</button>
            <button class="checkboxes-block__item checkboxes-block__item--link checkboxes-block__item--link-main btn-modal-open--contact-form-popup btn-add-hidden-info--checkboxes-block">Проконсультироваться</button>
        </div>
    </div>
</section>