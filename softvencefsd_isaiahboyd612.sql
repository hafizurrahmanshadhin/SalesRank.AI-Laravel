-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 29, 2025 at 08:22 AM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softvencefsd_isaiahboyd612`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_page_hero_sections`
--

CREATE TABLE `about_page_hero_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_page_hero_sections`
--

INSERT INTO `about_page_hero_sections` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Built by Sales Pros. Backed by Real Data.', '<p>Crafted by Sales Professionals, Powered by Cutting-Edge AI, and Backed by Real-World Data to Elevate Performance, Drive Growth, and Transform Sales Success.</p>', '2025-05-15 10:57:19', '2025-05-15 10:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `a_i_coach_page_hero_sections`
--

CREATE TABLE `a_i_coach_page_hero_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) NOT NULL,
  `sub_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `a_i_coach_page_hero_sections`
--

INSERT INTO `a_i_coach_page_hero_sections` (`id`, `title`, `image`, `description`, `banner`, `sub_title`, `sub_description`, `created_at`, `updated_at`) VALUES
(1, 'Your AI-Powered Sales Coach', 'seeder/aiavatar1.png', '<p>Get real-time coaching, script suggestions, and deal-closing strategies powered by advanced AI technology.</p>', 'seeder/aihero.png', 'Growth is our priority.', '<p>As a full-service business agency, we specialize in helping companies of all sizes optimize their operations.</p>', '2025-05-19 08:48:54', '2025-05-19 08:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `a_i_powered_insights`
--

CREATE TABLE `a_i_powered_insights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `a_i_powered_insights`
--

INSERT INTO `a_i_powered_insights` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Reward Fulfillment Services', '<p>Logistics and fulfillment solutions to handle the distribution of rewards to backers.</p>', 'active', '2025-05-18 09:58:58', '2025-05-18 09:58:58', NULL),
(2, 'Crowdfunding Campaign Audits', '<p>Professional review and feedback on campaign performance to identify areas of improvement.</p>', 'active', '2025-05-18 09:59:44', '2025-05-18 09:59:44', NULL),
(3, 'Project Boosting Features', '<p>Paid options to feature and boost projects on the platform\'s homepage and newsletters.</p>', 'active', '2025-05-18 10:00:07', '2025-05-18 10:00:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `a_i_prompts`
--

CREATE TABLE `a_i_prompts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `a_i_prompts`
--

INSERT INTO `a_i_prompts` (`id`, `title`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Keeping Sales Teams Thriving with Expert Performance Solutions.', 'seeder/salesteamimg.png', '2025-05-17 04:21:08', '2025-05-17 04:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'How a Top Sales Person Can Boost Your Business', 'We are the top digital marketing agency for branding corp. We offer a full range of services...', 'active', '2025-05-15 06:58:24', '2025-05-15 06:58:24', NULL),
(2, 'Why AI is the Future of Sales Performance', 'AI-driven insights are changing the way businesses hire and train top sales talent...', 'active', '2025-05-15 06:58:50', '2025-05-15 06:58:50', NULL),
(3, 'Maximizing Revenue with AI-Powered Sales Strategies', 'Learn how to leverage AI to increase revenue and improve sales team efficiency...', 'active', '2025-05-15 06:59:14', '2025-05-15 06:59:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs_previews`
--

CREATE TABLE `blogs_previews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs_previews`
--

INSERT INTO `blogs_previews` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'AI-Powered Sales Ranking & Performance Solutions That Drive Growth and Boost Revenue', '<p>Unlock the potential of your sales team with AI-driven insights, performance rankings, and industry benchmarks to accelerate growth and maximize revenue.</p>', '2025-05-14 11:47:23', '2025-05-14 11:47:23');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('86ed4f9a7f231187bf38b6b60c656eaad2661839', 'i:1;', 1748499697),
('86ed4f9a7f231187bf38b6b60c656eaad2661839:timer', 'i:1748499697;', 1748499697);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collaborations`
--

CREATE TABLE `collaborations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collaborations`
--

INSERT INTO `collaborations` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Frequently asked questions', '<p>Constant collaboration is how we roll. Let\'s see if we are a good fit.</p>', '2025-05-20 05:57:46', '2025-05-20 05:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `consultants`
--

CREATE TABLE `consultants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `total_experience` int(11) DEFAULT NULL,
  `tenure` int(11) DEFAULT NULL,
  `performance_keywords` tinyint(1) NOT NULL DEFAULT 0,
  `achievements` text DEFAULT NULL,
  `revenue_closed` varchar(255) DEFAULT NULL,
  `college_degree` tinyint(1) NOT NULL DEFAULT 0,
  `location` varchar(255) DEFAULT NULL,
  `ai_score` double DEFAULT NULL,
  `ranking_level` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consultants`
--

INSERT INTO `consultants` (`id`, `user_id`, `linkedin_url`, `full_name`, `job_title`, `company`, `industry`, `total_experience`, `tenure`, `performance_keywords`, `achievements`, `revenue_closed`, `college_degree`, `location`, `ai_score`, `ranking_level`, `created_at`, `updated_at`) VALUES
(1, NULL, 'https://www.linkedin.com/in/jordan-goldenberg-17a97911a?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAB2wAK4B20JJ-ThXckAOLXQvblzPMEtpklc&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people%3BCOYXuTQ0Q2uMO8PyRxPnMQ%3D%3D', 'Jordan Goldenberg', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 10, 1, 0, NULL, 'N/A', 0, 'St Louis, Missouri', 20, 'Needs Improvement', '2025-05-27 14:25:51', '2025-05-27 14:25:52'),
(2, NULL, 'https://www.linkedin.com/in/zach-vanzile?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAEWvOfUBgBzp94kigqcHyORac8tj9qKRs-Y&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people%3BCOYXuTQ0Q2uMO8PyRxPnMQ%3D%3D', 'Zach VanZile', 'Business Consultant PEO', 'Vensure Employer Solutions', 'PEO', 1, 1, 0, NULL, 'N/A', 0, 'Atlanta Metropolitan Area', 20, 'Needs Improvement', '2025-05-27 14:25:52', '2025-05-27 14:25:53'),
(3, NULL, 'https://www.linkedin.com/in/christian-knecht-608517b6?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABijH6gBzh6BohH1Ll5OoUtIh0-5e3Y7niw&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people%3BCOYXuTQ0Q2uMO8PyRxPnMQ%3D%3D', 'Christian Knecht', 'Sr. PEO Business Consultant', 'Congruity HR', 'PEO', 16, 1, 0, NULL, 'N/A', 0, 'Miami-Fort Lauderdale Area', 25, 'Needs Improvement', '2025-05-27 14:25:53', '2025-05-27 14:25:56'),
(4, NULL, 'https://www.linkedin.com/in/jonathan-garcia-61000b6a?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAA6YbawBqderfaS32dl7YwwMeP-QnDsTMZs&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people%3BCOYXuTQ0Q2uMO8PyRxPnMQ%3D%3D', 'Jonathan Garcia ', 'Paylocity Business consultant', 'Paylocity', 'PEO', 10, 2, 0, NULL, 'N/A', 0, 'Cerritos, California', 25, 'Needs Improvement', '2025-05-27 14:25:56', '2025-05-27 14:25:57'),
(5, NULL, 'https://www.linkedin.com/in/kaitlyn-mcdonald?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABHsjpsBqLTNAsfhlsJqzKbNaQWU5D_AvZE&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people%3BCOYXuTQ0Q2uMO8PyRxPnMQ%3D%3D', 'Kaitlyn McDonald', 'Senior Business Consultant', 'Nextep', 'PEO', 13, 5, 0, NULL, 'FY 2023 Over 146% ', 0, 'Dallas-Fort Worth Metroplex', 75, 'Strong Consultant', '2025-05-27 14:25:57', '2025-05-27 14:25:59'),
(6, NULL, 'https://www.linkedin.com/in/jenrell?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABqMF3oBKHyxOQzqEntk4x2d7rj5Cu1c-0U&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people%3BCOYXuTQ0Q2uMO8PyRxPnMQ%3D%3D', 'Jennifer Cocchiarelli', 'PEO Strategic Business Consultant', 'Paychex', 'PEO', 14, 1, 0, NULL, 'N/A', 1, 'United States', 45, 'Needs Improvement', '2025-05-27 14:25:59', '2025-05-27 14:26:00'),
(7, NULL, 'https://www.linkedin.com/in/ashleigh-looney-52b700162?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACbnNvMBq5MnsOVcoc9Edv1QzWMSCFGMQu0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people%3BCOYXuTQ0Q2uMO8PyRxPnMQ%3D%3D', 'Ashleigh Looney', 'Nextep PEO', 'Business Consultant', 'PEO', 11, 1, 0, NULL, 'N/A', 0, 'Boise, Idaho', 40, 'Needs Improvement', '2025-05-27 14:26:00', '2025-05-27 14:26:01'),
(8, NULL, 'https://www.linkedin.com/in/phil-schoenecke-aaa7265?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAD_NKIBC9cGSphkQxDbGkm4igDz2qHqBjs&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people%3BCOYXuTQ0Q2uMO8PyRxPnMQ%3D%3D', 'Phil Schoenecke', 'OneDigital | Resourcing Edge', 'Senior Business Consultant-PEO', 'PEO', 22, 3, 0, NULL, 'N/A', 0, 'Atlanta Metropolitan Area', 25, 'Needs Improvement', '2025-05-27 14:26:01', '2025-05-27 14:26:02'),
(9, NULL, 'https://www.linkedin.com/in/kate-eisenhauer-b9245a56?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAvQLx4BkAt45Br6uF9yLL5yreSjgmnrHBs&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people%3BCOYXuTQ0Q2uMO8PyRxPnMQ%3D%3D', 'Kate Eisenhauer', 'Paychex', 'PEO Business Consultant', 'PEO', 20, 3, 0, NULL, 'N/A', 1, 'Greater Milwaukee', 40, 'Needs Improvement', '2025-05-27 14:26:02', '2025-05-27 14:26:05'),
(10, NULL, 'https://www.linkedin.com/in/zacharywilkins1013?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACiu7-MBACP416v4ZSZcgXDFFL6Oy5NzLOM&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people%3BCOYXuTQ0Q2uMO8PyRxPnMQ%3D%3D', 'Zach Wilkins', 'Paychex PEO', 'Professional Business Consultant', 'PEO', 11, 1, 0, NULL, 'N/A', 0, 'Babylon, New York', 15, 'Needs Improvement', '2025-05-27 14:26:05', '2025-05-27 14:26:07'),
(11, NULL, 'https://www.linkedin.com/in/beatriz-torres-52272530?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAaDmqoBMnVWaR5WknJjbuEiU3J_ksXNrl8&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BIWQ7CTXyQkitDnZmiaowvw%3D%3D', 'Beatriz Torres', 'PEO Business Consultant', 'FrankCrum', 'PEO', 13, 1, 0, NULL, 'N/A', 0, 'Tampa, Florida', 40, 'Needs Improvement', '2025-05-27 14:26:07', '2025-05-27 14:26:08'),
(12, NULL, 'https://www.linkedin.com/in/brdickson?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAd6VMYBGYRoHJbTC24fKUMGvBZMYw6NqYk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BIWQ7CTXyQkitDnZmiaowvw%3D%3D', 'Brian Dickson', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 13, 4, 0, NULL, 'N/A', 1, 'Irvine, California', 40, 'Needs Improvement', '2025-05-27 14:26:08', '2025-05-27 14:26:09'),
(13, NULL, 'https://www.linkedin.com/in/william-hass-95610653?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAs6adIB188f1R4TvUmOc-NPsKD3OLPqKdY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BIWQ7CTXyQkitDnZmiaowvw%3D%3D', 'William Hass', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 11, 1, 0, NULL, 'Over $48,132 FY23', 1, 'Greater Chicago Area', 55, 'Average Performer', '2025-05-27 14:26:09', '2025-05-27 14:26:11'),
(14, NULL, 'https://www.linkedin.com/in/allisonkampapro?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAy9e2YBFBPu5C785OqLkfqZrB9SVp0pB_w&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BIWQ7CTXyQkitDnZmiaowvw%3D%3D', 'Allison Kampa', 'PEO Business Consultant', 'PRO Resources', 'PEO', 13, 4, 0, NULL, 'N/A', 0, 'St Cloud, Minnesota', 25, 'Needs Improvement', '2025-05-27 14:26:11', '2025-05-27 14:26:12'),
(15, NULL, 'https://www.linkedin.com/in/christopher-vaccaro-a6968b215?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAADZiMDEBxMdOx-AoKXsaF3RrV4jhIlPhink&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BIWQ7CTXyQkitDnZmiaowvw%3D%3D', 'Christopher Vaccaro', 'Business Consultant | PEO', 'CoAdvantage', 'PEO', 4, 1, 0, NULL, 'N/A', 0, 'Stuart, Florida', 35, 'Needs Improvement', '2025-05-27 14:26:12', '2025-05-27 14:26:13'),
(16, NULL, 'https://www.linkedin.com/in/kathryn-bobbitt?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACktZlABZ_5l8oL2omaaTuYkIzI2YAMCURk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BIWQ7CTXyQkitDnZmiaowvw%3D%3D', 'Katie Bobbitt', 'Senior Business Consultant', 'Nextep', 'PEO', 6, 1, 0, NULL, 'N/A', 0, 'Dallas-Fort Worth Metroplex', 20, 'Needs Improvement', '2025-05-27 14:26:13', '2025-05-27 14:26:14'),
(17, NULL, 'https://www.linkedin.com/in/adam-dingwell-503459b6?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABigpJMBtBAA8QZDFCyHVdLRBw7ysN6f1Ec&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BIWQ7CTXyQkitDnZmiaowvw%3D%3D', 'Adam Dingwell', 'Senior Business Consultant PEO', 'TrendHR', 'PEO', 10, 4, 0, NULL, 'Over 33.4% FY 2020', 0, 'Dallas-Fort Worth Metroplex', 75, 'High Performer', '2025-05-27 14:26:14', '2025-05-27 14:26:15'),
(18, NULL, 'https://www.linkedin.com/in/samantha-watkins-93978b190?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACz3K30B-E9tnYqzaGQYOWFj2hPAsXbL9aA&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BIWQ7CTXyQkitDnZmiaowvw%3D%3D', 'Samantha Watkins\n', 'Strategic Business Consultant', 'Paychex', 'PEO', 8, 1, 0, NULL, 'N/A', 0, 'Cincinnati Metropolitan Area', 20, 'Needs Improvement', '2025-05-27 14:26:15', '2025-05-27 14:26:16'),
(19, NULL, 'https://www.linkedin.com/in/sydneymkeith?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACSgf_oBF_dJOAs9swGF_GaX2YF1OF8_xlo&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BIWQ7CTXyQkitDnZmiaowvw%3D%3D', 'Sydney Keith', 'Business Consultant HR', 'Vensure Employer Solutions', 'PEO', 6, 2, 0, NULL, 'N/A', 0, 'Charlotte, North Carolina', 40, 'Needs Improvement', '2025-05-27 14:26:16', '2025-05-27 14:26:17'),
(20, NULL, 'https://www.linkedin.com/in/macie-lee2000?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAEa10_4B2rXdi3GALcMIJo058ia0CZ9LTYA&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BIWQ7CTXyQkitDnZmiaowvw%3D%3D', 'Macie Lee', 'Business Consultant', 'Nextep', 'PEO', 3, 1, 0, NULL, 'N/A', 0, 'Lenexa, Kansas', 30, 'Needs Improvement', '2025-05-27 14:26:17', '2025-05-27 14:26:19'),
(21, NULL, 'https://www.linkedin.com/in/teresa-witte-54829620?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAARQHIgBlyfUUKycZ5VEMokPAoYADXHhStA&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B7mOrCNPMRgW6nCnhX13Xjw%3D%3D', 'Teresa Witte', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 19, 12, 0, NULL, 'N/A', 0, 'Cincinnati, Ohio', 30, 'Needs Improvement', '2025-05-27 14:26:19', '2025-05-27 14:26:20'),
(22, NULL, 'https://www.linkedin.com/in/keeley-chmelik-90542a186?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACvYepUBo4I0Z1DrzbVV_D61cYa5ccR1xL0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B7mOrCNPMRgW6nCnhX13Xjw%3D%3D', 'Keeley Chmelik', 'Business Consultant', 'CoAdvantage', 'PEO', 13, 3, 0, NULL, 'N/A', 0, 'West Palm Beach, Florida', 15, 'Needs Improvement', '2025-05-27 14:26:20', '2025-05-27 14:26:27'),
(23, NULL, 'https://www.linkedin.com/in/andrew-gibson-nextep?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAa6kGQBwgmg49VX8SMVUkOGD93rZeJUUes&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B7mOrCNPMRgW6nCnhX13Xjw%3D%3D', 'Andrew Gibson', 'Business Consultant', 'Nextep', 'PEO', 13, 1, 0, NULL, 'N/A', 0, 'Nashville, Tennessee', 20, 'Needs Improvement', '2025-05-27 14:26:27', '2025-05-27 14:26:28'),
(24, NULL, 'https://www.linkedin.com/in/jasonagresta?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAB00elEBJxrOb2S506cnXTMg_8qZXH7dvmE&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B7mOrCNPMRgW6nCnhX13Xjw%3D%3D', 'Jason Agresta', 'Business Consultant', 'Paychex', 'PEO', 8, 5, 0, NULL, 'N/A', 1, 'Albany, New York Metropolitan Area', 35, 'Needs Improvement', '2025-05-27 14:26:28', '2025-05-27 14:26:29'),
(25, NULL, 'https://www.linkedin.com/in/samuel-spirk-a28786200?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAADNfSkAB9qBDr7fnOd5iveFtP4AC4FDwjCM&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B7mOrCNPMRgW6nCnhX13Xjw%3D%3D', 'Samuel Spirk', 'Business Consultant', 'VensureHR & Namely', 'PEO', 9, 1, 0, NULL, 'N/A', 0, 'Columbus, Ohio', 30, 'Needs Improvement', '2025-05-27 14:26:29', '2025-05-27 14:26:30'),
(26, NULL, 'https://www.linkedin.com/in/austinrobertsdtx?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACR7VcYBUDhyfB8yW9_ubVy-L_CJb-R8qRs&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B7mOrCNPMRgW6nCnhX13Xjw%3D%3D', 'Austin Roberts', 'Business Consultant', 'LL Roberts Group', 'PEO', 9, 9, 0, NULL, 'N/A', 0, 'Dallas, Texas', 25, 'Needs Improvement', '2025-05-27 14:26:30', '2025-05-27 14:26:33'),
(27, NULL, 'https://www.linkedin.com/in/brandon-mattison-207647157?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACWl7GcBsBtq8woWmHVXQOUgZdAGsOyR2y0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B7mOrCNPMRgW6nCnhX13Xjw%3D%3D', 'Brandon Mattison', 'Senior Business Consultant', 'Buford, Georgia', 'PEO', 3, 8, 0, NULL, 'N/A', 0, 'Buford, Georgia', 30, 'Needs Improvement', '2025-05-27 14:26:33', '2025-05-27 14:26:34'),
(28, NULL, 'https://www.linkedin.com/in/zac-johnson-308a481a?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAQR07gBbw8FHGBL_7FFAUmXCcu3D8s9AQs&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B7mOrCNPMRgW6nCnhX13Xjw%3D%3D', 'Zac Johnson', 'Senior Business Consultant', 'LBMC Employment Partners\n', 'PEO', 17, 2, 0, NULL, 'N/A', 1, 'Nashville, Tennessee', 25, 'Needs Improvement', '2025-05-27 14:26:34', '2025-05-27 14:26:36'),
(29, NULL, 'https://www.linkedin.com/in/dpallares?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACuhEhUBWgfRKgkzsT0ZJynd01bJ6AZkX7c&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B7mOrCNPMRgW6nCnhX13Xjw%3D%3D', 'David Pallares', 'Business Consultant', 'Nextep', 'PEO', 8, 1, 0, NULL, 'N/A', 0, 'Fort Worth, Texas', 20, 'Needs Improvement', '2025-05-27 14:26:36', '2025-05-27 14:26:37'),
(30, NULL, 'https://www.linkedin.com/in/matthentschel?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAVdU6QBh-Xosvz5AU16K4E1v8pxHrE3PfI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BabkRbx9eQkGROTKKm%2BhNbw%3D%3D', 'Matt Hentschel', 'Business Consultant', 'Sequoia', 'PEO', 15, 3, 0, NULL, 'N/A', 1, 'Livermore, California', 60, 'Average Performer', '2025-05-27 14:26:37', '2025-05-27 14:26:39'),
(31, NULL, 'https://www.linkedin.com/in/chris-hill-paychex?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAD2OZIBysONPV97CnupODVxDfrkZD6jLtI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BabkRbx9eQkGROTKKm%2BhNbw%3D%3D', 'Chris Hill', 'Strategic Business Consultant', 'Paychex', 'PEO', 21, 17, 0, NULL, 'N/A', 0, 'New Haven, Connecticut', 45, 'Needs Improvement', '2025-05-27 14:26:39', '2025-05-27 14:26:40'),
(32, NULL, 'https://www.linkedin.com/in/rob-smits-mba?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAueUEYBgzJ3I09H9JUapdFWL7di6qITPhI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BabkRbx9eQkGROTKKm%2BhNbw%3D%3D', 'Rob Smits', 'Business Consultant', 'ADP', 'PEO', 6, 1, 0, NULL, 'N/A', 0, 'Los Angeles Metropolitan Area', 30, 'Needs Improvement', '2025-05-27 14:26:40', '2025-05-27 14:26:41'),
(33, NULL, 'https://www.linkedin.com/in/matt-sternberger-5888893?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAACp1_gBuBcUfS9F5hopoW72-LdRjxJANCk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BabkRbx9eQkGROTKKm%2BhNbw%3D%3D', 'Matt Sternberger', 'Business Consultant', 'OneDigital ', 'PEO', 20, 1, 0, NULL, 'N/A', 0, 'Washington DC-Baltimore Area', 40, 'Needs Improvement', '2025-05-27 14:26:41', '2025-05-27 14:26:43'),
(34, NULL, 'https://www.linkedin.com/in/andrea-persson-0784495?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAD0gRwB7OIbr0GFLDsBwR7jQx_N182fWbk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BabkRbx9eQkGROTKKm%2BhNbw%3D%3D', 'Irvine, California', 'Business Consultant', 'CoAdvantage', 'PEO', 24, 1, 0, NULL, 'N/A', 0, 'Irvine, California', 40, 'Needs Improvement', '2025-05-27 14:26:43', '2025-05-27 14:26:46'),
(35, NULL, 'https://www.linkedin.com/in/shgarcia?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAPZeHQBhPj7QRAMwHXX2SB-ioKPiDA_mss&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BabkRbx9eQkGROTKKm%2BhNbw%3D%3D', 'Steven Garcia', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 15, 2, 0, NULL, 'Highest revenue year $711k sold', 0, 'Los Angeles Metropolitan Area', 75, 'Strong Consultant', '2025-05-27 14:26:46', '2025-05-27 14:26:48'),
(36, NULL, 'https://www.linkedin.com/in/mikesabogal?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABUZtnABvhjxT5nJF3UQ3k7QxxsIb42KEuE&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BabkRbx9eQkGROTKKm%2BhNbw%3D%3D', 'Mike S.', 'Sr. Business Consultant PEO', 'OneDigital', 'PEO', 9, 1, 0, NULL, 'N/A', 1, 'United States', 45, 'Needs Improvement', '2025-05-27 14:26:48', '2025-05-27 14:26:49'),
(37, NULL, 'https://www.linkedin.com/in/adam-raiford-7aa085b4?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABg3LjIBIXtd7YRKinyh7LO0iGiCjImhqc0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BabkRbx9eQkGROTKKm%2BhNbw%3D%3D', 'Adam Raiford', 'Strategic Business Consultant', 'Paychex', 'PEO', 10, 1, 0, NULL, 'N/A', 1, 'Austin, Texas', 30, 'Needs Improvement', '2025-05-27 14:26:49', '2025-05-27 14:26:51'),
(38, NULL, 'https://www.linkedin.com/in/rick-kappel-m-s-c-s-c-s-3255164b?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAqTp00BRuuwQyThrs5OYyhTioFONO0F9F4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BabkRbx9eQkGROTKKm%2BhNbw%3D%3D', 'Rick Kappel', 'Sr. Business Consultant PEO', 'OneDigital | Resourcing Edge', 'PEO', 21, 3, 0, NULL, 'N/A', 0, 'Tomball, Texas', 35, 'Needs Improvement', '2025-05-27 14:26:51', '2025-05-27 14:26:53'),
(39, NULL, 'https://www.linkedin.com/in/mikeharper?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAA9oh8B7f0T5O1PXHJWXNRzu9z0lH3AR4U&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BQcJc%2BkyMR92vyih%2FH2%2BYJQ%3D%3D', 'Michael Harper', 'Business Consultant', 'Sequoia', 'PEO', 21, 1, 0, NULL, 'N/A', 0, 'Los Angeles Metropolitan Area', 35, 'Needs Improvement', '2025-05-27 14:26:53', '2025-05-27 14:26:54'),
(40, NULL, 'https://www.linkedin.com/in/doug-bransfield-1714356?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAEhpaUBUFpbd1L7xOIR5seiTJ_pV_8M3-Q&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BQcJc%2BkyMR92vyih%2FH2%2BYJQ%3D%3D', 'Doug Bransfield', 'Senior Business Consultant', 'Vensure Employer Solutions', 'PEO', 29, 2, 0, NULL, 'N/A', 0, 'Miami-Fort Lauderdale Area', 20, 'Needs Improvement', '2025-05-27 14:26:54', '2025-05-27 14:26:55'),
(41, NULL, 'https://www.linkedin.com/in/kimberlydrozdoff?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAASfF1MBCFU8DlJEWMD6IfEEC9SxPS-oRjA&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BQcJc%2BkyMR92vyih%2FH2%2BYJQ%3D%3D', 'Kimberly Drozdoff', 'Business Consultant', 'Sequoia', 'PEO', 15, 1, 0, NULL, 'N/A', 0, 'San Diego County, California', 25, 'Needs Improvement', '2025-05-27 14:26:55', '2025-05-27 14:26:57'),
(42, NULL, 'https://www.linkedin.com/in/ashleemckeon?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAQYymcByBTGU9JC3WMCXoZ7zECsqrjo_JA&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BQcJc%2BkyMR92vyih%2FH2%2BYJQ%3D%3D', 'Ashlee McKeon', 'Business Strategist', 'CoAdvantage', 'PEO', 21, 1, 0, NULL, 'N/A', 0, 'Charlotte Metro', 10, 'Needs Improvement', '2025-05-27 14:26:57', '2025-05-27 14:26:58'),
(43, NULL, 'https://www.linkedin.com/in/kelsey-johnson-245306119?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAB1pXdUBbz01x0B7JEp0errdGU4wPMA788g&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BQcJc%2BkyMR92vyih%2FH2%2BYJQ%3D%3D', 'Kelsey Johnson', 'PEO Strategic Business Consultant', 'Denver, Colorado', 'PEO', 7, 2, 0, NULL, 'N/A', 0, 'Denver, Colorado', 30, 'Needs Improvement', '2025-05-27 14:26:58', '2025-05-27 14:27:01'),
(44, NULL, 'https://www.linkedin.com/in/hollyquintanapaychex?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABExS2MBHK1w6tLjermB94GJLY_3nKbOIeg&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BQcJc%2BkyMR92vyih%2FH2%2BYJQ%3D%3D', 'Holly Quintana', 'PEO Business Consultant', 'CoAdvantage', 'PEO', 19, 1, 0, NULL, 'N/A', 1, 'Winchester, California', 55, 'Average Performer', '2025-05-27 14:27:01', '2025-05-27 14:27:02'),
(45, NULL, 'https://www.linkedin.com/in/kory-lutes-91446377?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABBDX2ABH7NyuP90DCz3r53Tu-PpyCbn0RM&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BQcJc%2BkyMR92vyih%2FH2%2BYJQ%3D%3D', 'Kory Lutes', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 13, 1, 0, NULL, 'N/A', 0, 'Orlando, Florida', 40, 'Needs Improvement', '2025-05-27 14:27:02', '2025-05-27 14:27:04'),
(46, NULL, 'https://www.linkedin.com/in/tamkennedy?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAE0JCABsl6X8oChmKzEdBOS0S_o9QGDD4k&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BQcJc%2BkyMR92vyih%2FH2%2BYJQ%3D%3D', 'Tammy Kennedy', 'Business Consultant', 'OneDigital', 'PEO', 23, 2, 0, NULL, 'N/A', 0, 'Fort Lauderdale, Florida', 35, 'Needs Improvement', '2025-05-27 14:27:04', '2025-05-27 14:27:05'),
(47, NULL, 'https://www.linkedin.com/in/maximillian-reinhardt-364699203?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAADPkj7wBPPX79yRSewfBQbtd7JC4Ehqd6jQ&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BCcJSPrYwSjmggf8pJfdMZA%3D%3D', 'Maximillian Reinhardt', 'Strategic Business Consultant', 'Paychex', 'PEO', 8, 1, 0, NULL, 'N/A', 1, 'Hollywood, Florida', 65, 'Average Performer', '2025-05-27 14:27:05', '2025-05-27 14:27:06'),
(48, NULL, 'https://www.linkedin.com/in/misti-williams-phr-shrm-cp-893082a9?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABb4Km8BPMwvpXg3XC2jw_au4AgmFPMZh-o&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BCcJSPrYwSjmggf8pJfdMZA%3D%3D', 'Misti Williams', 'Business Consultant', 'Paychex', 'PEO', 34, 3, 0, NULL, 'N/A', 0, 'Mabank, Texas', 25, 'Needs Improvement', '2025-05-27 14:27:06', '2025-05-27 14:27:07'),
(49, NULL, 'https://www.linkedin.com/in/kevenewing?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAABUH-kB0z5tyvJ3I1qvhPx2MiWPPUo6SSk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BCcJSPrYwSjmggf8pJfdMZA%3D%3D', 'Keven Ewing', 'Small Business Consultant', 'Paychex', 'PEO', 37, 1, 0, NULL, 'N/A', 0, 'Sarasota, Florida', 30, 'Needs Improvement', '2025-05-27 14:27:07', '2025-05-27 14:27:10'),
(50, NULL, 'https://www.linkedin.com/in/mackenziedutton?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABh9u7cBAt43U2_kO9SebMaDvxmCsoR4eh8&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BCcJSPrYwSjmggf8pJfdMZA%3D%3D', 'Mackenzie Dutton', 'Strategic Business Consultant', 'Paychex', 'PEO', 9, 1, 0, NULL, 'N/A', 0, 'Temecula, California', 30, 'Needs Improvement', '2025-05-27 14:27:10', '2025-05-27 14:27:12'),
(51, NULL, 'https://www.linkedin.com/in/dinkobosnic?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABOmwgYBqRm380_Tvfmfb4QQ6P70e6gmXBc&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BCcJSPrYwSjmggf8pJfdMZA%3D%3D', 'Dinko Bosnic', 'Strategic Business Consultant', 'Paychex', 'PEO', 2, 12, 0, NULL, 'Over 19% FY21', 0, 'St Louis, Missouri', 70, 'Strong Consultant', '2025-05-27 14:27:12', '2025-05-27 14:27:14'),
(52, NULL, 'https://www.linkedin.com/in/cassandranovak?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAEwLlgBYOcn_F0LxtH8y2YvsZB9pQLerGE&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BCcJSPrYwSjmggf8pJfdMZA%3D%3D', 'Cassandra Novak', 'Business Development Specialist PEO', 'Savoy Associates', 'PEO', 25, 3, 0, NULL, 'N/A', 0, 'New York, New York', 30, 'Needs Improvement', '2025-05-27 14:27:14', '2025-05-27 14:27:16'),
(53, NULL, 'https://www.linkedin.com/in/chad-blenden?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAJd7l8BdqFMO5E8G9csThT_-dyal0-FeOs&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BCcJSPrYwSjmggf8pJfdMZA%3D%3D', 'Chad Blenden', 'HR Solutions Consultant', 'Vensure Employer Solutions', 'PEO', 27, 1, 0, NULL, 'N/A', 1, 'Metro Jacksonville', 65, 'Average Performer', '2025-05-27 14:27:16', '2025-05-27 14:27:19'),
(54, NULL, 'https://www.linkedin.com/in/jessica-kellem?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAxjxnYBR9Lr5NIbw3PZcUscbUVWef8yh9Q&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BCcJSPrYwSjmggf8pJfdMZA%3D%3D', 'Jessica Kellem', 'Strategic Business Consultant-PEO', 'Paychex', 'PEO', 13, 1, 0, NULL, 'N/A', 0, 'Denver, Colorado', 40, 'Needs Improvement', '2025-05-27 14:27:19', '2025-05-27 14:27:21'),
(55, NULL, 'https://www.linkedin.com/in/alex-e-0390ab15a?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACYZ1G0BW3K4G8RMTfyIv9aItIROpM3eIq4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BCcJSPrYwSjmggf8pJfdMZA%3D%3D', 'Alex E.', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 12, 1, 0, NULL, 'N/A', 0, 'Clermont, Florida', 20, 'Needs Improvement', '2025-05-27 14:27:21', '2025-05-27 14:27:24'),
(56, NULL, 'https://www.linkedin.com/in/skye-neumann?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABzpUqgBzZl_iV9yTBowmIYdPywc4BpMDH4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhoKf4PWRReuQyMqMMLV3bw%3D%3D', 'Skye Neumann', 'Senior Strategic Business Consultant', 'Paychex', 'PEO', 12, 5, 0, NULL, 'Over 103% FY22', 0, 'Jacksonville, Florida', 85, 'High Performer', '2025-05-27 14:27:24', '2025-05-27 14:27:26'),
(57, NULL, 'https://www.linkedin.com/in/melodie-savoia-shrm-hcma-b1215a43?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAkZWr4BdHX7xr5ZmkGT4ttJDY4xyROLaw4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhoKf4PWRReuQyMqMMLV3bw%3D%3D', 'Melodie Savoia', 'Business Consultant', 'Paychex', 'PEO', 19, 4, 0, NULL, 'N/A', 0, 'United States', 30, 'Needs Improvement', '2025-05-27 14:27:26', '2025-05-27 14:27:28'),
(58, NULL, 'https://www.linkedin.com/in/merritt-nissen-181744114?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAByV8_EBEwpxbBA0qvTS0GxXHNA-S9tLjTA&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhoKf4PWRReuQyMqMMLV3bw%3D%3D', 'Merritt Nissen', 'Business Consultant', 'Paychex', 'PEO', 13, 2, 0, NULL, 'N/A', 0, 'Houston, Texas', 45, 'Needs Improvement', '2025-05-27 14:27:28', '2025-05-27 14:27:30'),
(59, NULL, 'https://www.linkedin.com/in/mattnuetzman?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAL6gt8BhCM2a9fx6NUVg7mr5PQyTzKqC-M&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhoKf4PWRReuQyMqMMLV3bw%3D%3D', 'Matt Nuetzman', 'Senior Strategic Business Consultant', 'Paychex HR', 'PEO', 12, 22, 0, NULL, 'N/A', 0, 'Dallas County, Iowa', 30, 'Needs Improvement', '2025-05-27 14:27:30', '2025-05-27 14:27:33'),
(60, NULL, 'https://www.linkedin.com/in/reza-paknejad-a558b559?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAxp0qEBGWsNO_NatmLT2CMT0W3VY8F4Yiw&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhCCOa%2BWETNS9knphqFyA5g%3D%3D', 'Reza Paknejad ', 'Business Consultant', 'CoAdvantage', 'PEO', 17, 7, 0, NULL, 'N/A', 0, 'Dallas, Texas', 40, 'Needs Improvement', '2025-05-27 14:27:33', '2025-05-27 14:27:34'),
(61, NULL, 'https://www.linkedin.com/in/kimbelsen?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAgXAg8BHFSmAOnlTRXopcVpj-OmVQ3sVwM&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhCCOa%2BWETNS9knphqFyA5g%3D%3D', 'Kim Phillips', 'Business Consultant', 'FrankCrum', 'PEO', 14, 3, 0, NULL, 'N/A', 1, 'United States', 60, 'Average Performer', '2025-05-27 14:27:34', '2025-05-27 14:27:35'),
(62, NULL, 'https://www.linkedin.com/in/justineabbate?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAC0WeSgBNfrG51f3kR-Lcf5KDdE9egwcRCI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhCCOa%2BWETNS9knphqFyA5g%3D%3D', 'Justine Abbate', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 4, 12, 0, NULL, 'N/A', 0, 'New York, New York', 25, 'Needs Improvement', '2025-05-27 14:27:35', '2025-05-27 14:27:36'),
(63, NULL, 'https://www.linkedin.com/in/bonnie-fan-65672036?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAeU2aIB5pVu7HllQC7EG4_LoKSb0kZFCDc&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhCCOa%2BWETNS9knphqFyA5g%3D%3D', 'Bonnie Fan', 'Business Consultant', 'ProService Hawaii', 'PEO', 21, 8, 0, NULL, 'N/A', 0, 'San Diego, California', 30, 'Needs Improvement', '2025-05-27 14:27:36', '2025-05-27 14:27:37'),
(64, NULL, 'https://www.linkedin.com/in/carletonabutler?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAQGvdIBYkpnv4tky2QKWBq9pVOrNeFGjLQ&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhCCOa%2BWETNS9knphqFyA5g%3D%3D', 'Carleton Butler', 'Sr. Business Strategist', 'Paychex', 'PEO', 15, 1, 0, NULL, 'N/A', 1, 'Orlando, Florida', 35, 'Needs Improvement', '2025-05-27 14:27:37', '2025-05-27 14:27:38'),
(65, NULL, 'https://www.linkedin.com/in/scott-seidman-373397b?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAIDnkcBqu8cyDpeVOZj09vUUMg6VaEzqe0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhCCOa%2BWETNS9knphqFyA5g%3D%3D', 'Scott Seidman', 'Samall Business Consultant', 'Now doing outside consulting for small businesses · Self-employed', 'PEO', 27, 1, 0, NULL, 'N/A', 0, 'Edison, New Jersey', 25, 'Needs Improvement', '2025-05-27 14:27:38', '2025-05-27 14:27:40'),
(66, NULL, 'https://www.linkedin.com/in/rhonda-ryan-281653a?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAHgEsEBu79IAW90tbY-auC2cEb5SajxDJQ&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhCCOa%2BWETNS9knphqFyA5g%3D%3D', 'Rhonda Ryan', 'Senior Business Sales Consultant', 'Paychex', 'PEO', 30, 20, 0, NULL, 'N/A', 0, 'Covington, Louisiana', 40, 'Needs Improvement', '2025-05-27 14:27:40', '2025-05-27 14:27:41'),
(67, NULL, 'https://www.linkedin.com/in/kirstie-krinhop-1b7692136?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACE0T5sBF3iP9XEp0g7gzkKxN8LpT6yJEvA&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhCCOa%2BWETNS9knphqFyA5g%3D%3D', 'Kirstie Krinhop', 'PEO Strategic Business Consultant', 'Paychex', 'PEO', 11, 3, 0, NULL, 'N/A', 0, 'Austin, Texas', 20, 'Needs Improvement', '2025-05-27 14:27:41', '2025-05-27 14:27:42'),
(68, NULL, 'https://www.linkedin.com/in/marionpenn?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAADz8DkB_iSQnJKUqpFvwMpN4zHnGo-HFb4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhCCOa%2BWETNS9knphqFyA5g%3D%3D', 'Marion A. Penn', 'Strategic Business Consultant', 'Paychex', 'PEO', 17, 5, 0, NULL, 'N/A', 0, 'Greater Chicago Area', 10, 'Needs Improvement', '2025-05-27 14:27:42', '2025-05-27 14:27:44'),
(69, NULL, 'https://www.linkedin.com/in/gustavo-hernandez-7353a0b8?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABj5UhkBBoAFAD4ft4ywhJ72b5DyMLx7fhI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BZdEdtW%2BwQTiPVucjT%2F36VQ%3D%3D', 'Gustavo Hernandez', 'Business Consultant', 'CoAdvantage', 'PEO', 9, 2, 0, NULL, 'N/A', 0, 'New York, New York', 25, 'Needs Improvement', '2025-05-27 14:27:44', '2025-05-27 14:27:45'),
(70, NULL, 'https://www.linkedin.com/in/julia-albrich-705641105?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABqc5rUBa0W_ceA3aH67kOIENwTz5IEDjy4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BZdEdtW%2BwQTiPVucjT%2F36VQ%3D%3D', 'Julia Albrich', 'Business Consultant', 'Paychex', 'PEO', 9, 3, 0, NULL, 'N/A', 1, 'Vancouver, Washington', 60, 'Average Performer', '2025-05-27 14:27:45', '2025-05-27 14:27:46'),
(71, NULL, 'https://www.linkedin.com/in/nate-pinkard-20439665?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAA3CtqQB1s3GVWxaw1nRSLjGZWrSq0gJu8c&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BZdEdtW%2BwQTiPVucjT%2F36VQ%3D%3D', 'Nate Pinkard', 'Business Partner/Consultant', 'Premier HR Strategies, LLC', 'PEO', 27, 2, 0, NULL, 'N/A', 0, 'Atlanta, Georgia', 40, 'Needs Improvement', '2025-05-27 14:27:46', '2025-05-27 14:27:49'),
(72, NULL, 'https://www.linkedin.com/in/christian-clarke-63a91b208?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAADTRSs4BzoFQW0C2Jw_MtDZsmfBjPi2J3hw&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BZdEdtW%2BwQTiPVucjT%2F36VQ%3D%3D', 'Christian Clarke', 'PEO Strategic Business Consultant', 'Paychex', 'PEO', 3, 1, 0, NULL, 'N/A', 0, 'Georgetown, Texas', 25, 'Needs Improvement', '2025-05-27 14:27:49', '2025-05-27 14:27:51'),
(73, NULL, 'https://www.linkedin.com/in/jfreese?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAABGtpsBr_7IGwBzGELRDog9oz1gQZzmUZk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BZdEdtW%2BwQTiPVucjT%2F36VQ%3D%3D', 'Jesse Freese', 'Senior Business Consultant', 'Sequoia Consulting Group', 'PEO', 28, 9, 0, NULL, 'N/A', 0, 'Lafayette, California', 40, 'Needs Improvement', '2025-05-27 14:27:51', '2025-05-27 14:27:52'),
(74, NULL, 'https://www.linkedin.com/in/dannysieversfl?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAADxv56AB2Jy_kokaUHTa9ewIKUznh6bNQ-8&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BZdEdtW%2BwQTiPVucjT%2F36VQ%3D%3D', 'Business Consultant', 'Business Consultant', 'CoAdvantage', 'PEO', 3, 3, 0, NULL, 'N/A', 0, 'Boca Raton, Florida', 30, 'Needs Improvement', '2025-05-27 14:27:52', '2025-05-27 14:27:53'),
(75, NULL, 'https://www.linkedin.com/in/dean-clifford-ab289861?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAA0fhSYB62yFmsv0megWLSYqP5cDITNRchk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BZdEdtW%2BwQTiPVucjT%2F36VQ%3D%3D', 'Dean Clifford', 'P.E.O. Strategist & Business Consultant', 'Paychex', 'PEO', 21, 5, 0, NULL, 'N/A', 1, 'Temple, Texas', 50, 'Average Performer', '2025-05-27 14:27:53', '2025-05-27 14:27:54'),
(76, NULL, 'https://www.linkedin.com/in/christie-getuiza-maom-29451822?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAS0JJABERKawsoV3aN4cK2GSj2ULw1JfAI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BZdEdtW%2BwQTiPVucjT%2F36VQ%3D%3D', 'Christie Getuiza', 'Business Partner/HR Consultant', 'HR Outsourcing Services', 'PEO', 27, 5, 0, NULL, 'N/A', 0, 'San Francisco Bay Area', 45, 'Needs Improvement', '2025-05-27 14:27:54', '2025-05-27 14:27:55'),
(77, NULL, 'https://www.linkedin.com/in/justin-ramirez-95952560?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAzkRRUBnO7Ycf-S4OApMZgymYM8c_6rYIM&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bco9RlXLlRXC2ptYkvIOWUQ%3D%3D', 'Justin Ramirez', 'Business Consultant', 'CoAdvantage', 'PEO', 20, 2, 0, NULL, 'N/A', 0, 'Cypress, Texas', 20, 'Needs Improvement', '2025-05-27 14:27:55', '2025-05-27 14:27:58'),
(78, NULL, 'https://www.linkedin.com/in/ramy-sindi?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAu9ZVoBSSp2eTMHPHxA0vJ4kHKUkgkNC6A&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bco9RlXLlRXC2ptYkvIOWUQ%3D%3D', 'Ramy Sindi', 'Business Consultant', 'PEO Analysis', 'PEO', 18, 1, 0, NULL, 'N/A', 0, 'Tampa, Florida', 20, 'Needs Improvement', '2025-05-27 14:27:58', '2025-05-27 14:27:59'),
(79, NULL, 'https://www.linkedin.com/in/emily-peardon-98293534?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAdBxjIBJglT0r97VwsA6-UTMZ7slRcVD3w&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bco9RlXLlRXC2ptYkvIOWUQ%3D%3D', 'Emily Peardon', 'Business Consultant', 'CoAdvantage', 'PEO', 18, 1, 0, NULL, 'N/A', 1, 'Anaheim, California', 45, 'Needs Improvement', '2025-05-27 14:27:59', '2025-05-27 14:28:00'),
(80, NULL, 'https://www.linkedin.com/in/ryan-kerns-91a9a51a?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAQP3OYBTEl5cSvPGI5x5DzUGa_muqNZXG0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bco9RlXLlRXC2ptYkvIOWUQ%3D%3D', 'Ryan Kerns', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 24, 1, 0, NULL, 'N/A', 0, 'Lewis Center, Ohio', 30, 'Needs Improvement', '2025-05-27 14:28:00', '2025-05-27 14:28:03'),
(81, NULL, 'https://www.linkedin.com/in/%E2%98%85-john-tucker-linde-6b410037?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAeq_-gBtFH5s3HqpdgzLE6SUGGoa4dpBZI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bco9RlXLlRXC2ptYkvIOWUQ%3D%3D', 'John Tucker Linde', 'Senior Business Consultant', 'OneDigital | Resourcing Edge', 'PEO', 15, 1, 0, NULL, 'Over 279% FY21', 0, 'Austin, Texas', 95, 'Elite Consultant', '2025-05-27 14:28:03', '2025-05-27 14:28:05'),
(82, NULL, 'https://www.linkedin.com/in/steve-khoury-07a91693?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABPkFd4BqY7pKWQwCbaRZlU7QHgdNkglU7I&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bco9RlXLlRXC2ptYkvIOWUQ%3D%3D', 'Steve Khoury', 'PEO & Outsourcing Consultant', 'The Outsource Pros (PEO Brokers)\n', 'PEO', 13, 8, 0, NULL, 'N/A', 0, 'Spring, Texas', 30, 'Needs Improvement', '2025-05-27 14:28:05', '2025-05-27 14:28:06'),
(83, NULL, 'https://www.linkedin.com/in/steven-johnsen?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACaFZ9sBgEhYPUPXZVmpEA4sRFOjPBu2Unc&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bco9RlXLlRXC2ptYkvIOWUQ%3D%3D', 'Steven Johnsen', 'Business Consultant', 'CoAdvantage', 'PEO', 4, 4, 0, NULL, 'Over 220% FY22', 0, 'Tampa, Florida', 85, 'High Performer', '2025-05-27 14:28:06', '2025-05-27 14:28:08'),
(84, NULL, 'https://www.linkedin.com/in/gennaro-fusco-448187151?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACSC1bgBGAf1KvmsSL10BzZoSnLSU6ZiAp4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bco9RlXLlRXC2ptYkvIOWUQ%3D%3D', 'Gennaro Fusco', 'Business Consultant', 'Paychex', 'PEO', 11, 3, 0, NULL, 'N/A', 1, 'Nesconset, New York', 50, 'Average Performer', '2025-05-27 14:28:08', '2025-05-27 14:28:11'),
(85, NULL, 'https://www.linkedin.com/in/hugh-mclean-a278a63b?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAh_KD8B1lqCgYRW6kYk3kr0LbeNvSdhEvs&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bco9RlXLlRXC2ptYkvIOWUQ%3D%3D', 'Hugh Mclean', 'Business Consultant Manager', 'Adminisolve', 'PEO', 29, 12, 0, NULL, 'N/A', 0, 'Yulee, Florida', 55, 'Average Performer', '2025-05-27 14:28:11', '2025-05-27 14:28:12'),
(86, NULL, 'https://www.linkedin.com/in/melissa-archibald-9b11a3278?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAEOoz9UBoxLCh_m1Zn0dqkQ33xrtb1ruBUY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BVsAmrBHZQfmQQqf9%2FVeJpA%3D%3D', 'Melissa Archibald', 'Business Sales Consultant', 'Paychex', 'PEO', 21, 2, 0, NULL, 'N/A', 0, 'Plant City, Florida', 35, 'Needs Improvement', '2025-05-27 14:28:12', '2025-05-27 14:28:13'),
(87, NULL, 'https://www.linkedin.com/in/tonya-wilson-85342010?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAIylr8BEvA61iZaS_Bl6xW98pt5MrFnBqs&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BVsAmrBHZQfmQQqf9%2FVeJpA%3D%3D', 'Tonya Wilson', 'Business Consultant', 'PEO Business Consultant', 'PEO', 28, 13, 0, NULL, 'N/A', 0, 'Dallas, Texas', 25, 'Needs Improvement', '2025-05-27 14:28:13', '2025-05-27 14:28:16'),
(88, NULL, 'https://www.linkedin.com/in/bill-durbin-51394b94?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABQSvR8B_QKfz_gYOBAze7-36pYsiPYGJqo&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BVsAmrBHZQfmQQqf9%2FVeJpA%3D%3D', 'Bill Durbin', 'Business Sales Consultant', 'Paychex', 'PEO', 18, 18, 0, NULL, 'N/A', 0, 'St. Petersburg, Florida', 20, 'Needs Improvement', '2025-05-27 14:28:16', '2025-05-27 14:28:18'),
(89, NULL, 'https://www.linkedin.com/in/lindsey-garrison-campbell-b9b42057?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAv8iKcBVGU0o5fZQQwyx8jsS310hynGzEE&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BVsAmrBHZQfmQQqf9%2FVeJpA%3D%3D', 'Lindsey Campbell', 'Business Sales Consultant', 'Paychex', 'PEO', 11, 1, 0, NULL, 'N/A', 0, 'Greater Orlando', 45, 'Needs Improvement', '2025-05-27 14:28:18', '2025-05-27 14:28:19'),
(90, NULL, 'https://www.linkedin.com/in/jeremeyknout?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAckfYQBy_nAA6g803S3uV5OwNrOvLy3_i8&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BVsAmrBHZQfmQQqf9%2FVeJpA%3D%3D', 'Jeremey Knout', 'Consultant PEO Services', 'Nextep', 'PEO', 12, 2, 0, NULL, 'N/A', 0, 'Nashville, Tennessee', 30, 'Needs Improvement', '2025-05-27 14:28:19', '2025-05-27 14:28:20'),
(91, NULL, 'https://www.linkedin.com/in/stevenhookstra?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAM2DbwBbjzesEKe_duwi2IBCq5eKR3q0Zk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BVsAmrBHZQfmQQqf9%2FVeJpA%3D%3D', 'Steve Hookstra', 'Human Resource Consultant', 'ESI', 'PEO', 20, 16, 0, NULL, 'N/A', 0, 'Austin, Texas', 40, 'Needs Improvement', '2025-05-27 14:28:20', '2025-05-27 14:28:23'),
(92, NULL, 'https://www.linkedin.com/in/mary-heil-514ab72?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAACExSAB2hfFuVCSPylTnms67m8tvXt6yL8&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BVsAmrBHZQfmQQqf9%2FVeJpA%3D%3D', 'Mary Heil', 'Business Consultant', 'Paychex', 'PEO', 25, 25, 0, NULL, 'N/A', 0, 'Spring, Texas', 40, 'Needs Improvement', '2025-05-27 14:28:23', '2025-05-27 14:28:24'),
(93, NULL, 'https://www.linkedin.com/in/cagibbs?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAnjpXQBZ6z3GQw2lOuqFMaYoI3yGs2QUhY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BVsAmrBHZQfmQQqf9%2FVeJpA%3D%3D', 'Christian A. G.', 'Business Consultant', 'PIHRA', 'PEO', 10, 1, 0, NULL, 'N/A', 0, 'Anaheim, California', 40, 'Needs Improvement', '2025-05-27 14:28:24', '2025-05-27 14:28:26'),
(94, NULL, 'https://www.linkedin.com/in/luisdominguez212?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAARAsA4BluBAjCYlCRkUU-W7D_nKnnN8060&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BKmO6VC4nSKKn%2BcAnAXYn7Q%3D%3D', 'Luis Dominguez', 'Strategic Business Consultant', 'Paychex', 'PEO', 31, 1, 0, NULL, 'N/A', 0, 'Richardson, Texas', 40, 'Needs Improvement', '2025-05-27 14:28:26', '2025-05-27 14:28:28'),
(95, NULL, 'https://www.linkedin.com/in/stephen-chamiok-a969106a?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAA66oxIB2wivSNavIaxkQfiPo1f2FTZQ2mo&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B7mOrCNPMRgW6nCnhX13Xjw%3D%3D', 'Stephen Chamiok', 'Sr. Business Consultant PEO', 'OneDigital | Resourcing Edge', 'PEO', 9, 4, 0, NULL, 'N/A', 0, 'Dallas, Texas', 50, 'Average Performer', '2025-05-27 14:28:28', '2025-05-27 14:28:29'),
(96, NULL, 'https://www.linkedin.com/in/thomas-rice-3a4b2b46?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAnHEmwBbhI112uNd8LvS_MdNJyWp86-nu0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BKmO6VC4nSKKn%2BcAnAXYn7Q%3D%3D', 'Thomas Rice', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 13, 1, 0, NULL, 'N/A', 0, 'Lake Orion, Michigan', 35, 'Needs Improvement', '2025-05-27 14:28:30', '2025-05-27 14:28:31'),
(97, NULL, 'https://www.linkedin.com/in/danabambo?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAB_nLUBusxyGMf8hSAHNI6MECqd2rEm-9I&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BKmO6VC4nSKKn%2BcAnAXYn7Q%3D%3D', 'Dana Bambo', 'Business Consultant', 'Paychex', 'PEO', 30, 4, 0, NULL, 'N/A', 0, 'United States', 40, 'Needs Improvement', '2025-05-27 14:28:31', '2025-05-27 14:28:33'),
(98, NULL, 'https://www.linkedin.com/in/nicole-sussman-46395b15?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAMqncsBXGtGkBGpHtlVINK9qv8e3L_kkQ4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BKmO6VC4nSKKn%2BcAnAXYn7Q%3D%3D', 'Nicole Sussman', 'Senior PEO Business Consultant', 'Vensure Employer Services', 'PEO', 21, 4, 0, NULL, 'N/A', 0, 'Boca Raton, Florida', 25, 'Needs Improvement', '2025-05-27 14:28:33', '2025-05-27 14:28:34'),
(99, NULL, 'https://www.linkedin.com/in/martha-marderness-b56b653?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAC0gjIBNf1r4s8EWAT-lOfcy22dmOV_IYk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BKmO6VC4nSKKn%2BcAnAXYn7Q%3D%3D', 'Martha Marderness', 'Senior Strategic Business Consultant ', 'Paychex', 'PEO', 25, 23, 0, NULL, 'N/A', 0, 'Miami-Fort Lauderdale Area', 30, 'Needs Improvement', '2025-05-27 14:28:34', '2025-05-27 14:28:37'),
(100, NULL, 'https://www.linkedin.com/in/glen-johnston-1240a51a3?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAC-IfGwBiWwJOKjNYaAzj8R9RJjY_ZeIFdA&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BKmO6VC4nSKKn%2BcAnAXYn7Q%3D%3D', 'Glen Johnston', 'PEO Sales Consultant', 'CoAdvantage', 'PEO', 5, 1, 0, NULL, 'N/A', 0, 'Miami, Florida', 30, 'Needs Improvement', '2025-05-27 14:28:37', '2025-05-27 14:28:38'),
(101, NULL, 'https://www.linkedin.com/in/brendan-griffin-aa523a6?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAEaNJ0BlJPh7ITRnkyC-tmGdPmICO8ZAWw&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BKmO6VC4nSKKn%2BcAnAXYn7Q%3D%3D', 'Brendan G', 'Business Consultant ', 'CoAdvantage', 'PEO', 19, 1, 0, NULL, 'Over 109%  FY22 & Over 137%  FY23', 1, 'New York, New York', 90, 'High Performer', '2025-05-27 14:28:38', '2025-05-27 14:28:40'),
(102, NULL, 'https://www.linkedin.com/in/wes-goodman-173992197?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAC49w2cBY-uhruWFI7dtqKhp4MmqfnlKsrw&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BKmO6VC4nSKKn%2BcAnAXYn7Q%3D%3D', 'Wes Goodman', 'Business Consultant ', 'Vensure Employer Solutions', 'PEO', 11, 1, 0, NULL, 'N/A', 0, 'Mesa, Arizona', 25, 'Needs Improvement', '2025-05-27 14:28:40', '2025-05-27 14:28:42'),
(103, NULL, 'https://www.linkedin.com/in/eaves-tonia-a7b5a87?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAFVUf8B1VVt34Vf4c0Zgzf2T-AE6iOWK0U&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BMLKFX41mQsSFY7YY56nqHA%3D%3D', 'Eaves, Tonia', 'Senior Business Consultant', 'CoAdvantage', 'PEO', 30, 4, 0, NULL, 'N/A', 1, 'Birmingham, Alabama', 50, 'Average Performer', '2025-05-27 14:28:42', '2025-05-27 14:28:43'),
(104, NULL, 'https://www.linkedin.com/in/tom-gavin-01416b109?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABtBDFABtRw2ZY-rHpOugX_S8v6ytA4ro4k&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BMLKFX41mQsSFY7YY56nqHA%3D%3D', 'Tom Gavin', 'Business Consultant ', 'CoAdvantage', 'PEO', 35, 7, 0, NULL, 'N/A', 0, 'Tampa, Florida', 25, 'Needs Improvement', '2025-05-27 14:28:43', '2025-05-27 14:28:46'),
(105, NULL, 'https://www.linkedin.com/in/josephvolino?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABT1ij4B_NwWlnw_MxUdVAj9D6C8Fu1obY0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BMLKFX41mQsSFY7YY56nqHA%3D%3D', 'Joe Volino', 'Senior Business Consultant', 'Vensure Employer Solutions', 'PEO', 11, 5, 0, NULL, 'N/A', 0, 'New York City Metropolitan Area', 35, 'Needs Improvement', '2025-05-27 14:28:46', '2025-05-27 14:28:47'),
(106, NULL, 'https://www.linkedin.com/in/sarah-kruse-ansert-9488114a?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAApxXQgBm1jii5BySUR7oNHCF5cO6KENKWQ&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BMLKFX41mQsSFY7YY56nqHA%3D%3D', 'Sarah Kruse Ansert', 'Strategic Business Consultant-Paychex PEO', 'Paychex', 'PEO', 19, 3, 0, NULL, 'N/A', 0, 'Louisville, Kentucky', 30, 'Needs Improvement', '2025-05-27 14:28:47', '2025-05-27 14:28:49'),
(107, NULL, 'https://www.linkedin.com/in/veronicapaganlinkedin?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAouoQYBdamw_NeqfhecQYV9z-ut98OvYeo&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BMLKFX41mQsSFY7YY56nqHA%3D%3D', 'Veronica Pagán', 'Senior Business Consultant', 'Namely', 'PEO', 7, 4, 0, NULL, 'N/A', 0, 'Montclair, New Jersey', 40, 'Needs Improvement', '2025-05-27 14:28:49', '2025-05-27 14:28:51'),
(108, NULL, 'https://www.linkedin.com/in/jackspeece?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAAOBOUBvOFlXPvcVaGUx-7aGOhzAr1Voz0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BMLKFX41mQsSFY7YY56nqHA%3D%3D', 'Jack Speece', 'VP of Sales', 'Instant', 'PEO', 5, 1, 0, NULL, 'N/A', 0, 'Charlotte, North Carolina', 30, 'Needs Improvement', '2025-05-27 14:28:51', '2025-05-27 14:28:53'),
(109, NULL, 'https://www.linkedin.com/in/amber-n-28bb52268?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAEGqaAsBlXYP4CgmVDSbs9M2S1t5K_LEkgw&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BMLKFX41mQsSFY7YY56nqHA%3D%3D', 'Amber N', 'Business Consultant ', 'CoAdvantage', 'PEO', 10, 2, 0, NULL, 'N/A', 0, 'Atlanta, Georgia', 40, 'Needs Improvement', '2025-05-27 14:28:53', '2025-05-27 14:28:54'),
(110, NULL, 'https://www.linkedin.com/in/samantha-fitzjarrald-4148378a?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABL9JJABgHulig-AA12Y31HXdGFKE7d1SzY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BMLKFX41mQsSFY7YY56nqHA%3D%3D', 'Samantha Fitzjarrald', 'Business Consultant ', 'PEO Analysis', 'PEO', 12, 6, 0, NULL, 'N/A', 0, 'Gibsonton, Florida', 20, 'Needs Improvement', '2025-05-27 14:28:54', '2025-05-27 14:28:55'),
(111, NULL, 'https://www.linkedin.com/in/heidi-ochoa-369a874?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAADe8UEBsgzydMv6PqF6YjXGGUpkhbYgS-w&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BMLKFX41mQsSFY7YY56nqHA%3D%3D', 'Heidi Ochoa', 'PEO Business Consultant', 'Paychex', 'PEO', 23, 3, 0, NULL, 'N/A', 0, 'Houston, Texas', 20, 'Needs Improvement', '2025-05-27 14:28:55', '2025-05-27 14:28:56'),
(112, NULL, 'https://www.linkedin.com/in/henrik-olausson-62857047?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAnfJoABHjYLIY9dMQHYldio9LiOImIK6zc&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bp%2Bjm7fzZTmKWGlfPpx0Jcw%3D%3D', 'Henrik Olausson', 'Strategic Business Consultant', 'Paychex', 'PEO', 19, 8, 0, NULL, 'N/A', 0, 'Greater Houston', 20, 'Needs Improvement', '2025-05-27 14:28:56', '2025-05-27 14:28:58'),
(113, NULL, 'https://www.linkedin.com/in/tloiselle04?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAAWBT0BTHWUaIJ7zL-qTuiit8XxgXjtXRI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BMLKFX41mQsSFY7YY56nqHA%3D%3D', 'Tim Loiselle', 'Business Consultant ', 'CoAdvantage', 'PEO', 19, 6, 0, NULL, 'N/A', 0, 'Irvine, California', 40, 'Needs Improvement', '2025-05-27 14:28:58', '2025-05-27 14:28:59'),
(114, NULL, 'https://www.linkedin.com/in/josephdonofrio1?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAA6QQrEB4-EBavhhxqii1LH2PB8UtBWaFMk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bp%2Bjm7fzZTmKWGlfPpx0Jcw%3D%3D', 'Joseph D\'Onofrio', 'Business Consultant ', 'CoAdvantage', 'PEO', 16, 6, 0, NULL, 'N/A', 0, 'Massapequa, New York', 20, 'Needs Improvement', '2025-05-27 14:28:59', '2025-05-27 14:29:00'),
(115, NULL, 'https://www.linkedin.com/in/vince-megna-0183338?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAF461QBIvA1XdEVXo4KQVw5NbjHhTDPK8w&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bp%2Bjm7fzZTmKWGlfPpx0Jcw%3D%3D', 'Vince Megna', 'Business Consultant ', 'University of Wisconsin-La Crosse', 'PEO', 39, 1, 0, NULL, 'N/A', 0, 'Boca Raton, Florida', 20, 'Needs Improvement', '2025-05-27 14:29:00', '2025-05-27 14:29:03');
INSERT INTO `consultants` (`id`, `user_id`, `linkedin_url`, `full_name`, `job_title`, `company`, `industry`, `total_experience`, `tenure`, `performance_keywords`, `achievements`, `revenue_closed`, `college_degree`, `location`, `ai_score`, `ranking_level`, `created_at`, `updated_at`) VALUES
(116, NULL, 'https://www.linkedin.com/in/joanna-baker-4038677?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAFfZ4MB3kRegGhnMC4vmquk5ptXezJG9YE&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bp%2Bjm7fzZTmKWGlfPpx0Jcw%3D%3D', 'Joanna Baker', 'Strategic Business Consultant - PEO', 'Paychex', 'PEO', 14, 2, 0, NULL, 'N/A', 0, 'Minneapolis, Minnesota', 30, 'Needs Improvement', '2025-05-27 14:29:03', '2025-05-27 14:29:04'),
(117, NULL, 'https://www.linkedin.com/in/stephen-rubbinaccio-5b88775?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAEEmZwBpdjl7h49R8y-zLK8aBlK1nAZVts&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bp%2Bjm7fzZTmKWGlfPpx0Jcw%3D%3D', 'Stephen Rubbinaccio', 'Senior Business Consultant', 'Armhr ', 'PEO', 23, 2, 0, NULL, 'N/A', 0, 'United States', 40, 'Needs Improvement', '2025-05-27 14:29:04', '2025-05-27 14:29:05'),
(118, NULL, 'https://www.linkedin.com/in/aryachegini?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAfj6aQBn6O7Bh82RyUsZ0Fevct7eV3o7kY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bp%2Bjm7fzZTmKWGlfPpx0Jcw%3D%3D', 'Arya Chegini', 'PEO Strategic Business Consultant', 'Paychex', 'PEO', 14, 2, 0, NULL, 'N/A', 0, 'Los Angeles, California', 30, 'Needs Improvement', '2025-05-27 14:29:05', '2025-05-27 14:29:06'),
(119, NULL, 'https://www.linkedin.com/in/hashim-naveed-5239511a5?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAADAEGqsBWfMZWUWNrXoq57lLLKhWNKKnoBU&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bp%2Bjm7fzZTmKWGlfPpx0Jcw%3D%3D', 'Hashim Naveed', 'Business Consultant ', 'Vensure Employer Solutions', 'PEO', 5, 1, 0, NULL, 'N/A', 0, 'United States', 15, 'Needs Improvement', '2025-05-27 14:29:06', '2025-05-27 14:29:08'),
(120, NULL, 'https://www.linkedin.com/in/tommccadden?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAGlJrYBUvm2VxOY2gHxdY9Vp47Y4ZXVD7M&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bp%2Bjm7fzZTmKWGlfPpx0Jcw%3D%3D', 'Tom McCadden, CBPA', 'Business Consultant ', 'Peoplease', 'PEO', 26, 1, 0, NULL, 'N/A', 0, 'San Diego, California', 30, 'Needs Improvement', '2025-05-27 14:29:08', '2025-05-27 14:29:09'),
(121, NULL, 'https://www.linkedin.com/in/eric-galtress-95578a49?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAApCdNEBrYVWIDayNCll8-54n3EycLCI1Qc&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bp%2Bjm7fzZTmKWGlfPpx0Jcw%3D%3D', 'Eric Galtress', 'Senior Business Consultant', 'CPEhr', 'PEO', 30, 16, 0, NULL, 'N/A', 0, 'Simi Valley, California', 40, 'Needs Improvement', '2025-05-27 14:29:09', '2025-05-27 14:29:12'),
(122, NULL, 'https://www.linkedin.com/in/sage-h-978b295b?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAzNmCwBzaf2khbpiCi1ndmUflQNmmqCkaU&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Bp%2Bjm7fzZTmKWGlfPpx0Jcw%3D%3D', 'Sage H', 'Senior Business Consultant', 'Applied Business Solutions/ HR Delivered ', 'PEO', 32, 2, 0, NULL, 'N/A', 1, 'San Diego County, California', 40, 'Needs Improvement', '2025-05-27 14:29:12', '2025-05-27 14:29:13'),
(123, NULL, 'https://www.linkedin.com/in/brandon-berry-111a2691?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABONEx0BIx5xU8VQ970JSee64-ZAzYn7uZg&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2ss7sEqlRDSVJ%2BoFCjGJ8A%3D%3D', 'Brandon Berry', 'Senior Business Consultant', 'Vensure Employer Services', 'PEO', 10, 2, 0, NULL, 'N/A', 1, 'West Palm Beach, Florida', 40, 'Needs Improvement', '2025-05-27 14:29:13', '2025-05-27 14:29:15'),
(124, NULL, 'https://www.linkedin.com/in/angela-mu%C3%B1oz-diaz-b197a921?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAASREQUBANJ-RH965p7oenxHrzY6fJUA7Z4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2ss7sEqlRDSVJ%2BoFCjGJ8A%3D%3D', 'ANGELA MUÑOZ - DIAZ', 'Business Outsourcing Consultant', 'Advantage Business Partners', 'PEO', 21, 5, 0, NULL, 'N/A', 0, 'Bradenton, Florida', NULL, NULL, '2025-05-27 14:29:15', '2025-05-27 14:29:18'),
(125, NULL, 'https://www.linkedin.com/in/kate-harrington-21b38074?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAA-3bTcBXMk3fI1yFYQOzeYUfVQRemFPEs8&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2ss7sEqlRDSVJ%2BoFCjGJ8A%3D%3D', 'Kate Harrington', 'Business Consultant - Private Equity/Venture Capital', 'Sequoia', 'PEO', 21, 1, 0, NULL, 'N/A', 0, 'San Francisco Bay Area', 40, 'Needs Improvement', '2025-05-27 14:29:18', '2025-05-27 14:29:19'),
(126, NULL, 'https://www.linkedin.com/in/nicholas-cioffi?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACX2t0oBvN6597FEF517qtJeS8UK5lx_ZD4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2ss7sEqlRDSVJ%2BoFCjGJ8A%3D%3D', 'Nicholas Cioffi', 'Senior Business Consultant', 'CoAdvantage', 'PEO', 13, 5, 0, NULL, 'N/A', 0, 'Greater Tampa Bay Area', 30, 'Needs Improvement', '2025-05-27 14:29:19', '2025-05-27 14:29:21'),
(127, NULL, 'https://www.linkedin.com/in/aaron-johnson-62494180?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABE5ejwBeUKuYJi0QK7XYzE2XtUB8O-pw2I&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2ss7sEqlRDSVJ%2BoFCjGJ8A%3D%3D', 'Aaron Johnson', 'SR HR & Business Development Consultant', 'Paychex, Inc', 'PEO', 26, 12, 0, NULL, 'N/A', 0, 'Prosper, Texas', 25, 'Needs Improvement', '2025-05-27 14:29:21', '2025-05-27 14:29:22'),
(128, NULL, 'https://www.linkedin.com/in/heather-lalk-68b67626?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAVwC0sBYQRuT-7_lEZ6XiYS1oe1eo77OGk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2ss7sEqlRDSVJ%2BoFCjGJ8A%3D%3D', 'Heather Lalk', 'Business Consultant Specializing in PEO', 'FrankCrum', 'PEO', 10, 10, 0, NULL, 'N/A', 0, 'Clearwater, Florida', 35, 'Needs Improvement', '2025-05-27 14:29:22', '2025-05-27 14:29:23'),
(129, NULL, 'https://www.linkedin.com/in/anne-p-armstrong-38532410?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAIu4xUB2uaNpQlc5lDufhs4LpsjRyTMtyM&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2ss7sEqlRDSVJ%2BoFCjGJ8A%3D%3D', 'Anne P. Armstrong', 'Senior Business Consultant', 'CoAdvantage', 'PEO', 28, 4, 0, NULL, 'N/A', 0, 'Laguna Beach, California', 30, 'Needs Improvement', '2025-05-27 14:29:23', '2025-05-27 14:29:26'),
(130, NULL, 'https://www.linkedin.com/in/noellemangiapane?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAASd1oMBED092NyBvLBAwtMDSybaMCzw0W4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2ss7sEqlRDSVJ%2BoFCjGJ8A%3D%3D', 'Noelle Mangiapane', 'Senior HR and PEO Business Consultant', 'Paychex', 'PEO', 36, 7, 0, NULL, 'N/A', 0, 'San Francisco Bay Area', 25, 'Needs Improvement', '2025-05-27 14:29:26', '2025-05-27 14:29:28'),
(131, NULL, 'https://www.linkedin.com/in/mtheresaharrison?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAC0MCoBJUR42G_3gUo4D1uzYFSRiPLBPQE&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2ss7sEqlRDSVJ%2BoFCjGJ8A%3D%3D', 'Maria Theresa Harrison', 'Strategic Business Consultant - PEO', 'Paychex', 'PEO', 25, 1, 0, NULL, 'N/A', 0, 'San Diego, California', 30, 'Needs Improvement', '2025-05-27 14:29:28', '2025-05-27 14:29:29'),
(132, NULL, 'https://www.linkedin.com/in/phillip-petroni-666050148?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACOaGK4BtqcQUhbyvm69wqmJr3SM1cV9XKY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqfjKeYZeRoCU6%2Bio5Ra5tg%3D%3D', 'Phillip Petroni', 'PEO Business Consultant', 'Paychex', 'PEO', 11, 3, 0, NULL, 'N/A', 0, 'San Diego, California', 20, 'Needs Improvement', '2025-05-27 14:29:29', '2025-05-27 14:29:30'),
(133, NULL, 'https://www.linkedin.com/in/jenniferkeathly?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAINBT0BgcAtZDR-pMbrgGr2jRX8gQgvbm0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqfjKeYZeRoCU6%2Bio5Ra5tg%3D%3D', 'Jennifer Keathly', 'PEO/Human Resources Business Consultant', 'PEO by Design', 'PEO', 32, 3, 0, NULL, 'N/A', 0, 'Cypress, Texas', 40, 'Needs Improvement', '2025-05-27 14:29:30', '2025-05-27 14:29:33'),
(134, NULL, 'https://www.linkedin.com/in/matthew-mccrank?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAx_tggB4tbykWQTtmvpt2f94ZRIeZf82pE&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqfjKeYZeRoCU6%2Bio5Ra5tg%3D%3D', 'Matthew McCrank, MBA', 'Strategic Business Consultant, Paychex PEO', 'Paychex', 'PEO', 15, 1, 0, NULL, 'N/A', 0, 'Rochester, New York Metropolitan Area', 50, 'Average Performer', '2025-05-27 14:29:33', '2025-05-27 14:29:34'),
(135, NULL, 'https://www.linkedin.com/in/adam-martin-55530396?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABRVm1EBJ_2U0qKKNKozA3BKcJAsce2zMI0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqfjKeYZeRoCU6%2Bio5Ra5tg%3D%3D', 'Adam Martin', 'Senior Business Consultant', 'Worksite', 'PEO', 18, 5, 0, NULL, 'N/A', 1, 'Sarasota, Florida', 50, 'Average Performer', '2025-05-27 14:29:34', '2025-05-27 14:29:36'),
(136, NULL, 'https://www.linkedin.com/in/shanefowler11?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAA8pAUBRJ0AkzBVta0LZfi33rxQlpo5iig&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqfjKeYZeRoCU6%2Bio5Ra5tg%3D%3D', 'Shane Fowler', 'Sr, Strategic Business Consultant', 'Paychex', 'PEO', 16, 2, 0, NULL, 'N/A', 0, 'San Clemente, California', 35, 'Needs Improvement', '2025-05-27 14:29:36', '2025-05-27 14:29:37'),
(137, NULL, 'https://www.linkedin.com/in/jenna-ruiz-a8b26399?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABTcaEsBrqhyM1U510SDpWQpaEL9HqPAzgY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqfjKeYZeRoCU6%2Bio5Ra5tg%3D%3D', 'Jenna Ruiz', 'Human Resources Business Consultant', 'ADP', 'PEO', 12, 12, 0, NULL, 'N/A', 0, 'San Diego, California', 20, 'Needs Improvement', '2025-05-27 14:29:37', '2025-05-27 14:29:38'),
(138, NULL, 'https://www.linkedin.com/in/lisa-m-bergfield-b2730372?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAA9Z3o8BnKme52pdqe0p2RkFOwNbQaI5zd8&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqfjKeYZeRoCU6%2Bio5Ra5tg%3D%3D', 'Lisa M. Bergfield', 'Business Consultant', 'FrankCrum, Inc.', 'PEO', 11, 11, 0, NULL, 'N/A', 0, 'Palm Harbor, Florida', 40, 'Needs Improvement', '2025-05-27 14:29:38', '2025-05-27 14:29:41'),
(139, NULL, 'https://www.linkedin.com/in/mindy-mcleod-32664133?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAcJBI4BjCpnwZL6HxqMrm-iBnQpjPUKkjY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqfjKeYZeRoCU6%2Bio5Ra5tg%3D%3D', 'Mindy McLeod', 'Sr. Business Consultant', 'Paychex', 'PEO', 28, 6, 0, NULL, 'N/A', 0, 'Tampa, Florida', 30, 'Needs Improvement', '2025-05-27 14:29:41', '2025-05-27 14:29:42'),
(140, NULL, 'https://www.linkedin.com/in/jim-batz-5b70ab184?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACtwt5sBJWI06ORqw-ih9E73DNMEkhayeLk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqfjKeYZeRoCU6%2Bio5Ra5tg%3D%3D', 'Jim Batz ', 'Business Consultant', 'CoAdvantage', 'PEO', 21, 4, 0, NULL, 'N/A', 0, 'Dallas, Texas', 25, 'Needs Improvement', '2025-05-27 14:29:42', '2025-05-27 14:29:43'),
(141, NULL, 'https://www.linkedin.com/in/jake-chauret-47b388159?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACX29J8BtBPFs8ijdszsTygHX-oGIzkJNRY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BRmruj%2FEiSFqeVNB4dM1G7Q%3D%3D', 'Jake Chauret', 'PEO Sales Office', 'Trion Solutions', 'PEO', 10, 1, 0, NULL, 'N/A', 1, 'Miami, Florida', 40, 'Needs Improvement', '2025-05-27 14:29:43', '2025-05-27 14:29:45'),
(142, NULL, 'https://www.linkedin.com/in/martin-molitor-3b3731122?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAB5dL_cBkvk_ZNK7KyTGYg4OXpK1j4cj23k&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BRmruj%2FEiSFqeVNB4dM1G7Q%3D%3D', 'Martin Molitor', 'Business Consultant', 'CoAdvantage', 'PEO', 17, 1, 0, NULL, 'N/A', 1, 'Lake Forest, California', 20, 'Needs Improvement', '2025-05-27 14:29:45', '2025-05-27 14:29:46'),
(143, NULL, 'https://www.linkedin.com/in/rey-hernandez-a7b7a092?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABOxo_8BEmD8wEENnu987Pkn3z7lrYcPZig&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BRmruj%2FEiSFqeVNB4dM1G7Q%3D%3D', 'Rey Hernandez', 'Business Consultant', 'CoAdvantage', 'PEO', 36, 9, 0, NULL, 'N/A', 1, 'Miami, Florid', 60, 'Average Performer', '2025-05-27 14:29:46', '2025-05-27 14:29:48'),
(144, NULL, 'https://www.linkedin.com/in/shanewilliams-peo?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAB7jzP4BJSuU_zKEQGU4abbdMqMawvKgyIA&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BRmruj%2FEiSFqeVNB4dM1G7Q%3D%3D', 'Shane Williams', 'Business Consultant', 'PEO Match', 'PEO', 11, 1, 0, NULL, 'N/A', 0, 'Orlando, Florida, ', 20, 'Needs Improvement', '2025-05-27 14:29:48', '2025-05-27 14:29:49'),
(145, NULL, 'https://www.linkedin.com/in/dragana-arsovic-0a32338?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAF1H7sBELIUhrrBwr0InL6dHSRpZLyUflY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BRmruj%2FEiSFqeVNB4dM1G7Q%3D%3D', 'Dragana Arsovic', ' Business Consultant ', 'Paychex', 'PEO', 10, 2, 0, NULL, 'N/A', 0, 'St. Petersburg, Florida', 30, 'Needs Improvement', '2025-05-27 14:29:49', '2025-05-27 14:29:51'),
(146, NULL, 'https://www.linkedin.com/in/tiffany-le-mba-42375412?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAKaJlsB9qPj-BoMzBMOoIhVIJWqNyVWqUw&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BRmruj%2FEiSFqeVNB4dM1G7Q%3D%3D', 'Tiffany Le, MBA ', 'Human Resources Manager', 'FlyteHealth', 'PEO', 12, 1, 0, NULL, 'N/A', 0, 'Tempe, Arizona,', 0, 'Needs Improvement', '2025-05-27 14:29:51', '2025-05-27 14:29:53'),
(147, NULL, 'https://www.linkedin.com/in/tom-pettit-46920a27?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAWMThEBX1Y_LW_asjyhyKNdYk6lZeainxY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BRmruj%2FEiSFqeVNB4dM1G7Q%3D%3D', 'Tom Pettit', 'Business Consultant', 'UniqueHR', 'PEO', 33, 6, 0, NULL, 'N/A', 0, 'Corpus Christi, Texas,', 35, 'Needs Improvement', '2025-05-27 14:29:53', '2025-05-27 14:29:55'),
(148, NULL, 'https://www.linkedin.com/in/rachel-henton-mba-b96b9565?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAA3hFWIBN7iGbVJfR1BRu9owvmWDjCLd9ow&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BRmruj%2FEiSFqeVNB4dM1G7Q%3D%3D', 'Rachel Henton, MBA', 'Vice President of Human Resources', 'Afinida HR', 'PEO', 14, 1, 0, NULL, 'N/A', 0, 'San Diego Metropolitan AreaSan Diego Metropolitan Area', 0, 'Needs Improvement', '2025-05-27 14:29:55', '2025-05-27 14:29:56'),
(149, NULL, 'https://www.linkedin.com/in/winston-rodriguez-4a9b28128?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAB99nsEBmSzAu7CJdN_d3Qo9_N8yUWmVj7k&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BRmruj%2FEiSFqeVNB4dM1G7Q%3D%3D', 'Winston Rodriguez', 'Client Solutions Manager', 'ARCH Resources Group', 'PEO', 9, 7, 0, NULL, 'N/A', 0, 'Miami, Florida', 25, 'Needs Improvement', '2025-05-27 14:29:56', '2025-05-27 14:29:57'),
(150, NULL, 'https://www.linkedin.com/in/jorge-aguirre-7a4319145?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACMbxiwBWcMlx9BKKwvgBQAi0j9wLuk1WF0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BRmruj%2FEiSFqeVNB4dM1G7Q%3D%3D', 'Jorge Aguirre', 'Business Payroll Consultant ', 'SBS Payroll', 'PEO', 14, 6, 0, NULL, 'N/A', 1, 'Los Angeles Metropolitan Area', 20, 'Needs Improvement', '2025-05-27 14:29:57', '2025-05-27 14:29:58'),
(151, NULL, 'https://www.linkedin.com/in/richard-ravens-a05a146?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAE3yaUBMQY3a3zmxBjlDqTVOu_R0a68KJM&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhIXQrHwIR2yPPPn0gz6LCQ%3D%3D', 'Richard Ravens', 'Business Consultant', 'CoAdvantage', 'PEO', 20, 3, 0, NULL, 'N/A', 0, 'Tampa, Florida', 40, 'Needs Improvement', '2025-05-27 14:29:58', '2025-05-27 14:29:59'),
(152, NULL, 'https://www.linkedin.com/in/gabriel-cardenas-75a01a237?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAADrpyLYBhBdfVb7-WLpfIAliJPuXZxvacEk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhIXQrHwIR2yPPPn0gz6LCQ%3D%3D', 'Gabriel Cardenas', 'Strategic Business Consultant', 'Paychex', 'PEO', 15, 1, 0, NULL, 'N/A', 0, 'Miami, Florida', 35, 'Needs Improvement', '2025-05-27 14:29:59', '2025-05-27 14:30:01'),
(153, NULL, 'https://www.linkedin.com/in/charlie-stearns-996ba427?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAWxfoIB3rp5kwshIQ7PUj1oO80Zj4kjyfc&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhIXQrHwIR2yPPPn0gz6LCQ%3D%3D', 'Charlie Stearns', 'Business Consultant', 'CoAdvantage', 'PEO', 23, 2, 0, NULL, 'N/A', 0, 'Atlanta Metropolitan Area', 20, 'Needs Improvement', '2025-05-27 14:30:01', '2025-05-27 14:30:02'),
(154, NULL, 'https://www.linkedin.com/in/pat-bonner-66b5002?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAABuH7MBFIZJYL1udsa_wLFtZ-Heov_0ZyM&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhIXQrHwIR2yPPPn0gz6LCQ%3D%3D', 'Pat Bonner', 'Strategic Business Consultant', 'ESI', 'PEO', 20, 1, 0, NULL, 'N/A', 1, 'Woodstock, Maryland', 40, 'Needs Improvement', '2025-05-27 14:30:02', '2025-05-27 14:30:04'),
(155, NULL, 'https://www.linkedin.com/in/iamisaiahboyd?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABqg8roB56akGn1iN39XxKmR8fTAyJvBYik&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhIXQrHwIR2yPPPn0gz6LCQ%3D%3D', 'Isaiah Boyd', 'Georgia Businesses ', 'CoAdvantage', 'PEO', 9, 1, 0, NULL, 'N/A', 0, 'Atlanta, Georgia,', 40, 'Needs Improvement', '2025-05-27 14:30:04', '2025-05-27 14:30:06'),
(156, NULL, 'https://www.linkedin.com/in/joe-della-porta-36828174?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAA-zqMABvFUDZ9EISddVuxkAJS1XSk-Ibvs&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhIXQrHwIR2yPPPn0gz6LCQ%3D%3D', 'Joe Della Porta', 'PEO Consultant', 'CoAdvantage', 'PEO', 27, 2, 0, NULL, 'N/A', 0, 'Melville, New York', 20, 'Needs Improvement', '2025-05-27 14:30:06', '2025-05-27 14:30:08'),
(157, NULL, 'https://www.linkedin.com/in/ken-karagiorgas?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABFJu68B15LCZp4dOdHpJsJyn1tVz51a0z4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhIXQrHwIR2yPPPn0gz6LCQ%3D%3D', 'Ken Karagiorgas', 'Business Consultant', ' Vensure Employer Services', 'PEO', 9, 3, 0, NULL, 'N/A', 0, 'United States', 25, 'Needs Improvement', '2025-05-27 14:30:08', '2025-05-27 14:30:09'),
(158, NULL, 'https://www.linkedin.com/in/teenabrown1?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAJmX_gB5mkmjnEgwrUYRltoCveOTVa8eAM&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhIXQrHwIR2yPPPn0gz6LCQ%3D%3D', 'Teena Brown', 'Business Consultant ', ' Vensure Employer Solutions - PEO /Human', 'PEO', 11, 1, 0, NULL, 'N/A', 0, 'Greater Pittsburgh Region ', 15, 'Needs Improvement', '2025-05-27 14:30:09', '2025-05-27 14:30:11'),
(159, NULL, 'https://www.linkedin.com/in/david-yarbrough-90975214?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAL1O5kBjU-3eE-0LwWMKHG4aag9uLns5Os&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhIXQrHwIR2yPPPn0gz6LCQ%3D%3D', 'David Yarbrough', 'Business Consultant', 'Sequoia', 'PEO', 23, 1, 0, NULL, 'N/A', 0, 'Issaquah, Washington', 40, 'Needs Improvement', '2025-05-27 14:30:11', '2025-05-27 14:30:12'),
(160, NULL, 'https://www.linkedin.com/in/rod-clift-b86b889?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAHGmJYB1hP9xAePbT_geHgk3D8R2HCOXIM&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BhIXQrHwIR2yPPPn0gz6LCQ%3D%3D', 'Rod Clift ', ' Business Solutions Consultant', 'CoAdvantage', 'PEO', 16, 3, 0, NULL, 'N/A', 0, 'Denver Metropolitan Area', 40, 'Needs Improvement', '2025-05-27 14:30:12', '2025-05-27 14:30:17'),
(161, NULL, 'https://www.linkedin.com/in/patrick-flaherty-mba-sphr-shrm-scp-1bb1471?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAAy0F8BM7ZRzssuzwpsEgxXLkXh58Afxbc&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Be9ZT3jKqSXSvIYb0tV0nUw%3D%3D', 'Patrick Flaherty, MBA, SPHR, SHRM - SCP', 'Human Resource', 'Inland Empire Small Business Developmen', 'PEO', 38, 6, 0, NULL, 'N/A', 0, 'Beaumont, California', 40, 'Average Performer', '2025-05-27 14:30:17', '2025-05-27 14:30:19'),
(162, NULL, 'https://www.linkedin.com/in/matthew-davis-5354627?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAFQFnkBYKLlK1RwlRmvNn-Pq890Z-NARVc&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3Be9ZT3jKqSXSvIYb0tV0nUw%3D%3D', 'Matthew Davis', 'Business Solutions Consultant', 'isolved', 'PEO', 24, 6, 0, NULL, 'N/A', 0, 'New Haven, Connecticut', 20, 'Needs Improvement', '2025-05-27 14:30:19', '2025-05-27 14:30:20'),
(163, NULL, 'https://www.linkedin.com/in/imranmalik1990?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABwJSF4B_DP4AZ1Vbdd5J4Lqanpqq2mW5Tg&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BGl44Hz%2FGQgiSNgMQfWMq9w%3D%3D', 'Imran Malik', 'Business Consultant', 'Paychex', 'PEO', 15, 1, 0, NULL, 'N/A', 0, 'Lake Mary, Florida', 25, 'Needs Improvement', '2025-05-27 14:30:20', '2025-05-27 14:30:21'),
(164, NULL, 'https://www.linkedin.com/in/thekevinmoore?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAKlERoBIamtk_KYBikdUB5BB6BF7ezIKCI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BGl44Hz%2FGQgiSNgMQfWMq9w%3D%3D', 'Kevin Moore', 'Business Consultant', 'ESI', 'PEO', 17, 3, 0, NULL, 'N/A', 0, 'San Antonio, Texas', 20, 'Needs Improvement', '2025-05-27 14:30:21', '2025-05-27 14:30:24'),
(165, NULL, 'https://www.linkedin.com/in/trevorhind1120?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAA1UCKQBYTLZKoHJ0BJJPXeLngWAibPuO4A&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BGl44Hz%2FGQgiSNgMQfWMq9w%3D%3D', 'Trevor Hind', 'Business Consultant', 'TriNet', 'PEO', 30, 7, 0, NULL, 'N/A', 0, 'Sarasota, Florida', 25, 'Needs Improvement', '2025-05-27 14:30:24', '2025-05-27 14:30:25'),
(166, NULL, 'https://www.linkedin.com/in/raymondmead?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAACKl8EB6MDAaqCybdvTrHYt3RLHvkM4eQk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BGl44Hz%2FGQgiSNgMQfWMq9w%3D%3D', 'Ray Mead', 'Business Consultant', 'TriNet', 'PEO', 31, 10, 0, NULL, 'N/A', 0, 'Cardiff-by-the-Sea, California', 40, 'Needs Improvement', '2025-05-27 14:30:25', '2025-05-27 14:30:27'),
(167, NULL, 'https://www.linkedin.com/in/mark-shramek?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAA0Uj7YBNPpaN6di28n9I0zwAgjL0Noh4cs&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BGl44Hz%2FGQgiSNgMQfWMq9w%3D%3D', 'Mark Shramek', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 14, 1, 0, NULL, 'N/A', 0, 'Los Angeles Metropolitan Area', 20, 'Needs Improvement', '2025-05-27 14:30:27', '2025-05-27 14:30:29'),
(168, NULL, 'https://www.linkedin.com/in/andrew-c-blain?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABYWq5UBlspbvOe069qswApz60dMpSYo1Yk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BGl44Hz%2FGQgiSNgMQfWMq9w%3D%3D', 'Andrew Blain', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 11, 1, 0, NULL, 'N/A', 0, 'San Francisco Bay Area', 30, 'Needs Improvement', '2025-05-27 14:30:29', '2025-05-27 14:30:30'),
(169, NULL, 'https://www.linkedin.com/in/jeremy-carson-41a2015?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAADrcRYBAJurvyY56tv4o9-NgrDahneCuoQ&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BGl44Hz%2FGQgiSNgMQfWMq9w%3D%3D', 'Jeremy Carson', 'Business Consultant', 'Worksite', 'PEO', 26, 2, 0, NULL, 'N/A', 1, 'Saint Johns, Florida', 40, 'Needs Improvement', '2025-05-27 14:30:30', '2025-05-27 14:30:32'),
(170, NULL, 'https://www.linkedin.com/in/helen-ann-rodriguez-6b23b7101?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABndoiYBOpKUlpstb39GXq5C9lRzfxqCDO0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2F3VJ7soGQ5WLAMa%2BWjDZbg%3D%3D', 'Helen Ann Rodriguez', 'HCM Consultant', 'ADP', 'PEO', 12, 6, 0, NULL, 'N/A', 0, 'Huntersville, North Carolina', 45, 'Needs Improvement', '2025-05-27 14:30:32', '2025-05-27 14:30:34'),
(171, NULL, 'https://www.linkedin.com/in/suzanne-ostertag-0b319916?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAM7AkcB6FwqCi_jqdQ70udOAmMmB0NH4mA&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2F3VJ7soGQ5WLAMa%2BWjDZbg%3D%3D', 'Suzanne Ostertag', 'Senior Business Consultant', 'CoAdvantage', 'PEO', 23, 14, 0, NULL, 'N/A', 1, 'Cape Coral Metropolitan Area', 35, 'Needs Improvement', '2025-05-27 14:30:34', '2025-05-27 14:30:35'),
(172, NULL, 'https://www.linkedin.com/in/fernando-munoz?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACPXUtoBxpY1DnGjYTfZZEVnlXRlIAqWB1s&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2F3VJ7soGQ5WLAMa%2BWjDZbg%3D%3D', 'Fernando Munoz', 'Business Consultant', 'TriNet', 'PEO', 16, 2, 0, NULL, 'N/A', 0, 'Dallas-Fort Worth Metroplex', 40, 'Needs Improvement', '2025-05-27 14:30:35', '2025-05-27 14:30:36'),
(173, NULL, 'https://www.linkedin.com/in/brian-rhodes-48817011?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAJWVagB2Ye3QVZygI0GGAI_rUvgfRGaDOY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2F3VJ7soGQ5WLAMa%2BWjDZbg%3D%3D', 'Brian Rhodes', 'Business Consultant', 'CoAdvantage', 'PEO', 29, 4, 0, NULL, 'N/A', 0, 'Birmingham, Alabama', 45, 'Needs Improvement', '2025-05-27 14:30:36', '2025-05-27 14:30:37'),
(174, NULL, 'https://www.linkedin.com/in/joseph-p-cleary-1879a27?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAFkVHcBl47N69gYH6xVI3P5fYvBrld6L2Q&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2F3VJ7soGQ5WLAMa%2BWjDZbg%3D%3D', 'Joseph P. Cleary', 'Senior Strategic Business Consultant at Paychex HR', 'Paychex', 'PEO', 31, 3, 0, NULL, 'N/A', 0, 'Greater Philadelphia', 10, 'Needs Improvement', '2025-05-27 14:30:37', '2025-05-27 14:30:40'),
(175, NULL, 'https://www.linkedin.com/in/joycesotero?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAACYZdQBXimKqm34iggX7I18J5LXcdWph4g&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2F3VJ7soGQ5WLAMa%2BWjDZbg%3D%3D', 'Joyce Sotero', 'HR Business Consultant', 'Human Resources Leader | Business Partner | Strategic Planning | Performance Management', 'PEO', 28, 12, 0, NULL, 'N/A', 0, 'Los Angeles, California', 40, 'Needs Improvement', '2025-05-27 14:30:40', '2025-05-27 14:30:41'),
(176, NULL, 'https://www.linkedin.com/in/tyler-s-blair-b3178026?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAV0AlUBexsJI7JOAhUPO_OjxLv1HY77h8w&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2F3VJ7soGQ5WLAMa%2BWjDZbg%3D%3D', 'Tyler S. Blair', 'Business Development Consultant', 'Orion', 'PEO', 13, 1, 0, NULL, 'N/A', 0, 'Cleveland, Ohio', 25, 'Needs Improvement', '2025-05-27 14:30:41', '2025-05-27 14:30:43'),
(177, NULL, 'https://www.linkedin.com/in/ryan-parker-0a2122b0?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABeCu_oBgM0fE-AO5o3uG8uZCmYOgIfpbm0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2F3VJ7soGQ5WLAMa%2BWjDZbg%3D%3D', 'Ryan Parker', 'Business Consultant', 'LBMC Employment Partners', 'PEO', 22, 1, 0, NULL, 'N/A', 0, 'Nashville, Tennessee', 20, 'Needs Improvement', '2025-05-27 14:30:44', '2025-05-27 14:30:45'),
(178, NULL, 'https://www.linkedin.com/in/kathymascio?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAJDAJYBCQ25q_0VbLxft3PR0_sqATYBkgs&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2F3VJ7soGQ5WLAMa%2BWjDZbg%3D%3D', 'Kathy Mascio HRIP PHR GPHR', 'Business Consultant', 'Experian Employer Services', 'PEO', 41, 6, 0, NULL, 'N/A', 0, 'Twinsburg, Ohio', 45, 'Needs Improvement', '2025-05-27 14:30:45', '2025-05-27 14:30:46'),
(179, NULL, 'https://www.linkedin.com/in/brandonorth?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAFH-fsBJ1Yl-I1GUdIesZDDeGXDfYqc_Qc&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2F3VJ7soGQ5WLAMa%2BWjDZbg%3D%3D', 'Brandon Orth, MBA', 'Business Consultant', 'G&A Partners', 'PEO', 17, 2, 0, NULL, 'N/A', 0, 'Atlanta Metropolitan Area', 40, 'Needs Improvement', '2025-05-27 14:30:46', '2025-05-27 14:30:47'),
(180, NULL, 'https://www.linkedin.com/in/emilioquemada?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACmtuIkBfKa2FPYGpFWnDaXnca9qOXr9A0w&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BZ5dJvnGARBSSc70%2B0Wy6uA%3D%3D', 'Emilio Quemada', 'Strategic Business Consultant', 'Paychex', 'PEO', 9, 2, 0, NULL, 'FY23 over 270% plan ', 0, 'Irvine, California', 85, 'High Performer', '2025-05-27 14:30:47', '2025-05-27 14:30:49'),
(181, NULL, 'https://www.linkedin.com/in/katherine-burrow?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAFdo9IBDQ5TlqJoy4zAOo88K93CUKQXXAI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BZ5dJvnGARBSSc70%2B0Wy6uA%3D%3D', 'Katherine Burrow, CBPA', 'Senior Business Consultant', 'Aspen HR', 'PEO', 17, 1, 0, NULL, 'N/A', 1, 'Rowlett, Texas', 20, 'Needs Improvement', '2025-05-27 14:30:49', '2025-05-27 14:30:50'),
(182, NULL, 'https://www.linkedin.com/in/katesuerth?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAnsplQBHa2cFz0nSvKMbhnygUFzm1I4KHI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BZ5dJvnGARBSSc70%2B0Wy6uA%3D%3D', 'Kate Suerth', 'Senior District Sales Leader', 'Paychex', 'PEO', 14, 1, 0, NULL, 'N/A', 0, 'Chicago, Illinois', 20, 'Needs Improvement', '2025-05-27 14:30:50', '2025-05-27 14:30:53'),
(183, NULL, 'https://www.linkedin.com/in/pulidorodrigo?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAGesCQBpNpqAt5Y9Tg8zhVh5VRARbKZZdk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BZ5dJvnGARBSSc70%2B0Wy6uA%3D%3D', 'Rodrigo P', 'Interim Director of Human Resources', 'Momofuku', 'PEO', 19, 1, 0, NULL, 'N/A', 0, 'Los Angeles, California', 60, 'Average Performer', '2025-05-27 14:30:53', '2025-05-27 14:30:55'),
(184, NULL, 'https://www.linkedin.com/in/susan-misiura-8b74167?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAFOnosB2G3sZakIkgM15bmNYjZ1ho0G1G0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BZ5dJvnGARBSSc70%2B0Wy6uA%3D%3D', 'Susan Misiura', 'Business Consultant', 'CoAdvantage', 'PEO', 18, 8, 0, NULL, 'N/A', 0, 'Bradenton, Florida', 35, 'Needs Improvement', '2025-05-27 14:30:55', '2025-05-27 14:30:56'),
(185, NULL, 'https://www.linkedin.com/in/patrick-oconnor3210?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAlULX8Ba2lQO7vRDyKneRv9nofpZP0Wpw4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BrJkIn72LTAWuNzKXAYdxVw%3D%3D', 'Patrick O\'Connor', 'Strategic Business Consultant', 'Paychex ', 'PEO', 27, 2, 0, NULL, 'N/A', 0, 'Los Angeles Metropolitan Area', 40, 'Needs Improvement', '2025-05-27 14:30:56', '2025-05-27 14:30:57'),
(186, NULL, 'https://www.linkedin.com/in/sarahpry?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAys-IsBWpDkwPHkFyKP40EMmb43-7JK_gw&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BrJkIn72LTAWuNzKXAYdxVw%3D%3D', 'Business Development Manager', 'Business Development Manager', 'Bucom International', 'PEO', 18, 1, 0, NULL, 'N/A', 0, 'Chicago, Illinois', 20, 'Needs Improvement', '2025-05-27 14:30:57', '2025-05-27 14:30:59'),
(187, NULL, 'https://www.linkedin.com/in/laura-boone-4620a49?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAGdV4oB32xDpBw-_oHOtDjbmW-P8HtMeWo&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BrJkIn72LTAWuNzKXAYdxVw%3D%3D', 'Laura Boone', 'Business Consultant', 'Elite HR Sollutions', 'PEO', 29, 7, 0, NULL, 'N/A', 0, 'Fort Lauderdale, Florida', 40, 'Needs Improvement', '2025-05-27 14:30:59', '2025-05-27 14:31:00'),
(188, NULL, 'https://www.linkedin.com/in/melissa-gonzalez-phr?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAJRJjgBC9uBuHbBbZJTTHqtTd3FFslzlUI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BrJkIn72LTAWuNzKXAYdxVw%3D%3D', 'Melissa Gonzalez', 'Human Resources Consultant', 'BBSI', 'PEO', 27, 4, 0, NULL, 'N/A', 0, 'San Diego, California', 40, 'Needs Improvement', '2025-05-27 14:31:00', '2025-05-27 14:31:02'),
(189, NULL, 'https://www.linkedin.com/in/marjon-frates?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABp3DgcBaQwR46REHYDTQeX5VsW6IRRIEeE&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BrJkIn72LTAWuNzKXAYdxVw%3D%3D', 'Marjon Frates', 'Enterprise HCM Consultant', 'Paychex', 'PEO', 15, 3, 0, NULL, 'N/A', 0, 'Tucson, Arizona', 35, 'Needs Improvement', '2025-05-27 14:31:02', '2025-05-27 14:31:03'),
(190, NULL, 'https://www.linkedin.com/in/bonnie-parker-988b2311?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAJ6z7gB4psENhMOrZuU_g-mKdC1EqrTSVA&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BrJkIn72LTAWuNzKXAYdxVw%3D%3D', 'McKinney, Texas', 'Professional Employer Consultant', 'ContinuumHR, member of NAPEO', 'PEO', 21, 2, 0, NULL, 'N/A', 0, 'McKinney, Texas', 20, 'Needs Improvement', '2025-05-27 14:31:03', '2025-05-27 14:31:04'),
(191, NULL, 'https://www.linkedin.com/in/brendanflinter?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAB_gvEIBdCQctNF9BCmh-sGsxPFmDSvhoZo&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BrJkIn72LTAWuNzKXAYdxVw%3D%3D', 'Brendan Flinter', 'Business Consultant', 'TriNet', 'PEO', 9, 2, 0, NULL, 'N/A', 0, 'Miami-Fort Lauderdale Area', 20, 'Needs Improvement', '2025-05-27 14:31:04', '2025-05-27 14:31:05'),
(192, NULL, 'https://www.linkedin.com/in/krissburns?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAADe6_IBN6hx_8_4LLm4e8EckVhSd4MxApU&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BrJkIn72LTAWuNzKXAYdxVw%3D%3D', 'Kriss Burns', 'HR Business Consultant', 'PRO Resources', 'PEO', 24, 8, 0, NULL, 'N/A', 0, 'Fargo, North Dakota', 50, 'Average Performer', '2025-05-27 14:31:05', '2025-05-27 14:31:07'),
(193, NULL, 'https://www.linkedin.com/in/rick-james-dunn7?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAV_kX0BYFJyLwS-xHwVJK_uLpR3qTd2PWE&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BrJkIn72LTAWuNzKXAYdxVw%3D%3D', 'Rick Dunn', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 21, 1, 0, NULL, 'N/A', 1, 'New York, New York', 40, 'Needs Improvement', '2025-05-27 14:31:07', '2025-05-27 14:31:09'),
(194, NULL, 'https://www.linkedin.com/in/tim-steer-9518b57?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAFg8g0BTWGxGBNqJJPZpW7mm4ZrFN-cFkM&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BrJkIn72LTAWuNzKXAYdxVw%3D%3D', 'Tim Steer', 'Senior Strategic Business Consultant', 'Paychex', 'PEO', 40, 7, 0, NULL, 'N/A', 1, 'Atlanta, Georgia,', 40, 'Needs Improvement', '2025-05-27 14:31:09', '2025-05-27 14:31:10'),
(195, NULL, 'https://www.linkedin.com/in/michellesikes805?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAB3cgVgBow8_55d_KO8F7X0yfGaZK-zewlI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2Jfgkd9hTumhOJJ%2BgQa6Nw%3D%3D', 'Michelle Sikes SHRM-SCP', 'Client Business Partner', 'BBSI', 'PEO', 19, 5, 0, NULL, 'N/A', 0, 'Los Angeles Metropolitan Area', 30, 'Needs Improvement', '2025-05-27 14:31:10', '2025-05-27 14:31:11'),
(196, NULL, 'https://www.linkedin.com/in/david-porter-aa39324?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAADZcpsBfy2YFx8uCoCGM70H_NHpsSqYFtY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2Jfgkd9hTumhOJJ%2BgQa6Nw%3D%3D', 'David Porter', 'Senior Business Consultant', 'CoAdvantage', 'PEO', 21, 6, 0, NULL, 'N/A', 0, 'Alpharetta, Georgia', 20, 'Needs Improvement', '2025-05-27 14:31:11', '2025-05-27 14:31:14'),
(197, NULL, 'https://www.linkedin.com/in/nick-oakley-7592664?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAC_6rUBssmDuO99nQLCcMqp-aV79FENPrI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2Jfgkd9hTumhOJJ%2BgQa6Nw%3D%3D', 'Nick Oakley', 'Business Consultant', 'CoAdvantage', 'PEO', 17, 1, 0, NULL, 'N/A', 0, 'Costa Mesa, California', 35, 'Needs Improvement', '2025-05-27 14:31:14', '2025-05-27 14:31:15'),
(198, NULL, 'https://www.linkedin.com/in/leanne-wismeg-10884110?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAJCa1gBUD2TXHQFhKbUGswb7XioZNuomc4&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2Jfgkd9hTumhOJJ%2BgQa6Nw%3D%3D', 'Leanne Wismeg', 'Senior Strategic Business Consultant', 'Paychex', 'PEO', 38, 7, 0, NULL, 'N/A', 0, 'Jacksonville, Florida', 50, 'Average Performer', '2025-05-27 14:31:15', '2025-05-27 14:31:17'),
(199, NULL, 'https://www.linkedin.com/in/john-beaty-8b5b1438?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAf-9QkBmapEdPg4-KRCUHGXj8asG2wj8eA&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2Jfgkd9hTumhOJJ%2BgQa6Nw%3D%3D', 'John Beaty', 'Business Consultant', 'Peoplease', 'PEO', 21, 1, 0, NULL, 'N/A', 0, 'Dallas-Fort Worth Metroplex ', 30, 'Needs Improvement', '2025-05-27 14:31:17', '2025-05-27 14:31:18'),
(200, NULL, 'https://www.linkedin.com/in/collin-curbo-35146880?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABEnTe0B1sgox4WWQ6tfPBQSTrTNmEgNN8M&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2Jfgkd9hTumhOJJ%2BgQa6Nw%3D%3D', 'Collin Curbo', 'Executive Business Consultant', 'resourcing edge', 'PEO', 5, 3, 0, NULL, 'N/A', 0, 'Dallas-Fort Worth Metroplex', 40, 'Needs Improvement', '2025-05-27 14:31:18', '2025-05-27 14:31:20'),
(201, NULL, 'https://www.linkedin.com/in/davecicconeadp?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAOqs-gBv52t9juS5oDwm-TXVg26Sujafrk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2Jfgkd9hTumhOJJ%2BgQa6Nw%3D%3D', 'David S. Ciccone', 'Business Consultant', '985 Enterprises,LLC', 'PEO', 39, 6, 0, NULL, 'N/A', 0, 'Wyckoff, New Jersey', 35, 'Needs Improvement', '2025-05-27 14:31:20', '2025-05-27 14:31:22'),
(202, NULL, 'https://www.linkedin.com/in/erinhollenstein?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAADwXUAButdaBk7xN1pm_u0oJ9dyIkdr_fY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2Jfgkd9hTumhOJJ%2BgQa6Nw%3D%3D', 'Erin Hollenstein', 'Business Consultant', 'CoAdvantage', 'PEO', 21, 1, 0, NULL, 'N/A', 0, 'Dallas-Fort Worth Metroplex', 30, 'Needs Improvement', '2025-05-27 14:31:22', '2025-05-27 14:31:23'),
(203, NULL, 'https://www.linkedin.com/in/sandravaldiosera?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAACk56sBVe54Mvfn2JR6NtKDXuM_OCk24D0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B2Jfgkd9hTumhOJJ%2BgQa6Nw%3D%3D', 'Sandra Valdiosera', 'Senior HCM Technology Business Consultant', 'TriNet', 'PEO', 17, 4, 0, NULL, 'N/A', 0, 'San Francisco Bay Area', 40, 'Needs Improvement', '2025-05-27 14:31:23', '2025-05-27 14:31:25'),
(204, NULL, 'https://www.linkedin.com/in/steve-etheridge-65808313?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAKuD-QByLPQE1kAsJpyeKFOyxNZPYHOjSg&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B6C6wfzc3TJCs4wRexOcdcQ%3D%3D', 'Steve Etheridge', 'Sr. Strategic Business Consultant', 'Oasis', 'PEO', 29, 8, 0, NULL, 'N/A', 0, 'Lakeland, Florida', 20, 'Needs Improvement', '2025-05-27 14:31:25', '2025-05-27 14:31:26'),
(205, NULL, 'https://www.linkedin.com/in/glennamsb?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAABPKMQBzHhrtnp6jaINj0wV3VnReamL2tE&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B6C6wfzc3TJCs4wRexOcdcQ%3D%3D', 'Glenna Bongcaron', 'Human Resources Business Consultant', 'Various PE-backed companies', 'PEO', 13, 3, 0, NULL, 'N/A', 0, 'San Francisco, California', 50, 'Average Performer', '2025-05-27 14:31:26', '2025-05-27 14:31:28'),
(206, NULL, 'https://www.linkedin.com/in/leia-porges-59b6121?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAABEuccBuG0l0VtCgtdW6Pn_k77gzTqk_X8&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B6C6wfzc3TJCs4wRexOcdcQ%3D%3D', 'Leia Porges', 'Senior Solutions Consultant', 'SinglePoint Outsourcing', 'PEO', 31, 17, 0, NULL, 'N/A', 0, 'Modesto, California', 31, 'Needs Improvement', '2025-05-27 14:31:28', '2025-05-27 14:31:34'),
(207, NULL, 'https://www.linkedin.com/in/rhonda-vogel-662b327?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAFpuCoBM3ChWCO7Ulx3McqBnsxST5TkD5U&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B6C6wfzc3TJCs4wRexOcdcQ%3D%3D', 'Rhonda Vogel', 'Senior Strategic Business Consultant', 'Paychex', 'PEO', 31, 17, 0, NULL, 'N/A', 0, 'St Louis, Missouri', 40, 'Needs Improvement', '2025-05-27 14:31:34', '2025-05-27 14:31:35'),
(208, NULL, 'https://www.linkedin.com/in/michaelarena1?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAiPoEsB9pX1GmvVlwM30s4crD3MH5HTu7Y&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B6C6wfzc3TJCs4wRexOcdcQ%3D%3D', 'Michael Arena', 'Business Consultant', 'CoAdvantage', 'PEO', 22, 4, 0, NULL, 'N/A', 0, 'Charlotte Metro', 25, 'Needs Improvement', '2025-05-27 14:31:35', '2025-05-27 14:31:37'),
(209, NULL, 'https://www.linkedin.com/in/jorge-ramos88?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAASlh1ABQu-t75_i1-L6rJxOHcA1YZWSOhU&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B6C6wfzc3TJCs4wRexOcdcQ%3D%3D', 'Jorge Ramos', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 13, 1, 0, NULL, 'N/A', 0, 'Charlotte, North Carolina', 20, 'Needs Improvement', '2025-05-27 14:31:37', '2025-05-27 14:31:39'),
(210, NULL, 'https://www.linkedin.com/in/bsprings?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAC1S5cBiAtgKGfwizCAegjoMPr6uMBvnPs&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B6C6wfzc3TJCs4wRexOcdcQ%3D%3D', 'Brandon Springer', 'HR Business Consultant', 'TriNet', 'PEO', 19, 2, 0, NULL, 'N/A', 0, 'Alpharetta, Georgia', 40, 'Needs Improvement', '2025-05-27 14:31:39', '2025-05-27 14:31:40'),
(211, NULL, 'https://www.linkedin.com/in/indi-ericksen?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABPkxUUBTqGGDpEG2G8erR3OslQfLCnvZPw&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B6C6wfzc3TJCs4wRexOcdcQ%3D%3D', 'Indi Ericksen', 'Business Consultant', 'CoAdvantage', 'PEO', 15, 5, 0, NULL, 'N/A', 1, 'New York, New York', 30, 'Needs Improvement', '2025-05-27 14:31:40', '2025-05-27 14:31:41'),
(212, NULL, 'https://www.linkedin.com/in/kacie-lay?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABNgkVMBxCEN-MnYu4itTPWqz8jBGeZmG0w&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B6C6wfzc3TJCs4wRexOcdcQ%3D%3D', 'Kacie L', 'Sales Consultant', 'TriNet', 'PEO', 9, 2, 0, NULL, 'N/A', 0, 'Charlotte, North Carolina', 30, 'Needs Improvement', '2025-05-27 14:31:41', '2025-05-27 14:31:42'),
(213, NULL, 'https://www.linkedin.com/in/siarichey?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAALJi3oB9C68MPTHJFElaxWfNv5tX629Q2g&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2B5WlY98YQjinquA%2F%2BPpxCw%3D%3D', 'Sia Richey', 'Business Consultant Director', 'ADP', 'PEO', 27, 6, 0, NULL, 'N/A', 0, 'Greater Phoenix Area', 15, 'Needs Improvement', '2025-05-27 14:31:42', '2025-05-27 14:31:43'),
(214, NULL, 'https://www.linkedin.com/in/thechristyrangel?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAypN7wBvACuZmATlNt2ZUi-qT8A5-7B5qk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2B5WlY98YQjinquA%2F%2BPpxCw%3D%3D', 'Christy Rangel', 'Human Resources Consultant', 'Paychex', 'PEO', 17, 6, 0, NULL, 'N/A', 0, 'Denver, Colorado', 40, 'Needs Improvement', '2025-05-27 14:31:43', '2025-05-27 14:31:45'),
(215, NULL, 'https://www.linkedin.com/in/steven-abrams-45b7a5a?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAHlgkcBU9cG9Es2rguoC5eKWS7ljUaJYCM&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2B5WlY98YQjinquA%2F%2BPpxCw%3D%3D', 'Steven Abrams', 'Business Consultant Director', 'Trion Solutions, Inc', 'PEO', 19, 4, 0, NULL, 'N/A', 0, 'Delray Beach, Florida', 25, 'Needs Improvement', '2025-05-27 14:31:45', '2025-05-27 14:31:54'),
(216, NULL, 'https://www.linkedin.com/in/derrick-willis-791354113?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABxZiF0BPII7Iqoz91ffyMoEVMht9aOW2Ns&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2B5WlY98YQjinquA%2F%2BPpxCw%3D%3D', 'Derrick Willis', 'Senior Business Consultant', 'VanStone & Associates', 'PEO', 19, 10, 0, NULL, 'N/A', 0, 'Tampa, Florida', 35, 'Needs Improvement', '2025-05-27 14:31:54', '2025-05-27 14:31:55'),
(217, NULL, 'https://www.linkedin.com/in/chad-myers-85578065?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAA3RcMEB4ZicYNyL_F_KWGX-KBwOuOvp558&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2B5WlY98YQjinquA%2F%2BPpxCw%3D%3D', 'Chad Myers', 'Business Consultant Director', 'CoAdvantage', 'PEO', 16, 3, 0, NULL, 'N/A', 0, 'New York City Metropolitan Area', 30, 'Needs Improvement', '2025-05-27 14:31:55', '2025-05-27 14:31:57'),
(218, NULL, 'https://www.linkedin.com/in/natalie-garza-224905ab?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABdy_vwBhFnlpNblRUCZiV1hRCZYqRRRQvo', 'Natalie Garza', 'Sr. PEO Sales Operations Coordinator', 'Paychex', 'PEO', 11, 1, 0, NULL, 'N/A', 0, 'Irving, Texas', 45, 'Needs Improvement', '2025-05-27 14:31:57', '2025-05-27 14:31:59'),
(219, NULL, 'https://www.linkedin.com/in/catherine-williams-4a779922?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAS-TH8BVHazrYLYYTj3P1iKNWmNzsSCcMY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2B5WlY98YQjinquA%2F%2BPpxCw%3D%3D', 'Catherine (Baiza) Williams', 'HR Business Partner', 'Indiana University', 'PEO', 7, 3, 0, NULL, 'N/A', 0, 'Noblesville, Indiana', NULL, NULL, '2025-05-27 14:31:59', '2025-05-27 14:32:03'),
(220, NULL, 'https://www.linkedin.com/in/petersalata?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAF61ZgBMsrhyK_zuiMlVUhUHJCQowTBkYc&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2B5WlY98YQjinquA%2F%2BPpxCw%3D%3D', 'Peter Salata', 'Senior Business Consultant', 'Armhr', 'PEO', 25, 2, 0, NULL, 'N/A', 0, 'New York, New York', 30, 'Needs Improvement', '2025-05-27 14:32:03', '2025-05-27 14:32:05'),
(221, NULL, 'https://www.linkedin.com/in/zakiaford?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAA2tfUcBY1jdW5ynMTYtSAWG-PsDkC2XY4Q&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2B5WlY98YQjinquA%2F%2BPpxCw%3D%3D', 'Zakia Ford', 'Interim Head of HR and Consultant', 'DevNW', 'PEO', 7, 1, 0, NULL, 'N/A', 0, 'Atlanta, Georgia', 40, 'Needs Improvement', '2025-05-27 14:32:05', '2025-05-27 14:32:06'),
(222, NULL, 'https://www.linkedin.com/in/jenncpvaughan?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAW5gVgBFab4gU6KFR9CEPbgkMs-TsuT3WI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2B5WlY98YQjinquA%2F%2BPpxCw%3D%3D', 'Jennifer Vaughan', 'Business Consultant Director', 'CoAdvantage', 'PEO', 26, 1, 0, NULL, 'N/A', 0, 'Jacksonville Beach, Florida', 15, 'Needs Improvement', '2025-05-27 14:32:06', '2025-05-27 14:32:07'),
(223, NULL, 'https://www.linkedin.com/in/robin-gatley-362054bb?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABl1IfoBytcqFKvReolJhHJWX2aEuZ7l1iw&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B56%2F%2ByKquTROcm2Zcq8HXgA%3D%3D', 'Robin Gatley', 'Sales Business Development Consultant', 'Paychex', 'PEO', 26, 8, 0, NULL, 'N/A', 0, 'Phoenix, Arizona', 40, 'Needs Improvement', '2025-05-27 14:32:07', '2025-05-27 14:32:09'),
(224, NULL, 'https://www.linkedin.com/in/fredsimonds?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAABfkh8BqPG9mP6tgwxtaeLpAEuhv8OKOMk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B56%2F%2ByKquTROcm2Zcq8HXgA%3D%3D', 'Fred Simonds', 'Senior Business Solutions Consultant', 'ManagedPAY', 'PEO', 16, 1, 0, NULL, 'N/A', 0, 'Las Vegas, Nevada', 30, 'Needs Improvement', '2025-05-27 14:32:09', '2025-05-27 14:32:12'),
(225, NULL, 'https://www.linkedin.com/in/aoroshnik?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAAt3koBs6-vQgn6TaKySq1SEnSrQn6fIf0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B56%2F%2ByKquTROcm2Zcq8HXgA%3D%3D', 'Amy Oroshnik', 'Senior Consultant', 'ALO Human Resources, Inc', 'PEO', 29, 10, 0, NULL, 'N/A', 0, 'Los Angeles, California', 45, 'Needs Improvement', '2025-05-27 14:32:12', '2025-05-27 14:32:13'),
(226, NULL, 'https://www.linkedin.com/in/jordan-fike-725953112?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABxCuU0BtFa3_gCCZMgguhwSYxkksqFKJUs&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B56%2F%2ByKquTROcm2Zcq8HXgA%3D%3D', 'Jordan Fike', 'Business Consultant', 'Nextep', 'PEO', 5, 1, 0, NULL, 'N/A', 0, 'Greater Minneapolis-St. Paul Area', 20, 'Needs Improvement', '2025-05-27 14:32:13', '2025-05-27 14:32:14'),
(227, NULL, 'https://www.linkedin.com/in/jeffsapinsley?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAoUkt0BwcIhuQHIiMRSaievjFZY7ArcAVc&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B56%2F%2ByKquTROcm2Zcq8HXgA%3D%3D', 'Jeff S', 'Business Consultant', 'CoAdvantage', 'PEO', 23, 3, 0, NULL, 'N/A', 0, 'Atlanta Metropolitan Area', 30, 'Needs Improvement', '2025-05-27 14:32:14', '2025-05-27 14:32:15'),
(228, NULL, 'https://www.linkedin.com/in/sylviacarrillo?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAC8G3QB1gH_Kav4N-pj9WqOOhuO1_AK0qE&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B56%2F%2ByKquTROcm2Zcq8HXgA%3D%3D', 'Sylvia C', 'HR Business Partner/Consultant', 'Client Companies in the San Francisco Bay Area and United States', 'PEO', 10, 9, 0, NULL, 'N/A', 1, 'San Francisco Bay Area', 70, 'Strong Consultant', '2025-05-27 14:32:15', '2025-05-27 14:32:18'),
(229, NULL, 'https://www.linkedin.com/in/johnjavelli?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAGFOp8BeWWWlgEXYeZMjGyWLppIbZ5jB_Y&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B56%2F%2ByKquTROcm2Zcq8HXgA%3D%3D', 'John Javelli', 'Business and Client Consultant', 'LL Roberts Group', 'PEO', 40, 16, 0, NULL, 'N/A', 0, 'Dallas, Texas', 55, 'Average Performer', '2025-05-27 14:32:18', '2025-05-27 14:32:22');
INSERT INTO `consultants` (`id`, `user_id`, `linkedin_url`, `full_name`, `job_title`, `company`, `industry`, `total_experience`, `tenure`, `performance_keywords`, `achievements`, `revenue_closed`, `college_degree`, `location`, `ai_score`, `ranking_level`, `created_at`, `updated_at`) VALUES
(230, NULL, 'https://www.linkedin.com/in/beth-casey-b414a1a?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAHaByEBoXDZmLG66nQ0Deu7Z_upzoBjJeM&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B56%2F%2ByKquTROcm2Zcq8HXgA%3D%3D', 'Beth Casey', 'Business Development Consultant', 'InTandem Human Resources, LLC', 'PEO', 31, 10, 0, NULL, 'N/A', 0, 'Denver Metropolitan Area', 31, 'Average Performer', '2025-05-27 14:32:22', '2025-05-27 14:32:29'),
(231, NULL, 'https://www.linkedin.com/in/hollyjett?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAM45s0Bvr21hM2xSYGNMzZO7uxYrmLQYIg&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B56%2F%2ByKquTROcm2Zcq8HXgA%3D%3D', 'Holly Jett Kraiker', 'Business Consultant', 'Sequoia', 'PEO', 19, 1, 0, NULL, 'N/A', 0, 'San Francisco Bay Area', 40, 'Needs Improvement', '2025-05-27 14:32:29', '2025-05-27 14:32:30'),
(232, NULL, 'https://www.linkedin.com/in/craigcash?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAIqNusBmdURL_fbUhk76k_wUQQ7MdR8nr0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B56%2F%2ByKquTROcm2Zcq8HXgA%3D%3D', 'Craig Cash', 'Business Consultant', 'CoAdvantage', 'PEO', 32, 7, 0, NULL, 'N/A', 0, 'Gainesville Metropolitan Area', 35, 'Needs Improvement', '2025-05-27 14:32:30', '2025-05-27 14:32:31'),
(233, NULL, 'https://www.linkedin.com/in/dan-hernandez-444221?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAAIQzQBCUq922RwAP6Q_1npCJHFtDkOOC0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2Br0AS6NvSGKq7EUkWR9keA%3D%3D', 'Dan Hernandez', 'Senior Business Consultant', 'CoAdvantage', 'PEO', 35, 3, 0, NULL, 'N/A', 1, 'Irving, Texas', 45, 'Needs Improvement', '2025-05-27 14:32:31', '2025-05-27 14:32:33'),
(234, NULL, 'https://www.linkedin.com/in/kenmackay?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABeTangBOwob0vaUTo_zq0wCyR0VjjWP-6I&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2Br0AS6NvSGKq7EUkWR9keA%3D%3D', 'Ken MacKay', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 11, 1, 0, NULL, 'N/A', 0, 'Fort Myers, Florida', 35, 'Needs Improvement', '2025-05-27 14:32:33', '2025-05-27 14:32:35'),
(235, NULL, 'https://www.linkedin.com/in/roman-cenizal-704a01119?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAB2D0rQBb9oSzojyzIuUKxdInXDdjXxnmks&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2Br0AS6NvSGKq7EUkWR9keA%3D%3D', 'Roman Cenizal', 'Business Consultant', 'TriNet', 'PEO', 8, 1, 0, NULL, 'N/A', 0, 'Miami, Florida', 10, 'Needs Improvement', '2025-05-27 14:32:35', '2025-05-27 14:32:36'),
(236, NULL, 'https://www.linkedin.com/in/nick-hughes-56b60b162?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAACbjtWMBjBTztDZ0l1guWdiIQpzNkfLXlso&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2Br0AS6NvSGKq7EUkWR9keA%3D%3D', 'Nick Hughes', 'Strategic Business Consultant | PEO Services', 'Paychex', 'PEO', 10, 1, 0, NULL, 'N/A', 0, 'West Des Moines, Iowa', 30, 'Needs Improvement', '2025-05-27 14:32:36', '2025-05-27 14:32:37'),
(237, NULL, 'https://www.linkedin.com/in/tara-bowne?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABHStEQBKP7pKMQrGLFQd3F5ErucvERX2S8&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2Br0AS6NvSGKq7EUkWR9keA%3D%3D', 'Tara (Lukehart) Bowne ', 'HCM Consultant -Sales', 'iSolved HCM', 'PEO', 15, 6, 0, NULL, 'N/A', 1, 'Omaha Metropolitan Area', 65, 'Average Performer', '2025-05-27 14:32:37', '2025-05-27 14:32:40'),
(238, NULL, 'https://www.linkedin.com/in/darlene-underwood-55218410?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAIpMg4BkDxTpbeeOaGHpJ7rBKwaj0SAj44&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2Br0AS6NvSGKq7EUkWR9keA%3D%3D', 'Darlene Underwood', 'Executive Coaching Director', 'FACET INC', 'PEO', 34, 14, 0, NULL, 'N/A', 0, 'Houston, Texas', 45, 'Needs Improvement', '2025-05-27 14:32:40', '2025-05-27 14:32:41'),
(239, NULL, 'https://www.linkedin.com/in/janiceeskesen?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAALpQscBPPueFP3sWpta9DmTHwY5KDRfnkQ&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2Br0AS6NvSGKq7EUkWR9keA%3D%3D', 'Janice Eskesen', 'Senior Principal Solutions Consultant', 'ADP', 'PEO', 39, 1, 0, NULL, 'N/A', 0, 'Greater Tampa Bay Area', 40, 'Needs Improvement', '2025-05-27 14:32:41', '2025-05-27 14:32:43'),
(240, NULL, 'https://www.linkedin.com/in/don-jones-mba-fpc-50192b4?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAADZWxEBTjYCgDyPhhvN6hn0iyxXweCuLGw&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2Br0AS6NvSGKq7EUkWR9keA%3D%3D', 'Don Jones', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 37, 1, 0, NULL, 'N/A', 0, 'United States', 15, 'Needs Improvement', '2025-05-27 14:32:43', '2025-05-27 14:32:45'),
(241, NULL, 'https://www.linkedin.com/in/steve-clark-99444320?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAARWDcABVs7igrMxCn23y0Fms2RsDL-8Le0&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2Br0AS6NvSGKq7EUkWR9keA%3D%3D', 'Steve Clark', 'Senior Business Consultant', 'The Alliance Group, Inc', 'PEO', 30, 2, 0, NULL, 'N/A', 1, 'Omaha Metropolitan Area', 45, 'Needs Improvement', '2025-05-27 14:32:45', '2025-05-27 14:32:46'),
(242, NULL, 'https://www.linkedin.com/in/eric-jaklitsch-220aa52b?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAZj9PgBPCUDMWgLR_FWrifgu2KLYtOxTsg&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3B%2Br0AS6NvSGKq7EUkWR9keA%3D%3D', 'Eric Jaklitsch', 'Business Consultant', 'CoAdvantage', 'PEO', 26, 9, 0, NULL, 'N/A', 0, 'New York, New York', 35, 'Needs Improvement', '2025-05-27 14:32:46', '2025-05-27 14:32:49'),
(243, NULL, 'https://www.linkedin.com/in/britt-riese-paychexhr?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAADIJu9oBkOIX5r36426hX6KIFgxCzh-Ks20&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqYivf91PSQS6EI0191GfuA%3D%3D', 'Britt Riese, SHRM-CP', 'Sr. Business Consultant I Senior Living', 'Paychex', 'PEO', 18, 3, 0, NULL, 'N/A', 0, 'United States', 70, 'Strong Consultant', '2025-05-27 14:32:49', '2025-05-27 14:32:50'),
(244, NULL, 'https://www.linkedin.com/in/donna-jw-hare-8204039?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAGpWNgBucHZ0LuBsi0fLiXuQI3hX72DZy8&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqYivf91PSQS6EI0191GfuA%3D%3D', 'Donna JW Hare', 'Sr. Business Performance Consultant', 'Insperity', 'PEO', 29, 5, 0, NULL, 'N/A', 1, 'Spring, Texas', 40, 'Needs Improvement', '2025-05-27 14:32:50', '2025-05-27 14:32:51'),
(245, NULL, 'https://www.linkedin.com/in/stevewatson72?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAACGuoUBJsZu6cxdF8rHJ_K0WFxpV2Rr9sY&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqYivf91PSQS6EI0191GfuA%3D%3D', 'Steve Watson', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 28, 1, 0, NULL, 'N/A', 0, 'Dallas, Texas', 30, 'Needs Improvement', '2025-05-27 14:32:51', '2025-05-27 14:32:52'),
(246, NULL, 'https://www.linkedin.com/in/jordanzellner?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAB4AyQYBP6yu1PlDJ1g0NOqQheMeAVoInNQ&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqYivf91PSQS6EI0191GfuA%3D%3D', 'Jordan Zellner', 'Business Consultant', 'CoAdvantageCoAdvantage', 'PEO', 11, 7, 0, NULL, 'N/A', 1, 'Ocala, Florida', 35, 'Needs Improvement', '2025-05-27 14:32:52', '2025-05-27 14:32:53'),
(247, NULL, 'https://www.linkedin.com/in/ryancamis?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAB6NqewB5Z47nFrnKshjlkMnYlzjjVCbR38&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqYivf91PSQS6EI0191GfuA%3D%3D', 'Ryan Camis', 'Strategic Business Consultant', 'Paychex', 'PEO', 12, 1, 0, NULL, 'N/A', 0, 'Davenport, Florida', 20, 'Needs Improvement', '2025-05-27 14:32:53', '2025-05-27 14:32:56'),
(248, NULL, 'https://www.linkedin.com/in/betty-bartram-b76b2a11?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAJ7AAoBqKDsBDRBpJolCXF3f5aYICgqzsk&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqYivf91PSQS6EI0191GfuA%3D%3D', 'Betty Bartram', 'Professional Employer Business Consultant', 'Oasis', 'PEO', 23, 5, 0, NULL, 'N/A', 0, 'Des Moines, Iowa', 20, 'Needs Improvement', '2025-05-27 14:32:56', '2025-05-27 14:32:57'),
(249, NULL, 'https://www.linkedin.com/in/denise-mcclafferty-90486a12?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAKebpQBJS8do9yLK_rQDmaE-KRsHtOG3UU&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqYivf91PSQS6EI0191GfuA%3D%3D', 'Denise McClafferty\n', 'HR Business Consultant', 'Human Resources Business Consultant', 'PEO', 9, 6, 0, NULL, 'N/A', 0, 'Hauppauge, New York', 45, 'Needs Improvement', '2025-05-27 14:32:57', '2025-05-27 14:32:58'),
(250, NULL, 'https://www.linkedin.com/in/nelliemcclellan?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAABrXR_UBAwyR4TgHVM01jXhIoxprmiRF9ls&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqYivf91PSQS6EI0191GfuA%3D%3D', 'Nellie McClellan', 'Senior Business Consultant', 'Nextep', 'PEO', 10, 1, 0, NULL, 'N/A', 1, 'Houston, Texas', 50, 'Average Performer', '2025-05-27 14:32:58', '2025-05-27 14:33:00'),
(251, NULL, 'https://www.linkedin.com/in/eric-swift-05328355?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAAubxH8BgCyojfGs4QKu0IIlxYgRi4t_2MI&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqYivf91PSQS6EI0191GfuA%3D%3D', 'Eric Swift', 'Business Consultant', 'Vensure Employer Solutions', 'PEO', 21, 4, 0, NULL, 'N/A', 1, 'Santa Clarita, California,', 30, 'Needs Improvement', '2025-05-27 14:33:00', '2025-05-27 14:33:01'),
(252, NULL, 'https://www.linkedin.com/in/joel-r-plascencia-4050285?miniProfileUrn=urn%3Ali%3Afs_miniProfile%3AACoAAADkqkUB_dT53-xSbM6Zb57IsEDpTJcO65U&lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_people_load_more%3BqYivf91PSQS6EI0191GfuA%3D%3D', 'Joel R. Plascencia', 'HR Business Consultant', 'BBSI', 'PEO', 17, 17, 0, NULL, 'N/A', 0, 'Turlock, California', 40, 'Needs Improvement', '2025-05-27 14:33:02', '2025-05-27 14:33:04'),
(253, 5, 'https://www.linkedin.com/in/jessicarodriguez1514', 'Jessica Rodriguez', NULL, NULL, NULL, 14, 6, 0, NULL, NULL, 0, NULL, NULL, NULL, '2025-05-29 12:20:37', '2025-05-29 12:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `consulting_page_hero_sections`
--

CREATE TABLE `consulting_page_hero_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consulting_page_hero_sections`
--

INSERT INTO `consulting_page_hero_sections` (`id`, `title`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Want to Prove You\'re Among the Best?', 'seeder/consultingbg.png', '<p>Submit Your Data. Get Your Score. Stand Out.</p>', '2025-05-15 10:57:19', '2025-05-15 10:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('termsAndConditions','privacyPolicy') NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `type`, `title`, `slug`, `content`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'termsAndConditions', 'Terms & Conditions', 'terms-conditions', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>', 'active', '2025-01-11 23:37:30', '2025-01-12 23:40:33', NULL),
(2, 'privacyPolicy', 'Privacy Policy', 'privacy-policy', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'active', '2025-01-14 23:37:30', '2025-01-15 23:40:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `conduct_by` varchar(255) NOT NULL,
  `course_duration` int(11) NOT NULL,
  `course_level` enum('beginner','intermediate','advanced') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `conduct_by`, `course_duration`, `course_level`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Web Design Fundamentals', '<p>Learn the fundamentals of web design, including HTML, CSS, and responsive design principles. Develop the skills to create visually appealing and user-friendly websites.</p>', 'John Smith', 4, 'beginner', 'seeder/aiimg7.png', 'active', '2025-05-20 05:10:18', '2025-05-20 05:10:18', NULL),
(2, 'Advanced UI/UX Design', '<p>Deep dive into UI/UX principles, wireframing, and prototyping with tools like Figma and Adobe XD.</p>', 'Jane Doe', 6, 'intermediate', 'seeder/aiimg7.png', 'active', '2025-05-20 05:11:14', '2025-05-20 05:11:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_previews`
--

CREATE TABLE `course_previews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_previews`
--

INSERT INTO `course_previews` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Our Courses', '<p>Explore our range of courses designed for beginners to advanced learners. Improve your skills and advance your career with hands-on projects and expert guidance.</p>', '2025-05-20 05:08:18', '2025-05-20 05:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `generate_script` varchar(255) DEFAULT NULL,
  `practice_pitch` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `generate_script`, `practice_pitch`, `created_at`, `updated_at`) VALUES
