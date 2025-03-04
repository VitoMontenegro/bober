<?php

////checkout admin
add_action( 'woocommerce_admin_order_data_after_order_details', 'conditionally_add_actions' );

function conditionally_add_actions( $order ) {
    $order_id = $order->get_id();
    $payment_checkbox = $order->get_meta( 'payment_checkbox' );

    // Преобразуем строку в массив
    $payment_checkbox_array = explode( ',', $payment_checkbox );

    // Проверяем, есть ли 'postponement' в массиве
    if ( in_array( 'postponement', $payment_checkbox_array ) ) {
        //Выводим Инфу про Отсрочку
        add_action( 'woocommerce_admin_order_totals_after_shipping', 'add_custom_order_total_row' );
        add_action( 'woocommerce_admin_order_item_values', 'add_custom_order_item_column_value', 10, 3 );
        add_action( 'woocommerce_admin_order_item_headers', 'add_custom_order_item_column_header' );
    }
}

// Добавление нового столбца "Отсрочка"
function add_custom_order_item_column_header() {
    echo '<th class="custom-column-header">Отсрочка</th>';
}
// Добавление данных
function add_custom_order_item_column_value( $product, $item, $item_id ) {
    // Получение ID товара
    $product_id = $item->get_product_id();
    $additional_info = get_field('postponement', $product_id);
    $quantity = $item->get_quantity();
    $total_postponement = $additional_info * $quantity;
    // Вывод значения в ячейку таблицы
    if($additional_info){
        echo '<td class="custom-column-value">' . numberWithSpaces($additional_info ) . ' × ' . esc_html( $quantity ) . '<br>= ' . numberWithSpaces($total_postponement ) . ' ₽</td>';
    } else {
        echo '<td class="custom-column-value"> - </td>';
    }
}
// Стилизация нового столбца
add_action( 'admin_head', 'custom_order_item_column_styles' );
function custom_order_item_column_styles() {
    echo '<style>
        .custom-column-header {
            width: 10%;
        }
        .custom-column-value {
            text-align: center;
        }
    </style>';
}

//Итог по Отсрочке:
// Добавление новой строки в таблицу итогов заказа
function add_custom_order_total_row( $order_id ) {
    $order = wc_get_order( $order_id );
    $total_postponement = 0;
    // Проход по всем товарам в заказе
    foreach ( $order->get_items() as $item_id => $item ) {
        $product_id = $item->get_product_id();
        $quantity = $item->get_quantity();
        // Получение значения поля
        $postponement = get_field('postponement', $product_id);
        // Если значение поля не пустое, добавляем его к общей сумме
        if ( ! empty( $postponement ) ) {
            $total_postponement += $postponement * $quantity;
        }
    }
    // Вывод новой строки в таблицу итогов заказа
    echo '<tr>
            <td class="label">Итог по Отсрочке:</td>
            <td width="1%"></td>
            <td class="total">
                <span class="woocommerce-Price-amount amount"><bdi>' . wc_price( $total_postponement ) . '</bdi></span>
            </td>
          </tr>';
}
