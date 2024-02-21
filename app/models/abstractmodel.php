<?php

namespace PHPMVC\models;

use PHPMVC\LIB\Database\DB;

class AbstractModel
{
  // ثوابت لفلترة البيانات الداخلة
  const DATA_TYPE_BOOL = \PDO::PARAM_BOOL;
  const DATA_TYPE_STR = \PDO::PARAM_STR;
  const DATA_TYPE_INT = \PDO::PARAM_INT;
  const DATA_TYPE_DECIMAL = 4;
  const DATA_TYPE_DATE = 5;

  // جلب أسماء الأعمدة
  private static function buildNameParameterSQL()
  {
    $namedParams = "";
    foreach (static::$tableSchema as $columnName => $type) {
      $namedParams .= $columnName . "=:" . $columnName . " , ";
    }
    return trim($namedParams, " , ");
  }

  //تعديل القيم بابايند
  private function prepareValues(\PDOStatement $stmt)
  {
    foreach (static::$tableSchema as $columnName => $type) {
      $sanitizedValue = null;
      if ($type == self::DATA_TYPE_DECIMAL) {
        $sanitizedValue = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      } else if ($type == self::DATA_TYPE_DATE) {
        $sanitizedValue = date("Y-m-d H:i:s", strtotime($this->$columnName));
        // تحويل التاريخ إلى تنسيق قابل للقبول
      } else {
        $sanitizedValue = $this->$columnName;
      }
      $stmt->bindValue(":$columnName", $sanitizedValue, $type);
      // var_dump($sanitizedValue);
      // echo ": $columnName , $sanitizedValue, $type .</br>";
    }
  }

  //انشاء
  private  function create()
  {
    $connection = DB::connect();
    $sql = "INSERT INTO " . static::$tableName . " SET " . self::buildNameParameterSQL();
    $stmt = $connection->prepare($sql);
    $this->prepareValues($stmt);
    if ($stmt->execute()) {
      $this->{static::$primaryKey} = $connection->lastInsertId();
      return true;
    }
    return false;
  }
  //تحديث
  private  function update()
  {
    $connection = DB::connect();
    $sql = "UPDATE " . static::$tableName . " SET " . self::buildNameParameterSQL() . " where " . static::$primaryKey . "=" . $this->{static::$primaryKey};
    $stmt = $connection->prepare($sql);
    $this->prepareValues($stmt);
    return $stmt->execute();
  }

  //هذي تنفذ على حساب البرامري كي اذا حددتو معناها ساحدث والعكس صحيح
  public function save()
  {
    return $this->{static::$primaryKey} == null ? $this->create() : $this->update();
  
  }

  //حذف
  public  function delete()
  {
    $connection = DB::connect();
    $sql = "DELETE FROM " . static::$tableName . " WHERE " . static::$primaryKey . "=" . $this->{static::$primaryKey};
    $stmt = $connection->prepare($sql);
    return $stmt->execute();
  }
  //جلب كل شي
  public static function getAll()
  {
    $connection = DB::connect();
    $sql = "SELECT * FROM " . static::$tableName;
    $stmt = $connection->prepare($sql);
    //يجلبهم على شكل 
    $stmt->execute();
    $results =  $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
    return (is_array($results) && !empty($results)) ? $results  : false;
  }
  //جلب عنصر واحد بالايدي
  public static function getByPK($pk)
  {
    $connection = DB::connect();
    $sql = "SELECT * FROM " . static::$tableName . " WHERE " . static::$primaryKey . "='" . $pk . "' ";
    $stmt = $connection->prepare($sql);
    //يجلبهم على شكل كائن
    if ($stmt->execute() == true) {
      $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
      $obj = array_shift($obj);
      return (!empty($obj)) ?   $obj  : false;
    }
    return false;
  }
  //جلب عناصر ب اي شي
  public function get($sql, $options = array())
  {
    $connection = DB::connect();
    $stmt = $connection->prepare($sql);

    foreach ($options as $columnName => $type) {
      $sanitizedValue = null;
      if ($type[0] == 4) {
        $sanitizedValue = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      } elseif ($type[0] == self::DATA_TYPE_DATE) {
        $sanitizedValue = date("Y-m-d H:i:s", strtotime($type[1]));
      } else {
        $sanitizedValue = $type[1];
      }
      $stmt->bindValue(":$columnName", $sanitizedValue, $type[0]);
    }

    $stmt->execute();
    $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));

    return (is_array($results) && !empty($results)) ? $results : false;
  }
}
