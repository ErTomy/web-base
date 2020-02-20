<?php

class Auth
{  

    public $payload;


    function __construct()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                $this->payload = JWT::decode($matches[1], SECRET, array('HS256'));
            }
        }
    }

    public function verify(){
        if($this->payload === null){
            http_response_code(401);
            echo json_encode(['error'=>'No puedes pasar!!!']);
            die();
        }
    }

    public static function login(array $params, $token=null)
    {
        if($params['body']['username'] == ADMINUSER && $params['body']['password'] == ADMINPASS){
            return ['token' => JWT::encode(['logado'=>true], SECRET) ];
        }else{
            return ['error' => 'Usuario no válido'];
        }
    }

    public static function getInfo($token){    
        return JWT::decode($token, SECRET, array('HS256'));                
    }


}
