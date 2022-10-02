-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 24 fév. 2022 à 20:36
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `inter`
--

-- --------------------------------------------------------

--
-- Structure de la table `generateevent`
--

CREATE TABLE `generateevent` (
  `idEvent` int(11) NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `link` varchar(200) NOT NULL DEFAULT '#',
  `timeFrame` int(11) NOT NULL,
  `imagename` varchar(63) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Déchargement des données de la table `generateevent`
--

INSERT INTO `generateevent` (`idEvent`, `title`, `text`, `link`, `timeFrame`, `imagename`) VALUES
(32, 'centrespatial-polytechnique', 'Le projet vise à à concevoir, placer et maintenir en orbite basse un nanosatellite propulsé. il s’inscrit dans le contexte d’un intérêt croissant porté aux orbites très basses, pour leurs nombreux intérêts (temps de latence des communications réduit, meilleure résolution, coûts de lancement moindres…).\r\n\r\nLe satellite serait lancé depuis l’ISS et descendrait jusqu’à l’altitude de 300km. Cette descente repose sur la technique d’aerobreaking, qui consiste à utiliser la traînée atmosphérique afin de freiner le satellite, en orientant la plus grande surface perpendiculairement à la trajectoire pour maximiser la force de traînée.\r\n\r\nUne fois à 300km d’altitude, la mission de maintient à poste commence. À intervalles de temps réguliers, le nanosatellite amorcera une phase de descente pour atteindre une altitude plus basse de 10km. Le vol s’effectuera donc par paliers pour une durée souhaitée de 6 mois : la mission sera prolongée en cas de succès.\r\nRéussir à fournir la puissance nécessaire représente donc un véritable challenge, qui demande une étude précise des capacités de récupération d’énergie par les panneaux solaires, couplés à l’utilisation de la batterie. Il faut aussi saisir les conséquences d’une telle consommation d’énergie, notamment d’un point de vue thermique : cela demande une bonne capacité d’évacuation de la chaleur pour éviter le dysfonctionnement des composants.', 'https://centrespatial-polytechnique.fr/ionsat/', 1645711120, '../Project_Web/images/image32.png'),
(33, 'développeur web', 'Un développeur web est un informaticien spécialisé dans la programmation ou expressément impliqué dans le développement des applications du World Wide Web, ou des applications qui sont exécutées à partir d\'un serveur web sur un navigateur web et qui utilisent le protocole HTTP comme vecteur de transmission de l\'information.\r\nLes développeurs Web peuvent travailler dans différents types d\'organisations, y compris les grandes sociétés et les gouvernements, les petites et moyennes entreprises, ou en indépendants comme freelances. Certains développeurs web travaillent pour un organisme comme employés à temps plein, tandis que d\'autres peuvent travailler comme des consultants indépendants ou comme sous-traitants pour une agence d\'emploi, une agence Web ou une ESN. Les développeurs Web interviennent à la fois côté serveur et au niveau front-end. Cela implique généralement la mise en œuvre de tous les éléments visuels que les utilisateurs peuvent voir et utiliser dans l\'application web, ainsi que tous les services web et API qui sont nécessaires pour alimenter le front-end. Selon le type de travail de développement, le langage de programmation utilisé, l\'emplacement et le niveau d\'ancienneté, les salaires annuels des développeurs web dans de nombreuses grandes régions métropolitaines dépassent régulièrement les 100 000 $ américains1.', 'https://fr.wikipedia.org/wiki/D%C3%A9veloppeur_web', 1645711563, '../Project_Web/images/image33.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` varchar(128) NOT NULL,
  `pwdResetSelector` varchar(128) NOT NULL,
  `pwdResetToken` varchar(128) NOT NULL,
  `pwdResetExpires` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(14, 'zayed.herma@polytechnique.fr', '9ee95ab5c66d10cc', '9db882f0d07bd2c5fca27ca290210d0d995fccc7', '1644024046'),
(103, 'emmanuel.gnabeyeu-mbiada@polytechnique.edu', '5eafb438a7ffa830', 'dfba70f25854358723fc9c08987cc2e0ee32ef59', '1645717341');

-- --------------------------------------------------------

--
-- Structure de la table `registerlink`
--

CREATE TABLE `registerlink` (
  `registerId` int(11) NOT NULL,
  `registerEmail` varchar(128) NOT NULL,
  `registerLogin` varchar(100) NOT NULL,
  `registerSelector` varchar(128) NOT NULL,
  `registerToken` varchar(128) NOT NULL,
  `registerExpires` text NOT NULL,
  `profileimage` varchar(128) NOT NULL DEFAULT '../Project_Web/images/avatar_2x.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `registerlink`
--

INSERT INTO `registerlink` (`registerId`, `registerEmail`, `registerLogin`, `registerSelector`, `registerToken`, `registerExpires`, `profileimage`) VALUES
(40, 'Zayed.Herma@polytechnique.edu', 'Zayed.Herma', 'b3f0dc2cf925d37a', 'cb9dbeb80ff9dfce187d96174ec0eb12f0d4b497', '1645715169', '../Project_Web/images/avatar_2x.png'),
(41, 'Zarma@polytechnique.edu', 'Zarma', '39168b7d0a541674', '6455097db39ec7488fd529dcd114bb4804a69ed3', '1645717418', '../Project_Web/images/avatar_2x.png'),
(42, 'eyeu-mbiada@polytechnique.edu', 'eyeu-mbiada', '0cdcfb6f59697225', '9104e1b371f36ba1e8c04c96f4470c3d6a632566', '1645717430', '../Project_Web/images/avatar_2x.png'),
(43, 'a@polytechnique.edu', 'a', 'cd61f03cdbf09cb2', '945a3df69e880fda7ebbd4b844b88ad274a29e64', '1645717466', '../Project_Web/images/avatar_2x.png'),
(44, 'emmanue-mbiada@polytechnique.edu', 'emmanue-mbiada', 'a35ba1d625fcfdc2', '7794cfb7c576fbb03bbdaa5cdb81f3c33eb6ba27', '1645717476', '../Project_Web/images/avatar_2x.png'),
(45, 'emmanada@polytechnique.edu', 'emmanada', '2efd7739275d6952', 'af5b69cf03a12b1021c7bf8feed9fbd8d4e11d2f', '1645717485', '../Project_Web/images/avatar_2x.png'),
(46, 'ma@polytechnique.edu', 'ma', '919d32a16c134898', '29253a2813f5cb95b01bd1734e534854149a2984', '1645717490', '../Project_Web/images/avatar_2x.png');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `login` varchar(64) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `mdp` varchar(128) NOT NULL,
  `promotion` varchar(11) NOT NULL,
  `naissance` date NOT NULL,
  `email` varchar(128) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `profile` varchar(11) NOT NULL DEFAULT 'nonadmin',
  `phone` varchar(50) NOT NULL,
  `nationality` text NOT NULL,
  `address` varchar(128) NOT NULL,
  `localisation` text NOT NULL,
  `aboutme` varchar(200) NOT NULL,
  `profileimage` varchar(200) NOT NULL DEFAULT '../Project_Web/images/avatar_2x.png',
  `skills` varchar(250) NOT NULL,
  `url` varchar(200) NOT NULL DEFAULT '#'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`login`, `nom`, `prenom`, `mdp`, `promotion`, `naissance`, `email`, `sexe`, `profile`, `phone`, `nationality`, `address`, `localisation`, `aboutme`, `profileimage`, `skills`, `url`) VALUES
('abissi.dibi', 'dibi', 'abissi', '3b26eb86f8dca00b54aa8223fb8a25daa385d6fa', '2020', '1999-03-01', 'abissi.dibi@polytechnique.edu', 'M', 'nonadmin', '+33123456789', 'Cote d\'Ivoire', '09 boulevard des marechaux', 'Palaiseau,France', 'basket player', '../Project_Web/images/avatar_2x.png', 'MAP,INFO,', '#'),
('awa.khouna', 'khouna', 'awa', '3b26eb86f8dca00b54aa8223fb8a25daa385d6fa', '2020', '2000-03-02', 'awa.khouna@polytechnique.edu', 'M', 'nonadmin', '+33123456789', 'Mauritania', '09 boulevard des marechaux', 'Palaiseau,France', 'Hard debeger', '../Project_Web/images/avatar_2x.png', 'Python,Java,PHP', '#'),
('baptiste.desprez', 'desprez', 'batiste', '940a41592fd45fc57dc52386a809b2b35dab9ba3', '0000', '2022-02-28', 'baptiste.desprez@polytechnique.edu', 'M', 'nonadmin', '+33123456789', 'France', 'Ecole Polytechnique', 'Palaiseau,France', 'Ingénieur Système', '../Project_Web/images/avatar_2x.png', 'sécurité informatique ', '#'),
('dereck.meyam-ewane', 'meyam-ewane', 'dereck', '3b26eb86f8dca00b54aa8223fb8a25daa385d6fa', '2020', '1999-02-27', 'dereck.meyam-ewane@polytechnique.edu', 'M', 'nonadmin', '+33123456789', 'Cameroun', '9 boulevard des marechaux', 'Palaiseau,France', 'rugby player', '../Project_Web/images/avatar_2x.png', 'ECO,MAP', '#'),
('emmanuel.gnabeyeu-mbiada', 'gnabeyeu-mbiada', 'emmanuel', '3b26eb86f8dca00b54aa8223fb8a25daa385d6fa', '2020', '1999-02-26', 'emmanuel.gnabeyeu-mbiada@polytechnique.edu', 'M', 'admin', '+225759255606', 'Cameroun', '09 Boulevard des marechaux', 'Palaiseau,France ', 'Hard worker', '../Project_Web/images/avatar_2x.png', 'MAP,INF,ECO,deep Learning', 'https://www.linkedin.com/in/emmanuel-gnabeyeu-18b2bb20b/?originalSubdomain=fr'),
('franck.signe-talla', 'sugne-talla', 'franck', '3b26eb86f8dca00b54aa8223fb8a25daa385d6fa', '2020', '1999-03-03', 'franck.signe-talla@polytechnique.edu', 'M', 'nonadmin', '+33123456789', 'Cameroun', '09 boulevard des marechaux', 'Palaiseau,France', 'Basketball player and I am the tallest one in Polytechnique', '../Project_Web/images/avatar_2x.png', 'INF,MAP', '#'),
('mohamed.ahmed-maloum', 'ahmed-maloum', 'mohamed', '3b26eb86f8dca00b54aa8223fb8a25daa385d6fa', '2020', '2022-03-01', 'mohamed.ahmed-maloum@polytechnique.edu', 'M', 'nonadmin', '+33123456789', 'Mauritania', '9 boulevard des marechaux', 'paris,France', 'Hard worker', '../Project_Web/images/avatar_2x.png', 'Python', '#'),
('olivier.serre', 'serre', 'olivier', 'f128f74d470e3118f7c7726fa3cf5b3675d884c9', '0000', '2022-02-24', 'olivier.serre@polytechnique.edu', 'M', 'admin', '+331 57 27 94 18', 'France', 'Université Paris Diderot - Paris 7, Case 7014, 75205 Paris Cedex 13 ', 'Paris,France', 'I am a full-time CNRS researcher in the Automata and Applications group at IRIF (Institut de Recherche en Informatique Fondamentale) in Paris, France.', '../Project_Web/images/olivier.serre.png', ' JAVA,PHP', 'https://www.irif.fr/~serre/'),
('sinitandjon.yeo', 'yeo', 'sinitand', '3b26eb86f8dca00b54aa8223fb8a25daa385d6fa', '2020', '1999-02-25', 'sinitandjon.yeo@polytechnique.edu', 'M', 'nonadmin', '+225759255606', 'Côte d\'Ivoire', '09 Boulevard des marechaux', 'Palaiseau,France', 'I am a boxing man ', '../Project_Web/images/avatar_2x.png', 'Python,MAP', '#'),
('Zayed.Herma', 'herma', 'zayed', '52136ef85264f020090c971ae8b454b48a971cb4', '2020', '2022-02-27', 'Zayed.Herma@polytechnique.edu', 'M', 'admin', '+33337592234', 'Mauritania', '9 Boulevard des marechaux', 'Atar', 'yes', '../Project_Web/images/zayed.herma.jpeg', 'python', 'https://synapses.polytechnique.fr/');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `generateevent`
--
ALTER TABLE `generateevent`
  ADD PRIMARY KEY (`idEvent`);

--
-- Index pour la table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Index pour la table `registerlink`
--
ALTER TABLE `registerlink`
  ADD PRIMARY KEY (`registerId`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `generateevent`
--
ALTER TABLE `generateevent`
  MODIFY `idEvent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT pour la table `registerlink`
--
ALTER TABLE `registerlink`
  MODIFY `registerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
