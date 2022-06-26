<?php

//連線資料庫
include("setup.php");

$sql_query = "UPDATE students SET uni_id=?, seat_num=?, name=?, birthday=?, national_id=?, address=?, parent=?, telphone=?, major=?, secondary=? WHERE id=?";
// $sql_query = "UPDATE students SET uni_id={$_POST["uni_id"]}, seat_num={$_POST["seat_num"]}, name={$_POST["name"]}, birthday={$_POST["birthday"]}, national_id={$_POST["national_id"]}, address={$_POST["address"]}, parent={$_POST["parent"]}, telphone={$_POST["telphone"]}, major={$_POST["major"]}, secondary={$_POST["secondary"]} WHERE id={$_POST["id"]}";
// echo $sql_query."<br>";
$stmt = $db_link -> prepare($sql_query);
$stmt -> execute(array($_POST["uni_id"], $_POST["seat_num"], $_POST["name"], $_POST["birthday"], $_POST["national_id"], $_POST["address"], $_POST["parent"], $_POST["telphone"], $_POST["major"], $_POST["secondary"], $_POST["id"]));
$stmt = null;
$db_link = null;

// $sql="UPDATE `students` SET 
//              `uni_id`='{$_POST['uni_id']}',
//              `seat_num`='{$_POST['seat_num']}',
//              `name`='{$_POST['name']}',
//              `birthday`='{$_POST['birthday']}',
//              `national_id`='{$_POST['national_id']}',
//              `address`='{$_POST['address']}',
//              `parent`='{$_POST['parent']}',
//              `telphone`='{$_POST['telphone']}',
//              `major`='{$_POST['major']}',
//              `secondary`='{$_POST['secondary']}'
//       WHERE `id`='{$_POST['id']}'";

//       echo $sql;

//$pdo->query($sql);
// $pdo->exec($sql);
header("location:index.php");
?>