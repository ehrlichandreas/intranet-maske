<?php

require_once dirname(__FILE__) . '/config_value.php';

$db = $value->db;
$mail = $value->mail;
$transport = $mail->transport;

$basePath = dirname(dirname(__FILE__));
$frontendViewPath = $basePath . '/controllers/Frontend/view';

$config = array
(
    'db'        => array
    (
        'default'   => array
        (
            'driver'            => 'Pdo',
            'dsn'               => 'mysql:dbname='.$db->name.';host='.$db->host.';port='.$db->port.'',
            'username'          => $db->username,
            'password'          => $db->password,
            'charset'           => 'utf8',
            'driver_options'    => array
            (
                PDO::ATTR_EMULATE_PREPARES          => 1,
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY  => 1,
                PDO::MYSQL_ATTR_INIT_COMMAND      => 'SET NAMES \'UTF8\';SET SQL_BIG_SELECTS = 1;SET SQL_MAX_JOIN_SIZE = 18446744073709551615;',
            ),
        ),
    ),
    'router'    => array
    (
//        'default'    => array
//        (
//            'route'     => '.*',
//            'defaults'  => array
//            (
//                'module'        => 'default',
//                'submodule'     => 'default',
//                'controller'    => 'index',
//                'action'        => 'index',
//            ),
//            'map'       => array(),
//            'reverse'   => '',
//            'callbacks' => array(),
//        ),
        'frontend-main-static-faq'    => array
        (
            'route'     => 'faq',
            'defaults'  => array
            (
                'module'        => 'Frontend',
                'submodule'     => 'Main',
                'controller'    => 'Static',
                'action'        => 'faq',
            ),
            'map'       => array(),
            'reverse'   => 'faq',
            'callbacks' => array(),
        ),
        'frontend-main-static-imprint'    => array
        (
            'route'     => 'imprint',
            'defaults'  => array
            (
                'module'        => 'Frontend',
                'submodule'     => 'Main',
                'controller'    => 'Static',
                'action'        => 'imprint',
            ),
            'map'       => array(),
            'reverse'   => 'imprint',
            'callbacks' => array(),
        ),
		'frontend-user-register-emailconfirm'    => array
		(
			'route'     => 'confirm',
			'defaults'  => array
			(
				'module'        => 'Frontend',
				'submodule'     => 'User',
				'controller'    => 'Register',
				'action'        => 'emailconfirm',
			),
			'map'       => array(),
			'reverse'   => 'confirm',
			'callbacks' => array(),
		),
		'frontend-user-register-registration'    => array
		(
			'route'     => 'registration',
			'defaults'  => array
			(
				'module'        => 'Frontend',
				'submodule'     => 'User',
				'controller'    => 'Register',
				'action'        => 'registration',
			),
			'map'       => array(),
			'reverse'   => 'registration',
			'callbacks' => array(),
		),
    ),
    
    'view'      => array
    (
        'scriptPath'    => $basePath . '/views',
        'fileExtension' => 'phtml',
    ),
    
    'mail'      => array
    (
        array
        (
            'name'  => 'default',
            'mail'  => array
            (
                'encoding'  => 'base64',
                'from'      => array
                (
                    'email' => $mail->main->from->email,
                    'name'  => $mail->main->from->name,
                ),
                'replyto'   => array
                (
					'email' => $mail->main->replyto->email,
					'name'  => $mail->main->replyto->name,
                ),
                'to'        => array
                (
                    'email' => '%(email)%',
                    'name'  => '%(name)%'
                ),
                'cc'        => array(),
                'bcc'       => array(),
                'header'    => array(),
                'subject'   => '%(subject)%',
                'body'      => array
                (
                    'html'  => '%bodyhtml%',
                    'text'  => '%bodytext%',
                ),
                'transport' => array
                (
                    'smtp'      => $transport->smtp,
                    'host'      => $transport->host,
                    'port'      => $transport->port,
                    'auth'      => $transport->auth,
                    'username'  => $transport->username,
                    'password'  => $transport->password,
                    'name'      => $transport->name,
                ),
                'attachment'    => false,
                'eol'           => "\r\n",
                'zfversion'     => 1,
            ),
        ),
        array
        (
            'name'  => 'contactform',
            'mail'  => array
            (
                'encoding'  => 'base64',
				'from'      => array
				(
					'email' => $mail->contact->from->email,
					'name'  => $mail->contact->from->name,
				),
				'replyto'   => array
				(
					'email' => $mail->contact->replyto->email,
					'name'  => $mail->contact->replyto->name,
				),
                'to'        => array
                (
                    'email' => '%(email)%',
                    'name'  => '%(name)%'
                ),
                'cc'        => array(),
                'bcc'       => array(),
                'header'    => array(),
                'subject'   => '%(subject)%',
                'body'      => array
                (
                    'html'  => '%bodyhtml%',
                    'text'  => '%bodytext%',
                ),
				'transport' => array
				(
					'smtp'      => $transport->smtp,
					'host'      => $transport->host,
					'port'      => $transport->port,
					'auth'      => $transport->auth,
					'username'  => $transport->username,
					'password'  => $transport->password,
					'name'      => $transport->name,
				),
                'attachment'    => false,
                'eol'           => "\r\n",
                'zfversion'     => 1,
            ),
        ),
    ),
    
    'modules'   => array
    (
        'default'   => array
        (
            'view'  => array
            (
                'layoutPath'    => $basePath . '/controllers/default/view',
                'scriptPath'    => $basePath . '/controllers/default/view',
                'fileExtension' => 'phtml',
            ),
        ),
    ),
);

return $config;