<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>給定兩個日期，計算中間間隔天數</title>
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
    <a href="pra07.php">我的萬年曆pra07.php</a><br>
    <h1>給定兩個日期，計算中間間隔天數</h1>
    <?php
    $day1 = "2022-4-10";
    $day2 = "2022-4-20";
    echo "星期一=>" . $day1 . "<br>";
    echo "星期二=>" . $day2 . "<br>";

    $time1 = strtotime($day1); //strtotime(“+1 days”,$date_string)
    $time2 = strtotime($day2);

    echo $time1;
    echo "<br>";
    echo $time2;
    $gap = ($time2 - $time1 - (24 * 60 * 60));
    $gap = $gap / (60 * 60 * 24);


    $duration = ($time2 - $time1 + (24 * 60 * 60));
    $duration = $duration / (60 * 60 * 24);

    $diff = ($time2 - $time1);
    $diff = $diff / (60 * 60 * 24);
    echo "<hr>";
    echo "中間間隔 " . $gap . " 天<br>";
    echo "經過了 " . $duration . " 天<br>";
    echo "相差了 " . $diff . " 天<br>";
    ?>
</body>

</html>