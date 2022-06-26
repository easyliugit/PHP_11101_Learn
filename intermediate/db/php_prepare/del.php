<?php
//連線資料庫
include("setup.php");
$sql_query = "DELETE FROM students WHERE id=?";
$stmt = $db_link -> prepare($sql_query);
$stmt -> execute(array($_GET['id']));
$stmt = null;
$db_link = null;


// $id=$_GET['id'];
// $dsn="mysql:host=localhost;charset=utf8;dbname=school";
// $pdo=new PDO($dsn,'root','admin');

// $sql="DELETE FROM `students` WHERE `id`='$id'";

// $pdo->exec($sql);

//重新導向回到主畫面
header("location:index.php");

?>