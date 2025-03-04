<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}




global $woocommerce;
$total_before_discounts = 0;// Получаем сумму товаров в корзине без учета скидок
$postponement_total = 0;
$get_postponement = false;
foreach ($woocommerce->cart->get_cart() as $cart_item) {
    $total_before_discounts += $cart_item['data']->get_regular_price() * $cart_item['quantity'];//Скидка
    $postponement_total += get_field('postponement', $cart_item['product_id']) * $cart_item['quantity'];
    if(get_field('postponement', $cart_item['product_id'])){
        $get_postponement = true;
    }
}

$total_before_discounts_html = wc_price($total_before_discounts);
$GLOBALS['$total_before_discounts_html'] = $total_before_discounts_html;

$total_with_discounts = $woocommerce->cart->get_total('edit');
$total_with_discounts_html = wc_price($total_with_discounts);
$GLOBALS['$total_with_discounts_html'] = $total_with_discounts_html;

$GLOBALS['$postponement_total'] = $postponement_total;

$GLOBALS['$get_postponement'] = $get_postponement;


?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

    <?php if ( $checkout->get_checkout_fields() ) : ?>

        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

        <div class="col2-set" id="customer_details">
            <?php do_action( 'woocommerce_checkout_billing' ); ?>
            <?php // do_action( 'woocommerce_checkout_shipping' ); ?>


            <div class="customer_details_checkbox">
                <?php if($get_postponement){?>
                <label class="customer_details_checkbox__item">

                    <input type="checkbox" name="payment_checkbox[]" value="postponement" class="customer_details_checkbox__item__input customer_details_checkbox__item__input--postponement">
                    <span class="customer_details_checkbox__item__input-decoration">
                        <svg class="customer_details_checkbox__item__input-decoration__check" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2975 6.78669C19.8309 7.30416 19.8333 8.14551 19.3029 8.66591L10.5966 17.2083C10.341 17.4591 9.99342 17.6001 9.63087 17.6001C9.26833 17.6001 8.92074 17.4591 8.6651 17.2083L5.69737 14.2964C5.16699 13.776 5.16942 12.9347 5.7028 12.4172C6.23618 11.8997 7.09853 11.9021 7.62891 12.4225L9.63087 14.3868L17.3714 6.79198C17.9018 6.27159 18.7641 6.26922 19.2975 6.78669Z" fill="white"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3029 8.66591C19.8333 8.14551 19.8309 7.30416 19.2975 6.78669C18.7641 6.26922 17.9018 6.27159 17.3714 6.79198L9.63087 14.3868L7.62891 12.4225C7.09853 11.9021 6.23618 11.8997 5.7028 12.4172C5.16942 12.9347 5.16699 13.776 5.69737 14.2964L8.6651 17.2083C8.92074 17.4591 9.26833 17.6001 9.63087 17.6001C9.99342 17.6001 10.341 17.4591 10.5966 17.2083L19.3029 8.66591Z" fill="white"></path>
                        </svg>
                    </span>
                    <span class="customer_details_checkbox__item__text">Отсрочка 7 дней</span>
                </label>
                <?php } ?>
                <label class="customer_details_checkbox__item">
                    <input type="checkbox" name="payment_checkbox[]" value="cash-payment" class="customer_details_checkbox__item__input">
                    <span class="customer_details_checkbox__item__input-decoration">
                        <svg class="customer_details_checkbox__item__input-decoration__check" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2975 6.78669C19.8309 7.30416 19.8333 8.14551 19.3029 8.66591L10.5966 17.2083C10.341 17.4591 9.99342 17.6001 9.63087 17.6001C9.26833 17.6001 8.92074 17.4591 8.6651 17.2083L5.69737 14.2964C5.16699 13.776 5.16942 12.9347 5.7028 12.4172C6.23618 11.8997 7.09853 11.9021 7.62891 12.4225L9.63087 14.3868L17.3714 6.79198C17.9018 6.27159 18.7641 6.26922 19.2975 6.78669Z" fill="white"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3029 8.66591C19.8333 8.14551 19.8309 7.30416 19.2975 6.78669C18.7641 6.26922 17.9018 6.27159 17.3714 6.79198L9.63087 14.3868L7.62891 12.4225C7.09853 11.9021 6.23618 11.8997 5.7028 12.4172C5.16942 12.9347 5.16699 13.776 5.69737 14.2964L8.6651 17.2083C8.92074 17.4591 9.26833 17.6001 9.63087 17.6001C9.99342 17.6001 10.341 17.4591 10.5966 17.2083L19.3029 8.66591Z" fill="white"></path>
                        </svg>
                    </span>
                    <span class="customer_details_checkbox__item__text">Оплата наличными</span>
                </label>
                <label class="customer_details_checkbox__item">
                    <input type="checkbox" name="payment_checkbox[]" value="qr-code" class="customer_details_checkbox__item__input">
                    <span class="customer_details_checkbox__item__input-decoration">
                        <svg class="customer_details_checkbox__item__input-decoration__check" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2975 6.78669C19.8309 7.30416 19.8333 8.14551 19.3029 8.66591L10.5966 17.2083C10.341 17.4591 9.99342 17.6001 9.63087 17.6001C9.26833 17.6001 8.92074 17.4591 8.6651 17.2083L5.69737 14.2964C5.16699 13.776 5.16942 12.9347 5.7028 12.4172C6.23618 11.8997 7.09853 11.9021 7.62891 12.4225L9.63087 14.3868L17.3714 6.79198C17.9018 6.27159 18.7641 6.26922 19.2975 6.78669Z" fill="white"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3029 8.66591C19.8333 8.14551 19.8309 7.30416 19.2975 6.78669C18.7641 6.26922 17.9018 6.27159 17.3714 6.79198L9.63087 14.3868L7.62891 12.4225C7.09853 11.9021 6.23618 11.8997 5.7028 12.4172C5.16942 12.9347 5.16699 13.776 5.69737 14.2964L8.6651 17.2083C8.92074 17.4591 9.26833 17.6001 9.63087 17.6001C9.99342 17.6001 10.341 17.4591 10.5966 17.2083L19.3029 8.66591Z" fill="white"></path>
                        </svg>
                    </span>
                    <span class="customer_details_checkbox__item__text">Оплата по QR-коду</span>
                </label>
                <label class="customer_details_checkbox__item">
                    <input type="checkbox" name="payment_checkbox[]" value="invoice" class="customer_details_checkbox__item__input">
                    <span class="customer_details_checkbox__item__input-decoration">
                        <svg class="customer_details_checkbox__item__input-decoration__check" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2975 6.78669C19.8309 7.30416 19.8333 8.14551 19.3029 8.66591L10.5966 17.2083C10.341 17.4591 9.99342 17.6001 9.63087 17.6001C9.26833 17.6001 8.92074 17.4591 8.6651 17.2083L5.69737 14.2964C5.16699 13.776 5.16942 12.9347 5.7028 12.4172C6.23618 11.8997 7.09853 11.9021 7.62891 12.4225L9.63087 14.3868L17.3714 6.79198C17.9018 6.27159 18.7641 6.26922 19.2975 6.78669Z" fill="white"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3029 8.66591C19.8333 8.14551 19.8309 7.30416 19.2975 6.78669C18.7641 6.26922 17.9018 6.27159 17.3714 6.79198L9.63087 14.3868L7.62891 12.4225C7.09853 11.9021 6.23618 11.8997 5.7028 12.4172C5.16942 12.9347 5.16699 13.776 5.69737 14.2964L8.6651 17.2083C8.92074 17.4591 9.26833 17.6001 9.63087 17.6001C9.99342 17.6001 10.341 17.4591 10.5966 17.2083L19.3029 8.66591Z" fill="white"></path>
                        </svg>
                    </span>
                    <span class="customer_details_checkbox__item__text">Оплата по счету</span>
                </label>
                <div class="customer_details_checkbox__text">После отправки заказа, с вами свяжется наш менеджер.</div>
            </div>


            <div class="customer_details_confirm-order">
                <div class="form-row place-order">
                    <label class="contact-form__flex__agree">
                        <input type="checkbox" id="privacy_policy_checkbox_duplicator" value="1" class="contact-form__flex__agree__checkbox woocommerce-form__input-checkbox" checked="">
                        <div type="checkbox" class="contact-form__flex__agree__checkbox-decoration">
                            <svg class="contact-form__flex__agree__checkbox-decoration__check" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2975 6.78669C19.8309 7.30416 19.8333 8.14551 19.3029 8.66591L10.5966 17.2083C10.341 17.4591 9.99342 17.6001 9.63087 17.6001C9.26833 17.6001 8.92074 17.4591 8.6651 17.2083L5.69737 14.2964C5.16699 13.776 5.16942 12.9347 5.7028 12.4172C6.23618 11.8997 7.09853 11.9021 7.62891 12.4225L9.63087 14.3868L17.3714 6.79198C17.9018 6.27159 18.7641 6.26922 19.2975 6.78669Z" fill="white"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3029 8.66591C19.8333 8.14551 19.8309 7.30416 19.2975 6.78669C18.7641 6.26922 17.9018 6.27159 17.3714 6.79198L9.63087 14.3868L7.62891 12.4225C7.09853 11.9021 6.23618 11.8997 5.7028 12.4172C5.16942 12.9347 5.16699 13.776 5.69737 14.2964L8.6651 17.2083C8.92074 17.4591 9.26833 17.6001 9.63087 17.6001C9.99342 17.6001 10.341 17.4591 10.5966 17.2083L19.3029 8.66591Z" fill="white"></path>
                            </svg>
                        </div>
                        <div class="contact-form__flex__agree__text">Отправляя свои данные, я соглашаюсь с <a href="/politika-konfidenczialnosti/">политикой конфиденциальности</a></div>
                    </label>
                </div>
                <button class="button alt" id="place_order" name="woocommerce_checkout_place_order" value="Подтвердить заказ" class="button alt">Подтвердить заказ</button>
            </div>

        </div>

        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

    <?php endif; ?>

    <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>


    <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

    <div id="order_review" class="woocommerce-checkout-review-order">
        <h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
        <?php do_action( 'woocommerce_checkout_order_review' ); ?>
    </div>

    <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
