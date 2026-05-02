-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2026 at 02:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eemsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitet`
--

CREATE TABLE `aktivitet` (
  `id` int(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `content` varchar(255) NOT NULL,
  `titull` varchar(255) NOT NULL,
  `kategoria` varchar(255) NOT NULL,
  `ambient` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detyrat`
--

CREATE TABLE `detyrat` (
  `id` int(255) NOT NULL,
  `titulli` varchar(255) NOT NULL,
  `lendaID` int(255) NOT NULL,
  `klasID` int(255) NOT NULL,
  `dataFillimit` date NOT NULL,
  `dataMbarimit` date NOT NULL,
  `pershkrimi` text NOT NULL,
  `mesuesID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `klasa`
--

CREATE TABLE `klasa` (
  `klasaID` int(255) NOT NULL,
  `emer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klasa`
--

INSERT INTO `klasa` (`klasaID`, `emer`) VALUES
(1, '10A'),
(2, '10B'),
(3, '11E'),
(4, '11F'),
(5, '12A'),
(6, '12B'),
(7, '12C'),
(8, '12D'),
(9, '12E'),
(10, '12F'),
(11, '12G'),
(12, '12H'),
(13, '12I'),
(14, '12J');

-- --------------------------------------------------------

--
-- Table structure for table `klasalenda`
--

CREATE TABLE `klasalenda` (
  `id` int(255) NOT NULL,
  `klasID` int(255) NOT NULL,
  `lendaID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klasalenda`
--

INSERT INTO `klasalenda` (`id`, `klasID`, `lendaID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 8),
(6, 1, 9),
(7, 2, 1),
(8, 2, 2),
(9, 2, 3),
(10, 2, 4),
(11, 2, 8),
(12, 2, 9),
(13, 3, 1),
(14, 3, 2),
(15, 3, 5),
(16, 3, 6),
(17, 3, 7),
(18, 3, 8),
(19, 3, 9),
(20, 4, 1),
(21, 4, 2),
(22, 4, 5),
(23, 4, 6),
(24, 4, 7),
(25, 4, 8),
(26, 4, 9),
(27, 5, 1),
(28, 5, 2),
(29, 5, 3),
(30, 5, 4),
(31, 5, 5),
(32, 5, 8),
(33, 5, 9),
(34, 5, 10),
(35, 6, 1),
(36, 6, 2),
(37, 6, 3),
(38, 6, 4),
(39, 6, 5),
(40, 6, 8),
(41, 6, 9),
(42, 6, 10),
(43, 7, 1),
(44, 7, 2),
(45, 7, 3),
(46, 7, 4),
(47, 7, 5),
(48, 7, 8),
(49, 7, 9),
(50, 7, 10),
(51, 8, 1),
(52, 8, 2),
(53, 8, 3),
(54, 8, 4),
(55, 8, 5),
(56, 8, 8),
(57, 8, 9),
(58, 8, 10),
(59, 9, 1),
(60, 9, 2),
(61, 9, 5),
(62, 9, 6),
(63, 9, 7),
(64, 9, 8),
(65, 9, 9),
(66, 9, 11),
(67, 9, 12),
(68, 9, 13),
(69, 9, 14),
(70, 9, 15),
(71, 10, 1),
(72, 10, 2),
(73, 10, 5),
(74, 10, 6),
(75, 10, 7),
(76, 10, 8),
(77, 10, 9),
(78, 10, 11),
(79, 10, 12),
(80, 10, 13),
(81, 10, 14),
(82, 10, 15),
(83, 11, 1),
(84, 11, 2),
(85, 11, 5),
(86, 11, 6),
(87, 11, 7),
(88, 11, 8),
(89, 11, 9),
(90, 11, 11),
(91, 11, 12),
(92, 11, 13),
(93, 11, 14),
(94, 11, 15),
(95, 12, 1),
(96, 12, 2),
(97, 12, 5),
(98, 12, 6),
(99, 12, 7),
(100, 12, 8),
(101, 12, 9),
(102, 12, 11),
(103, 12, 12),
(104, 12, 13),
(105, 12, 14),
(106, 12, 15),
(107, 13, 1),
(108, 13, 2),
(109, 13, 5),
(110, 13, 6),
(111, 13, 7),
(112, 13, 8),
(113, 13, 9),
(114, 13, 11),
(115, 13, 12),
(116, 13, 13),
(117, 13, 14),
(118, 13, 15),
(119, 14, 1),
(120, 14, 2),
(121, 14, 5),
(122, 14, 6),
(123, 14, 7),
(124, 14, 8),
(125, 14, 9),
(126, 14, 11),
(127, 14, 12),
(128, 14, 13),
(129, 14, 14),
(130, 14, 15);

-- --------------------------------------------------------

--
-- Table structure for table `kualifikimemesuesi`
--

