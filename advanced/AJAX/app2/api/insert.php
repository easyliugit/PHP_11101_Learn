<?php
//處理新增資料的請求

$dsn="mysql:host=localhost;charset=utf8;dbname=students";
$pdo=new PDO($dsn,'root','');
$sql="insert into students (`classroom`,`seat_num`,`name`,`birthday`) 
                  values('{$_POST['classroom']}',
                         '{$_POST['seatnum']}',
                         '{$_POST['name']}',
                         '{$_POST['birthday']}')";
echo $pdo->exec($sql);

?>