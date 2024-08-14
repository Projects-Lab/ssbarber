-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-08-2024 a las 17:53:07
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ssbarber`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `nombre`) VALUES
(3, 'BARBERO'),
(4, 'ESTILISTA'),
(15, 'PELUQUERO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int NOT NULL,
  `id_cliente` int NOT NULL,
  `id_empleado` int NOT NULL,
  `id_servicio` int NOT NULL,
  `fecha_asignada` date DEFAULT NULL,
  `hora_asignada` time DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `id_cliente`, `id_empleado`, `id_servicio`, `fecha_asignada`, `hora_asignada`, `estado`) VALUES
(3, 4, 37, 1, '2024-03-01', '28:12:50', 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int NOT NULL,
  `tipo_documento_id` int NOT NULL,
  `numero_identificacion` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `primer_nombre` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `segundo_nombre` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `primer_apellido` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `segundo_apellido` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `sexo` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `edad` int DEFAULT NULL,
  `telefono_1` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `direccion_residencia` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `id_municipio` int UNSIGNED DEFAULT NULL,
  `id_departamento` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `tipo_documento_id`, `numero_identificacion`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `sexo`, `fecha_nacimiento`, `edad`, `telefono_1`, `direccion_residencia`, `id_municipio`, `id_departamento`) VALUES
(4, 2, '1067909090', 'JACKIE', 'JAVIER', 'CHAN', 'URIBE', 'M', '1996-10-09', 27, '3131311313', 'EL PLATANAL', 429, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int UNSIGNED NOT NULL,
  `departamento` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `departamento`) VALUES
(5, 'ANTIOQUIA'),
(8, 'ATLÁNTICO'),
(11, 'BOGOTÁ, D.C.'),
(13, 'BOLÍVAR'),
(15, 'BOYACÁ'),
(17, 'CALDAS'),
(18, 'CAQUETÁ'),
(19, 'CAUCA'),
(20, 'CESAR'),
(23, 'CORDOBA'),
(25, 'CUNDINAMARCA'),
(27, 'CHOCÓ'),
(41, 'HUILA'),
(44, 'LA GUAJIRA'),
(47, 'MAGDALENA'),
(50, 'META'),
(52, 'NARIÑO'),
(54, 'NORTE DE SANTANDER'),
(63, 'QUINDIO'),
(66, 'RISARALDA'),
(68, 'SANTANDER'),
(70, 'SUCRE'),
(73, 'TOLIMA'),
(76, 'VALLE DEL CAUCA'),
(81, 'ARAUCA'),
(85, 'CASANARE'),
(86, 'PUTUMAYO'),
(88, 'ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA'),
(91, 'AMAZONAS'),
(94, 'GUAINÍA'),
(95, 'GUAVIARE'),
(97, 'VAUPÉS'),
(99, 'VICHADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `cargo_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `nombre`, `cargo_id`) VALUES
(37, 'EMPLEADO 1', 4),
(40, 'EMPLEADO 2', 15),
(41, 'EMPLEADO 3', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cargo_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id_municipio` int UNSIGNED NOT NULL,
  `municipio` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `codigodane` int UNSIGNED NOT NULL,
  `departamento_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id_municipio`, `municipio`, `codigodane`, `departamento_id`) VALUES
(1, 'MEDELLÍN', 1, 5),
(2, 'ABEJORRAL', 2, 5),
(3, 'ABRIAQUÍ', 4, 5),
(4, 'ALEJANDRÍA', 21, 5),
(5, 'AMAGÁ', 30, 5),
(6, 'AMALFI', 31, 5),
(7, 'ANDES', 34, 5),
(8, 'ANGELÓPOLIS', 36, 5),
(9, 'ANGOSTURA', 38, 5),
(10, 'ANORÍ', 40, 5),
(11, 'SANTA FÉ DE ANTIOQUIA', 42, 5),
(12, 'ANZÁ', 44, 5),
(13, 'APARTADÓ', 45, 5),
(14, 'ARBOLETES', 51, 5),
(15, 'ARGELIA', 55, 5),
(16, 'ARMENIA', 59, 5),
(17, 'BARBOSA', 79, 5),
(18, 'BELMIRA', 86, 5),
(19, 'BELLO', 88, 5),
(20, 'BETANIA', 91, 5),
(21, 'BETULIA', 93, 5),
(22, 'CIUDAD BOLÍVAR', 101, 5),
(23, 'BRICEÑO', 107, 5),
(24, 'BURITICÁ', 113, 5),
(25, 'CÁCERES', 120, 5),
(26, 'CAICEDO', 125, 5),
(27, 'CALDAS', 129, 5),
(28, 'CAMPAMENTO', 134, 5),
(29, 'CAÑASGORDAS', 138, 5),
(30, 'CARACOLÍ', 142, 5),
(31, 'CARAMANTA', 145, 5),
(32, 'CAREPA', 147, 5),
(33, 'EL CARMEN DE VIBORAL', 148, 5),
(34, 'CAROLINA', 150, 5),
(35, 'CAUCASIA', 154, 5),
(36, 'CHIGORODÓ', 172, 5),
(37, 'CISNEROS', 190, 5),
(38, 'COCORNÁ', 197, 5),
(39, 'CONCEPCIÓN', 206, 5),
(40, 'CONCORDIA', 209, 5),
(41, 'COPACABANA', 212, 5),
(42, 'DABEIBA', 234, 5),
(43, 'DONMATÍAS', 237, 5),
(44, 'EBÉJICO', 240, 5),
(45, 'EL BAGRE', 250, 5),
(46, 'ENTRERRÍOS', 264, 5),
(47, 'ENVIGADO', 266, 5),
(48, 'FREDONIA', 282, 5),
(49, 'FRONTINO', 284, 5),
(50, 'GIRALDO', 306, 5),
(51, 'GIRARDOTA', 308, 5),
(52, 'GÓMEZ PLATA', 310, 5),
(53, 'GRANADA', 313, 5),
(54, 'GUADALUPE', 315, 5),
(55, 'GUARNE', 318, 5),
(56, 'GUATAPÉ', 321, 5),
(57, 'HELICONIA', 347, 5),
(58, 'HISPANIA', 353, 5),
(59, 'ITAGÜÍ', 360, 5),
(60, 'ITUANGO', 361, 5),
(61, 'JARDÍN', 364, 5),
(62, 'JERICÓ', 368, 5),
(63, 'LA CEJA', 376, 5),
(64, 'LA ESTRELLA', 380, 5),
(65, 'LA PINTADA', 390, 5),
(66, 'LA UNIÓN', 400, 5),
(67, 'LIBORINA', 411, 5),
(68, 'MACEO', 425, 5),
(69, 'MARINILLA', 440, 5),
(70, 'MONTEBELLO', 467, 5),
(71, 'MURINDÓ', 475, 5),
(72, 'MUTATÁ', 480, 5),
(73, 'NARIÑO', 483, 5),
(74, 'NECOCLÍ', 490, 5),
(75, 'NECHÍ', 495, 5),
(76, 'OLAYA', 501, 5),
(77, 'PEÑOL', 541, 5),
(78, 'PEQUE', 543, 5),
(79, 'PUEBLORRICO', 576, 5),
(80, 'PUERTO BERRÍO', 579, 5),
(81, 'PUERTO NARE', 585, 5),
(82, 'PUERTO TRIUNFO', 591, 5),
(83, 'REMEDIOS', 604, 5),
(84, 'RETIRO', 607, 5),
(85, 'RIONEGRO', 615, 5),
(86, 'SABANALARGA', 628, 5),
(87, 'SABANETA', 631, 5),
(88, 'SALGAR', 642, 5),
(89, 'SAN ANDRÉS DE CUERQUÍA', 647, 5),
(90, 'SAN CARLOS', 649, 5),
(91, 'SAN FRANCISCO', 652, 5),
(92, 'SAN JERÓNIMO', 656, 5),
(93, 'SAN JOSÉ DE LA MONTAÑA', 658, 5),
(94, 'SAN JUAN DE URABÁ', 659, 5),
(95, 'SAN LUIS', 660, 5),
(96, 'SAN PEDRO DE LOS MILAGROS', 664, 5),
(97, 'SAN PEDRO DE URABÁ', 665, 5),
(98, 'SAN RAFAEL', 667, 5),
(99, 'SAN ROQUE', 670, 5),
(100, 'SAN VICENTE FERRER', 674, 5),
(101, 'SANTA BÁRBARA', 679, 5),
(102, 'SANTA ROSA DE OSOS', 686, 5),
(103, 'SANTO DOMINGO', 690, 5),
(104, 'EL SANTUARIO', 697, 5),
(105, 'SEGOVIA', 736, 5),
(106, 'SONSÓN', 756, 5),
(107, 'SOPETRÁN', 761, 5),
(108, 'TÁMESIS', 789, 5),
(109, 'TARAZÁ', 790, 5),
(110, 'TARSO', 792, 5),
(111, 'TITIRIBÍ', 809, 5),
(112, 'TOLEDO', 819, 5),
(113, 'TURBO', 837, 5),
(114, 'URAMITA', 842, 5),
(115, 'URRAO', 847, 5),
(116, 'VALDIVIA', 854, 5),
(117, 'VALPARAÍSO', 856, 5),
(118, 'VEGACHÍ', 858, 5),
(119, 'VENECIA', 861, 5),
(120, 'VIGÍA DEL FUERTE', 873, 5),
(121, 'YALÍ', 885, 5),
(122, 'YARUMAL', 887, 5),
(123, 'YOLOMBÓ', 890, 5),
(124, 'YONDÓ', 893, 5),
(125, 'ZARAGOZA', 895, 5),
(126, 'BARRANQUILLA', 1, 8),
(127, 'BARANOA', 78, 8),
(128, 'CAMPO DE LA CRUZ', 137, 8),
(129, 'CANDELARIA', 141, 8),
(130, 'GALAPA', 296, 8),
(131, 'JUAN DE ACOSTA', 372, 8),
(132, 'LURUACO', 421, 8),
(133, 'MALAMBO', 433, 8),
(134, 'MANATÍ', 436, 8),
(135, 'PALMAR DE VARELA', 520, 8),
(136, 'PIOJÓ', 549, 8),
(137, 'POLONUEVO', 558, 8),
(138, 'PONEDERA', 560, 8),
(139, 'PUERTO COLOMBIA', 573, 8),
(140, 'REPELÓN', 606, 8),
(141, 'SABANAGRANDE', 634, 8),
(142, 'SABANALARGA', 638, 8),
(143, 'SANTA LUCÍA', 675, 8),
(144, 'SANTO TOMÁS', 685, 8),
(145, 'SOLEDAD', 758, 8),
(146, 'SUAN', 770, 8),
(147, 'TUBARÁ', 832, 8),
(148, 'USIACURÍ', 849, 8),
(149, 'BOGOTA DC', 1, 11),
(150, 'CARTAGENA DE INDIAS', 1, 13),
(151, 'ACHÍ', 6, 13),
(152, 'ALTOS DEL ROSARIO', 30, 13),
(153, 'ARENAL', 42, 13),
(154, 'ARJONA', 52, 13),
(155, 'ARROYOHONDO', 62, 13),
(156, 'BARRANCO DE LOBA', 74, 13),
(157, 'CALAMAR', 140, 13),
(158, 'CANTAGALLO', 160, 13),
(159, 'CICUCO', 188, 13),
(160, 'CÓRDOBA', 212, 13),
(161, 'CLEMENCIA', 222, 13),
(162, 'EL CARMEN DE BOLÍVAR', 244, 13),
(163, 'EL GUAMO', 248, 13),
(164, 'EL PEÑÓN', 268, 13),
(165, 'HATILLO DE LOBA', 300, 13),
(166, 'MAGANGUÉ', 430, 13),
(167, 'MAHATES', 433, 13),
(168, 'MARGARITA', 440, 13),
(169, 'MARÍA LA BAJA', 442, 13),
(170, 'MONTECRISTO', 458, 13),
(171, 'MOMPÓS', 468, 13),
(172, 'MORALES', 473, 13),
(173, 'NOROSÍ', 490, 13),
(174, 'PINILLOS', 549, 13),
(175, 'REGIDOR', 580, 13),
(176, 'RÍO VIEJO', 600, 13),
(177, 'SAN CRISTÓBAL', 620, 13),
(178, 'SAN ESTANISLAO', 647, 13),
(179, 'SAN FERNANDO', 650, 13),
(180, 'SAN JACINTO', 654, 13),
(181, 'SAN JACINTO DEL CAUCA', 655, 13),
(182, 'SAN JUAN NEPOMUCENO', 657, 13),
(183, 'SAN MARTÍN DE LOBA', 667, 13),
(184, 'SAN PABLO', 670, 13),
(185, 'SANTA CATALINA', 673, 13),
(186, 'SANTA ROSA', 683, 13),
(187, 'SANTA ROSA DEL SUR', 688, 13),
(188, 'SIMITÍ', 744, 13),
(189, 'SOPLAVIENTO', 760, 13),
(190, 'TALAIGUA NUEVO', 780, 13),
(191, 'TIQUISIO', 810, 13),
(192, 'TURBACO', 836, 13),
(193, 'TURBANÁ', 838, 13),
(194, 'VILLANUEVA', 873, 13),
(195, 'ZAMBRANO', 894, 13),
(196, 'TUNJA', 1, 15),
(197, 'ALMEIDA', 22, 15),
(198, 'AQUITANIA', 47, 15),
(199, 'ARCABUCO', 51, 15),
(200, 'BELÉN', 87, 15),
(201, 'BERBEO', 90, 15),
(202, 'BETÉITIVA', 92, 15),
(203, 'BOAVITA', 97, 15),
(204, 'BOYACÁ', 104, 15),
(205, 'BRICEÑO', 106, 15),
(206, 'BUENAVISTA', 109, 15),
(207, 'BUSBANZÁ', 114, 15),
(208, 'CALDAS', 131, 15),
(209, 'CAMPOHERMOSO', 135, 15),
(210, 'CERINZA', 162, 15),
(211, 'CHINAVITA', 172, 15),
(212, 'CHIQUINQUIRÁ', 176, 15),
(213, 'CHISCAS', 180, 15),
(214, 'CHITA', 183, 15),
(215, 'CHITARAQUE', 185, 15),
(216, 'CHIVATÁ', 187, 15),
(217, 'CIÉNEGA', 189, 15),
(218, 'CÓMBITA', 204, 15),
(219, 'COPER', 212, 15),
(220, 'CORRALES', 215, 15),
(221, 'COVARACHÍA', 218, 15),
(222, 'CUBARÁ', 223, 15),
(223, 'CUCAITA', 224, 15),
(224, 'CUÍTIVA', 226, 15),
(225, 'CHÍQUIZA', 232, 15),
(226, 'CHIVOR', 236, 15),
(227, 'DUITAMA', 238, 15),
(228, 'EL COCUY', 244, 15),
(229, 'EL ESPINO', 248, 15),
(230, 'FIRAVITOBA', 272, 15),
(231, 'FLORESTA', 276, 15),
(232, 'GACHANTIVÁ', 293, 15),
(233, 'GÁMEZA', 296, 15),
(234, 'GARAGOA', 299, 15),
(235, 'GUACAMAYAS', 317, 15),
(236, 'GUATEQUE', 322, 15),
(237, 'GUAYATÁ', 325, 15),
(238, 'GÜICÁN', 332, 15),
(239, 'IZA', 362, 15),
(240, 'JENESANO', 367, 15),
(241, 'JERICÓ', 368, 15),
(242, 'LABRANZAGRANDE', 377, 15),
(243, 'LA CAPILLA', 380, 15),
(244, 'LA VICTORIA', 401, 15),
(245, 'LA UVITA', 403, 15),
(246, 'VILLA DE LEYVA', 407, 15),
(247, 'MACANAL', 425, 15),
(248, 'MARIPÍ', 442, 15),
(249, 'MIRAFLORES', 455, 15),
(250, 'MONGUA', 464, 15),
(251, 'MONGUÍ', 466, 15),
(252, 'MONIQUIRÁ', 469, 15),
(253, 'MOTAVITA', 476, 15),
(254, 'MUZO', 480, 15),
(255, 'NOBSA', 491, 15),
(256, 'NUEVO COLÓN', 494, 15),
(257, 'OICATÁ', 500, 15),
(258, 'OTANCHE', 507, 15),
(259, 'PACHAVITA', 511, 15),
(260, 'PÁEZ', 514, 15),
(261, 'PAIPA', 516, 15),
(262, 'PAJARITO', 518, 15),
(263, 'PANQUEBA', 522, 15),
(264, 'PAUNA', 531, 15),
(265, 'PAYA', 533, 15),
(266, 'PAZ DE RÍO', 537, 15),
(267, 'PESCA', 542, 15),
(268, 'PISBA', 550, 15),
(269, 'PUERTO BOYACÁ', 572, 15),
(270, 'QUÍPAMA', 580, 15),
(271, 'RAMIRIQUÍ', 599, 15),
(272, 'RÁQUIRA', 600, 15),
(273, 'RONDÓN', 621, 15),
(274, 'SABOYÁ', 632, 15),
(275, 'SÁCHICA', 638, 15),
(276, 'SAMACÁ', 646, 15),
(277, 'SAN EDUARDO', 660, 15),
(278, 'SAN JOSÉ DE PARE', 664, 15),
(279, 'SAN LUIS DE GACENO', 667, 15),
(280, 'SAN MATEO', 673, 15),
(281, 'SAN MIGUEL DE SEMA', 676, 15),
(282, 'SAN PABLO DE BORBUR', 681, 15),
(283, 'SANTANA', 686, 15),
(284, 'SANTA MARÍA', 690, 15),
(285, 'SANTA ROSA DE VITERBO', 693, 15),
(286, 'SANTA SOFÍA', 696, 15),
(287, 'SATIVANORTE', 720, 15),
(288, 'SATIVASUR', 723, 15),
(289, 'SIACHOQUE', 740, 15),
(290, 'SOATÁ', 753, 15),
(291, 'SOCOTÁ', 755, 15),
(292, 'SOCHA', 757, 15),
(293, 'SOGAMOSO', 759, 15),
(294, 'SOMONDOCO', 761, 15),
(295, 'SORA', 762, 15),
(296, 'SOTAQUIRÁ', 763, 15),
(297, 'SORACÁ', 764, 15),
(298, 'SUSACÓN', 774, 15),
(299, 'SUTAMARCHÁN', 776, 15),
(300, 'SUTATENZA', 778, 15),
(301, 'TASCO', 790, 15),
(302, 'TENZA', 798, 15),
(303, 'TIBANÁ', 804, 15),
(304, 'TIBASOSA', 806, 15),
(305, 'TINJACÁ', 808, 15),
(306, 'TIPACOQUE', 810, 15),
(307, 'TOCA', 814, 15),
(308, 'TOGÜÍ', 816, 15),
(309, 'TÓPAGA', 820, 15),
(310, 'TOTA', 822, 15),
(311, 'TUNUNGUÁ', 832, 15),
(312, 'TURMEQUÉ', 835, 15),
(313, 'TUTA', 837, 15),
(314, 'TUTAZÁ', 839, 15),
(315, 'ÚMBITA', 842, 15),
(316, 'VENTAQUEMADA', 861, 15),
(317, 'VIRACACHÁ', 879, 15),
(318, 'ZETAQUIRA', 897, 15),
(319, 'MANIZALES', 1, 17),
(320, 'AGUADAS', 13, 17),
(321, 'ANSERMA', 42, 17),
(322, 'ARANZAZU', 50, 17),
(323, 'BELALCÁZAR', 88, 17),
(324, 'CHINCHINÁ', 174, 17),
(325, 'FILADELFIA', 272, 17),
(326, 'LA DORADA', 380, 17),
(327, 'LA MERCED', 388, 17),
(328, 'MANZANARES', 433, 17),
(329, 'MARMATO', 442, 17),
(330, 'MARQUETALIA', 444, 17),
(331, 'MARULANDA', 446, 17),
(332, 'NEIRA', 486, 17),
(333, 'NORCASIA', 495, 17),
(334, 'PÁCORA', 513, 17),
(335, 'PALESTINA', 524, 17),
(336, 'PENSILVANIA', 541, 17),
(337, 'RIOSUCIO', 614, 17),
(338, 'RISARALDA', 616, 17),
(339, 'SALAMINA', 653, 17),
(340, 'SAMANÁ', 662, 17),
(341, 'SAN JOSÉ', 665, 17),
(342, 'SUPÍA', 777, 17),
(343, 'VICTORIA', 867, 17),
(344, 'VILLAMARÍA', 873, 17),
(345, 'VITERBO', 877, 17),
(346, 'FLORENCIA', 1, 18),
(347, 'ALBANIA', 29, 18),
(348, 'BELÉN DE LOS ANDAQUÍES', 94, 18),
(349, 'CARTAGENA DEL CHAIRÁ', 150, 18),
(350, 'CURILLO', 205, 18),
(351, 'EL DONCELLO', 247, 18),
(352, 'EL PAUJÍL', 256, 18),
(353, 'LA MONTAÑITA', 410, 18),
(354, 'MILÁN', 460, 18),
(355, 'MORELIA', 479, 18),
(356, 'PUERTO RICO', 592, 18),
(357, 'SAN JOSÉ DEL FRAGUA', 610, 18),
(358, 'SAN VICENTE DEL CAGUÁN', 753, 18),
(359, 'SOLANO', 756, 18),
(360, 'SOLITA', 785, 18),
(361, 'VALPARAÍSO', 860, 18),
(362, 'POPAYÁN', 1, 19),
(363, 'ALMAGUER', 22, 19),
(364, 'ARGELIA', 50, 19),
(365, 'BALBOA', 75, 19),
(366, 'BOLÍVAR', 100, 19),
(367, 'BUENOS AIRES', 110, 19),
(368, 'CAJIBÍO', 130, 19),
(369, 'CALDONO', 137, 19),
(370, 'CALOTO', 142, 19),
(371, 'CORINTO', 212, 19),
(372, 'EL TAMBO', 256, 19),
(373, 'FLORENCIA', 290, 19),
(374, 'GUACHENÉ', 300, 19),
(375, 'GUAPÍ', 318, 19),
(376, 'INZÁ', 355, 19),
(377, 'JAMBALÓ', 364, 19),
(378, 'LA SIERRA', 392, 19),
(379, 'LA VEGA', 397, 19),
(380, 'LÓPEZ DE MICAY', 418, 19),
(381, 'MERCADERES', 450, 19),
(382, 'MIRANDA', 455, 19),
(383, 'MORALES', 473, 19),
(384, 'PADILLA', 513, 19),
(385, 'PÁEZ', 517, 19),
(386, 'PATÍA', 532, 19),
(387, 'PIAMONTE', 533, 19),
(388, 'PIENDAMÓ', 548, 19),
(389, 'PUERTO TEJADA', 573, 19),
(390, 'PURACÉ', 585, 19),
(391, 'ROSAS', 622, 19),
(392, 'SAN SEBASTIÁN', 693, 19),
(393, 'SANTANDER DE QUILICHAO', 698, 19),
(394, 'SANTA ROSA', 701, 19),
(395, 'SILVIA', 743, 19),
(396, 'SOTARA', 760, 19),
(397, 'SUÁREZ', 780, 19),
(398, 'SUCRE', 785, 19),
(399, 'TIMBÍO', 807, 19),
(400, 'TIMBIQUÍ', 809, 19),
(401, 'TORIBÍO', 821, 19),
(402, 'TOTORÓ', 824, 19),
(403, 'VILLA RICA', 845, 19),
(404, 'VALLEDUPAR', 1, 20),
(405, 'AGUACHICA', 11, 20),
(406, 'AGUSTÍN CODAZZI', 13, 20),
(407, 'ASTREA', 32, 20),
(408, 'BECERRIL', 45, 20),
(409, 'BOSCONIA', 60, 20),
(410, 'CHIMICHAGUA', 175, 20),
(411, 'CHIRIGUANÁ', 178, 20),
(412, 'CURUMANÍ', 228, 20),
(413, 'EL COPEY', 238, 20),
(414, 'EL PASO', 250, 20),
(415, 'GAMARRA', 295, 20),
(416, 'GONZÁLEZ', 310, 20),
(417, 'LA GLORIA', 383, 20),
(418, 'LA JAGUA DE IBIRICO', 400, 20),
(419, 'MANAURE BALCÓN DEL CESAR', 443, 20),
(420, 'PAILITAS', 517, 20),
(421, 'PELAYA', 550, 20),
(422, 'PUEBLO BELLO', 570, 20),
(423, 'RÍO DE ORO', 614, 20),
(424, 'LA PAZ', 621, 20),
(425, 'SAN ALBERTO', 710, 20),
(426, 'SAN DIEGO', 750, 20),
(427, 'SAN MARTÍN', 770, 20),
(428, 'TAMALAMEQUE', 787, 20),
(429, 'MONTERÍA', 1, 23),
(430, 'AYAPEL', 68, 23),
(431, 'BUENAVISTA', 79, 23),
(432, 'CANALETE', 90, 23),
(433, 'CERETÉ', 162, 23),
(434, 'CHIMÁ', 168, 23),
(435, 'CHINÚ', 182, 23),
(436, 'CIÉNAGA DE ORO', 189, 23),
(437, 'COTORRA', 300, 23),
(438, 'LA APARTADA', 350, 23),
(439, 'LORICA', 417, 23),
(440, 'LOS CÓRDOBAS', 419, 23),
(441, 'MOMIL', 464, 23),
(442, 'MONTELÍBANO', 466, 23),
(443, 'MOÑITOS', 500, 23),
(444, 'PLANETA RICA', 555, 23),
(445, 'PUEBLO NUEVO', 570, 23),
(446, 'PUERTO ESCONDIDO', 574, 23),
(447, 'PUERTO LIBERTADOR', 580, 23),
(448, 'PURÍSIMA DE LA CONCEPCIÓN', 586, 23),
(449, 'SAHAGÚN', 660, 23),
(450, 'SAN ANDRÉS DE SOTAVENTO', 670, 23),
(451, 'SAN ANTERO', 672, 23),
(452, 'SAN BERNARDO DEL VIENTO', 675, 23),
(453, 'SAN CARLOS', 678, 23),
(454, 'SAN JOSÉ DE URÉ', 682, 23),
(455, 'SAN PELAYO', 686, 23),
(456, 'TIERRALTA', 807, 23),
(457, 'TUCHÍN', 815, 23),
(458, 'VALENCIA', 855, 23),
(459, 'AGUA DE DIOS', 1, 25),
(460, 'ALBÁN', 19, 25),
(461, 'ANAPOIMA', 35, 25),
(462, 'ANOLAIMA', 40, 25),
(463, 'ARBELÁEZ', 53, 25),
(464, 'BELTRÁN', 86, 25),
(465, 'BITUIMA', 95, 25),
(466, 'BOJACÁ', 99, 25),
(467, 'CABRERA', 120, 25),
(468, 'CACHIPAY', 123, 25),
(469, 'CAJICÁ', 126, 25),
(470, 'CAPARRAPÍ', 148, 25),
(471, 'CÁQUEZA', 151, 25),
(472, 'CARMEN DE CARUPA', 154, 25),
(473, 'CHAGUANÍ', 168, 25),
(474, 'CHÍA', 175, 25),
(475, 'CHIPAQUE', 178, 25),
(476, 'CHOACHÍ', 181, 25),
(477, 'CHOCONTÁ', 183, 25),
(478, 'COGUA', 200, 25),
(479, 'COTA', 214, 25),
(480, 'CUCUNUBÁ', 224, 25),
(481, 'EL COLEGIO', 245, 25),
(482, 'EL PEÑÓN', 258, 25),
(483, 'EL ROSAL', 260, 25),
(484, 'FACATATIVÁ', 269, 25),
(485, 'FÓMEQUE', 279, 25),
(486, 'FOSCA', 281, 25),
(487, 'FUNZA', 286, 25),
(488, 'FÚQUENE', 288, 25),
(489, 'FUSAGASUGÁ', 290, 25),
(490, 'GACHALÁ', 293, 25),
(491, 'GACHANCIPÁ', 295, 25),
(492, 'GACHETÁ', 297, 25),
(493, 'GAMA', 299, 25),
(494, 'GIRARDOT', 307, 25),
(495, 'GRANADA', 312, 25),
(496, 'GUACHETÁ', 317, 25),
(497, 'GUADUAS', 320, 25),
(498, 'GUASCA', 322, 25),
(499, 'GUATAQUÍ', 324, 25),
(500, 'GUATAVITA', 326, 25),
(501, 'GUAYABAL DE SÍQUIMA', 328, 25),
(502, 'GUAYABETAL', 335, 25),
(503, 'GUTIÉRREZ', 339, 25),
(504, 'JERUSALÉN', 368, 25),
(505, 'JUNÍN', 372, 25),
(506, 'LA CALERA', 377, 25),
(507, 'LA MESA', 386, 25),
(508, 'LA PALMA', 394, 25),
(509, 'LA PEÑA', 398, 25),
(510, 'LA VEGA', 402, 25),
(511, 'LENGUAZAQUE', 407, 25),
(512, 'MACHETÁ', 426, 25),
(513, 'MADRID', 430, 25),
(514, 'MANTA', 436, 25),
(515, 'MEDINA', 438, 25),
(516, 'MOSQUERA', 473, 25),
(517, 'NARIÑO', 483, 25),
(518, 'NEMOCÓN', 486, 25),
(519, 'NILO', 488, 25),
(520, 'NIMAIMA', 489, 25),
(521, 'NOCAIMA', 491, 25),
(522, 'VENECIA', 506, 25),
(523, 'PACHO', 513, 25),
(524, 'PAIME', 518, 25),
(525, 'PANDI', 524, 25),
(526, 'PARATEBUENO', 530, 25),
(527, 'PASCA', 535, 25),
(528, 'PUERTO SALGAR', 572, 25),
(529, 'PULÍ', 580, 25),
(530, 'QUEBRADANEGRA', 592, 25),
(531, 'QUETAME', 594, 25),
(532, 'QUIPILE', 596, 25),
(533, 'APULO', 599, 25),
(534, 'RICAURTE', 612, 25),
(535, 'SAN ANTONIO DEL TEQUENDAMA', 645, 25),
(536, 'SAN BERNARDO', 649, 25),
(537, 'SAN CAYETANO', 653, 25),
(538, 'SAN FRANCISCO', 658, 25),
(539, 'SAN JUAN DE RIOSECO', 662, 25),
(540, 'SASAIMA', 718, 25),
(541, 'SESQUILÉ', 736, 25),
(542, 'SIBATÉ', 740, 25),
(543, 'SILVANIA', 743, 25),
(544, 'SIMIJACA', 745, 25),
(545, 'SOACHA', 754, 25),
(546, 'SOPÓ', 758, 25),
(547, 'SUBACHOQUE', 769, 25),
(548, 'SUESCA', 772, 25),
(549, 'SUPATÁ', 777, 25),
(550, 'SUSA', 779, 25),
(551, 'SUTATAUSA', 781, 25),
(552, 'TABIO', 785, 25),
(553, 'TAUSA', 793, 25),
(554, 'TENA', 797, 25),
(555, 'TENJO', 799, 25),
(556, 'TIBACUY', 805, 25),
(557, 'TIBIRITA', 807, 25),
(558, 'TOCAIMA', 815, 25),
(559, 'TOCANCIPÁ', 817, 25),
(560, 'TOPAIPÍ', 823, 25),
(561, 'UBALÁ', 839, 25),
(562, 'UBAQUE', 841, 25),
(563, 'VILLA DE SAN DIEGO DE UBATÉ', 843, 25),
(564, 'UNE', 845, 25),
(565, 'ÚTICA', 851, 25),
(566, 'VERGARA', 862, 25),
(567, 'VIANÍ', 867, 25),
(568, 'VILLAGÓMEZ', 871, 25),
(569, 'VILLAPINZÓN', 873, 25),
(570, 'VILLETA', 875, 25),
(571, 'VIOTÁ', 878, 25),
(572, 'YACOPÍ', 885, 25),
(573, 'ZIPACÓN', 898, 25),
(574, 'ZIPAQUIRÁ', 899, 25),
(575, 'QUIBDÓ', 1, 27),
(576, 'ACANDÍ', 6, 27),
(577, 'ALTO BAUDÓ', 25, 27),
(578, 'ATRATO', 50, 27),
(579, 'BAGADÓ', 73, 27),
(580, 'BAHÍA SOLANO', 75, 27),
(581, 'BAJO BAUDÓ', 77, 27),
(582, 'BOJAYÁ', 99, 27),
(583, 'EL CANTÓN DEL SAN PABLO', 135, 27),
(584, 'CARMEN DEL DARIÉN', 150, 27),
(585, 'CÉRTEGUI', 160, 27),
(586, 'CONDOTO', 205, 27),
(587, 'EL CARMEN DE ATRATO', 245, 27),
(588, 'EL LITORAL DEL SAN JUAN', 250, 27),
(589, 'ISTMINA', 361, 27),
(590, 'JURADÓ', 372, 27),
(591, 'LLORÓ', 413, 27),
(592, 'MEDIO ATRATO', 425, 27),
(593, 'MEDIO BAUDÓ', 430, 27),
(594, 'MEDIO SAN JUAN', 450, 27),
(595, 'NÓVITA', 491, 27),
(596, 'NUQUÍ', 495, 27),
(597, 'RÍO IRÓ', 580, 27),
(598, 'RÍO QUITO', 600, 27),
(599, 'RIOSUCIO', 615, 27),
(600, 'SAN JOSÉ DEL PALMAR', 660, 27),
(601, 'SIPÍ', 745, 27),
(602, 'TADÓ', 787, 27),
(603, 'UNGUÍA', 800, 27),
(604, 'UNIÓN PANAMERICANA', 810, 27),
(605, 'NEIVA', 1, 41),
(606, 'ACEVEDO', 6, 41),
(607, 'AGRADO', 13, 41),
(608, 'AIPE', 16, 41),
(609, 'ALGECIRAS', 20, 41),
(610, 'ALTAMIRA', 26, 41),
(611, 'BARAYA', 78, 41),
(612, 'CAMPOALEGRE', 132, 41),
(613, 'COLOMBIA', 206, 41),
(614, 'ELÍAS', 244, 41),
(615, 'GARZÓN', 298, 41),
(616, 'GIGANTE', 306, 41),
(617, 'GUADALUPE', 319, 41),
(618, 'HOBO', 349, 41),
(619, 'ÍQUIRA', 357, 41),
(620, 'ISNOS', 359, 41),
(621, 'LA ARGENTINA', 378, 41),
(622, 'LA PLATA', 396, 41),
(623, 'NÁTAGA', 483, 41),
(624, 'OPORAPA', 503, 41),
(625, 'PAICOL', 518, 41),
(626, 'PALERMO', 524, 41),
(627, 'PALESTINA', 530, 41),
(628, 'PITAL', 548, 41),
(629, 'PITALITO', 551, 41),
(630, 'RIVERA', 615, 41),
(631, 'SALADOBLANCO', 660, 41),
(632, 'SAN AGUSTÍN', 668, 41),
(633, 'SANTA MARÍA', 676, 41),
(634, 'SUAZA', 770, 41),
(635, 'TARQUI', 791, 41),
(636, 'TESALIA', 797, 41),
(637, 'TELLO', 799, 41),
(638, 'TERUEL', 801, 41),
(639, 'TIMANÁ', 807, 41),
(640, 'VILLAVIEJA', 872, 41),
(641, 'YAGUARÁ', 885, 41),
(642, 'RIOHACHA', 1, 44),
(643, 'ALBANIA', 35, 44),
(644, 'BARRANCAS', 78, 44),
(645, 'DIBULLA', 90, 44),
(646, 'DISTRACCIÓN', 98, 44),
(647, 'EL MOLINO', 110, 44),
(648, 'FONSECA', 279, 44),
(649, 'HATONUEVO', 378, 44),
(650, 'LA JAGUA DEL PILAR', 420, 44),
(651, 'MAICAO', 430, 44),
(652, 'MANAURE', 560, 44),
(653, 'SAN JUAN DEL CESAR', 650, 44),
(654, 'URIBIA', 847, 44),
(655, 'URUMITA', 855, 44),
(656, 'VILLANUEVA', 874, 44),
(657, 'SANTA MARTA', 1, 47),
(658, 'ALGARROBO', 30, 47),
(659, 'ARACATACA', 53, 47),
(660, 'ARIGUANÍ', 58, 47),
(661, 'CERRO DE SAN ANTONIO', 161, 47),
(662, 'CHIVOLO', 170, 47),
(663, 'CIÉNAGA', 189, 47),
(664, 'CONCORDIA', 205, 47),
(665, 'EL BANCO', 245, 47),
(666, 'EL PIÑÓN', 258, 47),
(667, 'EL RETÉN', 268, 47),
(668, 'FUNDACIÓN', 288, 47),
(669, 'GUAMAL', 318, 47),
(670, 'NUEVA GRANADA', 460, 47),
(671, 'PEDRAZA', 541, 47),
(672, 'PIJIÑO DEL CARMEN', 545, 47),
(673, 'PIVIJAY', 551, 47),
(674, 'PLATO', 555, 47),
(675, 'PUEBLOVIEJO', 570, 47),
(676, 'REMOLINO', 605, 47),
(677, 'SABANAS DE SAN ÁNGEL', 660, 47),
(678, 'SALAMINA', 675, 47),
(679, 'SAN SEBASTIÁN DE BUENAVISTA', 692, 47),
(680, 'SAN ZENÓN', 703, 47),
(681, 'SANTA ANA', 707, 47),
(682, 'SANTA BÁRBARA DE PINTO', 720, 47),
(683, 'SITIONUEVO', 745, 47),
(684, 'TENERIFE', 798, 47),
(685, 'ZAPAYÁN', 960, 47),
(686, 'ZONA BANANERA', 980, 47),
(687, 'VILLAVICENCIO', 1, 50),
(688, 'ACACÍAS', 6, 50),
(689, 'BARRANCA DE UPÍA', 110, 50),
(690, 'CABUYARO', 124, 50),
(691, 'CASTILLA LA NUEVA', 150, 50),
(692, 'SAN LUIS DE CUBARRAL', 223, 50),
(693, 'CUMARAL', 226, 50),
(694, 'EL CALVARIO', 245, 50),
(695, 'EL CASTILLO', 251, 50),
(696, 'EL DORADO', 270, 50),
(697, 'FUENTE DE ORO', 287, 50),
(698, 'GRANADA', 313, 50),
(699, 'GUAMAL', 318, 50),
(700, 'MAPIRIPÁN', 325, 50),
(701, 'MESETAS', 330, 50),
(702, 'LA MACARENA', 350, 50),
(703, 'URIBE', 370, 50),
(704, 'LEJANÍAS', 400, 50),
(705, 'PUERTO CONCORDIA', 450, 50),
(706, 'PUERTO GAITÁN', 568, 50),
(707, 'PUERTO LÓPEZ', 573, 50),
(708, 'PUERTO LLERAS', 577, 50),
(709, 'PUERTO RICO', 590, 50),
(710, 'RESTREPO', 606, 50),
(711, 'SAN CARLOS DE GUAROA', 680, 50),
(712, 'SAN JUAN DE ARAMA', 683, 50),
(713, 'SAN JUANITO', 686, 50),
(714, 'SAN MARTÍN', 689, 50),
(715, 'VISTAHERMOSA', 711, 50),
(716, 'PASTO', 1, 52),
(717, 'ALBÁN', 19, 52),
(718, 'ALDANA', 22, 52),
(719, 'ANCUYÁ', 36, 52),
(720, 'ARBOLEDA', 51, 52),
(721, 'BARBACOAS', 79, 52),
(722, 'BELÉN', 83, 52),
(723, 'BUESACO', 110, 52),
(724, 'COLÓN', 203, 52),
(725, 'CONSACÁ', 207, 52),
(726, 'CONTADERO', 210, 52),
(727, 'CÓRDOBA', 215, 52),
(728, 'CUASPÚD', 224, 52),
(729, 'CUMBAL', 227, 52),
(730, 'CUMBITARA', 233, 52),
(731, 'CHACHAGÜÍ', 240, 52),
(732, 'EL CHARCO', 250, 52),
(733, 'EL PEÑOL', 254, 52),
(734, 'EL ROSARIO', 256, 52),
(735, 'EL TABLÓN DE GÓMEZ', 258, 52),
(736, 'EL TAMBO', 260, 52),
(737, 'FUNES', 287, 52),
(738, 'GUACHUCAL', 317, 52),
(739, 'GUAITARILLA', 320, 52),
(740, 'GUALMATÁN', 323, 52),
(741, 'ILES', 352, 52),
(742, 'IMUÉS', 354, 52),
(743, 'IPIALES', 356, 52),
(744, 'LA CRUZ', 378, 52),
(745, 'LA FLORIDA', 381, 52),
(746, 'LA LLANADA', 385, 52),
(747, 'LA TOLA', 390, 52),
(748, 'LA UNIÓN', 399, 52),
(749, 'LEIVA', 405, 52),
(750, 'LINARES', 411, 52),
(751, 'LOS ANDES', 418, 52),
(752, 'MAGÜÍ', 427, 52),
(753, 'MALLAMA', 435, 52),
(754, 'MOSQUERA', 473, 52),
(755, 'NARIÑO', 480, 52),
(756, 'OLAYA HERRERA', 490, 52),
(757, 'OSPINA', 506, 52),
(758, 'FRANCISCO PIZARRO', 520, 52),
(759, 'POLICARPA', 540, 52),
(760, 'POTOSÍ', 560, 52),
(761, 'PROVIDENCIA', 565, 52),
(762, 'PUERRES', 573, 52),
(763, 'PUPIALES', 585, 52),
(764, 'RICAURTE', 612, 52),
(765, 'ROBERTO PAYÁN', 621, 52),
(766, 'SAMANIEGO', 678, 52),
(767, 'SANDONÁ', 683, 52),
(768, 'SAN BERNARDO', 685, 52),
(769, 'SAN LORENZO', 687, 52),
(770, 'SAN PABLO', 693, 52),
(771, 'SAN PEDRO DE CARTAGO', 694, 52),
(772, 'SANTA BÁRBARA', 696, 52),
(773, 'SANTACRUZ', 699, 52),
(774, 'SAPUYES', 720, 52),
(775, 'TAMINANGO', 786, 52),
(776, 'TANGUA', 788, 52),
(777, 'SAN ANDRÉS DE TUMACO', 835, 52),
(778, 'TÚQUERRES', 838, 52),
(779, 'YACUANQUER', 885, 52),
(780, 'CÚCUTA', 1, 54),
(781, 'ÁBREGO', 3, 54),
(782, 'ARBOLEDAS', 51, 54),
(783, 'BOCHALEMA', 99, 54),
(784, 'BUCARASICA', 109, 54),
(785, 'CÁCOTA', 125, 54),
(786, 'CÁCHIRA', 128, 54),
(787, 'CHINÁCOTA', 172, 54),
(788, 'CHITAGÁ', 174, 54),
(789, 'CONVENCIÓN', 206, 54),
(790, 'CUCUTILLA', 223, 54),
(791, 'DURANIA', 239, 54),
(792, 'EL CARMEN', 245, 54),
(793, 'EL TARRA', 250, 54),
(794, 'EL ZULIA', 261, 54),
(795, 'GRAMALOTE', 313, 54),
(796, 'HACARÍ', 344, 54),
(797, 'HERRÁN', 347, 54),
(798, 'LABATECA', 377, 54),
(799, 'LA ESPERANZA', 385, 54),
(800, 'LA PLAYA', 398, 54),
(801, 'LOS PATIOS', 405, 54),
(802, 'LOURDES', 418, 54),
(803, 'MUTISCUA', 480, 54),
(804, 'OCAÑA', 498, 54),
(805, 'PAMPLONA', 518, 54),
(806, 'PAMPLONITA', 520, 54),
(807, 'PUERTO SANTANDER', 553, 54),
(808, 'RAGONVALIA', 599, 54),
(809, 'SALAZAR', 660, 54),
(810, 'SAN CALIXTO', 670, 54),
(811, 'SAN CAYETANO', 673, 54),
(812, 'SANTIAGO', 680, 54),
(813, 'SARDINATA', 720, 54),
(814, 'SILOS', 743, 54),
(815, 'TEORAMA', 800, 54),
(816, 'TIBÚ', 810, 54),
(817, 'TOLEDO', 820, 54),
(818, 'VILLA CARO', 871, 54),
(819, 'VILLA DEL ROSARIO', 874, 54),
(820, 'ARMENIA', 1, 63),
(821, 'BUENAVISTA', 111, 63),
(822, 'CALARCÁ', 130, 63),
(823, 'CIRCASIA', 190, 63),
(824, 'CÓRDOBA', 212, 63),
(825, 'FILANDIA', 272, 63),
(826, 'GÉNOVA', 302, 63),
(827, 'LA TEBAIDA', 401, 63),
(828, 'MONTENEGRO', 470, 63),
(829, 'PIJAO', 548, 63),
(830, 'QUIMBAYA', 594, 63),
(831, 'SALENTO', 690, 63),
(832, 'PEREIRA', 1, 66),
(833, 'APÍA', 45, 66),
(834, 'BALBOA', 75, 66),
(835, 'BELÉN DE UMBRÍA', 88, 66),
(836, 'DOSQUEBRADAS', 170, 66),
(837, 'GUÁTICA', 318, 66),
(838, 'LA CELIA', 383, 66),
(839, 'LA VIRGINIA', 400, 66),
(840, 'MARSELLA', 440, 66),
(841, 'MISTRATÓ', 456, 66),
(842, 'PUEBLO RICO', 572, 66),
(843, 'QUINCHÍA', 594, 66),
(844, 'SANTA ROSA DE CABAL', 682, 66),
(845, 'SANTUARIO', 687, 66),
(846, 'BUCARAMANGA', 1, 68),
(847, 'AGUADA', 13, 68),
(848, 'ALBANIA', 20, 68),
(849, 'ARATOCA', 51, 68),
(850, 'BARBOSA', 77, 68),
(851, 'BARICHARA', 79, 68),
(852, 'BARRANCABERMEJA', 81, 68),
(853, 'BETULIA', 92, 68),
(854, 'BOLÍVAR', 101, 68),
(855, 'CABRERA', 121, 68),
(856, 'CALIFORNIA', 132, 68),
(857, 'CAPITANEJO', 147, 68),
(858, 'CARCASÍ', 152, 68),
(859, 'CEPITÁ', 160, 68),
(860, 'CERRITO', 162, 68),
(861, 'CHARALÁ', 167, 68),
(862, 'CHARTA', 169, 68),
(863, 'CHIMA', 176, 68),
(864, 'CHIPATÁ', 179, 68),
(865, 'CIMITARRA', 190, 68),
(866, 'CONCEPCIÓN', 207, 68),
(867, 'CONFINES', 209, 68),
(868, 'CONTRATACIÓN', 211, 68),
(869, 'COROMORO', 217, 68),
(870, 'CURITÍ', 229, 68),
(871, 'EL CARMEN DE CHUCURÍ', 235, 68),
(872, 'EL GUACAMAYO', 245, 68),
(873, 'EL PEÑÓN', 250, 68),
(874, 'EL PLAYÓN', 255, 68),
(875, 'ENCINO', 264, 68),
(876, 'ENCISO', 266, 68),
(877, 'FLORIÁN', 271, 68),
(878, 'FLORIDABLANCA', 276, 68),
(879, 'GALÁN', 296, 68),
(880, 'GÁMBITA', 298, 68),
(881, 'GIRÓN', 307, 68),
(882, 'GUACA', 318, 68),
(883, 'GUADALUPE', 320, 68),
(884, 'GUAPOTÁ', 322, 68),
(885, 'GUAVATÁ', 324, 68),
(886, 'GÜEPSA', 327, 68),
(887, 'HATO', 344, 68),
(888, 'JESÚS MARÍA', 368, 68),
(889, 'JORDÁN', 370, 68),
(890, 'LA BELLEZA', 377, 68),
(891, 'LANDÁZURI', 385, 68),
(892, 'LA PAZ', 397, 68),
(893, 'LEBRIJA', 406, 68),
(894, 'LOS SANTOS', 418, 68),
(895, 'MACARAVITA', 425, 68),
(896, 'MÁLAGA', 432, 68),
(897, 'MATANZA', 444, 68),
(898, 'MOGOTES', 464, 68),
(899, 'MOLAGAVITA', 468, 68),
(900, 'OCAMONTE', 498, 68),
(901, 'OIBA', 500, 68),
(902, 'ONZAGA', 502, 68),
(903, 'PALMAR', 522, 68),
(904, 'PALMAS DEL SOCORRO', 524, 68),
(905, 'PÁRAMO', 533, 68),
(906, 'PIEDECUESTA', 547, 68),
(907, 'PINCHOTE', 549, 68),
(908, 'PUENTE NACIONAL', 572, 68),
(909, 'PUERTO PARRA', 573, 68),
(910, 'PUERTO WILCHES', 575, 68),
(911, 'RIONEGRO', 615, 68),
(912, 'SABANA DE TORRES', 655, 68),
(913, 'SAN ANDRÉS', 669, 68),
(914, 'SAN BENITO', 673, 68),
(915, 'SAN GIL', 679, 68),
(916, 'SAN JOAQUÍN', 682, 68),
(917, 'SAN JOSÉ DE MIRANDA', 684, 68),
(918, 'SAN MIGUEL', 686, 68),
(919, 'SAN VICENTE DE CHUCURÍ', 689, 68),
(920, 'SANTA BÁRBARA', 705, 68),
(921, 'SANTA HELENA DEL OPÓN', 720, 68),
(922, 'SIMACOTA', 745, 68),
(923, 'SOCORRO', 755, 68),
(924, 'SUAITA', 770, 68),
(925, 'SUCRE', 773, 68),
(926, 'SURATÁ', 780, 68),
(927, 'TONA', 820, 68),
(928, 'VALLE DE SAN JOSÉ', 855, 68),
(929, 'VÉLEZ', 861, 68),
(930, 'VETAS', 867, 68),
(931, 'VILLANUEVA', 872, 68),
(932, 'ZAPATOCA', 895, 68),
(933, 'SINCELEJO', 1, 70),
(934, 'BUENAVISTA', 110, 70),
(935, 'CAIMITO', 124, 70),
(936, 'COLOSO', 204, 70),
(937, 'COROZAL', 215, 70),
(938, 'COVEÑAS', 221, 70),
(939, 'CHALÁN', 230, 70),
(940, 'EL ROBLE', 233, 70),
(941, 'GALERAS', 235, 70),
(942, 'GUARANDA', 265, 70),
(943, 'LA UNIÓN', 400, 70),
(944, 'LOS PALMITOS', 418, 70),
(945, 'MAJAGUAL', 429, 70),
(946, 'MORROA', 473, 70),
(947, 'OVEJAS', 508, 70),
(948, 'PALMITO', 523, 70),
(949, 'SAMPUÉS', 670, 70),
(950, 'SAN BENITO ABAD', 678, 70),
(951, 'SAN JUAN DE BETULIA', 702, 70),
(952, 'SAN MARCOS', 708, 70),
(953, 'SAN ONOFRE', 713, 70),
(954, 'SAN PEDRO', 717, 70),
(955, 'SAN LUIS DE SINCÉ', 742, 70),
(956, 'SUCRE', 771, 70),
(957, 'SANTIAGO DE TOLÚ', 820, 70),
(958, 'TOLÚ VIEJO', 823, 70),
(959, 'IBAGUÉ', 1, 73),
(960, 'ALPUJARRA', 24, 73),
(961, 'ALVARADO', 26, 73),
(962, 'AMBALEMA', 30, 73),
(963, 'ANZOÁTEGUI', 43, 73),
(964, 'ARMERO GUAYABAL', 55, 73),
(965, 'ATACO', 67, 73),
(966, 'CAJAMARCA', 124, 73),
(967, 'CARMEN DE APICALÁ', 148, 73),
(968, 'CASABIANCA', 152, 73),
(969, 'CHAPARRAL', 168, 73),
(970, 'COELLO', 200, 73),
(971, 'COYAIMA', 217, 73),
(972, 'CUNDAY', 226, 73),
(973, 'DOLORES', 236, 73),
(974, 'ESPINAL', 268, 73),
(975, 'FALAN', 270, 73),
(976, 'FLANDES', 275, 73),
(977, 'FRESNO', 283, 73),
(978, 'GUAMO', 319, 73),
(979, 'HERVEO', 347, 73),
(980, 'HONDA', 349, 73),
(981, 'ICONONZO', 352, 73),
(982, 'LÉRIDA', 408, 73),
(983, 'LÍBANO', 411, 73),
(984, 'SAN SEBASTIÁN DE MARIQUITA', 443, 73),
(985, 'MELGAR', 449, 73),
(986, 'MURILLO', 461, 73),
(987, 'NATAGAIMA', 483, 73),
(988, 'ORTEGA', 504, 73),
(989, 'PALOCABILDO', 520, 73),
(990, 'PIEDRAS', 547, 73),
(991, 'PLANADAS', 555, 73),
(992, 'PRADO', 563, 73),
(993, 'PURIFICACIÓN', 585, 73),
(994, 'RIOBLANCO', 616, 73),
(995, 'RONCESVALLES', 622, 73),
(996, 'ROVIRA', 624, 73),
(997, 'SALDAÑA', 671, 73),
(998, 'SAN ANTONIO', 675, 73),
(999, 'SAN LUIS', 678, 73),
(1000, 'SANTA ISABEL', 686, 73),
(1001, 'SUÁREZ', 770, 73),
(1002, 'VALLE DE SAN JUAN', 854, 73),
(1003, 'VENADILLO', 861, 73),
(1004, 'VILLAHERMOSA', 870, 73),
(1005, 'VILLARRICA', 873, 73),
(1006, 'CALI', 1, 76),
(1007, 'ALCALÁ', 20, 76),
(1008, 'ANDALUCÍA', 36, 76),
(1009, 'ANSERMANUEVO', 41, 76),
(1010, 'ARGELIA', 54, 76),
(1011, 'BOLÍVAR', 100, 76),
(1012, 'BUENAVENTURA', 109, 76),
(1013, 'GUADALAJARA DE BUGA', 111, 76),
(1014, 'BUGALAGRANDE', 113, 76),
(1015, 'CAICEDONIA', 122, 76),
(1016, 'CALIMA', 126, 76),
(1017, 'CANDELARIA', 130, 76),
(1018, 'CARTAGO', 147, 76),
(1019, 'DAGUA', 233, 76),
(1020, 'EL ÁGUILA', 243, 76),
(1021, 'EL CAIRO', 246, 76),
(1022, 'EL CERRITO', 248, 76),
(1023, 'EL DOVIO', 250, 76),
(1024, 'FLORIDA', 275, 76),
(1025, 'GINEBRA', 306, 76),
(1026, 'GUACARÍ', 318, 76),
(1027, 'JAMUNDÍ', 364, 76),
(1028, 'LA CUMBRE', 377, 76),
(1029, 'LA UNIÓN', 400, 76),
(1030, 'LA VICTORIA', 403, 76),
(1031, 'OBANDO', 497, 76),
(1032, 'PALMIRA', 520, 76),
(1033, 'PRADERA', 563, 76),
(1034, 'RESTREPO', 606, 76),
(1035, 'RIOFRÍO', 616, 76),
(1036, 'ROLDANILLO', 622, 76),
(1037, 'SAN PEDRO', 670, 76),
(1038, 'SEVILLA', 736, 76),
(1039, 'TORO', 823, 76),
(1040, 'TRUJILLO', 828, 76),
(1041, 'TULUÁ', 834, 76),
(1042, 'ULLOA', 845, 76),
(1043, 'VERSALLES', 863, 76),
(1044, 'VIJES', 869, 76),
(1045, 'YOTOCO', 890, 76),
(1046, 'YUMBO', 892, 76),
(1047, 'ZARZAL', 895, 76),
(1048, 'ARAUCA', 1, 81),
(1049, 'ARAUQUITA', 65, 81),
(1050, 'CRAVO NORTE', 220, 81),
(1051, 'FORTUL', 300, 81),
(1052, 'PUERTO RONDÓN', 591, 81),
(1053, 'SARAVENA', 736, 81),
(1054, 'TAME', 794, 81),
(1055, 'YOPAL', 1, 85),
(1056, 'AGUAZUL', 10, 85),
(1057, 'CHÁMEZA', 15, 85),
(1058, 'HATO COROZAL', 125, 85),
(1059, 'LA SALINA', 136, 85),
(1060, 'MANÍ', 139, 85),
(1061, 'MONTERREY', 162, 85),
(1062, 'NUNCHÍA', 225, 85),
(1063, 'OROCUÉ', 230, 85),
(1064, 'PAZ DE ARIPORO', 250, 85),
(1065, 'PORE', 263, 85),
(1066, 'RECETOR', 279, 85),
(1067, 'SABANALARGA', 300, 85),
(1068, 'SÁCAMA', 315, 85),
(1069, 'SAN LUIS DE PALENQUE', 325, 85),
(1070, 'TÁMARA', 400, 85),
(1071, 'TAURAMENA', 410, 85),
(1072, 'TRINIDAD', 430, 85),
(1073, 'VILLANUEVA', 440, 85),
(1074, 'MOCOA', 1, 86),
(1075, 'COLÓN', 219, 86),
(1076, 'ORITO', 320, 86),
(1077, 'PUERTO ASÍS', 568, 86),
(1078, 'PUERTO CAICEDO', 569, 86),
(1079, 'PUERTO GUZMÁN', 571, 86),
(1080, 'PUERTO LEGUÍZAMO', 573, 86),
(1081, 'SIBUNDOY', 749, 86),
(1082, 'SAN FRANCISCO', 755, 86),
(1083, 'SAN MIGUEL', 757, 86),
(1084, 'SANTIAGO', 760, 86),
(1085, 'VALLE DEL GUAMUEZ', 865, 86),
(1086, 'VILLAGARZÓN', 885, 86),
(1087, 'SAN ANDRÉS', 1, 88),
(1088, 'PROVIDENCIA', 564, 88),
(1089, 'LETICIA', 1, 91),
(1090, 'PUERTO NARIÑO', 540, 91),
(1091, 'INÍRIDA', 1, 94),
(1092, 'SAN JOSÉ DEL GUAVIARE', 1, 95),
(1093, 'CALAMAR', 15, 95),
(1094, 'EL RETORNO', 25, 95),
(1095, 'MIRAFLORES', 200, 95),
(1096, 'MITÚ', 1, 97),
(1097, 'CARURÚ', 161, 97),
(1098, 'TARAIRA', 666, 97),
(1099, 'PUERTO CARREÑO', 1, 99),
(1100, 'LA PRIMAVERA', 524, 99),
(1101, 'SANTA ROSALÍA', 624, 99),
(1102, 'CUMARIBO', 773, 99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `categoria` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `stock` int NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `codigo`, `categoria`, `stock`, `precio`) VALUES
(1, 'Gel Fijador', 'GF001', 'Gel', 12, 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`) VALUES
(1, 'CORTE DE CABELLO'),
(4, 'PEINADO'),
(6, 'BARBERIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` int NOT NULL,
  `codigo` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `codigo`, `descripcion`) VALUES
