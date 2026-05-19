-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 02:43 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `emri` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fjalekalim` varchar(255) NOT NULL,
  `nrTel` int(20) DEFAULT NULL,
  `gjinia` varchar(20) DEFAULT NULL,
  `datelindja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `emri`, `email`, `fjalekalim`, `nrTel`, `gjinia`, `datelindja`) VALUES
(1, 'ELda', 'admin1@gmail.com', '$2y$10$8tLwvQwH2Zfn7iMDDOA9ROjL250e4t1t/SzZQ/XWudAlj2Y6o2GSe', 691234567, 'Femer', '2004-05-12'),
(2, 'Fjona', 'admin2@gmail.com', '$2y$10$WBVeXyUbPcoF2v99.BJPO.HSWEOBCHcW6cOspW.LKvhJDYTLDt1PS', 689876543, 'Femer', '2003-08-21'),
(3, 'Iris', 'admin3@gmail.com', '$2y$10$O6rzvDxCIZ5HXrPxx3uCdONvvgn1NEjXDkzC6ynvEGqfjVMpoQDpO', 674567891, 'Femer', '2004-01-30');

-- --------------------------------------------------------

--
-- Table structure for table `aktivitet`
--

CREATE TABLE `aktivitet` (
  `id` int(255) NOT NULL,
  `data` date DEFAULT NULL,
  `content` varchar(255) NOT NULL,
  `titull` varchar(255) NOT NULL,
  `kategoria` varchar(255) NOT NULL,
  `ambient` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktivitet`
--

INSERT INTO `aktivitet` (`id`, `data`, `content`, `titull`, `kategoria`, `ambient`) VALUES
(1, '2026-05-02', 'Nxënësit morën pjesë në një aktivitet edukativ jashtë klase ku u diskutuan temat e bashkëpunimit.', 'Aktivitet edukativ', 'Edukativ', 'Klasë'),
(2, '2026-05-04', 'U zhvillua një garë sportive mes klasave me pjesëmarrje aktive të nxënësve.', 'Gara sportive', 'Sport', 'Oborr shkollor'),
(3, '2026-05-06', 'Nxënësit prezantuan projektet e tyre kreative para klasës.', 'Prezantim projektesh', 'Arsimor', 'Klasë'),
(4, '2026-05-08', 'U organizua një aktivitet leximi ku nxënësit lexuan libra dhe diskutuan për to.', 'Ora e leximit', 'Kulturor', 'Bibliotekë'),
(5, '2026-05-10', 'Nxënësit morën pjesë në një punëtori për zhvillimin personal dhe komunikimin.', 'Punëtori zhvillimi', 'Trajnim', 'Sallë trajnimi'),
(6, '2026-05-12', 'U realizua një eksperiment shkencor i thjeshtë në laborator.', 'Eksperiment shkencor', 'Shkencor', 'Laborator'),
(7, '2026-05-14', 'Nxënësit organizuan një aktivitet artistik me vizatime dhe piktura.', 'Aktivitet artistik', 'Art', 'Klasë arti'),
(8, '2026-05-16', 'U zhvillua një diskutim mbi rëndësinë e disiplinës në shkollë.', 'Diskutim edukativ', 'Edukativ', 'Klasë'),
(9, '2026-05-18', 'Nxënësit morën pjesë në një aktivitet ekologjik për pastrimin e oborrit.', 'Dita e pastrimit', 'Ekologjik', 'Oborr shkollor'),
(10, '2026-05-20', 'U organizua një konkurs diturie me pyetje nga fusha të ndryshme.', 'Konkurs diturie', 'Konkurs', 'Aula shkollore');

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

--
-- Dumping data for table `detyrat`
--

INSERT INTO `detyrat` (`id`, `titulli`, `lendaID`, `klasID`, `dataFillimit`, `dataMbarimit`, `pershkrimi`, `mesuesID`) VALUES
(7, 'Reaksionet kimike', 4, 2, '2026-05-06', '2026-06-10', 'Secili nxenes...', 5),
(9, 'Informacione mbi historine e zhvillimit te muzikes...', 13, 12, '2026-05-13', '2026-05-15', '', 5),
(10, 'Informacione mbi NaCl', 4, 2, '2026-05-06', '2026-06-24', '', 5),
(11, 'Detyra 2', 4, 2, '2026-05-17', '2026-05-22', 'Secili nxenes', 5),
(12, 'Projekti', 4, 2, '2026-03-17', '2026-05-02', 'Secili nxenes', 5),
(14, 'Detyrë kreative', 2, 1, '2026-05-05', '2026-05-15', 'Puno një projekt të thjesht dhe prezantoje.', 2),
(15, 'Detyra 2', 6, 3, '2026-05-10', '2026-05-20', 'Secili nxenes', 7),
(16, 'Projekti final', 8, 1, '2026-05-12', '2026-05-25', 'Secili nxenes', 3),
(17, 'Projekt individual', 16, 6, '2026-05-02', '2026-05-11', 'Përgatit një projekt individual dhe prezantoje.', 16),
(18, 'Reflektim personal', 17, 6, '2026-05-04', '2026-05-09', 'Shkruaj për përvojat e tua në shkollë.', 17);

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
(14, '12J'),
(15, '17E'),
(16, '11C'),
(17, '12K');

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

--
-- Dumping data for table `kualifikimemesuesi`
--

INSERT INTO `kualifikimemesuesi` (`id`, `mesuesID`, `titulli`, `viti`) VALUES
(1, 5, 'Bachelor ne Kimi', '2008');

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
(17, 'Sociologji'),
(18, 'TIK'),
(19, 'Teknologji');

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

--
-- Dumping data for table `lidhjamesues`
--

INSERT INTO `lidhjamesues` (`id`, `mesuesID`, `klasID`, `lendaID`) VALUES
(28, 1, 10, 9),
(29, 2, 10, 10),
(30, 3, 11, 11),
(31, 4, 11, 12),
(32, 5, 12, 13),
(33, 6, 12, 14),
(34, 7, 13, 15),
(35, 8, 13, 16),
(36, 9, 14, 17),
(37, 10, 14, 1),
(38, 11, 15, 2),
(39, 12, 15, 3),
(42, 14, 15, 1),
(43, 14, 16, 1),
(44, 14, 1, 3),
(45, 14, 1, 18),
(46, 14, 17, 1),
(47, 14, 1, 19),
(48, 1, 15, 1),
(49, 1, 1, 3),
(50, 27, 1, 1),
(52, 20, 1, 1),
(53, 20, 1, 2),
(54, 20, 16, 1),
(55, 1, 1, 19);

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

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `derguesi`, `marresi`, `subject`, `body`, `data`, `status`) VALUES
(1, 'admin1@gmail.com', 'eldaallgjata@gmail.com', 'EETFE', 'hdkshuehshebfhd', '2026-05-17 11:54:53', 'sent'),
(2, 'admin1@gmail.com', 'admin1@gmail.com', 'tttttttttttttttt', 'ggggggggggggggggggggggg', '2026-05-17 12:34:54', 'sent'),
(3, 'admin1@gmail.com', 'admin1@gmail.com', 'hidhuir', 'gvyduihbdh', '2026-05-17 12:35:13', 'sent'),
(4, 'ardian.kodra@mail.com', 'arben.hoxha@gmail.com', 'Njoftim per mungese', 'Pershendetje, nxenesi mungoi sot ne oren e matematikes.', '2026-05-18 09:08:27', 'sent'),
(5, 'dorian.leka@mail.com', 'elira.dervishi@gmail.com', 'Rezultatet e testit', 'Nxenesi ka marre note shume te mire ne testin e biologjise.', '2026-05-18 09:08:27', 'sent'),
(6, 'ardian.kodra@mail.com', 'ilir.krasniqi1@mail.com', 'Takim me prinder', 'Ju lutem paraqituni ne takim diten e premte ne oren 15:00.', '2026-05-18 09:08:27', 'sent'),
(7, 'dorian.leka@mail.com', 'arben.hoxha@gmail.com', 'Detyra e shtepise', 'Detyra e matematikes duhet dorezuar neser.', '2026-05-18 09:08:27', 'sent'),
(8, 'ardian.kodra@mail.com', 'elira.dervishi@gmail.com', 'Aktivitet shkollor', 'Neser organizohet aktivitet sportiv ne ambientet e shkolles.', '2026-05-18 09:08:27', 'sent'),
(9, 'alban.gjoka@mail.com', 'arben.hoxha@gmail.com', 'Gjuhe shqipe', 'Ese pershkruese me teme:\"Vendlindja ime\"', '2026-05-17 18:04:24', 'sent'),
(10, 'alban.gjoka@mail.com', 'arben.hoxha@gmail.com', 'Matematike', 'Veprime mbi ekuacionet linare.', '2026-05-17 18:09:40', 'sent'),
(11, 'alban.gjoka@mail.com', 'arben.hoxha@gmail.com', 'Gjuhe shqipe', 'Pershendetje ,neser zhvillohet provimi ne gjuhen s...', '2026-05-17 18:14:10', 'sent'),
(12, 'arben.hoxha@mail.com', 'alban.gjoka@mail.com', 'Njoftim', 'Pershendetje,aktivitet mbi per festat e flamurit?', '2026-05-17 18:21:12', 'sent');

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
(1, 'Ardian Kodra', 'Mashkull', '1981-02-14', 600300001, 'ardian.kodra@mail.com', '$2y$10$TX0gQcqf6htUeGph4204nOnrAIVsGRGqtvlFnjTbHx3BZZoMuo5d6'),
(2, 'Dorian Leka', 'Mashkull', '1979-06-18', 600300002, 'dorian.leka@mail.com', '$2y$10$8Wfrez3j4JKsS21xFSuOMO2Y1dA88mR.XPjlQHGdTJSqCFR9H/oY2'),
(3, 'Gent Rrushi', 'Mashkull', '1975-11-03', 600300003, 'gent.rrushi@mail.com', '$2y$10$Qns9zLxIEhiYYRDsUw1QYeGZadfAgsf4NxjwqBvzD9IlZ7B7OPfKy'),
(4, 'Ermal Vora', 'Mashkull', '1980-09-21', 600300004, 'ermal.vora@mail.com', '$2y$10$XzfEmMfYjykVY36cDfqSSOh.EhulmFOn90epGz/5K4idh4nPZu0Qy'),
(5, 'Alban Gjoka', 'Mashkull', '1978-03-10', 600300005, 'alban.gjoka@mail.com', '$2y$10$P/.tE4WBhG2HVF9MsjIdsuMSLuxPIyxGfK3vo2.X/HJB727NXCrE2'),
(6, 'Leon Vata', 'Mashkull', '1977-07-07', 600300006, 'leon.vata@mail.com', '$2y$10$v22oinO8vgObL0qq2nYMyeqc.YVJS30ndK1osd4ioO4FiG4G9kdY6'),
(7, 'Arjan Zefi', 'Mashkull', '1982-12-12', 600300007, 'arjan.zefi@mail.com', '$2y$10$UWEsUi8QyKk99KsGXkvaYu2L4/I1NFXUjweiJj9eCNRqZViEXHiC.'),
(8, 'Julian Bici', 'Mashkull', '1976-01-25', 600300008, 'julian.bici@mail.com', '$2y$10$zvy281KP8sY578IdYAauYOlk/wtIcR5ERTzRMnu5He6p89M6S7asq'),
(9, 'Rigers Hida', 'Mashkull', '1983-08-30', 600300009, 'rigers.hida@mail.com', '$2y$10$YxtMOCg5WVx3575gngTIpOUdw6cObt/pG2FwExqAzF59rT0wxerFK'),
(10, 'Elton Shima', 'Mashkull', '1974-05-09', 600300010, 'elton.shima@mail.com', '$2y$10$NvtkRlN1aV7lmMmbe1EF/.EUcQQMsXfyfahQvYq3ZxkBNdQbvWW9.'),
(11, 'Anisa Duka', 'Femër', '1980-04-14', 600300011, 'anisa.duka@mail.com', '$2y$10$OogGpo8MRCw08RMNEH1UXenQUOQaV8hplmLNsgs7RrEAhkVkmb4oy'),
(12, 'Blerina Kelmendi', 'Femër', '1979-06-22', 600300012, 'blerina.kelmendi@mail.com', '$2y$10$r0QKssR/dx63xd9kxLnvSeBVVmVddDR4nfGX1beufHZk.TsUq0brG'),
(13, 'Dorina Pasha', 'Femër', '1982-10-10', 600300013, 'dorina.pasha@mail.com', '$2y$10$ksgBfDl8V0MM.wPF93W1Becn8n3RU2NWfNKNdS16HcgIRXnZVzCRC'),
(14, 'Megi Vaso', 'Femër', '1978-02-02', 600300014, 'megi.vaso@mail.com', '$2y$10$LUnSO4GxRWebtwtbBelgA.togeN0u0kUB/H0inYVRLLoJPB3dtm5W'),
(15, 'Sara Dema', 'Femër', '1977-07-19', 600300015, 'sara.dema@mail.com', '$2y$10$SNgrkZPg1TqWxYYyQc9qfuZ7Oi0sh2j7xlZleFMqw3EjnJj/ihnsC'),
(16, 'Elona Sako', 'Femër', '1981-11-11', 600300016, 'elona.sako@mail.com', '$2y$10$K6hyN1Pd.GP68dttfnTcK.mkvukTSScZGY57C0pfzef32.FyrJWmC'),
(17, 'Flutura Ndoj', 'Femër', '1975-03-03', 600300017, 'flutura.ndoj@mail.com', '$2y$10$rZyNzqAMxgs83T5TSxuRIukfwj3uqx9xFB4QDLKaXirL5s1oqiZgq'),
(18, 'Ornela Dini', 'Femër', '1976-08-08', 600300018, 'ornela.dini@mail.com', '$2y$10$mkIdYfwy05mhp5fg63SV6edUb7mA1Xuvwx7lp2Gojvq/oLAgPiuci'),
(19, 'Jona Pire', 'Femër', '1983-01-17', 600300019, 'jona.pire@mail.com', '$2y$10$TzBVBx8q2UuPdYxAOJVIRe0RYMh9qYiYqfrQ9BCjHPJOYYT/vK0c6'),
(20, 'Ledia Muka', 'Femër', '1979-09-09', 600300020, 'ledia.muka@mail.com', '$2y$10$X7slUDeou.Nm3AQ56ipx8Ok5SA.v0nB4bQK0/jbRogYT/6TngOU02'),
(21, 'Arlind Basha', 'Mashkull', '1978-04-04', 600300021, 'arlind.basha@mail.com', '$2y$10$xagWovZfeO9Q88t7yjBy7.mQXyq2jSEm32vD3RUX0/3D/upn0RvG6'),
(22, 'Endri Kodra', 'Mashkull', '1980-06-06', 600300022, 'endri.kodra@mail.com', '$2y$10$l7S75K3.Pn3v5vVxgceiq.uNMwWLTucZYKt3ZAZWf3l0cT1ny6uPK'),
(23, 'Klevi Doda', 'Mashkull', '1976-09-15', 600300023, 'klevi.doda@mail.com', '$2y$10$y86QiSuDY77EbSTO8uX9kucRszmWVoGApWF5PfBiG/42vJXhjVGMa'),
(24, 'Valon Gjoni', 'Mashkull', '1977-12-21', 600300024, 'valon.gjoni@mail.com', '$2y$10$PhLHeJE/vVg/AUNtKS.yleCaPu4j/W2wMzVJnXtHdoyWDrRcs6oUO'),
(25, 'Sokol Lushi', 'Mashkull', '1981-03-11', 600300025, 'sokol.lushi@mail.com', '$2y$10$b1eWY/ZyOCJkhlvBpgrAb.kGFgIjXeRhXgeSw0L6ECTHuy2HDHrya'),
(26, 'Ylber Domi', 'Mashkull', '1975-07-07', 600300026, 'ylber.domi@mail.com', '$2y$10$Hkt3WMlfPDnY3HtQyKe/4..Wnb1y63/2lo7aaz.9vZzgL2g6iBGKK'),
(27, 'Mikel Shyti', 'Mashkull', '1979-10-10', 600300027, 'mikel.shyti@mail.com', '$2y$10$b3MLswtEakoG35mcC3Aat./9LXlAA04grK5a9cmfmk4Kf0x7kBuXC'),
(28, 'Artur Leci', 'Mashkull', '1982-02-28', 600300028, 'artur.leci@mail.com', '$2y$10$PaTRDSdT0FEhpl4eXBJqiufsA6kXo1xG9BqPKraKL/7pNRJNKXdPG'),
(29, 'Blendi Kasa', 'Mashkull', '1974-05-05', 600300029, 'blendi.kasa@mail.com', '$2y$10$HBOjZhRZVosPRPxVqWMuLeMlkJQbo6o3RqH9MeZz2rM.mc6i/lJ5y'),
(30, 'Franci Reka', 'Mashkull', '1976-11-11', 600300030, 'franci.reka@mail.com', '$2y$10$YnOMY9ehywGvKqWxoya7nO5Yo92Au5IhzCk8DIC6J/GUpe9YtfHTe'),
(31, 'elda', 'Femër', '2026-05-07', 456789, 'eldaela@gmail.com', '$2y$10$amnz9G4hZnmRASu9vJd/Ku1Wwy8xhgBZZu5p5lps4kY3B7deB163e'),
(32, 'visi', 'Mashkull', '2026-05-07', 234567890, 'visi@gmail.com', '$2y$10$WsHQNoJCh6yoSByRFwJDFOwmTB3zbBoKQVNBrBGDHqNrCC3tTY8HC'),
(33, 'Adi', 'Mashkull', '2008-07-02', 9876543, 'adi@gmail.com', '$2y$10$/jsQS0GYlJCaclvFFYDJtunYuo/.I.x3aLgRdPPEcMc3Ov5UyR6QO'),
(35, 'lindi', 'Mashkull', '2024-02-21', 34567896, 'lindi@gmail.com', '$2y$10$p6PDxZyOcakywNCDiXul5ubryPXtGX1vPso3IpcAUwH97SXweDjHm'),
(36, 'eeeeeeee', 'Femër', '2026-05-05', 23456789, 'edfg@gmail.com', '$2y$10$IVrCxhuoSJvrTjdXZFIHl.qFH5B7Q0ezJy6jnhjP46oVomdLbFbvS');

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
(6, 2, 1, '2026-05-14', '22:03:20.000000', 'Prezent'),
(7, 2, 1, '2026-05-15', '16:08:30.000000', 'Prezent');

-- --------------------------------------------------------

--
-- Table structure for table `mungesat`
--

CREATE TABLE `mungesat` (
  `mungesaID` int(11) NOT NULL,
  `nxenesID` int(11) NOT NULL,
  `lendaID` int(11) NOT NULL,
  `klasaID` int(11) NOT NULL,
  `data` date NOT NULL,
  `ora` time NOT NULL,
  `statusi` enum('Prezent','Mungese','Me arsye') NOT NULL,
  `mesuesID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mungesat`
--

INSERT INTO `mungesat` (`mungesaID`, `nxenesID`, `lendaID`, `klasaID`, `data`, `ora`, `statusi`, `mesuesID`) VALUES
(42, 2, 7, 2, '2026-05-08', '08:00:00', 'Me arsye', 1),
(43, 2, 8, 2, '2026-05-09', '08:00:00', 'Mungese', 1),
(44, 2, 9, 2, '2026-05-10', '08:00:00', 'Prezent', 1),
(45, 3, 1, 1, '2026-05-01', '08:00:00', 'Mungese', 1),
(46, 3, 2, 1, '2026-05-02', '08:00:00', 'Mungese', 1),
(47, 3, 3, 1, '2026-05-03', '08:00:00', 'Prezent', 1),
(48, 3, 4, 1, '2026-05-04', '08:00:00', 'Me arsye', 1),
(49, 3, 5, 1, '2026-05-05', '08:00:00', 'Mungese', 1),
(50, 3, 6, 1, '2026-05-06', '08:00:00', 'Mungese', 1),
(51, 3, 7, 1, '2026-05-07', '08:00:00', 'Prezent', 1),
(52, 3, 8, 1, '2026-05-08', '08:00:00', 'Mungese', 1),
(53, 3, 9, 1, '2026-05-09', '08:00:00', 'Me arsye', 1),
(55, 61, 7, 3, '2026-05-05', '14:25:00', 'Mungese', 8),
(56, 21, 10, 10, '2026-05-13', '14:27:00', 'Mungese', 2),
(57, 21, 10, 10, '2026-05-27', '12:24:00', 'Me arsye', 2),
(58, 21, 10, 10, '2026-05-06', '20:26:00', 'Prezent', 2),
(59, 31, 2, 1, '2026-01-14', '14:27:00', 'Mungese', 2),
(60, 31, 2, 1, '2026-04-02', '15:28:00', 'Mungese', 2),
(61, 40, 2, 1, '2026-02-11', '16:29:00', 'Mungese', 2),
(62, 40, 2, 1, '2025-12-16', '14:33:00', 'Mungese', 2),
(63, 40, 2, 1, '2026-05-20', '16:30:00', 'Me arsye', 2),
(64, 2, 13, 2, '2026-05-06', '15:32:00', 'Prezent', 5),
(65, 2, 13, 2, '2026-05-01', '16:32:00', 'Mungese', 5),
(66, 2, 13, 2, '2026-01-06', '16:35:00', 'Mungese', 5),
(67, 2, 4, 2, '2026-02-04', '15:36:00', 'Mungese', 5),
(68, 2, 4, 2, '2026-03-10', '15:36:00', 'Me arsye', 5),
(69, 2, 13, 2, '2026-05-05', '15:37:00', 'Me arsye', 5),
(70, 26, 4, 12, '2026-05-19', '16:38:00', 'Mungese', 5),
(71, 56, 13, 12, '2026-05-06', '14:39:00', 'Mungese', 5),
(72, 70, 4, 12, '2026-08-17', '17:39:00', 'Mungese', 5),
(73, 70, 4, 12, '2026-05-13', '14:45:00', 'Mungese', 5),
(74, 2, 4, 12, '2026-05-07', '10:16:00', 'Mungese', 5),
(75, 2, 4, 12, '2026-02-19', '10:17:00', 'Mungese', 5);

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
(5, 'Arlind Krasniqi', 'Mashkull', '2008-05-12', 600700004, 'arlind.krasniqi@mail.com', 3, 2, '2025-01-01', 'NX005'),
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
(73, 'Drin Hoxha', 'Mashkull', '2008-02-21', 600700073, 'drin.hoxha2@mail.com', 71, 6, '2025-01-01', 'NX099'),
(74, 'Albin Dervishi', 'Mashkull', '2008-03-22', 600700074, 'albin.dervishi2@mail.com', 72, 2, '2025-01-01', 'NX074'),
(75, 'Vigan Leka', 'Mashkull', '2008-04-23', 600700075, 'vigan.leka@mail.com', 73, 3, '2025-01-01', 'NX075'),
(77, 'Kris Hysa', 'Mashkull', '2008-06-25', 600700077, 'kris.hysa@mail.com', 75, 5, '2025-01-01', 'NX077'),
(78, 'Elona Kola', 'Femër', '2008-07-26', 600700078, 'elona.kola@mail.com', 1, 6, '2025-01-01', 'NX078'),
(79, 'Bruna Berisha', 'Femër', '2008-08-27', 600700079, 'bruna.berisha@mail.com', 2, 7, '2025-01-01', 'NX079'),
(82, 'Elda elda', 'Femër', '2026-05-08', 238746289, 'eldaelda@gmail.com', 2, 1, '2026-05-29', 'K873638L'),
(83, 'visi', 'Mashkull', '2024-02-06', 34567890, 'visi23@gmail.com', 3, 1, '2026-05-12', '56gjkmn');

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

--
-- Dumping data for table `orari`
--

INSERT INTO `orari` (`id`, `klasID`, `lendaID`, `dita`, `ora_fillimit`, `ora_mbarimit`, `mesuesID`, `tremujori`) VALUES
(1, 1, 1, 'E Hënë', '08:00:00', '09:00:00', 1, '1'),
(2, 1, 2, 'E Hënë', '09:00:00', '10:00:00', 2, '1'),
(3, 1, 8, 'E Hënë', '10:00:00', '11:00:00', 3, '1'),
(4, 1, 1, 'E Hënë', '11:00:00', '12:00:00', 1, '1'),
(5, 1, 2, 'E Hënë', '12:00:00', '13:00:00', 2, '1'),
(6, 1, 2, 'E Martë', '08:00:00', '09:00:00', 2, '1'),
(7, 1, 8, 'E Martë', '09:00:00', '10:00:00', 3, '1'),
(8, 1, 1, 'E Martë', '10:00:00', '11:00:00', 1, '1'),
(9, 1, 8, 'E Martë', '11:00:00', '12:00:00', 3, '1'),
(10, 1, 2, 'E Martë', '12:00:00', '13:00:00', 2, '1'),
(11, 1, 8, 'E Mërkurë', '08:00:00', '09:00:00', 3, '1'),
(12, 1, 1, 'E Mërkurë', '09:00:00', '10:00:00', 1, '1'),
(13, 1, 2, 'E Mërkurë', '10:00:00', '11:00:00', 2, '1'),
(14, 1, 1, 'E Mërkurë', '11:00:00', '12:00:00', 1, '1'),
(15, 1, 8, 'E Mërkurë', '12:00:00', '13:00:00', 3, '1'),
(16, 1, 1, 'E Enjte', '08:00:00', '09:00:00', 1, '1'),
(17, 1, 8, 'E Enjte', '09:00:00', '10:00:00', 3, '1'),
(18, 1, 2, 'E Enjte', '10:00:00', '11:00:00', 2, '1'),
(19, 1, 8, 'E Enjte', '11:00:00', '12:00:00', 3, '1'),
(20, 1, 1, 'E Enjte', '12:00:00', '13:00:00', 1, '1'),
(21, 1, 2, 'E Premte', '08:00:00', '09:00:00', 2, '1'),
(22, 1, 1, 'E Premte', '09:00:00', '10:00:00', 1, '1'),
(23, 1, 8, 'E Premte', '10:00:00', '11:00:00', 3, '1'),
(24, 1, 2, 'E Premte', '11:00:00', '12:00:00', 2, '1'),
(25, 1, 1, 'E Premte', '12:00:00', '13:00:00', 1, '1'),
(26, 2, 3, 'E Hënë', '08:00:00', '09:00:00', 4, '1'),
(27, 2, 4, 'E Hënë', '09:00:00', '10:00:00', 5, '1'),
(28, 2, 5, 'E Hënë', '10:00:00', '11:00:00', 6, '1'),
(29, 2, 3, 'E Hënë', '11:00:00', '12:00:00', 4, '1'),
(30, 2, 4, 'E Hënë', '12:00:00', '13:00:00', 5, '1'),
(31, 2, 4, 'E Martë', '08:00:00', '09:00:00', 5, '1'),
(32, 2, 5, 'E Martë', '09:00:00', '10:00:00', 6, '1'),
(33, 2, 3, 'E Martë', '10:00:00', '11:00:00', 4, '1'),
(34, 2, 5, 'E Martë', '11:00:00', '12:00:00', 6, '1'),
(35, 2, 4, 'E Martë', '12:00:00', '13:00:00', 5, '1'),
(36, 2, 5, 'E Mërkurë', '08:00:00', '09:00:00', 6, '1'),
(37, 2, 3, 'E Mërkurë', '09:00:00', '10:00:00', 4, '1'),
(38, 2, 4, 'E Mërkurë', '10:00:00', '11:00:00', 5, '1'),
(39, 2, 3, 'E Mërkurë', '11:00:00', '12:00:00', 4, '1'),
(40, 2, 5, 'E Mërkurë', '12:00:00', '13:00:00', 6, '1'),
(41, 2, 3, 'E Enjte', '08:00:00', '09:00:00', 4, '1'),
(42, 2, 5, 'E Enjte', '09:00:00', '10:00:00', 6, '1'),
(43, 2, 4, 'E Enjte', '10:00:00', '11:00:00', 5, '1'),
(44, 2, 5, 'E Enjte', '11:00:00', '12:00:00', 6, '1'),
(45, 2, 3, 'E Enjte', '12:00:00', '13:00:00', 4, '1'),
(46, 2, 4, 'E Premte', '08:00:00', '09:00:00', 5, '1'),
(47, 2, 3, 'E Premte', '09:00:00', '10:00:00', 4, '1'),
(48, 2, 5, 'E Premte', '10:00:00', '11:00:00', 6, '1'),
(49, 2, 4, 'E Premte', '11:00:00', '12:00:00', 5, '1'),
(50, 2, 3, 'E Premte', '12:00:00', '13:00:00', 4, '1'),
(51, 1, 8, 'E Hënë', '08:00:00', '09:00:00', 3, '2'),
(52, 1, 1, 'E Hënë', '09:00:00', '10:00:00', 1, '2'),
(53, 1, 2, 'E Hënë', '10:00:00', '11:00:00', 2, '2'),
(54, 1, 8, 'E Hënë', '11:00:00', '12:00:00', 3, '2'),
(55, 1, 1, 'E Hënë', '12:00:00', '13:00:00', 1, '2'),
(56, 1, 1, 'E Martë', '08:00:00', '09:00:00', 1, '2'),
(57, 1, 2, 'E Martë', '09:00:00', '10:00:00', 2, '2'),
(58, 1, 8, 'E Martë', '10:00:00', '11:00:00', 3, '2'),
(59, 1, 1, 'E Martë', '11:00:00', '12:00:00', 1, '2'),
(60, 1, 2, 'E Martë', '12:00:00', '13:00:00', 2, '2'),
(61, 1, 2, 'E Mërkurë', '08:00:00', '09:00:00', 2, '2'),
(62, 1, 8, 'E Mërkurë', '09:00:00', '10:00:00', 3, '2'),
(63, 1, 1, 'E Mërkurë', '10:00:00', '11:00:00', 1, '2'),
(64, 1, 2, 'E Mërkurë', '11:00:00', '12:00:00', 2, '2'),
(65, 1, 8, 'E Mërkurë', '12:00:00', '13:00:00', 3, '2'),
(66, 1, 8, 'E Enjte', '08:00:00', '09:00:00', 3, '2'),
(67, 1, 1, 'E Enjte', '09:00:00', '10:00:00', 1, '2'),
(68, 1, 2, 'E Enjte', '10:00:00', '11:00:00', 2, '2'),
(69, 1, 1, 'E Enjte', '11:00:00', '12:00:00', 1, '2'),
(70, 1, 8, 'E Enjte', '12:00:00', '13:00:00', 3, '2'),
(71, 1, 1, 'E Premte', '08:00:00', '09:00:00', 1, '2'),
(72, 1, 8, 'E Premte', '09:00:00', '10:00:00', 3, '2'),
(73, 1, 2, 'E Premte', '10:00:00', '11:00:00', 2, '2'),
(74, 1, 1, 'E Premte', '11:00:00', '12:00:00', 1, '2'),
(75, 1, 2, 'E Premte', '12:00:00', '13:00:00', 2, '2'),
(76, 2, 5, 'E Hënë', '08:00:00', '09:00:00', 6, '2'),
(77, 2, 3, 'E Hënë', '09:00:00', '10:00:00', 4, '2'),
(78, 2, 4, 'E Hënë', '10:00:00', '11:00:00', 5, '2'),
(79, 2, 5, 'E Hënë', '11:00:00', '12:00:00', 6, '2'),
(80, 2, 3, 'E Hënë', '12:00:00', '13:00:00', 4, '2'),
(81, 2, 4, 'E Martë', '08:00:00', '09:00:00', 5, '2'),
(82, 2, 3, 'E Martë', '09:00:00', '10:00:00', 4, '2'),
(83, 2, 5, 'E Martë', '10:00:00', '11:00:00', 6, '2'),
(84, 2, 4, 'E Martë', '11:00:00', '12:00:00', 5, '2'),
(85, 2, 3, 'E Martë', '12:00:00', '13:00:00', 4, '2'),
(86, 2, 3, 'E Mërkurë', '08:00:00', '09:00:00', 4, '2'),
(87, 2, 5, 'E Mërkurë', '09:00:00', '10:00:00', 6, '2'),
(88, 2, 4, 'E Mërkurë', '10:00:00', '11:00:00', 5, '2'),
(89, 2, 3, 'E Mërkurë', '11:00:00', '12:00:00', 4, '2'),
(90, 2, 5, 'E Mërkurë', '12:00:00', '13:00:00', 6, '2'),
(91, 2, 5, 'E Enjte', '08:00:00', '09:00:00', 6, '2'),
(92, 2, 4, 'E Enjte', '09:00:00', '10:00:00', 5, '2'),
(93, 2, 3, 'E Enjte', '10:00:00', '11:00:00', 4, '2'),
(94, 2, 5, 'E Enjte', '11:00:00', '12:00:00', 6, '2'),
(95, 2, 4, 'E Enjte', '12:00:00', '13:00:00', 5, '2'),
(96, 2, 3, 'E Premte', '08:00:00', '09:00:00', 4, '2'),
(97, 2, 4, 'E Premte', '09:00:00', '10:00:00', 5, '2'),
(98, 2, 5, 'E Premte', '10:00:00', '11:00:00', 6, '2'),
(99, 2, 3, 'E Premte', '11:00:00', '12:00:00', 4, '2'),
(100, 2, 4, 'E Premte', '12:00:00', '13:00:00', 5, '2'),
(101, 1, 2, 'E Hënë', '08:00:00', '09:00:00', 2, '3'),
(102, 1, 1, 'E Hënë', '09:00:00', '10:00:00', 1, '3'),
(103, 1, 8, 'E Hënë', '10:00:00', '11:00:00', 3, '3'),
(104, 1, 2, 'E Hënë', '11:00:00', '12:00:00', 2, '3'),
(105, 1, 1, 'E Hënë', '12:00:00', '13:00:00', 1, '3'),
(106, 1, 8, 'E Martë', '08:00:00', '09:00:00', 3, '3'),
(107, 1, 2, 'E Martë', '09:00:00', '10:00:00', 2, '3'),
(108, 1, 1, 'E Martë', '10:00:00', '11:00:00', 1, '3'),
(109, 1, 8, 'E Martë', '11:00:00', '12:00:00', 3, '3'),
(110, 1, 2, 'E Martë', '12:00:00', '13:00:00', 2, '3'),
(111, 1, 1, 'E Mërkurë', '08:00:00', '09:00:00', 1, '3'),
(112, 1, 8, 'E Mërkurë', '09:00:00', '10:00:00', 3, '3'),
(113, 1, 2, 'E Mërkurë', '10:00:00', '11:00:00', 2, '3'),
(114, 1, 1, 'E Mërkurë', '11:00:00', '12:00:00', 1, '3'),
(115, 1, 8, 'E Mërkurë', '12:00:00', '13:00:00', 3, '3'),
(116, 1, 2, 'E Enjte', '08:00:00', '09:00:00', 2, '3'),
(117, 1, 1, 'E Enjte', '09:00:00', '10:00:00', 1, '3'),
(118, 1, 8, 'E Enjte', '10:00:00', '11:00:00', 3, '3'),
(119, 1, 2, 'E Enjte', '11:00:00', '12:00:00', 2, '3'),
(120, 1, 1, 'E Enjte', '12:00:00', '13:00:00', 1, '3'),
(121, 1, 8, 'E Premte', '08:00:00', '09:00:00', 3, '3'),
(122, 1, 1, 'E Premte', '09:00:00', '10:00:00', 1, '3'),
(123, 1, 2, 'E Premte', '10:00:00', '11:00:00', 2, '3'),
(124, 1, 8, 'E Premte', '11:00:00', '12:00:00', 3, '3'),
(125, 1, 1, 'E Premte', '12:00:00', '13:00:00', 1, '3'),
(126, 2, 4, 'E Hënë', '08:00:00', '09:00:00', 5, '3'),
(127, 2, 5, 'E Hënë', '09:00:00', '10:00:00', 6, '3'),
(128, 2, 3, 'E Hënë', '10:00:00', '11:00:00', 4, '3'),
(129, 2, 4, 'E Hënë', '11:00:00', '12:00:00', 5, '3'),
(130, 2, 5, 'E Hënë', '12:00:00', '13:00:00', 6, '3'),
(131, 2, 3, 'E Martë', '08:00:00', '09:00:00', 4, '3'),
(132, 2, 4, 'E Martë', '09:00:00', '10:00:00', 5, '3'),
(133, 2, 5, 'E Martë', '10:00:00', '11:00:00', 6, '3'),
(134, 2, 3, 'E Martë', '11:00:00', '12:00:00', 4, '3'),
(135, 2, 4, 'E Martë', '12:00:00', '13:00:00', 5, '3'),
(136, 2, 5, 'E Mërkurë', '08:00:00', '09:00:00', 6, '3'),
(137, 2, 3, 'E Mërkurë', '09:00:00', '10:00:00', 4, '3'),
(138, 2, 4, 'E Mërkurë', '10:00:00', '11:00:00', 5, '3'),
(139, 2, 5, 'E Mërkurë', '11:00:00', '12:00:00', 6, '3'),
(140, 2, 3, 'E Mërkurë', '12:00:00', '13:00:00', 4, '3'),
(141, 2, 4, 'E Enjte', '08:00:00', '09:00:00', 5, '3'),
(142, 2, 5, 'E Enjte', '09:00:00', '10:00:00', 6, '3'),
(143, 2, 3, 'E Enjte', '10:00:00', '11:00:00', 4, '3'),
(144, 2, 4, 'E Enjte', '11:00:00', '12:00:00', 5, '3'),
(145, 2, 5, 'E Enjte', '12:00:00', '13:00:00', 6, '3'),
(146, 2, 3, 'E Premte', '08:00:00', '09:00:00', 4, '3'),
(147, 2, 5, 'E Premte', '09:00:00', '10:00:00', 6, '3'),
(148, 2, 4, 'E Premte', '10:00:00', '11:00:00', 5, '3'),
(149, 2, 3, 'E Premte', '11:00:00', '12:00:00', 4, '3'),
(150, 2, 5, 'E Premte', '12:00:00', '13:00:00', 6, '3'),
(151, 1, 13, 'E Hënë', '08:00:00', '09:00:00', 5, '1'),
(152, 1, 13, 'E Merkurë', '08:00:00', '09:00:00', 5, '1'),
(153, 1, 13, 'E Mërkurë', '08:00:00', '09:00:00', 5, '1'),
(154, 1, 13, 'E Enjte', '08:00:00', '09:00:00', 5, '1');

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

--
-- Dumping data for table `pagesat`
--

INSERT INTO `pagesat` (`id`, `studentID`, `prindID`, `klasID`, `shuma`, `transactionID`, `metodaPageses`, `dataPageses`, `muaji`, `afati`, `statusi`) VALUES
(2, 2, 2, 2, 35000, 100002, 'PayPal', '2026-05-03', 'Maj', '2026-05-10', 'Paguar'),
(3, 7, 5, 3, 28000, 100003, 'PayPal', '2026-05-05', 'Maj', '2026-05-10', 'Ne proces'),
(17, 3, 1, 1, 30000, 100004, 'PayPal', '2026-01-05', 'Janar', '2026-01-10', 'Paguar'),
(18, 3, 1, 1, 30000, 100005, 'PayPal', '2026-02-06', 'Shkurt', '2026-02-10', 'Paguar'),
(19, 3, 1, 1, 30000, 100006, 'PayPal', '2026-03-04', 'Mars', '2026-03-10', 'Paguar'),
(20, 3, 1, 1, 30000, 100007, 'PayPal', '2026-04-03', 'Prill', '2026-04-10', 'Paguar'),
(21, 3, 1, 1, 30000, 100008, 'PayPal', '2026-05-07', 'Maj', '2026-05-10', 'Ne proces'),
(22, 3, 1, 1, 30000, 100009, 'PayPal', '2026-06-06', 'Qershor', '2026-06-10', 'Ne proces');

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
(1, 'Arben Hoxha', 'Mashkull', '1980-05-12', 691234567, 'arben.hoxha@gmail.com', '$2y$10$Bs5140X2w6kte0BQProJ1OoE5xKrOzmhCUyJqdaruF4o1Lr0GW6YS'),
(2, 'Elira Dervishi', 'Femër', '1985-09-20', 689876543, 'elira.dervishi@gmail.com', '$2y$10$6DZvhye9kbCILV.TRqXQaOZuRHDcs6OeSHFyMgRwyJZcbcY4rqYWK'),
(3, 'Ilir Krasniqi', 'Mashkull', '1978-06-21', 600111112, 'ilir.krasniqi2@mail.com', '$2y$10$niwe7jZQhUqERBPACQmxDOM.9unzM0dWrDJlXTFaLtS6uRWPIz/32'),
(4, 'Dritan Berisha', 'Mashkull', '1972-01-10', 600111113, 'dritan.berisha3@mail.com', '$2y$10$u3WMdbZXvwa9C1vNjmhFa.LvhpBdXwaB0PbbPpRb8Q/d52zFEN2hK'),
(5, 'Erion Gashi', 'Mashkull', '1980-09-15', 600111114, 'erion.gashi4@mail.com', '$2y$10$oMhBeEuOWLxTTqOxugEUuuCb9ot4HYkBeuWS6CTUA9lVzzecA32d.'),
(6, 'Blerim Meta', 'Mashkull', '1976-11-03', 600111115, 'blerim.meta5@mail.com', '$2y$10$zFjVvkM8K.XlytYF/RxKceeuTEuMoAw5eanDehdaGmIfatT/zqgau'),
(7, 'Altin Dervishi', 'Mashkull', '1979-02-18', 600111116, 'altin.dervishi6@mail.com', '$2y$10$PBkuuCaoJN.meDDfzk6ewue1hPAT/Yk.KDp7cynKcx1KcTXJIJYx.'),
(8, 'Gentian Leka', 'Mashkull', '1974-07-09', 600111117, 'gentian.leka7@mail.com', '$2y$10$uTjb4hPcg72zkwpEuOiFs.kWFdGs5LehOoBWjKYGE2QPCirsHuMo2'),
(9, 'Shkëlzen Mullai', 'Mashkull', '1973-03-22', 600111118, 'shkelzen.mullai8@mail.com', '$2y$10$BImlQQuUaLVx233mcrsRme2PaSPAjJvAbCc3CPs/tx3tMObYR0M46'),
(10, 'Ardit Basha', 'Mashkull', '1977-12-01', 600111119, 'ardit.basha9@mail.com', '$2y$10$2p4i0rcqW1da7cg63iNWMun4FraRy/GARPVavqlCVG/q1BdWgIxey'),
(11, 'Besnik Rama', 'Mashkull', '1971-05-27', 600111120, 'besnik.rama10@mail.com', '$2y$10$zLAo/uoPgEEAPuxkrTiVVeljgAS8KhB98jnvp.JV5u68s2Zfxj1oy'),
(12, 'Luan Shehu', 'Mashkull', '1975-10-14', 600111121, 'luan.shehu11@mail.com', '$2y$10$m/43Xh1Uapd04VOxh7xRg.MOCRfhNlPFGe9jOqbW/AaDYcxwZt6cK'),
(13, 'Florian Kola', 'Mashkull', '1976-08-30', 600111122, 'florian.kola12@mail.com', '$2y$10$jX1rI48caJbfTJZxggSDOuUGDZgqVKdo.JHopytHNJtu4DcIJ6bZ6'),
(14, 'Endrit Prifti', 'Mashkull', '1978-01-19', 600111123, 'endrit.prifti13@mail.com', '$2y$10$qiCViaRSGdIOuIldMfhk1.aZS/v08Ur/W3nAdOUbVsPL.tG4oLwc2'),
(15, 'Klevis Kondi', 'Mashkull', '1979-04-25', 600111124, 'klevis.kondi14@mail.com', '$2y$10$wXfgja5egbM7GC2FZoNFmOQFdmlcjuiO5xAHStAH29lX8B5xT9ipC'),
(16, 'Arlind Ismaili', 'Mashkull', '1972-06-17', 600111125, 'arlind.ismaili15@mail.com', '$2y$10$8N7cZBuUqNdt576XmmW.P.OeF9Za9sqLgpWcypNLD9j26ci1YMkVG'),
(17, 'Valmir Zeqiri', 'Mashkull', '1973-09-08', 600111126, 'valmir.zeqiri16@mail.com', '$2y$10$SLCIs8ehNEvmOWBcot/oRuN0CGxp7nGvDTa1pwtfJN5klegMGcum6'),
(18, 'Sokol Ahmeti', 'Mashkull', '1977-11-11', 600111127, 'sokol.ahmeti17@mail.com', '$2y$10$d4u5aUZjGDf4A6FyRICPD.ZNb3qfsNBOkyHmFVl0vvGu2yKJvLuXq'),
(19, 'Ylli Veseli', 'Mashkull', '1974-02-02', 600111128, 'ylli.veseli18@mail.com', '$2y$10$AKPQySR.stKYO7mQLh6l0uD5Alpf7yq779iA97lMRgi/gCIDe2miq'),
(20, 'Mandi Marku', 'Mashkull', '1976-03-13', 600111129, 'mandi.marku19@mail.com', '$2y$10$mci.00DYprRk1REKNzBUj.TH2FIzMFLg0vupvLp7vI9PF587RvJt.'),
(21, 'Artan Luci', 'Mashkull', '1975-12-29', 600111130, 'artan.luci20@mail.com', '$2y$10$6OqNkekJ7I1J5S7n1FKAD.rG9qLs7.I3lWf9unfJuP48mddQC9HXq'),
(22, 'Elira Hoxha', 'Femër', '1978-05-05', 600111131, 'elira.hoxha21@mail.com', '$2y$10$1IzQtbQXlMxM7PXAZa6gDeluJ6THKX3NbON7StOnH8g83psli82Pu'),
(23, 'Arta Krasniqi', 'Femër', '1976-07-07', 600111132, 'arta.krasniqi22@mail.com', '$2y$10$gwt4VsHqABNaioDBlfxi1eGzVziwijO9p7SVdPlpsKH8zw3GbqKjC'),
(24, 'Linda Berisha', 'Femër', '1979-09-09', 600111133, 'linda.berisha23@mail.com', '$2y$10$HRy8e5X1DMDYerSTRwgDzelVGC3BytM2W/ZJEhfedWJlerZaTLlXu'),
(25, 'Jona Gashi', 'Femër', '1974-11-11', 600111134, 'jona.gashi24@mail.com', '$2y$10$ZQ1nDgtpHv6F9qdcvvqtgeWB/RC3xZa/HZA..C/LnN6srbqrBSbsy'),
(26, 'Dona Meta', 'Femër', '1973-02-14', 600111135, 'dona.meta25@mail.com', '$2y$10$SYNE3SDs4WsSXLA/XixAOOTy/nXJggLIZn9Dzfi1myulGuIDOlq7C'),
(27, 'Mira Dervishi', 'Femër', '1977-03-16', 600111136, 'mira.dervishi26@mail.com', '$2y$10$bZ6mbOQLn04fFLmgRii.v.y6U.Mcyj6Z1T2CnT5SRT83PGkTZqhmi'),
(28, 'Anisa Leka', 'Femër', '1975-06-18', 600111137, 'anisa.leka27@mail.com', '$2y$10$b54M2QYw9sI3xUWYJAMDq.mRM28cOKHtZ795YS/McdKJLYq.PNIcq'),
(29, 'Erisa Mullai', 'Femër', '1978-08-20', 600111138, 'erisa.mullai28@mail.com', '$2y$10$p5MdaxwExxDPnGJMZtA8F.HG3vdFQfaTCz/xem/xwI/5xZv2AWL72'),
(30, 'Klea Basha', 'Femër', '1976-10-22', 600111139, 'klea.basha29@mail.com', '$2y$10$nOjuAvw7MUZ8YDaPVtDAIenWpckU2tCN09Kutx7sx0S8qm561r8z2'),
(31, 'Valbona Rama', 'Femër', '1979-12-24', 600111140, 'valbona.rama30@mail.com', '$2y$10$MYJvVi47o7AzKlKGIIgkh.bevxhleSXK0/5Say9yvGoPTu3yqjhjO'),
(32, 'Adrian Doda', 'Mashkull', '1975-03-10', 600111135, 'adrian.doda26@mail.com', '$2y$10$f.K4Oq8DTPGgCjpA1bzrCOnIlzpwyInULItRRcgdKLcDfMhFLqD2m'),
(33, 'Bujar Hysa', 'Mashkull', '1976-06-18', 600111136, 'bujar.hysa27@mail.com', '$2y$10$7T0fX3DBEz73mpJML5lrTeLxKy14e2yCY1qjQmKPoRgPZZENepPxy'),
(34, 'Gent Malaj', 'Mashkull', '1973-09-22', 600111137, 'gent.malaj28@mail.com', '$2y$10$38cPOwhPCXmlUtW9kw1lU.GELvJbxI0IiFNQ1Ax15fBLvKnuRzRGm'),
(35, 'Ilir Pasha', 'Mashkull', '1978-12-05', 600111138, 'ilir.pasha29@mail.com', '$2y$10$2Dv1IYqmVxSFjkmfM1VwDuv.yHriAquX7cclxdg/OH0SNC679kvj6'),
(36, 'Arben Lika', 'Mashkull', '1972-04-14', 600111139, 'arben.lika30@mail.com', '$2y$10$hrwPCJXMP6IFD3EEPtkhpume9dshA5PvNWdz.xEDuMg67fTpB5PYK'),
(37, 'Erjon Duka', 'Mashkull', '1977-07-19', 600111140, 'erjon.duka31@mail.com', '$2y$10$ds0SuOqoCJUb9aNIIEtVr.w9T/QQk4n413gmlGTSeLVeAL4MjsaU2'),
(38, 'Leonard Sula', 'Mashkull', '1975-11-11', 600111141, 'leonard.sula32@mail.com', '$2y$10$kA4G1lcl0MX.Flxfv/o1/u49fFtf5q9YfsjCZl/QFcECSyV3b/tCC'),
(39, 'Altin Qerimi', 'Mashkull', '1979-02-25', 600111142, 'altin.qerimi33@mail.com', '$2y$10$XVl8savQmlP7ZUAIz2i5te0THELsWLZhEIqItfe0Lhjeh8HUd3iOq'),
(40, 'Saimir Kola', 'Mashkull', '1974-08-30', 600111143, 'saimir.kola34@mail.com', '$2y$10$BA80MADh64oadG3MsD3yTeGyaul2RRiFjFn4xVSQ47FdlSqW5yeLG'),
(41, 'Dorian Meta', 'Mashkull', '1976-01-17', 600111144, 'dorian.meta35@mail.com', '$2y$10$tXXV4m3chRB2shJ52.mRk.RwelnuybUJwE5IY7yJPfMBgZfwQEXIi'),
(42, 'Elona Hoxha', 'Femër', '1978-03-03', 600111145, 'elona.hoxha36@mail.com', '$2y$10$cciT6KSu91cAAvNUpWlEKeeS2zWIwRlG77n.cp9CW5d00fB.JSTO.'),
(43, 'Arta Dervishi', 'Femër', '1977-05-20', 600111146, 'arta.dervishi37@mail.com', '$2y$10$hBB1bHvuEDeZpwNhKVWj9.CLiEEeq3yztBkyWrbjOXFq4mW.LDmZK'),
(44, 'Jona Leka', 'Femër', '1975-09-09', 600111147, 'jona.leka38@mail.com', '$2y$10$lg9aqy0TbxdCNMae4lvlm.IjaqIupxCEzy88JyGAqxis01ZkYeANK'),
(45, 'Mira Berisha', 'Femër', '1976-12-12', 600111148, 'mira.berisha39@mail.com', '$2y$10$85W3hCm8I70N3agIRfbMIO1PSwwDSHENlOUkE.d6Ym2tTyO/a0Ke.'),
(46, 'Linda Gashi', 'Femër', '1974-07-07', 600111149, 'linda.gashi40@mail.com', '$2y$10$JeaT1g5UyadJnX.oDtcDpOJFUL/s8n9QNGZQb2mNNy.dcrj0vaswW'),
(47, 'Valbona Krasniqi', 'Femër', '1979-01-11', 600111150, 'valbona.krasniqi41@mail.com', '$2y$10$Ma3UXZhbUf4fmuowzBjYz.4pnFMwP2iH0ArmTJgkzliqAwJPTsenO'),
(48, 'Besa Rama', 'Femër', '1973-10-10', 600111151, 'besa.rama42@mail.com', '$2y$10$KnRxHqyFJKdh3nVEg8AIb.dAhUrthaMvrcnGQSazsgSrIjnBe77AC'),
(49, 'Ornela Prifti', 'Femër', '1978-06-06', 600111152, 'ornela.prifti43@mail.com', '$2y$10$Zjg1V4uvgUhxQsktAcmCiucoG6gVsgGYgqxR8UcalPcJvREYt.EdC'),
(50, 'Fjolla Ismaili', 'Femër', '1975-02-02', 600111153, 'fjolla.ismaili44@mail.com', '$2y$10$nc/I5NixTipwWbmWgxSSouzPdEOcynqIJGOEX5lI0.CnoWK.EBOHG'),
(51, 'Elda Kodra', 'Femër', '1977-04-04', 600111154, 'elda.kodra45@mail.com', '$2y$10$ptjGNxbCRE56YjT2w7LyZOtiFr12yTCbK3nMTLOrztANkLvET6Hai'),
(52, 'Ardit Nika', 'Mashkull', '1972-09-09', 600111155, 'ardit.nika46@mail.com', '$2y$10$0FkK5n3F23ViH.3/B54xjOeqws8r53438Me4n9tjAkbgm6PXg4ete'),
(53, 'Flamur Shehu', 'Mashkull', '1976-03-13', 600111156, 'flamur.shehu47@mail.com', '$2y$10$hIoJwejwpzrVPu9p8djrjOAIfMadXsGaS1kSHqW9ad.d3VIeRQgmK'),
(54, 'Besmir Zeka', 'Mashkull', '1975-05-25', 600111157, 'besmir.zeka48@mail.com', '$2y$10$Nqanz7GBHl26fvdZh1pliO24Pg.U0MYyawoFtKOIbg1dAwLwhm2EO'),
(55, 'Endri Lleshi', 'Mashkull', '1978-08-18', 600111158, 'endri.lleshi49@mail.com', '$2y$10$nJgeLlAwGBXGkPmgQSuGJuxJrDIM8GUCSE0ezNhnkB.Z9ut3VTkBu'),
(56, 'Klevis Hoxha', 'Mashkull', '1974-11-21', 600111159, 'klevis.hoxha50@mail.com', '$2y$10$R2BXdQqvi9TBOu37QJzUXOGhOtsgPpqSyLIAKFnGGLC1KNDI30FPy'),
(57, 'Arlinda Meta', 'Femër', '1976-06-16', 600111160, 'arlinda.meta51@mail.com', '$2y$10$lbI/C9x0X70Q3LTrSeH1eOa91hlo/1n3Pprhx7JUEI2pEehPSPciW'),
(58, 'Drita Kola', 'Femër', '1977-07-27', 600111161, 'drita.kola52@mail.com', '$2y$10$2ZXab/PgXoUi7PWpPwKSOOxixXFPFpma0mac0uXwnqyNLRN.8Ya5a'),
(59, 'Shpresa Gjoni', 'Femër', '1979-09-19', 600111162, 'shpresa.gjoni53@mail.com', '$2y$10$qgdwH3osj1F8a.P2BoZAPON6yVdPIVsHTdKEk4oi4i9HtZpTsgJTG'),
(60, 'Nora Doda', 'Femër', '1975-12-22', 600111163, 'nora.doda54@mail.com', '$2y$10$12yjiK6OTF3V9SUDtjbSPOoSTP4jmHUM0RToNpusQbfkUhbaP5Jtu'),
(61, 'Elvisa Hysa', 'Femër', '1973-03-30', 600111164, 'elvisa.hysa55@mail.com', '$2y$10$ZRol112cwsji.GQVFySinuK1mxWE8t46X6403RSigQP8p2nGDmIOu'),
(62, 'Ervin Pjetri', 'Mashkull', '1972-01-01', 600111165, 'ervin.pjetri56@mail.com', '$2y$10$vRTdJ3NIxH3X/E/J6k0LQelyYFmxFeJ2TdEl6YJaBzoR8F3CeKcOe'),
(63, 'Julian Bega', 'Mashkull', '1976-02-14', 600111166, 'julian.bega57@mail.com', '$2y$10$Fshw56W92NOG6s.Zl.HzGeCoXCw5uALam/4QOvW7PgPix1duGo9QK'),
(64, 'Sokol Dervishi', 'Mashkull', '1978-04-28', 600111167, 'sokol.dervishi58@mail.com', '$2y$10$KezUoIVfDKNlhn5yvT/gfuEQjYuMJTixQHvAMSEP9sXZFUt6j93mO'),
(65, 'Luan Duka', 'Mashkull', '1974-06-06', 600111168, 'luan.duka59@mail.com', '$2y$10$YJTxXSlk6zUMlA2jQ/SX2.9yS9pbn5rSTOAUO3Ox2v9ikDiPCXQAK'),
(66, 'Artur Kodra', 'Mashkull', '1977-08-08', 600111169, 'artur.kodra60@mail.com', '$2y$10$obGFghlYMcMJeXqofaRE1uBxfuA9csOsc2KrTrS0VsRPKZpqgetFy'),
(67, 'Elira Pasha', 'Femër', '1975-05-15', 600111170, 'elira.pasha61@mail.com', '$2y$10$nTD/JArczfjs76IvE2Lp.uKkMiEe9synDZ62srXC0dXxfwU0dEd3G'),
(68, 'Mirela Lika', 'Femër', '1978-10-10', 600111171, 'mirela.lika62@mail.com', '$2y$10$Tk7VG1vmA5puGjq8io46k.sYMN.qHgouXleAD83f3lG5116uUWkmy'),
(69, 'Jona Hoxha', 'Femër', '1976-11-11', 600111172, 'jona.hoxha63@mail.com', '$2y$10$tgEBvMD2.q5Q21jurJpmY.yLQXqLvIAyEfmBn/uNcKR5dmFtw1vMq'),
(70, 'Valentina Meta', 'Femër', '1979-01-23', 600111173, 'valentina.meta64@mail.com', '$2y$10$x0JhdCrcXYloIgNMFenmkukOGaYsjJoJFzl.shcN7JsUyBbx4PKDe'),
(71, 'Arta Sula', 'Femër', '1974-02-28', 600111174, 'arta.sula65@mail.com', '$2y$10$eJru9sjAgCDlyVTE6JKymu7NutZYfRMkoNqvBJc.nynUgunEK8is.'),
(72, 'Blerim Lleshi', 'Mashkull', '1973-03-03', 600111175, 'blerim.lleshi66@mail.com', '$2y$10$J2wV0FlYCXcU9Z5pKDTofOfhggHBxKOltRJDcY3RKWwqQ6zDQ4Vbm'),
(73, 'Dritan Kola', 'Mashkull', '1977-04-14', 600111176, 'dritan.kola67@mail.com', '$2y$10$CXeR3QgfoWAQgytWieKVBOIbXk5lNcIM2yk2MiFMv5fYJJHIlRo7W'),
(74, 'Gentian Hysa', 'Mashkull', '1975-06-25', 600111177, 'gentian.hysa68@mail.com', '$2y$10$f4mkr0ELHx7P0wOKJhBnjeHi9FqbnOGk985GWISfIacqDnxuNapqe'),
(75, 'Ilir Meta', 'Mashkull', '1978-09-09', 600111178, 'ilir.meta69@mail.com', '$2y$10$nCi4AdMgFzioW6gmirk2wemlGEVXqdoMKMSyB.BZznXgNVlCiwgeu'),
(76, 'Arben Gashi', 'Mashkull', '1972-12-12', 600111179, 'arben.gashi70@mail.com', '$2y$10$m3zX7z4CnEFDFJgtBtJcCepgqR5Vn5mrl1v9HvdgFQn.488f9y9Qa'),
(77, 'Linda Kola', 'Femër', '1976-01-19', 600111180, 'linda.kola71@mail.com', '$2y$10$UVKe5aj5yJgXOSzFF9aGreegBbw863Y5eeSeA0w5WXR9TCkzBX1eq'),
(78, 'Besa Dervishi', 'Femër', '1977-02-20', 600111181, 'besa.dervishi72@mail.com', '$2y$10$9XLxNaFAJ4g/41GOwpOSreEkkDtAw5OjdObYdfKMxx8kbe/yMkSIy'),
(79, 'Elona Leka', 'Femër', '1975-03-21', 600111182, 'elona.leka73@mail.com', '$2y$10$14HCyhH9F6Kw/rksJ0BkcuQ84BkSOTkEhwPSfLKidZk44QUDJtFaq'),
(80, 'Ornela Hoxha', 'Femër', '1979-04-22', 600111183, 'ornela.hoxha74@mail.com', '$2y$10$Ajmpl/E1ZCRzS.mgUPF4Q.muh0mjrqCLB7vSDhdv5rSoNIYL5I/au'),
(81, 'Mira Gashi', 'Femër', '1974-05-23', 600111184, 'mira.gashi75@mail.com', '$2y$10$1xohfmLLxCWfKdf2zOaRQ.ROzIQi6u3mEpwn2373TKQw/G4OZ8B2a'),
(82, 'arlind', 'Mashkull', '2026-04-23', 98765445, 'arlind@gmail.com', '$2y$10$1fcfcP9dfQXcQ2gOyqCPceFFR/G46QjLezZW2I2YVTZgToRkJBxkO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fjalekalim` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `reference_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `fjalekalim`, `role`, `reference_id`) VALUES
(1, 'arben.hoxha@gmail.com', '$2y$10$8tLwvQwH2Zfn7iMDDOA9ROjL250e4t1t/SzZQ/XWudAlj2Y6o2GSe', 'parent', 1),
(2, 'elira.dervishi@gmail.com', '$2y$10$UDAW3YOh5YD.HHFvvgzHU.JUUIIkBseWMRT6XQZgZ8wg3wVc8N6du', 'parent', 2),
(3, 'ilir.krasniqi2@mail.com', '$2y$10$knd1fhICsCEoEEdx5i3X5.Ye7qKkdzdLGxfZ8129qKe.ylr9zQysu', 'parent', 3),
(4, 'dritan.berisha3@mail.com', '$2y$10$LrVKlpHBygW6Tnw2LdE5/uCmnlKBMtlmScfK6vmbcfeE7xya9XwDW', 'parent', 4),
(5, 'erion.gashi4@mail.com', '$2y$10$OYtcVOQOVSUgAWIORBJTH.tk6fbhJWtuMOoYXwWmNcZgOcAIsZ3rG', 'parent', 5),
(6, 'blerim.meta5@mail.com', '$2y$10$.WJ0bQ7V6H1EEkCohvbHK.XCmiwk97FGm8X3O71qsLGD0fzTf60sO', 'parent', 6),
(7, 'altin.dervishi6@mail.com', '$2y$10$v3K6502lnMl5rAY8AtAzFexuJyL3Uku/V4PKABF8FlOVOhLqQt4/G', 'parent', 7),
(8, 'gentian.leka7@mail.com', '$2y$10$he/9sdNUBBi6qYkRdhwOMuMpZDF29DAAHgIopLvTQCyPWRuBS7ksm', 'parent', 8),
(9, 'shkelzen.mullai8@mail.com', '$2y$10$BZFopFVLejFcDerYexQchelvikaEpcgV6xvkkIXRUyIy9IR2JKB/6', 'parent', 9),
(10, 'ardit.basha9@mail.com', '$2y$10$kaPEeVwcx6YzjJaWqi0NPu6.BC13sypdvVpWWg9hjUTTZCmbjxOPy', 'parent', 10),
(11, 'besnik.rama10@mail.com', '$2y$10$3cV2xCtvjh5LDBM4wbGfo.YeHuIJT9tmKWKrNVfmjT2g9oE4WE1/S', 'parent', 11),
(12, 'luan.shehu11@mail.com', '$2y$10$8GbETaUCnney/3sVv/iMrOdFtUxYAvAnrpN19E6t1SkHxE64sB.py', 'parent', 12),
(13, 'florian.kola12@mail.com', '$2y$10$iL9twD/Wp8IhAIcdlO/Q9eMQRbR9XytM8xbx5NAl8mT5EBDQ9y3kK', 'parent', 13),
(14, 'endrit.prifti13@mail.com', '$2y$10$0q5n2baJ8YuSzT7H95OcUuhNQY.c51BKVzC50PIEkLbH6qtlM6hF2', 'parent', 14),
(15, 'klevis.kondi14@mail.com', '$2y$10$18.QGHBy5TJrQIzzQLJprefqFVZ8FoQ6WujYZJocRMcsxEBzIcZgq', 'parent', 15),
(16, 'arlind.ismaili15@mail.com', '$2y$10$pk0x2AOj5qCkGY0uQ/ehT.SkQTaU12AYtGeJT7sLXKGq0YkTj5amK', 'parent', 16),
(17, 'valmir.zeqiri16@mail.com', '$2y$10$3sqcmJb2nmsGPfKFq/Mzmu8tAIIi7hEBXps8sOzAAiWWrzQW2LSUK', 'parent', 17),
(18, 'sokol.ahmeti17@mail.com', '$2y$10$AB45RO.2KgnGTC84aXMKU.CP8/nHjZKKEYe12W6e2aAUribVszTHm', 'parent', 18),
(19, 'ylli.veseli18@mail.com', '$2y$10$wC67an4BqXdvpNe7AGqTXOWhaTkZNOFWPw0hQfpNUpOtA7ArsK1l6', 'parent', 19),
(20, 'mandi.marku19@mail.com', '$2y$10$dz2sBj9N/AA3v2GuQkdo5up04sEcTolaBlZeNOd4DOyKu2vQzKelW', 'parent', 20),
(21, 'artan.luci20@mail.com', '$2y$10$xSsC0SCnoD/XUEcMTqOObugukHK3TkZQNXVQZIK2E2UKjTEOY6sa.', 'parent', 21),
(22, 'elira.hoxha21@mail.com', '$2y$10$lUMjOYs/vKyMyYlgRZ40ee6NLZtMlKDVHV4TBroa6wuZ5YII.MVKq', 'parent', 22),
(23, 'arta.krasniqi22@mail.com', '$2y$10$diweU9RRRtAw8JzBW7HJIuF6TQ/0A3Y3KkvBjX3aPUZhPfTqWsDGC', 'parent', 23),
(24, 'linda.berisha23@mail.com', '$2y$10$9tizIBumDI/OZHTPE/7SfuhjwMXZbAKo/oH6j43BzBRzBR.Flx5We', 'parent', 24),
(25, 'jona.gashi24@mail.com', '$2y$10$DiME4NHgQPdmLHG9egNnE.g8TDItmQdtevd8UzcB1c7ook1cPOsmu', 'parent', 25),
(26, 'dona.meta25@mail.com', '$2y$10$HDJBsN/AY59LBaRc1P7O3e00fZdCKuKfDKB63Njyqe3Jj1TLpaJHi', 'parent', 26),
(27, 'mira.dervishi26@mail.com', '$2y$10$7J1CoRgqV6N.mM2vOjq2EODFq8JgwqEI74qCKbocQTs.0RzYbupzu', 'parent', 27),
(28, 'anisa.leka27@mail.com', '$2y$10$Qcx0.GmoUPLkgGmuuyz7S.sqdcDVeclxof4b.dWZy/FIYbIhoius.', 'parent', 28),
(29, 'erisa.mullai28@mail.com', '$2y$10$yY73NmDIQBT6jilUX9D6S.oJfTDWmaNDtGa3k9wBtaax61PLCYMI2', 'parent', 29),
(30, 'klea.basha29@mail.com', '$2y$10$j9e/1FSM/8OOnO0L8FlMzOj5aJ4icys9OOW8KTWjcT8niYAbJSueG', 'parent', 30),
(31, 'valbona.rama30@mail.com', '$2y$10$dc31MgCOfLDnmLOW0Dseg.CrFXVqspEbQB9QM1pIs5lq0p.wIo/Ma', 'parent', 31),
(32, 'adrian.doda26@mail.com', '$2y$10$5Ll.F./34VMrQ8nUKGekPe.v4VUsLJposcN6gjHmt6GtSFm1jDteq', 'parent', 32),
(33, 'bujar.hysa27@mail.com', '$2y$10$wi44dFNEAy3D6SOGTD8Al.p8P3bCG/FvAqnVfXhbWJ.jsxfQlJ5cq', 'parent', 33),
(34, 'gent.malaj28@mail.com', '$2y$10$O700KaPpCPCnUHmlrx5uQOQEnZe4Z/w9LtAmM135CSzsYeDRhkg/u', 'parent', 34),
(35, 'ilir.pasha29@mail.com', '$2y$10$rGjrgLR.OW3/G5H0mcBvieTbPc2Xhy.4VjSUWwXzS7HQIC3jZz47O', 'parent', 35),
(36, 'arben.lika30@mail.com', '$2y$10$MdBSUO3mZByF3Pv9Uv1BQOBDCRNjqncYLU4k8AyO4UcIdLyljO5X2', 'parent', 36),
(37, 'erjon.duka31@mail.com', '$2y$10$Sb0yWkS1klcinVrBeQogOeV.RKMOjj0l.to8Ispka69ECBlrDvXue', 'parent', 37),
(38, 'leonard.sula32@mail.com', '$2y$10$xBvuUy2ehG6Z0EokE4lSR.fEQyY9J8rjBimUHekQvz2qnAnwyv1qa', 'parent', 38),
(39, 'altin.qerimi33@mail.com', '$2y$10$/XHX.9guQ5EbWfCwNtVqtuQkRQ4fL.DOJVMc0yhiUtycXIz.ALZNe', 'parent', 39),
(40, 'saimir.kola34@mail.com', '$2y$10$3Ba8vIzNtN6Sgwp09odaPuCPvSpS7RnaNQgtKL9Vezwsc4gF2gI0.', 'parent', 40),
(41, 'dorian.meta35@mail.com', '$2y$10$keRDSHAmnh9Fdg/zs5RSruseHiS3DZ9pPxuYEl6oG9SP6g/WW2h.O', 'parent', 41),
(42, 'elona.hoxha36@mail.com', '$2y$10$KMhYVzZwaJniy8nN9WqlQugNKtq6MDC7fL756lvMzW4WrNoS4bfhW', 'parent', 42),
(43, 'arta.dervishi37@mail.com', '$2y$10$Se6puObEZWvlN0UaC7rY.OfKLfKRAQW.V3Ws6E3H1ItNJZ6Gmr5ee', 'parent', 43),
(44, 'jona.leka38@mail.com', '$2y$10$5VrToa2XO/NBPyqvSpvRFe0fgvf1vO12el9W8UzPjJKNScT/fgJFO', 'parent', 44),
(45, 'mira.berisha39@mail.com', '$2y$10$hKTu1Km2QWwfwJOsIXabS.mDSrIoROV7HqfCF34PpEwdfH4c5z4Ai', 'parent', 45),
(46, 'linda.gashi40@mail.com', '$2y$10$6zZ0VZoc04JBd9W.AmVHVu3fTSWUrgRN0k8Bp6/TxdXDMOYQvXXsu', 'parent', 46),
(47, 'valbona.krasniqi41@mail.com', '$2y$10$XJNoVnkL8Q5viIY2IrJtAuZSJjXs1cwBhrjOl5GkfxzHInFcEMuge', 'parent', 47),
(48, 'besa.rama42@mail.com', '$2y$10$gqYY65xvzdSw13mvTFf0jOED.B2oI.hslG5N1Ee2oYeDYjBBqkbpi', 'parent', 48),
(49, 'ornela.prifti43@mail.com', '$2y$10$/iJRO1LDS6/b.XIOOd4BtOXwCEOZY9ejZPHZcI.2zFGtAQEEXj.p2', 'parent', 49),
(50, 'fjolla.ismaili44@mail.com', '$2y$10$BVQ3IG86WNqoys2G5GTTDOoiNtYUKSkgrso1qqEEJtEp/L/i6JeyO', 'parent', 50),
(51, 'elda.kodra45@mail.com', '$2y$10$Gsv01ytTzUa.uu13SMD/cO2zb/nEQ8Ru5jHgb5Jq4c5rHceI6jCjW', 'parent', 51),
(52, 'ardit.nika46@mail.com', '$2y$10$KEPNV0BDWJ4fkO8AITfKlumqjC.IdXpV9.BmhzhdwitUkII5TWqkS', 'parent', 52),
(53, 'flamur.shehu47@mail.com', '$2y$10$1ewauuRYkGAOR343HYxKvu3Uf8InPxolNx5VL9bGl9XRmxjsrJ39C', 'parent', 53),
(54, 'besmir.zeka48@mail.com', '$2y$10$4t2hfeL3v65lahIm3di1fuGNlZy8u3T5i5MK2gp0VNkItNSOIypmi', 'parent', 54),
(55, 'endri.lleshi49@mail.com', '$2y$10$b/7JEMpyxCD1UN0ueHmTXullyjxe9w9UL0PjWce5u3pV/YENaU.zG', 'parent', 55),
(56, 'klevis.hoxha50@mail.com', '$2y$10$2t1W5Fcj0HO30M8bYdiFYOUog7EOQyapbXZJlE10w6EiAvCMxGjIm', 'parent', 56),
(57, 'arlinda.meta51@mail.com', '$2y$10$jxKbzMftXO0CQh/Wh6rr4uQG8WeFrLjrOAr65Y5fHflpMAwlSTthu', 'parent', 57),
(58, 'drita.kola52@mail.com', '$2y$10$YZ5Cy1Wj8aswHOf8vcM28u2.bOe1u/adzLz8sLRv/29a7S1FSPq4O', 'parent', 58),
(59, 'shpresa.gjoni53@mail.com', '$2y$10$W1C5NnyeyU/H0cByIgVJhuZ2VN6ApjrmLvgtNEghDCgrQeytHnz3y', 'parent', 59),
(60, 'nora.doda54@mail.com', '$2y$10$j4CdfnEE1GPJcFeOwOtLYu.WUJiMiZ8BThJMmf3wbN56n6pN8STMW', 'parent', 60),
(61, 'elvisa.hysa55@mail.com', '$2y$10$ft4UEyDFZ7WzU2YbeNS3oOBa0opJ2HpUuo9CWPmega62CPU5bfc0.', 'parent', 61),
(62, 'ervin.pjetri56@mail.com', '$2y$10$HIN/VKzeyW3YUq8/5d683uRlmFXFJng26b.0BYYzbqCgKnz.eSWmq', 'parent', 62),
(63, 'julian.bega57@mail.com', '$2y$10$jtN5XkJ8SDl/DsMXl9jIrOqws6j44UDYAQl1bUBa7vRVzjQFv2Dc6', 'parent', 63),
(64, 'sokol.dervishi58@mail.com', '$2y$10$rHAowJx54AEts6Xu.YOLbO9F4X2T.xMTrlayydN3s7z3xfMPu5bLW', 'parent', 64),
(65, 'luan.duka59@mail.com', '$2y$10$qdS/7CbDqGFV211KZ6jY4ezSKntMPnX.ZlaEBFh4sitKcq5AUvicK', 'parent', 65),
(66, 'artur.kodra60@mail.com', '$2y$10$GL5p6oX7AVuT2RgtdBF.g.z8M9YN8Cug7bibDIq2v4CK.8L18rZBy', 'parent', 66),
(67, 'elira.pasha61@mail.com', '$2y$10$/7utxiZFrwrNl.jEunfBDO7kjeBAJRA3Dyx0.lDHfHCSGZxIGLiZy', 'parent', 67),
(68, 'mirela.lika62@mail.com', '$2y$10$r.ZZklGY929VdS/RbUD2cOrl2IUefXwfG6rEIzKBo5jNEeZlFh.se', 'parent', 68),
(69, 'jona.hoxha63@mail.com', '$2y$10$1VJ6bjmnBIY3aIJWKcTb0e87nXkHRFyPnDV7knYN9rtzZXzDuthKm', 'parent', 69),
(70, 'valentina.meta64@mail.com', '$2y$10$4dAOXz0lLz1GvsKd1v9jdu0Vne0SmKj3Rhz.qr5ePkWI2pdsaQG9O', 'parent', 70),
(71, 'arta.sula65@mail.com', '$2y$10$n1gtyYAR.QZUyg6HVc7fk.xVj8knftpxxewBJkpjMp2rCt7oZ5X3u', 'parent', 71),
(72, 'blerim.lleshi66@mail.com', '$2y$10$QYHeOZXbxmX9T9lviH7QVO.XLiu0DdVNNg445lBj0BQ.d1fx2XfWW', 'parent', 72),
(73, 'dritan.kola67@mail.com', '$2y$10$..YovWB/huYlO9Rbd7akMOeCaUL8bku5WlkWTluUS1cwqTbu3etj.', 'parent', 73),
(74, 'gentian.hysa68@mail.com', '$2y$10$Bf0cvPow5HLkznjSiKLfN.ZwkFwdOQOTBZtC2s9npkC3VmAgujhx2', 'parent', 74),
(75, 'ilir.meta69@mail.com', '$2y$10$w/P7v27leDh.DuHEUYFouOg7f4f5p0j08IVT5ScPTIBjQztF06jBu', 'parent', 75),
(76, 'arben.gashi70@mail.com', '$2y$10$vAVwjXe70Go460YjLCzygeaH.G2WPAo0uKow2ZATu1HftTqrJgkzq', 'parent', 76),
(77, 'linda.kola71@mail.com', '$2y$10$8th/kd89xcgDObFc/qSsPuRez.qfFJB4VvRgXWMvk0AsERvfSSXY6', 'parent', 77),
(78, 'besa.dervishi72@mail.com', '$2y$10$DmotNuI0Xaa/AWOXFw8Eve0UZPl7hPrtW19bSNvbbvAtEF8blU.dG', 'parent', 78),
(79, 'elona.leka73@mail.com', '$2y$10$jPAUcAxlzAHTyxVvS7AA9eai6gdpznMP2qhlXH/GLvddSkOWj81ri', 'parent', 79),
(80, 'ornela.hoxha74@mail.com', '$2y$10$Wz9umMGQ7tNkzu39nh4jEOqU290ZI2G0JsCk23l0A1oGzGmM8V0p.', 'parent', 80),
(81, 'mira.gashi75@mail.com', '$2y$10$h4R9dutQ.bUJTRMlxLZkHuuXW9BlN9gkUZGzLLsS7ebAQVQtRLXWG', 'parent', 81),
(82, 'ardian.kodra@mail.com', '$2y$10$8tLwvQwH2Zfn7iMDDOA9ROjL250e4t1t/SzZQ/XWudAlj2Y6o2GSe', 'teacher', 1),
(83, 'dorian.leka@mail.com', '$2y$10$TNvdo0sXRhxi.6IEUq3J6uiZO43siV/M3lJMJNlDHvMFS89X52rHu', 'teacher', 2),
(84, 'gent.rrushi@mail.com', '$2y$10$2EXUTLCGz1Q2FmiUOhr32.IOjL3NzT9SoTydl8pytT32G4V79Wxia', 'teacher', 3),
(85, 'ermal.vora@mail.com', '$2y$10$.FOjShIOZbz9RKArls08u.da89oQ879A019ohOIlk.D1ZwjhsfZD6', 'teacher', 4),
(86, 'alban.gjoka@mail.com', '$2y$10$b.OjAbcqSAvaf0HOlZXhOO9Uz/aJ9IQdsVkkgDH3DyHgKMij42S42', 'teacher', 5),
(87, 'leon.vata@mail.com', '$2y$10$ENznwDCYuDxtkFPcp4mHiO71sBK7dPI74hEgNjewiYMPtpOQt.GWW', 'teacher', 6),
(88, 'arjan.zefi@mail.com', '$2y$10$Ge.mdtQY/MEf9hGVTH3OQepiyx3FssiECgmaLxN9kxA9CAqNXtPjC', 'teacher', 7),
(89, 'julian.bici@mail.com', '$2y$10$24ajOzDqJnR5ydu65aatw.Me0HRAxp0jFru9HQCCP0aeOhE/ER3SC', 'teacher', 8),
(90, 'rigers.hida@mail.com', '$2y$10$.RiWpNBPqLNfL/BYRxbKn.n./O5RiEknG6i2uelG4aZIg9nqeYeiO', 'teacher', 9),
(91, 'elton.shima@mail.com', '$2y$10$bPiCfVSMtO2MZFgnXW7eYePYzbkgIVdFf3QpKflXrMObyDUvAxhwy', 'teacher', 10),
(92, 'anisa.duka@mail.com', '$2y$10$.kwSu/fcOtCpzcAFUnpaRe/pQ86mAUksgwozQXYn/N/kHwSULrdOu', 'teacher', 11),
(93, 'blerina.kelmendi@mail.com', '$2y$10$0d7wXMRnte66H1akE1DWJO5vyJ168Cxae6juVxc2VzcIa0EyviqNO', 'teacher', 12),
(94, 'dorina.pasha@mail.com', '$2y$10$vLcf7klAKCRbi7z2jcBmkOXve68Nz0Z5jySZ/HLm5PpfjCj/aJpyu', 'teacher', 13),
(95, 'megi.vaso@mail.com', '$2y$10$0rlu14Gakz3Wyr0ZqUVAp.5PmBVr3OG3h3eprtXwzFkyjfs8WxmCC', 'teacher', 14),
(96, 'sara.dema@mail.com', '$2y$10$HShjj0c/PLz3HknSfTPhP.TLAalVlq95tu8bjoJ3rjaQRnWWbpBqq', 'teacher', 15),
(97, 'elona.sako@mail.com', '$2y$10$l7B9glROAr9y/9figw81oukbamIwG2nvsa8CtbN5mgL83x8Z0EnsO', 'teacher', 16),
(98, 'flutura.ndoj@mail.com', '$2y$10$v8Ch/Mom87kseF7k1xFMJOLKjbrFahCBDwYbVrYCBRfz.ozGci38i', 'teacher', 17),
(99, 'ornela.dini@mail.com', '$2y$10$d4PGDPEbUlXm88jtWZqAaO/dVcxd.K8oPxhmCrFSWdC2.EHrx29Di', 'teacher', 18),
(100, 'jona.pire@mail.com', '$2y$10$mt01WYdblscGpyO2.Y/7E.okNenOZQzwtMPiqyvackbX10Dnum4A.', 'teacher', 19),
(101, 'ledia.muka@mail.com', '$2y$10$.OO.moP33eKJssFkI9Bo3eHpjOQ7UAYmX99zM3JqHGJO8CCT5I.nq', 'teacher', 20),
(102, 'arlind.basha@mail.com', '$2y$10$R1OanMJLG1Qo8KtfehYgPeYx7FfViYF7imwdcSERFdgRca4ca5mOu', 'teacher', 21),
(103, 'endri.kodra@mail.com', '$2y$10$egGPdo8TvIloAoJm.YWbqucmSjRDZwqM4npdnIWF8kjGIHVWA7NTq', 'teacher', 22),
(104, 'klevi.doda@mail.com', '$2y$10$K10P4YMpETY8zlT/15HQeext/DruD5EkVI4RdOX2amwX3MOqJJRpC', 'teacher', 23),
(105, 'valon.gjoni@mail.com', '$2y$10$/UXFfpdfNRcQ02m6MA7yj.Z0hzYaz7XNdPm97nQ7SyArl1mn9uOI.', 'teacher', 24),
(106, 'sokol.lushi@mail.com', '$2y$10$E0.n8uyoRwZo9xjwOu227.xS9bbWj5cZfZr7AdWPvbpgjWOBGbNfe', 'teacher', 25),
(107, 'ylber.domi@mail.com', '$2y$10$0EmKRYjfW2ec9kh7PvDhxOS.H1QroE5u987bEqCbebo2tFpQsZXo2', 'teacher', 26),
(108, 'mikel.shyti@mail.com', '$2y$10$h.uZ/jYxU5TOFiDZFO1yXumtsqq9iCmb1ySsYWTRgiRjJ1YZ0Al/m', 'teacher', 27),
(109, 'artur.leci@mail.com', '$2y$10$OhrS1F/3H1s80L1pfcVMseZi3dqixxuJ5z0aIAgZf3uZFbN5EQ7Rq', 'teacher', 28),
(110, 'blendi.kasa@mail.com', '$2y$10$wjqntmai3u5L5p8p/X3ZJOuci6M.7QE89YrBOX3o0C85wXlrJryAi', 'teacher', 29),
(111, 'franci.reka@mail.com', '$2y$10$MyGwhUYtxBCgOtx7NaZw1uLRQfeGWQmjTMp.Ah7.zAl8Tgzme12gy', 'teacher', 30),
(112, 'admin1@gmail.com', '$2y$10$8tLwvQwH2Zfn7iMDDOA9ROjL250e4t1t/SzZQ/XWudAlj2Y6o2GSe', 'admin', 1),
(113, 'admin2@gmail.com', '$2y$10$gFP6NzAqrhU8q.on9zJYie60igaDx8GLThm5PpWRZ/68gqWwO7Kma', 'admin', 2),
(114, 'admin3@gmail.com', '$2y$10$PlqdslG7qiryRveNyb/gOOOeb8BmcFeXoEx9tNVh1K//G3XKCkl66', 'admin', 3);

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
  `lendaID` int(255) NOT NULL,
  `klasid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vleresim`
--

INSERT INTO `vleresim` (`id`, `nxenesID`, `tremujori`, `v1`, `v2`, `v3`, `projekt`, `test`, `lendaID`, `klasid`) VALUES
(1, 1, '1', 5, 5, 5, 5, 5, 1, 1),
(2, 3, '1', 0, 0, 0, 0, 0, 1, 1),
(3, 4, '1', 0, 0, 0, 0, 0, 1, 1),
(4, 31, '1', 0, 0, 0, 0, 0, 1, 1),
(5, 45, '1', 0, 0, 0, 0, 0, 1, 1),
(6, 59, '1', 0, 0, 0, 0, 0, 1, 1),
(7, 73, '1', 0, 0, 0, 0, 0, 1, 1),
(8, 82, '1', 0, 0, 0, 0, 0, 1, 1),
(9, 21, '1', 0, 0, 0, 0, 0, 1, 1),
(10, 22, '1', 0, 0, 0, 0, 0, 1, 1),
(11, 40, '1', 0, 0, 0, 0, 0, 1, 1),
(12, 54, '1', 0, 0, 0, 0, 0, 1, 1),
(13, 68, '1', 0, 0, 0, 0, 0, 1, 1),
(14, 21, '1', 5, 5, 5, 6, 6, 1, 10),
(15, 22, '1', 0, 0, 0, 0, 0, 1, 10),
(16, 40, '1', 0, 0, 0, 0, 0, 1, 10),
(17, 54, '1', 0, 0, 0, 0, 0, 1, 10),
(18, 68, '1', 0, 0, 0, 0, 0, 1, 10),
(19, 1, '2', 6, 6, 6, 9, 10, 1, 1),
(20, 3, '2', 0, 0, 0, 0, 0, 1, 1),
(21, 4, '2', 0, 0, 0, 0, 0, 1, 1),
(22, 31, '2', 0, 0, 0, 0, 0, 1, 1),
(23, 45, '2', 0, 0, 0, 0, 0, 1, 1),
(24, 59, '2', 0, 0, 0, 0, 0, 1, 1),
(25, 73, '2', 0, 0, 0, 0, 0, 1, 1),
(26, 82, '2', 0, 0, 0, 0, 0, 1, 1),
(27, 1, '3', 0, 0, 0, 0, 0, 9, 10),
(28, 3, '3', 4, 5, 5, 6, 7, 9, 10),
(29, 4, '3', 0, 0, 0, 0, 0, 9, 10),
(30, 31, '3', 0, 0, 0, 0, 0, 9, 10),
(31, 45, '3', 0, 0, 0, 0, 0, 9, 10),
(32, 59, '3', 0, 0, 0, 0, 0, 9, 10),
(33, 73, '3', 0, 0, 0, 0, 0, 9, 10),
(34, 82, '3', 0, 0, 0, 0, 0, 9, 10),
(35, 1, '3', 0, 0, 0, 0, 0, 3, 10),
(36, 3, '3', 0, 0, 0, 0, 0, 3, 10),
(37, 4, '3', 0, 0, 0, 0, 0, 3, 10),
(38, 31, '3', 0, 0, 0, 0, 0, 3, 10),
(39, 45, '3', 0, 0, 0, 0, 0, 3, 10),
(40, 59, '3', 0, 0, 0, 0, 0, 3, 10),
(41, 73, '3', 0, 0, 0, 0, 0, 3, 10),
(42, 82, '3', 0, 0, 0, 0, 0, 3, 10),
(43, 21, '3', 0, 0, 0, 0, 0, 3, 10),
(44, 22, '3', 0, 0, 0, 0, 0, 3, 10),
(45, 40, '3', 0, 0, 0, 0, 0, 3, 10),
(46, 54, '3', 0, 0, 0, 0, 0, 3, 10),
(47, 68, '3', 0, 0, 0, 0, 0, 3, 10),
(48, 1, '2', 0, 0, 0, 0, 0, 9, 15),
(49, 3, '2', 0, 0, 0, 0, 0, 9, 15),
(50, 4, '2', 0, 0, 0, 0, 0, 9, 15),
(51, 31, '2', 0, 0, 0, 0, 0, 9, 15),
(52, 45, '2', 0, 0, 0, 0, 0, 9, 15),
(53, 59, '2', 0, 0, 0, 0, 0, 9, 15),
(54, 73, '2', 0, 0, 0, 0, 0, 9, 15),
(55, 82, '2', 0, 0, 0, 0, 0, 9, 15),
(56, 21, '2', 0, 0, 0, 0, 0, 9, 15),
(57, 22, '2', 0, 0, 0, 0, 0, 9, 15),
(58, 40, '2', 0, 0, 0, 0, 0, 9, 15),
(59, 54, '2', 0, 0, 0, 0, 0, 9, 15),
(60, 68, '2', 0, 0, 0, 0, 0, 9, 15),
(61, 25, '3', 7, 7, 7, 7, 7, 4, 12),
(62, 26, '3', 0, 0, 0, 0, 0, 4, 12),
(63, 42, '3', 0, 8, 0, 0, 0, 4, 12),
(64, 56, '3', 0, 0, 0, 0, 0, 4, 12),
(65, 70, '3', 0, 0, 0, 0, 0, 4, 12),
(66, 25, '1', 4, 4, 4, 4, 4, 4, 12),
(67, 26, '1', 0, 0, 0, 0, 0, 4, 12),
(68, 42, '1', 0, 0, 0, 0, 0, 4, 12),
(69, 56, '1', 0, 0, 0, 0, 0, 4, 12),
(70, 70, '1', 0, 0, 0, 0, 0, 4, 12),
(71, 2, '1', 5, 5, 6, 7, 7, 4, 2),
(72, 5, '1', 0, 0, 0, 0, 0, 4, 2),
(73, 6, '1', 0, 0, 0, 0, 0, 4, 2),
(74, 32, '1', 0, 0, 0, 0, 0, 4, 2),
(75, 46, '1', 0, 0, 0, 0, 0, 4, 2),
(76, 60, '1', 0, 0, 0, 0, 0, 4, 2),
(77, 74, '1', 0, 0, 0, 0, 0, 4, 2),
(78, 25, '1', 0, 0, 0, 0, 0, 4, 2),
(79, 26, '1', 0, 0, 0, 0, 0, 4, 2),
(80, 42, '1', 0, 0, 0, 0, 0, 4, 2),
(81, 56, '1', 0, 0, 0, 0, 0, 4, 2),
(82, 70, '1', 0, 0, 0, 0, 0, 4, 2),
(83, 25, '2', 0, 0, 0, 0, 0, 4, 12),
(84, 26, '2', 0, 0, 0, 0, 0, 4, 12),
(85, 42, '2', 0, 0, 0, 0, 0, 4, 12),
(86, 56, '2', 0, 0, 0, 0, 0, 4, 12),
(87, 70, '2', 0, 0, 0, 0, 0, 4, 12),
(88, 2, '3', 5, 7, 10, 4, 6, 4, 2),
(89, 5, '3', 0, 0, 0, 0, 0, 4, 2),
(90, 6, '3', 0, 0, 0, 0, 0, 4, 2),
(91, 32, '3', 0, 0, 0, 0, 0, 4, 2),
(92, 46, '3', 0, 0, 0, 0, 0, 4, 2),
(93, 60, '3', 0, 0, 0, 0, 0, 4, 2),
(94, 74, '3', 0, 0, 0, 0, 0, 4, 2),
(95, 25, '3', 7, 7, 7, 7, 7, 13, 12),
(96, 26, '3', 0, 0, 0, 0, 0, 13, 12),
(97, 42, '3', 0, 0, 0, 0, 0, 13, 12),
(98, 56, '3', 0, 0, 0, 0, 0, 13, 12),
(99, 70, '3', 0, 7, 0, 0, 0, 13, 12),
(100, 25, '2', 6, 7, 0, 0, 0, 13, 12),
(101, 26, '2', 0, 0, 0, 0, 0, 13, 12),
(102, 42, '2', 0, 0, 0, 0, 0, 13, 12),
(103, 56, '2', 0, 0, 0, 0, 0, 13, 12),
(104, 70, '2', 0, 0, 0, 0, 0, 13, 12),
(105, 23, '2', 7, 0, 0, 0, 0, 3, 11),
(106, 24, '2', 0, 0, 0, 0, 0, 3, 11),
(107, 41, '2', 0, 0, 0, 0, 0, 3, 11),
(108, 55, '2', 0, 0, 0, 0, 0, 3, 11),
(109, 69, '2', 0, 0, 0, 0, 0, 3, 11),
(110, 21, '1', 7, 8, 9, 0, 0, 10, 10),
(111, 22, '1', 0, 0, 0, 0, 0, 10, 10),
(112, 40, '1', 0, 0, 0, 0, 0, 10, 10),
(113, 54, '1', 0, 0, 0, 0, 0, 10, 10),
(114, 68, '1', 0, 0, 0, 0, 0, 10, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `mungesat`
--
ALTER TABLE `mungesat`
  ADD PRIMARY KEY (`mungesaID`),
  ADD KEY `nxenesID` (`nxenesID`),
  ADD KEY `lendaID` (`lendaID`),
  ADD KEY `klasaID` (`klasaID`),
  ADD KEY `mesuesID` (`mesuesID`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vleresim`
--
ALTER TABLE `vleresim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lendaID` (`lendaID`),
  ADD KEY `nxenesID` (`nxenesID`),
  ADD KEY `klasid` (`klasid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aktivitet`
--
ALTER TABLE `aktivitet`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detyrat`
--
ALTER TABLE `detyrat`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `klasa`
--
ALTER TABLE `klasa`
  MODIFY `klasaID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `klasalenda`
--
ALTER TABLE `klasalenda`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `kualifikimemesuesi`
--
ALTER TABLE `kualifikimemesuesi`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lenda`
--
ALTER TABLE `lenda`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `lidhjamesues`
--
ALTER TABLE `lidhjamesues`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mesues`
--
ALTER TABLE `mesues`
  MODIFY `mesuesID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `mungesa`
--
ALTER TABLE `mungesa`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mungesat`
--
ALTER TABLE `mungesat`
  MODIFY `mungesaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `nxenes`
--
ALTER TABLE `nxenes`
  MODIFY `nxenesID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `pagesat`
--
ALTER TABLE `pagesat`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `prinder`
--
ALTER TABLE `prinder`
  MODIFY `prind_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `vleresim`
--
ALTER TABLE `vleresim`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

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
-- Constraints for table `mungesat`
--
ALTER TABLE `mungesat`
  ADD CONSTRAINT `mungesat_ibfk_1` FOREIGN KEY (`nxenesID`) REFERENCES `nxenes` (`nxenesID`),
  ADD CONSTRAINT `mungesat_ibfk_2` FOREIGN KEY (`lendaID`) REFERENCES `lenda` (`id`),
  ADD CONSTRAINT `mungesat_ibfk_3` FOREIGN KEY (`klasaID`) REFERENCES `klasa` (`klasaID`),
  ADD CONSTRAINT `mungesat_ibfk_4` FOREIGN KEY (`mesuesID`) REFERENCES `mesues` (`mesuesID`);

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
  ADD CONSTRAINT `vleresim_ibfk_2` FOREIGN KEY (`nxenesID`) REFERENCES `nxenes` (`nxenesID`),
  ADD CONSTRAINT `vleresim_ibfk_3` FOREIGN KEY (`klasid`) REFERENCES `klasa` (`klasaID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
