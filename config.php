<?php
define('BASE_URL', 'http://localhost/'); // url base de la web
define('DEBUG', true); // mostrar el depurador
define('CACHE', 0); // tiempo de cache de las páginas en segundos

define('ERROR_404', '404.php'); // página por defecto cuando no encuentra la ruta


/* posibles metatags que afectaran a todas las páginas */
define('LANG', 'es');
define('LOCALITY', 'España'); 
define('AUTHOR', 'Tomás Javier Rodríguez'); 
define('ORGANIZATION', 'ErTomy'); 
define('ICON', 'favicon.ico'); 


/* el email remitente del envio de correos */
define('FROM', 'ertomy@gmail.com');

/* la clave por la que se generan los tokens */
define('SECRET', 'Palabra clave');

/* datos de acceso al administrador */
define('ADMINUSER', 'tomy');
define('ADMINPASS', 'pass');