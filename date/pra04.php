<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>時間格式練習</title>
</head>

<body>
    <a href="../index.php">回首頁index.php</a> > <a href="index.php">[基礎課程] Lesson 5 時間及日期處理</a><br>
    <a href="pra01.php">日期時間練習pra01.php</a><br>
    <a href="pra02.php">給定兩個日期，計算中間間隔天數pra02.php</a><br>
    <a href="pra03.php">計算距離自己下一次生日還有幾天字串組合pra03.php</a><br>
    <a href="pra03_1.php">跨年或已過生日的時間差分問題討論pra03_1.php</a><br>
    <a href="pra04.php">時間格式練習pra04.php</a><br>
    <a href="pra05.php">使用程式控制時間pra05.php</a><br>
    <a href="pra06.php">線上月曆製作pra06.php</a><br>
    <a href="pra06_array.php">線上月曆製作_使用陣列pra06_array.php</a><br>
    <a href="pra06_flex.php">線上月曆製作_使用陣列Flexpra06_flex.php</a><br>
    <h1>時間格式練習</h1>
    <?php date_default_timezone_set("Asia/Taipei") ?>
    <?= date("Y/m/d"); ?>
    <hr>
    <?= date("n月j日 l"); ?>
    <hr>
    <?= date("Y-n-j G:") . (int)date("i") . ":" . (int)date("s"); ?>
    <hr>
    <?= date("Y-n-j G:") . (int)date("i") . ":" . (int)date("s"); ?>
    <hr>
    <?php

    $workday = "";
    $w = date("w");
    if ($w == 0 || $w == 6) {
        $workday = "假日";
    } else {
        $workday = "工作日";
    }
    echo date("今天是西元Y年n月j日 ") . $workday;
    ?>
    <hr>
</body>

</html>