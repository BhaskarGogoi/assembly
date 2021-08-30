-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2021 at 05:25 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assembly`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `ans_id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `answer_type` varchar(6) NOT NULL,
  `submit_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`ans_id`, `q_id`, `answer`, `answer_type`, `submit_date`) VALUES
(25, 305, 'This is a reply to the question asked in assembly.', 'Text', '30-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `assembly_login`
--

CREATE TABLE `assembly_login` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assembly_login`
--

INSERT INTO `assembly_login` (`id`, `email`, `username`, `password`) VALUES
(1, 'test@test.com', 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `assembly_login_details`
--

CREATE TABLE `assembly_login_details` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `operating_system` varchar(20) NOT NULL,
  `browser` varchar(30) NOT NULL,
  `date` varchar(12) NOT NULL,
  `time` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assembly_login_details`
--

INSERT INTO `assembly_login_details` (`id`, `username`, `ip`, `operating_system`, `browser`, `date`, `time`) VALUES
(2, 'admin', '::1', 'Windows 8.1', 'Chrome', '17-03-2019', '10:49 pm'),
(3, 'admin', '::1', 'Windows 8.1', 'Firefox', '17-03-2019', '10:49 pm'),
(4, 'admin', '::1', 'Windows 8.1', 'Chrome', '17-03-2019', '10:50:25'),
(5, 'admin', '::1', 'Windows 8.1', 'Firefox', '17-03-2019', '10:51:15pm'),
(6, 'admin', '::1', 'Windows 8.1', 'Firefox', '17-03-2019', '10:51:34 p'),
(7, 'admin', '::1', 'Windows 8.1', 'Firefox', '17-03-2019', '10:51:58 pm'),
(8, 'admin', '::1', 'Windows 8.1', 'Firefox', '18-03-2019', '10:40:45 am'),
(9, 'admin', '::1', 'Windows 8.1', 'Firefox', '18-03-2019', '07:20:15 pm'),
(10, 'admin', '::1', 'Windows 8.1', 'Firefox', '19-03-2019', '10:33:24 am'),
(11, 'admin', '::1', 'Windows 8.1', 'Firefox', '19-03-2019', '12:05:30 pm'),
(12, 'admin', '::1', 'Windows 8.1', 'Firefox', '19-03-2019', '12:37:06 pm'),
(13, 'admin', '::1', 'Windows 8.1', 'Firefox', '19-03-2019', '12:58:36 pm'),
(14, 'admin', '::1', 'Windows 8.1', 'Chrome', '19-03-2019', '05:35:22 pm'),
(15, 'admin', '::1', 'Windows 8.1', 'Firefox', '26-03-2019', '08:36:28 pm'),
(16, 'admin', '::1', 'Windows 8.1', 'Firefox', '30-04-2019', '07:34:11 pm'),
(17, 'admin', '::1', 'Windows 8.1', 'Firefox', '30-04-2019', '07:37:21 pm'),
(18, 'admin', '::1', 'Windows 8.1', 'Firefox', '30-04-2019', '09:16:27 pm'),
(19, 'admin', '::1', 'Windows 8.1', 'Chrome', '01-05-2019', '06:12:57 pm'),
(20, 'admin', '::1', 'Windows 8.1', 'Chrome', '07-05-2019', '03:47:35 pm'),
(21, 'admin', '::1', 'Windows 8.1', 'Chrome', '07-05-2019', '07:25:32 pm'),
(22, 'admin', '::1', 'Windows 8.1', 'Chrome', '07-05-2019', '08:50:30 pm'),
(23, 'admin', '::1', 'Windows 8.1', 'Chrome', '07-05-2019', '08:51:34 pm'),
(24, 'admin', '::1', 'Windows 8.1', 'Firefox', '07-05-2019', '09:45:47 pm'),
(25, 'admin', '::1', 'Windows 8.1', 'Firefox', '07-05-2019', '09:47:11 pm'),
(26, 'admin', '::1', 'Windows 8.1', 'Firefox', '07-05-2019', '10:21:30 pm'),
(27, 'admin', '::1', 'Windows 8.1', 'Chrome', '08-05-2019', '06:29:15 pm'),
(28, 'admin', '::1', 'Windows 8.1', 'Firefox', '08-05-2019', '06:33:48 pm'),
(29, 'admin', '::1', 'Windows 8.1', 'Firefox', '08-05-2019', '10:38:24 pm'),
(30, 'admin', '::1', 'Windows 8.1', 'Firefox', '08-05-2019', '11:35:30 pm'),
(31, 'admin', '::1', 'Windows 8.1', 'Firefox', '08-05-2019', '11:36:12 pm'),
(32, 'admin', '::1', 'Windows 8.1', 'Firefox', '08-05-2019', '11:42:47 pm'),
(33, 'admin', '::1', 'Windows 8.1', 'Firefox', '09-05-2019', '04:30:14 pm'),
(34, 'admin', '::1', 'Windows 8.1', 'Firefox', '09-05-2019', '04:53:45 pm'),
(35, 'admin', '::1', 'Windows 8.1', 'Firefox', '10-05-2019', '07:41:24 pm'),
(36, 'admin', '::1', 'Windows 8.1', 'Firefox', '13-05-2019', '07:33:11 pm'),
(37, 'admin', '::1', 'Windows 8.1', 'Firefox', '13-05-2019', '09:11:39 pm'),
(38, 'admin', '::1', 'Windows 8.1', 'Firefox', '13-05-2019', '10:24:41 pm'),
(39, 'admin', '::1', 'Windows 8.1', 'Firefox', '14-05-2019', '12:16:45 pm'),
(40, 'admin', '::1', 'Windows 8.1', 'Firefox', '14-05-2019', '06:32:26 pm'),
(41, 'admin', '::1', 'Windows 8.1', 'Chrome', '14-05-2019', '07:18:36 pm'),
(42, 'admin', '::1', 'Windows 8.1', 'Chrome', '14-05-2019', '10:11:09 pm'),
(43, 'admin', '::1', 'Windows 8.1', 'Chrome', '27-05-2019', '10:40:34 pm'),
(44, 'admin', '::1', 'Windows 8.1', 'Chrome', '27-05-2019', '11:00:51 pm'),
(45, 'admin', '::1', 'Windows 8.1', 'Chrome', '28-05-2019', '06:59:11 pm'),
(46, 'admin', '::1', 'Windows 8.1', 'Chrome', '04-06-2019', '08:58:46 pm'),
(47, 'admin', '::1', 'Windows 8.1', 'Chrome', '06-06-2019', '07:12:45 pm'),
(48, 'admin', '::1', 'Windows 8.1', 'Chrome', '06-06-2019', '07:14:51 pm'),
(49, 'admin', '::1', 'Windows 8.1', 'Firefox', '06-06-2019', '07:30:33 pm'),
(50, 'admin', '::1', 'Windows 8.1', 'Firefox', '06-06-2019', '08:24:27 pm'),
(51, 'admin', '::1', 'Windows 8.1', 'Chrome', '06-06-2019', '08:28:25 pm'),
(52, 'admin', '::1', 'Windows 8.1', 'Firefox', '06-06-2019', '08:50:56 pm'),
(53, 'admin', '::1', 'Windows 8.1', 'Firefox', '06-06-2019', '09:26:43 pm'),
(54, 'admin', '::1', 'Windows 8.1', 'Chrome', '06-06-2019', '09:49:15 pm'),
(55, 'admin', '::1', 'Windows 8.1', 'Chrome', '07-06-2019', '08:00:27 pm'),
(56, 'admin', '::1', 'Windows 8.1', 'Chrome', '07-06-2019', '08:26:04 pm'),
(57, 'admin', '::1', 'Windows 10', 'Chrome', '14-02-2021', '09:06:49 pm'),
(58, 'admin', '::1', 'Windows 10', 'Chrome', '30-08-2021', '07:30:50 pm'),
(59, 'admin', '::1', 'Windows 10', 'Chrome', '30-08-2021', '07:31:41 pm'),
(60, 'admin', '::1', 'Windows 10', 'Chrome', '30-08-2021', '07:47:55 pm'),
(61, 'admin', '::1', 'Windows 10', 'Chrome', '30-08-2021', '07:54:30 pm'),
(62, 'admin', '::1', 'Windows 10', 'Chrome', '30-08-2021', '08:30:14 pm'),
(63, 'admin', '::1', 'Windows 10', 'Chrome', '30-08-2021', '08:34:17 pm');

-- --------------------------------------------------------

--
-- Table structure for table `assembly_session`
--

CREATE TABLE `assembly_session` (
  `session_id` int(11) NOT NULL,
  `session_year` varchar(5) NOT NULL,
  `session_title` varchar(100) NOT NULL,
  `session_start_date` varchar(11) NOT NULL,
  `session_end_date` varchar(11) NOT NULL DEFAULT 'Live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assembly_session`
--

INSERT INTO `assembly_session` (`session_id`, `session_year`, `session_title`, `session_start_date`, `session_end_date`) VALUES
(1, '2019', 'AAS', '01-01-2019', '06-06-2019'),
(2, '2019', 'BUDGET SESSION', '04-03-2019', 'Live'),
(3, '2019', 'SAMPLE SESSION', '01-01-2019', 'Live');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_subject` varchar(200) NOT NULL,
  `complaint_details` text NOT NULL,
  `department_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `complaint_date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `complaint_subject`, `complaint_details`, `department_id`, `username`, `complaint_date`) VALUES
(12, 'This is a sample Complaint', 'This complaint is created by Transport Department Kamrup District Assam', 16, 'transport_kamrup', '30-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(110) NOT NULL,
  `inserted_date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `inserted_date`) VALUES
