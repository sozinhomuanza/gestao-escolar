-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Abr-2026 às 16:53
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestao_escolar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id_aluno` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `genero` enum('Masculino','Feminino','Outro') DEFAULT NULL,
  `naturalidade` varchar(100) DEFAULT NULL,
  `provincia_natural` varchar(100) DEFAULT NULL,
  `bi` varchar(20) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `nome_responsavel` varchar(150) DEFAULT NULL,
  `telefone_responsavel` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_provincia` int(11) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `id_comuna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id_aluno`, `nome`, `data_nascimento`, `genero`, `naturalidade`, `provincia_natural`, `bi`, `telefone`, `email`, `endereco`, `nome_responsavel`, `telefone_responsavel`, `created_at`, `updated_at`, `id_provincia`, `id_municipio`, `id_comuna`) VALUES
(1, 'Eurico Mayala', '1999-08-25', 'Masculino', '', '', '', '95483645', 'elias@gmail.com', 'Viana', 'Somuanza', '924873652', '2026-02-18 08:25:15', '2026-03-04 17:07:00', NULL, NULL, NULL),
(3, 'Adilson Luís André', '2000-04-21', 'Masculino', NULL, NULL, NULL, '', '', '', '', '', '2026-02-19 11:37:36', '2026-02-20 00:04:39', NULL, NULL, NULL),
(4, 'Cesar Canga', NULL, 'Outro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(5, 'Dumilde Eduardo Vunge', NULL, 'Outro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(6, 'Edilson de Oliveira Alberto Carlos', NULL, 'Outro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(7, 'Josué Panzo Francisco', NULL, 'Outro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(8, 'Josué Pedro Estevão de Azevedo', NULL, 'Outro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(9, 'Lauriano Bambi Pedro Laurindo', NULL, 'Outro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(10, 'Mauro Manuel Mariango', NULL, 'Outro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(11, 'Michel Manuel Domingo Miguel', '1984-01-29', 'Masculino', 'Luanda', 'Luanda', '000578414UE038', '925354049', 'somuanza@hotmail.com', 'Viana', 'Somuanza', '924873652', '2026-02-19 11:37:36', '2026-02-24 16:14:26', NULL, NULL, NULL),
(12, 'Nestor Catumbela Caumba', NULL, 'Outro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(13, 'Núria Estefânia Júlio Saldanha', NULL, 'Outro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(14, 'Nzinga Simão Makenda', NULL, 'Outro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(15, 'Rossana Borge Neto', NULL, 'Outro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(16, 'Salomão Daniel Paulino Conde', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(17, 'Salomão Loloji Mucamba', NULL, 'Outro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(18, 'Samira António Camana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(19, 'Samira Fernando Pascoal Neto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(20, 'Sérgio Cristiano Puri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(21, 'Tomás Laurente', NULL, 'Outro', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-19 11:37:36', '2026-02-19 11:37:36', NULL, NULL, NULL),
(22, 'Lopes António', '2004-05-21', 'Masculino', NULL, NULL, NULL, '925354049', 'somuanza@hotmail.com', '', 'Somuanza', '924873652', '2026-02-20 05:05:00', '2026-02-20 05:05:00', NULL, NULL, NULL),
(23, 'Mariana João Moreira', NULL, 'Feminino', NULL, NULL, NULL, NULL, NULL, 'Kilamba', NULL, NULL, '2026-02-22 14:50:15', '2026-02-22 14:50:15', 4, 48, 88),
(24, 'Maria', NULL, 'Masculino', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '2026-02-24 13:11:27', '2026-02-24 13:11:27', 11, 191, 319),
(25, 'Betinho Ramiro', '1984-01-29', 'Masculino', 'Luanda', 'Luanda', '000578414UE039', '925354049', 'somuanza@hotmail.com', 'Viana', '', '', '2026-02-24 13:12:20', '2026-02-24 13:28:42', 11, 191, 319),
(30, 'Nelito Panzo', '2008-01-04', 'Masculino', NULL, NULL, NULL, '925354049', 'somuanza@hotmail.com', 'Viana', '', '925354049', '2026-03-04 17:06:34', '2026-03-04 17:06:34', 10, NULL, NULL),
(32, 'Nelito Panzo', '2008-01-04', '', NULL, NULL, NULL, '925354049', 'somuanza@hotmail.com', 'Viana', '', '925354049', '2026-03-04 17:09:00', '2026-03-04 17:09:00', 10, NULL, NULL),
(33, 'Nelito Panzo', '2008-01-04', '', NULL, NULL, NULL, '925354049', 'somuanza@hotmail.com', 'Viana', '', '925354049', '2026-03-04 17:09:12', '2026-03-04 17:09:12', 10, NULL, NULL),
(34, 'Palo sebastião', '1972-12-31', 'Masculino', NULL, NULL, NULL, '925354049', 'somuanza@hotmail.com', 'Viana', '', '925354049', '2026-03-04 17:31:01', '2026-03-04 17:31:01', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comunas`
--

CREATE TABLE `comunas` (
  `id_comuna` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL COMMENT 'Ex: PR04MN01CM01',
  `nome` varchar(100) NOT NULL COMMENT 'Ex: Ingombota',
  `id_municipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Comunas de Angola';

--
-- Extraindo dados da tabela `comunas`
--

INSERT INTO `comunas` (`id_comuna`, `codigo`, `nome`, `id_municipio`) VALUES
(1, 'PR01MN01CM01', 'Cabinda Sede', 1),
(2, 'PR01MN03CM01', 'Lândana', 2),
(3, 'PR01MN03CM02', 'Dinge', 2),
(4, 'PR01MN05CM01', 'Buco Zau', 3),
(5, 'PR01MN07CM01', 'Belize', 4),
(6, 'PR01MN07CM02', 'Luali', 4),
(7, 'PR01MN09CM01', 'Miconje Sede', 5),
(8, 'PR01MN11CM01', 'Malembo', 6),
(9, 'PR01MN11CM02', 'Tando Zinze', 6),
(10, 'PR01MN13CM01', 'Necuto', 7),
(11, 'PR01MN13CM02', 'Inhuca', 7),
(12, 'PR01MN15CM01', 'Massabi Sede', 8),
(13, 'PR01MN017CM01', 'Ngoio Sede', 9),
(14, 'PR01MN019CM01', 'Liambo Sede', 10),
(15, 'PR02MN01CM01', 'Mbanza Congo', 11),
(16, 'PR02MN01CM03', 'Madimba', 11),
(17, 'PR02MN01CM04', 'Quiende', 11),
(18, 'PR02MN01CM06', 'Caluca', 11),
(19, 'PR02MN03CM01', 'Soyo', 12),
(20, 'PR02MN03CM02', 'Pedra de Feitiço', 12),
(21, 'PR02MN05CM01', 'Nzeto', 13),
(22, 'PR02MN05CM02', 'Musserra', 13),
(23, 'PR02MN07CM01', 'Tomboco', 14),
(24, 'PR02MN07CM02', 'Quinzau', 14),
(25, 'PR02MN07CM03', 'Quinsimba', 14),
(26, 'PR02MN09CM01', 'Nóqui Sede', 15),
(27, 'PR02MN11CM01', 'Cuimba', 16),
(28, 'PR02MN11CM02', 'Buela', 16),
(29, 'PR02MN11CM04', 'Luvaca', 16),
(30, 'PR02MN13CM01', 'Quêlo Sede', 17),
(31, 'PR02MN15CM01', 'Serra de Canda Sede', 18),
(32, 'PR02MN17CM01', 'Lufico', 19),
(33, 'PR02MN17CM02', 'Mpala', 19),
(34, 'PR02MN19CM01', 'Quindege', 20),
(35, 'PR02MN19CM02', 'Quibala Norte', 20),
(36, 'PR02MN21CM01', 'Luvo Sede', 21),
(37, 'PR03MN01CM01', 'Uíge', 22),
(38, 'PR03MN01CM04', 'Luanga', 22),
(39, 'PR03MN02CM02', 'Cancungo', 22),
(40, 'PR03MN03CM03', 'Casseche', 22),
(41, 'PR03MN03CM01', 'Ambuíla Sede', 23),
(42, 'PR03MN05CM01', 'Songo', 24),
(43, 'PR03MN05CM02', 'Quinvuenga', 24),
(44, 'PR03MN07CM01', 'Bembe', 25),
(45, 'PR03MN07CM02', 'Mabaia', 25),
(46, 'PR03MN09CM01', 'Negage', 26),
(47, 'PR03MN09CM02', 'Dimuca', 26),
(48, 'PR03MN09CM03', 'Quisseque', 26),
(49, 'PR03MN11CM01', 'Bungo Sede', 27),
(50, 'PR03MN13CM01', 'Maquela do Zombo', 28),
(51, 'PR03MN13CM02', 'Quibocolo', 28),
(52, 'PR03MN15CM01', 'Damba', 29),
(53, 'PR03MN15CM02', 'Camatambo', 29),
(54, 'PR03MN15CM03', 'Lêmboa', 29),
(55, 'PR03MN15CM04', 'Petecusso', 29),
(56, 'PR03MN17CM01', 'Cangola', 30),
(57, 'PR03MN17CM02', 'Caiongo', 30),
(58, 'PR03MN17CM03', 'Bengo', 30),
(59, 'PR03MN19CM01', 'Sanza Pombo', 31),
(60, 'PR03MN19CM02', 'Alfandega', 31),
(61, 'PR03MN19CM03', 'Cuilo Pombo', 31),
(62, 'PR03MN19CM04', 'Uamba', 31),
(63, 'PR03MN21CM01', 'Quitexe', 32),
(64, 'PR03MN21CM02', 'Aldeia Viçosa', 32),
(65, 'PR03MN23CM01', 'Quimbele', 33),
(66, 'PR03MN23CM02', 'Icoca', 33),
(67, 'PR03MN25CM01', 'Milunga', 34),
(68, 'PR03MN25CM02', 'Macocola', 34),
(69, 'PR03MN27CM01', 'Puri Sede', 35),
(70, 'PR03MN29CM02', 'Uando Mucaba', 36),
(71, 'PR03MN33CM01', 'Quipedro Sede', 37),
(72, 'PR03MN35CM02', 'Sacandica', 38),
(73, 'PR03MN35CM03', 'Béu', 38),
(74, 'PR03MN37CM01', 'Cuango Calumbo', 39),
(75, 'PR03MN37CM02', 'Alto-Zaza', 39),
(76, 'PR03MN35CM01', 'Cuilo Futa', 40),
(77, 'PR03MN45CM01', 'Nova Esperança', 40),
(78, 'PR03MN45CM03', 'Buenga Sul', 40),
(79, 'PR03MN47CM01', 'Nsosso Sede', 41),
(80, 'PR03MN49CM01', 'Macolo', 42),
(81, 'PR03MN49CM02', 'Massau', 42),
(82, 'PR03MN51CM01', 'Lucunga Sede', 43),
(83, 'PR03MN53CM01', 'Vista Alegre', 44),
(84, 'PR03MN53CM02', 'Cambamba', 44),
(85, 'PR04MN01CM01', 'Mussulo Sede', 45),
(86, 'PR04MN03CM01', 'Hoji-ya-Henda Sede', 46),
(87, 'PR04MN05CM01', 'Mulenvos Sede', 47),
(88, 'PR04MN07CM01', 'Kilamba', 48),
(89, 'PR04MN07CM02', 'Vila Flor', 48),
(90, 'PR04MN09CM01', 'Cazenga', 49),
(91, 'PR04MN09CM02', 'Kima Kieza', 49),
(92, 'PR04MN11CM01', 'Samba Sede', 50),
(93, 'PR04MN13CM01', 'Rangel Sede', 51),
(94, 'PR04MN15CM01', 'Cacuaco', 52),
(95, 'PR04MN15CM02', 'Kicolo', 52),
(96, 'PR04MN17CM01', 'Viana Sede', 53),
(97, 'PR04MN19CM01', 'Maianga Sede', 54),
(98, 'PR04MN21CM01', 'Cabolombo', 55),
(99, 'PR04MN21CM02', 'Barra do Cuanza', 55),
(100, 'PR04MN21CM03', 'Ramiros', 55),
(101, 'PR04MN23CM01', 'Sambizanga Sede', 56),
(102, 'PR04MN25CM01', 'Ingombota Sede', 57),
(103, 'PR04MN27CM01', 'Golfe', 58),
(104, 'PR04MN27CM02', 'Nova Vida', 58),
(105, 'PR04MN29CM01', 'Talatona', 59),
(106, 'PR04MN29CM02', 'Benfica', 59),
(107, 'PR04MN31CM01', 'Camama Sede', 60),
(108, 'PR05MN01CM01', 'Caculo Camuiza', 61),
(109, 'PR05MN01CM02', 'Ndalatando', 61),
(110, 'PR05MN03CM01', 'Lucala', 62),
(111, 'PR05MN03CM02', 'Quiagombe', 62),
(112, 'PR05MN05CM01', 'Golungo Alto', 63),
(113, 'PR05MN05CM02', 'Cambondo', 63),
(114, 'PR05MN05CM03', 'Quilombo quía Puto', 63),
(115, 'PR05MN07CM01', 'Dondo', 64),
(116, 'PR05MN07CM02', 'Dange Ya Menha', 64),
(117, 'PR05MN07CM03', 'S. Pedro da Quilemba', 64),
(118, 'PR05MN09CM01', 'Camabatela', 65),
(119, 'PR05MN09CM04', 'Maua', 65),
(120, 'PR05MN09CM05', 'Bindo', 65),
(121, 'PR05MN11CM01', 'Quiculungo Sede', 66),
(122, 'PR05MN13CM01', 'Bolongongo Sede', 67),
(123, 'PR05MN15CM01', 'Banga', 68),
(124, 'PR05MN15CM02', 'Cariamba', 68),
(125, 'PR05MN17CM02', 'Samba Cajú', 69),
(126, 'PR05MN17CM03', 'Samba Lucala', 69),
(127, 'PR05MN19CM01', 'Quilombo dos Dembos', 70),
(128, 'PR05MN19CM02', 'Camame', 70),
(129, 'PR05MN19CM03', 'Cavunga', 70),
(130, 'PR05MN21CM01', 'Luinga Sede', 71),
(131, 'PR05MN23CM01', 'Tango Sede', 72),
(132, 'PR05MN25CM01', 'Aldeia Nova Sede', 73),
(133, 'PR05MN15CM03', 'Caculo Cabaça Sede', 74),
(134, 'PR05MN29CM01', 'Terreiro', 75),
(135, 'PR05MN29CM02', 'Quiquiemba', 75),
(136, 'PR05MN31CM01', 'Massangano', 76),
(137, 'PR05MN31CM02', 'Zenza do Itombe', 76),
(138, 'PR05MN33CM01', 'Cerca Sede', 77),
(139, 'PR06MN01CM01', 'Sumbe Sede', 78),
(140, 'PR06MN01CM04', 'Quicombo', 78),
(141, 'PR06MN05CM01', 'Quilenda Sede', 79),
(142, 'PR06MN07CM01', 'Porto Amboim', 80),
(143, 'PR06MN07CM02', 'Capolo', 80),
(144, 'PR06MN11CM01', 'Quibala', 81),
(145, 'PR06MN11CM02', 'Dala Cachibo', 81),
(146, 'PR06MN13CM01', 'Mussende', 82),
(147, 'PR06MN13CM02', 'Quipaxi', 82),
(148, 'PR06MN15CM01', 'Seles', 83),
(149, 'PR06MN15CM02', 'Botera', 83),
(150, 'PR06MN17CM01', 'Conda', 84),
(151, 'PR06MN17CM02', 'Cunjo', 84),
(152, 'PR06MN19CM01', 'Cassongue', 85),
(153, 'PR06MN19CM02', 'Dumbi', 85),
(154, 'PR06MN19CM03', 'Atóme', 85),
(155, 'PR06MN21CM01', 'Boa Entrada Sede', 86),
(156, 'PR06MN23CM02', 'Ebo', 87),
(157, 'PR06MN23CM04', 'Cassanje', 87),
(158, 'PR06MN25CM01', 'Waku kungo Sede', 88),
(159, 'PR06MN27CM01', 'Gabela', 89),
(160, 'PR06MN27CM02', 'Assango', 89),
(161, 'PR06MN29CM01', 'Pambangala Sede', 90),
(162, 'PR06MN31CM01', 'Sanga Sede', 91),
(163, 'PR06MN33CM01', 'Condé Sede', 92),
(164, 'PR06MN35CM01', 'Calulo', 93),
(165, 'PR06MN35CM02', 'Cabuta', 93),
(166, 'PR06MN37CM01', 'Munenga Sede', 94),
(167, 'PR06MN39CM01', 'Quissongo Sede', 95),
(168, 'PR06MN41CM01', 'Quenha Sede', 96),
(169, 'PR06MN43CM01', 'Quirimbo Sede', 97),
(170, 'PR06MN45CM01', 'Lonhe', 98),
(171, 'PR06MN45CM02', 'Cariango', 98),
(172, 'PR06MN47CM01', 'Amboiva', 99),
(173, 'PR06MN49CM01', 'Gangula Sede', 100),
(174, 'PR06MN51CM01', 'Gungo sede', 101),
(175, 'PR07MN01CM01', 'Malanje', 102),
(176, 'PR07MN01CM02', 'Lombe', 102),
(177, 'PR07MN03CM01', 'Cacuso', 103),
(178, 'PR07MN03CM02', 'Soqueco', 103),
(179, 'PR07MN05CM01', 'Calandula', 104),
(180, 'PR07MN05CM02', 'Cota', 104),
(181, 'PR07MN07CM01', 'Cambundi Catembo', 105),
(182, 'PR07MN07CM02', 'Dumba Cabango', 105),
(183, 'PR07MN09CM01', 'Quela', 106),
(184, 'PR07MN09CM02', 'Bangalas', 106),
(185, 'PR07MN11CM01', 'Cahombo', 107),
(186, 'PR07MN11CM02', 'Micanda', 107),
(187, 'PR07MN13CM01', 'Massango Sede', 108),
(188, 'PR07MN15CM01', 'Luquembo', 109),
(189, 'PR07MN15CM02', 'Dombo wa Zanga', 109),
(190, 'PR07MN19CM01', 'Kunda Dya Baze', 110),
(191, 'PR07MN19CM02', 'Lemba', 110),
(192, 'PR07MN23CM01', 'Caculama', 111),
(193, 'PR07MN23CM02', 'Caxinga', 111),
(194, 'PR07MN25CM01', 'Cangandala', 112),
(195, 'PR07MN25CM02', 'Caribo', 112),
(196, 'PR07MN25CM03', 'Culamagia', 112),
(197, 'PR07MN27CM01', 'Kiwaba Nzoji', 113),
(198, 'PR07MN27CM02', 'Mufuma', 113),
(199, 'PR07MN29CM01', 'Nbanji ya Ngola', 114),
(200, 'PR07MN29CM02', 'Cabombo', 114),
(201, 'PR07MN31CM01', 'Cambo Suinginge Sede', 115),
(202, 'PR07MN33CM01', 'Pungo a Ndongo Sede', 116),
(203, 'PR07MN35CM01', 'Cateco Cangola Sede', 117),
(204, 'PR07MN37CM01', 'Cuale Sede', 118),
(205, 'PR07MN39CM01', 'Quitapa Sede', 119),
(206, 'PR07MN41CM01', 'Milando Sede', 120),
(207, 'PR07MN43CM01', 'Capunda', 121),
(208, 'PR07MN43CM02', 'Quimbango', 121),
(209, 'PR07MN43CM03', 'Cunga Palanga', 121),
(210, 'PR07MN45CM01', 'Ngola Luiji', 122),
(211, 'PR07MN47CM01', 'Quihuhu', 123),
(212, 'PR07MN47CM02', 'Quinguenque', 123),
(213, 'PR07MN51CM01', 'Muquixi Sede', 124),
(214, 'PR07MN53CM01', 'Xandel', 125),
(215, 'PR07MN53CM02', 'Moma', 125),
(216, 'PR07MN55CM01', 'Quêssua Sede', 126),
(217, 'PR07MN57CM01', 'Marimba', 127),
(218, 'PR07MN57CM02', 'Mangando', 127),
(219, 'PR07MN59CM01', 'Quirima', 128),
(220, 'PR07MN59CM02', 'Sautar', 128),
(221, 'PR08MN01CM01', 'Lucapa', 129),
(222, 'PR08MN01CM02', 'Camissombo', 129),
(223, 'PR08MN03CM01', 'Nzage', 130),
(224, 'PR08MN03CM02', 'Cachimo', 130),
(225, 'PR08MN05CM01', 'Chitato Sede', 131),
(226, 'PR08MN07CM01', 'Cuilo', 132),
(227, 'PR08MN07CM02', 'Caluango', 132),
(228, 'PR08MN09CM01', 'Caungula Sede', 133),
(229, 'PR08MN11CM01', 'Cuango Sede', 134),
(230, 'PR08MN13CM01', 'Lubalo', 135),
(231, 'PR08MN13CM02', 'Muvuluege', 135),
(232, 'PR08MN15CM01', 'Capenda-Camulemba', 136),
(233, 'PR08MN15CM02', 'Xinge', 136),
(234, 'PR08MN17CM01', 'Xá-Muteba Sede', 137),
(235, 'PR08MN19CM01', 'Lóvua Sede', 138),
(236, 'PR08MN21CM01', 'Canzar', 139),
(237, 'PR08MN21CM02', 'Luia', 139),
(238, 'PR08MN23CM01', 'Camaxilo Sede', 140),
(239, 'PR08MN25CM01', 'Luremo Sede', 141),
(240, 'PR08MN27CM01', 'Luangue Sede', 142),
(241, 'PR08MN29CM01', 'Capaia', 143),
(242, 'PR08MN29CM02', 'Xa-Cassau', 143),
(243, 'PR08MN31CM01', 'Iongo', 144),
(244, 'PR08MN31CM02', 'Cassange-Calucala', 144),
(245, 'PR08MN33CM01', 'Dundo', 145),
(246, 'PR08MN33CM02', 'Luachimo', 145),
(247, 'PR08MN35CM01', 'Mussungue', 146),
(248, 'PR08MN35CM02', 'Caita', 146),
(249, 'PR08MN37CM01', 'Cafunfu Sede', 147),
(250, 'PR09MN01CM01', 'Benguela Sede', 148),
(251, 'PR09MN03CM01', 'Baía Farta Sede', 149),
(252, 'PR09MN05CM01', 'Lobito Sede', 150),
(253, 'PR09MN07CM01', 'Cubal Sede', 151),
(254, 'PR09MN09CM01', 'Ganda Sede', 152),
(255, 'PR09MN11CM01', 'Balombo', 153),
(256, 'PR09MN11CM02', 'Maca Mombolo', 153),
(257, 'PR09MN13CM01', 'Bocoio', 154),
(258, 'PR09MN13CM02', 'Cubal do Lumbo', 154),
(259, 'PR09MN13CM03', 'Monte Belo', 154),
(260, 'PR09MN15CM01', 'Caimbambo ', 155),
(261, 'PR09MN15CM02', 'Caiavi', 155),
(262, 'PR09MN15CM03', 'Viangombe', 155),
(263, 'PR09MN17CM01', 'Chongoroi', 156),
(264, 'PR09MN17CM03', 'Camuine', 156),
(265, 'PR09MN19CM01', 'Catumbela Sede', 157),
(266, 'PR09MN45CM01', 'Navegantes', 157),
(267, 'PR09MN21CM01', 'Dombe Grande Sede', 158),
(268, 'PR09MN23CM01', 'Chindumbo Sede', 159),
(269, 'PR09MN25CM01', 'Chila Sede', 160),
(270, 'PR09MN27CM01', 'Canhamela Sede', 161),
(271, 'PR09MN29CM01', 'Catengue Sede', 162),
(272, 'PR09MN31CM01', 'Biopio Sede', 163),
(273, 'PR09MN33CM01', 'Bolonguera Sede', 164),
(274, 'PR09MN35CM01', 'Capupa Sede', 165),
(275, 'PR09MN37CM01', 'Iambala Sede', 166),
(276, 'PR09MN39CM01', 'Babaera Sede', 167),
(277, 'PR09MN41CM01', 'Chicuma Sede', 168),
(278, 'PR09MN43CM01', 'Egipto Praia', 169),
(279, 'PR09MN43CM02', 'Canjala', 169),
(280, 'PR10MN01CM01', 'Huambo', 171),
(281, 'PR10MN01CM02', 'Calima', 171),
(282, 'PR10MN03CM01', 'Chicala Cholohanga', 172),
(283, 'PR10MN03CM02', 'Mbave', 172),
(284, 'PR10MN05CM01', 'Cachiungo', 173),
(285, 'PR10MN05CM02', 'Tchinhama', 173),
(286, 'PR10MN07CM01', 'Bailundo', 174),
(287, 'PR10MN07CM02', 'Lunge', 174),
(288, 'PR10MN07CM03', 'Luvemba', 174),
(289, 'PR10MN25CM02', 'Hengue', 174),
(290, 'PR10MN09CM01', 'Caála Sede', 175),
(291, 'PR10MN27CM02', 'Catata', 175),
(292, 'PR10MN11CM01', 'Ecunha', 176),
(293, 'PR10MN11CM02', 'Quipeio', 176),
(294, 'PR10MN13CM01', 'Ucuma', 177),
(295, 'PR10MN13CM02', 'Cacoma', 177),
(296, 'PR10MN13CM03', 'Mundundo', 177),
(297, 'PR10MN15CM01', 'Longonjo', 178),
(298, 'PR10MN15CM02', 'Lépi', 178),
(299, 'PR10MN17CM01', 'Mungo', 179),
(300, 'PR10MN17CM02', 'Cambuengo', 179),
(301, 'PR10MN19CM01', 'Londuimbale', 180),
(302, 'PR10MN19CM03', 'Ussoque', 180),
(303, 'PR10MN31CM01', 'Galanga', 180),
(304, 'PR10MN21CM01', 'Chinjenje', 181),
(305, 'PR10MN21CM02', 'Chiaca', 181),
(306, 'PR10MN25CM01', 'Bimbe', 182),
(307, 'PR10MN27CM01', 'Cuima Sede', 183),
(308, 'PR10MN29CM01', 'Alto Hama Sede', 184),
(309, 'PR10MN31CM02', 'Cumbira', 185),
(310, 'PR10MN33CM01', 'Chilata Sede', 186),
(311, 'PR10MN35CM01', 'Sambo', 187),
(312, 'PR10MN35CM02', 'Samboto', 187),
(313, 'PR11MN01CM01', 'Cuito', 188),
(314, 'PR11MN01CM02', 'Cunje', 188),
(315, 'PR11MN03CM01', 'Cunhinga Sede', 189),
(316, 'PR11MN05CM01', 'Chinguar', 190),
(317, 'PR11MN05CM02', 'Cangote', 190),
(318, 'PR11MN05CM03', 'Cutato', 190),
(319, 'PR11MN07CM01', 'Andulo', 191),
(320, 'PR11MN07CM02', 'Chivaúlo', 191),
(321, 'PR11MN07CM03', 'Cassumbe', 191),
(322, 'PR11MN09CM01', 'Nharêa', 192),
(323, 'PR11MN09CM02', 'Gamba', 192),
(324, 'PR11MN09CM03', 'Caiei', 192),
(325, 'PR11MN11CM01', 'Camacupa', 193),
(326, 'PR11MN11CM02', 'Muinha', 193),
(327, 'PR11MN11CM03', 'Cuanza', 193),
(328, 'PR11MN13CM01', 'Cuemba', 194),
(329, 'PR11MN13CM02', 'Munhango', 194),
(330, 'PR11MN13CM04', 'Sachinemuna', 194),
(331, 'PR11MN15CM01', 'Chitembo', 195),
(332, 'PR11MN15CM02', 'Cachingues', 195),
(333, 'PR11MN15CM03', 'Malengue', 195),
(334, 'PR11MN17CM01', 'Catabola', 196),
(335, 'PR11MN17CM03', 'Sande', 196),
(336, 'PR11MN17CM04', 'Caiuera', 196),
(337, 'PR11MN19CM01', 'Calussinga Sede', 197),
(338, 'PR11MN21CM02', 'Ringoma Sede', 198),
(339, 'PR11MN23CM01', 'Umpulo Sede', 199),
(340, 'PR11MN25CM01', 'Chiuca', 200),
(341, 'PR11MN25CM02', 'Chipeta', 200),
(342, 'PR11MN27CM01', 'Soma Cuanza', 201),
(343, 'PR11MN27CM02', 'Mutumbo', 201),
(344, 'PR11MN27CM03', 'Mumbué', 201),
(345, 'PR11MN29CM01', 'Luando Sede', 202),
(346, 'PR11MN31CM01', 'Belo Horizonte Sede', 203),
(347, 'PR11MN33CM01', 'Chicala Sede', 204),
(348, 'PR11MN35CM01', 'Cambandua Sede', 205),
(349, 'PR11MN37CM01', 'Lubia', 206),
(350, 'PR11MN37CM02', 'Dando', 206),
(351, 'PR12MN01CM01', 'Luena', 207),
(352, 'PR12MN01CM02', 'Cassongo', 207),
(353, 'PR12MN03CM01', 'Camanongue Sede', 208),
(354, 'PR12MN05CM01', 'Léua', 209),
(355, 'PR12MN05CM02', 'Liangongo', 209),
(356, 'PR12MN07CM1', 'Alto Cuito', 210),
(357, 'PR12MN09CM01', 'Lumbala-Nguimbo', 211),
(358, 'PR12MN09CM02', 'Mussuma Mitete', 211),
(359, 'PR12MN09CM03', 'Sessa', 211),
(360, 'PR12MN15CM01', 'Lutembo', 213),
(361, 'PR12MN15CM02', 'Luvuei', 213),
(362, 'PR12MN19CM01', 'Ninda Sede', 214),
(363, 'PR12MN23CM01', 'Cangumbe Sede', 215),
(364, 'PR12MN25CM01', 'Lucusse Sede', 216),
(365, 'PR12MN27CM01', 'Cangamba', 217),
(366, 'PR12MN27CM03', 'Muié', 217),
(367, 'PR12MN27CM04', 'Cassamba', 217),
(368, 'PR12MN33CM01', 'Lutuai Sede', 218),
(369, 'PR13MN01CM01', 'Cuito Cuanavale', 219),
(370, 'PR13MN01CM02', 'Lupire', 219),
(371, 'PR13MN03CM01', 'Mavinga Sede', 220),
(372, 'PR13MN05CM01', 'Rivungo Sede', 221),
(373, 'PR13MN07CM01', 'Cunjamba', 222),
(374, 'PR13MN07CM02', 'Cutuile', 222),
(375, 'PR13MN09CM01', 'Mucusso Sede', 223),
(376, 'PR13MN11CM01', 'Luengue Sede', 224),
(377, 'PR13MN13CM01', 'Xipundo Sede', 225),
(378, 'PR13MN15CM01', 'Dirico', 226),
(379, 'PR13MN15CM02', 'Xamavera', 226),
(380, 'PR13MN17CM01', 'Luiana Sede', 227),
(381, 'PR14MN01CM01', 'Moçâmedes Sede', 228),
(382, 'PR14MN03CM01', 'Tômbwa Sede', 229),
(383, 'PR14MN05CM01', 'Virei', 230),
(384, 'PR14MN05CM02', 'Cainde', 230),
(385, 'PR14MN07CM01', 'Bibala', 231),
(386, 'PR14MN07CM02', 'Caitou', 231),
(387, 'PR14MN07CM03', 'Lola', 231),
(388, 'PR14MN07CM04', 'Capangombe', 231),
(389, 'PR14MN09CM01', 'Camucuio', 232),
(390, 'PR14MN09CM02', 'Mamué', 232),
(391, 'PR14MN09CM03', 'Chingo', 232),
(392, 'PR14MN11CM01', 'Iona Sede', 233),
(393, 'PR14MN13CM01', 'Sacomar', 234),
(394, 'PR14MN15CM01', 'Cacimbas Sede', 235),
(395, 'PR14MN17CM01', 'Lucira', 236),
(396, 'PR14MN17CM02', 'Bentiaba', 236),
(397, 'PR15MN01CM01', 'Lubango', 237),
(398, 'PR15MN01CM02', 'Huila', 237),
(399, 'PR15MN03CM01', 'Cacula', 238),
(400, 'PR15MN03CM02', 'Tchicuaqueia', 238),
(401, 'PR15MN05CM01', 'Chibia', 239),
(402, 'PR15MN05CM03', 'Jau', 239),
(403, 'PR15MN07CM01', 'Caconda', 240),
(404, 'PR15MN07CM02', 'Gungue', 240),
(405, 'PR15MN07CM03', 'Uaba', 240),
(406, 'PR15MN07CM04', 'Cusse', 240),
(407, 'PR15MN09CM01', 'Caluquembe', 241),
(408, 'PR15MN09CM02', 'Calepi', 241),
(409, 'PR15MN09CM03', 'Negola', 241),
(410, 'PR15MN11CM01', 'Quilengues', 242),
(411, 'PR15MN11CM02', 'Impulo', 242),
(412, 'PR15MN11CM03', 'Dinde', 242),
(413, 'PR15MN13CM01', 'Cuvango Sede', 243),
(414, 'PR15MN15CM01', 'Quipungo Sede', 244),
(415, 'PR15MN17CM01', 'Matala Sede', 245),
(416, 'PR15MN19CM01', 'Chicomba', 246),
(417, 'PR15MN19CM02', 'Cutenda', 246),
(418, 'PR15MN21CM01', 'Jamba Mineira', 247),
(419, 'PR15MN21CM02', 'Cassinga', 247),
(420, 'PR15MN23CM01', 'Chipindo', 248),
(421, 'PR15MN23CM02', 'Bambi', 248),
(422, 'PR15MN25CM01', 'Chiange', 249),
(423, 'PR15MN25CM02', 'Chimbemba', 249),
(424, 'PR15MN27CM01', 'Humpata Sede', 250),
(425, 'PR15MN29CM01', 'Chituto Sede', 251),
(426, 'PR15MN31CM01', 'Viti Vivali Sede', 252),
(427, 'PR15MN33CM01', 'Capunda Cavilongo', 253),
(428, 'PR15MN33CM02', 'Quihita', 253),
(429, 'PR15MN35CM01', 'Galangue Sede', 254),
(430, 'PR15MN37CM01', 'Dongo Sede', 255),
(431, 'PR15MN39CM01', 'Chicungo Sede', 256),
(432, 'PR15MN41CM01', 'Hoque Sede', 257),
(433, 'PR15MN43CM01', 'Mulondo', 258),
(434, 'PR15MN43CM02', 'Capelongo', 258),
(435, 'PR15MN45CM01', 'Palanca Sede', 259),
(436, 'PR16MN01CM01', 'Ondjiva', 260),
(437, 'PR16MN01CM02', 'Môngwa', 260),
(438, 'PR16MN03CM01', 'Xangongo', 261),
(439, 'PR16MN03CM02', 'Ombala-yo-Mungu', 261),
(440, 'PR16MN05CM01', 'Cuvelai Sede', 262),
(441, 'PR16MN07CM01', 'Curoca Sede', 263),
(442, 'PR16MN09CM01', 'Namacunde Sede', 264),
(443, 'PR16MN11CM01', 'Cahama', 265),
(444, 'PR16MN11CM02', 'Otchinjau', 265),
(445, 'PR16MN13CM01', 'Chitado Sede', 266),
(446, 'PR16MN15CM01', 'Chiede Sede', 267),
(447, 'PR16MN17CM01', 'Humbe', 268),
(448, 'PR16MN17CM02', 'Mucope', 268),
(449, 'PR16MN19CM01', 'Naulila Sede', 269),
(450, 'PR16MN21CM01', 'Nehone', 270),
(451, 'PR16MN21CM02', 'Evale', 270),
(452, 'PR16MN23CM01', 'CHissuata Sede', 271),
(453, 'PR16MN25CM01', 'Mupa Sede', 272),
(454, 'PR16MN27CM01', 'Cafima Sede', 273),
(455, 'PR17MN01CM01', 'Saurimo', 274),
(456, 'PR17MN01CM02', 'Mona Quimbundo', 274),
(457, 'PR17MN03CM01', 'Muconda Sede', 275),
(458, 'PR17MN05CM01', 'Dala Sede', 276),
(459, 'PR17MN07CM01', 'Cacolo Sede', 277),
(460, 'PR17MN09CM01', 'Alto-Chicapa Sede', 278),
(461, 'PR17MN11CM01', 'Cucumbi', 279),
(462, 'PR17MN11CM02', 'Xassengue', 279),
(463, 'PR17MN13CM01', 'Cazaje', 280),
(464, 'PR17MN15CM01', 'Luma Cassai Sede', 281),
(465, 'PR17MN17CM01', 'Cassai-Sul', 282),
(466, 'PR17MN19CM01', 'Chiluange Sede', 283),
(467, 'PR17MN21CM01', 'Murieje Sede', 284),
(468, 'PR17MN23CM01', 'Sombo Sede', 285),
(469, 'PR17MN25CM01', 'Cassengo Sede', 286),
(470, 'PR17MN27CM01', 'Muangueji Sede', 287),
(471, 'PR18MN01CM01', 'Caxito', 288),
(472, 'PR18MN01CM02', 'Mabubas', 288),
(473, 'PR18MN01CM03', 'Quicabo', 288),
(474, 'PR18MN03CM01', 'Barra do Dande Sede', 289),
(475, 'PR18MN05CM01', 'Úcua Sede', 290),
(476, 'PR18MN07CM01', 'Ambriz', 291),
(477, 'PR18MN07CM02', 'Bela Vista', 291),
(478, 'PR18MN07CM03', 'Tabi', 291),
(479, 'PR18MN09CM01', 'Gombe', 292),
(480, 'PR18MN09CM02', 'Canacassala', 292),
(481, 'PR18MN09CM03', 'Zala', 292),
(482, 'PR18MN11CM01', 'Bula-Atumba', 293),
(483, 'PR18MN11CM02', 'Quiage', 293),
(484, 'PR18MN13CM01', 'Quibaxe', 294),
(485, 'PR18MN13CM02', 'Coxe', 294),
(486, 'PR18MN13CM03', 'Paredes', 294),
(487, 'PR18MN15CM01', 'Pango-Aluquem', 295),
(488, 'PR18MN15CM02', 'Cazua-Ngongo', 295),
(489, 'PR18MN17CM01', 'Muxiluando', 296),
(490, 'PR18MN17CM02', 'Cage Mazumbo', 296),
(491, 'PR18MN17CM03', 'Quixico', 296),
(492, 'PR18MN19CM01', 'Quicunzo Sede', 297),
(493, 'PR18MN21CM01', 'Panguila', 298),
(494, 'PR18MN23CM01', 'Piri Sede', 299),
(495, 'PR19MN01CM01', 'Catete', 300),
(496, 'PR19MN01CM02', 'Cassoneca', 300),
(497, 'PR19MN01CM03', 'Caculo Cahongo', 300),
(498, 'PR19MN01CM04', 'Caxicane', 300),
(499, 'PR19MN03CM01', 'Bom Jesus Sede', 301),
(500, 'PR19MN05CM01', 'Cabiri Sede', 302),
(501, 'PR19MN09CM01', 'Cabo Ledo Sede', 303),
(502, 'PR19MN11CM01', 'Funda', 304),
(503, 'PR19MN11CM02', 'Quifangondo', 304),
(504, 'PR19MN11CM03', 'Sequele', 304),
(505, 'PR19MN13CM01', 'Calumbo Sede', 305),
(506, 'PR19MN15CM01', 'Muxima', 306),
(507, 'PR19MN15CM02', 'Demba Chio', 306),
(508, 'PR19MN15CM03', 'Mumbondo', 306),
(509, 'PR19MN15CM04', 'Quixinge', 306),
(510, 'PR20MN01CM01', 'Cazombo', 307),
(511, 'PR20MN01CM02', 'Lumbala Caquengue', 307),
(512, 'PR20MN03CM01', 'Caianda Sede', 308),
(513, 'PR20MN05CM01', 'Lóvua Zambeze Sede', 309),
(514, 'PR20MN07CM01', 'Luacano sede', 310),
(515, 'PR20MN09CM01', 'Cameia Sede', 311),
(516, 'PR20MN21CM01', 'Lago-Dilolo Sede', 313),
(517, 'PR20MN29CM01', 'Nana Candundo', 314),
(518, 'PR20MN31CM01', 'Macondo', 315),
(519, 'PR20MN31CM02', 'Calunda', 315),
(520, 'PR21MN01CM01', 'Menongue Sede', 316),
(521, 'PR21MN03CM01', 'Mavengue', 317),
(522, 'PR21MN03CM02', 'Maué', 317),
(523, 'PR21MN05CM01', 'Cuangar Sede', 318),
(524, 'PR21MN07CM01', 'Savate', 319),
(525, 'PR21MN07CM02', 'Bondo Caila', 319),
(526, 'PR21MN11CM01', 'Cuchi Sede', 320),
(527, 'PR21MN13CM01', 'Chinguanja Sede', 321),
(528, 'PR21MN15CM01', 'Nancova', 322),
(529, 'PR21MN15CM02', 'Rito', 322),
(530, 'PR21MN17CM01', 'Calai Sede', 323),
(531, 'PR21MN19CM01', 'Longa', 324),
(532, 'PR21MN19CM02', 'Baixo Longa', 324),
(533, 'PR21MN20CM01', 'Cutato', 325),
(534, 'PR21MN20CM02', 'Vissati', 325),
(535, 'PR21MN21CM01', 'Caiundo', 326),
(536, 'PR21MN21CM02', 'Jamba Cueio', 326);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `id_disciplina` int(11) NOT NULL,
  `nome_disciplina` varchar(150) NOT NULL,
  `carga_horaria` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `disciplinas`
--

INSERT INTO `disciplinas` (`id_disciplina`, `nome_disciplina`, `carga_horaria`, `descricao`, `created_at`, `updated_at`) VALUES
(1, 'Fisica', 20, '', '2026-02-18 08:22:51', '2026-02-18 08:22:51'),
(2, 'Língua Portuguesa', 20, 'O professor tem 20 tempos', '2026-02-20 18:52:02', '2026-02-20 18:52:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque_rupe`
--

CREATE TABLE `estoque_rupe` (
  `id_rupe` int(11) NOT NULL,
  `referencia` varchar(25) DEFAULT NULL,
  `utilizado` tinyint(1) DEFAULT 0,
  `data_importacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque_rupes`
--

CREATE TABLE `estoque_rupes` (
  `id` int(11) NOT NULL,
  `numero_rupe` varchar(50) NOT NULL,
  `status` enum('livre','utilizado') DEFAULT 'livre',
  `aluno_id` int(11) DEFAULT NULL,
  `data_uso` datetime DEFAULT NULL,
  `data_importacao` datetime DEFAULT current_timestamp(),
  `data_utilizacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `estoque_rupes`
--

INSERT INTO `estoque_rupes` (`id`, `numero_rupe`, `status`, `aluno_id`, `data_uso`, `data_importacao`, `data_utilizacao`) VALUES
(1, '602 012 502 034 572 804 74', 'utilizado', 30, '2026-03-04 10:22:43', '2026-03-04 09:39:42', NULL),
(2, '603 012 502 034 572 804 74', 'utilizado', 34, '2026-03-04 10:31:27', '2026-03-04 09:39:42', NULL),
(3, '604 012 502 034 572 804 74', 'utilizado', 33, '2026-03-05 03:16:19', '2026-03-04 09:39:42', NULL),
(4, '605 012 502 034 572 804 74', 'livre', NULL, NULL, '2026-03-04 09:39:42', NULL),
(5, '606 012 502 034 572 804 74', 'livre', NULL, NULL, '2026-03-04 09:39:42', NULL),
(6, '607 012 502 034 572 804 74', 'livre', NULL, NULL, '2026-03-04 09:39:42', NULL),
(7, '608 012 502 034 572 804 74', 'livre', NULL, NULL, '2026-03-04 09:39:42', NULL),
(8, '609 012 502 034 572 804 74', 'livre', NULL, NULL, '2026-03-04 09:39:42', NULL),
(9, '610 012 502 034 572 804 74', 'livre', NULL, NULL, '2026-03-04 09:39:42', NULL),
(10, '611 012 502 034 572 804 74', 'livre', NULL, NULL, '2026-03-04 09:39:42', NULL),
(11, '612 012 502 034 572 804 74', 'livre', NULL, NULL, '2026-03-04 09:39:42', NULL),
(12, '613 012 502 034 572 804 74', 'livre', NULL, NULL, '2026-03-04 09:39:42', NULL),
(13, '614 012 502 034 572 804 74', 'livre', NULL, NULL, '2026-03-04 09:39:42', NULL),
(14, '615 012 502 034 572 804 74', 'livre', NULL, NULL, '2026-03-04 09:39:42', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `matriculas`
--

CREATE TABLE `matriculas` (
  `id_matricula` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `referencia_pagamento` varchar(50) DEFAULT NULL,
  `status` enum('Pendente','Confirmada','Cancelada') DEFAULT 'Pendente',
  `data_inscricao` datetime DEFAULT current_timestamp(),
  `id_rupe_associado` int(11) DEFAULT NULL,
  `status_pagamento` enum('pendente','pago') DEFAULT 'pendente',
  `comprovativo_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `matriculas`
--

INSERT INTO `matriculas` (`id_matricula`, `id_aluno`, `id_turma`, `referencia_pagamento`, `status`, `data_inscricao`, `id_rupe_associado`, `status_pagamento`, `comprovativo_path`) VALUES
(1, 1, 1, NULL, 'Confirmada', '2026-02-18 15:25:33', NULL, 'pendente', NULL),
(2, 3, 1, NULL, 'Confirmada', '2026-02-19 11:39:13', NULL, 'pendente', NULL),
(3, 5, 1, NULL, 'Confirmada', '2026-02-19 11:39:54', NULL, 'pendente', NULL),
(4, 11, 2, NULL, 'Confirmada', '2026-02-19 16:47:43', NULL, 'pendente', NULL),
(5, 7, 2, NULL, 'Confirmada', '2026-02-20 05:40:04', NULL, 'pendente', NULL),
(6, 4, 1, NULL, 'Confirmada', '2026-02-21 01:26:51', NULL, 'pendente', NULL),
(7, 6, 1, NULL, 'Confirmada', '2026-02-21 01:27:34', NULL, 'pendente', NULL),
(8, 7, 1, NULL, 'Confirmada', '2026-02-21 01:28:03', NULL, 'pendente', NULL),
(9, 8, 1, NULL, 'Confirmada', '2026-02-21 01:28:18', NULL, 'pendente', NULL),
(10, 9, 1, NULL, 'Confirmada', '2026-02-21 01:28:35', NULL, 'pendente', NULL),
(11, 22, 1, NULL, 'Confirmada', '2026-02-21 01:28:50', NULL, 'pendente', NULL),
(12, 10, 1, NULL, 'Cancelada', '2026-02-21 01:29:12', NULL, 'pendente', NULL),
(13, 11, 1, NULL, 'Confirmada', '2026-02-21 01:30:11', NULL, 'pendente', NULL),
(14, 21, 3, NULL, 'Confirmada', '2026-02-21 01:53:06', NULL, 'pendente', NULL),
(15, 14, 3, NULL, 'Confirmada', '2026-02-21 01:53:21', NULL, 'pendente', NULL),
(16, 17, 3, NULL, 'Confirmada', '2026-02-21 01:53:35', NULL, 'pendente', NULL),
(17, 12, 3, NULL, 'Confirmada', '2026-02-21 01:53:50', NULL, 'pendente', NULL),
(18, 15, 3, NULL, 'Confirmada', '2026-02-21 01:54:02', NULL, 'pendente', NULL),
(19, 13, 3, NULL, 'Confirmada', '2026-02-21 01:56:29', NULL, 'pendente', NULL),
(20, 25, 3, NULL, 'Confirmada', '2026-02-24 13:12:45', NULL, 'pendente', NULL),
(21, 4, 2, NULL, 'Confirmada', '2026-02-24 15:54:17', NULL, 'pendente', NULL),
(22, 22, 3, NULL, 'Confirmada', '2026-02-24 09:01:56', NULL, 'pendente', NULL),
(23, 11, 9, NULL, 'Confirmada', '2026-02-24 09:11:22', NULL, 'pendente', NULL),
(24, 10, 9, NULL, 'Pendente', '2026-02-24 10:04:01', NULL, 'pendente', NULL),
(25, 24, 9, NULL, 'Pendente', '2026-02-24 10:19:33', NULL, 'pendente', NULL),
(27, 30, 1, NULL, 'Pendente', '2026-03-04 10:22:43', NULL, 'pendente', NULL),
(28, 34, 4, NULL, 'Pendente', '2026-03-04 10:31:27', NULL, 'pendente', NULL),
(29, 33, 9, NULL, 'Pendente', '2026-03-05 03:16:19', NULL, 'pendente', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `municipios`
--

CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL,
  `codigo` varchar(15) NOT NULL COMMENT 'Ex: PR04MN01',
  `nome` varchar(100) NOT NULL COMMENT 'Ex: Luanda',
  `id_provincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Municípios de Angola';

--
-- Extraindo dados da tabela `municipios`
--

INSERT INTO `municipios` (`id_municipio`, `codigo`, `nome`, `id_provincia`) VALUES
(1, 'PR01MN01', 'Cabinda', 1),
(2, 'PR01MN03', 'Cacongo', 1),
(3, 'PR01MN05', 'Buco Zau', 1),
(4, 'PR01MN07', 'Belize', 1),
(5, 'PR01MN09', 'Miconje', 1),
(6, 'PR01MN11', 'Tando Zinze', 1),
(7, 'PR01MN13', 'Necuto', 1),
(8, 'PR01MN15', 'Massabi', 1),
(9, 'PR01MN17', 'Ngoio', 1),
(10, 'PR01MN19', 'Liambo', 1),
(11, 'PR02MN01', 'Mbanza Congo', 2),
(12, 'PR02MN03', 'Soyo', 2),
(13, 'PR02MN05', 'Nzeto', 2),
(14, 'PR02MN07', 'Tomboco', 2),
(15, 'PR02MN09', 'Nóqui', 2),
(16, 'PR02MN11', 'Cuimba', 2),
(17, 'PR02MN13', 'Quêlo', 2),
(18, 'PR02MN15', 'Serra de Canda', 2),
(19, 'PR02MN17', 'Lufico', 2),
(20, 'PR02MN19', 'Quindege', 2),
(21, 'PR02MN21', 'Luvo', 2),
(22, 'PR03MN01', 'Uíge', 3),
(23, 'PR03MN03', 'Ambuíla', 3),
(24, 'PR03MN05', 'Songo', 3),
(25, 'PR03MN07', 'Bembe', 3),
(26, 'PR03MN09', 'Negage', 3),
(27, 'PR03MN11', 'Bungo', 3),
(28, 'PR03MN13', 'Maquela do  Zombo', 3),
(29, 'PR03MN15', 'Damba', 3),
(30, 'PR03MN17', 'Cangola', 3),
(31, 'PR03MN19', 'Sanza Pombo', 3),
(32, 'PR03MN21', 'Dange Quitexe', 3),
(33, 'PR03MN23', 'Quimbele', 3),
(34, 'PR03MN25', 'Milunga', 3),
(35, 'PR03MN27', 'Puri', 3),
(36, 'PR03MN29', 'Mucaba', 3),
(37, 'PR03MN33', 'Quipedro', 3),
(38, 'PR03MN35', 'Sacandica', 3),
(39, 'PR03MN37', 'Alto-Zaza', 3),
(40, 'PR03MN45', 'Nova Esperança', 3),
(41, 'PR03MN47', 'Nsosso', 3),
(42, 'PR03MN49', 'Massau', 3),
(43, 'PR03MN51', 'Lucunga', 3),
(44, 'PR03MN53', 'Vista Alegre', 3),
(45, 'PR04MN01', 'Mussulo', 4),
(46, 'PR04MN03', 'Hoji-ya-Henda', 4),
(47, 'PR04MN05', 'Mulenvos', 4),
(48, 'PR04MN07', 'Kilamba', 4),
(49, 'PR04MN09', 'Cazenga', 4),
(50, 'PR04MN11', 'Samba', 4),
(51, 'PR04MN13', 'Rangel', 4),
(52, 'PR04MN15', 'Cacuaco', 4),
(53, 'PR04MN17', 'Viana', 4),
(54, 'PR04MN19', 'Maianga', 4),
(55, 'PR04MN21', 'Belas', 4),
(56, 'PR04MN23', 'Sambizanga', 4),
(57, 'PR04MN25', 'Ingombota', 4),
(58, 'PR04MN27', 'Kilamba Kiaxi', 4),
(59, 'PR04MN29', 'Talatona', 4),
(60, 'PR04MN31', 'Camama', 4),
(61, 'PR05MN01', 'Cazengo', 5),
(62, 'PR05MN03', 'Lucala', 5),
(63, 'PR05MN05', 'Golungo Alto', 5),
(64, 'PR05MN07', 'Cambambe', 5),
(65, 'PR05MN09', 'Ambaca', 5),
(66, 'PR05MN11', 'Quiculungo', 5),
(67, 'PR05MN13', 'Bolongongo', 5),
(68, 'PR05MN15', 'Banga', 5),
(69, 'PR05MN17', 'Samba Caju', 5),
(70, 'PR05MN19', 'Ngonguembo', 5),
(71, 'PR05MN21', 'Luinga', 5),
(72, 'PR05MN23', 'Tango', 5),
(73, 'PR05MN25', 'Aldeia Nova', 5),
(74, 'PR05MN27', 'Caculo Cabaça', 5),
(75, 'PR05MN29', 'Terreiro', 5),
(76, 'PR05MN31', 'Massangano', 5),
(77, 'PR05MN33', 'Cêrca', 5),
(78, 'PR06MN01', 'Sumbe', 6),
(79, 'PR06MN05', 'Quilenda', 6),
(80, 'PR06MN07', 'Porto Amboim', 6),
(81, 'PR06MN11', 'Quibala', 6),
(82, 'PR06MN13', 'Mussende', 6),
(83, 'PR06MN15', 'Seles', 6),
(84, 'PR06MN17', 'Conda', 6),
(85, 'PR06MN19', 'Cassongue', 6),
(86, 'PR06MN21', 'Boa Entrada', 6),
(87, 'PR06MN23', 'Ebo', 6),
(88, 'PR06MN25', 'Waku kungo', 6),
(89, 'PR06MN27', 'Gabela', 6),
(90, 'PR06MN29', 'Pambagala', 6),
(91, 'PR06MN31', 'Sanga', 6),
(92, 'PR06MN33', 'Condé', 6),
(93, 'PR06MN35', 'Calulo', 6),
(94, 'PR06MN37', 'Munenga', 6),
(95, 'PR06MN39', 'Quissongo', 6),
(96, 'PR06MN41', 'Quenha', 6),
(97, 'PR06MN43', 'Quirimbo', 6),
(98, 'PR06MN45', 'Lonhe', 6),
(99, 'PR06MN47', 'Amboiva', 6),
(100, 'PR06MN49', 'Gangula', 6),
(101, 'PR06MN51', 'Gungo', 6),
(102, 'PR07MN01', 'Malanje', 7),
(103, 'PR07MN03', 'Cacuso', 7),
(104, 'PR07MN05', 'Calandula', 7),
(105, 'PR07MN07', 'Cambundi Catembo', 7),
(106, 'PR07MN09', 'Quela', 7),
(107, 'PR07MN11', 'Cahombo', 7),
(108, 'PR07MN13', 'Massango', 7),
(109, 'PR07MN15', 'Luquembo', 7),
(110, 'PR07MN19', 'Kunda Dya Baze', 7),
(111, 'PR07MN23', 'Caculama', 7),
(112, 'PR07MN25', 'Cangandala', 7),
(113, 'PR07MN27', 'Kiwaba Nzoji', 7),
(114, 'PR07MN29', 'Nbanji ya Ngola', 7),
(115, 'PR07MN31', 'Cambo Suinginge', 7),
(116, 'PR07MN33', 'Pungo a Ndongo', 7),
(117, 'PR07MN35', 'Cateco Cangola', 7),
(118, 'PR07MN37', 'Cuale', 7),
(119, 'PR07MN39', 'Quitapa', 7),
(120, 'PR07MN41', 'Milando', 7),
(121, 'PR07MN43', 'Capunda', 7),
(122, 'PR07MN45', 'Ngola Luiji', 7),
(123, 'PR07MN47', 'Quihuhu', 7),
(124, 'PR07MN51', 'Muquixe', 7),
(125, 'PR07MN53', 'Xandel', 7),
(126, 'PR07MN55', 'Quêssua', 7),
(127, 'PR07MN57', 'Marimba', 7),
(128, 'PR07MN59', 'Quirima', 7),
(129, 'PR08MN01', 'Lucapa', 8),
(130, 'PR08MN03', 'Cambulo', 8),
(131, 'PR08MN05', 'Chitato', 8),
(132, 'PR08MN07', 'Cuílo', 8),
(133, 'PR08MN09', 'Caungula', 8),
(134, 'PR08MN11', 'Cuango', 8),
(135, 'PR08MN13', 'Lubalo', 8),
(136, 'PR08MN15', 'Capenda Camulemba', 8),
(137, 'PR08MN17', 'Xá-Muteba', 8),
(138, 'PR08MN19', 'Lóvua', 8),
(139, 'PR08MN21', 'Canzar', 8),
(140, 'PR08MN23', 'Camaxilo', 8),
(141, 'PR08MN25', 'Luremo', 8),
(142, 'PR08MN27', 'Luangue', 8),
(143, 'PR08MN29', 'Xa-Cassau', 8),
(144, 'PR08MN31', 'Cassangue-Calocala', 8),
(145, 'PR08MN33', 'Dundo', 8),
(146, 'PR08MN35', 'Mussungue', 8),
(147, 'PR08MN37', 'Cafunfo', 8),
(148, 'PR09MN01', 'Benguela', 9),
(149, 'PR09MN03', 'Baía Farta', 9),
(150, 'PR09MN05', 'Lobito', 9),
(151, 'PR09MN07', 'Cubal', 9),
(152, 'PR09MN09', 'Ganda', 9),
(153, 'PR09MN11', 'Balombo', 9),
(154, 'PR09MN13', 'Bocoio', 9),
(155, 'PR09MN15', 'Caimbambo', 9),
(156, 'PR09MN17', 'Chongoroi', 9),
(157, 'PR09MN19', 'Catumbela', 9),
(158, 'PR09MN21', 'Dombe Grande', 9),
(159, 'PR09MN23', 'Chindumbo', 9),
(160, 'PR09MN25', 'Chila', 9),
(161, 'PR09MN27', 'Canhamela', 9),
(162, 'PR09MN29', 'Catengue', 9),
(163, 'PR09MN31', 'Biópio', 9),
(164, 'PR09MN33', 'Bolonguera', 9),
(165, 'PR09MN35', 'Capupa', 9),
(166, 'PR09MN37', 'Iambala', 9),
(167, 'PR09MN39', 'Babaera', 9),
(168, 'PR09MN41', 'Chicuma', 9),
(169, 'PR09MN43', 'Egipto Praia', 9),
(170, 'PR09MN45', 'Navegantes', 9),
(171, 'PR10MN01', 'Huambo', 10),
(172, 'PR10MN03', 'Chicala Cholohanga', 10),
(173, 'PR10MN05', 'Catchiungo', 10),
(174, 'PR10MN07', 'Bailundo', 10),
(175, 'PR10MN09', 'Caála', 10),
(176, 'PR10MN11', 'Ecunha', 10),
(177, 'PR10MN13', 'Ucuma', 10),
(178, 'PR10MN15', 'Longonjo', 10),
(179, 'PR10MN17', 'Mungo', 10),
(180, 'PR10MN19', 'Londuimbale', 10),
(181, 'PR10MN21', 'Chinjenje', 10),
(182, 'PR10MN25', 'Bimbe', 10),
(183, 'PR10MN27', 'Cuima', 10),
(184, 'PR10MN29', 'Alto Hama', 10),
(185, 'PR10MN31', 'Galanga', 10),
(186, 'PR10MN33', 'Chilata', 10),
(187, 'PR10MN35', 'Sambo', 10),
(188, 'PR11MN01', 'Cuito', 11),
(189, 'PR11MN03', 'Cunhinga', 11),
(190, 'PR11MN05', 'Chinguar', 11),
(191, 'PR11MN07', 'Andulo', 11),
(192, 'PR11MN09', 'Nharea', 11),
(193, 'PR11MN11', 'Camacupa', 11),
(194, 'PR11MN13', 'Cuemba', 11),
(195, 'PR11MN15', 'Chitembo', 11),
(196, 'PR11MN17', 'Catabola', 11),
(197, 'PR11MN19', 'Calussinga', 11),
(198, 'PR11MN21', 'Ringoma', 11),
(199, 'PR11MN23', 'Umpulo', 11),
(200, 'PR11MN25', 'Chipeta', 11),
(201, 'PR11MN27', 'Mumbué', 11),
(202, 'PR11MN29', 'Luando', 11),
(203, 'PR11MN31', 'Belo Horizonte', 11),
(204, 'PR11MN33', 'Chicala', 11),
(205, 'PR11MN35', 'Cambandua', 11),
(206, 'PR11MN37', 'Lubia', 11),
(207, 'PR12MN01', 'Luena', 12),
(208, 'PR12MN03', 'Camanongue', 12),
(209, 'PR12MN05', 'Léua', 12),
(210, 'PR12MN07', 'Alto Cuito', 12),
(211, 'PR12MN09', 'Lumbala-Nguimbo', 12),
(212, 'PR12MN11', 'Chiume', 12),
(213, 'PR12MN15', 'Lutembo', 12),
(214, 'PR12MN19', 'Ninda', 12),
(215, 'PR12MN23', 'Camgumbe', 12),
(216, 'PR12MN25', 'Lucusse', 12),
(217, 'PR12MN27', 'Cangamba', 12),
(218, 'PR12MN33', 'Lutuai', 12),
(219, 'PR13MN01', 'Cuito Cuanavale', 13),
(220, 'PR13MN03', 'Mavinga', 13),
(221, 'PR13MN05', 'Rivungo', 13),
(222, 'PR13MN07', 'Dima', 13),
(223, 'PR13MN09', 'Mucusso', 13),
(224, 'PR13MN11', 'Luengue', 13),
(225, 'PR13MN13', 'Xipundo', 13),
(226, 'PR13MN15', 'Dirico', 13),
(227, 'PR13MN17', 'Luiana', 13),
(228, 'PR14MN01', 'Moçâmedes', 14),
(229, 'PR14MN03', 'Tômbwa', 14),
(230, 'PR14MN05', 'Virei', 14),
(231, 'PR14MN07', 'Bibala', 14),
(232, 'PR14MN09', 'Camucuio', 14),
(233, 'PR14MN11', 'Iona', 14),
(234, 'PR14MN13', 'Sacomar', 14),
(235, 'PR14MN15', 'Cacimbas', 14),
(236, 'PR14MN17', 'Lucira', 14),
(237, 'PR15MN01', 'Lubango', 15),
(238, 'PR15MN03', 'Cacula', 15),
(239, 'PR15MN05', 'Chibia', 15),
(240, 'PR15MN07', 'Caconda', 15),
(241, 'PR15MN09', 'Caluquembe', 15),
(242, 'PR15MN11', 'Quilengues', 15),
(243, 'PR15MN13', 'Cuvango', 15),
(244, 'PR15MN15', 'Quipungo', 15),
(245, 'PR15MN17', 'Matala', 15),
(246, 'PR15MN19', 'Chicomba', 15),
(247, 'PR15MN21', 'Jamba Mineira', 15),
(248, 'PR15MN23', 'Chipindo', 15),
(249, 'PR15MN25', 'Gambos', 15),
(250, 'PR15MN27', 'Humpata', 15),
(251, 'PR15MN29', 'Chituto', 15),
(252, 'PR15MN31', 'Viti Vivali', 15),
(253, 'PR15MN33', 'Capunda Cavilongo', 15),
(254, 'PR15MN35', 'Galangue', 15),
(255, 'PR15MN37', 'Dongo', 15),
(256, 'PR15MN39', 'Chicungo', 15),
(257, 'PR15MN41', 'Hoque', 15),
(258, 'PR15MN43', 'Capelongo', 15),
(259, 'PR15MN45', 'Palanca', 15),
(260, 'PR16MN01', 'Cuanhama', 16),
(261, 'PR16MN03', 'Ombadja', 16),
(262, 'PR16MN05', 'Cuvelai', 16),
(263, 'PR16MN07', 'Curoca', 16),
(264, 'PR16MN09', 'Namacunde', 16),
(265, 'PR16MN11', 'Cahama', 16),
(266, 'PR16MN13', 'Chitado', 16),
(267, 'PR16MN15', 'Chiede', 16),
(268, 'PR16MN17', 'Humbe', 16),
(269, 'PR16MN19', 'Naulila', 16),
(270, 'PR16MN21', 'Nehone', 16),
(271, 'PR16MN23', 'Chissuata', 16),
(272, 'PR16MN25', 'Mupa', 16),
(273, 'PR16MN27', 'Cafima', 16),
(274, 'PR17MN01', 'Saurimo', 17),
(275, 'PR17MN03', 'Muconda', 17),
(276, 'PR17MN05', 'Dala', 17),
(277, 'PR17MN07', 'Cacolo', 17),
(278, 'PR17MN09', 'Alto Chicapa', 17),
(279, 'PR17MN11', 'Xassengue', 17),
(280, 'PR17MN13', 'Cazage', 17),
(281, 'PR17MN15', 'Luma Cassai', 17),
(282, 'PR17MN17', 'Cassai-Sul', 17),
(283, 'PR17MN19', 'Chiluange', 17),
(284, 'PR17MN21', 'Murieje', 17),
(285, 'PR17MN23', 'Sombo', 17),
(286, 'PR17MN25', 'Cassengo', 17),
(287, 'PR17MN27', 'Muangueji', 17),
(288, 'PR18MN01', 'Dande', 18),
(289, 'PR18MN03', 'Barra do Dande', 18),
(290, 'PR18MN05', 'Úcua', 18),
(291, 'PR18MN07', 'Ambriz', 18),
(292, 'PR18MN09', 'Nambuangongo', 18),
(293, 'PR18MN11', 'Bula-Atumba', 18),
(294, 'PR18MN13', 'Quibaxe', 18),
(295, 'PR18MN15', 'Pango-Aluquem', 18),
(296, 'PR18MN17', 'Muxaluando', 18),
(297, 'PR18MN19', 'Quicunzo', 18),
(298, 'PR18MN21', 'Panguila', 18),
(299, 'PR18MN23', 'Piri', 18),
(300, 'PR19MN01', 'Catete', 19),
(301, 'PR19MN03', 'Bom Jesus', 19),
(302, 'PR19MN05', 'Cabiri', 19),
(303, 'PR19MN09', 'Cabo Ledo', 19),
(304, 'PR19MN11', 'Sequele', 19),
(305, 'PR19MN13', 'Calumbo', 19),
(306, 'PR19MN15', 'Quissama', 19),
(307, 'PR20MN01', 'Cazombo', 20),
(308, 'PR20MN03', 'Caianda', 20),
(309, 'PR20MN05', 'Lóvua Zambeze', 20),
(310, 'PR20MN07', 'Luacano', 20),
(311, 'PR20MN09', 'Cameia', 20),
(312, 'PR20MN17', 'Luau', 20),
(313, 'PR20MN21', 'Lago-Dilolo', 20),
(314, 'PR20MN29', 'Nana Candundo', 20),
(315, 'PR20MN31', 'Macondo', 20),
(316, 'PR21MN01', 'Menongue', 21),
(317, 'PR21MN03', 'Mavengue', 21),
(318, 'PR21MN05', 'Cuangar', 21),
(319, 'PR21MN07', 'Savate', 21),
(320, 'PR21MN11', 'Cuchi', 21),
(321, 'PR21MN13', 'Chinguanja', 21),
(322, 'PR21MN15', 'Nancova', 21),
(323, 'PR21MN17', 'Calai', 21),
(324, 'PR21MN19', 'Longa', 21),
(325, 'PR21MN20', 'Cutato', 21),
(326, 'PR21MN21', 'Caiundo', 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notas`
--

CREATE TABLE `notas` (
  `id_nota` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `id_professor` int(11) NOT NULL,
  `trimestre` tinyint(1) NOT NULL COMMENT '1 = 1º Trim, 2 = 2º Trim, 3 = 3º Trim',
  `mac` decimal(4,1) DEFAULT NULL COMMENT 'Média Avaliação Contínua',
  `npp` decimal(4,1) DEFAULT NULL COMMENT 'Nota Prova de Preparação',
  `npt` decimal(4,1) DEFAULT NULL COMMENT 'Nota Prova de Trimestre',
  `mt` decimal(4,2) GENERATED ALWAYS AS (case when `mac` is not null and `npp` is not null and `npt` is not null then round((`mac` + `npp` + `npt`) / 3,2) else NULL end) STORED COMMENT 'Média do Trimestre (calculada)',
  `falta` tinyint(1) DEFAULT 0 COMMENT '1 = Faltou à prova trimestral',
  `observacao` varchar(255) DEFAULT NULL,
  `lancado_em` datetime DEFAULT current_timestamp(),
  `atualizado_em` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Mini Pauta - Notas por trimestre';

--
-- Extraindo dados da tabela `notas`
--

INSERT INTO `notas` (`id_nota`, `id_aluno`, `id_turma`, `id_disciplina`, `id_professor`, `trimestre`, `mac`, `npp`, `npt`, `falta`, `observacao`, `lancado_em`, `atualizado_em`) VALUES
(1, 1, 1, 1, 1, 3, 12.0, 10.0, 13.0, 1, '', '2026-02-18 11:34:59', '2026-02-19 21:55:44'),
(2, 1, 1, 1, 1, 1, 8.0, 4.0, 5.0, 0, '', '2026-02-18 11:45:22', '2026-02-19 21:54:45'),
(3, 1, 1, 1, 1, 2, 10.0, 8.0, 6.0, 0, '', '2026-02-19 03:28:53', '2026-02-19 21:53:42'),
(5, 11, 2, 1, 1, 2, 12.0, 12.0, 12.0, 0, '', '2026-02-19 21:52:59', '2026-02-19 21:52:59'),
(6, 3, 1, 1, 1, 2, 10.0, 10.0, 14.0, 0, NULL, '2026-02-19 21:53:42', '2026-02-23 19:33:20'),
(7, 5, 1, 1, 1, 2, 10.0, 12.0, 12.0, 0, '', '2026-02-19 21:53:42', '2026-02-19 21:53:42'),
(8, 3, 1, 1, 1, 1, 12.0, 12.0, 12.0, 0, NULL, '2026-02-19 21:54:45', '2026-02-23 19:33:20'),
(9, 5, 1, 1, 1, 1, 10.0, 8.0, 4.0, 0, '', '2026-02-19 21:54:45', '2026-02-19 21:54:45'),
(10, 3, 1, 1, 1, 3, 10.0, 12.0, 12.0, 0, NULL, '2026-02-19 21:55:44', '2026-02-23 19:33:20'),
(11, 5, 1, 1, 1, 3, 4.0, 5.0, 6.0, 0, '', '2026-02-19 21:55:44', '2026-02-19 21:55:44'),
(12, 7, 2, 1, 1, 1, 12.0, 12.0, 12.0, 0, '', '2026-02-20 05:40:35', '2026-02-20 05:40:35'),
(13, 11, 2, 1, 1, 1, 14.0, 13.0, 10.0, 0, '', '2026-02-20 05:40:35', '2026-02-20 05:40:35'),
(14, 12, 3, 2, 52, 2, 12.0, 10.0, 10.0, 0, '', '2026-02-21 02:27:54', '2026-02-21 02:27:54'),
(15, 14, 3, 2, 52, 2, 5.0, 6.0, 6.0, 0, '', '2026-02-21 02:27:55', '2026-02-21 02:27:55'),
(16, 15, 3, 2, 52, 2, 10.0, 11.0, 12.0, 0, '', '2026-02-21 02:27:55', '2026-02-21 02:27:55'),
(17, 17, 3, 2, 52, 2, 8.0, 10.0, 9.0, 0, '', '2026-02-21 02:27:55', '2026-02-21 02:27:55'),
(18, 21, 3, 2, 52, 2, 8.0, 12.0, 15.0, 0, '', '2026-02-21 02:27:55', '2026-02-21 02:27:55'),
(25, 3, 1, 2, 1, 1, 12.0, 8.0, 9.0, 5, NULL, '2026-02-23 19:33:20', '2026-02-23 19:33:20'),
(26, 3, 1, 2, 1, 2, 5.0, NULL, NULL, 0, NULL, '2026-02-23 19:33:20', '2026-02-23 19:33:20'),
(27, 3, 1, 2, 1, 3, NULL, NULL, NULL, 0, NULL, '2026-02-23 19:33:20', '2026-02-23 19:33:20'),
(40, 25, 3, 2, 52, 1, 7.0, 5.0, 7.0, 0, '', '2026-02-24 13:13:22', '2026-02-24 13:13:22'),
(41, 12, 3, 2, 52, 1, 12.0, 12.0, 8.0, 0, '', '2026-02-24 13:13:22', '2026-02-24 13:13:22'),
(42, 13, 3, 2, 52, 1, 12.0, 12.0, 12.0, 1, '', '2026-02-24 13:13:22', '2026-02-24 13:13:22'),
(43, 14, 3, 2, 52, 1, 5.0, 4.0, 7.0, 0, '', '2026-02-24 13:13:22', '2026-02-24 13:13:22'),
(44, 15, 3, 2, 52, 1, NULL, NULL, NULL, 0, '', '2026-02-24 13:13:22', '2026-02-24 13:13:22'),
(45, 17, 3, 2, 52, 1, NULL, NULL, NULL, 0, '', '2026-02-24 13:13:22', '2026-02-24 13:13:22'),
(46, 21, 3, 2, 52, 1, NULL, NULL, NULL, 0, '', '2026-02-24 13:13:22', '2026-02-24 13:13:22'),
(47, 11, 9, 2, 52, 1, 8.0, 12.0, 15.0, 0, '', '2026-02-24 16:12:15', '2026-02-24 16:12:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `provincias`
--

CREATE TABLE `provincias` (
  `id_provincia` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL COMMENT 'Ex: PR04',
  `nome` varchar(100) NOT NULL COMMENT 'Ex: Luanda'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Províncias de Angola';

--
-- Extraindo dados da tabela `provincias`
--

INSERT INTO `provincias` (`id_provincia`, `codigo`, `nome`) VALUES
(1, 'PR01', 'Cabinda'),
(2, 'PR02', 'Zaire'),
(3, 'PR03', 'Uíge'),
(4, 'PR04', 'Luanda'),
(5, 'PR05', 'Cuanza Norte'),
(6, 'PR06', 'Cuanza Sul'),
(7, 'PR07', 'Malanje'),
(8, 'PR08', 'Lunda Norte'),
(9, 'PR09', 'Benguela'),
(10, 'PR10', 'Huambo'),
(11, 'PR11', 'Bié'),
(12, 'PR12', 'Moxico'),
(13, 'PR13', 'Cuando'),
(14, 'PR14', 'Namibe'),
(15, 'PR15', 'Huíla'),
(16, 'PR16', 'Cunene'),
(17, 'PR17', 'Lunda Sul'),
(18, 'PR18', 'Bengo'),
(19, 'PR19', 'Icolo e Bengo'),
(20, 'PR20', 'Moxico Leste'),
(21, 'PR21', 'Cubango');

-- --------------------------------------------------------

--
-- Estrutura da tabela `salas`
--

CREATE TABLE `salas` (
  `id_sala` int(11) NOT NULL,
  `nome_sala` varchar(100) NOT NULL,
  `capacidade` int(11) DEFAULT 30,
  `tipo` varchar(50) DEFAULT 'Comum',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `salas`
--

INSERT INTO `salas` (`id_sala`, `nome_sala`, `capacidade`, `tipo`, `created_at`, `updated_at`) VALUES
(1, '12', 30, 'Comum', '2026-02-18 08:19:44', '2026-02-18 08:19:44'),
(2, '10', 20, 'Auditório', '2026-02-19 09:50:39', '2026-02-19 09:50:39'),
(3, '25', 30, 'Laboratório', '2026-03-09 08:48:59', '2026-03-09 08:48:59'),
(4, '45', 30, 'Comum', '2026-03-09 09:24:55', '2026-03-09 09:24:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabalhadores`
--

CREATE TABLE `trabalhadores` (
  `id_trabalhador` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `funcao` varchar(80) NOT NULL COMMENT 'Professor, Professora, Secretário, Secretária, Diretor, etc.',
  `telefone` varchar(30) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `data_admissao` date DEFAULT NULL,
  `doc_bi` varchar(255) DEFAULT NULL COMMENT 'Nome do ficheiro do BI carregado',
  `doc_certificado` varchar(255) DEFAULT NULL COMMENT 'Nome do ficheiro do Certificado carregado',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_provincia` int(11) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `id_comuna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `trabalhadores`
--

INSERT INTO `trabalhadores` (`id_trabalhador`, `nome`, `funcao`, `telefone`, `email`, `data_admissao`, `doc_bi`, `doc_certificado`, `created_at`, `updated_at`, `id_provincia`, `id_municipio`, `id_comuna`) VALUES
(1, 'Sozinho Muanza', 'Professor', '925354049', 'somuanza@hotmail.com', '2025-05-29', '1771424511_b340c81a566eb4d0722a.pdf', '1771424511_3bf645a8c870ae8b1514.pdf', '2026-02-18 08:21:51', '2026-02-22 07:51:21', 19, 305, 505),
(4, 'Joana Francisco da Rocha Francisco', 'DIRECTORA', NULL, 'joana.francisco@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(5, 'Mendes António Dinis', 'SUBDIRECTOR PEDAGOGICO', NULL, 'mendes.dinis@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(6, 'Ricardo Miguel', 'SUBDIRECTOR ADMINISTRATIVO', NULL, 'ricardo.miguel@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(7, 'Adalberto Raimundo', 'Coordenador de DisciplIna de Praticas Oficinais de Electricidade', NULL, 'adalberto.raimundo@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(8, 'Albertina Amelia Zangui Gombo', 'Coordenadora do Curso Tecnico de Informatica', NULL, 'albertina.gombo@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(9, 'Aleixo Willyam Massanga Serafim', 'Coordenador de Disciplina de TREI', NULL, 'aleixo.serafim@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(10, 'Ananias de Oliveira Pereira da Silva', 'Chefe da Secretaria Pedagoguca', NULL, 'ananias.silva@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(11, 'Andre Armando Pipa Dala', 'Coordenador de Disciplina de Educação Fisica', NULL, 'andre.dala@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(12, 'Antonia Suzete Peliganga Camuaoto', 'Coordenador de Disciplina de  Formaçao de Atitudes Integradoras', NULL, 'antonia.camuaoto@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(13, 'António Mandriz Joaquim', 'Coordenador do Gabinete de Inserção a Vida Activa', NULL, 'antonio.joaquim@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(14, 'Antonio Quirino Jose Manuel', 'Coordenador de Disciplina de  Quimica', NULL, 'antonio.manuel@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(15, 'Augusta Zay João Sebastiao Manuel', 'Coordenadora Da Comissão Disciplinar', NULL, 'augusta.manuel@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(16, 'Domingos Jorge Sebastião', 'Coordenador de Disciplina de  Fisica', NULL, 'domingos.sebastiao@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(17, 'Eurico Simão Mayala', 'Coordenador do Curso de Manutenção Mecanica', NULL, 'eurico.mayala@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(18, 'Euritson de Jesus Pedro Simao', 'Coordenador de Disciplina de  Electricidade e Electricidade/Electronica', NULL, 'euritson.simao@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(19, 'Francisco Mayele Silva Da Costa', 'Coordenador de Disciplina de Sistemas Digitais e de Controlo', NULL, 'francisco.costa@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(20, 'Gabriel Luis', 'Coordenador do Curso de Energia e I)nstalaçoes Electricas', NULL, 'gabriel.luis@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(21, 'Jenoveva Marisa João', 'Coordenadora das Actividades Extra Escolares e Culturais', NULL, 'jenoveva.joao@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(22, 'Honório Miguel Miranda Salaquiaco', 'Coordenador de Disciplina de Tecnologia de Comando', NULL, 'honorio.salaquiaco@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(23, 'Joana Sebastiao', 'Coordenador de Disciplina de Lingua Portuguesa', NULL, 'joana.sebastiao@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(24, 'Joao Alfredo Binga', 'Coordenador do Curso de Frio e Climatização', NULL, 'joao.binga@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(25, 'José Lourenço Alfredo João', 'Coordenador de Disciplina de Matematica', NULL, 'jose.joao@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(26, 'Lando Miguel Pedro', 'Coordenador de Disciplinas de Tecnologia de Maquinas e Motores e de Processo', NULL, 'lando.pedro@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(27, 'Manuel Sebastião Paulo', 'Coordenador de Disciplina de  Praticas Oficinas de Mecanica', NULL, 'manuel.paulo@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(28, 'Maria Manuel Augusto', 'Coordenadora da Disciplina de Biologia', NULL, 'maria.augusto@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(29, 'Maria Rosa Antonio Prado Manuel', 'Coordenadora da Disciplina de Lingua Inglesa', NULL, 'maria.manuel@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(30, 'Mauro Domingos José', 'Coordenador da Disciplina de Desenho Tecnico e de Construção Mecanica', NULL, 'mauro.jose@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(31, 'Miguel Sebastião De Castro', 'Coordenador do Curso de Mecatrónica Automovel', NULL, 'miguel.castro@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(32, 'Nguiengo Pinto Tomás', 'Coordenador do Curso de Maquinas e Motores', NULL, 'nguiengo.tomas@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(33, 'Nsimba Bunga Vemba da Silva', 'Coordenador de Disciplina de  Empreendedorismo e OGI', NULL, 'nsimba.silva@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(34, 'Silveira Filho Francisco Domingos', 'Coordenador de Disciplina de  Tecnicas e Linguagem de Programação', NULL, 'silveira.domingos@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(35, 'Sozinho Muanza miranda da Silva', 'Coordenador do Curso de  Tecnico de Produção em Metalomecanica', NULL, 'sozinho.silva@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(36, 'Suzaneth Rufino Mateus Pacavira Sango', 'Chefe da Secretaria Administrativa', NULL, 'suzaneth.sango@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(37, 'Tondo Manuel Mbolosi', 'Coordenador do Curso de  Tecnico de Laboratório Quimico Biologico', NULL, 'tondo.mbolosi@ipiz.ao', NULL, NULL, NULL, '2026-02-18 19:17:56', '2026-02-21 16:21:00', NULL, NULL, NULL),
(41, 'Adelaide Feliciana Neto da Silva Issenguel', 'Professor', NULL, 'adelaide.issenguel@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(42, 'Ana Natalia Chamula Alves', 'Professor', NULL, 'ana.alves@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(43, 'André Ngongo Yosso António', 'Professor', NULL, 'andre.antonio@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(44, 'André Panzo Samuel', 'Professor', NULL, 'andre.samuel@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(45, 'Andre Paulo Panzo Quieza', 'Professor', NULL, 'andre.quieza@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(46, 'Antonica Caefel***', 'Professor', NULL, 'antonica.caefel***@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(47, 'Baptista Paulo dos Santos Contreiras', 'Professor', NULL, 'baptista.contreiras@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(48, 'Benoni Tito Kakumba J. Adolfo Domingos', 'Professor', NULL, 'benoni.domingos@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(49, 'Biodina da Fonseca Alberto', 'Professor', NULL, 'biodina.alberto@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(50, 'Borges Armando de Freitas', 'Professor', NULL, 'borges.freitas@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(51, 'Brahms Carvalho Das Neves Filipe', 'Professor', NULL, 'brahms.filipe@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(52, 'Cândido Galante Cucuila', 'Professor', NULL, 'candido@gmail.com', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:16:50', NULL, NULL, NULL),
(53, 'Castro José Muenho', 'Professor', NULL, 'castro.muenho@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(54, 'Catarina Gabriela C. Da Fonseca Sapilinho', 'Professor', NULL, 'catarina.sapilinho@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(55, 'César Antonio Andre Maiala**', 'Professor', NULL, 'cesar.maiala**@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(56, 'Custodio Alvaro Caluanda', 'Professor', NULL, 'custodio.caluanda@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(57, 'Domingas Manuel João António', 'Professor', NULL, 'domingas.antonio@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(58, 'Domingos Masseca Fiel', 'Professor', NULL, 'domingos.fiel@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(59, 'Edilson Jacob Paca da Cunha', 'Professor', NULL, 'edilson.cunha@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(60, 'Eldibrando Jose Gonçalves Da Silva', 'Professor', NULL, 'eldibrando.silva@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(61, 'Elisa Almeida Razão**', 'Professor', NULL, 'elisa.razao**@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(62, 'Elsa Da Costa Garcia', 'Professor', NULL, 'elsa.garcia@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(63, 'Emidio Chissingui Pedro Lourenço', 'Professor', NULL, 'emidio.lourenço@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(64, 'Emidio Francisco Manuel', 'Professor', NULL, 'emidio.manuel@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(65, 'Emanuel Rodrigues Buaque', 'Professor', NULL, 'emanuel.buaque@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(66, 'Felicia Pereira Domingos e Domingos', 'Professor', NULL, 'felicia.domingos@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(67, 'Filipe Pedro Sebastião Paka **', 'Professor', NULL, 'filipe.**@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(68, 'Francisco Filipe Antonio', 'Professor', NULL, 'francisco.antonio68@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(69, 'Francisco Joaquim António', 'Professor', NULL, 'francisco.antonio69@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(70, 'Francisco José Bernardo Bento', 'Professor', NULL, 'francisco.bento@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(71, 'Joana Ilhaneth Mateus Salvador', 'Professor', NULL, 'joana.salvador@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(72, 'Joao Candido', 'Professor', NULL, 'joao.candido@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(73, 'João Gonçalves José  Pedro', 'Professor', NULL, 'joao.pedro@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(74, 'Joaquina V. Lopes Sebastiao Pacavira', 'Professor', NULL, 'joaquina.pacavira@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(75, 'José Adão da Costa', 'Professor', NULL, 'jose.costa@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(76, 'Julia Dos Anjos Paulino Martins Alfredo', 'Professor', NULL, 'julia.alfredo@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(77, 'Justino Manfwene Daniel', 'Professor', NULL, 'justino.daniel@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(78, 'Kiatuma Guelord Manuel', 'Professor', NULL, 'kiatuma.manuel@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(79, 'Konzo Pedro Mbiavanga', 'Professor', NULL, 'konzo.mbiavanga@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(80, 'Luzolo Ferreira Sebastião Paulo', 'Professor', NULL, 'luzolo.paulo@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(81, 'Manuel Gaspar Zua Gonga', 'Professor', NULL, 'manuel.gonga@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(82, 'Manzenza Isaac Lungambi', 'Professor', NULL, 'manzenza.lungambi@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(83, 'Marcos Júlio Dala Mandele', 'Professor', NULL, 'marcos.mandele@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(84, 'Maria Isabel Domingos Francisco Pedro', 'Professor', NULL, 'maria.pedro@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(85, 'Maria La Salleth Carvalho Trindade Filho', 'Professor', NULL, 'maria.filho@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(86, 'Mariam Maiomona Sanda', 'Professor', NULL, 'mariam.sanda@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(87, 'Mateus Pessela Sapuile', 'Professor', NULL, 'mateus.sapuile@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(88, 'Matias Jose Diogo', 'Professor', NULL, 'matias.diogo@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(89, 'Mbala Sumbula Muhongo', 'Professor', NULL, 'mbala.muhongo@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(90, 'Miguel Manuel Muana', 'Professor', NULL, 'miguel.muana@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(91, 'Miguel Pedro António Lumbombo', 'Professor', NULL, 'miguel.lumbombo@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(92, 'Miraldina João Sebastião', 'Professor', NULL, 'miraldina.sebastiao@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(93, 'Morais Satuda de Oliveira', 'Professor', NULL, 'morais.oliveira@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(94, 'Nazario Antonio Simão Gonçalves', 'Professor', NULL, 'nazario.gonçalves@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(95, 'Nelson Francisco Santana', 'Professor', NULL, 'nelson.santana@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(96, 'Osvaldo Domingos António', 'Professor', NULL, 'osvaldo.antonio@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(97, 'Rosa Bartolomeu Mateus', 'Professor', NULL, 'rosa.mateus@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(98, 'Sabino André Mateus', 'Professor', NULL, 'sabino.mateus@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(99, 'Salvador Canjamba Soares Francisco', 'Professor', NULL, 'salvador.francisco@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(100, 'Simao Gonçalves Mateus', 'Professor', NULL, 'simao.mateus@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(101, 'Suzana Quituxi Muanha', 'Professor', NULL, 'suzana.muanha@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(102, 'Tresor Graça Gonçalves José', 'Professor', NULL, 'tresor.jose@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(103, 'Umba da Conceição Pedro Diogo', 'Professor', NULL, 'umba.diogo@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(104, 'Vlademiro Cussulangana Macongo', 'Professor', NULL, 'vlademiro.macongo@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(105, 'Yolanda Miguel Cangondo', 'Professor', NULL, 'yolanda.cangondo@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL),
(106, 'Zeferina Manuel Luanda', 'Professor', NULL, 'zeferina.luanda@ipiz.ao', NULL, NULL, NULL, '2026-02-19 17:15:36', '2026-02-21 16:21:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

CREATE TABLE `turmas` (
  `id_turma` int(11) NOT NULL,
  `nome_turma` varchar(100) NOT NULL,
  `classe` varchar(50) DEFAULT NULL,
  `id_sala` int(11) DEFAULT NULL,
  `id_disciplina` int(11) DEFAULT NULL,
  `id_professor` int(11) DEFAULT NULL,
  `ano_letivo` year(4) DEFAULT NULL,
  `periodo` enum('Manhã','Tarde','Noite') DEFAULT 'Manhã',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sala_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`id_turma`, `nome_turma`, `classe`, `id_sala`, `id_disciplina`, `id_professor`, `ano_letivo`, `periodo`, `created_at`, `updated_at`, `sala_id`) VALUES
(1, 'PMT12AD', NULL, 1, 1, 1, '2026', 'Manhã', '2026-02-18 08:23:19', '2026-02-20 18:30:43', NULL),
(2, 'PMT11BD', NULL, 1, 1, 1, '2026', 'Tarde', '2026-02-18 12:38:11', '2026-02-19 09:48:16', NULL),
(3, 'PMT10CD', NULL, 2, 2, 52, '2026', 'Tarde', '2026-02-20 18:52:43', '2026-02-21 08:46:15', NULL),
(4, 'PMT10CD', NULL, 1, 2, 1, '2026', 'Manhã', '2026-02-20 20:05:42', '2026-02-20 20:05:42', NULL),
(5, 'PMT12AD', NULL, 1, 2, 52, '2026', 'Manhã', '2026-02-21 09:04:18', '2026-02-21 09:04:18', NULL),
(6, 'PMT12DD', NULL, 2, 2, 1, '2026', 'Tarde', '2026-02-21 09:05:48', '2026-02-21 09:05:48', NULL),
(7, 'PMT12DD', NULL, 2, 1, 52, '2026', 'Tarde', '2026-02-21 09:07:14', '2026-02-21 09:07:14', NULL),
(8, 'PMT12APL', NULL, 1, 1, 61, '2026', 'Noite', '2026-02-21 09:24:18', '2026-02-21 09:24:18', NULL),
(9, 'MM12AD', '12ª Classe', 1, 2, 52, '2026', 'Tarde', '2026-02-24 09:10:47', '2026-02-24 09:35:50', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma_disciplina`
--

CREATE TABLE `turma_disciplina` (
  `id` int(10) UNSIGNED NOT NULL,
  `turma_id` int(10) UNSIGNED NOT NULL,
  `disciplina_id` int(10) UNSIGNED NOT NULL,
  `professor_id` int(10) UNSIGNED NOT NULL,
  `ano_lectivo` varchar(9) NOT NULL DEFAULT '2025/2026',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Atribuição de professores a turmas por disciplina';

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(80) NOT NULL,
  `senha` varchar(255) NOT NULL COMMENT 'Hash bcrypt/password_hash',
  `perfil` enum('Administrador','Director','Secretario','Professor') NOT NULL DEFAULT 'Professor',
  `ativo` tinyint(1) DEFAULT 1,
  `ultimo_acesso` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_provincia` int(11) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `id_comuna` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `username`, `senha`, `perfil`, `ativo`, `ultimo_acesso`, `created_at`, `updated_at`, `id_provincia`, `id_municipio`, `id_comuna`, `foto`) VALUES
(1, 'Administrador', 'admin@escola.ao', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador', 1, '2026-04-29 04:46:04', '2026-02-18 13:30:25', '2026-04-29 04:46:04', NULL, NULL, NULL, 'default.png'),
(2, 'Sozinho Muanza', 'somuanza@hotmail.com', 'Somuanza', '$2y$10$8Au8OqD8C.2OW1mLZDZUBeClI7inD414Ku74/sDytPkzr./6GP6T.', 'Professor', 1, '2026-02-21 09:22:25', '2026-02-18 08:15:41', '2026-02-21 09:22:25', NULL, NULL, NULL, 'default.png'),
(3, 'Director da Escola', 'director@escola.ao', 'director', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Director', 1, '2026-02-20 04:56:05', '2026-02-19 09:17:09', '2026-02-20 04:56:05', NULL, NULL, NULL, 'default.png'),
(4, 'Cândido Galante Cucuila', 'candido@gmail.com', 'Galante', '$2y$10$w0JDuZYhKoip2e3HccRAKOGxUW88B9ScAM.q2.zg4uLr4bcCOhvma', 'Professor', 1, '2026-03-06 09:37:24', '2026-02-21 08:39:43', '2026-03-06 09:37:24', NULL, NULL, NULL, 'default.png'),
(5, 'Elisa Almeida Razão**', 'elisa.razao**@ipiz.ao', 'Elisa', '$2y$10$cjDI.TPjFiBU11EyP/cnheU3o6UUg40lIJamtZZcA8dX15c67d67W', 'Professor', 1, '2026-03-04 07:45:39', '2026-02-21 09:26:32', '2026-03-04 07:45:39', NULL, NULL, NULL, 'default.png');

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_mini_pauta`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vw_mini_pauta` (
`id_nota` int(11)
,`id_aluno` int(11)
,`id_turma` int(11)
,`id_disciplina` int(11)
,`id_professor` int(11)
,`trimestre` tinyint(1)
,`mac` decimal(4,1)
,`npp` decimal(4,1)
,`npt` decimal(4,1)
,`mt` decimal(4,2)
,`falta` tinyint(1)
,`observacao` varchar(255)
,`lancado_em` datetime
,`atualizado_em` datetime
,`nome_aluno` varchar(150)
,`genero` enum('Masculino','Feminino','Outro')
,`nome_turma` varchar(100)
,`nome_disciplina` varchar(150)
);

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_mini_pauta`
--
DROP TABLE IF EXISTS `vw_mini_pauta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_mini_pauta`  AS SELECT `n`.`id_nota` AS `id_nota`, `n`.`id_aluno` AS `id_aluno`, `n`.`id_turma` AS `id_turma`, `n`.`id_disciplina` AS `id_disciplina`, `n`.`id_professor` AS `id_professor`, `n`.`trimestre` AS `trimestre`, `n`.`mac` AS `mac`, `n`.`npp` AS `npp`, `n`.`npt` AS `npt`, `n`.`mt` AS `mt`, `n`.`falta` AS `falta`, `n`.`observacao` AS `observacao`, `n`.`lancado_em` AS `lancado_em`, `n`.`atualizado_em` AS `atualizado_em`, `a`.`nome` AS `nome_aluno`, `a`.`genero` AS `genero`, `t`.`nome_turma` AS `nome_turma`, `d`.`nome_disciplina` AS `nome_disciplina` FROM (((`notas` `n` left join `alunos` `a` on(`a`.`id_aluno` = `n`.`id_aluno`)) left join `turmas` `t` on(`t`.`id_turma` = `n`.`id_turma`)) left join `disciplinas` `d` on(`d`.`id_disciplina` = `n`.`id_disciplina`)) ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `fk_aluno_provincia` (`id_provincia`),
  ADD KEY `fk_aluno_municipio` (`id_municipio`),
  ADD KEY `fk_aluno_comuna` (`id_comuna`);

--
-- Índices para tabela `comunas`
--
ALTER TABLE `comunas`
  ADD PRIMARY KEY (`id_comuna`),
  ADD UNIQUE KEY `uk_codigo_comuna` (`codigo`),
  ADD KEY `idx_com_municipio` (`id_municipio`);

--
-- Índices para tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`id_disciplina`);

--
-- Índices para tabela `estoque_rupe`
--
ALTER TABLE `estoque_rupe`
  ADD PRIMARY KEY (`id_rupe`),
  ADD UNIQUE KEY `referencia` (`referencia`);

--
-- Índices para tabela `estoque_rupes`
--
ALTER TABLE `estoque_rupes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_rupe_unique` (`numero_rupe`);

--
-- Índices para tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id_matricula`),
  ADD UNIQUE KEY `aluno_turma_ano` (`id_aluno`,`id_turma`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices para tabela `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municipio`),
  ADD UNIQUE KEY `uk_codigo_municipio` (`codigo`),
  ADD KEY `idx_mun_provincia` (`id_provincia`);

--
-- Índices para tabela `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id_nota`),
  ADD UNIQUE KEY `uq_nota` (`id_aluno`,`id_turma`,`id_disciplina`,`trimestre`),
  ADD KEY `id_turma` (`id_turma`),
  ADD KEY `id_disciplina` (`id_disciplina`),
  ADD KEY `id_professor` (`id_professor`);

--
-- Índices para tabela `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id_provincia`),
  ADD UNIQUE KEY `uk_codigo_provincia` (`codigo`);

--
-- Índices para tabela `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id_sala`);

--
-- Índices para tabela `trabalhadores`
--
ALTER TABLE `trabalhadores`
  ADD PRIMARY KEY (`id_trabalhador`),
  ADD KEY `fk_trab_provincia` (`id_provincia`),
  ADD KEY `fk_trab_municipio` (`id_municipio`),
  ADD KEY `fk_trab_comuna` (`id_comuna`);

--
-- Índices para tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id_turma`),
  ADD KEY `id_sala` (`id_sala`),
  ADD KEY `id_disciplina` (`id_disciplina`),
  ADD KEY `id_professor` (`id_professor`);

--
-- Índices para tabela `turma_disciplina`
--
ALTER TABLE `turma_disciplina`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_turma_disc` (`turma_id`,`disciplina_id`,`ano_lectivo`),
  ADD KEY `idx_professor` (`professor_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_user_provincia` (`id_provincia`),
  ADD KEY `fk_user_municipio` (`id_municipio`),
  ADD KEY `fk_user_comuna` (`id_comuna`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `comunas`
--
ALTER TABLE `comunas`
  MODIFY `id_comuna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=537;

--
-- AUTO_INCREMENT de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `id_disciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estoque_rupe`
--
ALTER TABLE `estoque_rupe`
  MODIFY `id_rupe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estoque_rupes`
--
ALTER TABLE `estoque_rupes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;

--
-- AUTO_INCREMENT de tabela `notas`
--
ALTER TABLE `notas`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `salas`
--
ALTER TABLE `salas`
  MODIFY `id_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `trabalhadores`
--
ALTER TABLE `trabalhadores`
  MODIFY `id_trabalhador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `id_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `turma_disciplina`
--
ALTER TABLE `turma_disciplina`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `fk_aluno_comuna` FOREIGN KEY (`id_comuna`) REFERENCES `comunas` (`id_comuna`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_aluno_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_aluno_provincia` FOREIGN KEY (`id_provincia`) REFERENCES `provincias` (`id_provincia`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `comunas`
--
ALTER TABLE `comunas`
  ADD CONSTRAINT `fk_com_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `alunos` (`id_aluno`) ON DELETE CASCADE,
  ADD CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id_turma`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `fk_mun_provincia` FOREIGN KEY (`id_provincia`) REFERENCES `provincias` (`id_provincia`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `alunos` (`id_aluno`) ON DELETE CASCADE,
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id_turma`) ON DELETE CASCADE,
  ADD CONSTRAINT `notas_ibfk_3` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplinas` (`id_disciplina`) ON DELETE CASCADE,
  ADD CONSTRAINT `notas_ibfk_4` FOREIGN KEY (`id_professor`) REFERENCES `trabalhadores` (`id_trabalhador`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `trabalhadores`
--
ALTER TABLE `trabalhadores`
  ADD CONSTRAINT `fk_trab_comuna` FOREIGN KEY (`id_comuna`) REFERENCES `comunas` (`id_comuna`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_trab_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_trab_provincia` FOREIGN KEY (`id_provincia`) REFERENCES `provincias` (`id_provincia`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `turmas`
--
ALTER TABLE `turmas`
  ADD CONSTRAINT `turmas_ibfk_1` FOREIGN KEY (`id_sala`) REFERENCES `salas` (`id_sala`) ON DELETE SET NULL,
  ADD CONSTRAINT `turmas_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplinas` (`id_disciplina`) ON DELETE SET NULL,
  ADD CONSTRAINT `turmas_ibfk_3` FOREIGN KEY (`id_professor`) REFERENCES `trabalhadores` (`id_trabalhador`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_user_comuna` FOREIGN KEY (`id_comuna`) REFERENCES `comunas` (`id_comuna`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_user_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_user_provincia` FOREIGN KEY (`id_provincia`) REFERENCES `provincias` (`id_provincia`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