(1, 'TI', 'Tarjeta Identidad'),
(2, 'CC', 'Cedula Ciudadania'),
(3, 'CE', 'Cedula Extranjeria'),
(4, 'RC', 'Registro Civil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `usuario` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `perfil` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `estado` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT 'A',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `estado`, `fecha`) VALUES
(101, 'Jolurpe', 'jolurpe', '$2a$07$asxx54ahjppf45sd87a5au3mnULAjowa7bpEl9pUzqK9fyKjq/xOi', 'Administrador', 'A', '2024-04-28 19:51:56'),
(102, 'Administrador', 'Admin', '$2a$07$asxx54ahjppf45sd87a5auXXi0ieOzfxAb/u.EtXpm/yVQJbhZwha', 'Administrador', 'A', '2024-04-28 20:52:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int NOT NULL,
  `fecha` date NOT NULL,
  `consecutivo_venta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_cliente` int NOT NULL,
  `id_producto` int NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `consecutivo_venta`, `id_cliente`, `id_producto`, `valor`) VALUES
(2, '2024-08-10', 'FV000001', 4, 1, 200000.00),
(3, '2024-08-10', 'FV000002', 4, 1, 300000.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estudio` (`id_servicio`),
  ADD KEY `fk_paciente` (`id_cliente`),
  ADD KEY `fk_medico` (`id_empleado`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_identificacion_UNIQUE` (`numero_identificacion`),
  ADD KEY `fk_paciente_tipo_documento1_idx` (`tipo_documento_id`),
  ADD KEY `fk_departamento_paciente` (`id_departamento`),
  ADD KEY `fk_paciente_municipio` (`id_municipio`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cargo_idx` (`cargo_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `departamento_id` (`departamento_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consecutivo_venta` (`consecutivo_venta`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municipio` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1103;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `fk_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`),
  ADD CONSTRAINT `fk_estudio` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id`),
  ADD CONSTRAINT `fk_paciente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`),
  ADD CONSTRAINT `fk_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`),
  ADD CONSTRAINT `fk_tipo_documento1` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_cargo` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
