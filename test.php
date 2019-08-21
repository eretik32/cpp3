<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://cpp.local/api/imageModeration/');// Загружаемый URL
curl_setopt($ch, CURLOPT_POST, 1); // указываем метод POST
curl_setopt($ch, CURLOPT_TIMEOUT, 10); //время запроса
curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);

$filePath = __DIR__ .'/lesTnica.jpg';

curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'datafile' => curl_file_create($filePath, 'image/jpg', 'gfdgfggg'),
    'productId' => 8,
    'typeImage' => 3
]);

// добавить тип картинки и id продукта
$result = curl_exec($ch);
if ($result === false) {
    $error = '';
    $error = curl_error($ch);
    echo $error;
    echo curl_errno($ch);
}

curl_close($ch);



