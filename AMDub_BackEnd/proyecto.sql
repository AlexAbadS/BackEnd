-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-01-2019 a las 12:16:45
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `id_doblaje` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `contenido` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doblaje`
--

CREATE TABLE `doblaje` (
  `id_doblaje` int(11) NOT NULL,
  `titulo` varchar(30) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idpelicula` int(11) DEFAULT NULL,
  `audio` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes_comentario`
--

CREATE TABLE `likes_comentario` (
  `id_comentario` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `idpelicula` int(11) NOT NULL,
  `nombre_pelicula` varchar(30) NOT NULL,
  `director` varchar(50) DEFAULT NULL,
  `pais` varchar(30) DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  `fecha_estreno` date DEFAULT NULL,
  `productora` varchar(30) DEFAULT NULL,
  `genero` varchar(30) DEFAULT NULL,
  `imagen` varchar(500) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `passw` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` varchar(9) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `foto_usuario` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre_usuario`, `passw`, `email`, `nombre`, `apellido`, `direccion`, `telefono`, `fecha_nac`, `foto_usuario`) VALUES
(1, 'Juan777', '1234', 'mario@gmail.com', 'juan', 'Juan', 'calle walllaby', '123456789', '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion_doblaje`
--

CREATE TABLE `valoracion_doblaje` (
  `puntuacion` int(2) DEFAULT NULL,
  `id_doblaje` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fk_id_usu2` (`id_usuario`),
  ADD KEY `fk_id_doblaje` (`id_doblaje`);

--
-- Indices de la tabla `doblaje`
--
ALTER TABLE `doblaje`
  ADD PRIMARY KEY (`id_doblaje`),
  ADD KEY `fk_id_usu` (`idusuario`),
  ADD KEY `fk_id_peli` (`idpelicula`);

--
-- Indices de la tabla `likes_comentario`
--
ALTER TABLE `likes_comentario`
  ADD KEY `fk_id_coment` (`id_comentario`),
  ADD KEY `fk_id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`idpelicula`),
  ADD UNIQUE KEY `nombre_pelicula` (`nombre_pelicula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `valoracion_doblaje`
--
ALTER TABLE `valoracion_doblaje`
  ADD KEY `fk_id_usu3` (`id_usuario`),
  ADD KEY `fk_id_doblaje2` (`id_doblaje`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `idpelicula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_id_doblaje` FOREIGN KEY (`id_doblaje`) REFERENCES `doblaje` (`id_doblaje`),
  ADD CONSTRAINT `fk_id_usu2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`idusuario`);

--
-- Filtros para la tabla `doblaje`
--
ALTER TABLE `doblaje`
  ADD CONSTRAINT `fk_id_peli` FOREIGN KEY (`idpelicula`) REFERENCES `pelicula` (`idpelicula`),
  ADD CONSTRAINT `fk_id_usu` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`);

--
-- Filtros para la tabla `likes_comentario`
--
ALTER TABLE `likes_comentario`
  ADD CONSTRAINT `fk_id_coment` FOREIGN KEY (`id_comentario`) REFERENCES `comentario` (`id_comentario`),
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`idusuario`);

--
-- Filtros para la tabla `valoracion_doblaje`
--
ALTER TABLE `valoracion_doblaje`
  ADD CONSTRAINT `fk_id_doblaje2` FOREIGN KEY (`id_doblaje`) REFERENCES `doblaje` (`id_doblaje`),
  ADD CONSTRAINT `fk_id_usu3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`idusuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
