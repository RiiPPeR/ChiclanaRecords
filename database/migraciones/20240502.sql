CREATE TABLE IF NOT EXISTS <prefijo>records (
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
);

INSERT INTO <prefijo>records (`id`, `name`, `author`, `releaseDate`, `label`, `description`, `image`, `tags`, `rating`, `userId`) VALUES
(1, 'Ya viene el sol', 'Mecano', '1984-10-16', 'CBS – S-26211', 'Ya viene el Sol es el tercer álbum de estudio del grupo de tecno-pop español Mecano y último bajo el sello discográfico CBS.', './uploads/1.jpg', 'mecano, new wave, synth', 5, 26),
(47, 'El mar no cesa', 'Héroes del Silencio', '1988-10-31', 'EMI – 068 79 1455', 'El mar no cesa es el primer álbum de estudio de la banda española Héroes del Silencio, y fue publicado el 31 de octubre de 1988.', './uploads/712XXbJQPbL._UF894,1000_QL80_.jpg', 'rock, spansih', 5, 26),
(48, 'Descanso Dominical', 'Mecano', '1988-05-24', 'Ariola – 5F 209192', 'Descanso dominical es el nombre del quinto y penúltimo álbum de estudio del grupo español de música ', './uploads/c1310fc6ee21257f47d3c7cf5393b0ae.webp', 'mecano, pop, 80s', 5, 26),
(49, 'El grito del tiempo', 'Duncan Dhu', '1987-01-01', ' GA-177', 'El grito del tiempo es el nombre del tercer álbum de estudio del grupo donostiarra Duncan Dhu, edita', './uploads/duncandhuelgritodeltiempo.jfif', 'rock, pop', 4, 26),
(52, 'Busco algo barato - Aire (Single)', 'Mecano', '1984-01-01', '---', 'Cara A: Busco algo barato (Nacho Cano), Cara B: Aire (José María Cano)', './uploads/buscobusco.png', 'mecano, pop, 80s', 4, 26),
(53, 'El Mar No Cesa', 'Héroes del Silencio', '1988-01-01', 'EMI – 068-7914551', 'El primer álbum de héroes del silencio', './uploads/712XXbJQPbL._UF894,1000_QL80_.jpg', 'rock', 5, 65),
(54, 'Héroe de Leyenda', 'Héroes del Silencio', '1987-01-01', '---', 'Primer maxi single de Héroes del Silencio', './uploads/heroes-del-silencio-vinilo-cd-heroe-de-leyenda.jpg', 'rock', 4, 26);
(55, 'Senderos de Traición', 'Héroes del Silencio', '1990-01-01', '---', 'Segundo disco de Héroes del Silencio, donde podemos encontrar Entre dos Tierras, y Maldito Duende...', './uploads/ab67616d0000b273ae81e451f5b5d7d701b0a9f5.jpeg', 'rock español', 5, 65),
(56, 'La Rosa de los Vientos', 'La Frontera', '1989-06-05', 'Polydor – 839607-2', 'Disco mas famoso de la Frontera donde podemos escuchar El límite, Juan Antonio Cortés, ...', './uploads/R-3034654-1361138156-6706.jpg', 'rock western', 4, 66);

CREATE TABLE <prefijo>usuarios (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `rol` tinyint(1) NOT NULL DEFAULT 0
);

INSERT INTO <prefijo>usuarios (`id`, `name`, `surname`, `email`, `password`, `username`, `rol`) VALUES
(26, 'Pablo Antonio', 'López Butrón', 'panlobu@gmail.com', '$2y$10$a2W/zMmTeFd3Q7yx2Ldo8uDAOxbvx9H7GZzkOKZUtyLtiqYHh4ltC', 'panlobu', 1),
(65, 'Antonio', 'López', 'antonlopezru@gmail.com', '$2y$10$Bz8y3lnI4k3ZnZseGvNKkuRaV3kheW1b9XBmwpDL60dJF7sVf0DIO', 'Antonio', 0);
(66, 'Pepe', 'Mel', 'pepemel@gmail.com', '$2y$10$SJbZ4F45u5MKJ806ibaXueSq9pEtRpKPdKEcumf27N85NRYhZHlRi', 'pepemel', 0),
(67, 'Joselu', 'Mato', 'joselumato@gmail.com', '$2y$10$xf3uqQfIUgbcr8vt6k00nu1HkbDvMQARg2PZrbgP36UBs.lTwbabG', 'joselumato', 0);

ALTER TABLE <prefijo>records
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

ALTER TABLE <prefijo>usuarios
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_username` (`username`),
  ADD UNIQUE KEY `unique_email` (`email`) USING BTREE;

ALTER TABLE <prefijo>migraciones MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE <prefijo>records MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

ALTER TABLE <prefijo>usuarios MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

ALTER TABLE <prefijo>records ADD CONSTRAINT `cr_records_ibfk_1` FOREIGN KEY (`userId`) REFERENCES <prefijo>usuarios (`id`);
