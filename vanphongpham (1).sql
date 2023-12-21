-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2023 at 09:41 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vanphongpham`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int NOT NULL,
  `phone` varchar(13) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int DEFAULT NULL,
  `dob` date NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `role` int NOT NULL,
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `phone`, `password`, `name`, `age`, `dob`, `address`, `role`, `token`) VALUES
(1, '0334054063', 'admin', 'Trần Quang Long', 21, '2002-12-03', 'Phú Điền - Nam Sách - Hải Dương', 0, NULL),
(5, '0334054065', '12345', 'Ha Tien Hung', 21, '2002-09-29', 'Minh Khai', 1, NULL),
(6, '0334054064', '9876543210', 'Long Tran', 19, '2003-12-03', 'NS-HD', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chitiet_hoadon`
--

CREATE TABLE `chitiet_hoadon` (
  `id` int NOT NULL,
  `ma_hoadon` varchar(20) NOT NULL,
  `id_ct_sanpham` int NOT NULL,
  `soluong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chitiet_hoadon`
--

INSERT INTO `chitiet_hoadon` (`id`, `ma_hoadon`, `id_ct_sanpham`, `soluong`) VALUES
(5, 'HD1', 5, 1),
(6, 'HD2', 5, 1),
(7, 'HD2', 3, 1),
(8, 'HD3', 5, 3),
(9, 'HD4', 136, 1),
(10, 'HD5', 130, 1),
(11, 'HD6', 99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chitiet_sanpham`
--

CREATE TABLE `chitiet_sanpham` (
  `id` int NOT NULL,
  `ma_sanpham` varchar(20) NOT NULL,
  `anhs_sanpham` text COMMENT 'Ảnh sản phẩm (cách nhau bởi dấu '','')',
  `ma_thuoctinh` varchar(20) DEFAULT NULL,
  `soluong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chitiet_sanpham`
--

INSERT INTO `chitiet_sanpham` (`id`, `ma_sanpham`, `anhs_sanpham`, `ma_thuoctinh`, `soluong`) VALUES
(14, 'SP3', 'IMG/PhotosProduct/1700061623.jpg', 'TT3', 1000),
(15, 'SP3', 'IMG/PhotosProduct/1700061695.jpg', 'TT7', 1000),
(16, 'SP3', 'IMG/PhotosProduct/1700061708.jpg', 'TT8', 1000),
(17, 'SP3', 'IMG/PhotosProduct/1700061732.jpg', 'TT11', 200),
(18, 'SP3', 'IMG/PhotosProduct/1700061742.jpg', 'TT12', 1000),
(19, 'SP3', 'IMG/PhotosProduct/1700061758.jpg', 'TT13', 1000),
(20, 'SP4', 'IMG/PhotosProduct/1700061893.jpg', 'TT7', 100),
(21, 'SP4', 'IMG/PhotosProduct/1700061900.jpg', 'TT8', 200),
(22, 'SP4', 'IMG/PhotosProduct/1700061910.jpg', 'TT11', 100),
(23, 'SP4', 'IMG/PhotosProduct/1700061920.jpg', 'TT4', 100),
(24, 'SP5', 'IMG/PhotosProduct/1700062072.jpg', 'TT7', 100),
(25, 'SP5', 'IMG/PhotosProduct/1700062083.jpg', 'TT8', 1000),
(26, 'SP5', 'IMG/PhotosProduct/1700062092.jpg', 'TT12', 1000),
(27, 'SP5', 'IMG/PhotosProduct/1700062108.jpg', 'TT14', 500),
(28, 'SP6', 'IMG/PhotosProduct/1700062260.jpg', 'TT12', 1000),
(29, 'SP6', 'IMG/PhotosProduct/1700062271.jpg', '', 100),
(30, 'SP6', 'IMG/PhotosProduct/1700062278.jpg', '', 200),
(31, 'SP6', 'IMG/PhotosProduct/1700062286.jpg', '', 100),
(32, 'SP6', 'IMG/PhotosProduct/1700062292.jpg', '', 2),
(33, 'SP7', 'IMG/PhotosProduct/1700062496.jpg', 'TT18', 1000),
(34, 'SP7', 'IMG/PhotosProduct/1700062506.jpg', '', 100),
(35, 'SP7', 'IMG/PhotosProduct/1700062516.jpg', '', 100),
(36, 'SP7', 'IMG/PhotosProduct/1700062526.jpg', '', 1),
(37, 'SP7', 'IMG/PhotosProduct/1700062532.jpg', '', 1),
(38, 'SP8', 'IMG/PhotosProduct/1700062752.jpg', 'TT18', 1000),
(39, 'SP8', 'IMG/PhotosProduct/1700062758.jpg', '', 1),
(40, 'SP8', 'IMG/PhotosProduct/1700062767.jpg', '', 1),
(41, 'SP8', 'IMG/PhotosProduct/1700062775.jpg', '', 1),
(42, 'SP8', 'IMG/PhotosProduct/1700062782.jpg', '', 1),
(43, 'SP8', 'IMG/PhotosProduct/1700062788.jpg', '', 1),
(44, 'SP9', 'IMG/PhotosProduct/1700062926.jpg', 'TT4', 200),
(45, 'SP9', 'IMG/PhotosProduct/1700062937.jpg', 'TT10', 200),
(46, 'SP9', 'IMG/PhotosProduct/1700062945.jpg', 'TT11', 200),
(47, 'SP9', 'IMG/PhotosProduct/1700062954.jpg', 'TT12', 200),
(48, 'SP10', 'IMG/PhotosProduct/1700063053.jpg', 'TT10', 1000),
(49, 'SP10', 'IMG/PhotosProduct/1700063061.jpg', '', 1),
(50, 'SP10', 'IMG/PhotosProduct/1700063069.jpg', '', 1),
(51, 'SP10', 'IMG/PhotosProduct/1700063077.jpg', '', 1),
(52, 'SP10', 'IMG/PhotosProduct/1700063084.jpg', '', 1),
(53, 'SP10', 'IMG/PhotosProduct/1700063091.jpg', '', 1),
(54, 'SP11', 'IMG/PhotosProduct/1700063174.jpg', 'TT10', 1000),
(55, 'SP11', 'IMG/PhotosProduct/1700063182.jpg', 'TT12', 2000),
(56, 'SP11', 'IMG/PhotosProduct/1700063189.jpg', '', 1),
(57, 'SP11', 'IMG/PhotosProduct/1700063195.jpg', '', 1),
(58, 'SP12', 'IMG/PhotosProduct/1700063277.jpg', 'TT7', 600),
(59, 'SP12', 'IMG/PhotosProduct/1700063287.jpg', 'TT10', 700),
(60, 'SP12', 'IMG/PhotosProduct/1700063297.jpg', '', 3),
(61, 'SP13', 'IMG/PhotosProduct/1700063457.jpg', 'TT7', 1000),
(62, 'SP13', 'IMG/PhotosProduct/1700063468.jpg', 'TT10', 5000),
(63, 'SP13', 'IMG/PhotosProduct/1700063488.jpg', 'TT12', 5000),
(64, 'SP13', 'IMG/PhotosProduct/1700063501.jpg', '', 1),
(65, 'SP14', 'IMG/PhotosProduct/1700063635.jpg', 'TT10', 5000),
(66, 'SP14', 'IMG/PhotosProduct/1700063641.jpg', '', 1),
(67, 'SP14', 'IMG/PhotosProduct/1700063649.jpg', '', 1),
(68, 'SP14', 'IMG/PhotosProduct/1700063656.jpg', '', 1),
(69, 'SP15', 'IMG/PhotosProduct/1700063798.jpg', 'TT10', 7000),
(70, 'SP15', 'IMG/PhotosProduct/1700063807.jpg', 'TT12', 8000),
(71, 'SP15', 'IMG/PhotosProduct/1700063814.jpg', '', 1),
(72, 'SP15', 'IMG/PhotosProduct/1700063823.jpg', '', 1),
(73, 'SP15', 'IMG/PhotosProduct/1700063830.jpg', '', 1),
(74, 'SP15', 'IMG/PhotosProduct/1700063835.jpg', '', 1),
(75, 'SP15', 'IMG/PhotosProduct/1700063842.jpg', '', 1),
(76, 'SP16', 'IMG/PhotosProduct/1700063950.jpg', 'TT12', 8000),
(77, 'SP16', 'IMG/PhotosProduct/1700063961.jpg', 'TT13', 600),
(78, 'SP16', 'IMG/PhotosProduct/1700063970.jpg', '', 1),
(79, 'SP16', 'IMG/PhotosProduct/1700063976.jpg', '', 1),
(80, 'SP17', 'IMG/PhotosProduct/1700064073.jpg', 'TT10', 7000),
(81, 'SP17', 'IMG/PhotosProduct/1700064086.jpg', 'TT12', 7000),
(82, 'SP17', 'IMG/PhotosProduct/1700064096.jpg', 'TT13', 9000),
(83, 'SP17', 'IMG/PhotosProduct/1700064103.jpg', '', 1),
(84, 'SP17', 'IMG/PhotosProduct/1700064111.jpg', '', 1),
(85, 'SP18', 'IMG/PhotosProduct/1700064235.jpg', 'TT22', 700),
(86, 'SP18', 'IMG/PhotosProduct/1700064243.jpg', '', 1),
(87, 'SP18', 'IMG/PhotosProduct/1700064249.jpg', '', 1),
(88, 'SP18', 'IMG/PhotosProduct/1700064255.jpg', '', 1),
(89, 'SP19', 'IMG/PhotosProduct/1700064386.jpg', 'TT7', 400),
(90, 'SP19', 'IMG/PhotosProduct/1700064395.jpg', 'TT8', 400),
(91, 'SP19', 'IMG/PhotosProduct/1700064402.jpg', 'TT9', 400),
(92, 'SP19', 'IMG/PhotosProduct/1700064412.jpg', 'TT10', 400),
(93, 'SP19', 'IMG/PhotosProduct/1700064423.jpg', 'TT14', 400),
(94, 'SP20', 'IMG/PhotosProduct/1700064552.jpg', 'TT7', 7000),
(95, 'SP20', 'IMG/PhotosProduct/1700064560.jpg', 'TT10', 700),
(96, 'SP20', 'IMG/PhotosProduct/1700064572.jpg', '', 1),
(97, 'SP20', 'IMG/PhotosProduct/1700064578.jpg', '', 1),
(98, 'SP20', 'IMG/PhotosProduct/1700064584.jpg', '', 1),
(99, 'SP21', 'IMG/PhotosProduct/1700064665.jpg', 'TT12', 500),
(100, 'SP21', 'IMG/PhotosProduct/1700064671.jpg', '', 1),
(101, 'SP21', 'IMG/PhotosProduct/1700064677.jpg', '', 1),
(102, 'SP21', 'IMG/PhotosProduct/1700064683.jpg', '', 1),
(103, 'SP22', 'IMG/PhotosProduct/1700149585.jpg', 'TT7', 800),
(104, 'SP22', 'IMG/PhotosProduct/1700149595.jpg', 'TT12', 900),
(105, 'SP22', 'IMG/PhotosProduct/1700149604.jpg', '', 1),
(106, 'SP22', 'IMG/PhotosProduct/1700149612.jpg', '', 1),
(107, 'SP22', 'IMG/PhotosProduct/1700149619.jpg', '', 1),
(108, 'SP22', 'IMG/PhotosProduct/1700149626.jpg', '', 1),
(109, 'SP22', 'IMG/PhotosProduct/1700149632.jpg', '', 1),
(110, 'SP23', 'IMG/PhotosProduct/1700149815.jpg', 'TT25', 700),
(111, 'SP23', 'IMG/PhotosProduct/1700149825.jpg', 'TT26', 700),
(112, 'SP23', 'IMG/PhotosProduct/1700149833.jpg', 'TT27', 800),
(113, 'SP24', 'IMG/PhotosProduct/1700149962.jpg', 'TT3', 50),
(114, 'SP24', 'IMG/PhotosProduct/1700149954.jpg', 'TT7', 50),
(115, 'SP24', 'IMG/PhotosProduct/1700149970.jpg', 'TT10', 50),
(116, 'SP24', 'IMG/PhotosProduct/1700149978.jpg', 'TT12', 50),
(117, 'SP24', 'IMG/PhotosProduct/1700149985.jpg', '', 1),
(118, 'SP24', 'IMG/PhotosProduct/1700149991.jpg', '', 1),
(119, 'SP25', 'IMG/PhotosProduct/1700150111.jpg', 'TT12', 500),
(120, 'SP25', 'IMG/PhotosProduct/1700150116.jpg', '', 1),
(121, 'SP25', 'IMG/PhotosProduct/1700150123.jpg', '', 1),
(122, 'SP25', 'IMG/PhotosProduct/1700150130.jpg', '', 1),
(123, 'SP26', 'IMG/PhotosProduct/1700151591.jpg', 'TT10', 800),
(124, 'SP26', 'IMG/PhotosProduct/1700151598.jpg', 'TT12', 700),
(125, 'SP26', 'IMG/PhotosProduct/1700151605.jpg', '', 1),
(126, 'SP26', 'IMG/PhotosProduct/1700151611.jpg', '', 1),
(127, 'SP26', 'IMG/PhotosProduct/1700151617.jpg', '', 1),
(128, 'SP26', 'IMG/PhotosProduct/1700151623.jpg', '', 1),
(129, 'SP27', 'IMG/PhotosProduct/1700151792.jpg', 'TT3', 500),
(130, 'SP27', 'IMG/PhotosProduct/1700151815.jpg', 'TT7', 500),
(131, 'SP27', 'IMG/PhotosProduct/1700151824.jpg', 'TT10', 500),
(132, 'SP27', 'IMG/PhotosProduct/1700151830.jpg', '', 1),
(133, 'SP28', 'IMG/PhotosProduct/1700151914.jpg', 'TT7', 400),
(134, 'SP28', 'IMG/PhotosProduct/1700151921.jpg', 'TT11', 400),
(135, 'SP28', 'IMG/PhotosProduct/1700151928.jpg', 'TT12', 200),
(136, 'SP29', 'IMG/PhotosProduct/1700152009.jpg', 'TT7', 30),
(137, 'SP29', 'IMG/PhotosProduct/1700152015.jpg', 'TT14', 30),
(138, 'SP29', 'IMG/PhotosProduct/1700152023.jpg', '', 199),
(139, 'SP30', 'IMG/PhotosProduct/1700152142.jpg', 'TT7', 600),
(140, 'SP30', 'IMG/PhotosProduct/1700152149.jpg', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `phone`, `email`, `password`, `name`, `address`, `token`, `createdDate`, `updatedDate`) VALUES
(9, '012345', 'tql.official.2002@gmail.com', '12345', 'Trần Quang Long', 'NS-HD', '9fe89513d748a8ad297139b6b355024c', '2023-11-04 17:14:58', NULL),
(13, NULL, 'vuthinhung.it@gmail.com', '12345', 'vuthinhung.it', NULL, '9a3df31901ce975b82698289bb8987c8', '2023-11-12 07:02:34', NULL),
(14, NULL, 'thanh@gmail.com', '1234', 'thanh', NULL, 'f37f7eaf20f873d92dd697938149975e', '2023-11-26 15:44:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diachi_nhanhang`
--

CREATE TABLE `diachi_nhanhang` (
  `id` int NOT NULL,
  `customerID` int NOT NULL,
  `ten_nguoinhan` varchar(50) NOT NULL,
  `sdt_nguoinhan` varchar(15) NOT NULL,
  `diachi` text NOT NULL,
  `tinh` varchar(50) NOT NULL COMMENT 'Tỉnh',
  `huyen` varchar(50) NOT NULL COMMENT 'Huyện',
  `xa` varchar(50) NOT NULL COMMENT 'Xã',
  `macdinh` bit(2) NOT NULL COMMENT 'Địa chỉ mặc định',
  `ngaytao` datetime NOT NULL COMMENT 'Ngày tạo',
  `ngaycapnhat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `diachi_nhanhang`
--

INSERT INTO `diachi_nhanhang` (`id`, `customerID`, `ten_nguoinhan`, `sdt_nguoinhan`, `diachi`, `tinh`, `huyen`, `xa`, `macdinh`, `ngaytao`, `ngaycapnhat`) VALUES
(2, 9, 'Trần Quang Long', '0334054464', 'NS-HD', 'Tỉnh Hải Dương', 'Huyện Nam Sách', 'Xã Phú Điền', b'01', '2023-11-10 15:16:30', NULL),
(4, 9, 'Trần Quang Long 3', '2342341231', 'M\\u00e0u s\\u1eafc: \\u0111\\u1ecf', 'Thành phố Hà Nội', 'Quận Hai Bà Trưng', 'Phường Quỳnh Mai', b'00', '2023-11-14 16:16:26', NULL),
(5, 14, 'Thành', '0987654', 'HN', 'Tỉnh Phú Thọ', 'Huyện Tam Nông', 'Xã Vạn Xuân', b'01', '2023-11-26 15:45:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int NOT NULL,
  `customerID` int DEFAULT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `customerID`, `content`) VALUES
(1, NULL, 'xin chân thành cảm ơn những khách hàng thân yêu dù ở xa hay gần đã tin tưởng và ủng hộ NKN trong suốt thời gian vừa qua. Sự hài lòng của khách hàng chính là nguồn động lực vô hạn cho NKN không ngừng tạo nên những sản phẩm Thanh Lịch, Thời Thượng và Chất Lượng nhất để gửi gắm đến phái đẹp. '),
(10, NULL, 'Cải thiện thêm các mặt hàng'),
(11, NULL, '     '),
(12, NULL, '   '),
(13, NULL, '   '),
(14, NULL, '       ');

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `id` int NOT NULL,
  `ma_hoadon` varchar(20) NOT NULL,
  `customerID` int NOT NULL,
  `ma_diachi_nhanhang` int NOT NULL,
  `tienthanhtoan` int NOT NULL,
  `phivc` int NOT NULL,
  `trangthai` bit(2) NOT NULL,
  `createdDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`id`, `ma_hoadon`, `customerID`, `ma_diachi_nhanhang`, `tienthanhtoan`, `phivc`, `trangthai`, `createdDate`) VALUES
(4, 'HD1', 9, 2, 70000, 50000, b'01', '2023-11-16 00:50:00'),
(5, 'HD2', 9, 4, 82222, 50000, b'00', '2023-11-15 19:01:52'),
(6, 'HD3', 9, 2, 50060, 50000, b'00', '2023-11-16 19:23:09'),
(7, 'HD4', 14, 5, 102000, 50000, b'00', '2023-11-26 15:45:18'),
(8, 'HD5', 14, 5, 64500, 50000, b'00', '2023-11-26 15:48:39'),
(9, 'HD6', 14, 5, 50370, 50000, b'00', '2023-11-26 15:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `ma_sanpham` varchar(20) NOT NULL COMMENT 'Mã sản phẩm (tự config)',
  `ten_sanpham` text COMMENT 'Tên sản phẩm',
  `anh_sanpham` text NOT NULL COMMENT 'Ảnh sản phẩm (Ảnh mô tả)',
  `gia_sanpham` int NOT NULL COMMENT 'Giá sản phẩm',
  `mota_sanpham` text,
  `ngaytao` datetime NOT NULL COMMENT 'Ngày tạo sản phẩm',
  `ngaycapnhat` datetime DEFAULT NULL COMMENT 'Ngày cập nhật sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`ma_sanpham`, `ten_sanpham`, `anh_sanpham`, `gia_sanpham`, `mota_sanpham`, `ngaytao`, `ngaycapnhat`) VALUES
('SP3', 'Set 80 giấy ghi chú tiện dụng chất lượng cao', 'IMG/PhotosProduct/1700061536.jpg', 9700, '1. Tất cả sản phẩm có sẵn trong kho, vận chuyển nhanh chóng;\r\n\r\nLưu ý ：\r\nTất cả các gói đều được khử trùng và kiểm dịch, các bạn yên tâm mua hàng nhé.\r\n\r\nGiá đặc biệt ：\r\n1. Sản phẩm có giá cả phải chăng, chào mừng bạn đến mua hàng.\r\n\r\n2. Chúng tôi hỗ trợ bán sỉ. Nếu bạn mua hàng với số lượng lớn, vui lòng liên hệ với chúng tôi để biết thêm chi tiết\r\n     \r\nChúng tôi là xưởng sản xuất ở nước ngoài, tất cả sản phẩm do xưởng chúng tôi trực tiếp cung cấp nên giá thành sẽ rất rẻ, mọi thắc mắc vui lòng liên hệ bộ phận chăm sóc khách hàng trước khi đặt hàng.\r\n Do chênh lệch cài đặt ánh sáng và màn hình, màu sắc sản phẩm có thể hơi khác so với hình ảnh. Mong bạn thông cảm.\r\nBạn có thể thấy rằng ai đó bán với giá thấp hơn chúng tôi nhưng họ không thể đảm bảo chất lượng và dịch vụ như chúng tôi.\r\nMô tả sản phẩm:\r\n1. Tên sản phẩm: Giấy ghi chú\r\n2. Chất liệu sản phẩm: Giấy\r\n3. Kích thước sản phẩm: 7.3 * 7.3 / 7.4 * 7.4cm\r\n4. Số lượng sản phẩm: 1 \r\n5. Trọng lượng: 34g\r\n6. Màu sắc có sẵn: Trắng, Kaki\r\n7. Bao bì: Chúng tôi sử dụng một túi bong bóng để bọc sản phẩm chặt chẽ để tránh hư hỏng trong quá trình vận chuyển.', '2023-11-15 15:18:56', '2023-11-15 15:22:40'),
('SP4', 'Bảng Đánh Dấu Graffiti 6 Màu Sắc Kẹo Ngọt Xinh Xắn', 'IMG/PhotosProduct/1700061883.jpg', 12000, 'Bút đánh dấu, điểm đánh dấu dòng, điểm đánh dấu.\r\n\r\n \r\n\r\n- Màu sắc: 3 màu để bạn lựa chọn\r\n\r\n \r\n\r\n- Nib: 5mm\r\n\r\n \r\n\r\n- Đơn vị: 1 cây\r\n\r\n \r\n\r\n- Bút có thiết kế hiện đại, phù hợp với tay của học sinh, sinh viên, NVP.\r\n\r\n \r\n\r\n- Mực có màu sắc tươi sáng và độ phản xạ tốt. Các nét viết hoặc đánh dấu đều và liên tục. Không độc hại.\r\n\r\n\r\n \r\n\r\nPhương pháp bảo quản:\r\n\r\n \r\n\r\n- Đóng nắp ngay sau khi sử dụng.\r\n\r\n \r\n\r\n- Tránh nhòe hoặc thấm mực trên quần, áo sơ mi, túi xách, đồ vật có bề mặt thấm hút cao.\r\n\r\n \r\n\r\n- Tránh ánh nắng trực tiếp trên sản phẩm.\r\n\r\n \r\n\r\n- Bảo quản nơi khô ráo, thoáng mát, tránh xa nhiệt và hóa chất.\r\n\r\n ', '2023-11-15 15:24:43', '2023-11-15 15:25:23'),
('SP5', 'Giấy in A4 PaperOne Copier 70gsm - Ream 500 tờ khổ A4 cho máy photocopy công suất lớn', 'IMG/PhotosProduct/1700062048.jpg', 75000, 'I. THÔNG TIN SẢN PHẨM: \r\n- Kích thước: A4(297mm x 210mm)\r\n- Định lượng: 70gsm\r\n- Xuất xứ: Indonesia\r\n- Đóng gói: 500 tờ/ream\r\n\r\nII. TÍNH NĂNG SẢN PHẨM \r\n- PaperOne™ Copier là sản phẩm giấy Copy với chất lượng cao cấp, thích hợp cho tất cả các loại máy in và máy photocopy hiện đại, đảm bảo chất lượng và hiệu quả in cao nhất. Tiện dụng và phù hợp cho mọi văn phòng trong nhu cầu in ấn hàng ngày.\r\n- PaperOne™ Copier là lọai giấy cao cấp, đặc biệt thích hợp với các loại thiết bị văn phòng sử dụng nguyên lý in xegrographic.PaperOne™ Copier được nghiên cứu và sản xuất để chuyên dùng cho các lọai máy in và photocopy có tốc độ cao và công suất lớn. Đảm bảo không bị kẹt giấy hoặc trục trặc trong khi sử dụng.\r\n- Giấy in A4 PaperOne Copier đem lại màu sắc rực rỡ, mực in sắc nét, không lo lem mực, không tạo ra nhiều bụi giấy \r\n- Sản phẩm giúp tiết kiệm đến 18% lượng mực sử dụng so với những loại giấy khác. \r\n\r\nIII. HƯỚNG DẪN SỬ DỤNG \r\n- Chuyên dùng cho các loại máy in và photocopy tốc độ cao, công suất lớn\r\n\r\nIV. TẠI SAO NÊN CHỌN SẢN PHẨM TỪ PAPERONE \r\nPaperOne™ là thương hiệu giấy được sản xuất bởi APRIL - Tập đoàn sản xuất bột giấy và giấy mịn hàng đầu thế giới. Thông qua mạng lưới phân phối mạnh mẽ, chúng tôi đã đưa PaperOne™ trở thành thương hiệu giấy văn phòng được ưa chuộng và áp dụng rộng rãi tại Việt Nam.', '2023-11-15 15:27:28', '2023-11-15 15:28:29'),
('SP6', 'Kẹp rút loại trong đựng tài liệu', 'IMG/PhotosProduct/1700062233.jpg', 7500, 'Kẹp giấy rút khổ a4 trong suốt\r\n------------------------------------------------------------------------\r\nAn Phú Photos chuyên cung cấp album, khung hình, kẹp gỗ và phụ kiện ảnh giá rẻ. \r\nKhách mua sỉ số lượng lớn inbox để được tư vấn thêm nhé.\r\n\r\n*Thông tin liên hệ: An Phú Photos - 0963113139\r\nĐ/c: Nguyễn Trãi – Phường Phú Sơn – TP Thanh Hóa\r\n=========================================\r\nAn Phú Photos cam kết:\r\n- Hàng hóa được mô tả rõ ràng, chính xác.\r\n- Hàng đảm bảo chất lượng, giá cả cạnh tranh.\r\n- Thời gian giao hàng từ 1-7 ngày kể từ ngày đặt hàng (tùy từng đơn vị vận chuyển và khoảng cách xa – gần với shop). \r\n- Giao hàng toàn quốc. ', '2023-11-15 15:30:33', '2023-11-15 15:31:34'),
('SP7', 'Lọ Mực 5ml Nhiều Màu Sắc Chuyên Dùng Để Viết Thư Pháp', 'IMG/PhotosProduct/1700062441.jpg', 50000, '#5ml Gold Powder Colored #Ink #Fountain #Dip Pen #Calligraphy #Writing Painting #Stationery Office Supplies\r\n 100% sản phẩm mới, chất lượng cao\r\n Đặc trưng:\r\n Mực này có pha bột kim tuyến vàng rất đẹp.\r\n Màu sắc tuyệt đẹp với ánh ngọc trai và cường độ đậm màu độc đáo\r\n Mực thật được thiết kế không bị nhòe màu và gây tắc ngòi bút.\r\n Thân thiện với môi trường và không độc hại, dễ thấm vào giấy.\r\n Món quà tuyệt vời cho bạn bè, gia đình hoặc chính bạn.\r\n Sản phẩm chỉ gồm màu mực, không bao gồm các phụ kiện khác trưng bày trong hình.\r\n \r\n Miêu tả sản phẩm:\r\n Loại sản phẩm: Mực màu huỳnh quang\r\n Chất liệu: Thủy tinh & Mực\r\n Kích thước: khoảng 2x3.8cm / 0.79x1.50in\r\n 24 Màu & Kiểu để lựa chọn: Như hình ảnh hiển thị\r\n Dung tích: 5ml\r\n Số lượng: 1 lọ\r\n \r\n Lưu ý:\r\n Không có gói bán lẻ.\r\n Do đo lường thủ công, mong bạn vui lòng cho phép sai số nhỏ 0-1cm. Vui lòng cân nhắc kỹ trước khi đặt hàng ', '2023-11-15 15:34:01', '2023-11-15 15:35:34'),
('SP8', 'Ghim Dập Tài Liệu Số 10 Deli - Hộp Ghim Bấm 1000 cái - 1 hộp', 'IMG/PhotosProduct/1700062734.jpg', 6700, 'Gim 10 Deli\r\nTÍNH NĂNG SẢN PHẨM:\r\nMạ bạc bề mặt \r\nVừa đẹp lại chống gỉ, lớp bạc bóng loáng, chống ăn mòn tốt \r\nGhim thẳng, không bị méo, khả năng xuyên giấy tốt \r\nMặt cắt vuông vức, ghim dập an toàn\r\nĐầu ghim nhọn, chắc chắn, khả năng xuyên, dập tốt \r\nCó thể đóng, dập 15 tờ/cái \r\nLoại ghim phù hợp với nhiều dạng tài liệu, hiệu quả rõ rệt\r\nTHÔNG TIN SẢN PHẨM:\r\nTên sản phẩm: Ghim #10 Deli 1000 cái/ hộp\r\nMã sản phẩm: E0010N\r\nQuy cách đóng gói: 1 hộp\r\nXuất xứ: Trung Quốc\r\n--------------------------------------------------------------------------------------------\r\nTự hào là một trong những nhãn hàng văn phòng phẩm lớn nhất tại Việt Nam, @Delivietnam không ngừng nỗ lực và phát triển trong lĩnh vực phân phối các sản phẩm cho các đơn vị văn phòng, trường học,...  Với phương châm sản xuất những sản phẩm chất lượng tốt nhất và luôn đặt khách hàng làm trọng tâm, sứ mệnh của Deli là làm hài hòng người tiêu dùng toàn cầu với những sản phẩm chất lượng cao, độ tin cậy tuyệt đối và thân thiện với người dùng.\r\nKhách hàng lựa chọn các sản phẩm của @Delivietnam sẽ được cam kết: \r\nSản phẩm chính hãng từ nhà máy Deli, nguồn gốc rõ ràng và chất lượng đạt tiêu chuẩn. \r\nBảo hành theo quy định của nhà sản xuất. \r\nGiá cả hợp lý, cạnh tranh, rẻ nhất thị trường.\r\nHỗ trợ đổi trả hàng cho những sản phẩm bị thiếu.', '2023-11-15 15:38:54', '2023-11-15 15:39:51'),
('SP9', 'Máy tính cầm tay Flexio Fx799VN Thiên Long - Máy tính bỏ túi chính hãng cho học sinh, sinh viên', 'IMG/PhotosProduct/1700062913.jpg', 499000, 'Thông tin sản phẩm Máy tính cầm tay Flexio Fx799VN\r\n\r\nThông tin chung Máy tính cầm tay Flexio Fx799VN: \r\n\r\n- Thiết kế hiện đại, cá tính \r\n\r\n- Kích thước : 17 x 84 x 164 mm\r\n\r\n- Máy mỏng nhẹ với chất liệu bền bỉ, phím bấm với độ chống mòn và mờ cao.\r\n\r\n- Dàn phím được bố trí khoa học và thuận tiện cho các thao tác trên máy tínhMáy tính khoa học sử dụng cho học sinh, sinh viên, giảng viên, hỗ trợ giải nhanh các phép toán phức tạp.\r\n\r\n- Thiết kế phím bấm rộng, chống mòn và mờ cao, giúp thao tác nhanh, chính xác.\r\n\r\n- Màn hình hiển thị lớn, dễ quan sát các phép tính.\r\n\r\n- Một số tính năng nổi bật: \r\n\r\n\r\n\r\nGiải phương trình bậc 4, \r\n\r\nGiải bất phương trình bậc 4, \r\n\r\nGiải hệ phương trình bậc nhất 4 ẩn, \r\n\r\nTính ma trận 4 x 4, \r\n\r\nTìm cực trị hàm số bậc 3, \r\n\r\nTìm phương trình đường thẳng, \r\n\r\nTính độ dài đoạn thẳng,...\r\n\r\nCó tính năng thông báo khi sắp hết pin.\r\n\r\nSản phẩm Máy tính cầm tay Flexio Fx799VN của tập đoàn Thiên Long.\r\n\r\n\r\n\r\nĐẶC BIỆT :\r\n\r\nMáy tính cầm tay Flexio Fx799VN ĐƯỢC BỘ GIÁO DỤC VÀ ĐÀO TẠO CHO PHÉP MANG VÀO PHÒNG THI\r\n\r\nCHẾ ĐỘ BẢO HÀNH ĐẶC BIỆT : BẢO HÀNH 07 NĂM, 1 ĐỔI 1 TRONG 01 NĂM ĐẦU', '2023-11-15 15:41:53', '2023-11-15 15:43:28'),
('SP10', 'Ghế xoay văn phòng, ghế lưới cao cấp thiết kế chống mỏi lưng, XOAY 360 độ học tập làm việc,Thiết kế lưng cong, hỗ trợ cộ', 'IMG/PhotosProduct/1700063036.jpg', 319000, 'Dễ sử dụng, phù hợp đa đối tượng.\r\nHình thức đơn giản nhưng đẹp mắt, phù hợp với nhiều kiểu setup văn phòng.\r\nLưng lưới thông thoáng, sạch khuẩn, không bám mồ hôi.\r\nDễ dàng thay đổi chiều cao ghế tùy theo mục đích sử dụng.\r\nĐệm ngồi siêu êm ái, đàn hồi, ngồi lâu không bị xẹp.\r\n\r\nTạo cảm giác thoải mái làm việc, nâng cao hiệu quả công việc.\r\n\r\n- Thiết kế lưng cong, hỗ trợ cột sống\r\n\r\n- Chân ghế được làm từ chất liệu thép mạ chrome bền đẹp, ít bị hoen gỉ qua thời gian sử dụng. \r\n\r\n- Thiết kế 5 bánh xe ngay dưới các thanh đỡ giúp bạn dễ dàng xoay và di chuyển ghế một cách dễ dàng\r\n\r\n- Có thể điều chỉnh độ cao, xoay 360 độ', '2023-11-15 15:43:56', '2023-11-15 15:44:52'),
('SP11', 'Nghiêng Điều Chỉnh Độ Cao Ghế Ngồi Văn Phòng Tiện Dụng', 'IMG/PhotosProduct/1700063161.jpg', 1200000, 'Ghế Ghế xoay văn phòng Xfurniture C002:\r\n\r\n- Hình thức ưa nhìn, đẹp mắt và độc đáo, gọn nhẹ\r\n\r\n- Thiết kế đường nét tinh tế theo đúng tư thế ngồi, tạo cảm giác thoải mái nhất khi ngồi làm việc\r\n\r\n- Chống ê mỏi cổ, lưng, hạn chế các bênh về xương khớp\r\n\r\n- Dễ dàng thay đổi chiều cao ghế, thay đổi chiều cao\r\n\r\n- Cấu tạo chắc khỏe, chịu được tải trọng lên tới 250kg.\r\n\r\n- Phù hợp vơi những người thường xuyên ngồi liên tục hàng giờ\r\n\r\n- Trọng lượng: 11kg\r\n\r\n- Chất liệu: Khung nhựa ABS , vải lưới thoáng khí thân thiện với môi trường \r\n\r\n- Màu sắc: Trắng Đen\r\n\r\n\r\n\r\n- Hàng nhập khẩu nguyên thùng\r\n\r\n\r\n\r\n- Xuất xứ: Hebei, China\r\n\r\n\r\n\r\n- Bảo hành: 12 tháng\r\n\r\n\r\n\r\n- Có xuất hóa đơn VAT cho công ty\r\n\r\n\r\n\r\n- Có giá sỉ cho đại lý\r\n\r\n\r\n\r\n- Phân phối online: okmua.com.vn\r\n\r\n\r\n\r\n- Thương hiệu: Xfurniture', '2023-11-15 15:46:01', '2023-11-15 15:46:36'),
('SP12', 'Ghế gấp văn phòng Cao Cấp, đủ mẫu để bạn lựa chọn', 'IMG/PhotosProduct/1700063261.jpg', 157000, 'Ghế gâp gọn , Ghế gấp văn phòng\r\n  - Cam Kết hỗ trợ Đổi Trả nếu sản phẩm không giống với mô tả.\r\n  - Cam kết hình ảnh shop tự chụp ,video shop tự quay. HÌNH THẬT 100% \r\n  - Cam Kết giá rẻ nhất thị trường đi kèm chất lượng tốt nhất \r\n  - Giao hàng tận nơi trên toàn quốc, Nhận hàng nhanh chóng tại nhà.\r\n  - Chúc quý khách mua sắm vui vẻ!\r\n\r\nMô tả sản phẩm: Ghế gâp gọn , Ghế gấp văn phòng\r\nChất liệu sản phẩm được làm từ khung ống thép sơn tĩnh điện màu ghi sang trọng, không bị rỉ sét trong quá trình sử dụng về sau\r\n\r\n- Mặt lưng tựa và đệm ngồi được làm bằng mút bọc da, mềm mại tạo cảm giác êm ái cho người ngồi. Mặt ngồi được uốn cong cho khả năng ngồi sát chắc và êm ái, tạo cảm giá dễ chịu ngay khi ngồi, ngồi lâu sẽ không bị mỏi.\r\n\r\n- Sản phẩm ghế gấp giá rẻ nhưng chất lượng tuyệt vời có thể mang đi mọi nơi rất tiện lợi. Dễ dàng di chuyển.\r\n\r\n- Ghế gấp bọc da là dòng sản phẩm ghế gấp giá rẻ đa năng, tiện dụng dùng được cho cả văn phòng làm việc, hội họp cho đến gia đình phòng ăn, tiếp khách,...\r\n\r\n-Sản phẩm ghế gấp giá rẻ có thế gấp gọn nhẹ nhàng, nhanh chóng xếp kế lại nhau tiết kiệm diện tích không gian làm việc, sinh hoạt. Kiểu dáng đơn giản nhưng hiện đại và linh hoạt.\r\n- Ảnh thật 100%', '2023-11-15 15:47:41', '2023-11-15 15:48:18'),
('SP13', 'Bàn làm việc Nội Thất Tiết Kiệm gỗ để máy tính bàn gaming thiết kế theo ikea đã lắp sẵn BLV888789', 'IMG/PhotosProduct/1700063444.jpg', 3399000, ' \r\n\r\nTheo Bản Vẽ Trong Phân Loại Giỏ Hàng\r\n\r\nSản Phẩm thiết kê tách rời gồm: 2 Tủ Ikea rời, Mặt bàn rời\r\n\r\n\r\n\r\n Gỗ công nghiệp lõi nhập khẩu dày dặn phủ toàn bộ Min trắng, hoặc Vân gỗ, chống trầy, chống vông vênh, hạn chế ẩm mốc, dễ lau chùi ít bám bụi\r\n\r\nMàu sắc: Màu trắng, Đen, và có màu theo yêu cầu khách hàng\r\n\r\nKhách Hàng đổi size inbox kích thước shop nhé\r\nBàn làm việc - Nơi sáng tạo, sản xuất và học tập\r\n\r\nBàn làm việc, còn được gọi là bàn làm việc hoặc bàn làm việc cá nhân, là nơi chúng ta trải qua nhiều giờ trong ngày để làm việc, học tập, nghiên cứu và thậm chí là sáng tạo. Đó là một không gian quan trọng trong cuộc sống hàng ngày của chúng ta, nơi chúng ta tập trung và tiếp thu kiến thức, sáng tạo ý tưởng và thực hiện công việc.', '2023-11-15 15:50:44', '2023-11-15 15:51:42'),
('SP14', 'Bàn Họp Văn Phòng, Làm Việc Nhóm', 'IMG/PhotosProduct/1700063623.jpg', 1340000, 'Tổng Kho Sỉ An Bình - 0868865506 \r\nBàn Họp Văn Phòng \r\nCHẤT liệu :khung sắt sơn tĩnh điện cao cấp .,gỗ công nghiệp MFC sử lý công nghệ chống mối mọt,gỗ phủ melanime mặt gỗ bóng đẹp ko chầy xước ,cong vênh,khung chắc chắn bền đẹp theo thời gian ,\r\nNHẬN LÀM THEO YÊU CẦU MẪU MÃ\r\nnội thất gia đình văn phòng trường học,giá xuất xưởng ko qua trung gian\r\nĐộ mới: Mới 100% chưa qua sử dụng\r\nĐịa chỉ:509 Vũ Tông Phan - Thanh Xuân', '2023-11-15 15:53:43', '2023-11-15 15:54:18'),
('SP15', 'Bàn gaming cao cấp khung thép lớn chắc chắn hiện đại thương hiệu ZEN HOME', 'IMG/PhotosProduct/1700063779.jpg', 329000, 'Điều kiện bảo hành\r\n- Nếu khách nhận hàng không đúng màu, hư hỏng, yêu cầu khách chụp ảnh sản phẩm gửi qua chat. Bạn có thể thông báo vấn đề. Shop rất sẵn lòng đổi sản phẩm/hoàn tiền.\r\n(Cửa hàng phải yêu cầu ảnh chụp mặt sau của đế, cả sản phẩm nhận được / trang bìa và phong bì bưu kiện. Nếu khách không xem được gửi cho shop xem sẽ không thể làm điều đó cho bạn)\r\n- Shop bảo hành sản phẩm từ 3-7 ngày tùy từng mặt hàng. Bạn có thể hỏi trước.\r\n- Nếu bạn đã thực hiện việc đổi trả sản phẩm, shop đã ấn chấp nhận. phải được trả lại trong vòng 3 ngày.\r\n- Nếu quá thời hạn bảo hành Cửa hàng sẽ không chấp nhận bất cứ điều gì cả.\r\n- Trường hợp đổi/trả hàng vui lòng thực hiện qua hệ thống shopee. Shoppee sẽ hỗ trợ phí giao hàng tại mục này cho bạn.\r\n\r\nLưu ý: Trường hợp khách đã đánh giá và tặng sao cho shop. Ngừng chấp nhận khiếu nại sản phẩm trong mọi trường hợp.\r\n\r\n Chi tiết sản phẩm \r\n\r\n- Bàn văn phòng chân sắt loại tốt\r\n- Có 4 kích cỡ (80x40x74, 140x60x74, 120x60x74 , 100x50x74)\r\n- Chân bàn trước 5 cm, cạnh bàn (chỉ gỗ) dày 1,5 cm.\r\n- Mặt bàn bằng gỗ phong màu nâu nhạt. (Chỉ có một mẫu duy nhất)\r\n- nỏ chống nước\r\n- Chân bàn chống gỉ\r\n- Chịu được trọng lượng khoảng 220kg\r\n- Chân bàn dưới nâng nền cao hơn. Với các miếng đệm cao su chống trượt dưới chân.\r\nQuý khách hàng thân mến\r\nChào bạn, vì là sản phẩm lớn nên nếu bạn mua nhiều hơn 2 cái thì nhân viên chuyển phát nhanh sẽ không đến nhận hàng.\r\n Nhắc nhở mua hàng: Nên mua 1 chiếc cho mỗi đơn hàng để đạt được tốc độ vận chuyển nhanh nhất', '2023-11-15 15:56:19', '2023-11-15 15:57:22'),
('SP16', 'Kệ Sách Gỗ chữ U- Kích thước: 70cm x 20cm x 140cm', 'IMG/PhotosProduct/1700063939.jpg', 270000, 'MÔ TẢ SẢN PHẨM\r\n-Bạn đang cần tìm cống phẩm kệ sách cho buồng ngủ cá nhân, kệ giá đựng đồ, kệ phân phối cống phẩm tại cửa hàng, kệ tư liệu tại công sở làm việc.\r\n-Bạn đang cần tìm mẫu kệ sách, kệ bỏ đồ có kiến tạo tối tân tinh xảo thậm chí là kệ sách được xem là kệ trang trí.\r\n-Bạn đang cần tìm mẫu kệ sách có thiết kế thông thái giúp diện tích S được tiết kiệm ngân sách và chi phí tối đa đơn giản chuyển hướng những lúc có nhu cầu.\r\n=>thì đây là đó là item nhiều người đang CẦN ĐẶT NHANH KẺO HẾT\r\nThông tin sản phẩm:\r\n- Kích thước: 70cm x 20cm x 140cm (DxRxC)\r\n- Kệ được thiết kế từ gỗ ép MDF phủ lớp chống ấm chống mốc\r\n- xây đắp uy quyền , chắc chắc , tiện lợi ,... \r\n- Màu sắc: trắng , giả gỗ\r\n- hoàn toàn có thể làm giá đựng sách tại phòng đọc, phòng học, phòng làm việc, công sở làm việc. Làm kệ để đồ, kệ trưng sản phẩm, kệ tô điểm tại cửa hàng...', '2023-11-15 15:58:59', '2023-11-15 15:59:37'),
('SP17', 'Kệ sách để sàn hình cây thông minh phù hợp với bàn làm việc, giá sách cho bàn máy tính- GP03', 'IMG/PhotosProduct/1700064049.jpg', 220000, 'CAM KẾT \r\n Hàng thật như hình\r\nHàng chính hãng cao cấp, bền, đẹp\r\nKhông giống hoàn 111% giá trị đơn hàng\r\n Giá cả: RẺ NHẤT với hàng cùng chất lượng!\r\nThời gian chuẩn bị hàng: hàng luôn có, luôn sẵn sàng mang qua bưu cục khi có đơn của bạn.\r\n---------------\r\n*** CHƯƠNG TRÌNH ƯU ĐÃI \r\nHiện Shop đang triển khai nhiều ưu đãi hấp dẫn, hãy nhấp vào xem Shop để lấy mã ưu đãi bạn nhé.\r\n---------------\r\n*** QUYỀN LỢI CỦA BẠN:\r\nBao đổi trả hàng miễn phí khi sản phẩm không giống hình, hoặc nhầm size, số lượng...\r\nKhách cũ: luôn có mã giảm giá ưu tiên cho khách cũ nhé.\r\n---------------\r\nTHÔNG TIN SẢN PHẨM\r\n- Chất liệu: Gỗ MDF bề mặt phủ melamine cao cấp mịn, bóng, không mối mọt\r\n- Màu sắc: Vân gỗ\r\n- kích thước: cao 122cm rộng 48cm sâu 20cm.\r\n- Mô hình: tháo lắp ráp. \r\nLƯU Ý\r\n- Nếu bạn nhận hàng chất lượng kém không giống mô tả shop hoàn tiền ngay 100% cho bạn.\r\n- Nếu sản phẩm bị lỗi do vận chuyển shop đổi trả sản phẩm mới miễn phí cho bạn.\r\n- Sản phẩm được sản xuất và phân phối bởi IGA tại Khu Công Nghiệp 658 Phường Tiền Phong, Thành phố Thái Bình', '2023-11-15 16:00:49', '2023-11-15 16:01:54'),
('SP18', 'Túi vải đựng tài liệu A4', 'IMG/PhotosProduct/1700064225.jpg', 46000, 'THUỘC TÍNH SẢN PHẨM\r\nChất liệu: Vải bố.\r\nKích thước: 40x45.\r\nTrọng lượng (kg): 500.\r\nTHUỘC TÍNH SẢN PHẨM\r\nChất liệu: Vải bố.\r\nKích thước: 40x45.\r\nTrọng lượng (kg): 500.', '2023-11-15 16:03:45', '2023-11-15 16:04:17'),
('SP19', '[Siêu Rẻ] Túi Vải Treo Tường 3 Ngăn Đa Năng, Đựng Đồ Cá Nhân Tiện Dụng - Văn Phòng Phẩm Sáng Tạo', 'IMG/PhotosProduct/1700064371.jpg', 18599, 'Giỏ vải treo tường đựng đồ tiện ích 2355\r\n Kích thước: 20 x 68cm\r\n 6 Màu: xanh, vàng, ghi, rêu, nâu, thổ cẩm\r\n\r\nHiện shop đang áp dung rất nhiều các chương trình km hấp dẫn:\r\nMua 5 giảm ngay 2%\r\nĐược áp mã giảm giá cho đơn hang tối thiểu 99k\r\nCác chương trình Flatsale diễn ra lien tục giữa các khung giờ khác nhau,vui long ấn theo dõi shop tạo nhắc nhở để mình cùng mua hang với giá khuyến mại nhé\r\nMiễn phí vận chuyển với đơn hang chỉ từ 150k trở lên\r\nĐơn sỉ chỉ từ 1 triệu chiết khấu thẳng 10%\r\nRất nhiều sản phẩm hót đang chờ bạn nhé.Hẹn gặp bạn ở những đơn hang mới cùng shop bạn nhé', '2023-11-15 16:06:11', '2023-11-15 16:07:03'),
('SP20', 'Cặp da công sở chính hãng Huabups chất liệu da Pu cao cấp cực bền cặp văn phòng đựng laptop chống thấm nước', 'IMG/PhotosProduct/1700064542.jpg', 750000, 'Cặp xách công sở Cặp da công sở Huabup Chất liệu da PU cao cấp chống thấm nước,cặp văn phòng sang trọng - IBAG\r\n\r\nCặp xách công sở không chỉ đơn thuần phục vụ cho công việc văn phòng mà còn phục vụ cho những chuyến đi công tác dài ngày ,túi đựng được nhiều kích cỡ laptop khác nhau từ 15.6inch trở lại ,có ngăn đựng hồ sơ riêng rất tiện lợi \r\n\r\nCặp mang phong cách thời trang lịch lãm năng động \r\n\r\n- Thiết kế bao gồm có 2 ngăn chính và 2 ngăn phụ : \r\n\r\n+ 2 ngăn chính:  1 ngăn chống sốc dành cho laptop ,1 ngăn đựng giấy tờ hồ sơ\r\n\r\n+ 2 ngăn phụ: 1 ngăn ở phía trước và phía sau dạng hộp có dây kéo cho chàng thoả sức để đồ \r\n\r\n- Cặp có cả dây đeo và quai xách tích hợp cho chàng nhiều phong cách khác nhau,ngoài ra dây đeo rất tiện lợi có thể thu ngắn hay dài ra phù hợp và cân đối ', '2023-11-15 16:09:02', '2023-11-15 16:09:45'),
('SP21', 'Cặp đựng laptop GUBAG TL10 cho nam công sở, văn phòng, thiết kế thời trang, lịch sự, vải chống thấm nước, chống xước', 'IMG/PhotosProduct/1700064655.jpg', 370200, 'Cặp đựng laptop công sở cao cấp dành cho nam. Đựng được laptop 15,6 inch thoải mái, nhẹ nhàng. Cặp có dây đeo chéo khi cần, tùy vào mục đích sử dụng. Phù hợp với những công việc văn phòng, máy tính hay mang theo laptop.\r\nTHÔNG TIN SẢN PHẨM:\r\nKích thước: \r\n13/14 inch: 37*27*7cm, khối lượng: 0.3kg.\r\n15,6 inch: 39*30 *7 cm, khối lượng: 0.31kg.\r\nKhóa túi: Nút nam châm kép vô hình, lực hút mạnh, thiết kế đẹp và bền.\r\nQuai xách bằng da, may chắc chắn, bền bỉ, gập đi gập lại 10 triệu lần thoải mái.\r\nNhiều ngăn: đựng laptop, giấy tờ, sách sở, điện thoại, ví tiền, sạc máy tính, sạc dự phòng…\r\n***Cam kết với khách hàng:\r\n- Sản phẩm giống mô tả.\r\n- Đảm bảo chất lượng, dịch vụ tốt, hàng được giao từ 1-5 ngày kể từ ngày đặt hàng.\r\n- Đổi trả theo đúng quy định của Shopee.\r\n1. Điều kiện áp dụng (trong vòng 03 ngày kể từ khi nhận sản phẩm):\r\n- Hàng hoá vẫn còn mới, chưa qua sử dụng\r\n- Hàng hóa bị lỗi, hư hỏng do vận chuyển hoặc do nhà sản xuất.\r\n2. Trường hợp được chấp nhận đổi trả:\r\n- Hàng không đúng chủng loại, mẫu mã như quý khách đặt hàng.\r\n- Không đủ số lượng, không đủ bộ như trong đơn hàng.\r\n- Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ…\r\n3. Trường hợp không đủ điều kiện áp dụng chính sách:\r\n- Quá 03 ngày kể từ khi Quý khách nhận hàng.\r\n- Gửi lại hàng không đúng mẫu mã, không phải hàng của shop.\r\n- Đặt nhầm sản phẩm, chủng loại, không thích, không hợp,...\r\n*** Lưu ý:\r\n- Bạn có thể lựa chọn đơn vị vận chuyển \"Giao hàng tiết kiệm\" nếu muốn giao hàng nhanh hơn.\r\n- Khách hàng muốn mua sỉ số lượng lớn, có thể liên hệ qua Hotline 0869.097.636.\r\nGUBAG - BÁN HÀNG BẰNG SỰ TỬ TẾ\r\n#capdunglaptop #caplaptop #capcongso #capdilam #capvanphong #capdeocheonam #capdungmaytinh #capcongsonam #capdungmacbook #capmacbook #capcongsonam #capxachcongso #capdilamcongso #capdilamcongsonam #capcanbocongso #capcongsochonam', '2023-11-15 16:10:55', '2023-11-15 16:11:24'),
('SP22', 'Ghế sofa văn phòng êm ái, bền đẹp sofa phòng khách phòng ngủ, spa, khách sạn Sofa decor', 'IMG/PhotosProduct/1700149572.jpg', 2940000, 'VĂNG/ GHẾ SOFA PHONG CÁCH BẮC ÂU\r\nLưu ý: Chỉ dành cho hình thức Nhà Bán Hàng tự vận chuyển\r\n- Phí vận chuyển giao hàng ở nội thành Hà Nội: miễn ship hoàn toàn\r\n- Khách hàng ở tỉnh khác không đặt được hàng trên shopee vui lòng liên hệ z.alo 0977654652 để được hướng dẫn đặt hàng và hỗ trợ vận chuyển. H2 Furniture xin lỗi chủ nhà vì sự bất tiện này.\r\nCác tỉnh miền Nam và Nam Trung Bộ shop không giao được, khách lưu ý trước khi đặt hàng gíup shop.\r\n\r\nSOFA phong cách BẮC ÂU hàng có sẵn nhiều màu\r\nKích thước 1.4m - 1.8m chiều sâu 75 cao từ 70cm* 75 cm tùy mẫu\r\nTặng Kèm đôn, gối tựa và gối ôm\r\n1. Chính sách bảo hành:\r\nThời gian bảo hành: 12 tháng\r\nMột số trường hợp H2 FURNITURE bảo hành:\r\n- Sản phẩm bị hư hỏng/ bể vỡ trong quá trình vận chuyển \r\n- Sản phẩm bị lỗi do lỗi từ nhà sản xuất \r\n- Sản phẩm giao đến không đúng với đơn hàng đã đặt \r\n- Sản phẩm được giao không đủ số lượng theo đơn hàng đã đặt\r\n- Những lỗi khác do kỹ thuật, chất liệu của sản phẩm\r\nChăm sóc, hỗ trợ & tư vấn trọn đời\r\n\r\n2. Hướng dẫn sử dụng:\r\n- Hạn chế tiếp xúc với ánh nắng mặt trời, nơi ẩm ướt. Nên lau khô khi sản phẩm tiếp xúc với nước\r\n- Sử dụng các chất tẩy rửa chuyên dụng để không làm mất độ thẩm mỹ của vải.\r\n- Khi gặp vấn đề liên hệ dịch vụ CSKH của H2 FURNITURE để được hỗ trợ nhanh nhất. \r\n\r\n3. Mẹo khi mua hàng:\r\n- Áp dụng đúng mã voucher để được ưu đãi tốt nhất\r\n- Khi nhận hàng, khách hàng nên quay video lúc mở sản phẩm để đảm bảo quyền lợi khi có sự cố phải đổi trả sản phẩm. \r\n- Hãy để lại vài lời đánh giá chân thành về chất lượng sản phẩm/dịch vụ để góp phần H2 FURNITURE phát triển tốt sản phẩm/ dịch vụ và nhận được thêm nhiều ƯU ĐÃI.\r\n\r\nXUẤT XỨ VÀ CƠ SỞ \r\n- Sản xuất bởi CT TNHH sản xuất và thương mại nội thất Gia Nguyên\r\n- Địa chỉ: số 99 KCN - DV Vĩnh Lộc, Thạch Thất, Hà Nội\r\n- Hotline: 0977654652/ 0981999657', '2023-11-16 15:46:12', '2023-11-16 15:47:14'),
('SP23', 'Bàn ghế bộ văn phòng, showroom sang trọng, lịch sự giá rẻ', 'IMG/PhotosProduct/1700149802.jpg', 2850000, 'Bàn ghế Santang- tự hào chất lượng cao, hàng chĩnh hãng\r\nGhế nhựa đúc nguyên khối nhựa PP cao cấp, chân gỗ thông\r\nQuy cách:82*45*50\r\nMàu sắc: đỏ, cam, vàng lục, trắng, đen, xám, xánh lá, hồng, ........\r\nBàn gỗ MDF, chân gỗ thông\r\nQuy cách: Đk 60cm \r\nLiên hệ: 0901 32 6668 để được tư vấn và báo giá tốt nhất \r\nCÔNG TY TNHH VẬT LIỆU KỸ THUẬT HẠ TẦNG ĐÔNG HƯNG\r\nĐC kho hàng :  P. an thạnh 24. Thuận An Bình Dương\r\nGiao hàng toàn quốc,  nhanh chóng, thuận tiện, an toàn', '2023-11-16 15:50:02', '2023-11-16 15:50:34'),
('SP24', 'Balo, cặp Laptop Tích Hợp Cổng Sạc Dự Phòng PRAZA BL174 ', 'IMG/PhotosProduct/1700149926.jpg', 149000, 'THÔNG TIN SẢN PHẨM\r\n\r\nĐặc tính nổi bật\r\n\r\n- Kích thước 41cm x 28cm x 12cm rộng rãi\r\n\r\nSản phẩm có kích thước rộng rãi, được chia làm nhiều ngăn tiện lợi. Có các ngăn lớn  để đựng các vật dụng cần thiết và nhiều ngăn nhỏ để đựng giấy tờ, tiền, ví… tiện dùng khi đi học, làm việc.\r\n\r\n- Thiết kế tinh tế, màu sắc thanh lịch\r\n\r\n+ Tích hợp cổng ra USB, bạn có thể dễ dàng kết nối điện thoại vào sạc dự phòng khi đi đường.\r\n\r\n- Chất liệu vải Polyester cao cấp\r\n\r\nBalo PRAZA được gia công bằng chất liệu vải Polyester chất lượng cao, khó phai màu và bền bỉ. Bạn sẽ dễ dàng bảo quản và sử dụng được khá lâu. Hiện những sản phẩm được sản xuất bằng chất liệu này đang trở nên rất thịnh hành nhờ độ bền và thẩm mỉ của nó.\r\n\r\n- Đường may tỉ mỉ, chắc chắn\r\n\r\nSản phẩm được chế tác bằng những đường may tỉ mỉ và chắc chắn, không chỉ mang đến độ bền mà còn mang đến tính thẩm mỹ, tinh tế cao. Phần dây đeo có thể điều chỉnh độ ngắn dài, được may bằng kỹ thuật gấp mép dây viền, thiết kế ôm rất sát hai vai, vững chắc.\r\n\r\n- Sản xuất tại: Việt Nam\r\n\r\n- Thời gian bảo hành: 01 tháng\r\n\r\n- Loại hình bảo hành: bằng hóa đơn mua hàng\r\n\r\nLưu ý:\r\n\r\n* Vui lòng cho phép sai số 1-2cm do đo lường thủ công.\r\n\r\n* Màu sắc thực tế của sản phẩm có thể hơi khác so với hình ảnh được hiển thị do sự khác biệt giữa màn hình và độ sáng.', '2023-11-16 15:52:06', '2023-11-17 00:12:59'),
('SP25', 'Dao rọc giấy inox Mini (dao dọc giấy nhỏ gọn) tiện ích loại xịn cho văn phòng 88073', 'IMG/PhotosProduct/1700150100.jpg', 12000, 'Dao Rọc Giấy thiết kế lưỡi dao bằng hợp kim thép sắc bén, nhỏ gọn nhưng rất cứng cáp cho bạn cắt, rọc giấy thật dễ dàng, nhanh chóng theo ý thích.\r\nDao có vỏ bọc bằng kim loại đảm bảo an toàn cho đôi tay của bạn. Bạn chỉ cần đẩy khóa chốt lên để cố định độ dài lưỡi dao lúc cắt và kéo xuống để cất dọn, thật dễ dàng khi sử dụng.\r\n\r\nThông tin sản phẩm: \r\n•	Kích thước : 13 x 1.2 cm\r\n•	Kích thước lưỡi dao : 83mm x 9mm\r\n•	Trọng lượng : 10g\r\n•	Chất liệu hợp kim thép\r\n•	Lưỡi dao được làm từ thép cứng, mỏng & rất sắc có thể trượt để thay đổi độ dài ngắn của lưỡi dao sao cho phù hợp với công việc.\r\nXuất Xứ : Trung Quốc\r\nCông Ty Sản Xuất : Yiwu Baoxuan Electronic Commerce Co., Ltd.\r\nCông Ty Nhập Khẩu : Công Ty TNHH Thương Mại Và Xuất Nhập Khẩu Quốc Tế Vĩnh Phát\r\nĐịa Chỉ Công Ty Nhập Khẩu : Huyện Yên Lạc , Tỉnh Vĩnh Phúc\r\n\r\nSản phẩm có kích thước nhỏ gọn cùng phần lưỡi dao được rút gọn bên trong giúp bạn có thể mang theo trong các chuyến đi một cách an toàn.\r\nNgoài cắt, trổ, rọc giấy bạn có thể sử dụng để làm nhiều công việc khác như gọt bút chì, rọc vải, cắt tỉa hoa quả…\r\n* LUCKYSTAR_STORE *\r\n:Nhà bán hàng sỉ lẻ nhập trực tiếp \r\n:Cung cấp các mặt hàng : đồ gia dụng , đồ tiện ích thông minh, đồ trang trí, thời trang nam nữ,phụ kiện.... Nguồn hàng hàng triệu sản phẩm.\r\n:Quý khách mua hàng lưu ý lấy mã giảm giá của SHOP và mã miễn phí vận chuyển của SHOPEE.\r\nHỗ trợ mọi yêu cầu tìm nguồn hàng, đặt hàng tuỳ chỉnh theo yêu cầu.\r\nLiên hệ : 0961182926( Call - Sms - Zalo )', '2023-11-16 15:55:00', '2023-11-16 15:55:31'),
('SP26', 'Bút ký cao cấp khắc tên theo yêu cầu TopGift IM010 Xoay mở ngòi', 'IMG/PhotosProduct/1700151577.jpg', 129000, 'Bút ký khắc tên theo yêu cầu Xoay mở ngòi TopGift IM010 - Quà tặng sinh nhật, thầy cô, tốt nghiệp\r\nBút ký là một trong những món quà ý nghĩa không thể thiếu đối với mọi cá nhân trong đời sống. Đặc biệt ý nghĩa hơn là mang phong cách cá nhân và thông điệp yêu thương của từng người. Tôn vinh tính độc lập cá nhân, quảng bá thương hiệu và hơn hết là một món qua nhắn gửi yêu thương mang thông điệp cá nhân của người tặng đến với người mình yêu thương nhất.\r\n\r\nTOP QUÀ TẶNG xin gửi đến với quý khách dong bút xoay IM 001 chuyên dùng để ký với viền lấy phong cách từ kiến trúc la mã độc đáo. Bút vừa vặn, tiện dụng vừa để ký với ngòi 0.7mm.\r\nCHÍNH SÁCH BẢO HÀNH – ĐỔI TRẢ - SAI THÔNG TIN:\r\n\r\n-	Tất cả các sản phẩm được BẢO HÀNH 6 THÁNG nếu lỗi kỹ thuật từ NHÀ SẢN XUẤT.\r\n\r\n-	BẢO HÀNH MỚI 100% (1 đổi 1).\r\n\r\n-	BẢO HÀNH TRÊN HOÁ ĐƠN MUA HÀNG.\r\n\r\n-	Trong qúa trình Khắc tên, Khắc Logo. Nếu sai thông tin không đúng theo yêu cầu quý khách sẽ được ĐỔI MỚI và LÀM LẠI SẢN PHẨM MỚI 100% cho quý khách. Mọi chi phí SHIP hàng sẽ do SHOP chịu.', '2023-11-16 16:19:37', '2023-11-16 16:20:24'),
('SP27', 'BÚT BI NƯỚC VĂN PHÒNG SIÊU RẺ SIÊU ĐỀU MỰC', 'IMG/PhotosProduct/1700151687.jpg', 14500, 'MÔ TẢ SẢN PHẨM\r\n Trộn màu quý khách vui lòng nhắn tin cho shop để được trộn đủ màu đủ số lượng ạ\r\n- Thiết kế ngòi bút 0,5mm\r\n- Thân bút vừa vặn\r\n- Mực ra đều và liên tục\r\n- Bút bi dạng gel nước viết cực trơn\r\n- Bút nước mini luôn là bạn đồng hành cho mọi người\r\n- Bút viết không lem mực mực ra đều\r\n- Hàng bán chạy nhất nhiều năm qua\r\n- Có 3 màu cho các bạn lựa chọn xanh, đỏ, đen\r\n\r\nKHO GIA DỤNG LINH STORE, CHUYÊN CUNG CẤP BÁN BUÔN BÁN LẺ CÁC LOẠI MẶT HÀNG GIA DỤNG GIÁ TỐT NHẤT CHO CÁC ĐẠI LÝ,CỬA HÀNG TIỆN LỢI,SIÊU THỊ MINI\r\nCUNG CẤP CÁC SẢN PHẨM HOT THEO MÙA,CÁC MẶT HÀNG GIA DỤNG ONLINE\r\nCUNG CẤP CÁC SẢN PHẨM HỮU ÍCH CÁC VẬT DỤNG CẦN THIẾT CHO NHÀ HÀNG,KHÁCH SẠN KHI CÓ NHU CẦU\r\nMỌI THÔNG TIN XIN ĐỂ LẠI SDT ĐỂ SHOP LIÊN LẠC HỖ TRỢ TƯ VẤN MIỄN PHÍ Ạ', '2023-11-16 16:21:27', '2023-11-16 16:23:51'),
('SP28', 'Giỏ để đồ đa năng, để văn phòng phẩm, bàn làm việc tiện lợi, gọn gàng', 'IMG/PhotosProduct/1700151900.jpg', 17000, 'Thông tin sản phẩm : Giỏ Đựng Đồ Nhựa 4 Ngăn Đa Năng Cắm Bút Đựng Vật Dụng Cá Nhân Đồ Gia Dụng Tachi Store\r\nGiỏ đựng đồ để bàn Việt Nhật với thiết kế thông minh độc đáo 4 có thể để được rất nhiều đồ vật \r\nChất liệu nhựa dẻo, bền bỉ trong quá trình sử dụng Kiểu dáng trang nhã, bắt mắt \r\nChịu được va đập mạnh, thời gian sử dụng lâu dài\r\nSử dụng được với nhiều mục đích \r\nGiỏ đựng đồ đa năng / Khay tiện ích 4 ngăn Việt Nhật nhựa PP cao cấp hộp đựng bút để bàn trong suốt nhỏ gọn \r\nKích thước:9.5 x 17.6 x 12.7 cm\r\nNguyên liệu: Nhựa PP cao cấp\r\nGiỏ Đựng Đồ Nhựa 4 Ngăn Đa Năng Cắm Bút Đựng Vật Dụng Cá Nhân Đồ Gia Dụng Tachi Store', '2023-11-16 16:25:00', '2023-11-16 16:25:30'),
('SP29', 'Sổ Tay Bìa Da A5 X04-25 Màu Trơn 128 Trang Có Khóa Nam Châm', 'IMG/PhotosProduct/1700151998.jpg', 52000, 'Chào mừng đến với cửa hàng của chúng tôi\r\n- Màu bìa: xanh Bắc Âu, hồng Bắc Âu, đen trang nhã\r\n- Loại gáy: kết dính\r\n- Khối lượng giấy bên trong: 78 (g)\r\n- Kích thước giấy bên trong: A5 142 * 210mm\r\n- Định lượng giấy: 128 tờ giấy lót\r\n- Đặc điểm: khóa từ đơn giản và tinh tế', '2023-11-16 16:26:38', '2023-11-16 16:27:04'),
('SP30', 'BÚT BI MỰC XANH ÁNH SÁNG MS B33 ĐẦU BI 0.7mm', 'IMG/PhotosProduct/1700152126.jpg', 3200, 'BÚT BI MỰC XANH ÁNH SÁNG MS B33 ĐẦU BI\r\nCẢM ƠN MỌI NGƯỜI ĐÃ MUA HÀNG ỦNG HỘ SHOP NGƯỜI NÔNG DÂN.\r\n\r\n\r\nBÚT BI MỰC XANH\r\nBút\r\nĐặc điểm: Đầu bi:\r\nngòi 0.7mm \r\nhàng xuất xứ việt nam \r\nhàng gia công giá rẻ nên vận chuyển khi đặt mua hàng. không có bao bì vì mua dưới qui cách đóng gói thành hộp. \r\nnên có thể bị trầy trụa. khách hàng vui lòng bỏ qua\r\n\r\nBút bi dạng bấm cò, viết êm tay, không trơn tuột', '2023-11-16 16:28:46', '2023-11-16 16:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `thuoctinh`
--

CREATE TABLE `thuoctinh` (
  `id` int NOT NULL,
  `ma_thuoctinh` varchar(20) NOT NULL,
  `ten_thuoctinhcha` varchar(50) NOT NULL,
  `ten_thuoctinhcon` varchar(50) DEFAULT NULL,
  `ngaytao` datetime NOT NULL,
  `ngaycapnhat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `thuoctinh`
--

INSERT INTO `thuoctinh` (`id`, `ma_thuoctinh`, `ten_thuoctinhcha`, `ten_thuoctinhcon`, `ngaytao`, `ngaycapnhat`) VALUES
(8, 'TT1', 'Màu sắc', NULL, '2023-10-27 13:43:18', NULL),
(9, 'TT2', '', 'xanh', '2023-10-27 13:43:18', NULL),
(10, 'TT3', 'TT1', 'đỏ', '2023-10-27 13:43:18', NULL),
(11, 'TT4', 'TT1', 'tím', '2023-10-27 13:43:18', NULL),
(16, 'TT5', 'Loại', NULL, '2023-10-31 17:53:29', NULL),
(17, 'TT6', 'TT5', 'dễ vỡ', '2023-10-31 17:53:29', NULL),
(18, 'TT7', 'TT1', 'xanh', '2023-11-15 15:06:31', NULL),
(19, 'TT8', 'TT1', 'vàng', '2023-11-15 15:06:31', NULL),
(20, 'TT9', 'TT1', 'cam', '2023-11-15 15:06:31', NULL),
(21, 'TT10', 'TT1', 'đen', '2023-11-15 15:06:31', NULL),
(22, 'TT11', 'TT1', 'hồng', '2023-11-15 15:15:28', NULL),
(23, 'TT12', 'TT1', 'trắng', '2023-11-15 15:16:34', NULL),
(24, 'TT13', 'TT1', 'kaki', '2023-11-15 15:17:58', NULL),
(25, 'TT14', 'TT1', 'xanh lam', '2023-11-15 15:26:48', NULL),
(26, 'TT15', 'Đơn vị', NULL, '2023-11-15 15:34:16', NULL),
(27, 'TT16', 'TT15', 'lọ', '2023-11-15 15:34:16', NULL),
(28, 'TT17', 'TT15', 'chai', '2023-11-15 15:34:31', NULL),
(29, 'TT18', 'TT15', 'hộp', '2023-11-15 15:34:31', NULL),
(30, 'TT19', 'TT15', 'can', '2023-11-15 15:34:31', NULL),
(31, 'TT20', 'TT15', 'cái', '2023-11-15 15:34:31', NULL),
(32, 'TT21', 'Mã màu', NULL, '2023-11-15 16:03:18', NULL),
(33, 'TT22', 'TT21', 'ST1', '2023-11-15 16:03:18', NULL),
(34, 'TT23', 'Số lượng', NULL, '2023-11-16 15:49:01', NULL),
(35, 'TT24', 'TT23', '1 ghế', '2023-11-16 15:49:01', NULL),
(36, 'TT25', 'TT23', '2 ghế', '2023-11-16 15:49:14', NULL),
(37, 'TT26', 'TT23', '4 ghế', '2023-11-16 15:49:14', NULL),
(38, 'TT27', 'TT23', '6 ghế', '2023-11-16 15:49:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chitiet_hoadon`
--
ALTER TABLE `chitiet_hoadon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chitiet_sanpham`
--
ALTER TABLE `chitiet_sanpham`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `diachi_nhanhang`
--
ALTER TABLE `diachi_nhanhang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thuoctinh`
--
ALTER TABLE `thuoctinh`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chitiet_hoadon`
--
ALTER TABLE `chitiet_hoadon`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chitiet_sanpham`
--
ALTER TABLE `chitiet_sanpham`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `diachi_nhanhang`
--
ALTER TABLE `diachi_nhanhang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `thuoctinh`
--
ALTER TABLE `thuoctinh`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
