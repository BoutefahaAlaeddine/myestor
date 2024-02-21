<?php
namespace PHPMVC\models;

class UserGroupsModel extends AbstractModel{
  public $GroupId;
  protected $GroupName	;
  

  protected static $primaryKey="GroupId";
  protected static $tableName = "app_users_groups";
  protected static $tableSchema = array(
    "GroupName" => self::DATA_TYPE_STR,
  );

  public function __construct($GroupName)
  {
    $this->GroupName	 = $GroupName	;
  }

  public function __get($prop)
  {
    return $this->$prop;
  }

}