<?php
$apiKey = "YOUR_API_KEY";
$apiUrl = "https://api.deepseek.com/v1/analyze";

if ($_FILES["file"]["tmp_name"]) {
    $file = new CURLFile($_FILES["file"]["tmp_name"], $_FILES["file"]["type"], $_FILES["file"]["name"]);
    $postData = ['file' => $file];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiKey"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
}
?>
