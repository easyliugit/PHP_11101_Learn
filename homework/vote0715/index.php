<?php
require("steup.php");
// 接收傳遞值
$action=$_REQUEST['action'];
// 顯示頁面與資料庫存取
switch($action){
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
            // die_content("測試= 此帳號可以使用");
            users_add($db_link);
            $Msg = "帳號建立完成，請重新登入";
            header("location:{$_SERVER['PHP_SELF']}?Msg={$Msg}");
        }
    case "users_add_form":
        $content=voteWeb(users_add_form());
    break;
    case "users_list":
        $content=voteWeb(users_list());
    break;
    default:
        $content=voteWeb(votes_list());
}
echo $content;

function users_add($db_link){
    global $link;
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
    $MsgFinUser = $MsgFinUser;
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
    global $link;
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
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>編輯|刪除</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="8"></td>
        </tr>
    </tfoot>
</table>
    ';
    return $main;
}
function votes_list(){
    global $link;
    $main='
    <p>'.$_GET["Msg"].'</p>
    <p>投票清單</p>
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
?>