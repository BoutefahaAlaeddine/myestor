<?php

namespace PHPMVC\Controllers;

use PHPMVC\models\UserGroupsModel;
use PHPMVC\models\UserModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\Messenger;
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
    "Password"  => 'req|min(6)|eqField(CPassword)',
    'CPassword' => 'req|min(6)',
    "Email"     => 'req|email',
    "CEmail"     => 'req|email',
    "phoneNumber" => 'alphanum|max(10)',
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
    $this->language->load("user.messages");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
    $this->_data["groups"] = UserGroupsModel::getAll();
    if (isset($_POST["submit"]) && $this->isValid($this->_addActionRoles, $_POST)) {
      $username = $this->filterString($_POST["Username"]);
      $password= UserModel::cryptPassword($_POST["Password"]);
      $email=$this->filterString($_POST["Email"]);
      $phoneNumber=$this->filterString($_POST["phoneNumber"]);
      $groupId=$this->filterInt($_POST["GroupId"]);
      $SubscriptionData=date("Y-m-d");
      $LastLogin=date("Y-m-d H:i:s");
      $Status=1;
       $user=new UserModel( $username,$password,$email,$phoneNumber,$SubscriptionData,$LastLogin,$groupId,$Status);
       if ($user->save()) {
        $this->messenger->add($this->language->get("message_add_success"));
       }else{
        $this->messenger->add($this->language->get("message_add_failed"),Messenger::APP_MESSAGE_ERROR);
       }
       $this->redirect("user");

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
