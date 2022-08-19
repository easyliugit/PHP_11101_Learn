<?php
$order=$Order->find(['no'=>$_GET['no']]);
?>
<style>
    #result td{
        border:1px solid #ccc;
        padding:2px;
    }
</style>

<table id='result' style="width:65%;margin:auto;padding:20px;border:1px solid #999">
    <tr>
        <td colspan="2">感謝您的訂購，您的訂單編號是：<?=$_GET['no'];?></td>
    </tr>
    <tr>
        <td width="120px">電影名稱：</td>
        <td><?=$order['movie'];?></td>
    </tr>
    <tr>
        <td>日期：</td>
        <td><?=$order['date'];?></td>
    </tr>
    <tr>
        <td>場次時間：</td>
        <td><?=$order['session'];?></td>
    </tr>
    <tr>
        <td colspan="2">
            座位：<br>
            <?php
            $seats=unserialize($order['seats']);
            foreach($seats as $seat){
                echo floor($seat/5)+1;
                echo "排";
                echo floor($seat%5)+1;
                echo "號<br>";
            }

            ?>
            <div>共<?=$order['qt'];?>張電影票</div>
        </td>
    </tr>
    <tr>
        <td colspan="2" class='ct'>
            <button onclick="location.href='?'">確認</button>
        </td>
    </tr>
</table>