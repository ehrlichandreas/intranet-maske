<?php

return (object) array(
	'db' => (object) array(
		'host' => 'localhost',
		'port' => '3306',
		'name' => 'dobild',
		'username' => 'root',
		'password' => 'root',
	),
	'mail' => (object) array(
		'main' => (object) array(
			'from' => (object) array(
				'email' => 'main@dobild.de',
				'name'  => 'doBild',
			),
			'replyto' => (object) array(
				'email' => 'main@dobild.de',
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
			'host' => 'mail.dn21.de',
			'port' => '25',
			'auth' => 'login',
			'username' => 'webapp@epsservice.org',
			'password' => 'r1s94z45',
			'name' => 'mail.dn21.de',
		),
	),
);