<?php

namespace PHPMVC\LIB;
//مسوول على التحقق من ان المستخدم مسجل الدخول وهل له صلاحيات الدخول على action معين
class Authentication
{
  private static $_instance;
  private $_session;
  private $excludeRoutes =
  [
    "index/default",
    "auth/logout",
    "user/profile",
    "user/changepassword",
    "user/settings",
    "language/default",
    "accesdenied/default",
    "notfuond/notfound"
  ];
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
  public function isAuthorized()
  { //تتحقق اذا كانت يوجد سيشون بهذا الاسم والتي تدل على تسجيل دخوله 
    return  isset($this->_session->u);
  }
  public function hasAccess($controller, $action)
  {
    $url =strtolower( $controller . "/" . $action);
    if (in_array($url,$this->excludeRoutes)|| in_array($url,$this->_session->u->privileges)) {
      return true;
    }
  }
}
