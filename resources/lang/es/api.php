<?php

return [
	'errors' => [
		'401' => [
			'auth' => 'Las credenciales no coinciden.'
		],
		'403' => [
			'auth' => 'Este usuario no puede ingresar.',
			'customer' => 'El usuario no es un cliente'
		],
		'422' => [
			'auth' => 'La contraseña es incorrecta.',
			'profile' => [
				'changePassword' => [
					'password' => 'La contraseña actual es incorrecta.',
					'equal' => 'La nueva contraseña no puede ser la misma que la actual.'
				],
				'changeEmail' => [
					'email' => 'El correo electrónico actual es incorrecto.',
					'equal' => 'El nuevo correo electrónico no puede ser el mismo que el actual.'
				]
			],
			'category' => 'Esta categoría ya existe.',
			'attribute' => 'Este atributo ya existe.',
			'currency' => 'Esta moneda ya existe.'
		],
		'500' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'
	],

	'auth' => [
		'register' => 'Registro exitoso.',
		'logout' => 'La sesión ha sido cerrada exitosamente.'
	],

	'profile' => [
		'update' => 'Perfil de usuario actualizado exitosamente.',
		'changePassword' => 'La contraseña fue editada exitosamente.',
		'changeEmail' => 'El correo electrónico fue editado exitosamente.'
	],

	'cart' => [
		'store' => 'El producto ha sido agregado al carrito exitosamente.',
		'add' => 'El producto ha sido agregado al carrito exitosamente.',
		'remove' => 'El producto ha sido removido al carrito exitosamente.',
		'destroy' => 'El producto ha sido eliminado del carrito exitosamente.'
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
		'assign' => 'Los grupos han sido asignados exitosamente.'
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
		'activate' => 'El atributo ha sido activado exitosamente.',
	],

	'currencies' => [
		'store' => 'La moneda ha sido registrada exitosamente.',
		'update' => 'La moneda ha sido editada exitosamente.',
		'destroy' => 'La moneda ha sido eliminada exitosamente.',
		'deactivate' => 'La moneda ha sido desactivada exitosamente.',
		'activate' => 'La moneda ha sido activada exitosamente.'
	],

	'settings' => [
		'update' => 'Los ajustes han sido editados exitosamente.'
	]
];

?>