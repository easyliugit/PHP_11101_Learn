<?php 
include_once "../base.php";
$row=$Movie->find($_POST['id']);

if(!empty($_FILES['trailer']['tmp_name'])){
    $_POST['trailer']=$_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'],'../upload/'.$_FILES['trailer']['name']);
}else{
    $_POST['trailer']=$row['trailer'];
}
if(!empty($_FILES['poster']['tmp_name'])){

    $_POST['poster']=$_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'],'../upload/'.$_FILES['poster']['name']);
}else{
    $_POST['poster']=$row['poster'];
}

$_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
unset($_POST['year'],$_POST['month'],$_POST['day']);
$_POST['sh']=$row['sh'];
$_POST['rank']=$row['rank'];


$Movie->save($_POST);

to("../back.php?do=movie");
?>