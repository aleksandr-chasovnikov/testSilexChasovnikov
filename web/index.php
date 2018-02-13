<?php

ini_set('display_errors', 0);

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';
require __DIR__.'/../config/prod.php';

require '../config/database.php';
use Models\Database;
//Initialize Illuminate Database Connection
new Database();

require __DIR__.'/../src/controllers.php';
$app->run();
