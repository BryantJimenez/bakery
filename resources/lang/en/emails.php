<?php

return [
	'register' => [
		'subject' => 'New User',
		'greeting' => 'Hello :name :lastname, welcome to :app, you have successfully registered.'
	],

	'reset' => [
		'subject' => 'Recover Password',
		'greeting' => 'Hello! :name',
		'text' => 'You are receiving this email because a password reset has been requested for your account.',
		'call to action' => 'Recover',
		'expire' => 'This link to recover password will expire in 30 minutes.',
		'advise' => 'If you did not make this request, you can ignore this email and nothing will have changed.'
	],

	'contact' => [
		'subject' => 'Contact Message',
		'greeting' => 'Hello, you receive this message from the web page form:',
		'name' => 'Name',
		'email' => 'Email',
		'case' => 'Subject',
		'message' => 'Message'
	],

	'salutation' => 'Greetings, :name'
]

?>