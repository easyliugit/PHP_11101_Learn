<?php

$default_user='mack';
$default_pw='1234';

$acc=$_POST['acc'];
$pw=$_POST['pw'];

$error='';
if($acc!=$default_user || $pw!=$default_pw){
    $error="帳號或密碼錯誤";
    header("location:login.php?error=$error");
}else{
    session_start();
    $_SESSION['login']=$acc;
    header("location:memcenter.php");

}

?> 