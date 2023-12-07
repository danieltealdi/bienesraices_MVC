<?php
require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

$db=conectarDB();
use Model\ActiveRecord;
//echo 'estoy en app.php';
//debugear($db);

ActiveRecord::setDB($db);
