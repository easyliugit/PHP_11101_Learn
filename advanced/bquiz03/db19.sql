-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-08-08 10:31:59
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `db19`
--

-- --------------------------------------------------------

--
-- 資料表結構 `movie`
--

CREATE TABLE `movie` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` int(10) UNSIGNED NOT NULL,
  `ondate` date NOT NULL,
  `publish` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `trailer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `poster` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` int(11) UNSIGNED NOT NULL,
  `sh` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `movie`
--

INSERT INTO `movie` (`id`, `name`, `level`, `length`, `ondate`, `publish`, `director`, `trailer`, `poster`, `intro`, `rank`, `sh`) VALUES
(1, '院線片01', '普遍級', 90, '2022-08-06', '院線片01發行商', '院線片01導演', '03B01v.mp4', '03B01.png', '院線片01的劇情介紹院線片01的劇情介紹院線片01的劇情介紹院線片01的劇情介紹院線片01的劇情介紹院線片01的劇情介紹院線片01的劇情介紹', 3, 0),
(2, '院線片02', '保護級', 90, '2022-08-07', '院線片02發行商', '院線片02導演', '03B02v.mp4', '03B02.png', '院線片02的劇情介紹院線片02的劇情介紹院線片02的劇情介紹院線片02的劇情介紹院線片02的劇情介紹院線片02的劇情介紹院線片02的劇情介紹', 4, 1),
(3, '院線片03', '輔導級', 90, '2022-08-08', '院線片03發行商', '院線片03導演', '03B03v.mp4', '03B03.png', '院線片03的劇情介紹院線片03的劇情介紹院線片03的劇情介紹院線片03的劇情介紹院線片03的劇情介紹院線片03的劇情介紹院線片03的劇情介紹', 2, 1),
(4, 'dfasdfasdfsaf', '限制級', 1111, '2022-09-09', '院線片04發行商', '院線片04導演', '03B07v.mp4', '03B04.png', 'afdsfasfsaf', 5, 1),
(5, '院線片05', '普遍級', 90, '2022-08-10', '院線片05發行商', '院線片05導演', '03B05v.mp4', '03B05.png', '院線片05的劇情介紹院線片05的劇情介紹院線片05的劇情介紹院線片05的劇情介紹院線片05的劇情介紹院線片05的劇情介紹院線片05的劇情介紹', 6, 1),
(6, '院線片06', '普遍級', 90, '2022-08-06', '院線片06發行商', '院線片06導演', '03B06v.mp4', '03B06.png', '院線片06的劇情介紹院線片06的劇情介紹院線片06的劇情介紹院線片06的劇情介紹院線片06的劇情介紹院線片06的劇情介紹院線片06的劇情介紹', 7, 1),
(7, '院線片07', '普遍級', 90, '2022-08-07', '院線片07發行商', '院線片07導演', '03B07v.mp4', '03B07.png', '院線片07的劇情介紹院線片07的劇情介紹院線片07的劇情介紹院線片07的劇情介紹院線片07的劇情介紹院線片07的劇情介紹院線片07的劇情介紹', 8, 1),
(8, '院線片08', '普遍級', 90, '2022-08-08', '院線片08發行商', '院線片08導演', '03B08v.mp4', '03B08.png', '院線片08的劇情介紹院線片08的劇情介紹院線片08的劇情介紹院線片08的劇情介紹院線片08的劇情介紹院線片08的劇情介紹院線片08的劇情介紹', 9, 1),
(9, '院線片09', '普遍級', 90, '2022-08-09', '院線片09發行商', '院線片09導演', '03B09v.mp4', '03B09.png', '院線片09的劇情介紹院線片09的劇情介紹院線片09的劇情介紹院線片09的劇情介紹院線片09的劇情介紹院線片09的劇情介紹院線片09的劇情介紹', 10, 1),
(10, '院線片10', '普遍級', 90, '2022-08-10', '院線片10發行商', '院線片10導演', '03B10v.mp4', '03B10.png', '院線片10的劇情介紹院線片10的劇情介紹院線片10的劇情介紹院線片10的劇情介紹院線片10的劇情介紹院線片10的劇情介紹院線片10的劇情介紹', 11, 1),
(11, '院線片11', '普遍級', 90, '2022-08-09', '院線片11發行商', '院線片11導演', '03B11v.mp4', '03B11.png', '院線片11的劇情介紹院線片11的劇情介紹院線片11的劇情介紹院線片11的劇情介紹院線片11的劇情介紹院線片11的劇情介紹院線片11的劇情介紹', 12, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `poster`
--

CREATE TABLE `poster` (
  `id` int(11) UNSIGNED NOT NULL,
  `img` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` int(11) UNSIGNED NOT NULL,
  `sh` int(1) UNSIGNED NOT NULL,
  `ani` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `poster`
--

INSERT INTO `poster` (`id`, `img`, `name`, `rank`, `sh`, `ani`) VALUES
(1, '03A01.jpg', '蠟筆小新：幽靈忍者珍風傳', 3, 0, 3),
(3, '03A03.jpg', '預告片03', 1, 1, 3),
(4, '03A04.jpg', '預告片04', 4, 1, 2),
(5, '03A05.jpg', '預告片05', 19, 1, 3),
(6, '03A06.jpg', '預告片07', 9, 1, 2),
(7, '03A07.jpg', '預告片07', 14, 1, 1),
(8, '03A08.jpg', '預告片08', 2, 1, 2),
(9, '03A09.jpg', '預告片09', 5, 1, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;