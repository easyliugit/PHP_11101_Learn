<?php
include_once "connect.php";

$sql="UPDATE `users` 
      SET  `pw`='{$_POST['pw']}', 
           `birthday`='{$_POST['birthday']}', 
           `passnote`='{$_POST['passnote']}',
           `email`='{$_POST['email']}' 
      WHERE  `id`='{$_POST['id']}'";

$pdo->exec($sql);

header('location:member_center.php');

?>