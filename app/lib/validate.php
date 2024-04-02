<?php

namespace PHPMVC\LIB;
//هذا الكلاس مسسول على تحقق من صحة المدخلات
trait Validate
{
  private $_regexPatterns = [
    "num" => '/^[0-9]+(?:\.[0-9]+)?$/',
    "int" => '/^[0-9]+$/',
    "float" => '/^[0-9]+\.[0-9]+$/',
    "alpha" => '/^[a-zA-Z \p{Arabic}]+$/u',
    "alphanum" => '/^[a-zA-Z\p{Arabic}0-9]+$/u',
    "vdate" => '/^[1-9][0-9][0-9]{2}-([0][1-9]|[1][0-2])-([1-2][0-9]|[0][1-9]|[3][0-1])$/',
    "email" => '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i',
    "url" => '~^(https?|ftp)://[a-zA-Z0-9-]+(?:\.[a-zA-Z]{2,})+(?:/[^\s]*)?$~',
  ];

  public function req($value)
  {
    return '' !== $value | !empty($value);
  }
  public function num($value)
  {
    return (bool) preg_match($this->_regexPatterns["num"], $value);
  }
  public function int($value)
  {
    return (bool) preg_match($this->_regexPatterns["int"], $value);
  }
  public function float($value)
  {
    return (bool) preg_match($this->_regexPatterns["float"], $value);
  }
  public function alpha($value)
  {
    return (bool) preg_match($this->_regexPatterns["alpha"], $value);
  }
  public function alphanum($value)
  {
    return (bool)preg_match($this->_regexPatterns["alphanum"], $value);
  }
  public function eq($value, $matchAgainst)
  {
    return $value == $matchAgainst;
  }
  public function eqField($value, $otherFiledValue)
  {
    return $value == $otherFiledValue;
  }
  public function lt($value, $matchAgainst)
  {
    if (is_string($value)) {
      return mb_strlen($value) < $matchAgainst;
    } elseif (is_numeric($value)) {
      return $value < $matchAgainst;
    }
  }
  public function gt($value, $matchAgainst)
  {
    if (is_string($value)) {
      return mb_strlen($value) > $matchAgainst;
    } elseif (is_numeric($value)) {
      return $value > $matchAgainst;
    }
  }
  public function min($value, $min)
  {
    if (is_string($value)) {
      return mb_strlen($value) >= $min;
    } elseif (is_numeric($value)) {
      return $value >= $min;
    }
  }
  public function max($value, $max)
  {
    if (is_string($value)) {
      return mb_strlen($value) <= $max;
    } elseif (is_numeric($value)) {
      return $value <= $max;
    }
  }
  public function between($value, $min, $max)
  {
    if (is_string($value)) {
      return mb_strlen($value) >= $min && mb_strlen($value) <= $max;
    } elseif (is_numeric($value)) {
      return  $value >= $min && $value <= $max;
    }
  }
  public function floatLike($value, $beforeDP, $afterDP)
  {
    if (!$this->float($value)) {
      return false;
    }
    $pattern = '/^[0-9]{' . $beforeDP . '}\.[0-9]{' . $afterDP . '}$/';
    return (bool) preg_match($pattern, $value);
  }
  public function vdate($value)
  {
    return (bool)preg_match($this->_regexPatterns['vdate'], $value);
  }
  public function email($value)
  {
    return (bool)preg_match($this->_regexPatterns['email'], $value);
  }
  public function url($value)
  {
    return (bool)preg_match($this->_regexPatterns['url'], $value);
  }

