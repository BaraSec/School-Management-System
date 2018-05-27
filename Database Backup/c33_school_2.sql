-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 25, 2018 at 10:22 PM
-- Server version: 5.5.56-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c33_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `applicID` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `grade` int(11) NOT NULL,
  `average` double NOT NULL,
  `email` varchar(100) NOT NULL,
  `interests` varchar(1000) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `father_job` varchar(100) NOT NULL,
  `father_phone` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `mother_job` varchar(100) NOT NULL,
  `mother_phone` varchar(100) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `parents_email` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`applicID`, `first_name`, `last_name`, `gender`, `dob`, `grade`, `average`, `email`, `interests`, `father_name`, `father_job`, `father_phone`, `mother_name`, `mother_job`, `mother_phone`, `payment`, `parents_email`, `status`) VALUES
(1, 'a', 'b', 'Female', '2001-05-15', 8, 95.3, 'dfasads@ghasfa.com', 'Swimming, Working out', 'a', 'b', '1234567890', 'a', 'b', '1234567890', 'Paypal, all at once', 'dasdas@dada.com', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `course_schedule`
--

CREATE TABLE IF NOT EXISTS `course_schedule` (
  `grade` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `lec1_subject` varchar(200) NOT NULL,
  `lec1_teacher` int(11) NOT NULL,
  `lec2_subject` varchar(200) NOT NULL,
  `lec2_teacher` int(11) NOT NULL,
  `lec3_subject` varchar(200) NOT NULL,
  `lec3_teacher` int(11) NOT NULL,
  `lec4_subject` varchar(200) NOT NULL,
  `lec4_teacher` int(11) NOT NULL,
  `lec5_subject` varchar(200) NOT NULL,
  `lec5_teacher` int(11) NOT NULL,
  `lec6_subject` varchar(200) NOT NULL,
  `lec6_teacher` int(11) NOT NULL,
  `lec7_subject` varchar(200) NOT NULL,
  `lec7_teacher` int(11) NOT NULL,
  `lec8_subject` varchar(200) NOT NULL,
  `lec8_teacher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_schedule`
--

INSERT INTO `course_schedule` (`grade`, `section`, `lec1_subject`, `lec1_teacher`, `lec2_subject`, `lec2_teacher`, `lec3_subject`, `lec3_teacher`, `lec4_subject`, `lec4_teacher`, `lec5_subject`, `lec5_teacher`, `lec6_subject`, `lec6_teacher`, `lec7_subject`, `lec7_teacher`, `lec8_subject`, `lec8_teacher`) VALUES
(9, 3, 'Arabic', 5, 'Math', 4, 'Science', 5, 'English', 4, 'Sports', 5, 'Health', 4, 'History', 5, 'Geography', 4);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `eID` int(11) NOT NULL,
  `ID` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `gender` varchar(40) NOT NULL,
  `phone` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `type` varchar(80) NOT NULL,
  `salary` double NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`eID`, `ID`, `name`, `gender`, `phone`, `email`, `dob`, `type`, `salary`, `username`, `password`) VALUES
(1, '1234567899', 'Bara Abraham', 'Male', '5665466', 'assa@gmail.com', '2009-02-15', 'Headmaster', 564165.2, 'Headmaster1', 'a8eee021d6334ccc3b8c444a5386958328225540'),
(4, '1212515', 'Ahmad', 'Male', '565615', 'sasa@adaa.com', '1980-02-15', 'Teacher', 51541, 'Teacher1', '6f5ec8c5518b8c89d69dd286513390f85f454624'),
(5, '121221', 'Salam', 'Male', '54454654', 'ads@dsad.casd', '1980-05-02', 'Teacher', 4854, 'Teacher2', 'c9d1eec601d9ad5b51552b8c5555d602448c66ee');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eventID` int(11) NOT NULL,
  `short_story` varchar(1000) NOT NULL,
  `full_story` varchar(10000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventID`, `short_story`, `full_story`) VALUES
