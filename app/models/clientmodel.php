<?php

namespace PHPMVC\models;

class ClientModel extends AbstractModel
{
  public $ClientId;
  public $Name;
  public $PhoneNumber;
  public $Email;
  public $Address;


  protected static $primaryKey = "ClientId";
  protected static $tableName = "app_clients";
  protected static $tableSchema = array(
    "Name" => self::DATA_TYPE_STR,
    "PhoneNumber" => self::DATA_TYPE_STR,
    "Email" => self::DATA_TYPE_STR,
    "Address" => self::DATA_TYPE_STR,
  );

  public function __construct()
  {}


}
