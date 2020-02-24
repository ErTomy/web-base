<?php

class Tracks
{  
  function __construct()
  {
    $auth = new Auth();
    $auth->verify();      
  }


  public function get($params)
  {

    $year = (array_key_exists('year', $params['body']))?$params['body']['year']:date("Y");
    $month = (array_key_exists('month', $params['body']))?$params['body']['month']:0;

    $meses = [ '', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    $result = [];
    foreach(glob('{tracks/*}',GLOB_BRACE) as $path){
      $track = explode('/', $path)[1];

      $handle = fopen(str_replace('class'.DIRECTORY_SEPARATOR.'API', $path, __DIR__), "r");
      if ($handle) {
          if($month == 0){            
            // estamos devolviendo todo el año por meses
            while (($line = fgets($handle)) !== false) {
              $date = DateTime::createFromFormat("d/m/Y H:i:s", trim($line));
              if($date->format("Y") == $year){   
                if(!array_key_exists($track, $result)){
                  $result[$track] = ['Enero'=>0, 'Febrero'=>0, 'Marzo'=>0, 'Abril'=>0, 'Mayo'=>0, 'Junio'=>0, 'Julio'=>0, 'Agosto'=>0, 'Septiembre'=>0, 'Octubre'=>0, 'Noviembre'=>0, 'Diciembre'=>0];
                }
                $result[$track][$meses[$date->format("n")]]++;
              }                     
            }
            fclose($handle);          
          }else{
            // estamos devolviendo un mes en concreto por dias
            while (($line = fgets($handle)) !== false) {
              $date = DateTime::createFromFormat("d/m/Y H:i:s", trim($line));
              if($date->format("Y") == $year && $date->format("n") == $month){   
                if(!array_key_exists($track, $result)){
                  $result[$track] = [];
                  for($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {              
                    $result[$track][$i] = 0;              
                  }
                }  
                $result[$track][$date->format("j")]++;
              } 
            }   
          }          
               
      }

    }
    return $result;
  }
 
}
