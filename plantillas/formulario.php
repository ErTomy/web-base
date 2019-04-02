<html>
  <head>
      <?php $this->_metas(); ?>
  </head>
  <body>
      <?php if($this->include) $this->_include("header.php"); ?>
      Este es el formulario:
      <br>


      <?php $this->_include("footer.php");


      echo $_SERVER['REQUEST_URI'];
       ?>
  </body>
</html>
