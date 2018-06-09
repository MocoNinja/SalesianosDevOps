-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2018 a las 13:57:51
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bancodetrabajosalesiano`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `idAlumno` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`idAlumno`, `nombre`, `apellidos`, `correo`, `username`, `password`) VALUES
(7, 'Javier', 'Gonzalez Tello', 'javiergonzaleztello@gmail.com', 'javier', 'asdf'),
(8, 'Miguel', 'Rubio Pueyo', 'miguelrubio@gmail.com', 'miguel', 'asdf'),
(9, 'prueba', 'pruebaaddhdh asdfyasdifidouiasio asfdjklasl', 'pruena@gmail.com', 'asdf', 'asdf'),
(10, 'prueba2', 'pruebaaddhdh asdfyasdifidouiasio asfdjklasl', 'pruena2@gmail.com', 'asdf2', 'asdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidades`
--

CREATE TABLE `habilidades` (
  `idHabilidad` int(11) NOT NULL,
  `habilidad` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `habilidades`
--

INSERT INTO `habilidades` (`idHabilidad`, `habilidad`) VALUES
(1, 'Quimica'),
(2, 'Fisica'),
(3, 'Matematicas'),
(4, 'Ingles'),
(5, 'Java'),
(6, 'SQL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoria`
--

CREATE TABLE `tutoria` (
  `idAlumno` int(11) NOT NULL,
  `idTutelado` int(11) DEFAULT NULL,
  `horario` varchar(350) COLLATE utf8mb4_spanish_ci NOT NULL,
  `idHabilidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tutoria`
--

INSERT INTO `tutoria` (`idAlumno`, `idTutelado`, `horario`, `idHabilidad`) VALUES
(7, NULL, 'LUNES|08:30-08:45#MARTES|#MIERCOLES|#JUEVES|#VIERNES|#', 1),
(9, NULL, 'LUNES|08:20-09:35#MARTES|#MIERCOLES|#JUEVES|#VIERNES|#', 1),
(9, NULL, 'LUNES|#MARTES|08:00-15:00#MIERCOLES|#JUEVES|#VIERNES|#', 2),
(9, NULL, 'LUNES|#MARTES|#MIERCOLES|08:00-15:00#JUEVES|#VIERNES|#', 3),
(9, NULL, 'LUNES|#MARTES|#MIERCOLES|#JUEVES|08:12-15:23#VIERNES|#', 4),
(9, NULL, 'LUNES|#MARTES|#MIERCOLES|#JUEVES|#VIERNES|08:12-20:16#', 5),
(9, NULL, 'LUNES|12:23-14:23;15:23-16:23#MARTES|#MIERCOLES|12:12-20:12;12:14-23:33#JUEVES|#VIERNES|12:12-20:12;12:14-23:33#', 6),
(10, NULL, 'LUNES|08:20-09:35#MARTES|#MIERCOLES|#JUEVES|#VIERNES|#', 1),
(10, NULL, 'LUNES|#MARTES|08:00-15:00#MIERCOLES|#JUEVES|#VIERNES|#', 2),
(10, NULL, 'LUNES|#MARTES|#MIERCOLES|08:00-15:00#JUEVES|#VIERNES|#', 3),
(10, NULL, 'LUNES|#MARTES|#MIERCOLES|#JUEVES|08:12-15:23#VIERNES|#', 4),
(10, NULL, 'LUNES|#MARTES|#MIERCOLES|#JUEVES|#VIERNES|08:12-20:16#', 5),
(10, NULL, 'LUNES|12:23-14:23;15:23-16:23#MARTES|#MIERCOLES|12:12-20:12;12:14-23:33#JUEVES|#VIERNES|12:12-20:12;12:14-23:33#', 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`idAlumno`),
  ADD UNIQUE KEY `username` (`username`,`password`);

--
-- Indices de la tabla `habilidades`
--
ALTER TABLE `habilidades`
  ADD PRIMARY KEY (`idHabilidad`);

--
-- Indices de la tabla `tutoria`
--
ALTER TABLE `tutoria`
  ADD UNIQUE KEY `idAlumno` (`idAlumno`,`idHabilidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `idAlumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `habilidades`
--
ALTER TABLE `habilidades`
  MODIFY `idHabilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
