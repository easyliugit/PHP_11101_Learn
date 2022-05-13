<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的萬年曆</title>
    <style>
        .calendar {
            width: 450px;
            height: 350px;
            background: #fff;
            box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);
        }

        .body-list ul {
            width: 100%;
            font-family: arial;
            font-weight: bold;
            font-size: 14px;
        }

        .body-list ul li {
            width: 14.28%;
            height: 36px;
            line-height: 36px;
            list-style-type: none;
            display: block;
            box-sizing: border-box;
            float: left;
            text-align: center;
        }

        .lightgrey {
            color: #a8a8a8;
            /*已過*/
        }

        .darkgrey {
            color: #565656;
            /*未到*/
        }

        .green {
            color: #6ac13c;
            /*當日*/
        }

        .greenbox {
            border: 1px solid #6ac13c;
            background: #e9f8df;
            /*當日背景*/
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
    <h1>我的萬年曆</h1>
    <?php
    $month = 5;
    $nowday = 9;

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
    <div class="calendar">
        <div class="body">
            <div class="lightgrey body-list">
                <ul>
                    <li>日</li>
                    <li>一</li>
                    <li>二</li>
                    <li>三</li>
                    <li>四</li>
                    <li>五</li>
                    <li>六</li>
                </ul>
            </div>
            <div class="darkgrey body-list">
                <ul id="days">
                    <?php
                    foreach ($dateHouse as $k => $day) {
                        // $hol = ($k % 7 == 0 || $k % 7 == 6) ? 'darkgrey' : "";

                        if (!empty($day)) {
                            $dayFormat = date("j", strtotime($day));
                            if ($dayFormat > $nowday - 1) {
                                echo "<li class='darkgrey'>{$dayFormat}</li>";
                            }else{
                                echo "<li class='lightgrey'>{$dayFormat}</li>";
                            }
                        } else {
                            echo "<li></li>";
                        }
                    }

                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>