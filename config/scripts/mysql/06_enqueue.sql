CREATE TABLE `enqueue` (
  `id` char(36) COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `published_at` bigint NOT NULL,
  `body` longtext COLLATE utf8mb3_unicode_ci,
  `headers` longtext COLLATE utf8mb3_unicode_ci,
  `properties` longtext COLLATE utf8mb3_unicode_ci,
  `redelivered` tinyint(1) DEFAULT NULL,
  `queue` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `priority` smallint DEFAULT NULL,
  `delayed_until` bigint DEFAULT NULL,
  `time_to_live` bigint DEFAULT NULL,
  `delivery_id` char(36) COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `redeliver_after` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

ALTER TABLE `enqueue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CFC35A6862A6DC27E0D4FDE17FFD7F63121369211A065DF8BF396750` (`priority`,`published_at`,`queue`,`delivery_id`,`delayed_until`,`id`),
  ADD KEY `IDX_CFC35A68AA0BDFF712136921` (`redeliver_after`,`delivery_id`),
  ADD KEY `IDX_CFC35A68E0669C0612136921` (`time_to_live`,`delivery_id`),
  ADD KEY `IDX_CFC35A6812136921` (`delivery_id`);
