<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! wp_doing_ajax() ) {
    do_action( 'woocommerce_review_order_before_payment' );
}
?>
    <div id="payment" class="woocommerce-checkout-payment">
        <?php if ( WC()->cart->needs_payment() ) : ?>
            <ul class="wc_payment_methods payment_methods methods">
                <?php
                if ( ! empty( $available_gateways ) ) {
                    foreach ( $available_gateways as $gateway ) {
                        wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
                    }
                } else {
                    echo '<li>';
                    wc_print_notice( apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ), 'notice' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment
                    echo '</li>';
                }
                ?>
            </ul>
        <?php endif; ?>
        <div class="form-row place-order">
            <noscript>
                <?php
                /* translators: $1 and $2 opening and closing emphasis tags respectively */
                printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
                ?>
                <br/><button type="submit" class="button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
            </noscript>

            <label class="contact-form__flex__agree">
                <input type="checkbox" name="privacy_policy_checkbox" id="privacy_policy_checkbox" value="1" class="contact-form__flex__agree__checkbox woocommerce-form__input-checkbox" checked="">
                <div type="checkbox" class="contact-form__flex__agree__checkbox-decoration">
                    <svg class="contact-form__flex__agree__checkbox-decoration__check" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2975 6.78669C19.8309 7.30416 19.8333 8.14551 19.3029 8.66591L10.5966 17.2083C10.341 17.4591 9.99342 17.6001 9.63087 17.6001C9.26833 17.6001 8.92074 17.4591 8.6651 17.2083L5.69737 14.2964C5.16699 13.776 5.16942 12.9347 5.7028 12.4172C6.23618 11.8997 7.09853 11.9021 7.62891 12.4225L9.63087 14.3868L17.3714 6.79198C17.9018 6.27159 18.7641 6.26922 19.2975 6.78669Z" fill="white"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3029 8.66591C19.8333 8.14551 19.8309 7.30416 19.2975 6.78669C18.7641 6.26922 17.9018 6.27159 17.3714 6.79198L9.63087 14.3868L7.62891 12.4225C7.09853 11.9021 6.23618 11.8997 5.7028 12.4172C5.16942 12.9347 5.16699 13.776 5.69737 14.2964L8.6651 17.2083C8.92074 17.4591 9.26833 17.6001 9.63087 17.6001C9.99342 17.6001 10.341 17.4591 10.5966 17.2083L19.3029 8.66591Z" fill="white"></path>
                    </svg>
                </div>
                <div class="contact-form__flex__agree__text">Отправляя свои данные, я соглашаюсь с <a href="/politika-konfidenczialnosti/">политикой конфиденциальности</a></div>
            </label>

            <?php // do_action( 'woocommerce_review_order_before_submit' );//Политика конф. ?>

            <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt' . esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ) . '" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

            <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

            <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
        </div>
    </div>
<?php
if ( ! wp_doing_ajax() ) {
    do_action( 'woocommerce_review_order_after_payment' );
}
