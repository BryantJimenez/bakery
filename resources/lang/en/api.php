<?php

return [
	'errors' => [
		'401' => [
			'auth' => 'The credentials do not match.'
		],
		'403' => [
			'auth' => 'This user cannot login.',
			'customer' => 'User is not a customer'
		],
		'422' => [
			'auth' => 'Password is incorrect.',
			'profile' => [
				'changePassword' => [
					'password' => 'The current password is incorrect.',
					'equal' => 'The new password cannot be the same as the current one.'
				],
				'changeEmail' => [
					'email' => 'The current email is incorrect.',
					'equal' => 'The new email cannot be the same as the current one.'
				]
			],
			'category' => 'This category already exists.',
			'attribute' => 'This attribute already exists.',
			'currency' => 'This currency already exists.'
		],
		'500' => 'An error occurred during the process, please try again.'
	],

	'auth' => [
		'register' => 'Successful registration.',
		'logout' => 'The session has been closed successfully.'
	],

	'profile' => [
		'update' => 'User profile updated successfully.',
		'changePassword' => 'The password was successfully edited.',
		'changeEmail' => 'The email was successfully edited.'
	],

	'cart' => [
		'store' => 'The product has been added to the cart successfully.',
		'add' => 'The product has been added to the cart successfully.',
		'remove' => 'The product has been successfully removed from the cart.',
		'destroy' => 'The product has been successfully deleted from the cart.'
	],

	'users' => [
		'store' => 'The user has been successfully registered.',
		'update' => 'The user has been successfully edited.',
		'destroy' => 'The user has been successfully deleted.',
		'deactivate' => 'The user has been successfully deactivated.',
		'activate' => 'The user has been successfully activated.'
	],

	'customers' => [
		'store' => 'The customer has been successfully registered.',
		'update' => 'The customer has been successfully edited.',
		'destroy' => 'The customer has been successfully deleted.',
		'deactivate' => 'The customer has been successfully deactivated.',
		'activate' => 'The customer has been successfully activated.'
	],

	'categories' => [
		'store' => 'The category has been successfully registered.',
		'update' => 'The category has been successfully edited.',
		'destroy' => 'The category has been successfully deleted.',
		'deactivate' => 'The category has been successfully deactivated.',
		'activate' => 'The category has been successfully activated.'
	],

	'products' => [
		'store' => 'The product has been successfully registered.',
		'update' => 'The product has been edited successfully.',
		'destroy' => 'The product has been successfully deleted.',
		'deactivate' => 'The product has been successfully deactivated.',
		'activate' => 'The product has been successfully activated.',
		'assign' => 'The groups have been successfully assigned.'
	],

	'complements' => [
		'store' => 'The complement has been successfully registered.',
		'update' => 'The complement has been successfully edited.',
		'destroy' => 'The complement has been successfully deleted.',
		'deactivate' => 'The complement has been successfully deactivated.',
		'activate' => 'The complement has been successfully activated.'
	],

	'groups' => [
		'store' => 'The group has been successfully registered.',
		'update' => 'The group has been successfully edited.',
		'destroy' => 'The group has been successfully deleted.',
		'deactivate' => 'The group has been successfully deactivated.',
		'activate' => 'The group has been successfully activated.',
		'assign' => 'The complements have been assigned successfully.'
	],

	'orders' => [
		'reject' => 'The order has been successfully rejected.',
		'confirm' => 'The order has been successfully confirmed.'
	],

	'agencies' => [
		'store' => 'The agency has been successfully registered.',
		'update' => 'The agency has been successfully edited.',
		'destroy' => 'The agency has been successfully deleted.',
		'deactivate' => 'The agency has been successfully deactivated.',
		'activate' => 'The agency has been successfully activated.'
	],

	'attributes' => [
		'store' => 'The attribute has been successfully registered.',
		'update' => 'The attribute has been successfully edited.',
		'destroy' => 'The attribute has been successfully deleted.',
		'deactivate' => 'The attribute has been successfully deactivated.',
		'activate' => 'The attribute has been successfully activated.',
	],

	'currencies' => [
		'store' => 'The currency has been successfully registered.',
		'update' => 'The currency has been successfully edited.',
		'destroy' => 'The currency has been successfully deleted.',
		'deactivate' => 'The currency has been successfully deactivated.',
		'activate' => 'The currency has been successfully activated.'
	],

	'settings' => [
		'update' => 'The settings have been successfully edited.'
	]
];

?>