<?php
require("steup.php");
session_start();
// 接收傳遞值
$action=$_REQUEST['action'];
// 顯示頁面與資料庫存取
switch($action){
    case "votes_log_list":
        $content=voteWeb(votes_log_list());
    break;
    case "votes_option":
        if (count($_POST["options_id"])) {
            votes_option();
            header("location:{$_SERVER['PHP_SELF']}?action=votes_log_list&s_id={$_POST["subjects_id"]}");
        } else {
            $Msg = "請選擇投票項目";
            // die_content("測試= ");
            header("location:{$_SERVER['PHP_SELF']}?action=votes_option_form&s_id={$_POST["subjects_id"]}&Msg={$Msg}");
        }
        
    break;
    case "votes_option_form":
        if(isset($_GET["s_id"])&&($_GET["s_id"]!="")){
            $get_s_id = $_GET["s_id"];
            //找今天是否已經投票
            $client_ip=GetIP();
            // $client_ip="127.0.0.1";
            $query_RecFindLogs = "SELECT l_time FROM votedb_logs WHERE subjects_id={$get_s_id} AND l_ip='{$client_ip}' ORDER BY l_id DESC";
            $RecFindLogs=$db_link->query($query_RecFindLogs);
            $RecLogsTime=$RecFindLogs->fetchColumn();
            $RecLogsTime_date=date_format(date_create($RecLogsTime),"Y-m-d");
            $today=date("Y-m-d");
            if($RecLogsTime!="" && strtotime($today)==strtotime($RecLogsTime_date)){
                header("location:{$_SERVER['PHP_SELF']}?action=votes_log_list&s_id={$get_s_id}");
            }else{
                $content=voteWeb(votes_option_form());
            }
            // die_content("測試1 RecLogsTime_date={$RecLogsTime_date} RecLogsTime={$RecLogsTime} today={$today} client_ip{$client_ip}");
        }else {
            header("location:{$_SERVER['PHP_SELF']}");
        }
    break;
    case "votes_update":
        if ($_POST["s_title"]!="") {
            votes_update();
            $Msg = "已更新完成";
        }else {
            $Msg = "請輸入投票主題";
        }
        header("location:{$_SERVER['PHP_SELF']}?action=votes_update_form&s_id={$_POST["s_id"]}&Msg={$Msg}");
        // header("location:{$_SERVER['PHP_SELF']}?action=votes_my_list");
    break;
    case "votes_update_form":
        //檢查是否經過登入，若沒有登入則重新導向
        if(!isset($_SESSION["l_u_user"]) || ($_SESSION["l_u_user"]=="")){
            header("location:{$_SERVER['PHP_SELF']}");
        }elseif(isset($_GET["s_id"])&&($_GET["s_id"]!="")){
            $content=voteWeb(votes_update_form());
        }else {
            header("location:{$_SERVER['PHP_SELF']}");
        }
    break;
    case "votes_del":
        votes_del();
        if($_GET["at"]=="votes_list"){
            header("location:{$_SERVER['PHP_SELF']}");
        }else{
            header("location:{$_SERVER['PHP_SELF']}?action=votes_my_list");
        }
    break;
    case "votes_close":
        votes_close();
        if($_GET["at"]=="votes_list"){
            header("location:{$_SERVER['PHP_SELF']}");
        }else{
            header("location:{$_SERVER['PHP_SELF']}?action=votes_my_list");
        }
    break;
    case "votes_add":
        if ($_POST["s_title"]!="") {
            votes_add();
            header("location:{$_SERVER['PHP_SELF']}?action=votes_my_list");
        }else {
            $Msg = "請輸入投票主題";
            header("location:{$_SERVER['PHP_SELF']}?action=votes_add_form&s_id={$_POST["s_id"]}&Msg={$Msg}");
        }
    break;
    case "votes_add_form":
        $content=voteWeb(votes_add_form());
    break;
    case "login_out":
        unset($_SESSION["l_u_user"]);
	    unset($_SESSION["l_u_lv"]);     
        header("location:{$_SERVER['PHP_SELF']}");
    break;
    case "votes_my_list":
        $content=voteWeb(votes_my_list());
    break;
    case "login_users":
        login_users();        
        header("location:{$_SERVER['PHP_SELF']}");
    break;
    case "login_users_form":
        $content=voteWeb(login_users_form());
    break;
    case "users_del":
        if(isset($_GET["u_id"])&&($_GET["u_id"]!="")){
            users_del();
        }
        header("location:{$_SERVER['PHP_SELF']}?action=users_list");
    break;
    case "users_update":
        users_update();
        header("location:{$_SERVER['PHP_SELF']}?action=users_list");
    break;
    case "users_update_form":
        $content=voteWeb(users_update_form());
    break;
    case "users_add":
        //找尋帳號是否已經註冊
        $query_RecFindUser = "SELECT count(*) FROM votedb_users WHERE u_user='{$_POST["u_user"]}'";
        $RecFindUser=$db_link->query($query_RecFindUser);
        if($RecFindUser->fetchColumn()){            
            $Msg = "此帳號已被使用";
            header("location:{$_SERVER['PHP_SELF']}?action=users_add_form&u_user={$_POST["u_user"]}&Msg={$Msg}");
        }elseif($_POST["u_user"]==""){
            $Msg = "請輸入帳號";
            header("location:{$_SERVER['PHP_SELF']}?action=users_add_form&u_user={$_POST["u_user"]}&Msg={$Msg}");

        }elseif($_POST["u_pw"]==""){
            $Msg = "請輸入密碼";
            header("location:{$_SERVER['PHP_SELF']}?action=users_add_form&u_user={$_POST["u_user"]}&Msg={$Msg}");

        }else{            
            users_add();
            $Msg = "帳號建立完成，請重新登入";
            header("location:{$_SERVER['PHP_SELF']}?Msg={$Msg}");
        }
    break;
    case "users_add_form":
        $content=voteWeb(users_add_form());
    break;
    case "users_list":
        if($_SESSION["l_u_lv"]=="admin"){
            $content=voteWeb(users_list());
        }else {
            header("location:{$_SERVER['PHP_SELF']}");
        }
    break;
    default:
        $content=voteWeb(votes_list());
}
echo $content;

