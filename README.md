# web-base #

Estructura para montar web con funcionalidades básicas, con posibilidad de versión amp y generación automática del sitemap.xml

## Estructura básica ##

#### config.php ####

Fichero que almacena la configuración básica del proyecto con las siguientes constantes:

* BASE_URL: constante que identifica la url base de la web
* DEBUG: activa o desactiva la depuración de rutas, plantillas y variables
* CACHE: tiempo de cache de las páginas en segundos
* ERROR_404: página por defecto cuando no encuentra la ruta
* LANG: el metadato lang que se añade a la cabecera
* LOCALITY: el metadato locality que se añade a la cabecera
* AUTHOR: el metadato author que se añade a la cabecera
* ORGANIZATION: el metadato organization que se añade a la cabecera
* ICON: el favicon que tendra la web
* FROM: email remitente de los correos que se mandan

#### redirecciones.php ####

Array de urls "antiguas" y a donde deben ser redirigidas mediante __HTTP/1.1 301 Moved Permanently__ 

#### rutas.php ####

Array con todas las rutas disponibles en la web, indicando los siguientes parametros obligatorios:

* plantilla: indica el fichero php que cargará la página y deberá estar localizado dentro de la carpeta plantillas
* sitemap_priority: prioridad que se le dará a la página en el sitemap.xml
* sitemap_changefreq: frecuencia de refresco de la página en el sitemap.xml
* parametros: parámetros opciones que puede tener la página (title, description, keywords)

#### sitemap.php ####

Fichero que genera el sitemap.xml a partir del fichero de rutas

#### variables.php ####

Array con variables que se van a poder usar desde las plantillas usando la llamada **echo $this->__var('NOMBRE DE LA VARIABLE');**

#### formularios.php ####

Array con los formularios que se validan y envian con la clase Formulario.php

#### /cache ####

Directorio donde se almacenan los ficheros de cache.

#### /class ####

Directorio donde se almacenan las clases. En caso de necesitar crear nuevas lo ideal es crearlas aquí

#### /plantillas ####

Directorio donde se almacenan las plantillas. En caso de tener una plantilla en el directorio /plantillas y otra con el mismo nombre en el directorio /plantillas/amp, se generará una versión amp de la página

#### /plantillas/includes ####

Directorio donde se almacenan los includes que se van a hacer desde otras plantillas

#### /plantillas/emails ####

Directorio donde se almacenan los htmls que se mandan por email desde los formularios 

#### /xsl-stylesheets ####

Directorio donde se almacenan los estilos del sitemap.xml