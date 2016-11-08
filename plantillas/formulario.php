<html>
  <head>
    <title><?php echo $this->title; ?></title>
    <base href="<?php echo BASE_URL; ?>">
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
