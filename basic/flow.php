<h1>流程結構</h1>
<h3>if....else</h3>
<?php
$score = 25;
echo "成績=" . $score;
echo "<br>";
if ($score >= 60) {

    if ($score >= 85) {
        echo "及格，而且很棒";
    } else {
        echo "及格，還可以再更進步";
    }
} else {
    if ($score >= 30) {

        echo "不及格,再多加油";
    } else {
        echo "不及格,重新開始";
    }
}

if ($score >= 85) {

    echo "及格，而且很棒";
} else if ($score >= 60) {

    echo "及格，還可以再更進步";
} else if ($score >= 30) {

    echo "不及格,再多加油";
} else {

    echo "不及格,重新開始";
}

?>

<h3>switch...case</h3>
<?php
$score = 500;
$level = ($score > 100 || $score < 0) ? 5 : floor($score / 25);

/* if($score>100 || $score<0){
    $level=5;
}else{
    $level=floor($score/25);
} */
echo $level;
/* if($score >= 85){
    $level='A';
}else if($score>=60){
    $level='B';
}else if($score>=30){
    $level='C';
}else{
    $level='D';
} */

switch ($level) {
    case 4: //100~
    case 3: //75~99
        echo "表現優良，請繼續保持";
        break;
    case 2: //50~74
        echo "值得肯定，還有進步空間";
        break;
    case 1: //25~49
        echo "需要更多的練習";
        break;
    case 0:  //0~24
        echo "需要加強基本功";
        break;
    default:
        echo "成績不合理(0~100)，請重新輸入";
}

?>

<h3>閏年的判斷</h3>
<?php
$year = 1600;
echo '年=>' . $year . "<br>";

if((($year % 4 == 0) && ($year % 100 !=0 )) || ($year%400 == 0)){
    echo "這是閏年";
}else{
    echo "這是平年";
}

/* if ($year % 4 != 0) {
    echo "這是平年";
} else if($year % 100 !=0 ){
    echo "這是閏年";
} else if($year%400 != 0) {
    echo "這是平年";
}else{
    echo "這是閏年";
}  */       

?>