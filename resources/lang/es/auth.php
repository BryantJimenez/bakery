<?php

return [
    'login' => [
        'title' => 'Iniciar Sesión',
        'button' => 'Ingresar',
        'password' => [
            'text' => '¿Olvidaste tu contraseña?',
            'button' => 'Recuperar'
        ],
        'register' => [
            'text' => '¿No tienes cuenta?',
            'button' => 'Regístrate'
        ]
    ],

    'register' => [
        'title' => 'Registro de Usuario',
        'button' => 'Regístrate',
        'terms' => [
            'text' => 'Acepto',
            'button' => 'términos y condiciones'
        ],
        'login' => [
            'text' => 'Ya tienes una cuenta?',
            'button' => 'Ingresar'
        ],
        'modal' => [
            'title' => 'Términos y Condiciones'
        ]
    ],

    'email' => [
        'title' => 'Recuperar Contraseña',
        'button' => 'Enviar',
        'register' => [
            'text' => '¿No tienes cuenta?',
            'button' => 'Regístrate'
        ]
    ],

    'reset' => [
        'title' => 'Restablecer Contraseña',
        'button' => 'Enviar',
        'login' => [
            'text' => 'Ya tienes una cuenta?',
            'button' => 'Ingresar'
        ]
    ],

    'notifications' => [
        'login' => [
            'error' => [
                'title' => 'Ingreso no permitido',
                'msg' => 'Este usuario no tiene permitido ingresar.',
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    'failed' => 'Estas credenciales no coinciden con nuestros registros.',
    'throttle' => 'Demasiados intentos fallidos en muy poco tiempo. Por favor intente de nuevo en :seconds segundos.',
];

?>