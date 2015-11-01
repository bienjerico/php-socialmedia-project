-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2015 at 04:03 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpprojectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL,
  `emailaddress` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobilenumber` varchar(11) NOT NULL,
  `landlinenumner` varchar(50) NOT NULL,
  `is_admin` int(1) NOT NULL COMMENT '0 - guest , 1 - admin ',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `gender`, `birthday`, `age`, `emailaddress`, `address`, `mobilenumber`, `landlinenumner`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'user', 'admin', '', '', '', '', '0000-00-00', 0, '', '', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'admin', 'admin', '', '', '', '', '0000-00-00', 0, '', '', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'admin', 'admin', '', '', '', '', '0000-00-00', 0, '', '', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'admin', 'admin', '', '', '', '', '0000-00-00', 0, '', '', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'admin', 'admin', '', '', '', '', '0000-00-00', 0, '', '', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'bien', '67d6c28fac7541d9ce1f46ba4f84e149', '', '', '', '', '0000-00-00', 0, '', '', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'testing', 'ae2b1fca515949e5d54fb22b8ed95575', '', '', '', '', '0000-00-00', 0, '', '', '', '', 1, '2015-11-01 20:03:16', '2015-11-01 20:03:16'),
(8, 'bienjerico', '827ccb0eea8a706c4c34a16891f84e7b', 'bien', 'perez', 'cueto', 'male', '1991-08-01', 23, 'bien.jerico@gmail.com', 'munti', '09177168438', '', 0, '2015-11-01 21:22:21', '2015-11-01 22:41:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
