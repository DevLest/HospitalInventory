-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 10:40 AM
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
(181, 'sample', 'sample', 'johnpaul', 'rebecca', '', 'sample', 'zxcz', '09155249913', 0.00, 7, 'IN PATIENT'),
(182, 'sample213', 'sample1213', '', 'rebecca', 'sample', 'asd', '', '09155249913', 100.00, 1, 'IN PATIENT'),
(183, '', '', '', 'johnpaul', '', '', '', '', 0.00, 1, 'IN PATIENT');

-- --------------------------------------------------------

--
-- Table structure for table `admission_refer`
--

CREATE TABLE `admission_refer` (
  `id` int(11) NOT NULL,
  `er_patient_id` int(11) NOT NULL,
  `status` enum('Admitted','Referred') NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_initial` char(1) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_visit` tinyint(1) NOT NULL,
  `appointment_date` date NOT NULL,
  `reason_for_visit` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `doctor_id`, `first_name`, `middle_initial`, `last_name`, `first_visit`, `appointment_date`, `reason_for_visit`, `created_at`, `status`) VALUES
(21, 19, 'John', 'M', 'Baldonasa', 1, '2024-11-24', 'asdsadsad', '2024-11-24 06:14:03', 'Reschedule'),
(22, 17, 'John Paul', 'M', 'Baldonasa', 1, '2024-11-26', 'asd', '2024-11-26 10:43:43', 'Approved'),
(23, 17, 'Lutao', 'M', 'Joser', 1, '2024-11-27', 'try', '2024-11-27 08:47:39', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `calendar_availability`
--

CREATE TABLE `calendar_availability` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `availability` enum('Available','N/A') DEFAULT 'N/A',
  `available_time` varchar(255) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendar_availability`
--

INSERT INTO `calendar_availability` (`id`, `date`, `availability`, `available_time`, `doctor_id`) VALUES
(17, '2024-11-24', 'Available', '10:00 AM - 4:00 PM', 17),
(18, '2024-11-26', 'Available', '8:00 am - 10:00 am', 19);

-- --------------------------------------------------------

--
-- Table structure for table `chief_admins`
--

CREATE TABLE `chief_admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Chief Admin',
  `chief_license` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chief_admins`
--

INSERT INTO `chief_admins` (`id`, `username`, `password`, `email`, `role`, `chief_license`, `contact_number`, `address`, `created_at`) VALUES
(1, 'jason', '$2y$10$tc6k9jW4cJoC6uk.6/lZ3Oz78v0EyIyU3s.p0eNck796meWAILA7G', 'jason@gmail.com', 'Chief Admin', '111-22001-2222', '09155249913', 'Enclaro', '2024-11-25 21:44:18'),
(2, 'John', 'john', 'john@gmail.com', 'Chief Admin', '222-112291-1011', '09155249913', 'Enclaro', '2024-11-25 22:11:40');

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
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `license` varchar(20) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `clinic_address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `specialties` varchar(255) DEFAULT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `name`, `password`, `license`, `image`, `email`, `clinic_address`, `contact_number`, `specialties`, `username`) VALUES
(11, 'Borris', '$2y$10$sOiqkTEohILX6VzxmY/umuTu2qLPYRVEUXw8DXemNNj8VzE1Q3GAK', '', 'uploads/user.jpg', 'Borris@gmal.com', 'Hinigaran Medical Clinic Hospital', '09155249913', 'Cardiology', 'Borris'),
(16, 'john', '$2y$10$hh.pPd7vghts3b4fNwjtauTIpUDnqS655tiJWWvnjzdZa.HlE40a.', 'xx-ooo-xx', 'uploads/gwapo.jpg', 'johnpaulbaldonasa@gmail.com', 'asd', '09155249913', 'Cardiology', 'jp'),
(17, 'riz', '$2y$10$//CqFCS5yXJFKC2Y9yms9u1Wo9kLooo4jEZCyahLlUVLK16bLYPvq', 'xxxxx-00000000000-xx', 'uploads/user.jpg', 'riz@gmail.com', 'asd', '09155249913', 'Radiology', 'riz'),
(19, 'Ry', '$2y$10$F1kyZ3sMFjZrBrzAVLMSkuM7JCpn41iipqEskFnJ6sBn95Ihsloqi', 'xx-00000-xx', 'uploads/staff.jpg', 'ry@gmail.com', 'aasda', '09155249913', 'Gastroenterology', 'ry'),
(20, 'by', '$2y$10$MArwWk6.NBEnl00FBVaj5.nTuMvq0osN/3Yx2Otz4ms6Pu5XC3Mgy', 'xx-ooo-xx', 'uploads/gwapo.jpg', 'paul@gmail.com', 'asdasd', '09155249913', 'Pediatricians', 'by'),
(21, 'john', '$2y$10$Sk8tWA0xg26qEUR/AVM9/OIBz19Y4YSjM07.U4R/HxqBZzo5XCPNq', 'xx-00000-xx', 'uploads/2 - Copy_1728568600.jpg', 'johnpaulbaldonasa@gmail.com', 'hinigaran', '09155249913', 'Cardiology', 'user1');

