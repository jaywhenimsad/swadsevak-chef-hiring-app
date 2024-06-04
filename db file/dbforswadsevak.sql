-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 08:24 AM
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
-- Database: `new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `email`, `created_at`) VALUES
(2, 'admin1', 'admin123', 'admin@swadsevak', '2024-04-24 20:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `auser`
--

CREATE TABLE `auser` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(12) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(16) NOT NULL,
  `cpassword` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auser`
--

INSERT INTO `auser` (`id`, `name`, `email`, `mobile`, `address`, `password`, `cpassword`) VALUES
(6, 'Jay', 'email@123', 7878787878, 'Narhe', '12345678', '12345678'),
(7, 'Rupali', 'email@813', 8787878787, 'Mangalwar Peth', '12345678', '12345678'),
(8, 'tejas', 'tejas@123', 7878787878, 'Vagaon Budruk', '12345678', '12345678'),
(9, 'Jay Rangari ', 'jayrangari78@gmail.com', 8668700378, 'Jadhav Nagar', 'Jaikumar@123', 'Jaikumar@123');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `email`, `post_id`, `status`, `created_at`) VALUES
(1, 'email@123', 8, 'cancelled', '2024-04-25 11:13:00'),
(2, 'email@123', 8, 'cancelled', '2024-04-25 11:18:00'),
(3, 'email@123', 8, 'cancelled', '2024-04-25 11:20:20'),
(4, 'email@123', 9, 'cancelled', '2024-04-25 11:48:27'),
(5, 'email@813', 9, 'cancelled', '2024-04-25 12:15:40'),
(6, 'email@813', 8, '', '2024-04-25 12:20:23'),
(9, 'email@123', 10, '', '2024-04-28 17:43:27'),
(10, 'tejas@123', 10, '', '2024-05-02 07:20:39'),
(11, 'tejas@123', 9, '', '2024-05-02 08:14:28'),
(12, 'tejas@123', 8, '', '2024-05-05 09:30:08'),
(13, 'jayrangari78@gmail.com', 9, 'cancelled', '2024-05-26 06:28:48'),
(14, 'jayrangari78@gmail.com', 11, '', '2024-05-26 06:40:05'),
(15, 'jayrangari78@gmail.com', 8, '', '2024-05-28 07:03:55');

-- --------------------------------------------------------

--
-- Table structure for table `chef`
--

CREATE TABLE `chef` (
  `chef_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(16) NOT NULL,
  `cpassword` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chef`
--

INSERT INTO `chef` (`chef_id`, `name`, `email`, `mobile`, `address`, `password`, `cpassword`) VALUES
(1, 'Jay123', 'jayrangari78@gmail.com', 9898989898, 'Kalyani Nagar', '12345678', '12345678'),
(2, 'Succhi Javlekar', 'suchi@cook.com', 7878787878, 'MagarpattaCity', '12345678', '12345678'),
(3, 'Rupali', 'chef3@swadsevak.com', 8668700456, 'Karve Nagar', '12345678', '12345678'),
(5, 'jatin@swadsevak', 'jatin@swadsevak', 8444344423, 'Lohgaon', 'jatin123', 'jatin123'),
(6, 'anand', 'anandkate@cook', 9898989898, 'Vagaon Budruk', 'pass@1234', 'pass@1234');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Jay Rangari', 'email@123', 'Make you\'re interface more better', '2024-04-26 07:42:44'),
(2, 'Aniket', 'aniketjadhav@123', 'Make you\'re user interface more friendly ', '2024-05-26 06:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `booking_id`, `amount`, `status`, `payment_method`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 6, 40000.00, 'paid', 'cash', NULL, '2024-04-25 19:44:13', '2024-04-25 19:44:13'),
(2, 6, 40000.00, 'paid', 'cash', NULL, '2024-04-25 19:47:33', '2024-04-25 19:47:33'),
(3, 9, 50000.00, 'paid', 'cash', NULL, '2024-04-28 17:46:15', '2024-04-28 17:46:15'),
(4, 10, 50000.00, 'paid', 'cash', NULL, '2024-05-02 08:13:19', '2024-05-02 08:13:19'),
(5, 11, 40000.00, 'paid', 'cash', NULL, '2024-05-05 09:30:59', '2024-05-05 09:30:59'),
(6, 12, 40000.00, 'paid', 'cash', NULL, '2024-05-23 14:42:47', '2024-05-23 14:42:47'),
(7, 14, 16000.00, 'paid', 'cash', NULL, '2024-05-26 06:43:20', '2024-05-26 06:43:20'),
(8, 15, 40000.00, 'paid', 'cash', NULL, '2024-05-28 07:05:23', '2024-05-28 07:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `speciality` varchar(100) NOT NULL,
  `chef_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `price`, `speciality`, `chef_id`, `status`, `date_posted`) VALUES
(8, 'Hotel Chef', 'Available 9am to 5pm', 40000.00, 'Spanish, Continental, Indian & Chinese', 2, 'approved', '2024-04-24 21:01:07'),
(9, 'Party Cook', 'Available', 40000.00, 'Spanish, Continental, Indian & Chinese', 2, 'approved', '2024-04-24 21:20:01'),
(10, 'Party Cook', 'Available For Weddings and Pre-Weddings Order, Fulltime', 50000.00, 'Indian', 1, 'approved', '2024-04-28 17:40:52'),
(11, 'Home/Party Cook ', 'Part-time, available on 28th may, 9am to 2pm.', 16000.00, 'Indian, Continental ', 2, 'approved', '2024-05-26 06:37:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `auser`
--
ALTER TABLE `auser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `email` (`email`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `chef`
--
ALTER TABLE `chef`
  ADD PRIMARY KEY (`chef_id`),
  ADD KEY `idx_chef_id` (`chef_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chef_id` (`chef_id`),
  ADD KEY `idx_post_id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auser`
--
ALTER TABLE `auser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `chef`
--
ALTER TABLE `chef`
  MODIFY `chef_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`email`) REFERENCES `auser` (`email`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`chef_id`) REFERENCES `chef` (`chef_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
