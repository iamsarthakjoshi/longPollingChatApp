-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 04, 2016 at 06:30 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `longpollingchatapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `role` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email_id`, `fullname`, `role`, `semester`, `description`, `active`) VALUES
(1, 'sarthak', '0b9ac4df8b07fa551bcc9f97ec8256b6', 'sarthak@live.com', 'Sarthak Joshi', 'Student', 'bscit_l6s2', 'Student', 1),
(2, 'test', '098f6bcd4621d373cade4e832627b4f6', 'admin@gmail.com', 'Administrator', 'Staff', '', 'Staff', 1),
(3, 'sagar', '0b9ac4df8b07fa551bcc9f97ec8256b6', 'random@live.com', 'Random Shrestha', 'Student', 'bscit_l6s2', 'Student', 1),
(4, 'sachetpun', 'f7bdb2d3c50132114eb66de0338f4651', 'sachetpun@live.com', 'Sachet Gurung', 'Student', 'bscit_l6s1', 'Student', 1),
(5, 'bplv', 'f7bdb2d3c50132114eb66de0338f4651', 'bplv@live.com', 'Biplav Subedi', 'Student', 'bscit_l6s1', 'Student', 1),
(6, 'sandeep_tbc', '41c4a83ef9fa543c4df9ba916d756248', 'sandeepstha@tbc.edu.np', 'Sandeep Shrestha', 'Staff', '', 'PHP Tutor', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;