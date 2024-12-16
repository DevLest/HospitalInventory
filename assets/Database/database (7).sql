-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2024 at 04:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admissionpatient`
--

CREATE TABLE `admissionpatient` (
  `admission_id` int(11) NOT NULL,
  `admittedby` varchar(255) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `attending_physician` varchar(255) NOT NULL,
  `chargeaccountto` varchar(255) NOT NULL,
  `relationtoparent` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobilenumber` varchar(255) NOT NULL,
  `totalpayment` decimal(10,2) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admissionpatient`
--

INSERT INTO `admissionpatient` (`admission_id`, `admittedby`, `parent_name`, `ward`, `attending_physician`, `chargeaccountto`, `relationtoparent`, `address`, `mobilenumber`, `totalpayment`, `patient_id`, `status`) VALUES
(172, 'sample', 'sample', 'johnpaul', 'johnpaul', 'sample', 'sample', 'as', '09155249913', 400.00, 1, 'IN-PATIENT'),
(174, 'sample', 'sample', 'johnpaul', 'johnpaul', 'sample', 'sample', 'as', '09155249913', 400.00, 1, 'IN-PATIENT'),
(180, 'sample', 'sample', 'johnpaul', 'johnpaul', '', 'sample', 'sa', '09155249913', 400.00, 3, 'IN PATIENT');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `email`, `phone`, `address`) VALUES
(2, 'John paul', NULL, '09155249913', 'enclaro'),
(3, 'John paul', NULL, '09155249913', 'enclaro'),
(4, 'John paul', NULL, '09155249913', 'enclaro');

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `role` enum('Pharmacy Admin','Pharmacy Cashier','Pharmacy Staff','ER nurse','ER Doctor','Chief Admin') DEFAULT NULL,
  `shift` enum('Day : 6:00 am - 12:00 pm','Day: 12:00 pm - 6:00 pm','Night: 6:00 pm - 12:00 am','Night: 12:00 am - 6:00 am') DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `login_date` date DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `username`, `role`, `shift`, `time_in`, `time_out`, `login_date`, `status`) VALUES
(151, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '03:59:01', '04:06:37', '2024-10-17', 'Inactive'),
(152, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '04:17:41', '04:19:34', '2024-10-17', 'Inactive'),
(153, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '04:30:24', NULL, '2024-10-17', 'Active'),
(154, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '23:02:30', '23:03:04', '2024-10-17', 'Inactive'),
(155, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '22:33:26', NULL, '2024-10-18', 'Active'),
(156, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '00:13:21', '21:36:01', '2024-10-21', 'Inactive'),
(157, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '21:44:19', NULL, '2024-10-21', 'Active'),
(158, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '00:46:58', '00:47:05', '2024-10-22', 'Inactive'),
(159, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '00:48:23', '02:00:17', '2024-10-22', 'Inactive'),
(160, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '21:56:14', '21:57:07', '2024-10-23', 'Inactive'),
(161, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '21:57:54', NULL, '2024-10-23', 'Active'),
(162, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '22:06:02', NULL, '2024-10-23', 'Active'),
(163, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '08:57:19', '08:58:11', '2024-10-24', 'Inactive'),
(164, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '08:58:23', '09:34:07', '2024-10-24', 'Inactive'),
(165, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '09:34:12', '09:43:04', '2024-10-24', 'Inactive'),
(166, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '09:43:09', '10:03:28', '2024-10-24', 'Inactive'),
(167, 'rizza', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '10:04:45', NULL, '2024-10-24', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `hospitalnum` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `ext_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `civilstatus` varchar(255) NOT NULL,
  `gender` enum('male','female','other','') NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `hospitalnum`, `lastname`, `firstname`, `middlename`, `ext_name`, `address`, `age`, `birthday`, `birthplace`, `civilstatus`, `gender`, `mobile`, `religion`, `occupation`, `date`) VALUES
