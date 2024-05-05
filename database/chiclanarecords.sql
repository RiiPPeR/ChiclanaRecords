-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2024 a las 14:08:59
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chiclanarecords`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cr_records`
--

CREATE TABLE `cr_records` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `releaseDate` date DEFAULT NULL,
  `label` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `tags` varchar(50) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cr_records`
--

INSERT INTO `cr_records` (`id`, `name`, `author`, `releaseDate`, `label`, `description`, `tags`, `rating`, `userId`) VALUES
(1, 'Ya viene el sol', 'Mecano', '0000-00-00', '123132asdw', 'muy bueno', 'mecano', 5, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cr_usuarios`
--

CREATE TABLE `cr_usuarios` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `rol` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cr_usuarios`
--

INSERT INTO `cr_usuarios` (`id`, `name`, `surname`, `email`, `password`, `username`, `rol`) VALUES
(25, 'pepe', 'mel', 'pepemel@gmail.com', '$2y$10$3F90S43Za8iEQxXbI09T9OSpRUXcAgFkHRgaGJqNsIDg/6c4uhxee', 'pepemel', 0),
(26, 'pablo', 'lopez', 'panlobu@gmail.com', '$2y$10$KkAihsXONeSEju9bij1vDOEcBVtUAcCBC6AxaTW9ULYD1auDNLpp2', 'panlobu', 1),
(28, 'Juaneye', 'Valdivia', 'juanvaldivia@gmail.com', '$2y$10$Vukmsil8XwR71hUUuYQ1muQss33ZL4NH/LlbvFRMOVtB2ZEO373Xq', 'juanvalidivahds', 0),
(29, 'Cristiano', 'Malagueño', 'cris@gmail.com', '$2y$10$x6jr2HESjeJ/K2u5mq9X..n5UobOf1ucyouvifpxO76vUvP9F3zyi', 'ronaldo7', 0),
(35, 'antonietasta', 'antonio', 'antonio@gmail.com', '$2y$10$CMMxo.oCu01WGhcglBUUPueYforfV5ZGbztHPZoG05fMqvIQaWSC2', 'antonio14', 0),
(36, 'pepe', 'pepe', 'pepe@pepe.com', '$2y$10$GkPAyUE3CwO/6KoTu6snP.IXdcLqaN5PnewnE.d/4.Q.C9Pceh7Ga', 'pepe', 0),
(37, 'Joselete', 'ruiz', 'joselete@gmail.com', '$2y$10$TfHNNtscvGVqSRDVosGuXuNBXoRgae5O.0fSwrxHjMfugLQQl/srG', 'Joseleteelmillor', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cr_records`
--
ALTER TABLE `cr_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indices de la tabla `cr_usuarios`
--
ALTER TABLE `cr_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_username` (`username`),
  ADD UNIQUE KEY `unique_email` (`email`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cr_records`
--
ALTER TABLE `cr_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cr_usuarios`
--
ALTER TABLE `cr_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cr_records`
--
ALTER TABLE `cr_records`
  ADD CONSTRAINT `cr_records_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `cr_usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