(1, 'AGRICULTURE', '02-02-2019'),
(2, 'ANIMAL HUSBANDRY &\r\nVETERINARY', '02-02-2019'),
(3, 'CHIEF ELECTORAL OFFICER', '02-02-2019'),
(4, 'CM\'S SECRETARIAT', '02-02-2019'),
(5, 'CHIEF SECRETARY\'S OFFICE', '03-02-2019'),
(6, 'CULTURAL AFFAIRS', '03-02-2019'),
(7, 'ELEMENTARY EDUCATION', '03-02-2019'),
(8, 'EXCISE DEPARTMENT', '03-02-2019'),
(9, 'FOREST AND ENVIRONMENT', '03-02-2019'),
(10, 'FINANCE', '03-02-2019'),
(11, 'FISHERY', '03-02-2019'),
(12, 'FOOD AND CIVIL SUPPLIES', '03-02-2019'),
(13, 'HEALTH & FAMILY WELFARE', '03-02-2019'),
(14, 'HIGHER EDUCATION\r\nDEPARTMENT', '03-02-2019'),
(15, 'POWER', '03-02-2019'),
(16, 'TRANSPORT', '03-02-2019'),
(17, 'IRRIGATION', '03-02-2019'),
(18, 'JUDICIAL DEPARTMENT', '03-02-2019'),
(19, 'TOURISM DEPARTMENT', '03-02-2019'),
(20, 'SOCIAL WELFARE', '03-02-2019'),
(21, 'REVENUE & DISASTER MGMT', '03-02-2019');

