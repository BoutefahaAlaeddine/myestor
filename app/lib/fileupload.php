<?php

namespace PHPMVC\LIB;

class FileUpload
{
  private $name;
  private $type;
  private $size;
  private $error;
  private $tempPth;

  private $fileExtension;

  private $allowedExtensions=[
    "jpg","png","gif","pdf","doc","docx","xls"
  ];

  public function __construct(array $file)
  {
    $this->name=$this->name($file["name"]);
    $this->type=$file["type"];
    $this->size=$file["size"];
    $this->error=$file["error"];
    $this->tempPth=$file["tmp_name"];
  }
private function name($name){
preg_match_all('/([a-z]{1,4})$/i',$name,$m);
$this->fileExtension=$m[0][0];
return substr(strtolower(base64_decode($this->name.APP_SALT)),0,24);
}

private function isAllowedType(){

  return in_array($this->fileExtension,$this->allowedExtensions);
}

private function isSizeAcceptable(){
preg_match_all("/(\d+)([MG])$/i",MAX_FILE_SIZE_ALLOWED,$matches) ;
$maxFileSizeToUpload=$matches[1][0];
 $sizeUnit=$matches[2][0];
$currentFileSiz=($sizeUnit=="M")?($this->size/1024/1024):($this->size/1024/1024/1024);
$currentFileSiz=ceil($currentFileSiz);
return (int) $currentFileSiz > (int) $maxFileSizeToUpload;
}

private function isImage(){
  return preg_match("/image/i",$this->type);
}

public function getFileName(){
  return $this->name.".".$this->fileExtension;
}



public function upload(){
  if ($this->error!=0) {
    trigger_error("Sorry File didn't upload successfully",E_USER_WARNING);
  }
  elseif(!$this->isAllowedType()){
    trigger_error("Sorry Files of type".$this->fileExtension."are not allowed",E_USER_WARNING);
  }
  elseif($this->isSizeAcceptable()){
    trigger_error("Sorry the file size exceed the maximum allowed size",E_USER_WARNING);
  }
  else{
    if ($this->isImage()) {
      move_uploaded_file($this->tempPth,IMAGES_UPLOAD_STORAGE.DS.$this->getFileName());
    }else{
      move_uploaded_file($this->tempPth,DOCUMENTS_UPLOAD_STORAGE.DS.$this->getFileName());
    }
  }
  return $this;
}

}