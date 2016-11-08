<?php

class Buscador
{
  private $campos_busqueda = array('title', 'Keywords', 'description');
  private $paginas_no_indexa = array('/buscador');
  const HTML = '<div><a href="{ruta}">{titulo}</a><br />{descripcion}</div>';
  public $resultados = array();

  function __construct($palabra)
  {
      global $rutas;
      foreach($rutas as $ruta => $parametros){
        if(!in_array($ruta, $this->paginas_no_indexa)){
          foreach($this->campos_busqueda as $campo){
              if(isset($parametros['parametros'][$campo]) && strpos($parametros['parametros'][$campo], $palabra) !== false && !isset($this->resultados[$ruta])){
                  $this->resultados[$ruta] = array(
                      'titulo'=> $parametros['parametros']['title'],
                      'descripcion' => $parametros['parametros']['description']
                  );
              }
          }
        }
      }
  }
}
