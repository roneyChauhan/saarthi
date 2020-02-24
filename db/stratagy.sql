-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2019 at 05:02 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stratagy`
--

-- --------------------------------------------------------

--
-- Table structure for table `bharat_admin`
--

CREATE TABLE `bharat_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_admin`
--

INSERT INTO `bharat_admin` (`id`, `username`, `first_name`, `last_name`, `password`, `is_active`) VALUES
(1, 'admin', 'Sumit', 'V', 'e10adc3949ba59abbe56e057f20f883e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bharat_attachment`
--

CREATE TABLE `bharat_attachment` (
  `id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_attachment`
--

INSERT INTO `bharat_attachment` (`id`, `path`, `type`, `created_date`) VALUES
(1, '/uploads/brand/c4ca4238a0b923820dcc509a6f75849b/6.jpg', 'image', '2019-10-14 17:50:16'),
(2, '/uploads/brand/c81e728d9d4c2f636f067f89cc14862c/8.jpg', 'image', '2019-10-14 17:50:59'),
(3, '/uploads/brand/eccbc87e4b5ce2fe28308fd9f2a7baf3/6.jpg', 'image', '2019-10-14 17:51:18'),
(4, '/uploads/brand/a87ff679a2f3e71d9181a67b7542122c/8.jpg', 'image', '2019-10-14 17:51:32'),
(5, '/uploads/brand/e4da3b7fbbce2345d7772b0674a318d5/7.jpg', 'image', '2019-10-14 17:51:48'),
(6, '/uploads/vehicle_photos/a87ff679a2f3e71d9181a67b7542122c/vehicle_photo/1575481078_7.jpg', 'image', '2019-12-04 17:43:15'),
(12, '/uploads/vehicle_photos/c81e728d9d4c2f636f067f89cc14862c/vehicle_photo/1576089204_2017-honda-accord_coupe-lx-s-vin1hgct1b34ha001662-768px-n01_550x310.jpg', 'image', '2019-12-11 18:33:30'),
(13, '/uploads/vehicle_photos/c81e728d9d4c2f636f067f89cc14862c/vehicle_photo/1576089208_31443713-hyundai_elite_i20_550x310.jpg', 'image', '2019-12-11 18:33:30'),
(14, '/uploads/vehicle_photos/a87ff679a2f3e71d9181a67b7542122c/vehicle_photo/1576089235_1552676931-8228_550x310.jpg', 'image', '2019-12-11 18:33:58'),
(15, '/uploads/vehicle_photos/eccbc87e4b5ce2fe28308fd9f2a7baf3/vehicle_photo/1576089252_c3eed710c1894ea0447b2d6148f0105e_550x310.png', 'image', '2019-12-11 18:34:14'),
(16, '/uploads/vehicle_photos/e4da3b7fbbce2345d7772b0674a318d5/vehicle_photo/1576089269_Honda_Civic_White_550x310.jpeg', 'image', '2019-12-11 18:34:34'),
(17, '/uploads/vehicle_photos/e4da3b7fbbce2345d7772b0674a318d5/vehicle_photo/1576089273_images_550x310.jpg', 'image', '2019-12-11 18:34:34'),
(18, '/uploads/vehicle_photos/8f14e45fceea167a5a36dedd4bea2543/vehicle_photo/1576089296_lucid-roundup-TA_550x310.jpg', 'image', '2019-12-11 18:34:58'),
(20, '/uploads/vehicle_photos/c4ca4238a0b923820dcc509a6f75849b/vehicle_photo/1576089346_pexels-photo-210019_550x310.jpeg', 'image', '2019-12-11 18:35:48'),
(21, '/uploads/vehicle_photos/1679091c5a880faf6fb5e6087eb1b2dc/vehicle_photo/1576089404_photo-1523676060187-f55189a71f5e_550x310.jpg', 'image', '2019-12-11 18:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `bharat_booking`
--

CREATE TABLE `bharat_booking` (
  `id` int(11) NOT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vehical_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `total_amount` double(9,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `check_sum_arr` text,
  `transaction_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_booking`
--

INSERT INTO `bharat_booking` (`id`, `reference_id`, `user_id`, `vehical_id`, `transaction_id`, `total_amount`, `status`, `token`, `check_sum_arr`, `transaction_date`, `created_date`, `modify_date`) VALUES
(1, 'SRT_1572977307', 1, 3, '1572977307', 500.00, 'Pending', '', '', '0000-00-00 00:00:00', '2019-11-05 13:08:27', '2019-11-05 18:08:27'),
(2, 'SRT_1572977649', 1, 3, '1572977649', 300.00, 'Pending', '', '', '0000-00-00 00:00:00', '2019-11-05 13:14:09', '2019-11-05 18:14:09'),
(3, 'SRT_1572978351', 1, 3, '1572978351', 200.00, 'Pending', '', '', '0000-00-00 00:00:00', '2019-11-05 13:25:51', '2019-11-05 18:25:51'),
(4, 'SRT_1572980433', 2, 7, '1572980433', 400.00, 'Pending', '', '', '0000-00-00 00:00:00', '2019-11-05 14:00:33', '2019-11-05 19:00:33'),
(5, 'SRT1573155163', 4, 1, '1573155163', 300.00, 'Pending', '', '', '0000-00-00 00:00:00', '2019-11-07 14:32:43', '2019-11-07 19:32:43'),
(6, 'SRT1573155498', 4, 1, '1573155498', 300.00, 'Pending', '', '', '0000-00-00 00:00:00', '2019-11-07 14:38:18', '2019-11-07 19:38:18'),
(7, 'SRT1573155607', 5, 1, '20191108111212800110168119200987759', 10.00, 'TXN_SUCCESS', '', 'qiAOewa+/d1F4wcZ8d428jTN9wUo1nL3DbLcausfkZ4KlEmFHoNqD5X7vKukA+GfSEbiBJjp8xzKXtNBNU54SvOnqAL7zkhnRqMlGQ0dq40=', '0000-00-00 00:00:00', '2019-11-07 14:40:07', '2019-11-07 19:40:07'),
(8, 'SRT_1573156193', 5, 1, '1573156193', 300.00, 'Pending', '', '', '0000-00-00 00:00:00', '2019-11-07 14:49:53', '2019-11-07 19:49:53'),
(9, 'SRT_1573576780', 6, 3, '20191112111212800110168135301003891', 5.00, 'TXN_SUCCESS', '', 'afoJLZiv8v6hTYKFw5RRYHbervRnRQQtyAjt4fYv7hV6rd4kkzPWuPobGdK6RFWVWsSlSTSIUPXiao1YP9ra38D8HXZt6n0VSF/zTIpjBlI=', '0000-00-00 00:00:00', '2019-11-12 11:39:40', '2019-11-12 16:39:40'),
(10, 'SRT_1574355979', 12, 2, '20191121111212800110168613301041106', 5.00, 'TXN_SUCCESS', '', 'MrE9kKxfsBOP9VPinnEA0m5XoQgHXlXkR+BxKJ1ylpvIlmI2utm56ey1lWH3jyzzqDnU2kF1xiemNVh+fXq4akwyi+ECd+mDQnm1C+NFXuY=', '0000-00-00 00:00:00', '2019-11-21 12:06:19', '2019-11-21 17:06:19'),
(11, 'SRT_1574356287', 13, 2, '1574356287', 300.00, 'Pending', '', '', '0000-00-00 00:00:00', '2019-11-21 12:11:27', '2019-11-21 17:11:27'),
(12, 'SRT_1574874612', 4, 1, '20191127111212800110168598601054484', 5.00, 'TXN_SUCCESS', '', '00JmYIGXYej2ukc7WlF9KwGqMvUbVfvGtBPuwM0VL4OoHX3s8fPEOwxulUbuLeeRkeCzQKNvhW8bTCXaEvHpWMp0gg3Oq9jsQVVyEmlVLsc=', '0000-00-00 00:00:00', '2019-11-27 12:10:12', '2019-11-27 17:10:12'),
(13, 'SRT_1574874879', 4, 5, '20191127111212800110168585001032578', 5.00, 'TXN_SUCCESS', '', 'wSBW1evWwYw9wAtKs27qwkxPUoBRb8WWDCYM2Jr0nS+OhcE1jyISU/Qn+wDwRxnWRRLE11AnD8/0h/PeWliwg/tJOl6jryJb8Rxm8ZtXtDs=', '0000-00-00 00:00:00', '2019-11-27 12:14:39', '2019-11-27 17:14:39'),
(14, 'SRT_1575184564', 14, 2, '1575184565', 5250.00, 'Pending', '', '', '0000-00-00 00:00:00', '2019-12-01 02:16:05', '2019-12-01 07:16:05'),
(15, 'SRT_1575199505', 15, 2, '20191201111212800110168560901062401', 5.00, 'TXN_SUCCESS', '', 'pAk06Xz+sXDaCvOgNpudVYjO/Bcy3V4aKw4dpHO0fjT6yjSdT8hJtgabaYE3wtLlqPGeoTSPqRWDvN0P9SaMcDQuIoiaO3n4HQRkO9ezVE8=', '0000-00-00 00:00:00', '2019-12-01 06:25:06', '2019-12-01 11:25:06'),
(16, 'SRT_1575201173', 16, 1, '20191201111212800110168559001053951', 5.00, 'TXN_SUCCESS', '', 'm5b7l0yXwXJ+rlFXLbJKqBJ0DDurPgmcuQcA8mZZGfeLVT0AkNNMVLe0FdVUec45kinN0a/QfA9JzVm5VqjN8CnV33mTirALrdi1boRXA14=', '0000-00-00 00:00:00', '2019-12-01 06:52:53', '2019-12-01 11:52:53'),
(17, 'SRT_1576089934', 17, 1, '1576089934', 3500.00, 'Pending', '', '', '0000-00-00 00:00:00', '2019-12-11 13:45:34', '2019-12-11 18:45:34'),
(18, 'SRT_1576257745', 18, 2, '20191213111212800110168532601097257', 5.00, 'TXN_SUCCESS', '', 'BwVywJCnGA5C0dcbNwCmD0fFriijc7z+0WdZ46yBTC7vthkjpjLgs4fzNN3JJ6cMAlMnM9vjPtIScfRs/0lJEy07WT2+4HGqokJFDjMvEa0=', '0000-00-00 00:00:00', '2019-12-13 12:22:26', '2019-12-13 17:22:26'),
(19, 'SRT_1576258610', 18, 1, '20191213111212800110168521401111945', 5.00, 'TXN_SUCCESS', '', '1i4rvQpNh7QMrsy3GdcYAfhBs/LotzPotxguJZ974AGz+HM7bns/lu2RZOx8GDlyFnettbRtsYQEnK4KRfEsLkWA3MOYH2ehyjPn9QgvE3g=', '0000-00-00 00:00:00', '2019-12-13 12:36:50', '2019-12-13 17:36:50'),
(20, 'SRT_1576262282', 19, 1, '1576262282', 7000.00, 'Pending', '', '', '0000-00-00 00:00:00', '2019-12-13 13:38:02', '2019-12-13 18:38:02'),
(21, 'SRT_1576262332', 19, 1, '1576262332', 10500.00, 'Pending', '', '', '0000-00-00 00:00:00', '2019-12-13 13:38:52', '2019-12-13 18:38:52'),
(22, 'SRT_1576262605', 19, 1, '20191214111212800110168289201096602', 5.00, 'TXN_SUCCESS', '', 'YoADM310BwsSDBkT9K+fMW0wdMUXD6xGaXNxixdvwE2iTzqV1JfueEwAvb6pN6jw7ka6Vv2w5xkXgfQr7dUhu7te+sxbDJRkA9PVYMnvdkY=', '0000-00-00 00:00:00', '2019-12-13 13:43:25', '2019-12-13 18:43:25'),
(23, 'SRT_1576262757', 19, 1, '20191214111212800110168270801099408', 5.00, 'TXN_SUCCESS', '', '1tHWshofKsbeudkUUZWg1q/8Zk2OVHeXO1CUL5yjYcmdkDx+80YgFoTcW9jR7EJk8644yqf9ZoCgTeL3uElkzeJTuXqg5/dQylfSGWNSHNc=', '0000-00-00 00:00:00', '2019-12-13 13:45:57', '2019-12-13 18:45:57'),
(24, 'SRT_1576262837', 19, 1, '20191214111212800110168263701100863', 5.00, 'TXN_SUCCESS', '', '5KakEm36nDH43Fu9tV0npLui2HbB64VXM3LyqPPXXL77E77pGC6Ck3AvOyQivvJ/9vqvbPe3P4SzPH561RSK07mbREBFkOx2N8Lx2zEyTS4=', '0000-00-00 00:00:00', '2019-12-13 13:47:17', '2019-12-13 18:47:17'),
(25, 'SRT_1577209889', 20, 2, '20191224111212800110168255901126563', 5.00, 'TXN_SUCCESS', NULL, 'MjkIrSIS+pXBIv9tYDICycwhigKkbI1X4YXh+hGq75zbEBdhDJ67nVrjXVpD9sMfksXJD6sW4aiuNtdk3uVTy/vBjpV9IttdqXy07khsguM=', NULL, '2019-12-24 12:51:29', '2019-12-24 17:51:29'),
(26, 'SRT_1577378642', 1, 1, '1577378642', 3500.00, 'Pending', NULL, NULL, NULL, '2019-12-26 11:44:02', '2019-12-26 16:44:02'),
(27, 'SRT_1577378813', 1, 2, '20191226111212800110168239001131212', 5.00, 'TXN_SUCCESS', NULL, 'yLKFkDWp1YBIpIgOtg1pw60cPxxthZLg7qTSw4JpQg56Fl3S3AtfSWfqPkaJwivdr71dz3AGzrC9a7ceKybu550JWk/jC8u1qKCoL0qtR/c=', NULL, '2019-12-26 11:46:53', '2019-12-26 16:46:53'),
(28, 'SRT_1577471973', 3, 1, '1577471974', 3500.00, 'Pending', NULL, NULL, NULL, '2019-12-27 13:39:34', '2019-12-27 18:39:34'),
(29, 'SRT_1577723443', 3, 2, '20191230111212800110168217701127757', 5.00, 'TXN_SUCCESS', NULL, 'vURqgJDUsiSr5LtwmcJMWV5mDmMMUi2zsDLOQ8aWPKF/FlGrz1ABCmOVxwpXAfPw6aVrGQl1UCFzzzeNhUbw7HCuCdT/kuSGcXUBWL3nxK0=', NULL, '2019-12-30 11:30:43', '2019-12-30 16:30:43'),
(30, 'SRT_1577726182', 3, 2, '1577726182', 5250.00, 'Pending', NULL, NULL, NULL, '2019-12-30 12:16:22', '2019-12-30 17:16:22'),
(31, 'SRT_1577736236', 3, 2, '20191231111212800110168983901143935', 5.00, 'TXN_SUCCESS', NULL, '+JTeoh7XMcwnTWpv+uLFymJ6Jk60s/VR1fGNGYX84F0NjpbwWoHBLChXgM3mYNFORQ3Rvd7pXZtXCU934cd1fP5a8jZYH18JyNipAj8AEjk=', NULL, '2019-12-30 15:03:56', '2019-12-30 20:03:56'),
(32, 'SRT_1577736652', 21, 1, '20191231111212800110168973101154229', 5.00, 'TXN_SUCCESS', NULL, 'IebNnGy0V+gSmyn8Xcq+E58DdBLXr3kwVxSMr3tVKSFzfTGZkk25HLL6+8xpJWS61c9u8ACsQfHLjJVnOf4LlDGQCRcwp1Uj7DMQrInPgYU=', NULL, '2019-12-30 15:10:52', '2019-12-30 20:10:52'),
(33, 'SRT_1577741719', 21, 2, '1577741719', 5250.00, 'Pending', NULL, NULL, NULL, '2019-12-30 16:35:19', '2019-12-30 21:35:19');

-- --------------------------------------------------------

--
-- Table structure for table `bharat_booking_detail`
--

CREATE TABLE `bharat_booking_detail` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `service_type` tinyint(1) DEFAULT NULL COMMENT '0 = one way, 1 out station',
  `trip_location` int(11) DEFAULT NULL,
  `drop_location` int(11) DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `pickup_time` time DEFAULT NULL,
  `drop_date` date DEFAULT NULL,
  `drop_time` time DEFAULT NULL,
  `trip_days` int(11) DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_booking_detail`
--

INSERT INTO `bharat_booking_detail` (`id`, `booking_id`, `service_type`, `trip_location`, `drop_location`, `pickup_date`, `pickup_time`, `drop_date`, `drop_time`, `trip_days`, `modify_date`) VALUES
(1, 1, 0, 263, 0, '2019-07-11', '12:00:00', '0000-00-00', '00:00:00', 0, '2019-11-05 18:08:27'),
(2, 2, 0, 263, 0, '2019-07-11', '23:00:00', '0000-00-00', '00:00:00', 0, '2019-11-05 18:14:09'),
(3, 3, 0, 263, 0, '2019-07-11', '04:00:00', '0000-00-00', '00:00:00', 0, '2019-11-05 18:25:51'),
(4, 4, 0, 285, 0, '1969-12-31', '07:00:00', '0000-00-00', '00:00:00', 0, '2019-11-05 19:00:33'),
(5, 5, 0, 268, 0, '2019-12-11', '17:30:00', '0000-00-00', '00:00:00', 0, '2019-11-07 19:32:44'),
(6, 6, 0, 268, 0, '1969-12-31', '18:30:00', '0000-00-00', '00:00:00', 0, '2019-11-07 19:38:18'),
(7, 7, 0, 272, 0, '1969-12-31', '05:30:00', '0000-00-00', '00:00:00', 0, '2019-11-07 19:40:07'),
(8, 8, 0, 263, 0, '1969-12-31', '07:00:00', '0000-00-00', '00:00:00', 0, '2019-11-07 19:49:53'),
(9, 9, 0, 285, 274, '1969-12-31', '00:00:00', '0000-00-00', '00:00:00', 0, '2019-11-12 16:39:40'),
(10, 10, 0, 285, 263, '1969-12-31', '12:00:00', '0000-00-00', '00:00:00', 0, '2019-11-21 17:06:19'),
(11, 11, 0, 285, 263, '1969-12-31', '00:00:00', '0000-00-00', '00:00:00', 0, '2019-11-21 17:11:27'),
(12, 12, 0, 285, 263, '1969-12-31', '12:00:00', '0000-00-00', '00:00:00', 0, '2019-11-27 17:10:13'),
(13, 13, 0, 263, 285, '1969-12-31', '12:00:00', '0000-00-00', '00:00:00', 0, '2019-11-27 17:14:39'),
(14, 14, 1, 285, 263, '2019-02-12', '02:00:00', '2019-04-12', '00:20:19', 0, '2019-12-01 07:16:05'),
(15, 15, 1, 285, 263, '2019-02-12', '02:00:00', '2019-06-12', '00:20:19', 0, '2019-12-01 11:25:06'),
(16, 16, 1, 285, 263, '2019-12-04', '02:00:00', '2019-12-10', '02:00:00', 0, '2019-12-01 11:52:53'),
(17, 17, 0, 285, 263, '2019-12-13', '01:00:00', '0000-00-00', '00:00:00', 0, '2019-12-11 18:45:34'),
(18, 18, 0, 285, 263, '2019-12-17', '16:00:00', '0000-00-00', '00:00:00', 0, '2019-12-13 17:22:26'),
(19, 19, 0, 285, 263, '2019-12-15', '02:00:00', '0000-00-00', '00:00:00', 0, '2019-12-13 17:36:51'),
(20, 20, 1, 285, 263, '2019-12-17', '02:00:00', '0000-00-00', '00:00:00', 2, '2019-12-13 18:38:02'),
(21, 21, 1, 285, 263, '2019-12-19', '02:00:00', '0000-00-00', '00:00:00', 3, '2019-12-13 18:38:52'),
(22, 22, 1, 285, 263, '2019-12-24', '02:00:00', '0000-00-00', '00:00:00', 2, '2019-12-13 18:43:25'),
(23, 23, 1, 285, 263, '2019-12-14', '00:00:00', '0000-00-00', '00:00:00', 2, '2019-12-13 18:45:57'),
(24, 24, 0, 269, 289, '2019-12-24', '02:00:00', '0000-00-00', '00:00:00', 0, '2019-12-13 18:47:17'),
(25, 25, 0, 285, 263, '2019-12-25', '00:00:00', NULL, NULL, NULL, '2019-12-24 17:51:29'),
(26, 26, 0, 285, 263, '2019-12-27', '12:00:00', NULL, NULL, NULL, '2019-12-26 16:44:02'),
(27, 27, 0, 285, 263, '2019-12-28', '12:00:00', NULL, NULL, NULL, '2019-12-26 16:46:53'),
(28, 28, 0, 285, 263, '2019-12-29', '18:00:00', NULL, NULL, NULL, '2019-12-27 18:39:34'),
(29, 29, NULL, 285, 263, '2019-12-30', '23:55:00', NULL, NULL, NULL, '2019-12-30 16:30:43'),
(30, 30, NULL, 285, 263, '1969-12-31', '00:00:00', NULL, NULL, NULL, '2019-12-30 17:16:22'),
(31, 31, NULL, 285, 263, '2019-12-31', '07:53:00', NULL, NULL, NULL, '2019-12-30 20:03:56'),
(32, 32, 1, 285, 263, '2019-12-31', '01:34:00', NULL, NULL, 4, '2019-12-30 20:10:52'),
(33, 33, NULL, 285, 263, '2019-12-31', '03:04:00', NULL, NULL, NULL, '2019-12-30 21:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `bharat_brands`
--

CREATE TABLE `bharat_brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `image` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_brands`
--

INSERT INTO `bharat_brands` (`id`, `brand_name`, `image`, `is_active`, `created_date`, `modify_date`) VALUES
(1, 'Maruti', 1, 1, '2019-10-14 13:47:39', '2019-10-14 17:50:37'),
(2, 'BMW', 2, 1, '2019-10-14 13:50:59', '2019-10-14 17:50:59'),
(3, 'Audi', 3, 1, '2019-10-14 13:51:18', '2019-10-14 17:51:18'),
(4, 'Nissan', 4, 1, '2019-10-14 13:51:32', '2019-10-14 17:51:32'),
(5, 'Toyota', 5, 1, '2019-10-14 13:51:48', '2019-10-14 17:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `bharat_category`
--

CREATE TABLE `bharat_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_category`
--

INSERT INTO `bharat_category` (`id`, `name`, `image`, `is_active`, `created_date`, `modify_date`) VALUES
(1, 'category 1', 1, 1, '2019-10-14 13:47:39', '2019-10-16 17:06:13'),
(2, 'category 2', 2, 1, '2019-10-14 13:50:59', '2019-10-16 17:06:19'),
(6, 'category 3', 0, 1, '2019-10-16 13:09:10', '2019-10-16 17:09:10'),
(7, 'sdfsdfdsf', 0, 1, '2019-11-12 13:50:32', '2019-11-12 18:50:32'),
(8, 'zxvzvcxv', 0, 0, '2019-11-12 13:53:57', '2019-11-13 17:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `bharat_cities`
--

CREATE TABLE `bharat_cities` (
  `id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `city_code` int(11) DEFAULT NULL,
  `state_code` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_cities`
--

INSERT INTO `bharat_cities` (`id`, `city_name`, `city_code`, `state_code`, `status`) VALUES
(1, 'Alipur', 101, 1, 0),
(2, 'Andaman Island', 102, 1, 0),
(3, 'Anderson Island', 103, 1, 0),
(4, 'Arainj-Laka-Punga', 104, 1, 0),
(5, 'Austinabad', 105, 1, 0),
(6, 'Bamboo Flat', 106, 1, 0),
(7, 'Barren Island', 107, 1, 0),
(8, 'Beadonabad', 108, 1, 0),
(9, 'Betapur', 109, 1, 0),
(10, 'Bindraban', 110, 1, 0),
(11, 'Bonington', 111, 1, 0),
(12, 'Brookesabad', 112, 1, 0),
(13, 'Cadell Point', 113, 1, 0),
(14, 'Calicut', 114, 1, 0),
(15, 'Chetamale', 115, 1, 0),
(16, 'Cinque Islands', 116, 1, 0),
(17, 'Defence Island', 117, 1, 0),
(18, 'Digilpur', 118, 1, 0),
(19, 'Dolyganj', 119, 1, 0),
(20, 'Flat Island', 120, 1, 0),
(21, 'Geinyale', 121, 1, 0),
(22, 'Great Coco Island', 122, 1, 0),
(23, 'Haddo', 123, 1, 0),
(24, 'Havelock Island', 124, 1, 0),
(25, 'Henry Lawrence Island', 125, 1, 0),
(26, 'Herbertabad', 126, 1, 0),
(27, 'Hobdaypur', 127, 1, 0),
(28, 'Ilichar', 128, 1, 0),
(29, 'Ingoie', 128, 1, 0),
(30, 'Inteview Island', 130, 1, 0),
(31, 'Jangli Ghat', 131, 1, 0),
(32, 'Jhon Lawrence Island', 132, 1, 0),
(33, 'Karen', 133, 1, 0),
(34, 'Kartara', 134, 1, 0),
(35, 'KYD Islannd', 135, 1, 0),
(36, 'Landfall Island', 136, 1, 0),
(37, 'Little Andmand', 137, 1, 0),
(38, 'Little Coco Island', 138, 1, 0),
(39, 'Long Island', 138, 1, 0),
(40, 'Maimyo', 140, 1, 0),
(41, 'Malappuram', 141, 1, 0),
(42, 'Manglutan', 142, 1, 0),
(43, 'Manpur', 143, 1, 0),
(44, 'Mitha Khari', 144, 1, 0),
(45, 'Neill Island', 145, 1, 0),
(46, 'Nicobar Island', 146, 1, 0),
(47, 'North Brother Island', 147, 1, 0),
(48, 'North Passage Island', 148, 1, 0),
(49, 'North Sentinel Island', 149, 1, 0),
(50, 'Nothen Reef Island', 150, 1, 0),
(51, 'Outram Island', 151, 1, 0),
(52, 'Pahlagaon', 152, 1, 0),
(53, 'Palalankwe', 153, 1, 0),
(54, 'Passage Island', 154, 1, 0),
(55, 'Phaiapong', 155, 1, 0),
(56, 'Phoenix Island', 156, 1, 0),
(57, 'Port Blair', 157, 1, 0),
(58, 'Preparis Island', 158, 1, 0),
(59, 'Protheroepur', 159, 1, 0),
(60, 'Rangachang', 160, 1, 0),
(61, 'Rongat', 161, 1, 0),
(62, 'Rutland Island', 162, 1, 0),
(63, 'Sabari', 163, 1, 0),
(64, 'Saddle Peak', 164, 1, 0),
(65, 'Shadipur', 165, 1, 0),
(66, 'Smith Island', 166, 1, 0),
(67, 'Sound Island', 167, 1, 0),
(68, 'South Sentinel Island', 168, 1, 0),
(69, 'Spike Island', 169, 1, 0),
(70, 'Tarmugli Island', 170, 1, 0),
(71, 'Taylerabad', 171, 1, 0),
(72, 'Titaije', 172, 1, 0),
(73, 'Toibalawe', 173, 1, 0),
(74, 'Tusonabad', 174, 1, 0),
(75, 'West Island', 175, 1, 0),
(76, 'Wimberleyganj', 176, 1, 0),
(77, 'Yadita', 177, 1, 0),
(78, 'Adilabad', 201, 2, 0),
(79, 'Anantapur', 201, 2, 0),
(80, 'Chittoor', 203, 2, 0),
(81, 'Cuddapah', 204, 2, 0),
(82, 'East Godavari', 205, 2, 0),
(83, 'Guntur', 206, 2, 0),
(84, 'Hyderabad', 207, 2, 0),
(85, 'Karimnagar', 208, 2, 0),
(86, 'Khammam', 209, 2, 0),
(87, 'Krishna', 210, 2, 0),
(88, 'Kurnool', 211, 2, 0),
(89, 'Mahabubnagar', 212, 2, 0),
(90, 'Medak', 213, 2, 0),
(91, 'Nalgonda', 214, 2, 0),
(92, 'Nellore', 215, 2, 0),
(93, 'Nizamabad', 216, 2, 0),
(94, 'Prakasam', 217, 2, 0),
(95, 'Rangareddy', 218, 2, 0),
(96, 'Srikakulam', 219, 2, 0),
(97, 'Visakhapatnam', 220, 2, 0),
(98, 'Vizianagaram', 221, 2, 0),
(99, 'Warangal', 222, 2, 0),
(100, 'West Godavari', 223, 2, 0),
(101, 'Anjaw', 301, 3, 0),
(102, 'Changlang', 302, 3, 0),
(103, 'Dibang Valley', 303, 3, 0),
(104, 'East Kameng', 304, 3, 0),
(105, 'East Siang', 305, 3, 0),
(106, 'Itanagar', 306, 3, 0),
(107, 'Kurung Kumey', 307, 3, 0),
(108, 'Lohit', 308, 3, 0),
(109, 'Lower Dibang Valley', 309, 3, 0),
(110, 'Lower Subansiri', 310, 3, 0),
(111, 'Papum Pare', 311, 3, 0),
(112, 'Tawang', 312, 3, 0),
(113, 'Tirap', 313, 3, 0),
(114, 'Upper Siang', 314, 3, 0),
(115, 'Upper Subansiri', 315, 3, 0),
(116, 'West Kameng', 316, 3, 0),
(117, 'West Siang', 317, 3, 0),
(118, 'Barpeta', 401, 4, 0),
(119, 'Bongaigaon', 402, 4, 0),
(120, 'Cachar', 403, 4, 0),
(121, 'Darrang', 404, 4, 0),
(122, 'Dhemaji', 405, 4, 0),
(123, 'Dhubri', 406, 4, 0),
(124, 'Dibrugarh', 407, 4, 0),
(125, 'Goalpara', 408, 4, 0),
(126, 'Golaghat', 409, 4, 0),
(127, 'Guwahati', 410, 4, 0),
(128, 'Hailakandi', 411, 4, 0),
(129, 'Jorhat', 412, 4, 0),
(130, 'Kamrup', 413, 4, 0),
(131, 'Karbi Anglong', 414, 4, 0),
(132, 'Karimganj', 415, 4, 0),
(133, 'Kokrajhar', 416, 4, 0),
(134, 'Lakhimpur', 417, 4, 0),
(135, 'Marigaon', 418, 4, 0),
(136, 'Nagaon', 419, 4, 0),
(137, 'Nalbari', 420, 4, 0),
(138, 'North Cachar Hills', 421, 4, 0),
(139, 'Silchar', 422, 4, 0),
(140, 'Sivasagar', 423, 4, 0),
(141, 'Sonitpur', 424, 4, 0),
(142, 'Tinsukia', 425, 4, 0),
(143, 'Udalguri', 426, 4, 0),
(144, 'Araria', 501, 5, 0),
(145, 'Aurangabad', 502, 5, 0),
(146, 'Banka', 503, 5, 0),
(147, 'Begusarai', 504, 5, 0),
(148, 'Bhagalpur', 505, 5, 0),
(149, 'Bhojpur', 506, 5, 0),
(150, 'Buxar', 507, 5, 0),
(151, 'Darbhanga', 508, 5, 0),
(152, 'East Champaran', 509, 5, 0),
(153, 'Gaya', 510, 5, 0),
(154, 'Gopalganj', 511, 5, 0),
(155, 'Jamshedpur', 512, 5, 0),
(156, 'Jamui', 513, 5, 0),
(157, 'Jehanabad', 514, 5, 0),
(158, 'Kaimur (Bhabua)', 515, 5, 0),
(159, 'Katihar', 516, 5, 0),
(160, 'Khagaria', 517, 5, 0),
(161, 'Kishanganj', 518, 5, 0),
(162, 'Lakhisarai', 519, 5, 0),
(163, 'Madhepura', 520, 5, 0),
(164, 'Madhubani', 521, 5, 0),
(165, 'Munger', 522, 5, 0),
(166, 'Muzaffarpur', 523, 5, 0),
(167, 'Nalanda', 524, 5, 0),
(168, 'Nawada', 525, 5, 0),
(169, 'Patna', 526, 5, 0),
(170, 'Purnia', 527, 5, 0),
(171, 'Rohtas', 528, 5, 0),
(172, 'Saharsa', 529, 5, 0),
(173, 'Samastipur', 530, 5, 0),
(174, 'Saran', 531, 5, 0),
(175, 'Sheikhpura', 532, 5, 0),
(176, 'Sheohar', 533, 5, 0),
(177, 'Sitamarhi', 534, 5, 0),
(178, 'Siwan', 535, 5, 0),
(179, 'Supaul', 536, 5, 0),
(180, 'Vaishali', 537, 5, 0),
(181, 'West Champaran', 538, 5, 0),
(182, 'Chandigarh', 601, 6, 0),
(183, 'Mani Marja', 602, 6, 0),
(184, 'Bastar', 701, 7, 0),
(185, 'Bhilai', 702, 7, 0),
(186, 'Bijapur', 703, 7, 0),
(187, 'Bilaspur', 704, 7, 0),
(188, 'Dhamtari', 705, 7, 0),
(189, 'Durg', 706, 7, 0),
(190, 'Janjgir-Champa', 707, 7, 0),
(191, 'Jashpur', 708, 7, 0),
(192, 'Kabirdham-Kawardha', 709, 7, 0),
(193, 'Korba', 710, 7, 0),
(194, 'Korea', 711, 7, 0),
(195, 'Mahasamund', 712, 7, 0),
(196, 'Narayanpur', 713, 7, 0),
(197, 'Norh Bastar-Kanker', 714, 7, 0),
(198, 'Raigarh', 715, 7, 0),
(199, 'Raipur', 716, 7, 0),
(200, 'Rajnandgaon', 717, 7, 0),
(201, 'South Bastar-Dantewada', 718, 7, 0),
(202, 'Surguja', 719, 7, 0),
(203, 'Amal', 801, 8, 0),
(204, 'Amli', 802, 8, 0),
(205, 'Bedpa', 803, 8, 0),
(206, 'Chikhli', 804, 8, 0),
(207, 'Dadra & Nagar Haveli', 805, 8, 0),
(208, 'Dahikhed', 806, 8, 0),
(209, 'Dolara', 807, 8, 0),
(210, 'Galonda', 808, 8, 0),
(211, 'Kanadi', 809, 8, 0),
(212, 'Karchond', 810, 8, 0),
(213, 'Khadoli', 811, 8, 0),
(214, 'Kharadpada', 812, 8, 0),
(215, 'Kherabari', 813, 8, 0),
(216, 'Kherdi', 814, 8, 0),
(217, 'Kothar', 815, 8, 0),
(218, 'Luari', 816, 8, 0),
(219, 'Mashat', 817, 8, 0),
(220, 'Rakholi', 818, 8, 0),
(221, 'Rudana', 819, 8, 0),
(222, 'Saili', 820, 8, 0),
(223, 'Sili', 821, 8, 0),
(224, 'Silvassa', 822, 8, 0),
(225, 'Sindavni', 823, 8, 0),
(226, 'Udva', 824, 8, 0),
(227, 'Umbarkoi', 825, 8, 0),
(228, 'Vansda', 826, 8, 0),
(229, 'Vasona', 827, 8, 0),
(230, 'Velugam', 828, 8, 0),
(231, 'Brancavare', 901, 9, 0),
(232, 'Dagasi', 902, 9, 0),
(233, 'Daman', 903, 9, 0),
(234, 'Diu', 904, 9, 0),
(235, 'Magarvara', 905, 9, 0),
(236, 'Nagwa', 906, 9, 0),
(237, 'Pariali', 907, 9, 0),
(238, 'Passo Covo', 908, 9, 0),
(239, 'Central Delhi', 1001, 10, 0),
(240, 'East Delhi', 1002, 10, 0),
(241, 'New Delhi', 1003, 10, 0),
(242, 'North Delhi', 1004, 10, 0),
(243, 'North East Delhi', 1005, 10, 0),
(244, 'North West Delhi', 1006, 10, 0),
(245, 'Old Delhi', 1007, 10, 0),
(246, 'South Delhi', 1008, 10, 0),
(247, 'South West Delhi', 1009, 10, 0),
(248, 'West Delhi', 1010, 10, 0),
(249, 'Canacona', 1101, 11, 0),
(250, 'Candolim', 1102, 11, 0),
(251, 'Chinchinim', 1103, 11, 0),
(252, 'Cortalim', 1104, 11, 0),
(253, 'Goa', 1105, 11, 0),
(254, 'Jua', 1106, 11, 0),
(255, 'Madgaon', 1107, 11, 0),
(256, 'Mahem', 1108, 11, 0),
(257, 'Mapuca', 1109, 11, 0),
(258, 'Marmagao', 1110, 11, 0),
(259, 'Panji', 1111, 11, 0),
(260, 'Ponda', 1112, 11, 0),
(261, 'Sanvordem', 1113, 11, 0),
(262, 'Terekhol', 1114, 11, 0),
(263, 'Ahmedabad', 1201, 12, 1),
(264, 'Amreli', 1202, 12, 1),
(265, 'Anand', 1203, 12, 1),
(266, 'Banaskantha', 1204, 12, 1),
(267, 'Baroda', 1205, 12, 1),
(268, 'Bharuch', 1206, 12, 1),
(269, 'Bhavnagar', 1207, 12, 1),
(270, 'Dahod', 1208, 12, 1),
(271, 'Dang', 1209, 12, 1),
(272, 'Dwarka', 1210, 12, 1),
(273, 'Gandhinagar', 1211, 12, 1),
(274, 'Jamnagar', 1212, 12, 1),
(275, 'Junagadh', 1213, 12, 1),
(276, 'Kheda', 1214, 12, 1),
(277, 'Kutch', 1215, 12, 1),
(278, 'Mehsana', 1216, 12, 1),
(279, 'Nadiad', 1217, 12, 1),
(280, 'Narmada', 1218, 12, 1),
(281, 'Navsari', 1219, 12, 1),
(282, 'Panchmahals', 1220, 12, 1),
(283, 'Patan', 1221, 12, 1),
(284, 'Porbandar', 1222, 12, 1),
(285, 'Rajkot', 1223, 12, 1),
(286, 'Sabarkantha', 1224, 12, 1),
(287, 'Surat', 1225, 12, 1),
(288, 'Surendranagar', 1226, 12, 1),
(289, 'Vadodara', 1227, 12, 1),
(290, 'Valsad', 1228, 12, 1),
(291, 'Vapi', 1229, 12, 1),
(292, 'Ambala', 1301, 13, 0),
(293, 'Bhiwani', 1302, 13, 0),
(294, 'Faridabad', 1303, 13, 0),
(295, 'Fatehabad', 1304, 13, 0),
(296, 'Gurgaon', 1305, 13, 0),
(297, 'Hisar', 1306, 13, 0),
(298, 'Jhajjar', 1307, 13, 0),
(299, 'Jind', 1308, 13, 0),
(300, 'Kaithal', 1309, 13, 0),
(301, 'Karnal', 1310, 13, 0),
(302, 'Kurukshetra', 1311, 13, 0),
(303, 'Mahendragarh', 1312, 13, 0),
(304, 'Mewat', 1313, 13, 0),
(305, 'Panchkula', 1314, 13, 0),
(306, 'Panipat', 1315, 13, 0),
(307, 'Rewari', 1316, 13, 0),
(308, 'Rohtak', 1317, 13, 0),
(309, 'Sirsa', 1318, 13, 0),
(310, 'Sonipat', 1319, 13, 0),
(311, 'Yamunanagar', 1320, 13, 0),
(312, 'Bilaspur', 1401, 14, 0),
(313, 'Chamba', 1402, 14, 0),
(314, 'Dalhousie', 1403, 14, 0),
(315, 'Hamirpur', 1404, 14, 0),
(316, 'Kangra', 1405, 14, 0),
(317, 'Kinnaur', 1406, 14, 0),
(318, 'Kullu', 1407, 14, 0),
(319, 'Lahaul & Spiti', 1408, 14, 0),
(320, 'Mandi', 1409, 14, 0),
(321, 'Shimla', 1410, 14, 0),
(322, 'Sirmaur', 1411, 14, 0),
(323, 'Solan', 1412, 14, 0),
(324, 'Una', 1413, 14, 0),
(325, 'Anantnag', 1501, 15, 0),
(326, 'Baramulla', 1502, 15, 0),
(327, 'Budgam', 1503, 15, 0),
(328, 'Doda', 1504, 15, 0),
(329, 'Jammu', 1505, 15, 0),
(330, 'Kargil', 1506, 15, 0),
(331, 'Kathua', 1507, 15, 0),
(332, 'Kupwara', 1508, 15, 0),
(333, 'Leh', 1509, 15, 0),
(334, 'Poonch', 1510, 15, 0),
(335, 'Pulwama', 1511, 15, 0),
(336, 'Rajauri', 1512, 15, 0),
(337, 'Srinagar', 1513, 15, 0),
(338, 'Udhampur', 1514, 15, 0),
(339, 'Bokaro', 1601, 16, 0),
(340, 'Chatra', 1602, 16, 0),
(341, 'Deoghar', 1603, 16, 0),
(342, 'Dhanbad', 1604, 16, 0),
(343, 'Dumka', 1605, 16, 0),
(344, 'East Singhbhum', 1606, 16, 0),
(345, 'Garhwa', 1607, 16, 0),
(346, 'Giridih', 1608, 16, 0),
(347, 'Godda', 1609, 16, 0),
(348, 'Gumla', 1610, 16, 0),
(349, 'Hazaribag', 1611, 16, 0),
(350, 'Jamtara', 1612, 16, 0),
(351, 'Koderma', 1613, 16, 0),
(352, 'Latehar', 1614, 16, 0),
(353, 'Lohardaga', 1615, 16, 0),
(354, 'Pakur', 1616, 16, 0),
(355, 'Palamu', 1617, 16, 0),
(356, 'Ranchi', 1618, 16, 0),
(357, 'Sahibganj', 1619, 16, 0),
(358, 'Seraikela', 1620, 16, 0),
(359, 'Simdega', 1621, 16, 0),
(360, 'West Singhbhum', 1622, 16, 0),
(361, 'Bagalkot', 1701, 17, 0),
(362, 'Bangalore', 1702, 17, 0),
(363, 'Bangalore Rural', 1703, 17, 0),
(364, 'Belgaum', 1704, 17, 0),
(365, 'Bellary', 1705, 17, 0),
(366, 'Bhatkal', 1706, 17, 0),
(367, 'Bidar', 1707, 17, 0),
(368, 'Bijapur', 1708, 17, 0),
(369, 'Chamrajnagar', 1709, 17, 0),
(370, 'Chickmagalur', 1710, 17, 0),
(371, 'Chikballapur', 1711, 17, 0),
(372, 'Chitradurga', 1712, 17, 0),
(373, 'Dakshina Kannada', 1713, 17, 0),
(374, 'Davanagere', 1714, 17, 0),
(375, 'Dharwad', 1715, 17, 0),
(376, 'Gadag', 1716, 17, 0),
(377, 'Gulbarga', 1717, 17, 0),
(378, 'Hampi', 1718, 17, 0),
(379, 'Hassan', 1719, 17, 0),
(380, 'Haveri', 1720, 17, 0),
(381, 'Hospet', 1721, 17, 0),
(382, 'Karwar', 1722, 17, 0),
(383, 'Kodagu', 1723, 17, 0),
(384, 'Kolar', 1724, 17, 0),
(385, 'Koppal', 1725, 17, 0),
(386, 'Madikeri', 1726, 17, 0),
(387, 'Mandya', 1727, 17, 0),
(388, 'Mangalore', 1728, 17, 0),
(389, 'Manipal', 1729, 17, 0),
(390, 'Mysore', 1730, 17, 0),
(391, 'Raichur', 1731, 17, 0),
(392, 'Shimoga', 1732, 17, 0),
(393, 'Sirsi', 1733, 17, 0),
(394, 'Sringeri', 1734, 17, 0),
(395, 'Srirangapatna', 1735, 17, 0),
(396, 'Tumkur', 1736, 17, 0),
(397, 'Udupi', 1737, 17, 0),
(398, 'Uttara Kannada', 1738, 17, 0),
(399, 'Alappuzha', 1801, 18, 0),
(400, 'Alleppey', 1802, 18, 0),
(401, 'Alwaye', 1803, 18, 0),
(402, 'Ernakulam', 1804, 18, 0),
(403, 'Idukki', 1805, 18, 0),
(404, 'Kannur', 1806, 18, 0),
(405, 'Kasargod', 1807, 18, 0),
(406, 'Kochi', 1808, 18, 0),
(407, 'Kollam', 1809, 18, 0),
(408, 'Kottayam', 1810, 18, 0),
(409, 'Kovalam', 1811, 18, 0),
(410, 'Kozhikode', 1812, 18, 0),
(411, 'Malappuram', 1813, 18, 0),
(412, 'Palakkad', 1814, 18, 0),
(413, 'Pathanamthitta', 1815, 18, 0),
(414, 'Perumbavoor', 1816, 18, 0),
(415, 'Thiruvananthapuram', 1817, 18, 0),
(416, 'Thrissur', 1818, 18, 0),
(417, 'Trichur', 1819, 18, 0),
(418, 'Trivandrum', 1820, 18, 0),
(419, 'Wayanad', 1821, 18, 0),
(420, 'Agatti Island', 1901, 19, 0),
(421, 'Bingaram Island', 1902, 19, 0),
(422, 'Bitra Island', 1903, 19, 0),
(423, 'Chetlat Island', 1904, 19, 0),
(424, 'Kadmat Island', 1905, 19, 0),
(425, 'Kalpeni Island', 1906, 19, 0),
(426, 'Kavaratti Island', 1907, 19, 0),
(427, 'Kiltan Island', 1908, 19, 0),
(428, 'Lakshadweep Sea', 1909, 19, 0),
(429, 'Minicoy Island', 1910, 19, 0),
(430, 'North Island', 1911, 19, 0),
(431, 'South Island', 1912, 19, 0),
(432, 'Anuppur', 2001, 20, 0),
(433, 'Ashoknagar', 2002, 20, 0),
(434, 'Balaghat', 2003, 20, 0),
(435, 'Barwani', 2004, 20, 0),
(436, 'Betul', 2005, 20, 0),
(437, 'Bhind', 2006, 20, 0),
(438, 'Bhopal', 2007, 20, 0),
(439, 'Burhanpur', 2008, 20, 0),
(440, 'Chhatarpur', 2009, 20, 0),
(441, 'Chhindwara', 2010, 20, 0),
(442, 'Damoh', 2011, 20, 0),
(443, 'Datia', 2012, 20, 0),
(444, 'Dewas', 2013, 20, 0),
(445, 'Dhar', 2014, 20, 0),
(446, 'Dindori', 2015, 20, 0),
(447, 'Guna', 2016, 20, 0),
(448, 'Gwalior', 2017, 20, 0),
(449, 'Harda', 2018, 20, 0),
(450, 'Hoshangabad', 2019, 20, 0),
(451, 'Indore', 2020, 20, 0),
(452, 'Jabalpur', 2021, 20, 0),
(453, 'Jagdalpur', 2022, 20, 0),
(454, 'Jhabua', 2023, 20, 0),
(455, 'Katni', 2024, 20, 0),
(456, 'Khandwa', 2025, 20, 0),
(457, 'Khargone', 2026, 20, 0),
(458, 'Mandla', 2027, 20, 0),
(459, 'Mandsaur', 2028, 20, 0),
(460, 'Morena', 2029, 20, 0),
(461, 'Narsinghpur', 2030, 20, 0),
(462, 'Neemuch', 2031, 20, 0),
(463, 'Panna', 2032, 20, 0),
(464, 'Raisen', 2033, 20, 0),
(465, 'Rajgarh', 2034, 20, 0),
(466, 'Ratlam', 2035, 20, 0),
(467, 'Rewa', 2036, 20, 0),
(468, 'Sagar', 2037, 20, 0),
(469, 'Satna', 2038, 20, 0),
(470, 'Sehore', 2039, 20, 0),
(471, 'Seoni', 2040, 20, 0),
(472, 'Shahdol', 2041, 20, 0),
(473, 'Shajapur', 2042, 20, 0),
(474, 'Sheopur', 2043, 20, 0),
(475, 'Shivpuri', 2044, 20, 0),
(476, 'Sidhi', 2045, 20, 0),
(477, 'Tikamgarh', 2046, 20, 0),
(478, 'Ujjain', 2047, 20, 0),
(479, 'Umaria', 2048, 20, 0),
(480, 'Vidisha', 2049, 20, 0),
(481, 'Ahmednagar', 2101, 21, 0),
(482, 'Akola', 2102, 21, 0),
(483, 'Amravati', 2103, 21, 0),
(484, 'Aurangabad', 2104, 21, 0),
(485, 'Beed', 2105, 21, 0),
(486, 'Bhandara', 2106, 21, 0),
(487, 'Buldhana', 2107, 21, 0),
(488, 'Chandrapur', 2108, 21, 0),
(489, 'Dhule', 2109, 21, 0),
(490, 'Gadchiroli', 2110, 21, 0),
(491, 'Gondia', 2111, 21, 0),
(492, 'Hingoli', 2112, 21, 0),
(493, 'Jalgaon', 2113, 21, 0),
(494, 'Jalna', 2114, 21, 0),
(495, 'Kolhapur', 2115, 21, 0),
(496, 'Latur', 2116, 21, 0),
(497, 'Mahabaleshwar', 2117, 21, 0),
(498, 'Mumbai', 2118, 21, 0),
(499, 'Mumbai City', 2119, 21, 0),
(500, 'Mumbai Suburban', 2120, 21, 0),
(501, 'Nagpur', 2121, 21, 0),
(502, 'Nanded', 2122, 21, 0),
(503, 'Nandurbar', 2123, 21, 0),
(504, 'Nashik', 2124, 21, 0),
(505, 'Osmanabad', 2125, 21, 0),
(506, 'Parbhani', 2126, 21, 0),
(507, 'Pune', 2127, 21, 0),
(508, 'Raigad', 2128, 21, 0),
(509, 'Ratnagiri', 2129, 21, 0),
(510, 'Sangli', 2130, 21, 0),
(511, 'Satara', 2131, 21, 0),
(512, 'Sholapur', 2132, 21, 0),
(513, 'Sindhudurg', 2133, 21, 0),
(514, 'Thane', 2134, 21, 0),
(515, 'Wardha', 2135, 21, 0),
(516, 'Washim', 2136, 21, 0),
(517, 'Yavatmal', 2137, 21, 0),
(518, 'Bishnupur', 2201, 22, 0),
(519, 'Chandel', 2202, 22, 0),
(520, 'Churachandpur', 2203, 22, 0),
(521, 'Imphal East', 2204, 22, 0),
(522, 'Imphal West', 2205, 22, 0),
(523, 'Senapati', 2206, 22, 0),
(524, 'Tamenglong', 2207, 22, 0),
(525, 'Thoubal', 2208, 22, 0),
(526, 'Ukhrul', 2209, 22, 0),
(527, 'East Garo Hills', 2301, 23, 0),
(528, 'East Khasi Hills', 2302, 23, 0),
(529, 'Jaintia Hills', 2303, 23, 0),
(530, 'Ri Bhoi', 2304, 23, 0),
(531, 'Shillong', 2305, 23, 0),
(532, 'South Garo Hills', 2306, 23, 0),
(533, 'West Garo Hills', 2307, 23, 0),
(534, 'West Khasi Hills', 2308, 23, 0),
(535, 'Aizawl', 2401, 24, 0),
(536, 'Champhai', 2402, 24, 0),
(537, 'Kolasib', 2403, 24, 0),
(538, 'Lawngtlai', 2404, 24, 0),
(539, 'Lunglei', 2405, 24, 0),
(540, 'Mamit', 2406, 24, 0),
(541, 'Saiha', 2407, 24, 0),
(542, 'Serchhip', 2408, 24, 0),
(543, 'Dimapur', 2501, 25, 0),
(544, 'Kohima', 2502, 25, 0),
(545, 'Mokokchung', 2503, 25, 0),
(546, 'Mon', 2504, 25, 0),
(547, 'Phek', 2505, 25, 0),
(548, 'Tuensang', 2506, 25, 0),
(549, 'Wokha', 2507, 25, 0),
(550, 'Zunheboto', 2508, 25, 0),
(551, 'Angul', 2601, 26, 0),
(552, 'Balangir', 2602, 26, 0),
(553, 'Balasore', 2603, 26, 0),
(554, 'Baleswar', 2604, 26, 0),
(555, 'Bargarh', 2605, 26, 0),
(556, 'Berhampur', 2606, 26, 0),
(557, 'Bhadrak', 2607, 26, 0),
(558, 'Bhubaneswar', 2608, 26, 0),
(559, 'Boudh', 2609, 26, 0),
(560, 'Cuttack', 2610, 26, 0),
(561, 'Deogarh', 2611, 26, 0),
(562, 'Dhenkanal', 2612, 26, 0),
(563, 'Gajapati', 2613, 26, 0),
(564, 'Ganjam', 2614, 26, 0),
(565, 'Jagatsinghapur', 2615, 26, 0),
(566, 'Jajpur', 2616, 26, 0),
(567, 'Jharsuguda', 2617, 26, 0),
(568, 'Kalahandi', 2618, 26, 0),
(569, 'Kandhamal', 2619, 26, 0),
(570, 'Kendrapara', 2620, 26, 0),
(571, 'Kendujhar', 2621, 26, 0),
(572, 'Khordha', 2622, 26, 0),
(573, 'Koraput', 2623, 26, 0),
(574, 'Malkangiri', 2624, 26, 0),
(575, 'Mayurbhanj', 2625, 26, 0),
(576, 'Nabarangapur', 2626, 26, 0),
(577, 'Nayagarh', 2627, 26, 0),
(578, 'Nuapada', 2628, 26, 0),
(579, 'Puri', 2629, 26, 0),
(580, 'Rayagada', 2630, 26, 0),
(581, 'Rourkela', 2631, 26, 0),
(582, 'Sambalpur', 2632, 26, 0),
(583, 'Subarnapur', 2633, 26, 0),
(584, 'Sundergarh', 2634, 26, 0),
(585, 'Bahur', 2701, 27, 0),
(586, 'Karaikal', 2701, 27, 0),
(587, 'Mahe', 2701, 27, 0),
(588, 'Pondicherry', 2701, 27, 0),
(589, 'Purnankuppam', 2701, 27, 0),
(590, 'Valudavur', 2701, 27, 0),
(591, 'Villianur', 2701, 27, 0),
(592, 'Yanam', 2701, 27, 0),
(593, 'Amritsar', 2801, 28, 0),
(594, 'Barnala', 2801, 28, 0),
(595, 'Bathinda', 2801, 28, 0),
(596, 'Faridkot', 2801, 28, 0),
(597, 'Fatehgarh Sahib', 2801, 28, 0),
(598, 'Ferozepur', 2801, 28, 0),
(599, 'Gurdaspur', 2801, 28, 0),
(600, 'Hoshiarpur', 2801, 28, 0),
(601, 'Jalandhar', 2801, 28, 0),
(602, 'Kapurthala', 2801, 28, 0),
(603, 'Ludhiana', 2801, 28, 0),
(604, 'Mansa', 2801, 28, 0),
(605, 'Moga', 2801, 28, 0),
(606, 'Muktsar', 2801, 28, 0),
(607, 'Nawanshahr', 2801, 28, 0),
(608, 'Pathankot', 2801, 28, 0),
(609, 'Patiala', 2801, 28, 0),
(610, 'Rupnagar', 2801, 28, 0),
(611, 'Sangrur', 2801, 28, 0),
(612, 'SAS Nagar', 2801, 28, 0),
(613, 'Tarn Taran', 2801, 28, 0),
(614, 'Ajmer', 2901, 29, 0),
(615, 'Alwar', 2902, 29, 0),
(616, 'Banswara', 2903, 29, 0),
(617, 'Baran', 2904, 29, 0),
(618, 'Barmer', 2905, 29, 0),
(619, 'Bharatpur', 2906, 29, 0),
(620, 'Bhilwara', 2907, 29, 0),
(621, 'Bikaner', 2908, 29, 0),
(622, 'Bundi', 2909, 29, 0),
(623, 'Chittorgarh', 2910, 29, 0),
(624, 'Churu', 2911, 29, 0),
(625, 'Dausa', 2912, 29, 0),
(626, 'Dholpur', 2913, 29, 0),
(627, 'Dungarpur', 2914, 29, 0),
(628, 'Hanumangarh', 2915, 29, 0),
(629, 'Jaipur', 2916, 29, 0),
(630, 'Jaisalmer', 2917, 29, 0),
(631, 'Jalore', 2918, 29, 0),
(632, 'Jhalawar', 2919, 29, 0),
(633, 'Jhunjhunu', 2920, 29, 0),
(634, 'Jodhpur', 2921, 29, 0),
(635, 'Karauli', 2922, 29, 0),
(636, 'Kota', 2923, 29, 0),
(637, 'Nagaur', 2924, 29, 0),
(638, 'Pali', 2925, 29, 0),
(639, 'Pilani', 2926, 29, 0),
(640, 'Rajsamand', 2927, 29, 0),
(641, 'Sawai Madhopur', 2928, 29, 0),
(642, 'Sikar', 2929, 29, 0),
(643, 'Sirohi', 2930, 29, 0),
(644, 'Sri Ganganagar', 2931, 29, 0),
(645, 'Tonk', 2932, 29, 0),
(646, 'Udaipur', 2933, 29, 0),
(647, 'Barmiak', 3001, 30, 0),
(648, 'Be', 3002, 30, 0),
(649, 'Bhurtuk', 3003, 30, 0),
(650, 'Chhubakha', 3004, 30, 0),
(651, 'Chidam', 3005, 30, 0),
(652, 'Chubha', 3006, 30, 0),
(653, 'Chumikteng', 3007, 30, 0),
(654, 'Dentam', 3008, 30, 0),
(655, 'Dikchu', 3009, 30, 0),
(656, 'Dzongri', 3010, 30, 0),
(657, 'Gangtok', 3011, 30, 0),
(658, 'Gauzing', 3012, 30, 0),
(659, 'Gyalshing', 3013, 30, 0),
(660, 'Hema', 3014, 30, 0),
(661, 'Kerung', 3015, 30, 0),
(662, 'Lachen', 3016, 30, 0),
(663, 'Lachung', 3017, 30, 0),
(664, 'Lema', 3018, 30, 0),
(665, 'Lingtam', 3019, 30, 0),
(666, 'Lungthu', 3020, 30, 0),
(667, 'Mangan', 3021, 30, 0),
(668, 'Namchi', 3022, 30, 0),
(669, 'Namthang', 3023, 30, 0),
(670, 'Nanga', 3024, 30, 0),
(671, 'Nantang', 3025, 30, 0),
(672, 'Naya Bazar', 3026, 30, 0),
(673, 'Padamachen', 3027, 30, 0),
(674, 'Pakhyong', 3028, 30, 0),
(675, 'Pemayangtse', 3029, 30, 0),
(676, 'Phensang', 3030, 30, 0),
(677, 'Rangli', 3031, 30, 0),
(678, 'Rinchingpong', 3032, 30, 0),
(679, 'Sakyong', 3033, 30, 0),
(680, 'Samdong', 3034, 30, 0),
(681, 'Singtam', 3035, 30, 0),
(682, 'Siniolchu', 3035, 30, 0),
(683, 'Sombari', 3036, 30, 0),
(684, 'Soreng', 3037, 30, 0),
(685, 'Sosing', 3038, 30, 0),
(686, 'Tekhug', 3039, 30, 0),
(687, 'Temi', 3040, 30, 0),
(688, 'Tsetang', 3041, 30, 0),
(689, 'Tsomgo', 3042, 30, 0),
(690, 'Tumlong', 3043, 30, 0),
(691, 'Yangang', 3044, 30, 0),
(692, 'Yumtang', 3045, 30, 0),
(693, 'Chennai', 3101, 31, 0),
(694, 'Chidambaram', 3102, 31, 0),
(695, 'Chingleput', 3103, 31, 0),
(696, 'Coimbatore', 3104, 31, 0),
(697, 'Courtallam', 3105, 31, 0),
(698, 'Cuddalore', 3106, 31, 0),
(699, 'Dharmapuri', 3107, 31, 0),
(700, 'Dindigul', 3108, 31, 0),
(701, 'Erode', 3109, 31, 0),
(702, 'Hosur', 3110, 31, 0),
(703, 'Kanchipuram', 3111, 31, 0),
(704, 'Kanyakumari', 3112, 31, 0),
(705, 'Karaikudi', 3113, 31, 0),
(706, 'Karur', 3114, 31, 0),
(707, 'Kodaikanal', 3115, 31, 0),
(708, 'Kovilpatti', 3116, 31, 0),
(709, 'Krishnagiri', 3117, 31, 0),
(710, 'Kumbakonam', 3118, 31, 0),
(711, 'Madurai', 3119, 31, 0),
(712, 'Mayiladuthurai', 3120, 31, 0),
(713, 'Nagapattinam', 3121, 31, 0),
(714, 'Nagarcoil', 3122, 31, 0),
(715, 'Namakkal', 3123, 31, 0),
(716, 'Neyveli', 3124, 31, 0),
(717, 'Nilgiris', 3125, 31, 0),
(718, 'Ooty', 3126, 31, 0),
(719, 'Palani', 3127, 31, 0),
(720, 'Perambalur', 3128, 31, 0),
(721, 'Pollachi', 3129, 31, 0),
(722, 'Pudukkottai', 3130, 31, 0),
(723, 'Rajapalayam', 3131, 31, 0),
(724, 'Ramanathapuram', 3132, 31, 0),
(725, 'Salem', 3133, 31, 0),
(726, 'Sivaganga', 3134, 31, 0),
(727, 'Sivakasi', 3135, 31, 0),
(728, 'Thanjavur', 3136, 31, 0),
(729, 'Theni', 3137, 31, 0),
(730, 'Thoothukudi', 3138, 31, 0),
(731, 'Tiruchirappalli', 3139, 31, 0),
(732, 'Tirunelveli', 3140, 31, 0),
(733, 'Tirupur', 3141, 31, 0),
(734, 'Tiruvallur', 3142, 31, 0),
(735, 'Tiruvannamalai', 3143, 31, 0),
(736, 'Tiruvarur', 3144, 31, 0),
(737, 'Trichy', 3145, 31, 0),
(738, 'Tuticorin', 3146, 31, 0),
(739, 'Vellore', 3147, 31, 0),
(740, 'Villupuram', 3148, 31, 0),
(741, 'Virudhunagar', 3149, 31, 0),
(742, 'Yercaud', 3150, 31, 0),
(743, 'Agartala', 3201, 32, 0),
(744, 'Ambasa', 3202, 32, 0),
(745, 'Bampurbari', 3203, 32, 0),
(746, 'Belonia', 3204, 32, 0),
(747, 'Dhalai', 3205, 32, 0),
(748, 'Dharam Nagar', 3206, 32, 0),
(749, 'Kailashahar', 3207, 32, 0),
(750, 'Kamal Krishnabari', 3208, 32, 0),
(751, 'Khopaiyapara', 3209, 32, 0),
(752, 'Khowai', 3210, 32, 0),
(753, 'Phuldungsei', 3211, 32, 0),
(754, 'Radha Kishore Pur', 3212, 32, 0),
(755, 'Tripura', 3213, 32, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bharat_inquiry`
--

CREATE TABLE `bharat_inquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `trip_details` text,
  `created_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_inquiry`
--

INSERT INTO `bharat_inquiry` (`id`, `name`, `email`, `subject`, `message`, `trip_details`, `created_date`, `modify_date`) VALUES
(1, 'Kishan', 'kishan@gmail.com', 'Please guide me', 'I want to send', '{\"trip_location\":\"263\",\"drop_location\":\"285\",\"trip_location_name\":\"Ahmedabad-GUJARAT\",\"drop_location_name\":\"Rajkot-GUJARAT\",\"pick_date\":\"29\\/11\\/2019\",\"pick_time\":\"12:00 pm\",\"seating_capacity\":\"5\",\"car_id\":\"c2FydGhpNQ%3D%3D\",\"route_price\":7000}', '2019-11-27 13:13:16', '2019-11-27 18:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `bharat_route`
--

CREATE TABLE `bharat_route` (
  `id` int(11) NOT NULL,
  `from_location` int(11) DEFAULT NULL,
  `to_location` int(11) DEFAULT NULL,
  `from_city` varchar(255) DEFAULT NULL,
  `to_city` varchar(255) DEFAULT NULL,
  `from_state` varchar(255) DEFAULT NULL,
  `to_state` varchar(255) DEFAULT NULL,
  `kilometer` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_route`
--

INSERT INTO `bharat_route` (`id`, `from_location`, `to_location`, `from_city`, `to_city`, `from_state`, `to_state`, `kilometer`, `is_active`, `created_date`, `modify_date`) VALUES
(1, 263, 285, 'Ahmedabad', 'Rajkot', 'GUJARAT', 'GUJARAT', 350, 1, '2019-11-14 12:49:09', '2019-11-14 18:53:47'),
(2, 285, 272, 'Rajkot', 'Dwarka', 'GUJARAT', 'GUJARAT', 300, 1, '2019-11-14 12:51:01', '2019-11-14 18:36:40'),
(3, 285, 274, 'Rajkot', 'Jamnagar', 'Gujarat', 'Gujarat', 350, 1, '2019-11-14 13:07:49', '2019-12-01 12:09:28'),
(4, 285, 288, 'Rajkot', 'Surendranagar', 'GUJARAT', 'GUJARAT', 70, 1, '2019-11-14 13:08:40', '2019-11-14 18:33:40'),
(5, 285, 273, 'Rajkot', 'Gandhinagar', 'GUJARAT', 'GUJARAT', 250, 1, '2019-11-14 13:26:21', '2019-11-14 18:26:21'),
(6, 289, 269, 'Vadodara', 'Bhavnagar', 'GUJARAT', 'GUJARAT', 450, 1, '2019-11-14 13:54:26', '2019-11-26 02:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bharat_sitesettings`
--

CREATE TABLE `bharat_sitesettings` (
  `id` int(11) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `day_min_km` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_sitesettings`
--

INSERT INTO `bharat_sitesettings` (`id`, `from_name`, `from_email`, `day_min_km`, `is_active`) VALUES
(1, 'abc', 'abc', 300, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bharat_state`
--

CREATE TABLE `bharat_state` (
  `id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_state`
--

INSERT INTO `bharat_state` (`id`, `state`, `status`) VALUES
(1, 'ANDAMAN AND NICOBAR ISLANDS', 0),
(2, 'ANDHRA PRADESH', 0),
(3, 'ARUNACHAL PRADESH', 0),
(4, 'ASSAM', 0),
(5, 'BIHAR', 0),
(6, 'CHATTISGARH', 0),
(7, 'CHANDIGARH', 0),
(8, 'DAMAN AND DIU', 0),
(9, 'DELHI', 0),
(10, 'DADRA AND NAGAR HAVELI', 1),
(11, 'GOA', 0),
(12, 'GUJARAT', 1),
(13, 'HIMACHAL PRADESH', 0),
(14, 'HARYANA', 0),
(15, 'JAMMU AND KASHMIR', 0),
(16, 'JHARKHAND', 0),
(17, 'KERALA', 0),
(18, 'KARNATAKA', 0),
(19, 'LAKSHADWEEP', 0),
(20, 'MEGHALAYA', 0),
(21, 'MAHARASHTRA', 0),
(22, 'MANIPUR', 0),
(23, 'MADHYA PRADESH', 0),
(24, 'MIZORAM', 0),
(25, 'NAGALAND', 0),
(26, 'ORISSA', 0),
(27, 'PUNJAB', 0),
(28, 'PONDICHERRY', 0),
(29, 'RAJASTHAN', 0),
(30, 'SIKKIM', 0),
(31, 'TAMIL NADU', 0),
(32, 'TRIPURA', 0),
(33, 'UTTARAKHAND', 0),
(34, 'UTTAR PRADESH', 0),
(35, 'WEST BENGAL', 0),
(36, 'TELANGANA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bharat_user`
--

CREATE TABLE `bharat_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = Inactive , 1 Active',
  `activation_code` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_user`
--

INSERT INTO `bharat_user` (`id`, `username`, `first_name`, `last_name`, `phone`, `email`, `password`, `is_active`, `activation_code`, `created_date`, `modify_date`) VALUES
(1, 'SRT_kishan', 'kishan', '', '1234567895', 'abc@gmail.com', 'c2FydGhpMTIzNDU2', 1, '', '2019-11-05 13:08:27', '2019-11-05 18:08:27'),
(3, 'SRT_Kishan Chavda', 'Kishan Chavda', '', '8866699038', 'ca.kishanchavda@gmail.com', 'c2FydGhpMTIzNDU2', 1, '', '2019-11-07 13:45:12', '2019-11-07 18:45:12'),
(4, 'SRT_Ravi Jadav', 'Ravi Jadav', '', '8485978745', 'kishan@gmail.com', 'c2FydGhpMTIzNDU2Nw%3D%3D', 1, '', '2019-11-07 14:32:43', '2019-11-07 19:32:43'),
(5, 'SRT_Kishan', 'Kishan', '', '1234567898', 'test@gmail.com', 'c2FydGhpMTIzNDU2', 1, '', '2019-11-07 14:40:07', '2019-11-07 19:40:07'),
(6, 'SRT_Kishan Chavda', 'Kishan Chavda', '', '7778915545', 'test@gmail.com', 'c2FydGhpMTIzNDU2', 1, '', '2019-11-12 11:39:40', '2019-11-12 16:39:40'),
(7, '', 'Kishan', 'Chavda', '1234567898', 'kishan123@gmail.com', 'c2FydGhpQWJjQDEyMw%3D%3D', 1, '', '2019-11-15 12:57:20', '2019-11-15 17:57:20'),
(8, '', 'Sumit', 'Vegad', '1234567898', 'sumit@gmail.com', 'c2FydGhpQWJjQDEyMw%3D%3D', 0, '', '2019-11-15 13:01:26', '2019-11-15 18:01:26'),
(9, '', 'sumit', 'vegad', '1234567895', 'sumit@abcgmail.com', 'c2FydGhpQWJjQDEyMw%3D%3D', 0, '', '2019-11-15 13:02:08', '2019-11-15 18:02:08'),
(10, '', 'abc', 'abc', '8866699038', 'abc123@gmail.com', 'c2FydGhpYWJjQDEyMw%3D%3D', 0, '', '2019-11-20 13:42:08', '2019-11-20 18:42:08'),
(11, '', 'abc', 'abc', '8866699038', 'abc123@gmail.com', 'c2FydGhpYWJjQDEyMw%3D%3D', 0, '', '2019-11-20 13:42:28', '2019-11-20 18:42:28'),
(12, 'SRT_dsafsfewrwrtw', 'dsafsfewrwrtw', '', '879798777987', 'k1@gmail.com', 'c2FydGhpMTIzNDU2', 1, '', '2019-11-21 12:06:19', '2019-11-21 17:06:19'),
(13, 'SRT_sdfsdf', 'sdfsdf', '', 'sdfsdf', 'sdfsdf', 'c2FydGhpMTIzNDU2', 1, '', '2019-11-21 12:11:27', '2019-11-21 17:11:27'),
(14, 'SRT_fsdfsd', 'fsdfsd', '', 'sfds', 'sdfsaf', 'c2FydGhpMTIzNDU2', 1, '', '2019-12-01 02:16:04', '2019-12-01 07:16:04'),
(15, 'SRT_gsdg', 'gsdg', '', 'sdfg', 'sdgfd', 'c2FydGhpMTIzNDU2', 1, '', '2019-12-01 06:25:05', '2019-12-01 11:25:05'),
(16, 'SRT_sdfsdf', 'sdfsdf', '', 'sdf', 'sdfsdf', 'c2FydGhpMTIzNDU2', 1, '', '2019-12-01 06:52:53', '2019-12-01 11:52:53'),
(17, '', 'Kishan', 'Rathod', '1234567898', 'test123@gmail.com', 'c2FydGhpSzFzaEBuNTg%3D', 0, '', '2019-12-11 13:18:54', '2019-12-11 18:18:54'),
(18, 'SRT_Ravi Jadav', 'Ravi Jadav', '', '9898748671', '', 'c2FydGhpMTIzNDU2', 1, '', '2019-12-13 12:22:25', '2019-12-13 17:22:25'),
(19, 'SRT_Rahul', 'Rahul', 'Gohel', '1234567890', '', 'c2FydGhpMTIzNDU2', 1, '', '2019-12-13 13:38:02', '2019-12-13 18:38:02'),
(20, 'SRT_ravi', 'ravi', NULL, '1231231235', NULL, 'c2FydGhpMTIzNDU2', 1, NULL, '2019-12-24 12:51:29', '2019-12-24 17:51:29'),
(21, 'SRT_abcSumit', 'abcSumit', NULL, '9722074310', NULL, 'c2FydGhpMTIzNDU2', 1, NULL, '2019-12-30 15:10:52', '2019-12-30 20:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `bharat_vehicle`
--

CREATE TABLE `bharat_vehicle` (
  `id` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `brand` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `overview` longtext,
  `seating_capacity` int(11) DEFAULT NULL,
  `min_hours` int(11) DEFAULT NULL,
  `local_km` int(11) DEFAULT NULL,
  `hours_price` double(11,2) DEFAULT NULL,
  `min_day` int(11) DEFAULT NULL,
  `outstation_km` int(11) DEFAULT NULL,
  `outstation_price` double(11,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `modify_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_vehicle`
--

INSERT INTO `bharat_vehicle` (`id`, `title`, `brand`, `category`, `overview`, `seating_capacity`, `min_hours`, `local_km`, `hours_price`, `min_day`, `outstation_km`, `outstation_price`, `is_active`, `created_date`, `modify_date`) VALUES
(1, 'Bolero', NULL, 2, 'vtretrvet', 2, 8, 80, 300.00, 1, 1, 10.00, 1, '0000-00-00 00:00:00', '2019-11-26 01:46:00'),
(2, 'Scorpio', NULL, 2, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam nibh. Nunc varius facilisis eros. Sed erat. In in velit quis arcu ornare laoreet. Curabitur adipiscing luctus massa. Integer ut purus ac augue commodo commodo. Nunc nec mi eu justo tempor consectetuer. Etiam vitae nisl. In dignissim lacus ut ante. Cras elit lectus, bibendum a, adipiscing vitae, commodo et, dui. Ut tincidunt tortor. Donec nonummy, enim in lacinia pulvinar, velit tellus scelerisque augue, ac posuere libero urna eget neque. Cras ipsum. Vestibulum pretium, lectus nec venenatis volutpat, purus lectus ultrices risus, a condimentum risus mi et quam. Pellentesque auctor fringilla neque. Duis eu massa ut lorem iaculis vestibulum. Maecenas facilisis elit sed justo. Quisque volutpat malesuada velit. ', 4, 8, 80, 300.00, 1, 1, 15.00, 1, '0000-00-00 00:00:00', '2019-11-26 01:27:14'),
(3, 'Maruti Zen', NULL, 0, 'Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum', 5, 8, 80, 300.00, 1, 300, 500.00, 0, '0000-00-00 00:00:00', '2019-12-11 18:34:14'),
(4, 'Tavera', NULL, 0, 'Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum', 6, 8, 80, 300.00, 1, 300, 500.00, 0, '0000-00-00 00:00:00', '2019-12-04 17:43:15'),
(5, 'Inova', NULL, 2, 'vtretrvet', 5, 8, 80, 300.00, 1, 1, 20.00, 0, '0000-00-00 00:00:00', '2019-11-26 02:31:53'),
(6, 'Ertiga', NULL, 0, 'asdsad sad asd asd asd as dsad asd as dasdas d sd sdfsdfsd', 6, 8, 80, 300.00, 1, 300, 500.00, 1, '2019-10-15 13:48:22', '2019-12-11 18:35:15'),
(7, 'ETOS', NULL, 6, 'testing', 5, 8, 80, 300.00, 1, 300, 600.00, 1, '2019-10-16 13:27:05', '2019-10-18 19:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `bharat_vehicle_image`
--

CREATE TABLE `bharat_vehicle_image` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `image` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bharat_vehicle_image`
--

INSERT INTO `bharat_vehicle_image` (`id`, `vehicle_id`, `image`, `created_date`) VALUES
(7, 2, 12, '2019-12-11 18:33:30'),
(8, 2, 13, '2019-12-11 18:33:30'),
(9, 4, 14, '2019-12-11 18:33:58'),
(10, 3, 15, '2019-12-11 18:34:14'),
(11, 5, 16, '2019-12-11 18:34:34'),
(12, 5, 17, '2019-12-11 18:34:34'),
(13, 7, 18, '2019-12-11 18:34:58'),
(15, 1, 20, '2019-12-11 18:35:48'),
(16, 6, 21, '2019-12-11 18:36:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bharat_admin`
--
ALTER TABLE `bharat_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharat_attachment`
--
ALTER TABLE `bharat_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharat_booking`
--
ALTER TABLE `bharat_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharat_booking_detail`
--
ALTER TABLE `bharat_booking_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharat_brands`
--
ALTER TABLE `bharat_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharat_category`
--
ALTER TABLE `bharat_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharat_cities`
--
ALTER TABLE `bharat_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharat_inquiry`
--
ALTER TABLE `bharat_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharat_route`
--
ALTER TABLE `bharat_route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharat_sitesettings`
--
ALTER TABLE `bharat_sitesettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharat_state`
--
ALTER TABLE `bharat_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharat_user`
--
ALTER TABLE `bharat_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharat_vehicle`
--
ALTER TABLE `bharat_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bharat_vehicle_image`
--
ALTER TABLE `bharat_vehicle_image`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bharat_admin`
--
ALTER TABLE `bharat_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bharat_attachment`
--
ALTER TABLE `bharat_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bharat_booking`
--
ALTER TABLE `bharat_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `bharat_booking_detail`
--
ALTER TABLE `bharat_booking_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `bharat_brands`
--
ALTER TABLE `bharat_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bharat_category`
--
ALTER TABLE `bharat_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bharat_cities`
--
ALTER TABLE `bharat_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=756;

--
-- AUTO_INCREMENT for table `bharat_inquiry`
--
ALTER TABLE `bharat_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bharat_route`
--
ALTER TABLE `bharat_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bharat_state`
--
ALTER TABLE `bharat_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `bharat_user`
--
ALTER TABLE `bharat_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bharat_vehicle`
--
ALTER TABLE `bharat_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bharat_vehicle_image`
--
ALTER TABLE `bharat_vehicle_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
