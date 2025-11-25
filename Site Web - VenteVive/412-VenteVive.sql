-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 13 mai 2024 à 14:20
-- Version du serveur : 10.11.4-MariaDB-1~deb12u1
-- Version de PHP : 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dnguyen003`
--

-- --------------------------------------------------------

--
-- Structure de la table `Vavis`
--

CREATE TABLE `Vavis` (
  `id` int(11) NOT NULL,
  `id_Vmembre` int(11) NOT NULL,
  `id_Vproduit` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Vavis`
--

INSERT INTO `Vavis` (`id`, `id_Vmembre`, `id_Vproduit`, `note`, `commentaire`, `date`) VALUES
(1, 4, 0, 3, 'sdfsdf', '2024-05-07 13:33:48'),
(2, 4, 0, 2, 'cool', '2024-05-07 13:34:20'),
(3, 4, 1, 3, 'cv', '2024-05-07 13:34:53'),
(4, 4, 5, 3, 'vvv', '2024-05-07 13:35:22'),
(5, 4, 5, 5, 'J achate ', '2024-05-07 13:56:37');

-- --------------------------------------------------------

--
-- Structure de la table `Vcategorie`
--

CREATE TABLE `Vcategorie` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Vcategorie`
--

INSERT INTO `Vcategorie` (`id`, `nom`, `description`) VALUES
(1, 'Cuisines', 'Plongez dans l\'art culinaire avec notre sélection exceptionnelle d\'articles de cuisine et d\'ustensiles de cuisine de première qualité. Des casseroles et poêles antiadhésives aux gadgets de cuisine innovants, nous avons tout ce dont vous avez besoin pour transformer votre cuisine en un véritable sanctuaire gastronomique. Que vous soyez un chef amateur ou un professionnel passionné, notre assortiment de produits de cuisine vous offre les outils nécessaires pour libérer votre créativité culinaire et épater vos convives.'),
(2, 'Electroménager', 'Découvrez une gamme complète d\'appareils électroménagers dernier cri pour simplifier votre quotidien. Des machines à laver économes en énergie aux robots culinaires polyvalents, notre sélection d\'électroménager de qualité vous offre des performances fiables et une efficacité inégalée. Faites de votre maison un foyer moderne et fonctionnel avec nos appareils conçus pour répondre à tous vos besoins domestiques'),
(3, 'Vêtements', 'Explorez un univers de style et d\'élégance avec notre collection de vêtements pour hommes, femmes et enfants. Des tenues décontractées aux ensembles sophistiqués, notre sélection de vêtements de haute qualité allie confort, tendance et qualité. Que vous recherchiez le parfait jean décontracté, une robe de soirée élégante ou des vêtements pour toute la famille, notre boutique en ligne est votre destination mode incontournable.'),
(4, 'Marque Porche', 'Nous sélectionnons les meilleures Porche pour vous. \r\nNotre expertise à votre service:\r\n-Une analyse objective des prix\r\n-Une visibilité complète sur l\'historique du véhicule\r\n-Votre budget maîtrisé avec notre simulateur de financement\r\n-Une projection claire sur les futurs entretiens de votre Porche'),
(5, 'Beauté Premium ', 'Beauté Premium incarne l\'élégance intemporelle et l\'excellence dans les soins de la peau. \r\nChaque produit est méticuleusement formulé pour offrir une expérience luxueuse et des résultats visibles. Inspiré par les dernières avancées scientifiques, Beauté Premium célèbre la beauté naturelle à travers des ingrédients de haute qualité et des textures somptueuses. \r\nDécouvrez l\'essence du raffinement et de la sophistication avec Beauté Premium.');

-- --------------------------------------------------------

--
-- Structure de la table `Vcommande`
--

CREATE TABLE `Vcommande` (
  `id` int(11) NOT NULL,
  `id_Vmembre` int(11) NOT NULL,
  `date_commande` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Vmembre`
--

