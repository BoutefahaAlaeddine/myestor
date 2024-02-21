<?php 

namespace PHPMVC\LIB;

class Autoload{
public static function autoload($className){

  $className=str_replace("PHPMVC",'',$className);

  // $className=str_replace("\\",'',$className);

  //اسم ملف الكلاس الكنتولور الموجود في lib
$className=$className.".php";
  //للوصول الى رابط ملفات المجودة في lib
  // echo APP_PATH. $className;
  // var_dump(file_exists(APP_PATH.$className));
if (file_exists(APP_PATH.$className)) {
  require_once APP_PATH.$className;
}

}
}

spl_autoload_register(__NAMESPACE__.'\autoload::autoload');
