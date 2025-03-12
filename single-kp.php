<?php
/**
 * Шаблон для страницы КП (Коммерческое предложение)
 */

get_header();
$kp_id = get_the_ID();
$products = get_field('kp_products', $kp_id);
$kp_title = get_the_title($kp_id);

$total = 0; // Инициализация переменной для хранения общей суммы
$validation = '';

//Оформление заказа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $billing_first_name = sanitize_text_field($_POST['billing_first_name']);
    $billing_phone = sanitize_text_field($_POST['billing_phone']);
    $billing_email = sanitize_email($_POST['billing_email']);
    $total_kp = sanitize_text_field($_POST['total']);
    $product_count_kp = sanitize_text_field($_POST['product_count']); // Получаем количество товаров из скрытого поля

    if (empty($billing_first_name) || empty($billing_phone) || empty($billing_email) || empty($total_kp)) {
        $validation = true;
    } else {


        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $user = get_userdata($user_id);

            $order = wc_create_order(array('customer_id' => $user_id));

            $order->set_address(array(
                'first_name' => $billing_first_name,
                'phone'      => $billing_phone,
                'email'      => $billing_email,
            ), 'billing');

            // Добавляем название КП как мета-данные к заказу
            $kp_title = get_the_title($kp_id);
            $order->update_meta_data('_kp_title', $kp_title);

            // Добавляем менеджера КП как мета-данные к заказу
            $kp_manager_id = get_field('kp_manager', $kp_id);
            $kp_manager_name = get_the_title($kp_manager_id);
            $order->update_meta_data('_kp_manager', $kp_manager_name);

            // Добавляем ссылку на КП как мета-данные к заказу
            $kp_link = get_permalink($kp_id);
            $order->update_meta_data('_kp_link', $kp_link);

            // Добавляем количество товаров как мета-данные к заказу
            $order->update_meta_data('_product_count', $product_count_kp);

            // Устанавливаем общую сумму заказа
            $order->set_total($total_kp);

            //$order->calculate_totals();
            $order->update_status('processing', 'Order created from custom KP page', true);

            // Сохраняем мета-данные
            $order->save();
            // Редирект - Ваш заказ принят!
            wp_redirect($order->get_checkout_order_received_url());
            exit;
        } else {
            echo 'Пожалуйста, войдите в систему для оформления заказа.';
        }
    }
}
?>



