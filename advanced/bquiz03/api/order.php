<?php
include_once "../base.php";
$data=[];
$data['no']=date("Ymd") . sprintf("%04d",($Order->math('max','id')+1));
$data['movie']=$_POST['movieName'];
$data['date']=$_POST['date'];
$data['session']=$_POST['session'];
$data['qt']=count($_POST['seats']);
sort($_POST['seats']);
$data['seats']=serialize($_POST['seats']);
$Order->save($data);

echo $data['no'];
?>