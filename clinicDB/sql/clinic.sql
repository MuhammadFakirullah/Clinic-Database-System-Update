-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 31, 2023 at 02:35 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_name`, `admin_image`) VALUES
(1, 'admin', 'admin123', 'Muhammad Fakirullah Mohd Adnan', 'profileImage/ai photo.png');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `an_id` int(11) NOT NULL,
  `an_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`an_id`, `an_text`) VALUES
(1, '<p><strong>Dear colleagues</strong>,</p>\r\n\r\n<p>We are thrilled to announce an exciting new addition to our workplace - the installation of a state-of-the-art coffee machine in the breakroom! We understand that coffee plays a vital role in keeping our team energized and motivated, and this new machine promises to deliver an array of gourmet coffee options to suit every palate. From rich espresso to creamy cappuccinos, and even soothing herbal teas, this machine has it all. We hope that this will not only boost your productivity but also serve as a gathering point for informal discussions and collaboration. So, whether you&#39;re a coffee connoisseur or simply in need of a caffeine pick-me-up, stop by the breakroom and savor a cup of freshly brewed goodness. Enjoy your coffee moments and keep up the fantastic work!&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doc_id` int(11) NOT NULL,
  `doc_username` varchar(255) NOT NULL,
  `doc_password` varchar(255) NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  `doc_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doc_id`, `doc_username`, `doc_password`, `doc_name`, `doc_image`) VALUES
(1, 'Rahmat@gmail.com', 'rahmat123', 'Rahmat', 'profileImage/ecommerce.png'),
(2, 'test1', 'test123', 'test', 'profileImage/rain.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `front`
--

CREATE TABLE `front` (
  `front_id` int(11) NOT NULL,
  `front_username` varchar(255) NOT NULL,
  `front_password` varchar(255) NOT NULL,
  `front_name` varchar(255) NOT NULL,
  `front_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `front`
--

INSERT INTO `front` (`front_id`, `front_username`, `front_password`, `front_name`, `front_image`) VALUES
(3, 'PC1@gmail.com', 'best123', 'PC1', 'profileImage/ai_photo.png'),
(4, 'PC2@gmail.com', 'front123', 'PC2', 'profileImage/rain.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icno` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `diagnose_status` varchar(255) NOT NULL,
  `appointment_status` varchar(255) NOT NULL,
  `appointmentDateTime` varchar(255) NOT NULL,
  `medicinePrescription` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `icno`, `phone_no`, `timestamp`, `address`, `gender`, `diagnose_status`, `appointment_status`, `appointmentDateTime`, `medicinePrescription`, `total_price`, `payment_status`) VALUES
(24, 'Salmah', '3453432535', '5463435235', '2023-09-26T11:30', 'Lot 19 Jalan Ahmadiah', 'Female', 'fewfef', 'Yes', '2023-10-03T17:07', 'paracetamol', '230', 'Paid'),
(25, 'Rizal', '3493489127', '0221434523', '2023-10-04T09:45', 'Jalan Wong Ah Jang, Kuantan, Pahang', 'Male', 'Sakit pinggang', 'No', '2023-10-07T01:22', 'Ubat sakit pinggang', '110', 'Paid'),
(26, 'Imran', '739698120', '235325422', '2023-10-04T14:50', 'Jalan Sultan Ismail, 20000 K.Trg', 'Male', 'Batuk', 'No', '2023-10-11T02:25', 'Ubat batuk', '20', 'Paid'),
(27, 'Suhana', '639470232', '324325089', '2023-10-05T18:09', 'Kampung Seberang Takir', 'Female', '', '', '', '', '', '0'),
(28, 'Akmal', '4653255323', '6563243253', '2023-10-05T19:32', 'Jalan road off 19, Pekan ', 'Male', '', '', '', '', '', '0'),
(29, 'Ah Cong', '435346436', '346436436', '2023-10-05T19:32', 'Bukit Damai', 'Male', '', '', '', '', '', '0'),
(30, 'Arizal', '4533235235', '3464353231', '2023-10-06T00:08', 'Jalan Dato\' Bahaman', 'Male', '', '', '', '', '', '0'),
(33, 'Sulaiman ', '3453324325', '4535635224', '2023-10-06T17:38', 'Kampung Seberang Takir', 'Male', 'Eyeball itch', 'No', '2023-10-07T07:29', 'Cleaning', '50', 'Not paid'),
(34, 'Syafika', '634534432', '534122146', '2023-10-07T07:31', 'Jalan Kamaruddin, K. Trg', 'Female', 'Fever, Flu wqdfwefwqfefwqf efqfewfqefefefefqwfwq', 'No', '2023-10-07T07:31', 'Paracetamol, antibiotic, ubat flu', '90', 'Not paid'),
(35, 'Liu Chang', '543421443', '566533325', '2023-10-07T07:39', 'Perkampungan Cina ', 'Female', 'csaljcbdoid lkADNDIPCN NWIDWNXO', 'No', '2023-10-10T17:14', 'AWQNICBDO', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `pharmacy_id` int(11) NOT NULL,
  `pharmacy_username` varchar(255) NOT NULL,
  `pharmacy_password` varchar(255) NOT NULL,
  `pharmacy_name` varchar(255) NOT NULL,
  `pharmacy_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`pharmacy_id`, `pharmacy_username`, `pharmacy_password`, `pharmacy_name`, `pharmacy_image`) VALUES
(1, 'Ehsan@gmail.com', 'ehsan123', 'Ehsan', 'profileImage/person.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `description`, `image`) VALUES
(31, 'sample1', '65145f7a78b2d1695833978.jpg'),
(32, 'sample2', '65145f8703c0e1695833991.jpg'),
(33, 'sample3', '65145f92c68991695834002.jpg'),
(34, 'sample4', '65145f9decaee1695834013.jpg'),
(35, 'sample5', '65145faa82c4a1695834026.jpeg'),
(36, 'sample6', '65146843a4b991695836227.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `title`, `image`) VALUES
(0, 'Contoh 1', '651b8c3c91184_rain.jpg'),
(0, 'Contoh 1', '651b8e2b5751f_rain.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`an_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `front`
--
ALTER TABLE `front`
  ADD PRIMARY KEY (`front_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`pharmacy_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `an_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `front`
--
ALTER TABLE `front`
  MODIFY `front_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pharmacy`
--
ALTER TABLE `pharmacy`
  MODIFY `pharmacy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
