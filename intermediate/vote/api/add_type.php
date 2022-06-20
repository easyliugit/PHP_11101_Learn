<?php
include_once "base.php";
//建議先檢一下分類名稱是否有重覆
save('types',['name'=>$_POST['name']]);

header("location:../back.php");
?>