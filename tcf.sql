-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2022 at 04:26 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcf`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `ID` int(11) NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`ID`, `project_id`, `date`, `views`, `active`) VALUES
(12, 0, '2022-03-27 15:24:03', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blog_detail`
--

CREATE TABLE `blog_detail` (
  `ID` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `descr` varchar(200) NOT NULL,
  `title` varchar(64) NOT NULL,
  `body` text NOT NULL,
  `lang` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_detail`
--

INSERT INTO `blog_detail` (`ID`, `blog_id`, `descr`, `title`, `body`, `lang`) VALUES
(1, 12, 'SEO Description - en', 'Title - en', 'Description - en', 'en'),
(2, 12, 'SEO Description - de', 'Title - de', 'Description - de', 'de'),
(3, 12, 'SEO Description - fa', 'Title - fa', 'Description - fa', 'fa'),
(4, 12, 'SEO Description - ar', 'Title - ar', 'Description - ar', 'ar'),
(5, 12, 'SEO Description - ku', 'Title - ku', 'Description - ku', 'ku');

-- --------------------------------------------------------

--
-- Table structure for table `blog_gallery`
--

CREATE TABLE `blog_gallery` (
  `ID` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `photo` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_gallery_detail`
--

CREATE TABLE `blog_gallery_detail` (
  `ID` int(11) NOT NULL,
  `blog_gallery_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `lang` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `ID` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_post_detail`
--

CREATE TABLE `blog_post_detail` (
  `ID` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `body` text NOT NULL,
  `lang` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_video`
--

CREATE TABLE `blog_video` (
  `ID` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blog_video_detail`
--

CREATE TABLE `blog_video_detail` (
  `ID` int(11) NOT NULL,
  `blog_video_id` int(11) NOT NULL,
  `video` varchar(4096) NOT NULL,
  `title` varchar(256) NOT NULL,
  `lang` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `ID` int(11) NOT NULL,
  `link` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`ID`, `link`) VALUES
(1, '#'),
(2, '#'),
(3, '#'),
(4, '#');

-- --------------------------------------------------------

--
-- Table structure for table `link_detail`
--

CREATE TABLE `link_detail` (
  `ID` int(11) NOT NULL,
  `link_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `lang` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `link_detail`
--

INSERT INTO `link_detail` (`ID`, `link_id`, `title`, `lang`) VALUES
(1, 1, 'link address text', 'en'),
(2, 1, 'link address text', 'de'),
(3, 1, 'link address text', 'fa'),
(4, 1, 'link address text', 'ar'),
(5, 1, 'link address text', 'ku'),
(6, 2, 'link address text', 'en'),
(7, 2, 'link address text', 'de'),
(8, 2, 'link address text', 'fa'),
(9, 2, 'link address text', 'ar'),
(10, 2, 'link address text', 'ku'),
(11, 3, 'link address text', 'en'),
(12, 3, 'link address text', 'de'),
(13, 3, 'link address text', 'fa'),
(14, 3, 'link address text', 'ar'),
(15, 3, 'link address text', 'ku'),
(16, 4, 'link address text', 'en'),
(17, 4, 'link address text', 'de'),
(18, 4, 'link address text', 'fa'),
(19, 4, 'link address text', 'ar'),
(20, 4, 'link address text', 'ku');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `ID` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `link` varchar(512) NOT NULL DEFAULT '#',
  `avatar` varchar(1024) NOT NULL DEFAULT 'content/avatar/default.jpg',
  `active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`ID`, `email`, `link`, `avatar`, `active`) VALUES
(1, 'agrinpc@gmail.com', 'https://ulticr.com/', 'content/avatar/m-1-1400121917326.jpg', 1),
(4, 'member@tcf.org', '#', 'content/avatar/default.jpg', 1),
(6, 'member@tcf.org', '#', 'content/avatar/default.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `member_detail`
--

CREATE TABLE `member_detail` (
  `ID` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `post` varchar(64) NOT NULL,
  `info` text NOT NULL,
  `lang` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member_detail`
--

INSERT INTO `member_detail` (`ID`, `member_id`, `first_name`, `last_name`, `post`, `info`, `lang`) VALUES
(1, 1, 'Milad', 'Ahmadi', 'Programmer And Designer', 'Maybe someday', 'en'),
(4, 4, 'Arman', 'Torkzaban', 'Manager', 'some text in English', 'en'),
(5, 4, 'First', 'Last - de', 'Member - de', 'No text yet... - de', 'de'),
(6, 4, 'First', 'Last - fa', 'Member - fa', 'No text yet... - fa', 'fa'),
(7, 4, 'First', 'Last - ar', 'Member - ar', 'No text yet... - ar', 'ar'),
(8, 4, 'First', 'Last - ku', 'Member - ku', 'No text yet... - ku', 'ku'),
(14, 6, 'First', 'Last - en', 'Member - en', 'No text yet... - en', 'en'),
(15, 6, 'First', 'Last - de', 'Member - de', 'No text yet... - de', 'de'),
(16, 6, 'First', 'Last - fa', 'Member - fa', 'No text yet... - fa', 'fa'),
(17, 6, 'First', 'Last - ar', 'Member - ar', 'No text yet... - ar', 'ar'),
(18, 6, 'First', 'Last - ku', 'Member - ku', 'No text yet... - ku', 'ku');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ID` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ID`, `views`, `active`) VALUES
(7, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_detail`
--

CREATE TABLE `project_detail` (
  `ID` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `body` text NOT NULL,
  `descr` varchar(170) NOT NULL,
  `lang` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_detail`
--

INSERT INTO `project_detail` (`ID`, `project_id`, `title`, `body`, `descr`, `lang`) VALUES
(26, 7, 'Title - en', '<p><span style=\"color: rgb(33, 37, 41);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas purus viverra accumsan in nisl nisi. Arcu cursus vitae congue mauris rhoncus aenean vel elit scelerisque. In egestas erat imperdiet sed euismod nisi porta lorem mollis. Morbi tristique senectus et netus. Mattis pellentesque id nibh tortor id aliquet lectus proin. Sapien faucibus et molestie ac feugiat sed lectus vestibulum. Ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget. Dictum varius duis at consectetur lorem. Nisi vitae suscipit tellus mauris a diam maecenas sed enim. Velit ut tortor pretium viverra suspendisse potenti nullam. Et molestie ac feugiat sed lectus. Non nisi est sit amet facilisis magna. Dignissim diam quis enim lobortis scelerisque fermentum. Odio ut enim blandit volutpat maecenas volutpat. Ornare lectus sit amet est placerat in egestas erat. Nisi vitae suscipit tellus mauris a diam maecenas sed. Placerat duis ultricies lacus sed turpis tincidunt id aliquet.</span></p>', 'SEO Description - en', 'en'),
(27, 7, 'Title - de', 'Description - de', 'SEO Description - de', 'de'),
(28, 7, 'Title - fa', 'Description - fa', 'SEO Description - fa', 'fa'),
(29, 7, 'Title - ar', 'Description - ar', 'SEO Description - ar', 'ar'),
(30, 7, 'Title - ku', 'Description - ku', 'SEO Description - ku', 'ku');

-- --------------------------------------------------------

--
-- Table structure for table `project_gallery`
--

CREATE TABLE `project_gallery` (
  `ID` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `photo` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_gallery`
--

INSERT INTO `project_gallery` (`ID`, `project_id`, `photo`) VALUES
(10, 7, 'content/projects/temp.jpg'),
(11, 7, 'content/projects/temp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `project_gallery_detail`
--

CREATE TABLE `project_gallery_detail` (
  `ID` int(11) NOT NULL,
  `project_gallery_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `lang` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_gallery_detail`
--

INSERT INTO `project_gallery_detail` (`ID`, `project_gallery_id`, `title`, `lang`) VALUES
(46, 10, 'Project Photo Title - en', 'en'),
(47, 10, 'Project Photo Title - de', 'de'),
(48, 10, 'Project Photo Title - fa', 'fa'),
(49, 10, 'Project Photo Title - ar', 'ar'),
(50, 10, 'Project Photo Title - ku', 'ku'),
(51, 11, 'Project Photo Title - en', 'en'),
(52, 11, 'Project Photo Title - de', 'de'),
(53, 11, 'Project Photo Title - fa', 'fa'),
(54, 11, 'Project Photo Title - ar', 'ar'),
(55, 11, 'Project Photo Title - ku', 'ku');

-- --------------------------------------------------------

--
-- Table structure for table `project_video`
--

CREATE TABLE `project_video` (
  `ID` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_video`
--

INSERT INTO `project_video` (`ID`, `project_id`, `views`) VALUES
(1, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_video_detail`
--

CREATE TABLE `project_video_detail` (
  `ID` int(11) NOT NULL,
  `project_video_id` int(11) NOT NULL,
  `video` varchar(4096) NOT NULL,
  `title` varchar(256) NOT NULL,
  `lang` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_video_detail`
--

INSERT INTO `project_video_detail` (`ID`, `project_video_id`, `video`, `title`, `lang`) VALUES
(1, 1, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/1tj7Y3PR16s\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 'Video Title - en', 'en'),
(2, 1, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/1tj7Y3PR16s\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 'Video Title - de', 'de'),
(3, 1, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/1tj7Y3PR16s\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 'Video Title - fa', 'fa'),
(4, 1, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/1tj7Y3PR16s\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 'Video Title - ar', 'ar'),
(5, 1, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/1tj7Y3PR16s\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 'Video Title - ku', 'ku');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `ID` int(11) NOT NULL,
  `key_name` varchar(32) NOT NULL,
  `value` text NOT NULL,
  `lang` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`ID`, `key_name`, `value`, `lang`) VALUES
(1, 'title', 'TransCF - en', 'en'),
(2, 'about', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed cras ornare arcu dui. Magna fermentum iaculis eu non diam phasellus vestibulum lorem sed. Id consectetur purus ut faucibus pulvinar. Euismod lacinia at quis risus sed vulputate odio ut. Potenti nullam ac tortor vitae purus faucibus ornare suspendisse sed. Nunc sed id semper risus. Sociis natoque penatibus et magnis dis parturient. Risus nec feugiat in fermentum posuere urna nec. Feugiat vivamus at augue eget. Enim eu turpis egestas pretium aenean pharetra magna ac placerat. en</p>', 'en'),
(3, 'title', 'TransCF', 'fa'),
(4, 'title', 'TransCF', 'de'),
(5, 'title', 'TransCF', 'ku'),
(6, 'title', 'TransCF', 'ar'),
(7, 'about', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed cras ornare arcu dui. Magna fermentum iaculis eu non diam phasellus vestibulum lorem sed. Id consectetur purus ut faucibus pulvinar. Euismod lacinia at quis risus sed vulputate odio ut. Potenti nullam ac tortor vitae purus faucibus ornare suspendisse sed. Nunc sed id semper risus. Sociis natoque penatibus et magnis dis parturient. Risus nec feugiat in fermentum posuere urna nec. Feugiat vivamus at augue eget. Enim eu turpis egestas pretium aenean pharetra magna ac placerat.', 'fa'),
(8, 'about', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed cras ornare arcu dui. Magna fermentum iaculis eu non diam phasellus vestibulum lorem sed. Id consectetur purus ut faucibus pulvinar. Euismod lacinia at quis risus sed vulputate odio ut. Potenti nullam ac tortor vitae purus faucibus ornare suspendisse sed. Nunc sed id semper risus. Sociis natoque penatibus et magnis dis parturient. Risus nec feugiat in fermentum posuere urna nec. Feugiat vivamus at augue eget. Enim eu turpis egestas pretium aenean pharetra magna ac placerat.', 'de'),
(9, 'about', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed cras ornare arcu dui. Magna fermentum iaculis eu non diam phasellus vestibulum lorem sed. Id consectetur purus ut faucibus pulvinar. Euismod lacinia at quis risus sed vulputate odio ut. Potenti nullam ac tortor vitae purus faucibus ornare suspendisse sed. Nunc sed id semper risus. Sociis natoque penatibus et magnis dis parturient. Risus nec feugiat in fermentum posuere urna nec. Feugiat vivamus at augue eget. Enim eu turpis egestas pretium aenean pharetra magna ac placerat.', 'ku'),
(10, 'about', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed cras ornare arcu dui. Magna fermentum iaculis eu non diam phasellus vestibulum lorem sed. Id consectetur purus ut faucibus pulvinar. Euismod lacinia at quis risus sed vulputate odio ut. Potenti nullam ac tortor vitae purus faucibus ornare suspendisse sed. Nunc sed id semper risus. Sociis natoque penatibus et magnis dis parturient. Risus nec feugiat in fermentum posuere urna nec. Feugiat vivamus at augue eget. Enim eu turpis egestas pretium aenean pharetra magna ac placerat.', 'ar'),
(11, 'header', 'Welcome - en', 'en'),
(12, 'header', 'Welcome - fa', 'fa'),
(13, 'header', 'Welcome', 'ku'),
(14, 'header', 'Welcome', 'de'),
(15, 'header', 'Welcome', 'ar'),
(16, 'descr', '<p>Transnational Community Federation e.V. works on social innovation and change. With our interdisciplinary approach and belief in the power of minorities we bring about positive change in our communities around the world. We are active in the field of promotion of education, the democratic state, and refugees protection and empowerment. en</p>', 'en'),
(17, 'descr', 'Transnational Community Federation e.V. works on social innovation and change. With our interdisciplinary approach and belief in the power of minorities we bring about positive change in our communities around the world. We are active in the field of promotion of education, the democratic state, and refugees protection and empowerment.', 'fa'),
(18, 'descr', 'Transnational Community Federation e.V. works on social innovation and change. With our interdisciplinary approach and belief in the power of minorities we bring about positive change in our communities around the world. We are active in the field of promotion of education, the democratic state, and refugees protection and empowerment.', 'ku'),
(19, 'descr', 'Transnational Community Federation e.V. works on social innovation and change. With our interdisciplinary approach and belief in the power of minorities we bring about positive change in our communities around the world. We are active in the field of promotion of education, the democratic state, and refugees protection and empowerment.', 'de'),
(20, 'descr', 'Transnational Community Federation e.V. works on social innovation and change. With our interdisciplinary approach and belief in the power of minorities we bring about positive change in our communities around the world. We are active in the field of promotion of education, the democratic state, and refugees protection and empowerment.', 'ar'),
(21, 'address', 'Company address - en', 'en'),
(22, 'address', 'Company address', 'de'),
(23, 'address', 'Company address', 'fa'),
(24, 'address', 'Company address', 'ku'),
(25, 'address', 'Company address', 'ar'),
(26, 'email', 'info@tcf.org', 'all'),
(31, 'phone', '+123456780', 'all'),
(32, 'about_us', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed cras ornare arcu dui. Magna fermentum iaculis eu non diam phasellus vestibulum lorem sed. Id consectetur purus ut faucibus pulvinar. Euismod lacinia at quis risus sed vulputate odio ut. Potenti nullam ac tortor vitae purus faucibus ornare suspendisse sed. Nunc sed id semper risus. Sociis natoque penatibus et magnis dis parturient. Risus nec feugiat in fermentum posuere urna nec. Feugiat vivamus at augue eget. Enim eu turpis egestas pretium aenean pharetra magna ac placerat. en</p>', 'en'),
(33, 'about_us', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed cras ornare arcu dui. Magna fermentum iaculis eu non diam phasellus vestibulum lorem sed. Id consectetur purus ut faucibus pulvinar. Euismod lacinia at quis risus sed vulputate odio ut. Potenti nullam ac tortor vitae purus faucibus ornare suspendisse sed. Nunc sed id semper risus. Sociis natoque penatibus et magnis dis parturient. Risus nec feugiat in fermentum posuere urna nec. Feugiat vivamus at augue eget. Enim eu turpis egestas pretium aenean pharetra magna ac placerat.', 'fa'),
(34, 'about_us', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed cras ornare arcu dui. Magna fermentum iaculis eu non diam phasellus vestibulum lorem sed. Id consectetur purus ut faucibus pulvinar. Euismod lacinia at quis risus sed vulputate odio ut. Potenti nullam ac tortor vitae purus faucibus ornare suspendisse sed. Nunc sed id semper risus. Sociis natoque penatibus et magnis dis parturient. Risus nec feugiat in fermentum posuere urna nec. Feugiat vivamus at augue eget. Enim eu turpis egestas pretium aenean pharetra magna ac placerat.', 'de'),
(35, 'about_us', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed cras ornare arcu dui. Magna fermentum iaculis eu non diam phasellus vestibulum lorem sed. Id consectetur purus ut faucibus pulvinar. Euismod lacinia at quis risus sed vulputate odio ut. Potenti nullam ac tortor vitae purus faucibus ornare suspendisse sed. Nunc sed id semper risus. Sociis natoque penatibus et magnis dis parturient. Risus nec feugiat in fermentum posuere urna nec. Feugiat vivamus at augue eget. Enim eu turpis egestas pretium aenean pharetra magna ac placerat.', 'ku'),
(36, 'about_us', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed cras ornare arcu dui. Magna fermentum iaculis eu non diam phasellus vestibulum lorem sed. Id consectetur purus ut faucibus pulvinar. Euismod lacinia at quis risus sed vulputate odio ut. Potenti nullam ac tortor vitae purus faucibus ornare suspendisse sed. Nunc sed id semper risus. Sociis natoque penatibus et magnis dis parturient. Risus nec feugiat in fermentum posuere urna nec. Feugiat vivamus at augue eget. Enim eu turpis egestas pretium aenean pharetra magna ac placerat.', 'ar');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `pwd` varchar(128) NOT NULL,
  `role` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `member_id`, `user_name`, `pwd`, `role`) VALUES
(1, 1, 'tcf', '$2y$10$HzrL8Pis1bkZplXjImzGnOxV0UCn7MU6m8n0aKxOujskKyhHvgU3O', 'admn');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blog_detail`
--
ALTER TABLE `blog_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `blog_gallery`
--
ALTER TABLE `blog_gallery`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `project_id` (`blog_id`);

--
-- Indexes for table `blog_gallery_detail`
--
ALTER TABLE `blog_gallery_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `project_photo_id` (`blog_gallery_id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `blog_post_detail`
--
ALTER TABLE `blog_post_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `blog_video`
--
ALTER TABLE `blog_video`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `project_id` (`blog_id`);

--
-- Indexes for table `blog_video_detail`
--
ALTER TABLE `blog_video_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `project_video_id` (`blog_video_id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `link_detail`
--
ALTER TABLE `link_detail`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `member_detail`
--
ALTER TABLE `member_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `project_detail`
--
ALTER TABLE `project_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `project_gallery`
--
ALTER TABLE `project_gallery`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `project_gallery_detail`
--
ALTER TABLE `project_gallery_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `project_photo_id` (`project_gallery_id`);

--
-- Indexes for table `project_video`
--
ALTER TABLE `project_video`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `project_video_detail`
--
ALTER TABLE `project_video_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `project_video_id` (`project_video_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `member_id` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `blog_detail`
--
ALTER TABLE `blog_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blog_gallery`
--
ALTER TABLE `blog_gallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_gallery_detail`
--
ALTER TABLE `blog_gallery_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_post_detail`
--
ALTER TABLE `blog_post_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_video`
--
ALTER TABLE `blog_video`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_video_detail`
--
ALTER TABLE `blog_video_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `link_detail`
--
ALTER TABLE `link_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `member_detail`
--
ALTER TABLE `member_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `project_detail`
--
ALTER TABLE `project_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `project_gallery`
--
ALTER TABLE `project_gallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `project_gallery_detail`
--
ALTER TABLE `project_gallery_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `project_video`
--
ALTER TABLE `project_video`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_video_detail`
--
ALTER TABLE `project_video_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_detail`
--
ALTER TABLE `blog_detail`
  ADD CONSTRAINT `blog_detail_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog_gallery`
--
ALTER TABLE `blog_gallery`
  ADD CONSTRAINT `blog_gallery_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog_gallery_detail`
--
ALTER TABLE `blog_gallery_detail`
  ADD CONSTRAINT `blog_gallery_detail_ibfk_1` FOREIGN KEY (`blog_gallery_id`) REFERENCES `blog_gallery` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog_post_detail`
--
ALTER TABLE `blog_post_detail`
  ADD CONSTRAINT `blog_post_detail_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog_posts` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member_detail`
--
ALTER TABLE `member_detail`
  ADD CONSTRAINT `member_detail_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_detail`
--
ALTER TABLE `project_detail`
  ADD CONSTRAINT `project_detail_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_gallery`
--
ALTER TABLE `project_gallery`
  ADD CONSTRAINT `project_gallery_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_gallery_detail`
--
ALTER TABLE `project_gallery_detail`
  ADD CONSTRAINT `project_gallery_detail_ibfk_1` FOREIGN KEY (`project_gallery_id`) REFERENCES `project_gallery` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_video`
--
ALTER TABLE `project_video`
  ADD CONSTRAINT `project_video_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_video_detail`
--
ALTER TABLE `project_video_detail`
  ADD CONSTRAINT `project_video_detail_ibfk_1` FOREIGN KEY (`project_video_id`) REFERENCES `project_video` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