(1, 'School officially ends on 10th of June, finals start a week after', 'School officially ends on 10th of June, finals start a week after. Good luck everyone!!'),
(2, 'Teacher''s day on Tuesday', 'Teacher''s day on Tuesday! Let''s have some fun, shall we?'),
(3, 'Football tournament starts on Sunday', 'Football tournament starts on Sunday. Let''s guess who''s gonna win hahaha'),
(4, 'The open day!', 'The open day! On the doors, be prepared :)');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `fbID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback` varchar(2000) NOT NULL,
  `isSeen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fbID`, `name`, `phone`, `email`, `feedback`, `isSeen`) VALUES
(1, 'lama', '1234567890', 'dfasads@ghasfa.com', 'ad D', 0);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE IF NOT EXISTS `marks` (
  `mID` int(11) NOT NULL,
  `grade` varchar(200) NOT NULL,
  `section` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`mID`, `grade`, `section`, `subject`, `name`) VALUES
(7, '9', '3', 'History', 'Midterm 1'),
(8, '9', '3', 'Health', 'Quiz 1'),
(9, '9', '3', 'Health', 'Quiz 2');

-- --------------------------------------------------------

--
-- Table structure for table `marks_students`
--

CREATE TABLE IF NOT EXISTS `marks_students` (
  `mID` int(11) NOT NULL,
  `sID` int(11) NOT NULL,
  `mark` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marks_students`
--

INSERT INTO `marks_students` (`mID`, `sID`, `mark`) VALUES
(7, 1, 96.2),
(7, 3, 85),
(8, 1, 52),
(8, 3, 85),
(9, 1, 26),
(9, 3, 32);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `newsID` int(11) NOT NULL,
  `short_story` varchar(1000) NOT NULL,
  `full_story` varchar(10000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsID`, `short_story`, `full_story`) VALUES
(1, 'Al-Salam school states tomorrow a day of mourning on the souls of martyrs', 'Al-Salam school states tomorrow a day of mourning on the souls of martyrs. Hope everyone stays safe.'),
(2, 'Student council president elected', 'Student council president elected. Congratulations!'),
(3, 'Cafeteria lights fixed', 'Cafeteria lights fixed. Finally hahaha'),
(4, 'Surprise!', 'Be ready for some new action !');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `grade` int(11) NOT NULL,
  `section_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`grade`, `section_number`) VALUES
(7, 1),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(9, 3),
(10, 1),
(11, 1),
(11, 2),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `sID` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `father_job` varchar(100) NOT NULL,
  `mother_job` varchar(100) NOT NULL,
  `father_phone` int(11) NOT NULL,
  `mother_phone` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `parents_email` varchar(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sID`, `first_name`, `last_name`, `father_name`, `mother_name`, `father_job`, `mother_job`, `father_phone`, `mother_phone`, `grade`, `section`, `email`, `parents_email`, `username`, `password`) VALUES
(1, 'Ahmad', 'Sameer', 'Ramo A', 'Mairam B', 'Technician', 'CEO', 454151, 2147483647, 9, 3, 'std1@email.com', 'pts1@email.com', 'Student1', 'ee76f947391d9d8da92ec0f3e2b9e31a3f95af69'),
(3, 'Lama', 'Moe', 'Ahmad', 'Randa', 'CTO', 'Home', 456126455, 2147483647, 9, 3, 'sad@dasd.com', 'dasdfas@ddsad.com', 'Student2', '9c246dccb43580e9354d65e1cf64ee19a32e05bb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`applicID`);

--
-- Indexes for table `course_schedule`
--
ALTER TABLE `course_schedule`
  ADD PRIMARY KEY (`grade`,`section`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`eID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fbID`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`mID`);

--
-- Indexes for table `marks_students`
--
ALTER TABLE `marks_students`
  ADD PRIMARY KEY (`mID`,`sID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsID`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`grade`,`section_number`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `applicID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `eID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fbID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `mID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `sID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
