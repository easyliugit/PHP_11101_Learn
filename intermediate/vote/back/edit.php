<?php

//取得主題id
$id=$_GET['id'];

//從資料表中撈出主題資料
$subj=find('subjects',$id);

//從資料表中撈出該主題的所有選項資料
$opts=all('options',['subject_id'=>$id]);

?>

<form action="../api/edit_vote.php" method="post">
<div>
        <select name="types" id="types">
        <?php
            //取得所有的分類資料
            $types=all("types");

            //使用迴圈顯示所有的分類資料
            foreach($types as $type){
                //根據主題資料中的id來判斷主題所屬的分類
                $selected=($subj['type_id']==$type['id'])?'selected':'';

                //在選單中加上$selected來讓下拉選單可以直接顯示主題的分類
                echo "<option value='{$type['id']}' $selected>";
                echo $type['name'];
                echo "</option>";
            }
            ?>
        </select>
    </div>
    <div>
        <label for="subject">投票主題：</label>
        <input type="text" name="subject" id="subject" value="<?=$subj['subject'];?>">
        <input type="button" value="新增選項" onclick="more()">
        <input type="hidden" name="subject_id" value="<?=$subj['id'];?>">
    </div>
    <div id="selector">
        <input type="radio" name="multiple" value="0" <?=($subj['multiple']==0)?'checked':'';?>>
        <label>單選</label>
        <input type="radio" name="multiple" value="1" <?=($subj['multiple']==1)?'checked':'';?>>
        <label>複選</label>
    </div>
    <div id="options">
        <?php 
        foreach($opts as $opt){
        ?>
        <div>
            <label>選項:</label><input type="text" name="option[<?=$opt['id'];?>]" value="<?=$opt['option'];?>">
        </div>
        <?php 
        }
        ?>
    </div>
    <input type="submit" value="修改">

</form>
<script>
    function more(){
        let opt=`<div><label>選項:</label><input type="text" name="option[]"></div>`;
        let opts=document.getElementById('options').innerHTML;
        opts=opts+opt;
        document.getElementById('options').innerHTML=opts;
    }
</script>