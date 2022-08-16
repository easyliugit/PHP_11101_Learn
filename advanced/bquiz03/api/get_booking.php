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
    background-color: yellow;
}
.seat{
    width:20%;
    height:25%;
}
</style>
<div id="block">
    <div class='seats'>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
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