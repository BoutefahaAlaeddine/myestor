<?php

namespace PHPMVC\LIB;

use PHPMVC\LIB\Registry;

//استقبال الريكويست 
//تحديد action(الميتود),$controller("الكلاس"),params(هوما ?id=54&?cat=ff)
class FrontController
{
  use Helper;

  const NOT_FOUND_ACTION = "notFoundAction";
  const NOT_FOUND_CONTROLLER = "PHPMVC\Controllers\\NotFoundController";

  private $_controller = "index";
  private $_action = "default";
  private $_prams = array();

  private $_template;
  private $_registry;
  private $_authentication;

  public function __construct(Template $template, Registry $registry, Authentication $authentication)
  {
    $this->_parseUrl();
    $this->_template = $template;
    $this->_registry = $registry;
    $this->_authentication = $authentication;
  }

  //فصل الراوبط

  private function _parseUrl()
  {
    //فصل عنصار الرابط وازالة السلاش التي في البدايةاو النهاية
    $url = str_replace('/' . Folder, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
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
  {    //هذي تستدي الميتود والكلاس على حسب الرابط
    $controllerClassName = "PHPMVC\\Controllers\\" . ucfirst($this->_controller) . "Controller";
    $actionName = $this->_action . "Action";
    //التحقق من صلاحية دخول المستخدم ل
    if (!$this->_authentication->isAuthorized()) {
      $controllerClassName = "PHPMVC\\Controllers\AuthController";
      // اذا ليس له الحق في الدخول فيدخليني لصفحة التسحيل
      if ($this->_controller != "auth" && $this->_action != "login") {
        $this->redirect("auth/login");
      }
    } else {
      if ($this->_controller == "auth" || $this->_action == "login") {
        isset($_SERVER["HTTP_REFERER"]) ? "" : $this->redirect("");
      }
      //التحقق من صلاحية المستخدم
      // if (!$this->_authentication->hasAccess($this->_controller, $this->_action)) {

      //   if (class_exists($controllerClassName) || method_exists($controllerClassName, $actionName)) {
      //     $this->redirect("accesdenied");
      //   }
      // }
    }

    if (!class_exists($controllerClassName) || !method_exists($controllerClassName, $actionName)) {
      $controllerClassName = self::NOT_FOUND_CONTROLLER;
      $this->_action = $actionName = self::NOT_FOUND_ACTION;
    }
    //طبع اسم الكلاس انطلاقا من الرابط
    // echo $controllerClassName;

    //انشاء كائن
    $controller = new $controllerClassName();
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
