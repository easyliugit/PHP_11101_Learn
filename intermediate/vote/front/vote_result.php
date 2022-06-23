<?php
//取得主題資料
$subject=find("subjects",$_GET['id']);

//取得主題所屬的所有選項資料
$opts=all("options",['subject_id'=>$_GET['id']]);
?>
                <!--顯示主題文字-->
<h1 class="text-center"><?=$subject['subject'];?></h1>
<div style="width:600px;margin:auto">
    <div>總投票數:<?=$subject['total'];?></div>
    <table class="result-table">
        <tr>
            <td>選項</td>
            <td>投票數</td>
            <td>比例</td>
        </tr>
        <?php 
        foreach($opts as $opt){
            $total=($subject['total']==0)?1:$subject['total'];
            $rate=$opt['total']/$total;
        ?>
        <tr>
            <td><?=$opt['option'];?></td>
            <td><?=$opt['total'];?></td>
            <td>
                                                 <!--利用css屬性來建立一個長條bar，並代入投票比例來計算長度-->
                <div style="display:inline-block;height:24px;background:skyblue;width:<?=300*$rate;?>px;"></div>
                <?=($rate*100) . "%";?>
            </td>
        </tr>
        <?php 

        }
        ?>
    </table>
                                 <!--在按鈕上建立點擊事件並帶入主題id-->
    <button class="btn btn-info" onclick="location.href='?do=vote&id=<?=$_GET['id'];?>'">我要投票</button>
</div>