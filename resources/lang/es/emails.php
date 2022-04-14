<?php

return [
	'register' => [
		'subject' => 'Nuevo Usuario',
		'greeting' => 'Hola :name :lastname, bienvenido a :app, te has registrado correctamente.'
	],

	'reset' => [
		'subject' => 'Recuperar Contraseña',
		'greeting' => 'Hola! :name',
		'text' => 'Recibes este correo porque se ha solicitado una restablecimiento de contraseña de tu cuenta.',
		'call to action' => 'Recuperar',
		'expire' => 'Este link para recuperar contraseña expirara en 30 minutos.',
		'advise' => 'Si no realizaste esta petición, puedes ignorar este correo y nada habra cambiado.'
	],

	'contact' => [
		'subject' => 'Mensaje de Contacto',
		'greeting' => 'Hola, recibes este mensaje desde el formulario de la página web:',
		'name' => 'Nombre',
		'email' => 'Email',
		'case' => 'Asunto',
		'message' => 'Mensaje'
	],

	'salutation' => 'Saludos, :name'
]

?>