CREATE DATABASE `vaccine_registration_system`CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE `users` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
     `nid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
     `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
     `address` text COLLATE utf8mb4_unicode_ci,
     `created_at` timestamp NULL DEFAULT NULL,
     `updated_at` timestamp NULL DEFAULT NULL,
     PRIMARY KEY (`id`),
     UNIQUE KEY `users_nid_unique` (`nid`),
     UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `registrations` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `user_id` int(10) unsigned NOT NULL,
     `vaccine_center_id` int(10) unsigned NOT NULL,
     `is_scheduled` tinyint(1) NOT NULL DEFAULT '0',
     `created_at` timestamp NULL DEFAULT NULL,
     `updated_at` timestamp NULL DEFAULT NULL,
     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `vaccine_centers` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
   `capacity` int(10) unsigned NOT NULL,
   `created_at` timestamp NULL DEFAULT NULL,
   `updated_at` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into `vaccine_centers` (`name`, `capacity`, `created_at`, `updated_at`) values('Parshuram Hospital','2',NULL,NULL);
insert into `vaccine_centers` (`name`, `capacity`, `created_at`, `updated_at`) values('Feni Hospital','2',NULL,NULL);
insert into `vaccine_centers` (`name`, `capacity`, `created_at`, `updated_at`) values('Fulgazi Hospital','3',NULL,NULL);


CREATE TABLE `vaccine_schedules` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `registered_user_id` int(10) unsigned NOT NULL,
     `vaccine_center_id` int(10) unsigned NOT NULL,
     `schedule_date` date NOT NULL,
     `created_at` timestamp NULL DEFAULT NULL,
     `updated_at` timestamp NULL DEFAULT NULL,
     PRIMARY KEY (`id`);
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
