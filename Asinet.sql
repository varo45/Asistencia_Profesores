-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql
-- Tiempo de generación: 05-06-2020 a las 09:11:03
-- Versión del servidor: 5.7.22
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Asinet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Fichaje`
--

CREATE TABLE `Fichaje` (
  `ID` int(11) NOT NULL,
  `ID_PROFESOR` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora_entrada` time NOT NULL,
  `Hora_salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Horarios`
--

CREATE TABLE `Horarios` (
  `ID` int(11) NOT NULL,
  `ID_PROFESOR` int(11) NOT NULL,
  `Dia` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Hora` int(1) NOT NULL,
  `Aula` int(11) NOT NULL,
  `Grupo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `Hora_salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Profesores`
--

CREATE TABLE `Profesores` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `DNI` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `Password` longtext COLLATE utf8_spanish_ci NOT NULL,
  `Admin` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Fichaje`
--
ALTER TABLE `Fichaje`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Fichaje_Horarios` (`ID_PROFESOR`);

--
-- Indices de la tabla `Horarios`
--
ALTER TABLE `Horarios`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Horarios_Profesores` (`ID_PROFESOR`);

--
-- Indices de la tabla `Profesores`
--
ALTER TABLE `Profesores`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Fichaje`
--
ALTER TABLE `Fichaje`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Horarios`
--
ALTER TABLE `Horarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Profesores`
--
ALTER TABLE `Profesores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Fichaje`
--
ALTER TABLE `Fichaje`
  ADD CONSTRAINT `FK_Fichaje_Horarios` FOREIGN KEY (`ID_PROFESOR`) REFERENCES `Horarios` (`ID_PROFESOR`);

--
-- Filtros para la tabla `Horarios`
--
ALTER TABLE `Horarios`
  ADD CONSTRAINT `FK_Horarios_Profesores` FOREIGN KEY (`ID_PROFESOR`) REFERENCES `Profesores` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
