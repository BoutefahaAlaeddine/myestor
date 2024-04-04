<?php

namespace PHPMVC\Controllers;

use PHPMVC\LIB\FileUpload;
use PHPMVC\models\ProductCategoryModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\Validate;

class ProductCategoryController extends abstractController
{
  //استعمال التريت
  use  InputFilter;
  use  Helper;
  use Validate;

  private $_addActionRoles =
  [
    "Name"  => 'req|alpha|between(3,10)',
    "Image" => 'alphanum|max(30)',
  ];
  private $_editActionRoles =
  [
    "Name"  => 'req|alpha|between(3,10)',
    "Image" => 'alphanum|max(30)',
  ];

  public function defaultAction()
  {
    $this->language->load("template.common");
    $this->language->load("productcategory.default");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
    $this->_data["Categories"] = ProductCategoryModel::getAll();
    $this->_view();
  }

  public function addAction()
  {
    $this->language->load("template.common");
    $this->language->load("productcategory.default");    
    $this->language->load("productcategory.labels");
    $this->language->load("validation.errors");
    $this->language->load("productcategory.messages");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
  
    if (isset($_POST["submit"])) {
      $Category = new ProductCategoryModel();

      $Category->Name = $this->filterString($_POST["Name"]);
      $Category->Image = (new FileUpload($_FILES["image"]))->upload()->getFileName();

    //ارسل رسالة ترحيبة بلاميل

      if ($Category->save()) {
        $this->messenger->add($this->language->get("message_add_success"));
      } else {
        $this->messenger->add($this->language->get("message_add_failed"), Messenger::APP_MESSAGE_ERROR);
      }
      $this->redirect("productCategory");
    }
    $this->_view();
  }

  public function editAction()
  {
    $this->language->load("template.common");
    //عمل رفع لمفات صفحة الاديت
    $this->language->load("productcategory.labels");
    $this->language->load("productcategory.messages");
    $this->language->load("validation.errors");

    //edit
    if (!empty($this->_params)) {
      $CategoryId = $this->filterInt($this->_params[0]);
      $Category = ProductCategoryModel::getByPk($CategoryId);


      $this->_data["Category"] = $Category;
    

      //update
      if (isset($_POST["submit"]) && $this->isValid($this->_editActionRoles, $_POST)) {
        $Category = new ProductCategoryModel();

        $Category->Name = $this->filterString($_POST["Name"]);
        $Category->Image = $this->filterString($_FILES["Image"]);
          //لتاكيد انها تحديث
        $Category->CategoryId =  $CategoryId;
        if ($Category->save()) {
          $this->messenger->add($this->language->get("message_add_success"));
          $this->redirect("productCategory");
        } else {
          $this->messenger->add($this->language->get("message_add_failed"), Messenger::APP_MESSAGE_ERROR);
        }
      }
      $this->_view();
  }
  }



  public function deleteAction()
  {
    $this->language->load("productcategory.messages");

    $CategoryId = $this->filterInt($this->_params[0]);
    $Category = ProductCategoryModel::getByPk($CategoryId);
    if ($Category == false) {
      $this->redirect("productCategory");
    }

    if ($Category->delete()) {
      $this->messenger->add($this->language->get("message_delete_success"));
      $this->redirect("productCategory");
    }
  }
}
