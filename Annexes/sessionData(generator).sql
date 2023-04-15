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
	('DoctrineMigrations\\Version20230412073441', '2023-04-15 17:43:00', 39);

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

-- Listage des données de la table symfonysessions.programme : ~12 rows (environ)
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
	(18, 1, 1, 5),
	(19, 9, 1, 5),
	(20, 9, 2, 3);

-- Listage des données de la table symfonysessions.session : ~26 rows (environ)
INSERT INTO `session` (`id`, `trainer_id`, `training_id`, `title`, `begin_date`, `end_date`, `nbr_places`) VALUES
	(1, 1, 2, 'Pipo', '2012-04-12 17:56:32', '2026-04-12 17:56:35', 42),
	(2, 2, 2, 'pipo2', '2023-04-13 00:00:00', '2023-04-14 00:00:00', 43),
	(3, 3, 1, 'pipo3', '2023-04-06 00:00:00', '2023-04-08 00:00:00', 46),
	(4, 1, 1, 'pipo3', '2023-04-08 00:00:00', '2023-04-09 00:00:00', 42),
	(5, 1, 1, 'pipo4', '2023-04-01 00:00:00', '2023-04-14 00:00:00', 85),
	(6, 1, 2, 'testt', '2023-04-13 00:00:00', '2023-04-19 00:00:00', 55),
	(7, 2, 1, 'testFlash', '2023-04-08 00:00:00', '2023-04-15 00:00:00', 2),
	(8, 2, 1, 'reTestFlash', '2023-04-15 00:00:00', '2023-04-22 00:00:00', 2),
	(12, 1, 2, 'test session a venir', '2023-04-23 00:00:00', '2023-04-30 00:00:00', 4),
	(13, 17, 6, 'tincidunt lacus at velit vivamus vel nulla eget eros elementum', '2023-05-02 09:08:01', '2023-07-19 20:50:29', 7),
	(14, 37, 1, 'mi integer ac neque duis bibendum morbi non quam nec', '2022-12-09 13:29:10', '2023-05-15 04:30:00', 35),
	(15, 21, 4, 'tortor sollicitudin mi sit amet lobortis sapien sapien', '2023-07-12 14:38:27', '2023-07-07 19:40:25', 22),
	(16, 13, 8, 'magnis dis parturient montes nascetur ridiculus mus', '2022-10-06 15:23:23', '2022-11-08 01:44:15', 19),
	(17, 43, 4, 'lacinia aenean sit amet justo morbi ut odio cras mi', '2022-03-14 20:56:44', '2022-12-09 14:51:24', 25),
	(18, 24, 1, 'vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat', '2022-10-04 10:18:42', '2023-02-15 23:56:58', 26),
	(19, 31, 10, 'et ultrices posuere cubilia curae mauris viverra diam vitae', '2023-01-10 03:54:31', '2023-01-09 09:28:32', 31),
	(20, 12, 8, 'dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at', '2022-12-08 04:10:31', '2023-06-04 04:31:54', 7),
	(21, 29, 6, 'non mauris morbi non lectus aliquam', '2022-12-16 11:27:31', '2022-07-14 03:28:34', 37),
	(22, 25, 4, 'consectetuer eget rutrum at lorem integer tincidunt ante', '2022-08-29 11:56:52', '2023-05-06 16:01:27', 42),
	(23, 28, 2, 'vivamus in felis eu sapien cursus vestibulum proin', '2023-06-29 07:05:00', '2022-02-14 16:39:47', 16),
	(24, 33, 4, 'lacus at velit vivamus vel nulla eget eros', '2022-03-30 17:56:18', '2023-03-17 14:06:51', 24),
	(25, 12, 5, 'urna pretium nisl ut volutpat sapien', '2023-04-14 23:02:06', '2022-10-17 11:20:25', 22),
	(26, 19, 5, 'sit amet justo morbi ut odio cras mi', '2022-06-30 22:20:58', '2023-01-20 21:23:56', 13),
	(27, 9, 4, 'amet turpis elementum ligula vehicula consequat morbi a', '2022-09-16 09:34:37', '2022-08-29 01:00:31', 47),
	(28, 41, 4, 'id justo sit amet sapien dignissim', '2023-07-20 04:00:39', '2022-08-18 12:16:48', 17),
	(29, 38, 9, 'venenatis turpis enim blandit mi in porttitor pede', '2022-10-01 15:49:11', '2022-08-25 13:16:15', 23);

