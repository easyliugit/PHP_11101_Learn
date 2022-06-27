<?php

class R9{

    public function result($a,$b){
        for($i=1;$i<=$a;$i++){
            for($j=1;$j<=$b;$j++){
                echo $i . " x ". $j . " = ".($i*$j) . "<br>";
            }
        } 
    }
}

$r=new R9;
$r->result(5,5);
?>