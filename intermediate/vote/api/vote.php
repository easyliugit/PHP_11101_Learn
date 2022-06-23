<?php
//紀錄投票結果
//載入共用函式庫檔案
include_once "base.php";

//判斷送來的資料是否是選項
if (isset($_POST['opt'])) {

    //判斷傳來的資料是單一值(單選)還是陣列(複選)
    if (is_array($_POST['opt'])) {
        
        //如果是複選題，則使用迴圈把陣列中的id值逐一取出
        foreach ($_POST['opt'] as $key => $opt) {

            //取得資料表中指定id選項的資料
            $option = find("options", $opt);

            //將資料中的total欄位加1
            $option['total']++;

            //將資料存回資料表中
            save("options", $option);
            //如果是第一筆選項目資料，則取出主題資料
            if ($key == 0) {
                $subject = find("subjects", $option['subject_id']);
                
                //將主題資料中的total欄位也加1
                $subject['total']++;
                save("subjects", $subject);
            }

            //將投票資料寫入log,如果投票人未登入，則user_id欄位寫0，否則記錄存在session中的user id
            $log = ['user_id' => (isset($_SESSION['user'])) ? $_SESSION['user'] : 0,
                'subject_id' => $subject['id'],
                'option_id' => $option['id']];
            
            //儲存投票紀錄
            save("logs", $log);
        }

    } else {
        //如果是單選，則直接取出選項資料
        $option = find("options", $_POST['opt']);

        //total欄位加1
        $option['total']++;

        //儲存選項
        save("options", $option);

        //取得主題資料
        $subject = find("subjects", $option['subject_id']);

        //total欄位加1
        $subject['total']++;

        //儲存主題
        save("subjects", $subject);

        //紀錄投票紀錄
        $log = ['user_id' => (isset($_SESSION['user'])) ? $_SESSION['user'] : 0,
            'subject_id' => $subject['id'],
            'option_id' => $option['id']];
        save("logs", $log);
    }
}

//將頁面導回前台的投票結果頁,記得在網址中代入該投票的主題的id
to("../index.php?do=vote_result&id={$option['subject_id']}");

?>