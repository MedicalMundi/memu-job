CREATE TABLE `ecotone_deduplication` (
  `message_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `consumer_endpoint_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `routing_slip` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `handled_at` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


ALTER TABLE `ecotone_deduplication`
  ADD PRIMARY KEY (`message_id`,`consumer_endpoint_id`,`routing_slip`),
  ADD KEY `IDX_4FEBE3E36F4B26C` (`handled_at`);
