<?php

$id=$_GET['id'];
$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','admin');

$sql="DELETE FROM `students` WHERE `id`='$id'";

$pdo->exec($sql);

header("location:index.php");

?>