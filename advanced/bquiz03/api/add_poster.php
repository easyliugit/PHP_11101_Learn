<?php
include_once "../base.php";

if(isset($_FILES['img']['tmp_name'])){
    $poster['img']=$_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'],'../upload/'.$_FILES['img']['name']);
}

$poster['name']=$_POST['name'];
$poster['sh']=1;
$poster['ani']=rand(1,3);
$poster['rank']=$Poster->math('max','id')+1;

$Poster->save($poster);
to("../back.php?do=poster");
?>