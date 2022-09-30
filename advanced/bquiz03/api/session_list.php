<?php
include_once "../base.php";
$session=['1'=>"14:00~16:00",
          '2'=>"16:00~18:00",
          '3'=>"18:00~20:00",
          '4'=>"20:00~22:00",
          '5'=>"22:00~24:00"];

$movieId=$_POST['movie'];
$movie=$Movie->find($movieId);
$date=$_POST['date'];

$now=ceil((24-date("H"))/2);
$now=((6-$now)<=0)?0:(6-$now);

for($i=($now+1);$i<=5;$i++){
    $qt=20-$Order->math('sum','qt',['movie'=>"{$movie['name']}",'date'=>"{$date}",'session'=>"{$session[$i]}"]);

    echo "<option value='{$i}'><span>{$session[$i]}</span> 剩餘座位($qt)</option>";
}
