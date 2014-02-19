-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
-- 
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2014 a las 22:13:49
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyectfact`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `codcliente` int(5) NOT NULL AUTO_INCREMENT,
  `cif` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `razonsocial` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion1` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion2` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pais` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cpostal` int(5) NOT NULL,
  `telefono1` int(12) NOT NULL,
  `telefono2` int(15) NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `web` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`codcliente`),
  UNIQUE KEY `codcliente` (`codcliente`),
  UNIQUE KEY `cif` (`cif`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10002 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`codcliente`, `cif`, `razonsocial`, `direccion1`, `direccion2`, `localidad`, `provincia`, `pais`, `cpostal`, `telefono1`, `telefono2`, `email`, `web`, `logo`, `estado`, `created_at`, `updated_at`) VALUES
(10000, 'E-14.236.392', 'Vinagrera Montillana,C.B.', 'Avda. Andalucia, 46', 'Avda. Andalucia, 46 Int.', 'Montilla', 'Córdoba', 'España', 14550, 957652952, 676230174, 'vinagreramontillana@gmail.com', '', '', '1', '2014-02-02 17:52:28', '0000-00-00 00:00:00'),
(10001, 'asdweqw', 'prueba', 'prueba Direccion', '', '', '', '', 0, 957650205, 0, 'vela91@gmail.com', '', '', '1', '2014-02-02 17:02:54', '2014-02-02 17:02:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_ref`
--

CREATE TABLE IF NOT EXISTS `cliente_ref` (
  `codcliente` int(11) NOT NULL,
  `idref` int(11) NOT NULL,
  PRIMARY KEY (`codcliente`,`idref`),
  UNIQUE KEY `codcliente` (`codcliente`,`idref`),
  UNIQUE KEY `codcliente_2` (`codcliente`,`idref`),
  UNIQUE KEY `codcliente_3` (`codcliente`,`idref`),
  KEY `idref` (`idref`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente_ref`
--

INSERT INTO `cliente_ref` (`codcliente`, `idref`) VALUES
(10000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_tarifa`
--

CREATE TABLE IF NOT EXISTS `cliente_tarifa` (
  `codcliente` int(11) NOT NULL,
  `idtarifa` int(11) NOT NULL,
  PRIMARY KEY (`codcliente`,`idtarifa`),
  UNIQUE KEY `codcliente` (`codcliente`,`idtarifa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_01_30_101542_create-users-table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias`
--

CREATE TABLE IF NOT EXISTS `referencias` (
  `id` int(2) NOT NULL,
  `capacidad` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `formato` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `etiqueta` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `referencias`
--

INSERT INTO `referencias` (`id`, `capacidad`, `formato`, `etiqueta`) VALUES
(1, '1L', 'PET', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE IF NOT EXISTS `tarifas` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `tarifa` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fechamod` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_user` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `tipo_user`, `created_at`, `updated_at`) VALUES
(1, 'prueba', 'asdf@asd.es', '$2y$10$/az19LBtGFdyTTEIv4/oouPdyQw7qpKw8HECPLq1PPlmRLkZWWbf6', '1', '2014-01-30 10:48:24', '2014-01-30 10:48:24'),
(2, 'admin', 'admin@admin.es', '$2y$10$RYQOMR6gVB/9oGeZeG1Rh.draxbFOWlqgX416WjgJt8U/.oEJusVC', '2', '2014-01-30 10:49:20', '2014-01-30 10:49:20'),
(3, 'ricardovelac', 'ricardovelac@gmail.com', '$2y$10$jUlhOSOdeCXyjzYPCPDqkeXdNBv0iL1BE/dk2uGThQ6Ar7XNRmTta', '1', '2014-01-31 17:39:06', '2014-01-31 17:39:06');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente_ref`
--
ALTER TABLE `cliente_ref`
  ADD CONSTRAINT `codcliente` FOREIGN KEY (`codcliente`) REFERENCES `clientes` (`codcliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idref` FOREIGN KEY (`idref`) REFERENCES `referencias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
