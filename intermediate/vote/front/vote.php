<?php
include_once "./api/base.php";

$subject=find("subjects",$_GET['id']);
$opts=all('options',['subject_id'=>$_GET['id']]);

dd($subject);
dd($opts);

?> 