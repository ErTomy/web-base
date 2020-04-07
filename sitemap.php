<?php
header ("Content-Type:text/xml");
include 'config.php';
$rutas = json_decode(file_get_contents('config/rutas.json'), true);

echo '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="xsl-stylesheets/xml-sitemap.xsl"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
  foreach($rutas as $ruta=>$datos){
      if( file_exists('plantillas/'.$datos['plantilla'])){        
          echo '<url>
                    <loc>'.BASE_URL.substr($ruta, 1).'</loc>
                    <priority>'.$datos['sitemap_priority'].'</priority>
                    <lastmod>'.date("Y-m-d", filemtime('plantillas/'.$datos['plantilla'])).'</lastmod>
                    <changefreq>'.$datos['sitemap_changefreq'].'</changefreq>
                </url>';
      }

  }
echo '</urlset>';
