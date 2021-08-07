-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 06 Mai 2021 à 14:03
-- Version du serveur: 5.5.60-0ubuntu0.14.04.1
-- Version de PHP: 7.2.7-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `visite`
--

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE IF NOT EXISTS `departement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C1765B6398260155` (`region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=47 ;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`id`, `libelle`, `region_id`) VALUES
(1, 'Dakar', 1),
(2, 'Guédiawaye', 1),
(3, 'Pikine', 1),
(4, 'Rufisque', 1),
(5, 'Bambey', 2),
(6, 'Diourbel', 2),
(7, 'Mbacké', 2),
(8, 'Fatick', 3),
(9, 'Foundiougne', 3),
(10, 'Gossas', 3),
(11, 'Birkilane', 4),
(12, 'Kaffrine', 4),
(13, 'Malem-Hodar', 4),
(14, 'Kaolack', 5),
(15, 'Guinguinéo', 5),
(16, 'Nioro du Rip', 5),
(17, 'Kédougou', 6),
(18, 'Salemata', 6),
(19, 'Saraya', 6),
(20, 'Kolda', 7),
(21, 'Médina Yoro Foulah', 7),
(22, 'Vélingara', 7),
(23, 'Kébémer', 8),
(24, 'Linguère', 8),
(25, 'Louga', 8),
(26, 'Kanel', 9),
(27, 'Matam', 9),
(28, 'Ranérou', 9),
(29, 'Dagana', 10),
(30, 'Podor', 10),
(31, 'Saint-Louis', 10),
(32, 'Bounkiling', 11),
(33, 'Goudomp', 11),
(34, 'Sédhiou', 11),
(35, 'Bakel', 12),
(36, 'Koumpentoum', 12),
(37, 'Goudiry', 12),
(38, 'Tambacounda', 12),
(39, 'Mbour', 13),
(40, 'Thiès', 13),
(41, 'Tivaouane', 13),
(42, 'Bignona', 14),
(43, 'Oussouye', 14),
(44, 'Ziguinchor', 14),
(45, 'Hors Sénégal', 15),
(46, 'Koungheul', 4);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200316162105', '2020-03-16 16:22:06'),
('20200316162750', '2020-03-16 16:28:10'),
('20200316164432', '2020-03-16 16:45:23'),
('20200317101627', '2020-03-17 10:16:37'),
('20200317124449', '2020-03-17 12:45:10'),
('20200318120925', '2020-03-18 12:09:48'),
('20200318151405', '2020-03-18 15:15:10'),
('20200318164117', '2020-03-18 16:41:34'),
('20200319104738', '2020-03-19 10:52:29'),
('20200319105910', '2020-03-19 10:59:25'),
('20200319114222', '2020-03-19 11:45:34'),
('20200319114735', '2020-03-19 11:47:44'),
('20200319122405', '2020-03-19 12:24:18'),
('20200323141227', '2020-03-23 16:26:46'),
('20200330135656', '2020-03-30 21:41:37'),
('20200330205640', '2020-03-30 22:29:59');

-- --------------------------------------------------------

--
-- Structure de la table `motif_demande`
--

CREATE TABLE IF NOT EXISTS `motif_demande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67E3108FED5CA9E6` (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=73 ;

--
-- Contenu de la table `motif_demande`
--

INSERT INTO `motif_demande` (`id`, `libelle`, `service_id`) VALUES
(5, 'Plateforme des demandes d''emploi', 3),
(6, 'Plateforme de téléchargement des actes', 3),
(4, 'Certificat de non appartenance á la Fonction Publique', 3),
(7, 'Autres', 3),
(8, 'Numéro projet', 4),
(9, 'Etape projet', 4),
(10, 'Disponibilité acte', 4),
(11, 'Complément de dossier', 4),
(12, 'Réclamation', 4),
(13, 'Résultat commission', 4),
(14, 'Suivi de dossier', 4),
(15, 'Autres', 4),
(16, 'Numéro projet', 5),
(17, 'Etape projet', 5),
(18, 'Disponibilité acte', 5),
(19, 'Complément de dossier', 5),
(20, 'Réclamation', 5),
(21, 'Résultat commission', 5),
(22, 'Suivi de dossier', 5),
(23, 'Autres', 5),
(24, 'Numéro projet', 6),
(25, 'Etape projet', 6),
(26, 'Disponibilité acte', 6),
(27, 'Complément de dossier', 6),
(28, 'Réclamation', 6),
(29, 'Résultat commission', 6),
(30, 'Suivi de dossier', 6),
(31, 'Autres', 6),
(32, 'Numéro projet', 7),
(33, 'Etape projet', 7),
(34, 'Disponibilité acte', 7),
(35, 'Complément de dossier', 7),
(36, 'Réclamation', 7),
(37, 'Résultat commission', 7),
(38, 'Suivi de dossier', 7),
(39, 'Autres', 7),
(40, 'Demandes d''emploi', 8),
(41, 'Autres', 8),
(42, 'Affaire personnel', 9),
(43, 'Autres', 9),
(44, 'Affaire personnel', 10),
(45, 'Autres', 10),
(46, 'Acte disponibilite', 11),
(47, 'Résultat commission', 11),
(48, 'Autres', 11),
(49, 'Numéro projet', 12),
(50, 'Etape projet', 12),
(51, 'Disponibilité acte', 12),
(52, 'Complément de dossier', 12),
(53, 'Réclamation', 12),
(54, 'Résultat commission', 12),
(55, 'Suivi de dossier', 12),
(56, 'Autres', 12),
(57, 'Numéro projet', 13),
(58, 'Etape projet', 13),
(59, 'Disponibilité acte', 13),
(60, 'Complément de dossier', 13),
(61, 'Réclamation', 13),
(62, 'Résultat commission', 13),
(63, 'Suivi de dossier', 13),
(64, 'Autres', 13),
(65, 'Plateforme des demandes d''emploi', 13),
(66, 'Plateforme de téléchargement des actes', 13),
(67, 'Affaire personnel', 14),
(68, 'autres', 14),
(69, 'Affaire personnel', 15),
(70, 'autres', 15),
(71, 'Suivi dossier', 2),
(72, 'autres', 2);

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `region`
--

INSERT INTO `region` (`id`, `libelle`) VALUES
(1, 'Dakar'),
(2, 'Diourbel'),
(3, 'Fatick'),
(4, 'Kaffrine'),
(5, 'Kaolack'),
(6, 'Kédougou'),
(7, 'Kolda'),
(8, 'Louga'),
(9, 'Matam'),
(10, 'Saint-Louis'),
(11, 'Sédhiou'),
(12, 'Tambacounda'),
(13, 'Thiès'),
(14, 'Ziguinchor'),
(15, 'Hors Sénégal');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `structure_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E19D9AD22534008B` (`structure_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id`, `structure_id`, `nom`, `agent`) VALUES
(2, 1, 'le Bureau du Courrier commun', 0),
(3, 2, 'Support et Plateforme', 0),
(4, 3, 'Division des Fonctionnaires', 1),
(5, 3, 'Division des Agents non fonctionnaires de l’Etat', 1),
(6, 3, 'Division des Enseignants', 1),
(7, 3, 'Division des Pensions et Retraites', 1),
(8, 4, 'Division du Recrutement', 0),
(9, 5, 'Division des Etudes et de la Législation', 1),
(10, 5, 'Division du Contentieux et de la Discipline', 1),
(11, 6, 'Service du Fichier central', 1),
(12, 6, 'Service d’Accueil, d’Information et de Liaison', 1),
(13, 6, 'Service informatique et de l’Archivage', 1),
(14, 7, 'Division administrative et financière', 0),
(15, 8, 'Centre national Médico-social', 1);

-- --------------------------------------------------------

--
-- Structure de la table `structure`
--

CREATE TABLE IF NOT EXISTS `structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `structure`
--

INSERT INTO `structure` (`id`, `nom`) VALUES
(1, 'Secrétariat Général'),
(2, 'Direction des Systèmes d''Information'),
(3, 'Direction de la Gestion des Carrières'),
(4, 'Direction de la Gestion   des Effectifs, des Emplois et des Compétences'),
(5, 'Direction des Etudes, de la Législation et du Contentieux'),
(6, 'Direction générale de la Fonction publique'),
(7, 'Direction de l’Administration générale et de l’Equipement'),
(8, 'Autres administrations rattachées au Ministère ');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(11) NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usern` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `usern` (`usern`),
  KEY `IDX_8D93D649ED5CA9E6` (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `service_id`, `prenom`, `nom`, `usern`, `active`) VALUES
(1, 'zauromansour@gmail.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$N30BflyBm2gqDlWEqeK8Cg$NfNjnjfQmDnzUUX8ifRZ9KZvPEy4qts3whMSftffvus', 5, 'Mansour', 'Faye', 'm.faye', 1),
(2, 'dgc.chef-dens@fonctionpublique.gouv.sn', '[]', '$argon2id$v=19$m=65536,t=4,p=1$tsaSKJEd3nmrtwbyNqMPzg$yqs+zHgqX/h3S4de0HCjNC85tDyE4+9Ht5AO2ShhyFw', 6, 'Amadou Legrand', 'Diop', 'chefdens', 0),
(3, 'dgc.chef-dnf@fonctionpublique.gouv.sn', '[]', '$argon2id$v=19$m=65536,t=4,p=1$tsaSKJEd3nmrtwbyNqMPzg$yqs+zHgqX/h3S4de0HCjNC85tDyE4+9Ht5AO2ShhyFw', 5, 'Kasso', 'Dramé', 'chefdnf', 0),
(4, 'dgc.chef-dpr@fonctionpublique.gouv.sn', '[]', '$argon2id$v=19$m=65536,t=4,p=1$tsaSKJEd3nmrtwbyNqMPzg$yqs+zHgqX/h3S4de0HCjNC85tDyE4+9Ht5AO2ShhyFw', 7, 'Mamadou', 'Gaye', 'chefdpr', 0),
(5, 'dgc.chef-df@fonctionpublique.gouv.sn', '[]', '$argon2id$v=19$m=65536,t=4,p=1$tsaSKJEd3nmrtwbyNqMPzg$yqs+zHgqX/h3S4de0HCjNC85tDyE4+9Ht5AO2ShhyFw', 4, 'Papa Mamadou', 'Camara\r\n', 'chefdf', 0),
(6, 'dgpeec.chefdfc@fonctionpublique.gouv.sn', '[]', '$argon2id$v=19$m=65536,t=4,p=1$tsaSKJEd3nmrtwbyNqMPzg$yqs+zHgqX/h3S4de0HCjNC85tDyE4+9Ht5AO2ShhyFw', 11, 'Ndiack', 'Diaw', 'chefdfc', 0),
(7, 'Ibrahima.NDIAYE@fonctionpublique.gouv.sn', '[]', '$argon2id$v=19$m=65536,t=4,p=1$tsaSKJEd3nmrtwbyNqMPzg$yqs+zHgqX/h3S4de0HCjNC85tDyE4+9Ht5AO2ShhyFw', 13, 'Ibrahima', 'Ndiaye', 'chefsia', 0),
(8, 'admin@admin.com', '["ROLE_ADMIN"]', '$argon2id$v=19$m=65536,t=4,p=1$t+oh9sH//y3MX6nWcD1zdg$ZcmaPTTcsB6LB/6Fnw79wjLU3+MUH/w3WVQArVPMIDg', 3, 'admin', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Structure de la table `visite`
--

CREATE TABLE IF NOT EXISTS `visite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_visiteur` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_visiteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_visite` datetime NOT NULL,
  `demande` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif_demande_id` int(11) NOT NULL,
  `departement_id` int(11) NOT NULL,
  `telephone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  
  `datenaiss` date NOT NULL,
  `service_id` int(11) NOT NULL,
  `structure_id` int(11) NOT NULL,
  `reponse` longtext COLLATE utf8mb4_unicode_ci,
  `genre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B09C8CBBFFE93879` (`motif_demande_id`),
  KEY `IDX_B09C8CBBCCF9E01E` (`departement_id`),
  KEY `IDX_B09C8CBB98260155` (`region_id`),
  KEY `IDX_B09C8CBBED5CA9E6` (`service_id`),
  KEY `IDX_B09C8CBB2534008B` (`structure_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=15 ;

--
-- Contenu de la table `visite`
--

INSERT INTO `visite` (`id`, `nom_visiteur`, `prenom_visiteur`, `adresse`, `date_visite`, `demande`, `motif_demande_id`, `departement_id`, `telephone`, `email`, `region_id`, `matricule`, `cin`, `datenaiss`, `service_id`, `structure_id`, `reponse`, `genre`) VALUES
(1, 'Ndiaye', 'Waly', 'Patte d''oie', '2020-03-20 12:50:56', 'Je souhaite avoir l''etat d''avencement de mon projet', 16, 1, '776585898', 'ahmadouwalyndiaye@gmail.com', 1, '696783/A', '', '2007-01-29', 5, 3, 'votre projet se trouve au contrôle budgétaire\r\ntest d''envoi du mail', 'Masculin'),
(2, 'Ndiaye', 'Waly', 'Patte d''oie', '2020-03-20 12:50:56', 'Je souhaite avoir l''etat d''avencement de mon projet', 17, 1, '776585898', 'ahmadouwalyndiaye@gmail.com', 1, '696783/A', '', '2007-01-29', 5, 3, 'OK on est dessu\r\nMerci de  patienter\r\n\r\ntester gmail', 'Masculin'),
(3, 'Faye', 'Mansour', 'paris', '2020-03-21 00:16:44', 'bonsoir,\r\nj''aimerai savoir si mon acte est disponible', 55, 45, '779094470', 'zauromansour@gmail.com', 15, '696783A', '', '1990-10-05', 5, 3, 'Oui votre acte est disponible en téléchargement sur le site  De téléchargement des actes de la Fonction publique http://www.fonctionpublique-actes.gouv.sn/', 'Masculin'),
(4, 'Faye', 'Mansour', 'hann mariste', '2020-03-23 12:21:23', 'je veux connaitre l''etat de mon projet acte', 10, 1, '779094470', 'zauromansour@gmail.com', 1, '696783A', '', '1980-01-01', 5, 3, NULL, 'Masculin'),
(5, 'ba', 'khadija', 'Scat Urbam', '2020-03-24 16:01:25', 'bonjour,\r\nje voudrais mes param de connexion. Merci', 5, 1, '773526321', 'khadijatouba89@gmail.com', 1, NULL, '2870198900501', '1989-02-09', 3, 2, NULL, 'Masculin'),
(6, 'Faye', 'Serigne Mansour', 'dakar-senegal', '2020-03-25 22:54:19', 'Bonjour,\r\nje demande l''état d''avancement de mon projet', 9, 1, '+221779094470', 'zauromansour@gmail.com', 1, '696783A', '', '1900-02-14', 4, 3, NULL, 'Masculin'),
(7, 'Kane', 'Oumou', 'hlm diourbel', '2020-03-30 23:36:59', 'Bonjour, je suis enseignant à l''école élémentaire de Diourbel et je voudrais connaitre mon numéro de projet Matricule:765435/B', 24, 6, '772151111', 'salam@gmail.com', 2, '765435/B', '', '1995-11-25', 6, 3, NULL, 'Feminin'),
(8, 'Kane', 'Oumou', 'HLM 4', '2020-03-30 23:45:50', 'Bonjour, je suis enseignant au CEM Malick Sy de Dakar et je voudrais connaitre mon numéro de projet Matricule 765555/B', 24, 1, '772155555', 'salam@gmail.com', 1, '765555/B', '', '1995-11-25', 6, 3, NULL, 'Feminin'),
(9, 'Kane', 'Oumou', 'HLM 4', '2020-03-31 22:47:33', 'Bonjour, je suis un enseignant du CEM Malick SY de Dakar et je voudrais connaitre mon numéro de projet Matricule :765432/B', 24, 1, '772155555', 'salam@gmail.com', 1, '765432/B', '', '1995-11-25', 6, 3, NULL, 'Feminin'),
(10, 'kane', 'Oumou', 'hlm5', '2020-03-31 22:56:23', 'Bonjour, je suis un enseignant du CEM Malick SY de Dakar et je voudrais connaitre mon numéro de projet Matricule: 765435/B', 24, 1, '772155555', 'salam@gmail.com', 1, '765435/B', '', '1995-11-25', 6, 3, NULL, 'Feminin'),
(11, 'Kane', 'Oumou', 'Hlm5', '2020-03-31 23:06:34', 'Bonjour, je suis un enseignant du CEM Malick SY de Dakar et je voudrais connaitre mon numéro de projet Matricule 765435/B', 24, 1, '772155555', 'salam@gmail.com', 1, '765435/B', '', '1995-11-25', 6, 3, NULL, 'Feminin'),
(12, 'Kane', 'Oumou', 'hlm5', '2020-03-31 23:12:55', 'Bonjour, je suis un enseignant du CEM Malick SY de Dakar et je voudrais connaitre mon numéro de projet Matricule :765435/B', 24, 1, '77215555', 'salam@gmail.com', 1, '765435/B', '', '1995-11-25', 6, 3, NULL, 'Feminin'),
(13, 'Kane', 'Oumou', 'hlm5', '2020-03-31 23:16:45', 'Bonjour, je suis un enseignant du CEM Malick SY de Dakar et je voudrais connaitre mon numéro de projet Matricule :765435/B', 24, 1, '77215555', 'salam@gmail.com', 1, '765435/B', '', '1995-11-25', 6, 3, NULL, 'Feminin'),
(14, 'Faye', 'Mansour', 'paris', '2020-04-06 15:32:29', 'Bonjour, je n''arrive à me connecter sur la plateforme des demandeurs d''emploi j''ai oublier mon mot de passe et mon numéro d’inscription', 5, 45, '779094470', 'zauromansour@gmail.com', 15, NULL, '1254562120012', '1990-02-14', 3, 2, NULL, 'Masculin');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `FK_C1765B6398260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`);

--
-- Contraintes pour la table `motif_demande`
--
ALTER TABLE `motif_demande`
  ADD CONSTRAINT `FK_67E3108FED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `FK_E19D9AD22534008B` FOREIGN KEY (`structure_id`) REFERENCES `structure` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Contraintes pour la table `visite`
--
ALTER TABLE `visite`
  ADD CONSTRAINT `FK_B09C8CBB2534008B` FOREIGN KEY (`structure_id`) REFERENCES `structure` (`id`),
  ADD CONSTRAINT `FK_B09C8CBB98260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`),
  ADD CONSTRAINT `FK_B09C8CBBCCF9E01E` FOREIGN KEY (`departement_id`) REFERENCES `departement` (`id`),
  ADD CONSTRAINT `FK_B09C8CBBED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`),
  ADD CONSTRAINT `FK_B09C8CBBFFE93879` FOREIGN KEY (`motif_demande_id`) REFERENCES `motif_demande` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
