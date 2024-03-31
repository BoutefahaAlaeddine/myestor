<?php

namespace PHPMVC\models;

class UserModel extends AbstractModel
{
  public $UserId;
  protected $Username;
  protected $Password;
  protected $Email;
  protected $PhoneNumber;
  protected $SubscriptionDate;
  protected $LastLogin;
  protected $GroupId;
  protected $Status;

  //user profile model
  public $profile;
  public $privileges;

  protected static $primaryKey = "UserId";
  protected static $tableName = "app_users";
  protected static $tableSchema = array(
    "Username" => self::DATA_TYPE_STR,
    "Password" => self::DATA_TYPE_STR,
    "Email" => self::DATA_TYPE_STR,
    "PhoneNumber" => self::DATA_TYPE_STR,
    "SubscriptionDate" => self::DATA_TYPE_STR,
    "LastLogin" => self::DATA_TYPE_STR,
    "GroupId" => self::DATA_TYPE_INT,
    "Status" => self::DATA_TYPE_INT,
  );

  public function __construct($Username, $Password, $Email, $PhoneNumber, $SubscriptionDate, $LastLogin, $GroupId, $Status)
  {
    $this->Username = $Username;
    $this->Password = $Password;
    $this->Email = $Email;
    $this->PhoneNumber = $PhoneNumber;
    $this->SubscriptionDate = $SubscriptionDate;
    $this->LastLogin = $LastLogin;
    $this->GroupId = $GroupId;
    $this->Status = $Status;
  }
  static function cryptPassword($Password)
  {
    return  crypt($Password, APP_SALT);
  }

  public static function getUsers(UserModel $user)
  {
    return self::get('SELECT au.* , aug.GroupName  GroupName FROM ' . self::$tableName . ' au INNER JOIN app_users_groups aug ON aug.GroupId=au.GroupId WHERE au.UserId !=' . $user->UserId);
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
  public static function authenticate($username, $Password, $session)
  {
    $Password = self::cryptPassword($Password);
    $sql = 'SELECT *,(SELECT GroupName FROM app_users_groups WHERE app_users_groups.GroupId=' . self::$tableName . '.GroupId ) GroupName FROM ' . self::$tableName . ' WHERE Username="' . $username . '" AND password= "' . $Password . '"';
    $foundUser = self::getOne($sql);
    if ($foundUser !== false) {
      //حالة الحساب موجود لكن معطل
      if ($foundUser[0]->Status == 2) {
        return 2;
      }
      //الحساب مفعل
      $foundUser[0]->LastLogin = date("Y-m-d H:i:s");
      $foundUser[0]->profile = UserProfileModel::getByPk($foundUser[0]->UserId);
      $foundUser[0]->privileges=UserGroupPrivilegeModel::getPrivilegesForGroup($foundUser[0]->GroupId);
      $foundUser[0]->save();
      $session->u = $foundUser[0];
      return 1;
    }
    //لا يوجد حساب
    return 3;
  }

  public function __get($prop)
  {
    return $this->$prop;
  }
}
