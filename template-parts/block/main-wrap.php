<div class="container main-wrap main__wrap"<?php if(get_field('main-wrap_max-width')){?>  style="max-width: <?php the_field('main-wrap_max-width');?>px"<?php } ?>>
    <?php if(get_field('main-wrap_title')){?>
    <h1 class="main-title">
        <?php the_field('main-wrap_title');?>
    </h1>
    <?php } ?>
    <?php if(get_field('main-wrap_desc')){?>
    <div class="main-desc">
        <?php the_field('main-wrap_desc');?>
    </div>
    <?php } ?>
</div>


