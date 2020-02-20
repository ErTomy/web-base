<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

session_start();

function __autoload($nombre_clase) {
    include ((isset($_GET['path']) && strpos($_GET['path'], 'api/v1') !== false)?'class/API/':'class/') . $nombre_clase . '.php';
}

include_once 'config.php';
$rutas = json_decode(file_get_contents('config/rutas.json'), TRUE);
$redirecciones = json_decode(file_get_contents('config/redirecciones.json'), TRUE);
$variables = json_decode(file_get_contents('config/variables.json'), TRUE);
$formularios = json_decode(file_get_contents('config/formularios.json'), TRUE);

if(array_key_exists('formName', $_POST) && array_key_exists('formId', $_POST)){
    header('Content-Type: application/json');    
    $form = new Formulario($_POST['formName'], $_POST['formId']);
    if($form->validar() === true){
        echo json_encode($form->OK);
    }else{
        http_response_code(422);
        echo json_encode($form->errores);
    }
}elseif(isset($_GET['path']) && strpos($_GET['path'], 'api/v1') !== false){    
    header('Content-type: application/json');
	
    try {
        list($class, $method) = explode('/', ucfirst(strtolower(str_replace('api/v1/', '', $_GET['path']))) );
        $params=[];        
        $inputJSON = file_get_contents('php://input');
        $params['body'] = json_decode($inputJSON, TRUE);
        
        if (file_exists( __DIR__ . DIRECTORY_SEPARATOR. 'class'.DIRECTORY_SEPARATOR.'API'.DIRECTORY_SEPARATOR.$class.'.php')) {
            $func = array(new $class, $method);            
        }else{
            $func = array(new Config, $method);
            $params['file']=strtolower($class);
        }
        echo json_encode($func($params), JSON_PRETTY_PRINT);            
    }
    catch(Exception $e) {
        echo json_encode(['error' => $e->getMessage()], JSON_PRETTY_PRINT);
    }
}else{
    header('Content-Type: text/html; charset=utf-8');
    $ruta = '/'. (isset($_GET['path'])?$_GET['path']:'');
    $Template = new Template($ruta);
    echo $Template->display();
}
