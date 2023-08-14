CREATE TABLE `ecotone_error_messages` (
  `message_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` datetime NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


ALTER TABLE `ecotone_error_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `IDX_F9FBCA7B1DD19495` (`failed_at`);
