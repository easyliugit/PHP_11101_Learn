<?php
include_once "base.php";

$subject=$_POST['subject'];
$add_subject=[
    'subject'=>$subject,
    'type_id'=>1,
    'start'=>date("Y-m-d"),
    'end'=>date("Y-m-d",strtotime("+10 days")),
];
save('subjects',$add_subject);
$id=find('subjects',['subject'=>$subject])['id'];

if(isset($_POST['option'])){
    foreach($_POST['option'] as $opt){
        if($opt!=""){
            $add_option=[
                'option'=>$opt,
                'subject_id'=>$id
            ];
            save("options",$add_option);
        }
    }
}

to('../back.php');
?>