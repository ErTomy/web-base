<?php

$rutas = array();

$rutas['/'] = array( 'plantilla'=>'home.php',
                     'cache'=>false,
                     'class'=>array('prueba'),
                     'parametros'=>array('title'=>'Home',
                                         'description'=>'Esta es la descripción de la home',
                                         'Keywords'=>'a, b, c, d',
                                         'include'=>false,
                                         'fecha'=>date('d/m/Y')
                                       )

                    );

$rutas['/pagina/formulario'] = array( 'plantilla'=>'formulario.php',
                               'parametros'=>array('title'=>'formulario',
                                                   'description'=>'Esta es la descripción del formulario',
                                                   'Keywords'=>'a, b, c, d',
                                                   'include'=>true
                                                  )
                              );

$rutas['/buscador'] = array( 'plantilla'=>'buscador.php',
                               'parametros'=>array('title'=>'buscador',
                                                   'description'=>'Esta es la descripción',
                                                   'Keywords'=>'a, b, c, d',
                                                   'include'=>true
                                                  )
                              );
