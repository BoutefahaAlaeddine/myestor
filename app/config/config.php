<?php
if (!defined('DS')) {
  define('DS', DIRECTORY_SEPARATOR);
}

define('APP_PATH', realpath(dirname(__FILE__) . DS . '..'));
define('VIEWS_PATH', APP_PATH . DS . "views");
define("MAIN_LINK",  str_replace(array(DS,  str_replace(DS, "/", realpath($_SERVER['DOCUMENT_ROOT']))), array("/", "http://localhost"), APP_PATH . DS . '..' . DS));
define("TEMPLATE_PATH", APP_PATH . DS . "template");
define('LANGUAGE_PATH', APP_PATH . DS . "languages" . DS);
define("Folder", "php%20MVC/myestor/");
define('MAIN_SRC', DS . Folder . "public/");

// Database Credentials
defined('DATABASE_HOST_NAME')       ? null : define('DATABASE_HOST_NAME', 'localhost');
defined('DATABASE_USER_NAME')       ? null : define('DATABASE_USER_NAME', 'root');
defined('DATABASE_PASSWORD')        ? null : define('DATABASE_PASSWORD', '');
defined('DATABASE_DB_NAME')         ? null : define('DATABASE_DB_NAME', 'storedb');
// defined('DATABASE_PORT_NUMBER')     ? null : define ('DATABASE_PORT_NUMBER', 3306);
// defined('DATABASE_CONN_DRIVER')     ? null : define ('DATABASE_CONN_DRIVER', 1);

//default application language
defined('APP_DEFAULT_LANGUAGE')         ? null : define('APP_DEFAULT_LANGUAGE', 'en');


//session configuration
defined('SESSION_NAME')         ? null : define('SESSION_NAME', 'PHPSESSID');
defined('SESSION_MAX_LIFE_TIME')         ? null : define('SESSION_MAX_LIFE_TIME', 0);
defined('SESSION_SAVE_PATH')         ? null : define('SESSION_SAVE_PATH', APP_PATH . DS . ".." . DS . "sessions");
defined('SESSION_SSL')         ? null : define('SESSION_SSL',False);
defined('SESSION_HTTP_ONLY')         ? null : define('SESSION_HTTP_ONLY',true);
defined('SESSION_DOMAIN')         ? null : define('SESSION_DOMAIN', "");
defined('SESSION_TTL')         ? null : define('SESSION_TTL', 30);