-- --------------------------------------------------------

--
-- Table structure for table `er_patient`
--

CREATE TABLE `er_patient` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `admission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `condition_summary` text DEFAULT NULL,
  `attending_doctor` varchar(255) DEFAULT NULL,
  `status` enum('Admitted','Discharged','Under Observation') DEFAULT 'Under Observation',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `role` enum('Pharmacy Admin','Pharmacy Cashier','Pharmacy Staff','Er nurse','Wards','Chief Admin') DEFAULT NULL,
  `shift` enum('Day : 6:00 am - 12:00 pm','Day: 12:00 pm - 6:00 pm','Night: 6:00 pm - 12:00 am','Night: 12:00 am - 6:00 am','Day : 7:00 am - 5:00 pm','Day : 7:00 pm - 5:00 am') DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `login_date` date DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `username`, `role`, `shift`, `time_in`, `time_out`, `login_date`, `status`) VALUES
(176, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '09:51:52', '09:55:33', '2024-11-05', 'Inactive'),
(181, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '17:04:47', '17:23:33', '2024-11-12', 'Inactive'),
(183, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '08:28:24', '08:36:38', '2024-11-13', 'Inactive'),
(184, 'lutao', 'Pharmacy Staff', 'Night: 6:00 pm - 12:00 am', '08:28:40', NULL, '2024-11-13', 'Active'),
(185, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '11:00:57', NULL, '2024-11-13', 'Active'),
(186, 'rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '21:10:36', NULL, '2024-11-22', 'Active'),
(187, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '18:15:05', '18:15:11', '2024-11-24', 'Inactive'),
(188, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '00:08:33', '00:16:57', '2024-11-26', 'Inactive'),
(189, 'Wards', '', '', '00:35:58', NULL, '2024-11-26', 'Active'),
(190, 'wards', 'Wards', '', '00:39:00', NULL, '2024-11-26', 'Active'),
(191, 'wards', 'Wards', 'Day : 7:00 am - 5:00 pm', '00:41:29', NULL, '2024-11-26', 'Active'),
(192, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '02:06:24', '05:57:04', '2024-11-26', 'Inactive'),
(193, 'wards', 'Wards', 'Day : 7:00 am - 5:00 pm', '03:38:18', NULL, '2024-11-26', 'Active'),
(194, 'wards', 'Wards', 'Day : 7:00 am - 5:00 pm', '03:48:46', NULL, '2024-11-26', 'Active'),
(195, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '05:57:23', NULL, '2024-11-26', 'Active'),
(196, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '13:50:29', '13:53:04', '2024-11-26', 'Inactive'),
(197, 'wards', 'Wards', 'Day : 7:00 am - 5:00 pm', '14:11:22', NULL, '2024-11-26', 'Active'),
(198, 'wards', 'Wards', 'Day : 7:00 am - 5:00 pm', '14:27:29', NULL, '2024-11-26', 'Active'),
(199, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '16:58:40', '18:22:27', '2024-11-26', 'Inactive'),
(200, 'wards', 'Wards', 'Day : 7:00 am - 5:00 pm', '17:02:23', NULL, '2024-11-26', 'Active'),
(201, 'wards', 'Wards', 'Day : 7:00 am - 5:00 pm', '18:40:49', NULL, '2024-11-26', 'Active'),
(202, 'wards', 'Wards', 'Day : 7:00 am - 5:00 pm', '18:45:34', NULL, '2024-11-26', 'Active'),
(203, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '18:46:20', '18:49:05', '2024-11-26', 'Inactive'),
(204, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '18:51:42', NULL, '2024-11-26', 'Active'),
(205, 'lutao', 'Pharmacy Staff', 'Night: 6:00 pm - 12:00 am', '15:02:54', NULL, '2024-11-27', 'Active'),
(206, 'wards', 'Wards', 'Day : 7:00 am - 5:00 pm', '15:04:13', NULL, '2024-11-27', 'Active'),
(207, 'Rebecca', 'Pharmacy Cashier', 'Day: 12:00 pm - 6:00 pm', '16:37:51', NULL, '2024-11-27', 'Active'),
(208, 'wards', 'Wards', 'Day : 7:00 am - 5:00 pm', '16:44:07', NULL, '2024-11-27', 'Active'),
(209, 'lutao', 'Pharmacy Staff', 'Night: 6:00 pm - 12:00 am', '16:52:25', NULL, '2024-11-27', 'Active');

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
(6, 11, 2, 2, 2, 2, 2, 2, 2, 2, 3372.00, '2024-10-24 10:04:51'),
(7, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, '2024-10-24 14:52:15'),
(8, 3, 20, 2, 2, 2, 2, 2, 2, 2, 3390.00, '2024-11-05 09:52:04'),
(9, 3, 20, 2, 2, 2, 2, 2, 2, 2, 3390.00, '2024-11-05 15:36:42'),
(10, 3, 2, 2, 2, 2, 2, 2, 2, 2, 3372.00, '2024-11-12 17:04:53'),
(11, 3, 20, 20, 202, 2, 2, 2, 2, 2, 5480.00, '2024-11-13 11:01:16'),
(12, 3, 20, 20, 2, 2, 2, 2, 2, 2, 3480.00, '2024-11-22 21:10:47'),
(13, 3, 2, 2, 2, 2, 2, 2, 2, 2, 3372.00, '2024-11-24 18:15:09'),
(14, 3, 2, 2, 2, 2, 2, 2, 2, 2, 3372.00, '2024-11-26 00:08:39'),
(15, 3, 2, 2, 2, 22, 0, 2, 2, 2, 3672.00, '2024-11-26 02:06:28'),
(16, 3, 2, 2, 2, 2, 2, 20, 2, 2, 5172.00, '2024-11-26 13:50:47'),
(17, 3, 20, 2, 20, 2, 12, 2, 2, 2, 4070.00, '2024-11-26 16:58:58'),
(18, 3, 2, 2, 2, 2, 2, 2, 2, 2, 3372.00, '2024-11-26 18:46:33'),
(19, 3, 2, 2, 2, 2, 2, 2, 2, 2, 3372.00, '2024-11-26 18:51:49'),
(20, 3, 2, 2, 2, 2, 2, 2, 2, 2, 3372.00, '2024-11-27 16:38:00');

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
  `brand` varchar(255) NOT NULL,
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

INSERT INTO `pharmacy_medicines_products` (`id`, `medicine_product`, `image`, `generic_name`, `category`, `brand`, `registered_quantity`, `sold_quantity`, `registered`, `expiry`, `selling_price`) VALUES
(5, 'MedicolForte (200mg)', 'uploads/medicol.jpg', 'Ibuprofen', 'non-steroidal anti-inflammatory drugs (NSAIDs)', '', '180 (stab)', 179, '2023-09-18', '2024-03-18', 20.00),
(7, 'Biogeisc ( 500ml )', 'uploads/biogesic.jpg', 'Paracetamol', 'N02BE01 - paracetamol ; Belongs to the class of anilide preparations.', '', '183 (sachetz)\r\n', 1, '2024-09-18', '2030-10-18', 10.00),
(8, 'Amoxicillin ( 500mg )', 'uploads/amoxicilin.jpg', 'Amoxicillin', 'Amoxicillin belongs to the group of medicines known as penicillin antibiotics.', '', '103', 97, '2024-09-18', '2028-07-18', 5.00),
(9, 'Cetirizine ( 10mg )', 'uploads/cetirizine.jpg', 'loratadine ', 'It works against the production of histamine, and belongs to as class of medications called antihist', '', '172', 28, '2024-09-18', '2029-11-18', 20.00),
(10, 'Mefenamic Acid ( 500mg )', 'uploads/mefenamic.jpg', 'Mefenamic acid', 'Mefenamic (mef\" e nam\' ik) acid belongs to the anthranilic acid derivative class of NSAIDs (fenamate', '', '192', 8, '2024-09-18', '2030-12-18', 49.00),
(11, 'Bioflu', 'uploads/Bioflu.jpg', 'Phenylephrine HCI + Chlorphenamine Maleate + Paracetamol', 'N02BE01 - paracetamol ; Belongs to the class of anilide preparations. Used to relieve pain and fever', '', '189', 31, '2024-09-18', '2027-07-18', 30.00),
(16, 'Bioflus', 'uploads/Bioflu.jpg', 'asd', 'asd', 'Baxter', '200 (Stabs)', 0, '2024-11-25', '2024-11-26', 10.00),
(17, 'Bioflu', 'uploads/biogesic.jpg', 'Paracetamol', 'N02BE01 - paracetamol ; Belongs to the class of anilide preparations.', 'Baxter', '196', 4, '2024-11-26', '2024-11-26', 10.00);

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
(2, 'uploads/wheelchair.jpg', 'Wheel Chair', 'Mobility Aid', 'Van Os', '2024-09-18', 1559.00, '12', 9),
(3, 'uploads/inject.jpg', 'Syringe ( 10ml )', 'Luer Slip (or Slip Tip)', 'Baxter', '2024-09-19', 48.00, '81', 19);

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
(55, 'POS-016', 25.00, '2024-10-21 15:16:36', 50.00, 25.00, 0.00, 0),
(56, 'POS-017', 45.00, '2024-10-23 14:24:15', 50.00, 5.00, 0.00, 0),
(57, 'POS-018', 50.00, '2024-10-23 14:43:03', 50.00, 0.00, 0.00, 0),
(59, 'POS-020', 15.00, '2024-10-24 00:57:44', 20.00, 5.00, 0.00, 0),
(63, 'POS-024', 10.00, '2024-10-24 02:05:21', 10.00, 0.00, 0.00, 11),
(64, 'POS-025', 2502.40, '2024-11-05 01:52:48', 4000.00, 1497.60, 625.60, 3),
(65, 'POS-026', 394.00, '2024-11-05 07:37:34', 0.00, -394.00, 0.00, 3),
(66, 'POS-027', 5.00, '2024-11-05 08:04:05', 0.00, -5.00, 0.00, 3),
(67, 'POS-028', 1569.00, '2024-11-12 09:11:01', 1600.00, 31.00, 0.00, 3),
(68, 'POS-029', 1271.20, '2024-11-25 16:09:32', 2000.00, 728.80, 317.80, 3),
(69, 'POS-030', 48.00, '2024-11-25 18:29:50', 10.00, 2.00, 2.00, 3),
(70, 'POS-031', 10.00, '2024-11-25 18:44:19', 10.00, 0.00, 0.00, 3),
(71, 'POS-032', 30.00, '2024-11-25 19:26:50', 20.00, -10.00, 0.00, 3),
(72, 'POS-033', 240.00, '2024-11-25 19:28:04', 300.00, 60.00, 0.00, 3),
(73, 'POS-034', 150.00, '2024-11-25 19:30:01', 200.00, 50.00, 0.00, 3),
(74, 'POS-035', 1112.30, '2024-11-26 05:52:25', 2000.00, 887.70, 476.70, 3),
(75, 'POS-036', 54.00, '2024-11-26 08:59:51', 100.00, 46.00, 6.00, 3),
(76, 'POS-037', 9.80, '2024-11-26 10:47:32', 10.00, 0.20, 0.20, 3),
(77, 'POS-038', 58.80, '2024-11-27 08:39:03', 100.00, 41.20, 1.20, 3);

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
(69, 63, 'Amoxicillin ( 500mg )', 2, 5.00, 10.00),
(70, 64, 'Amoxicillin ( 500mg )', 2, 5.00, 10.00),
(71, 64, 'Wheel Chair', 2, 1559.00, 3118.00),
(72, 65, 'Amoxicillin ( 500mg )', 2, 5.00, 10.00),
(73, 65, 'Syringe ( 10ml )', 8, 48.00, 384.00),
(74, 66, 'Amoxicillin ( 500mg )', 1, 5.00, 5.00),
(75, 67, 'Amoxicillin ( 500mg )', 2, 5.00, 10.00),
(76, 67, 'Wheel Chair', 1, 1559.00, 1559.00),
(77, 68, 'Bioflu', 1, 30.00, 30.00),
(78, 68, 'Wheel Chair', 1, 1559.00, 1559.00),
(79, 69, 'Biogeisc ( 500ml )', 5, 10.00, 50.00),
(80, 70, 'Biogeisc ( 500ml )', 1, 10.00, 10.00),
(81, 71, 'Bioflu', 1, 30.00, 30.00),
(82, 72, 'Bioflu', 8, 30.00, 240.00),
(83, 73, 'Bioflu', 5, 30.00, 150.00),
(84, 74, 'Bioflu', 1, 30.00, 30.00),
(85, 74, 'Wheel Chair', 1, 1559.00, 1559.00),
(86, 75, 'Bioflu', 2, 30.00, 60.00),
(87, 76, 'Amoxicillin ( 500mg )', 2, 5.00, 10.00),
(88, 77, 'Bioflu', 2, 30.00, 60.00);

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
  `role` enum('Pharmacy Staff','Pharmacy Admin','Pharmacy Cashier','Wards','Er Nurse') NOT NULL,
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
(11, 'rizza', 'pla@gmail.com', '$2y$10$zZ10erilydR9z3.V2uiZMuHPZgWHQzTxGJlgAdpZsOin8w4K6/4QW', 'Day: 12:00 pm - 6:00 pm', 'Pharmacy Cashier', 'uploads/1_1729735469.jpg', '2024-10-24 02:04:29'),
(12, 'lutao', 'lutao@gmail.com', '$2y$10$lkxkNKGU1WxOlZ7Z6YwLO.Q4IVHVxun.aJ61F2x7SfSFjoueMI7nG', 'Night: 6:00 pm - 12:00 am', 'Pharmacy Staff', 'uploads/2 - Copy_1729808063.jpg', '2024-10-24 22:14:23'),
(15, 'Wards', 'paul@gmail.com', '$2y$10$eBiolD2e.jwsjPugFWHHJuR0zaaNbLnHdcrteZ6pkuVr0ALIdaTG.', 'Day : 7:00 am - 5:00 pm', 'Wards', 'uploads/cashiers_1732552316.jpg', '2024-11-25 16:31:56'),
(16, 'Lutao', 'lutao@gmail.com', '$2y$10$l9KtISZWpTLGTMO/x8/lH.ZvBL3gNWczGePj0iOvzkbPqPyk.M8am', 'Day : 7:00 am - 5:00 pm', '', 'uploads/1_1729735394_1732617481.jpg', '2024-11-26 10:38:01');

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
(89, 2, 'Covid', 'johnpaul', 90, '12', '12', 12, 12, 90, '', '', ''),
(90, 9, 'Asthma', 'johnpaul', 90, '12', '12', 12, 12, 90, '', '', ''),
(91, 1, '', '', 90, '', '12', 12, 12, 12, 'N/A', 'aw', 'N/A'),
(92, 1, '', '', 90, '', '12', 12, 12, 12, 'N/A', 'aw', 'N/A'),
(93, 1, '', '', 90, '', '12', 12, 12, 12, 'N/A', 'aw', 'N/A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admissionpatient`
--
ALTER TABLE `admissionpatient`
  ADD PRIMARY KEY (`admission_id`);

