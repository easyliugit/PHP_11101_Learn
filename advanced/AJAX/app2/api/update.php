<?php
//處理更新資料的請求

$dsn="mysql:host=localhost;charset=utf8;dbname=students";
$pdo=new PDO($dsn,'root','');
$sql="update students set `classroom`='{$_POST['classroom']}',
                          `seat_num`='{$_POST['seatnum']}',
                          `name`='{$_POST['name']}',
                          `birthday`='{$_POST['birthday']}' 
                    where id='{$_POST['id']}'";
$pdo->exec($sql);


?>