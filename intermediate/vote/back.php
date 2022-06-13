<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投票管理中心</title>
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
if(isset($_GET['do'])){
    $file="./back/".$_GET['do'].".php";
}
if(isset($file) && file_exists($file)){
    include $file;
}else{
?>
    <button class="btn btn-primary" onclick="location.href='?do=add_vote'">新增投票</button>
    
    <div>投票列表</div>
<?php
}
?>
</div>



<div>
    <?php include "./layout/footer.php";?>
</div> 
</body>
</html>