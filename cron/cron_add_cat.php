<?php

// Крон на добавление новых категорий в prodazha.json (Раз в день в 00:01)

sleep(5);

// доступы к API
$login = 'kruassan-rf@mail.ru';
$password = 'do9qa1wu';
$data_auth = json_encode(array("login" => $login, "password" => $password));

// Получим все категории
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_PORT => "8030",
    CURLOPT_URL => "http://api.holdingbio.ru:8030/categories",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data_auth,
    CURLOPT_HTTPHEADER => [
        "content-type: application/json; charset=utf-8"
    ],
]);
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

$data_response = json_decode($response);

$all_cat = [];
foreach ($data_response as $key => $item) {
    foreach ($item->categories as $key_cats => $item_child) {
        $all_cat[] = $item_child->id;
    }
}

// Путь к файлу JSON
//$jsonFilePath = 'prodazha.json';
$jsonFilePath = 'bober.services/public_html/wp-content/themes/bober/cron/prodazha.json';


// Чтение текущего содержимого файла JSON
if (file_exists($jsonFilePath)) {
    $jsonContent = file_get_contents($jsonFilePath);
    $jsonArray = json_decode($jsonContent, true);
} else {
    $jsonArray = [];
}

// Обновление JSON массива новыми категориями
foreach ($all_cat as $cat_id) {
    if (!array_key_exists($cat_id, $jsonArray)) {
        $jsonArray[$cat_id] = [];
    }
}

// Сохранение обновленного содержимого обратно в файл JSON
file_put_contents($jsonFilePath, json_encode($jsonArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

?>