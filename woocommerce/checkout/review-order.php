<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>


    <div class="postponement-total">

            <div class="postponement-total__top">
                <div class="postponement-total__col-info postponement-total__top__info">Итого</div>
                <div class="postponement-total__col-total postponement-total__top__total">
                    <?php if ($GLOBALS['$total_before_discounts_html'] == $GLOBALS['$total_with_discounts_html']) { ?>
                        <div class="postponement-total__top__total__price"><?php echo $GLOBALS['$total_with_discounts_html']; ?></div>
                    <?php } else { ?>
                        <div class="postponement-total__top__total__price-old"><?php echo $GLOBALS['$total_before_discounts_html']; ?></div>
                        <div class="postponement-total__top__total__price"><?php echo $GLOBALS['$total_with_discounts_html']; ?></div>
                    <?php } ?>
                </div>
                <div class="postponement-total__col-postponement postponement-total__top__postponement is-postponement">
                    <div class="postponement-total__top__postponement__price"><?php echo numberWithSpaces($GLOBALS['$postponement_total']);?> ₽</div>
                    <div class="postponement-total__top__postponement__text">с отсрочкой 7 дн.</div>
                </div>
            </div>


            <div class="postponement-total__mid">
                <div class="postponement-total__col-info postponement-total__mid__info">Товар</div>
                <div class="postponement-total__mid__product-total">Стоимость</div>
            </div>


        <?php

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                $thumbnail    = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
//                $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                $postponement = get_field('postponement',$cart_item['product_id']);

                echo '<div class="postponement-total__item ' . esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ) . '">';
                    echo '<div class="postponement-total__col-info postponement-total__item__info">';
                        echo '<div class="postponement-total__item__left">';
                            echo '<div class="postponement-total__item__left__img-wrap">';
                                echo $thumbnail;
                            echo '</div>';
                            echo '<div class="postponement-total__item__left__quantity">х ' . $cart_item['quantity'] . '</div>';
                        echo '</div>';
                        echo '<div class="postponement-total__item__name">';
                            echo $product_name;
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="postponement-total__col-total postponement-total__item__total">';

                        if($_product->get_regular_price() > $_product->get_price()){
                            echo '<div class="postponement-total__item__total__price-old">' . numberWithSpaces($_product->get_regular_price()) . ' ₽</div>';
                            echo '<div class="postponement-total__item__total__price">' . numberWithSpaces($_product->get_price()) . ' ₽</div>';
                        } else {

                            echo numberWithSpaces($_product->get_price()) .' ₽';
                        }

                    echo '</div>';
                    echo '<div class="postponement-total__col-postponement postponement-total__item__postponement is-postponement">';
                    if($postponement){
                        echo $postponement . ' ₽';
                    } else {
                        echo '—';
                    }
                    echo '</div>';
                echo '</div>';
            }
        }
        ?>

    </div>
