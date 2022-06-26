<?php
//連線資料庫
include("setup.php");

//預設每頁筆數
$pageRow_records = 3;
//預設頁數
$num_pages = 1;
//若已經有翻頁，將頁數更新
if (isset($_GET['page'])) {
  $num_pages = $_GET['page'];
}
//本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
$startRow_records = ($num_pages -1) * $pageRow_records;

$sql_query="SELECT * FROM students";
//加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
$sql_query_limit = $sql_query." LIMIT {$startRow_records}, {$pageRow_records}";
//以加上限制顯示筆數的SQL敘述句查詢資料到 $stmt 中
$stmt = $db_link->prepare($sql_query_limit);
$stmt->execute();
//以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_stmt 中
$all_stmt = $db_link->prepare($sql_query);
$all_stmt->execute();
//計算總筆數
$total_records = $all_stmt->rowCount();
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records);
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
    <p>目前資料筆數：<?php echo $total_records;?> | <a href="index.php">不分頁</a></p>
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
    }
    ?>
    </table>
    <p>
        <?php if ($num_pages > 1) { // 若不是第一頁則顯示 ?>
            <a href="index_page.php?page=1">第一頁</a> | 
            <a href="index_page.php?page=<?php echo $num_pages-1;?>">上一頁</a>
        <?php } ?>
        <?php if ($num_pages < $total_pages) { // 若不是最後一頁則顯示 ?>
            <a href="index_page.php?page=<?php echo $num_pages+1;?>">下一頁</a> | 
            <a href="index_page.php?page=<?php echo $total_pages;?>">最後頁</a>
        <?php } ?>
    </p>
    <p>
    頁數：
  	  <?php
  	  for($i=1;$i<=$total_pages;$i++){
  	  	  if($i==$num_pages){
  	  	  	  echo $i." ";
  	  	  }else{
  	  	      echo "<a href=\"index_page.php?page={$i}\">{$i}</a> ";
  	  	  }
  	  }
  	  ?>
    </p>
</body>

</html>