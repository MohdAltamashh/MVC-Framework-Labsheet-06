<?php
require __DIR__.'/../config/config.php';require __DIR__.'/../app/core/SecurityHelper.php';SecurityHelper::start();
require __DIR__.'/../app/core/Database.php';require __DIR__.'/../app/core/helpers.php';
spl_autoload_register(function($c){foreach([__DIR__.'/../app/models/'] as $d)if(is_file($d.$c.'.php'))require_once $d.$c.'.php';});
if($_SERVER['REQUEST_METHOD']==='POST'){SecurityHelper::verifyCsrf();$name=trim($_POST['name']??'');$body=trim($_POST['body']??'');if($name===''||$body===''){flash('error','Name and comment are required.');redirect('/');}(new CommentModel())->add($name,$body);flash('success','Comment posted securely.');redirect('/');}
$comments=(new CommentModel())->all();$csrf=SecurityHelper::csrfToken();$title='Secure Comments';require __DIR__.'/../app/views/comments/index.php';
