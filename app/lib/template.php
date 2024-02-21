<?php
//هذا الكلاس المسوول على تنضيم رفع ملفات  التاملبت
namespace PHPMVC\LIB;


class Template
{


  private $_templateParts;
  private $_action_view;
  private $_data;
  private $_action;
  private $_params;

  public function __construct(array $parts)
  {
    $this->_templateParts = $parts;
  }

  //ه عمل ادخال لمسارات الفيو
  public function setActionViewFile($actionViwPath)
  {
    $this->_action_view = $actionViwPath;
  }

  //عمل ادخال لداتا عندي 
  public function setAppData($data)
  {
    $this->_data = $data;
  }

  public function setPramsAndAction($action, $params)
  {
    $this->_action = $action;
    $this->_params = $params;
  }





  private function renderTemplateStart()
  {
    extract($this->_data);
    require_once TEMPLATE_PATH . DS . "templateheader.php";
  }
  private function renderTemplateEnd()
  {
    require_once TEMPLATE_PATH . DS . "templatefooter.php";
  }

  //تعديل الراوابط الفايلس heder content  sidebar..
  public function renderTemplateBlocks()
  {

    if (!array_key_exists("template", $this->_templateParts)) {
      // var_dump($parts);

      //يجب تعريف مسارات الملفات في ملف التمبليت كونفيغ
      trigger_error("Sorry you Have to define the template blocks", E_USER_WARNING);
    } else {

      //جلب القيم التي اضافاها الامبوليي مثلا وفصلها على شكل مفتاح وقيمة لستعمالها في الفيو 
      extract($this->_data);
      $parts = $this->_templateParts["template"];
      if (!empty($parts)) {
        foreach ($parts as $partKey => $file) {
          if ($partKey == ":view") {
            require_once $this->_action_view;
          } else {
            require_once $file;
          }
        }
      }
    }
  }

  //تعديل روابط ال css ,js 
  private function renderHeaderResources()
  {
    $output = "";
    if (!array_key_exists("Header_resources", $this->_templateParts)) {
      // var_dump($parts);
      //يجب تعريف مسارات الملفات في ملف التمبليت كونفيغ
      trigger_error("Sorry you Have to define the header resources ", E_USER_WARNING);
    } else {
      $resources = $this->_templateParts["Header_resources"];

      //generate Css links
      $css = $resources["css"];
      if (!empty($css)) {
        foreach ($css as $cssKey => $path) {

          if ($_SESSION["lang"] == "en") {
            if ($cssKey !== "main-ar") {
              $output .= '<link rel="stylesheet" type="text/css" href="'.MAIN_SRC  . $path . '" />';
            }
          } else {
            $output .= '<link rel="stylesheet" type="text/css" href="'.MAIN_SRC  . $path . '" />';
          }
        }
      }
    }
    echo $output;
  }
  //تعديل روابط ال css ,js 
  private function renderFooterResources()
  {
    $output = "";
    if (!array_key_exists("footer_resources", $this->_templateParts)) {
      // var_dump($parts);
      //يجب تعريف مسارات الملفات في ملف التمبليت كونفيغ
      trigger_error("Sorry you Have to define the footer resources ", E_USER_WARNING);
    } else {
      $resources = $this->_templateParts["footer_resources"];


      //generate js links
      $js = $resources["js"];
      if (!empty($js)) {
        foreach ($js as $jsKey => $path) {
          $output .= '<script src="'.MAIN_SRC  . $path . '"></script>';
        }
      }
    }
    echo $output;
  }

  public function renderApp()
  {
    $this->renderTemplateStart();
    $this->renderHeaderResources();

    $this->renderTemplateBlocks();


    $this->renderFooterResources();

    $this->renderTemplateEnd();
  }
}
