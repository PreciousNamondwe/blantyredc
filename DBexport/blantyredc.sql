-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2026 at 03:48 PM
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
-- Database: `blantyredc`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesses_application`
--

CREATE TABLE `businesses_application` (
  `id` int(11) UNSIGNED NOT NULL,
  `application_code` varchar(50) NOT NULL,
  `application_type` enum('new','renewal','amendment') NOT NULL DEFAULT 'new',
  `current_stage` enum('draft','submitted','under_review','inspection_scheduled','awaiting_payment','approved','rejected') NOT NULL DEFAULT 'draft',
  `submission_date` datetime DEFAULT NULL,
  `business_name` varchar(255) NOT NULL,
  `business_type` varchar(150) NOT NULL,
  `business_category` varchar(100) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `owner_national_id` varchar(20) NOT NULL,
  `owner_id_image` varchar(255) NOT NULL,
  `owner_phone` varchar(50) NOT NULL,
  `traditional_authority` varchar(100) NOT NULL,
  `village_or_area` varchar(100) NOT NULL,
  `physical_address` text NOT NULL,
  `trading_name` varchar(255) DEFAULT NULL,
  `owner_email` varchar(255) DEFAULT NULL,
  `plot_number` varchar(100) DEFAULT NULL,
  `is_formal_sector` tinyint(1) NOT NULL DEFAULT 0,
  `mbrs_registration_number` varchar(100) DEFAULT NULL,
  `mra_tpin` varchar(50) DEFAULT NULL,
  `estimated_annual_turnover` decimal(15,2) NOT NULL DEFAULT 0.00,
  `assigned_reviewer_id` int(11) UNSIGNED DEFAULT NULL,
  `reviewer_remarks` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Dumping data for table `businesses_application`
--

INSERT INTO `businesses_application` (`id`, `application_code`, `application_type`, `current_stage`, `submission_date`, `business_name`, `business_type`, `business_category`, `owner_name`, `owner_national_id`, `owner_id_image`, `owner_phone`, `traditional_authority`, `village_or_area`, `physical_address`, `trading_name`, `owner_email`, `plot_number`, `is_formal_sector`, `mbrs_registration_number`, `mra_tpin`, `estimated_annual_turnover`, `assigned_reviewer_id`, `reviewer_remarks`, `created_at`, `updated_at`) VALUES
(1, 'APP-2026-1D112BDB', 'renewal', 'under_review', '2026-06-07 01:01:46', 'EvintraTech', 'EvintraTech', 'Manufacturing', 'precious namondwe', 'ZDXFCGVB', 'uploads/national_ids/ID_ZDXFCGVB_1780786906.jpg', '+265994567897', 'drtfgyhuji', 'sdfghj', 'asdrftgyhj', 'dfghj', 'bis22-pnamondwe@mubas.ac.mw', 'awserdtfgyh', 0, NULL, NULL, 0.00, NULL, NULL, '2026-06-07 01:01:46', '2026-06-07 11:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_services`
--

CREATE TABLE `chatbot_services` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` text NOT NULL COMMENT 'Comma-separated values used by background engine matching variables',
  `description` text DEFAULT NULL,
  `requirements` text DEFAULT NULL COMMENT 'List items separated strictly by newline line characters',
  `url` varchar(255) NOT NULL DEFAULT 'services',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatbot_services`
--

