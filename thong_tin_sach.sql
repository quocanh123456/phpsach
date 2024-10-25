-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 25, 2024 lúc 10:01 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_hua_quoc_anh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thong_tin_sach`
--

CREATE TABLE `thong_tin_sach` (
  `id_sach` int(11) NOT NULL,
  `ten_sach` varchar(255) NOT NULL,
  `nha_xb` varchar(255) DEFAULT NULL,
  `nam_xb` year(4) DEFAULT NULL,
  `the_loai` varchar(100) DEFAULT NULL,
  `so_luong` int(11) DEFAULT 0,
  `gia_ban` decimal(10,2) DEFAULT NULL,
  `link_anh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thong_tin_sach`
--

INSERT INTO `thong_tin_sach` (`id_sach`, `ten_sach`, `nha_xb`, `nam_xb`, `the_loai`, `so_luong`, `gia_ban`, `link_anh`) VALUES
(97, 'Harry Potter và chiếc cốc lửa', ' NXB Trẻ', 2020, 'Tiểu thuyết', 10, '150000.00', ' img/nxbtre_full_20342017_033410.u4972.d20170426.t163428.208230.jpg'),
(98, 'Harry Potter và tên tù nhân ngục Azshkaban', ' NXB Trẻ', 2020, 'Tiểu thuyết', 10, '170000.00', ' img/tunhan.jpg'),
(99, 'Harry Potter và hòn đá phù thủy', ' NXB Trẻ', 2020, 'Tiểu thuyết', 10, '200000.00', ' img/Harry-Potter-va-Hon-da-phu-thuy.jpg'),
(100, 'Harry Potter và hoàng tử Lai', ' NXB Trẻ', 2020, 'Tiểu thuyết', 10, '190000.00', ' img/20e8389d63ecf50488820388f5cec094.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `thong_tin_sach`
--
ALTER TABLE `thong_tin_sach`
  ADD PRIMARY KEY (`id_sach`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `thong_tin_sach`
--
ALTER TABLE `thong_tin_sach`
  MODIFY `id_sach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
