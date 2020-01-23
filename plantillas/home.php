<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <?php $this->_metas(); ?>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="<?php $this->_asset('/js/cms-track.js'); ?>"></script>
    
    
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


    <hr>

    Guardando estadisticas de click... <br>
    <a href="tel:+123456789" class="btnTrack" data-track="telefono">Teléfono: 123 45 67 89</a><br>
    <a href="http://www.ertomy.es" class="btnTrack" data-track="web-con-blank" target="_blank">ertomy.es</a><br>
    <a href="pagina/formulario" class="btnTrack" data-track="web-sin-blank">formulario</a><br>





  </body>
</html>
