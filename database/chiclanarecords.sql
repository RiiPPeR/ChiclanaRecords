-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2024 a las 01:29:34
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
  `description` varchar(250) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `tags` varchar(50) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cr_records`
--

INSERT INTO `cr_records` (`id`, `name`, `author`, `releaseDate`, `label`, `description`, `image`, `tags`, `rating`, `userId`) VALUES
(1, 'Ya viene el sol', 'Mecano', '1984-10-16', 'CBS – S-26211', 'Ya viene el Sol es el tercer álbum de estudio del grupo de tecno-pop español Mecano y último bajo el sello discográfico CBS.', './uploads/1.jpg', 'mecano, new wave, synth', 5, 26),
(47, 'El mar no cesa', 'Héroes del Silencio', '1988-10-31', 'EMI – 068 79 1455', 'El mar no cesa es el primer álbum de estudio de la banda española Héroes del Silencio, y fue publicado el 31 de octubre de 1988.', './uploads/712XXbJQPbL._UF894,1000_QL80_.jpg', 'rock, spansih', 5, 26),
(48, 'Descanso Dominical', 'Mecano', '1988-05-24', 'Ariola – 5F 209192', 'Descanso dominical es el nombre del quinto y penúltimo álbum de estudio del grupo español de música ', './uploads/c1310fc6ee21257f47d3c7cf5393b0ae.webp', 'mecano, pop, 80s', 5, 26),
(49, 'El grito del tiempo', 'Duncan Dhu', '1987-01-01', ' GA-177', 'El grito del tiempo es el nombre del tercer álbum de estudio del grupo donostiarra Duncan Dhu, edita', './uploads/duncandhuelgritodeltiempo.jfif', 'rock, pop', 4, 26),
(52, 'Busco algo barato - Aire (Single)', 'Mecano', '1984-01-01', '---', 'Cara A: Busco algo barato (Nacho Cano), Cara B: Aire (José María Cano)', './uploads/buscobusco.png', 'mecano, pop, 80s', 4, 26),
(53, 'El Mar No Cesa', 'Héroes del Silencio', '1988-01-01', 'EMI – 068-7914551', 'El primer álbum de héroes del silencio', './uploads/712XXbJQPbL._UF894,1000_QL80_.jpg', 'rock', 5, 65),
(54, 'Héroe de Leyenda', 'Héroes del Silencio', '1987-01-01', '---', 'Primer maxi single de Héroes del Silencio', './uploads/heroes-del-silencio-vinilo-cd-heroe-de-leyenda.jpg', 'rock', 4, 26);

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
(26, 'Pablo Antonio', 'López Butrón', 'panlobu@gmail.com', '$2y$10$a2W/zMmTeFd3Q7yx2Ldo8uDAOxbvx9H7GZzkOKZUtyLtiqYHh4ltC', 'panlobu', 1),
(65, 'Antonio', 'López', 'antonlopezru@gmail.com', '$2y$10$Bz8y3lnI4k3ZnZseGvNKkuRaV3kheW1b9XBmwpDL60dJF7sVf0DIO', 'Antonio', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `cr_usuarios`
--
ALTER TABLE `cr_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

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
