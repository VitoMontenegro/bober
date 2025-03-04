<section class="section accordion-price__section">

    <div class="container">

        <?php if(get_field('accordion-price_option_title')){?>
        <div class="accordion-price js-accordion-price-item-open">
            <div class="accordion-price__head">
                <h2 class="section-title"><?php the_field('accordion-price_option_title');?></h2>
                <i class="icon icon-caret">
                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="46" viewBox="0 0 45 46" fill="none">
                        <rect class="icon-caret__circle" y="0.86377" width="45" height="45" rx="22.5" fill="#99807A"></rect>
                        <path class="icon-caret__arrow" fill-rule="evenodd" clip-rule="evenodd" d="M29.2114 23.3531C29.2114 23.7975 29.0322 24.2237 28.7131 24.538L21.1175 32.0185C20.453 32.6729 19.3758 32.6729 18.7113 32.0185C18.0469 31.3641 18.0469 30.3032 18.7113 29.6488L25.1038 23.3531L18.7113 17.0575C18.0469 16.4031 18.0469 15.3422 18.7113 14.6878C19.3758 14.0334 20.453 14.0334 21.1175 14.6878L28.7131 22.1683C29.0322 22.4825 29.2114 22.9087 29.2114 23.3531Z" fill="white"></path>
                    </svg>
                </i>
            </div>
            <div class="accordion-price__content" style="display: block;">

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
            </div>
        </div>
        <?php } ?>

        <?php if (have_rows('price-table_accordion', 'option')): ?>
            <?php while (have_rows('price-table_accordion', 'option')): the_row(); ?>
                <div class="accordion-price">
                <div class="accordion-price__head">
                    <h2 class="section-title"><?php the_sub_field('price-table_accordion_title');?></h2>
                    <i class="icon icon-caret">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="46" viewBox="0 0 45 46" fill="none">
                            <rect class="icon-caret__circle" y="0.86377" width="45" height="45" rx="22.5" fill="#99807A"></rect>
                            <path class="icon-caret__arrow" fill-rule="evenodd" clip-rule="evenodd" d="M29.2114 23.3531C29.2114 23.7975 29.0322 24.2237 28.7131 24.538L21.1175 32.0185C20.453 32.6729 19.3758 32.6729 18.7113 32.0185C18.0469 31.3641 18.0469 30.3032 18.7113 29.6488L25.1038 23.3531L18.7113 17.0575C18.0469 16.4031 18.0469 15.3422 18.7113 14.6878C19.3758 14.0334 20.453 14.0334 21.1175 14.6878L28.7131 22.1683C29.0322 22.4825 29.2114 22.9087 29.2114 23.3531Z" fill="white"></path>
                        </svg>
                    </i>
                </div>

                <div class="accordion-price__content">

                    <?php
                    if (have_rows('price-table_accordion_table_list')):
                        while (have_rows('price-table_accordion_table_list')): the_row();?>
                    <div class="price-table__wrap custom-scroll--horizontal" data-mcs-axis="x">
                        <?php
                            $table_item = get_sub_field('price-table_accordion_table_item');
                            echo $table_item;?>
                    </div>
                        <?php endwhile;
                     endif;?>

                </div>
                </div>
            <?php endwhile;?>
        <?php endif; ?>



<!--        -->
<!--        <div class="accordion-price">-->
<!--            --><?php //if(get_field('accordion-price-2-col_title')){?>
<!--                <div class="accordion-price__head">-->
<!--                    <h2 class="section-title">--><?php //the_field('accordion-price-2-col_title');?><!--</h2>-->
<!--                    <i class="icon icon-caret">-->
<!--                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="46" viewBox="0 0 45 46" fill="none">-->
<!--                            <rect class="icon-caret__circle" y="0.86377" width="45" height="45" rx="22.5" fill="#99807A"></rect>-->
<!--                            <path class="icon-caret__arrow" fill-rule="evenodd" clip-rule="evenodd" d="M29.2114 23.3531C29.2114 23.7975 29.0322 24.2237 28.7131 24.538L21.1175 32.0185C20.453 32.6729 19.3758 32.6729 18.7113 32.0185C18.0469 31.3641 18.0469 30.3032 18.7113 29.6488L25.1038 23.3531L18.7113 17.0575C18.0469 16.4031 18.0469 15.3422 18.7113 14.6878C19.3758 14.0334 20.453 14.0334 21.1175 14.6878L28.7131 22.1683C29.0322 22.4825 29.2114 22.9087 29.2114 23.3531Z" fill="white"></path>-->
<!--                        </svg>-->
<!--                    </i>-->
<!--                </div>-->
<!--            --><?php //} ?>
<!---->
<!--            <div class="accordion-price__content">-->
<!--                <div class="price-table__wrap custom-scroll--horizontal" data-mcs-axis="x">-->
<!--                    <table class="price-table price-table--2-col">-->
<!--                        --><?php //if(get_field('accordion-price-2-col_head_th1') || get_field('accordion-price-2-col_head_th2')){?>
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>--><?php //the_field('accordion-price-2-col_head_th1');?><!--</th>-->
<!--                                <th>--><?php //the_field('accordion-price-2-col_head_th2');?><!--</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                        --><?php //} ?>
<!---->
<!--                        --><?php //if( have_rows('accordion-price-2-col_tbody') ): ?>
<!--                            <tbody>-->
<!--                            --><?php //while( have_rows('accordion-price-2-col_tbody') ): the_row(); ?>
<!--                                <tr>-->
<!--                                    <td>--><?php //the_sub_field('accordion-price-2-col_tbody_td1');?><!--</td>-->
<!--                                    <td>--><?php //the_sub_field('accordion-price-2-col_tbody_td2');?><!--</td>-->
<!--                                </tr>-->
<!--                            --><?php //endwhile; ?>
<!--                            </tbody>-->
<!--                        --><?php //endif; ?>
<!--                    </table>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->


    </div>
</section>
