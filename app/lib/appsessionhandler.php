<?php
namespace PHPMVC\LIB;

class AppSessionHandler extends \SessionHandler
{

  // اسم السيشون افتراضي  
  private $sessionName = SESSION_NAME;
  // وقت السيشون ينتهي بعد اطفاء المتصفح
  private $sessionMaxLifetime =SESSION_MAX_LIFE_TIME;
  // كاش سكريتي
  private $sessionSSl = SESSION_SSL;
  // يمكن التحكم بجافا سكريبت
  private $sessionHTTPOnly = SESSION_HTTP_ONLY;
  // من أين يبدأ قراءة السيشون من ملف الملف هذا وبعدها الأجزاء نتواعد
  private $sessionPth = "/";
  private $sessionDomain =SESSION_DOMAIN;

  private  $sessionCipherAlgo = "AES-128-CBC";
  private  $sessionCipherKey = "*/Alilo&Dz2024/@";
  private $ttl = SESSION_TTL;

  // مكان حفض السيشون
  private $sessionSavePth = SESSION_SAVE_PATH;

  public function __construct()
  {
    // التعديل على ملف php.ini

    // يمكن استخدام الكوكيز من طرف الجافا سكريبت
    ini_set("session.use_cookies", 1);
    // استخدام فقط الكوكيز
    ini_set("session.use_only_cookies", 1);
    // مطلوب عدم التحكم في السيشون عن طريق الرابط
    ini_set("session.use_trans_sid", 0);
    // لازم تتحفظ في فايل
    ini_set("session.save_handler", "files");

    session_name($this->sessionName);
    session_save_path($this->sessionSavePth);

    session_set_cookie_params(
      $this->sessionMaxLifetime,
      $this->sessionPth,
      $this->sessionDomain,
      $this->sessionSSl,
      $this->sessionHTTPOnly
    );

    // لكي يتم استخدام دوال الكتابة والقراءة
    // session_set_save_handler($this, true);
  }

  public function __get($key)
  {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
  }

  public function __set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  public function __isset($key)
  {
    return isset($_SESSION[$key]);
  }


  public function read(string $id): string|false
  {
    return openssl_decrypt(parent::read($id), $this->sessionCipherAlgo, $this->sessionCipherKey);
  }

  public function write(string $id, string $data): bool
  {
    return parent::write($id, openssl_encrypt($data, $this->sessionCipherAlgo, $this->sessionCipherKey));
  }

  public function start()
  {
    if (session_id() === "") {
      if (session_start()) {
        $this->setSessionStartTime();
        $this->checkSessionValidity();
      }
    }
  }

  private function setSessionStartTime()
  {

    if (!isset($this->sessionStarTime)) {
      // انشاء متغير بهذا الاسم واعطيه قيمة التايم الحالية (وقت فتح السيشون)
      $this->sessionStarTime = time();
    }
    return true;
  }

  private function checkSessionValidity()
  {
    // اذا تجاوز الوقت فتح السيشون الوقت المسموح لنا نديروه من عندنا اعمل تغيير لاسم الملف السيشون
    if ((time() - $this->sessionStartTime) > ($this->ttl * 60)) {
      $this->renewSession();
      $this->generateFingerPrint();
    }
    return true;
  }

  private function renewSession()

  {
    $this->sessionStartTime = time();
    // حذف السيشون فايل القديمة وانشاء واحدة جديدة
    return  session_regenerate_id(true);
  }

  // هنا باه نخلو السيشون تمشي فقط مع لي عندو هذه البينات فقط
  // اضافة دالة لمنع session fixation و منع hijacking بطريقة بسيطة


  // اخفاء كل شيء
  public function kill()
  {
    session_unset();
    setcookie(
      $this->sessionName,
      "",
      time() - 100,
      $this->sessionPath,
      $this->sessionDomain,
      $this->sessionSSl,
      $this->sessionHTTPOnly
    );
    session_destroy();
  }

  // التحقق من المعلومات
  private function generateFingerPrint()
  {
    $this->cipherKey = openssl_random_pseudo_bytes(16);
    $this->fingerPrint = md5($_SERVER["HTTP_USER_AGENT"] . $this->cipherKey . session_id());
  }

  public function isValidFingerPrint()
  {
    if (!isset($this->fingerPrint)) {
      $this->generateFingerPrint();
    }
    $this->generateFingerPrint();
    $fingerPrint = md5($_SERVER["HTTP_USER_AGENT"] . $this->cipherKey . session_id());

    if ($fingerPrint == $this->fingerPrint) {
      return true;
    }
    return false;
  }
}

