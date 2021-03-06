<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>字串函式整合應用</title>
</head>

<body>
<a href="../index.php">回首頁index.php</a> > <a href="index.php">[基礎課程] Lesson 4 字串處理</a><br>
    <a href="pra01.php">字串取代pra01.php</a><br>
    <a href="pra02.php">字串分割pra02.php</a><br>
    <a href="pra03.php">字串組合pra03.php</a><br>
    <a href="pra04.php">子字串取用pra04.php</a><br>
    <a href="pra05.php">字串函式整合應用pra05.php</a><br>
    <h1>字串函式整合應用</h1>
    <article>
        <div>給定一個句子，將指定的關鍵字放大
            “學會PHP網頁程式設計，薪水會加倍，工作會好找”
            請將上句中的 “程式設計” 放大字型或變色.</div>
    </article>
    <?php
    $str = "學會PHP網頁程式設計，薪水會加倍，工作會好找";
    echo $str;
    echo "<br>";
    $search = "薪水";
    $pos = mb_strpos($str, $search);
    $head = mb_substr($str, 0, $pos);
    //$tail_len=mb_strlen($str)-mb_strlen(mb_substr($str,0,$pos))-mb_strlen($search);
    $tail = mb_substr($str, $pos + mb_strlen($search));
    $str = $head
        . "<span style='font-size:2rem;color:red'>"
        . $search
        . "</span>"
        . $tail;
    echo $str;
    ?>
</body>

</html>