(1, 'backend/images/calendar.png', 'backend/images/calendar.png', '2025-05-19 10:14:34', '2025-05-19 10:14:43');

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_pages`
--

CREATE TABLE `dynamic_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `page_content` longtext NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dynamic_pages`
--

INSERT INTO `dynamic_pages` (`id`, `page_title`, `page_slug`, `page_content`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Help Center', 'help-center', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'active', '2024-01-31 23:37:30', '2024-03-31 23:40:33', NULL),
(2, 'Server Status', 'server-status', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 'active', '2024-08-10 23:37:30', '2024-09-11 23:40:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `image`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Keeping Sales Teams Thriving with Expert Performance Solutions.', 'seeder/salesteam.png', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 'active', '2025-05-17 06:30:29', '2025-05-17 06:30:29', NULL),
(2, 'Comprehensive Solutions Tailored to Your Sales Team’s Needs', 'seeder/salesteam.png', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 'active', '2025-05-17 06:31:55', '2025-05-17 06:31:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feature_blocks`
--

CREATE TABLE `feature_blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_blocks`
--

INSERT INTO `feature_blocks` (`id`, `category`, `images`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'top notch seals people', '[\"seeder\\/hero1.png\",\"seeder\\/hero2.png\",\"seeder\\/hero3.png\"]', 'active', '2025-05-13 08:45:22', '2025-05-13 08:45:22', NULL),
(2, 'digital marketing', '[\"seeder\\/hero1.png\",\"seeder\\/hero2.png\",\"seeder\\/hero3.png\"]', 'active', '2025-05-13 08:46:06', '2025-05-13 08:46:06', NULL),
(3, 'branding', '[\"seeder\\/hero1.png\",\"seeder\\/hero2.png\",\"seeder\\/hero3.png\"]', 'active', '2025-05-13 08:46:34', '2025-05-13 08:46:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `f_a_q_s`
--

CREATE TABLE `f_a_q_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `type` enum('SalesRank','Collaboration') NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `f_a_q_s`
--

INSERT INTO `f_a_q_s` (`id`, `question`, `answer`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Why is digital marketing important for my business?', 'SalesRank.AI is an AI-powered platform that evaluates and ranks sales professionals across multiple industries. With features like AI-powered rankings, industry benchmarking, and skill verification, we help businesses identify top-performing sales professionals and enhance their sales strategies.', 'SalesRank', 'active', '2025-05-10 10:03:52', '2025-05-10 10:03:52', NULL),
(2, 'How does SalesRank.AI help improve my sales team’s performance?', 'SalesRank.AI offers real-time data and analytics to identify your team\'s strengths and areas for improvement. With these insights, you can make data-driven decisions to improve performance and sales outcomes.', 'SalesRank', 'active', '2025-05-10 10:03:52', '2025-05-10 10:03:52', NULL),
(3, 'How can I use SalesRank.AI to track and benchmark my team’s performance?', 'SalesRank.AI provides clear, industry-specific benchmarks and performance tracking tools. With this, you can compare your team’s performance against top performers and identify areas to improve.', 'SalesRank', 'active', '2025-05-10 10:03:52', '2025-05-10 10:03:52', NULL),
(4, 'Can I integrate SalesRank.AI with my existing CRM or sales tools?', 'Yes, SalesRank.AI integrates with several CRM and sales tools, ensuring seamless synchronization with your existing systems to track and optimize your sales team’s performance.', 'SalesRank', 'active', '2025-05-10 10:03:52', '2025-05-10 10:03:52', NULL),
(5, 'Why should I choose Humestic?', 'SalesRank.AI is an AI-powered platform that evaluates and ranks sales professionals across multiple industries. With features like AI-powered rankings, industry benchmarking, and skill verification, we help businesses identify top-performing sales professionals and enhance their sales strategies.', 'Collaboration', 'active', '2025-05-10 10:06:23', '2025-05-10 10:06:23', NULL),
(6, 'I like your works, how do we start a project?', 'SalesRank.AI is an AI-powered platform that evaluates and ranks sales professionals across multiple industries. With features like AI-powered rankings, industry benchmarking, and skill verification, we help businesses identify top-performing sales professionals and enhance their sales strategies.', 'Collaboration', 'active', '2025-05-10 10:06:23', '2025-05-10 10:06:23', NULL),
(7, 'What info is required to get a quotation?', 'SalesRank.AI is an AI-powered platform that evaluates and ranks sales professionals across multiple industries. With features like AI-powered rankings, industry benchmarking, and skill verification, we help businesses identify top-performing sales professionals and enhance their sales strategies.', 'Collaboration', 'active', '2025-05-10 10:06:23', '2025-05-10 10:06:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `growth_stories`
--

CREATE TABLE `growth_stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `growth_stories`
--

INSERT INTO `growth_stories` (`id`, `title`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Credibility', 'seeder/consulting1.png', 'active', '2025-05-19 04:28:31', '2025-05-19 04:28:31', NULL),
(2, 'Higher Earning Potential', 'seeder/consulting2.png', 'active', '2025-05-19 04:28:43', '2025-05-19 04:28:43', NULL),
(3, 'Know Your Rank', 'seeder/consulting3.png', 'active', '2025-05-19 04:28:55', '2025-05-19 04:28:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `growth_story_banners`
--

CREATE TABLE `growth_story_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `growth_story_banners`
--

INSERT INTO `growth_story_banners` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Your Growth Story Starts Here. Speak with Our Experts Today.', '2025-05-19 04:27:13', '2025-05-19 04:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `home_page_hero_sections`
--

CREATE TABLE `home_page_hero_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_page_hero_sections`
--

INSERT INTO `home_page_hero_sections` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'The World\'s First Global Ranking Platform for Elite Sales Consultants', '<p>At SalesRank.AI, we\'ve taken the guesswork out of hiring sales consultants. Our platform ranks the world\'s top closers across multiple industries - giving you data-backed insights into who actually delivers results. Whether you\'re scaling your sales team, launching a new product, or need a closer to land that next big deal, we make it easy to find and hire top-ranked talent you can trust.</p>', 'seeder/hero.png', '2025-05-12 04:09:57', '2025-05-12 04:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `home_page_video_banner_sections`
--

CREATE TABLE `home_page_video_banner_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `video_thumbnail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_page_video_banner_sections`
--

INSERT INTO `home_page_video_banner_sections` (`id`, `title`, `description`, `video`, `video_thumbnail`, `created_at`, `updated_at`) VALUES
(1, 'Delivering top-tier sales person with groundbreaking AI innovation.', '<p>Objective Rankings: SalesRank Scores (70-100) based on real performance - not hype. Industry-Specific Filters: From SaaS to Real Estate to Medical Sales, we rank the best in each field. Projected Revenue Impact: See how much revenue each consultant could bring to your business - before you hire.</p>', NULL, 'seeder/delevery2.png', '2025-05-12 06:24:46', '2025-05-12 06:24:46');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `text`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, 'Hello! I am from user...', 'active', '2025-05-28 08:05:14', '2025-05-28 08:05:14', NULL),
(2, 3, 1, 'Hello! I am from user...', 'active', '2025-05-28 08:15:46', '2025-05-28 08:15:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_05_125715_create_system_settings_table', 1),
(5, '2024_12_08_212128_create_personal_access_tokens_table', 1),
(6, '2024_12_09_063902_create_messages_table', 1),
(7, '2025_05_04_083248_create_f_a_q_s_table', 1),
(8, '2025_05_04_084941_create_dynamic_pages_table', 1),
(9, '2025_05_04_085224_create_social_media_table', 1),
(10, '2025_05_04_090120_create_contents_table', 1),
(11, '2025_05_04_101932_create_profiles_table', 1),
(12, '2025_05_04_103035_create_portfolios_table', 1),
(13, '2025_05_11_163505_create_home_page_hero_sections_table', 1),
(14, '2025_05_12_102308_create_home_page_video_banner_sections_table', 1),
(15, '2025_05_13_150219_create_feature_blocks_table', 1),
(16, '2025_05_13_154716_create_testimonials_table', 1),
(17, '2025_05_14_172044_create_blogs_previews_table', 1),
(18, '2025_05_14_175134_create_blogs_table', 1),
(19, '2025_05_15_142931_create_newsletters_table', 1),
(20, '2025_05_15_165108_create_about_page_hero_sections_table', 1),
(21, '2025_05_15_170307_create_mission_statements_table', 1),
(22, '2025_05_15_175128_create_partner_spotlights_table', 1),
(23, '2025_05_17_091347_create_a_i_prompts_table', 1),
(24, '2025_05_17_103238_create_features_table', 1),
(25, '2025_05_17_140717_create_price_page_hero_sections_table', 1),
(26, '2025_05_17_154105_create_subscription_plans_table', 1),
(27, '2025_05_18_142634_create_consulting_page_hero_sections_table', 1),
(28, '2025_05_18_145444_create_a_i_powered_insights_table', 1),
(29, '2025_05_18_161558_create_growth_story_banners_table', 1),
(30, '2025_05_18_161559_create_growth_stories_table', 1),
(31, '2025_05_19_114658_create_sales_evaluation_banners_table', 1),
(32, '2025_05_19_114704_create_sales_evaluations_table', 1),
(33, '2025_05_19_141504_create_a_i_coach_page_hero_sections_table', 1),
(34, '2025_05_19_152256_create_documents_table', 1),
(35, '2025_05_19_162811_create_course_previews_table', 1),
(36, '2025_05_19_162813_create_courses_table', 1),
(37, '2025_05_20_113445_create_sales_rank_a_i_s_table', 1),
(38, '2025_05_20_114600_create_collaborations_table', 1),
(39, '2025_05_24_094759_create_consultants_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mission_statements`
--

CREATE TABLE `mission_statements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mission_statements`
--

INSERT INTO `mission_statements` (`id`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'seeder/missionStatement.png', '<p>At SalesRank.AI, we are building the global standard for identifying elite sales talent—bringing transparency, trust, and better results for both companies and top consultants. Great salespeople drive success, but for too long, companies have relied on gut instinct, biased referrals, and guesswork when hiring closers. Resumes can be misleading, interviews are rehearsed, and referrals lack objectivity. The wrong hire costs valuable time, money, and momentum. That’s why we leverage AI-driven insights to revolutionize the way businesses identify, evaluate, and recruit top-performing sales professionals—ensuring data-backed decisions that lead to real growth.</p>', '2025-05-15 11:19:29', '2025-05-15 11:21:44');

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `text` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `name`, `email`, `text`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Daniel Alves', 'daniel3627@example.com', 'Seventh piece of text here, which is deliberately verbose in order to meet the mandatory length requirement, going well beyond one hundred characters.', 'active', '2025-05-15 09:28:18', '2025-05-15 09:28:18', NULL),
(2, 'John Doe', 'john7093@hotmail.com', 'Just testing the newsletter submission with a much longer text that definitely goes beyond one hundred characters so it can pass any length validation rules.', 'active', '2025-05-15 09:28:49', '2025-05-15 09:28:49', NULL),
(3, 'John Smith', 'john2069@hotmail.com', 'This random text message has been extended to surpass the limit of one hundred characters, ensuring it meets the requirement for newsletter submission forms.', 'active', '2025-05-15 09:28:50', '2025-05-15 09:59:42', NULL),
(4, 'Sarah Connor', 'sarah7622@example.com', 'Fifth randomly chosen text to confirm that we exceed the set character limit for newsletter content, ensuring proper validation and illustrating realistic sample data.', 'active', '2025-05-15 09:28:51', '2025-05-15 09:58:58', NULL),
(5, 'Jane Austin', 'jane1533@hotmail.com', 'Hello! I\'d like to subscribe, but also ensuring this particular text block contains more than one hundred characters, fulfilling the necessary constraints.', 'active', '2025-05-15 09:59:48', '2025-05-15 09:59:48', NULL),
(6, 'Daniel Craig', 'daniel5638@outlook.com', 'Fourth extended random text. This example elaborates more thoroughly, surpassing one hundred characters, and demonstrating correct data length requirements.', 'active', '2025-05-15 09:59:49', '2025-05-15 09:59:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partner_spotlights`
--

CREATE TABLE `partner_spotlights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partner_spotlights`
--

INSERT INTO `partner_spotlights` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Your Partner in Sales Excellence and Business Success.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore dolor sit amet, consectetur</p>', 'seeder/excelency.png', '2025-05-15 12:03:23', '2025-05-15 12:05:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_path` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `user_id`, `project_path`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'seeder/PortfolioProject_1.pdf', 'active', '2025-05-22 09:24:52', '2025-05-22 09:24:52', NULL),
(2, 2, 'seeder/PortfolioProject_2.pdf', 'active', '2025-05-22 09:24:54', '2025-05-22 09:24:54', NULL),
(3, 2, 'seeder/PortfolioProject_3.pdf', 'active', '2025-05-22 09:24:55', '2025-05-22 09:24:55', NULL),
(4, 2, 'seeder/PortfolioProject_4.pdf', 'active', '2025-05-22 09:26:00', '2025-05-22 09:26:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `price_page_hero_sections`
--

CREATE TABLE `price_page_hero_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_page_hero_sections`
--

INSERT INTO `price_page_hero_sections` (`id`, `title`, `sub_title`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Hire With Confidence - No More Guesswork', 'Our affordable pricing options make it possible.', 'seeder/priceimg1.png', '<p>At our firm, we strive to deliver the highest quality design services while providing exceptional value to our clients. We offer competitive rates for all our services, including architectural design, interior design, project management, and furniture design, with pricing tailored to factors such as project scope, level of customization, and timeline.</p>', '2025-05-17 09:04:22', '2025-05-17 09:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `linkedin_profile_url` varchar(255) DEFAULT NULL,
  `revenue_generated_year` int(11) DEFAULT NULL,
  `revenue_generated` decimal(15,2) DEFAULT NULL,
  `industry_experience` double DEFAULT NULL,
  `present_club_experience` double DEFAULT NULL,
  `lead_close_ratio` decimal(10,2) DEFAULT NULL,
  `working_role` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `phone_number`, `linkedin_profile_url`, `revenue_generated_year`, `revenue_generated`, `industry_experience`, `present_club_experience`, `lead_close_ratio`, `working_role`, `country`, `bio`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '0123456789', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', '2025-05-05 12:25:22', '2025-05-05 12:25:22', NULL),
(2, 2, '1234567890', 'https://salesrank-react.vercel.app', 2025, 50.00, 1.7, 1.5, 80.20, NULL, NULL, NULL, 'active', '2025-05-05 12:27:22', '2025-05-05 12:27:22', NULL),
(3, 3, '123456789', 'https://salesrank-react.vercel.app', 2025, 50.00, 1.7, 1.5, 80.20, NULL, NULL, NULL, 'active', '2025-05-05 12:28:14', '2025-05-05 12:28:14', NULL),
(4, 4, '+1 (698) 829-7385', 'https://lucide.dev/icons/', 1987, 25.00, 12, 76, 56.00, NULL, NULL, NULL, 'active', '2025-05-29 12:05:11', '2025-05-29 12:05:11', NULL),
(5, 5, '+8801941885957', 'https://www.linkedin.com/in/jessicarodriguez1514', 2016, 19238.45, 14.3, 6.9, 60.81, NULL, NULL, NULL, 'active', '2025-05-29 12:20:37', '2025-05-29 12:20:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_evaluations`
--

CREATE TABLE `sales_evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_evaluations`
--

INSERT INTO `sales_evaluations` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Total Revenue Closed', '<p>The total revenue from closed deals in a given period, showing sales impact.</p>', 'active', '2025-05-19 06:50:28', '2025-05-19 06:50:28', NULL),
(2, 'Average Deal Size', '<p>The average value of each deal closed within a specific period.</p>', 'active', '2025-05-19 06:50:54', '2025-05-19 06:50:54', NULL),
(3, 'Close Rate', '<p>The % of deals closed compared to the total number of opportunities.</p>', 'active', '2025-05-19 06:51:16', '2025-05-19 06:51:16', NULL),
(4, 'Industries Served', '<p>The sectors benefiting from our sales solutions.</p>', 'active', '2025-05-19 06:51:36', '2025-05-19 06:51:36', NULL),
(5, 'Deal Velocity', '<p>The speed at which deals move through the sales pipeline.</p>', 'active', '2025-05-19 06:52:03', '2025-05-19 06:52:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_evaluation_banners`
--

CREATE TABLE `sales_evaluation_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_evaluation_banners`
--

INSERT INTO `sales_evaluation_banners` (`id`, `title`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Data-Driven Sales Evaluation: Measuring What Truly Matters', 'seeder/evaluation1.png', '2025-05-19 06:49:38', '2025-05-19 06:49:38');

-- --------------------------------------------------------

--
-- Table structure for table `sales_rank_a_i_s`
--

CREATE TABLE `sales_rank_a_i_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_rank_a_i_s`
--

INSERT INTO `sales_rank_a_i_s` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Everything You Need to Know About SalesRank.AI', '<p>Your go-to guide for understanding how our AI-powered platform can elevate your sales team\'s performance and drive business success.</p>', '2025-05-20 05:56:51', '2025-05-20 05:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FntLmSB3KptNBjeBGXFVFZlVz4SnWmYgtFn6iUxj', NULL, '15.237.250.160', 'Mozilla/5.0 (Linux; Android 7.0; SM-G892A Build/NRD90M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/60.0.3112.107 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRW5jTzRuR0xxM2E1SDFLY3Jjck9RRm9CcUlXc0MxeG5CZGMxRHY3aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly93d3cuaXNhaWFoYm95ZDYxMi5zb2Z0dmVuY2Vmc2QueHl6Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748467650),
('H1u0qM96X708JRUjTzhnDEHxSnTK8aRqUddPEJvk', NULL, '135.148.100.196', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWnQxZ1lpcUl1RXRpZ3lFU0ltQ3dIU0ZrbWtMV1oxaHR5NmdwV3M2ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vd3d3LmlzYWlhaGJveWQ2MTIuc29mdHZlbmNlZnNkLnh5eiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748401390),
('tw6wLLwIWqHFli50bsYLCqkKrqyyGoGDhb7HEd9o', NULL, '91.208.197.253', 'Mozilla/5.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVQxSzNRNkJNRWFyamUyeDdTakp5ZGpNUjJacUg3UVV2R1hYWWY3bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vd3d3LmlzYWlhaGJveWQ2MTIuc29mdHZlbmNlZnNkLnh5eiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748476348);

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `social_media` varchar(255) NOT NULL,
  `profile_link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `social_media`, `profile_link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'facebook', 'https://www.facebook.com/', '2025-02-19 00:03:21', '2025-03-19 00:03:21', NULL),
(2, 'twitter', 'https://x.com/', '2025-06-19 00:03:21', '2025-07-19 00:03:21', NULL),
(3, 'linkedin', 'https://www.linkedin.com/', '2025-08-19 00:03:21', '2025-09-19 00:03:21', NULL),
(4, 'instagram', 'https://www.instagram.com/', '2025-04-19 00:03:21', '2025-05-19 00:03:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `billing_interval` enum('month','year') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'USD',
  `description` text DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `is_recommended` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `name`, `billing_interval`, `price`, `currency`, `description`, `features`, `is_recommended`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Free Search', 'month', 0.00, 'USD', 'Limited access, search up to 10 ranked profiles, basic profile data, limited filters', '[\"Limited Access\",\"Search up to 10 ranked profiles\",\"Basic profile data\",\"Limited filters\"]', 0, 'active', '2025-05-27 14:25:51', '2025-05-27 14:25:51', NULL),
(2, 'Premium Search', 'month', 20.00, 'USD', 'Unlimited access, search up to 100 ranked profiles, detailed profile data, advanced filters', '[\"Unlimited Access\",\"Search up to 100 ranked profiles\",\"Detailed profile data\",\"Advanced filters\"]', 0, 'active', '2025-05-27 14:25:51', '2025-05-27 14:25:51', NULL),
(3, 'Ultimate Search', 'year', 200.00, 'USD', 'Unlimited access, search up to 500 ranked profiles, full profile data, premium filters', '[\"Unlimited Access\",\"Search up to 500 ranked profiles\",\"Full profile data\",\"Premium filters\"]', 1, 'active', '2025-05-27 14:25:51', '2025-05-27 14:25:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `system_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `copyright_text` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `title`, `system_name`, `email`, `phone_number`, `address`, `copyright_text`, `description`, `logo`, `favicon`, `created_at`, `updated_at`) VALUES
(1, 'SalesRank.AI', 'SalesRank.AI', 'Hey@boostim.com', '(406) 555-0120', '2972 Westheimer Rd. Santa Ana, Illinois 85486', '© 2025 SalesRank.AI. All Rights Reserved.', '<p>SalesRank.AI offers a comprehensive suite of AI-powered solutions to help you find expert sales professionals who can elevate every aspect of your business. From performance rankings and skill verification to industry benchmarking and real-time analytics, we provide the insights and tools to optimize your sales strategy and drive growth.</p>', NULL, NULL, '2025-05-09 23:00:00', '2025-05-21 03:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `title`, `image`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'John Doe', 'CEO, Company', NULL, '<p>They thoroughly analyze our industry and target audience, allowing them to develop customized campaigns that effectively reach and engage our customers.</p>', 'active', '2025-05-14 10:06:07', '2025-05-14 10:06:07', NULL),
(2, 'Jane Smith', 'Marketing Director', NULL, '<p>Their creative ideas and cutting-edge techniques have helped us stay ahead of the competition.</p>', 'active', '2025-05-14 10:06:54', '2025-05-14 10:06:54', NULL),
(3, 'Robert Johnson', 'CTO, Tech Solutions', NULL, '<p>Exceptional service with a strong focus on customer satisfaction!</p>', 'active', '2025-05-14 10:07:28', '2025-05-14 10:07:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `cover_photo` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `role` enum('admin','sales_professional','hiring_company') NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_name`, `email`, `email_verified_at`, `password`, `avatar`, `cover_photo`, `google_id`, `role`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com', '2025-05-05 12:25:21', '$2y$12$QB/Jnm/DFsWBwoyYEPDvOOhlAMBFqX2ghe40DXDAYzS5MEJuwAxwG', NULL, NULL, NULL, 'admin', 'active', NULL, '2025-05-05 12:25:22', '2025-05-05 12:25:22', NULL),
(2, 'sales', 'professional', 'sales_professional', 'sales@professional.com', '2025-05-05 12:27:21', '$2y$12$Wa4cBLy0D33a7JBQjukEXOeU2hpD5xadCiXwxCvvdg6ef5Et3aOAu', NULL, NULL, NULL, 'sales_professional', 'active', NULL, '2025-05-05 12:27:22', '2025-05-05 12:27:22', NULL),
(3, 'hiring', 'company', 'hiring_company', 'hiring@company.com', '2025-05-05 12:28:14', '$2y$12$ZYeM2adVGZ1GE4R/poQ1LOeCrLUfPZ/B4ofFGxUK2G3r01rmexj1u', NULL, NULL, NULL, 'hiring_company', 'active', NULL, '2025-05-05 12:29:14', '2025-05-05 12:29:14', NULL),
(4, 'Kimberley', 'Riddle', 'user1', 'user1@mail.com', '2025-05-29 12:05:10', '$2y$12$./uT.XJ0cDbb0bMla6IIpuL4.HFTuuR/GiTRMhBI/uKIQqSuBcDhK', NULL, NULL, NULL, 'hiring_company', 'active', NULL, '2025-05-29 12:05:10', '2025-05-29 12:05:10', NULL),
(5, 'Jessica', 'Rodriguez', 'jessicarodriguez1514', 'jessica1514@example.com', '2025-05-29 12:20:37', '$2y$12$WYJ5SlJ.S9BkMUztPdbYMOTDZY2WQqf6sOkht5b4v6ZPujG0xIUXW', NULL, NULL, NULL, 'sales_professional', 'active', NULL, '2025-05-29 12:20:37', '2025-05-29 12:20:37', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_page_hero_sections`
--
ALTER TABLE `about_page_hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_i_coach_page_hero_sections`
--
ALTER TABLE `a_i_coach_page_hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_i_powered_insights`
--
ALTER TABLE `a_i_powered_insights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_i_prompts`
--
ALTER TABLE `a_i_prompts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs_previews`
--
ALTER TABLE `blogs_previews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `collaborations`
--
ALTER TABLE `collaborations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultants`
--
ALTER TABLE `consultants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consultants_user_id_foreign` (`user_id`);

--
-- Indexes for table `consulting_page_hero_sections`
--
ALTER TABLE `consulting_page_hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_previews`
--
ALTER TABLE `course_previews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynamic_pages`
--
ALTER TABLE `dynamic_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_blocks`
--
ALTER TABLE `feature_blocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `feature_blocks_category_unique` (`category`);

--
-- Indexes for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `growth_stories`
--
ALTER TABLE `growth_stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `growth_story_banners`
--
ALTER TABLE `growth_story_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_hero_sections`
--
ALTER TABLE `home_page_hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_video_banner_sections`
--
ALTER TABLE `home_page_video_banner_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mission_statements`
--
ALTER TABLE `mission_statements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner_spotlights`
--
ALTER TABLE `partner_spotlights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolios_user_id_foreign` (`user_id`);

--
-- Indexes for table `price_page_hero_sections`
--
ALTER TABLE `price_page_hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profiles_phone_number_unique` (`phone_number`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `sales_evaluations`
--
ALTER TABLE `sales_evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_evaluation_banners`
--
ALTER TABLE `sales_evaluation_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_rank_a_i_s`
--
ALTER TABLE `sales_rank_a_i_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_plans_name_unique` (`name`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_name_unique` (`user_name`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_page_hero_sections`
--
ALTER TABLE `about_page_hero_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `a_i_coach_page_hero_sections`
--
ALTER TABLE `a_i_coach_page_hero_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `a_i_powered_insights`
--
ALTER TABLE `a_i_powered_insights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `a_i_prompts`
--
ALTER TABLE `a_i_prompts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blogs_previews`
--
ALTER TABLE `blogs_previews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `collaborations`
--
ALTER TABLE `collaborations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consultants`
--
ALTER TABLE `consultants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `consulting_page_hero_sections`
--
ALTER TABLE `consulting_page_hero_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_previews`
--
ALTER TABLE `course_previews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dynamic_pages`
--
ALTER TABLE `dynamic_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feature_blocks`
--
ALTER TABLE `feature_blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `growth_stories`
--
ALTER TABLE `growth_stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `growth_story_banners`
--
ALTER TABLE `growth_story_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_page_hero_sections`
--
ALTER TABLE `home_page_hero_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_page_video_banner_sections`
--
ALTER TABLE `home_page_video_banner_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `mission_statements`
--
ALTER TABLE `mission_statements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `partner_spotlights`
--
ALTER TABLE `partner_spotlights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `price_page_hero_sections`
--
ALTER TABLE `price_page_hero_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_evaluations`
--
ALTER TABLE `sales_evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_evaluation_banners`
--
ALTER TABLE `sales_evaluation_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_rank_a_i_s`
--
ALTER TABLE `sales_rank_a_i_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consultants`
--
ALTER TABLE `consultants`
  ADD CONSTRAINT `consultants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
