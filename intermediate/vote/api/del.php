<?php

//載入共用的函式庫檔案
include_once "base.php";

//從網址取得要刪除的資料表名稱
$table=$_GET['table'];

//從網址取得要刪除的資料id
$id=$_GET['id'];

//判斷要刪除的資料是否為主題
if($table=='subjects'){

    //如果要刪除的資料為主題，則連選項也一併刪除
    del($table,$id);
    del('options',['subject_id'=>$id]);
}else{

    //刪除指定資料表及id的資料
    del($table,$id);
}

//將網頁請求導回後台首頁
to("../back.php");
?>