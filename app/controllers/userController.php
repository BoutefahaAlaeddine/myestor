<?php

namespace PHPMVC\Controllers;

use PHPMVC\models\UserGroupsModel;
use PHPMVC\models\UserProfileModel;
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
    "FirstName"  => 'req|alpha|between(3,10)',
    "LastName"  => 'req|alpha|between(3,10)',
    "Username"  => 'req|alphanum|between(3,12)',
    "Password"  => 'req|min(6)|eqField(CPassword)',
    'CPassword' => 'req|min(6)',
    "Email"     => 'req|email',
    "CEmail"     => 'req|email',
    "phoneNumber" => 'alphanum|max(10)',
    "GroupId" => 'req|int',
  ];
  private $_editActionRoles =
  [
    "phoneNumber" => 'alphanum|max(10)',
    "GroupId" => 'req|int',
  ];

  public function defaultAction()
  {
    $this->language->load("template.common");
    $this->language->load("user.default");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
    $this->_data["users"] = UserModel::getUsers($this->session->u);
    UserModel::getUsers($this->session->u);
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
      $password = UserModel::cryptPassword($_POST["Password"]);
      $email = $this->filterString($_POST["Email"]);
      $phoneNumber = $this->filterString($_POST["phoneNumber"]);
      $groupId = $this->filterInt($_POST["GroupId"]);
      $SubscriptionData = date("Y-m-d");
      $LastLogin = date("Y-m-d H:i:s");
      $Status = 1;
      $user = new UserModel($username, $password, $email, $phoneNumber, $SubscriptionData, $LastLogin, $groupId, $Status);
      if (UserModel::userExists($user->Username)) {
        $this->messenger->add($this->language->get("message_user_exists"), Messenger::APP_MESSAGE_ERROR);
        $this->redirect("user/add");
      }
      if (UserModel::EmailExists($user->Email)) {
        $this->messenger->add($this->language->get("message_email_exists"), Messenger::APP_MESSAGE_ERROR);
        $this->redirect("user/add");
      }

      //ارسل رسالة ترحيبة بلاميل

      if ($user->save()) {
        $userProfile = new UserProfileModel();
        $userProfile->UserId = $this->filterInt( $user->UserId);
        $userProfile->FirstName = $this->filterString($_POST["FirstName"]);
        $userProfile->LastName = $this->filterString($_POST["LastName"]);
        $userProfile->save(false);
        $this->messenger->add($this->language->get("message_add_success"));
      } else {
        $this->messenger->add($this->language->get("message_add_failed"), Messenger::APP_MESSAGE_ERROR);
      }
      $this->redirect("user");
    }
    $this->_view();
  }

  public function editAction()
  {
    $this->language->load("template.common");
    //عمل رفع لمفات صفحة الاديت
    $this->language->load("user.labels");
    $this->language->load("user.messages");
    $this->language->load("validation.errors");

    //edit
    if (!empty($this->_params)) {
      $UserId = $this->filterInt($this->_params[0]);
      $user = UserModel::getByPk($UserId);
      if ($user == false || $this->session->u->UserId== $UserId) {
        $this->redirect("user");
      }

      $this->_data["user"] = $user;
      $this->_data["groups"] = UserGroupsModel::getAll();


      //update
      if (isset($_POST["submit"]) && $this->isValid($this->_editActionRoles, $_POST)) {
        $phoneNumber = $this->filterString($_POST["phoneNumber"]);
        $GroupId = $this->filterString($_POST["GroupId"]);
        $UserModel = new UserModel($user->Username, $user->Password, $user->Email, $phoneNumber, $user->SubscriptionDate, date("Y-m-d H:i:s"),  $GroupId, 1);
        //لتاكيد انها تحديث
        $UserModel->UserId =  $UserId;
        if ($UserModel->save()) {
          $this->messenger->add($this->language->get("message_add_success"));
          $this->redirect("user");
        } else {
          $this->messenger->add($this->language->get("message_add_failed"), Messenger::APP_MESSAGE_ERROR);
        }
      }
      $this->_view();
    }
  }



  public function deleteAction()
  {
    $this->language->load("user.messages");

    $UserId = $this->filterInt($this->_params[0]);
    $UserModel = UserModel::getByPk($UserId);
    if ($UserModel == false || $this->session->u->UserId== $UserId) {
      $this->redirect("user");
    }

    if ($UserModel->delete()) {
      $this->messenger->add($this->language->get("message_delete_success"));
      $this->redirect("user");
    }
  }
}
