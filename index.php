<?php
//لربط الكلاسات مع كلاسات الكنترولر
namespace PHPMVC;
use PHPMVC\LIB\Registry;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\FrontController;
use PHPMVC\LIB\Template;
use PHPMVC\LIB\Language;
use PHPMVC\LIB\AppSessionHandler;

define('DS', DIRECTORY_SEPARATOR);


require_once "app" . DS . "config" . DS . "config.php";
require_once APP_PATH . DS . "lib" . DS . "autoload.php";
//يرجعلي مسارات التمليت
$template_pars = require_once "app" . DS . "config" . DS . "templateconfig.php";



//  require_once 'F:\1a\alilo\wep\php\htdocs\php MVC\mvcApp\app\LIB\FrontController.php';
// session_start();


$session = new AppSessionHandler();
$session->start();

$session->isValidFingerPrint();
if (!$session->isValidFingerPrint()) {
  $session->kill();
}

if (!isset($session->lang)) {
$session->lang = APP_DEFAULT_LANGUAGE;
}

//استدعاء ملف الكائن هنا وحقنه في فرونت كونترولور بدلا من استدعاءه داخل الابستراكت كونترولور 
//inject dependency
//تدخل المسارات الى كلاس التيمبليت
$template = new Template($template_pars);


$language = new Language($template_pars);

$messenger=Messenger::geInstance($session);

//اي كائن يحتاجو جميع الكنترولولز نتاوعي حطو في الريجيستري
$registry=Registry::geInstance();
$registry->session=$session;
$registry->language=$language;
$registry->messenger=$messenger;

$frontController = new FrontController($template, $registry);


$frontController->dispatch();
