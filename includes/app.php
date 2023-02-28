<?php 

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// CONECTAR A LA BASE DE DATOS
$db = conectarDB();

use Model\ActiveRecord;

//
ActiveRecord::setDB($db);

