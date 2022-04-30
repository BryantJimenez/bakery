<?php

return [
  'name' => 'Tiendita',
  'header' => [
    'profile' => 'Mi perfil',
    'web' => 'Ir a la web',
    'logout' => 'Cerrar Sesión'
  ],

  'sidebar' => [
    'home' => 'Inicio',
    'users' => 'Usuarios',
    'customers' => 'Clientes',
    'categories' => 'Categorías',
    'products' => 'Productos',
    'complements' => 'Complementos',
    'groups' => 'Grupos',
    'orders' => 'Pedidos',
    'agencies' => 'Agencias',
    'attributes' => 'Atributos',
    'coupons' => 'Cupones',
    'currencies' => 'Monedas',
    'languages' => 'Idiomas',
    'schedules' => 'Horarios',
    'settings' => 'Ajustes'
  ],

  'footer' => [
    'copyright' => 'Todos los derechos reservados',
    'developed by' => 'Desarrollado a medida por',
  ],

  'home' => [
    'title' => 'Inicio',
    'welcome' => [
      'title' => 'Bienvenido:',
      'subtitle' => 'Administre todo su negocio de forma simple, fácil, comoda y a medida!'
    ],
    'counters' => [
      'users' => 'Usuarios',
      'customers' => 'Clientes',
      'categories' => 'Categorías',
      'products' => 'Productos',
      'groups' => 'Grupos',
      'complements' => 'Complementos',
      'agencies' => 'Agencias',
      'attributes' => 'Atributos',
      'coupons' => 'Cupones',
      'orders' => [
        'confirms' => 'Pedidos Confirmados',
        'pendings' => 'Pedidos Pendientes'
      ],
      'payments' => 'Pagos'
    ]
  ],

  'profile' => [
    'titles' => [
      'edit' => 'Editar Perfil',
      'show' => 'Perfil de Usuario'
    ],
    'subtitles' => [
      'show' => 'Información Personal'
    ]
  ],

  'users' => [
    'titles' => [
      'index' => 'Lista de Usuarios',
      'create' => 'Crear Usuario',
      'edit' => 'Editar Usuario',
      'show' => 'Perfil de Usuario'
    ],
    'subtitles' => [
      'show' => 'Información Personal'
    ],
    'modals' => [
      'titles' => [
        'deactivate' => '¿Está seguro de que desea desactivar este usuario?',
        'activate' => '¿Está seguro de que desea activar a este usuario?',
        'delete' => '¿Está seguro de que desea eliminar este usuario?'
      ]
    ]
  ],

  'customers' => [
    'titles' => [
      'index' => 'Lista de Clientes',
      'create' => 'Crear Cliente',
      'edit' => 'Editar Cliente',
      'show' => 'Perfil de Cliente'
    ],
    'subtitles' => [
      'show' => 'Información Personal'
    ],
    'modals' => [
      'titles' => [
        'deactivate' => '¿Está seguro de que desea desactivar este cliente?',
        'activate' => '¿Está seguro de que desea activar a este cliente?',
        'delete' => '¿Está seguro de que desea eliminar este cliente?'
      ]
    ]
  ],

  'categories' => [
    'titles' => [
      'index' => 'Lista de Categorías',
      'create' => 'Crear Categoría',
      'edit' => 'Editar Categoría'
    ],
    'modals' => [
      'titles' => [
        'deactivate' => '¿Está seguro de que desea desactivar esta categoría?',
        'activate' => '¿Está seguro de que desea activar a esta categoría?',
        'delete' => '¿Está seguro de que desea eliminar esta categoría?'
      ]
    ]
  ],

  'products' => [
    'titles' => [
      'index' => 'Lista de Productos',
      'create' => 'Crear Producto',
      'edit' => 'Editar Producto',
      'show' => 'Información del Producto'
    ],
    'subtitles' => [
      'show' => [
        'data' => 'Datos del Producto',
        'aditional' => 'Información Adicional',
        'groups' => 'Grupos'
      ]
    ],
    'info' => [
      'qty groups' => 'Nº Grupos'
    ],
    'modals' => [
      'titles' => [
        'deactivate' => '¿Está seguro de que desea desactivar este producto?',
        'activate' => '¿Está seguro de que desea activar a este producto?',
        'delete' => '¿Está seguro de que desea eliminar este producto?',
        'assign' => 'Seleccione los grupos que se asignarán a este producto'
      ]
    ]
  ],

  'complements' => [
    'titles' => [
      'index' => 'Lista de Complementos',
      'create' => 'Crear Complemento',
      'edit' => 'Editar Complemento',
      'show' => 'Información del Complemento'
    ],
    'subtitles' => [
      'show' => [
        'data' => 'Datos del Producto',
        'aditional' => 'Información Adicional'
      ]
    ],
    'modals' => [
      'titles' => [
        'deactivate' => '¿Está seguro de que desea desactivar este complemento?',
        'activate' => '¿Está seguro de que desea activar a este complemento?',
        'delete' => '¿Está seguro de que desea eliminar este complemento?'
      ]
    ]
  ],

  'groups' => [
    'titles' => [
      'index' => 'Lista de Grupos',
      'create' => 'Crear Grupo',
      'edit' => 'Editar Grupo',
      'show' => 'Información del Grupo',
      'complements' => 'Agregar Complementos'
    ],
    'subtitles' => [
      'show' => [
        'data' => 'Información del Grupo',
        'complements' => 'Complementos'
      ]
    ],
    'info' => [
      'min' => 'Cantidad de opciones mínimas para seleccionar',
      'max' => 'Cantidad de opciones máximas para seleccionar',
      'qty complements' => 'Nº Complementos'
    ],
    'modals' => [
      'titles' => [
        'deactivate' => '¿Está seguro de que desea desactivar este grupo?',
        'activate' => '¿Está seguro de que desea activar a este grupo?',
        'delete' => '¿Está seguro de que desea eliminar este grupo?'
      ]
    ]
  ],

  'orders' => [
    'titles' => [
      'index' => 'Lista de Pedidos',
      'show' => 'Detalle del Pedido'
    ],
    'subtitles' => [
      'show' => [
        'user' => 'Datos del Usuario',
        'order' => 'Datos del Pedido',
        'products' => 'Productos del Pedido',
        'payment' => 'Datos del Pago',
        'shipping' => 'Datos del Envío',
        'coupon' => 'Datos del Cupón'      
      ]
    ],
    'info' => [
      'qty products' => 'Cantidad de Productos',
      'total paid' => 'Total Pagado',
      'type delivery' => 'Tipo de Entrega',
      'address shipping' => 'Dirección de Envío',
      'qty' => 'Cantidad',
      'subtotal' => 'Subtotal',
      'shipping' => 'Envío',
      'discount' => 'Descuento',
      'total' => 'Total',
      'reason' => 'Motivo',
      'commission' => 'Comisión',
      'balance' => 'Balance'
    ],
    'modals' => [
      'titles' => [
        'reject' => '¿Estás seguro de que quieres rechazar este pedido?',
        'confirm' => '¿Estás seguro de que quieres confirmar este pedido?'
      ]
    ]
  ],

  'agencies' => [
    'titles' => [
      'index' => 'Lista de Agencias',
      'create' => 'Crear Agencia',
      'edit' => 'Editar Agencia'
    ],
    'modals' => [
      'titles' => [
        'deactivate' => '¿Está seguro de que desea desactivar esta agencia?',
        'activate' => '¿Está seguro de que desea activar a esta agencia?',
        'delete' => '¿Está seguro de que desea eliminar esta agencia?'
      ]
    ]
  ],

  'attributes' => [
    'titles' => [
      'index' => 'Lista de Atributos',
      'create' => 'Crear Atributo',
      'edit' => 'Editar Atributo'
    ],
    'modals' => [
      'titles' => [
        'deactivate' => '¿Está seguro de que desea desactivar este atributo?',
        'activate' => '¿Está seguro de que desea activar a este atributo?',
        'delete' => '¿Está seguro de que desea eliminar este atributo?'
      ]
    ]
  ],

  'coupons' => [
    'titles' => [
      'index' => 'Lista de Cupones',
      'create' => 'Crear Cupón',
      'edit' => 'Editar Cupón'
    ],
    'modals' => [
      'titles' => [
        'deactivate' => '¿Está seguro de que desea desactivar este cupón?',
        'activate' => '¿Está seguro de que desea activar a este cupón?',
        'delete' => '¿Está seguro de que desea eliminar este cupón?'
      ]
    ]
  ],

  'currencies' => [
    'titles' => [
      'index' => 'Lista de Monedas',
      'create' => 'Crear Moneda',
      'edit' => 'Editar Moneda'
    ],
    'modals' => [
      'titles' => [
        'deactivate' => '¿Está seguro de que desea desactivar esta moneda?',
        'activate' => '¿Está seguro de que desea activar a esta moneda?',
        'delete' => '¿Está seguro de que desea eliminar esta moneda?'
      ]
    ]
  ],

  'languages' => [
    'titles' => [
      'languages' => [
        'index' => 'Lista de Idiomas',
        'create' => 'Agregar Idioma'
      ],
      'translations' => [
        'index' => 'Lista de Traducciones',
        'create' => 'Agregar Traducción'
      ]
    ],
    'info' => [
      'group single' => 'Grupo / Individual',
      'key' => 'Índice',
      'search' => 'Buscar todas las traducciones'
    ]
  ],

  'schedules' => [
    'titles' => [
      'index' => 'Lista de Horarios',
      'create' => 'Crear Horario',
      'edit' => 'Editar Horario'
    ],
    'modals' => [
      'titles' => [
        'deactivate' => '¿Está seguro de que desea desactivar este horario?',
        'activate' => '¿Está seguro de que desea activar a este horario?',
        'delete' => '¿Está seguro de que desea eliminar este horario?'
      ]
    ]
  ],
  
  'settings' => [
    'titles' => [
      'edit' => 'Editar Ajustes'
    ]
  ],

  'table' => [
    'actions' => 'Acciones',
    'profile' => 'Perfil',
    'show' => 'Ver',
    'edit' => 'Editar',
    'deactivate' => 'Desactivar',
    'activate' => 'Activar',
    'delete' => 'Eliminar',
    'assign' => [
      'groups' => 'Asignar Grupos',
      'complements' => 'Asignar Complementos'
    ],
    'reject' => 'Rechazar',
    'confirm' => 'Confirmar',
    'order' => 'Ver Pedido',
    'translations' => 'Lista de Traducciones'
  ],

  'values_attributes' => [
    'unknown' => 'Desconocido',
    'states' => [
      'active' => 'Activo',
      'inactive' => 'Inactivo',
      'products' => [
        'not available' => 'No Disponible',
        'out of stock' => 'Agotado'
      ],
      'complements' => [
        'available' => 'Disponible',
        'not available' => 'No Disponible',
        'out of stock' => 'Agotado',
        'not visible' => 'No Visible'
      ],
      'orders' => [
        'rejected' => 'Rechazado',
        'confirmed' => 'Confirmado',
        'waiting' => 'En Espera'
      ],
      'payments' => [
        'rejected' => 'Rechazado',
        'confirmed' => 'Confirmado',
        'pending' => 'Pendiente'
      ],
      'settings' => [
        'open' => 'Abierto',
        'closed' => 'Cerrado'
      ]
    ],
    'types' => [
      'coupons' => [
        'fixed' => 'Fijo',
        'percentage' => 'Porcentaje'
      ],
      'deliveries' => [
        'eat on site' => 'Comer en el Lugar',
        'to take away' => 'Recoger para Llevar',
        'delivery' => 'A Domicilio'
      ]
    ],
    'conditions' => [
      'required' => 'Obligatorio',
      'optional' => 'Opcional'
    ],
    'methods' => [
      'card' => 'Tarjeta'
    ],
    'days' => [
      '1' => 'Lunes',
      '2' => 'Martes',
      '3' => 'Miércoles',
      '4' => 'Jueves',
      '5' => 'Viernes',
      '6' => 'Sábado',
      '7' => 'Domingo'
    ],
    'forces' => [
      'yes' => 'Si',
      'no' => 'No'
    ]
  ],
  'not added' => 'No Ingresado',

  'notifications' => [
    'success' => [
      'titles' => [
        'store' => 'Registro exitoso',
        'update' => 'Edición exitosa',
        'destroy' => 'Eliminación exitosa'
      ],

      'messages' => [
        'profile' => [
          'update' => 'El perfil ha sido editado exitosamente.'
        ],

        'users' => [
          'store' => 'El usuario ha sido registrado exitosamente.',
          'update' => 'El usuario ha sido editado exitosamente.',
          'destroy' => 'El usuario ha sido eliminado exitosamente.',
          'deactivate' => 'El usuario ha sido desactivado exitosamente.',
          'activate' => 'El usuario ha sido activado exitosamente.'
        ],

        'customers' => [          
          'store' => 'El cliente ha sido registrado exitosamente.',
          'update' => 'El cliente ha sido editado exitosamente.',
          'destroy' => 'El cliente ha sido eliminado exitosamente.',
          'deactivate' => 'El cliente ha sido desactivado exitosamente.',
          'activate' => 'El cliente ha sido activado exitosamente.'
        ],

        'categories' => [
          'store' => 'La categoría ha sido registrada exitosamente.',
          'update' => 'La categoría ha sido editada exitosamente.',
          'destroy' => 'La categoría ha sido eliminada exitosamente.',
          'deactivate' => 'La categoría ha sido desactivada exitosamente.',
          'activate' => 'La categoría ha sido activada exitosamente.'
        ],

        'products' => [
          'store' => 'El producto ha sido registrado exitosamente.',
          'update' => 'El producto ha sido editado exitosamente.',
          'destroy' => 'El producto ha sido eliminado exitosamente.',
          'deactivate' => 'El producto ha sido desactivado exitosamente.',
          'activate' => 'El producto ha sido activado exitosamente.',
          'assign' => 'El grupo de complementos se ha asignado exitosamente.'
        ],

        'complements' => [
          'store' => 'El complemento ha sido registrado exitosamente.',
          'update' => 'El complemento ha sido editado exitosamente.',
          'destroy' => 'El complemento ha sido eliminado exitosamente.',
          'deactivate' => 'El complemento ha sido desactivado exitosamente.',
          'activate' => 'El complemento ha sido activado exitosamente.'
        ],

        'groups' => [
          'store' => 'El grupo ha sido registrado exitosamente.',
          'update' => 'El grupo ha sido editado exitosamente.',
          'destroy' => 'El grupo ha sido eliminado exitosamente.',
          'deactivate' => 'El grupo ha sido desactivado exitosamente.',
          'activate' => 'El grupo ha sido activado exitosamente.',
          'assign' => 'Los complementos han sido asignados exitosamente.'
        ],

        'orders' => [
          'reject' => 'El pedido ha sido rechazado exitosamente.',
          'confirm' => 'El pedido ha sido confirmado exitosamente.'
        ],

        'agencies' => [
          'store' => 'La agencia ha sido registrada exitosamente.',
          'update' => 'La agencia ha sido editada exitosamente.',
          'destroy' => 'La agencia ha sido eliminada exitosamente.',
          'deactivate' => 'La agencia ha sido desactivada exitosamente.',
          'activate' => 'La agencia ha sido activada exitosamente.'
        ],

        'attributes' => [
          'store' => 'El atributo ha sido registrado exitosamente.',
          'update' => 'El atributo ha sido editado exitosamente.',
          'destroy' => 'El atributo ha sido eliminado exitosamente.',
          'deactivate' => 'El atributo ha sido desactivado exitosamente.',
          'activate' => 'El atributo ha sido activado exitosamente.'
        ],

        'coupons' => [
          'store' => 'El cupón ha sido registrado exitosamente.',
          'update' => 'El cupón ha sido editado exitosamente.',
          'destroy' => 'El cupón ha sido eliminado exitosamente.',
          'deactivate' => 'El cupón ha sido desactivado exitosamente.',
          'activate' => 'El cupón ha sido activado exitosamente.'
        ],
        
        'currencies' => [
          'store' => 'La moneda ha sido registrada exitosamente.',
          'update' => 'La moneda ha sido editada exitosamente.',
          'destroy' => 'La moneda ha sido eliminada exitosamente.',
          'deactivate' => 'La moneda ha sido desactivada exitosamente.',
          'activate' => 'La moneda ha sido activada exitosamente.'
        ],
        
        'languages' => [
          'store' => 'El idioma ha sido registrado exitosamente.'
        ],

        'schedules' => [
          'store' => 'El horario ha sido registrado exitosamente.',
          'update' => 'El horario ha sido editado exitosamente.',
          'destroy' => 'El horario ha sido eliminado exitosamente.',
          'deactivate' => 'El horario ha sido desactivado exitosamente.',
          'activate' => 'El horario ha sido activado exitosamente.'
        ],
        
        'settings' => [
          'update' => 'Los ajustes han sido editados exitosamente.'
        ]
      ]
    ],

    'error' => [
      '500' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.',
      'titles' => [
        'store' => 'Registro fallido',
        'update' => 'Edición fallida',
        'destroy' => 'Eliminación fallida'
      ],

      'messages' => [
        'customers' => [
          '403' => [
            'title' => 'El usuario no es un cliente',
            'msg' => 'Este usuario no es un cliente, tiene un rol diferente.'
          ]
        ],

        'categories' => [
          '422' => [
            'title' => 'La categoría ya existe',
            'msg' => 'Esta categoría ya se encuentra registrada.'
          ]
        ],

        'attributes' => [
          '422' => [
            'title' => 'El atributo ya existe',
            'msg' => 'Este atributo ya se encuentra registrado.'
          ]
        ],
        
        'currencies' => [
          '422' => [
            'title' => 'La moneda ya existe',
            'msg' => 'Esta moneda ya se encuentra registrada.'
          ]
        ],
        
        'languages' => [
          '422' => [
            'title' => 'El idioma ya existe',
            'msg' => 'Este idioma ya se encuentra registrada.'
          ]
        ],

        'schedules' => [
          '422' => [
            'title' => 'El horario ya existe',
            'msg' => 'Este horario interfiere con otro ya registrado.'
          ]
        ]
      ]
    ]
  ],

  'js' => [
    '500' => [
      'title' => 'Error',
      'msg' => 'Ha ocurrido un problema, inténtelo de nuevo.'
    ],

    'table' => [
      'info' => 'Resultados del :start al :end de un total de :total registros',
      'search' => 'Buscar...',
      'length' => 'Mostrar :menu registros',
      'processing' => 'Procesando...',
      'empty' => [
        'zero' => 'No se encontraron resultados',
        'table' => 'Ningún resultado disponible en esta tabla',
        'info' => 'No hay resultados'
      ],
      'filter' => '(filtrado de un total de :max registros]',
      'loading' => 'Cargando...',
      'sort' => [
        'asc' => ': Activar para ordenar la columna de manera ascendente',
        'desc' => ': Activar para ordenar la columna de manera descendente',
      ],
      'buttons' => [
        'copy' => 'Copiar',
        'print' => 'Imprimir'
      ]
    ],

    'file' => [
      'messages' => [
        'default' => 'Arrastre y suelte una imagen o da click para seleccionarla',
        'replace' => 'Arrastre y suelte una imagen o haga click para reemplazar',
        'remove' => 'Remover',
        'error' => 'Lo sentimos, el archivo es demasiado grande'
      ],

      'error' => [
        'fileSize' => 'El tamaño del archivo es demasiado grande (:value máximo].',
        'minWidth' => 'El ancho de la imagen es demasiado pequeño (:value}px mínimo].',
        'maxWidth' => 'El ancho de la imagen es demasiado grande (:value}px máximo].',
        'minHeight' => 'La altura de la imagen es demasiado pequeña (:value}px mínimo].',
        'maxHeight' => 'La altura de la imagen es demasiado grande (:valuepx máximo].',
        'imageFormat' => 'El formato de imagen no está permitido (Debe ser :value].'
      ]
    ],

    'date' => [
      'cancel' => 'Cancelar',
      'clear' => 'Limpiar'
    ]
  ]
];
