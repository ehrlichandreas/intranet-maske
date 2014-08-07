<?php

ini_set('display_startup_errors', true);

ini_set('display_errors', true);

ini_set('error_reporting', -1);

error_reporting(-1);

date_default_timezone_set('UTC');

ini_set('log_errors', 1);

ini_set('error_log', dirname(__FILE__) . '/_errorlog/' . date('Y-m-d') . '.php.log');

if (! file_exists(dirname(__FILE__) . '/_errorlog/') || ! is_dir(dirname(__FILE__) . '/_errorlog/'))
{
    mkdir(dirname(__FILE__) . '/_errorlog/', 0777, true);
}

define('APPLICATIONBASEDIR', dirname(__FILE__));

//load autoloader from projects-libraries-composer-summary
$autolodFile1 = dirname(dirname(dirname(__FILE__))) . '/projects-libraries-composer-summary/vendor/autoload_52.php';

if(file_exists($autolodFile1) && is_readable($autolodFile1))
{
    require_once $autolodFile1;
}

//load autoloader from vendor
$autolodFile2 = dirname(dirname(__FILE__)) . '/vendor/autoload_52.php';

if(file_exists($autolodFile2) && is_readable($autolodFile2))
{
    require_once $autolodFile2;
}

require_once dirname(__FILE__) . '/modules/include.php';

$config = include dirname(__FILE__) . '/config/config.php';

EhrlichAndreas_Mvc_Registry::set('config', $config);

#$dbConfig = $config['db']['default'];

#$dbConnection = EhrlichAndreas_Db_Db::factory($dbConfig);

#EhrlichAndreas_Mvc_Registry::set('dbconnection', $dbConnection);

$mvc = EhrlichAndreas_Mvc_FrontController::getInstance();

$mvc->addRouterConfig($config, 'router');

$mvc->addViewConfig($config, 'view');

