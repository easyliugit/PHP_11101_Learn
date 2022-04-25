<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>跨年或已過生日的時間差分問題討論</title>
</head>

<body>
    <a href="../index.php">回首頁index.php</a> > <a href="index.php">[基礎課程] Lesson 5 時間及日期處理</a><br>
    <a href="pra01.php">日期時間練習pra01.php</a><br>
    <a href="pra02.php">給定兩個日期，計算中間間隔天數pra02.php</a><br>
    <a href="pra03.php">計算距離自己下一次生日還有幾天字串組合pra03.php</a><br>
    <a href="pra03_1.php">跨年或已過生日的時間差分問題討論pra03_1.php</a><br>
    <a href="pra04.php">時間格式練習pra04.php</a><br>
    <a href="pra05.php">使用程式控制時間pra05.php</a><br>
    <h1>跨年或已過生日的時間差分問題討論</h1>
    <?php
    $birthday="03-02";
    echo "你的生日是".$birthday."<br>";
    //$now=strtotime('now');
    $today=strtotime(date("Y-m-d"));
    $mybirth=strtotime(date("Y-").$birthday);
    
    
    echo "<hr>";
    echo "today 秒數".$today."<br>";
    echo "mybirth 秒數".$mybirth."<br>";
    echo  $today-$mybirth;
    $diff2=$today-$mybirth;
    echo  "<br>";
    echo $diff2/60;
    echo  "<br>";
    echo $diff2/(60*60);
    echo  "<br>";
    echo $diff2/(60*60*24);
    echo "<hr>";
    
    
    $diff=0;
    $result="";
    if($mybirth-$today>0){
        $diff=ceil(($mybirth-$today)/(24*60*60));
    
        $result="距離你的生日還有<span style='color:red'>".$diff."</span>天";
    
    }else if($mybirth-$today<0){
        $mybirth=strtotime("+1 year",$mybirth);
        $diff=ceil(($mybirth-$today)/(24*60*60));
    
        $result="距離你的生日還有<span style='color:red'>".$diff."</span>天";
    
    }else{
    
        $result="今天是你的生日，祝你生日快樂";
    }
    
    echo $result;
    ?>
</body>

</html>