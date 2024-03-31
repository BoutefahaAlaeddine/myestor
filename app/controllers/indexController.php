<?php

namespace PHPMVC\Controllers;

use PHPMVC\models\UserGroupPrivilegeModel;

class IndexController extends abstractController
{
  public function defaultAction()
  {$this->language->load("template.common");
    $this->language->load("index.default");
    //استدعاء عناصر صفحة الفيو انديكس ديفولت
    $this->_view();
  }
}
