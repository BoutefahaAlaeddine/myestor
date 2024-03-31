<?php

namespace PHPMVC\models;

class UserGroupPrivilegeModel extends AbstractModel
{
  public $Id;
  protected $GroupId;
  protected $PrivilegeId;


  protected static $primaryKey = "Id";
  protected static $tableName = "app_users_groups_privileges";
  protected static $tableSchema = array(
    "GroupId" => self::DATA_TYPE_INT,
    "PrivilegeId" => self::DATA_TYPE_INT,
  );

  public function __construct($GroupId, $PrivilegeId)
  {
    $this->GroupId   = $GroupId;
    $this->PrivilegeId   = $PrivilegeId;
  }

  public function __get($prop)
  {
    return $this->$prop;
  }
  public static function getGroupPrivileges(UserGroupsModel $UserGroup)
  {
    $groupPrivileges = self::getBy(["GroupId" => $UserGroup->GroupId]);

    $extractedPrivilegesIds = [];

    if (false !== $groupPrivileges) {
      foreach ($groupPrivileges as $privilege) {
        $extractedPrivilegesIds[] = $privilege->PrivilegeId;
      }
    }
    return  $extractedPrivilegesIds;
  }
  //جمع الصلاحيات مع المجموعات
  public static function getPrivilegesForGroup($groupId)
  {
    $sql = "SELECT augp.*, aup.Privilege FROM " . self::$tableName . " augp ";
    $sql .= "INNER JOIN app_users_privileges aup ON aup.PrivilegeId = augp.PrivilegeId ";
    $sql .= "WHERE augp.GroupId= " . $groupId;
    $privileges =  self::get($sql);
    $extractedUrls = [];
    if (false !== $privileges) {
      foreach ($privileges as $privilege) {
        $extractedUrls[] = $privilege->Privilege;
      }
    }
    return $extractedUrls;
  }
}
