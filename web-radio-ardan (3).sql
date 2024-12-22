-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 07:50 AM
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
-- Database: `web-radio-ardan`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcers`
--

CREATE TABLE `announcers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_announcer` varchar(255) NOT NULL,
  `image_announcer` varchar(255) NOT NULL,
  `link_instagram` varchar(255) DEFAULT NULL,
  `link_tiktok` varchar(255) DEFAULT NULL,
  `link_twitter` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcers`
--

INSERT INTO `announcers` (`id`, `name_announcer`, `image_announcer`, `link_instagram`, `link_tiktok`, `link_twitter`, `bio`, `created_at`, `updated_at`) VALUES
(1, 'Zikri', 'uploads/images_announcer/Announcer1.png', '333', '333', '333', '<p>halooo</p>', '2024-10-25 03:15:24', '2024-11-16 03:34:38'),
(2, 'Kelvin', 'uploads/images_announcer/Announcer2.png', '22', '22', '22', '<p>bb</p>', '2024-10-25 03:16:17', '2024-12-17 00:56:36'),
(3, 'Salma', 'uploads/images_announcer/Announcer3.png', '66', '66', '66', NULL, '2024-10-25 03:17:40', '2024-10-25 04:33:02'),
(4, 'Arif', 'uploads/images_announcer/Announcer4.png', 'ff', 'ff', 'ff', NULL, '2024-10-25 03:18:57', '2024-10-25 04:33:58'),
(5, 'Wawan', 'uploads/images_announcer/Announcer5.png', 'dd', NULL, 'dd', NULL, '2024-10-25 03:19:39', '2024-10-25 04:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `app_links`
--

CREATE TABLE `app_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `platform_name` varchar(255) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_image` varchar(255) NOT NULL,
  `link_app` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_links`
--

INSERT INTO `app_links` (`id`, `platform_name`, `app_name`, `app_image`, `link_app`, `created_at`, `updated_at`) VALUES
(1, 'Playstore', 'Ardan Radio', 'uploads/images_app/GooglePlay.png', 'iauhdawdankoda', '2024-11-01 11:43:50', '2024-11-01 12:34:32'),
(3, 'Apple Store', 'Ardan Radio', 'uploads/images_app/AppleStore.png', 'dadhajweada', '2024-11-01 12:38:08', '2024-11-01 12:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `artis`
--

CREATE TABLE `artis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori_info` text DEFAULT NULL,
  `image_artis` varchar(255) NOT NULL,
  `judul_berita` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `ringkasan_berita` varchar(255) DEFAULT NULL,
  `konten_berita` text DEFAULT NULL,
  `publish_sekarang` tinyint(1) NOT NULL DEFAULT 1,
  `tanggal_publikasi` date DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artis`
--

INSERT INTO `artis` (`id`, `nama`, `kategori_info`, `image_artis`, `judul_berita`, `slug`, `ringkasan_berita`, `konten_berita`, `publish_sekarang`, `tanggal_publikasi`, `tanggal_dibuat`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'Juicy & Luicy', 'info_artis', 'uploads/images_artis/artis1.jpg', 'Juicy & Luicy akan konser di bandung ', 'juicy-luicy-akan-konser-di-bandung', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Ad commodo ad consequat elit eget nullam venenatis. Iaculis cubilia primis sapien integer mollis. Turpis a gravida sem orci aenean phasellus. Himen', '<p>Tristique cubilia nibh vitae semper suspendisse phasellus conubia. Nec vehicula cras tempor molestie ut laoreet quam mi. Torquent porttitor vivamus convallis ligula integer nostra.</p><p>Semper tincidunt sem fringilla, justo class mattis ligula aliquet. Fermentum volutpat euismod; curae ullamcorper duis fames lacus platea. Vehicula at libero duis adipiscing malesuada diam turpis consectetur nostra. Vel mattis diam mauris luctus maximus iaculis dui. Massa iaculis potenti egestas leo mus. Felis ullamcorper ex mollis odio mus urna. Class libero molestie faucibus fusce, volutpat vulputate donec. Maecenas pretium porta nisi amet himenaeos ac consequat; per quam. Fermentum quam odio a posuere eros vulputate.</p>', 1, '2024-12-17', '2024-11-16', 'Juicy & Luicy akan konser di bandung ', 'cjaidakdmwla', 'jawdkamlwdmawokd', '2024-10-29 04:07:29', '2024-12-17 03:19:15'),
(2, 'lorem ipsum dolor sit ', 'info_artis', 'uploads/images_artis/podcast aseek.jpg', 'lajdad ndajwda idajwkdw', 'lajdad-ndajwda-idajwkdw', 'Vel mattis diam mauris luctus maximus iaculis dui. Massa iaculis potenti egestas leo mus. Felis ullamcorper ex mollis odio mus urna. Class libero molestie faucibus fusce, volutpat vulputate donec.', '<p>Orci placerat nibh, aliquet velit class quis dictum facilisis fringilla. Placerat dapibus etiam himenaeos quis praesent posuere eros. Quisque rhoncus lacinia neque consequat litora egestas pellentesque libero pretium. Integer nulla malesuada etiam etiam pharetra egestas. Phasellus aptent commodo ac, penatibus eu elit. Efficitur blandit hac dapibus velit a aliquam tempus nullam parturient.</p><p>Non nibh cubilia metus congue mauris suspendisse enim. Massa dis auctor cursus torquent parturient; ut montes.</p>', 1, '2024-12-16', '2024-11-16', 'lajdad ndajwda idajwkdw', 'adwdpka', 'jdaoijwid', '2024-11-16 08:36:41', '2024-12-16 13:07:21'),
(3, 'svsfsf', 'info_artis', 'uploads/images_artis/podcast.jpg', 'ndJADj kyufuh ijjmm', 'ndjadj-kyufuh-ijjmm', 'Dis enim justo mauris cubilia sagittis, commodo tellus amet. Interdum blandit consectetur pulvinar et est at dui sed. Hac eu habitant magna a aliquam. Finibus rutrum sem per euismod primis metus.', '<p>Quis leo nisi taciti quam consequat orci condimentum maecenas. Rutrum fames porta cras pharetra velit. Fermentum tristique nullam nam nec laoreet taciti? At eros ante a himenaeos; tincidunt commodo. Fringilla lacinia varius sodales ad, mollis risus vivamus etiam. Fames convallis quam vel, condimentum ipsum ultricies. Consequat congue laoreet mus, per nullam suspendisse. Ac justo accumsan commodo sed netus lacinia vitae.</p>', 0, '2024-12-18', '2024-12-16', 'ndJADj kyufuh ijjmm', 'dapdwkad', 'podakwm', '2024-11-16 08:39:26', '2024-12-17 00:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_banner` varchar(255) NOT NULL,
  `image_banner` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title_banner`, `image_banner`, `created_at`, `updated_at`) VALUES
(1, 'Banner 1', 'uploads/images_banner/banner1 (1).jpg', '2024-10-22 04:43:07', '2024-10-22 04:43:07'),
(2, 'Banner 2', 'uploads/images_banner/banner2.png', '2024-10-22 04:44:31', '2024-10-22 04:44:31'),
(3, 'Banner 3', 'uploads/images_banner/banner3.png', '2024-10-22 04:45:36', '2024-10-22 04:45:36');

-- --------------------------------------------------------

--
-- Table structure for table `banner_infos`
--

CREATE TABLE `banner_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_banner_info` varchar(255) NOT NULL,
  `banner_info` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_infos`
--

INSERT INTO `banner_infos` (`id`, `title_banner_info`, `banner_info`, `created_at`, `updated_at`) VALUES
(1, 'Info', 'uploads/banner_info/bannerInfo.png', '2024-10-31 10:15:50', '2024-10-31 10:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `banner_podcasts`
--

CREATE TABLE `banner_podcasts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_banner_podcast` varchar(255) NOT NULL,
  `banner_podcast` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_podcasts`
--

INSERT INTO `banner_podcasts` (`id`, `title_banner_podcast`, `banner_podcast`, `created_at`, `updated_at`) VALUES
(1, 'Ardan Podcast', 'uploads/banner_podcast/bannerPodcast (1).png', '2024-10-31 07:26:51', '2024-10-31 09:05:17');

-- --------------------------------------------------------

--
-- Table structure for table `banner_youtubes`
--

CREATE TABLE `banner_youtubes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_banner_youtube` varchar(255) NOT NULL,
  `banner_youtube` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_youtubes`
--

INSERT INTO `banner_youtubes` (`id`, `title_banner_youtube`, `banner_youtube`, `created_at`, `updated_at`) VALUES
(1, 'Ardan On Youtube', 'uploads/images_youtube/bannerYoutube.png', '2024-10-31 10:43:35', '2024-10-31 10:43:35');

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
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1734539447),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1734539447;', 1734539447),
('a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1734832118),
('a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1734832118;', 1734832118),
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:4:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:10:\"Edit Posts\";s:1:\"c\";s:3:\"web\";}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:10:\"Modul Info\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:13:\"Modul Podcast\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:13:\"Modul Program\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:10:\"superAdmin\";s:1:\"c\";s:3:\"web\";}}}', 1734918461);

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
-- Table structure for table `charts`
--

CREATE TABLE `charts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `link_audio` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `charts`
--

INSERT INTO `charts` (`id`, `name`, `kategori_id`, `link_audio`, `created_at`, `updated_at`) VALUES
(1, 'Billie Eilish - BIRDS OF A FEATHER ', 1, 'audioChart/Billie Eilish - BIRDS OF A FEATHER (Official Music Video).mp3', '2024-10-28 11:13:29', '2024-12-02 15:33:34'),
(2, 'Hoobastank - The Reason', 2, 'audioChart/Hoobastank - The Reason (Official Music Video).mp3', '2024-10-28 11:14:06', '2024-11-12 13:10:59'),
(3, 'Alphaville - Forever Young', 3, 'audioChart/Alphaville - Forever Young ( Video Lyrics ).mp3', '2024-10-28 11:14:19', '2024-11-13 14:20:11'),
(4, 'Juicy & Luicy - Sialan', 4, 'audioChart/Adrian Khalif & Juicy Luicy - Sialan (Official Lyric Video)__m6l5nKEGIA.mp3', '2024-10-28 11:14:54', '2024-11-07 06:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_title', 'ARDAN', '2024-12-06 06:20:10', '2024-12-06 06:33:07'),
(2, 'site_description', 'Default Description', '2024-12-06 06:20:10', '2024-12-06 06:20:10'),
(3, 'site_logo', NULL, '2024-12-06 06:20:10', '2024-12-06 06:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text_1` varchar(255) DEFAULT NULL,
  `text_2` varchar(255) DEFAULT NULL,
  `email_collab` varchar(255) NOT NULL,
  `email_music` varchar(255) NOT NULL,
  `no_telepon` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `text_1`, `text_2`, `email_collab`, `email_music`, `no_telepon`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'ARDAN 105.9 FM', 'RADIO ANAK MUDA NO. 1 di BANDUNG', 'ArdanRadio123@gmail.com', 'ArdanRadio123@gmail.com', '0829126138192', 'Cipaganti', '2024-11-01 11:22:39', '2024-11-01 11:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `copy_rights`
--

CREATE TABLE `copy_rights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL,
  `copyright_owners` varchar(255) NOT NULL,
  `link_company` varchar(255) NOT NULL,
  `year` year(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `copy_rights`
--

INSERT INTO `copy_rights` (`id`, `text`, `copyright_owners`, `link_company`, `year`, `created_at`, `updated_at`) VALUES
(1, 'Copyright © 2019 Designed by:', 'ARDAN RADIO 105.9 FM', 'https://ardanradio.com/', '2019', '2024-11-01 23:23:48', '2024-11-01 23:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `podcast_id` bigint(20) UNSIGNED NOT NULL,
  `judul_episode` varchar(255) NOT NULL,
  `episode_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_event` varchar(255) DEFAULT NULL,
  `image_event` varchar(255) NOT NULL,
  `deskripsi_pendek` varchar(255) DEFAULT NULL,
  `deskripsi_event` text DEFAULT NULL,
  `date_event` date NOT NULL,
  `publish_now` tinyint(1) NOT NULL DEFAULT 1,
  `tanggal_publikasi` date DEFAULT NULL,
  `time_countdown` datetime NOT NULL,
  `status` enum('soon','upcoming','completed') NOT NULL,
  `ticket_url` varchar(255) DEFAULT NULL,
  `has_ticket` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `nama_event`, `image_event`, `deskripsi_pendek`, `deskripsi_event`, `date_event`, `publish_now`, `tanggal_publikasi`, `time_countdown`, `status`, `ticket_url`, `has_ticket`, `slug`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'Event 1', 'uploads/images_event/event1.png', 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2025-01-01', 1, '2024-12-17', '2024-12-31 11:59:00', 'soon', 'VDVZFDRDDHRTFGR', 1, 'event-1', 'Event 1', 'dadacaefawq', 'fwegrdbhgfdaaRWR', '2024-10-23 11:56:09', '2024-12-17 08:14:59'),
(2, 'Event 2', 'uploads/images_event/event2.png', 'Lorem ipsum dolor sit amet,', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua..', '2024-11-01', 1, '2024-12-17', '2024-10-31 11:59:00', 'upcoming', NULL, 0, 'event-2', 'Event 2', 'a2wwada', 'dawdad', '2024-10-23 11:59:07', '2024-12-17 08:15:34'),
(3, 'Event 3', 'uploads/images_event/event3.png', 'minim veniam, quis nostrud exercitation ullamco laboris ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris ', '2024-11-08', 1, '2024-12-17', '2024-11-07 11:59:00', 'upcoming', NULL, 0, 'event-3', 'Event 3', 'acacsadawd', 'dawdawdad', '2024-10-23 12:01:15', '2024-12-17 08:15:54');

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
-- Table structure for table `feed_instagrams`
--

CREATE TABLE `feed_instagrams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instagram_link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `infos`
--

CREATE TABLE `infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_info` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tag_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`tag_info`)),
  `deskripsi_info` text NOT NULL,
  `image_info` varchar(255) NOT NULL,
  `date_info` date NOT NULL,
  `publish_now` tinyint(1) NOT NULL DEFAULT 1,
  `tanggal_publikasi` date DEFAULT NULL,
  `top_news` tinyint(1) NOT NULL DEFAULT 0,
  `trending` tinyint(1) NOT NULL DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `infos`
--

INSERT INTO `infos` (`id`, `judul_info`, `kategori_id`, `tag_info`, `deskripsi_info`, `image_info`, `date_info`, `publish_now`, `tanggal_publikasi`, `top_news`, `trending`, `slug`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'Lari pagi ke tahura', 3, '[\"Sport\",\"Place\"]', '<p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;home2.jpg&quot;,&quot;filesize&quot;:741301,&quot;height&quot;:2700,&quot;href&quot;:&quot;http://127.0.0.1:8000/storage/info/REbrMAV20P87G3yM6xkwW6XoFNp0lHIaHqus1ZKg.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/storage/info/REbrMAV20P87G3yM6xkwW6XoFNp0lHIaHqus1ZKg.jpg&quot;,&quot;width&quot;:3600}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"http://127.0.0.1:8000/storage/info/REbrMAV20P87G3yM6xkwW6XoFNp0lHIaHqus1ZKg.jpg\"><img src=\"http://127.0.0.1:8000/storage/info/REbrMAV20P87G3yM6xkwW6XoFNp0lHIaHqus1ZKg.jpg\" width=\"3600\" height=\"2700\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">home2.jpg</span> <span class=\"attachment__size\">723.93 KB</span></figcaption></a></figure>Harus cobain lari pagi ke tahura di bandung</p>', 'uploads/images_info/info.png', '2024-10-16', 1, '2024-12-17', 1, 0, 'lari-pagi-ke-tahura', 'Lari pagi ke tahura', 'cek selengkapnya, enaknya lari pagi ke tahura', 'Tahura, tahura, lari, lari pagi, jogging, Taman Hutan Raya, taman hutan raya', '2024-10-23 10:29:03', '2024-12-17 03:56:50'),
(2, 'berita hari ini adalah kebakaran di jakarta', 3, '[\"Place\",\"Incident\"]', 'kebakaran di salah satu daerah jakarta ', 'uploads/images_info/info (1).png', '2024-10-01', 1, '2024-12-17', 0, 1, 'berita-hari-ini-adalah-kebakaran-di-jakarta', 'berita hari ini adalah kebakaran di jakarta', 'Terjadi kebakaran di Jakarta, cek selengkapnya', 'Kebakaran, kebakaran, jakarta, Kebakaran di jakarta, kebakaran di jakarta ', '2024-10-23 10:31:30', '2024-12-17 03:57:21'),
(3, 'Program seru ardan radio', 2, '[\"Musik\",\"Radio\"]', '<p>Program program seru ardan radio</p><p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;home3.jpg&quot;,&quot;filesize&quot;:1024556,&quot;height&quot;:2401,&quot;href&quot;:&quot;http://127.0.0.1:8000/storage/info/rmVmEMwEhqduA33K7Am1SRlS4HBYXfpzHqSAPbYd.jpg&quot;,&quot;url&quot;:&quot;http://127.0.0.1:8000/storage/info/rmVmEMwEhqduA33K7Am1SRlS4HBYXfpzHqSAPbYd.jpg&quot;,&quot;width&quot;:3600}\" data-trix-content-type=\"image/jpeg\" data-trix-attributes=\"{&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--jpg\"><a href=\"http://127.0.0.1:8000/storage/info/rmVmEMwEhqduA33K7Am1SRlS4HBYXfpzHqSAPbYd.jpg\"><img src=\"http://127.0.0.1:8000/storage/info/rmVmEMwEhqduA33K7Am1SRlS4HBYXfpzHqSAPbYd.jpg\" width=\"3600\" height=\"2401\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">home3.jpg</span> <span class=\"attachment__size\">1000.54 KB</span></figcaption></a></figure></p>', 'uploads/images_info/info (2).png', '2024-10-10', 1, '2024-12-17', 1, 0, 'program-seru-ardan-radio', 'Program seru ardan radio', 'yukk cek ada program seru apa aja di ardan radio ', 'Program ardan, program ardan, program seru ardan, Program Ardan, Program Radio Seru, program radio seru ', '2024-10-23 10:35:06', '2024-12-17 03:57:39'),
(4, 'Terjadi banjir di wilayah baleendah ', 3, '[\"Place\"]', 'Banjir di wilayah baleendah', 'uploads/images_info/info (3).png', '2024-10-02', 1, '2024-12-17', 0, 0, 'terjadi-banjir-di-wilayah-baleendah', 'Terjadi banjir di wilayah baleendah ', 'wilayah baleendah terjadi banjir lagi', 'Banjir, banjir, baleendah, Baleendah, banjir baleendah, Banjir Baleendah', '2024-10-23 10:36:44', '2024-12-17 03:57:56'),
(5, 'Persib akan berlaga dengan club asal singapura ', 4, '[\"Sport\"]', 'Kamis tanggal 24 oktober persib akan menjamu club asal singapura di laga acl two ', 'uploads/images_info/info (4).png', '2024-10-21', 0, '2024-12-18', 1, 0, 'persib-akan-berlaga-dengan-club-asal-singapura', 'Persib akan berlaga dengan club asal singapura ', 'Tim kebanggaan kota bandung akan melawan club asa singapura hari kamis nanti ', 'Persib Bandung, persib bandung, persib, Persib, bandung, Bandung', '2024-10-23 10:42:50', '2024-12-17 04:00:41');

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
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Top 20 ', '2024-10-25 12:10:01', '2024-10-25 12:10:01'),
(2, 'Flight 40', '2024-10-25 12:10:11', '2024-10-25 12:10:11'),
(3, 'Indie7', '2024-10-25 12:10:21', '2024-10-25 12:10:21'),
(4, 'Persada 7', '2024-10-25 12:10:30', '2024-10-25 12:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_infos`
--

CREATE TABLE `kategori_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_infos`
--

INSERT INTO `kategori_infos` (`id`, `nama_kategori`, `is_visible`, `created_at`, `updated_at`) VALUES
(1, 'Social', 1, '2024-11-06 06:09:01', '2024-12-11 15:16:02'),
(2, 'Music', 1, '2024-11-06 06:10:27', '2024-12-11 15:16:27'),
(3, 'Place', 1, '2024-11-06 06:43:11', '2024-12-11 15:18:10'),
(4, 'Sport', 1, '2024-11-06 06:44:45', '2024-12-11 15:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(73, '0001_01_01_000000_create_users_table', 1),
(74, '0001_01_01_000001_create_cache_table', 1),
(75, '0001_01_01_000002_create_jobs_table', 1),
(76, '2024_10_18_183348_create_streamings_table', 1),
(77, '2024_10_19_035708_create_media_table', 1),
(78, '2024_10_19_171114_create_banners_table', 1),
(79, '2024_10_19_183827_create_programs_table', 1),
(94, '2024_10_19_201607_create_infos_table', 2),
(95, '2024_10_20_002330_create_events_table', 2),
(96, '2024_10_20_015954_create_announcers_table', 2),
(107, '2024_10_20_030708_create_podcasts_table', 3),
(111, '2024_10_23_191030_create_episodes_table', 3),
(116, '2024_10_20_034537_create_youtubes_table', 4),
(123, '2024_10_20_050622_create_schedules_table', 5),
(124, '2024_10_24_222711_create_kategoris_table', 5),
(125, '2024_10_20_035118_create_charts_table', 6),
(126, '2024_10_25_160548_create_artis_table', 7),
(127, '2024_10_30_021710_add_nama_playlist_to_youtubes', 8),
(128, '2024_10_30_235211_create_banner_podcasts_table', 9),
(129, '2024_10_31_030351_create_banner_infos_table', 10),
(130, '2024_10_31_033152_create_banner_youtubes_table', 11),
(140, '2024_10_31_162152_create_contacts_table', 12),
(141, '2024_10_31_162505_create_social_media_table', 12),
(142, '2024_10_31_162814_create_app_links_table', 12),
(144, '2024_11_01_155543_create_copy_rights_table', 13),
(145, '2024_11_01_165321_create_partners_table', 14),
(151, '2024_11_05_220230_create_tag_infos_table', 15),
(152, '2024_11_05_221810_drop_tag_info_column_from_infos_table', 16),
(153, '2024_11_05_223747_add_tag_info_id_foreign_key_to_infos_table', 17),
(154, '2024_11_15_060815_update_link_facebook_column_in_announcers_table', 18),
(157, '2024_11_15_061035_add_columns_to_announcers_table', 19),
(161, '2024_11_15_235231_add_columns_to_artis_table', 20),
(162, '2024_11_22_124428_create_feed_instagrams_table', 21),
(163, '2024_11_26_055014_update_programs_table_add_jam_mulai_jam_selesai', 22),
(164, '2024_11_26_104319_update_schedules_table_add_jam_mulai_jam_selesai', 23),
(165, '2024_12_03_183050_modify_tag_info_id_column_in_infos_table', 24),
(166, '2024_12_03_184158_modify_tag_info_id_column_in_infos_table', 25),
(168, '2024_12_04_202326_add_is_trending_to_infos_table', 26),
(169, '2024_12_06_131347_create_configs_table', 27),
(170, '2024_12_06_135800_create_settings_table', 28),
(171, '2024_12_07_124218_add_meta_columns_to_infos_table', 29),
(172, '2024_12_08_102613_add_meta_columns_to_event_table', 30),
(173, '2024_12_08_105959_add_meta_columns_to_podcasts_table', 31),
(174, '2024_12_11_210719_rename_tag_infos_to_kategori_infos', 32),
(175, '2024_12_11_211813_modify_columns_in_table', 33),
(176, '2024_12_11_213035_modify_columns_in_table_infos', 34),
(177, '2024_12_12_220740_modify_columns_in_table_artis', 35),
(180, '2024_12_13_001647_modify_columns_in_table_events', 36),
(181, '2024_12_13_135259_modify_columns_in_table_programs', 37),
(182, '2024_12_16_144849_modify_columns_in_streamings_table', 38),
(183, '2024_12_17_085944_modify_columns_in_podcasts_table', 39),
(184, '2024_12_17_105030_modify_columns_in_infos_table', 40),
(185, '2024_12_17_142129_modify_columns_in_programs_table', 41),
(186, '2024_12_17_150835_modify_columns_in_events_table', 42),
(187, '2024_12_17_104752_create_permission_tables', 43);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_partner` varchar(255) NOT NULL,
  `logo_partner` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name_partner`, `logo_partner`, `created_at`, `updated_at`) VALUES
(1, 'Eikyo', 'uploads/images_partner/Eikyo-Logo.png', '2024-11-02 00:09:38', '2024-11-02 00:09:38');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Edit Posts', 'web', '2024-12-17 13:08:49', '2024-12-17 13:08:49'),
(2, 'Modul Info', 'web', '2024-12-17 13:18:58', '2024-12-17 13:18:58'),
(3, 'Modul Podcast', 'web', '2024-12-17 13:19:56', '2024-12-17 13:19:56'),
(4, 'Modul Program', 'web', '2024-12-17 13:20:27', '2024-12-17 13:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `podcasts`
--

CREATE TABLE `podcasts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_podcast` varchar(255) NOT NULL,
  `genre_podcast` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`genre_podcast`)),
  `deskripsi_podcast` text NOT NULL,
  `image_podcast` varchar(255) NOT NULL,
  `date_podcast` date NOT NULL,
  `publish_now` tinyint(1) NOT NULL DEFAULT 1,
  `tanggal_publikasi` date DEFAULT NULL,
  `link_podcast` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `episode_number` int(11) DEFAULT NULL,
  `is_episode` tinyint(1) NOT NULL DEFAULT 0,
  `podcast_id` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `podcasts`
--

INSERT INTO `podcasts` (`id`, `judul_podcast`, `genre_podcast`, `deskripsi_podcast`, `image_podcast`, `date_podcast`, `publish_now`, `tanggal_publikasi`, `link_podcast`, `file`, `slug`, `episode_number`, `is_episode`, `podcast_id`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'podcast asek', '[\"Comedy\"]', 'qqqqqqq', 'uploads/images_podcast/podcastAseek.png', '2024-10-21', 1, '2024-12-17', '   https://live.ardangroup.fm/memfs/1b1d14c7-4945-46b6-839d-00eb3d5a5e17.m3u8', 'audioPodcast/Lady Gaga, Bruno Mars - Die With A Smile (Official Music Video)_kPa7bsKwL-c.mp3', 'podcast-asek', 1, 1, 1, 'podcast asek', 'podcast asek', 'podcast asek', '2024-10-24 04:24:35', '2024-12-17 03:21:05'),
(2, 'Malam Jumat Horror', '[\"Horror\"]', 'dadadada', 'uploads/images_podcast/podcast.jpg', '2024-10-20', 1, '2024-12-18', 'https://live.dyntube.net/live/sgp/all/09oGc3MKXkq1vtirReWacQ/stream/live_71d78e4d6a04fd9e0a2e/live_71d78e4d6a04fd9e0a2e.m3u8?md5=DMRIhDBQpTrvQ1XJG31H2Q&expires=9779118972', 'audioPodcast/Justin Bieber - One Time (Official Music Video).mp3', 'malam-jumat-horror', NULL, 0, NULL, 'Malam Jumat Horror', 'horror', 'maljum', '2024-10-24 07:29:48', '2024-12-18 16:29:53'),
(3, 'Podcast cihuy', '[\"Comedy\"]', 'adadad', 'uploads/images_podcast/podcastCihuyy.png', '2024-10-18', 1, '2024-12-17', 'https://live.ardangroup.fm/memfs/1b1d14c7-4945-46b6-839d-00eb3d5a5e17.m3u8', 'audioPodcast/Adrian Khalif & Juicy Luicy - Sialan (Official Lyric Video)__m6l5nKEGIA.mp3', 'podcast-cihuy', 2, 1, 1, 'Podcast cihuy', 'Podcast Cihuy', 'podcast cihuyy', '2024-10-27 13:17:45', '2024-12-17 03:22:49'),
(4, 'Podcast Warawiri', '[\"Comedy\"]', '<p>lorem ipsum dolor sit amet</p>', 'uploads/images_podcast/home3.jpg', '2024-12-17', 0, '2024-12-18', 'https://live.dyntube.net/live/sgp/all/09oGc3MKXkq1vtirReWacQ/stream/live_71d78e4d6a04fd9e0a2e/live_71d78e4d6a04fd9e0a2e.m3u8?md5=DMRIhDBQpTrvQ1XJG31H2Q&expires=9779118972', 'audioPodcast/Rendy Pandugo - Sebuah Kisah Klasik.mp3', 'podcast-warawiri', NULL, 0, NULL, 'Podcast Warawiri', 'warawiri podcast', 'Podcast warawiri', '2024-12-17 03:43:09', '2024-12-17 03:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_program` varchar(255) NOT NULL,
  `deskripsi_pendek` text NOT NULL,
  `deskripsi_program` text NOT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `image_program` varchar(255) NOT NULL,
  `publish_now` tinyint(1) NOT NULL DEFAULT 1,
  `tanggal_publikasi` date DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `judul_program`, `deskripsi_pendek`, `deskripsi_program`, `jam_mulai`, `jam_selesai`, `image_program`, `publish_now`, `tanggal_publikasi`, `slug`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'Program Ardan 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '<p>&nbsp;laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '08:00:00', '09:00:00', 'uploads/images_program/program1.png', 1, '2024-12-17', 'program-ardan-1', 'Program Ardan 1', 'program ardan 1 seruu', 'Program ardan, ardan', '2024-10-22 07:58:28', '2024-12-17 07:44:52'),
(2, 'Program Ardan 2 ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt', '<p>Justo euismod pretium fames gravida varius. Egestas curabitur dui platea vestibulum malesuada. Senectus elit ac conubia tristique magnis tincidunt diam suscipit. Nam id class pulvinar curabitur suspendisse, proin nisl quisque. Curabitur ligula penatibus viverra; morbi dignissim est tempus. Volutpat et ex phasellus vivamus proin maecenas.&nbsp;</p>', '08:00:00', '10:00:00', 'uploads/images_program/program2.png', 1, '2024-12-17', 'program-ardan-2', 'Program Ardan 2 ', 'program ardan', 'Program ardan\n', '2024-10-22 08:00:30', '2024-12-17 07:47:24'),
(3, 'Program Ardan 3', 'Cursus vestibulum viverra tempus eu venenatis venenatis integer eleifend taciti. ', '<p>Varius eros aliquam dolor scelerisque adipiscing justo. Congue tempus massa faucibus sollicitudin mus ligula. Natoque mauris magnis ante elementum pellentesque curabitur sapien. Orci himenaeos sagittis ac mauris massa, luctus elit. Imperdiet dolor fringilla lobortis id, lacinia sociosqu libero natoque mi.</p>', '10:00:00', '13:00:00', 'uploads/images_program/program3.png', 1, '2024-12-17', 'program-ardan-3', 'Program Ardan 3', 'program', 'program ardan', '2024-10-22 08:01:14', '2024-12-17 07:47:54'),
(4, 'Program Ardan 4', 'Aliquam habitant dictum nostra malesuada; platea aptent. Sapien ac dapibus aenean platea euismod metus.', '<p>Velit vulputate id gravida porttitor ridiculus arcu posuere. Sapien nunc a id pharetra habitant non interdum. Tortor lacus semper molestie per porttitor ligula.</p>', '15:00:00', '16:00:00', 'uploads/images_program/program4.png', 1, '2024-12-17', 'program-ardan-4', 'Program Ardan 4', 'dkaokwdoak', 'damsdakw', '2024-10-22 08:01:58', '2024-12-17 07:48:32'),
(5, 'Program Ardan 5', 'Sagittis himenaeos platea pretium vulputate orci volutpat adipiscing mollis. Porta blandit urna eget', '<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Massa turpis et convallis commodo donec libero, vestibulum malesuada. Enim vehicula ridiculus sociosqu semper facilisis leo cubilia lacus! Risus massa ligula placerat mollis condimentum curae.</p>', '19:00:00', '21:00:00', 'uploads/images_program/program5.png', 1, '2024-12-17', 'program-ardan-5', 'Program Ardan 5', 'alwalwd', 'dkawka', '2024-10-22 08:02:36', '2024-12-17 07:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-12-17 11:18:00', '2024-12-17 11:18:00'),
(2, 'superAdmin', 'web', '2024-12-17 11:18:01', '2024-12-17 13:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 1),
(2, 2),
(3, 2),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `program_id`, `jam_mulai`, `jam_selesai`, `hari`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 5, '19:00:00', '21:00:00', 'senin', 'www', '2024-10-25 12:02:09', '2024-11-27 09:53:00'),
(2, 3, '10:00:00', '13:00:00', 'jumat', 'f', '2024-10-25 12:11:16', '2024-11-27 09:55:42'),
(3, 2, '08:00:00', '10:00:00', 'jumat', 'a', '2024-12-13 00:41:15', '2024-12-13 00:41:15');

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
('Vb2QymEcFnK4h4RiwrpHcCFo865I3riS3vikJ2AG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiaktqUWhWZmc1Vlc2NUQzY0VCclRxRHVHMzVmTkN4aVhwNkp4SUNTTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGkvbmV4dC1wcm9ncmFtLWltYWdlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRWRmt5YTJTV05EckZ3RktHQTJSbEUueVBRaERHbXguZWRDdVo2ajNqMmNPWjBJOGNTd05jdSI7fQ==', 1734850152);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_title', 'ARDAN 105.9 FM BANDUNG', '2024-12-06 06:59:58', '2024-12-07 07:16:45'),
(2, 'site_description', 'The best Number 1 Youth Radio Station in Bandung. Stay Cool and Lovely', '2024-12-06 06:59:58', '2024-12-07 07:17:44'),
(3, 'site_logo', 'logo/logoArdan.png', '2024-12-06 06:59:58', '2024-12-07 07:18:50'),
(4, 'site_keyword', 'Ardan Radio, Radio Hits Bandung, Ardan, Lokal Bandung, Radio Bandung', '2024-12-06 13:00:06', '2024-12-07 07:19:07'),
(5, 'site_icon', 'icon/favicon_Ardan.png', '2024-12-07 07:11:37', '2024-12-07 09:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `platform_name` varchar(255) NOT NULL,
  `link_platform` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `platform_name`, `link_platform`, `created_at`, `updated_at`) VALUES
(1, 'Instagram', 'akdjaihewqbdia', '2024-11-01 11:28:55', '2024-11-01 11:28:55'),
(2, 'Twitter', 'adjawndioahdi', '2024-11-01 11:29:11', '2024-11-01 11:29:11'),
(3, 'Youtube', 'iahdihawidaidwpo', '2024-11-01 11:29:26', '2024-11-01 11:29:26'),
(4, 'Facebook', 'dahduiahdw', '2024-11-01 11:29:40', '2024-11-01 11:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `streamings`
--

CREATE TABLE `streamings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_url` varchar(255) NOT NULL,
  `stream_url` varchar(255) NOT NULL,
  `image_stream` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `streamings`
--

INSERT INTO `streamings` (`id`, `type_url`, `stream_url`, `image_stream`, `created_at`, `updated_at`) VALUES
(1, 'Audio', 'https://stream.rcs.revma.com/ugpyzu9n5k3vv', 'uploads/images_stream/info.png', '2024-10-30 04:01:21', '2024-12-16 07:59:40'),
(2, 'Video', 'https://live.ardangroup.fm/memfs/1b1d14c7-4945-46b6-839d-00eb3d5a5e17.m3u8', 'uploads/images_stream/Rectangle 1.png', '2024-11-12 11:52:57', '2024-12-20 11:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'WebRadioArdan', 'admin321@gmail.com', NULL, '$2y$12$VFkya2SWNDrFwFKGA2RlE.yPQhDGmx.edCuZ6j3j2cOZ0I8cSwNcu', NULL, '2024-10-22 04:22:54', '2024-10-22 04:22:54'),
(3, 'Admin', 'ardan123@example.com', '2024-12-17 11:18:00', '$2y$12$DbM1AIdqXKLedKzM84Igjej5l6P7B5L.qGAF6JbV0VwBn9dimfnJ.', 'vOxzgFCLbIdLpiMbrxMiyiceNrdPk7shzfhilkMhGguyTgdM7w9Z8MmHQ13H', '2024-12-17 11:18:00', '2024-12-17 14:03:16');

-- --------------------------------------------------------

--
-- Table structure for table `youtubes`
--

CREATE TABLE `youtubes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link_youtube` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama_playlist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `youtubes`
--

INSERT INTO `youtubes` (`id`, `link_youtube`, `created_at`, `updated_at`, `nama_playlist`) VALUES
(1, 'PLWB1T6z4qsVdtre5f9vbpkSobkTnPjOe3', '2024-10-25 06:23:44', '2024-10-30 12:56:39', 'Konci'),
(2, 'PLWB1T6z4qsVfNlAujxaMdj15rL_uGXIRJ', '2024-10-30 09:30:56', '2024-10-30 09:30:56', 'A!utomotive Podcast'),
(3, 'PLWB1T6z4qsVfjDHxspyrf-Io2piuNpn5P', '2024-10-30 12:48:44', '2024-10-30 12:48:44', 'LDR BEAUTY');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcers`
--
ALTER TABLE `announcers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_links`
--
ALTER TABLE `app_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artis`
--
ALTER TABLE `artis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_infos`
--
ALTER TABLE `banner_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_podcasts`
--
ALTER TABLE `banner_podcasts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_youtubes`
--
ALTER TABLE `banner_youtubes`
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
-- Indexes for table `charts`
--
ALTER TABLE `charts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `charts_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `configs_key_unique` (`key`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copy_rights`
--
ALTER TABLE `copy_rights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `episodes_podcast_id_foreign` (`podcast_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feed_instagrams`
--
ALTER TABLE `feed_instagrams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `infos_slug_unique` (`slug`),
  ADD KEY `infos_kategori_id_foreign` (`kategori_id`);

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
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_infos`
--
ALTER TABLE `kategori_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `podcasts`
--
ALTER TABLE `podcasts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `podcasts_slug_unique` (`slug`),
  ADD KEY `podcasts_podcast_id_foreign` (`podcast_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_program_id_foreign` (`program_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `streamings`
--
ALTER TABLE `streamings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `youtubes`
--
ALTER TABLE `youtubes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcers`
--
ALTER TABLE `announcers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `app_links`
--
ALTER TABLE `app_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `artis`
--
ALTER TABLE `artis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banner_infos`
--
ALTER TABLE `banner_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner_podcasts`
--
ALTER TABLE `banner_podcasts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner_youtubes`
--
ALTER TABLE `banner_youtubes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `charts`
--
ALTER TABLE `charts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `copy_rights`
--
ALTER TABLE `copy_rights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feed_instagrams`
--
ALTER TABLE `feed_instagrams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_infos`
--
ALTER TABLE `kategori_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `podcasts`
--
ALTER TABLE `podcasts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `streamings`
--
ALTER TABLE `streamings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `youtubes`
--
ALTER TABLE `youtubes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `charts`
--
ALTER TABLE `charts`
  ADD CONSTRAINT `charts_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_podcast_id_foreign` FOREIGN KEY (`podcast_id`) REFERENCES `podcasts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `infos`
--
ALTER TABLE `infos`
  ADD CONSTRAINT `infos_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_infos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `podcasts`
--
ALTER TABLE `podcasts`
  ADD CONSTRAINT `podcasts_podcast_id_foreign` FOREIGN KEY (`podcast_id`) REFERENCES `podcasts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