-- Listage des données de la table symfonysessions.trainee : ~49 rows (environ)
INSERT INTO `trainee` (`id`, `first_name`, `last_name`, `ville`, `birth_date`, `email`, `tel`, `gender`) VALUES
	(1, 'Basile', 'Kuntz', 'TestVille', '1996-12-03 00:00:00', 'email.email@email.fr', '0680264451', 'Other'),
	(3, 'Alain', 'Terrieur', 'Haguenau', '2023-04-21 00:00:00', 'Alain.terrieur@test.fr', '063232', 'Male'),
	(4, 'Fred', 'Du grenier', 'Clermont-Ferrand', '2023-04-28 00:00:00', 'Jug@hkj.fr', '09', 'Male'),
	(5, 'Macron', 'Emanuel', 'Parise', '2023-04-16 00:00:00', 'macron.darkSasuke@elysee.io', '01', 'Other'),
	(6, 'Léonie', 'Littleover', 'Mudanjiang', '2022-11-23 01:08:18', 'elittleover5@ihg.com', '337-380-9177', 'Male'),
	(7, 'Kévina', 'Hearnes', 'Palmira', '2022-08-11 18:14:33', 'thearnes6@bbb.org', '152-623-7779', 'Female'),
	(8, 'Maëlyss', 'Hunnisett', 'Talshand', '2022-07-24 21:26:00', 'mhunnisett7@booking.com', '885-793-3937', 'Female'),
	(9, 'Pål', 'Cosstick', 'Zaozhuang', '2023-01-04 11:29:06', 'acosstick8@tumblr.com', '403-639-1118', 'Polygender'),
	(10, 'Maëlla', 'Carolan', 'Chivor', '2023-02-25 00:45:45', 'bcarolan9@lulu.com', '955-594-6938', 'Male'),
	(11, 'Océanne', 'Verduin', 'San Gil', '2023-01-31 05:13:06', 'bverduina@gov.uk', '840-253-7516', 'Female'),
	(12, 'Irène', 'Seemmonds', 'Saint-Jean-de-Védas', '2022-10-21 15:39:50', 'eseemmondsb@unblog.fr', '823-903-3675', 'Male'),
	(13, 'André', 'Campany', 'Vol’no-Nadezhdinskoye', '2022-05-15 09:19:00', 'acampanyc@instagram.com', '750-805-2623', 'Female'),
	(14, 'Edmée', 'Ivons', 'Salon-de-Provence', '2022-06-13 05:00:20', 'bivonsd@discuz.net', '545-757-8769', 'Female'),
	(15, 'Sòng', 'Edwardes', 'Souziqiu', '2022-07-30 17:23:46', 'fedwardese@alibaba.com', '614-754-4994', 'Female'),
	(16, 'Gérald', 'Tribe', 'Otrokovice', '2022-05-21 15:22:30', 'jtribef@gravatar.com', '747-745-9251', 'Female'),
	(17, 'Lorène', 'Chong', 'Amparafaravola', '2023-03-24 20:47:34', 'bchongg@example.com', '305-746-7872', 'Male'),
	(18, 'Mà', 'Downer', 'Ventsy', '2022-10-27 10:51:34', 'kdownerh@canalblog.com', '718-354-6798', 'Female'),
	(19, 'Léonore', 'Laundon', 'Hepu', '2022-08-02 18:23:06', 'hlaundoni@nbcnews.com', '512-217-4212', 'Female'),
	(20, 'Laïla', 'Alanbrooke', 'Jalatrang', '2022-12-04 02:53:40', 'malanbrookej@surveymonkey.com', '986-993-3323', 'Male'),
	(21, 'Maïwenn', 'Putland', 'Yermolino', '2023-02-11 01:24:38', 'lputlandk@rakuten.co.jp', '942-373-9954', 'Polygender'),
	(22, 'Marie-josée', 'Burnand', 'São Lourenço de Mamporcão', '2022-08-09 08:31:04', 'kburnandl@state.gov', '982-547-4125', 'Female'),
	(23, 'Adèle', 'Charke', 'Qiting', '2022-11-29 23:33:08', 'ccharkem@furl.net', '485-977-7927', 'Male'),
	(24, 'Yáo', 'Franses', 'Inglewood', '2022-12-26 22:39:15', 'hfransesn@utexas.edu', '310-819-2960', 'Female'),
	(25, 'Joséphine', 'Minshaw', 'Lallayug', '2022-09-22 19:29:56', 'mminshawo@theglobeandmail.com', '113-739-5632', 'Male'),
	(26, 'Táng', 'Ricardot', 'Poço Verde', '2022-08-18 11:03:56', 'dricardotp@histats.com', '731-699-7283', 'Male'),
	(27, 'Hélèna', 'Soppit', 'Yongshan', '2022-09-14 04:39:39', 'wsoppitq@mac.com', '961-729-6113', 'Male'),
	(28, 'Åke', 'Pitney', 'San Antonio', '2022-05-22 13:22:46', 'tpitneyr@infoseek.co.jp', '822-248-8242', 'Female'),
	(29, 'Bérénice', 'Bunny', 'Bobadela', '2022-10-29 23:38:21', 'lbunnys@omniture.com', '331-779-1535', 'Male'),
	(30, 'Maëly', 'Bennallck', 'Banjar Banyuning Barat', '2023-03-23 09:28:34', 'cbennallckt@hhs.gov', '936-368-8918', 'Male'),
	(31, 'Vénus', 'Diamond', 'Bar-le-Duc', '2022-05-16 09:08:57', 'ddiamondu@youtu.be', '455-868-2430', 'Female'),
	(32, 'Görel', 'Gibby', 'Santa Maria do Souto', '2022-08-18 15:31:31', 'wgibbyv@free.fr', '418-863-1404', 'Female'),
	(33, 'Desirée', 'Tutchell', 'Modderfontein', '2022-09-28 21:28:47', 'mtutchellw@networksolutions.com', '171-751-3543', 'Female'),
	(34, 'Hélène', 'Matkin', 'São Pedro', '2022-06-13 07:01:56', 'hmatkinx@freewebs.com', '276-989-8146', 'Female'),
	(35, 'Anaël', 'Biscomb', 'Mojoroto', '2022-09-11 19:50:04', 'jbiscomby@accuweather.com', '368-414-0409', 'Female'),
	(36, 'Néhémie', 'Coping', 'Si Sa Ket', '2022-10-29 20:28:31', 'lcopingz@gnu.org', '347-652-4807', 'Male'),
	(37, 'Cunégonde', 'Ellison', 'Pianling', '2022-08-20 14:22:44', 'lellison10@github.com', '980-896-1693', 'Male'),
	(38, 'Andréanne', 'Gianullo', 'Dengyue', '2023-02-16 09:47:50', 'agianullo11@taobao.com', '492-320-2227', 'Female'),
	(39, 'Eléonore', 'Coolbear', 'Volodars’k-Volyns’kyy', '2022-05-27 05:36:25', 'dcoolbear12@csmonitor.com', '285-569-0202', 'Female'),
	(40, 'Célia', 'Hoofe', 'Asadābād', '2022-05-30 12:12:55', 'lhoofe13@pcworld.com', '565-875-3727', 'Female'),
	(41, 'Mårten', 'Teager', 'Sonder', '2022-09-15 12:25:55', 'gteager14@rambler.ru', '527-597-1157', 'Male'),
	(42, 'Célestine', 'Seccombe', 'Shibi', '2023-03-19 01:58:18', 'xseccombe15@aol.com', '961-480-4477', 'Female'),
	(43, 'Eugénie', 'Clifton', 'Ananindeua', '2023-04-04 00:50:57', 'tclifton16@house.gov', '392-355-4591', 'Male'),
	(44, 'Loïca', 'Collingwood', 'Wenfeng Zhen', '2022-08-07 23:13:19', 'kcollingwood17@ifeng.com', '136-936-8357', 'Female'),
	(45, 'Loïs', 'Lillico', 'Turbo', '2022-09-29 01:35:48', 'ilillico18@yellowpages.com', '545-711-4154', 'Genderqueer'),
	(46, 'Josée', 'Collingwood', 'Dargaz', '2022-06-11 04:41:13', 'gcollingwood19@ycombinator.com', '674-434-4188', 'Female'),
	(47, 'Séréna', 'Van der Veldt', 'Ami', '2022-05-17 05:11:21', 'ivanderveldt1a@pagesperso-orange.fr', '183-935-1026', 'Male'),
	(48, 'Örjan', 'Gomme', 'Bailadores', '2022-06-10 13:15:59', 'cgomme1b@quantcast.com', '456-144-0913', 'Female'),
	(49, 'Réservés', 'Bullant', 'Gornji Breg', '2023-03-07 12:27:49', 'obullant1c@buzzfeed.com', '165-288-3227', 'Female'),
	(50, 'Maïlis', 'Rudge', 'Sława', '2022-09-11 12:11:19', 'mrudge1d@who.int', '656-658-9532', 'Female');

