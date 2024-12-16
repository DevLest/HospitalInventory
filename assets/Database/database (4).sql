-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 11:23 PM
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
  `shift` enum('day','night') DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `login_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `username`, `role`, `shift`, `time_in`, `time_out`, `login_date`) VALUES
(33, 'rebecca', 'Pharmacy Cashier', 'day', '05:06:00', '05:07:50', '2024-10-08'),
(34, 'johnpaul', 'Pharmacy Admin', 'day', '05:07:00', NULL, '2024-10-08'),
(35, 'rebecca', 'Pharmacy Cashier', 'day', '05:08:00', '05:09:06', '2024-10-08'),
(36, 'johnpaul', 'Pharmacy Admin', 'day', '05:20:00', NULL, '2024-10-08');

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
(5, 'MedicolForte (200mg)', 'uploads/medicol.jpg', 'Ibuprofen', 'non-steroidal anti-inflammatory drugs (NSAIDs)', '181', 178, '2023-09-18', '2024-03-18', 20.00),
(7, 'Biogeisc ( 500ml )', 'uploads/biogesic.jpg', 'Paracetamol', 'N02BE01 - paracetamol ; Belongs to the class of anilide preparations.', '200 (Stabs)', 0, '2024-09-18', '2030-10-18', 10.00),
(8, 'Amoxicillin ( 500mg )', 'uploads/amoxicilin.jpg', 'Amoxicillin', 'Amoxicillin belongs to the group of medicines known as penicillin antibiotics.', '200 (Stabs)', 0, '2024-09-18', '2028-07-18', 5.00),
(9, 'Cetirizine ( 10mg )', 'uploads/cetirizine.jpg', 'loratadine ', 'It works against the production of histamine, and belongs to as class of medications called antihist', '200 (Stabs)', 0, '2024-09-18', '2029-11-18', 20.00),
(10, 'Mefenamic Acid ( 500mg )', 'uploads/mefenamic.jpg', 'Mefenamic acid', 'Mefenamic (mef\" e nam\' ik) acid belongs to the anthranilic acid derivative class of NSAIDs (fenamate', '200 (Stabs)', 0, '2024-09-18', '2030-12-18', 49.00),
(11, 'Bioflu', 'uploads/Bioflu.jpg', 'Phenylephrine HCI + Chlorphenamine Maleate + Paracetamol', 'N02BE01 - paracetamol ; Belongs to the class of anilide preparations. Used to relieve pain and fever', '13(Stabs)', 0, '2024-09-18', '2027-07-18', 30.00);

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
(3, 'uploads/inject.jpg', 'Syringe ( 10ml )', 'Luer Slip (or Slip Tip)', 'Baxter', '2024-09-19', 48.00, '98', 2);

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
  `refunded_amount` decimal(10,2) DEFAULT NULL,
  `refund_reason` varchar(255) DEFAULT NULL,
  `refunded_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `pos_number`, `total`, `created_at`, `paid_amount`, `change_amount`, `discount_amount`, `refunded_amount`, `refund_reason`, `refunded_at`) VALUES
(47, 'POS-008', 1559.00, '2024-09-18 11:33:27', 0.00, -1559.00, 0.00, NULL, NULL, NULL),
(48, 'POS-009', 3118.00, '2024-09-18 11:34:45', 0.00, -3118.00, 0.00, NULL, NULL, NULL),
(49, 'POS-010', 1231.30, '2024-09-18 11:36:47', 0.00, -1231.30, 527.70, NULL, NULL, NULL),
(50, 'POS-011', 1391.20, '2024-09-18 11:38:10', 1400.00, 8.80, 347.80, 1391.20, 'wrong\r\n', '2024-09-18 11:40:53'),
(51, 'POS-012', 48.00, '2024-09-18 16:34:03', 0.00, -48.00, 0.00, NULL, NULL, NULL),
(52, 'POS-013', 48.00, '2024-10-02 11:22:35', 50.00, 2.00, 0.00, NULL, NULL, NULL);

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
(53, 47, 'Wheel Chair', 1, 1559.00, 1559.00),
(54, 48, 'Wheel Chair', 2, 1559.00, 3118.00),
(55, 49, 'MedicolForte (200mg)', 10, 20.00, 200.00),
(56, 49, 'Wheel Chair', 1, 1559.00, 1559.00),
(57, 50, 'Wheel Chair', 1, 1559.00, 1559.00),
(58, 50, 'MedicolForte (200mg)', 9, 20.00, 180.00),
(59, 51, 'Syringe ( 10ml )', 1, 48.00, 48.00),
(60, 52, 'Syringe ( 10ml )', 1, 48.00, 48.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `shift` enum('day','night') NOT NULL,
  `role` enum('Pharmacy Staff','Pharmacy Admin','Pharmacy Cashier') NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `shift`, `role`, `profile_image`, `created_at`) VALUES
(1, 'Johnpaul', 'johnpaulbaldonasa@gmail.com', '$2y$10$Y5hYPiEl8qFl8s2BcXn88O8cQ47WBDsR4IZb87mCxcPZPr4ZIidlW', 'day', 'Pharmacy Admin', 'uploads/gwapo_1728312916.jpg', '2024-10-07 14:55:16'),
(2, 'Jp', 'paul@gmail.com', '$2y$10$7Shii9udWvrkwsymvHwPR.ftHVHMcvrXDM2/JFU44MibaanuRfLfu', 'day', 'Pharmacy Staff', 'uploads/staff_1728315172.jpg', '2024-10-07 15:32:52'),
(3, 'Rebecca', 'rebeccabandojo@gmail.com', '$2y$10$pFweon8BQSvX8d/ezrq48Oi0CD3gUQL/MhraTYTtpw5ciLTVX3ZSy', 'day', 'Pharmacy Cashier', 'uploads/cashiers_1728318856.jpg', '2024-10-07 16:34:16');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `receipt_items`
--
ALTER TABLE `receipt_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vital_signs`
--
ALTER TABLE `vital_signs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Constraints for dumped tables
--

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
