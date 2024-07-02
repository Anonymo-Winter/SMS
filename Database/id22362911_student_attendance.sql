-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2024 at 01:25 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id22362911_student_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(15) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin@123', '$2y$10$WVr/Sfh/XxQn2aFt.vTDTOo2XLu8GZlL5WW2PoBACQnX3dghC44KS');

-- --------------------------------------------------------

--
-- Table structure for table `allocate_teacher`
--

CREATE TABLE `allocate_teacher` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `Sclass` varchar(10) NOT NULL,
  `Course_id` varchar(10) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allocate_teacher`
--

INSERT INTO `allocate_teacher` (`id`, `tid`, `Sclass`, `Course_id`, `date`) VALUES
(9, 2, 'CSE-1A', 'CS2203', '2024-06-26 09:31:40'),
(10, 2, 'CSE-1B', 'CS2203', '2024-06-26 09:31:52'),
(11, 1, 'CSE-1C', 'CS2203', '2024-06-26 09:32:21'),
(12, 4, 'CSE-1A', 'CS2201', '2024-06-26 09:32:39'),
(13, 3, 'CSE-1B', 'CS2201', '2024-06-26 09:32:48'),
(14, 3, 'CSE-1C', 'CS2201', '2024-06-26 09:33:00'),
(15, 3, 'CSE-1A', 'CS2202', '2024-06-26 09:33:31'),
(16, 2, 'CSE-1B', 'CS2202', '2024-06-26 09:33:41'),
(18, 2, 'CSE-1C', 'CS2202', '2024-06-26 09:33:54'),
(19, 1, 'CSE-1A', 'CS2204', '2024-06-26 09:34:18'),
(20, 1, 'CSE-1B', 'CS2204', '2024-06-26 09:35:51'),
(21, 4, 'CSE-1C', 'CS2204', '2024-06-26 09:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `aid` int(11) NOT NULL,
  `Sid` varchar(10) NOT NULL,
  `Course_id` varchar(30) NOT NULL,
  `Class_id` varchar(30) NOT NULL,
  `attendance_date` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`aid`, `Sid`, `Course_id`, `Class_id`, `attendance_date`, `status`) VALUES
(1, 'S200001', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(2, 'S200281', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(3, 'S200078', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(4, 'S201114', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(5, 'S200335', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(6, 'S200224', 'CS2204', 'CSE-1A', '2024-06-26', 0),
(7, 'S200319', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(8, 'S200749', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(9, 'S200025', 'CS2204', 'CSE-1A', '2024-06-26', 0),
(10, 'S200059', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(11, 'S200386', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(12, 'S201147', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(13, 'S200288', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(14, 'S200543', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(15, 'S200177', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(16, 'S200448', 'CS2204', 'CSE-1A', '2024-06-26', 0),
(17, 'S200182', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(18, 'S201107', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(19, 'S200056', 'CS2204', 'CSE-1A', '2024-06-26', 0),
(20, 'S200290', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(21, 'S200868', 'CS2204', 'CSE-1A', '2024-06-26', 1),
(22, 'S200170', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(23, 'S200422', 'CS2204', 'CSE-1B', '2024-06-26', 0),
(24, 'S200439', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(25, 'S200398', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(26, 'S200355', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(27, 'S200823', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(28, 'S200266', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(29, 'S200216', 'CS2204', 'CSE-1B', '2024-06-26', 0),
(30, 'S200143', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(31, 'S200987', 'CS2204', 'CSE-1B', '2024-06-26', 0),
(32, 'S200885', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(33, 'S200869', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(34, 'S200903', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(35, 'S200967', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(36, 'S200168', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(37, 'S200490', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(38, 'S200463', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(39, 'S200316', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(40, 'S200531', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(41, 'S200488', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(42, 'S200990', 'CS2204', 'CSE-1B', '2024-06-26', 1),
(43, 'S200417', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(44, 'S200460', 'CS2204', 'CSE-1C', '2024-06-26', 0),
(45, 'S200206', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(46, 'S200778', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(47, 'S200256', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(48, 'S200499', 'CS2204', 'CSE-1C', '2024-06-26', 0),
(49, 'S200272', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(50, 'S200397', 'CS2204', 'CSE-1C', '2024-06-26', 0),
(51, 'S200506', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(52, 'S200032', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(53, 'S200566', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(54, 'S200712', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(55, 'S200671', 'CS2204', 'CSE-1C', '2024-06-26', 0),
(56, 'S200959', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(57, 'S201140', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(58, 'S201025', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(59, 'S200857', 'CS2204', 'CSE-1C', '2024-06-26', 0),
(60, 'S200942', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(61, 'S200886', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(62, 'S200052', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(63, 'S200893', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(64, 'S201021', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(65, 'S201028', 'CS2204', 'CSE-1C', '2024-06-26', 1),
(66, 'S200417', 'CS2201', 'CSE-1C', '2024-06-30', 1),
(67, 'S200460', 'CS2201', 'CSE-1C', '2024-06-30', 1),
(68, 'S200206', 'CS2201', 'CSE-1C', '2024-06-30', 1),
(69, 'S200778', 'CS2201', 'CSE-1C', '2024-06-30', 1),
(70, 'S200256', 'CS2201', 'CSE-1C', '2024-06-30', 1),
(71, 'S200499', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(72, 'S200272', 'CS2201', 'CSE-1C', '2024-06-30', 1),
(73, 'S200397', 'CS2201', 'CSE-1C', '2024-06-30', 1),
(74, 'S200506', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(75, 'S200032', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(76, 'S200566', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(77, 'S200712', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(78, 'S200671', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(79, 'S200959', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(80, 'S201140', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(81, 'S201025', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(82, 'S200857', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(83, 'S200942', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(84, 'S200886', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(85, 'S200052', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(86, 'S200893', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(87, 'S201021', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(88, 'S201028', 'CS2201', 'CSE-1C', '2024-06-30', 0),
(89, 'S200001', 'CS2201', 'CSE-1A', '2024-07-01', 1),
(90, 'S200281', 'CS2201', 'CSE-1A', '2024-07-01', 1),
(91, 'S200078', 'CS2201', 'CSE-1A', '2024-07-01', 1),
(92, 'S201114', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(93, 'S200335', 'CS2201', 'CSE-1A', '2024-07-01', 1),
(94, 'S200224', 'CS2201', 'CSE-1A', '2024-07-01', 1),
(95, 'S200319', 'CS2201', 'CSE-1A', '2024-07-01', 1),
(96, 'S200749', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(97, 'S200025', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(98, 'S200059', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(99, 'S200386', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(100, 'S201147', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(101, 'S200288', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(102, 'S200543', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(103, 'S200177', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(104, 'S200448', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(105, 'S200182', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(106, 'S201107', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(107, 'S200056', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(108, 'S200290', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(109, 'S200868', 'CS2201', 'CSE-1A', '2024-07-01', 0),
(110, 'S200001', 'CS2201', 'CSE-1A', '2024-07-02', 1),
(111, 'S200281', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(112, 'S200078', 'CS2201', 'CSE-1A', '2024-07-02', 1),
(113, 'S201114', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(114, 'S200335', 'CS2201', 'CSE-1A', '2024-07-02', 1),
(115, 'S200224', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(116, 'S200319', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(117, 'S200749', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(118, 'S200025', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(119, 'S200059', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(120, 'S200386', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(121, 'S201147', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(122, 'S200288', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(123, 'S200543', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(124, 'S200177', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(125, 'S200448', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(126, 'S200182', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(127, 'S201107', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(128, 'S200056', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(129, 'S200290', 'CS2201', 'CSE-1A', '2024-07-02', 0),
(130, 'S200868', 'CS2201', 'CSE-1A', '2024-07-02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `Sclass` varchar(10) NOT NULL,
  `dept` int(11) DEFAULT NULL,
  `year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `Sclass`, `dept`, `year`) VALUES