  public function isValid($roles, $inputType)
  {
    $errors = [];
    if (!empty($roles)) {
      //جلب كل القواعد
      foreach ($roles as $fieldName => $validationRoles) {
        //قيم المبعوثة ب post
        // var_dump($inputType[$fieldName]);
        $value = $inputType[$fieldName];
        //تفكيك القواعد
        $validationRoles = explode('|', $validationRoles);
        // var_dump($validationRoles);
        //استعمال كل دوال القواعد التي وضعتها في كل انبوت
        foreach ($validationRoles as $validationRole) {
          if (array_key_exists($fieldName, $errors))
            continue;
          if (preg_match_all('/(min)\((\d+)\)/', $validationRole, $m)) {
            // var_dump($m[1][0]);
            if (!$this->min($value, $m[2][0])) {
              //اضافة النص الى رسائل الخطا
              $this->messenger->add($this->language->feedKey("text_error_" . $m[1][0], [$this->language->get('text_label_' . $fieldName), $m[2][0]]), Messenger::APP_MESSAGE_ERROR);
              $errors[$fieldName] = true;
            }
          } elseif (preg_match_all('/(max)\((\d+)\)/', $validationRole, $m)) {
            // var_dump($m[1][0]);
            if (!$this->max($value, $m[2][0])) {
              //اضافة النص الى رسائل الخطا
              $this->messenger->add($this->language->feedKey("text_error_" . $m[1][0], [$this->language->get('text_label_' . $fieldName), $m[2][0]]), Messenger::APP_MESSAGE_ERROR);
              $errors[$fieldName] = true;
            }
          } elseif (preg_match_all('/(lt)\((\d+)\)/', $validationRole, $m)) {
            // var_dump($m[1][0]);
            if (!$this->lt($value, $m[2][0])) {
              //اضافة النص الى رسائل الخطا
              $this->messenger->add($this->language->feedKey("text_error_" . $m[1][0], [$this->language->get('text_label_' . $fieldName), $m[2][0]]), Messenger::APP_MESSAGE_ERROR);
              $errors[$fieldName] = true;
            }
          } elseif (preg_match_all('/(gt)\((\d+)\)/', $validationRole, $m)) {
            // var_dump($m[1][0]);
            if (!$this->gt($value, $m[2][0])) {
              //اضافة النص الى رسائل الخطا
              $this->messenger->add($this->language->feedKey("text_error_" . $m[1][0], [$this->language->get('text_label_' . $fieldName), $m[2][0]]), Messenger::APP_MESSAGE_ERROR);
              $errors[$fieldName] = true;
            }
          } elseif (preg_match_all('/(between)\((\d+),(\d+)\)/', $validationRole, $m)) {
            // var_dump($m[1][0]);
            if (!$this->between($value, $m[2][0], $m[3][0])) {
              //اضافة النص الى رسائل الخطا
              $this->messenger->add($this->language->feedKey("text_error_" . $m[1][0], [$this->language->get('text_label_' . $fieldName), $m[2][0], $m[3][0]]), Messenger::APP_MESSAGE_ERROR);
              $errors[$fieldName] = true;
            }
          } elseif (preg_match_all('/(floatLike)\((\d+),(\d+)\)/', $validationRole, $m)) {
            // var_dump($m[1][0]);
            if (!$this->floatLike($value, $m[2][0], $m[3][0])) {
              //اضافة النص الى رسائل الخطا
              $this->messenger->add($this->language->feedKey("text_error_" . $m[1][0], [$this->language->get('text_label_' . $fieldName), $m[2][0], $m[3][0]]), Messenger::APP_MESSAGE_ERROR);
              $errors[$fieldName] = true;
            }
          } elseif (preg_match_all('/(eq)\((\w+)\)/', $validationRole, $m)) {
            // var_dump($m[1][0]);
            if (!$this->eq($value, $m[2][0])) {
              //اضافة النص الى رسائل الخطا
              $this->messenger->add($this->language->feedKey("text_error_" . $m[1][0], [$this->language->get('text_label_' . $fieldName), $m[2][0]]), Messenger::APP_MESSAGE_ERROR);
              $errors[$fieldName] = true;
            }
          } elseif (preg_match_all('/(eqField)\((\w+)\)/', $validationRole, $m)) {
            $otherFiledValue = $inputType[$m[2][0]];
            if (!$this->eqField($value, $otherFiledValue)) {
              //اضافة النص الى رسائل الخطا
              $this->messenger->add($this->language->feedKey("text_error_" . $m[1][0], [$this->language->get('text_label_' . $fieldName), $this->language->get('text_label_' . $m[2][0])]), Messenger::APP_MESSAGE_ERROR);
              $errors[$fieldName] = true;
            }
          } else {
            if (!$this->$validationRole($value)) {
              //اضافة النص الى رسائل الخطا
              $this->messenger->add($this->language->feedKey("text_error_" . $validationRole, [$this->language->get('text_label_' . $fieldName)]), Messenger::APP_MESSAGE_ERROR);
              $errors[$fieldName] = true;
            }
          }


          // var_dump($this->$validationRole($inputType[$fieldName]));

        }
      }
    }
    return empty($errors) ? true : false;
  }
}
