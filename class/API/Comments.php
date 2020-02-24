<?php

class Comments
{  
  function __construct()
  {
     $auth = new Auth();
     $auth->verify();      
  }


  public function pages($params)
  {
    $result = [];
    foreach(glob('{comentarios/*.json}',GLOB_BRACE) as $path){
      $pagina = [
        'url'=>str_replace('__', '/', explode('/', explode('.json', $path)[0])[1]), 
        'path'=>$path,
        'comentarios'=>0,
        'pendientes'=>0
      ];
      foreach ($this->get(['body'=>['path'=>$path]]) as $comentario) {
        $pagina['comentarios']++;
        if(!$comentario->validate){
          $pagina['pendientes']++;
        }
      }
      $result[] = $pagina;
    }
    return $result;
  }

  public function get($params)
  {
    if(array_key_exists('path', $params['body'])){
      $file = str_replace('class'.DIRECTORY_SEPARATOR.'API', $params['body']['path'], __DIR__);
      if(file_exists($file)){
        return json_decode(file_get_contents($file));
      }
    }  
    return ['error'=>'parametros erroneos'];
  }

  public function set($params){           
    if(array_key_exists('body', $params) && array_key_exists('path', $params['body']) && array_key_exists('comments', $params['body'])){
      $file = str_replace('class'.DIRECTORY_SEPARATOR.'API', $params['body']['path'], __DIR__);
        if(file_exists($file)){
            file_put_contents($file, json_encode($params['body']['comments'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            return ['result'=>true];
        }
    }  
    return ['error'=>'parametros erroneos'];
  }

  

}
