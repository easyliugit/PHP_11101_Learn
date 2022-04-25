<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>日期時間練習</title>
</head>

<body>
    <a href="../index.php">回首頁index.php</a> > <a href="index.php">[基礎課程] Lesson 5 時間及日期處理</a><br>
    <a href="pra01.php">日期時間練習pra01.php</a><br>
    <a href="pra02.php">給定兩個日期，計算中間間隔天數pra02.php</a><br>
    <a href="pra03.php">計算距離自己下一次生日還有幾天字串組合pra03.php</a><br>
    <a href="pra03_1.php">跨年或已過生日的時間差分問題討論pra03_1.php</a><br>
    <h1>日期時間練習</h1>
    <h3>未設定時區</h3>
    <?php

    echo date("Y-m-d H:i:s"); //date(“Y-m-d”,$time)
    echo "<hr>";
    ?>
    <h3>有設定時區(Asia/Taipei)</h3>
    <?php
    date_default_timezone_set("Asia/Taipei");
    echo date("Y-n-d H:i:s");
    echo "<br>";
    echo date("Y 年 n 月 d 日 H 點 i 分 s 秒");
    ?>

    <h2>strtotime()</h2>
    <?php
    //時間日期字串格式 yyyy-mm-dd hh:mm:ss 
    $time = "2021-10-01 10:12:30";
    $s = strtotime($time);
    echo $time;
    echo "<br>";
    echo $s;
    echo "<br>";
    echo date("西元 Y 年 m 月 d 日 l ", $s);
    echo "<br>";
    $splus = strtotime("+2 days", $s);
    echo "<br>";
    echo date("西元 Y 年 m 月 d 日 l ", $splus);
    $splus = strtotime("+1 month", $s);
    echo "<br>";
    echo date("西元 Y 年 m 月 d 日 l ", $splus);
    $splus = strtotime("-1 month", $s);
    echo "<br>";
    echo date("西元 Y 年 m 月 d 日 l ", $splus);
    $splus = strtotime("+1 week", $s);
    echo "<br>";
    echo date("西元 Y 年 m 月 d 日 l ", $splus);
    ?>
</body>

</html>