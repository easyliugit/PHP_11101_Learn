<?php

include_once "../base.php";

$selectId=$_POST['id'];
$startDate=date("Y-m-d",strtotime("-2 days"));
$today=date("Y-m-d");
$movies=$Movie->all(" Where `sh`='1' && ondate between '$startDate' AND '$today'");

foreach($movies as $movie){
    $selected=($selectId==$movie['id'])?'selected':'';
    echo "<option value='{$movie['id']}' $selected>{$movie['name']}</option>";
}
?>