<div class="container kp-page is-user-<?php if(is_user_logged_in()){echo 'auth';}else{echo 'ghost';}?>">
    <?php
    $custom_dt = get_the_date('d.m.y', $kp_id);
    ?>
    <h1>Коммерческое предложение от <?php echo $custom_dt;?></h1>

    <?php if($manager=get_field('kp_manager', $kp_id)):
        $manager = get_field('kp_manager', $kp_id);
        if($manager) {
            echo '<div class="kp_manager" style="display:none;">
						<p>Менеджер: ' . get_the_title($manager) . '</p>
						<p>Телефон: <a href="tel:' . get_field('manager_phone', $manager) . '">' . get_field('manager_phone', $manager) . '</a></p>
						<p>Email: <a href="mailto:' . get_field('manager_email', $manager) . '">' . get_field('manager_email', $manager) . '</a></p>
					</div>';
        }
    endif ?>

    <div class="kp-page__flex kp-container">
        <div class="kp-page__flex__left ">
                <table class="wc-block-cart-items">
                    <thead>
                    <tr class="wc-block-cart-items__header">
                        <th class="wc-block-cart-items__header-image"><span>Товар</span></th>
                        <th class="wc-block-cart-items__header-product"><span></span></th>
                        <th class="wc-block-cart-items__header-total"><span>Итого</span></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $total = 0; // Инициализация переменной для хранения общей суммы
                    $product_count = 0; //Общее число товаров
                    ?>
                    <?php if(isset($products) && is_array($products)) : ?>
                    <?php foreach ($products as $item): ?>
                        <?php
                        $product = wc_get_product($item['product']);
                        //if (!$product) continue;
                        ?>
                        <tr class="wc-block-cart-items__row">
                            <td class="wc-block-cart-item__image">
                                <?php if(get_the_post_thumbnail_url($product->get_id())){?>
                                <a href="<?php echo get_permalink($product->get_id()); ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url($product->get_id(), 'medium'); ?>"
                                         alt="<?php echo esc_attr($product->get_name()); ?>">
                                </a>
                                <?php } ?>
                            </td>
                            <td class="wc-block-cart-item__product">
                                <div class="wc-block-cart-item__wrap">
                                    <a class="wc-block-components-product-name"
                                       href="<?php echo get_permalink($product->get_id()); ?>">
                                        <?php echo $product->get_name(); ?>
                                    </a>
                                    <div class="wc-block-cart-item__prices">
                                        <?php //echo wc_price($product->get_price()); ?>
                                        <?php
                                        $count = $item['count'];
                                        $type = $item['type'];
                                        $sale = $item['sale'];
                                        $orig_price = $item['price'];
                                        $price = floatval($product->get_price());
                                        $product_count += $count;
                                        if(isset($orig_price) && $orig_price)
                                            $price = $orig_price;
                                        if($sale)
                                            $sale_price = ($type=='percent')?round($price-$price*$sale/100):$price-$sale;
                                        ?>
                                        <div class="prod__price">
                                            <?php if($sale): ?>
                                                <?php
                                                $total += $sale_price*$count;
                                                if(isset($total_old)) $total_old += $price*$count;
                                                ?>
                                                <div class="old_price"><?=number_format($price, 0, '.', ' ')?> ₽</div>
                                                <div class="prod__price_num">
                                                    <?=number_format($sale_price, 0, '.', ' ')?> ₽ <span class="price_count">x <?=$count?></span>
                                                </div>
                                                <?php else: ?>
                                                <?php
                                                $total += $price*$count;
                                                if(isset($total_old)) $total_old += $price*$count;
                                                ?>
                                                <div class="prod__price_num">
                                                    <?=number_format($price, 0, '.', ' ')?> ₽ <span class="price_count">x <?=$count?></span>
                                                </div>
                                                <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="wc-block-cart-item__total">
                                <?php if($sale): ?>
                                <?=number_format(($sale_price*$count), 0, '.', ' ')?> ₽
                                <?php else: ?>
                                <?=number_format(($price*$count), 0, '.', ' ')?> ₽
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
        </div>

        <div class="kp-page__flex__right">
            <div class="kp-page__flex__right__total">
                <div class="kp-page__flex__right__total__title">Сумма заказов</div>
                <div class="kp-page__flex__right__total__info">
                    <div class="kp-page__flex__right__total__info__title">Итого</div>
                    <div class="kp-page__flex__right__total__info__value">
                        <?= number_format($total, 0, '.', ' ') ?> ₽
                    </div>
                </div>
            </div>

            <?php if (!is_user_logged_in()): ?>
            <div class="kp-page__flex__right__auth">
                <div class="kp-page__flex__right__auth__text kp_cart_note">Для того, чтобы приобрести товары со скидкой <a target="_blank" href="<?php echo get_site_url(); ?>/my-account/">войдите или зарегистрируйтесь</a></div>
            </div>
            <?php else: ?>
            <div class="kp-page__flex__right__checkout">

                <div class="kp-page__flex__right__checkout__form-wrap">
                    <form method="post" class="kp-page__flex__right__checkout__form" data-total="<?php echo $total;?>">
                        <input type="hidden" name="total" value="<?php echo $total; ?>">
                        <input type="hidden" name="kp_id" value="<?php echo $kp_id; ?>">
                        <input type="hidden" name="product_count" value="<?php echo $product_count; ?>">
                        <h3>Детали оплаты</h3>

                        <label for="billing_first_name" class="">ФИО</label>
                        <input type="text" class="kp-page__flex__right__checkout__form__input-text" name="billing_first_name" id="billing_first_name" placeholder="" value="" autocomplete="given-name">

                        <label for="billing_phone" class="">Телефон&nbsp;<abbr class="required">*</abbr></label>
                        <input type="tel" class="kp-page__flex__right__checkout__form__input-text<?php if($validation){echo' not-validate';}?>" name="billing_phone" id="billing_phone" placeholder="" value="" aria-required="true" autocomplete="tel"></span>
                        <?php if($validation){
                            echo '<div class="kp-page__flex__right__checkout__form__validate">Заполните номер телефона</div>';
                        } ?>

                        <label for="billing_email" class="">Email</label>
                        <input type="email" class="kp-page__flex__right__checkout__form__input-text" name="billing_email" id="billing_email" placeholder="" value="" autocomplete="email username"></span>


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
                            <button type="submit" class="button alt" id="place_order" name="place_order" value="Подтвердить заказ">Подтвердить заказ</button>

                        </div>
                    </form>
                </div>

            </div>
            <?php endif; ?>
        </div>
    </div>

    <div id="checkout-form" style="display: none;"></div>
    </div>
