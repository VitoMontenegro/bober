<section class="section accordion-price__section">
    <div class="container">

        <?php  $remont_term = get_term_by('slug', 'remont', 'product_cat'); ?>

        <?php if ($remont_term) : ?>
            <?php
                // Получаем дочерние категории
                $args = array(
                    'taxonomy'     => 'product_cat',
                    'parent'        => $remont_term->term_id,
                    'orderby'       => 'name',
                    'order'         => 'ASC',
                    'hide_empty'    => false
                );
                $categories = get_terms($args);
            ?>

            <?php if ($categories) : ?>
                <?php foreach ($categories as $category) : ?>
                    <div class="accordion-price">
                        <div class="accordion-price__head">
                            <h2 class="section-title"><?php echo esc_html($category->name) ?></h2>
                            <i class="icon icon-caret">
                                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="46" viewBox="0 0 45 46" fill="none">
                                    <rect class="icon-caret__circle" y="0.86377" width="45" height="45" rx="22.5" fill="#99807A"></rect>
                                    <path class="icon-caret__arrow" fill-rule="evenodd" clip-rule="evenodd" d="M29.2114 23.3531C29.2114 23.7975 29.0322 24.2237 28.7131 24.538L21.1175 32.0185C20.453 32.6729 19.3758 32.6729 18.7113 32.0185C18.0469 31.3641 18.0469 30.3032 18.7113 29.6488L25.1038 23.3531L18.7113 17.0575C18.0469 16.4031 18.0469 15.3422 18.7113 14.6878C19.3758 14.0334 20.453 14.0334 21.1175 14.6878L28.7131 22.1683C29.0322 22.4825 29.2114 22.9087 29.2114 23.3531Z" fill="white"></path>
                                </svg>
                            </i>
                        </div>

                        <div class="accordion-price__content">
                            <?php
                                // Получаем подкатегории текущей категории
                                $subcategories = get_terms(array(
                                    'taxonomy'     => 'product_cat',
                                    'parent'        => $category->term_id,
                                    'orderby'       => 'name',
                                    'order'         => 'ASC',
                                    'hide_empty'    => false
                                ));
                            ?>

                            <?php if ($subcategories) : ?>
                                <?php foreach ($subcategories as $subcategory) : ?>
                                    <div class="price-table__wrap custom-scroll--horizontal" data-mcs-axis="x">
                                        <table dir="ltr" border="1" cellspacing="0" cellpadding="0" data-sheets-root="1" data-sheets-baot="1">
                                            <tbody>
                                            <tr>
                                                <td><?php echo esc_html($subcategory->name);?></td>
                                                <td>Цена</td>
                                                <td></td>
                                            </tr>
                                            <?php // Получаем товары в подкатегории
                                                $args_products = array(
                                                    'post_type' => 'product',
                                                    'posts_per_page' => -1,
                                                    'post_status' => 'publish',
                                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'product_cat',
                                                            'field' => 'id',
                                                            'terms' => $subcategory->term_id,
                                                            'operator' => 'IN'
                                                        )
                                                    )
                                                );
                                                $loop = new WP_Query($args_products);
                                            ?>
                                            <?php if ($loop->have_posts()) : ?>
                                                <?php  while ($loop->have_posts()): $loop->the_post();
                                                    global $product;?>
                                                    <tr>
                                                        <td><?php echo get_the_title(); ?></td>
                                                        <td><?php echo wc_price($product->get_price()); ?></td>
                                                        <td style="max-width: 75px;display: flex;align-items: center;justify-content: center;">
                                                        <button type="button" class="product-card__btns__main--buy btn-buy" onclick="addToCart(<?php echo esc_attr( $product->get_id() ) ?>)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 50 50" fill="none" class="header__flex__right__cart__svg__cart">
                                                                <path d="M31.722 33.1607C29.7952 33.1589 28.2318 34.6885 28.2299 36.5771C28.228 38.4656 29.7885 39.9981 31.7152 40C33.642 40.0018 35.2054 38.4723 35.2073 36.5837C35.2073 36.5826 35.2073 36.5815 35.2073 36.5804C35.2055 34.6938 33.6466 33.1644 31.722 33.1607Z" fill="#EB6025"></path>
                                                                <path d="M37.9097 16.7858C37.8263 16.7699 37.7414 16.7619 37.6564 16.7618H16.4148L16.0783 14.5556C15.8687 13.0905 14.5902 12.0005 13.0808 12H10.3457C9.60247 12 9 12.5905 9 13.319C9 14.0475 9.60247 14.6381 10.3457 14.6381H13.0842C13.2553 14.6369 13.4001 14.7617 13.4206 14.9283L15.493 28.8508C15.7771 30.6199 17.3295 31.925 19.1566 31.9308H33.1551C34.9142 31.933 36.4317 30.7212 36.7851 29.0322L38.9752 18.3314C39.1164 17.6162 38.6394 16.9242 37.9097 16.7858Z" fill="#EB6025"></path>
                                                                <path d="M23.1755 36.4339C23.0936 34.6007 21.5501 33.1576 19.6781 33.164C17.7529 33.2403 16.2553 34.8319 16.3331 36.7189C16.4077 38.5296 17.9104 39.9688 19.7588 40H19.8429C21.7678 39.9173 23.2598 38.3207 23.1755 36.4339Z" fill="#EB6025"></path>
                                                            </svg>
                                                            <span class="icon-preloader" data-preloader="<?php echo $product->get_id();?>" data-title="<?php  echo get_the_title(); ?>"></span>
                                                        </button>
                                                        </td>
                                                    </tr>



                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(get_field('accordion-price_option_title')){?>  <!--Стоимость услуг-->
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

        <?php if (have_rows('price-table_accordion', 'option')): ?> <!--Остальное-->
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




    </div>
</section>
