<?php

namespace PHPMVC\LIB;
//هدف انشاء هذا الكلاس هو بهدف االتحكم في اي كائن من اي مكان (هنا سنتحكم بالكائن السيشون رسائل)
class Messenger
{
  const APP_MESSAGE_SUCCESS = 1;
  const APP_MESSAGE_ERROR = 2;
  const APP_MESSAGE_WARNING = 3;
  const APP_MESSAGE_INFO = 4;

  private static $_instance;
  private $_session;
  private $_messages = [];

  private function __construct($session)
  {
    $this->_session = $session;
  }
  private function __clone()
  {
  }

  public static function geInstance(AppSessionHandler $session)
  {
    if (self::$_instance == null) {
      self::$_instance = new self($session);
    }
    return self::$_instance;
  }
  public function add($message, $type = self::APP_MESSAGE_SUCCESS)
  {
    if (!$this->messagesExists()) {
      $this->_session->messages = [];
    }
    $megs = $this->_session->messages;
    $megs[] = [$message, $type];
    $this->_session->messages= $megs;
  }
  private function messagesExists()
  {
    return isset($this->_session->messages);
  }
  public function getMessage()
  {
    if ($this->messagesExists()) {
      $this->_messages = $this->_session->messages;
      unset($this->_session->messages);
      return $this->_messages;
    }
    return [];
  }
}
