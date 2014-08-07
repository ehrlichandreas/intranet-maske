<?php

require_once dirname(__FILE__) . '/config_value.php';

$db = $value->db;
$mail = $value->mail;
$transport = $mail->transport;

$basePath = dirname(dirname(__FILE__));
$frontendViewPath = $basePath . '/modules/frontend/view';

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
        'default'    => array
        (
            'route'     => '.*',
            'defaults'  => array
            (
                'module'        => 'default',
                'submodule'     => 'default',
                'controller'    => 'index',
                'action'        => 'index',
            ),
            'map'       => array(),
            'reverse'   => '',
            'callbacks' => array(),
        ),
        'frontend-main-intranet-export'    => array
        (
            'route'     => 'export',
            'defaults'  => array
            (
                'module'        => 'frontend',
                'submodule'     => 'main',
                'controller'    => 'intranet',
                'action'        => 'export',
            ),
            'map'       => array(),
            'reverse'   => 'export',
            'callbacks' => array(),
        ),
        'frontend-main-intranet-registration'    => array
        (
            'route'     => 'registration',
            'defaults'  => array
            (
                'module'        => 'frontend',
                'submodule'     => 'main',
                'controller'    => 'intranet',
                'action'        => 'registration',
            ),
            'map'       => array(),
            'reverse'   => 'registration',
            'callbacks' => array(),
        ),
        'frontend-main-intranet-list'    => array
        (
            'route'     => 'page\/?|page\/(\d+)',
            'defaults'  => array
            (
                'module'        => 'frontend',
                'submodule'     => 'main',
                'controller'    => 'intranet',
                'action'        => 'view',
                'page'          => '1',
            ),
            'map'       => array
            (
				'page'  => 1,
            ),
            'reverse'   => 'page/%1$s',
            'callbacks' => array(),
        ),
        'frontend-main-intranet-view'    => array
        (
            'route'     => 'view\/?|view\/(\d+)',
            'defaults'  => array
            (
                'module'        => 'frontend',
                'submodule'     => 'main',
                'controller'    => 'intranet',
                'action'        => 'view',
                'id'            => '-1',
            ),
            'map'       => array
            (
				'id'    => 1,
            ),
            'reverse'   => 'view/%1$s',
            'callbacks' => array(),
        ),
    ),
    
    'view'      => array
    (
        'scriptPath'    => $basePath . '/modules/default/view',
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
                'layoutPath'    => $basePath . '/modules/default/view',
                'scriptPath'    => $basePath . '/modules/default/view',
                'fileExtension' => 'phtml',
            ),
        ),
        'frontend'   => array
        (
            'view'  => array
            (
                'layoutPath'    => $frontendViewPath,
                'scriptPath'    => $frontendViewPath,
                'fileExtension' => 'phtml',
            ),
            'submodules'    => array
            (
				'main' => array
				(
					'view'  => array
					(
						'layoutPath'    => $frontendViewPath,
						'scriptPath'    => $basePath . '/modules/frontend/main/view',
						'fileExtension' => 'phtml',
					),
				),
            ),
        ),
    ),
);

return $config;