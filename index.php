<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

header('Content-Type: text/html; charset=utf-8');

function __autoload($nombre_clase) {
    include 'class/'.$nombre_clase . '.php';
}

include_once 'config.php';
include_once 'rutas.php';
include_once 'redirecciones.php';
include_once 'variables.php';

$ruta = '/'. (isset($_GET['path'])?$_GET['path']:'');
$Template = new Template($ruta);
echo $Template->display();
