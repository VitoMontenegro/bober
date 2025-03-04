<?php

$randomNumber = rand(1, 2); //Пропускаем (уменьшение частоты)
if ($randomNumber == 2) {
//    $log_txt = 'bober.services/public_html/wp-content/themes/bober/cron/log.txt';
//    $log_txt_content = file_get_contents($log_txt) . "\nКатегория -";
//    file_put_contents($log_txt, $log_txt_content);
    return false;
}

// Подключаем WordPress
require_once('bober.services/public_html/wp-load.php' );

// Проверяем, что WooCommerce активен
if ( ! class_exists( 'WooCommerce' ) ) {
    error_log( 'WooCommerce is not active' );
    exit;
}

sleep(10);
// Крон на замену SKU товаров в текущей категории(current_index.txt), в файл prodazha.json

// Путь к файлу JSON
//    $jsonFilePath = 'prodazha.json';
//
//// Путь к файлу с текущим индексом
//    $indexFilePath = 'current_index.txt';
// Путь к файлу JSON
    $jsonFilePath = 'bober.services/public_html/wp-content/themes/bober/cron/prodazha.json';

// Путь к файлу с текущим индексом
    $indexFilePath = 'bober.services/public_html/wp-content/themes/bober/cron/current_index.txt';

// Чтение содержимого JSON файла
    $jsonContent = file_get_contents($jsonFilePath);
    $categories = json_decode($jsonContent, true);

// Получение всех ключей из JSON
    $categoryKeys = array_keys($categories);

// Чтение текущего индекса из файла
    if (file_exists($indexFilePath)) {
        $currentIndex = (int)file_get_contents($indexFilePath);
    } else {
        $currentIndex = 0;
    }

// Получение текущего значения $categoryId
    $categoryId = $categoryKeys[$currentIndex];

// Обновление индекса для следующего вызова
    $currentIndex = ($currentIndex + 1) % count($categoryKeys);

// Сохранение нового индекса в файл
    file_put_contents($indexFilePath, $currentIndex);


// доступы к API
    $login = 'kruassan-rf@mail.ru';
    $password = 'do9qa1wu';
    $data_auth = json_encode(array("login" => $login, "password" => $password));

//$categoryId = $_POST['cat_id'];
//$categoryId = "5fcba79d-5c7b-11ea-82d5-001b78567c7a";
    $data_auth_cat = json_encode(array("login" => $login, "password" => $password, "categoryId" => $categoryId));

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_PORT => "8030",
        CURLOPT_URL => "http://api.holdingbio.ru:8030/products",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data_auth_cat,
        CURLOPT_HTTPHEADER => [
            "content-type: application/json; charset=utf-8"
        ],
    ]);

    $response_2 = curl_exec($curl); // ПОлучаем все товары из всех категорий
    $err = curl_error($curl);
    curl_close($curl);


    if ($err) {
        return false;
    }

    $price_count = 0;
    $log_price = '';
    $prod_ids = [];
    $decodedResponse = json_decode($response_2, true);
    foreach ($decodedResponse as $item) {
        if ($item['priceRUB'] == '0') {
            continue;
        }
        $prod_ids[] = $item['code'];

        // Поиск продукта по SKU
        $product_id = wc_get_product_id_by_sku($item['code']);
        if ($product_id) {
            $wc_product = wc_get_product($product_id);
            if ($wc_product) {
//                echo $wc_product->name;
                $price = $item['priceRUB'];

                $price = (float)$price;
                $price = (int)round($price);
//                $price = number_format($price, 0, '.', ' ');

                // Получение текущей цены продукта
                $current_price = $wc_product->get_regular_price();

                // Проверка, отличается ли новая цена от текущей
                if ($price != $current_price) {
                    $wc_product->set_regular_price($price); // Установка регулярной цены
                    $wc_product->set_price($price); // Установка цены

                    $price_count++;
                    $log_price .= 'p='.$price.'c='.$current_price.'---';
                    // Сохранение изменений
                    $wc_product->save();
                }
            }
        }
    }

    // Чтение текущего содержимого файла prodazha.json
//    $jsonFilePath = 'prodazha.json';
    $jsonFilePath = 'bober.services/public_html/wp-content/themes/bober/cron/prodazha.json';

    $jsonContent = file_get_contents($jsonFilePath);
    $jsonArray = json_decode($jsonContent, true);

    // Обновление значений для $categoryId
    $jsonArray[$categoryId] = $prod_ids;

    // Запись обновленного содержимого обратно в файл prodazha.json
    file_put_contents($jsonFilePath, json_encode($jsonArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));


    $log_txt = 'bober.services/public_html/wp-content/themes/bober/cron/log.txt';
    $log_txt_content = file_get_contents($log_txt) . "\n" . $categoryId . ' '.  $price_count . ' ' . $log_price;
    file_put_contents($log_txt, $log_txt_content);

//echo '<pre>';
//echo print_r($prod_ids);
//echo '</pre>';

?>
