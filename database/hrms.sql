-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2015 at 04:31 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_qualifications`
--

CREATE TABLE IF NOT EXISTS `academic_qualifications` (
  `user_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `level_of_education` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `exam_or_degree_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `concentration_or_major_or_group` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `institute_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `result` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `year_of_passing` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `achievement` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  KEY `academic_qualifications_user_id_index` (`user_id`),
  KEY `academic_qualifications_applicant_id_index` (`applicant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `academic_qualifications`
--

INSERT INTO `academic_qualifications` (`user_id`, `applicant_id`, `level_of_education`, `exam_or_degree_title`, `concentration_or_major_or_group`, `institute_name`, `result`, `year_of_passing`, `achievement`) VALUES
(3, 0, '', '', '', '', '', '', ''),
(4, 0, '', '', '', '', '', '', ''),
(5, 0, '', '', '', '', '', '', ''),
(6, 0, '', '', '', '', '', '', ''),
(7, 0, '', '', '', '', '', '', ''),
(0, 1, '', '', '', '', '', '', ''),
(0, 2, '', '', '', '', '', '', ''),
(0, 3, '', '', '', '', '', '', ''),
(0, 4, '', '', '', '', '', '', ''),
(0, 5, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `profile_image` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `admins_user_id_unique` (`user_id`),
  UNIQUE KEY `admins_phone_unique` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `first_name`, `last_name`, `phone`, `address`, `profile_image`) VALUES
(1, 'Oscar', 'Cantu', '15645707281', '662-1696 Gravida. Av.', 'preview.png'),
(2, 'Alvin', 'Sweeney', '15645707282', '662-1696 Gravida. Av.', 'preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE IF NOT EXISTS `applicants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alternative_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `alternative_phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ssn` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `marital_status` tinyint(4) NOT NULL DEFAULT '1',
  `nationality` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `religion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `profile_image` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `first_name`, `last_name`, `email`, `alternative_email`, `phone`, `alternative_phone`, `ssn`, `dob`, `gender`, `marital_status`, `nationality`, `religion`, `father_name`, `mother_name`, `address`, `profile_image`) VALUES
(1, 'Price', 'Bender', 'applicant1@example.com', 'applicant_ae1@example.com', '15645707295', '156457072953', '112233', '1980-01-24', 1, 1, 'Canadian', '', 'Darius Bailey', 'Neville Shelton', '662-1696 Gravida. Av.', 'preview.png'),
(2, 'Oscar', 'Cantu', 'applicant2@example.com', 'applicant_ae2@example.com', '15645707294', '156457072944', '112244', '1980-01-24', 1, 1, 'Canadian', '', 'Darius Bailey', 'Neville Shelton', '662-1696 Gravida. Av.', 'preview.png'),
(3, 'Alvin', 'Sweeney', 'applicant3@example.com', 'applicant_ae3@example.com', '15645707274', '1564570727410', '112233', '1980-01-24', 1, 1, 'Canadian', '', 'Darius Bailey', 'Neville Shelton', '662-1696 Gravida. Av.', 'preview.png'),
(4, 'Ferris', 'Nieves', 'applicant4@example.com', 'applicant_ae4@example.com', '15645707291', '156457072914', '112233', '1980-01-24', 1, 1, 'Canadian', '', 'Darius Bailey', 'Neville Shelton', '662-1696 Gravida. Av.', 'preview.png'),
(5, 'Nasim', 'Arber', 'applicant5@example.com', 'applicant_ae5@example.com', '15645707285', '156457072855', '112233', '1980-01-24', 1, 1, 'Canadian', '', 'Darius Bailey', 'Neville Shelton', '662-1696 Gravida. Av.', 'preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `company_infos`
--

CREATE TABLE IF NOT EXISTS `company_infos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `about` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_infos`
--

INSERT INTO `company_infos` (`id`, `name`, `phone`, `email`, `website`, `address`, `about`, `latitude`, `longitude`) VALUES
(1, 'HRMS Software', '444-555-666', 'support@example.com', 'www.example.com', 'P.O. Box 140, 8866 Rutrum Avenue', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eget erat magna. Pellentesque justo ante, sollicitudin eget, interdum id nibh.', '57.7973433', '12.0502107');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `head` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `head`, `created_at`, `updated_at`) VALUES
(1, 'Accounting', 3, '2015-06-29 08:31:26', '2015-06-29 08:31:26'),
(2, 'Human Resource', 4, '2015-06-29 08:31:26', '2015-06-29 08:31:26'),
(3, 'IT', 5, '2015-06-29 08:31:26', '2015-06-29 08:31:26'),
(4, 'Marketing', 6, '2015-06-29 08:31:26', '2015-06-29 08:31:26'),
(5, 'Finance', 7, '2015-06-29 08:31:26', '2015-06-29 08:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `main_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alternative_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `alternative_phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ssn` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `marital_status` tinyint(4) NOT NULL DEFAULT '1',
  `nationality` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `religion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mother_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `department_id` tinyint(4) NOT NULL,
  `employee_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `joining_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `profile_image` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `employees_user_id_unique` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`user_id`, `first_name`, `last_name`, `main_email`, `alternative_email`, `phone`, `alternative_phone`, `ssn`, `dob`, `gender`, `marital_status`, `nationality`, `religion`, `father_name`, `mother_name`, `address`, `department_id`, `employee_id`, `designation`, `joining_date`, `profile_image`) VALUES
(3, 'Nathaniel', 'Farmer', 'employee@example.com', 'employee_ae1@example.com', '15645707281', '156457072811', '112233', '1980-01-24', 1, 1, 'Canadian', '', 'Darius Bailey', 'Neville Shelton', '662-1696 Gravida. Av.', 1, '12345', 'CEO', '2009-01-24', 'preview.png'),
(4, 'Oscar', 'Cantu', 'employee2@example.com', 'employee_ae2@example.com', '15645707276', '156457072762', '112244', '1980-01-24', 1, 1, 'Canadian', '', 'Darius Bailey', 'Neville Shelton', '662-1696 Gravida. Av.', 2, '12345', 'Software Engineer', '2009-01-24', 'preview.png'),
(5, 'Alvin', 'Sweeney', 'employee3@example.com', 'employee_ae3@example.com', '15645707277', '156457072773', '112233', '1980-01-24', 1, 1, 'Canadian', '', 'Darius Bailey', 'Neville Shelton', '662-1696 Gravida. Av.', 3, '12345', 'Software Engineer', '2009-01-24', 'preview.png'),
(6, 'Ferris', 'Nieves', 'employee4@example.com', 'employee_ae4@example.com', '15645707278', '156457072784', '112233', '1980-01-24', 1, 1, 'Canadian', '', 'Darius Bailey', 'Neville Shelton', '662-1696 Gravida. Av.', 4, '12345', 'Software Engineer', '2009-01-24', 'preview.png'),
(7, 'Nasim', 'Arber', 'employee5@example.com', 'employee_ae5@example.com', '15645707279', '156457072797', '112233', '1980-01-24', 1, 1, 'Canadian', '', 'Darius Bailey', 'Neville Shelton', '662-1696 Gravida. Av.', 5, '12345', 'Software Engineer', '2009-01-24', 'preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendances`
--

CREATE TABLE IF NOT EXISTS `employee_attendances` (
  `employee_id` int(11) NOT NULL,
  `punch_month` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `punch_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `in_time` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `out_time` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `punch_type` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  KEY `employee_attendances_punch_month_index` (`punch_month`),
  KEY `employee_attendances_employee_id_index` (`employee_id`),
  KEY `employee_attendances_punch_date_index` (`punch_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_equipments`
--

CREATE TABLE IF NOT EXISTS `employee_equipments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `reason` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `moderated_by` int(11) NOT NULL,
  `moderator_comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_leaves`
--

CREATE TABLE IF NOT EXISTS `employee_leaves` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `from_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `to_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `reason` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `moderated_by` int(11) NOT NULL,
  `moderator_comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employment_summaries`
--

CREATE TABLE IF NOT EXISTS `employment_summaries` (
  `user_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `company_location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position_held` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `eh_department` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `eh_responsibilities` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `eh_from` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `eh_to` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `experience_category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `skills` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  KEY `employment_summaries_user_id_index` (`user_id`),
  KEY `employment_summaries_applicant_id_index` (`applicant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employment_summaries`
--

INSERT INTO `employment_summaries` (`user_id`, `applicant_id`, `company_name`, `company_location`, `position_held`, `eh_department`, `eh_responsibilities`, `eh_from`, `eh_to`, `experience_category`, `skills`) VALUES
(3, 0, '', '', '', '', '', '', '', '', ''),
(4, 0, '', '', '', '', '', '', '', '', ''),
(5, 0, '', '', '', '', '', '', '', '', ''),
(6, 0, '', '', '', '', '', '', '', '', ''),
(7, 0, '', '', '', '', '', '', '', '', ''),
(0, 1, '', '', '', '', '', '', '', '', ''),
(0, 2, '', '', '', '', '', '', '', '', ''),
(0, 3, '', '', '', '', '', '', '', '', ''),
(0, 4, '', '', '', '', '', '', '', '', ''),
(0, 5, '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE IF NOT EXISTS `genders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Group A', 'This is for Group A', 1, '2015-06-29 08:31:27', '2015-06-29 08:31:27'),
(2, 'Group B', 'This is for Group B', 1, '2015-06-29 08:31:27', '2015-06-29 08:31:27'),
(3, 'Group C', 'This is for Group C', 1, '2015-06-29 08:31:27', '2015-06-29 08:31:27'),
(4, 'Group D', 'This is for Group D', 1, '2015-06-29 08:31:27', '2015-06-29 08:31:27'),
(5, 'Group E', 'This is for Group E', 1, '2015-06-29 08:31:27', '2015-06-29 08:31:27');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE IF NOT EXISTS `group_members` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `group_members_group_id_index` (`group_id`),
  KEY `group_members_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`group_id`, `user_id`) VALUES
(1, 3),
(1, 6),
(1, 7),
(2, 4),
(2, 5),
(2, 6),
(3, 3),
(3, 3),
(3, 4),
(4, 4),
(4, 5),
(4, 6),
(5, 5),
(5, 7),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `interview_boards`
--

CREATE TABLE IF NOT EXISTS `interview_boards` (
  `interview_schedule_id` int(11) NOT NULL,
  `interview_by` int(11) NOT NULL,
  `selected` int(11) NOT NULL,
  `accepted` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  KEY `interview_boards_interview_schedule_id_index` (`interview_schedule_id`),
  KEY `interview_boards_interview_by_index` (`interview_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interview_schedules`
--

CREATE TABLE IF NOT EXISTS `interview_schedules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `interview_date` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `job_status` tinyint(4) NOT NULL,
  `reason` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `salary_range` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `experience_requirements` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `educational_requirements` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `no_of_vacancies` tinyint(4) NOT NULL,
  `job_nature` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `additional_requirements` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `other_benefits` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `open` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `marital_statuses`
--

CREATE TABLE IF NOT EXISTS `marital_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `marital_statuses`
--

INSERT INTO `marital_statuses` (`id`, `name`) VALUES
(1, 'Single'),
(2, 'Married'),
(3, 'Divorced'),
(4, 'Widowed');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_01_30_152140_create_departments_table', 1),
('2015_02_02_093244_create_users_table', 1),
('2015_02_07_082753_create_gender_table', 1),
('2015_02_07_083046_create_marital_status_table', 1),
('2015_02_09_085606_create_company_infos_table', 1),
('2015_02_11_072213_create_groups_table', 1),
('2015_02_11_073403_create_group_members_table', 1),
('2015_02_12_134931_create_notices_table', 1),
('2015_02_12_144052_create_notice_viewers_table', 1),
('2015_02_12_172605_create_notifications_table', 1),
('2015_02_17_140726_create_jobs_table', 1),
('2015_02_23_100900_create_interview_schedules_table', 1),
('2015_02_25_151645_create_interview_boards_table', 1),
('2015_03_23_145309_create_admins_table', 1),
('2015_03_30_093626_create_employees_table', 1),
('2015_03_30_093759_create_applicants_table', 1),
('2015_04_06_075055_create_academic_qualifications_table', 1),
('2015_04_06_102130_create_training_summaries_table', 1),
('2015_04_06_102340_create_professional_summaries_table', 1),
('2015_04_06_110454_create_employment_summaries_table', 1),
('2015_04_06_132529_create_other_profile_summaries_table', 1),
('2015_04_20_143432_create_employee_leaves_table', 1),
('2015_04_20_143532_create_employee_equipments_table', 1),
('2015_04_23_132119_create_employee_attendances_table', 1),
('2015_05_01_160248_create_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE IF NOT EXISTS `notices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notice_viewers`
--

CREATE TABLE IF NOT EXISTS `notice_viewers` (
  `notice_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  KEY `notice_viewers_notice_id_index` (`notice_id`),
  KEY `notice_viewers_group_id_index` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `user_id` int(11) NOT NULL,
  `notice_last_seen_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `notifications_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_profile_summaries`
--

CREATE TABLE IF NOT EXISTS `other_profile_summaries` (
  `user_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `ref_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ref_organization` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ref_designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ref_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ref_phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ref_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ref_relation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `objective` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `career_summary` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `spacial_qualification` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  KEY `other_profile_summaries_user_id_index` (`user_id`),
  KEY `other_profile_summaries_applicant_id_index` (`applicant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `other_profile_summaries`
--

INSERT INTO `other_profile_summaries` (`user_id`, `applicant_id`, `ref_name`, `ref_organization`, `ref_designation`, `ref_address`, `ref_phone`, `ref_email`, `ref_relation`, `objective`, `career_summary`, `spacial_qualification`) VALUES
(3, 0, '', '', '', '', '', '', '', '', '', ''),
(4, 0, '', '', '', '', '', '', '', '', '', ''),
(5, 0, '', '', '', '', '', '', '', '', '', ''),
(6, 0, '', '', '', '', '', '', '', '', '', ''),
(7, 0, '', '', '', '', '', '', '', '', '', ''),
(0, 1, '', '', '', '', '', '', '', '', '', ''),
(0, 2, '', '', '', '', '', '', '', '', '', ''),
(0, 3, '', '', '', '', '', '', '', '', '', ''),
(0, 4, '', '', '', '', '', '', '', '', '', ''),
(0, 5, '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `professional_summaries`
--

CREATE TABLE IF NOT EXISTS `professional_summaries` (
  `user_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `certification` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pq_institute` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pq_location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pq_from` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pq_to` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  KEY `professional_summaries_user_id_index` (`user_id`),
  KEY `professional_summaries_applicant_id_index` (`applicant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `professional_summaries`
--

INSERT INTO `professional_summaries` (`user_id`, `applicant_id`, `certification`, `pq_institute`, `pq_location`, `pq_from`, `pq_to`) VALUES
(3, 0, '', '', '', '', ''),
(4, 0, '', '', '', '', ''),
(5, 0, '', '', '', '', ''),
(6, 0, '', '', '', '', ''),
(7, 0, '', '', '', '', ''),
(0, 1, '', '', '', '', ''),
(0, 2, '', '', '', '', ''),
(0, 3, '', '', '', '', ''),
(0, 4, '', '', '', '', ''),
(0, 5, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `office_hour_start` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `office_hour_end` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `office_weekday_start` tinyint(4) NOT NULL,
  `office_weekday_end` tinyint(4) NOT NULL,
  `ip_range` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `weather_zip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `temperature_units` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `office_hour_start`, `office_hour_end`, `office_weekday_start`, `office_weekday_end`, `ip_range`, `weather_zip`, `temperature_units`) VALUES
(1, '09', '17', 1, 5, 'localhost', '94089', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `training_summaries`
--

CREATE TABLE IF NOT EXISTS `training_summaries` (
  `user_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `training_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ts_institute` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ts_location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `training_year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  KEY `training_summaries_user_id_index` (`user_id`),
  KEY `training_summaries_applicant_id_index` (`applicant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `training_summaries`
--

INSERT INTO `training_summaries` (`user_id`, `applicant_id`, `training_title`, `ts_institute`, `ts_location`, `training_year`) VALUES
(3, 0, '', '', '', ''),
(4, 0, '', '', '', ''),
(5, 0, '', '', '', ''),
(6, 0, '', '', '', ''),
(7, 0, '', '', '', ''),
(0, 1, '', '', '', ''),
(0, 2, '', '', '', ''),
(0, 3, '', '', '', ''),
(0, 4, '', '', '', ''),
(0, 5, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '3',
  `last_login_agent` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_login_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `last_login_agent`, `last_login_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@example.com', '$2y$10$vtHaWkPQ1pbtxHuviVxL2uEaAi5T.sXiCpvdIvpSNOeuxd.oIPsN.', 1, '', '0000-00-00 00:00:00', NULL, '2015-06-29 08:31:21', '2015-06-29 08:31:21'),
(2, 'admin2@example.com', '$2y$10$LzwsRTHnwvP3loAea.wSCuRI/iXAf8/btmydeBZIogMVoVRRvpbFC', 1, '', '0000-00-00 00:00:00', NULL, '2015-06-29 08:31:21', '2015-06-29 08:31:21'),
(3, 'employee@example.com', '$2y$10$J1GR222Oqans2wCrGipXI.WqU3MktuHdrCecg0hsFbkRLJQKerMNW', 2, '', '0000-00-00 00:00:00', NULL, '2015-06-29 08:31:21', '2015-06-29 08:31:21'),
(4, 'employee2@example.com', '$2y$10$RMu2CdZ9oHUPvbp8ZJWokuRhm5z7L5yOnIErFI72GGjkxu3JQjlq.', 2, '', '0000-00-00 00:00:00', NULL, '2015-06-29 08:31:21', '2015-06-29 08:31:21'),
(5, 'employee3@example.com', '$2y$10$NrjH54OAVaPob/0Ie/pRCus6VHsVK7u6kX62MygC3dYOX3cxuU0Qe', 2, '', '0000-00-00 00:00:00', NULL, '2015-06-29 08:31:21', '2015-06-29 08:31:21'),
(6, 'employee4@example.com', '$2y$10$vjiBx.fZY8v1tttYvgvNHO93Z/kmu6GTFzLfWLxpUqhoI.9Ed0i52', 2, '', '0000-00-00 00:00:00', NULL, '2015-06-29 08:31:21', '2015-06-29 08:31:21'),
(7, 'employee5@example.com', '$2y$10$lZ57fvDEl8fZYi3/SQ1ECu4mI1ow1dZBfJrsMTehMNnVyJUqKV/kq', 2, '', '0000-00-00 00:00:00', NULL, '2015-06-29 08:31:21', '2015-06-29 08:31:21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
