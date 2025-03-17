<?php
require 'vendor/autoload.php'; // Load dependencies

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$imaggaApiKey = $_ENV['IMAGGA_API_KEY'];
$imaggaApiSecret = $_ENV['IMAGGA_API_SECRET'];
