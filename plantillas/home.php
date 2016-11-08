<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $this->title; ?></title>
    <base href="<?php echo BASE_URL; ?>">
  </head>
  <body>
      <?php if($this->include) $this->_include("header.php"); ?>

      Esta es la home a fecha (<?php echo $this->fecha; ?>) y la <?php echo $this->description; ?>


      <a href="pagina/formulario">enlace al formulario</a>


      <?php

        echo $this->__var('aa');
        echo '<br>';
        echo $this->__var('bb');
        
       ?>
      <?php $this->_include("footer.php"); ?>




  </body>
</html>
