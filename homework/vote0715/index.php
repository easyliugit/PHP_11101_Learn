<?php
require("steup.php");
// 接收傳遞值
$action=$_REQUEST['action'];
// 顯示頁面與資料庫存取
switch($action){
    case "users_add_form":
    $content=voteWeb(users_add_form());
    break; 
    default:
    $content=voteWeb(users_list());
}
echo $content;
function users_add_form(){
    global $link;
    $main='
    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
    <fieldset>
        <legend>新增使用者資料</legend>
        <dl>
            <dt>使用帳號</dt>
            <dd><input type="text" name="u_user" id="u_user"></dd>
            <dt>使用密碼</dt>
            <dd><input type="password" name="u_pw" id="u_pw"></dd>
            <dt>暱稱</dt>
            <dd><input type="text" name="u_nick" id="u_nick"></dd>
            <dt>電子郵件</dt>
            <dd><input type="email" name="u_email" id="u_email"></dd>
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
    使用者資料清單
    ';
    return $main;
}
?>