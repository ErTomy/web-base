<?php
class Template {
    private $_tpl_data = array();
    private $template = null;
    private $errores = array();
    private $cache;
    
    public function __construct($path){
        global $rutas;
        global $redirecciones;
        $this->cache = str_replace('class', 'cache/'.md5($path), __DIR__);

        // comprobación por si esta cargando una url amp
        $ruta = ($path == '/amp' || substr($path, 0, 5) == '/amp/')? '/' . substr($path, 5, strlen($path)-5) : $path;
		if(isset($rutas[$ruta])){
			$this->template = ($ruta != $path)?'plantillas/amp/'.$rutas[$ruta]['plantilla']:'plantillas/'.$rutas[$ruta]['plantilla'];
		}	

        if(!isset($rutas[$ruta]) || !isset($rutas[$ruta]['plantilla'])){
            if(isset($redirecciones[$path])){
              Header( "HTTP/1.1 301 Moved Permanently" );
              Header( "Location: " . BASE_URL. $redirecciones[$path]);
              exit; die();
            }else{
              Header("HTTP/1.0 404 Not Found");
              if(DEBUG) echo sprintf('Ruta <b>%s</b> no encontrada en el fichero rutas.php', $path);
              $this->template = 'plantillas/' . ERROR_404;
            }
        }elseif(!file_exists($this->template)){
            if(DEBUG) echo sprintf('La plantilla <b>%s</b> no se ha encontrado en el directorio plantillas', $this->template);
        }else{
            if (!file_exists($this->cache) || (time() - filemtime($this->cache) >= CACHE)){           
              if(isset($rutas[$ruta]['parametros'])){
                  foreach($rutas[$ruta]['parametros'] as $param=>$valor){
                      $this->$param = $valor;
                  }
              }
            }
        }
    }

    public function __set($key,$data) {
        $this->_tpl_data[$key] = $data;
    }

    public function display($display = true) {
      if (!file_exists($this->cache) || (time() - filemtime($this->cache) >= CACHE)){
        $Scope = new TemplateScope($this->template,$this->_tpl_data);
        if($display === true) {
          $contenido = $Scope->_Display();
          if(CACHE > 0){
            file_put_contents($this->cache, $contenido);
          }
          return $contenido;
          exit;
        }
        return $Scope;
      }else{
        return file_get_contents($this->cache);
      }
    }
}