function votes_log_list(){
    global $db_link;
    $get_s_id = FilterString($_GET["s_id"], 'int');

    $sql_query="SELECT * FROM votedb_subjects WHERE s_id = '{$get_s_id}'";
    $stmt = $db_link->query($sql_query);
    $row=$stmt->fetch();

    $sql_query="SELECT * FROM `votedb_types` ORDER BY t_sort ASC ,t_id DESC";
    $stmt_types = $db_link->query($sql_query);
    $row_result_types=$stmt_types->fetchAll();
    $total_records_types = count($row_result_types);

    $sql_query="SELECT * FROM `votedb_options` WHERE subjects_id = '{$row["s_id"]}'";
    $stmt_options = $db_link->query($sql_query);
    $row_result_options=$stmt_options->fetchAll();
    $total_records_options = count($row_result_options);

    $main='
    <h3>投票結果</h3>
    <dl>
        <dt>投票主題</dt>
        <dd>'.$row["s_title"].'</dd>
        <dt>投票類別</dt>
    ';
if($total_records_types){
    foreach($row_result_types as $item=>$row_types){
        if($row["types_id"]==$row_types["t_id"]){
            $main .= $row_types["t_name"];
        }
    }
}
    $main.='
        <dt>選擇</dt>
        <dd>'.$row["s_choice"].'</dd>
        <dt>投票開始時間</dt>
        <dd>'.$row["s_date_start"].'</dd>
        <dt>投票結束時間</dt>
        <dd>'.$row["s_date_end"].'</dd>
        <dt>選項</dt>
        <dd>
        <div class="options">
        <!-- <div class="logs-1" style="grid-row-start: 55;">111111</div> -->
        <!-- <div class="logs-2" style="grid-row-start: 70;">222222</div> -->
        <!-- <div class="logs-3" style="grid-row-start: 20;background-color: blue;"></div> -->
        <!-- <div class="logs-4"></div> -->
        <!-- <div class="logs-5"></div> -->
        <!-- <div class="logs-6"></div> -->
        ';
if($total_records_options){
    foreach($row_result_options as $item=>$row_options){
        $option_percent = 100 - number_format( $row_options["o_votes"] * $row["s_votes"], 2);
        $main.='<div class="logs-'.$row_options["o_id"].'" style="grid-row-start: '.$option_percent.';">'.$row_options["o_votes"].'</div>';
    }
}
        $main.='
        </div>
        <div class="options_name">
        ';
if($total_records_options){
    foreach($row_result_options as $item=>$row_options){
        // die_content("測試= ". $row_options["o_votes"] *100);
        $main.='<div>'.$row_options["o_option"].'</div>';
    }
}
        $main.='
        </div>
        </dd>
        <dt></dt>
        <dd></dd>
    </dl>
    ';
    return $main;
}
function votes_option(){
    global $db_link;
    $post_s_id = FilterString($_POST["subjects_id"], 'int');

    for ($i=0; $i < count($_POST["options_id"]) ; $i++) { 
        $post_o_id = FilterString($_POST["options_id"][$i], 'int');
        $sql_query = "INSERT INTO votedb_logs (users_id ,subjects_id ,options_id ,l_time ,l_ip) VALUES (?, ?, ?, NOW(), ?)";
        $stmt = $db_link -> prepare($sql_query);
        $stmt -> execute(array(
                        FilterString($_POST["users_id"], 'int')
                        , $post_s_id
                        , $post_o_id
                        , FilterString($_POST["l_ip"], 'string')
                    ));
    
        $sql_query="SELECT count(*) FROM votedb_logs WHERE options_id = {$post_o_id}";
        $stmt = $db_link->query($sql_query);
        $total_records = $stmt->fetchColumn();
        
        $sql_query = "UPDATE votedb_options SET o_votes=$total_records WHERE o_id={$post_o_id}";
        $db_link -> exec($sql_query);
    }

    $sql_query="SELECT count(*) FROM votedb_logs WHERE subjects_id = {$post_s_id}";
    $stmt = $db_link->query($sql_query);
    $total_records = $stmt->fetchColumn();
    
    $sql_query = "UPDATE votedb_subjects SET s_votes=$total_records WHERE s_id={$post_s_id}";
    $db_link -> exec($sql_query);
}
function votes_option_form(){
    global $db_link;
    $get_s_id = FilterString($_GET["s_id"], 'int');

    $sql_query = "UPDATE votedb_subjects SET s_hits=s_hits+1 WHERE s_id={$get_s_id}";
    $stmt = $db_link -> exec($sql_query);

    $sql_query="SELECT * FROM votedb_subjects WHERE s_id = '{$get_s_id}'";
    $stmt = $db_link->query($sql_query);
    $row=$stmt->fetch();
    
    $sql_query="SELECT * FROM `votedb_types` ORDER BY t_sort ASC ,t_id DESC";
    $stmt_types = $db_link->query($sql_query);
    $row_result_types=$stmt_types->fetchAll();
    $total_records_types = count($row_result_types);

    $sql_query="SELECT * FROM `votedb_options` WHERE subjects_id = '{$row["s_id"]}'";
    $stmt_options = $db_link->query($sql_query);
    $row_result_options=$stmt_options->fetchAll();
    $total_records_options = count($row_result_options);
    $main='
    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
    <fieldset>
        <legend>投票選項</legend>
        <dl>
            <dt>投票主題</dt>
            <dd>'.$row["s_title"].'</dd>
            <dt>投票類別</dt>
            <dd>
    ';
if($total_records_types){
    foreach($row_result_types as $item=>$row_types){
        if($row["types_id"]==$row_types["t_id"]){
            $main .= $row_types["t_name"];
        }
    }
}
    $main.='
            </dd>
            <dt>選擇</dt>
            <dd>'.$row["s_choice"].'</dd>
            <dt>投票開始時間</dt>
            <dd>'.$row["s_date_start"].'</dd>
            <dt>投票結束時間</dt>
            <dd>'.$row["s_date_end"].'</dd>
        </dl>
    </fieldset>
    <p>'.$_GET["Msg"].'</p>
    <fieldset>
        <legend>投票選項</legend>
        <ol>
            <!-- <li><input type="radio" name="options_id[]" value="" checked>111</li> -->
            <!-- <li><input type="checkbox" name="options_id[]" value="" checked>111</li> -->
    ';
    if($total_records_options){
        foreach($row_result_options as $item=>$row_options){
            $main.='<li><input type="'.$row["s_choice"].'" name="options_id[]" value="'.$row_options["o_id"].'">'.$row_options["o_option"].'</li>';
        }
    }
    $main.='
        </ol>
    </fieldset>
    <input type="hidden" name="users_id" value="'.$row["users_id"].'">
    <input type="hidden" name="subjects_id" value="'.$row["s_id"].'">
    <input type="hidden" name="l_ip" value="'.GetIP().'">
    <input type="hidden" name="action" value="votes_option">
    <input type="submit" value="送出">
    <input type="reset" value="重置">                        
    </form>
    ';
    return $main;
}
function votes_update(){
    global $db_link;
    $sql_query = "UPDATE votedb_subjects SET s_title=?, types_id=?, s_choice=?, s_date_start=? ,s_date_end=? ,s_close=? WHERE s_id=?";
    $stmt = $db_link -> prepare($sql_query);
    $stmt -> execute(array(
        FilterString($_POST["s_title"], 'string')
        , FilterString($_POST["types_id"], 'int')
        , FilterString($_POST["s_choice"], 'string')
        , FilterString($_POST["s_date_start"], 'string')
        , FilterString($_POST["s_date_end"], 'string')
        , FilterString($_POST["s_close"], 'string')
        , FilterString($_POST["s_id"], 'int')
    ));

    for ($i=0; $i < count($_POST["o_id"]); $i++) { 
        if(in_array($_POST["o_id"][$i],$_POST["del_check"])){
            $sql_query = "DELETE FROM votedb_options WHERE o_id=?";
            $stmt = $db_link -> prepare($sql_query);
            $stmt -> execute(array($_POST["o_id"][$i]));
        }else{
            $sql_query = "UPDATE votedb_options SET o_option=? WHERE o_id=?";
            $stmt = $db_link -> prepare($sql_query);
            $stmt -> execute(array(
                FilterString($_POST["o_option"][$i], 'string')
                , FilterString($_POST["o_id"][$i], 'int')
            ));
        }
    }

    for ($i=0; $i < count($_POST["o_option_add"]) ; $i++) { 
        if ($_POST["o_option_add"][$i]=="") {
            continue;
        }
        // die_content("測試= ");
        $sql_query = "INSERT INTO votedb_options (subjects_id ,o_option) VALUES (?, ?)";
        $stmt = $db_link -> prepare($sql_query);
        $stmt -> execute(array(
                        FilterString($_POST["s_id"], 'int')
                        , FilterString($_POST["o_option_add"][$i], 'string')
                    ));
    }

    $stmt = null;
    $db_link = null;    
}
function votes_update_form(){
    global $db_link;
    $get_s_id = FilterString($_GET["s_id"], 'int');

    $sql_query="SELECT * FROM votedb_subjects WHERE s_id = '{$get_s_id}'";
    $stmt = $db_link->query($sql_query);
    $row=$stmt->fetch();
    
    $sql_query="SELECT * FROM `votedb_types` ORDER BY t_sort ASC ,t_id DESC";
    $stmt_types = $db_link->query($sql_query);
    $row_result_types=$stmt_types->fetchAll();
    $total_records_types = count($row_result_types);

    $sql_query="SELECT * FROM `votedb_options` WHERE subjects_id = '{$row["s_id"]}'";
    $stmt_options = $db_link->query($sql_query);
    $row_result_options=$stmt_options->fetchAll();
    $total_records_options = count($row_result_options);

    $main='
    <p class="Msg">'.$_GET["Msg"].'</p>
    <script>
    setTimeout(function(){$(".Msg").remove();},2000);
    </script>
    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
    <fieldset>
        <legend>編輯投票主題</legend>
        <dl>
            <dd>
    ';
    if($row["s_close"]=="0"){
        $s_close_0_checked = " checked";
    }else{
        $s_close_1_checked = " checked";
    }
    $main.='
            <input type="radio" name="s_close" value="0"'.$s_close_0_checked.'>開
            <input type="radio" name="s_close" value="1"'.$s_close_1_checked.'>關
            </dd>
            <dt>投票主題</dt>
            <dd><input type="text" name="s_title" value="'.$row["s_title"].'"></dd>
            <dt>投票類別</dt>
            <dd>
                <select name="types_id">
                    <!-- <option value="1" selected>全部</option> -->
    ';
    if($total_records_types){
        foreach($row_result_types as $item=>$row_types){
            if($row["types_id"]==$row_types["t_id"]){
                $selected = " selected";
            }else{
                $selected = "";
            }
            $main.='<option value="'.$row_types["t_id"].'"'.$selected.'>'.$row_types["t_name"].'</option>';
        }
    }
    $main.='
                </select>
            </dd>
            <!-- <dd><input type="text" name="types_id" value="1" readonly="readonly">不提供調整</dd> -->
            <dt>選擇</dt>
            <dd>
    ';
    if($row["s_choice"=="radio"]){
        $radio_checked = " checked";
    }else{
        $checkbox_checked = " checked";
    }
    $main.='
                <input type="radio" name="s_choice" value="radio"'.$radio_checked.'>單選 
                <input type="radio" name="s_choice" value="checkbox"'.$checkbox_checked.'>複選
                <input type="number" name="s_choice_num" value="1" disabled>暫不限制
            </dd>
            <dt>投票開始時間</dt>
            <dd><input type="date" name="s_date_start" value="'.$row["s_date_start"].'"></dd>
            <dt>投票結束時間</dt>
            <dd><input type="date" name="s_date_end" value="'.$row["s_date_end"].'"></dd>
        </dl>
    </fieldset>
    <fieldset>
        <legend>投票選項</legend>
        <ol id="options">
        <!-- <li><input type="text" name="o_option[]" value=""> <input type="checkbox" name="del_check[]" value="">刪除</li> -->
        ';
    if($total_records_options){
        foreach($row_result_options as $item=>$row_options){
            $main.='<li><input type="text" name="o_option[]" value="'.$row_options["o_option"].'"> <input type="checkbox" name="del_check[]" value="'.$row_options["o_id"].'">刪除<input type="hidden" name="o_id[]" value="'.$row_options["o_id"].'"></li>';
        }
    }
    $main.='
        </ol>
    </fieldset>
    <fieldset>
        <legend>新增投票選項</legend>
        <input type="button" id="btn_add_option" value="新增選項" />
        <ol id="add_options">
            <li id="li_add0"><input type="text" name="o_option_add[]" value=""><input type="button" id="btn_del_option" value="刪除選項" onclick="delOption_add(0)"></li>
        </ol>
    </fieldset>
    <input type="hidden" name="s_id" value="'.$row["s_id"].'">
    <input type="hidden" name="action" value="votes_update">
    <input type="submit" value="送出">
    <input type="reset" value="重置"> 
    </form>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/votes_update_form.js"></script>
    ';

    return $main;
}
function votes_del(){
    global $db_link;
    $sql_query = "UPDATE votedb_subjects SET s_del='1' WHERE s_id={$_GET["s_id"]}";
    $db_link -> exec($sql_query);
    $db_link = null;
}
function votes_close(){
    global $db_link;
    $sql_query = "UPDATE votedb_subjects SET s_close='{$_GET["s_close"]}' WHERE s_id={$_GET["s_id"]}";
    $db_link -> exec($sql_query);
    $db_link = null;
}
function votes_add(){
    global $db_link;
    $sql_query = "INSERT INTO votedb_subjects (s_title ,types_id ,s_choice ,users_id ,s_date ,s_date_start ,s_date_end) VALUES (?, ?, ?, ?, NOW(), ?, ?)";
    $stmt = $db_link -> prepare($sql_query);
    $stmt -> execute(array(
                    FilterString($_POST["s_title"], 'string')
                    , FilterString($_POST["types_id"], 'int')
                    , FilterString($_POST["s_choice"], 'string')
                    , FilterString($_POST["users_id"], 'int')
                    , FilterString($_POST["s_date_start"], 'string')
                    , FilterString($_POST["s_date_end"], 'string')
                ));
    $s_id = $db_link -> lastInsertId();
    for ($i=0; $i < count($_POST["o_option"]) ; $i++) { 
        if ($_POST["o_option"][$i]=="") {
            continue;
        }
        $sql_query = "INSERT INTO votedb_options (subjects_id ,o_option) VALUES (?, ?)";
        $stmt = $db_link -> prepare($sql_query);
        $stmt -> execute(array(
                        $s_id
                        , FilterString($_POST["o_option"][$i], 'string')
                    ));
    }
    $stmt = null;
    $db_link = null;
}
function votes_add_form(){
    global $db_link;
    //檢查是否經過登入，若沒有登入則重新導向
    if(!isset($_SESSION["l_u_user"]) || ($_SESSION["l_u_user"]=="")){
        header("location:{$_SERVER['PHP_SELF']}");
    }
    $sql_query="SELECT * FROM votedb_users WHERE u_user = '{$_SESSION["l_u_user"]}'";
    $stmt = $db_link->query($sql_query);
    $row=$stmt->fetch();

    $sql_query="SELECT * FROM `votedb_types` ORDER BY t_sort ASC ,t_id DESC";
    $stmt_types = $db_link->query($sql_query);
    $row_result_types=$stmt_types->fetchAll();
    $total_records_types = count($row_result_types);

    $main='
    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
    <fieldset>
        <legend>新增投票主題</legend>
        <dl>
            <dt>投票主題</dt>
            <dd><input type="text" name="s_title" value="">'.$_GET["Msg"].'</dd>
            <dt>投票類別</dt>
            <dd>
            <select name="types_id">
            <!-- <option value="1" selected>全部</option> -->
    ';
            if($total_records_types){
                foreach($row_result_types as $item=>$row_types){
                    $main.='<option value="'.$row_types['t_id'].'"';
                    if($row_types['t_id']==1){
                        $main.= ' selected';
                    }
                    $main.='>'.$row_types['t_name'].'</option>';
                }
            }
    $main.='
            </select>
            </dd>
            <dt>選擇</dt>
            <dd>
                <input type="radio" name="s_choice" value="radio" checked>單選 
                <input type="radio" name="s_choice" value="checkbox">複選
                <input type="number" name="s_choice_num" value="1" disabled>暫不限制
            </dd>
            <dt>投票開始時間</dt>
            <dd><input type="date" name="s_date_start" value="'.date('Y-m-d').'"></dd>
            <dt>投票結束時間</dt>
            <dd><input type="date" name="s_date_end" value="'.date('Y-m-d').'"></dd>
        </dl>
    </fieldset>
    <fieldset>
        <legend>新增投票選項</legend>
        <input type="button" id="btn_add_option" value="新增選項" />
        <ol id="add_options">
            <li id="li0"><input type="text" name="o_option[]"><input type="button" id="btn_del_option" value="刪除選項" onclick="delOption(0)"></li>
        </ol>
    </fieldset>
    <input type="hidden" name="users_id" value="'.$row["u_id"].'">
    <input type="hidden" name="action" value="votes_add">
    <input type="submit" value="送出">
    <input type="reset" value="重置">
    </form>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/votes_add_form.js"></script>
    ';
    return $main;
}
function votes_my_list(){
    global $db_link;
    global $action;
    //檢查是否經過登入，若沒有登入則重新導向
    if(!isset($_SESSION["l_u_user"]) || ($_SESSION["l_u_user"]=="")){
        header("location:{$_SERVER['PHP_SELF']}");
    }
    $sql_query="SELECT * FROM votedb_users WHERE u_user = '{$_SESSION["l_u_user"]}'";
    $stmt = $db_link->query($sql_query);
    $row=$stmt->fetch();
    $row_u_id=$row["u_id"];
    
    //預設每頁筆數
    $pageRow_records = 10;
    //預設頁數
    $num_pages = 1;
    //若已經有翻頁，將頁數更新
    if (isset($_GET['page'])) {
        $num_pages = $_GET['page'];
    }
    //本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
    $startRow_records = ($num_pages -1) * $pageRow_records;
    
    $sql_query="SELECT * FROM votedb_subjects WHERE users_id = {$row_u_id} AND s_del = '0' ORDER BY s_id DESC";
    //加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
    $sql_query_limit = $sql_query." LIMIT {$startRow_records}, {$pageRow_records}";
    //以加上限制顯示筆數的SQL敘述句查詢資料到 $stmt 中
    $stmt = $db_link->query($sql_query_limit);
    //以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_stmt 中
    $all_stmt = $db_link->query($sql_query);
    //計算總筆數
    $total_records = count($all_stmt->fetchAll());
    //計算總頁數=(總筆數/每頁筆數)後無條件進位。
    $total_pages = ceil($total_records/$pageRow_records);
    $main='
    <table class="votes_my_list">
    <caption>我的投票主題清單</caption>
    <thead>
        <tr>
            <td></td>
            <td>投票主題</td>
            <td>投票類別</td>
            <td>選擇</td>
            <td>開始時間</td>
            <td>結束時間</td>
            <td>人氣</td>
            <td>投票數</td>
            <td>開關</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
    ';

    if($total_records){
        while($row=$stmt->fetch()){
            
    $main.='
    <tr>
    <td>'.$row['s_id'].'</td>
    <td>'.$row['s_title'].'</td>
    <td>';
        $sql_query="SELECT * FROM `votedb_types` WHERE t_id = {$row['types_id']}";
        $stmt_types = $db_link->query($sql_query);
        $row_types=$stmt_types->fetch();
        $main .= $row_types['t_name'];
        $main.=
    '</td>
    <td>'.$row['s_choice'].'</td>
    <td>'.$row['s_date_start'].'</td>
    <td>'.$row['s_date_end'].'</td>
    <td>'.$row['s_hits'].'</td>
    <td>'.$row['s_votes'].'</td>
    <td>
    ';
    $row_s_close = ($row['s_close']=="0") ? 1 : 0 ;
    $row_s_close_val = ($row['s_close']=="0") ? '開' : '關' ;
    $main.='
    <a href="'.$_SERVER['PHP_SELF'].'?action=votes_close&s_id='.$row['s_id'].'&s_close='.$row_s_close.'">'.$row_s_close_val.'</a>
    </td>
    <td>
    ';
    if($row['users_id']==$row_u_id){
    $main.='
    <a href="'.$_SERVER['PHP_SELF'].'?action=votes_update_form&s_id='.$row['s_id'].'">編輯</a> | 
    <a href="'.$_SERVER['PHP_SELF'].'?action=votes_del&s_id='.$row['s_id'].'">刪除</a>
    ';
    }

    $main.='
    </td>
    </tr>
    ';
    
        }
    }

    $main.='
    </tbody>
    <tfoot>
        <tr>
            <td colspan="10"></td>
        </tr>
    </tfoot>
</table>
<p>
    ';
    if ($num_pages > 1) { // 若不是第一頁則顯示        
    $main.='
    <a href="'.$_SERVER['PHP_SELF'].'?action='.$action.'&page=1">第一頁</a> | 
    <a href="'.$_SERVER['PHP_SELF'].'?action='.$action.'&page='.($num_pages-1) .'">上一頁</a>
    ';
    }
    if ($num_pages < $total_pages) { // 若不是最後一頁則顯示
    $main.='
    <a href="'.$_SERVER['PHP_SELF'].'?action='.$action.'&page='.($num_pages+1) .'">下一頁</a> | 
    <a href="'.$_SERVER['PHP_SELF'].'?action='.$action.'&page='.$total_pages.'">最後頁</a>
    ';
    }
    $main.='
    頁數：
    ';
    for($i=1;$i<=$total_pages;$i++){
        if($i==$num_pages){
    $main.='
    '.$i.' 
    ';
        }else{
    $main.='
    <a href="'.$_SERVER['PHP_SELF'].'?action='.$action.'&page='.$i.'">'.$i.'</a> 
    ';
        }
    }
    $main.='
    </p>
    ';

    return $main;
}
function login_users(){
    global $db_link;
    //檢查是否經過登入，若有登入則重新導向
    if(isset($_SESSION["l_u_user"]) && ($_SESSION["l_u_user"]!="")){
        header("location:{$_SERVER['PHP_SELF']}");
    }
    //繫結登入會員資料
	$query_RecLogin = "SELECT u_user, u_pw, u_lv FROM votedb_users WHERE u_user='{$_POST["u_user"]}'";
    $stmt = $db_link->query($query_RecLogin);
    $row=$stmt->fetch();
    $row_u_user=$row['u_user'];
    $row_u_pw=$row['u_pw'];
    $row_u_lv=$row['u_lv'];
    //比對密碼，若登入成功則呈現登入狀態
	if(password_verify($_POST["u_pw"],$row_u_pw)){
        $sql_query = "UPDATE votedb_users SET u_login=u_login+1, u_logintime=NOW() WHERE u_user=?";
        $stmt = $db_link -> prepare($sql_query);
        $stmt -> execute(array(
                        FilterString($_POST["u_user"], 'string')
                    ));
        $stmt = null;
        $db_link = null;
        //設定登入者的名稱及等級
        $_SESSION["l_u_user"]=$row_u_user;
        $_SESSION["l_u_lv"]=$row_u_lv;
    }
}
function login_users_form(){
    global $link;
    //檢查是否經過登入，若有登入則重新導向
    if(isset($_SESSION["l_u_user"]) && ($_SESSION["l_u_user"]!="")){
        header("location:{$_SERVER['PHP_SELF']}");
    }
    $main='
    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
    <fieldset>
        <legend>登入</legend>
        <dl>
            <dt>使用帳號</dt>
            <dd><input type="text" name="u_user" id="u_user" value=""></dd>
            <dt>使用密碼</dt>
            <dd><input type="password" name="u_pw" id="u_pw" value=""></dd>
        </dl>
    </fieldset>
    <input type="hidden" name="action" value="login_users">
    <input type="submit" value="送出">
    <input type="reset" value="重置">
    </form>
    <a href="#">重設密碼</a> | 
    <a href="'.$_SERVER['PHP_SELF'].'?action=users_add_form">註冊使用</a>
    ';
    return $main;
}
function users_del(){
    global $db_link;
    $get_u_id = FilterString($_GET["u_id"], 'int');

    $sql_query="SELECT * FROM votedb_users WHERE u_id = {$get_u_id}";
    $stmt = $db_link->query($sql_query);
    $row=$stmt->fetch();
    if($row['u_lv']!='admin'){
        $sql_query = "DELETE FROM votedb_users WHERE u_id=?";
        $stmt = $db_link -> prepare($sql_query);
        $stmt -> execute(array($get_u_id));
        $stmt = null;
        $db_link = null;    
    }    
}
function users_update(){
    global $db_link;
    //檢查是否有修改密碼
	$mpass = $_POST["u_pwo"];
    if($_POST["u_pw"]!=""){
        $mpass = password_hash($_POST["u_pw"], PASSWORD_DEFAULT);
    }
    $sql_query = "UPDATE votedb_users SET u_pw=?, u_nick=?, u_email=? WHERE u_id=?";
    $stmt = $db_link -> prepare($sql_query);
    $stmt -> execute(array(
                    $mpass
                    , FilterString($_POST["u_nick"], 'string')
                    , FilterString($_POST["u_email"], 'email')
                    , FilterString($_POST["u_id"], 'int')
                ));
    $stmt = null;
    $db_link = null;    
}
function users_update_form(){
    global $db_link;
    if(isset($_GET["u_id"]) && ($_GET["u_id"]!="")){
        $sql_query="SELECT * FROM votedb_users WHERE u_id = {$_GET["u_id"]}";
    }else{
        $sql_query="SELECT * FROM votedb_users WHERE u_user = '{$_SESSION["l_u_user"]}'";
    }    
    $stmt = $db_link->query($sql_query);
    $row=$stmt->fetch();
    if(($_GET["u_id"]!="") && ($row['u_lv']=='admin')){
        header("location:{$_SERVER['PHP_SELF']}?action=users_list");
    }
    $main='
    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
    <fieldset>
        <legend>新增使用者資料</legend>
        <dl>
            <dt>使用帳號</dt>
            <dd>'.$row['u_user'].'</dd>
            <dt>使用密碼</dt>
            <dd>
            <input type="password" name="u_pw" id="u_pw" value="">不修改密碼請保持空白
            <input type="hidden" name="u_pwo" value="'.$row['u_pw'].'">
            </dd>
            <dt>暱稱</dt>
            <dd><input type="text" name="u_nick" id="u_nick" value="'.$row['u_nick'].'"></dd>
            <dt>電子郵件</dt>
            <dd><input type="email" name="u_email" id="u_email" value="'.$row['u_email'].'"></dd>
        </dl>
    </fieldset>
    <input type="hidden" name="u_id" value="'.$row['u_id'].'">
    <input type="hidden" name="action" value="users_update">
    <input type="submit" value="送出">
    <input type="reset" value="重置">
</form>
    ';
    return $main;
}
function users_add(){
    global $db_link;
    $sql_query = "INSERT INTO votedb_users (u_user ,u_pw ,u_nick ,u_email ,u_jointime) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $db_link -> prepare($sql_query);
    $stmt -> execute(array(
                    FilterString($_POST["u_user"], 'string')
                    , password_hash($_POST["u_pw"], PASSWORD_DEFAULT)
                    , FilterString($_POST["u_nick"], 'string')
                    , FilterString($_POST["u_email"], 'email')
                ));
    $stmt = null;
    $db_link = null;
}
function users_add_form(){
    global $link;
    $main='
    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
    <fieldset>
    <legend>新增使用者資料</legend>
    <dl>
    <dt>使用帳號</dt>
    <dd><input type="text" name="u_user" id="u_user" value="'.$_GET["u_user"].'">'.$_GET["Msg"].'</dd>
    <dt>使用密碼</dt>
    <dd><input type="password" name="u_pw" id="u_pw" value=""></dd>
    <dt>暱稱</dt>
    <dd><input type="text" name="u_nick" id="u_nick" value=""></dd>
    <dt>電子郵件</dt>
    <dd><input type="email" name="u_email" id="u_email" value=""></dd>
    </dl>
    </fieldset>
    <input type="hidden" name="action" value="users_add">
    <input type="submit" value="送出">
    <input type="reset" value="重置">
    </form>
    ';
    return $main;
}
function users_list(){
    global $db_link;
    global $action;
    //預設每頁筆數
    $pageRow_records = 10;
    //預設頁數
    $num_pages = 1;
    //若已經有翻頁，將頁數更新
    if (isset($_GET['page'])) {
        $num_pages = $_GET['page'];
    }
    //本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
    $startRow_records = ($num_pages -1) * $pageRow_records;
    
    $sql_query="SELECT * FROM votedb_users";
    //加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
    $sql_query_limit = $sql_query." LIMIT {$startRow_records}, {$pageRow_records}";
    //以加上限制顯示筆數的SQL敘述句查詢資料到 $stmt 中
    $stmt = $db_link->query($sql_query_limit);
    //以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_stmt 中
    $all_stmt = $db_link->query($sql_query);
    //計算總筆數
    $total_records = count($all_stmt->fetchAll());
    //計算總頁數=(總筆數/每頁筆數)後無條件進位。
    $total_pages = ceil($total_records/$pageRow_records);
    $main='
    <table class="users_list">
    <caption>使用者清單</caption>
    <thead>
        <tr>
            <td></td>
            <td>帳號</td>
            <td>暱稱</td>
            <td>權限</td>
            <td>登入次數</td>
            <td>登入時間</td>
            <td>加入日期</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
    ';

    if($total_records){
        while($row=$stmt->fetch()){
            
    $main.='
    <tr>
    <td>'.$row['u_id'].'</td>
    <td>'.$row['u_user'].'</td>
    <td>'.$row['u_nick'].'</td>
    <td>'.$row['u_lv'].'</td>
    <td>'.$row['u_login'].'</td>
    <td>'.$row['u_linintime'].'</td>
    <td>'.$row['u_jointime'].'</td>
    <td>
    ';
    if($row['u_lv']=='user'){
    $main.='
    <a href="'.$_SERVER['PHP_SELF'].'?action=users_update_form&u_id='.$row['u_id'].'">編輯</a> | 
    <a href="'.$_SERVER['PHP_SELF'].'?action=users_del&u_id='.$row['u_id'].'">刪除</a>
    ';
    }

    $main.='
    </td>
    </tr>
    ';
    
        }
    }

    $main.='
    </tbody>
    <tfoot>
        <tr>
            <td colspan="8"></td>
        </tr>
    </tfoot>
</table>
<p>
    ';
    if ($num_pages > 1) { // 若不是第一頁則顯示        
    $main.='
    <a href="'.$_SERVER['PHP_SELF'].'?action='.$action.'&page=1">第一頁</a> | 
    <a href="'.$_SERVER['PHP_SELF'].'?action='.$action.'&page='.($num_pages-1) .'">上一頁</a>
    ';
    }
    if ($num_pages < $total_pages) { // 若不是最後一頁則顯示
    $main.='
    <a href="'.$_SERVER['PHP_SELF'].'?action='.$action.'&page='.($num_pages+1) .'">下一頁</a> | 
    <a href="'.$_SERVER['PHP_SELF'].'?action='.$action.'&page='.$total_pages.'">最後頁</a>
    ';
    }
    $main.='
    頁數：
    ';
    for($i=1;$i<=$total_pages;$i++){
        if($i==$num_pages){
    $main.='
    '.$i.' 
    ';
        }else{
    $main.='
    <a href="'.$_SERVER['PHP_SELF'].'?action='.$action.'&page='.$i.'">'.$i.'</a> 
    ';
        }
    }
    $main.='
    </p>
    ';

    return $main;
}
function votes_list(){
    global $db_link;
    $get_page_LinkVal="";
    $action = "votes_list";
    //預設每頁筆數
    $pageRow_records = 10;
    //預設頁數
    $num_pages = 1;
    //若已經有翻頁，將頁數更新
    if (isset($_GET['page'])) {
        $num_pages = $_GET['page'];
    }
    //本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
    $startRow_records = ($num_pages -1) * $pageRow_records;

    if($_GET["types_id"]!=""){
        $get_where_types_id = "AND types_id={$_GET["types_id"]} ";
        $get_page_LinkVal .= "types_id={$_GET["types_id"]}&";
    }else{
        $get_where_types_id = "";
        $get_page_LinkVal .= "";
    }
    if($_GET["desc"]!=""){
        $get_order_desc = "{$_GET["desc"]} DESC ,";        
        $get_page_LinkVal .= "desc={$_GET["desc"]}&";        
    }else{
        $get_order_desc = "";
        $get_page_LinkVal .= "";
    }
    if($_SESSION["l_u_lv"]=="admin"){
        $and_s_close="";
    }else {
        $and_s_close="AND s_close = '0' ";
    }
    $sql_query="SELECT * FROM votedb_subjects WHERE s_del = '0' {$and_s_close}{$get_where_types_id}ORDER BY {$get_order_desc}s_id DESC";
    //加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
    $sql_query_limit = $sql_query." LIMIT {$startRow_records}, {$pageRow_records}";
    //以加上限制顯示筆數的SQL敘述句查詢資料到 $stmt 中
    $stmt = $db_link->query($sql_query_limit);
    //以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_stmt 中
    $all_stmt = $db_link->query($sql_query);
    //計算總筆數
    $total_records = count($all_stmt->fetchAll());
    //計算總頁數=(總筆數/每頁筆數)後無條件進位。
    $total_pages = ceil($total_records/$pageRow_records);
    $main='
    <table class="votes_list">
    <caption>所有投票清單</caption>
    <thead>
        <tr>
            <td></td>
            <td>投票主題</td>
            <td>投票類別</td>
            <td>選擇</td>
            <td>開始時間</td>
            <td>結束時間</td>
            <td>人氣</td>
            <td>投票數</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
    ';

    if($total_records){
        while($row=$stmt->fetch()){
            
    $main.='
    <tr>
    <td>'.$row['s_id'].'</td>
    <td>
        <a href="'.$_SERVER['PHP_SELF'].'?action=votes_option_form&s_id='.$row['s_id'].'">'.$row['s_title'].'</a>
    </td>
    <td>';
        if($_GET["types_id"]!=""){
            $types_id = $_GET["types_id"];        
        }else{
            $types_id = $row['types_id'];
        }
        $sql_query="SELECT * FROM `votedb_types` WHERE t_id = {$types_id}";
        $stmt_types = $db_link->query($sql_query);
        $row_types=$stmt_types->fetch();
        $main .= $row_types['t_name'];
        $main.=
    '</td>
    <td>'.$row['s_choice'].'</td>
    <td>'.$row['s_date_start'].'</td>
    <td>'.$row['s_date_end'].'</td>
    <td>'.$row['s_hits'].'</td>
    <td>'.$row['s_votes'].'</td>
    <td>
    ';
if($_SESSION["l_u_lv"]=="admin"){
    $row_s_close = ($row['s_close']=="0") ? 1 : 0 ;
    $row_s_close_val = ($row['s_close']=="0") ? '開' : '關' ;
    $main.='
    <a href="'.$_SERVER['PHP_SELF'].'?action=votes_close&s_id='.$row['s_id'].'&s_close='.$row_s_close.'&at='.$action.'">'.$row_s_close_val.'</a> | 
    <a href="'.$_SERVER['PHP_SELF'].'?action=votes_update_form&s_id='.$row['s_id'].'">編輯</a> | 
    <a href="'.$_SERVER['PHP_SELF'].'?action=votes_del&s_id='.$row['s_id'].'&at='.$action.'">刪除</a>
    ';
}

    $main.='
    </td>
    </tr>
    ';
    
        }
    }

    $main.='
    </tbody>
    <tfoot>
        <tr>
            <td colspan="9"></td>
        </tr>
    </tfoot>
</table>
<p>
    ';
    if ($num_pages > 1) { // 若不是第一頁則顯示        
    $main.='
    <a href="'.$_SERVER['PHP_SELF'].'?'.$get_page_LinkVal.'page=1">第一頁</a> | 
    <a href="'.$_SERVER['PHP_SELF'].'?'.$get_page_LinkVal.'page='.($num_pages-1) .'">上一頁</a>
    ';
    }
    if ($num_pages < $total_pages) { // 若不是最後一頁則顯示
    $main.='
    <a href="'.$_SERVER['PHP_SELF'].'?'.$get_page_LinkVal.'page='.($num_pages+1) .'">下一頁</a> | 
    <a href="'.$_SERVER['PHP_SELF'].'?'.$get_page_LinkVal.'page='.$total_pages.'">最後頁</a>
    ';
    }
    $main.='
    頁數：
    ';
    for($i=1;$i<=$total_pages;$i++){
        if($i==$num_pages){
    $main.='
    '.$i.' 
    ';
        }else{
    $main.='
    <a href="'.$_SERVER['PHP_SELF'].'?'.$get_page_LinkVal.'page='.$i.'">'.$i.'</a> 
    ';
        }
    }
    $main.='
    </p>
    ';

    return $main;
}
function defHtml(){
    global $link;
    $main='
    預設格式
    ';
    return $main;
}
// die_content("測試");
?>