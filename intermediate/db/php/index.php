<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP連線資料庫的方式</title>
    <style>
        h1,
        h2,
        h3,
        h4 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            border: 3px solid blue;
            margin: auto;
        }

        table td {
            padding: 0.5rem;
            border: 1px solid #aaa;
        }

        table tr:nth-child(odd) {
            background: lightgreen;
        }

        table tr:nth-child(even) {
            background: lightcyan;
        }

        table tr:hover {
            background: lightcoral;
        }
    </style>
</head>

<body>
    <h1>PHP連線資料庫</h1>
    <?php
    $dsn = "mysql:host=localhost;charset=utf8;dbname=school2";
    $pdo = new PDO($dsn, 'root', 'admin');

    $sql="SELECT `students`.*,`dept`.`code`,`dept`.`name` as '科系' FROM `students`,`dept` WHERE `dept`.`id`=`students`.`dept`";
    
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    // echo "<table>";
    // foreach ($rows as $row) {
    //     echo "<tr>";
    //     echo "<td>{$row['id']}</td>";
    //     echo "<td>{$row['school_num']}</td>";
    //     echo "<td>{$row['name']}</td>";
    //     echo "<td>{$row['科系']}</td>";
    //     echo "<td>{$row['parents']}</td>";
    //     echo "</tr>";
    // }
    // echo "</table>";
    echo "<table>";
    foreach($rows as $key => $row){
        echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['school_num']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['科系']}</td>";
            echo "<td>{$row['parents']}</td>";
        echo "</tr>";
    }
    ?>
</body>

</html>