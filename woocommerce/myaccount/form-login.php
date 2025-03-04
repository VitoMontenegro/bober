<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="u-columns col2-set bober-wc__my-account--forms" id="customer_login">

    <div class="u-column1 col-1">

        <?php endif; ?>

        <h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>

        <form class="woocommerce-form woocommerce-form-login login bober-wc__form-auth bober-wc__form-auth__login" method="post">

            <?php do_action( 'woocommerce_login_form_start' ); ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="username"><?php esc_html_e( 'Email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text bober-wc__form-auth__field" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                <input class="woocommerce-Input woocommerce-Input--text input-text bober-wc__form-auth__field" type="password" name="password" id="password" autocomplete="current-password" />
            </p>

            <?php do_action( 'woocommerce_login_form' ); ?>

            <div class="form-row form-row__flex">
<!--                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">-->
<!--                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span>--><?php //esc_html_e( 'Remember me', 'woocommerce' ); ?><!--</span>-->
<!--                </label>-->

                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                <button type="submit" class="woocommerce-button button woocommerce-form-login__submit btn bober-wc__form-auth__btn<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>

                <label class="contact-form__flex__agree">
                    <input class="contact-form__flex__agree__checkbox woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
                    <span type="checkbox" class="contact-form__flex__agree__checkbox-decoration">
                        <svg class="contact-form__flex__agree__checkbox-decoration__check" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2975 6.78669C19.8309 7.30416 19.8333 8.14551 19.3029 8.66591L10.5966 17.2083C10.341 17.4591 9.99342 17.6001 9.63087 17.6001C9.26833 17.6001 8.92074 17.4591 8.6651 17.2083L5.69737 14.2964C5.16699 13.776 5.16942 12.9347 5.7028 12.4172C6.23618 11.8997 7.09853 11.9021 7.62891 12.4225L9.63087 14.3868L17.3714 6.79198C17.9018 6.27159 18.7641 6.26922 19.2975 6.78669Z" fill="white"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3029 8.66591C19.8333 8.14551 19.8309 7.30416 19.2975 6.78669C18.7641 6.26922 17.9018 6.27159 17.3714 6.79198L9.63087 14.3868L7.62891 12.4225C7.09853 11.9021 6.23618 11.8997 5.7028 12.4172C5.16942 12.9347 5.16699 13.776 5.69737 14.2964L8.6651 17.2083C8.92074 17.4591 9.26833 17.6001 9.63087 17.6001C9.99342 17.6001 10.341 17.4591 10.5966 17.2083L19.3029 8.66591Z" fill="white"></path>
                        </svg>
                    </span>
                    <span class="contact-form__flex__agree__text">Запомнить меня</span>
                </label>
            </div>

            <div class="woocommerce-LostPassword lost_password">
                <a class="lost_password__link"  href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
            </div>

            <?php do_action( 'woocommerce_login_form_end' ); ?>

        </form>

        <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

    </div>

    <div class="u-column2 col-2">

        <h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>

        <form method="post" class="woocommerce-form woocommerce-form-register register bober-wc__form-auth bober-wc__form-auth__register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

            <?php do_action( 'woocommerce_register_form_start' ); ?>

            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text bober-wc__form-auth__field" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                </p>

            <?php endif; ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                <input type="email" class="woocommerce-Input woocommerce-Input--text input-text bober-wc__form-auth__field" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
            </p>

            <?php /* if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text bober-wc__form-auth__field" name="password" id="reg_password" autocomplete="new-password" />
                </p>

            <?php else : ?>

                <p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>

            <?php endif; */?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="reg_phone"><?php _e('Телефон', 'woocommerce'); ?> <span class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text bober-wc__form-auth__field" name="billing_phone" id="reg_phone" value="<?php echo ( ! empty( $_POST['billing_phone'] ) ) ? esc_attr( wp_unslash( $_POST['billing_phone'] ) ) : ''; ?>" />
            </p>
            <p class="woocommerce-form-row woocommerce-form<?php _e('Компания', 'woocommerce'); ?>-row--wide form-row form-row-wide">
                <label for="reg_company"><?php _e('Компания', 'woocommerce'); ?></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text bober-wc__form-auth__field" name="user_company" id="reg_company" value="<?php if (!empty($_POST['user_company'])) echo esc_attr($_POST['user_company']); ?>" />
            </p>

            <?php do_action( 'woocommerce_register_form' ); ?>

            <label class="contact-form__flex__agree">
                <input type="checkbox" class="contact-form__flex__agree__checkbox" name="privacy_policy_checkbox" id="privacy_policy_checkbox" value="1" checked="">
                <div type="checkbox" class="contact-form__flex__agree__checkbox-decoration">
                    <svg class="contact-form__flex__agree__checkbox-decoration__check" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.2975 6.78669C19.8309 7.30416 19.8333 8.14551 19.3029 8.66591L10.5966 17.2083C10.341 17.4591 9.99342 17.6001 9.63087 17.6001C9.26833 17.6001 8.92074 17.4591 8.6651 17.2083L5.69737 14.2964C5.16699 13.776 5.16942 12.9347 5.7028 12.4172C6.23618 11.8997 7.09853 11.9021 7.62891 12.4225L9.63087 14.3868L17.3714 6.79198C17.9018 6.27159 18.7641 6.26922 19.2975 6.78669Z" fill="white"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3029 8.66591C19.8333 8.14551 19.8309 7.30416 19.2975 6.78669C18.7641 6.26922 17.9018 6.27159 17.3714 6.79198L9.63087 14.3868L7.62891 12.4225C7.09853 11.9021 6.23618 11.8997 5.7028 12.4172C5.16942 12.9347 5.16699 13.776 5.69737 14.2964L8.6651 17.2083C8.92074 17.4591 9.26833 17.6001 9.63087 17.6001C9.99342 17.6001 10.341 17.4591 10.5966 17.2083L19.3029 8.66591Z" fill="white"></path>
                    </svg>
                </div>
                <div class="contact-form__flex__agree__text">Согласен с <a href="/politika-konfidenczialnosti/">политикой конфиденциальности</a></div>
            </label>

            <p class="woocommerce-form-row form-row">
                <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                <button type="submit" class="woocommerce-Button woocommerce-button button btn bober-wc__form-auth__btn<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
            </p>

            <?php do_action( 'woocommerce_register_form_end' ); ?>

        </form>

    </div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
