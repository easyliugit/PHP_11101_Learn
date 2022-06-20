<?php
// 是否有來自其他頁面的月份參數傳遞
if (isset($_GET['month'])) {
	$month = $_GET['month'];
	$year = $_GET['year'];
} else {
	$month = date('n');
	$year = date("Y");
}

// 前後頁月份參數傳遞預設值   
switch ($month) {
	case 1:
		$prevMonth = 12;
		$prevYear = $year - 1;
		$nextMonth = $month + 1;
		$nextYear = $year;
		break;
	case 12:
		$prevMonth = $month - 1;
		$prevYear = $year;
		$nextMonth = 1;
		$nextYear = $year + 1;
		break;
	default:
		$prevMonth = $month - 1;
		$prevYear = $year;
		$nextMonth = $month + 1;
		$nextYear = $year;
}


// 設定月曆用參數 
$firstDay = $year . "-" . $month . "-1"; // 當月第一天日期"Y-m-d"
$firstWeekday = date("w", strtotime($firstDay)); // 當月第一天在星期幾
$monthDays = date("t", strtotime($firstDay)); // 當月總天數
$lastDay = $year . "-" . $month . "-" . $monthDays; // 當月最後一天日期"Y-m-d"
$lastWeekday = date("w", strtotime($lastDay)); // 當月最後一天在星期幾
$today = date("Y-m-d");
$dateHouse = [];
$months = array("一月"=>"1", "二月"=>"2", "三月"=>"3", "四月"=>"4", "五月"=>"5", "六月"=>"6", "七月"=>"7", "八月"=>"8", "九月"=>"9", "十月"=>"10", "十一月"=>"11", "十二月"=>"12");
$festivals = array(
	"開國紀念日"=>"01-01","獸醫師節"=>"01-06","司法節"=>"01-11","藥師節"=>"01-15","消防節"=>"01-19","自由日"=>"01-23",
	"觀光節"=>"02-12","情人節"=>"02-14","戲劇節"=>"02-15","炬光節"=>"02-19","和平紀念日"=>"02-28",
	"兵役節"=>"03-01","童子軍節"=>"03-05","婦女節"=>"03-08","國父逝世紀念日"=>"03-12","白色情人節"=>"03-14","國醫節"=>"03-17","郵政節"=>"03-20","氣象節"=>"03-21","美術節"=>"03-25","廣播電視節"=>"03-26","青年節"=>"03-29",
	"主計日"=>"04-01","兒童節"=>"04-04","清明節"=>"04-05","衛生節"=>"04-07",
	"勞動節"=>"05-01","牙醫師節"=>"05-04","護士節"=>"05-12",
	"禁煙節"=>"06-03","工程師節"=>"06-06","鐵路節"=>"06-09","警察節"=>"06-15",
	"漁民節"=>"07-01","航海節"=>"07-11",
	"父親節"=>"08-08",
	"記者節"=>"09-01","軍人節"=>"09-03","體育節"=>"09-09","教師節"=>"09-28",
	"國慶日"=>"10-10","華僑節"=>"10-21","台灣光復節"=>"10-25","萬聖節"=>"10-31",
	"商人節"=>"11-01","工業節"=>"11-11","國父誕辰紀念日"=>"11-12","防空節"=>"11-21",
	"聖誕節"=>"12-25","建築師節"=>"12-27","電信節"=>"12-28");

// 開始組合月曆存入陣列
// 當月一號以前註記空白
for ($i = 0; $i < $firstWeekday; $i++) {
	$dateHouse[] = "";
}
// 當月全部日期
for ($i = 0; $i < $monthDays; $i++) {
	$date = date("Y-m-d", strtotime("+$i days", strtotime($firstDay)));
	$dateHouse[] = $date;
}
// 當月最後一天以後註記空白
for ($i = 0; $i < (6 - $lastWeekday); $i++) {
	$dateHouse[] = "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP 萬年曆</title>
	<link rel="stylesheet" href="./css/style.css">
</head>

<body>
	<div class="calendar_body">
		<header class="header">
			<h1>PHP 萬年曆</h1>
		</header>
		<Section class="calendar_year">
			<a href='index.php?year=<?= $prevYear-1; ?>&month=<?= $month; ?>'><?= $prevYear-1; ?>年</a>
			<a href='#' class="year_thisday"><?php echo $year;?>年</a>
			<a href='index.php?year=<?= $nextYear+1; ?>&month=<?= $month; ?>'><?= $prevYear+1; ?>年</a>
		</Section>
		<section class="calendar_month">
			<?php
			foreach ($months as $key => $value) {
				if ($month != $value) {
					echo "<a href='index.php?year={$year}&month={$value}'>{$key}</a>";
				}else {
					echo "<a href='#' class='month_thisday'>{$key}</a>";
				}
				
			}
			?>
		</section>
		<section class="calendar_day_th">
			<div class="bg_color_holi">週日</div>
			<div>週一</div>
			<div>週二</div>
			<div>週三</div>
			<div>週四</div>
			<div>週五</div>
			<div class="bg_color_holi">週六</div>			
		</section>
		<section class="calendar_week">
			<?php

			// 依據月曆陣列畫格子，並帶入月曆值
			foreach ($dateHouse as $k => $day) {
				// 是否為假日套用.weekend CSS樣式
				$dayFormat = (!empty($day)) ? date("j", strtotime($day)) : ""; // 是否帶入日期
				$bg_color_holi = ($k % 7 == 0 || $k % 7 == 6) ? ' bg_color_holi' : ""; //是否六日
				$bg_color_today = ($today == $day) ? ' bg_color_today' : ""; //是否今天

				foreach ($festivals as $key => $value) {
					if (!empty($day) && $value == date("m-d", strtotime($day))) {
						$festival_val = $key;
						break;
					}else{
						$festival_val = "";
					}
				}
				echo "<div class='calendar_day{$bg_color_holi}{$bg_color_today}'>";
				echo "<span class='calendar_date'>{$dayFormat}</span>";
				// 是否帶入日期
				// if (!empty($day)) {
				// 	$dayFormat = date("j", strtotime($day));
				// 	echo "<span class='calendar_date'>{$dayFormat}</span>";
				// } else {
				// 	echo "<span class='calendar_date'></span>";
				// }
				echo "<span class='calendar_task'>-{$festival_val}</span>";
				echo "</div>";
			}

			?>
		</section>		

	</div>
</body>

</html>