--
-- Indexes for table `admission_refer`
--
ALTER TABLE `admission_refer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `er_patient_id` (`er_patient_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `calendar_availability`
--
ALTER TABLE `calendar_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `chief_admins`
--
ALTER TABLE `chief_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `er_patient`
--
ALTER TABLE `er_patient`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `admission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `admission_refer`
--
ALTER TABLE `admission_refer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `calendar_availability`
--
ALTER TABLE `calendar_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `chief_admins`
--
ALTER TABLE `chief_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `er_patient`
--
ALTER TABLE `er_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pharmacy_er_nurse`
--
ALTER TABLE `pharmacy_er_nurse`
  MODIFY `nurse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pharmacy_medicines_products`
--
ALTER TABLE `pharmacy_medicines_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pharmacy_products`
--
ALTER TABLE `pharmacy_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `receipt_items`
--
ALTER TABLE `receipt_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vital_signs`
--
ALTER TABLE `vital_signs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admission_refer`
--
ALTER TABLE `admission_refer`
  ADD CONSTRAINT `admission_refer_ibfk_1` FOREIGN KEY (`er_patient_id`) REFERENCES `er_patient` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`);

--
-- Constraints for table `calendar_availability`
--
ALTER TABLE `calendar_availability`
  ADD CONSTRAINT `calendar_availability_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`);

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
