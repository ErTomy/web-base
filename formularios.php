<?php

$formularios = [
    'contacto'=>[
        'fields'=>[
            'nombre'=>[
                'required'=>'Debe indicar el nombre'
            ],
            'email'=>[
                'required'=>'Debe indicar el email', 
                'email'=>'Debe indicar un email válido'
            ],
            'opciones'=>[
                'required'=>'Debe seleccionar una opción', 
            ],
            'mensaje'=>[]
        ],
        'action'=>'mailto:ertomy@gmail.com',
        'subject'=>'el asunto del correo',
        'template'=>'email.html',
        'msgOK'=>'Gracias por contactar con nosotros, te responderemos lo antes posible'
    ],
    'buscador'=>[
        'fields'=>[
            'texto'=>[
                'required'=>'Debe indicar un mensaje a buscar'
            ]
        ],
        'action'=>'/buscador'
    ]
];