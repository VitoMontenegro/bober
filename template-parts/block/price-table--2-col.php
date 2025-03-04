<div class="container price-table__container">

    <?php if(get_field('price-table-2-col_title')){?>
        <h2 class="section-title"><?php the_field('price-table-2-col_title');?></h2>
    <?php } ?>

    <div class="price-table__wrap custom-scroll--horizontal" data-mcs-axis="x">
        <table class="price-table price-table--2-col">
            <?php if(get_field('price-table-2-col_head_th1') || get_field('price-table-2-col_head_th2')){?>
            <thead>
                <tr>
                    <th><?php the_field('price-table-2-col_head_th1');?></th>
                    <th><?php the_field('price-table-2-col_head_th2');?></th>
                </tr>
            </thead>
            <?php } ?>

            <?php if( have_rows('price-table-2-col_tbody') ): ?>
                <tbody>
                <?php while( have_rows('price-table-2-col_tbody') ): the_row(); ?>
                <tr>
                    <td><?php the_sub_field('price-table-2-col_tbody_td1');?></td>
                    <td><?php the_sub_field('price-table-2-col_tbody_td2');?></td>
                </tr>
                    <?php endwhile; ?>
                </tbody>
            <?php endif; ?>
        </table>
    </div>
</div>