<?php
namespace PHPMVC\Controllers;
use PHPMVC\models\UserGroupsModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;

class UserGroupsController extends abstractController
{use  InputFilter;
  use  Helper;

  public function defaultAction()
  {$this->_language->load("template.common");
    $this->_language->load("usergroups.default");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
     $this->_data["groups"] = UserGroupsModel::getAll();
    $this->_view();
  }

  
  public function addAction()
  {
    //عمل رفع لمفات صفحة الادد
    $this->_language->load("template.common");
    $this->_language->load("usergroups.labels");

    if (isset($_POST["submit"])) {
      $GroupName = $this->filterString($_POST["GroupName"]);
      $UserGroups = new UserGroupsModel($GroupName);
      if ($UserGroups->save()) {
        $_SESSION["message"] = "Group, Save Successfully";
        $this->redirect("usergroups");
      }
      // print_r($emp);
    }
    $this->_view();
  }

  public function editAction()
  {
    $this->_language->load("template.common");
    //عمل رفع لمفات صفحة الاديت
    $this->_language->load("usergroups.labels");

    //edit
    if (!empty($this->_params)) {
      $GroupId = $this->filterInt($this->_params[0]);
      $UserGroup = UserGroupsModel::getByPk($GroupId);
      if ($UserGroup == false) {
        $this->redirect("usergroups");
      }

      $this->_data["group"] = $UserGroup;


      //update
      if (isset($_POST["submit"])) {
        $GroupName = $this->filterString($_POST["GroupName"]);
        $UserGroup = new UserGroupsModel($GroupName);
        //لتاكيد انها تحديث
        $UserGroup->GroupId =  $GroupId;
        if ($UserGroup->save()) {
          $_SESSION["message"] = "group, Save Successfully";
          $this->redirect("usergroups");
        }
      }
      $this->_view();
    }
  }

  public function deleteAction()
  {

    $GroupId = $this->filterInt($this->_params[0]);
    $UserGroup = UserGroupsModel::getByPk($GroupId);
    if ($UserGroup == false) {
      $this->redirect("usergroups");
    }

    if ($UserGroup->delete()) {
      $_SESSION["message"] = "group, delete successfully";
      $this->redirect("usergroups");
    }
  }

}
