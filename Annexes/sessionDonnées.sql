-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage des données de la table symfonysessions.category : ~0 rows (environ)
INSERT INTO `category` (`id`, `name`) VALUES
	(1, 'Informatique'),
	(2, 'Bureatique'),
	(3, 'Vente'),
	(4, 'Mode');

-- Listage des données de la table symfonysessions.doctrine_migration_versions : ~0 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20230412073441', '2023-04-14 06:39:04', 80);

-- Listage des données de la table symfonysessions.messenger_messages : ~0 rows (environ)

-- Listage des données de la table symfonysessions.module : ~0 rows (environ)
INSERT INTO `module` (`id`, `category_id`, `name`) VALUES
	(1, 1, 'HTML5'),
	(2, 1, 'CSS3'),
	(3, 2, 'Word'),
	(4, 2, 'Excel'),
	(5, 1, 'PHP'),
	(6, 1, 'Javascript'),
	(7, 1, 'SQL'),
	(8, 1, 'Symfony');

-- Listage des données de la table symfonysessions.programme : ~0 rows (environ)
INSERT INTO `programme` (`id`, `session_id`, `module_id`, `length`) VALUES
	(1, 1, 3, 100),
	(2, 6, 1, 5),
	(3, 6, 3, 10),
	(12, 8, 1, 1),
	(13, 8, 2, 5),
	(14, 8, 6, 100),
	(15, 8, 5, 2000),
	(16, 8, 8, 10),
	(17, 7, 5, 5),
	(18, 1, 1, 5);

-- Listage des données de la table symfonysessions.session : ~0 rows (environ)
INSERT INTO `session` (`id`, `trainer_id`, `training_id`, `title`, `begin_date`, `end_date`, `nbr_places`) VALUES
	(1, 1, 2, 'Pipo', '2012-04-12 17:56:32', '2026-04-12 17:56:35', 42),
	(2, 2, 2, 'pipo2', '2023-04-13 00:00:00', '2023-04-14 00:00:00', 43),
	(3, 3, 1, 'pipo3', '2023-04-06 00:00:00', '2023-04-08 00:00:00', 46),
	(4, 1, 1, 'pipo3', '2023-04-08 00:00:00', '2023-04-09 00:00:00', 42),
	(5, 1, 1, 'pipo4', '2023-04-01 00:00:00', '2023-04-14 00:00:00', 85),
	(6, 1, 2, 'testt', '2023-04-13 00:00:00', '2023-04-19 00:00:00', 55),
	(7, 2, 1, 'testFlash', '2023-04-08 00:00:00', '2023-04-15 00:00:00', 2),
	(8, 2, 1, 'reTestFlash', '2023-04-15 00:00:00', '2023-04-22 00:00:00', 2);

-- Listage des données de la table symfonysessions.trainee : ~0 rows (environ)
INSERT INTO `trainee` (`id`, `first_name`, `last_name`, `ville`, `birth_date`, `email`, `tel`, `gender`) VALUES
	(1, 'Basile', 'Kuntz', 'TestVille', '1996-12-03 00:00:00', 'email.email@email.fr', '0680264451', 'Other'),
	(3, 'Alain', 'Terrieur', 'Haguenau', '2023-04-21 00:00:00', 'Alain.terrieur@test.fr', '063232', 'Male'),
	(4, 'Fred', 'Du grenier', 'Clermont-Ferrand', '2023-04-28 00:00:00', 'Jug@hkj.fr', '09', 'Male'),
	(5, 'Macron', 'Emanuel', 'Parise', '2023-04-16 00:00:00', 'macron.darkSasuke@elysee.io', '01', 'Other');

-- Listage des données de la table symfonysessions.trainee_session : ~0 rows (environ)
INSERT INTO `trainee_session` (`id`, `trainee_id`, `session_id`) VALUES
	(16, 1, 1),
	(19, 1, 3),
	(15, 3, 1),
	(18, 3, 3),
	(12, 3, 5),
	(36, 3, 7),
	(17, 4, 1),
	(25, 4, 8),
	(26, 5, 8);

-- Listage des données de la table symfonysessions.trainer : ~0 rows (environ)
INSERT INTO `trainer` (`id`, `first_name`, `last_name`) VALUES
	(1, 'Bob', 'Vance Vance Frigo'),
	(2, 'Michael', 'Scott');

-- Listage des données de la table symfonysessions.training : ~0 rows (environ)
INSERT INTO `training` (`id`, `title`) VALUES
	(1, 'Formation au développement webb'),
	(2, 'Formation en vente de papier à Scranton'),
	(5, 'test formation (AVEC SESSIONS) à suppr');

-- Listage des données de la table symfonysessions.user : ~0 rows (environ)
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`) VALUES
	(2, 'aa@aa.fr', '[]', '$2y$13$5b3yUYoW5U/U708dkW7Va.t/xrnMqS9cM.93JcR0eeSg.5RXl6DbC', 0),
	(3, 'bb@bb.fr', '[]', '$2y$13$fVZBE3vGmWHX4.xNu5cV9O.WlVYl.ZTJfa9Fmjkn7xDXL9IuqpMXC', 0),
	(4, 'cc@cc.fr', '["ROLE_ADMIN"]', '$2y$13$JnFr3cwWw.LgBj3uPJc/2OPeHbSM9F7A24iV7ZARxDsylEcEJxdDG', 1),
	(5, 'dd@dd.fr', '["ROLE_ADMIN"]', '$2y$13$nguNmU1N25cC6CCwCUvY5epeGbA/bMrfeKK2ALAMl8HKiPGWRde72', 0),
	(6, 'ee@ee.fr', '[]', '$2y$13$jOyzu3OL92eqvSZwUapPB.uOWqDaxh3zY4hC9rDVyBdp8nbtcHqyK', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
