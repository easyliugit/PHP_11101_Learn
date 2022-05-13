<h2>建立學生成績陣列</h2>
<?php
$a=['a'=>10,
    'b'=>20];


?>
<h2>利用程式來產生陣列-九九乘法表</h2>
<?php

$nine=[];

for($i=1;$i<=9;$i++){

    for($j=1;$j<=9;$j++){

        $nine[]="$i x $j = " . ($i*$j);
    }

}

/* echo "<pre>";
print_r($nine);
echo "</pre>"; */

for($i=0;$i<count($nine);$i++){
    echo $nine[$i]."&nbsp;&nbsp;";
    if($i%9==8){
        echo "<br>";
    }
}


?>
<h2>利用程式來產生陣列-九九乘法表-2</h2>
<?php

$nine=[];

for($i=1;$i<=9;$i++){

    for($j=1;$j<=9;$j++){

        $nine["{$i}x{$j}"]=$i*$j;
    }

}

echo "<pre>";
print_r($nine);
echo "</pre>";
$i=7;
$j=7;
echo "$i x $j =";
echo $nine["{$i}x{$j}"];
?>

<h2>威力彩號</h2>
<?php
echo "<h3>第一區</h3>";
$lotto=[];
while(count($lotto)<6){
    $num=rand(1,38);
    if(!in_array($num, $lotto)){
        $lotto[]=$num;
    }
}
echo "開出順序:";
for($i=0;$i<count($lotto);$i++){
    echo  $lotto[$i].",";
}
echo "<br>大小順序:";
sort($lotto);
for($i=0;$i<count($lotto);$i++){
    echo  $lotto[$i].",";
}
echo "<h3>第二區</h3>";
echo rand(1,8);



?>

<h2>五百年內的閏年</h2>
<?php
$leapYear=[];
$start=2022;
$end=$start+500;
for($year=$start;$year<=$end;$year++){
    if((($year % 4 == 0) && ($year % 100 !=0 )) || ($year%400 == 0)){
        $leapYear[]=$year;
    }
}
/* echo "<pre>";
print_r($leapYear);
echo "</pre>";  */

$leap=2100;
if(in_array($leap,$leapYear)){
    echo $leap . '年是閏年';
}else{
    echo $leap . '年 不是閏年';

}

?>

<h2>求天干地支年</h2>
<pre>
天干：甲乙丙丁戊己庚辛壬癸
地支：子丑寅卯辰巳午未申酉戌亥
天干地支配對：甲子、乙丑、丙寅….甲戌、乙亥、丙子….
</pre>

<?php
$sky=['甲', '乙', '丙', '丁', '戊', '己', '庚', '辛', '壬', '癸'];
$land=['子', '丑', '寅', '卯', '辰', '巳', '午', '未', '申', '酉', '戌', '亥'];

$skyland=[];

for($i=0;$i<count($sky);$i++){
    
    for($j=0;$j<count($land);$j++){
    
        $skyland[]=$sky[$i].$land[$j];

    }
    
}

/* echo "<pre>";
print_r($skyland);
echo "</pre>"; */

$skyland2=[];
$year=(2022-1024);

echo $sky[$year%10] . $land[$year%12];

for($i=1024;$i<=2048;$i++){
    $year=$i-1024;
    $skyland2[$i]=$sky[$year%10] . $land[$year%12];
}

/* echo "<pre>";
print_r($skyland2);
echo "</pre>"; */


echo "西元2022年是 [".$skyland2[2022]."] 年";
?>

<h2>陣列反轉</h2>
<pre>
請設計一支程式，在不產生新陣列的狀況下，將一個陣列的元素順序反轉(利用迴圈)

例：$a=[2,4,6,1,8,9]    反轉後    $a=[8,1,6,4,2]   
</pre>
<?php


?>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>