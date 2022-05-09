<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>線上月曆製作</title>
    <style>
        .table {
            width: 560px;
            height: 560px;
            /* border:1px solid green; */
            display: flex;
            flex-wrap: wrap;
            align-content: baseline;
            margin-left: 1px;
            margin-top: 1px;
        }

        .table div {
            display: inline-block;
            width: 80px;
            height: 80px;
            border: 1px solid #999;
            box-sizing: border-box;
            margin-left: -1px;
            margin-top: -1px;
        }

        .table div.header {
            background: black;
            color: white;
            height: 32px;
            ;
        }

        .weekend {
            background: pink;
        }

        .workday {
            background: white;
        }

        .today {
            background: lightseagreen;
        }
    </style>
</head>

<body>
    <a href="../index.php">回首頁index.php</a> > <a href="index.php">[基礎課程] Lesson 5 時間及日期處理</a><br>
    <a href="pra01.php">日期時間練習pra01.php</a><br>
    <a href="pra02.php">給定兩個日期，計算中間間隔天數pra02.php</a><br>
    <a href="pra03.php">計算距離自己下一次生日還有幾天字串組合pra03.php</a><br>
    <a href="pra03_1.php">跨年或已過生日的時間差分問題討論pra03_1.php</a><br>
    <a href="pra04.php">時間格式練習pra04.php</a><br>
    <a href="pra05.php">使用程式控制時間pra05.php</a><br>
    <a href="pra06.php">線上月曆製作pra06.php</a><br>
    <a href="pra06_array.php">線上月曆製作_使用陣列pra06_array.php</a><br>
    <a href="pra06_flex.php">線上月曆製作_使用陣列Flexpra06_flex.php</a><br>
    <a href="pra07.php">我的萬年曆pra07.php</a><br>
    <h1>線上月曆製作_使用陣列Flex</h1>
    <?php
    $month = 2;


    $firstDay = date("Y-") . $month . "-1";
    $firstWeekday = date("w", strtotime($firstDay));
    $monthDays = date("t", strtotime($firstDay));
    $lastDay = date("Y-") . $month . "-" . $monthDays;
    $today = date("Y-m-d");
    $lastWeekday = date("w", strtotime($lastDay));
    $dateHouse = [];

    for ($i = 0; $i < $firstWeekday; $i++) {
        $dateHouse[] = "";
    }

    for ($i = 0; $i < $monthDays; $i++) {
        $date = date("Y-m-d", strtotime("+$i days", strtotime($firstDay)));
        $dateHouse[] = $date;
    }

    for ($i = 0; $i < (6 - $lastWeekday); $i++) {
        $dateHouse[] = "";
    }

    ?>

    <div class="table">
        <div class='header'>日</div>
        <div class='header'>一</div>
        <div class='header'>二</div>
        <div class='header'>三</div>
        <div class='header'>四</div>
        <div class='header'>五</div>
        <div class='header'>六</div>
        <?php
        foreach ($dateHouse as $k => $day) {
            $hol = ($k % 7 == 0 || $k % 7 == 6) ? 'weekend' : "";

            if (!empty($day)) {
                $dayFormat = date("j", strtotime($day));
                echo "<div class='{$hol}'>{$dayFormat}</div>";
            } else {
                echo "<div class='{$hol}'></div>";
            }
        }

        ?>
    </div>


    </table>
</body>

</html>