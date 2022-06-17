<?php

include_once "./api/base.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投票管理中心</title>
    <!--使用拆分css檔案的方式來區分共用的css設定及前後台不同的css-->
    <link rel="stylesheet" href="./css/basic.css">
    <link rel="stylesheet" href="./css/back.css">
</head>
<body>
<div id="header">
    <?php include "./layout/header.php";
          include "./layout/back_nav.php";
    ?>
</div>
<div id="container">
<?php
//根據網址有沒有帶do這個參數來決定要include那個外部檔案
if(isset($_GET['do'])){
    $file="./back/".$_GET['do'].".php";
}

//判斷$file變數是否存在及$file所代表的檔案位置是否存在
if(isset($file) && file_exists($file)){
    include $file;
}else{
?>
    <button class="btn btn-primary" onclick="location.href='?do=add_vote'">新增投票</button>
    
    <div>
        <ul>
            <li class='list-header'>
                <div>投票主題</div>
                <div>單/複選題</div>
                <div>投票期間</div>
                <div>剩餘天數</div>
                <div>投票人數</div>
                <div>操作</div>
            </li>
        <?php
            //使用all()函式來取得資料表subjects中的所有資料，請參考base.php中的函式all($table,...$arg)
            $subjects=all('subjects');

            //使用迴圈將每一筆資料的內容顯示在畫面上
            foreach($subjects as $subject){
                echo "<li class='list-items'>";
                echo "<div>{$subject['subject']}</div>";
                if($subject['multiple']==0){
                    echo "<div class='text-center'>單選題</div>";
                }else{
                    echo "<div class='text-center'>複選題</div>";
                }
                echo "<div class='text-center'>";
                echo $subject['start']. " ~ ".$subject['end'];
                echo "</div>";
                echo "<div class='text-center'>";
                    $today=strtotime("now");
                    $end=strtotime($subject['end']);
                    if(($end-$today)>0){
                        $remain=floor(($end-$today)/(60*60*24));
                        echo "倒數".$remain."天結束";
                    }else{
                        echo "<span style='color:grey'>投票已結束</span>";
                    }
                
                echo "</div>";
                echo "<div class='text-center'>{$subject['total']}</div>";
                echo "<div class='text-center'>";
                echo "<a class='edit' href='?do=edit&id={$subject['id']}'>編輯</a>";
                echo "<a class='del' href='?do=del&id={$subject['id']}'>刪除</a>";
                echo "</div>";
                echo "</li>";
            }

        ?>
        </ul>

    </div>
<?php
}
?>
</div>



<div>
    <?php include "./layout/footer.php";?>
</div> 
</body>
</html>