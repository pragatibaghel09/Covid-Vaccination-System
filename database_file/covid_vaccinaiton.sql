-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2021 at 09:21 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaccine_record`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_security`
--

CREATE TABLE `admin_security` (
  `S.No.` int(6) NOT NULL,
  `PIN_Code` int(6) NOT NULL,
  `Centre_ID` varchar(10) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_security`
--

INSERT INTO `admin_security` (`S.No.`, `PIN_Code`, `Centre_ID`, `Password`) VALUES
(1, 452010, 'AH123', '$2y$10$68JXx5QxMvhCCy.8rwImMuw/qv2McCXDyzOaiHocdkgX/9OcuzEae'),
(2, 452011, 'SH0045', '$2y$10$eKbsBxC0.PYNwcSoX5kL2uY/1D7tFaL3UzboYiSWPoLdvtDmlv5/a');

-- --------------------------------------------------------

--
-- Table structure for table `dose_available`
--

CREATE TABLE `dose_available` (
  `Vaccine` varchar(15) NOT NULL,
  `injection` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dose_available`
--

INSERT INTO `dose_available` (`Vaccine`, `injection`) VALUES
('COVAXIN', 146),
('COVISHIELD', 100),
('SPUTNIK', 100);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `Reference_ID` int(6) NOT NULL,
  `First_Name` varchar(15) NOT NULL,
  `Last_Name` varchar(15) NOT NULL,
  `Address` varchar(40) NOT NULL,
  `Identity` varchar(20) NOT NULL,
  `Mobile_Number` bigint(10) NOT NULL,
  `Date_Of_Birth` date NOT NULL,
  `Age` int(5) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`Reference_ID`, `First_Name`, `Last_Name`, `Address`, `Identity`, `Mobile_Number`, `Date_Of_Birth`, `Age`, `Gender`, `Date`) VALUES
(1, 'XYZ', 'ABC', '111, Mahesh Guard Line,INDORE(M.P)', '594023516464', 8569745123, '1908-10-22', 20, 'Male', '2021-06-22 22:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_status`
--

CREATE TABLE `vaccination_status` (
  `Refer_ID` int(6) NOT NULL,
  `Identity` varchar(20) NOT NULL,
  `First_Dose` varchar(15) DEFAULT NULL,
  `first_date` date DEFAULT NULL,
  `Second_Dose` varchar(15) DEFAULT NULL,
  `second_date` date DEFAULT NULL,
  `vaccine_type` varchar(15) DEFAULT NULL,
  `vaccinated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccination_status`
--

INSERT INTO `vaccination_status` (`Refer_ID`, `Identity`, `First_Dose`, `first_date`, `Second_Dose`, `second_date`, `vaccine_type`, `vaccinated_by`) VALUES
(1, '594023516464', 'Success', '2021-06-22', 'Success', '2021-06-22', 'COVAXIN', 'DR. Tiwari');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_security`
--
ALTER TABLE `admin_security`
  ADD PRIMARY KEY (`S.No.`);

--
-- Indexes for table `dose_available`
--
ALTER TABLE `dose_available`
  ADD PRIMARY KEY (`Vaccine`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`Reference_ID`);

--
-- Indexes for table `vaccination_status`
--
ALTER TABLE `vaccination_status`
  ADD PRIMARY KEY (`Identity`),
  ADD KEY `vaccine_type` (`vaccine_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_security`
--
ALTER TABLE `admin_security`
  MODIFY `S.No.` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `Reference_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vaccination_status`
--
ALTER TABLE `vaccination_status`
  ADD CONSTRAINT `vaccination_status_ibfk_1` FOREIGN KEY (`vaccine_type`) REFERENCES `dose_available` (`Vaccine`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
