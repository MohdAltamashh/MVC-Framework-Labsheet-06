<?php
class SecurityHelper{
 public static function start():void{if(session_status()!==PHP_SESSION_ACTIVE){session_set_cookie_params(['httponly'=>true,'secure'=>!empty($_SERVER['HTTPS']),'samesite'=>'Lax']);session_start();}}
 public static function csrfToken():string{if(empty($_SESSION['_csrf']))$_SESSION['_csrf']=bin2hex(random_bytes(32));return $_SESSION['_csrf'];}
 public static function verifyCsrf():void{$sent=$_POST['_csrf']??'';$known=$_SESSION['_csrf']??'';if(!$known||!hash_equals($known,$sent)){http_response_code(419);exit('419 - Invalid CSRF token');}}
 public static function e($v):string{return htmlspecialchars((string)$v,ENT_QUOTES|ENT_SUBSTITUTE,'UTF-8');}
 public static function validImage(array $file):bool{if(($file['error']??UPLOAD_ERR_NO_FILE)!==UPLOAD_ERR_OK||$file['size']>2*1024*1024)return false;$mime=(new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);return in_array($mime,['image/jpeg','image/png','image/webp'],true);}
}