INSERT INTO `chatbot_services` (`id`, `title`, `keywords`, `description`, `requirements`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Marriage Certificate Registration', 'marriage, marr, cert, wedding, spouse, certificate, m, c', 'Official registration and digital processing of a legal marriage union via the portal.', 'Valid identification (Passport or National ID) for both parties\nWitness IDs (Minimum of two witnesses)\nProof of residence\nDivorce Decree or Death Certificate of previous spouse (if applicable)', 'marriage-certificates', 'active', '2026-06-04 20:20:53', '2026-06-04 20:20:53'),
(2, 'Business License & Corporate Registration', 'business, bus, license, lic, reg, company, firm, commerce, b', 'Legal authorization pipeline required to register and operate a commercial business entity.', 'Approved Business Name reservation document\nCertificate of Incorporation / Articles of Organization\nValid Identification of directors/owners\nTax Identification Number (TIN) certificate', 'business-license', 'active', '2026-06-04 20:20:53', '2026-06-04 20:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_reports`
--

CREATE TABLE `complaint_reports` (
  `id` int(11) UNSIGNED NOT NULL,
  `application_id` int(11) UNSIGNED NOT NULL COMMENT 'Links directly to core applications master tracking table',
  `complaint_category` varchar(50) NOT NULL,
  `complaint_subject` varchar(255) NOT NULL,
  `complaint_description` text NOT NULL,
  `complaint_location` text NOT NULL,
  `priority_level` enum('low','medium','high','emergency') NOT NULL DEFAULT 'medium',
  `anonymous` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = Anonymous submission, 0 = Public identities exposed',
  `applicant_name` varchar(255) DEFAULT NULL,
  `applicant_phone` varchar(50) DEFAULT NULL,
  `applicant_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaint_reports`
--

INSERT INTO `complaint_reports` (`id`, `application_id`, `complaint_category`, `complaint_subject`, `complaint_description`, `complaint_location`, `priority_level`, `anonymous`, `applicant_name`, `applicant_phone`, `applicant_email`, `created_at`, `updated_at`) VALUES
(1, 25, 'corruption', 'sdfghjkl', 'FFFFFDGHJJJKJKUYTREWHGFDHGF', 'buying pain killer', 'medium', 1, 'Anonymous', '+265994567897', 'bis22-pnamondwe@mubas.ac.mw', '2026-06-05 23:50:53', '2026-06-05 23:50:53'),
(2, 26, 'corruption', 'pxwwzwaaaaa', 'WSERDTFGYHUJIKOPKIUYTREDRFTGYUH', 'buying pain killer', 'medium', 1, 'Anonymous', '+265982348199', 'bis22-pnamondwe@mubas.ac.mw', '2026-06-06 00:43:01', '2026-06-06 00:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `elected_officials`
--

CREATE TABLE `elected_officials` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `photo` varchar(500) DEFAULT NULL,
  `social_media` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_media`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `elected_officials`
--

INSERT INTO `elected_officials` (`id`, `name`, `position`, `department`, `phone`, `email`, `bio`, `photo`, `social_media`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(3, 'precious namondwe', 'sdxfcgvbhnj', 'zsxdfcghjk', '0982348199', 'bis22-pnamondwe@mubas.ac.mw', 'qaewsrdtfyuhijokpl', NULL, NULL, 1, 1, '2026-06-06 07:20:18', '2026-06-06 10:31:49'),
(5, 'pzwa', 'sdxfcgvbhnj', 'zsxdfcghjk', '0982348199', 'pzwa@gmail.com', 'wsedrtfgyuhjik', NULL, NULL, 1, 2, '2026-06-06 08:20:40', '2026-06-06 13:08:27'),
(6, 'pzwa', 'sdxfcgvbhnj', 'zsxdfcghjk', NULL, NULL, '234e5r6t78u9i', NULL, NULL, 1, 3, '2026-06-06 09:54:38', '2026-06-06 09:54:38'),
(7, 'John Doe', 'chair person', 'zsxdfcghjk', NULL, NULL, 'aserdtfgyuhjikoloiytrdewqertyuiopiuytre', 'image/officials/1780755047_701dbe7435267513faa6.jpg', NULL, 1, 4, '2026-06-06 14:10:47', '2026-06-06 14:10:47'),
(8, 'precious namondwe', 'sdfghbnj', 'zsxdfcghjk', NULL, NULL, 'wertfyghjkl', 'image/officials/1780836776_615b70d01c959b77ecec.jpg', NULL, 1, 5, '2026-06-07 12:52:56', '2026-06-07 12:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `management_members`
--

CREATE TABLE `management_members` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `photo` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `management_members`
--

INSERT INTO `management_members` (`id`, `name`, `position`, `email`, `phone`, `bio`, `photo`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(6, 'Karen NANAI', 'sdxfcgvbhnj', 'bis22-pnamondwe@mubas.ac.mw', '0994567897', 'asdrtfghujswedrfgtyh90', NULL, 1, 1, '2026-06-06 08:30:23', '2026-06-06 10:32:34'),
(7, 'precious namondwe', 'aesrtydtrvst', 'bis22-pnamondwe@mubas.ac.mw', '0982348199', 'qQAESRTFGHUJ', NULL, 1, 2, '2026-06-06 09:02:33', '2026-06-06 09:02:33'),
(8, 'precious namondwe', 'qawsetgyhujiko', 'bis22-pnamondwe@mubas.ac.mw', '0982348199', 'awserfgyhujik', NULL, 1, 3, '2026-06-06 09:20:01', '2026-06-06 09:20:01'),
(9, 'precious namondwe', 'qawsetgyhujiko', 'bis22-pnamondwe@mubas.ac.mw', '0982348199', 'awserfgyhujik', NULL, 1, 4, '2026-06-06 09:22:42', '2026-06-06 09:22:42'),
(10, 'awsredtfyguhijo', 'qawsetgyhujiko', 'bis22-pnamondwe@mubas.ac.mw', '0982348199', 'WAESRDTGYUHJIKO', NULL, 1, 5, '2026-06-06 10:06:16', '2026-06-06 10:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `marriage_certificates`
--

CREATE TABLE `marriage_certificates` (
  `certificate_id` int(11) NOT NULL,
  `certificate_number` varchar(50) NOT NULL,
  `marriage_type` enum('Civil','Religious','Customary') NOT NULL,
  `groom_first_name` varchar(100) NOT NULL,
  `groom_last_name` varchar(100) NOT NULL,
  `groom_national_id` char(8) NOT NULL,
  `groom_foreign_passport` varchar(50) DEFAULT NULL,
  `groom_date_of_birth` date NOT NULL,
  `groom_origin_id` int(11) NOT NULL,
  `groom_current_residence` text NOT NULL,
  `groom_id_upload_front` varchar(255) DEFAULT NULL,
  `groom_id_upload_back` varchar(255) DEFAULT NULL,
  `groom_passport_bio_upload` varchar(255) DEFAULT NULL,
  `bride_first_name` varchar(100) NOT NULL,
  `bride_last_name` varchar(100) NOT NULL,
  `bride_national_id` char(8) NOT NULL,
  `bride_foreign_passport` varchar(50) DEFAULT NULL,
  `bride_date_of_birth` date NOT NULL,
  `bride_origin_id` int(11) NOT NULL,
  `bride_current_residence` text NOT NULL,
  `bride_id_upload_front` varchar(255) DEFAULT NULL,
  `bride_id_upload_back` varchar(255) DEFAULT NULL,
  `bride_passport_bio_upload` varchar(255) DEFAULT NULL,
  `notice_date_form_b` date NOT NULL,
  `permit_date_form_d` date DEFAULT NULL,
  `date_of_marriage` date NOT NULL,
  `place_of_marriage` varchar(255) NOT NULL,
  `officiating_officer` varchar(150) NOT NULL,
  `form_b_notice_document_upload` varchar(255) NOT NULL,
  `letter_of_no_impediment_upload` varchar(255) DEFAULT NULL,
  `groom_witness_id` int(11) NOT NULL,
  `bride_witness_id` int(11) NOT NULL,
  `registration_fee_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `acknowledgement_slip_issued` tinyint(1) DEFAULT 0,
  `status` enum('Pending Notice','Approved','Registered','Objected') DEFAULT 'Pending Notice',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marriage_certificates`
--

INSERT INTO `marriage_certificates` (`certificate_id`, `certificate_number`, `marriage_type`, `groom_first_name`, `groom_last_name`, `groom_national_id`, `groom_foreign_passport`, `groom_date_of_birth`, `groom_origin_id`, `groom_current_residence`, `groom_id_upload_front`, `groom_id_upload_back`, `groom_passport_bio_upload`, `bride_first_name`, `bride_last_name`, `bride_national_id`, `bride_foreign_passport`, `bride_date_of_birth`, `bride_origin_id`, `bride_current_residence`, `bride_id_upload_front`, `bride_id_upload_back`, `bride_passport_bio_upload`, `notice_date_form_b`, `permit_date_form_d`, `date_of_marriage`, `place_of_marriage`, `officiating_officer`, `form_b_notice_document_upload`, `letter_of_no_impediment_upload`, `groom_witness_id`, `bride_witness_id`, `registration_fee_paid`, `acknowledgement_slip_issued`, `status`, `created_at`, `updated_at`) VALUES
(11, 'BT/MC/2026/1C55CE', 'Civil', 'precious', 'namondwe', 'sdfghj', 'retyuij', '2026-06-06', 21, 'buying pain killer', 'nationalid/1780783140_a7364f1fd70989c36bae.jpg', 'nationalid/1780783140_e56118355942208a9f9c.jpg', 'nationalid/1780783140_1ab98766b737b1cafbda.jpg', 'precious', 'namondwe', 'AWRSEDTG', 'zsxdfgh', '2026-06-06', 22, 'buying pain killer', 'nationalid/1780783140_7b2f47022703477fdc14.jpg', 'nationalid/1780783140_d8430852737fa1ae1fdc.jpg', 'nationalid/1780783140_4b9cd15c3db6330349e6.jpg', '2026-06-18', '2026-06-10', '2026-06-06', 'aSDRTFGYUH', 'rdtfyguhiop', 'nationalid/1780783140_c89da0a4759b82c584df.jpg', 'nationalid/1780783140_d5be8d9b3d2a2d0ef7af.jpg', 21, 22, 0.00, 0, 'Pending Notice', '2026-06-06 21:59:03', '2026-06-07 08:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `marriage_witnesses`
--

CREATE TABLE `marriage_witnesses` (
  `witness_id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `national_id` char(8) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `village_name` varchar(100) NOT NULL,
  `traditional_authority` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `relationship_to_party` varchar(50) NOT NULL,
  `witness_id_upload_front` varchar(255) NOT NULL,
  `witness_id_upload_back` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marriage_witnesses`
--

INSERT INTO `marriage_witnesses` (`witness_id`, `full_name`, `national_id`, `phone_number`, `village_name`, `traditional_authority`, `district`, `relationship_to_party`, `witness_id_upload_front`, `witness_id_upload_back`, `created_at`) VALUES
(21, 'precious namondwe', 'asdfgh', '0982348199', 'sdfygh', 'dsxfcgvhb', 'sxdfgh', 'wsedrftgyhu', 'nationalid/1780783140_cdf4e1a78519912cdf95.jpg', 'nationalid/1780783140_8ddb7e52f36a742e05ac.jpg', '2026-06-06 21:59:03'),
(22, 'precious EvintraTech namondwe', 'zdxfcgvb', '0994567897', 'sedrftgy', 'sdrfg', 'zsxdcf', 'sdfgh', 'nationalid/1780783140_a996d60a0f92ea93f3bf.jpg', 'nationalid/1780783140_f60637bbccc2c3493585.jpg', '2026-06-06 21:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '20260226000000', 'App\\Database\\Migrations\\CreateInitialSchema', 'default', 'App', 1779202797, 1),
(2, '20260409113813', 'App\\Database\\Migrations\\CreateCompleteBackendSchema', 'default', 'App', 1779202801, 1),
(3, '20260409130000', 'App\\Database\\Migrations\\FixMissingUpdatedAtColumns', 'default', 'App', 1779202801, 1),
(4, '20260413140000', 'App\\Database\\Migrations\\CreateProjectsTable', 'default', 'App', 1779202801, 1),
(5, '20260511120000', 'App\\Database\\Migrations\\CreateElectedOfficialsTable', 'default', 'App', 1779202802, 1),
(6, '20260512110000', 'App\\Database\\Migrations\\CreateManagementMembersTable', 'default', 'App', 1779202802, 1),
(8, '20260520113000', 'App\\Database\\Migrations\\CreateBusinessLicensesTable', 'default', 'App', 1779543493, 2),
(9, '20260522140000', 'App\\Database\\Migrations\\CreateNewsTable', 'default', 'App', 1779543493, 2),
(10, '20260531120000', 'App\\Database\\Migrations\\CreateNoticesTable', 'default', 'App', 1780244983, 3),
(11, '20260603120000', 'App\\Database\\Migrations\\CreateBusinessTypesTable', 'default', 'App', 1780558978, 4);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'draft',
  `author_id` int(10) UNSIGNED DEFAULT 1,
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `featured_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `content`, `excerpt`, `status`, `author_id`, `published_at`, `created_at`, `updated_at`, `featured_image`) VALUES
(6, 'mytgrtgyui87y6t5r45ty6u7y6tr4', 'mytgrtgyui87y6t5r45ty6u7y6tr4', '][0po9u7y6u7i8o98u7y6yuio87y65y76ui8op097865y7uiop0-o8y6t5r45ty67uiop-0', '5y67i8op0', 'published', 1, '2026-06-06 14:33:00', '2026-06-06 14:34:24', '2026-06-06 14:34:24', ''),
(7, 'dfghjk', 'dfghjkgfdrdsfdgch', 'wsedrtfgyuhjik', 'sadfxgchjbkm', 'draft', 1, '2026-06-07 14:54:00', '2026-06-07 14:55:06', '2026-06-07 14:55:06', '');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'general',
  `urgency_level` enum('low','medium','high','urgent') NOT NULL DEFAULT 'medium',
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'draft',
  `author_id` int(11) UNSIGNED DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `title`, `slug`, `content`, `reference`, `category`, `urgency_level`, `status`, `author_id`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'TEMP TEST NOTICE 1780320589', 'temp-test-notice-1780320589', 'This is a temporary notice test.', 'TEST-1780320589', 'testing', 'low', 'draft', NULL, NULL, '2026-06-01 15:29:49', '2026-06-01 15:29:49'),
(2, 'Business', 'business', 'efgyhjk vicwqubonpmiwuhopjk', 'BL-REV-2026', 'Business License', 'urgent', 'published', 1, '2026-06-02 07:48:42', '2026-06-02 09:48:42', '2026-06-02 09:48:42'),
(3, 'close of xool due to heavy rains', 'close-of-xool-due-to-heavy-rains', 'dtfuygihojpk[ rtywugiohjpk[lwaertyuji', 'BL-REV-2026', 'General', 'urgent', 'draft', 1, '2026-06-02 07:55:25', '2026-06-02 09:55:25', '2026-06-06 16:04:39'),
(6, 'QAWSERTGYHUJIO', 'qawsertgyhujio', 'ASDFGHJKML,AESRDTFGYHUJIKOLBVFCDXSASDFG', 'ASDXFGHJK', 'Public Health', 'high', 'published', 1, '2026-06-06 14:04:23', '2026-06-06 16:03:17', '2026-06-06 16:04:23'),
(7, 'asdfghjkl;kjhgfdssedfghjk', 'asdfghjkl-kjhgfdssedfghjk', 'erdtfyhujikojhgfdsdrfghujkl', 'NTC-2026-43D1', 'General', 'medium', 'draft', 1, NULL, '2026-06-06 16:14:06', '2026-06-06 16:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `party_origins`
--

CREATE TABLE `party_origins` (
  `origin_id` int(11) NOT NULL,
  `village_name` varchar(100) NOT NULL,
  `traditional_authority` varchar(100) NOT NULL,
  `district` varchar(100) DEFAULT 'Blantyre',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `party_origins`
--

INSERT INTO `party_origins` (`origin_id`, `village_name`, `traditional_authority`, `district`, `created_at`) VALUES
(1, 'swerdtfghyujikol', 'sdxfcgvbhjmk', 'sedfgvhbjn', '2026-06-06 16:25:50'),
(2, 'dtfgyhuji', 'drtfgyhuji', 'Azsdxcfgvhb', '2026-06-06 16:25:51'),
(21, 'swerdtfghyujikol', 'QWAESRDTGYUJI', 'sedfgvhbjn', '2026-06-06 21:59:02'),
(22, 'dtfgyhuji', 'drtfgyhuji', 'Azsdxcfgvhb', '2026-06-06 21:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `location` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` enum('planning','ongoing','completed','suspended','cancelled') NOT NULL DEFAULT 'planning',
  `progress_percentage` int(11) DEFAULT 0,
  `start_date` date NOT NULL,
  `estimated_completion_date` date NOT NULL,
  `actual_completion_date` date DEFAULT NULL,
  `budget` decimal(15,2) NOT NULL DEFAULT 0.00,
  `spent_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `contractor` varchar(255) DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `fund_source` varchar(100) DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `location`, `category`, `status`, `progress_percentage`, `start_date`, `estimated_completion_date`, `actual_completion_date`, `budget`, `spent_amount`, `contractor`, `image_url`, `details`, `fund_source`, `created_by`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'Bridge', 'asdfghjkl', 'sxdfcghjk', 'brige', 'ongoing', 56, '2026-06-25', '2026-07-04', NULL, 23789.00, 20000000.00, 'evintra', NULL, NULL, 'gov', NULL, 1, '2026-06-05 06:40:47', '2026-06-06 13:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) UNSIGNED NOT NULL,
  `service_key` varchar(100) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `department` varchar(100) NOT NULL,
  `fee_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `processing_days` int(11) NOT NULL DEFAULT 5,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_key`, `service_name`, `description`, `department`, `fee_amount`, `processing_days`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'birth_certificate', 'Birth Certificate', 'Application for birth certificate', 'Health', 5000.00, 5, 1, 1, '2026-05-19 15:00:00', '2026-05-19 15:00:00'),
(2, 'death_certificate', 'Death Certificate', 'Application for death certificate', 'Health', 3000.00, 3, 1, 2, '2026-05-19 15:00:00', '2026-05-19 15:00:00'),
(3, 'marriage_certificate', 'Marriage Certificate', 'Application for marriage certificate', 'Registry', 10000.00, 7, 1, 3, '2026-05-19 15:00:00', '2026-05-19 15:00:00'),
(4, 'business_license', 'Business License', 'Application for business license', 'Commerce/Trade', 25000.00, 10, 1, 4, '2026-05-19 15:00:00', '2026-05-19 15:00:00'),
(5, 'property_rates', 'Property Rates Payment', 'Property rates payment and assessment', 'Finance', 0.00, 2, 1, 5, '2026-05-19 15:00:00', '2026-05-19 15:00:00'),
(6, 'complaint_reporting', 'Complaint Reporting', 'Report complaints and issues', 'General Administration', 0.00, 3, 1, 6, '2026-05-19 15:00:00', '2026-05-19 15:00:00'),
(7, 'firearm_license', 'Firearm License', 'Application for firearm license', 'Police', 15000.00, 14, 1, 7, '2026-05-19 15:00:00', '2026-05-19 15:00:00'),
(8, 'affidavits', 'Affidavits', 'Affidavit services and declarations', 'Legal', 2000.00, 2, 1, 8, '2026-05-19 15:00:00', '2026-05-19 15:00:00'),
(9, 'deceased_estates', 'Deceased Estates', 'Estate administration and probate', 'Legal', 5000.00, 10, 1, 9, '2026-05-19 15:00:00', '2026-05-19 15:00:00'),
(10, 'Divorce', 'Devorce Complaint', 'wertyuiopiuyfdsfghjkl;kjfdsdfghjkl', 'sdfghjk', 34000.00, 7, 1, 4, '2026-06-06 11:10:13', '2026-06-06 11:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `service_assignments`
--

CREATE TABLE `service_assignments` (
  `id` int(11) UNSIGNED NOT NULL,
  `service_key` varchar(100) NOT NULL,
  `assigned_user_id` int(11) UNSIGNED NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `role` enum('admin','department_head','staff','reviewer') NOT NULL DEFAULT 'staff',
  `department` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `full_name`, `role`, `department`, `phone`, `is_active`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@blantyredc.gov.mw', '$2y$10$bxQx93gtYe5Fm8wUb3sxaOyjeDZ6L4AXQvMX0R24E5IDnTa8BCOJK', 'System Administrator', 'admin', 'IT', '+265 1 822 000', 1, '2026-06-07 09:54:14', '2026-05-19 15:00:01', '2026-06-07 09:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `session_token` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `session_token`, `ip_address`, `user_agent`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 1, '5623c4822b22987f2288702cf5db51ed957ffee3991149d57dbdeaa933f06ef3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-05-26 15:07:07', '2026-05-19 15:07:07', '2026-05-19 15:07:07'),
(2, 1, '047b482d5e75250d3fa6a9da05135659fad9461d6ef13cf1662e7cf3a37d7886', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-05-27 06:40:52', '2026-05-20 06:40:52', '2026-05-20 06:40:52'),
(3, 1, '77fe24148ce884573c1e63763586c9f0c6fe0c1cdde89c143d317ff1cdae30c3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-05-27 09:15:52', '2026-05-20 09:15:52', '2026-05-20 09:15:52'),
(4, 1, '627105624b96a96704bd924e39dc4d30ca625797f54f4c68e81a76b7c569fc4b', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-05-27 09:40:49', '2026-05-20 09:40:49', '2026-05-20 09:40:49'),
(5, 1, 'aafb83654b94cdc152cea2482a776b29019533254728f0cfef99590234de33af', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-05-27 09:45:50', '2026-05-20 09:45:50', '2026-05-20 09:45:50'),
(6, 1, 'f9b926c2a1d36c364fc4e1144e1272dcfadc42556d5ad1be10546ae9832be2fa', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-05-27 09:50:01', '2026-05-20 09:50:01', '2026-05-20 09:50:01'),
(7, 1, '96e234d97aba8485f86e89345425e1dc6a4870466be71beeb4e7260cd847c20c', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-05-27 12:54:01', '2026-05-20 12:54:01', '2026-05-20 12:54:01'),
(8, 1, '4e4bd445d636bc1e14032b41dda0ecccdbf2b26ce90d92a6291d373ee505c29b', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-05-21 10:34:59', '2026-05-21 08:27:23', '2026-05-21 10:34:59'),
(9, 1, 'ed6e8568b947f7fd2b58acc542999caebc42c26001217604db80769cf93e47cd', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-05-21 12:25:52', '2026-05-21 10:35:02', '2026-05-21 12:25:53'),
(10, 1, 'c53442aeb4b058c8be40ed417212a84761243e2caeb37771867a7444f77aaa51', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-05-28 12:25:56', '2026-05-21 12:25:56', '2026-05-21 12:25:56'),
(11, 1, 'c5871b098e64d2d5512b3035f24b0e2bd41303f1c667996267fa3f15b68a1909', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-05-30 09:39:05', '2026-05-23 09:39:05', '2026-05-23 09:39:05'),
(12, 1, '39445b16d0fefe8a75c087add7f1100f6b4beca43f5da71e3e7008caf8b97fd2', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-05-30 12:21:35', '2026-05-23 12:21:35', '2026-05-23 12:21:35'),
(13, 1, '7ce61df55f143c95a1b7b6c8fecfb2658b0e85ace0a10550dc86fb463b3de9e3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-05-30 14:05:11', '2026-05-23 14:05:11', '2026-05-23 14:05:11'),
(14, 1, '648f2fdfed0e91190193503bc678a7b90a0f1d754ee45231d97197cd123ea4eb', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-01 11:43:53', '2026-05-25 11:43:53', '2026-05-25 11:43:53'),
(15, 1, 'e6277fcf64827ad3ba83ed6dbdf1339e0290e0144f7f9f1c27a72e7050e81aaa', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-02 06:11:25', '2026-05-26 06:11:25', '2026-05-26 06:11:25'),
(16, 1, '0e6512e75d672322b87c37c9914455b81b53dc1a9c1ebba44ceabe03bae27b3e', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 06:55:49', '2026-05-27 06:55:49', '2026-05-27 06:55:49'),
(17, 1, 'ff054ce40332070fe605fba2c045e530367ec7e2c2eccd6fe16138d5437f7ccc', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 09:17:08', '2026-05-27 09:17:08', '2026-05-27 09:17:08'),
(18, 1, 'c5417ddee9b54812e6c375e96bca34f2e2ab4ff2bf2576012de9f03665178abb', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-04 09:43:51', '2026-05-28 09:43:52', '2026-05-28 09:43:52'),
(19, 1, '0d3eb51a50a6b6e872d09eb1fd764301dd1ff1df5a581fe8efbfae8e8e26741e', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-04 12:14:11', '2026-05-28 12:14:11', '2026-05-28 12:14:11'),
(20, 1, '8d94bc4b91ee5f35f94e28045dc97144c60de7ab6836729eb073ab97496ee52c', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-05 06:30:09', '2026-05-29 06:30:09', '2026-05-29 06:30:09'),
(21, 1, '793089ed88051fe06457820902c61efc4394a76ce2c845dbf60d8c6150d2957b', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-07 16:02:35', '2026-05-31 16:02:35', '2026-05-31 16:02:35'),
(22, 1, '84085c29b5cd92dae36805f53d6374f2565e2fd27864a8fa9ccffc0dc00b68c1', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 07:58:45', '2026-06-01 07:58:45', '2026-06-01 07:58:45'),
(23, 1, '9a0942878eb8ed44acb73cd31f0b46ce4188e47d6035828c87c8c8ba7afac591', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-09 07:11:19', '2026-06-02 07:11:19', '2026-06-02 07:11:19'),
(24, 1, '63dfbc64eead0154d23897550fb439b29b8fdf501078b0bd3df2d481ad213bd4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-09 10:00:27', '2026-06-02 10:00:27', '2026-06-02 10:00:27'),
(25, 1, 'd41ef3a590db1797b65f1427d3e9b80d7570c60b60d5c513ef35ed2e0334ce4f', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-03 13:37:19', '2026-06-03 07:42:11', '2026-06-03 13:37:26'),
(26, 1, '816ed91977ae43900e7f76b7804f149f5c2e72a89a2f2af97ffba5ed68612059', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-10 13:37:35', '2026-06-03 13:37:35', '2026-06-03 13:37:35'),
(27, 1, 'e720ac5a247c4b91600400618bb937d01561054d5880bfd497fe67da3d1a5ca3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-11 07:41:45', '2026-06-04 07:41:45', '2026-06-04 07:41:45'),
(28, 1, '85759bfe22de8c998671f031a65d9d4da036205e60eb3112cb04452d8b5e9bf5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-11 14:23:19', '2026-06-04 14:23:19', '2026-06-04 14:23:19'),
(29, 1, 'cdff46649e74a0d3d3792e62f161b22b453faefd44848e45f7f763a854632551', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-11 19:55:49', '2026-06-04 19:55:49', '2026-06-04 19:55:49'),
(30, 1, 'dd5377855ca30f37cddc3791066a304df39023367a87bc8df3c386eb4430a0e5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-12 02:01:06', '2026-06-05 02:01:06', '2026-06-05 02:01:06'),
(31, 1, 'ca3c7a3e33b605a6fbe4bcb7056b82c1a7706d2b5e9775ef370593e2140f5ee0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-12 06:08:14', '2026-06-05 06:08:14', '2026-06-05 06:08:14'),
(32, 1, '6377b1ea39060262b84aae66a63d5caffc3698c56ca5e2c2f63ebeefc942459e', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-12 06:08:16', '2026-06-05 06:08:16', '2026-06-05 06:08:16'),
(33, 1, '159ffa6b4c117959995412d74336abbe7b2dd031fe2ece0d03eb854ed9c082a2', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-12 08:13:44', '2026-06-05 08:13:44', '2026-06-05 08:13:44'),
(34, 1, '1f3618e0640a608a310935e075940214173958e1aefcfcfcab3f48365a5d377b', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-12 08:34:27', '2026-06-05 08:34:27', '2026-06-05 08:34:27'),
(35, 1, '585d8b476fba11ec972fdf3d784e0a7e263633a2b0d37b05d1f1f18745d0aec2', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-12 11:44:24', '2026-06-05 11:44:24', '2026-06-05 11:44:24'),
(36, 1, '66b9b537240db97b3ebe8fa38b55688e6d0809916cd5d3555e61941c0a1ce042', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-12 11:53:30', '2026-06-05 11:53:30', '2026-06-05 11:53:30'),
(37, 1, 'b1138d309525e50de78cbe0a233c4a97628913c90787b230ba680c47b528e8b1', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-12 12:03:20', '2026-06-05 12:03:20', '2026-06-05 12:03:20'),
(38, 1, '5e223af904cd56368f2331b4dcd7977f557d25b93c32952b9c08cdf83085a6e1', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-12 12:12:19', '2026-06-05 12:12:19', '2026-06-05 12:12:19'),
(39, 1, '56c0ce35f00691a5531ab1288834c5e95b5a411fd6eafe044e129e3f16cc7d67', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-12 12:22:11', '2026-06-05 12:22:11', '2026-06-05 12:22:11'),
(40, 1, '8d5440154e6682bb8733e0f65c18a8c3ce16a3253213cd20c8b10a216da7eb4c', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-13 06:55:30', '2026-06-06 06:55:30', '2026-06-06 06:55:30'),
(41, 1, '9a25d6c702ce7a905afe2c61e5c5dd46cb48bf684214bc606b19ea55094da93b', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-13 09:01:56', '2026-06-06 09:01:56', '2026-06-06 09:01:56'),
(42, 1, '94d82fb4e5735f64272c7a726c77535d9b81c2b43a332627767eb3c37b311a5a', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-13 10:26:12', '2026-06-06 10:26:12', '2026-06-06 10:26:12'),
(43, 1, '547367e742fd99df06ef842fd72cb76841c2f75ab21684802af509cd009b087a', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-13 12:55:00', '2026-06-06 12:55:00', '2026-06-06 12:55:00'),
(44, 1, 'eb57689e35ece08088917383a16bf858e28b7f81c5604441d5e262443c1acaab', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-13 13:28:16', '2026-06-06 13:28:16', '2026-06-06 13:28:16'),
(45, 1, '9fead813d9419b549fd0350522163be0ced39a6ea0e8152fc9dbd85f7d34c58e', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-13 23:29:55', '2026-06-06 23:29:55', '2026-06-06 23:29:55'),
(46, 1, '1c06c05310dd807e2748f4f1f345a3246ee1e46e20e36c3ac8801ba2869ced01', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-13 23:34:13', '2026-06-06 23:34:13', '2026-06-06 23:34:13'),
(47, 1, 'f2bbfbd4b753948b06c9c64f58ab5e4c58b0b61f98d10330f2f8142c2bb562a3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-13 23:43:39', '2026-06-06 23:43:39', '2026-06-06 23:43:39'),
(48, 1, '070bc7d0acece90de2e353a8fd8f4925f675d6407a2bfee7986e9b569c8b5495', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-14 06:27:04', '2026-06-07 06:27:04', '2026-06-07 06:27:04'),
(49, 1, 'd9be96eba9f0c9b1f8662b1c36861b905654c6f117908535efa7c23b0e98a7e2', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', '2026-06-14 09:54:13', '2026-06-07 09:54:13', '2026-06-07 09:54:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses_application`
--
ALTER TABLE `businesses_application`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `application_code` (`application_code`),
  ADD KEY `fk_biz_app_reviewer_idx` (`assigned_reviewer_id`);

--
-- Indexes for table `chatbot_services`
--
ALTER TABLE `chatbot_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint_reports`
--
ALTER TABLE `complaint_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_complaint_application_idx` (`application_id`);

--
-- Indexes for table `elected_officials`
--
ALTER TABLE `elected_officials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `position` (`position`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `management_members`
--
ALTER TABLE `management_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `position` (`position`);

--
-- Indexes for table `marriage_certificates`
--
ALTER TABLE `marriage_certificates`
  ADD PRIMARY KEY (`certificate_id`),
  ADD UNIQUE KEY `certificate_number` (`certificate_number`),
  ADD KEY `groom_origin_id` (`groom_origin_id`),
  ADD KEY `bride_origin_id` (`bride_origin_id`),
  ADD KEY `groom_witness_id` (`groom_witness_id`),
  ADD KEY `bride_witness_id` (`bride_witness_id`);

--
-- Indexes for table `marriage_witnesses`
--
ALTER TABLE `marriage_witnesses`
  ADD PRIMARY KEY (`witness_id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `notices_author_id_foreign` (`author_id`),
  ADD KEY `status` (`status`),
  ADD KEY `published_at` (`published_at`),
  ADD KEY `urgency_level` (`urgency_level`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `party_origins`
--
ALTER TABLE `party_origins`
  ADD PRIMARY KEY (`origin_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_created_by_foreign` (`created_by`),
  ADD KEY `status` (`status`),
  ADD KEY `category` (`category`),
  ADD KEY `location` (`location`),
  ADD KEY `is_active` (`is_active`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_key` (`service_key`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `service_assignments`
--
ALTER TABLE `service_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_key` (`service_key`),
  ADD KEY `assigned_user_id` (`assigned_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_token` (`session_token`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesses_application`
--
ALTER TABLE `businesses_application`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chatbot_services`
--
ALTER TABLE `chatbot_services`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complaint_reports`
--
ALTER TABLE `complaint_reports`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `elected_officials`
--
ALTER TABLE `elected_officials`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `management_members`
--
ALTER TABLE `management_members`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `marriage_certificates`
--
ALTER TABLE `marriage_certificates`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `marriage_witnesses`
--
ALTER TABLE `marriage_witnesses`
  MODIFY `witness_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `party_origins`
--
ALTER TABLE `party_origins`
  MODIFY `origin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `service_assignments`
--
ALTER TABLE `service_assignments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `businesses_application`
--
ALTER TABLE `businesses_application`
  ADD CONSTRAINT `fk_biz_app_reviewer_users` FOREIGN KEY (`assigned_reviewer_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `marriage_certificates`
--
ALTER TABLE `marriage_certificates`
  ADD CONSTRAINT `marriage_certificates_ibfk_1` FOREIGN KEY (`groom_origin_id`) REFERENCES `party_origins` (`origin_id`),
  ADD CONSTRAINT `marriage_certificates_ibfk_2` FOREIGN KEY (`bride_origin_id`) REFERENCES `party_origins` (`origin_id`),
  ADD CONSTRAINT `marriage_certificates_ibfk_3` FOREIGN KEY (`groom_witness_id`) REFERENCES `marriage_witnesses` (`witness_id`),
  ADD CONSTRAINT `marriage_certificates_ibfk_4` FOREIGN KEY (`bride_witness_id`) REFERENCES `marriage_witnesses` (`witness_id`);

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE SET NULL;

--
-- Constraints for table `service_assignments`
--
ALTER TABLE `service_assignments`
  ADD CONSTRAINT `service_assignments_assigned_user_id_foreign` FOREIGN KEY (`assigned_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_assignments_service_key_foreign` FOREIGN KEY (`service_key`) REFERENCES `services` (`service_key`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