-- Listage des données de la table symfonysessions.trainee_session : ~0 rows (environ)
INSERT INTO `trainee_session` (`trainee_id`, `session_id`, `id`) VALUES
	(1, 1, 16),
	(1, 3, 19),
	(3, 1, 15),
	(3, 3, 18),
	(3, 5, 12),
	(3, 7, 36),
	(4, 1, 17),
	(4, 8, 25),
	(5, 8, 26),
	(37, 12, 41),
	(40, 12, 42),
	(42, 12, 43),
	(43, 12, 44);

-- Listage des données de la table symfonysessions.trainer : ~15 rows (environ)
INSERT INTO `trainer` (`id`, `first_name`, `last_name`) VALUES
	(1, 'Bob', 'Vance Vance Frigo'),
	(2, 'Michael', 'Scott'),
	(3, 'Marie-noël', 'Simon'),
	(4, 'Thérèsa', 'Edon'),
	(5, 'Åke', 'Oosthout de Vree'),
	(6, 'Mélodie', 'Yoxen'),
	(7, 'Audréanne', 'Kilford'),
	(8, 'Pénélope', 'Jaquet'),
	(9, 'Camélia', 'Barnicott'),
	(10, 'Hélèna', 'Goodlet'),
	(11, 'Noémie', 'Praundlin'),
	(12, 'Lài', 'Salling'),
	(13, 'Michèle', 'Muffitt'),
	(14, 'Lén', 'McCurtain'),
	(15, 'Zoé', 'Pollock');

-- Listage des données de la table symfonysessions.training : ~10 rows (environ)
INSERT INTO `training` (`id`, `title`) VALUES
	(1, 'Formation au développement webb'),
	(2, 'Formation en vente de papier à Scranton'),
	(3, 'Aliquam quis turpis eget elit sodales scelerisque.'),
	(4, 'Duis ac nibh.'),
	(5, 'Aliquam erat volutpat.'),
	(6, 'Integer non velit.'),
	(7, 'Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.'),
	(8, 'Cras non velit nec nisi vulputate nonummy.'),
	(9, 'Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.'),
	(10, 'Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.');

-- Listage des données de la table symfonysessions.user : ~5 rows (environ)
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
