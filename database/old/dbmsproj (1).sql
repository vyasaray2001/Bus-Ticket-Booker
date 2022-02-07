-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2022 at 06:28 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmsproj`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingno` int(11) NOT NULL,
  `useremail` varchar(50) NOT NULL,
  `bname` varchar(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `nseats` int(11) NOT NULL,
  `totalprice` int(11) NOT NULL DEFAULT 0,
  `bprice` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `ustatus` varchar(20) NOT NULL DEFAULT 'cart'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingno`, `useremail`, `bname`, `date`, `nseats`, `totalprice`, `bprice`, `status`, `ustatus`) VALUES
(1003, 'vyas@gmail.com ', 'VRL(B1) ', '2022-01-24', 1, 2200, 2200, 'confirmed', 'uconfirm'),
(1004, 'vyas@gmail.com ', 'VRL(B1) ', '2022-01-24', 1, 2200, 2200, 'confirmed', 'uconfirm'),
(1005, 'vyas@gmail.com ', 'Sugama(A2)', '2022-01-24', 1, 2000, 2000, 'confirmed', 'uconfirm'),
(1006, 'vyas@gmail.com ', 'Reshma(K3)  ', '2022-01-24', 1, 900, 900, 'confirmed', 'uconfirm');

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `Busname` varchar(20) NOT NULL,
  `Bustype` varchar(20) NOT NULL,
  `Route` varchar(20) NOT NULL,
  `Price` int(11) NOT NULL,
  `Seats` int(11) NOT NULL DEFAULT 60,
  `Seatsused` int(11) NOT NULL,
  `Drivername` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`Busname`, `Bustype`, `Route`, `Price`, `Seats`, `Seatsused`, `Drivername`) VALUES
('Durgamba(A)', 'NonA/C', 'Karkala-Banglore', 1000, 60, 0, 'Rajesh'),
('Durgamba(B)', 'NonA/C', 'Banglore-Karkala', 1000, 60, 0, 'Ramesh'),
('Durgamba(C)', 'NonA/C', 'Banglore-Mysore', 1000, 60, 0, 'Suresh'),
('Reshma(K1)', 'NonA/C', 'Karkala-Banglore', 950, 60, 0, 'Rudra Kapadia'),
('Reshma(K2) ', 'NonA/C', 'Banglore-Karkala', 950, 60, 0, 'Kabir Ranga'),
('Reshma(K3) ', 'NonA/C', 'Banglore-Mysore', 900, 60, 0, 'Kanta Konda'),
('Sugama(A1)', 'A/C-Sleeper', 'Karkala-Banglore', 2000, 60, 0, 'Jai Balaa'),
('Sugama(A2)', 'A/C-Sleeper', 'Banglore-Karkala', 2000, 60, 0, 'Karthik Sur'),
('Sugama(A3)', 'A/C-Sleeper', 'Banglore-Mysore', 1800, 60, 0, 'Kalyan Goel'),
('Vishal(M1)', 'A/C-Seating', 'Karkala-Banglore', 1800, 60, 0, 'Sarvesh Gola'),
('Vishal(M2)', 'A/C-Seating', 'Banglore-Karkala', 1800, 60, 0, 'Rajesh Kummar'),
('Vishal(M3)', 'A/C-Seating', 'Banglore-Mysore', 1600, 60, 0, 'Nishant Khosla'),
('VRL(B1) ', 'A/C-Sleeper', 'Karkala-Banglore', 2300, 60, 0, 'Prasad Dhaliwal'),
('VRL(B2) ', 'A/C-Sleeper', 'Banglore-Karkala', 2200, 60, 0, 'Lalit Manne'),
('VRL(B3) ', 'A/C-Sleeper', 'Banglore-Mysore', 2000, 60, 0, 'Madhur Arora');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `srno` int(11) NOT NULL,
  `topic` varchar(20) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `time` date NOT NULL,
  `user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`srno`, `topic`, `comment`, `time`, `user`) VALUES
(1, 'Over All Experience', 'Very Good Recommended', '2022-01-15', 'vyas@gmail.com'),
(6, 'Bus Beds', 'Can Be Improved', '2022-01-24', 'vyas@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `Routename` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`Routename`) VALUES
('Banglore-Karkala'),
('Banglore-Mysore'),
('Karkala-Banglore');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Fullname` varchar(20) NOT NULL,
  `Mobileno` bigint(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `type` varchar(5) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Fullname`, `Mobileno`, `Email`, `Password`, `type`) VALUES
('admin', 0, 'admi@ad.com', '123', 'admin'),
('Bharat Yadav ', 981499389, 'BharatYad@gmail.com', '123', 'user'),
('Dipti Keer  ', 8051175981, 'DiptiKeer@gmail.com', '123', 'user'),
('Jobin Tripathi  ', 987499388, 'JobinTripa@gmail.com', '123', 'user'),
('Krishna Shah ', 981499388, 'KrishnaSh@gmail.com', '123', 'user'),
('Leelawati Trivedi  ', 8641662333, 'Leelawati @gmail.com', '123', 'user'),
('Mukul Chandra  ', 980499388, 'MukulChan@gmail.com', '123', 'user'),
('Ragavendra ', 9108940481, 'ragaverdra@gmail.com', '123', 'user'),
('Vyaskk ', 1651651656, 'vyas1@gmail.com', '123', 'user'),
('Vyasaray Kamath  ', 8296294737, 'vyas@gmail.com', '123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingno`),
  ADD KEY `useremail` (`useremail`),
  ADD KEY `bname` (`bname`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`Busname`),
  ADD KEY `foreignkeyroute` (`Route`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`srno`),
  ADD KEY `foreignkeyuser` (`user`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`Routename`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`useremail`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`bname`) REFERENCES `bus` (`Busname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `foreignkeyroute` FOREIGN KEY (`Route`) REFERENCES `routes` (`Routename`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `foreignkeyuser` FOREIGN KEY (`user`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
