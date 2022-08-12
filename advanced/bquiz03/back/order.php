<h3 class="ct">訂單清單</h3>
<style>
    .header> div,.row > div{
        /* width:14%; */
        width:calc(100% / 7);
        text-align: center;
    }
</style>
<div>
    快速刪除:
    <input type="radio" name="type" value="date">依日期 
    <input type="text" name="date" >
    <input type="radio" name="type" value="movie">依電影
    <select name="movie" >
        <?php
            $opts=$Order->q("select `movie` from `orders` group by `movie`");
            foreach($opts as $opt){
                echo "<option value='{$opt['movie']}'>{$opt['movie']}</option>";
            }


        ?>
    </select>
    <button onclick="qDel()">刪除</button>
</div>
<div class="header" style="display:flex;width:100%">
    <div>訂單編號</div>
    <div>電影名稱</div>
    <div>日期</div>
    <div>場次時間</div>
    <div>訂購數量</div>
    <div>訂購位置</div>
    <div>操作</div>
</div>
<div style="overflow:auto;height:450px">
    <?php
    $orders=$Order->all(' order by `no` desc');
    foreach($orders as $ord){
    ?>
    <div class="row" style="display:flex;align-items:center">
        <div><?=$ord['no'];?></div>
        <div><?=$ord['movie'];?></div>
        <div><?=$ord['date'];?></div>
        <div><?=$ord['session'];?></div>
        <div><?=$ord['qt'];?></div>
        <div><?php
            $seats=unserialize($ord['seats']);
            sort($seats);
            foreach($seats as $seat){
                echo   floor(($seat/5))+1 ."排";
                echo   ($seat%5)+1 ."號";
                echo "<br>";
            }
        ?></div>
        <div>
            <button onclick="del('orders',<?=$ord['id'];?>)">刪除</button>
        </div>
    </div>
    <hr>
    <?php
    }
    ?>
</div>

<script>
    function del(table,id){
    $.post('./api/del.php',{table,id},()=>{
        location.reload();
    })
}

</script>