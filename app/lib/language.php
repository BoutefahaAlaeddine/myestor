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
  $defaultLanguage=$_SESSION["lang"];
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
  public function getDictionary()
  {
    return $this->_dictionary;
  }
}
