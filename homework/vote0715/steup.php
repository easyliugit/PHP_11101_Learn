<?php
//系統變數
$title="PHP 投票系統";
//傳遞值過濾
function FilterString($theValue, $theType) {
    switch ($theType) {
      case "string":
        $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_MAGIC_QUOTES) : "";
        break;
      case "int":
        $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_NUMBER_INT) : "";
        break;
      case "email":
        $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_EMAIL) : "";
        break;
      case "url":
        $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_URL) : "";
        break;      
    }
    return $theValue;
}
require_once("conndef.php");
// 中斷程式顯示錯誤訊息
function die_content($content=""){
  $main='
  <!DOCTYPE html>
  <html lang="zh-Hant-TW">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>輸出錯誤訊息</title>
    <link rel="stylesheet" href="./css/eorrdie.css">
  </head>
  <body>
    <article class="content">
      <section class="box">
        <h1>Die 錯誤訊息</h1>
        <p>'.$content.'</p>
        <a href="'._WEB_ROOT_URL.'"><h2>回到首頁</h2></a>
      </section>
    </article>
  </body>
  </html>
  ';
  die($main);
}
function GetIP(){
  if(!empty($_SERVER["HTTP_CLIENT_IP"])){
   $cip = $_SERVER["HTTP_CLIENT_IP"];
  }
  elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
   $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
  }
  elseif(!empty($_SERVER["REMOTE_ADDR"])){
   $cip = $_SERVER["REMOTE_ADDR"];
  }
  else{
   $cip = "無法取得IP位址！";
  }
  return $cip;
 }
function voteWeb($content=""){
  global $db_link;
  global $title;
  $main='
  <!DOCTYPE html>
  <html lang="zh-Hant-TW">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>'.$title.'</title>
      <link rel="stylesheet" href="./css/share.css">
  </head>
  <body>
      <div class="vote_body">
          <header>
              <a href="'.$_SERVER['PHP_SELF'].'"><h1>'.$title.'</h1></a>
              <ul>
  ';
  //檢查是否經過登入
  if(isset($_SESSION["l_u_user"]) && ($_SESSION["l_u_user"]!="")){
  $main.='
              <li>'.$_SESSION["l_u_user"].'，您好！</li>
              <li> <a href="'.$_SERVER['PHP_SELF'].'?action=login_out">登出</a></li>
  ';
  }else{
  $main.='
              <li><a href="'.$_SERVER['PHP_SELF'].'?action=login_users_form">登入</a></li>
              <li><a href="'.$_SERVER['PHP_SELF'].'?action=users_add_form">註冊</a></li>
  ';
  }
  $main.='
              </ul>
          </header>
          <div class="box">
              <nav>
                  <ul>
                  <!-- <li><a href="#">全部 ()</a></li> -->
  ';
                      // $sql_query="SELECT * FROM `votedb_types` WHERE t_name != '全部' ORDER BY t_sort ASC ,t_id DESC";
                      $sql_query="SELECT * FROM `votedb_types` ORDER BY t_sort ASC ,t_id DESC";
                      $stmt = $db_link->query($sql_query);
                      $row_result=$stmt->fetchAll();
                      $total_records = count($row_result);
                      if($total_records){
                        foreach($row_result as $item=>$row){                          
                          $sql_query="SELECT count(*) FROM `votedb_subjects` WHERE types_id = {$row['t_id']} AND s_del = '0' AND s_close = '0'";
                          $stmt = $db_link->query($sql_query);
                          $stmt->execute();
                          $total_records = $stmt->fetchColumn();

                          $main.='<li><a href="'.$_SERVER['PHP_SELF'].'?types_id='.$row["t_id"].'">'.$row['t_name'].' ('.$total_records.')</a></li>';
                        }
                      }
  $main.='
                  </ul>
              </nav>
              <article>
                  <nav>
                      <ul>
                          <li><a href="'.$_SERVER['PHP_SELF'].'">綜合排行</a></li>
                          <li><a href="'.$_SERVER['PHP_SELF'].'">人氣排行</a></li>
                          <li><a href="'.$_SERVER['PHP_SELF'].'">新發起的</a></li>
                          <li><a href="'.$_SERVER['PHP_SELF'].'">即將結束</a></li>
                      </ul>
                  </nav>
  ';
  //檢查是否經過登入
  if(isset($_SESSION["l_u_user"]) && ($_SESSION["l_u_user"]!="")){
  $main.='
                  <nav>
                      <ul>
                          <li><a href="'.$_SERVER['PHP_SELF'].'?action=votes_add_form">新增投票</a></li>
                          <li><a href="'.$_SERVER['PHP_SELF'].'?action=votes_my_list">我的主題</a></li>
                          <li><a href="'.$_SERVER['PHP_SELF'].'?action=users_update_form">修改個人資料</a></li>
                      </ul>
      ';
      if($_SESSION["l_u_lv"]=="admin"){
      $main.='
                      <ul class="new_vote">
                          <li><a href="'.$_SERVER['PHP_SELF'].'?action=users_list">使用者清單</a></li>
                      </ul>
      ';
      }
      $main.='
                  </nav>
  ';
  }
  $main.='
                  <section>
                  <!-- $content 開始 -->
                  '.$content.'
                  <!-- $content 結束 -->
              </section>
              </article>
          </div>
          <footer>
              <h3>版權所有© 泰山職訓PHP網頁設計11101 01劉峻誌</h3>
          </footer>
      </div>    
  </body>
  </html>
  ';
  return $main;
}
?>