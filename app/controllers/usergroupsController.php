<?php

namespace PHPMVC\Controllers;

use PHPMVC\models\UserGroupsModel;
use PHPMVC\models\PrivilegeModel;
use PHPMVC\models\UserGroupPrivilegeModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;

class UserGroupsController extends abstractController
{
  use  InputFilter;
  use  Helper;

  public function defaultAction()
   {
//لاحض هنا اننا ممكن ان نتحكم بالسيشون
    // var_dump($this->session);


    $this->language->load("template.common");
    $this->language->load("usergroups.default");
    //تخزين الباينات في مصفوفة لاستدعئها في الفيو
    $this->_data["groups"] = UserGroupsModel::getAll();
    $this->_view();
  }


  public function addAction()
  {
    //عمل رفع لمفات صفحة الادد
    $this->language->load("template.common");
    $this->language->load("usergroups.labels");
    $this->_data["privileges"] = PrivilegeModel::getAll();
    if (isset($_POST["submit"])) {
      $GroupName = $this->filterString($_POST["GroupName"]);
      $UserGroups = new UserGroupsModel($GroupName);

      if ($UserGroups->save()) {

        if (isset($_POST["privileges"]) && is_array($_POST["privileges"])) {
          foreach ($_POST["privileges"] as $privilegeId) {
            $groupPrivilege = new UserGroupPrivilegeModel($UserGroups->GroupId, $privilegeId);
            $groupPrivilege->save();
          }
          $_SESSION["message"] = "Group, Save Successfully";
          $this->redirect("usergroups");
        }
      }
      // print_r($emp);
    }
    $this->_view();
  }

  public function editAction()
  {
    $this->language->load("template.common");
    //عمل رفع لمفات صفحة الاديت
    $this->language->load("usergroups.labels");

    //edit
    if (!empty($this->_params)) {
      $GroupId = $this->filterInt($this->_params[0]);
      $UserGroup = UserGroupsModel::getByPk($GroupId);
      if ($UserGroup == false) {
        $this->redirect("usergroups");
      }

      $this->_data["group"] = $UserGroup;
      $this->_data["privileges"] = PrivilegeModel::getAll();
      $groupPrivileges = UserGroupPrivilegeModel::getBy(["GroupId" => $UserGroup->GroupId]);
      $extractedPrivilegesIds = [];

      if (false !== $groupPrivileges) {
        foreach ($groupPrivileges as $privilege) {
          $extractedPrivilegesIds[] = $privilege->PrivilegeId;
        }
      }
      $this->_data["groupPrivileges"] = $extractedPrivilegesIds;
      //update
      if (isset($_POST["submit"])) {
        $GroupName = $this->filterString($_POST["GroupName"]);
        $UserGroup = new UserGroupsModel($GroupName);
        //لتاكيد انها تحديث
        $UserGroup->GroupId =  $GroupId;
        if ($UserGroup->save()) {
          if (isset($_POST["privileges"]) && is_array($_POST["privileges"])) {

            //مقارنة المصفوفة السابقة بالجديدة لمعرفةمذا الغينا
            $PrivilegesIdsToBeDeleted = array_diff($extractedPrivilegesIds, $_POST["privileges"]);

            //مقارنة المصفوفة السابقة بالجديدة لمعرفةمذا اضفنا
            $PrivilegesIdsToBeAdded = array_diff($_POST["privileges"], $extractedPrivilegesIds);

            //ازالة البريفلج لي الغيناهم
            foreach ($PrivilegesIdsToBeDeleted as $deletePrivilege) {
              $unwantedPrivilege = UserGroupPrivilegeModel::getBy(["PrivilegeId" => $deletePrivilege, "GroupId" => $UserGroup->GroupId]);
              $unwantedPrivilege[0]->delete();
            }

            //اضافة الصلاحيات لي اضفتهم

            foreach ($PrivilegesIdsToBeAdded as $privilegeId) {
              $groupPrivilege = new UserGroupPrivilegeModel($UserGroup->GroupId, $privilegeId);
              $groupPrivilege->save();
            }
          }
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
