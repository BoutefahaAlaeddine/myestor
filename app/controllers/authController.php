<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\Helper;
use PHPMVC\LIB\Messenger;
use PHPMVC\models\UserModel;

class AuthController extends abstractController
{
  use Helper;
  public function loginAction()
  {
    // $this->language->load("template.common");
    $this->language->load("auth.login");
    $this->language->load("auth.messages");
    $this->_template->swapTemplate(
      [
        ':view' => ':action_view'
      ]
    );
    if (isset($_POST["login"])) {
      $isAuthorized =  UserModel::authenticate($_POST["user"], $_POST["pass"], $this->session);
      if ($isAuthorized == 2) {
        $this->messenger->add($this->language->get("text_user_disabled"), Messenger::APP_MESSAGE_ERROR);
      } elseif ($isAuthorized == 1) {
        $this->redirect("");

      }elseif($isAuthorized==3){
        $this->messenger->add($this->language->get("text_user_not_found"), Messenger::APP_MESSAGE_ERROR);
      }
    }
    $this->_view();
  }
  public function logoutAction(){
    $this->session->Kill();
    $this->redirect("auth/login");
  }
}
