<?php

if((getenv('APPLICATION_ENV') == 'production' )){
	$value = require dirname(__FILE__) . '/configValue/prod.php';
}
elseif((getenv('APPLICATION_ENV') == 'staging' )){
	$value = require dirname(__FILE__) . '/configValue/staging.php';
}
else {
	$value = require dirname(__FILE__) . '/configValue/dev.php';
}

return $value;