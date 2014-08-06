<?php

return (object) array(
	'db' => (object) array(
		'host' => 'localhost',
		'port' => '3306',
		'name' => '',
		'username' => '',
		'password' => '',
	),
	'mail' => (object) array(
		'main' => (object) array(
			'from' => (object) array(
				'email' => 'info@dobild.de',
				'name'  => 'doBild',
			),
			'replyto' => (object) array(
				'email' => 'info@dobild.de',
				'name'  => 'doBild',
			),
		),
		'contact'   => (object) array(
			'from' => (object) array(
				'email' => 'contact@dobild.de',
				'name'  => 'doBild',
			),
			'replyto' => (object) array(
				'email' => 'contact@dobild.de',
				'name'  => 'doBild',
			),
		),
		'transport' => (object) array(
			'smtp' => true,
			'host' => '',
			'port' => '',
			'auth' => '',
			'username' => '',
			'password' => '',
			'name' => '',
		),
	),
);