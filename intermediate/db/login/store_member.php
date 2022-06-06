<?php
include_once "connect.php";
$acc=$_POST['acc'];

$sql="INSERT INTO `users` (`acc`,`pw`,`birthday`,`passnote`,`email`) 
                    values('{$_POST['acc']}','{$_POST['pw']}','{$_POST['birthday']}','{$_POST['passnote']}','{$_POST['email']}');";

$pdo->exec($sql);

header('location:login.php');

?>