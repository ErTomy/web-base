<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

function __autoload($nombre_clase) {
    include 'class/'.$nombre_clase . '.php';
}

include_once 'config.php';
include_once 'rutas.php';
include_once 'redirecciones.php';
include_once 'variables.php';
include_once 'formularios.php';

if(array_key_exists('formName', $_POST) && array_key_exists('formId', $_POST)){
    header('Content-Type: application/json');    
    $form = new Formulario($_POST['formName'], $_POST['formId']);
    if($form->validar() === true){
        echo json_encode($form->OK);
    }else{
        http_response_code(422);
        echo json_encode($form->errores);
    }
}else{
    header('Content-Type: text/html; charset=utf-8');
    $ruta = '/'. (isset($_GET['path'])?$_GET['path']:'');
    $Template = new Template($ruta);
    echo $Template->display();
}
