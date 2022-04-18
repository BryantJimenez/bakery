<?php

return [
    'menu' => [
        'menu' => 'Menú',
        'home' => 'Inicio',
        'sign in' => 'Ingresar',
        'sign up' => 'Registrarse',
        'checkout' => 'Finalizar Compra',
        'languages' => 'Idiomas',
        'dashboard' => 'Panel Administrativo',
        'profile' => 'Mi Perfil',
        'logout' => 'Cerrar Sesión'
    ],

    'cart' => [
        'header' => [
            'empty' => 'Pedido Vacío',
            'total' => 'Total',
            'button' => 'Finalizar Compra'
        ],
        'card' => [
            'title' => 'Resumen del Pedido',
            'empty' => 'Pedido Vacío',
            'subtotal' => 'Subtotal',
            'delivery' => 'Delivery',
            'total' => 'Total',
            'buttons' => [
                'checkout' => 'Pedir Ahora',
                'mobile' => 'Ver Pedido'
            ]
        ]
    ],

    'shop' => [
        'categories' => 'Categorías',
        'choose a type of' => 'Elige un tipo de :category',
        'you can choose' => 'Tú puedes elegir:',
        'not available' => 'No Disponible',
        'empty' => 'No hay productos, intenta cambiar de categoría',
        'modal' => [
            'choices' => [
                'choose' => 'Elige :max :attribute',
                'choose at least' => 'Elige al menos :min :atribute (Máximo :max)',
                'choose maximum' => 'Elige máximo :max :attribute'
            ],
            'buttons' => [
                'undo' => 'Volver',
                'cancel' => 'Cancelar',
                'add cart' => 'Agregar al Carrito',
                'continue' => 'Continuar'
            ],
            'validations' => [
                'choose' => [
                    'min' => '{1} Selecciona mínimo 1 opción|[2,*] Selecciona mínimo :min opciones',
                    'max' => '{1} Selecciona máximo 1 opción|[2,*] Selecciona máximo :max opciones'
                ]
            ]
        ]
    ],

    'checkout' => [
        'title' => 'Finalizar Compra',
        'personal details' => 'Detalles Personales',
        'shipping' => [
            'title' => 'Método de Entrega',
            'label' => '¿Dónde lo Enviamos?'
        ],
        'payment' => 'Método de Pago',
        'button' => 'Comprar',
        'login' => [
            'title' => 'Ingresa A Tu Cuenta',
            'description' => 'Para finalizar el pedido ingresa a tu cuenta',
            'button' => 'Ingresar'
        ],
        'register' => [
            'title' => 'Crea Tu Cuenta',
            'description' => 'Si aun no tienes una cuenta',
            'button' => 'Registrate'
        ]
    ],

    'profile' => [
        'title' => 'Perfil',
        'orders' => [
            'title' => 'Pedidos',
            'table' => [
                'total' => 'Total',
                'state' => 'Estado',
                'date' => 'Fecha',
                'actions' => 'Acciones',
                'show' => 'Ver Pedido',
                'empty' => 'No se ha realizado ningun pedido'
            ]
        ],
        'settings' => [
            'title' => 'Ajustes',
            'information personal' => 'Información Personal'
        ]
    ],

    'order' => [
        'title' => 'Detalles del Pedido',
        'info' => [
            'date' => 'Fecha del pedido',
            'method' => 'Método de pago',
            'total' => 'Total del pedido',
            'state' => [
                'order' => 'Estado del pedido',
                'payment' => 'Estado del pago'
            ]
        ]
    ],

    'notifications' => [
        'success' => [
            'titles' => [
                'buy' => 'Compra exitosa'
            ],

            'messages' => [
                'buy' => 'La compra ha sido completada exitosamente.'
            ]
        ],

        'error' => [
            'titles' => [
                'buy' => 'Compra fallida',
                'cart' => 'Carrito Vacío'
            ],

            'messages' => [
                'cart' => 'El carrito no tiene ningun producto.',
                'categories' => [
                    '404' => [
                        'title' => 'Categoría No Encontrada',
                        'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'
                    ]
                ],

                'products' => [
                    '404' => [
                        'title' => 'Producto No Encontrado',
                        'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'
                    ]
                ],

                'complements' => [
                    '404' => [
                        'title' => 'Complemento No Disponible',
                        'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'
                    ]
                ]
            ]
        ]
    ]
];

?>