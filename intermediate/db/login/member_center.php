<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員中心</title>
</head>
<body>
<nav><a href="logout.php">登出</a></nav>
    <h1>會員中心</h1>
    <?php include "connect.php";?>
    歡迎<?=$_SESSION['user'];?>,祝你有美好的一天
    <?php 

    $sql="select * from `users` where acc='{$_SESSION['user']}'";
    $user=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    echo "<hr>";
    echo '序號:'.$user['id']."<br>";
    echo '帳號:'.$user['acc']."<br>";
    echo '密碼:**********<br>';
    echo '密碼提示:'.$user['passnote']."<br>";
    echo '生日:'.$user['birthday']."<br>";
    echo 'email:'.$user['email']."<br>";
    ?>
    <button>編輯</button>
</body>
</html>