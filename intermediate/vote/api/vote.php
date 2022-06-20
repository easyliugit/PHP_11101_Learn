<?php
//紀錄投票結果
include_once "base.php";
if (isset($_POST['opt'])) {
    if (is_array($_POST['opt'])) {
        foreach ($_POST['opt'] as $key => $opt) {
            $option = find("options", $opt);
            $option['total']++;
            save("options", $option);
            if ($key == 0) {
                $subject = find("subjects", $option['subject_id']);
                $subject['total']++;
                save("subjects", $subject);
            }
            $log = ['user_id' => (isset($_SESSION['user'])) ? $_SESSION['user'] : 0,
                'subject_id' => $subject['id'],
                'option_id' => $option['id']];
            save("logs", $log);
        }

    } else {

        $option = find("options", $_POST['opt']);
        $option['total']++;
        save("options", $option);
        $subject = find("subjects", $option['subject_id']);
        $subject['total']++;
        save("subjects", $subject);
        $log = ['user_id' => (isset($_SESSION['user'])) ? $_SESSION['user'] : 0,
            'subject_id' => $subject['id'],
            'option_id' => $option['id']];
        save("logs", $log);
    }
}
to("../index.php?do=vote_result&id={$option['subject_id']}");