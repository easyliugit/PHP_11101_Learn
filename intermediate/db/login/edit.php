<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯會員資料</title>
</head>
<body>
    <h1>編輯會員資料</h1>
    <?php 
    include_once "connect.php";
    $sql="SELECT * FROM users WHERE id='{$_GET['id']}'";
    $user=$pdo->query($sql)->fetch();
    ?>
<form action="save_member.php" method="post">
    <table>
        <tr>
            <td>帳號</td>
            <td><input type="text" name="acc" value="<?=$user['acc'];?>"></td>
        </tr>
        <tr>
            <td>密碼</td>
            <td><input type="password" name="pw" value="<?=$user['pw'];?>"></td>
        </tr>
        <tr>
            <td>生日</td>
            <td><input type="date" name="birthday" value="<?=$user['birthday'];?>"></td>
        </tr>
        <tr>
            <td>密碼提示</td>
            <td><input type="text" name="passnote" value="<?=$user['passnote'];?>"></td>
        </tr>
        <tr>
            <td>email</td>
            <td><input type="email" name="email" value="<?=$user['email'];?>"></td>
        </tr>
    </table>
    <div>
        <input type="submit" value="編輯"><input type="reset" value="重置">
    </div>
</form>
</body>
</html>