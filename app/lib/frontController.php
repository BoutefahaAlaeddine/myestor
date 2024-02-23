<?php

namespace PHPMVC\LIB;

use PHPMVC\LIB\Registry;

//استقبال الريكويست 
//تحديد action(الميتود),$controller("الكلاس"),params(هوما ?id=54&?cat=ff)
class FrontController
{
  const NOT_FOUND_ACTION = "notFoundAction";
  const NOT_FOUND_CONTROLLER = "PHPMVC\Controllers\\NotFoundController";

  private $_controller = "index";
  private $_action = "default";
  private $_prams = array();
  private $_template;
  private $_registry;

  public function __construct(Template $template,Registry $registry)
  {
    $this->_parseUrl();
    $this->_template=$template;
    $this->_registry=$registry;
  }

  //فصل الراوبط

  private function _parseUrl()
  {
    //فصل عنصار الرابط وازالة السلاش التي في البدايةاو النهاية
    $url = str_replace('/'.Folder, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $url = explode("/", trim($url, '/'), 3);
    if (isset($url[0]) && $url[0] != '') {
      $this->_controller = $url[0];
    }
    if (isset($url[1]) && $url[1] != '') {
      $this->_action = $url[1];
    }
    if (isset($url[2]) && $url[2] != '') {
      $this->_prams = explode('/', $url[2]);
    }
    //طباعة الخصائص الرابط
    // print_r($this);

  }
//هذه الدالة تبعث الروابط لل abstract
  public function dispatch()
  {
    //هذي تستدي الميتود والكلاس على حسب الرابط

    $controllerClassName = "PHPMVC\\Controllers\\" . ucfirst($this->_controller) . "Controller";
    $actionName = $this->_action . "Action";

    //  echo $controllerClassName;

    if (!class_exists($controllerClassName)) {
      $controllerClassName = self::NOT_FOUND_CONTROLLER;
    }
    //طبع اسم الكلاس انطلاقا من الرابط
    // echo $controllerClassName;

    //انشاء كائن
    $controller = new $controllerClassName();
    // echo $controllerClassName ."->" .$actionName;

    if (!method_exists($controller, $actionName)) {
      $this->_action = $actionName = self::NOT_FOUND_ACTION;
    }
    // echo $controllerClassName ."->" .$actionName;

    //نحتاجوهم باه نستدعو الفيو على حساب وش كتبنا
    $controller->setController($this->_controller);
    $controller->setAction($this->_action);
    $controller->setParams($this->_prams);

    //هذا الاوبجيت نتاع التمبليت لي حقنتو
    //نزيد نحقنو في الابستراكت
    $controller->setTemplate($this->_template);

    //هذا الاوبجيت نتاع الريجستري لي حقنتو
    $controller->setRegistry($this->_registry);

    //استدعاء الدالة
    $controller->$actionName();
    //  var_dump($controller);




  }
}
