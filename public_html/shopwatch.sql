-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 04, 2017 lúc 07:59 SA
-- Phiên bản máy phục vụ: 10.1.21-MariaDB
-- Phiên bản PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopwatch`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `id_brand` int(11) NOT NULL,
  `name_brand` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `brand`
--

INSERT INTO `brand` (`id_brand`, `name_brand`) VALUES
(1, 'Rolex'),
(2, 'Movado'),
(3, 'Tissot'),
(4, 'Bulova'),
(5, 'Micheal Kors'),
(6, 'Omega'),
(7, 'Citizen');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `watch`
--

CREATE TABLE `watch` (
  `id_watch` int(11) NOT NULL,
  `name_watch` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `price_watch` int(11) NOT NULL,
  `sale_watch` int(11) NOT NULL,
  `size_watch` int(11) NOT NULL,
  `color_watch` varchar(255) NOT NULL,
  `sex_watch` varchar(255) NOT NULL,
  `img_1` varchar(255) DEFAULT NULL,
  `img_2` varchar(255) DEFAULT NULL,
  `img_3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `watch`
--

INSERT INTO `watch` (`id_watch`, `name_watch`, `brand_id`, `price_watch`, `sale_watch`, `size_watch`, `color_watch`, `sex_watch`, `img_1`, `img_2`, `img_3`) VALUES
(1, 'Museum Black Dial Black Leather Strap Men\'s Watch', 2, 5625000, 10, 38, 'Black', 'Men', 'https://cdn2.jomashop.com/media/catalog/product/cache/1/watermark/490x490/0a1186946c551c1cc1f1a1120b7bd9a0/m/o/movado-museum-black-dial-black-leather-strap-men_s-watch-2100002_5.jpg', 'https://cdn2.jomashop.com/media/catalog/product/cache/1/watermark/490x490/0a1186946c551c1cc1f1a1120b7bd9a0/m/o/movado-museum-black-dial-black-leather-strap-men_s-watch-2100002_3_2.jpg', NULL),
(2, 'Series 800 Chronograph Black Dial Men\'s Watch', 2, 10470000, 20, 42, 'Bạc', 'Men', 'https://cdn2.jomashop.com/media/catalog/product/cache/1/watermark/490x490/0a1186946c551c1cc1f1a1120b7bd9a0/m/o/movado-series-800-quartz-chronograph-black-dial-men_s-watch-2600096_5.jpg', 'https://cdn2.jomashop.com/media/catalog/product/m/o/movado-series-800-quartz-chronograph-black-dial-men_s-watch-2600096_2_2.jpg', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Chỉ mục cho bảng `watch`
--
ALTER TABLE `watch`
  ADD PRIMARY KEY (`id_watch`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT cho bảng `watch`
--
ALTER TABLE `watch`
  MODIFY `id_watch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
