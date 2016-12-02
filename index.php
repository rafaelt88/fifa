<?php
switch ($_SERVER['SERVER_NAME']) {
    case 'localhost':
    case '127.0.0.1':
    case '190.39.245.128':
        defined('YII_DEBUG') or define('YII_DEBUG', true);
        defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
        require_once dirname(__FILE__) . '/../yii/yii.php';
        $config = dirname(__FILE__) . '/protected/config/local.php';
    break;
    default:
        error_reporting(0);
        date_default_timezone_set('America/Caracas');
        require_once dirname(__FILE__) . '/../../yii/yiilite.php';
        $config = dirname(__FILE__) . '/protected/config/main.php';
}
Yii::createWebApplication($config)->run();
