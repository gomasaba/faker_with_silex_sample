<?php
require __DIR__ . '/../vendor/autoload.php';
$app = new App\Application(['locale' => 'ja', 'debug' => true]);
$app->run();
