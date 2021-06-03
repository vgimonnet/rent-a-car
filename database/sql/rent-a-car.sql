-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 03 juin 2021 à 09:39
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `rent-a-car`
--

-- --------------------------------------------------------

--
-- Structure de la table `conducteurs`
--

DROP TABLE IF EXISTS `conducteurs`;
CREATE TABLE IF NOT EXISTS `conducteurs` (
  `id_conducteur` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `est_particulier` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_personne_morale` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_conducteur`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `conducteurs`
--

INSERT INTO `conducteurs` (`id_conducteur`, `est_particulier`, `created_at`, `updated_at`, `nom`, `prenom`, `permis`, `id_personne_morale`) VALUES
(1, 1, '2021-06-03 06:41:35', '2021-06-03 06:41:35', 'Durand', 'Arthur', '54689793211984', NULL),
(2, 1, '2021-06-03 06:42:25', '2021-06-03 06:42:25', 'Dupont', 'Vincent', '123546785231', NULL),
(3, 1, '2021-06-03 06:44:46', '2021-06-03 06:44:46', 'Bauer', 'Justine', '32135479865432', NULL),
(4, 1, '2021-06-03 06:46:01', '2021-06-03 06:46:01', 'Kante', 'Younes', '1234568702312', NULL),
(5, 0, '2021-06-03 07:00:33', '2021-06-03 07:00:33', 'Martin', 'Louis', '123456789321', 1),
(6, 0, '2021-06-03 07:01:37', '2021-06-03 07:01:37', 'Durand', 'Christophe', '12345689231', 2),
(7, 0, '2021-06-03 07:02:28', '2021-06-03 07:02:39', 'Dubois', 'Didier', '32145687231', 3),
(8, 0, '2021-06-03 07:03:42', '2021-06-03 07:03:42', 'Moreau', 'Antoine', '65478932146', 4),
(9, 0, '2021-06-03 07:04:54', '2021-06-03 07:04:54', 'Petit', 'Kevin', '6548912345678', 1);

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

DROP TABLE IF EXISTS `contrats`;
CREATE TABLE IF NOT EXISTS `contrats` (
  `id_contrat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_conducteur` bigint(20) UNSIGNED DEFAULT NULL,
  `id_employe` bigint(20) UNSIGNED DEFAULT NULL,
  `id_vehicule` bigint(20) UNSIGNED DEFAULT NULL,
  `type_vehicule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `date_retour` date DEFAULT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double(8,2) NOT NULL,
  `montant_paye` double(8,2) NOT NULL,
  `id_controle_etat_sortie` bigint(20) UNSIGNED DEFAULT NULL,
  `id_controle_etat_entree` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_contrat`),
  KEY `contrats_id_controle_etat_sortie_index` (`id_controle_etat_sortie`),
  KEY `contrats_id_controle_etat_entree_index` (`id_controle_etat_entree`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contrats`
--

INSERT INTO `contrats` (`id_contrat`, `created_at`, `updated_at`, `id_conducteur`, `id_employe`, `id_vehicule`, `type_vehicule`, `date_debut`, `date_fin`, `date_retour`, `motif`, `montant`, `montant_paye`, `id_controle_etat_sortie`, `id_controle_etat_entree`) VALUES
(1, '2021-06-03 07:34:29', '2021-06-03 07:34:29', 5, 1, 1, 'vehicule_utilitaire', '2021-06-03', '2021-06-05', NULL, 'Vacances', 90.00, 20.00, NULL, NULL),
(3, '2021-06-03 07:35:17', '2021-06-03 07:35:17', 3, 1, 3, 'vehicule_utilitaire', '2021-06-03', '2021-06-07', NULL, 'Déménagement', 175.00, 50.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `controles_etat`
--

DROP TABLE IF EXISTS `controles_etat`;
CREATE TABLE IF NOT EXISTS `controles_etat` (
  `id_controle_etat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date NOT NULL,
  `kilometrage` int(11) NOT NULL,
  `etat_exterieur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat_interieur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frais_a_prevoir` tinyint(1) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_employe` bigint(20) UNSIGNED DEFAULT NULL,
  `id_contrat` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_controle_etat`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `controles_etat`
--

INSERT INTO `controles_etat` (`id_controle_etat`, `created_at`, `updated_at`, `date`, `kilometrage`, `etat_exterieur`, `etat_interieur`, `frais_a_prevoir`, `type`, `id_employe`, `id_contrat`) VALUES
(1, '2021-06-03 07:37:57', '2021-06-03 07:37:58', '2021-06-03', 30000, 'RAS', 'RAS', 0, 'sortie', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `controles_technique`
--

DROP TABLE IF EXISTS `controles_technique`;
CREATE TABLE IF NOT EXISTS `controles_technique` (
  `id_controle_technique` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_vehicule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conforme` tinyint(1) DEFAULT NULL,
  `date_controle` date NOT NULL,
  `contre_visite` tinyint(1) DEFAULT NULL,
  `date_contre_visite` date DEFAULT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_controle_technique`),
  KEY `controles_technique_id_vehicule_index` (`id_vehicule`(250))
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `controles_technique`
--

INSERT INTO `controles_technique` (`id_controle_technique`, `id_vehicule`, `conforme`, `date_controle`, `contre_visite`, `date_contre_visite`, `commentaire`, `created_at`, `updated_at`) VALUES
(1, 'AA-000-AA', 1, '2017-07-25', 0, NULL, 'RAS', '2021-06-03 07:23:37', '2021-06-03 07:23:37'),
(2, 'BB-111-BB', 1, '2017-08-28', 0, NULL, 'Prévoir de changer les pneus avants dans les prochains mois', '2021-06-03 07:25:08', '2021-06-03 07:25:08'),
(3, 'FF-555-FF', 1, '2021-03-01', 0, NULL, 'RAS', '2021-06-03 07:28:24', '2021-06-03 07:28:24'),
(4, 'II-888-II', 1, '2021-05-09', 0, NULL, 'RAS', '2021-06-03 07:28:43', '2021-06-03 07:28:43');

-- --------------------------------------------------------

--
-- Structure de la table `coordonnees`
--

DROP TABLE IF EXISTS `coordonnees`;
CREATE TABLE IF NOT EXISTS `coordonnees` (
  `id_coordonnee` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codePostal` int(11) NOT NULL,
  `id_personne_morale` bigint(20) UNSIGNED DEFAULT NULL,
  `id_conducteur` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_coordonnee`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `coordonnees`
--

INSERT INTO `coordonnees` (`id_coordonnee`, `email`, `telephone`, `pays`, `ville`, `adresse`, `complement`, `codePostal`, `id_personne_morale`, `id_conducteur`, `created_at`, `updated_at`) VALUES
(1, 'contact@eiffage.fr', '0102030405', 'France', 'Paris', 'rue des rues', '', 75001, NULL, NULL, '2021-06-03 06:37:35', '2021-06-03 06:37:35'),
(2, 'contact@free.fr', '9785462315', 'France', 'Paris', 'rue des villes', '', 75002, NULL, NULL, '2021-06-03 06:38:22', '2021-06-03 06:38:22'),
(3, 'contact@sick.fr', '5479624782', 'France', 'Paris', 'rue des Eglantiers', '', 75015, NULL, NULL, '2021-06-03 06:39:26', '2021-06-03 06:39:26'),
(4, 'contact@darty.fr', '0234657789', 'France', 'Metz', 'route de jouy', '', 57000, NULL, NULL, '2021-06-03 06:40:32', '2021-06-03 06:40:32'),
(5, 'arthur@mail.com', '0645978136', 'France', 'Metz', 'rue des capucins', '', 57000, NULL, NULL, '2021-06-03 06:41:35', '2021-06-03 06:41:35'),
(6, 'vincent.dupont@mail.com', '0613459752', 'France', 'Paris', 'rue des rues', '', 75005, NULL, NULL, '2021-06-03 06:42:25', '2021-06-03 06:42:25'),
(7, 'justine.bauer@mail.com', '0613459782', 'France', 'Melun', 'bd du chat', NULL, 93000, NULL, NULL, '2021-06-03 06:44:47', '2021-06-03 07:02:39'),
(8, 'younes.kante@mail.com', '0634975218', 'France', 'Paris', 'rue des iles', '', 77050, NULL, NULL, '2021-06-03 06:46:01', '2021-06-03 06:46:01'),
(9, 'louis.martin@mail.com', '0613549782', 'France', 'Paris', 'rue des loges', '', 75005, NULL, NULL, '2021-06-03 07:00:33', '2021-06-03 07:00:33'),
(10, 'christophe.durand@mail.com', '0631249752', 'France', 'Paris', 'rue d\'ici', '', 77000, NULL, NULL, '2021-06-03 07:01:37', '2021-06-03 07:01:37'),
(11, 'didier.dubois@mail.com', '0613497852', 'France', 'Metz', 'rue des poules', '', 57000, NULL, NULL, '2021-06-03 07:02:28', '2021-06-03 07:02:28'),
(12, 'antoine.moreau@mail.com', '0697845713', 'France', 'Melun', 'rue des molineaux', '', 77000, NULL, NULL, '2021-06-03 07:03:42', '2021-06-03 07:03:42'),
(13, 'kevin.petit@mail.com', '0654978478', 'France', 'Paris', 'rue de paulo', '', 75015, NULL, NULL, '2021-06-03 07:04:54', '2021-06-03 07:04:54'),
(14, 'martine.lefevre@mail.com', '0645978134', 'France', 'Paris', 'rue de la bas', '', 75001, NULL, NULL, '2021-06-03 07:05:55', '2021-06-03 07:05:55'),
(15, 'phillipe.roux@mail.com', '0645978431', 'France', 'Paris', '6 route de paris', '', 75003, NULL, NULL, '2021-06-03 07:06:55', '2021-06-03 07:06:55'),
(16, 'etienne.morel@mail.com', '0634975845', 'France', 'Metz', '54 bd chateaudun', '', 57000, NULL, NULL, '2021-06-03 07:08:03', '2021-06-03 07:08:03'),
(17, 'hamza.amdoui@mail.com', '0645978431', 'France', 'Paris', '1 rue de la gare', '', 77200, NULL, NULL, '2021-06-03 07:09:27', '2021-06-03 07:09:27');

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

DROP TABLE IF EXISTS `employes`;
CREATE TABLE IF NOT EXISTS `employes` (
  `id_employe` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `poste` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_employe`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employes`
--

INSERT INTO `employes` (`id_employe`, `poste`, `created_at`, `updated_at`, `nom`, `prenom`, `permis`) VALUES
(1, 'Hôtesse d\'accueil', '2021-06-03 07:05:55', '2021-06-03 07:05:55', 'Lefevre', 'Martine', '12346657892'),
(2, 'Mécanicien', '2021-06-03 07:06:54', '2021-06-03 07:06:54', 'Roux', 'Phillipe', '1234568794564'),
(3, 'Mécanicien', '2021-06-03 07:08:03', '2021-06-03 07:08:03', 'Morel', 'Etienne', '654879123456'),
(4, 'Mécanicien', '2021-06-03 07:09:27', '2021-06-03 07:09:27', 'Amdoui', 'Hamza', '974586123457');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING HASH
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_26_115114_create_coordonnees_table', 1),
(5, '2021_05_27_073506_create_personnes_morale_table', 1),
(16, '2021_05_27_080533_create_controle_techniques_table', 2),
(7, '2021_05_27_184413_create_controles_etat_table', 1),
(8, '2021_05_28_191339_create_contrats_table', 1),
(9, '2021_05_30_184556_create_conducteurs_table', 1),
(10, '2021_05_30_193517_create_employes_table', 1),
(11, '2021_05_31_192125_add_fields_nom_prenom_permis_to_conducteurs', 1),
(12, '2021_05_31_192125_add_relation_personnemorale_to_conducteurs', 1),
(13, '2021_05_31_192126_add_fields_nom_prenom_permis_to_employes', 1),
(14, '2021_06_01_164925_create_vehicules_leger_table', 1),
(15, '2021_06_01_175318_create_vehicules_utilitaire_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personnes_morale`
--

DROP TABLE IF EXISTS `personnes_morale`;
CREATE TABLE IF NOT EXISTS `personnes_morale` (
  `id_personne_morale` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `siret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `societe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_personne_morale`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personnes_morale`
--

INSERT INTO `personnes_morale` (`id_personne_morale`, `siret`, `societe`, `created_at`, `updated_at`) VALUES
(1, '123245678998761', 'EIFFAGE', '2021-06-03 06:37:35', '2021-06-03 06:37:35'),
(2, '32165478932149', 'FREE', '2021-06-03 06:38:22', '2021-06-03 06:38:22'),
(3, '65472354975234', 'SICK', '2021-06-03 06:39:26', '2021-06-03 06:39:26'),
(4, '65478912365481', 'Darty', '2021-06-03 06:40:32', '2021-06-03 06:40:32');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Valentin Gimonnet', 'valentin.gimonnet18@gmail.com', NULL, '$2y$10$cbVB0AtDimdcgkWH7CiZ2OcYs3CHQYtW0WWBS.F7gKqqYrBIsyvE2', NULL, '2021-06-03 06:16:19', '2021-06-03 06:16:19');

-- --------------------------------------------------------

--
-- Structure de la table `vehicules_leger`
--

DROP TABLE IF EXISTS `vehicules_leger`;
CREATE TABLE IF NOT EXISTS `vehicules_leger` (
  `id_vehicule` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `immatriculation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `poid` int(11) NOT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modele` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cout_par_jour` double(8,2) NOT NULL,
  `date_anciennete` date NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `places` smallint(6) NOT NULL,
  `contenance_coffre` int(11) NOT NULL,
  `hauteur` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_vehicule`),
  UNIQUE KEY `vehicules_leger_immatriculation_unique` (`immatriculation`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vehicules_leger`
--

INSERT INTO `vehicules_leger` (`id_vehicule`, `immatriculation`, `disponible`, `poid`, `marque`, `modele`, `cout_par_jour`, `date_anciennete`, `couleur`, `places`, `contenance_coffre`, `hauteur`, `created_at`, `updated_at`) VALUES
(1, 'AA-000-AA', 1, 980, 'Peugeot', '208', 20.00, '2018-01-01', 'Grise', 5, 200, 160.00, '2021-06-03 06:19:45', '2021-06-03 06:19:45'),
(2, 'BB-111-BB', 1, 1000, 'Toyota', 'Yaris', 21.00, '2016-01-01', 'Bleue', 5, 200, 165.00, '2021-06-03 06:22:13', '2021-06-03 06:22:13'),
(3, 'CC-222-CC', 1, 980, 'Renault', 'Clio', 25.00, '2019-01-01', 'Rouge', 5, 200, 160.00, '2021-06-03 06:22:57', '2021-06-03 06:23:50'),
(4, 'DD-333-DD', 1, 950, 'Citroën', 'C3', 20.00, '2018-01-01', 'Verte pomme', 5, 200, 160.00, '2021-06-03 06:23:40', '2021-06-03 06:23:40'),
(5, 'EE-444-EE', 1, 975, 'Dacia', 'Sandero', 22.00, '2018-12-01', 'Noire', 5, 200, 155.00, '2021-06-03 06:24:33', '2021-06-03 06:24:33');

-- --------------------------------------------------------

--
-- Structure de la table `vehicules_utilitaire`
--

DROP TABLE IF EXISTS `vehicules_utilitaire`;
CREATE TABLE IF NOT EXISTS `vehicules_utilitaire` (
  `id_vehicule` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `immatriculation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `poid` int(11) NOT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modele` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cout_par_jour` double(8,2) NOT NULL,
  `date_anciennete` date NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `places` smallint(6) NOT NULL,
  `contenance_coffre` int(11) NOT NULL,
  `hauteur` double(8,2) NOT NULL,
  `benne` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_vehicule`),
  UNIQUE KEY `vehicules_utilitaire_immatriculation_unique` (`immatriculation`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vehicules_utilitaire`
--

INSERT INTO `vehicules_utilitaire` (`id_vehicule`, `immatriculation`, `disponible`, `poid`, `marque`, `modele`, `cout_par_jour`, `date_anciennete`, `couleur`, `places`, `contenance_coffre`, `hauteur`, `benne`, `created_at`, `updated_at`) VALUES
(1, 'FF-555-FF', 1, 1500, 'Citroën', 'Berlingo', 30.00, '2020-09-26', 'Blanche', 3, 500, 180.00, 0, '2021-06-03 06:26:18', '2021-06-03 06:26:18'),
(2, 'GG-666-GG', 1, 2000, 'Ford', 'Transit', 32.00, '2017-08-24', 'Blanche', 3, 1000, 190.00, 0, '2021-06-03 06:27:08', '2021-06-03 06:27:08'),
(3, 'HH-777-HH', 1, 2300, 'Mercedes-Benz', 'Vito', 35.00, '2016-05-06', 'Blanche', 3, 1200, 195.00, 0, '2021-06-03 06:28:51', '2021-06-03 06:28:51'),
(4, 'II-888-II', 1, 1300, 'Peugeot', 'Expert', 35.00, '2016-08-28', 'Blanche', 5, 500, 180.00, 1, '2021-06-03 06:29:54', '2021-06-03 06:29:54'),
(5, 'JJ-999-JJ', 1, 2000, 'Hyundai', 'H350', 36.00, '2019-12-01', 'Blanche', 3, 1300, 180.00, 0, '2021-06-03 06:31:12', '2021-06-03 06:31:12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
