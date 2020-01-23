<?php
class Formulario {
    
    private $form;
    private $name;
    public $id;
    public $OK = []; 
    public $divOK;
    public $errores = [];

    function __construct($formulario, $id = null)
    {
        global $formularios;
        if (array_key_exists($formulario, $formularios)) {
            $this->form = $formularios[$formulario];
            $this->name = $formulario;
            $this->id = ($id === null)?substr(md5(microtime()),rand(0,26),10):$id;            
            $this->divOK = 'OK' . $this->id;
        }elseif(DEBUG){
            echo sprintf('No existe el formulario <b>%s</b> en el fichero formularios.php', $formulario);
        }    
    }

    public function init($clases='')
    {
        echo '<form action="'.BASE_URL.'" id="form'.$this->id.'" class="cmsForm" data-clases="'.$clases.'">
                <input type="hidden" name="formName" value="'.$this->name.'">
                <input type="hidden" name="formId" value="'.$this->id.'">';
    }

    public function validar(){
        foreach ($this->form['fields'] as $field => $validations) {
            foreach ($validations as $type => $msg) {
                switch ($type) {
                    case 'required':
                        if(!array_key_exists($field, $this->errores) && (!array_key_exists($field, $_POST) || strlen($_POST[$field]) == 0))    
                            $this->errores[$field] = $msg;
                        break;                    
                    case 'email':
                        if(!array_key_exists($field, $this->errores) && (!array_key_exists($field, $_POST) || !filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)))    
                            $this->errores[$field] = $msg;
                        break;  
                }
            }
        }
        if(count($this->errores) === 0){
            if( strpos($this->form['action'], 'mailto:') !== false){
                $cabeceras = "MIME-version: 1.0\r\n";
                $cabeceras .= "Content-type:text/html; charset=utf-8\r\n";
                $cabeceras .= "From: ".FROM."\r\n";    
                $html = file_get_contents(str_replace('class', 'plantillas/emails/'.$this->form['template'], __DIR__));
                foreach ($this->form['fields'] as $field => $validations) {
                    $html = str_replace('{'.$field.'}', $_POST[$field], $html);
                }                    
                @mail(str_replace('mailto:', '', $this->form['action']), $this->form['subject'], $html, $cabeceras);                  
            }elseif($this->form['action'] == 'comentar'){
                $file = str_replace('class', 'comentarios' . DIRECTORY_SEPARATOR, __DIR__) . str_replace('/', '__', str_replace(BASE_URL, '', $_SERVER['HTTP_REFERER'])) . '.json';                
                $comentarios = (file_exists($file))?json_decode(file_get_contents($file)):[];
                $comentario = $_POST;
                $comentario['date'] = date('d/m/Y H:i:s');
                $comentario['validate'] = false;
                $comentarios[] = $comentario;
                file_put_contents($file, json_encode($comentarios));      
            }
            $this->OK['id'] = $this->id;
            $this->OK['mensaje'] = $this->form['msgOK'];
            return true;          
        }else{
            return false;
        }
    }

    public function comentarios(){
        $path = str_replace(BASE_URL, '', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        $file = str_replace('class', 'comentarios' . DIRECTORY_SEPARATOR, __DIR__) . str_replace('/', '__', $path) . '.json';
        return (file_exists($file))? array_filter(json_decode(file_get_contents($file)), function($comment) {return $comment->validate;}):[];        
    }

}