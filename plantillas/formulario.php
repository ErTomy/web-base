<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="/js/cms-formularios.js"></script>
</head>
<body>

<!-- el formulario -->
<?php $form = new Formulario('contacto'); ?>
<?php $form->init('clase1 clase2'); ?> 

<fieldset> Nombre <input type="text" name="nombre"> </fieldset> 
<fieldset> Email <input type="text" name="email"></fieldset>
<fieldset> Opción <select name="opciones">
          <option value="">Seleccione una opción</option>  
          <option value="1">Uno</option>
          <option value="2">Dos</option>
          <option value="3">Tres</option>
        </select></fieldset>
<fieldset> Mensaje <textarea name="mensaje"></textarea></fieldset>
<fieldset> <input type="submit" value="Enviar"> </fieldset>
</form>
<!-- fin del formulario -->


<!-- capa de formulario enviado -->
<div id="<?php echo $form->divOK; ?>"></div>







</body>
</html>





