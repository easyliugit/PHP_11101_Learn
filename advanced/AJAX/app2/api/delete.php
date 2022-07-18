<?php
//處理刪除資料的請求

$id=$_POST['id'];
$dsn="mysql:host=localhost;charset=utf8;dbname=students";
$pdo=new PDO($dsn,'root','');
$sql="delete from students where id='$id'";

echo $pdo->exec($sql);
?>