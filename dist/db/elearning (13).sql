-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 17, 2016 at 08:21 AM
-- Server version: 5.5.43-0ubuntu0.14.10.1
-- PHP Version: 5.5.12-2ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
`answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `choices` varchar(1000) NOT NULL,
  `letter` varchar(2) NOT NULL,
  `cola` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `question_id`, `answer`, `choices`, `letter`, `cola`) VALUES
(1, 1, 'True', 'True', '', ''),
(2, 1, 'True', 'False', '', ''),
(3, 2, 'True', 'True', '', ''),
(4, 2, 'True', 'False', '', ''),
(5, 3, 'True', '', '', ''),
(6, 4, 'lala', '', '', ''),
(7, 5, 'True', 'True', '', ''),
(8, 5, 'True', 'False', '', ''),
(9, 6, 'True', 'True', '', ''),
(10, 6, 'True', 'False', '', ''),
(11, 7, 'True', 'True', '', ''),
(12, 7, 'True', 'False', '', ''),
(13, 8, 'True', 'True', '', ''),
(14, 8, 'True', 'False', '', ''),
(15, 9, 'True', 'True', '', ''),
(16, 9, 'True', 'False', '', ''),
(17, 10, 'True', 'True', '', ''),
(18, 10, 'True', 'False', '', ''),
(19, 11, 'True', 'True', '', ''),
(20, 11, 'True', 'False', '', ''),
(21, 12, 'True', 'True', '', ''),
(22, 12, 'True', 'False', '', ''),
(23, 13, 'True', 'True', '', ''),
(24, 13, 'True', 'False', '', ''),
(25, 14, 'True', 'True', '', ''),
(26, 14, 'True', 'False', '', ''),
(27, 15, 'True', 'True', '', ''),
(28, 15, 'True', 'False', '', ''),
(29, 16, 'True', 'True', '', ''),
(30, 16, 'True', 'False', '', ''),
(31, 17, 'a', 'a', 'A', 'a'),
(32, 17, 'c', 'c', 'B', 'c'),
(33, 17, 'd', 'd', 'C', 'd'),
(34, 17, 'e', 'e', 'D', 'e'),
(35, 17, 'f', 'f', 'E', 'f'),
(36, 18, 'True', 'True', '', ''),
(37, 18, 'True', 'False', '', ''),
(38, 19, 'a', '1', 'A', '1'),
(39, 19, 'c', '2', 'B', '2'),
(40, 19, 'd', '3', 'C', '3'),
(41, 19, 'e', '4', 'D', '4'),
(42, 19, 'f', '5', 'E', '5');

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE IF NOT EXISTS `assign` (
`assign_id` int(11) NOT NULL,
  `assign_date` date NOT NULL,
  `assign_time` time NOT NULL,
  `assign_due` date NOT NULL,
  `assign_pts` int(5) NOT NULL,
  `assign_desc` varchar(1000) NOT NULL,
  `t_id` int(11) NOT NULL,
  `assign_term` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `assign`
--

INSERT INTO `assign` (`assign_id`, `assign_date`, `assign_time`, `assign_due`, `assign_pts`, `assign_desc`, `t_id`, `assign_term`) VALUES
(1, '2016-02-16', '22:56:59', '2016-01-01', 10, 'Assign1', 4, 'Prelim'),
(2, '2016-02-16', '22:57:24', '2016-01-01', 5, 'Assign2', 4, 'Midterm'),
(3, '2016-02-16', '22:57:49', '2016-01-01', 15, 'Assign3', 4, 'Endterm'),
(4, '2016-02-18', '16:23:21', '2016-12-12', 5, 'assign1', 6, 'Prelim'),
(5, '2016-02-18', '16:24:05', '0016-12-01', 5, 'assign2', 6, 'Midterm'),
(6, '2016-02-18', '16:24:49', '2016-12-03', 5, 'assign3', 6, 'Endterm');

-- --------------------------------------------------------

--
-- Table structure for table `assign_class`
--

CREATE TABLE IF NOT EXISTS `assign_class` (
`assign_class_id` int(11) NOT NULL,
  `assign_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `assign_class`
--

