<?php
$id=$_GET['id'];
$row=find('subjects',$id);
$opts=all('options',['subject_id'=>$id]);
dd($row);
dd($opts);
?>

編輯<?=$id;?>