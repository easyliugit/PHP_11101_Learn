<style>
    *{
        font-family:'Courier New', Courier, monospace
    }
</style>
<h1>畫星星</h1>
<h2>直角三角形</h2>
<?php
for($i=0;$i<5;$i++){

    for($j=0;$j<=$i;$j++){

        echo "*";

    }

    echo "<br>";

}

?>
<h2>倒直角三角形</h2>
<?php
for($i=0;$i<5;$i++){

    for($j=5;$j>$i;$j--){

        echo "*";

    }

    echo "<br>";

}

?>
<h2>正三角形</h2>
<?php
for($i=0;$i<6;$i++){
   
    for($k=5;$k>$i;$k--){

        echo "&nbsp;";

    }
    for($j=0;$j<($i*2+1);$j++){

        echo "*";

    }

    echo "<br>";
}

?>
<h2>倒正三角形</h2>
<?php
//上面
for($i=0;$i<6;$i++){
   
    for($k=5;$k>$i;$k--){

        echo "&nbsp;";

    }
    for($j=0;$j<($i*2+1);$j++){

        echo "*";

    }

    echo "<br>";
}

//下面
for($i=0;$i<6;$i++){
   
    for($k=0;$k<=$i;$k++){

        echo "&nbsp;";

    }
    for($j=9;$j>($i*2);$j--){

        echo "*";

    }

    echo "<br>";
}

?>
<h2>菱形</h2>
<?php
//上面
$size=31;
for($i=0;$i<$size;$i++){

    if($i<=(($size-1)/2)){
        //印空白
        for($k=0;$k<(($size-1)/2-$i);$k++){
            echo "&nbsp;";
        }

        //印星星
        for($j=0;$j<($i*2+1);$j++){
            echo "*";
        }
    }else{
        //印空白
        for($k=0;$k<($i-($size-1)/2);$k++){
            echo "&nbsp;";
        }

        //印星星
        for($j=0;$j<(($size-$i)*2-1);$j++){
            echo "*";
        }
    }
    echo "<br>";
}

?>
<h2>菱形程式變化</h2>
<?php
//上面
$size=10;

//先判斷是否為奇數
if($size%2==0){
    $size=$size+1;
}
if($size<3){
    $size=3;
}

for($i=0;$i<$size;$i++){

    if($i<=(($size-1)/2)){
        $space=($size-1)/2-$i;
        $stars=$i*2+1; 
    }else{
        $space=$i-($size-1)/2;
        $stars=($size-$i)*2-1; 
    }

    //印空白
    for($k=0;$k<$space;$k++){
        echo "&nbsp;";
    }

    //印星星
    for($j=0;$j<$stars;$j++){
        echo "*";
    }
    echo "<br>";
}

?>

<h2>矩形</h2>
<?php

$size=20;

for($i=0;$i<$size;$i++){

    for($j=0;$j<$size;$j++){
        if($i==0 || $i==($size-1) || $j==0 || $j==($size-1) || $i==$j || $j==($size-1-$i)){
                echo "*";
        }else{
                echo "&nbsp;";
        }
    }

    echo "<br>";
}