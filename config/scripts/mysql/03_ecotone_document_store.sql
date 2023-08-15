CREATE TABLE `ecotone_document_store` (
  `collection` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `document_id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `document_type` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `document` json NOT NULL,
  `updated_at` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


ALTER TABLE `ecotone_document_store` ADD PRIMARY KEY (`collection`,`document_id`);

