<?php

namespace PHPMVC\models;

class UserModel extends AbstractModel
{
  public $UserId;
  protected $Username;
  protected $password;
  protected $Email;
  protected $PhoneNumber;
  protected $SubscriptionDate;
  protected $LastLogin;
  protected $GroupId;
  protected $Status;

  protected static $primaryKey = "UserId";
  protected static $tableName = "app_users";
  protected static $tableSchema = array(
    "Username" => self::DATA_TYPE_STR,
    "password" => self::DATA_TYPE_STR,
    "Email" => self::DATA_TYPE_STR,
    "PhoneNumber" => self::DATA_TYPE_STR,
    "SubscriptionDate" => self::DATA_TYPE_STR,
    "LastLogin" => self::DATA_TYPE_STR,
    "GroupId" => self::DATA_TYPE_INT,
    "Status" => self::DATA_TYPE_INT,
  );

  public function __construct($Username, $password, $Email, $PhoneNumber, $SubscriptionDate, $LastLogin, $GroupId, $Status)
  {
    $this->Username = $Username;
    $this->password = $password;
    $this->Email = $Email;
    $this->PhoneNumber = $PhoneNumber;
    $this->SubscriptionDate = $SubscriptionDate;
    $this->LastLogin = $LastLogin;
    $this->GroupId = $GroupId;
    $this->Status = $Status;
  }
  static function cryptPassword($password)
  {
    $salt = '$2a$07$OL3EQnBoyahYafbnlntbde$';
    return  crypt($password,  $salt);
  }
  //تم التعديل في هذه الدالة
  public static function getAll()
  {
    return self::get('SELECT au.* , aug.GroupName  GroupName FROM ' . self::$tableName . ' au INNER JOIN app_users_groups aug ON aug.GroupId=au.GroupId');
  }
  //دالة الحقق من وجود المستخدم
  public static function userExists($Username)
  {
    return self::get('SELECT * FROM ' . self::$tableName . ' WHERE username="' . $Username . '"');
  }
  //دالة الحقق من وجود المستخدم
  public static function EmailExists($Email)
  {
    return self::get('SELECT * FROM ' . self::$tableName . ' WHERE Email="' . $Email . '"');
  }

  public function __get($prop)
  {
    return $this->$prop;
  }
}
