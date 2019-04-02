<?php

class TemplateScope {

    private $__data = array();
    private $compiled;
    private $template;
    public function __construct($template,$data) {
        $this->__data = $data;
        $this->template = $template;
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

    public function _metas()
    {
        if (defined('LANG')) echo '<meta name="lang" content="'.LANG.'" />';
        if (defined('LOCALITY')) echo '<meta name="locality" content="'.LOCALITY.'" />';
        if (defined('AUTHOR')) echo '<meta name="author" content="'.AUTHOR.'" />';
        if (defined('ORGANIZATION')) echo '<meta name="organization" content="'.ORGANIZATION.'" />';
        if (defined('ICON')) echo ' <link rel="icon" href="'.ICON.'" type="image/x-icon" /><link rel="shortcut icon" href="'.ICON.'" type="image/x-icon" />';

        if (isset($this->__data['title'])) echo '<title>'. $this->title .'</title><meta property="og:title" content="'. $this->title .'" /><meta itemprop="name" content="'. $this->title .'">';
        if (isset($this->__data['description'])) echo '<meta name="description" content="'. $this->description .'" /><meta property="og:description" content="'. $this->description .'" /><meta itemprop="description" content="'. $this->description .'">';
        if (isset($this->__data['keywords'])) echo '<meta name="description" content="'. $this->keywords .'" /><meta property="article:tag" content="'. $this->keywords .'" />';
        if (isset($this->__data['image'])) echo '<meta property="og:image" content="'.$this->image.'" /><meta itemprop="image" content="'.$this->image.'">';
 
        echo '<base href="'. BASE_URL .'">';

        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        if(file_exists(str_replace('plantillas/', 'plantillas/amp/', $this->template))){
            echo '<link rel="amphtml" href="'.str_replace(BASE_URL, BASE_URL.'amp/', "$protocol{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}").'">';
        }elseif(substr($this->template, 0, 15) == 'plantillas/amp/'){
            echo '<link rel="canonical" href="'.str_replace(BASE_URL.'amp/', BASE_URL, "$protocol{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}").'">';
        }

    }


}
