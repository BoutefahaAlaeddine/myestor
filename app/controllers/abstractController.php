<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\FrontController;
//انشاء هذا الكلاس لكي ارثه في كل كلاس كنترولور دون انشاء الدالة كل مرة
class abstractController
{

  protected $_controller;
  protected $_action;
  protected $_params;
  protected $_data = [];
  protected $_template;
  protected $_language;
  protected $_registry;

  //التحكم في جميع الكائنات التي داخل الريجستري (لاحظ اننا وضعناها في ابستراكت كنترولر الذي يرث منه جميع الكنترولور)
  public function __get($key)
  {
    return $this->_registry->$key;
  }

  public function notFoundAction()
  {
    $this->_language->load("template.common");
    $this->_language->load("notfound.notfound");
    $this->_view();
  }

  public function setController($controllerName)
  {
    $this->_controller = $controllerName;
  }

  public function setAction($actionName)
  {
    $this->_action = $actionName;
  }

  public function setParams($params)
  {
    $this->_params = $params;
  }

  public function setTemplate($template)
  {
    $this->_template = $template;
  }

  public function setRegistry($registry)
  {
    $this->_registry = $registry;
  }

  //الاستداء الرابط الفيوس
  //استدعاء ملفات الفيوس
  protected function _view()
  {
    $view = VIEWS_PATH . DS . $this->_controller . DS . $this->_action . ".view.php";
    if ($this->_action == FrontController::NOT_FOUND_ACTION || !file_exists($view)) {
      $view = VIEWS_PATH . DS . "notfuond" . DS . "notfound.view.php";
    }

    //اضافة الداتا لي جاينها من ملف اللغات الى ملف الداتا لي جايبنها من داتا بيس  
    $this->_data = array_merge($this->_data, $this->language->getDictionary());
    // var_dump($this->_data);


    //عمل سيت لمسار الفيو في كلاس التمليت
    $this->_template->setActionViewFile($view);

    //عمل سيت لداتا لي جايبها من قاعدة البيانات
    $this->_template->setAppData($this->_data);

    //لتحكم بالريجستور داخل الفيو
    $this->_template->setRegistry($this->_registry);

    //اوبجيكت التيمبليت
    // var_dump($this->_template);

    //جلب كل التملبيت
    $this->_template->renderApp();

    // echo $view;
  }
}
