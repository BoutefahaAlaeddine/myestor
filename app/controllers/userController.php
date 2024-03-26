<?php

namespace PHPMVC\Controllers;

use PHPMVC\models\UserGroupsModel;
use PHPMVC\models\UserModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\Validate;

class UserController extends abstractController
{
  //استعمال التريت
  use  InputFilter;
  use  Helper;
  use Validate;

  private $_addActionRoles =
  [
    "Username"  => 'req|alphanum|between(3,12)',
    "Password"  => 'req|min(6)',
    'CPassword' => 'req|min(6)',
    "Email"     => 'req|email',
    "CEmail"     => 'req|email',
    "phoneNumber" => 'alphanum|max(15)',
    "GroupId" => 'req|int',
  ];

  public function defaultAction()
  {
    $this->language->load("template.common");
    $this->language->load("user.default");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
    $this->_data["users"] = UserModel::getAll();
    $this->_view();
  }

  public function addAction()
  {
    $this->language->load("template.common");
    $this->language->load("user.labels");
    $this->language->load("validation.errors");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
    $this->_data["groups"] = UserGroupsModel::getAll();
    if (isset($_POST["submit"])) {
      $this->isValid($this->_addActionRoles,$_POST);
    }
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
