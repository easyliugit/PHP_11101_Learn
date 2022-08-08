<button onclick="location.href='?do=add_movie'">新增電影</button>
<hr>
<div style="overflow:scroll;height:430px;">
<?php
$rows=$Movie->all(" order by rank");
foreach($rows as $key => $row){
?>
    <div style="background:#eee;width:99%;height:140px;margin:2px 0;display:flex;">
        <div style="width:15%">
            <img src="./upload/<?=$row['poster'];?>" style="height:130px;">
        </div>
        <div style="width:15%">
            分級:<img src="./icon/<?=$Level[$row['level']];?>" alt="">
        </div>
        <div style="width:70%">
            <div style="display:flex">
                <div style="width:33.33%">片名:<?=$row['name'];?></div>
                <div style="width:33.33%">片長:<?=$row['length'];?></div>
                <div style="width:33.33%">上映時間:<?=$row['ondate'];?></div>
            </div>
            <div>
                <button>顯示</button>
                <button>往上</button>
                <button>往下</button>
                <button>編輯電影</button>
                <button>刪除電影</button>
            </div>
            <div>
                劇情介紹:<?=$row['intro'];?>
            </div>
        </div>
    </div>
<?php
}
?>    
</div>
<script>


</script>