(6, 'CSE-1A', 1, 'E1'),
(7, 'CSE-1B', 1, 'E1'),
(8, 'CSE-1C', 1, 'E1');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `depId` int(11) NOT NULL,
  `dept_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`depId`, `dept_name`) VALUES
(1, 'CSE'),
(2, 'ECE'),
(3, 'EEE'),
(4, 'MECH');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `Sid` varchar(8) NOT NULL,
  `Sname` text NOT NULL,
  `Sclass` varchar(15) NOT NULL,
  `Srollno` int(11) NOT NULL,
  `dept` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`Sid`, `Sname`, `Sclass`, `Srollno`, `dept`) VALUES
('S200001', 'Kotyada Shalini', 'CSE-1A', 1, 1),
('S200025', 'Korukonda Yamuna', 'CSE-1A', 9, 1),
('S200032', 'Kadari Naga Chakradar', 'CSE-1C', 10, 1),
('S200052', 'Vaka Leela Lahari', 'CSE-1C', 20, 1),
('S200056', 'Potnuru Ganesh', 'CSE-1A', 19, 1),
('S200059', 'Patta Mounika Sree', 'CSE-1A', 10, 1),
('S200078', 'Kummari Usha', 'CSE-1A', 3, 1),
('S200143', 'Koyyalamudi Satwika', 'CSE-1B', 9, 1),
('S200168', 'Ramba Madhu Simhanadh', 'CSE-1B', 15, 1),
('S200170', 'Sura Dakshayani', 'CSE-1B', 1, 1),
('S200177', 'Kuriti Uma', 'CSE-1A', 15, 1),
('S200182', 'Bonu Venkatesh', 'CSE-1A', 17, 1),
('S200206', 'Nunna Lakshmi Janardhana Ganesh', 'CSE-1C', 3, 1),
('S200216', 'Podilapu Anjali', 'CSE-1B', 8, 1),
('S200224', 'Kondati Satya', 'CSE-1A', 6, 1),
('S200256', 'Duppala Venkatesh', 'CSE-1C', 5, 1),
('S200266', 'Pondara Amruthakumari', 'CSE-1B', 7, 1),
('S200272', 'Chikkala Giridhar Sai', 'CSE-1C', 7, 1),
('S200281', 'LENKA YASASWINI', 'CSE-1A', 2, 1),
('S200288', 'Karibandi Geetha Venkata Jyothi', 'CSE-1A', 13, 1),
('S200290', 'Padidadakala Avinash', 'CSE-1A', 20, 1),
('S200316', 'Solla Harikrishna', 'CSE-1B', 18, 1),
('S200319', 'Madena Pujitha', 'CSE-1A', 7, 1),
('S200335', 'Thatraju Sandhya', 'CSE-1A', 5, 1),
('S200355', 'Patruni Madhavilatha', 'CSE-1B', 5, 1),
('S200386', 'Pudi Gnana Lahari', 'CSE-1A', 11, 1),
('S200397', 'Vamaravalli Hemanth Kumar', 'CSE-1C', 8, 1),
('S200398', 'Pediredla Swathi', 'CSE-1B', 4, 1),
('S200417', 'Gadham Anantha Kumar', 'CSE-1C', 1, 1),
('S200422', 'Atmakuri Hymavathi', 'CSE-1B', 2, 1),
('S200439', 'Yasarla Nalini', 'CSE-1B', 3, 1),
('S200448', 'Shaik Suraj', 'CSE-1A', 16, 1),
('S200460', 'Lanka Sampath Kumar', 'CSE-1C', 2, 1),
('S200463', 'Gedela Chandra Venkata Manikanta', 'CSE-1B', 17, 1),
('S200488', 'Viswanadhapalli Hemanth Kumar', 'CSE-1B', 20, 1),
('S200490', 'Bongu Jani', 'CSE-1B', 16, 1),
('S200499', 'Alajangi Vidya Sagar', 'CSE-1C', 6, 1),
('S200506', 'Ampolu Karthikay', 'CSE-1C', 9, 1),
('S200531', 'Akula Ashok', 'CSE-1B', 19, 1),
('S200543', 'Kalla Bhargavi', 'CSE-1A', 14, 1),
('S200566', 'Raparthi Srinivas', 'CSE-1C', 11, 1),
('S200671', 'Anumalasetty Deepak Gupta', 'CSE-1C', 13, 1),
('S200712', 'Natukula Chaithanya Kumar', 'CSE-1C', 12, 1),
('S200749', 'Yeturu Lakshmi Sravya', 'CSE-1A', 8, 1),
('S200778', 'Marrimanu Shahul', 'CSE-1C', 4, 1),
('S200823', 'Shaik Shainaz', 'CSE-1B', 6, 1),
('S200857', 'Gogi Nadeesa Rahul', 'CSE-1C', 17, 1),
('S200868', 'Puli Tarun Sumanth', 'CSE-1A', 21, 1),
('S200869', 'Paramati Sarika Gangothri', 'CSE-1B', 12, 1),
('S200885', 'Birudugadda Bhargavi', 'CSE-1B', 11, 1),
('S200886', 'Bethapudi Risheendra', 'CSE-1C', 19, 1),
('S200893', 'Vemula Prabhas', 'CSE-1C', 21, 1),
('S200903', 'Nedunuri Visalakshi', 'CSE-1B', 13, 1),
('S200942', 'Ongole Manasshe', 'CSE-1C', 18, 1),
('S200959', 'Ravuri Rahul Justin', 'CSE-1C', 14, 1),
('S200967', 'Pulakunta Sai Jyothi', 'CSE-1B', 14, 1),
('S200987', 'Pangi Jahnavi', 'CSE-1B', 10, 1),
('S200990', 'Badavath Pavan Kalyan', 'CSE-1B', 21, 1),
('S201021', 'Angadi Purna Sankar', 'CSE-1C', 22, 1),
('S201025', 'Sajja Phani Kumar', 'CSE-1C', 16, 1),
('S201028', 'Mude Theja Naick', 'CSE-1C', 23, 1),
('S201107', 'Bhavaraju Raj Koushal', 'CSE-1A', 18, 1),
('S201114', 'Gelam Lakshmi Sujitha', 'CSE-1A', 4, 1),
('S201140', 'Kamunuri Tarun', 'CSE-1C', 15, 1),
('S201147', 'Mohammed Khajal', 'CSE-1A', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `Course_id` varchar(10) NOT NULL,
  `Course_name` varchar(50) NOT NULL,
  `dept` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `Course_id`, `Course_name`, `dept`) VALUES
(1, 'CS2201', 'COMPUTER ORGANIZATION AND ARCHITECTURE', 1),
(2, 'CS2202', 'WEB TECHNOLOGIES', 1),
(3, 'CS2203', 'COMPILER DESIGN', 1),
(8, 'CS2204', 'DATABASE MANAGEMENT SYSTEM', 1),
(4, 'EC2201', 'DIGITAL LOGIC DESIGN', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `tname` varchar(20) NOT NULL,
  `user_name` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `dept` int(11) NOT NULL,
  `subjects` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `tname`, `user_name`, `password`, `phone_no`, `dept`, `subjects`) VALUES
(1, 'SAVITRI', 'savi3@123', '$2y$10$FjmCGtYPHXM8pGt5U8dHM.SxIu/wDX5TKN3aPULBWKW0BNF7UTrBG', '0000000000', 1, 'COMPILER DESIGN,DATABASE MANAGEMENT SYSTEM'),
(2, 'VISHNU PRIYANKA', 'vis@123', '$2y$10$mXQRxXyVt51vD.Op7Puxw.RUQq.Dnw2QkLn45u3oGP.TUowq7GD9e', '0000000000', 1, 'WEB TECHNOLOGIES,COMPILER DESIGN'),
(3, 'DILEEP', 'dileep@123', '$2y$10$mp8zVn4G0D.zOr2ayxK4bOM90z.rbU8jnCefqNDoeE8IWuPADw1ee', '0000000000', 1, 'COMPUTER ORGANIZATION AND ARCHITECTURE,WEB TECHNOLOGIES'),
(4, 'VENKAT', 'venky#123', '$2y$10$ePdCY.Q/.oepaleBOkdnzeqmrveCW0QL5ULknvT5/KpSzkhbwusXG', '2222222222', 1, 'COMPUTER ORGANIZATION AND ARCHITECTURE,DATABASE MANAGEMENT SYSTEM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `allocate_teacher`
--
ALTER TABLE `allocate_teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `tid` (`tid`,`Sclass`,`Course_id`),
  ADD UNIQUE KEY `Sclass` (`Sclass`,`Course_id`),
  ADD KEY `tid_idx` (`tid`),
  ADD KEY `Sclass_idx` (`Sclass`),
  ADD KEY `Course_id_idx` (`Course_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`aid`),
  ADD UNIQUE KEY `aid_UNIQUE` (`aid`),
  ADD KEY `Sid_idx` (`Sid`),
  ADD KEY `Course_id_idx` (`Course_id`),
  ADD KEY `Class_id_idx` (`Class_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`Sclass`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `dept_idx` (`dept`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`depId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`Sid`),
  ADD UNIQUE KEY `Sclass_Srollno_UNIQUE` (`Sclass`,`Srollno`),
  ADD KEY `dept_idx` (`dept`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`Course_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `Course_name` (`Course_name`),
  ADD KEY `dept_idx` (`dept`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  ADD KEY `teachers_fk_department` (`dept`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocate_teacher`
--
ALTER TABLE `allocate_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allocate_teacher`
--
ALTER TABLE `allocate_teacher`
  ADD CONSTRAINT `allocate_teacher_fk_class` FOREIGN KEY (`Sclass`) REFERENCES `classes` (`Sclass`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `allocate_teacher_fk_subject` FOREIGN KEY (`Course_id`) REFERENCES `subjects` (`Course_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `allocate_teacher_fk_teacher` FOREIGN KEY (`tid`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_fk_class` FOREIGN KEY (`Class_id`) REFERENCES `classes` (`Sclass`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_fk_student` FOREIGN KEY (`Sid`) REFERENCES `students` (`Sid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_fk_subject` FOREIGN KEY (`Course_id`) REFERENCES `subjects` (`Course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`dept`) REFERENCES `department` (`depId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_fk_department` FOREIGN KEY (`dept`) REFERENCES `department` (`depId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`Sclass`) REFERENCES `classes` (`Sclass`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_fk_department` FOREIGN KEY (`dept`) REFERENCES `department` (`depId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_fk_department` FOREIGN KEY (`dept`) REFERENCES `department` (`depId`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
