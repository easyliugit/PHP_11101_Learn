<?php
include_once "./api/base.php";

//取得主題資料
$subject=find("subjects",$_GET['id']);

//取得選項資料
$opts=all('options',['subject_id'=>$_GET['id']]);

?>

<h1><?=$subject['subject'];?></h1>
<form action="./api/vote.php" method="post">
<?php
foreach($opts as $opt){
?>
    <div class="vote-item">
        <?php
        //根據主題資料的multiple來決定這邊要顯示的是radio單選按鈕還是checked複選按鈕
         if($subject['multiple']==0){
        ?>
            <input type="radio" name="opt" value="<?=$opt['id'];?>">
        <?php
        }else{
        ?>
            <input type="checkbox" name="opt[]" value="<?=$opt['id'];?>">
        <?php
        }
        ?>
        <?=$opt['option'];?>
    </div>

<?php
}
?>

<input type="submit" value="投票去">
<input type="reset" value="重置">
<input type="button" value="放棄" onclick="location.href='index.php'">
</form>