<?php
/* echo "POST陣列的內容";
print_r($_POST);
echo "<BR>";
echo "get陣列的內容";
print_r($_GET); */

if(!empty($_GET) || !empty($_POST)){
    if(empty($_GET)){ //判斷$_GET是否為空,如果為空表示為POST的方式傳送
        $height=$_POST['height'];
        $weight=$_POST['weight'];
    }else{
        $height=$_GET['height'];
        $weight=$_GET['weight'];
    };


$bmi=round($weight/(($height/100)*($height/100)),1);

$result='';

if($bmi >= 27 ){
    $result= "肥胖";
}else if($bmi >= 24 && $bmi < 27){
    $result= "過重";
}else if($bmi >= 18.5 && $bmi < 24){
    $result= "健康";
}else if($bmi < 18.5){
    $result= "過輕";
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI計算</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php
if(empty($_GET)  && empty($_POST)){
?>
    <div id="wrapper">
        <header>
            <p>BMI計算</p>
        </header>
        <div id="content">
            <form action="bmi_single-bmi.php" method="post">
                <div class="form-group">
                    <input class="form-control" placeholder="身高" name="height" type="number">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="體重" name="weight" type="number">
                </div>
                <button type="submit" class="btn"> 計算BMI</button>
            </form>
        </div>
    </div>
    <?php
}else{

?>
    <h1 style="font-size:3rem;text-align:center">
你的BMI值為:<?=$bmi;?>

</h1>
<h2 style="text-align:center">判定結果為:<?=$result;?></h2>

<div style="text-align:center">

    <a href="bmi_single-bmi.php"><button>回到BMI計算</button></a>
</div>

<?php
}
?>
</body>
</html>