<?php
session_start();
include 'db.php';
include 'config.php'; // Load API credentials

// Check if an image was uploaded
if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
    die("Error: Please upload a valid image.");
}

$imagePath = $_FILES['image']['tmp_name'];
$imageData = base64_encode(file_get_contents($imagePath));

$imaggaApiKey = $_ENV['IMAGGA_API_KEY'];
$imaggaApiSecret = $_ENV['IMAGGA_API_SECRET'];

// Send request to Imagga API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.imagga.com/v2/tags");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$imaggaApiKey:$imaggaApiSecret");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ['image_base64' => $imageData]);

$response = curl_exec($ch);
curl_close($ch);

if (!$response) {
    die("Error: Could not connect to Imagga API.");
}

$responseData = json_decode($response, true);

// Extract and display tags
$tags = [];
if (isset($responseData['result']['tags'])) {
    foreach ($responseData['result']['tags'] as $tag) {
        $tags[] = $tag['tag']['en']; // Extract English tags
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UrinoBot AI - Image Analysis</title>
</head>
<body>
    <h1>Analysis Results</h1>
    <p>Detected Elements in Your Urine Sample:</p>
    <ul>
        <?php foreach ($tags as $tag) {
            echo "<li>$tag</li>";
        } ?>
    </ul>
    <a href="urine.php">Go Back</a>
</body>
</html>
