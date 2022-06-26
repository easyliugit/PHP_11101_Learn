
<?php
//連線資料庫
include("setup.php");
$sql_query="SELECT * FROM `students` WHERE id = ?";
$stmt = $db_link->prepare($sql_query);
$stmt->execute(array($_GET['id']));
$row=$stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯學生資料</title>
    <style>
        label{
            display: block;
            padding: 4px;
        }

        label input{
            padding:3px;
            font-size:1.2rem;
        }
    </style>
</head>
<body>
    <h1>編輯學生資料</h1>
    <form action="update.php" method="post">
    <label for="">學號：<input type="text" name="uni_id" value="<?=$row['uni_id'];?>"></label>
        <label for="">班級座號：<input type="text" name="seat_num" value="<?=$row['seat_num'];?>"></label>
        <label for="">姓名：<input type="text" name="name" value="<?=$row['name'];?>"></label>
        <label for="">生日<input type="text" name="birthday" value="<?=$row['birthday'];?>"></label>
        <label for="">身分證號碼<input type="text" name="national_id" value="<?=$row['national_id'];?>"></label>
        <label for="">住址<input type="text" name="address" value="<?=$row['address'];?>"></label>
        <label for="">家長<input type="text" name="parent" value="<?=$row['parent'];?>"></label>
        <label for="">電話<input type="text" name="telphone" value="<?=$row['telphone'];?>"></label>
        <label for="">科別<input type="text" name="major" value="<?=$row['major'];?>"></label>
        <label for="">畢業國中<input type="text" name="secondary" value="<?=$row['secondary'];?>"></label>
        <input type="hidden" name="id" value="<?=$id;?>">
        <input type="submit" value="更新">
        <input type="reset" value="重置">
    </form>
</body>
</html>