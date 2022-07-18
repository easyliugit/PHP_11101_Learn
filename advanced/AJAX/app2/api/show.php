<?php

$id=$_GET['id'];
$sql="select * from students where id='$id'";
$dsn="mysql:host=localhost;charset=utf8;dbname=students";
$pdo=new PDO($dsn,'root','');

$student=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

echo json_encode($student);

?>