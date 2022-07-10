<?php
require("steup.php");
// 接收傳遞值
$action=$_REQUEST['action'];
// 顯示頁面與資料庫存取
switch($action){
    case "users_update":
        users_update();
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
        $content=voteWeb(users_list());
    break;
    default:
        $content=voteWeb(votes_list());
}
echo $content;

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
        , $_POST["u_nick"]
        , $_POST["u_email"]
        , $_POST["u_id"]
    ));
    $stmt = null;
    $db_link = null;
    //重新導向回到主畫面
    header("location:{$_SERVER['PHP_SELF']}?action=users_list");
}
function users_update_form(){
    global $db_link;
    $sql_query="SELECT * FROM votedb_users WHERE u_id = {$_GET["u_id"]}";
    $stmt = $db_link->query($sql_query);
    $row=$stmt->fetch();
    if($row['u_lv']=='admin'){
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
            <dd><input type="password" name="u_pw" id="u_pw" value="">不修改密碼請保持空白</dd>
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
    //預設每頁筆數
    $pageRow_records = 3;
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
    <a href="'.$_SERVER['PHP_SELF'].'?action=users_update_form&u_id='.$row['u_id'].'">編輯</a> |<a href="#">刪除</a>
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
    <a href="index_page.php?page=1">第一頁</a> | 
    <a href="index_page.php?page='.$num_pages-1 .'">上一頁</a>
    ';
    }
    if ($num_pages < $total_pages) { // 若不是最後一頁則顯示
    $main.='
    <a href="index_page.php?page='.$num_pages+1 .'">下一頁</a> | 
    <a href="index_page.php?page='.$total_pages.'">最後頁</a>
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
    <a href="index_page.php?page='.$i.'">'.$i.'</a> 
    ';
        }
    }
    $main.='
    </p>
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
// die_content("測試users_list");
?>