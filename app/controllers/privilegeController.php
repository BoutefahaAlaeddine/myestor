<?php
namespace PHPMVC\Controllers;
use PHPMVC\models\PrivilegeModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;

class PrivilegeController extends abstractController
{  //استعمال التريت
  use  InputFilter;
  use  Helper;

  public function defaultAction()
  {$this->_language->load("template.common");
    $this->_language->load("privilege.default");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
     $this->_data["privileges"] = PrivilegeModel::getAll();
    $this->_view();
  }

  public function addAction()
  {
    //عمل رفع لمفات صفحة الادد
    $this->_language->load("template.common");
    $this->_language->load("privilege.labels");

    if (isset($_POST["submit"])) {
      $privilege = $this->filterString($_POST["Privilege"]);
      $privilegeTitle = $this->filterString($_POST["PrivilegeTitle"]);
      $privilege = new PrivilegeModel($privilege, $privilegeTitle);
      if ($privilege->save()) {
        $_SESSION["message"] = "Privilege, Save Successfully";
        $this->redirect("privilege");
      }
      // print_r($emp);
    }
    $this->_view();
  }

  public function editAction()
  {
    $this->_language->load("template.common");
    //عمل رفع لمفات صفحة الاديت
    $this->_language->load("privilege.labels");

    //edit
    if (!empty($this->_params)) {
      $PrivilegeId = $this->filterInt($this->_params[0]);
      $privilege = PrivilegeModel::getByPk($PrivilegeId);
      if ($privilege == false) {
        $this->redirect("privilege");
      }

      $this->_data["privilege"] = $privilege;


      //update
      if (isset($_POST["submit"])) {
        $privilege = $this->filterString($_POST["Privilege"]);
        $privilegeTitle = $this->filterString($_POST["PrivilegeTitle"]);
        $privilege = new PrivilegeModel($privilege, $privilegeTitle);
        //لتاكيد انها تحديث
        $privilege->PrivilegeId =  $PrivilegeId;
        if ($privilege->save()) {
          $_SESSION["message"] = "Privilege, Save Successfully";
          $this->redirect("privilege");
        }
      }
      $this->_view();
    }
  }


  public function deleteAction()
  {

    $PrivilegeId = $this->filterInt($this->_params[0]);
    $privilege = PrivilegeModel::getByPk($PrivilegeId);
    if ($privilege == false) {
      $this->redirect("privilege");
    }

    if ($privilege->delete()) {
      $_SESSION["message"] = "privilege, delete successfully";
      $this->redirect("privilege");
    }
  }

}
