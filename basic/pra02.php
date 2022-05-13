<style>
    table{
       color: blue;
       border: 1px solid black;
       border-collapse: collapse;
    }
    td{
        border: 1px solid gray;
        padding: 5px 10px;
    }
    .header{
        background-color: lightgreen;
    }
/*     td:nth-child(2n){
        background-color: lightgreen;
    }
    tr:nth-child(2n){
        background-color: lightblue;
    } */
</style>

<h1>九九乘法表大亂鬥</h1>
<?php
echo "<table>";
for($i=1;$i<=9;$i++){
    if($i%2==0){
        echo "<tr style='background:lightblue'>";
    }else{
        echo "<tr>";
    }
 for($j=1;$j<=9;$j++){
        echo "<td";
     if($j%2==0){
         echo " style='background:lightgreen'";
     }
        echo ">";
        echo "{$j}x{$i}=";
        echo $i*$j;
        echo "</td>";
 }
echo "</tr>";
}
echo "</table>";
?>
<hr>
<?php
echo "<table>";
for($i=1;$i<=9;$i++){
        echo "<tr>";
 for($j=1;$j<=9;$j++){
        echo "<td";
     if($i==$j){
         echo " style='background:lightgreen'";
     }
        echo ">";
        echo "{$j}x{$i}=";
        echo $i*$j;
        echo "</td>";
 }
echo "</tr>";
}
echo "</table>";
?>
<hr>
<?php
echo "<table>";
for($i=1;$i<=9;$i++){
        echo "<tr>";
 for($j=1;$j<=$i;$j++){
        echo "<td";
     if($i==$j){
         echo " style='background:lightgreen'";
     }
        echo ">";
        echo "{$j}x{$i}=";
        echo $i*$j;
        echo "</td>";
 }
echo "</tr>";
}
echo "</table>";
?>
<hr>
<?php
echo "<table>";
for($i=0;$i<10;$i++){
        echo "<tr>";
 for($j=0;$j<10;$j++){
     if($i==0){
         echo "<td class='header'>$j</td>";
     }else if($j==0){
        echo "<td class='header'>$i</td>";
     }else{
         echo "<td>";
         echo $i*$j;
         echo "</td>";
     }
 }
echo "</tr>";
}
echo "</table>";
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
