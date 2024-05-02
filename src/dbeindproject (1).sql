-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 02 mei 2024 om 08:05
-- Serverversie: 5.7.36
-- PHP-versie: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbeindproject`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblcart`
--

DROP TABLE IF EXISTS `tblcart`;
CREATE TABLE IF NOT EXISTS `tblcart` (
  `productid` int(11) NOT NULL,
  `gebruikerid` int(11) NOT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblcart`
--

INSERT INTO `tblcart` (`productid`, `gebruikerid`, `aantal`) VALUES
(15, 8, 2),
(15, 8, 2),
(15, 8, 1),
(16, 8, 1),
(16, 8, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblcategorie`
--

DROP TABLE IF EXISTS `tblcategorie`;
CREATE TABLE IF NOT EXISTS `tblcategorie` (
  `categorienaam` text NOT NULL,
  `doelgroep` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblcategorie`
--

INSERT INTO `tblcategorie` (`categorienaam`, `doelgroep`) VALUES
('Armani', 'Heren'),
('Rolex', 'Dames'),
('Omega', 'Heren');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblgebruikers`
--

DROP TABLE IF EXISTS `tblgebruikers`;
CREATE TABLE IF NOT EXISTS `tblgebruikers` (
  `gebruikerid` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` text CHARACTER SET utf8mb4 NOT NULL,
  `naam` text CHARACTER SET utf8mb4 NOT NULL,
  `wachtwoord` text CHARACTER SET utf8mb4 NOT NULL,
  `email` text CHARACTER SET utf8mb4 NOT NULL,
  `profielfoto` text CHARACTER SET utf8mb4 NOT NULL,
  `beschrijving` text CHARACTER SET utf8mb4 NOT NULL,
  `Admin` int(11) NOT NULL,
  PRIMARY KEY (`gebruikerid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblgebruikers`
--

INSERT INTO `tblgebruikers` (`gebruikerid`, `voornaam`, `naam`, `wachtwoord`, `email`, `profielfoto`, `beschrijving`, `Admin`) VALUES
(5, 'Mohamed', 'Aoulad Abdelkader', 'mohamed', 'Mohamed@gmail.com', 'Brabus.jpg', 'Ik ben een horloge liefhebber. Armani', 1),
(2, 'Yoru', 'Agent', 'Yoru', 'Yoru@gmail.com', 'Yoru.PNG', 'I am the best agent.', 0),
(3, 'Raze', 'Agent', 'Raze', 'Raze@gmail.com', 'Raze.PNG', 'I am Raze a friend of Yoru ewa', 0),
(6, 'Imad', 'Berrag', 'berg', 'imad@gmail.com', 'arend.jpg', 'Ik hou van online shoppen.', 0),
(7, 'Abdelilah', 'El hach', 'Bomj', 'abdel@gmail.com', 'bomj.jpg', 'azerty', 0),
(8, 'Dragon 2', 'Slayer', 'dragon', 'Jo@gmail.com', 'Dragon.jpg', 'Hey', 0),
(10, 'Steven', 'Geerts', 'geerts', 'geerts@gmail.com', 'arend.jpg', 'Ewa', 0),
(11, 'Imad Edine', 'Berrag', '$2y$10$EMhU0.PfxYSZ0rcWFw/Bou1SS282ggOzrMjvwArbWz8pDOBAAihom', 'Imad@berrag.edinecom', 'arend.jpg', 'Ik ben Imad. Ik ben een goede berg beklimmer.', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblkleur`
--

DROP TABLE IF EXISTS `tblkleur`;
CREATE TABLE IF NOT EXISTS `tblkleur` (
  `kleur` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblkleur`
--

INSERT INTO `tblkleur` (`kleur`) VALUES
('Zwart'),
('Blauw'),
('Goud'),
('Zilver'),
('Groen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblproducten`
--

DROP TABLE IF EXISTS `tblproducten`;
CREATE TABLE IF NOT EXISTS `tblproducten` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `foto` text CHARACTER SET utf8mb4 NOT NULL,
  `naam` text CHARACTER SET utf8mb4 NOT NULL,
  `prijs` decimal(10,0) NOT NULL,
  `beschrijving` text CHARACTER SET utf8mb4 NOT NULL,
  `categorie` text CHARACTER SET utf8mb4 NOT NULL,
  `kleur` text NOT NULL,
  PRIMARY KEY (`productid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblproducten`
--

INSERT INTO `tblproducten` (`productid`, `foto`, `naam`, `prijs`, `beschrijving`, `categorie`, `kleur`) VALUES
(1, 'Armani.jpg', 'Emporio Armani', '250', 'Een nieuwe Armani is toegevoegd.', 'Armani', 'Zwart'),
(2, 'Armanisilver.jpg', 'Emporio Armani Silver', '350', 'Dit is een ander horloge van Armani.', 'Armani', 'Zilver'),
(7, 'Rolex1.JPG', 'Rolex Submariner Gold', '4500', 'Een gouden horloge van het merk Rolex.', 'Rolex', 'Goud'),
(15, 'Omega Seamaster.JPG', 'Omega Seamaster 3500 ', '11900', 'Dit is het 2de exemplaar. ', 'Omega', 'Groen'),
(14, 'Omega.JPG', 'Omega Speed Classic 35', '47000', 'Een prachtig exemplaar', 'Omega', 'Goud'),
(16, 'rolex oyster1.jpg', 'Rolex Oyster', '40780', 'Rolex horloge dat waterproof is.', 'Rolex', 'Zilver');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblrating`
--

DROP TABLE IF EXISTS `tblrating`;
CREATE TABLE IF NOT EXISTS `tblrating` (
  `user_name` text NOT NULL,
  `user_rating` int(11) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
