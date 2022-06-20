<?php
//引入base.php
include_once "base.php";
//接收來自表單傳來的投票主題文字內容
$subject=$_POST['subject'];

//建立資料陣列，請參考base.php中的函式save($table,$arg)
$add_subject=[
    'subject'=>$subject,
    'type_id'=>$_POST['types'],
    'multiple'=>$_POST['multiple'],
    'start'=>date("Y-m-d"),
    'end'=>date("Y-m-d",strtotime("+10 days")),
];

//使用save()函式把投票主題存至資料表subjects中
save('subjects',$add_subject);

//利用剛才存入的投票主題文字來找出該筆資料並取得id，請參考base.php中的函式find($table,$id)
$id=find('subjects',['subject'=>$subject])['id'];

//判斷表單資料有沒有option這個項目，如果有，則使用迴圈把選項一個一個取出
if(isset($_POST['option'])){
    foreach($_POST['option'] as $opt){
        if($opt!=""){
            //如果選項的文字內容不是空的 ,則建立資料陣列,並將主題對應的id代入
            $add_option=[
                'option'=>$opt,
                'subject_id'=>$id
            ];

            //使用save()函式把投票選項存至資料表options中
            save("options",$add_option);
        }
    }
}

//使用to()函式來取代header，請參考base.php中的函式to($url)
to('../back.php');
?>