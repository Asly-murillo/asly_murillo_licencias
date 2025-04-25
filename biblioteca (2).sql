-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2025 a las 16:32:32
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
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE `autor` (
  `id_autor` int(11) NOT NULL,
  `autor` text NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`id_autor`, `autor`, `id_categoria`) VALUES
(1, 'Gabriel Garcia Marquez', 1),
(2, 'Suzanne Collins', 4),
(3, 'Isabel Allende', 1),
(4, 'Julio Verne', 2),
(5, 'J.K. Rowling', 6),
(6, 'Stephen King', 5),
(7, 'George Orwell', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bibliotecas`
--

CREATE TABLE `bibliotecas` (
  `nit_biblioteca` int(11) NOT NULL,
  `nom_biblioteca` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bibliotecas`
--

INSERT INTO `bibliotecas` (`nit_biblioteca`, `nom_biblioteca`) VALUES
(700456789, 'Biblioteca Universitaria'),
(800987654, 'Biblioteca Municipal'),
(900123456, 'Biblioteca Nacional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(1, 'Novela'),
(2, 'Aventura'),
(3, 'Drama'),
(4, 'Ciencia Ficcion'),
(5, 'Terror'),
(6, 'Fantasia'),
(7, 'Politica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_prestamo_libro`
--

CREATE TABLE `detalle_prestamo_libro` (
  `id_detalle_prestamo` int(11) NOT NULL,
  `id_prestamo` int(11) DEFAULT NULL,
  `id_libro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `id_editorial` int(11) NOT NULL,
  `editorial` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`id_editorial`, `editorial`) VALUES
(1, 'Planeta'),
(2, 'RBA'),
(3, 'Alfaguara'),
(4, 'HarperCollins'),
(5, 'Ediciones B'),
(6, 'Bloomsbury Publishing');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `estado`) VALUES
(1, 'activo'),
(2, 'inactivo'),
(3, 'bloqueado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_libro`
--

CREATE TABLE `estado_libro` (
  `id_estado_libro` int(11) NOT NULL,
  `estado_libro` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_libro`
--

INSERT INTO `estado_libro` (`id_estado_libro`, `estado_libro`) VALUES
(1, 'prestado'),
(2, 'devuelto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL,
  `cod_barras` varchar(200) DEFAULT NULL,
  `nom_libro` varchar(250) NOT NULL,
  `autor` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `editorial` int(11) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `cod_barras`, `nom_libro`, `autor`, `categoria`, `editorial`, `fecha_publicacion`, `cantidad`, `imagen`) VALUES
(1, NULL, 'Cien años de soledad', 1, 1, 1, '1967-05-30', 9, 'http://localhost/biblioteca/img/libros/cien_anios.jpeg'),
(2, NULL, 'La ciudad de las bestias', 3, 3, 3, '2002-02-01', 5, 'http://localhost/biblioteca/img/libros/la_ciudad_de_las_bestias.jpeg'),
(3, NULL, 'Los juegos del hambre', 2, 4, 2, '2008-09-14', 6, 'http://localhost/biblioteca/img/libros/los-juegos-del-hambre.jpg'),
(4, NULL, 'Viaje al centro de la Tierra', 4, 2, 4, '1864-11-25', 7, ''),
(5, NULL, 'Harry Potter y la piedra filosofal', 5, 6, 6, '1997-06-26', 12, ''),
(6, NULL, 'El resplandor', 6, 5, 5, '1977-01-28', 4, ''),
(7, NULL, '1984', 7, 7, 1, '1949-06-08', 6, ''),
(8, NULL, 'It', 6, 5, 2, '1986-09-15', 2, ''),
(9, NULL, 'Animales fantasticos y donde encontrarlos', 5, 6, 6, '2001-03-01', 9, ''),
(10, NULL, 'La isla misteriosa', 4, 2, 4, '1874-01-01', 5, ''),
(12, NULL, 'Ensayo sobre la ceguera', 1, 1, 3, '1995-01-01', 6, ''),
(13, NULL, 'El amor en los tiempos del colera', 1, 1, 1, '1985-03-06', 7, ''),
(14, NULL, 'La sombra del viento', 3, 3, 2, '2001-06-06', 5, ''),
(15, NULL, 'Carrie', 6, 5, 5, '1974-04-05', 4, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencias`
--

CREATE TABLE `licencias` (
  `id_licencia` varchar(20) NOT NULL,
  `id_tipo_licencia` int(11) DEFAULT NULL,
  `nit_biblioteca` varchar(50) DEFAULT NULL,
  `fecha_adquisicion` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `licencias`
--

INSERT INTO `licencias` (`id_licencia`, `id_tipo_licencia`, `nit_biblioteca`, `fecha_adquisicion`, `fecha_fin`, `id_estado`) VALUES
('2', 2, '700456789', '2025-04-25', '2025-10-25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `doc_usuario` bigint(11) NOT NULL,
  `fe_prestamo` date NOT NULL,
  `fe_devolucion` date NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `doc_usuario`, `fe_prestamo`, `fe_devolucion`, `estado`) VALUES
(4, 12345678, '2025-04-25', '2025-05-05', 1),
(5, 12345678, '2025-04-25', '2025-05-05', 1),
(6, 12345678, '2025-04-25', '2025-05-05', 1),
(7, 12345678, '2025-04-25', '2025-05-05', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `role_id` int(11) NOT NULL,
  `rol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`role_id`, `rol`) VALUES
(1, 'administrador'),
(2, 'usuario'),
(3, 'super_admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_licencias`
--

CREATE TABLE `tipos_licencias` (
  `id_licencia` int(11) NOT NULL,
  `nom_licencia` varchar(255) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_licencias`
--

INSERT INTO `tipos_licencias` (`id_licencia`, `nom_licencia`, `valor`) VALUES
(1, 'Demo', 3),
(2, 'Licencia Estándar', 6),
(3, 'Licencia Avanzada', 12),
(4, 'Licencia Premium', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipo` int(11) NOT NULL,
  `tipo_documento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo`, `tipo_documento`) VALUES
(1, 'Cedula de ciudadania'),
(2, 'Tarjeta de identidad'),
(3, 'Pasaporte'),
(4, 'cedula extranjera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `documento` bigint(11) NOT NULL,
  `tipo_documento` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `correo` varchar(250) NOT NULL,
  `passw` varchar(500) NOT NULL,
  `telefono` int(10) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `nit_biblioteca` int(11) DEFAULT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`documento`, `tipo_documento`, `nombre`, `correo`, `passw`, `telefono`, `id_rol`, `nit_biblioteca`, `id_estado`) VALUES
(567890, 1, 'camilo montoya', 'intentodecorreoadicional@gmail.com', '$2y$10$vbYjubmRiqIqvNgk9OI4keCYqXATOssIpOuNugQXQcg7yAptYg4We', 318746747, 1, 700456789, 1),
(984567, 2, 'Dev', 'niyi@gmail.com', '$2y$10$huSRxXRbElMZNX6b9fokk.yXM7JUMuoVwNW99We8fTnmGHohqeQpm', 314765677, 2, NULL, 2),
(12345678, 1, 'daniel montealegre', 'danielito111@gmail.com', '12345678', 2147483647, 2, NULL, 1),
(1104952552, 1, 'camilo lozada', 'Asly2710@hotmail.com', '$2y$10$yieUCnVZcJ8A4uA1Rz7fuOEDH6jNGV6zzal8Ed6H3hskmVjIIgkNK', 312578768, 3, NULL, 1),
(1107977681, 1, 'Aleja duarte', 'Alejandrad2710@gmail.com', '12345678', 324565676, 1, NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id_autor`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `bibliotecas`
--
ALTER TABLE `bibliotecas`
  ADD PRIMARY KEY (`nit_biblioteca`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalle_prestamo_libro`
--
ALTER TABLE `detalle_prestamo_libro`
  ADD PRIMARY KEY (`id_detalle_prestamo`),
  ADD KEY `id_prestamo` (`id_prestamo`),
  ADD KEY `id_libro` (`id_libro`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`id_editorial`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `estado_libro`
--
ALTER TABLE `estado_libro`
  ADD PRIMARY KEY (`id_estado_libro`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`),
  ADD KEY `categoria` (`categoria`),
  ADD KEY `editorial` (`editorial`),
  ADD KEY `autor` (`autor`);

--
-- Indices de la tabla `licencias`
--
ALTER TABLE `licencias`
  ADD PRIMARY KEY (`id_licencia`),
  ADD KEY `id_tipo_licencia` (`id_tipo_licencia`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `prestamos_ibfk_1` (`estado`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`role_id`);

--
-- Indices de la tabla `tipos_licencias`
--
ALTER TABLE `tipos_licencias`
  ADD PRIMARY KEY (`id_licencia`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`documento`),
  ADD KEY `tipo_documento` (`tipo_documento`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `nit_biblioteca` (`nit_biblioteca`),
  ADD KEY `id_estado` (`id_estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autor`
--
ALTER TABLE `autor`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_prestamo_libro`
--
ALTER TABLE `detalle_prestamo_libro`
  MODIFY `id_detalle_prestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `id_editorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estado_libro`
--
ALTER TABLE `estado_libro`
  MODIFY `id_estado_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_licencias`
--
ALTER TABLE `tipos_licencias`
  MODIFY `id_licencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autor`
--
ALTER TABLE `autor`
  ADD CONSTRAINT `autor_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `detalle_prestamo_libro`
--
ALTER TABLE `detalle_prestamo_libro`
  ADD CONSTRAINT `detalle_prestamo_libro_ibfk_1` FOREIGN KEY (`id_prestamo`) REFERENCES `prestamos` (`id_prestamo`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_prestamo_libro_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE CASCADE;

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`editorial`) REFERENCES `editorial` (`id_editorial`),
  ADD CONSTRAINT `libros_ibfk_3` FOREIGN KEY (`autor`) REFERENCES `autor` (`id_autor`);

--
-- Filtros para la tabla `licencias`
--
ALTER TABLE `licencias`
  ADD CONSTRAINT `licencias_ibfk_1` FOREIGN KEY (`id_tipo_licencia`) REFERENCES `tipos_licencias` (`id_licencia`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estado_libro` (`id_estado_libro`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipo_documento`) REFERENCES `tipo_documento` (`id_tipo`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`role_id`),
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`nit_biblioteca`) REFERENCES `bibliotecas` (`nit_biblioteca`),
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
