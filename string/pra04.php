<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>子字串取用</title>
</head>

<body>
<a href="../index.php">回首頁index.php</a> > <a href="index.php">[基礎課程] Lesson 4 字串處理</a><br>
    <a href="pra01.php">字串取代pra01.php</a><br>
    <a href="pra02.php">字串分割pra02.php</a><br>
    <a href="pra03.php">字串組合pra03.php</a><br>
    <a href="pra04.php">子字串取用pra04.php</a><br>
    <a href="pra05.php">字串函式整合應用pra05.php</a><br>
    <h1>子字串取用</h1>
    <article>
        <div>將” The reason why a great man is great is that he resolves to be a great man”只取前十字成為” The reason…”</div>
    </article>
    <?php
    //$str="The reason why a great man is great is that he resolves to be a great man";
    $str = "有12志3者事竟成";
    echo $str;
    echo "<br>";
    //$newStr=substr($str,0,3);
    $newStr = mb_substr($str, 0, 3);
    //$newStr=mb_substr($str,0,10);

    echo $newStr . "...";


    ?>
</body>

</html>