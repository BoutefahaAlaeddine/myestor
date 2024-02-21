<?php

namespace PHPMVC\models;

class PrivilegeModel extends AbstractModel
{
  public $PrivilegeId;
  protected $Privilege;
  protected $PrivilegeTitle;


  protected static $primaryKey = "PrivilegeId";
  protected static $tableName = "app_users_privileges";
  protected static $tableSchema = array(
    "Privilege" => self::DATA_TYPE_STR,
    "PrivilegeTitle" => self::DATA_TYPE_STR,
  );

  public function __construct($Privilege, $PrivilegeTitle)
  {
    $this->Privilege   = $Privilege;
    $this->PrivilegeTitle   = $PrivilegeTitle;
  }

  public function __get($prop)
  {
    return $this->$prop;
  }
}
