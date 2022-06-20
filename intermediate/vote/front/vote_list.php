<div>
        <ul class='list'>
            <li class='list-header'>
                <div>投票主題</div>
                <?php
                if(isset($_GET['type']) && $_GET['type']=='asc'){
                ?>
                <div><a href="?order=multiple&type=desc">單/複選題</a></div>
                <?php
                }else{
                ?>
                <div><a href="?order=multiple&type=asc">單/複選題</a></div>
                <?php
                }
                ?>
                <?php
                if(isset($_GET['type']) && $_GET['type']=='asc'){
                ?>
                <div><a href="?order=end&type=desc">投票期間</a></div>
                <?php
                }else{
                ?>
                <div><a href="?order=end&type=asc">投票期間</a></div>   
                <?php
                }
                ?>
                <?php
                if(isset($_GET['type']) && $_GET['type']=='asc'){
                ?>
                    <div><a href="?order=remain&type=desc">剩餘天數</a></div> 
                <?php 
                }else{
                ?>
                    <div><a href="?order=remain&type=asc">剩餘天數</a></div>
                <?php
                    }
                ?>
                <?php
                if(isset($_GET['type']) && $_GET['type']=='asc'){
                ?>
                <div><a href='?order=total&type=desc'>投票人數</a></div>
                <?php
                }else{
                ?>
                <div><a href='?order=total&type=asc'>投票人數</a></div>
                <?php
                }
                ?>
                
            </li>
        <?php
            //偵測是否需要排序
            $orderStr='';
            if(isset($_GET['order'])){
                $_SESSION['order']['col']=$_GET['order'];
                $_SESSION['order']['type']=$_GET['type'];

                if($_GET['order']=='remain'){
                    $orderStr=" ORDER BY DATEDIFF(`end`,now()) {$_SESSION['order']['type']}";
                }else{
                    $orderStr=" ORDER BY `{$_SESSION['order']['col']}` {$_SESSION['order']['type']}";
                }
                

            }
            //使用all()函式來取得資料表subjects中的所有資料，請參考base.php中的函式all($table,...$arg)
            $subjects=all('subjects',$orderStr);

            //使用迴圈將每一筆資料的內容顯示在畫面上
            foreach($subjects as $subject){
                echo "<a href='?do=vote_result&id={$subject['id']}'>";
                echo "<li class='list-items'>";
                echo "<div>{$subject['subject']}</div>";
                if($subject['multiple']==0){
                    echo "<div class='text-center'>單選題</div>";
                }else{
                    echo "<div class='text-center'>複選題</div>";
                }
                echo "<div class='text-center'>";
                echo $subject['start']. " ~ ".$subject['end'];
                echo "</div>";
                echo "<div class='text-center'>";
                    $today=strtotime("now");
                    $end=strtotime($subject['end']);
                    if(($end-$today)>0){
                        $remain=floor(($end-$today)/(60*60*24));
                        echo "倒數".$remain."天結束";
                    }else{
                        echo "<span style='color:grey'>投票已結束</span>";
                    }
                
                echo "</div>";
                echo "<div class='text-center'>{$subject['total']}</div>";
                echo "</li>";
                echo "</a>";
            }

        ?>
        </ul>

    </div>