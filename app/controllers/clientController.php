<?php

namespace PHPMVC\Controllers;

use PHPMVC\models\ClientModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\Validate;

class ClientController extends abstractController
{
  //استعمال التريت
  use  InputFilter;
  use  Helper;
  use Validate;

  private $_addActionRoles =
  [
    "Name"  => 'req|alpha|between(3,10)',
    "PhoneNumber" => 'alphanum|min(10)',
    "Email" => 'req|email',
    "Address" => 'alpha|max(20)',
  ];
  private $_editActionRoles =
  [
    "Name"  => 'req|alpha|between(3,10)',
    "PhoneNumber" => 'alphanum|min(10)',
    "Email" => 'req|email',
    "Address" => 'alpha|max(20)',
  ];

  public function defaultAction()
  {
    $this->language->load("template.common");
    $this->language->load("client.default");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
    $this->_data["clients"] = ClientModel::getAll();
    $this->_view();
  }

  public function addAction()
  {
    $this->language->load("template.common");
    $this->language->load("client.default");    
    $this->language->load("client.labels");
    $this->language->load("validation.errors");
    $this->language->load("client.messages");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
  
    if (isset($_POST["submit"]) && $this->isValid($this->_addActionRoles, $_POST)) {
      $client = new ClientModel();

      $client->Name = $this->filterString($_POST["Name"]);
      $client->Email = $this->filterString($_POST["Email"]);
      $client->PhoneNumber = $this->filterString($_POST["PhoneNumber"]);
      $client->Address = $this->filterString($_POST["Address"]);

    //ارسل رسالة ترحيبة بلاميل

      if ($client->save()) {
        $this->messenger->add($this->language->get("message_add_success"));
      } else {
        $this->messenger->add($this->language->get("message_add_failed"), Messenger::APP_MESSAGE_ERROR);
      }
      $this->redirect("client");
    }
    $this->_view();
  }

  public function editAction()
  {
    $this->language->load("template.common");
    //عمل رفع لمفات صفحة الاديت
    $this->language->load("client.labels");
    $this->language->load("client.messages");
    $this->language->load("validation.errors");

    //edit
    if (!empty($this->_params)) {
      $ClientId = $this->filterInt($this->_params[0]);
      $client = ClientModel::getByPk($ClientId);


      $this->_data["client"] = $client;
    

      //update
      if (isset($_POST["submit"]) && $this->isValid($this->_editActionRoles, $_POST)) {
        $client = new ClientModel();

        $client->Name = $this->filterString($_POST["Name"]);
        $client->Email = $this->filterString($_POST["Email"]);
        $client->PhoneNumber = $this->filterString($_POST["PhoneNumber"]);
        $client->Address = $this->filterString($_POST["Address"]);
          //لتاكيد انها تحديث
        $client->ClientId =  $ClientId;
        if ($client->save()) {
          $this->messenger->add($this->language->get("message_add_success"));
          $this->redirect("client");
        } else {
          $this->messenger->add($this->language->get("message_add_failed"), Messenger::APP_MESSAGE_ERROR);
        }
      }
      $this->_view();
  }
  }



  public function deleteAction()
  {
    $this->language->load("client.messages");

    $ClientId = $this->filterInt($this->_params[0]);
    $client = ClientModel::getByPk($ClientId);
    if ($client == false) {
      $this->redirect("client");
    }

    if ($client->delete()) {
      $this->messenger->add($this->language->get("message_delete_success"));
      $this->redirect("client");
    }
  }
}
