<?php
include_once "base.php";

$table=$_GET['table'];
$id=$_GET['id'];
if($table=='subjects'){
    del($table,$id);
    del('options',['subject_id'=>$id]);
}else{
    del($table,$id);
}

to("../back.php");
?>