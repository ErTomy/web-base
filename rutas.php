<?php

$rutas = array();

$rutas['/'] = array( 'plantilla'=>'home.php',  
                     'sitemap_priority'=>1,
                     'sitemap_changefreq'=>'weekly',                   
                     'parametros'=>array('title'=>'Home',
                                         'description'=>'Esta es la descripción de la home',
                                         'keywords'=>'a, b, c, d',
                                         'image'=>'https://scontent.fmad10-1.fna.fbcdn.net/v/t1.0-1/c75.33.414.414a/p480x480/402487_2864033321724_257771298_n.jpg?_nc_cat=111&_nc_ht=scontent.fmad10-1.fna&oh=2236bed29be0cf341e6b1f253f491e18&oe=5D4DA2BC',
                                         'include'=>false,
                                         'fecha'=>date('d/m/Y')                                         
                                       )

                    );

$rutas['/pagina/formulario'] = array( 'plantilla'=>'formulario.php',
                                      'sitemap_priority'=>0.5,
                                      'sitemap_changefreq'=>'monthly',
                                      'parametros'=>array('title'=>'formulario',
                                                          'description'=>'Esta es la descripción del formulario',
                                                          'keywords'=>'a, b, c, d',
                                                          'include'=>true                                                   
                                                          )
                                    );

$rutas['/pagina/sinamp'] = array( 'plantilla'=>'sinamp.php',
                                  'sitemap_priority'=>0.2,
                                  'sitemap_changefreq'=>'monthly',
                                  'parametros'=>array('title'=>'página sin amp',
                                                      'description'=>'Esta es la descripción de la página'                                                                                                    
                                                     )
                                );

$rutas['/buscador'] = array(  'plantilla'=>'buscador.php',
                              'sitemap_priority'=>0.5,
                              'sitemap_changefreq'=>'weekly',
                              'parametros'=>array('title'=>'buscador',
                                                   'description'=>'Esta es la descripción',
                                                   'keywords'=>'a, b, c, d',
                                                   'include'=>true                                                   
                                                  )
                              );
