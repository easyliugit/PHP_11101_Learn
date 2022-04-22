<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>字串取代</title>
</head>

<body>
    <a href="../index.php">回首頁index.php</a><br>
    <h1>字串取代</h1>
    <article>
        <h3>字串取代</h3>
        <div>aaddw1123”改成”*********</div>
    </article>
    <?php
    $password = "aadd";
    //str_replace() 
    //$password=str_replace("a","*",$password);
    $strlen = mb_strlen($password);
    $password = str_repeat("*", $strlen);
    echo $password;
    ?>
</body>

</html>