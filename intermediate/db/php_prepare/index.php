<?php
//連線資料庫
include("setup.php");
$sql_query="SELECT * FROM `students` WHERE 1";
$stmt = $db_link->prepare($sql_query);

// 計算總筆數 方法1.
$stmt->execute();
$total_records = count($stmt->fetchAll());
// 方法1.結束

$stmt->execute();

// 計算總筆數 方法2. 3. 適用僅查詢筆數
// 計算總筆數 方法2.
$sql_query2="SELECT count(*) FROM `students` WHERE 1";
$stmt2 = $db_link->prepare($sql_query2);
$stmt2->execute();
$total_records2 = ($stmt2->fetch())[0];
// 方法2.結束

// 計算總筆數 方法3.(效能最好) 沿用方法2.sql
$stmt2->execute();
$total_records3 = $stmt2->fetchColumn();
// 方法3.結束
?>
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
        p {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>PHP連線資料庫</h1>
    <h3><button><a href="add.php">新增學生資料</a></button></h3>
    <h3><form action="add.php" method="get"><button>新增學生資料</button></form></h3>
    <h3><button onclick="location.href='add.php'">新增學生資料</button></h3>
    <p><a href="index_page.php">分頁版</a></p>
    <p>目前資料筆數：方法1=<?php echo $total_records;?> | 方法2=<?php echo $total_records2;?> | 方法3=<?php echo $total_records3;?></a></p>
    <table>
    <tr>
        <td>序號</td>
        <td>學號</td>
        <td>學生姓名</td>
        <td>科系</td>
        <td>父母</td>
        <td>畢業國中</td>
        <td>操作</td>
    </tr>
    <?php
    if($total_records){
        while($row=$stmt->fetch()){
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['uni_id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['major']}</td>";
            echo "<td>{$row['parent']}</td>";
            echo "<td>{$row['secondary']}</td>";
            echo "<td>";
            echo "<button><a href='edit.php?id={$row['id']}'>編輯</a></button>";
            echo "<button><a href='del.php?id={$row['id']}'>刪除</a></button>";
            echo "</td>";
            echo "</tr>";
        }
        // $row_result=$stmt->fetchAll();
        // echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
	    // foreach($row_result as $item=>$row){
        //     echo "<tr>";
        //     echo "<td>{$row['id']}</td>";
        //     echo "<td>{$row['uni_id']}</td>";
        //     echo "<td>{$row['name']}</td>";
        //     echo "<td>{$row['major']}</td>";
        //     echo "<td>{$row['parent']}</td>";
        //     echo "<td>{$row['secondary']}</td>";
        //     echo "<td>";
        //     echo "<button><a href='edit.php?id={$row['id']}'>編輯</a></button>";
        //     echo "<button><a href='del.php?id={$row['id']}'>刪除</a></button>";
        //     echo "</td>";
        //     echo "</tr>";
        // }
    }
    ?>
    </table>
</body>

</html>