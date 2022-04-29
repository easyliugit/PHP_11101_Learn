<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>線上月曆製作</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table td {
            padding: 5px;
            text-align: center;
            border: 1px solid #aaa;
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
    <a href="pra06.php">線上月曆製作_使用陣列pra06_arry.php</a><br>
    <h1>線上月曆製作_使用陣列</h1>
    <?php
    $month = 4;

    ?>
    <table>
        <tr>
            <td>日</td>
            <td>一</td>
            <td>二</td>
            <td>三</td>
            <td>四</td>
            <td>五</td>
            <td>六</td>
        </tr>
        <?php

        $firstDay = date("Y-") . $month . "-1";
        $firstWeekday = date("w", strtotime($firstDay));
        $monthDays = date("t", strtotime($firstDay));
        $lastDay = date("Y-") . $month . "-" . $monthDays;
        $today = date("Y-m-d");

        $dateHouse = [];
        for ($i = 0; $i < $monthDays; $i++) {
            $date = date("Y-m-d", strtotime("+$i days", strtotime($firstDay)));
            $dateHouse[] = $date;
        }

        echo "<pre>";
        print_r($dateHouse);
        echo "</pre>";

        echo "月份" . $month;
        echo "<br>";
        echo "第一天是" . $firstDay;
        echo "<br>";
        echo "第一天是星期" . $firstWeekday;
        echo "<br>";
        echo "最後一天是" . $lastDay;
        echo "<br>";
        echo "當月天數共" . $monthDays;
        echo "<br>";
        for ($i = 0; $i < 6; $i++) {
            echo "<tr>";

            for ($j = 0; $j < 7; $j++) {
                $d = $i * 7 + ($j + 1) - $firstWeekday - 1;

                if ($d >= 0 && $d < $monthDays) {
                    $fs = strtotime($firstDay);
                    $shiftd = strtotime("+$d days", $fs);
                    $date = date("d", $shiftd);
                    $w = date("w", $shiftd);
                    $chktoday = "";
                    if (date("Y-m-d", $shiftd) == $today) {
                        $chktoday = 'today';
                    }
                    //$date=date("Y-m-d",strtotime("+$d days",strtotime($firstDay)));
                    if ($w == 0 || $w == 6) {
                        echo "<td class='weekend $chktoday' >";
                    } else {
                        echo "<td class='workday $chktoday'>";
                    }
                    echo $date;
                    echo "</td>";
                } else {
                    echo "<td></td>";
                }
            }

            echo "</tr>";
        }



        ?>


    </table>
</body>

</html>