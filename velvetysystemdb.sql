-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2022 at 05:23 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `velvetysystemdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(25) NOT NULL,
  `emp_number` int(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `emp_number`, `first_name`, `last_name`, `job_title`, `password`) VALUES
(100, 441207813, 'Ali', 'Hamad', 'HR', '698d51a19d8a121ce581499d7b701668'),
(101, 442709890, 'Sara', 'Ahmed', 'IT', 'bcbe3365e6ac95ea2c0343a2395834dd'),
(102, 442200999, 'Lena', 'Saad', 'Data analysis ', '310dcbbf4cce62f762a2aaa148d556bd');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(25) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `first_name`, `last_name`, `username`, `password`) VALUES
(444, 'Mohamed', 'Ali', 'Moh_Ali', '550a141f12de6341fba65b0ad0433500');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(100) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `service_id` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `attachment1` varchar(100) NOT NULL,
  `attachment2` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=in progress,1=accepted, 2=Declined'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `emp_id`, `service_id`, `description`, `attachment1`, `attachment2`, `status`) VALUES
(1, '100', '1', 'I need ten days off due to family circumstances', '14419861.png', '', 0),
(2, '101', '2', 'I requested this to notify a third party.. Please look into it and thank you.', 'Party-Request-Form.webp', '14419861.png', 0),
(3, '102', '1', 'An emergency happened to me and I apologize for not attending today.. Please accept my apology.', 'Sick-leave-Application-for-School-Teacher-by-Parent.jpg', 'Leave-Authorization-Form.webp', 0),
(4, '102', '1', 'I contracted corona and for this reason I will not be able to attend for 14 days.', 'R.png', 'large.png', 2),
(5, '102', '2', 'CODE BROWN! We should hold a necessary meeting regarding this request. thankyou', 'RHC_Emergency_Codes.png', '', 1),
(6, '100', '2', 'The Employer agrees to provide notice to PSE of all records requests by third parties made pursuant to RCW 42.56 that request disclosure of the personal information of any group or classification of represented employees covered by this bargaining agreement.', 'Party-Request-Form.webp', 'Party-Request-Form (1).webp', 2),
(7, '100', '1', 'A technical conference was held in Switzerland and I am going to visit it.. so I need a vacation for a period of 5 days', 'VEM_Invitation-Technical-Conference.pdf', 'invitation.jpg', 1),
(8, '101', '1', 'I will take leave tomorrow afternoon due to a family circumstance.', 'large.png', 'Leave-Authorization-Form.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `type`) VALUES
(1, 'leave'),
(2, 'party');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_number` (`emp_number`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `job_title` (`job_title`),
  ADD KEY `password` (`password`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=445;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
