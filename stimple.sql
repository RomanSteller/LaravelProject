-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.23 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных stimpleproject
CREATE DATABASE IF NOT EXISTS `stimpleproject` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `stimpleproject`;

-- Дамп структуры для таблица stimpleproject.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Находится на модерации',
  `views_count` int(11) DEFAULT '0',
  `save_count` int(11) DEFAULT '0',
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы stimpleproject.articles: 15 rows
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
REPLACE INTO `articles` (`id`, `user_id`, `name`, `status`, `views_count`, `save_count`, `content`, `photo`, `created_at`, `updated_at`) VALUES
	(28, 1, 'Тестовый пост', 'Одобрено модерацией', 0, 299, '<img src ="/storage/content-img.jpg">', 'null', '2021-06-18 19:54:17', '2021-06-18 19:54:26'),
	(29, 1, 'Тестовый пост', 'Одобрено модерацией', 0, 188, '<img src ="/storage/content-img.jpg">', 'null', '2021-06-18 19:54:17', '2021-06-18 19:54:26'),
	(30, 1, 'Тестовый пост', 'Одобрено модерацией', 0, 89, '<img src ="/storage/content-img.jpg">', 'null', '2021-06-18 19:54:17', '2021-06-18 19:54:26'),
	(31, 1, 'Тестовый пост', 'Одобрено модерацией', 1, 952, '<img src ="/storage/content-img.jpg">', 'null', '2021-06-18 19:54:18', '2021-06-18 20:55:43'),
	(32, 1, 'Тестовый пост', 'Одобрено модерацией', 6, 950, '<img src ="/storage/content-img.jpg">', 'null', '2021-06-18 19:54:20', '2021-06-21 02:49:35'),
	(33, 1, 'Тестовый пост', 'Одобрено модерацией', 0, 61, '<img src ="/storage/content-img.jpg">', 'null', '2021-06-18 19:54:18', '2021-06-18 19:54:24'),
	(34, 1, 'Тестовый пост', 'Одобрено модерацией', 0, 59, '<img src ="/storage/content-img.jpg">', 'null', '2021-06-18 19:54:19', '2021-06-20 19:37:59'),
	(35, 1, 'Тестовый пост', 'Одобрено модерацией', 2, 718, '<img src ="/storage/content-img.jpg">', 'null', '2021-06-18 19:54:19', '2021-06-20 19:38:06'),
	(36, 1, 'Тестовый пост', 'Одобрено модерацией', 1, 311, '<img src ="/storage/content-img.jpg">', 'null', '2021-06-18 19:54:20', '2021-06-21 02:49:06'),
	(70, 1, 'dsadsdadsa', 'Пост отклонён', 0, 0, '<p>sdaasdasdsadsdadas</p>', NULL, '2021-06-19 00:22:34', '2021-06-20 14:05:33'),
	(71, 1, 'dfdfsdsf', 'Пост отклонён', 0, 0, '<p>dsfsdffds</p>', NULL, '2021-06-19 16:00:32', '2021-06-20 14:05:31'),
	(72, 1, 'fsfdsdf', 'Пост отклонён', 0, 0, '', NULL, '2021-06-20 03:20:04', '2021-06-20 14:05:29'),
	(73, 1, NULL, 'Пост отклонён', 0, 0, '', NULL, '2021-06-20 16:57:47', '2021-06-20 14:05:26'),
	(76, 1, 'dasddsasdadsa', 'Находится на модерации', 0, 0, '<p>dsasdadsaasddsadsads</p>', NULL, '2021-06-21 02:40:30', '2021-06-21 02:40:30'),
	(78, 1, 'successPost', 'Находится на модерации', 0, 0, '<p>successPostsuccessPostsuccessPostsuccessPost</p><img src="/storage/articles_content/1624232699_ford-mustang.jpg" alt="">', NULL, '2021-06-21 02:44:59', '2021-06-21 02:45:05');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- Дамп структуры для таблица stimpleproject.articles_tags
CREATE TABLE IF NOT EXISTS `articles_tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы stimpleproject.articles_tags: 4 rows
/*!40000 ALTER TABLE `articles_tags` DISABLE KEYS */;
REPLACE INTO `articles_tags` (`id`, `article_id`, `tag_id`) VALUES
	(39, 78, 4),
	(38, 78, 3),
	(37, 78, 2),
	(36, 78, 1);
/*!40000 ALTER TABLE `articles_tags` ENABLE KEYS */;

-- Дамп структуры для таблица stimpleproject.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `comments` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_article_id_foreign` (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы stimpleproject.comments: 2 rows
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Дамп структуры для таблица stimpleproject.favorites
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы stimpleproject.favorites: 3 rows
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
REPLACE INTO `favorites` (`id`, `user_id`, `article_id`, `created_at`, `updated_at`) VALUES
	(30, 1, 35, '2021-06-20 19:38:00', '2021-06-20 19:38:00'),
	(29, 1, 34, '2021-06-20 19:37:59', '2021-06-20 19:37:59'),
	(28, 1, 36, '2021-06-20 19:37:58', '2021-06-20 19:37:58');
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;

-- Дамп структуры для таблица stimpleproject.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы stimpleproject.migrations: 10 rows
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2021_06_02_142523_create_articles_table', 1),
	(3, '2021_06_02_144622_create_tags_table', 1),
	(4, '2021_06_05_203602_create_article_images_table', 1),
	(5, '2021_06_07_155809_create_articles_tags_table', 1),
	(6, '2021_06_07_201052_create_comments_table', 1),
	(7, '2021_06_08_133747_update_articles_table', 1),
	(8, '2021_06_08_234032_update_users_table', 1),
	(9, '2021_06_10_154452_create_favorites_table', 2),
	(10, '2021_06_21_004105_update_comments_table', 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Дамп структуры для таблица stimpleproject.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы stimpleproject.tags: 8 rows
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
REPLACE INTO `tags` (`id`, `tag_name`, `created_at`, `updated_at`) VALUES
	(1, '1С', '2021-06-18 20:52:30', '2021-06-18 20:52:31'),
	(2, 'Laravel', '2021-06-18 20:52:39', '2021-06-18 20:52:40'),
	(3, 'Космос', '2021-06-18 20:52:52', '2021-06-18 20:52:53'),
	(4, 'Видеокарты', '2021-06-18 20:52:58', '2021-06-18 20:52:59'),
	(5, 'Технологии', '2021-06-18 20:53:06', '2021-06-18 20:53:07'),
	(6, 'Игры', '2021-06-18 20:53:12', '2021-06-18 20:53:12'),
	(7, 'Гейм-разработка', '2021-06-18 20:53:21', '2021-06-18 20:53:22'),
	(8, 'Игрушки', '2021-06-20 03:56:44', '2021-06-20 03:56:45');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;

-- Дамп структуры для таблица stimpleproject.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_login_unique` (`login`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы stimpleproject.users: 1 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `login`, `password`, `email`, `role`, `description`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Катин Роман Вадимович', 'rkatin', '$2y$10$09PUnWxIRjuYuNQZMWXP4uv3/snc6JGdHjwAgZBso7bVKdr7zy2wW', 'rkatin2002@mail.ru', 'admin', 'Программист.', 'user/default.png', NULL, '2021-06-10 19:36:51', '2021-06-18 17:24:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
