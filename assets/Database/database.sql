-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2024 at 02:58 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `pharmacycustomers`
--

CREATE TABLE `pharmacycustomers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacycustomers`
--

INSERT INTO `pharmacycustomers` (`customer_id`, `customer_name`, `contact_number`, `address`) VALUES
(1, 'John Doe', '123-456-7890', '123 Main St, Anytown, USA'),
(9, 'John paul', '09155249913', 'enclaro'),
(10, 'John paul', '09155249913', 'enclaro'),
(11, 'ad', '21312', 'sa');

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
-- Table structure for table `pharmacy_invoice`
--

CREATE TABLE `pharmacy_invoice` (
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `total_discount` decimal(10,2) NOT NULL,
  `net_total` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `change_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy_invoice`
--

INSERT INTO `pharmacy_invoice` (`invoice_id`, `customer_id`, `invoice_number`, `payment_type`, `date`, `total_amount`, `total_discount`, `net_total`, `paid_amount`, `change_amount`) VALUES
(2, 10, '23', 'Cash Payment', '2024-06-02', 340.00, 10.00, 330.00, 350.00, 20.00),
(3, 10, '23', 'Cash Payment', '2024-06-02', 340.00, 10.00, 330.00, 350.00, 20.00),
(4, 1, '24', 'Cash Payment', '2024-06-02', 210.00, 0.00, 210.00, 210.00, 0.00),
(26, 1, '2134', 'Cash Payment', '2024-06-02', 210.00, 10.00, 200.00, 500.00, 300.00),
(42, 1, '23', 'Cash Payment', '2024-06-02', 126.00, 1.00, 125.00, 150.00, 25.00),
(108, 1, '', 'Cash Payment', '2024-06-02', 210.00, 0.00, 210.00, 250.00, 40.00),
(109, 11, '11', 'Cash Payment', '2024-06-02', 240.00, 2.00, 238.00, 250.00, 12.00),
(128, 9, '111', 'Cash Payment', '2024-06-02', 330.00, 2.00, 328.00, 400.00, 72.00),
(139, 9, '23', 'Cash Payment', '2024-06-02', 30.00, 1.00, 29.00, 30.00, 1.00),
(157, 9, '', 'Cash Payment', '2024-06-02', 175.00, 8.00, 167.00, 200.00, 33.00),
(160, 1, '111', 'Cash Payment', '2024-06-02', 21.00, 0.00, 21.00, 30.00, 9.00),
(164, 10, '23', 'Cash Payment', '2024-06-03', 11.00, 1.00, 10.00, 10.00, 0.00),
(166, 9, '2133', 'Cash Payment', '2024-06-03', 20.00, 6.00, 14.00, 20.00, 6.00);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_medicines`
--

CREATE TABLE `pharmacy_medicines` (
  `id` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `packing` varchar(50) DEFAULT NULL,
  `generic_name` varchar(255) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy_medicines`
--

INSERT INTO `pharmacy_medicines` (`id`, `medicine_name`, `packing`, `generic_name`, `supplier`) VALUES
(1, 'Aspirin', '10 TAB', 'Acetylsalicylic Acid', 'ABC Pharmaceuticals'),
(2, 'Biogesic', '20 Tab', 'Paracetamol', 'Abc SUpplier'),
(3, 'Biogesic', '20 Tab', 'Paracetamol', 'Abc SUpplier');

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
(1, 'Biogesic (500g)', '', 'Paracetamol\r\n', 'Pain KIller', '175 (sachetz)', 30, '2024-08-01', '2033-01-06', 20.00),
(2, 'Pseudoephedrine', '', 'Sudafed / Pseudoephedrine', 'Depend on doctor by specific use', '20', 5, '2021-09-30', '2029-09-11', 35.00);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_medicine_details`
--

CREATE TABLE `pharmacy_medicine_details` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `batch_id` varchar(255) NOT NULL,
  `packing` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `quantity` varchar(300) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `supplier` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy_medicine_details`
--

INSERT INTO `pharmacy_medicine_details` (`id`, `purchase_id`, `medicine_name`, `batch_id`, `packing`, `expiry_date`, `quantity`, `price`, `amount`, `supplier`) VALUES
(12, 11, 'Bioflu', '', '6 Stabs\r\n', '2024-06-04', '21 Stabs\r\n', 10.00, 200.00, 'Bacolod'),
(13, 12, 'aspirin', '', '8 Sachets\r\n', '2023-06-08', '21', 6.00, 126.00, 'hinigaran'),
(14, 13, 'Bioflu', '', '10', '2026-06-17', '21', 21.00, 441.00, 'hinigaran'),
(15, 13, 'aspirin', '', '10', '2025-06-26', '50', 11.00, 550.00, 'hinigaran'),
(16, 14, 'Diatabs', '', '10', '2022-06-23', '10', 10.00, 100.00, 'hinigaran'),
(17, 15, 'BIOGESIC', '', '10', '2024-06-03', '20', 10.00, 200.00, 'Bacolod');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_purchase_details`
--

CREATE TABLE `pharmacy_purchase_details` (
  `id` int(11) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy_purchase_details`
--

INSERT INTO `pharmacy_purchase_details` (`id`, `supplier`, `invoice`, `payment_type`, `date`, `grand_total`, `payment_status`) VALUES
(11, 'Bacolod', '21331', 'Cash Payment', '2024-05-27', 200.00, 'PAID'),
(12, 'hinigaran', '2321', 'Payment Due', '2024-03-27', 126.00, 'PENDING'),
(13, 'hinigaran', '1234', 'Cash Payment', '2024-05-27', 991.00, 'PAID'),
(14, 'hinigaran', '', 'Cash Payment', '', 100.00, 'PAID'),
(15, 'Bacolod', '1234', 'Cash Payment', '2024-06-03', 200.00, 'PAID');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy_suppliers`
--

CREATE TABLE `pharmacy_suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacy_suppliers`
--

INSERT INTO `pharmacy_suppliers` (`id`, `name`, `email`, `contact_number`, `address`) VALUES
(1, 'Bacolod', 'bacolod@gmail.com', '09155249913', 'Bacolodcity'),
(2, 'hinigaran', 'hinigaran@gmail.com', '09155249913', 'hinigaran');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `pos_number` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `pos_number`, `total`, `created_at`) VALUES
(3, 'POS-001', 40.00, '2024-09-10 22:49:54'),
(4, 'POS-002', 60.00, '2024-09-10 22:50:09'),
(5, 'POS-003', 180.00, '2024-09-10 22:53:39'),
(6, 'POS-004', 140.00, '2024-09-10 22:54:33'),
(7, 'POS-005', 100.00, '2024-09-10 22:58:27'),
(8, 'POS-006', 120.00, '2024-09-10 22:58:54'),
(9, 'POS-007', 160.00, '2024-09-10 23:12:42'),
(11, 'POS-008', 180.00, '2024-09-10 23:26:45'),
(12, 'POS-009', 120.00, '2024-09-10 23:30:07'),
(13, 'POS-010', 180.00, '2024-09-10 23:32:33'),
(14, 'POS-011', 180.00, '2024-09-10 23:36:24'),
(15, 'POS-012', 180.00, '2024-09-10 23:38:31'),
(16, 'POS-013', 160.00, '2024-09-11 00:08:37'),
(17, 'POS-014', 100.00, '2024-09-11 00:10:21'),
(18, 'POS-015', 175.00, '2024-09-11 00:26:32');

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
(3, 3, 'Biogesic', 2, 20.00, 40.00),
(4, 4, 'Biogesic', 3, 20.00, 60.00),
(5, 5, 'Biogesic', 9, 20.00, 180.00),
(6, 6, 'Biogesic', 7, 20.00, 140.00),
(7, 7, 'Biogesic', 5, 20.00, 100.00),
(8, 8, 'Biogesic', 6, 20.00, 120.00),
(9, 9, 'Biogesic', 8, 20.00, 160.00),
(10, 12, 'Biogesic', 6, 20.00, 120.00),
(11, 13, 'Biogesic', 9, 20.00, 180.00),
(12, 14, 'Biogesic', 9, 20.00, 180.00),
(13, 15, 'Biogesic', 9, 20.00, 180.00),
(14, 16, 'Biogesic', 8, 20.00, 160.00),
(15, 17, 'Biogesic', 5, 20.00, 100.00),
(16, 18, 'Pseudoephedrine', 5, 35.00, 175.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'paul', 'paul');

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
(87, 2, 'AsthmaS', '', 0, '', 'N/A', 0, 0, 0, 'N/A', 'N/A', 'N/A');

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
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacycustomers`
--
ALTER TABLE `pharmacycustomers`
  ADD PRIMARY KEY (`customer_id`);

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
-- Indexes for table `pharmacy_er_nurse`
--
ALTER TABLE `pharmacy_er_nurse`
  ADD PRIMARY KEY (`nurse_id`);

--
-- Indexes for table `pharmacy_invoice`
--
ALTER TABLE `pharmacy_invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `pharmacy_medicines`
--
ALTER TABLE `pharmacy_medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_medicines_products`
--
ALTER TABLE `pharmacy_medicines_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_medicine_details`
--
ALTER TABLE `pharmacy_medicine_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indexes for table `pharmacy_purchase_details`
--
ALTER TABLE `pharmacy_purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy_suppliers`
--
ALTER TABLE `pharmacy_suppliers`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

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
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pharmacycustomers`
--
ALTER TABLE `pharmacycustomers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT for table `pharmacy_er_nurse`
--
ALTER TABLE `pharmacy_er_nurse`
  MODIFY `nurse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pharmacy_invoice`
--
ALTER TABLE `pharmacy_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `pharmacy_medicines`
--
ALTER TABLE `pharmacy_medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pharmacy_medicines_products`
--
ALTER TABLE `pharmacy_medicines_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pharmacy_medicine_details`
--
ALTER TABLE `pharmacy_medicine_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pharmacy_purchase_details`
--
ALTER TABLE `pharmacy_purchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pharmacy_suppliers`
--
ALTER TABLE `pharmacy_suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `receipt_items`
--
ALTER TABLE `receipt_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vital_signs`
--
ALTER TABLE `vital_signs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pharmacy_invoice`
--
ALTER TABLE `pharmacy_invoice`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `pharmacycustomers` (`customer_id`),
  ADD CONSTRAINT `pharmacy_invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `pharmacycustomers` (`customer_id`);

--
-- Constraints for table `pharmacy_medicine_details`
--
ALTER TABLE `pharmacy_medicine_details`
  ADD CONSTRAINT `pharmacy_medicine_details_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `pharmacy_purchase_details` (`id`);

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
