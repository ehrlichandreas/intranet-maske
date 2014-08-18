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
				'email' => 'info@xxxxx.de',
				'name'  => 'xxxxx',
			),
			'replyto' => (object) array(
				'email' => 'info@xxxxx.de',
				'name'  => 'xxxxx',
			),
		),
		'contact'   => (object) array(
			'from' => (object) array(
				'email' => 'info@xxxxx.de',
				'name'  => 'xxxxx',
			),
			'replyto' => (object) array(
				'email' => 'info@xxxxx.de',
				'name'  => 'xxxxx',
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
