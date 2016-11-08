<?php

class TemplateScope {

    private $__data = array();
    private $compiled;
    public function __construct($template,$data) {
        $this->__data = $data;
        if(file_exists($template)) {
            ob_start();
            require_once $template;
            $this->compiled = ob_get_contents();
            ob_end_clean();
        }
    }

    public function __get($key) {
        return isset($this->__data[$key]) ? $this->__data[$key] : ((DEBUG)?sprintf('La variable <b>%s</b> no esta definida', $key):null);
    }

    public function __var($key) {
        global $variables;
        return isset($variables[$key]) ? $variables[$key] : ((DEBUG)?sprintf('La variable <b>%s</b> no esta definida', $key):null);
    }

    public function _Display() {
        if($this->compiled !== null) {
             return $this->compiled;
        }
    }

    public function _include($file) {
        if(file_exists('plantillas/includes/'.$file)){
            require_once 'plantillas/includes/'.$file;
        }elseif(DEBUG){
            echo sprintf('El include <b>%s</b> no se ha encontrado', 'plantillas/includes/'.$file);
        }
    }
}
