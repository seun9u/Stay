-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-12-21 07:50
-- 서버 버전: 10.4.25-MariaDB
-- PHP 버전: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `stay`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `content_code` varchar(50) NOT NULL,
  `nights` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `content_code`, `nights`, `total_price`, `room_name`, `thumbnail`, `created_at`) VALUES
(2, 'damuljang', 'ROOM_674f015de2d12', 1, 10000, '에이바 호텔', 'img/contents/room1.jpg', '2024-12-04 02:15:27'),
(13, 'jang', 'ROOM_675dcac9b69ab', 1, 80000, '기가 막힌 호텔', 'img/hotel/hotel101.jpg', '2024-12-21 04:11:26'),
(14, 'admin', 'ROOM_675dcac9b69ab', 5, 400000, '기가 막힌 호텔', 'img/hotel/hotel101.jpg', '2024-12-21 05:43:39'),
(17, 'park', 'ROOM_675dcd186022d', 1, 75000, '하루 더있고 싶은 모텔', 'img/motel/motel105.jpg', '2024-12-21 06:04:26');

-- --------------------------------------------------------

--
-- 테이블 구조 `contents`
--

CREATE TABLE `contents` (
  `content_code` char(14) NOT NULL,
  `content_img` varchar(500) NOT NULL,
  `deliv_today` char(1) NOT NULL,
  `content_name` varchar(50) NOT NULL,
  `discount_rate` decimal(3,0) NOT NULL,
  `content_cost` int(11) NOT NULL,
  `content_price` int(11) NOT NULL,
  `content_color1` varchar(30) DEFAULT NULL,
  `content_color2` varchar(30) DEFAULT NULL,
  `content_color3` varchar(30) DEFAULT NULL,
  `content_color4` varchar(30) DEFAULT NULL,
  `category_large` varchar(50) DEFAULT NULL,
  `category_small` varchar(50) DEFAULT NULL,
  `content_img1` varchar(500) DEFAULT NULL,
  `content_img2` varchar(500) DEFAULT NULL,
  `content_img3` varchar(500) DEFAULT NULL,
  `content_img4` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `contents`
--

INSERT INTO `contents` (`content_code`, `content_img`, `deliv_today`, `content_name`, `discount_rate`, `content_cost`, `content_price`, `content_color1`, `content_color2`, `content_color3`, `content_color4`, `category_large`, `category_small`, `content_img1`, `content_img2`, `content_img3`, `content_img4`) VALUES
('221119-001', 'img/contents/content2.jpg', 'Y', '진짜 너무 예쁜', '30', 60000, 35000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('221119-002', 'img/contents/content2.jpg', 'N', '진짜 너무 예쁜', '30', 60000, 35000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('221119-003', 'img/contents/content3.jpg', 'Y', '기분좋은날 입는', '20', 50000, 35000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('221119-004', 'img/contents/content4.jpg', 'Y', '안사면 후회하는', '10', 60000, 35000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('221119-005', 'img/contents/content5.jpg', 'N', '안사면 후회하는', '30', 60000, 25000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('221119-006', 'img/contents/content6.jpg', 'N', '진짜 너무 예쁜', '20', 30000, 35000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('221119-007', 'img/contents/content7.jpg', 'Y', '기분좋은날 입는', '20', 50000, 35000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('221119-008', 'img/contents/content8.jpg', 'Y', '안사면 후회하는', '50', 90000, 50000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('221119-009', 'img/contents/content9.jpg', 'N', '진짜 너무 예쁜', '30', 60000, 30000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('221119-010', 'img/contents/content10.jpg', 'Y', '기분좋은날 입는', '30', 60000, 45000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `member_id` char(15) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `discount_rate` int(11) NOT NULL,
  `is_used` tinyint(4) DEFAULT 0,
  `issued_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `used_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `coupons`
--

INSERT INTO `coupons` (`id`, `member_id`, `coupon_name`, `discount_rate`, `is_used`, `issued_at`, `used_at`) VALUES
(1, '', '신규가입 쿠폰', 10, 0, '2024-11-27 01:04:16', NULL),
(2, '', '신규가입 쿠폰', 10, 0, '2024-11-27 01:04:42', NULL),
(3, '', '신규가입 쿠폰', 10, 0, '2024-11-27 01:04:50', NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `members`
--

CREATE TABLE `members` (
  `id` char(15) NOT NULL,
  `pass` varchar(450) NOT NULL,
  `name` char(10) NOT NULL,
  `phone` char(20) NOT NULL,
  `birth` char(20) NOT NULL,
  `email` char(80) NOT NULL,
  `refferer` char(15) NOT NULL,
  `sns_receive` varchar(3) DEFAULT 'no',
  `email_receive` varchar(3) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `members`
--

INSERT INTO `members` (`id`, `pass`, `name`, `phone`, `birth`, `email`, `refferer`, `sns_receive`, `email_receive`) VALUES
('1', '$2y$10$eWRNYpvIhACy4.2mrBZZe.4feD.Ge7dkGKHZ69mJ0ovpsorYH6B6W', '1', '1', '1', '1@naver.com', '', 'yes', 'yes'),
('1234', '$2y$10$nemazVt0fjkOg1OhxcINYOoJMLbmYUZrvUYUkTdYI6eNz/2mMub1q', '1234', '123123123', '123', '1234@1234', '', 'no', 'no'),
('12345', '$2y$10$.K.J2nkv9g.q/1vWzlOeKOt.ZmIoPeV1DVoIlwQSSKYe8H1QvMmWO', '12345', '12345', '1212', '12345@12345', '', 'yes', 'yes'),
('admin', '$2y$10$qnDWRu4rmJk0Nv9TKJE.vewTFjuSha3/GayhJvB5O21oBFYYX/8CC', '관리자', '01021226001', '021202', 'admin@gmail.com', '', 'no', 'no'),
('damuljang', '$2y$10$Bl/NdrXLlqoC96y9YZhkie3UWSzQ56lQDF3rzU20o08Pj4SBIdSmW', '장현서', '01021226001', '021212', 'klikliapple@gmail.com', '', 'no', 'no'),
('jang', '$2y$10$0bf9HT.4zJGUHeT.UyqC8ea/JS0bLCiSTmuQw3cUapni1zqTBecvC', '장현서', '01021226001', '021212', 'klikliapple@gmail.com', '', 'no', 'no'),
('kkang', '$2y$10$SpNSfwxbtCmjuR5KDwUbDOoIlsfbQl/bI0fd.CXDKVfwhNZlualpy', '강승구', '01021220150', '121212', 'klikliapple@gmail.com', '', 'no', 'no'),
('park', '$2y$10$w2wWw5yLmEOiqSTO8UOjt.mIzR7DzoTuntPgi8Fuue/hEDcmQvXtS', '박종학', '01012341234', '012012', 'park@gmail.com', '', 'no', 'no'),
('wkdgustj1547', '$2y$10$fh4Xq0mh0Nsi/539BbNNQeJu0xWrjv.iNgVMOp/wtP4.5Yc5Cki0W', '김미누', '01011111111', '031211', 'wkdgustj1547@naver.com', '', 'no', 'no');

-- --------------------------------------------------------

--
-- 테이블 구조 `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `onetoone`
--

CREATE TABLE `onetoone` (
  `id` int(11) NOT NULL,
  `inquiry_type` varchar(255) NOT NULL,
  `inquiry_title` varchar(255) NOT NULL,
  `inquiry_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `userid` varchar(255) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `admin_response` text DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `onetoone`
--

INSERT INTO `onetoone` (`id`, `inquiry_type`, `inquiry_title`, `inquiry_content`, `created_at`, `userid`, `content`, `admin_response`, `password`) VALUES
(6, '회원', '로그인이 안돼요', '', '2024-12-18 00:52:22', 'qwer', 'ㅈㄱㄴ', '시발럼아\r\n', '$2y$10$iYMqIABjIK1j2HHLb2MuFuXkN3zgsNkI1f/WbrE3Hktgqcy5Y4qTi'),
(7, '숙소', '숙소가 이상해요', '', '2024-12-21 06:29:16', 'park', '숙소가 이상해요', '답변 작성완료', '$2y$10$lASF4P.RmbWhJM3FBNuQ4u5j5y9pNxsemzqvIimB1pVtN15hRFY6S');

-- --------------------------------------------------------

--
-- 테이블 구조 `pay`
--

CREATE TABLE `pay` (
  `order_id` char(14) NOT NULL,
  `orderer_name` char(10) NOT NULL,
  `orderer_email` char(80) NOT NULL,
  `orderer_phone` char(20) NOT NULL,
  `Recipient_name` char(10) NOT NULL,
  `zip_code` char(5) NOT NULL,
  `address1` varchar(50) NOT NULL,
  `address2` varchar(50) NOT NULL,
  `Recipient_phone` char(20) NOT NULL,
  `message` varchar(20) NOT NULL,
  `member_id` char(15) NOT NULL,
  `order_contents` varchar(500) NOT NULL,
  `review` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `reservation_code` varchar(10) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `content_code` varchar(20) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `total_payment` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `reservation`
--

INSERT INTO `reservation` (`id`, `reservation_code`, `user_id`, `content_code`, `customer_name`, `customer_phone`, `total_payment`, `created_at`) VALUES
(1, '4565064C', '', 'ROOM_674f015de2d12', '장현서', '01021226001', 40000, '2024-12-04 02:01:25'),
(2, 'C10C9A09', '', 'ROOM_674f9d6812742', '강승구', '010-2123-2342', 900000, '2024-12-04 09:10:04'),
(3, '30D7A037', '', 'ROOM_674fa06a3d0b0', '박종학', '123123', 99999999, '2024-12-04 09:22:01'),
(4, 'F0883223', '', 'ROOM_674fa06a3d0b0', '박종학', 'ㄷㄱㅈㄷㄱ14234`', 800000000, '2024-12-04 09:26:16'),
(5, 'A80E6277', '', 'ROOM_674fa06a3d0b0', '박종학', 'ㄷㄱㅈㄷㄱ14234`', 800000000, '2024-12-04 09:27:01'),
(6, '7741B8CD', 'damuljang', 'ROOM_674f015de2d12', '장현서', '01021226001', 10000, '2024-12-04 10:45:21'),
(7, '5434F9F4', 'damuljang', 'ROOM_674f015de2d12', '장현서', '01021226001', 70000, '2024-12-04 10:49:22'),
(8, '679779F8', 'jang', 'ROOM_674f015de2d12', '장현서', '01021226001', 80000, '2024-12-11 09:17:57'),
(9, 'E4685E10', 'kkang', 'ROOM_6758e96c05eaf', '강승구', '01021220150', 10000, '2024-12-11 10:24:40'),
(10, '44BB1BB5', 'jang', 'ROOM_675dcac9b69ab', '장현서', '01021226001', 80000, '2024-12-18 10:22:58'),
(11, 'C29FD81C', 'jang', 'ROOM_675dcbfd871a2', '장현서', '01021226001', 240000, '2024-12-18 10:27:22'),
(12, '2B1045E4', 'jang', 'ROOM_675dcac9b69ab', '장현서', '01021226001', 400000, '2024-12-21 14:20:25'),
(13, 'FE8021B5', 'jang', 'ROOM_675dcb9f4b447', '장현서', '01021226001', 180000, '2024-12-21 14:40:51'),
(14, '0C62E063', 'park', 'ROOM_675dcd186022d', '박종학', '01012341234', 75000, '2024-12-21 15:10:00'),
(15, '7AEB420C', 'park', 'ROOM_675dcd186022d', '박종학', '01012341234', 75000, '2024-12-21 15:10:14');

-- --------------------------------------------------------

--
-- 테이블 구조 `review`
--

CREATE TABLE `review` (
  `review_id` int(10) UNSIGNED NOT NULL,
  `writer_id` char(15) NOT NULL,
  `content_code` char(14) NOT NULL,
  `review_contents` varchar(500) NOT NULL,
  `photo` text DEFAULT NULL,
  `star` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `rooms`
--

CREATE TABLE `rooms` (
  `room_code` varchar(50) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_price` decimal(10,2) NOT NULL,
  `content_img` varchar(255) NOT NULL,
  `content_img1` varchar(255) DEFAULT NULL,
  `content_img2` varchar(255) DEFAULT NULL,
  `content_img3` varchar(255) DEFAULT NULL,
  `content_img4` varchar(255) DEFAULT NULL,
  `category_large` varchar(50) NOT NULL,
  `category_small` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `room_location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `rooms`
--

INSERT INTO `rooms` (`room_code`, `room_name`, `room_price`, `content_img`, `content_img1`, `content_img2`, `content_img3`, `content_img4`, `category_large`, `category_small`, `created_at`, `room_location`) VALUES
('ROOM_675dcac9b69ab', '기가 막힌 호텔', '80000.00', 'img/hotel/hotel101.jpg', 'img/hotel/hotel1.jpg', 'img/hotel/hotel2.jpg', 'img/hotel/hotel3.jpg', 'img/hotel/hotel4.jpg', '호텔', '스탠다드', '2024-12-15 03:14:29', '전남-여수'),
('ROOM_675dcb24ca8c6', '야무진 호텔', '150000.00', 'img/hotel/hotel102.jpg', 'img/hotel/hotel5.jpg', 'img/hotel/hotel6.jpg', 'img/hotel/hotel7.jpg', 'img/hotel/hotel8.jpg', '호텔', '럭셔리', '2024-12-15 03:15:47', '부산'),
('ROOM_675dcb69ef603', '꿀잠 호텔', '110000.00', 'img/hotel/hotel103.jpg', 'img/hotel/hotel9.jpg', 'img/hotel/hotel10.jpg', 'img/hotel/hotel11.jpg', 'img/hotel/hotel12.jpg', '호텔', '스탠다드', '2024-12-15 03:16:57', '제주'),
('ROOM_675dcb9f4b447', '숙면 호텔', '180000.00', 'img/hotel/hotel104.jpg', 'img/hotel/hotel13.jpg', 'img/hotel/hotel14.jpg', 'img/hotel/hotel15.jpg', 'img/hotel/hotel16.jpg', '호텔', '럭셔리', '2024-12-15 03:17:47', '서울-강남'),
('ROOM_675dcbcde51b3', '힐링 호텔', '230000.00', 'img/hotel/hotel105.jpg', 'img/hotel/hotel17.jpg', 'img/hotel/hotel18.jpg', 'img/hotel/hotel19.jpg', 'img/hotel/hotel20.jpg', '호텔', '럭셔리', '2024-12-15 03:18:29', '강원-강릉'),
('ROOM_675dcbfd871a2', '제일 좋은 모텔', '60000.00', 'img/motel/motel101.jpg', 'img/motel/motel1.jpg', 'img/motel/motel2.jpg', 'img/motel/motel3.jpg', 'img/motel/motel4.jpg', '모텔', '이코노미', '2024-12-15 03:20:19', '강원-춘천'),
('ROOM_675dcc644e961', '짱 좋은 모텔', '80000.00', 'img/motel/motel102.jpg', 'img/motel/motel5.jpg', 'img/motel/motel6.jpg', 'img/motel/motel7.jpg', 'img/motel/motel8.jpg', '모텔', '이코노미', '2024-12-15 03:21:00', '울산'),
('ROOM_675dcc967eb64', '내 집 같은 모텔', '70000.00', 'img/motel/motel103.jpg', 'img/motel/motel9.jpg', 'img/motel/motel10.jpg', 'img/motel/motel11.jpg', 'img/motel/motel12.jpg', '모텔', '스탠다드', '2024-12-15 03:21:58', '인천-부평'),
('ROOM_675dccd26d446', '다시 오고 싶은 모텔', '90000.00', 'img/motel/motel104.jpg', 'img/motel/motel13.jpg', 'img/motel/motel14.jpg', 'img/motel/motel15.jpg', 'img/motel/motel16.jpg', '모텔', '럭셔리', '2024-12-15 03:22:52', '경기-성남'),
('ROOM_675dcd186022d', '하루 더있고 싶은 모텔', '75000.00', 'img/motel/motel105.jpg', 'img/motel/motel17.jpg', 'img/motel/motel18.jpg', 'img/motel/motel19.jpg', 'img/motel/motel20.jpg', '모텔', '스탠다드', '2024-12-15 03:24:17', '서울-노원'),
('ROOM_675dcd757f550', '또 오고 싶은 펜션', '160000.00', 'img/pension/pension101.jpg', 'img/pension/pension1.jpg', 'img/pension/pension2.jpg', 'img/pension/pension3.jpg', 'img/pension/pension4.jpg', '펜션', '스탠다드', '2024-12-15 03:25:47', '경기-가평'),
('ROOM_675dcdb7ec56c', '자연 펜션', '150000.00', 'img/pension/pension102.jpg', 'img/pension/pension5.jpg', 'img/pension/pension6.jpg', 'img/pension/pension7.jpg', 'img/pension/pension8.jpg', '펜션', '럭셔리', '2024-12-15 03:26:42', '강원-원주'),
('ROOM_675dcdeab7352', '힐링 펜션', '210000.00', 'img/pension/pension103.jpg', 'img/pension/pension9.jpg', 'img/pension/pension10.jpg', 'img/pension/pension11.jpg', 'img/pension/pension12.jpg', '펜션', '스탠다드', '2024-12-15 03:27:38', '경기-포천'),
('ROOM_675dce1b693dc', '풀 펜션', '250000.00', 'img/pension/pension104.jpg', 'img/pension/pension13.jpg', 'img/pension/pension14.jpg', 'img/pension/pension15.jpg', 'img/pension/pension16.jpg', '펜션', '럭셔리', '2024-12-15 03:28:20', '경기-파주'),
('ROOM_675dce4503d18', '두번 오고 싶은 펜션', '230000.00', 'img/pension/pension105.jpg', 'img/pension/pension17.jpg', 'img/pension/pension18.jpg', 'img/pension/pension19.jpg', 'img/pension/pension20.jpg', '펜션', '럭셔리', '2024-12-15 03:29:20', '강원-강릉'),
('ROOM_675dcea0e8f19', '제일 좋은 글램핑', '170000.00', 'img/glamping/glamping101.jpg', 'img/glamping/glamping1.jpg', 'img/glamping/glamping2.jpg', 'img/glamping/glamping3.jpg', 'img/glamping/glamping4.jpg', '글램핑', '스탠다드', '2024-12-15 03:31:17', '경기-양주'),
('ROOM_675dcef754d08', '짱 좋은 글램핑', '180000.00', 'img/glamping/glamping102.jpg', 'img/glamping/glamping5.jpg', 'img/glamping/glamping6.jpg', 'img/glamping/glamping7.jpg', 'img/glamping/glamping8.jpg', '글램핑', '럭셔리', '2024-12-15 03:31:58', '강원-양구'),
('ROOM_675dcf1f64acd', '내 집 같은 글램핑', '210000.00', 'img/glamping/glamping103.jpg', 'img/glamping/glamping9.jpg', 'img/glamping/glamping10.jpg', 'img/glamping/glamping11.jpg', 'img/glamping/glamping12.jpg', '글램핑', '스탠다드', '2024-12-15 03:32:41', '강원-평창'),
('ROOM_675dcf4be4641', '다시 오고 싶은 글램핑', '250000.00', 'img/glamping/glamping104.jpg', 'img/glamping/glamping13.jpg', 'img/glamping/glamping14.jpg', 'img/glamping/glamping15.jpg', 'img/glamping/glamping16.jpg', '글램핑', '럭셔리', '2024-12-15 03:33:30', '충북-제천'),
('ROOM_675dcf7b69fcb', '하루 더 있고 싶은 글램핑', '170000.00', 'img/glamping/glamping105.jpg', 'img/glamping/glamping17.jpg', 'img/glamping/glamping18.jpg', 'img/glamping/glamping19.jpg', 'img/glamping/glamping20.jpg', '글램핑', '이코노미', '2024-12-15 03:34:39', '충북-서산'),
('ROOM_675dd03301025', '기가 막힌 리조트', '280000.00', 'img/resort/resort101.jpg', 'img/resort/resort1.jpg', 'img/resort/resort2.jpg', 'img/resort/resort3.jpg', 'img/resort/resort4.jpg', '리조트', '럭셔리', '2024-12-15 03:37:38', '서울-강남'),
('ROOM_675dd072e9484', '야무진 리조트', '290000.00', 'img/resort/resort102.jpg', 'img/resort/resort5.jpg', 'img/resort/resort6.jpg', 'img/resort/resort7.jpg', 'img/resort/resort8.jpg', '리조트', '럭셔리', '2024-12-15 03:38:21', '경기-김포'),
('ROOM_675dd09e7cac4', '꿀잠 리조트', '310000.00', 'img/resort/resort103.jpg', 'img/resort/resort9.jpg', 'img/resort/resort10.jpg', 'img/resort/resort11.jpg', 'img/resort/resort12.jpg', '리조트', '스탠다드', '2024-12-15 03:39:04', '인천-부평'),
('ROOM_675dd0c98a505', '너무 재밌는 리조트', '340000.00', 'img/resort/resort104.jpg', 'img/resort/resort13.jpg', 'img/resort/resort14.jpg', 'img/resort/resort15.jpg', 'img/resort/resort16.jpg', '리조트', '럭셔리', '2024-12-15 03:39:51', '제주'),
('ROOM_675dd0f8bdbb5', '숙면 리조트', '450000.00', 'img/resort/resort105.jpg', 'img/resort/resort17.jpg', 'img/resort/resort18.jpg', 'img/resort/resort19.jpg', 'img/resort/resort20.jpg', '리조트', '럭셔리', '2024-12-15 03:40:35', '부산');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- 테이블의 인덱스 `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`content_code`);

--
-- 테이블의 인덱스 `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_member_id` (`member_id`);

--
-- 테이블의 인덱스 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `onetoone`
--
ALTER TABLE `onetoone`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`order_id`);

--
-- 테이블의 인덱스 `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reservation_code` (`reservation_code`);

--
-- 테이블의 인덱스 `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- 테이블의 인덱스 `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_code`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 테이블의 AUTO_INCREMENT `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `onetoone`
--
ALTER TABLE `onetoone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 테이블의 AUTO_INCREMENT `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 테이블의 AUTO_INCREMENT `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
