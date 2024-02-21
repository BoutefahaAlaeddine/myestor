<?php
namespace PHPMVC\models;

class UserModel extends AbstractModel
{
  public $UserId;
  protected $Username;
  protected $password;
  protected $Email;
  protected $PhoneNumber;
  protected $SubscriptionData;
  protected $LastLogon;
  protected $GroupId;

  protected static $primaryKey="UserId";
  protected static $tableName = "app_users";
  protected static $tableSchema = array(
    "Username" => self::DATA_TYPE_INT,
    "password" => self::DATA_TYPE_STR,
    "Email" => self::DATA_TYPE_STR,
    "PhoneNumber" => self::DATA_TYPE_STR,
    "SubscriptionData" => self::DATA_TYPE_DATE,
    "LastLogon" => self::DATA_TYPE_STR,
    "GroupId" => self::DATA_TYPE_INT,
  );

  public function __construct($Username, $password, $Email, $PhoneNumber, $SubscriptionData, $LastLogon, $GroupId)
  {
    $this->Username = $Username;
    $this->password = $password;
    $this->Email = $Email;
    $this->PhoneNumber = $PhoneNumber;
    $this->SubscriptionData = $SubscriptionData;
    $this->LastLogon = $LastLogon;
    $this->GroupId = $GroupId;
  }

  public function __get($prop)
  {
    return $this->$prop;
  }


}
?>
