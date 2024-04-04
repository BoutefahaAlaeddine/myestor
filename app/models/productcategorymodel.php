<?php

namespace PHPMVC\models;

class ProductCategoryModel extends AbstractModel
{
  public $CategoryId;
  public $Name;
  public $Image;


  protected static $primaryKey = "cat_id";
  protected static $tableName = "app_products_categories";
  protected static $tableSchema = array(
    "Name" => self::DATA_TYPE_STR,
    "Image" => self::DATA_TYPE_STR,
  );

  public function __construct()
  {}


}
