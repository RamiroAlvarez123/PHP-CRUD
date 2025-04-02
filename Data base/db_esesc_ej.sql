-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2025 a las 20:45:13
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
-- Base de datos: `db_esesc_ej`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aspirantes`
--

CREATE TABLE `aspirantes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` int(15) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` enum('Masculino','Femenino','Otro') NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aspirantes`
--

INSERT INTO `aspirantes` (`id`, `nombre`, `apellido`, `dni`, `fecha_nacimiento`, `sexo`, `telefono`, `imagen`) VALUES
(32, 'Rodolfos', 'Pérezz', 12346678, '1990-05-10', 'Otro', '1122334455', 'imagenes/32.jpg'),
(33, 'María', 'Gómez', 87654321, '1995-09-15', 'Femenino', '2233445566', 'imagenes/defaultimg.jpg'),
(34, 'Carlos', 'López', 23456789, '1988-02-20', 'Masculino', '3344556677', 'imagenes/34.jpg'),
(41, 'Sofía', 'Hernández', 90123456, '1991-03-12', 'Femenino', '1001122334', 'imagenes/41.jpg'),
(42, 'Fernando', 'Mendoza', 91234567, '1994-10-05', 'Masculino', '1112233445', 'imagenes/defaultimg.jpg'),
(43, 'Camila', 'Ortega', 92345678, '2001-01-20', 'Femenino', '1223344556', 'imagenes/defaultimg.jpg'),
(44, 'Javier', 'Silva', 93456789, '1989-05-25', 'Masculino', '1334455667', 'imagenes/defaultimg.jpg'),
(45, 'Natalia', 'Vega', 94567890, '1996-09-10', 'Femenino', '1445566778', 'imagenes/defaultimg.jpg'),
(46, 'Emiliano', 'Castro', 95678901, '1993-07-14', 'Masculino', '1556677889', 'imagenes/defaultimg.jpg'),
(47, 'Juan', 'Gomez', 12435445, '2025-04-03', 'Femenino', '1121423563', 'imagenes/defaultimg.jpg'),
(48, 'Ramiro', 'Alvarez', 46688229, '2025-06-06', 'Otro', '1121824759', 'imagenes/defaultimg.jpg'),
(51, 'Ludmila', 'Sisi', 45677511, '2025-04-11', 'Femenino', '53265256', 'imagenes/defaultimg.jpg'),
(53, 'Enzo', 'Burgos', 46667765, '2005-11-11', 'Masculino', '1121324437', 'imagenes/53.jpg'),
(54, 'Lautaro', 'Jadga', 45776983, '2025-04-05', 'Masculino', '1143445977', 'imagenes/defaultimg.jpg'),
(55, 'María', 'Castro', 45678912, '2025-04-13', 'Femenino', '4455667788', 'imagenes/defaultimg.jpg'),
(56, 'Ana', 'Suárez', 25874169, '2025-04-12', 'Masculino', '7788990011', 'imagenes/56.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `privilegio` enum('visualizar','cargar','editar-eliminar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `privilegio`) VALUES
(1, 'ramiro', 'rami123', 'editar-eliminar'),
(2, 'usuariovista', 'usuariovista123', 'visualizar'),
(3, 'usuariocargar', 'usuariocargar123', 'cargar'),
(4, 'rama', '123', 'visualizar'),
(5, 'juan123', 'juan1234567', 'visualizar'),
(6, 'rodrigoo', 'rodrigoo!!2345', 'cargar'),
(7, 'sofia123!!', 'sofia321!!!', 'editar-eliminar');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aspirantes`
--
ALTER TABLE `aspirantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aspirantes`
--
ALTER TABLE `aspirantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
