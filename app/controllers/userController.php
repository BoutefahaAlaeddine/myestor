<?php

namespace PHPMVC\Controllers;
use PHPMVC\models\UserModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;

class UserController extends abstractController
{
  //استعمال التريت
  use  InputFilter;
  use  Helper;

  public function defaultAction()
  {$this->language->load("template.common");
    $this->language->load("user.default");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
    $this->_data["users"] = UserModel::getAll();
    $this->_view();
  }


  public function deleteAction()
  {
    $UserId = $this->filterInt($this->_params[0]);
    $UserModel = UserModel::getByPk($UserId);
    if ($UserModel == false) {
      $this->redirect("user");
    }

    if ($UserModel->delete()) {
      $_SESSION["message"] = "user delete successfully";
      $this->redirect("user");
    }
  }

}
