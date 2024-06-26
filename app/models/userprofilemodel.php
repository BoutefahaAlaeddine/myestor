<?php

namespace PHPMVC\models;

class UserProfileModel extends AbstractModel
{
  public $UserId;
  public $FirstName;
  public $LastName;
  public $Address;
  public $DOB;
  public $Image;

  protected static $primaryKey = "UserId";
  protected static $tableName = "app_users_profiles";
  protected static $tableSchema = array(
    "UserId" => self::DATA_TYPE_INT,
    "FirstName" => self::DATA_TYPE_STR,
    "LastName" => self::DATA_TYPE_STR,
    "Address" => self::DATA_TYPE_STR,
    "DOB" => self::DATA_TYPE_STR,
    "Image" => self::DATA_TYPE_STR,
  );

  public function __construct()
  {

  }
}
