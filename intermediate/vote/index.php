<?php include_once "./api/base.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>泰山線上投票中心</title>
    <!--使用拆分css檔案的方式來區分共用的css設定及前後台不同的css-->
    <link rel="stylesheet" href="./css/basic.css">
    <link rel="stylesheet" href="./css/front.css">
</head>
<body>
<div id="header">
    <?php 
          include "./layout/header.php";
          include "./layout/front_nav.php";
    ?>
</div>
<div id="container">
<?php
if(isset($_GET['do'])){
    $file='./front/'.$_GET['do'].".php";
}
if(isset($file) && file_exists($file)){
    include $file;
}else{
    include "./front/vote_list.php";
}
?>
</div>
</div>
<div>
    <?php include "./layout/footer.php";?>
</div>    
</body>
</html>