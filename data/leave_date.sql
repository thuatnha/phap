
--
-- Table structure for table `leave_day`
--

CREATE TABLE `leave_day` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_date` timestamp NULL DEFAULT NULL,
  `to_date` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `leave_day`
--

INSERT INTO `leave_day` (`id`, `user_id`, `from_date`, `to_date`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-12-21 17:00:00', '2017-12-21 17:00:00', 'bận việc gia đình', '2017-12-22 01:48:16', '2017-12-22 01:48:16'),
(2, 1, '2017-12-22 17:00:00', '2017-12-23 17:00:00', 'Bận việc gia đình', '2017-12-22 01:50:48', '2017-12-22 01:50:48');
