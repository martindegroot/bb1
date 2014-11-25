<?php
// set the variable $development to the value true when in development mode
// set the variable $development to the value false when in production mode

if (dirname(__FILE__) == "C:\wamp\www\bb1") {
    $development = true;    
}
else {
    $development = false;
}


// change the following paths if necessary
// original
if ($development) {
    $yii='M:\Martin\Documenten\Yii\yii.php';
}
else {
  // version for production that is, deployment on www.budgetbeheer.martiendegroot.eu
  $yii=dirname(__FILE__).'/../framework/yii.php';    
}

if ($development)  {
      $config=dirname(__FILE__).'/protected/config/main_development.php';        
}
else {
    $config=dirname(__FILE__).'/protected/config/main_production.php';    
}
function d2l($what, $where='def.defaultlogdir') {
    $what = print_r($what, true);
    Yii::log($what, 'info', 'application.'.$where);
}


// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
// Yii::createWebApplication($config)->run();
$app = Yii::createWebApplication($config);

// adding Zend Framework autoloader
//$result = Yii::import('application.vendors.*');

//require_once('Zend/Loader/Autoloader.php');
//require_once( 'protected/vendors/Zend/Loader/Autoloader.php');
//Yii::registerAutoloader(array('Zend_Loader_Autoloader','autoload'), true);

$app->run();