DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `uuid`       varchar(255)        NOT NULL,
    `connection` text                NOT NULL,
    `queue`      text                NOT NULL,
    `payload`    longtext            NOT NULL,
    `exception`  longtext            NOT NULL,
    `failed_at`  timestamp           NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations`
(
    `id`        int(10) unsigned NOT NULL AUTO_INCREMENT,
    `migration` varchar(255)     NOT NULL,
    `batch`     int(11)          NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 7;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations`
    DISABLE KEYS */;
INSERT INTO `migrations`
VALUES (1, '2014_10_12_000000_create_users_table', 1),
       (2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
       (3, '2019_08_19_000000_create_failed_jobs_table', 1),
       (4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
       (5, '2023_06_24_071402_create_plans_table', 1),
       (6, '2023_06_24_071443_create_plan_chapters_table', 1);
/*!40000 ALTER TABLE `migrations`
    ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens`
(
    `email`      varchar(255) NOT NULL,
    `token`      varchar(255) NOT NULL,
    `created_at` timestamp    NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens`
(
    `id`             bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `tokenable_type` varchar(255)        NOT NULL,
    `tokenable_id`   bigint(20) unsigned NOT NULL,
    `name`           varchar(255)        NOT NULL,
    `token`          varchar(64)         NOT NULL,
    `abilities`      text                     DEFAULT NULL,
    `last_used_at`   timestamp           NULL DEFAULT NULL,
    `expires_at`     timestamp           NULL DEFAULT NULL,
    `created_at`     timestamp           NULL DEFAULT NULL,
    `updated_at`     timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
    KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`, `tokenable_id`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id`                bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name`              varchar(255)        NOT NULL,
    `email`             varchar(255)        NOT NULL,
    `email_verified_at` timestamp           NULL DEFAULT NULL,
    `password`          varchar(255)        NOT NULL,
    `remember_token`    varchar(100)             DEFAULT NULL,
    `created_at`        timestamp           NULL DEFAULT NULL,
    `updated_at`        timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `plans`;

CREATE TABLE `plans`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `topic`      varchar(255)        NOT NULL,
    `user_id`    bigint(20) unsigned NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `plans_user_id_foreign` (`user_id`),
    CONSTRAINT `plans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS `plan_chapters`;

CREATE TABLE `plan_chapters`
(
    `id`            bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `chapter`       varchar(255)        NOT NULL,
    `planned_hours` smallint(6)         NOT NULL,
    `plan_id`       bigint(20) unsigned NOT NULL,
    `start_at`      datetime                 DEFAULT NULL,
    `end_at`        datetime                 DEFAULT NULL,
    `created_at`    timestamp           NULL DEFAULT NULL,
    `updated_at`    timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `plan_chapters_plan_id_foreign` (`plan_id`),
    CONSTRAINT `plan_chapters_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`)
) ENGINE = InnoDB;