(1, '2024', 'Baldonasa', 'John Paul', 'Mandras', '', 'Purok Vietnam Rose, Brgy. Enclaro Binalbagan Neg. Occ.', 21, '2002-09-09', 'City of Makati', 'Single', 'male', '09155249913', 'Catholic', 'None', '2024-08-08'),
(2, '2024', 'Sardon', 'Marc ', 'Laurence', '', 'San Teodoro Binalbagan', 22, '2001-03-12', 'Binalbagan', 'Single', 'male', '09155249913', 'Catholic', 'None', '2024-07-05'),
(3, '2024', 'Ardenio', 'Jamela', 'Gamella', '', 'Brgy. Nanunga Hinigaran', 25, '1998-12-18', 'hinigaran', 'Single', 'female', '09155249913', 'Catholic', 'None', '2024-05-05'),
(4, '2024-5', 'Sardon', 'Marc ', 'Laurence', '', 'Purok Vietnam Rose, Brgy. Enclaro Binalbagan Neg. Occ.', 22, '2003-03-21', 'City of Makati', 'Single', 'male', '09155249913', 'Catholic', 'None', '2024-05-13'),
(6, '2024-3', 'Glory', 'Von', '', '', 'Purok Vietnam Rose, Brgy. Enclaro Binalbagan Neg. Occ.', 21, '2002-12-03', 'Binalbagan', 'Single', 'male', '09563667440', 'Catholic', 'None', '2024-12-26'),
(7, '2024-7', 'baldonasa', 'Ryan', 'Mandras', '', 'Purok Vietnam Rose, Brgy. Enclaro Binalbagan Neg. Occ.', 22, '2001-07-07', 'City of Makati', 'Single', 'male', '09155249913', 'Catholic', 'None', '2024-06-03'),
(8, '2024-6', 'baldonasa', 'John Paul ', 'Mandras', '', 'Purok Vietnam Rose, Brgy. Enclaro Binalbagan Neg. Occ.', 22, '2002-09-09', 'City of Makati', 'Single', 'male', '09563667440', 'Catholic', 'None', '2024-11-03'),
(9, '2024-4', 'Sardon', 'Marc ', 'Gamella', '', 'San Teodoro Binalbagan', 21, '2016-02-25', 'Binalbagan', 'Single', 'male', '09205516986', 'Catholic', 'None', '2024-06-03'),
(10, '2024-9', 'baldonasa', 'John Paul ', 'Mandras', '', '123 Main St, Anytown, USA', 21, '2017-11-03', 'Binalbagan', 'Single', 'male', '09155249913', 'Catholic', 'None', '2024-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacydoctors`
--

CREATE TABLE `pharmacydoctors` (
  `doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `doctor_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacydoctors`
--

INSERT INTO `pharmacydoctors` (`doctor_id`, `doctor_name`, `doctor_address`) VALUES
(1, 'Dr. Smith', '456 Oak St, Anytown, USA'),
(2, 'Dr. jp', 'Hinigaran'),
(3, 'Dr. jp', 'Hinigaran'),
(4, 'Dr. jp', 'Hinigaran'),
(5, 'Dr. jp', 'Hinigaran'),
(6, 'Dr. jp', 'Hinigaran'),
(7, 'Dr. jp', 'Hinigaran'),
(8, 'Dr. jp', 'Hinigaran'),
(9, 'Dr. jp', 'Hinigaran'),
(10, 'Dr. jp', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_cashier`
--

CREATE TABLE `pharmacy_cashier` (
  `cashier_id` int(11) NOT NULL,
  `cashier_name` varchar(255) NOT NULL,
  `shift_start` datetime NOT NULL,
  `shift_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy_cashier`
--

INSERT INTO `pharmacy_cashier` (`cashier_id`, `cashier_name`, `shift_start`, `shift_end`) VALUES
(1, 'Ms. Saya', '2024-06-04 08:00:00', '2024-06-04 16:00:00'),
(2, 'Ms Jane', '2024-06-04 16:00:00', '2024-06-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_cashier_cash_in`
--

CREATE TABLE `pharmacy_cashier_cash_in` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `one` int(11) DEFAULT 0,
  `five` int(11) DEFAULT 0,
  `ten` int(11) DEFAULT 0,
  `twenty` int(11) DEFAULT 0,
  `fifty` int(11) DEFAULT 0,
  `hundred` int(11) DEFAULT 0,
  `five_hundred` int(11) DEFAULT 0,
  `thousand` int(11) DEFAULT 0,
  `total_cash_in` decimal(10,2) NOT NULL,
  `cash_in_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy_cashier_cash_in`
--

INSERT INTO `pharmacy_cashier_cash_in` (`id`, `user_id`, `one`, `five`, `ten`, `twenty`, `fifty`, `hundred`, `five_hundred`, `thousand`, `total_cash_in`, `cash_in_time`) VALUES
(1, 3, 2, 22, 22, 22, 22, 2, 2, 2, 5072.00, '2024-10-23 22:06:19'),
(2, 3, 220, 222, 22, 2, 2, 2, 2, 2, 4890.00, '2024-10-24 08:57:28'),
(3, 3, 0, 2, 2, 2, 2, 2, 20, 2, 12370.00, '2024-10-24 08:58:32'),
(4, 3, 22, 2, 2, 2, 2, 2, 2, 22, 23392.00, '2024-10-24 09:34:23'),
(5, 3, 20, 2, 2, 2, 2, 22, 2, 2, 5390.00, '2024-10-24 09:43:15'),
(6, 11, 2, 2, 2, 2, 2, 2, 2, 2, 3372.00, '2024-10-24 10:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_er_nurse`
--

CREATE TABLE `pharmacy_er_nurse` (
  `nurse_id` int(11) NOT NULL,
  `nurse_name` varchar(255) NOT NULL,
  `shift_start` datetime NOT NULL,
  `shift_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy_er_nurse`
--

INSERT INTO `pharmacy_er_nurse` (`nurse_id`, `nurse_name`, `shift_start`, `shift_end`) VALUES
(1, 'Lima', '2024-06-04 08:00:00', '2024-06-04 16:00:00'),
(2, 'Guilardro', '2024-06-04 16:00:00', '2024-06-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_medicines_products`
--

CREATE TABLE `pharmacy_medicines_products` (
  `id` int(11) NOT NULL,
  `medicine_product` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `generic_name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `registered_quantity` varchar(255) NOT NULL,
  `sold_quantity` int(11) NOT NULL,
  `remain_quantity` varchar(255) GENERATED ALWAYS AS (`registered_quantity` - `sold_quantity`) VIRTUAL,
  `registered` date NOT NULL,
  `expiry` date NOT NULL,
  `selling_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy_medicines_products`
--

INSERT INTO `pharmacy_medicines_products` (`id`, `medicine_product`, `image`, `generic_name`, `category`, `registered_quantity`, `sold_quantity`, `registered`, `expiry`, `selling_price`) VALUES
(5, 'MedicolForte (200mg)', 'uploads/medicol.jpg', 'Ibuprofen', 'non-steroidal anti-inflammatory drugs (NSAIDs)', '180', 179, '2023-09-18', '2024-03-18', 20.00),
(7, 'Biogeisc ( 500ml )', 'uploads/biogesic.jpg', 'Paracetamol', 'N02BE01 - paracetamol ; Belongs to the class of anilide preparations.', '189', 11, '2024-09-18', '2030-10-18', 10.00),
(8, 'Amoxicillin ( 500mg )', 'uploads/amoxicilin.jpg', 'Amoxicillin', 'Amoxicillin belongs to the group of medicines known as penicillin antibiotics.', '112', 88, '2024-09-18', '2028-07-18', 5.00),
(9, 'Cetirizine ( 10mg )', 'uploads/cetirizine.jpg', 'loratadine ', 'It works against the production of histamine, and belongs to as class of medications called antihist', '172', 28, '2024-09-18', '2029-11-18', 20.00),
(10, 'Mefenamic Acid ( 500mg )', 'uploads/mefenamic.jpg', 'Mefenamic acid', 'Mefenamic (mef\" e nam\' ik) acid belongs to the anthranilic acid derivative class of NSAIDs (fenamate', '192', 8, '2024-09-18', '2030-12-18', 49.00),
(11, 'Bioflu', 'uploads/Bioflu.jpg', 'Phenylephrine HCI + Chlorphenamine Maleate + Paracetamol', 'N02BE01 - paracetamol ; Belongs to the class of anilide preparations. Used to relieve pain and fever', '2', 11, '2024-09-18', '2027-07-18', 30.00);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_products`
--

CREATE TABLE `pharmacy_products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `date_registered` date NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `registered_quantity` varchar(255) DEFAULT '0',
  `sold_quantity` int(11) DEFAULT 0,
  `remaining_quantity` int(11) GENERATED ALWAYS AS (`registered_quantity` - `sold_quantity`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy_products`
--

INSERT INTO `pharmacy_products` (`id`, `image`, `product`, `category`, `brand`, `date_registered`, `selling_price`, `registered_quantity`, `sold_quantity`) VALUES
(2, 'uploads/wheelchair.jpg', 'Wheel Chair', 'Mobility Aid', 'Van Os', '2024-09-18', 1559.00, '17', 4),
(3, 'uploads/inject.jpg', 'Syringe ( 10ml )', 'Luer Slip (or Slip Tip)', 'Baxter', '2024-09-19', 48.00, '89', 11);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `pos_number` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `paid_amount` decimal(10,2) NOT NULL,
  `change_amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) DEFAULT 0.00,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `pos_number`, `total`, `created_at`, `paid_amount`, `change_amount`, `discount_amount`, `user_id`) VALUES
(52, 'POS-013', 48.00, '2024-10-02 11:22:35', 50.00, 2.00, 0.00, 0),
(53, 'POS-014', 5.00, '2024-10-08 10:09:34', 10.00, 5.00, 0.00, 0),
(54, 'POS-015', 0.00, '2024-10-15 10:08:26', 0.00, 0.00, 0.00, 0),
(55, 'POS-016', 25.00, '2024-10-21 15:16:36', 50.00, 25.00, 0.00, 0),
(56, 'POS-017', 45.00, '2024-10-23 14:24:15', 50.00, 5.00, 0.00, 0),
(57, 'POS-018', 50.00, '2024-10-23 14:43:03', 50.00, 0.00, 0.00, 0),
(58, 'POS-019', 0.00, '2024-10-24 00:48:51', 0.00, 0.00, 0.00, 0),
(59, 'POS-020', 15.00, '2024-10-24 00:57:44', 20.00, 5.00, 0.00, 0),
(60, 'POS-021', 0.00, '2024-10-24 01:10:41', 10.00, 10.00, 0.00, 0),
(61, 'POS-022', 10.00, '2024-10-24 01:43:28', 100.00, 90.00, 0.00, 3),
(62, 'POS-023', 482.00, '2024-10-24 01:44:23', 500.00, 18.00, 0.00, 3),
(63, 'POS-024', 10.00, '2024-10-24 02:05:21', 10.00, 0.00, 0.00, 11);

-- --------------------------------------------------------

--
-- Table structure for table `receipt_items`
--

CREATE TABLE `receipt_items` (
  `id` int(11) NOT NULL,
  `receipt_id` int(11) DEFAULT NULL,
  `medicine_product` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipt_items`
--

INSERT INTO `receipt_items` (`id`, `receipt_id`, `medicine_product`, `quantity`, `price`, `total`) VALUES
(60, 52, 'Syringe ( 10ml )', 1, 48.00, 48.00),
(61, 53, 'Amoxicillin ( 500mg )', 1, 5.00, 5.00),
(62, 55, 'Amoxicillin ( 500mg )', 5, 5.00, 25.00),
(63, 56, 'Amoxicillin ( 500mg )', 9, 5.00, 45.00),
(64, 57, 'Biogeisc ( 500ml )', 5, 10.00, 50.00),
(65, 59, 'Amoxicillin ( 500mg )', 3, 5.00, 15.00),
(66, 61, 'Amoxicillin ( 500mg )', 2, 5.00, 10.00),
(67, 62, 'Biogeisc ( 500ml )', 5, 10.00, 50.00),
(68, 62, 'Syringe ( 10ml )', 9, 48.00, 432.00),
(69, 63, 'Amoxicillin ( 500mg )', 2, 5.00, 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `shift` enum('Day : 6:00 am - 12:00 pm','Day: 12:00 pm - 6:00 pm','Night: 6:00 pm - 12:00 am','Night: 12:00 am - 6:00 am','Day : 7:00 am - 5:00 pm','Day : 7:00 pm - 5:00 am') NOT NULL,
  `role` enum('Pharmacy Staff','Pharmacy Admin','Pharmacy Cashier') NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `shift`, `role`, `profile_image`, `created_at`) VALUES
(3, 'Rebecca', 'rebeccabandojo@gmail.com', '$2y$10$pFweon8BQSvX8d/ezrq48Oi0CD3gUQL/MhraTYTtpw5ciLTVX3ZSy', 'Day: 12:00 pm - 6:00 pm', 'Pharmacy Cashier', 'uploads/cashiers_1728318856.jpg', '2024-10-07 16:34:16'),
(8, 'johnpaul', 'johnpaulbaldonasa@gmail.com', '$2y$10$zn7GLkdIxuP9HQTgS6GkCehzLzHuSQsCWt3Z47p.Nt2J4TsYpSmE2', 'Day : 7:00 am - 5:00 pm', 'Pharmacy Admin', 'uploads/gwapo_1728368192.jpg', '2024-10-08 06:16:32'),
(9, 'paul', 'paul@gmail.com', '$2y$10$CFV.mdHiHs5ZOjbuRpCRU.qXE9BP3xNHVddp77YzrmA5RpgZga3PC', 'Day : 7:00 pm - 5:00 am', 'Pharmacy Admin', 'uploads/2 - Copy_1728568600.jpg', '2024-10-10 13:56:40'),
(10, 'paul', 'paul@gmail.com', '$2y$10$7KqfnkPlHTQBOzrWRdavnOhc8K3M6Y5j3E0ynsoZN9pdcQMgtFDsy', 'Day : 7:00 am - 5:00 pm', 'Pharmacy Cashier', 'uploads/1_1729735394.jpg', '2024-10-24 02:03:14'),
(11, 'rizza', 'pla@gmail.com', '$2y$10$zZ10erilydR9z3.V2uiZMuHPZgWHQzTxGJlgAdpZsOin8w4K6/4QW', 'Day: 12:00 pm - 6:00 pm', 'Pharmacy Cashier', 'uploads/1_1729735469.jpg', '2024-10-24 02:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `vital_signs`
--

CREATE TABLE `vital_signs` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `history_of_patient_illness` varchar(255) NOT NULL,
  `attending_physician` varchar(255) NOT NULL,
  `respiratory_rate` int(11) NOT NULL,
  `blood_pressure` varchar(255) NOT NULL,
  `capillary_refill` varchar(255) NOT NULL,
  `temperature` float NOT NULL,
  `weight` float NOT NULL,
  `pulse_rate` int(11) NOT NULL,
  `physical_examination` text NOT NULL,
  `diagnosis` text NOT NULL,
  `medication_treatment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vital_signs`
--

INSERT INTO `vital_signs` (`id`, `patient_id`, `history_of_patient_illness`, `attending_physician`, `respiratory_rate`, `blood_pressure`, `capillary_refill`, `temperature`, `weight`, `pulse_rate`, `physical_examination`, `diagnosis`, `medication_treatment`) VALUES
(83, 1, '', 'johnpaul', 23, '', '49', 31, 42, 16, 'sample', 'N/A', 'N/A'),
(84, 1, '', 'johnpaul', 23, '', '49', 31, 42, 16, 'sample', 'N/A', 'N/A'),
(85, 3, 'sample', '', 12, '', '12', 12, 12, 12, 'JP', 'N/A', 'N/A'),
(86, 2, 'AsthmaS', '', 0, '', 'N/A', 0, 0, 0, 'N/A', 'N/A', 'N/A'),
(87, 2, 'AsthmaS', '', 0, '', 'N/A', 0, 0, 0, 'N/A', 'N/A', 'N/A'),
(88, 1, 'Covid', '', 0, '', '', 0, 0, 0, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admissionpatient`
--
ALTER TABLE `admissionpatient`
  ADD PRIMARY KEY (`admission_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacydoctors`
--
ALTER TABLE `pharmacydoctors`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `pharmacy_cashier`
--
ALTER TABLE `pharmacy_cashier`
  ADD PRIMARY KEY (`cashier_id`);

--
-- Indexes for table `pharmacy_cashier_cash_in`
--
ALTER TABLE `pharmacy_cashier_cash_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pharmacy_er_nurse`
--
ALTER TABLE `pharmacy_er_nurse`
  ADD PRIMARY KEY (`nurse_id`);

--
-- Indexes for table `pharmacy_medicines_products`
--
ALTER TABLE `pharmacy_medicines_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_products`
--
ALTER TABLE `pharmacy_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_items`
--
ALTER TABLE `receipt_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipt_id` (`receipt_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vital_signs`
--
ALTER TABLE `vital_signs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patient_id` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admissionpatient`
--
ALTER TABLE `admissionpatient`
  MODIFY `admission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pharmacydoctors`
--
ALTER TABLE `pharmacydoctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pharmacy_cashier`
--
ALTER TABLE `pharmacy_cashier`
  MODIFY `cashier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pharmacy_cashier_cash_in`
--
ALTER TABLE `pharmacy_cashier_cash_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pharmacy_er_nurse`
--
ALTER TABLE `pharmacy_er_nurse`
  MODIFY `nurse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pharmacy_medicines_products`
--
ALTER TABLE `pharmacy_medicines_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pharmacy_products`
--
ALTER TABLE `pharmacy_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `receipt_items`
--
ALTER TABLE `receipt_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vital_signs`
--
ALTER TABLE `vital_signs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pharmacy_cashier_cash_in`
--
ALTER TABLE `pharmacy_cashier_cash_in`
  ADD CONSTRAINT `pharmacy_cashier_cash_in_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `receipt_items`
--
ALTER TABLE `receipt_items`
  ADD CONSTRAINT `receipt_items_ibfk_1` FOREIGN KEY (`receipt_id`) REFERENCES `receipts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vital_signs`
--
ALTER TABLE `vital_signs`
  ADD CONSTRAINT `fk_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
