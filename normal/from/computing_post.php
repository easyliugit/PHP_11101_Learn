<?php


$height=$_POST['height'];
$weight=$_POST['weight'];

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



header("location:result_post.php?bmi=$bmi&result=$result");
?>