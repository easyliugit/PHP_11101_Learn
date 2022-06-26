<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增學生資料</title>
    <style>
        label{
            padding: 4px;
        }
        label input{
            display: block;
            padding:3px;
            font-size:1.2rem;
        }
    </style>
</head>
<body>
    <form action="store.php" method="post">
        <label for="">學號：</label>
        <input type="text" name="uni_id" id=""><br>
        <label for="">班級座號：</label>
        <input type="text" name="seat_num" id=""><br>
        <label for="">姓名：</label>
        <input type="text" name="name" id=""><br>
        <label for="">生日：</label>
        <input type="text" name="birthday" id=""><br>
        <label for="">身分證號碼：</label>
        <input type="text" name="national_id" id=""><br>
        <label for="">住址：</label>
        <input type="text" name="address" id=""><br>
        <label for="">家長：</label>
        <input type="text" name="parent" id=""><br>
        <label for="">電話：</label>
        <input type="text" name="telphone" id=""><br>
        <label for="">科別：</label>
        <input type="text" name="major" id=""><br>
        <label for="">畢業國中：</label>
        <input type="text" name="secondary" id=""><br>
        <button type="submit">新增</button>
        <button type="reset">重置</button>
    </form>
</body>
</html>