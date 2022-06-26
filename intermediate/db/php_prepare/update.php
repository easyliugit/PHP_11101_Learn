<?php

$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','admin');

$sql="UPDATE `students` SET 
             `uni_id`='{$_POST['uni_id']}',
             `seat_num`='{$_POST['seat_num']}',
             `name`='{$_POST['name']}',
             `birthday`='{$_POST['birthday']}',
             `national_id`='{$_POST['national_id']}',
             `address`='{$_POST['address']}',
             `parent`='{$_POST['parent']}',
             `telphone`='{$_POST['telphone']}',
             `major`='{$_POST['major']}',
             `secondary`='{$_POST['secondary']}'
      WHERE `id`='{$_POST['id']}'";

      echo $sql;

//$pdo->query($sql);
$pdo->exec($sql);
header("location:index.php");
?>