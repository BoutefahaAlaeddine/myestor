<?php

namespace PHPMVC\Controllers;

class IndexController extends abstractController
{
  public function defaultAction()
  {$this->language->load("template.common");
    $this->language->load("index.default");
    //استدعاء عناصر صفحة الفيو انديكس ديفولت
    $this->_view();
  }
}
