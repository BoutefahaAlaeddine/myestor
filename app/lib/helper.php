<?php

namespace PHPMVC\LIB;

trait Helper
{
  public function redirect($path)
  {
    session_write_close();
    if (str_contains($path,"http") ) {
      header("Location:" .$path);
    }else{
    header("Location:" .  MAIN_LINK .$path);
  }
    exit;
  }
}
