<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>子字串取用</title>
</head>

<body>
    <a href="../index.php">回首頁index.php</a><br>
    <h1>子字串取用</h1>
    <article>
        <h3>將” The reason why a great man is great is that he resolves to be a great man”只取前十字成為” The reason…”</h3>
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