<?php

return [
    'exceptions' => [
        '401' => 'No autenticado.',
        '403' => 'Prohibido.',
        '404' => 'No se han encontrado resultados.',
        '405' => 'El método especificado en la solicitud no es válido.',
        '422' => 'Los datos enviados no eran válidos.'
    ],

	'400' => [
        'title' => 'Error 400',
        'number' => '400',
        'subtitle' => '¡Error al cargar la página!',
        'text' => '¡Por favor, inténtelo de nuevo más tarde!',
        'button' => 'Inicio'
    ],

    '403' => [
        'title' => 'Error 403',
        'number' => '403',
        'subtitle' => '¡Error de prohibición!',
        'text' => '¡No tienes permiso para acceder a este sitio!',
        'button' => 'Inicio'
    ],

    '404' => [
        'title' => 'Error 404',
        'number' => '404',
        'subtitle' => '¡Página no encontrada!',
        'text' => '¡Lo que buscas no lo encontrarás aquí!',
        'button' => 'Inicio'
    ],

    '419' => [
        'title' => 'Error 419',
        'number' => '419',
        'subtitle' => '¡Sesión expirada!',
        'text' => '¡Su sesión ha caducado!',
        'button' => 'Inicio'
    ],

    '500' => [
        'title' => 'Error 500',
        'number' => '500',
        'subtitle' => '¡Error de servidor interno!',
        'text' => '¡Por favor, inténtelo de nuevo más tarde!',
        'button' => 'Inicio'
    ],

    '503' => [
        'title' => 'Error 503',
        'number' => '503',
        'subtitle' => '¡Este sitio se cargará en unos minutos!',
        'text' => '¡Por favor, inténtelo de nuevo más tarde!',
        'button' => 'Inicio'
    ]
];

?>