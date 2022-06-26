<?php
//連線資料庫
include("setup.php");

$sql_query = "INSERT INTO students (uni_id ,seat_num ,name ,birthday ,national_id ,address ,parent ,telphone ,major ,secondary) VALUES (?, ?, ?, ? ,? ,? ,? ,? ,? ,?)";
$stmt = $db_link -> prepare($sql_query);
$stmt -> execute(array($_POST["uni_id"], $_POST["seat_num"], $_POST["name"], $_POST["birthday"], $_POST["national_id"], $_POST["address"], $_POST["parent"], $_POST["telphone"], $_POST["major"], $_POST["secondary"]));
$stmt = null;
$db_link = null;
//重新導向回到主畫面
header("location:index.php");
?>