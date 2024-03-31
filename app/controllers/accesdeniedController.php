<?php

namespace PHPMVC\Controllers;

class AccesdeniedController extends abstractController
{
  public function defaultAction()
  {
    $this->language->load("template.common");
    $this->language->load("accesdenied.default");
    $this->_view();
  }
}
