-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3307
-- 產生時間： 2022-06-06 19:13:12
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
-- 資料庫： `mrp`
--

-- --------------------------------------------------------

--
-- 資料表結構 `bom`
--

CREATE TABLE `bom` (
  `Pid` int(5) NOT NULL,
  `Order` int(5) NOT NULL,
  `Mid` int(5) NOT NULL,
  `Count` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `bom`
--

INSERT INTO `bom` (`Pid`, `Order`, `Mid`, `Count`) VALUES
(1, 1, 2, 10),
(1, 2, 1, 8),
(1, 3, 3, 20);

-- --------------------------------------------------------

--
-- 資料表結構 `material`
--

CREATE TABLE `material` (
  `Mid` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Stock` int(10) NOT NULL,
  `Lead Time` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `material`
--

INSERT INTO `material` (`Mid`, `Name`, `Stock`, `Lead Time`) VALUES
(1, '5公分鐵片', 10, 3),
(2, '10公分木材', 0, 5),
(3, '1公分釘子', 100, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

CREATE TABLE `order` (
  `Sid` int(5) NOT NULL,
  `Mid` int(5) NOT NULL,
  `Count` int(5) NOT NULL,
  `Status` int(5) NOT NULL DEFAULT 0,
  `Order_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `order`
--

INSERT INTO `order` (`Sid`, `Mid`, `Count`, `Status`, `Order_Date`) VALUES
(1, 2, 50, 0, '2022-06-06 18:11:54'),
(1, 1, 40, 0, '2022-06-06 18:12:10');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `Pid` int(5) NOT NULL,
  `PName` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`Pid`, `PName`) VALUES
(1, '桌子');

-- --------------------------------------------------------

--
-- 資料表結構 `schedule`
--

CREATE TABLE `schedule` (
  `Sid` int(5) NOT NULL,
  `Pid` int(5) NOT NULL,
  `Count` int(5) NOT NULL,
  `Deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `schedule`
--

INSERT INTO `schedule` (`Sid`, `Pid`, `Count`, `Deadline`) VALUES
(1, 1, 5, '2022-06-10');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `bom`
--
ALTER TABLE `bom`
  ADD PRIMARY KEY (`Pid`,`Order`);

--
-- 資料表索引 `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`Mid`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Pid`);

--
-- 資料表索引 `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`Sid`,`Pid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `material`
--
ALTER TABLE `material`
  MODIFY `Mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `Pid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `schedule`
--
ALTER TABLE `schedule`
  MODIFY `Sid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
