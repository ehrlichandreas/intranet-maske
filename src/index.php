<?php 

if (isset($_SERVER['REQUEST_TIME_FLOAT']))
{
    $microtime = $_SERVER['REQUEST_TIME_FLOAT'];
}
else
{
    $microtime = microtime(true);
}


include_once dirname(__FILE__) . '/bootstrap.php';

$mvc = EhrlichAndreas_Mvc_FrontController::getInstance();

echo $mvc->dispatch();

echo microtime(true)-$microtime;
