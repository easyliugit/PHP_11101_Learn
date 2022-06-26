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
    <?php

        $id=$_GET['id'];
        $dsn="mysql:host=localhost;charset=utf8;dbname=school";
        $pdo=new PDO($dsn,'root','admin');
        $sql="SELECT * FROM `students` WHERE `id`='$id'";
        $student=$pdo->query($sql)->fetch();

    ?>
    <form action="update.php" method="post">
    <label for="">學號：<input type="text" name="uni_id" value="<?=$student['uni_id'];?>"></label>
        <label for="">班級座號：<input type="text" name="seat_num" value="<?=$student['seat_num'];?>"></label>
        <label for="">姓名：<input type="text" name="name" value="<?=$student['name'];?>"></label>
        <label for="">生日<input type="text" name="birthday" value="<?=$student['birthday'];?>"></label>
        <label for="">身分證號碼<input type="text" name="national_id" value="<?=$student['national_id'];?>"></label>
        <label for="">住址<input type="text" name="address" value="<?=$student['address'];?>"></label>
        <label for="">家長<input type="text" name="parent" value="<?=$student['parent'];?>"></label>
        <label for="">電話<input type="text" name="telphone" value="<?=$student['telphone'];?>"></label>
        <label for="">科別<input type="text" name="major" value="<?=$student['major'];?>"></label>
        <label for="">畢業國中<input type="text" name="secondary" value="<?=$student['secondary'];?>"></label>
        <input type="hidden" name="id" value="<?=$id;?>">
        <input type="submit" value="更新">
        <input type="reset" value="重置">
    </form>
</body>
</html>