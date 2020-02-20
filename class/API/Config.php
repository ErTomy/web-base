<?php

class Config
{  
  function __construct()
  {
      $auth = new Auth();
      $auth->verify();      
  }


  public function get($params)
  {
    if(array_key_exists('file', $params)){
        $file = str_replace('class'.DIRECTORY_SEPARATOR.'API', 'config'.DIRECTORY_SEPARATOR.$params['file'].'.json', __DIR__);
        if(file_exists($file)){
            return json_decode(file_get_contents($file));
        }
    }  
    return ['error'=>'error en la llamada'];
  }

  public function set($params){           
    if(array_key_exists('file', $params) && array_key_exists('body', $params)){
        $file = str_replace('class'.DIRECTORY_SEPARATOR.'API', 'config'.DIRECTORY_SEPARATOR.$params['file'].'.json', __DIR__);
        if(file_exists($file)){
            file_put_contents($file, json_encode($params['body'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            return ['result'=>true];
        }
    }  
    return ['error'=>$params];
  }

  public function templates(){
    $folder = str_replace('class'.DIRECTORY_SEPARATOR.'API', 'plantillas', __DIR__);
    return preg_grep('~\.(php)$~', scandir($folder));;    
  }

}
