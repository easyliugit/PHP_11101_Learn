<?php
//先設定一個空的分頁字串變數
$p = "";

//如果網址中帶有分頁的參數則將變數設為參數的值
if (isset($_GET['p'])) {
    $p = "&p={$_GET['p']}";
}
//先設定一個空的排序字串變數
$querystr = "";

//如果網址中帶有排序的參數則將變數設為參數的值
if (isset($_GET['order'])) {
    $querystr = "&order={$_GET['order']}&type={$_GET['type']}";
}

//先設定一個空的分類字串變數
$queryfilter = "";

//如果網址中帶有分類的參數則將變數設為參數的值
if (isset($_GET['filter'])) {
    $queryfilter = "&filter={$_GET['filter']}";
}

?>
<div>
    <label for="types">分類</label>
    <!--建立一個選單事件，當選單被選擇到不一樣的項目時會觸發onchange事件，此事件會在網址中帶入相關的參數-->
    <select name="types" id="types" onchange="location.href=`?filter=${this.value}<?=$p;?><?=$querystr;?>`">
        <option value="0">全部</option>
        <?php
        //顯示分類下拉選單，根據網址的分類參數值，可以讓每次重整分類時都維持之前的選擇
        $types = all("types");
        foreach ($types as $type) {
            $selected = (isset($_GET['filter']) && $_GET['filter'] == $type['id']) ? 'selected' : '';
            echo "<option value='{$type['id']}' $selected>";
            echo $type['name'];
            echo "</option>";
        }
        ?>
    </select>
</div>
<div>
    <ul class='list'>
        <li class='list-header'>
            <div>投票主題</div>
            <!-- 在標題連結上加入排序的參數，根據當前網址帶入的排序做切換
              -- 比如當這次的排序方式為由大到小時，則連結的排序參數為由小到大
              -- 表示下一次點這個連結時會改以由小到大的方式排序      -->
            <?php
                if (isset($_GET['type']) && $_GET['type'] == 'asc') {
            ?>
            <div><a href="?order=multiple&type=desc<?=$p;?><?=$queryfilter;?>">單/複選題</a></div>
            <?php
                } else {
            ?>
            <div><a href="?order=multiple&type=asc<?=$p;?><?=$queryfilter;?>">單/複選題</a></div>
            <?php
                }
            ?>
            <?php
                if (isset($_GET['type']) && $_GET['type'] == 'asc') {
            ?>
            <div><a href="?order=end&type=desc<?=$p;?><?=$queryfilter;?>">投票期間</a></div>
            <?php
                } else {
            ?>
            <div><a href="?order=end&type=asc<?=$p;?><?=$queryfilter;?>">投票期間</a></div>
            <?php
                }
            ?>
            <?php
                if (isset($_GET['type']) && $_GET['type'] == 'asc') {
            ?>
            <div><a href="?order=remain&type=desc<?=$p;?><?=$queryfilter;?>">剩餘天數</a></div>
            <?php
                } else {
            ?>
            <div><a href="?order=remain&type=asc<?=$p;?><?=$queryfilter;?>">剩餘天數</a></div>
            <?php
              }
            ?>
            <?php
                if (isset($_GET['type']) && $_GET['type'] == 'asc') {
            ?>
            <div><a href='?order=total&type=desc<?=$p;?><?=$queryfilter;?>'>投票人數</a></div>
            <?php
                } else {
            ?>
            <div><a href='?order=total&type=asc<?=$p;?><?=$queryfilter;?>'>投票人數</a></div>
            <?php
                }
            ?>

        </li>
        <?php
//偵測是否需要排序
//先建立一個空的字串
$orderStr = '';

//當網址有帶排序的參數時，將排序的參數先存入到session中
if (isset($_GET['order'])) {
    $_SESSION['order']['col'] = $_GET['order'];
    $_SESSION['order']['type'] = $_GET['type'];

    //特殊排序，倒數天數為特殊的排序方式，因此另外獨立出來處理
    //在此處理建立排序用的SQL語法字串，用來代入後面的資料查卜口
    if ($_GET['order'] == 'remain') {
        $orderStr = " ORDER BY DATEDIFF(`end`,now()) {$_SESSION['order']['type']}";
    } else {
        $orderStr = " ORDER BY `{$_SESSION['order']['col']}` {$_SESSION['order']['type']}";
    }

}

//建立一個分類過濾用的空陣列
$filter = [];

//判斷網址中是否帶有分類參數
if (isset($_GET['filter'])) {
    //如果分類項目不是0，則在空陣列中加入分類id
    if (!$_GET['filter'] == 0) {
        $filter = ['type_id' => $_GET['filter']];
    }
}

//建立分頁所需的變數群
$total = math('subjects', 'count', 'id', $filter);  //計算指定條件的資料總筆數
$div = 3;                                           //每頁資料筆數
$pages = ceil($total / $div);                       //計算總頁數
$now = isset($_GET['p']) ? $_GET['p'] : 1;          //從網址參數取得目前所在頁數
$start = ($now - 1) * $div;                         //計算要從那個索引開始取得資料
$page_rows = " limit $start,$div";                  //建立SQL語法的limit字串

//使用all()函式來取得資料表subjects中的所有資料，請參考base.php中的函式all($table,...$arg)
$subjects = all('subjects', $filter, $orderStr . $page_rows);

//使用迴圈將每一筆資料的內容顯示在畫面上
foreach ($subjects as $subject) {
    echo "<a href='?do=vote_result&id={$subject['id']}'>";
    echo "<li class='list-items'>";
    echo "<div>{$subject['subject']}</div>";
    if ($subject['multiple'] == 0) {
        echo "<div class='text-center'>單選題</div>";
    } else {
        echo "<div class='text-center'>複選題</div>";
    }
    echo "<div class='text-center'>";
    echo $subject['start'] . " ~ " . $subject['end'];
    echo "</div>";
    echo "<div class='text-center'>";
    
    //計算倒數天數，結束日—今天
    $today = strtotime("now");
    $end = strtotime($subject['end']);
    if (($end - $today) > 0) {
        $remain = floor(($end - $today) / (60 * 60 * 24));
        echo "倒數" . $remain . "天結束";
    } else {
        echo "<span style='color:grey'>投票已結束</span>";
    }

    echo "</div>";
    echo "<div class='text-center'>{$subject['total']}</div>";
    echo "</li>";
    echo "</a>";
}

?>
    </ul>
    <div class="text-center">
        <?php
        //在列表下方顯示頁碼及連結
        if ($pages > 1) {
            for ($i = 1; $i <= $pages; $i++) {
                
                //同時帶入網址的分頁及排序參數，用來記憶頁面行為的狀態
                echo "<a href='?p={$i}{$querystr}{$queryfilter}'>&nbsp;";
                echo $i;
                echo "&nbsp;</a>";
            }
        }

?>
    </div>
</div>