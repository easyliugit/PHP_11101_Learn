<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>字串組合</title>
</head>

<body>
    <a href="../index.php">回首頁index.php</a><br>
    <h1>字串組合</h1>
    <article>
        <h3>字串組合</h3>
        <div>將”this,is,a,book”依”,”切割後成為陣列</div>
        <div>將上例陣列重新組合成“this is a book”</div>
    </article>
    <?php
    $str = "this,is,a,book";

    $array = explode(",", $str);

    echo "<pre>";
    print_r($array);
    echo "</pre>";

    //$newstr=implode(" ",$array);
    $newstr = join(" ", $array);
    echo $newstr;

    ?>
</body>

</html>