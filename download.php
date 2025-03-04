<?php
$downloadUrl = base64_decode($_GET['url']);
$hiddenFilename = $_GET['name'];

// Устанавливаем заголовок Content-Disposition для скрытия исходного URL
header("Content-Disposition: attachment; filename=" . $hiddenFilename);

// Инициализируем cURL сессию
$ch = curl_init();

// Устанавливаем URL для скачивания
curl_setopt($ch, CURLOPT_URL, $downloadUrl);

// Пропускаем проверку SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Устанавливаем параметр FOLLOWLOCATION в true, чтобы обрабатывать перенаправления
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

// Устанавливаем параметр RETURNTRANSFER в true, чтобы получить содержимое файла
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Выполняем запрос и получаем содержимое файла
$fileContent = curl_exec($ch);

// Закрываем cURL сессию
curl_close($ch);

// Выводим содержимое файла
echo $fileContent;
?>