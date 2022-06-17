<?php
$subject=find("subjects",$_GET['id']);
$opts=all("options",['subject_id'=>$_GET['id']]);
?>
<h1 class="text-center"><?=$subject['subject'];?></h1>
<div style="width:600px;margin:auto">

    <div>總投票數:<?=$subject['total'];?></div>
    <table>
        <tr>
            <td>選項</td>
            <td>投票數</td>
            <td>比例</td>
        </tr>
        <?php 
        foreach($opts as $opt){
            $total=($subject['total']==0)?1:$subject['total'];
        ?>
        <tr>
            <td><?=$opt['option'];?></td>
            <td><?=$opt['total'];?></td>
            <td><?=$opt['total']/$total;?></td>
        </tr>
        <?php 

        }
        ?>
    </table>
    <button onclick="location.href='?do=vote&id=<?=$_GET['id'];?>'">我要投票</button>
</div>