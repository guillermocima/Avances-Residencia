-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306

-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_tortilleria`
--
CREATE DATABASE IF NOT EXISTS `bd_tortilleria` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_tortilleria`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobaciones_tortillas_calientes`
--

CREATE TABLE `comprobaciones_tortillas_calientes` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tortillas_calientes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comprobaciones_tortillas_calientes`
--

INSERT INTO `comprobaciones_tortillas_calientes` (`id`, `fecha`, `usuario_id`, `tortillas_calientes`) VALUES
(1, '2024-09-11', 24, 2),
(15, '2024-09-12', 24, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobaciones_tortillas_frias`
--

CREATE TABLE `comprobaciones_tortillas_frias` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tortillas_frias` int(11) NOT NULL,
  `tortillas_frias_dia_anterior` int(11) NOT NULL,
  `cuadrado` int(11) NOT NULL COMMENT '0 numeros iguales -faltan totillas  +sobran',
  `contador_comparaciones` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comprobaciones_tortillas_frias`
--

INSERT INTO `comprobaciones_tortillas_frias` (`id`, `fecha`, `usuario_id`, `tortillas_frias`, `tortillas_frias_dia_anterior`, `cuadrado`, `contador_comparaciones`) VALUES
(165, '2024-09-10', 24, 1322, 6, 1316, 1),
(166, '2024-11-09', 24, 15, 6, 9, 1),
(177, '2024-09-12', 24, 2, 44, -42, 1),
(178, '2024-09-12', 24, 2, 44, -42, 1),
(179, '2024-09-12', 24, 2, 44, -42, 1),
(180, '2024-09-12', 24, 2, 44, -42, 1),
(181, '2024-09-12', 24, 2, 44, -42, 1),
(182, '2024-09-12', 24, 44, 44, 0, 1),
(183, '2024-09-12', 24, 2, 44, -42, 1),
(184, '2024-09-12', 24, 2, 44, -42, 1),
(185, '2024-09-12', 24, 1, 44, -43, 1),
(186, '2024-09-12', 24, 3, 44, -41, 1),
(187, '2024-09-12', 24, 3, 44, -41, 1),
(188, '2024-09-12', 24, 22, 44, -22, 1),
(189, '2024-09-12', 24, 33, 44, -11, 1),
(190, '2024-09-12', 24, 33, 44, -11, 1),
(191, '2024-09-12', 24, 44, 44, 0, 1),
(192, '2024-09-12', 24, 33, 44, -11, 1),
(193, '2024-09-12', 24, 33, 44, -11, 1),
(194, '2024-09-12', 24, 33, 44, -11, 1),
(195, '2024-09-12', 24, 33, 44, -11, 1),
(196, '2024-09-12', 24, 4, 44, -40, 1),
(197, '2024-09-12', 24, 5, 44, -39, 1),
(198, '2024-09-12', 24, 52, 44, 8, 1),
(199, '2024-09-12', 24, 44, 44, 0, 1),
(200, '2024-09-12', 24, 55, 44, 11, 1),
(201, '2024-09-12', 24, 44, 44, 0, 1),
(202, '2024-09-12', 24, 3, 44, -41, 1),
(203, '2024-09-12', 24, 3, 44, -41, 1),
(204, '2024-09-11', 24, 6, 5, 1, 1),
(205, '2024-09-11', 24, 7, 5, 2, 1),
(206, '2024-09-11', 24, 4, 5, -1, 1),
(207, '2024-09-11', 24, 5, 5, 0, 1),
(208, '2024-09-11', 24, 44, 5, 39, 1),
(209, '2024-09-11', 24, 5, 5, 0, 1),
(210, '2024-09-11', 24, 2, 5, -3, 1),
(211, '2024-09-11', 24, 5, 5, 0, 1),
(212, '2024-09-12', 24, 2, 44, -42, 1),
(213, '2024-09-12', 24, 44, 44, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dash_usuarios`
--

CREATE TABLE `dash_usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(70) NOT NULL,
  `hashUser` varchar(25) NOT NULL,
  `fechaRegistro` date NOT NULL,
  `tipo` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1administrador \r\n2usuario',
  `turno` varchar(50) NOT NULL,
  `rol` varchar(50) NOT NULL
  `tipo` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1administrador \r\n2usuario'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dash_usuarios`
--

INSERT INTO `dash_usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `hashUser`, `fechaRegistro`, `tipo`, `turno`, `rol`) VALUES
(24, 'UICAB', 'Uicabsdsd', 'uicab.nahuat.victor@cbta80.edu.mx', '61be55a8e2f6b4e172338bddf184d6dbee29c98853e0a0485ecee7f27b9af0b4', 'cfb4033453ac410171613dc69', '2022-05-25', 1, '', 'repartidor'),
(26, '3333sfesfejknjk', 'sdsfsefsjihuy', 'uicab.nahuat.victor@cbta80.edu.mxp', '7cbccda65959a4fe629dbdf546ae3ddea9328ae5a53498785f4a27394fe26515', '4c09a1034e3d99fbc7c336681', '2022-06-11', 2, '', '0'),
(28, 'Administrador', 'uicab', 'uicab.nahuat.victor@cbta80.edu.mxppp', '7cbccda65959a4fe629dbdf546ae3ddea9328ae5a53498785f4a27394fe26515', '0c7dbb3ec3ca4fa6a967cbdbc', '2022-06-12', 2, '', '0'),
(31, 'aaddss', 'asdasddsa', 'uicab.nahuat.victor@cbta80.edu.mxasdasdasdasdasdasdasdas', '61be55a8e2f6b4e172338bddf184d6dbee29c98853e0a0485ecee7f27b9af0b4', '7fbfe8d7a61eb45dd1c378456', '2022-08-22', 2, '', '0'),
(32, 'manuel uicab', 'nahsua', 'aygshd.37ygduyg@as.ssa.ss', '61be55a8e2f6b4e172338bddf184d6dbee29c98853e0a0485ecee7f27b9af0b4', '51eebfbfd2525f5c88e4626d1', '2022-12-06', 2, '', '0'),
(33, 'Victor', 'Nahuat', 'uicab.nahuat.victor@cbta80.edu.mxb', '5e846c64f2db12266e6b658a8e5b5b42cc225419b3ee1fca88acbb181ddfdb52', '27d440e9185124c9c8f9664bd', '2023-02-16', 2, '', 'repartidor'),
(34, 'aa', 'assa', 'sasaas@sassa.jh', 'f29a448b780745bf2e10667f46c442b102e75e76a46a1fff969641866225ab56', 'b144a9d3e74feb095aa1dbbbf', '2024-02-26', 2, '', '0'),
(36, 'aa', 'bb', 'cccc', 'cccc', '', '0000-00-00', 2, '', '0'),
(37, '', '', 'aaa', '', '', '0000-00-00', 2, '', '0'),
(38, '', '', 'aaaa', 'aaaa', '', '0000-00-00', 2, '', '0'),
(39, 'a', 'aa', 'aygshd.37ygduyg@as.ssa.ssdddddd', '61be55a8e2f6b4e172338bddf184d6dbee29c98853e0a0485ecee7f27b9af0b4', 'a8d3b0bceae5a23d24ca08d75', '2024-07-28', 2, '', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregas_distribucion`
--

CREATE TABLE `entregas_distribucion` (
  `id` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `repartidor_id` int(11) NOT NULL,
  `sucursal_id` int(11) NOT NULL,
  `subtotal_frias` decimal(10,2) NOT NULL,
  `cantidad_reportada_frias` decimal(10,2) NOT NULL,
  `diferencia_frias` decimal(10,2) NOT NULL,
  `tortilla_caliente_salidas` decimal(10,2) NOT NULL,
  `devolucion_caliente` decimal(10,2) NOT NULL,
  `cantidad_reportada_caliente` decimal(10,2) NOT NULL,
  `diferencia_caliente` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entregas_distribucion`
--

INSERT INTO `entregas_distribucion` (`id`, `fecha_entrega`, `repartidor_id`, `sucursal_id`, `subtotal_frias`, `cantidad_reportada_frias`, `diferencia_frias`, `tortilla_caliente_salidas`, `devolucion_caliente`, `cantidad_reportada_caliente`, `diferencia_caliente`, `created_at`) VALUES
(3, '2024-09-12', 33, 5, '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '8.00', '2024-09-09 15:27:42'),
(4, '2024-09-12', 33, 5, '7.00', '77.00', '7.00', '7.00', '7.00', '7.00', '7.00', '2024-09-09 15:29:16'),
(5, '2024-09-19', 33, 3, '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '6.00', '2024-09-09 16:07:18'),
(6, '2024-09-10', 24, 5, '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '5.00', '2024-09-09 17:35:30'),
(10, '2024-09-11', 24, 3, '44.00', '44.00', '44.00', '444.00', '444.00', '44.00', '44.00', '2024-09-12 00:46:25'),
(11, '2024-09-17', 24, 2, '7777.00', '77777.00', '777.00', '7.00', '7.00', '7.00', '99999999.99', '2024-09-12 15:43:52'),
(12, '2024-09-24', 33, 2, '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '4.00', '2024-09-12 15:47:05');
INSERT INTO `dash_usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `hashUser`, `fechaRegistro`, `tipo`) VALUES
(24, 'UICAB', 'Uicabsdsd', 'uicab.nahuat.victor@cbta80.edu.mx', '61be55a8e2f6b4e172338bddf184d6dbee29c98853e0a0485ecee7f27b9af0b4', 'cfb4033453ac410171613dc69', '2022-05-25', 1),
(26, '3333sfesfejknjk', 'sdsfsefsjihuy', 'uicab.nahuat.victor@cbta80.edu.mxp', '7cbccda65959a4fe629dbdf546ae3ddea9328ae5a53498785f4a27394fe26515', '4c09a1034e3d99fbc7c336681', '2022-06-11', 2),
(28, 'Administrador', 'uicab', 'uicab.nahuat.victor@cbta80.edu.mxppp', '7cbccda65959a4fe629dbdf546ae3ddea9328ae5a53498785f4a27394fe26515', '0c7dbb3ec3ca4fa6a967cbdbc', '2022-06-12', 2),
(31, 'aaddss', 'asdasddsa', 'uicab.nahuat.victor@cbta80.edu.mxasdasdasdasdasdasdasdas', '61be55a8e2f6b4e172338bddf184d6dbee29c98853e0a0485ecee7f27b9af0b4', '7fbfe8d7a61eb45dd1c378456', '2022-08-22', 2),
(32, 'manuel uicab', 'nahsua', 'aygshd.37ygduyg@as.ssa.ss', '61be55a8e2f6b4e172338bddf184d6dbee29c98853e0a0485ecee7f27b9af0b4', '51eebfbfd2525f5c88e4626d1', '2022-12-06', 2),
(33, 'Victor', 'Nahuat', 'uicab.nahuat.victor@cbta80.edu.mxb', '5e846c64f2db12266e6b658a8e5b5b42cc225419b3ee1fca88acbb181ddfdb52', '27d440e9185124c9c8f9664bd', '2023-02-16', 2),
(34, 'aa', 'assa', 'sasaas@sassa.jh', 'f29a448b780745bf2e10667f46c442b102e75e76a46a1fff969641866225ab56', 'b144a9d3e74feb095aa1dbbbf', '2024-02-26', 2),
(36, 'aa', 'bb', 'cccc', 'cccc', '', '0000-00-00', 2),
(37, '', '', 'aaa', '', '', '0000-00-00', 2),
(38, '', '', 'aaaa', 'aaaa', '', '0000-00-00', 2),
(39, 'a', 'aa', 'aygshd.37ygduyg@as.ssa.ssdddddd', '61be55a8e2f6b4e172338bddf184d6dbee29c98853e0a0485ecee7f27b9af0b4', 'a8d3b0bceae5a23d24ca08d75', '2024-07-28', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_gas`
--

CREATE TABLE `inventario_gas` (
  `id` int(11) NOT NULL,
  `turno` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `inicial` int(11) NOT NULL,
  `entradas` int(11) NOT NULL,
  `salidas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--



-- Volcado de datos para la tabla `inventario_gas`
--

INSERT INTO `inventario_gas` (`id`, `turno`, `fecha`, `inicial`, `entradas`, `salidas`) VALUES
(1, 'harturno1', '0044-04-04', 4444, 444, 444),
(2, 'harturno1', '0066-06-06', 6, 6, 6),
(3, 'harturno1', '6666-06-06', 666, 666, 666),
(4, 'harturno2', '7777-07-07', 777, 777, 777),
(5, 'harturno2', '0099-09-09', 99, 99, 99),
(6, 'gasTURN2', '2222-02-22', 22, 22, 22),
(7, 'gasTURN2', '3333-03-31', 333, 33, 33);
=======
(6, 'gasTURN2', '2222-02-22', 22, 22, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_harina`
--

CREATE TABLE `inventario_harina` (
  `id` int(11) NOT NULL,
  `opcion_seleccionada` varchar(50) NOT NULL,
  `fecha_h` date NOT NULL,
  `inicial` decimal(10,2) NOT NULL,
  `entradas` decimal(10,2) NOT NULL,
  `salidas` decimal(10,2) NOT NULL,
  `traspasos` decimal(10,2) DEFAULT NULL,
  `lista_sucursales` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario_harina`
--

INSERT INTO `inventario_harina` (`id`, `opcion_seleccionada`, `fecha_h`, `inicial`, `entradas`, `salidas`, `traspasos`, `lista_sucursales`, `created_at`) VALUES
(1, 'harturno1', '0056-06-05', '200.00', '55.00', '55.00', NULL, 'SELECCIONAR', '2024-07-28 20:55:12'),
(2, 'harturno2', '0065-06-05', '6.00', '6.00', '6.00', NULL, 'MERLY Y HACIENDAS', '2024-07-28 20:58:27'),
(3, 'harturno2', '0033-03-31', '5.00', '5.00', '5.00', NULL, 'MADDOX I', '2024-07-28 21:00:08'),
(4, 'harturno1', '0003-03-31', '33.00', '333.00', '333.00', '33.00', 'SOBRINOS 2', '2024-07-28 21:02:54'),
(5, 'harturno1', '0066-06-06', '66.00', '666.00', '666.00', '66.00', 'MADDOX 3', '2024-07-28 21:05:22'),
(6, 'harturno2', '0002-03-31', '0.00', '0.00', '0.00', '0.00', 'SOBRINOS 2', '2024-07-28 21:06:03'),
(7, 'harturno1', '0004-04-04', '4.00', '4.00', '4.00', '4.00', 'MERLY Y ALEJANDRIA', '2024-07-28 21:06:56'),
(8, 'harturno2', '0004-03-04', '5.00', '5.00', '5.00', '2.00', 'SOBRINOS III', '2024-07-28 21:11:05'),
(9, 'harTURN1', '3333-03-31', '33.00', '33.00', '33.00', '33.00', 'MADDOX 3', '2024-07-29 01:36:25'),
(10, 'harTURN2', '3333-03-31', '333.00', '333.00', '33.00', '3.00', 'MERLY PETEN', '2024-08-03 16:09:38'),
(11, 'harTURN2', '3333-03-31', '333.00', '333.00', '33.00', '3.00', 'MERLY PETEN', '2024-08-03 16:09:39'),
(12, 'harTURN1', '0054-04-05', '45.00', '554.00', '5454.00', '554.00', 'SOBRINOS III', '2024-08-21 21:22:08'),
(13, 'harTURN2', '0044-04-04', '4.00', '3.00', '4.00', '4.00', 'SOBRINOS 2', '2024-08-21 21:22:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_totopos`
--

CREATE TABLE `inventario_totopos` (
  `id` int(11) NOT NULL,
  `topos_anterior` decimal(10,2) NOT NULL,
  `produccion` decimal(10,2) NOT NULL,
  `venta_totopos` decimal(10,2) NOT NULL,
  `salida_totopos` decimal(10,2) NOT NULL,
  `existencia_real` decimal(10,2) NOT NULL,
  `lista_sucursales` varchar(255) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario_totopos`
--

INSERT INTO `inventario_totopos` (`id`, `topos_anterior`, `produccion`, `venta_totopos`, `salida_totopos`, `existencia_real`, `lista_sucursales`, `fecha`) VALUES
(1, '5.00', '1.00', '16.00', '104.00', '38.00', 'SOBRINOS I', '0002-02-22'),
(2, '4.00', '4.00', '4.00', '4.00', '4.00', 'SOBRINOS I', '0044-04-04'),
(3, '5.00', '5.00', '5.00', '5.00', '3.00', 'MERLY Y ALEJANDRIA', '0005-05-05'),
(4, '9.00', '9.00', '16.00', '104.00', '38.00', 'MADDOX I', '9999-09-09'),
(5, '4.00', '4.00', '16.00', '104.00', '38.00', 'SOBRINOS I', '0044-04-04');
=======
(9, 'harTURN1', '3333-03-31', '33.00', '33.00', '33.00', '33.00', 'MADDOX 3', '2024-07-29 01:36:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `nombre_permiso` varchar(50) NOT NULL,
  `descripcion_permiso` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `nombre_permiso`, `descripcion_permiso`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'REQ001', 'gestión de inventario', '2024-07-27 23:00:04', '2024-07-27 23:00:04'),
(2, 'REQ002', 'gestión de ventas', '2024-07-27 23:00:04', '2024-07-27 23:00:04'),
(3, 'REQ003', 'recursos humanos', '2024-07-27 23:00:04', '2024-07-27 23:00:04'),
(4, 'REQ004', 'distribución', '2024-07-27 23:00:04', '2024-07-27 23:00:04'),
(5, 'REQ005', 'contabilidad y finanzas', '2024-07-27 23:00:04', '2024-07-27 23:00:04'),
(6, 'REQ006', 'reportes y administración', '2024-07-27 23:00:04', '2024-07-27 23:00:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidores`
--

CREATE TABLE `repartidores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `repartidores`
--

INSERT INTO `repartidores` (`id`, `nombre`, `created_at`) VALUES
(1, 'Repartidor 1', '2024-09-09 03:15:27'),
(2, 'Repartidor 2', '2024-09-09 03:15:27'),
(3, 'Repartidor 3', '2024-09-09 03:15:27'),
(4, 'Repartidor 1', '2024-09-09 03:16:16'),
(5, 'Repartidor 2', '2024-09-09 03:16:16'),
(6, 'Repartidor 3', '2024-09-09 03:16:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL,
  `descripcion_rol` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`, `descripcion_rol`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'administrador general', 'acceso total al sistema y configuración', '2024-07-27 23:00:04', '2024-07-27 23:00:04'),
(2, 'administrador', 'acceso total al sistema y configuración', '2024-07-27 23:00:04', '2024-07-27 23:00:04'),
(3, 'ventas', 'acceso limitado a ventas e inventarios', '2024-07-27 23:00:04', '2024-07-27 23:00:04'),
(4, 'distribuidor', 'acceso limitado a ventas y distribución', '2024-07-27 23:00:04', '2024-07-27 23:00:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permisos`
--

CREATE TABLE `rol_permisos` (
  `id_rol_permiso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol_permisos`
--

INSERT INTO `rol_permisos` (`id_rol_permiso`, `id_rol`, `id_permiso`, `fecha_creacion`) VALUES
(1, 1, 1, '2024-07-27 23:00:05'),
(2, 1, 2, '2024-07-27 23:00:05'),
(3, 1, 3, '2024-07-27 23:00:05'),
(4, 1, 4, '2024-07-27 23:00:05'),
(5, 1, 5, '2024-07-27 23:00:05'),
(6, 1, 6, '2024-07-27 23:00:05'),
(7, 2, 1, '2024-07-27 23:00:05'),
(8, 2, 2, '2024-07-27 23:00:05'),
(9, 2, 3, '2024-07-27 23:00:05'),
(10, 2, 4, '2024-07-27 23:00:05'),
(11, 2, 5, '2024-07-27 23:00:05'),
(12, 2, 6, '2024-07-27 23:00:05'),
(13, 3, 1, '2024-07-27 23:00:05'),
(14, 3, 2, '2024-07-27 23:00:05'),
(15, 3, 3, '2024-07-27 23:00:05'),
(16, 3, 4, '2024-07-27 23:00:05'),
(17, 3, 5, '2024-07-27 23:00:05'),
(18, 4, 1, '2024-07-27 23:00:05'),
(19, 4, 2, '2024-07-27 23:00:05');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `nombre`) VALUES
(1, 'SOBRINOS I'),
(2, 'MADDOX II'),
(3, 'MADDOX I'),
(4, 'SOBRINOS III'),
(5, 'MERLY Y ALEJANDRIA'),
(6, 'MERLY PETEN'),
(7, 'MERLY Y HACIENDAS'),
(8, 'SOBRINOS 2'),
(9, 'MADDOX 3'),
(10, 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventastotopos_dia`
--

CREATE TABLE `ventastotopos_dia` (
  `id` int(11) NOT NULL,
  `sucursal` varchar(255) NOT NULL,
  `bolsas` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventastotopos_dia`
--

INSERT INTO `ventastotopos_dia` (`id`, `sucursal`, `bolsas`, `precio`, `fecha`) VALUES
(5, '3', 3, '3.00', '2024-09-11'),
(7, '1', 444, '444.00', '2024-09-04'),
(8, '3', 222, '3.00', '2024-09-12'),
(9, '2', 3, '3.00', '2024-09-12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comprobaciones_tortillas_calientes`
--
ALTER TABLE `comprobaciones_tortillas_calientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_fecha_usuario` (`fecha`,`usuario_id`);

--
-- Indices de la tabla `comprobaciones_tortillas_frias`
--
ALTER TABLE `comprobaciones_tortillas_frias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dash_usuarios`
--
ALTER TABLE `dash_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entregas_distribucion`
--
ALTER TABLE `entregas_distribucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario_gas`
--
ALTER TABLE `inventario_gas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario_harina`
--
ALTER TABLE `inventario_harina`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario_totopos`
--
ALTER TABLE `inventario_totopos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`),
  ADD UNIQUE KEY `nombre_permiso` (`nombre_permiso`);

--
-- Indices de la tabla `repartidores`
--
ALTER TABLE `repartidores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `rol_permisos`
--
ALTER TABLE `rol_permisos`
  ADD PRIMARY KEY (`id_rol_permiso`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventastotopos_dia`
--
ALTER TABLE `ventastotopos_dia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comprobaciones_tortillas_calientes`
--
ALTER TABLE `comprobaciones_tortillas_calientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `comprobaciones_tortillas_frias`
--
ALTER TABLE `comprobaciones_tortillas_frias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT de la tabla `dash_usuarios`
--
ALTER TABLE `dash_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `entregas_distribucion`
--
ALTER TABLE `entregas_distribucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `inventario_gas`
--
ALTER TABLE `inventario_gas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
-- AUTO_INCREMENT de la tabla `inventario_gas`
--
ALTER TABLE `inventario_gas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `inventario_harina`
--
ALTER TABLE `inventario_harina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `inventario_totopos`
--
ALTER TABLE `inventario_totopos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `repartidores`
--
ALTER TABLE `repartidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol_permisos`
--
ALTER TABLE `rol_permisos`
  MODIFY `id_rol_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ventastotopos_dia`
--
ALTER TABLE `ventastotopos_dia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `rol_permisos`
--
ALTER TABLE `rol_permisos`
  ADD CONSTRAINT `rol_permisos_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  ADD CONSTRAINT `rol_permisos_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
