<div class="container price-table__container">

    <?php if(get_field('price-table-page')){?>
        <h2 class="section-title"><?php the_field('price-table-page');?></h2>
    <?php } ?>

    <?php if(get_field('price-table-page_text')){?>
        <div class="price-table__text">
            <?php the_field('price-table-page_text');?>
        </div>
    <?php } ?>

    <div class="price-table__wrap custom-scroll--horizontal" data-mcs-axis="x">
        <table class="price-table price-table--2-col">
            <?php if(get_field('price-table-2-col_head_th1', 'option') || get_field('price-table-2-col_head_th2', 'option')){?>
                <thead>
                <tr>
                    <th><?php the_field('price-table-2-col_head_th1', 'option');?></th>
                    <th><?php the_field('price-table-2-col_head_th2', 'option');?></th>
                </tr>
                </thead>
            <?php } ?>

            <?php if( have_rows('price-table-2-col_tbody', 'option') ): ?>
                <tbody>
                <?php while( have_rows('price-table-2-col_tbody', 'option') ): the_row(); ?>
                    <tr>
                        <td><?php the_sub_field('price-table-2-col_tbody_td1', 'option');?></td>
                        <td><?php the_sub_field('price-table-2-col_tbody_td2', 'option');?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            <?php endif; ?>
        </table>
    </div>

    <a href="/price/" class="btn btn-orange btn-after-center margin-bottom-20">Полный прайс на услуги</a>
</div>
