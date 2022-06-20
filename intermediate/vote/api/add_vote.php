<?php
//引入base.php
include_once "base.php";


//接收來自表單傳來的投票主題文字內容
$subject_id=$_POST['subject_id'];
$new_subject=$_POST['subject'];

$subject=find('subjects',$subject_id);

$subject['subject']=$new_subject;
$subject['multiple']=$_POST['multiple'];
$subject['type_id']=$_POST['types'];

//使用save()函式把投票主題存至資料表subjects中
save('subjects',$subject);

$opts=all("options",['subject_id'=>$subject_id]);

    foreach($_POST['option'] as $key => $opt){
         $exist=false;
        foreach($opts as $ot){
            if($ot['id']==$key){
                $exist=true;
                break;
            }
        }

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