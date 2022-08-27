-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 27 août 2022 à 12:10
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sirbarh`
--

-- --------------------------------------------------------

--
-- Structure de la table `calendrier`
--

CREATE TABLE `calendrier` (
  `id` int(11) NOT NULL,
  `libelle_annee` varchar(4) DEFAULT NULL,
  `date_edition_salaire` date DEFAULT NULL,
  `base_mois` int(11) DEFAULT NULL,
  `debut_periode` date DEFAULT NULL,
  `fin_periode` varchar(45) DEFAULT NULL,
  `mois_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `charge`
--

CREATE TABLE `charge` (
  `id` int(11) NOT NULL,
  `nom_prenom` varchar(45) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `relation` varchar(45) DEFAULT NULL,
  `telephone` varchar(8) DEFAULT NULL,
  `employe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `libelle_classe` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `libelle_classe`) VALUES
(1, 'c1'),
(2, 'c2'),
(7, 'c3');

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `id` int(11) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin_prevue` date DEFAULT NULL,
  `date_fin_reel` date DEFAULT NULL,
  `fichier` varchar(45) DEFAULT NULL,
  `salaire_base` varchar(45) DEFAULT NULL,
  `employe_id` int(11) NOT NULL,
  `type_contrat_id` int(11) NOT NULL,
  `statut_contrat_id` int(11) NOT NULL,
  `type_traitement_salaire_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `departement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `donnees_configuration`
--

CREATE TABLE `donnees_configuration` (
  `id` int(11) NOT NULL,
  `nom_societe` varchar(45) DEFAULT NULL,
  `nif` varchar(45) DEFAULT NULL,
  `rccm` varchar(45) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  `pourcentage_charge_patronale_cnss` varchar(45) DEFAULT NULL,
  `valeur_indiciaire` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `echelon`
--

CREATE TABLE `echelon` (
  `id` int(11) NOT NULL,
  `libelle_echelon` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `echelon`
--

INSERT INTO `echelon` (`id`, `libelle_echelon`) VALUES
(1, 'e'),
(2, 'e2'),
(3, 'e');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id` int(11) NOT NULL,
  `matricule` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_employe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_employe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fonction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` tinyint(4) NOT NULL,
  `telephone` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_cnss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classe_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `echelon_id` int(11) NOT NULL,
  `Département_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `employe_has_prime`
--

CREATE TABLE `employe_has_prime` (
  `employe_id` int(11) NOT NULL,
  `indemnite_id` int(11) NOT NULL,
  `valeur` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `grille`
--

CREATE TABLE `grille` (
  `id` int(11) NOT NULL,
  `valeur` int(11) DEFAULT NULL,
  `echelon_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `classe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `indemnite`
--

CREATE TABLE `indemnite` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `indemnite`
--

INSERT INTO `indemnite` (`id`, `libelle`) VALUES
(1, 'test'),
(4, 'test2'),
(5, 'test3');

-- --------------------------------------------------------

--
-- Structure de la table `mois`
--

CREATE TABLE `mois` (
  `id` int(11) NOT NULL,
  `libelle_mois` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mois`
--

INSERT INTO `mois` (`id`, `libelle_mois`) VALUES
(1, 'Janvier'),
(2, 'fevrier'),
(4, 'mars');

-- --------------------------------------------------------

--
-- Structure de la table `prime`
--

CREATE TABLE `prime` (
  `id` int(11) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `prime`
--

INSERT INTO `prime` (`id`, `libelle`) VALUES
(1, 'Supplementaire'),
(3, 'alimentaire');

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `libelleProfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id`, `libelleProfil`) VALUES
(1, 'Administrateur'),
(2, 'Ressource humaine');

-- --------------------------------------------------------

--
-- Structure de la table `salaire`
--

CREATE TABLE `salaire` (
  `id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL,
  `grille_id` int(11) NOT NULL,
  `salaire_brut` varchar(45) DEFAULT NULL,
  `salaire_net` varchar(45) DEFAULT NULL,
  `total_indemnites` varchar(45) DEFAULT NULL,
  `total_prime` varchar(45) DEFAULT NULL,
  `iuts` varchar(45) DEFAULT NULL,
  `cotisation_cnss` varchar(45) DEFAULT NULL,
  `fnr` varchar(45) DEFAULT NULL,
  `calendrier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `salaire_has_prime`
--

CREATE TABLE `salaire_has_prime` (
  `salaire_id` int(11) NOT NULL,
  `prime_id` int(11) NOT NULL,
  `valeur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `statut_contrat`
--

CREATE TABLE `statut_contrat` (
  `id` int(11) NOT NULL,
  `libelle_statut` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `statut_contrat`
--

INSERT INTO `statut_contrat` (`id`, `libelle_statut`) VALUES
(1, 'En cours'),
(2, 'Actif'),
(3, 'Résilié');

-- --------------------------------------------------------

--
-- Structure de la table `type_contrat`
--

CREATE TABLE `type_contrat` (
  `id` int(11) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_contrat`
--

INSERT INTO `type_contrat` (`id`, `libelle`) VALUES
(1, 'Stage'),
(2, 'CDD'),
(3, 'CDI'),
(4, 'En cours');

-- --------------------------------------------------------

--
-- Structure de la table `type_traitement_salaire`
--

CREATE TABLE `type_traitement_salaire` (
  `id` int(11) NOT NULL,
  `libelle` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_traitement_salaire`
--

INSERT INTO `type_traitement_salaire` (`id`, `libelle`) VALUES
(1, 'Traitement par contrat'),
(2, 'Traitement par grille');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(225) DEFAULT NULL,
  `password` varchar(245) DEFAULT NULL,
  `profil_id` int(11) NOT NULL,
  `statut` tinyint(4) DEFAULT 1,
  `employe_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `profil_id`, `statut`, `employe_id`) VALUES
(0, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_calendrier_mois1_idx` (`mois_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `charge`
--
ALTER TABLE `charge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_charge_employe1_idx` (`employe_id`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Contrat_employe1_idx` (`employe_id`),
  ADD KEY `fk_Contrat_type_contrat1_idx` (`type_contrat_id`),
  ADD KEY `fk_Contrat_statut_contrat1_idx` (`statut_contrat_id`),
  ADD KEY `id_type_taitement_salaire_in_contrat` (`type_traitement_salaire_id`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_departement_departement1_idx` (`departement_id`);

--
-- Index pour la table `donnees_configuration`
--
ALTER TABLE `donnees_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `echelon`
--
ALTER TABLE `echelon`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_employe_classe1_idx` (`classe_id`),
  ADD KEY `fk_employe_categorie1_idx` (`categorie_id`),
  ADD KEY `fk_employe_echelon1_idx` (`echelon_id`),
  ADD KEY `fk_employe_Département1_idx` (`Département_id`);

--
-- Index pour la table `employe_has_prime`
--
ALTER TABLE `employe_has_prime`
  ADD PRIMARY KEY (`employe_id`,`indemnite_id`),
  ADD KEY `fk_employe_has_prime_prime1_idx` (`indemnite_id`),
  ADD KEY `fk_employe_has_prime_employe1_idx` (`employe_id`);

--
-- Index pour la table `grille`
--
ALTER TABLE `grille`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_grille_echelon1_idx` (`echelon_id`),
  ADD KEY `fk_grille_categorie1_idx` (`categorie_id`),
  ADD KEY `fk_grille_classe1_idx` (`classe_id`);

--
-- Index pour la table `indemnite`
--
ALTER TABLE `indemnite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mois`
--
ALTER TABLE `mois`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prime`
--
ALTER TABLE `prime`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salaire`
--
ALTER TABLE `salaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_salaire_employe1_idx` (`employe_id`),
  ADD KEY `fk_salaire_grille1_idx` (`grille_id`),
  ADD KEY `fk_salaire_calendrier1_idx` (`calendrier_id`);

--
-- Index pour la table `salaire_has_prime`
--
ALTER TABLE `salaire_has_prime`
  ADD PRIMARY KEY (`salaire_id`,`prime_id`),
  ADD KEY `fk_salaire_has_prime_prime1_idx` (`prime_id`),
  ADD KEY `fk_salaire_has_prime_salaire1_idx` (`salaire_id`);

--
-- Index pour la table `statut_contrat`
--
ALTER TABLE `statut_contrat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_contrat`
--
ALTER TABLE `type_contrat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_traitement_salaire`
--
ALTER TABLE `type_traitement_salaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD KEY `fk_user_profil1_idx` (`profil_id`),
  ADD KEY `fk_user_employes1_idx` (`employe_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `calendrier`
--
ALTER TABLE `calendrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `charge`
--
ALTER TABLE `charge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `donnees_configuration`
--
ALTER TABLE `donnees_configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `echelon`
--
ALTER TABLE `echelon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `grille`
--
ALTER TABLE `grille`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `indemnite`
--
ALTER TABLE `indemnite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `mois`
--
ALTER TABLE `mois`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `prime`
--
ALTER TABLE `prime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `salaire`
--
ALTER TABLE `salaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statut_contrat`
--
ALTER TABLE `statut_contrat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_contrat`
--
ALTER TABLE `type_contrat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_traitement_salaire`
--
ALTER TABLE `type_traitement_salaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD CONSTRAINT `fk_calendrier_mois1` FOREIGN KEY (`mois_id`) REFERENCES `mois` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `charge`
--
ALTER TABLE `charge`
  ADD CONSTRAINT `fk_charge_employe1` FOREIGN KEY (`employe_id`) REFERENCES `employe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD CONSTRAINT `fk_Contrat_employe1` FOREIGN KEY (`employe_id`) REFERENCES `employe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Contrat_statut_contrat1` FOREIGN KEY (`statut_contrat_id`) REFERENCES `statut_contrat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Contrat_type_contrat1` FOREIGN KEY (`type_contrat_id`) REFERENCES `type_contrat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_type_taitement_salaire_in_contrat` FOREIGN KEY (`type_traitement_salaire_id`) REFERENCES `type_traitement_salaire` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `fk_departement_departement1` FOREIGN KEY (`departement_id`) REFERENCES `departement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `fk_employe_Département1` FOREIGN KEY (`Département_id`) REFERENCES `departement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employe_categorie1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employe_classe1` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employe_echelon1` FOREIGN KEY (`echelon_id`) REFERENCES `echelon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `employe_has_prime`
--
ALTER TABLE `employe_has_prime`
  ADD CONSTRAINT `fk_employe_has_prime_employe1` FOREIGN KEY (`employe_id`) REFERENCES `employe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employe_has_prime_prime1` FOREIGN KEY (`indemnite_id`) REFERENCES `indemnite` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `grille`
--
ALTER TABLE `grille`
  ADD CONSTRAINT `fk_grille_categorie1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grille_classe1` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grille_echelon1` FOREIGN KEY (`echelon_id`) REFERENCES `echelon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `salaire`
--
ALTER TABLE `salaire`
  ADD CONSTRAINT `fk_salaire_calendrier1` FOREIGN KEY (`calendrier_id`) REFERENCES `calendrier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salaire_employe1` FOREIGN KEY (`employe_id`) REFERENCES `employe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salaire_grille1` FOREIGN KEY (`grille_id`) REFERENCES `grille` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `salaire_has_prime`
--
ALTER TABLE `salaire_has_prime`
  ADD CONSTRAINT `fk_salaire_has_prime_prime1` FOREIGN KEY (`prime_id`) REFERENCES `prime` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salaire_has_prime_salaire1` FOREIGN KEY (`salaire_id`) REFERENCES `salaire` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_employes1` FOREIGN KEY (`employe_id`) REFERENCES `employe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_profil1` FOREIGN KEY (`profil_id`) REFERENCES `profil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