CREATE TABLE `Vmembre` (
  `id` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `motdepasse` text NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `email` text NOT NULL,
  `datecreation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Vmembre`
--

INSERT INTO `Vmembre` (`id`, `pseudo`, `motdepasse`, `nom`, `prenom`, `email`, `datecreation`) VALUES
(1, 'sasow', '$2y$10$WM98X5xtDh3pZwUoNpfWjeqx/hlRU2.DxkD/Now.5xHtv42KUUEnm', 'salif', 'sow', 'sowsalifk02@gmail.com', '2024-04-12 14:30:02'),
(2, 'sgarcia', '$2y$10$WpiDaYzpv3uQ9dFYlDScAOuOnD.TnqJCnQu1MAe.MxcGw0d3LAv2W', 'garcia', 'silvia', 'sgarcia@gmail.com', '2024-04-12 14:30:53'),
(3, 'duclam', '$2y$10$.UHsyS/v72A299vQqoWEpO.g3Bofa7vb.jz0Bbn2Lt.JYI6h78oue', 'NGUYEN', 'Duc Lam', 'duclam@gmail.com', '2024-04-12 14:31:23'),
(4, 'ss', '$2y$10$.7jKR1E/Ls7vRyNpHUAH.ucwP9lsqQ076cyrkZ37rYheET8cOdWMq', 'sow', 'salif', 'ss02@gmail.com', '2024-05-07 11:54:49'),
(5, 'sossa', '$2y$10$44qgdIVXzZYQmxhvttqeFe4n0o9.nsBx7uuZeLEFBAnQbfFvQlQmO', 'sossa', 'ss', 'ss02@gmail.com', '2024-05-13 15:36:29');

-- --------------------------------------------------------

--
-- Structure de la table `Vpanier`
--

CREATE TABLE `Vpanier` (
  `id` int(11) NOT NULL,
  `id_Vmembre` int(11) NOT NULL,
  `date_commande` datetime DEFAULT NULL,
  `date_paiement` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Vpanier_produit`
--

CREATE TABLE `Vpanier_produit` (
  `id` int(11) NOT NULL,
  `id_Vpanier` int(11) NOT NULL,
  `id_Vproduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Vproduit`
--

CREATE TABLE `Vproduit` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `stock` int(11) NOT NULL,
  `id_Vcategorie` int(11) NOT NULL,
  `dateajout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Vproduit`
--

INSERT INTO `Vproduit` (`id`, `nom`, `description`, `prix`, `stock`, `id_Vcategorie`, `dateajout`) VALUES
(0, 'Pantalon Verte', 'Pantalon neuf', 20, 2, 3, '2024-04-12 14:20:19'),
(1, 'Blouson', 'Coollll', 50, 2, 3, '2024-04-18 14:39:01'),
(5, 'Porche', '333', 39000, 1, 4, '2024-05-07 11:07:22'),
(9, 'Friteuse sans huile', 'Points forts :\r\n\r\nFonctions spéciales\r\n    100 recettes à votre disposition\r\nPuissance électrique\r\n    1500W\r\nCapacité\r\n    Capacité de 5L/5.28QT\r\nNombre de programmes\r\n    11 programmes de cuisson prédéfinis + 1 cuisine ', 80, 6, 2, '2024-05-13 15:46:36'),
(10, 'Cuisine équipée blanche IPOMA blanc Mat ', ' Modèle de Cuisine IPOMA Blanc mat\r\n\r\n    #Cuisine équipée blanche IPOMA blanc Mat <br />Design avec poignée intégrée, pour un look très contemporain !\r\n    #Cuisine équipée blanche IPOMA blanc Mat <br />Design avec poignée intégrée, pour un look très contemporain !\r\n    #Cuisine équipée blanche IPOMA blanc Mat <br />Design avec poignée intégrée, pour un look très contemporain ! \r\n\r\n• Façade polymère réversible décor mat blanc.\r\n• Vide sanitaire pour passage facile des tuyaux.\r\n• Pieds réglables de 14,5 à 20cm (500kg/pieds).\r\n• Garantie 15 ans.', 600, 10, 1, '2024-05-13 15:50:14'),
(11, 'Crème jeunesse Immortelle Divine 50ml ', 'Ce soin anti-âge global est enrichi en extrait d’Immortelle bio de Corse, une alternative naturelle au Rétinol.\r\n\r\n \r\n\r\nReformulée, cette crème aide à combattre les 7 signes visibles de l’âge : rides, fermeté, densité de la peau, teint inégal, grain de peau irrégulier, manque de radiance et maintenant les taches de vieillesse.\r\n\r\n \r\n\r\n\r\nGrâce à sa texture cachemire, 100% des femmes déclarent la crème enveloppe la peau d’un voile de douceur et laisse un fini léger.\r\n\r\n    -19% de rides après 28 jours d\'utilisation*.\r\n    85% des consommateurs trouvent leurs taches brunes moins visibles**.\r\n\r\n \r\n\r\nPackaging en verre composé à 40% de verre recyclé.', 90, 14, 5, '2024-05-13 16:00:11');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Vavis`
--
ALTER TABLE `Vavis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Vmembre_id` (`id_Vmembre`),
  ADD KEY `Vproduit_id` (`id_Vproduit`);

--
-- Index pour la table `Vcategorie`
--
ALTER TABLE `Vcategorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Vcommande`
--
ALTER TABLE `Vcommande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Vmembre` (`id_Vmembre`);

--
-- Index pour la table `Vmembre`
--
ALTER TABLE `Vmembre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Vpanier`
--
ALTER TABLE `Vpanier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Vmembre` (`id_Vmembre`);

--
-- Index pour la table `Vpanier_produit`
--
ALTER TABLE `Vpanier_produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Vpanier` (`id_Vpanier`),
  ADD KEY `id_Vproduit` (`id_Vproduit`);

--
-- Index pour la table `Vproduit`
--
ALTER TABLE `Vproduit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Vcategorie` (`id_Vcategorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Vavis`
--
ALTER TABLE `Vavis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Vcategorie`
--
ALTER TABLE `Vcategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Vcommande`
--
ALTER TABLE `Vcommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Vmembre`
--
ALTER TABLE `Vmembre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Vpanier`
--
ALTER TABLE `Vpanier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Vpanier_produit`
--
ALTER TABLE `Vpanier_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Vproduit`
--
ALTER TABLE `Vproduit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Vavis`
--
ALTER TABLE `Vavis`
  ADD CONSTRAINT `Vavis_ibfk_1` FOREIGN KEY (`id_Vproduit`) REFERENCES `Vproduit` (`id`),
  ADD CONSTRAINT `Vavis_ibfk_2` FOREIGN KEY (`id_Vmembre`) REFERENCES `Vmembre` (`id`);

--
-- Contraintes pour la table `Vcommande`
--
ALTER TABLE `Vcommande`
  ADD CONSTRAINT `Vcommande_ibfk_1` FOREIGN KEY (`id_Vmembre`) REFERENCES `Vmembre` (`id`);

--
-- Contraintes pour la table `Vpanier`
--
ALTER TABLE `Vpanier`
  ADD CONSTRAINT `Vpanier_ibfk_1` FOREIGN KEY (`id_Vmembre`) REFERENCES `Vmembre` (`id`);

--
-- Contraintes pour la table `Vproduit`
--
ALTER TABLE `Vproduit`
  ADD CONSTRAINT `Vproduit_ibfk_1` FOREIGN KEY (`id_Vcategorie`) REFERENCES `Vcategorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
