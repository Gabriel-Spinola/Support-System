-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2021 at 05:07 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_support_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_calls`
--

CREATE TABLE `tb_calls` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_calls`
--

INSERT INTO `tb_calls` (`id`, `message`, `email`, `token`) VALUES
(18, 'Can you help me?', 'sampleemail7000@gmail.com', '9926ba70994e97900ec97ba103c1f89e');

-- --------------------------------------------------------

--
-- Table structure for table `tb_call_answer`
--

CREATE TABLE `tb_call_answer` (
  `id` int(11) NOT NULL,
  `call_id` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_call_answer`
--

INSERT INTO `tb_call_answer` (`id`, `call_id`, `message`, `position`, `status`) VALUES
(28, '9926ba70994e97900ec97ba103c1f89e', 'Sure! Lorem Ipsum', 1, 1),
(29, '9926ba70994e97900ec97ba103c1f89e', 'But how I Lorem Ipsum', -1, 1),
(30, '9926ba70994e97900ec97ba103c1f89e', 'Just goes to', 1, 1),
(31, '9926ba70994e97900ec97ba103c1f89e', 'it\'s not working ):', -1, 1),
(32, '9926ba70994e97900ec97ba103c1f89e', 'What?', 1, 1),
(33, '9926ba70994e97900ec97ba103c1f89e', 'oops', -1, 1),
(34, '9926ba70994e97900ec97ba103c1f89e', 'oops', 1, 1),
(35, '9926ba70994e97900ec97ba103c1f89e', 'testing email', -1, 1),
(36, '9926ba70994e97900ec97ba103c1f89e', 'testing email', 1, 1),
(37, '9926ba70994e97900ec97ba103c1f89e', 'testing email', 1, 1),
(38, '9926ba70994e97900ec97ba103c1f89e', 'Works!', -1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_calls`
--
ALTER TABLE `tb_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_call_answer`
--
ALTER TABLE `tb_call_answer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_calls`
--
ALTER TABLE `tb_calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_call_answer`
--
ALTER TABLE `tb_call_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
