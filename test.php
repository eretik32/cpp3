<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://cpp/api/imageModeration/');// Загружаемый URL
curl_setopt($ch, CURLOPT_POST, 1); // указываем метод POST
curl_setopt($ch, CURLOPT_TIMEOUT, 10); //время запроса
curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'datafile' => curl_file_create(__DIR__ .'\lesTnica.jpg', 'image/jpg', 'hghff'),
    'productId' =>2,
    'typeImage' => 3
]);
// добавить тип картинки и id продукта
$result = curl_exec($ch);
if ($result === false) {
  echo 'файл не найден';
}

curl_close($ch);