-- --------------------------------------------------------

--
-- Table structure for table `department_login`
--

CREATE TABLE `department_login` (
  `ID` int(11) NOT NULL,
  `Dept_ID` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` text NOT NULL,
  `ph_no` varchar(12) NOT NULL,
  `District` varchar(50) NOT NULL,
  `registered_date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_login`
--

INSERT INTO `department_login` (`ID`, `Dept_ID`, `Email`, `Username`, `Password`, `ph_no`, `District`, `registered_date`) VALUES
(28, 1, 'agriculture@gmaol.com', 'agriculture_baksa', '$2y$10$iJSjkw3UUCDW5DtdhTkYj.wq76MDFzmBkaUWxoCw0pxhhVIM3OI2a', '1234567890', '1', '10-08-2020'),
(29, 10, 'finance@gmail.com', 'finance_golaghat', '$2y$10$N9GCpBEPCmHwsZTVtVf0R.j5jOWenvCJsTTZm0b.1zUTqvvt9.fee', '7894561230', '14', '15-05-2020'),
(30, 15, 'power@gmail.com', 'power_jorhat', '$2y$10$hYe7sWmaXfPzB6oWvrZHgeaIJVcfwqnndNkwQ7REEJYZgIRok/YQW', '6543219878', '17', '01-02-2020'),
(31, 12, 'food@gmail.com', 'food_sivsagar', '$2y$10$PrA5mWHAegWfA5ocA5zL1.TmkQZIR3FjCHb1uiexzOIhnhthH0/sO', '4562587946', '32', '12-08-2021'),
(32, 16, 'transport@gmail.com', 'transport_kamrup', '$2y$10$LOn2Dc9a7V58QWQJdinnkOqUQks7okqwQL/eGvYLmwAeQl9.HCYty', '6543219875', '18', '30-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `department_login_details`
--

CREATE TABLE `department_login_details` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `operating_system` varchar(30) NOT NULL,
  `browser` varchar(30) NOT NULL,
  `date` varchar(15) NOT NULL,
  `time` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_login_details`
--

INSERT INTO `department_login_details` (`id`, `username`, `ip`, `operating_system`, `browser`, `date`, `time`) VALUES
(27, 'power_jorhat', '::1', 'Windows 10', 'Chrome', '30-08-2021', '08:33:33 pm'),
(28, 'power_jorhat', '::1', 'Windows 10', 'Chrome', '30-08-2021', '08:33:54 pm'),
(29, 'food_sivsagar', '::1', 'Windows 10', 'Chrome', '30-08-2021', '08:45:36 pm'),
(30, 'transport_kamrup', '::1', 'Windows 10', 'Chrome', '30-08-2021', '08:50:17 pm');

-- --------------------------------------------------------

--
-- Table structure for table `department_profile_settings`
--

CREATE TABLE `department_profile_settings` (
  `dept_settings_id` int(11) NOT NULL,
  `dept_username` varchar(50) NOT NULL,
  `email_notification` varchar(5) NOT NULL DEFAULT 'Off',
  `sms_notification` varchar(5) NOT NULL DEFAULT 'Off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_profile_settings`
--

INSERT INTO `department_profile_settings` (`dept_settings_id`, `dept_username`, `email_notification`, `sms_notification`) VALUES
(14, 'agriculture_baksa', 'Off', 'Off'),
(15, 'finance_golaghat', 'Off', 'Off'),
(16, 'power_jorhat', 'Off', 'Off'),
(17, 'food_sivsagar', 'Off', 'Off'),
(18, 'transport_kamrup', 'Off', 'Off');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `district_name`) VALUES
(1, 'Baksa'),
(2, 'Barpeta'),
(3, 'Biswanath'),
(4, 'Bongaigaon'),
(5, 'Cachar'),
(6, 'Charaideo'),
(7, 'Chirang'),
(8, 'Darrang'),
(9, 'Dhemaji'),
(10, 'Dhubri'),
(11, 'Dibrugarh'),
(12, 'Dima Hasao (North Cachar Hills)'),
(13, 'Goalpara'),
(14, 'Golaghat'),
(15, 'Hailakandi'),
(16, 'Hojai'),
(17, 'Jorhat'),
(18, 'Kamrup'),
(19, 'Kamrup Metropolitan'),
(20, 'Karbi Anglong'),
(21, 'Karimganj'),
(22, 'Kokrajhar'),
(23, 'Lakhimpur'),
(24, 'Majuli'),
(25, 'Morigaon'),
(26, 'Nagaon'),
(27, 'Nalbari'),
(28, 'South Salamara-Mankachar'),
(29, 'Tinsukia'),
(30, 'Udalguri'),
(31, 'West Karbi Anglong'),
(32, 'Sivasagar'),
(33, 'Sonitpur');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `party_affiliation` varchar(50) NOT NULL,
  `assembly_constituency_no` int(11) NOT NULL,
  `assembly_constituency_name` varchar(50) NOT NULL,
  `member_type` varchar(5) NOT NULL,
  `questions_asked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `firstname`, `lastname`, `party_affiliation`, `assembly_constituency_no`, `assembly_constituency_name`, `member_type`, `questions_asked`) VALUES
(1, 'KRIPANATH', 'MALLAH', 'BHARATIYA JANATA PARTY', 1, 'RATABARI (SC)', 'MLA', 0),
(2, 'KRISHNENDU', 'PAUL', 'BHARATIYA JANATA PARTY', 2, 'PATHARKANDI', 'MLA', 7),
(3, 'HIMANTA BISWA', 'SARMA', 'BHARATIYA JANATA PARTY', 51, 'JALUKBARI', 'MLA', 18),
(4, 'HITENDRA NATH', 'GOSWAMI', 'BHARATIYA JANATA PARTY', 98, 'JORHAT', 'MLA', 0),
(5, 'MRINAL', 'SAIKIA', 'BHARATIYA JANATA PARTY', 96, 'KHUMTAI', 'MLA', 1),
(6, 'AJANTA', 'NEOG', 'INDIAN NATIONAL CONGRESS', 95, 'GOLAGHAT', 'MLA', 14),
(7, 'TARUN', 'GOGOI', 'INDIAN NATIONAL CONGRESS', 100, 'TITABOR', 'MLA', 0),
(8, 'DILIP KUMAR', 'PAUL', 'BHARATIYA JANATA PARTY', 9, 'SILCHAR', 'MLA', 1),
(9, 'KISHOR', 'NATH', 'BHARATIYA JANATA PARTY', 14, 'BARKHOLA', 'MLA', 11),
(10, 'PHANI BHUSAN', 'CHOUDHURY', 'ASOM GANA PARISHAD', 32, 'BONGAIGAON', 'MLA', 6),
(11, 'PABINDRA', 'DEKA', 'ASOM GANA PARISHAD', 42, 'PATACHARKUCHI', 'MLA', 2),
(12, 'GUNINDRA NATH', 'DAS', 'ASOM GANA PARISHAD', 43, 'BARPETA', 'MLA', 2);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `q_id` int(11) NOT NULL,
  `subject` text CHARACTER SET utf8 NOT NULL,
  `assembly_question_no` int(11) NOT NULL,
  `file_no` varchar(11) NOT NULL,
  `question` text CHARACTER SET utf8 NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `district` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `askedOn` varchar(12) NOT NULL,
  `due_date` varchar(20) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`q_id`, `subject`, `assembly_question_no`, `file_no`, `question`, `member_name`, `department`, `district`, `session`, `askedOn`, `due_date`, `status`) VALUES
(305, 'Test Question to Power Department Jorhat', 265, '112', 'Test Question to Power Department Jorhat Description', '5', '15', 17, 2, '30-08-2021', '11-06-2032', 'Yes'),
(306, 'Test Question to Social Welfare Baksa', 568, '657', 'Test Question to Social Welfare Baksa', '9', '1', 1, 2, '30-08-2021', '21-11-2024', 'No'),
(307, 'This is a sample draft question', 698, '487', 'Drafts Question', '3', '10', 14, 2, '30-08-2021', '18-11-2032', 'Draft');

-- --------------------------------------------------------

--
-- Table structure for table `sent_email`
--

CREATE TABLE `sent_email` (
  `e_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `q_id` int(11) NOT NULL,
  `date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`ans_id`);

--
-- Indexes for table `assembly_login`
--
ALTER TABLE `assembly_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `assembly_login_details`
--
ALTER TABLE `assembly_login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assembly_session`
--
ALTER TABLE `assembly_session`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `department_login`
--
ALTER TABLE `department_login`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `department_login_details`
--
ALTER TABLE `department_login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_profile_settings`
--
ALTER TABLE `department_profile_settings`
  ADD PRIMARY KEY (`dept_settings_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `sent_email`
--
ALTER TABLE `sent_email`
  ADD PRIMARY KEY (`e_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `ans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `assembly_login`
--
ALTER TABLE `assembly_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assembly_login_details`
--
ALTER TABLE `assembly_login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `assembly_session`
--
ALTER TABLE `assembly_session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `department_login`
--
ALTER TABLE `department_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `department_login_details`
--
ALTER TABLE `department_login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `department_profile_settings`
--
ALTER TABLE `department_profile_settings`
  MODIFY `dept_settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT for table `sent_email`
--
ALTER TABLE `sent_email`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
