<?php
//載入共用函式庫檔案
include_once "base.php";

//建議先檢查一下分類名稱是否有重覆
save('types',['name'=>$_POST['name']]);

//完成新增後將頁面請求導回後台首頁
header("location:../back.php");
?>