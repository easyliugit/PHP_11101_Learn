<?php 
include_once "../base.php";


?>

<style>

#block{
    width:540px;
    height:370px;
    padding-top:19px;
    background:url("./icon/03D04.png") no-repeat center;
    margin:auto;
    box-sizing: border-box;
}
.seats{
    width:316px;
    height:340px;
    margin:auto;
    display:flex;
    flex-wrap:wrap;
}
.seat{
    width:20%;
    height:25%;
    text-align: center;
    position: relative;
}

.empty{
    background-image: url('icon/03D02.png');
    background-repeat: no-repeat;
    background-position: center;
}
.checked{
    background-image: url('icon/03D03.png');
    background-repeat: no-repeat;
    background-position: center;
}
.chk{
    position: absolute;
    bottom:0;
    right:0;
}
</style>
<div id="block">
    <div class='seats'>
<?php

for($i=0;$i<20;$i++){
    echo "<div class='seat empty'>";
    echo floor($i/5)+1;
    echo "排";
    echo floor($i%5)+1;
    echo "號";
    echo "<input type='checkbox' name='seat' value='$i' class='chk'>";
    echo "</div>";
}

?>
    </div>
</div>
<div style="width:540px;margin:1rem auto;">
    <div style="width:60%;margin:auto;">
        <div>您選擇的電影是：</div>
        <div>您選擇的時刻是：</div>
        <div>您已經勾選<span id='tickets'></span>張票，最多可以購買四張票</div>
        <div>
            <button onclick="$('#order,#booking').toggle();$('#booking').html('')">上一步</button>
            <button>訂購</button>
        </div>
    </div>
</div>