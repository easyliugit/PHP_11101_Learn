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
function voteWeb($content=""){
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
                  <li><a href="#">登入</a></li>
                  <li><a href="'.$_SERVER['PHP_SELF'].'?action=users_add_form">註冊</a></li>
              </ul>
          </header>
          <div class="box">
              <nav>
                  <ul>
                      <li><a href="#">全部 ()</a></li>
                      <li><a href="#">生活 ()</a></li>
                  </ul>
              </nav>
              <article>
                  <nav>
                      <ul>
                          <li><a href="#">綜合排行</a></li>
                          <li><a href="#">人氣排行</a></li>
                          <li><a href="#">新發起的</a></li>
                          <li><a href="#">即將結束</a></li>
                      </ul>
                      <ul class="new_vote">
                          <li><a href="#">新增投票</a></li>
                      </ul>
                  </nav>
                  <nav>
                      <ul>
                          <li><a href="#">我的主題</a></li>
                          <li><a href="#">修改個人資料</a></li>
                      </ul>
                      <ul class="new_vote">
                          <li><a href="#">使用者清單</a></li>
                      </ul>
                  </nav>
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