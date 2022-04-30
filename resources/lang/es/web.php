<?php

return [
    'menu' => [
        'menu' => 'Menú',
        'home' => 'Inicio',
        'shop' => 'Tienda',
        'sign in' => 'Ingresar',
        'sign up' => 'Registrarse',
        'checkout' => 'Finalizar Compra',
        'languages' => 'Idiomas',
        'points' => ':points pts',
        'dashboard' => 'Panel Administrativo',
        'profile' => 'Mi Perfil',
        'logout' => 'Cerrar Sesión'
    ],

    'home' => [
        'banner' => [
            'heading' => 'Bienvenido',
            'title' => 'Coma <span class="font-weight-light">Saludable</span><br>Sea Saludable',
            'button' => 'Pedir Ya',
            'text' => 'La plantilla perfecta para tu restaurante, cafetería o pub. Cree un sitio lleno de sabor que sorprenda a la multitud.'
        ],
        'products' => [
            'heading' => 'Restaurante',
            'title' => 'Menú',
            'all' => 'Todos',
            'button' => 'Ver Todos'
        ],
        'about' => [
            'heading' => 'Nuestra Historia',
            'title' => 'Pocas Palabras Sobre Nosotros',
            'paragraphs' => [
                'one' => 'En 1971, Rosa, Josep, la abuela Rosalía y el abuelo Antonio transformaron una bocatería de la calle Ausias Marc en una pequeña tienda tradicional de barrio, Pa i Trago',
                'two' => 'Desde sus inicios fue un comercio especializado en quesos, embutidos, vinos, cavas y también comida para llevar. La cocina de la abuela Rosalía deslumbró el paladar de los vecinos que pronto se convirtieron en parte de la clientela que apreciaba la buena comida.'
            ]
        ],
        'footer' => [
            'address' => [
                'title' => 'Dirección',
                'text' => 'C / Ausiàs March,<br>Lorem Ipsum is simply',
                'button' => 'Ver Mapa'
            ],
            'schedule' => [
                'title' => 'Horario de Atención',
                'text' => [
                    'not found' => 'No hay horario disponibles',
                    'stairway' => ':first a :last',
                    'two days' => ':first y :last',
                    'and' => 'y'
                ]
            ],
            'contact' => [
                'title' => 'Contactanos',
                'phone' => '93 245 20 04',
                'email' => 'direccio@paitrago.com',
                'button' => 'Enviar Mensaje'
            ],
            'copyright' => '© 2022 PaiTrago'
        ]
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
            'discount' => 'Descuento',
            'total' => 'Total',
            'buttons' => [
                'checkout' => 'Pedir Ahora',
                'mobile' => 'Ver Pedido'
            ]
        ]
    ],

    'shop' => [
        'title' => 'Tienda',
        'categories' => 'Categorías',
        'choose a type of' => 'Elige un tipo de :category',
        'you can choose' => 'Tú puedes elegir:',
        'not available' => 'No Disponible',
        'empty' => 'No hay productos, intenta cambiar de categoría',
        'modal' => [
            'choices' => [
                'choose' => 'Elige :max :attribute',
                'choose at least' => 'Elige al menos :min :attribute (Máximo :max)',
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
                'cart' => 'Carrito Vacío',
                'coupons' => [
                    'error' => 'Cupón Incorrecto',
                    'not available' => 'Cupón No Disponible',
                    'expired' => 'Cupón Expirado',
                    'limit' => 'Límite Alcanzado'
                ],
                'closed' => 'La tienda está cerrada'
            ],

            'messages' => [
                'cart' => 'El carrito no tiene ningun producto.',
                'coupons' => [
                    'error' => 'Este cupón no es correcto.',
                    'not available' => 'Ya has utilizado este cupón.',
                    'expired' => 'Este cupón ha expirado.',
                    'limit' => 'Ya has usado un cupón para esta compra.'
                ],
                'closed' => 'La tienda se encuentra cerrada en este momento.',
                
                'subject' => [
                    'buy' => 'Compra de productos.'
                ],

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
    ],

    'js' => [
        'coupons' => [
            'buttons' => [
                'add' => 'Agregar un cupón de descuento',
                'remove' => 'Quitar el cupón de descuento',
                'close' => 'Cerrar el cupón de descuento'
            ],

            'notifications' => [
                'add' => [
                    'title' => 'Cupón Agregado',
                    'message' => 'El cupón de descuento ha sido agregado exitosamente'
                ],

                'remove' => [
                    'title' => 'Cupón Removido',
                    'message' => 'El cupón de descuento ha sido removido exitosamente'
                ]
            ]
        ]
    ],

    'offline' => [
        'text' => 'Actualmente no estás conectado a ninguna red.'
    ]
];

?>