-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2022 年 07 月 10 日 16:51
-- 伺服器版本： 10.7.3-MariaDB
-- PHP 版本： 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `s1110201`
--

-- --------------------------------------------------------

--
-- 資料表結構 `votedb_logs`
--

CREATE TABLE `votedb_logs` (
  `l_id` int(11) UNSIGNED NOT NULL COMMENT '主索引',
  `users_id` int(11) UNSIGNED DEFAULT NULL COMMENT '投票者',
  `subjects_id` int(11) UNSIGNED NOT NULL COMMENT '投票主題',
  `options_id` int(11) UNSIGNED NOT NULL COMMENT '投票項目',
  `l_time` datetime DEFAULT NULL COMMENT '投票時間',
  `l_ip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '投票者ip'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `votedb_options`
--

CREATE TABLE `votedb_options` (
  `o_id` int(11) UNSIGNED NOT NULL COMMENT '主索引',
  `subjects_id` int(11) UNSIGNED NOT NULL COMMENT '投票主題',
  `o_option` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '選項'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `votedb_subjects`
--

CREATE TABLE `votedb_subjects` (
  `s_id` int(11) UNSIGNED NOT NULL COMMENT '主索引',
  `s_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '主題',
  `types_id` int(11) UNSIGNED DEFAULT 1 COMMENT '投票類別',
  `s_choice` enum('check','radio') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'radio' COMMENT '單/複選',
  `s_choice_num` tinyint(2) NOT NULL DEFAULT 1 COMMENT '單/複選項目數',
  `users_id` int(11) UNSIGNED NOT NULL DEFAULT 1 COMMENT '建立者',
  `s_date` date NOT NULL COMMENT '建立日期',
  `s_date_start` date DEFAULT NULL COMMENT '投票開始日期',
  `s_date_end` date DEFAULT NULL COMMENT '投票結束日期',
  `s_hits` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '人氣',
  `s_close` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '開關'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `votedb_types`
--

CREATE TABLE `votedb_types` (
  `t_id` int(11) UNSIGNED NOT NULL COMMENT '主索引',
  `t_name` int(100) UNSIGNED NOT NULL COMMENT '類別名稱',
  `t_sort` int(11) DEFAULT NULL COMMENT '排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `votedb_users`
--

CREATE TABLE `votedb_users` (
  `u_id` int(11) UNSIGNED NOT NULL COMMENT '主索引',
  `u_user` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '帳號',
  `u_pw` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密碼',
  `u_nick` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '暱稱',
  `u_lv` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user' COMMENT '權限',
  `u_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '信箱',
  `u_login` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '登入次數',
  `u_logintime` datetime DEFAULT NULL COMMENT '登入時間',
  `u_jointime` datetime NOT NULL COMMENT '加入時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `votedb_users`
--

INSERT INTO `votedb_users` (`u_id`, `u_user`, `u_pw`, `u_nick`, `u_lv`, `u_email`, `u_login`, `u_logintime`, `u_jointime`) VALUES
(1, 'voteadmin', '$2y$10$OwfU2P3QhXERkuobNob7t.I4pOn/0U5JBuhyg1ms7Z/ORKaVHLZPu', 'admin', 'admin', 'easy19050711@gmail.com', 0, NULL, '2022-07-09 22:32:54'),
(2, 'mark', '$2y$10$Csk1hDwjmFPDgbDFF7DhaOrSSNaCtDA1COLxYzt5WQPQWUETzjBl6', 'mark', 'admin', '', 8, '2022-07-10 22:34:08', '2022-07-10 00:55:49'),
(4, '123', '$2y$10$nj/Xm6mXiCBQte.tg1F3kuLg3bxIWuBgpRfn3pOTffpO3Rl/A3VG2', '567', 'user', '', 1, '2022-07-10 22:06:34', '2022-07-10 17:11:41');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `votedb_logs`
--
ALTER TABLE `votedb_logs`
  ADD PRIMARY KEY (`l_id`);

--
-- 資料表索引 `votedb_options`
--
ALTER TABLE `votedb_options`
  ADD PRIMARY KEY (`o_id`);

--
-- 資料表索引 `votedb_subjects`
--
ALTER TABLE `votedb_subjects`
  ADD PRIMARY KEY (`s_id`);

--
-- 資料表索引 `votedb_types`
--
ALTER TABLE `votedb_types`
  ADD PRIMARY KEY (`t_id`);

--
-- 資料表索引 `votedb_users`
--
ALTER TABLE `votedb_users`
  ADD PRIMARY KEY (`u_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `votedb_logs`
--
ALTER TABLE `votedb_logs`
  MODIFY `l_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主索引';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `votedb_options`
--
ALTER TABLE `votedb_options`
  MODIFY `o_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主索引';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `votedb_subjects`
--
ALTER TABLE `votedb_subjects`
  MODIFY `s_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主索引';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `votedb_types`
--
ALTER TABLE `votedb_types`
  MODIFY `t_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主索引';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `votedb_users`
--
ALTER TABLE `votedb_users`
  MODIFY `u_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主索引', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
