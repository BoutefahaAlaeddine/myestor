<?php

namespace PHPMVC\Controllers;

use PHPMVC\models\SupplierModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\Validate;

class SupplierController extends abstractController
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
    $this->language->load("supplier.default");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
    $this->_data["suppliers"] = SupplierModel::getAll();
    $this->_view();
  }

  public function addAction()
  {
    $this->language->load("template.common");
    $this->language->load("supplier.default");    
    $this->language->load("supplier.labels");
    $this->language->load("validation.errors");
    $this->language->load("supplier.messages");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
  
    if (isset($_POST["submit"]) && $this->isValid($this->_addActionRoles, $_POST)) {
      $Supplier = new SupplierModel();

      $Supplier->Name = $this->filterString($_POST["Name"]);
      $Supplier->Email = $this->filterString($_POST["Email"]);
      $Supplier->PhoneNumber = $this->filterString($_POST["PhoneNumber"]);
      $Supplier->Address = $this->filterString($_POST["Address"]);

    //ارسل رسالة ترحيبة بلاميل

      if ($Supplier->save()) {
        $this->messenger->add($this->language->get("message_add_success"));
      } else {
        $this->messenger->add($this->language->get("message_add_failed"), Messenger::APP_MESSAGE_ERROR);
      }
      $this->redirect("supplier");
    }
    $this->_view();
  }

  public function editAction()
  {
    $this->language->load("template.common");
    //عمل رفع لمفات صفحة الاديت
    $this->language->load("supplier.labels");
    $this->language->load("supplier.messages");
    $this->language->load("validation.errors");

    //edit
    if (!empty($this->_params)) {
      $SupplierId = $this->filterInt($this->_params[0]);
      $Supplier = SupplierModel::getByPk($SupplierId);


      $this->_data["supplier"] = $Supplier;
    

      //update
      if (isset($_POST["submit"]) && $this->isValid($this->_editActionRoles, $_POST)) {
        $Supplier = new SupplierModel();

        $Supplier->Name = $this->filterString($_POST["Name"]);
        $Supplier->Email = $this->filterString($_POST["Email"]);
        $Supplier->PhoneNumber = $this->filterString($_POST["PhoneNumber"]);
        $Supplier->Address = $this->filterString($_POST["Address"]);
          //لتاكيد انها تحديث
        $Supplier->SupplierId =  $SupplierId;
        if ($Supplier->save()) {
          $this->messenger->add($this->language->get("message_add_success"));
          $this->redirect("supplier");
        } else {
          $this->messenger->add($this->language->get("message_add_failed"), Messenger::APP_MESSAGE_ERROR);
        }
      }
      $this->_view();
  }
  }



  public function deleteAction()
  {
    $this->language->load("supplier.messages");

    $SupplierId = $this->filterInt($this->_params[0]);
    $SupplierModel = SupplierModel::getByPk($SupplierId);
    if ($SupplierModel == false) {
      $this->redirect("supplier");
    }

    if ($SupplierModel->delete()) {
      $this->messenger->add($this->language->get("message_delete_success"));
      $this->redirect("supplier");
    }
  }
}