INSERT INTO `assign_class` (`assign_class_id`, `assign_id`, `class_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 1, 2),
(5, 5, 2),
(6, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
`class_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `class_stat` varchar(15) NOT NULL,
  `class_code` varchar(10) NOT NULL,
  `class_color` varchar(10) NOT NULL,
  `subject_code` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `t_id`, `class_name`, `class_stat`, `class_code`, `class_color`, `subject_code`) VALUES
(1, 4, 'IS111 1-A', 'Active', 'T6WO1', '#916060', 'IS111'),
(2, 6, 'bscs4', 'Active', 'nExbi', '#000000', 'Select Subject'),
(3, 4, 'ewewe', 'Active', 'kcWKM', '#000000', 'IS111');

-- --------------------------------------------------------

--
-- Table structure for table `class_quiz`
--

CREATE TABLE IF NOT EXISTS `class_quiz` (
`class_quiz_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `class_quiz_stat` varchar(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `class_quiz`
--

INSERT INTO `class_quiz` (`class_quiz_id`, `quiz_id`, `class_id`, `class_quiz_stat`) VALUES
(1, 1, 1, 'Deactivated'),
(2, 2, 1, 'Deactivated'),
(3, 3, 1, 'Deactivated'),
(4, 4, 1, 'Activated'),
(5, 5, 1, 'Activated'),
(6, 6, 1, 'Activated'),
(7, 7, 1, 'Activated'),
(8, 8, 2, 'Activated'),
(9, 9, 2, 'Activated'),
(10, 10, 2, 'Activated'),
(11, 11, 2, 'Activated'),
(12, 12, 2, 'Activated'),
(13, 13, 2, 'Activated'),
(14, 14, 2, 'Activated'),
(15, 15, 2, 'Activated'),
(16, 16, 1, 'Activated'),
(17, 17, 1, 'Activated');

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE IF NOT EXISTS `criteria` (
`criteria_id` int(3) NOT NULL,
  `assign` varchar(5) NOT NULL,
  `quiz` varchar(5) NOT NULL,
  `attendance` varchar(5) NOT NULL,
  `exam` varchar(5) NOT NULL,
  `project` varchar(5) NOT NULL,
  `class_id` int(11) NOT NULL,
  `attitude` varchar(5) NOT NULL,
  `seatwork` varchar(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`criteria_id`, `assign`, `quiz`, `attendance`, `exam`, `project`, `class_id`, `attitude`, `seatwork`) VALUES
(1, '0.1', '0.2', '0.1', '0.4', '0.2', 1, '0', '0'),
(2, '0.3', '0', '0.1', '0.3', '0.3', 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `enrol`
--

CREATE TABLE IF NOT EXISTS `enrol` (
`enrol_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `prelim` decimal(5,2) NOT NULL,
  `midterm` decimal(5,2) NOT NULL,
  `endterm` decimal(5,2) NOT NULL,
  `final` decimal(5,2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `enrol`
--

INSERT INTO `enrol` (`enrol_id`, `class_id`, `stud_id`, `prelim`, `midterm`, `endterm`, `final`) VALUES
(1, 1, 12, 98.00, 55.00, 95.40, 84.06),
(2, 1, 13, 90.00, 96.50, 95.00, 93.95),
(3, 2, 17, 79.00, 60.00, 77.25, 72.60),
(4, 3, 12, 0.00, 0.00, 0.00, 0.00),
(5, 3, 13, 0.00, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
`grade_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `term` varchar(10) NOT NULL,
  `score` int(3) NOT NULL,
  `total` int(5) NOT NULL,
  `grade` decimal(6,2) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`grade_id`, `stud_id`, `class_id`, `term`, `score`, `total`, `grade`, `type`) VALUES
(2, 13, 1, 'Prelim', 9, 10, 85.00, 'Project'),
(3, 13, 1, 'Prelim', 9, 10, 90.00, 'Attendance'),
(4, 13, 1, 'Prelim', 9, 10, 90.00, 'Quiz'),
(5, 13, 1, 'Prelim', 9, 10, 90.00, 'Exam'),
(6, 13, 1, 'Endterm', 13, 15, 86.00, 'Assignment'),
(7, 13, 1, 'Midterm', 4, 5, 80.00, 'Assignment'),
(8, 13, 1, 'Prelim', 9, 10, 95.00, 'Assignment'),
(9, 13, 1, 'Prelim', 9, 10, 90.00, 'Project'),
(10, 12, 1, 'Prelim', 7, 10, 100.00, 'Project'),
(11, 12, 1, 'Prelim', 7, 10, 100.00, 'Quiz'),
(12, 12, 1, 'Prelim', 7, 10, 100.00, 'Exam'),
(13, 12, 1, 'Endterm', 15, 15, 100.00, 'Assignment'),
(14, 12, 1, 'Midterm', 5, 5, 100.00, 'Assignment'),
(15, 12, 1, 'Prelim', 7, 10, 100.00, 'Assignment'),
(16, 12, 1, 'Prelim', 9, 10, 100.00, 'Attendance'),
(17, 12, 1, 'Prelim', 4, 4, 100.00, 'Quiz'),
(18, 13, 1, 'Prelim', 4, 4, 95.00, 'Quiz'),
(19, 13, 1, 'Midterm', 19, 20, 95.00, 'Attendance'),
(20, 12, 1, 'Midterm', 18, 20, 90.00, 'Attendance'),
(21, 13, 1, 'Midterm', 0, 0, 95.00, 'Project'),
(22, 12, 1, 'Midterm', 0, 0, 80.00, 'Project'),
(23, 12, 1, 'Endterm', 2, 2, 100.00, 'Quiz'),
(24, 12, 1, 'Midterm', 2, 2, 100.00, 'Quiz'),
(25, 12, 1, 'Endterm', 3, 3, 100.00, 'Exam'),
(26, 12, 1, 'Midterm', 0, 5, 75.00, 'Exam'),
(27, 13, 1, 'Endterm', 2, 2, 100.00, 'Quiz'),
(28, 13, 1, 'Midterm', 2, 2, 100.00, 'Quiz'),
(29, 13, 1, 'Endterm', 3, 3, 100.00, 'Exam'),
(30, 13, 1, 'Midterm', 5, 5, 100.00, 'Exam'),
(31, 13, 1, 'Endterm', 45, 50, 90.00, 'Attendance'),
(32, 12, 1, 'Endterm', 42, 50, 84.00, 'Attendance'),
(33, 13, 1, 'Endterm', 0, 0, 87.00, 'Project'),
(34, 12, 1, 'Endterm', 0, 0, 85.00, 'Project'),
(35, 17, 2, 'Prelim', 10, 10, 100.00, 'Quiz'),
(36, 17, 2, 'Midterm', 10, 10, 50.00, 'Quiz'),
(37, 17, 2, 'Endterm', 10, 10, 65.00, 'Quiz'),
(38, 17, 2, 'Prelim', 10, 10, 100.00, 'Exam'),
(39, 17, 2, 'Midterm', 10, 10, 50.00, 'Exam'),
(40, 17, 2, 'Endterm', 10, 10, 65.00, 'Exam'),
(41, 17, 2, 'Endterm', 10, 10, 100.00, 'Exam'),
(42, 17, 2, 'Prelim', 10, 10, 100.00, 'Project'),
(43, 17, 2, 'Midterm', 10, 10, 50.00, 'Project'),
(44, 17, 2, 'Endterm', 10, 10, 65.00, 'Project'),
(45, 17, 2, 'Prelim', 10, 10, 86.00, 'Attendance'),
(46, 17, 2, 'Midterm', 10, 10, 100.00, 'Attendance'),
(47, 17, 2, 'Endterm', 10, 10, 100.00, 'Attendance'),
(48, 17, 2, 'Endterm', 5, 5, 100.00, 'Assignment'),
(49, 17, 2, 'Endterm', 5, 5, 100.00, 'Assignment'),
(50, 17, 2, 'Midterm', 5, 5, 100.00, 'Assignment'),
(51, 17, 2, 'Prelim', 10, 10, 100.00, 'Assignment'),
(53, 17, 2, 'Prelim', 4, 5, 80.00, 'Assignment'),
(57, 17, 2, 'Prelim', 3, 5, 60.00, 'Assignment'),
(58, 12, 1, 'Prelim', 5, 6, 83.00, 'Quiz'),
(61, 12, 1, 'Prelim', 10, 12, 83.33, 'Exam'),
(62, 12, 3, 'Prelim', 9, 10, 90.00, 'Attendance'),
(63, 13, 3, 'Prelim', 9, 10, 90.00, 'Attendance'),
(64, 12, 3, 'Midterm', 10, 25, 40.00, 'Attendance'),
(65, 13, 3, 'Midterm', 19, 25, 76.00, 'Attendance');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
`post_id` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `post_content` varchar(100) NOT NULL,
  `post_file` varchar(100) NOT NULL,
  `t_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
`question_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question` longtext NOT NULL,
  `question_type` varchar(50) NOT NULL,
  `points` int(3) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `quiz_id`, `question`, `question_type`, `points`) VALUES
(1, 1, 'dadada', 'True or False', 2),
(2, 2, 'dada', 'True or False', 3),
(3, 3, 'dada', 'Modified True or False', 4),
(4, 4, 'xfsfdsfds', 'Identification', 2),
(5, 5, 'dasdsds', 'True or False', 2),
(6, 6, 'dadada', 'True or False', 5),
(7, 7, 'dsdsdsd', 'True or False', 3),
(8, 8, '12456/', 'True or False', 2),
(9, 9, 'asdfghj/<br><br>', 'True or False', 2),
(10, 10, 'asdfghj', 'True or False', 2),
(11, 10, 'asdfghj', 'True or False', 2),
(12, 12, 'asdfghj', 'True or False', 2),
(13, 13, 'asdfghj', 'True or False', 2),
(14, 14, 'asdfgh', 'True or False', 2),
(15, 15, 'asdfghj', 'True or False', 2),
(16, 16, 'kjfsdfs', 'True or False', 1),
(17, 16, 'Match', 'Matching Type', 1),
(18, 17, 'sdsdsds', 'True or False', 2),
(19, 17, 'fsfs', 'Matching Type', 2);

-- --------------------------------------------------------

--
-- Table structure for table `question_order`
--

CREATE TABLE IF NOT EXISTS `question_order` (
`order_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `q_order` varchar(2) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `q_score` int(3) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `question_order`
--

INSERT INTO `question_order` (`order_id`, `stud_id`, `question_id`, `q_order`, `answer`, `quiz_id`, `q_score`) VALUES
(1, 13, 1, '1', 'True', 1, 2),
(2, 13, 2, '1', 'True', 2, 3),
(3, 12, 1, '1', 'False', 1, 0),
(4, 12, 2, '1', 'True', 2, 3),
(5, 12, 3, '1', 'True', 3, 4),
(6, 13, 3, '1', 'True', 3, 4),
(7, 12, 5, '1', 'True', 5, 2),
(8, 12, 4, '1', 'lala', 4, 2),
(9, 12, 7, '1', 'True', 7, 3),
(10, 12, 6, '1', 'False', 6, 0),
(11, 13, 5, '1', 'True', 5, 2),
(12, 13, 4, '1', 'lala', 4, 2),
(13, 13, 7, '1', 'True', 7, 3),
(14, 13, 6, '1', 'True', 6, 5),
(15, 17, 8, '1', 'True', 8, 2),
(16, 17, 9, '1', 'True', 9, 2),
(17, 17, 10, '1', 'True', 10, 2),
(18, 17, 11, '2', 'True', 10, 2),
(19, 17, 12, '1', 'True', 12, 2),
(20, 17, 14, '1', 'True', 14, 2),
(21, 17, 15, '1', 'True', 15, 2),
(22, 12, 16, '1', 'True', 16, 1),
(23, 12, 17, '2', 'a,c,d,e,g', 16, 4),
(26, 12, 18, '1', 'True', 17, 2),
(27, 12, 19, '2', 'a,c,d,e,g', 17, 8);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
`quiz_id` int(11) NOT NULL,
  `quiz_title` varchar(100) NOT NULL,
  `quiz_instruction` varchar(1000) NOT NULL,
  `quiz_date` date NOT NULL,
  `quiz_time` time NOT NULL,
  `t_id` int(11) NOT NULL,
  `quiz_type` varchar(10) NOT NULL,
  `quiz_duration` varchar(10) NOT NULL,
  `quiz_term` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `quiz_title`, `quiz_instruction`, `quiz_date`, `quiz_time`, `t_id`, `quiz_type`, `quiz_duration`, `quiz_term`) VALUES
(1, 'Quiz 1', '', '2016-02-16', '11:14:05', 4, 'Quiz', '5', 'Prelim'),
(2, 'Exam', '', '2016-02-16', '11:53:26', 4, 'Exam', '40', 'Prelim'),
(3, 'Quiz # 2', '', '2016-02-17', '01:05:45', 4, 'Quiz', '5', 'Prelim'),
(4, 'Quiz 1 Mid', '', '2016-02-17', '05:38:31', 4, 'Quiz', '5', 'Midterm'),
(5, 'Quiz 2 End', '', '2016-02-17', '05:39:26', 4, 'Quiz', '2', 'Endterm'),
(6, 'Exam', '', '2016-02-17', '05:39:58', 4, 'Exam', '60', 'Midterm'),
(7, 'Exam End', '', '2016-02-17', '05:41:20', 4, 'Exam', '50', 'Endterm'),
(8, 'quiz1', '', '2016-02-18', '09:27:34', 6, 'Quiz', '5', 'Prelim'),
(9, 'quiz2', '', '2016-02-18', '09:28:37', 6, 'Quiz', '5', 'Midterm'),
(10, 'quiz3', '', '2016-02-18', '09:29:00', 6, 'Quiz', '5', 'Endterm'),
(11, 'eam', '', '2016-02-18', '09:29:32', 6, 'Exam', '5', 'Prelim'),
(12, 'eam2', '', '2016-02-18', '09:30:01', 6, 'Exam', '5', 'Midterm'),
(13, 'eam', '', '2016-02-18', '09:30:54', 6, 'Quiz', '5', 'Endterm'),
(14, 'eam3', '', '2016-02-18', '09:35:43', 6, 'Exam', '5', 'Endterm'),
(15, 'eaem', '', '2016-02-18', '09:38:06', 6, 'Exam', '5', 'Endterm'),
(16, 'sample', '', '2016-03-13', '07:25:21', 4, 'Quiz', '45', 'Prelim'),
(17, 'exam', '', '2016-03-13', '07:39:13', 4, 'Exam', '20', 'Prelim');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_result`
--

CREATE TABLE IF NOT EXISTS `quiz_result` (
`quiz_result_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `quiz_taken` date NOT NULL,
  `grade_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `quiz_result`
--

INSERT INTO `quiz_result` (`quiz_result_id`, `quiz_id`, `stud_id`, `quiz_taken`, `grade_id`) VALUES
(1, 1, 13, '2016-02-17', 4),
(2, 2, 13, '2016-02-17', 5),
(3, 1, 12, '2016-02-17', 11),
(4, 2, 12, '2016-02-17', 12),
(5, 3, 12, '2016-02-17', 17),
(6, 3, 13, '2016-02-17', 18),
(7, 5, 12, '2016-02-17', 23),
(8, 4, 12, '2016-02-17', 24),
(9, 7, 12, '2016-02-17', 25),
(10, 6, 12, '2016-02-17', 26),
(11, 5, 13, '2016-02-17', 27),
(12, 4, 13, '2016-02-17', 28),
(13, 7, 13, '2016-02-17', 29),
(14, 6, 13, '2016-02-17', 30),
(15, 8, 17, '2016-02-18', 35),
(16, 9, 17, '2016-02-18', 36),
(17, 10, 17, '2016-02-18', 37),
(18, 11, 17, '2016-02-18', 38),
(19, 12, 17, '2016-02-18', 39),
(20, 14, 17, '2016-02-18', 40),
(21, 15, 17, '2016-02-18', 41),
(22, 16, 12, '2016-03-13', 58),
(25, 17, 12, '2016-03-14', 61);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`stud_id` int(11) NOT NULL,
  `stud_last` varchar(30) NOT NULL,
  `stud_first` varchar(30) NOT NULL,
  `stud_user` varchar(15) NOT NULL,
  `stud_pass` varchar(15) NOT NULL,
  `stud_pic` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stud_id`, `stud_last`, `stud_first`, `stud_user`, `stud_pass`, `stud_pic`) VALUES
(12, 'De la Cruz', 'Juan', 'juan', '1', 'default.gif'),
(13, 'Toledo', 'Tisay', 'tisay', '1', 'default.gif'),
(14, 'Merkado', 'Alonso', 'alonso', '1', 'default.gif'),
(15, 'Ador', 'Riza', 'riza', '1', 'default.gif'),
(16, 'Yanson', 'Mond', 'mond', '1', 'default.gif'),
(17, 'ren', 'flo', 'ren', '1', 'default.gif'),
(18, 'Venancio', 'ClementPaul', 'cp', 'v', 'default.gif');

-- --------------------------------------------------------

--
-- Table structure for table `stud_assign`
--

CREATE TABLE IF NOT EXISTS `stud_assign` (
`stud_assign_id` int(10) NOT NULL,
  `assign_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `date_posted` date NOT NULL,
  `time_posted` time NOT NULL,
  `content` varchar(500) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `stud_assign`
--

INSERT INTO `stud_assign` (`stud_assign_id`, `assign_id`, `stud_id`, `date_posted`, `time_posted`, `content`, `grade_id`, `status`) VALUES
(1, 1, 13, '2016-02-17', '12:14:07', 'assign1', 8, 'Late'),
(2, 2, 13, '2016-02-17', '12:14:19', 'dada', 7, 'Late'),
(3, 3, 13, '2016-02-17', '12:14:27', 'dada', 6, 'Late'),
(4, 3, 12, '2016-02-17', '12:54:07', 'dsfsf', 13, 'Late'),
(5, 2, 12, '2016-02-17', '12:54:16', 'fsds', 14, 'Late'),
(6, 1, 12, '2016-02-17', '12:54:24', 'dada', 15, 'Late'),
(7, 6, 17, '2016-02-18', '04:43:29', 'a', 49, 'Submitted'),
(8, 5, 17, '2016-02-18', '04:43:48', 'b', 50, 'Late'),
(9, 4, 17, '2016-02-18', '04:44:07', 'c', 57, 'Submitted');

-- --------------------------------------------------------

--
-- Table structure for table `stud_log`
--

CREATE TABLE IF NOT EXISTS `stud_log` (
`slog_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `activity_type` varchar(50) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `log_date` date NOT NULL,
  `activity_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `stud_log`
--

INSERT INTO `stud_log` (`slog_id`, `stud_id`, `activity_type`, `activity`, `log_date`, `activity_id`, `class_id`) VALUES
(1, 13, 'assignment', 'submmitted assignment', '2016-02-17', 0, 1),
(2, 13, 'assignment', 'submmitted assignment', '2016-02-17', 0, 1),
(3, 13, 'assignment', 'submmitted assignment', '2016-02-17', 0, 1),
(4, 12, 'assignment', 'submmitted assignment', '2016-02-17', 0, 1),
(5, 12, 'assignment', 'submmitted assignment', '2016-02-17', 0, 1),
(6, 12, 'assignment', 'submmitted assignment', '2016-02-17', 0, 1),
(7, 17, 'assignment', 'submmitted assignment', '2016-02-18', 0, 2),
(8, 17, 'assignment', 'submmitted assignment', '2016-02-18', 0, 2),
(9, 17, 'assignment', 'submmitted assignment', '2016-02-18', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_code` varchar(30) NOT NULL,
  `subject_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_code`, `subject_title`) VALUES
('IS111', 'Fundamentals of IS'),
('IS112', 'Personal Productivity Using IS'),
('IS221', 'DFOS'),
('IS225', 'IS Programming'),
('Rizal', 'Life and Works of Rizal');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
`t_id` int(11) NOT NULL,
  `t_last` varchar(15) NOT NULL,
  `t_first` varchar(15) NOT NULL,
  `t_user` varchar(15) NOT NULL,
  `t_pass` varchar(15) NOT NULL,
  `t_pic` varchar(100) NOT NULL,
  `t_salut` varchar(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_id`, `t_last`, `t_first`, `t_user`, `t_pass`, `t_pic`, `t_salut`) VALUES
(4, 'Ponce', 'Juan', 'juan', '1', 'default.gif', 'Mr.'),
(5, 'Cuenca', 'Jake', 'jake', '1', 'default.gif', 'Mr.'),
(6, 'four', 'four', 'four', '4', 'default.gif', 'Mr.'),
(7, 'Hermosura', 'Wilfredo', 'wilfredo', 'w', 'default.gif', 'Mr.');

-- --------------------------------------------------------

--
-- Table structure for table `t_log`
--

CREATE TABLE IF NOT EXISTS `t_log` (
`log_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `activity_type` varchar(100) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `log_date` date NOT NULL,
  `activity_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `t_log`
--

INSERT INTO `t_log` (`log_id`, `t_id`, `activity_type`, `activity`, `log_date`, `activity_id`, `class_id`, `stud_id`) VALUES
(1, 4, 'enrol', 'added you to the group', '2016-02-16', 0, 1, 13),
(2, 4, 'assignment', 'posted new assignment', '2016-02-16', 1, 1, 0),
(3, 4, 'assignment', 'posted new assignment', '2016-02-16', 2, 1, 0),
(4, 4, 'assignment', 'posted new assignment', '2016-02-16', 3, 1, 0),
(5, 4, 'test', 'activated a test', '0000-00-00', 1, 1, 0),
(6, 4, 'test', 'activated a test', '0000-00-00', 1, 1, 0),
(7, 4, 'test', 'activated a test', '0000-00-00', 2, 1, 0),
(8, 4, 'grade', 'graded your assignment', '2016-02-17', 3, 1, 13),
(9, 4, 'grade', 'graded your assignment', '2016-02-17', 2, 1, 13),
(10, 4, 'grade', 'graded your assignment', '2016-02-17', 1, 1, 13),
(11, 4, 'enrol', 'added you to the group', '2016-02-17', 0, 1, 12),
(12, 4, 'grade', 'graded your assignment', '2016-02-17', 3, 1, 12),
(13, 4, 'grade', 'graded your assignment', '2016-02-17', 2, 1, 12),
(14, 4, 'grade', 'graded your assignment', '2016-02-17', 1, 1, 12),
(15, 4, 'test', 'activated a test', '0000-00-00', 3, 1, 0),
(16, 4, 'test', 'activated a test', '0000-00-00', 3, 1, 0),
(17, 4, 'test', 'activated a test', '0000-00-00', 2, 1, 0),
(18, 4, 'test', 'activated a test', '0000-00-00', 1, 1, 0),
(19, 4, 'test', 'activated a test', '0000-00-00', 4, 1, 0),
(20, 4, 'test', 'activated a test', '0000-00-00', 5, 1, 0),
(21, 4, 'test', 'activated a test', '0000-00-00', 6, 1, 0),
(22, 4, 'test', 'activated a test', '0000-00-00', 7, 1, 0),
(23, 6, 'enrol', 'added you to the group', '2016-02-18', 0, 2, 17),
(24, 6, 'test', 'activated a test', '0000-00-00', 8, 2, 0),
(25, 6, 'test', 'activated a test', '0000-00-00', 9, 2, 0),
(26, 6, 'test', 'activated a test', '0000-00-00', 10, 2, 0),
(27, 6, 'test', 'activated a test', '0000-00-00', 11, 2, 0),
(28, 6, 'test', 'activated a test', '0000-00-00', 12, 2, 0),
(29, 6, 'test', 'activated a test', '0000-00-00', 13, 2, 0),
(30, 6, 'test', 'activated a test', '0000-00-00', 14, 2, 0),
(31, 6, 'test', 'activated a test', '0000-00-00', 15, 2, 0),
(32, 6, 'grade', 'graded your assignment', '2016-02-18', 6, 2, 17),
(33, 6, 'grade', 'graded your assignment', '2016-02-18', 6, 2, 17),
(34, 6, 'grade', 'graded your assignment', '2016-02-18', 5, 2, 17),
(35, 6, 'grade', 'graded your assignment', '2016-02-18', 4, 2, 17),
(36, 6, 'grade', 'graded your assignment', '2016-02-18', 4, 2, 17),
(37, 6, 'grade', 'graded your assignment', '2016-02-19', 4, 2, 17),
(38, 6, 'grade', 'graded your assignment', '2016-02-19', 4, 2, 17),
(39, 6, 'grade', 'graded your assignment', '2016-02-19', 4, 2, 17),
(40, 6, 'grade', 'graded your assignment', '2016-02-19', 4, 2, 17),
(41, 6, 'grade', 'graded your assignment', '2016-02-19', 4, 2, 17),
(42, 4, 'test', 'activated a test', '0000-00-00', 16, 1, 0),
(43, 4, 'test', 'activated a test', '0000-00-00', 17, 1, 0),
(44, 4, 'enrol', 'added you to the group', '2016-03-17', 0, 3, 12),
(45, 4, 'enrol', 'added you to the group', '2016-03-17', 0, 3, 13);

-- --------------------------------------------------------

--
-- Table structure for table `t_upload`
--

CREATE TABLE IF NOT EXISTS `t_upload` (
`t_upload_id` int(11) NOT NULL,
  `file` varchar(100) NOT NULL,
  `assign_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `t_upload`
--

INSERT INTO `t_upload` (`t_upload_id`, `file`, `assign_id`) VALUES
(1, 'bagologo.jpg', 1),
(2, 'lock.jpg', 2),
(3, 'brgy.jpg', 3),
(4, 'APA-ppt.ppt', 4),
(5, 'APA-ppt.ppt', 5),
(6, 'APA-ppt.ppt', 6);

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
`upload_id` int(10) NOT NULL,
  `stud_assign_id` int(10) NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`upload_id`, `stud_assign_id`, `file`) VALUES
(1, 1, 'bagologo.jpg'),
(2, 2, 'students.png'),
(3, 3, 'boxed-bg.png'),
(4, 4, 'boxed-bg.jpg'),
(5, 5, 'glyphicons-halflings.png'),
(6, 6, 'boxed-bg.jpg'),
(7, 7, 'APA-ppt.ppt'),
(8, 8, 'APA-ppt.ppt'),
(9, 9, 'APA-ppt.ppt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
 ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `assign`
--
ALTER TABLE `assign`
 ADD PRIMARY KEY (`assign_id`);

--
-- Indexes for table `assign_class`
--
ALTER TABLE `assign_class`
 ADD PRIMARY KEY (`assign_class_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_quiz`
--
ALTER TABLE `class_quiz`
 ADD PRIMARY KEY (`class_quiz_id`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
 ADD PRIMARY KEY (`criteria_id`);

--
-- Indexes for table `enrol`
--
ALTER TABLE `enrol`
 ADD PRIMARY KEY (`enrol_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
 ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
 ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `question_order`
--
ALTER TABLE `question_order`
 ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
 ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_result`
--
ALTER TABLE `quiz_result`
 ADD PRIMARY KEY (`quiz_result_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `stud_assign`
--
ALTER TABLE `stud_assign`
 ADD PRIMARY KEY (`stud_assign_id`);

--
-- Indexes for table `stud_log`
--
ALTER TABLE `stud_log`
 ADD PRIMARY KEY (`slog_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
 ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `t_log`
--
ALTER TABLE `t_log`
 ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `t_upload`
--
ALTER TABLE `t_upload`
 ADD PRIMARY KEY (`t_upload_id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
 ADD PRIMARY KEY (`upload_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `assign`
--
ALTER TABLE `assign`
MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `assign_class`
--
ALTER TABLE `assign_class`
MODIFY `assign_class_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `class_quiz`
--
ALTER TABLE `class_quiz`
MODIFY `class_quiz_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
MODIFY `criteria_id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `enrol`
--
ALTER TABLE `enrol`
MODIFY `enrol_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `question_order`
--
ALTER TABLE `question_order`
MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `quiz_result`
--
ALTER TABLE `quiz_result`
MODIFY `quiz_result_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `stud_assign`
--
ALTER TABLE `stud_assign`
MODIFY `stud_assign_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `stud_log`
--
ALTER TABLE `stud_log`
MODIFY `slog_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `t_log`
--
ALTER TABLE `t_log`
MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `t_upload`
--
ALTER TABLE `t_upload`
MODIFY `t_upload_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
MODIFY `upload_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
