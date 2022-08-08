<?php

include_once "../base.php";

$table=$_POST['table'];
$DB=new DB($table);
$ids=$_POST['id'];

$row0=$DB->find($ids[0]);
$row1=$DB->find($ids[1]);

$rank=$row0['rank'];

$row0['rank']=$row1['rank'];
$row1['rank']=$rank;

$DB->save($row0);
$DB->save($row1);