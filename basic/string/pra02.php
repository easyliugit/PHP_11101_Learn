<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>字串分割</title>
</head>
<body>
<a href="../index.php">回首頁index.php</a> > <a href="index.php">[基礎課程] Lesson 4 字串處理</a><br>
    <a href="pra01.php">字串取代pra01.php</a><br>
    <a href="pra02.php">字串分割pra02.php</a><br>
    <a href="pra03.php">字串組合pra03.php</a><br>
    <a href="pra04.php">子字串取用pra04.php</a><br>
    <a href="pra05.php">字串函式整合應用pra05.php</a><br>
    <h1>字串分割</h1>
    <article>
        <h3>字串分割</h3>
        <div>將”this,is,a,book”依”,”切割後成為陣列</div>
    </article>
    <?php
    $str="this,is,a,book";
    $array=explode(",",$str);

    echo "<pre>";
    print_r($array);
    echo "</pre?";
    ?>
</body>
</html>