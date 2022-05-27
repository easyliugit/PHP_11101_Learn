<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP連線資料庫的方式</title>
    <style>
        h1 ,h2 ,h3 ,h4{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>PHP連線資料庫</h1>
    <?php
        $dsn = "mysql:host=localhost;charset=utf8;dbname=school2";
        $pdo = new PDO($dsn,'root','admin');

        $sql = "SELECT * FROM `students`,`dept` WHERE `dept`.`id`= `students`.`dept`";

        $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_BOTH); 

        // print_r($rows);

        echo $rows[0][3];
        echo '<br>';
        echo $rows[0]['birthday'];
    ?>
</body>
</html>