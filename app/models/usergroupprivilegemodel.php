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
}