</div>


<style>
    .wc-block-cart-item__prices .prod__price {
        display: flex;
        gap: 15px;
        align-items: flex-end;
    }
    .wc-block-cart-item__prices .old_price {
        text-decoration: line-through;
        font-weight: 600;
        font-size: 16px;
        line-height: 16px;
        color: #b3b3b3;
        display: block;
        height: 16px;
    }
    .wc-block-cart-item__prices .prod__price_num {
        font-weight: 700;
        font-size: 18px;
        line-height: 18px;
        color: #262626;
    }
    .wc-block-cart-item__prices  .price_count {
        font-weight: 400;
        font-size: 16px;
        line-height: 18px;
    }

    .kp_manager {

        margin-bottom: 20px;
    }
</style>





<style>
    .kp-page {
        margin-top: 26px;
    }


    .kp-page__flex {
        display: flex;
        width: 100%;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 60px;
        gap: 54px;
    }
    .kp-page__flex__left {
        width: 65%;
        max-width: 725px;
        margin: 0;
    }
    .kp-page .wc-block-cart-items {
        border-spacing: 0;
        border-bottom: 2px solid #f2f2f2 !important;
        width: 100%;
    }
    .kp-page .wc-block-cart-items td {
        padding: 24px 0 24px 16px;
        border-top: 2px solid #f2f2f2;
    }
    .kp-page .wc-block-cart-items td:last-child {
        padding-right: 16px;
        text-align: right;
    }
    .kp-page .wc-block-cart-items__header {
        font-size: 15px;
        text-transform: uppercase;
        font-weight: 700;
    }
    .kp-page .wc-block-cart-items__header th {
        padding: 8px 16px 8px 0;
        white-space: nowrap;
    }
    .kp-page .wc-block-cart-items__header th:first-child {
        padding-right: 0;
        padding-left: 16px;
    }
    .kp-page .wc-block-cart-items__header th:last-child {
        padding-right: 16px;
        text-align: right;
    }
    .kp-page .wc-block-cart-item__image {
        padding: 24px 0 24px 16px;
        vertical-align: middle;
    }
    .kp-page .wc-block-cart-item__image img {
        height: auto;
        width: 100%;
    }
    .kp-page td.wc-block-cart-item__total,
    .kp-page td.wc-block-cart-item__image {
        width: 100px;
    }
    .kp-page .wc-block-components-product-name {
        font-weight: 700;
        font-size: 18px;
        line-height: 25px;
        color: #262626;
        text-decoration: none;
        margin-bottom: 10px;
        display: block;
    }
    .kp-page .wc-block-cart-item__total {
        font-weight: 700;
        font-size: 24px;
        line-height: 28px;
        color: #262626;
        text-decoration: none;
        text-wrap: nowrap;
        vertical-align: top;
    }

    .kp-page__flex__right {
        border: 2px solid #f2f2f2;
        padding: 32px 20px;
        border-radius: 10px;
        position: relative;
        max-width: 420px;
        width: 35%;
        display: flex;
        flex-direction: column;
        gap: 35px;
        margin-top: -25px;
    }

    .kp-page__flex__right__total__title {
        font-weight: 700;
        font-size: 15px;
        line-height: 18px;
        color: #262626;
        text-transform: uppercase;
        margin-bottom: 14px;
        padding-bottom: 14px;
        border-bottom: 2px solid #f2f2f2;
    }
    .kp-page__flex__right__total__info {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .kp-page__flex__right__total__info__value,
    .kp-page__flex__right__total__info__title {
        font-weight: 700;
        font-size: 25px;
        line-height: 30px;
    }
    .kp-page__flex__right__checkout__btn {
        background: #ffe4d9;
        border-radius: 8px;
        background-color: #ffe4d9;
        font-size: 16px;
        font-weight: 700;
        line-height: 100%;
        color: #EB6025;
        border: none;
        min-height: 50px;
        text-decoration: none;
        width: auto;
        padding: 5px 20px;
        max-width: 320px;
        transition: 0.15s;
    }
    .kp-page__flex__right__checkout__form__input-text {
        border-radius: 8px;
        padding: 15px 15px 15px 15px;
        height: 50px;
        border: 1px solid #efdcd2;
        background: rgba(250, 240, 235, 0.5);
        outline: none;
        font-weight: 700;
        font-size: 16px;
        line-height: 100%;
        color: #664d47;
        width: 100%;
        margin-bottom: 10px;
    }
    .kp-page__flex__right__checkout__form .customer_details_confirm-order {
        gap: 10px;
        flex-direction: column;
        margin-top: 20px;
    }

    .kp-page__flex__right__checkout__form #place_order {
        border-radius: 8px;
        font-size: 16px;
        font-weight: 700;
        line-height: 100%;
        border: none;
        background-color: #EB6025;
        color: #fff;
        transition: 0.15s;
        width: 190px;
        min-height: 46px;
        flex-shrink: 0;
        padding: 9px 15px;
        cursor: pointer;
    }

    @media (max-width: 1024px){
        .kp-page__flex {
            flex-direction: column;
        }
        .kp-page__flex__left {
            width: 100%;
            max-width: 100%;
        }
        .kp-page__flex__right {
            width: 100%;
            max-width: 100%;
            gap: 16px;
        }
    }

    @media (max-width: 757px){
        .kp-page__flex__right {
            padding: 20px 20px;
        }
        .kp-page__flex__right__total__title {
            display: none;
        }
    }
    @media (max-width: 520px){
        .kp-page__flex__right__total__info__value,
        .kp-page__flex__right__total__info__title {
            font-size: 18px;
            line-height: 20px;
        }
        .kp-page .wc-block-cart-items td {
            border-top: none;
            padding: 0;
        }
        .kp-page .wc-block-cart-items__header {
            display: none;
        }
        .kp-page .wc-block-cart-items__row {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: wrap !important;
            border-bottom: 2px solid #f2f2f2;
            padding: 16px 0;
        }
        .kp-page .wc-block-cart-items__row:last-child {
            border-bottom: none;
        }
        .kp-page td.wc-block-cart-item__image {
            order: 0;
            width: 120px;
        }
        .kp-page td.wc-block-cart-item__total {
            order: 0;
            margin-left: auto !important;
            margin-top: 10px !important;
        }
    }

</style>
<?php /*
<script>
    document.getElementById('kp-order').addEventListener('click', function () {
        let kp_id = this.getAttribute('data-kp-id');
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'action=kp_checkout&kp_id=' + kp_id
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.data.redirect;
                } else {
                    alert('Ошибка: ' + data.data);
                }
            });
    });
</script>
 */?>

<?php get_footer(); ?>
