<?php
namespace PHPMVC\Controllers;


class NotFoundController extends abstractController{
  public function notFoundAction()
  {$this->_language->load("template.common");
    $this->_language->load("notfound.notfound");
    $this->_view();
  }

}