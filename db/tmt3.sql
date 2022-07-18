-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2022 at 10:46 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmt3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(50) NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `username`, `password`, `email`, `company`, `img`) VALUES
(1, 'Admin', 'admin@123', 'admin565@gmail.com', 'SCET (MCA)', '99695.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `eid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(11) DEFAULT NULL,
  `gender` varchar(20) NOT NULL,
  `role` int(11) NOT NULL,
  `jdate` date NOT NULL,
  `bdate` date DEFAULT NULL,
  `age` int(10) NOT NULL,
  `exp` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(10) DEFAULT NULL,
  `status2` int(10) NOT NULL,
  `img` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eid`, `name`, `email`, `mobile`, `gender`, `role`, `jdate`, `bdate`, `age`, `exp`, `username`, `password`, `description`, `status`, `status2`, `img`) VALUES
(23, 'Kushang Rathod G.', 'kushang8998@gmail.com', NULL, 'male', 1, '2021-09-01', NULL, 0, 0, 'kushang5195', 'kushang5195', '-', 0, 0, NULL),
(24, 'Jay Virani', 'jayvirani.mca21@scet.ac.in', NULL, 'male', 3, '2021-12-01', NULL, 0, 0, 'Jay1211', 'Jay1211', '-', 1, 0, NULL),
(25, 'Avi gajera', 'avigajera.mca21@scet.ac.in', NULL, 'male', 3, '2022-01-01', NULL, 0, 0, 'Avi9585', 'Avi9585', '-', 1, 1, NULL),
(26, 'john', 'kushangrathod5@gmail.com', NULL, 'male', 1, '2021-12-01', NULL, 0, 0, 'john3628', 'john3628', '-', 0, 0, NULL),
(27, 'vicky', 'kushangrathod5@gmail.com', NULL, 'male', 3, '2022-02-04', NULL, 0, 0, 'vicky7520', 'vicky7520', '-', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `otp_tab`
--

CREATE TABLE `otp_tab` (
  `id` int(11) NOT NULL,
  `otp` int(20) NOT NULL,
  `eid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otp_tab`
--

INSERT INTO `otp_tab` (`id`, `otp`, `eid`) VALUES
(1, 3613, 23);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `pid` int(11) NOT NULL,
  `pkey` varchar(10) DEFAULT NULL,
  `pname` varchar(100) NOT NULL,
  `ptype` varchar(100) NOT NULL,
  `pdec` varchar(500) NOT NULL,
  `cdate` date NOT NULL,
  `priority` int(10) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`pid`, `pkey`, `pname`, `ptype`, `pdec`, `cdate`, `priority`, `status`) VALUES
(9, 'P101', 'money tracker', 'finanace project', '<p>this is our financial projects</p>', '2022-02-09', 1, 2),
(10, 'P102', 'bank system', 'finanace project', '<p>create bank system</p>', '2022-02-09', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `project_assign`
--

CREATE TABLE `project_assign` (
  `paid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `eid` int(11) DEFAULT NULL,
  `sdate` date DEFAULT NULL,
  `edate` date DEFAULT NULL,
  `status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_assign`
--

INSERT INTO `project_assign` (`paid`, `pid`, `eid`, `sdate`, `edate`, `status`) VALUES
(14, 9, 23, '2022-02-09', '2022-02-28', 2),
(15, 10, 23, '2022-02-01', '2022-03-02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `project_issue`
--

CREATE TABLE `project_issue` (
  `psid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `issue` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_issue`
--

INSERT INTO `project_issue` (`psid`, `pid`, `issue`) VALUES
(7, 9, 'projects 1 issue');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `tname` varchar(200) NOT NULL,
  `tdec` varchar(500) NOT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `tpriority` int(10) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`tid`, `pid`, `eid`, `tname`, `tdec`, `sdate`, `edate`, `tpriority`, `status`) VALUES
(14, 9, 25, 'Task 1', '<p>task 1</p>', '2022-02-09', '2022-02-11', 2, 1),
(15, 10, 25, 'task 1 bank login', '<p>task 1</p>', '2022-02-09', '2022-02-12', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_issue`
--

CREATE TABLE `task_issue` (
  `tsid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `issue` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `tid` int(11) NOT NULL,
  `tname` varchar(50) NOT NULL,
  `manager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`tid`, `tname`, `manager`) VALUES
(13, 'Front end team', 23);

-- --------------------------------------------------------

--
-- Table structure for table `team_member`
--

CREATE TABLE `team_member` (
  `tmid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `eid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_member`
--

INSERT INTO `team_member` (`tmid`, `tid`, `eid`) VALUES
(25, 13, 25),
(27, 13, 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `otp_tab`
--
ALTER TABLE `otp_tab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `project_assign`
--
ALTER TABLE `project_assign`
  ADD PRIMARY KEY (`paid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `eid_assign` (`eid`);

--
-- Indexes for table `project_issue`
--
ALTER TABLE `project_issue`
  ADD PRIMARY KEY (`psid`),
  ADD KEY `pid_issue` (`pid`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `pid_task` (`pid`),
  ADD KEY `eid_task` (`eid`);

--
-- Indexes for table `task_issue`
--
ALTER TABLE `task_issue`
  ADD PRIMARY KEY (`tsid`),
  ADD KEY `tid_issue` (`tid`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `team_member`
--
ALTER TABLE `team_member`
  ADD PRIMARY KEY (`tmid`),
  ADD KEY `eid_member` (`eid`),
  ADD KEY `tid_member` (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `otp_tab`
--
ALTER TABLE `otp_tab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project_assign`
--
ALTER TABLE `project_assign`
  MODIFY `paid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `project_issue`
--
ALTER TABLE `project_issue`
  MODIFY `psid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `task_issue`
--
ALTER TABLE `task_issue`
  MODIFY `tsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `team_member`
--
ALTER TABLE `team_member`
  MODIFY `tmid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project_assign`
--
ALTER TABLE `project_assign`
  ADD CONSTRAINT `eid_assign` FOREIGN KEY (`eid`) REFERENCES `employee` (`eid`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `pid` FOREIGN KEY (`pid`) REFERENCES `project` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_issue`
--
ALTER TABLE `project_issue`
  ADD CONSTRAINT `pid_issue` FOREIGN KEY (`pid`) REFERENCES `project` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `eid_task` FOREIGN KEY (`eid`) REFERENCES `employee` (`eid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pid_task` FOREIGN KEY (`pid`) REFERENCES `project` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_issue`
--
ALTER TABLE `task_issue`
  ADD CONSTRAINT `tid_issue` FOREIGN KEY (`tid`) REFERENCES `task` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team_member`
--
ALTER TABLE `team_member`
  ADD CONSTRAINT `eid_member` FOREIGN KEY (`eid`) REFERENCES `employee` (`eid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tid_member` FOREIGN KEY (`tid`) REFERENCES `team` (`tid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
