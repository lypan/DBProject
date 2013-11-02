-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主機: dbhome.cs.nctu.edu.tw
-- 建立日期: Nov 02, 2013, 05:37 PM
-- 伺服器版本: 5.0.81
-- PHP 版本: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `lypan_cs`
--

-- --------------------------------------------------------

--
-- 資料表格式： `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `account` int(10) NOT NULL,
  `name` varchar(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  `idNumber` int(10) NOT NULL,
  PRIMARY KEY  (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 列出以下資料庫的數據： `admin`
--

INSERT INTO `admin` (`account`, `name`, `password`, `idNumber`) VALUES
(88888, 'admin', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 88888);

-- --------------------------------------------------------

--
-- 資料表格式： `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `courseName` varchar(20) NOT NULL,
  `profID` int(10) NOT NULL,
  `classroom` varchar(10) NOT NULL,
  `capacity` int(10) NOT NULL,
  `credit` int(10) NOT NULL,
  `department` varchar(30) NOT NULL,
  `grade` int(10) NOT NULL,
  `obligatory` tinyint(1) NOT NULL,
  `courseYear` int(10) NOT NULL,
  `courseTime` varchar(20) NOT NULL,
  `courseID` int(10) NOT NULL,
  PRIMARY KEY  (`courseID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 列出以下資料庫的數據： `course`
--


-- --------------------------------------------------------

--
-- 資料表格式： `courseConstraint`
--

CREATE TABLE IF NOT EXISTS `courseConstraint` (
  `courseID` int(10) NOT NULL,
  `department` varchar(30) NOT NULL,
  `grade` varchar(20) NOT NULL,
  PRIMARY KEY  (`courseID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 列出以下資料庫的數據： `courseConstraint`
--


-- --------------------------------------------------------

--
-- 資料表格式： `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department` varchar(30) NOT NULL,
  PRIMARY KEY  (`department`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 列出以下資料庫的數據： `department`
--

INSERT INTO `department` (`department`) VALUES
('ComputerScience'),
('MaterialScience'),
('MechanicalEngineering');

-- --------------------------------------------------------

--
-- 資料表格式： `enroll`
--

CREATE TABLE IF NOT EXISTS `enroll` (
  `stdID` int(10) NOT NULL,
  `courseID` int(10) NOT NULL,
  PRIMARY KEY  (`stdID`,`courseID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 列出以下資料庫的數據： `enroll`
--

INSERT INTO `enroll` (`stdID`, `courseID`) VALUES
(16997, 358),
(16999, 358);

-- --------------------------------------------------------

--
-- 資料表格式： `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `stdID` int(10) NOT NULL,
  `notice` varchar(50) NOT NULL,
  PRIMARY KEY  (`stdID`,`notice`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 列出以下資料庫的數據： `notice`
--

INSERT INTO `notice` (`stdID`, `notice`) VALUES
(16997, '182-Logical is deleted due to constraint!'),
(16997, '269-DiscreteMath is deleted due to constraint!'),
(16997, '702-Probability is deleted due to constraint!'),
(16997, '931-EEDesign is deleted due to constraint!'),
(16997, '950-EngineeringCircuit is deleted due to constrain'),
(17997, '182-Logical is deleted due to constraint!'),
(17997, '269-DiscreteMath is deleted due to constraint!'),
(17997, '312-CSDesign is deleted due to constraint!'),
(17997, '318-Translate is deleted due to constraint!'),
(17997, '358-Database is deleted due to constraint!'),
(17997, '702-Probability is deleted due to constraint!'),
(17997, '931-EEDesign is deleted due to constraint!'),
(17997, '950-EngineeringCircuit is deleted due to constrain');

-- --------------------------------------------------------

--
-- 資料表格式： `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `account` int(10) NOT NULL,
  `idNumber` int(10) NOT NULL,
  `privilege` varchar(10) NOT NULL,
  `suspend` tinyint(1) NOT NULL,
  PRIMARY KEY  (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 列出以下資料庫的數據： `permission`
--

INSERT INTO `permission` (`account`, `idNumber`, `privilege`, `suspend`) VALUES
(16996, 16996, 'student', 0),
(16997, 16997, 'student', 0),
(16998, 16998, 'student', 0),
(16999, 16999, 'student', 0),
(17996, 17996, 'student', 0),
(11111, 11111, 'professor', 0),
(22222, 22222, 'professor', 0),
(33333, 33333, 'professor', 0),
(44444, 44444, 'professor', 0),
(55555, 55555, 'professor', 0),
(66666, 66666, 'professor', 0),
(77777, 77777, 'professor', 0),
(17997, 17997, 'student', 0),
(9931031, 9931031, 'professor', 0),
(123456, 123445, 'professor', 0);

-- --------------------------------------------------------

--
-- 資料表格式： `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `account` int(10) NOT NULL,
  `idNumber` int(10) NOT NULL,
  `position` varchar(10) NOT NULL,
  PRIMARY KEY  (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 列出以下資料庫的數據： `position`
--

INSERT INTO `position` (`account`, `idNumber`, `position`) VALUES
(16996, 16996, 'student'),
(16997, 16997, 'student'),
(16998, 16998, 'student'),
(16999, 16999, 'student'),
(17996, 17996, 'student'),
(11111, 11111, 'professor'),
(22222, 22222, 'professor'),
(33333, 33333, 'professor'),
(44444, 44444, 'professor'),
(55555, 55555, 'professor'),
(66666, 66666, 'professor'),
(77777, 77777, 'professor'),
(17997, 17997, 'student'),
(9931031, 9931031, 'professor'),
(123456, 123445, 'professor');

-- --------------------------------------------------------

--
-- 資料表格式： `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `account` int(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(10) NOT NULL,
  `idNumber` int(10) NOT NULL,
  `department` varchar(30) NOT NULL,
  PRIMARY KEY  (`idNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 列出以下資料庫的數據： `professor`
--

INSERT INTO `professor` (`account`, `password`, `name`, `idNumber`, `department`) VALUES
(11111, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Chung', 11111, 'ComputerScience'),
(22222, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Hung', 22222, 'MechanicalEngineering'),
(33333, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Tsai', 33333, 'ComputerScience'),
(44444, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Liao', 44444, 'ComputerScience'),
(55555, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Chung', 55555, 'ComputerScience'),
(66666, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Lin', 66666, 'MaterialScience'),
(77777, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'Kuao', 77777, 'ComputerScience'),
(9931031, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'lypan', 9931031, 'ComputerScience'),
(123456, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'testtest', 123445, 'ComputerScience');

-- --------------------------------------------------------

--
-- 資料表格式： `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `account` int(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(10) NOT NULL,
  `idNumber` int(10) NOT NULL,
  `department` varchar(30) NOT NULL,
  `grade` int(1) NOT NULL,
  PRIMARY KEY  (`idNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 列出以下資料庫的數據： `student`
--

INSERT INTO `student` (`account`, `password`, `name`, `idNumber`, `department`, `grade`) VALUES
(16996, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'OneWong', 16996, 'ComputerScience', 6),
(16997, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'TwoLing', 16997, 'ComputerScience', 5),
(16998, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'ThreeChung', 16998, 'MechanicalEngineering', 3),
(16999, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'FourLee', 16999, 'ComputerScience', 5),
(17996, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'GeeAh', 17996, 'MechanicalEngineering', 2),
(17997, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'TEST', 17997, 'ComputerScience', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
