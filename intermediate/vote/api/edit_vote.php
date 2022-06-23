<?php
//引入base.php
include_once "base.php";


//接收來自表單傳來的投票主題id
$subject_id=$_POST['subject_id'];

//接收來自表單傳來的主題內容
$new_subject=$_POST['subject'];

//從資料表中取得原本的主題資料
$subject=find('subjects',$subject_id);

//將資料表中的主題內容更換成表單傳過來的新主題內容
$subject['subject']=$new_subject;

//同上,更新單複選欄位
$subject['multiple']=$_POST['multiple'];

//同上,更新分類項目
$subject['type_id']=$_POST['types'];

//使用save()函式把投票主題存至資料表subjects中
save('subjects',$subject);

//根據主題id來取得所有的選項資料
$opts=all("options",['subject_id'=>$subject_id]);

    //使用迴圈來更新選項資料
    foreach($_POST['option'] as $key => $opt){
         $exist=false;
        
        //使用迴圈來找出相同id的資料表中資料
        foreach($opts as $ot){
            if($ot['id']==$key){
                $exist=true;
                break;
            }
        }

        //如果表單傳來的選項資料在資料表中存在則為更新資料,否則為新增資料
        if($exist){
            //更新選項
            $ot['option']=$opt;
            save("options",$ot);
        }else{
            //新增選項
            $add_option=[
                'option'=>$opt,
                'subject_id'=>$subject_id
            ];
            save("options",$add_option);
        }
    }


//使用to()函式來取代header，請參考base.php中的函式to($url)
to('../back.php');
?>