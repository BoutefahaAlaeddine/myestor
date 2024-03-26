<?php

namespace PHPMVC\LIB;

class Language
{
  private $_dictionary = array();

  public function load($path)
  {
    //اللغة الافتراضية
    $defaultLanguage = APP_DEFAULT_LANGUAGE;

    if (isset($_SESSION['lang'])) {
      $defaultLanguage = $_SESSION["lang"];
    }

    //هذا مسار الملف الصفحة لكي يترجم حسب الصفحة
    $languageFileToLoad = LANGUAGE_PATH . $defaultLanguage . DS . str_replace(".", DS, $path) . ".lang.php";

    // var_dump(file_exists($languageFileToLoad));

    if (file_exists($languageFileToLoad)) {
      //استدعاء الفايل
      require $languageFileToLoad;
      if (is_array($_) && !empty($_)) {
        foreach ($_ as $key => $value) {
          //ادخال القيم في مصفوفة
          $this->_dictionary[$key] = $value;
        }
        // var_dump($this->_dictionary);
      }
    } else {
      trigger_error("Sorry the language file " . $path . " does not exists", E_USER_WARNING);
    }
  }
  //هذي تجلب بها ترجمة اسم المدخل
  public function get($key)
  {
    if (array_key_exists($key, $this->_dictionary)) {
      return $this->_dictionary[$key];
    }
  }
  //جلب الاخطاء نتاع الفايل من الديكسونري
  public function feedKey($Key,$data){
    if (array_key_exists($Key, $this->_dictionary)) {
      //ربط كل مدخل بالخطا نتاعو
      array_unshift($data,$this->_dictionary[$Key]);
      //  print_r($data);
      //  echo "</br>";
    return call_user_func_array("sprintf",$data);
    }
  }

  public function getDictionary()
  {
    return $this->_dictionary;
  }
}
