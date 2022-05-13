<h1>迴圈</h1>
<?php

/* for($i=0;$i<10;$i=$i+2){
    echo 'i='.$i.'====> i*10 ='.($i*10)."<br>";
}
echo "<hr>";
for($i=1;$i<=100;$i++){
    // echo "第".$i."次迴圈 => ";
    if($i%2==1){
        echo $i.",";
    }
}
echo "<br>";
for($i=1;$i<=100;$i=$i+2){
    echo $i.",";
    
}
echo "<br>";
for($i=1;$i<=100;$i=$i*2+1){
    echo $i.",";
    
}
 */

?>

<h1>while  / do...while</h1>
<hr>
<?php
$i=200;
while($i<100){

    echo $i;
    $i=$i+1;
}

echo "<hr>";
$i=200;

do{

    echo $i;
    $i=$i+1;

}while($i<100);

?>