CREATE TABLE `kualifikimemesuesi` (
  `id` int(255) NOT NULL,
  `mesuesID` int(255) NOT NULL,
  `titulli` varchar(255) NOT NULL,
  `viti` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lenda`
--

CREATE TABLE `lenda` (
  `id` int(255) NOT NULL,
  `emri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lenda`
--

INSERT INTO `lenda` (`id`, `emri`) VALUES
(1, 'Informatike'),
(2, 'Matematike'),
(3, 'Fizikë'),
(4, 'Kimi'),
(5, 'Biologji'),
(6, 'Histori'),
(7, 'Gjeografi'),
(8, 'Anglisht'),
(9, 'Gjuhë Shqipe'),
(10, 'Informatikë e Avancuar'),
(11, 'Edukatë Qytetare'),
(12, 'Art Figurativ'),
(13, 'Muzikë'),
(14, 'Edukatë Fizike'),
(15, 'Ekonomi'),
(16, 'Filozofi'),
(17, 'Sociologji');

-- --------------------------------------------------------

--
-- Table structure for table `lidhjamesues`
--

CREATE TABLE `lidhjamesues` (
  `id` int(255) NOT NULL,
  `mesuesID` int(255) NOT NULL,
  `klasID` int(255) NOT NULL,
  `lendaID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` int(255) NOT NULL,
  `derguesi` varchar(255) NOT NULL,
  `marresi` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mesues`
--

CREATE TABLE `mesues` (
  `mesuesID` int(255) NOT NULL,
  `emerMbiemer` varchar(255) NOT NULL,
  `gjinia` varchar(255) NOT NULL,
  `datelindja` date NOT NULL,
  `nrTel` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fjalekalimFillestare` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mesues`
--

INSERT INTO `mesues` (`mesuesID`, `emerMbiemer`, `gjinia`, `datelindja`, `nrTel`, `email`, `fjalekalimFillestare`) VALUES
(1, 'Ardian Kodra', 'Mashkull', '1981-02-14', 600300001, 'ardian.kodra@mail.com', 'mesues123'),
(2, 'Dorian Leka', 'Mashkull', '1979-06-18', 600300002, 'dorian.leka@mail.com', 'mesues123'),
(3, 'Gent Rrushi', 'Mashkull', '1975-11-03', 600300003, 'gent.rrushi@mail.com', 'mesues123'),
(4, 'Ermal Vora', 'Mashkull', '1980-09-21', 600300004, 'ermal.vora@mail.com', 'mesues123'),
(5, 'Alban Gjoka', 'Mashkull', '1978-03-10', 600300005, 'alban.gjoka@mail.com', 'mesues123'),
(6, 'Leon Vata', 'Mashkull', '1977-07-07', 600300006, 'leon.vata@mail.com', 'mesues123'),
(7, 'Arjan Zefi', 'Mashkull', '1982-12-12', 600300007, 'arjan.zefi@mail.com', 'mesues123'),
(8, 'Julian Bici', 'Mashkull', '1976-01-25', 600300008, 'julian.bici@mail.com', 'mesues123'),
(9, 'Rigers Hida', 'Mashkull', '1983-08-30', 600300009, 'rigers.hida@mail.com', 'mesues123'),
(10, 'Elton Shima', 'Mashkull', '1974-05-09', 600300010, 'elton.shima@mail.com', 'mesues123'),
(11, 'Anisa Duka', 'Femër', '1980-04-14', 600300011, 'anisa.duka@mail.com', 'mesues123'),
(12, 'Blerina Kelmendi', 'Femër', '1979-06-22', 600300012, 'blerina.kelmendi@mail.com', 'mesues123'),
(13, 'Dorina Pasha', 'Femër', '1982-10-10', 600300013, 'dorina.pasha@mail.com', 'mesues123'),
(14, 'Megi Vaso', 'Femër', '1978-02-02', 600300014, 'megi.vaso@mail.com', 'mesues123'),
(15, 'Sara Dema', 'Femër', '1977-07-19', 600300015, 'sara.dema@mail.com', 'mesues123'),
(16, 'Elona Sako', 'Femër', '1981-11-11', 600300016, 'elona.sako@mail.com', 'mesues123'),
(17, 'Flutura Ndoj', 'Femër', '1975-03-03', 600300017, 'flutura.ndoj@mail.com', 'mesues123'),
(18, 'Ornela Dini', 'Femër', '1976-08-08', 600300018, 'ornela.dini@mail.com', 'mesues123'),
(19, 'Jona Pire', 'Femër', '1983-01-17', 600300019, 'jona.pire@mail.com', 'mesues123'),
(20, 'Ledia Muka', 'Femër', '1979-09-09', 600300020, 'ledia.muka@mail.com', 'mesues123'),
(21, 'Arlind Basha', 'Mashkull', '1978-04-04', 600300021, 'arlind.basha@mail.com', 'mesues123'),
(22, 'Endri Kodra', 'Mashkull', '1980-06-06', 600300022, 'endri.kodra@mail.com', 'mesues123'),
(23, 'Klevi Doda', 'Mashkull', '1976-09-15', 600300023, 'klevi.doda@mail.com', 'mesues123'),
(24, 'Valon Gjoni', 'Mashkull', '1977-12-21', 600300024, 'valon.gjoni@mail.com', 'mesues123'),
(25, 'Sokol Lushi', 'Mashkull', '1981-03-11', 600300025, 'sokol.lushi@mail.com', 'mesues123'),
(26, 'Ylber Domi', 'Mashkull', '1975-07-07', 600300026, 'ylber.domi@mail.com', 'mesues123'),
(27, 'Mikel Shyti', 'Mashkull', '1979-10-10', 600300027, 'mikel.shyti@mail.com', 'mesues123'),
(28, 'Artur Leci', 'Mashkull', '1982-02-28', 600300028, 'artur.leci@mail.com', 'mesues123'),
(29, 'Blendi Kasa', 'Mashkull', '1974-05-05', 600300029, 'blendi.kasa@mail.com', 'mesues123'),
(30, 'Franci Reka', 'Mashkull', '1976-11-11', 600300030, 'franci.reka@mail.com', 'mesues123');

-- --------------------------------------------------------

--
-- Table structure for table `mungesa`
--

CREATE TABLE `mungesa` (
  `id` int(255) NOT NULL,
  `nxenesID` int(255) NOT NULL,
  `lendaID` int(255) NOT NULL,
  `data` date NOT NULL,
  `ora` time(6) NOT NULL,
  `statusi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mungesa`
--

INSERT INTO `mungesa` (`id`, `nxenesID`, `lendaID`, `data`, `ora`, `statusi`) VALUES
(3, 1, 1, '2026-05-02', '13:34:03.000000', 'Prezent');

-- --------------------------------------------------------

--
-- Table structure for table `notat`
--

CREATE TABLE `notat` (
  `id` int(255) NOT NULL,
  `nxenesID` int(255) NOT NULL,
  `klasid` int(255) NOT NULL,
  `prind_id` int(255) NOT NULL,
  `nota` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nxenes`
--

CREATE TABLE `nxenes` (
  `nxenesID` int(255) NOT NULL,
  `emerMbiemer` varchar(255) NOT NULL,
  `gjinia` varchar(255) NOT NULL,
  `datelindja` date NOT NULL,
  `nrTel` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `prindID` int(255) NOT NULL,
  `klasID` int(255) NOT NULL,
  `vitiStudimit` date NOT NULL,
  `nrID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nxenes`
--

INSERT INTO `nxenes` (`nxenesID`, `emerMbiemer`, `gjinia`, `datelindja`, `nrTel`, `email`, `prindID`, `klasID`, `vitiStudimit`, `nrID`) VALUES
(1, 'Ardit Hoxha', 'Mashkull', '2008-03-15', 691111111, 'ardit.hoxha@gmail.com', 1, 1, '2025-01-01', 'NX001'),
(2, 'Sara Dervishi', 'Femër', '2008-07-22', 692222222, 'sara.dervishi@gmail.com', 2, 2, '2025-01-01', 'NX002'),
(3, 'Denis Hoxha', 'Mashkull', '2008-03-10', 600700001, 'denis.hoxha@mail.com', 1, 1, '2025-01-01', 'NX003'),
(4, 'Elira Dervishi', 'Femër', '2008-04-11', 600700002, 'elira.dervishi2@mail.com', 2, 1, '2025-01-01', 'NX004'),
(5, 'Arlind Krasniqi', 'Mashkull', '2008-05-12', 600700003, 'arlind.krasniqi@mail.com', 3, 2, '2025-01-01', 'NX005'),
(6, 'Erion Berisha', 'Mashkull', '2008-06-13', 600700004, 'erion.berisha@mail.com', 4, 2, '2025-01-01', 'NX006'),
(7, 'Sara Gashi', 'Femër', '2008-07-14', 600700005, 'sara.gashi@mail.com', 5, 3, '2025-01-01', 'NX007'),
(8, 'Bleron Meta', 'Mashkull', '2008-08-15', 600700006, 'bleron.meta@mail.com', 6, 3, '2025-01-01', 'NX008'),
(9, 'Altin Dervishi', 'Mashkull', '2008-09-16', 600700007, 'altin.dervishi@mail.com', 7, 4, '2025-01-01', 'NX009'),
(10, 'Gent Leka', 'Mashkull', '2008-10-17', 600700008, 'gent.leka@mail.com', 8, 4, '2025-01-01', 'NX010'),
(11, 'Shkelzen Mullai', 'Mashkull', '2008-11-18', 600700009, 'shkelzen.mullai@mail.com', 9, 5, '2025-01-01', 'NX011'),
(12, 'Ardit Basha', 'Mashkull', '2008-12-19', 600700010, 'ardit.basha@mail.com', 10, 5, '2025-01-01', 'NX012'),
(13, 'Besnik Rama', 'Mashkull', '2008-01-20', 600700011, 'besnik.rama@mail.com', 11, 6, '2025-01-01', 'NX013'),
(14, 'Luan Shehu', 'Mashkull', '2008-02-21', 600700012, 'luan.shehu@mail.com', 12, 6, '2025-01-01', 'NX014'),
(15, 'Florian Kola', 'Mashkull', '2008-03-22', 600700013, 'florian.kola@mail.com', 13, 7, '2025-01-01', 'NX015'),
(16, 'Endrit Prifti', 'Mashkull', '2008-04-23', 600700014, 'endrit.prifti@mail.com', 14, 7, '2025-01-01', 'NX016'),
(17, 'Klevis Kondi', 'Mashkull', '2008-05-24', 600700015, 'klevis.kondi@mail.com', 15, 8, '2025-01-01', 'NX017'),
(18, 'Arlind Ismaili', 'Mashkull', '2008-06-25', 600700016, 'arlind.ismaili@mail.com', 16, 8, '2025-01-01', 'NX018'),
(19, 'Valmir Zeqiri', 'Mashkull', '2008-07-26', 600700017, 'valmir.zeqiri@mail.com', 17, 9, '2025-01-01', 'NX019'),
(20, 'Sokol Ahmeti', 'Mashkull', '2008-08-27', 600700018, 'sokol.ahmeti@mail.com', 18, 9, '2025-01-01', 'NX020'),
(21, 'Ylli Veseli', 'Mashkull', '2008-09-28', 600700019, 'ylli.veseli@mail.com', 19, 10, '2025-01-01', 'NX021'),
(22, 'Mandi Marku', 'Mashkull', '2008-10-29', 600700020, 'mandi.marku@mail.com', 20, 10, '2025-01-01', 'NX022'),
(23, 'Artan Luci', 'Mashkull', '2008-11-30', 600700021, 'artan.luci@mail.com', 21, 11, '2025-01-01', 'NX023'),
(24, 'Elira Hoxha', 'Femër', '2008-01-01', 600700022, 'elira.hoxha@mail.com', 22, 11, '2025-01-01', 'NX024'),
(25, 'Arta Krasniqi', 'Femër', '2008-02-02', 600700023, 'arta.krasniqi@mail.com', 23, 12, '2025-01-01', 'NX025'),
(26, 'Linda Berisha', 'Femër', '2008-03-03', 600700024, 'linda.berisha@mail.com', 24, 12, '2025-01-01', 'NX026'),
(27, 'Jona Gashi', 'Femër', '2008-04-04', 600700025, 'jona.gashi@mail.com', 25, 13, '2025-01-01', 'NX027'),
(28, 'Dona Meta', 'Femër', '2008-05-05', 600700026, 'dona.meta@mail.com', 26, 13, '2025-01-01', 'NX028'),
(29, 'Mira Dervishi', 'Femër', '2008-06-06', 600700027, 'mira.dervishi@mail.com', 27, 14, '2025-01-01', 'NX029'),
(30, 'Anisa Leka', 'Femër', '2008-07-07', 600700028, 'anisa.leka@mail.com', 28, 14, '2025-01-01', 'NX030'),
(31, 'Erisa Mullai', 'Femër', '2008-08-08', 600700029, 'erisa.mullai@mail.com', 29, 1, '2025-01-01', 'NX031'),
(32, 'Klea Basha', 'Femër', '2008-09-09', 600700030, 'klea.basha@mail.com', 30, 2, '2025-01-01', 'NX032'),
(33, 'Drin Hoxha', 'Mashkull', '2008-10-10', 600700033, 'drin.hoxha@mail.com', 31, 3, '2025-01-01', 'NX033'),
(34, 'Albin Dervishi', 'Mashkull', '2008-11-11', 600700034, 'albin.dervishi@mail.com', 32, 4, '2025-01-01', 'NX034'),
(35, 'Vigan Krasniqi', 'Mashkull', '2008-12-12', 600700035, 'vigan.krasniqi@mail.com', 33, 5, '2025-01-01', 'NX035'),
(36, 'Aris Berisha', 'Mashkull', '2008-01-13', 600700036, 'aris.berisha@mail.com', 34, 6, '2025-01-01', 'NX036'),
(37, 'Kris Gashi', 'Mashkull', '2008-02-14', 600700037, 'kris.gashi@mail.com', 35, 7, '2025-01-01', 'NX037'),
(38, 'Elona Meta', 'Femër', '2008-03-15', 600700038, 'elona.meta@mail.com', 36, 8, '2025-01-01', 'NX038'),
(39, 'Bruna Dervishi', 'Femër', '2008-04-16', 600700039, 'bruna.dervishi@mail.com', 37, 9, '2025-01-01', 'NX039'),
(40, 'Diana Leka', 'Femër', '2008-05-17', 600700040, 'diana.leka@mail.com', 38, 10, '2025-01-01', 'NX040'),
(41, 'Iris Mullai', 'Femër', '2008-06-18', 600700041, 'iris.mullai@mail.com', 39, 11, '2025-01-01', 'NX041'),
(42, 'Alisa Basha', 'Femër', '2008-07-19', 600700042, 'alisa.basha@mail.com', 40, 12, '2025-01-01', 'NX042'),
(43, 'Drin Kola', 'Mashkull', '2008-08-20', 600700043, 'drin.kola@mail.com', 41, 13, '2025-01-01', 'NX043'),
(44, 'Albin Meta', 'Mashkull', '2008-09-21', 600700044, 'albin.meta@mail.com', 42, 14, '2025-01-01', 'NX044'),
(45, 'Vigan Hoxha', 'Mashkull', '2008-10-22', 600700045, 'vigan.hoxha@mail.com', 43, 1, '2025-01-01', 'NX045'),
(46, 'Aris Dervishi', 'Mashkull', '2008-11-23', 600700046, 'aris.dervishi@mail.com', 44, 2, '2025-01-01', 'NX046'),
(47, 'Kris Leka', 'Mashkull', '2008-12-24', 600700047, 'kris.leka@mail.com', 45, 3, '2025-01-01', 'NX047'),
(48, 'Elona Gashi', 'Femër', '2008-01-25', 600700048, 'elona.gashi@mail.com', 46, 4, '2025-01-01', 'NX048'),
(49, 'Bruna Kola', 'Femër', '2008-02-26', 600700049, 'bruna.kola@mail.com', 47, 5, '2025-01-01', 'NX049'),
(50, 'Diana Berisha', 'Femër', '2008-03-27', 600700050, 'diana.berisha@mail.com', 48, 6, '2025-01-01', 'NX050'),
(51, 'Iris Duka', 'Femër', '2008-04-28', 600700051, 'iris.duka@mail.com', 49, 7, '2025-01-01', 'NX051'),
(52, 'Alisa Hysa', 'Femër', '2008-05-29', 600700052, 'alisa.hysa@mail.com', 50, 8, '2025-01-01', 'NX052'),
(53, 'Drin Rama', 'Mashkull', '2008-06-01', 600700053, 'drin.rama@mail.com', 51, 9, '2025-01-01', 'NX053'),
(54, 'Albin Lleshi', 'Mashkull', '2008-07-02', 600700054, 'albin.lleshi@mail.com', 52, 10, '2025-01-01', 'NX054'),
(55, 'Vigan Kelmendi', 'Mashkull', '2008-08-03', 600700055, 'vigan.kelmendi@mail.com', 53, 11, '2025-01-01', 'NX055'),
(56, 'Aris Meta', 'Mashkull', '2008-09-04', 600700056, 'aris.meta@mail.com', 54, 12, '2025-01-01', 'NX056'),
(57, 'Kris Dervishi', 'Mashkull', '2008-10-05', 600700057, 'kris.dervishi@mail.com', 55, 13, '2025-01-01', 'NX057'),
(58, 'Elona Hoxha', 'Femër', '2008-11-06', 600700058, 'elona.hoxha2@mail.com', 56, 14, '2025-01-01', 'NX058'),
(59, 'Bruna Lika', 'Femër', '2008-12-07', 600700059, 'bruna.lika@mail.com', 57, 1, '2025-01-01', 'NX059'),
(60, 'Diana Pasha', 'Femër', '2008-01-08', 600700060, 'diana.pasha@mail.com', 58, 2, '2025-01-01', 'NX060'),
(61, 'Iris Gashi', 'Femër', '2008-02-09', 600700061, 'iris.gashi@mail.com', 59, 3, '2025-01-01', 'NX061'),
(62, 'Alisa Meta', 'Femër', '2008-03-10', 600700062, 'alisa.meta@mail.com', 60, 4, '2025-01-01', 'NX062'),
(63, 'Drin Doda', 'Mashkull', '2008-04-11', 600700063, 'drin.doda@mail.com', 61, 5, '2025-01-01', 'NX063'),
(64, 'Albin Hysa', 'Mashkull', '2008-05-12', 600700064, 'albin.hysa@mail.com', 62, 6, '2025-01-01', 'NX064'),
(65, 'Vigan Lika', 'Mashkull', '2008-06-13', 600700065, 'vigan.lika@mail.com', 63, 7, '2025-01-01', 'NX065'),
(66, 'Aris Kola', 'Mashkull', '2008-07-14', 600700066, 'aris.kola@mail.com', 64, 8, '2025-01-01', 'NX066'),
(67, 'Kris Berisha', 'Mashkull', '2008-08-15', 600700067, 'kris.berisha@mail.com', 65, 9, '2025-01-01', 'NX067'),
(68, 'Elona Rama', 'Femër', '2008-09-16', 600700068, 'elona.rama@mail.com', 66, 10, '2025-01-01', 'NX068'),
(69, 'Bruna Duka', 'Femër', '2008-10-17', 600700069, 'bruna.duka@mail.com', 67, 11, '2025-01-01', 'NX069'),
(70, 'Diana Meta', 'Femër', '2008-11-18', 600700070, 'diana.meta@mail.com', 68, 12, '2025-01-01', 'NX070'),
(71, 'Iris Lleshi', 'Femër', '2008-12-19', 600700071, 'iris.lleshi@mail.com', 69, 13, '2025-01-01', 'NX071'),
(72, 'Alisa Kelmendi', 'Femër', '2008-01-20', 600700072, 'alisa.kelmendi@mail.com', 70, 14, '2025-01-01', 'NX072'),
(73, 'Drin Hoxha', 'Mashkull', '2008-02-21', 600700073, 'drin.hoxha2@mail.com', 71, 1, '2025-01-01', 'NX073'),
(74, 'Albin Dervishi', 'Mashkull', '2008-03-22', 600700074, 'albin.dervishi2@mail.com', 72, 2, '2025-01-01', 'NX074'),
(75, 'Vigan Leka', 'Mashkull', '2008-04-23', 600700075, 'vigan.leka@mail.com', 73, 3, '2025-01-01', 'NX075'),
(76, 'Aris Gashi', 'Mashkull', '2008-05-24', 600700076, 'aris.gashi@mail.com', 74, 4, '2025-01-01', 'NX076'),
(77, 'Kris Hysa', 'Mashkull', '2008-06-25', 600700077, 'kris.hysa@mail.com', 75, 5, '2025-01-01', 'NX077'),
(78, 'Elona Kola', 'Femër', '2008-07-26', 600700078, 'elona.kola@mail.com', 1, 6, '2025-01-01', 'NX078'),
(79, 'Bruna Berisha', 'Femër', '2008-08-27', 600700079, 'bruna.berisha@mail.com', 2, 7, '2025-01-01', 'NX079');

-- --------------------------------------------------------

--
-- Table structure for table `orari`
--

CREATE TABLE `orari` (
  `id` int(255) NOT NULL,
  `klasID` int(255) NOT NULL,
  `lendaID` int(255) NOT NULL,
  `dita` varchar(255) NOT NULL,
  `ora_fillimit` time NOT NULL,
  `ora_mbarimit` time NOT NULL,
  `mesuesID` int(255) NOT NULL,
  `tremujori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagesat`
--

CREATE TABLE `pagesat` (
  `id` int(255) NOT NULL,
  `studentID` int(255) NOT NULL,
  `prindID` int(255) NOT NULL,
  `klasID` int(255) NOT NULL,
  `shuma` int(11) NOT NULL,
  `transactionID` int(255) NOT NULL,
  `metodaPageses` varchar(255) NOT NULL,
  `dataPageses` date NOT NULL,
  `muaji` varchar(255) NOT NULL,
  `afati` date NOT NULL,
  `statusi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prinder`
--

CREATE TABLE `prinder` (
  `prind_id` int(50) NOT NULL,
  `emerMbiemer` varchar(255) NOT NULL,
  `Gjinia` varchar(255) NOT NULL,
  `Datelindja` date NOT NULL,
  `nrTel` int(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fjalekalimFillestare` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prinder`
--

INSERT INTO `prinder` (`prind_id`, `emerMbiemer`, `Gjinia`, `Datelindja`, `nrTel`, `email`, `fjalekalimFillestare`) VALUES
(1, 'Arben Hoxha', 'Mashkull', '1980-05-12', 691234567, 'arben.hoxha@gmail.com', '123456'),
(2, 'Elira Dervishi', 'Femër', '1985-09-20', 689876543, 'elira.dervishi@gmail.com', '123456'),
(3, 'Ilir Krasniqi', 'Mashkull', '1978-06-21', 600111112, 'ilir.krasniqi2@mail.com', '123456'),
(4, 'Dritan Berisha', 'Mashkull', '1972-01-10', 600111113, 'dritan.berisha3@mail.com', '123456'),
(5, 'Erion Gashi', 'Mashkull', '1980-09-15', 600111114, 'erion.gashi4@mail.com', '123456'),
(6, 'Blerim Meta', 'Mashkull', '1976-11-03', 600111115, 'blerim.meta5@mail.com', '123456'),
(7, 'Altin Dervishi', 'Mashkull', '1979-02-18', 600111116, 'altin.dervishi6@mail.com', '123456'),
(8, 'Gentian Leka', 'Mashkull', '1974-07-09', 600111117, 'gentian.leka7@mail.com', '123456'),
(9, 'Shkëlzen Mullai', 'Mashkull', '1973-03-22', 600111118, 'shkelzen.mullai8@mail.com', '123456'),
(10, 'Ardit Basha', 'Mashkull', '1977-12-01', 600111119, 'ardit.basha9@mail.com', '123456'),
(11, 'Besnik Rama', 'Mashkull', '1971-05-27', 600111120, 'besnik.rama10@mail.com', '123456'),
(12, 'Luan Shehu', 'Mashkull', '1975-10-14', 600111121, 'luan.shehu11@mail.com', '123456'),
(13, 'Florian Kola', 'Mashkull', '1976-08-30', 600111122, 'florian.kola12@mail.com', '123456'),
(14, 'Endrit Prifti', 'Mashkull', '1978-01-19', 600111123, 'endrit.prifti13@mail.com', '123456'),
(15, 'Klevis Kondi', 'Mashkull', '1979-04-25', 600111124, 'klevis.kondi14@mail.com', '123456'),
(16, 'Arlind Ismaili', 'Mashkull', '1972-06-17', 600111125, 'arlind.ismaili15@mail.com', '123456'),
(17, 'Valmir Zeqiri', 'Mashkull', '1973-09-08', 600111126, 'valmir.zeqiri16@mail.com', '123456'),
(18, 'Sokol Ahmeti', 'Mashkull', '1977-11-11', 600111127, 'sokol.ahmeti17@mail.com', '123456'),
(19, 'Ylli Veseli', 'Mashkull', '1974-02-02', 600111128, 'ylli.veseli18@mail.com', '123456'),
(20, 'Mandi Marku', 'Mashkull', '1976-03-13', 600111129, 'mandi.marku19@mail.com', '123456'),
(21, 'Artan Luci', 'Mashkull', '1975-12-29', 600111130, 'artan.luci20@mail.com', '123456'),
(22, 'Elira Hoxha', 'Femër', '1978-05-05', 600111131, 'elira.hoxha21@mail.com', '123456'),
(23, 'Arta Krasniqi', 'Femër', '1976-07-07', 600111132, 'arta.krasniqi22@mail.com', '123456'),
(24, 'Linda Berisha', 'Femër', '1979-09-09', 600111133, 'linda.berisha23@mail.com', '123456'),
(25, 'Jona Gashi', 'Femër', '1974-11-11', 600111134, 'jona.gashi24@mail.com', '123456'),
(26, 'Dona Meta', 'Femër', '1973-02-14', 600111135, 'dona.meta25@mail.com', '123456'),
(27, 'Mira Dervishi', 'Femër', '1977-03-16', 600111136, 'mira.dervishi26@mail.com', '123456'),
(28, 'Anisa Leka', 'Femër', '1975-06-18', 600111137, 'anisa.leka27@mail.com', '123456'),
(29, 'Erisa Mullai', 'Femër', '1978-08-20', 600111138, 'erisa.mullai28@mail.com', '123456'),
(30, 'Klea Basha', 'Femër', '1976-10-22', 600111139, 'klea.basha29@mail.com', '123456'),
(31, 'Valbona Rama', 'Femër', '1979-12-24', 600111140, 'valbona.rama30@mail.com', '123456'),
(32, 'Adrian Doda', 'Mashkull', '1975-03-10', 600111135, 'adrian.doda26@mail.com', '123456'),
(33, 'Bujar Hysa', 'Mashkull', '1976-06-18', 600111136, 'bujar.hysa27@mail.com', '123456'),
(34, 'Gent Malaj', 'Mashkull', '1973-09-22', 600111137, 'gent.malaj28@mail.com', '123456'),
(35, 'Ilir Pasha', 'Mashkull', '1978-12-05', 600111138, 'ilir.pasha29@mail.com', '123456'),
(36, 'Arben Lika', 'Mashkull', '1972-04-14', 600111139, 'arben.lika30@mail.com', '123456'),
(37, 'Erjon Duka', 'Mashkull', '1977-07-19', 600111140, 'erjon.duka31@mail.com', '123456'),
(38, 'Leonard Sula', 'Mashkull', '1975-11-11', 600111141, 'leonard.sula32@mail.com', '123456'),
(39, 'Altin Qerimi', 'Mashkull', '1979-02-25', 600111142, 'altin.qerimi33@mail.com', '123456'),
(40, 'Saimir Kola', 'Mashkull', '1974-08-30', 600111143, 'saimir.kola34@mail.com', '123456'),
(41, 'Dorian Meta', 'Mashkull', '1976-01-17', 600111144, 'dorian.meta35@mail.com', '123456'),
(42, 'Elona Hoxha', 'Femër', '1978-03-03', 600111145, 'elona.hoxha36@mail.com', '123456'),
(43, 'Arta Dervishi', 'Femër', '1977-05-20', 600111146, 'arta.dervishi37@mail.com', '123456'),
(44, 'Jona Leka', 'Femër', '1975-09-09', 600111147, 'jona.leka38@mail.com', '123456'),
(45, 'Mira Berisha', 'Femër', '1976-12-12', 600111148, 'mira.berisha39@mail.com', '123456'),
(46, 'Linda Gashi', 'Femër', '1974-07-07', 600111149, 'linda.gashi40@mail.com', '123456'),
(47, 'Valbona Krasniqi', 'Femër', '1979-01-11', 600111150, 'valbona.krasniqi41@mail.com', '123456'),
(48, 'Besa Rama', 'Femër', '1973-10-10', 600111151, 'besa.rama42@mail.com', '123456'),
(49, 'Ornela Prifti', 'Femër', '1978-06-06', 600111152, 'ornela.prifti43@mail.com', '123456'),
(50, 'Fjolla Ismaili', 'Femër', '1975-02-02', 600111153, 'fjolla.ismaili44@mail.com', '123456'),
(51, 'Elda Kodra', 'Femër', '1977-04-04', 600111154, 'elda.kodra45@mail.com', '123456'),
(52, 'Ardit Nika', 'Mashkull', '1972-09-09', 600111155, 'ardit.nika46@mail.com', '123456'),
(53, 'Flamur Shehu', 'Mashkull', '1976-03-13', 600111156, 'flamur.shehu47@mail.com', '123456'),
(54, 'Besmir Zeka', 'Mashkull', '1975-05-25', 600111157, 'besmir.zeka48@mail.com', '123456'),
(55, 'Endri Lleshi', 'Mashkull', '1978-08-18', 600111158, 'endri.lleshi49@mail.com', '123456'),
(56, 'Klevis Hoxha', 'Mashkull', '1974-11-21', 600111159, 'klevis.hoxha50@mail.com', '123456'),
(57, 'Arlinda Meta', 'Femër', '1976-06-16', 600111160, 'arlinda.meta51@mail.com', '123456'),
(58, 'Drita Kola', 'Femër', '1977-07-27', 600111161, 'drita.kola52@mail.com', '123456'),
(59, 'Shpresa Gjoni', 'Femër', '1979-09-19', 600111162, 'shpresa.gjoni53@mail.com', '123456'),
(60, 'Nora Doda', 'Femër', '1975-12-22', 600111163, 'nora.doda54@mail.com', '123456'),
(61, 'Elvisa Hysa', 'Femër', '1973-03-30', 600111164, 'elvisa.hysa55@mail.com', '123456'),
(62, 'Ervin Pjetri', 'Mashkull', '1972-01-01', 600111165, 'ervin.pjetri56@mail.com', '123456'),
(63, 'Julian Bega', 'Mashkull', '1976-02-14', 600111166, 'julian.bega57@mail.com', '123456'),
(64, 'Sokol Dervishi', 'Mashkull', '1978-04-28', 600111167, 'sokol.dervishi58@mail.com', '123456'),
(65, 'Luan Duka', 'Mashkull', '1974-06-06', 600111168, 'luan.duka59@mail.com', '123456'),
(66, 'Artur Kodra', 'Mashkull', '1977-08-08', 600111169, 'artur.kodra60@mail.com', '123456'),
(67, 'Elira Pasha', 'Femër', '1975-05-15', 600111170, 'elira.pasha61@mail.com', '123456'),
(68, 'Mirela Lika', 'Femër', '1978-10-10', 600111171, 'mirela.lika62@mail.com', '123456'),
(69, 'Jona Hoxha', 'Femër', '1976-11-11', 600111172, 'jona.hoxha63@mail.com', '123456'),
(70, 'Valentina Meta', 'Femër', '1979-01-23', 600111173, 'valentina.meta64@mail.com', '123456'),
(71, 'Arta Sula', 'Femër', '1974-02-28', 600111174, 'arta.sula65@mail.com', '123456'),
(72, 'Blerim Lleshi', 'Mashkull', '1973-03-03', 600111175, 'blerim.lleshi66@mail.com', '123456'),
(73, 'Dritan Kola', 'Mashkull', '1977-04-14', 600111176, 'dritan.kola67@mail.com', '123456'),
(74, 'Gentian Hysa', 'Mashkull', '1975-06-25', 600111177, 'gentian.hysa68@mail.com', '123456'),
(75, 'Ilir Meta', 'Mashkull', '1978-09-09', 600111178, 'ilir.meta69@mail.com', '123456'),
(76, 'Arben Gashi', 'Mashkull', '1972-12-12', 600111179, 'arben.gashi70@mail.com', '123456'),
(77, 'Linda Kola', 'Femër', '1976-01-19', 600111180, 'linda.kola71@mail.com', '123456'),
(78, 'Besa Dervishi', 'Femër', '1977-02-20', 600111181, 'besa.dervishi72@mail.com', '123456'),
(79, 'Elona Leka', 'Femër', '1975-03-21', 600111182, 'elona.leka73@mail.com', '123456'),
(80, 'Ornela Hoxha', 'Femër', '1979-04-22', 600111183, 'ornela.hoxha74@mail.com', '123456'),
(81, 'Mira Gashi', 'Femër', '1974-05-23', 600111184, 'mira.gashi75@mail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `vleresim`
--

CREATE TABLE `vleresim` (
  `id` int(255) NOT NULL,
  `nxenesID` int(255) NOT NULL,
  `tremujori` varchar(255) NOT NULL,
  `v1` int(255) NOT NULL,
  `v2` int(255) NOT NULL,
  `v3` int(255) NOT NULL,
  `projekt` int(255) NOT NULL,
  `test` int(255) NOT NULL,
  `lendaID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitet`
--
ALTER TABLE `aktivitet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detyrat`
--
ALTER TABLE `detyrat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klasID` (`klasID`),
  ADD KEY `lendaID` (`lendaID`),
  ADD KEY `mesuesID` (`mesuesID`);

--
-- Indexes for table `klasa`
--
ALTER TABLE `klasa`
  ADD PRIMARY KEY (`klasaID`);

--
-- Indexes for table `klasalenda`
--
ALTER TABLE `klasalenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klasID` (`klasID`),
  ADD KEY `lendaID` (`lendaID`);

--
-- Indexes for table `kualifikimemesuesi`
--
ALTER TABLE `kualifikimemesuesi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mesuesID` (`mesuesID`);

--
-- Indexes for table `lenda`
--
ALTER TABLE `lenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lidhjamesues`
--
ALTER TABLE `lidhjamesues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klasID` (`klasID`),
  ADD KEY `lendaID` (`lendaID`),
  ADD KEY `mesuesID` (`mesuesID`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mesues`
--
ALTER TABLE `mesues`
  ADD PRIMARY KEY (`mesuesID`);

--
-- Indexes for table `mungesa`
--
ALTER TABLE `mungesa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lendaID` (`lendaID`),
  ADD KEY `nxenesID` (`nxenesID`);

--
-- Indexes for table `notat`
--
ALTER TABLE `notat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klasid` (`klasid`),
  ADD KEY `nxenesID` (`nxenesID`),
  ADD KEY `prind_id` (`prind_id`);

--
-- Indexes for table `nxenes`
--
ALTER TABLE `nxenes`
  ADD PRIMARY KEY (`nxenesID`),
  ADD KEY `prindID` (`prindID`),
  ADD KEY `klasID` (`klasID`);

--
-- Indexes for table `orari`
--
ALTER TABLE `orari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klasID` (`klasID`),
  ADD KEY `lendaID` (`lendaID`),
  ADD KEY `mesuesID` (`mesuesID`);

--
-- Indexes for table `pagesat`
--
ALTER TABLE `pagesat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klasID` (`klasID`),
  ADD KEY `prindID` (`prindID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `prinder`
--
ALTER TABLE `prinder`
  ADD PRIMARY KEY (`prind_id`);

--
-- Indexes for table `vleresim`
--
ALTER TABLE `vleresim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lendaID` (`lendaID`),
  ADD KEY `nxenesID` (`nxenesID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitet`
--
ALTER TABLE `aktivitet`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detyrat`
--
ALTER TABLE `detyrat`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klasa`
--
ALTER TABLE `klasa`
  MODIFY `klasaID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `klasalenda`
--
ALTER TABLE `klasalenda`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `kualifikimemesuesi`
--
ALTER TABLE `kualifikimemesuesi`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lenda`
--
ALTER TABLE `lenda`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `lidhjamesues`
--
ALTER TABLE `lidhjamesues`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mesues`
--
ALTER TABLE `mesues`
  MODIFY `mesuesID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `mungesa`
--
ALTER TABLE `mungesa`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notat`
--
ALTER TABLE `notat`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nxenes`
--
ALTER TABLE `nxenes`
  MODIFY `nxenesID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `pagesat`
--
ALTER TABLE `pagesat`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prinder`
--
ALTER TABLE `prinder`
  MODIFY `prind_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `vleresim`
--
ALTER TABLE `vleresim`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detyrat`
--
ALTER TABLE `detyrat`
  ADD CONSTRAINT `detyrat_ibfk_1` FOREIGN KEY (`klasID`) REFERENCES `klasa` (`klasaID`),
  ADD CONSTRAINT `detyrat_ibfk_2` FOREIGN KEY (`lendaID`) REFERENCES `lenda` (`id`),
  ADD CONSTRAINT `detyrat_ibfk_3` FOREIGN KEY (`mesuesID`) REFERENCES `mesues` (`mesuesID`);

--
-- Constraints for table `klasalenda`
--
ALTER TABLE `klasalenda`
  ADD CONSTRAINT `klasalenda_ibfk_1` FOREIGN KEY (`klasID`) REFERENCES `klasa` (`klasaID`),
  ADD CONSTRAINT `klasalenda_ibfk_2` FOREIGN KEY (`lendaID`) REFERENCES `lenda` (`id`);

--
-- Constraints for table `kualifikimemesuesi`
--
ALTER TABLE `kualifikimemesuesi`
  ADD CONSTRAINT `kualifikimemesuesi_ibfk_1` FOREIGN KEY (`mesuesID`) REFERENCES `mesues` (`mesuesID`);

--
-- Constraints for table `lidhjamesues`
--
ALTER TABLE `lidhjamesues`
  ADD CONSTRAINT `lidhjamesues_ibfk_1` FOREIGN KEY (`klasID`) REFERENCES `klasa` (`klasaID`),
  ADD CONSTRAINT `lidhjamesues_ibfk_2` FOREIGN KEY (`lendaID`) REFERENCES `lenda` (`id`),
  ADD CONSTRAINT `lidhjamesues_ibfk_3` FOREIGN KEY (`mesuesID`) REFERENCES `mesues` (`mesuesID`);

--
-- Constraints for table `mungesa`
--
ALTER TABLE `mungesa`
  ADD CONSTRAINT `mungesa_ibfk_1` FOREIGN KEY (`lendaID`) REFERENCES `lenda` (`id`),
  ADD CONSTRAINT `mungesa_ibfk_2` FOREIGN KEY (`nxenesID`) REFERENCES `nxenes` (`nxenesID`);

--
-- Constraints for table `notat`
--
ALTER TABLE `notat`
  ADD CONSTRAINT `notat_ibfk_1` FOREIGN KEY (`klasid`) REFERENCES `klasa` (`klasaID`),
  ADD CONSTRAINT `notat_ibfk_2` FOREIGN KEY (`nxenesID`) REFERENCES `nxenes` (`nxenesID`),
  ADD CONSTRAINT `notat_ibfk_3` FOREIGN KEY (`prind_id`) REFERENCES `prinder` (`prind_id`);

--
-- Constraints for table `nxenes`
--
ALTER TABLE `nxenes`
  ADD CONSTRAINT `nxenes_ibfk_2` FOREIGN KEY (`prindID`) REFERENCES `prinder` (`prind_id`),
  ADD CONSTRAINT `nxenes_ibfk_3` FOREIGN KEY (`klasID`) REFERENCES `klasa` (`klasaID`);

--
-- Constraints for table `orari`
--
ALTER TABLE `orari`
  ADD CONSTRAINT `orari_ibfk_1` FOREIGN KEY (`klasID`) REFERENCES `klasa` (`klasaID`),
  ADD CONSTRAINT `orari_ibfk_2` FOREIGN KEY (`lendaID`) REFERENCES `lenda` (`id`),
  ADD CONSTRAINT `orari_ibfk_3` FOREIGN KEY (`mesuesID`) REFERENCES `mesues` (`mesuesID`);

--
-- Constraints for table `pagesat`
--
ALTER TABLE `pagesat`
  ADD CONSTRAINT `pagesat_ibfk_1` FOREIGN KEY (`klasID`) REFERENCES `klasa` (`klasaID`),
  ADD CONSTRAINT `pagesat_ibfk_2` FOREIGN KEY (`prindID`) REFERENCES `prinder` (`prind_id`),
  ADD CONSTRAINT `pagesat_ibfk_3` FOREIGN KEY (`studentID`) REFERENCES `nxenes` (`nxenesID`);

--
-- Constraints for table `vleresim`
--
ALTER TABLE `vleresim`
  ADD CONSTRAINT `vleresim_ibfk_1` FOREIGN KEY (`lendaID`) REFERENCES `lenda` (`id`),
  ADD CONSTRAINT `vleresim_ibfk_2` FOREIGN KEY (`nxenesID`) REFERENCES `nxenes` (`nxenesID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
