<?php

namespace PHPMVC\Controllers;

class IndexController extends abstractController
{
  public function defaultAction()
  {$this->_language->load("template.common");
    $this->_language->load("index.default");
    //استدعاء عناصر صفحة الفيو انديكس ديفولت
    $this->_view();
  }
}
