-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2022 a las 17:51:49
-- Versión del servidor: 10.4.22-MariaDB-log
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE `consulta` (
  `idconsulta` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `consulta`
--

INSERT INTO `consulta` (`idconsulta`, `titulo`, `descripcion`, `fecha_hora`, `id_usuario`) VALUES
(3, 'Relaciones extra institucionales del personal', 'Se refiere a la relación del personal de salu', '2020-11-08 12:20:07', 15),
(4, 'agujeros negros', 'Los agujeros negros son los restos fríos de antiguas estrellas, tan densas que ninguna partícula material, ni siquiera la luz, es capaz de escapar a su poderosa fuerza gravitatoria.\r\n\r\nMientras muchas estrellas acaban convertidas en enanas blancas o estrellas de neutrones, los agujeros negros representan la última fase en la evolución de enormes estrellas que fueron al menos de 10 a 15 veces más grandes que nuestro sol.\r\n\r\nCuando las estrellas gigantes alcanzan el estadio final de sus vidas estallan en cataclismos conocidos como supernovas. Tal explosión dispersa la mayor parte de la estrella al vacío espacial pero quedan una gran cantidad de restos «fríos» en los que no se produce la fusión.', '2020-11-08 14:04:40', 15),
(5, 'EL RENACIMIENTO ITALIANO', 'Durante la Edad Media el saber estaba estrechamente vinculado con la religión. Muy pocos, aparte de los eclesiásticos, sabían leer y escribir. En su mayor parte el saber estuvo influido por las enseñanzas de la Iglesia, las cuales raras veces eran cuestionadas.\r\n\r\nEl Renacimiento fue la época en que los hombres buscaron nuevas ideas. Muchos retornaron a las ideas de los griegos y romanos. Los grandes artistas del Renacimiento, como Leonardo de Vinci y Miguel Ángel, siguieron los ejemplos grecorromanos en sus magníficas pinturas y estatuas. Arquitectos como Bramante diseñaron edificios con columnas y arcos tomados de Grecia y Roma, respectivamente. También floreció el comercio en el Renacimiento. Una nueva clase de riqueza —la de los ricos mercaderes— apareció y estos hombres se sintieron orgullosos de sus logros. Pidieron a muchos artistas que pintaran sus retratos y los de los miembros de su familia. Con este nuevo interés por los retratos la pintura se hizo cada vez más realista.\r\n\r\n', '2020-11-08 21:08:39', 11),
(7, 'Un breve recorrido por la historia de PHP', 'Aunque generalmente solemos publicar artículos más prácticos, nunca está de más algo de teoría. Al menos, de soluciones tan conocidas y utilizadas como la que ocupa este artículo, y que se remonta casi a la prehistoria de Internet (al menos, de la Internet que conocemos hoy). A modo de anécdota para empezar, basta decir que, aunque ya casi no nos acordamos, PHP que se corresponde con las iniciales de Personal Home Page Tools y que la versión 6 jamás se liberó.\r\n\r\nPHP es un software libre, nacido en 1994 de la mano de Rasmus Lerdof, que ha ido creciendo gracias a las aportaciones de los miembros de la gran comunidad PHP, que hoy en día cuenta con un potente núcleo de lenguaje y con muchísimas librerías.\r\n\r\nInicialmente, PHP (Personal Home Page Tools) surgió como un CGI escrito en C y era capaz de interpretar una serie limitada de comandos. Pronto, muchas personas se interesaron por el sistema y solicitaron a su creador autorización para poder usarlo en sus propias páginas. Esto hizo que', '2020-11-09 06:16:02', 11),
(8, 'La montaña más alta de la Tierra', 'El volcán inactivo Mauna Kea se eleva 4.200 metros sobre el nivel del mar, lo cual lo convierte en el punto más alto del estado de Hawái, que se caracteriza por estar compuesto únicamente de islas volcánicas. En este punto el lector se preguntará: ¿por qué con tan solo 4.200 m, Mauna Kea es más alto que el Everest, que tiene 8.848 metros de altura? Pues, bien, esa es una muy buena pregunta cuya respuesta va más allá de lo obvio. De hecho, no es solo la altura de Mauna Kea lo que la hace sobresaliente respecto a sus contendores, sino los procesos geológicos que allí han ocurrido y siguen presentes.', '2020-11-09 07:07:17', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `idrespuesta` int(11) NOT NULL,
  `respuesta` varchar(100) DEFAULT NULL,
  `fecha_hora` varchar(45) DEFAULT NULL,
  `id_consulta` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`idrespuesta`, `respuesta`, `fecha_hora`, `id_consulta`, `id_usuario`) VALUES
(6, 'Muy mal amigo. Tu foro esta incompleto.', '2020-11-08 18:31:32', 3, 11),
(10, 'Muy interesante, esto me ayudará mucho para mi examen de mañana', '2020-11-09 07:17:51', 7, 17),
(11, 'Wow, que genial. ', '2020-11-09 07:20:32', 8, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `usr` varchar(45) DEFAULT NULL,
  `pwd` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `ape_pat` varchar(45) DEFAULT NULL,
  `ape_mat` varchar(45) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usr`, `pwd`, `nombre`, `ape_pat`, `ape_mat`, `is_admin`) VALUES
(11, 'Emma19', 'aafcc615b67a5a2e360fdd7b390060ee', 'Emilia', 'Diaz', 'León', 0),
(13, 'ferminator11', 'a0e2ed1866c7c13de610eeaf075c75d3', 'Fermin', 'López', 'Montañez', 1),
(15, 'LadyGaGa', '811584043b844704c9bb9a6e99dd05d3', 'Gabriela', 'Ochoa', 'Medina', 0),
(16, 'Mario666', 'eeafbf4d9b3957b139da7b7f2e7f2d4a', 'Mario', 'López', 'Ramirez', 1),
(17, 'rana2020', '52cb39fd78a403d8662e568a95e5aec2', 'Renata', 'Mendez', 'Vega', 0),
(18, 'Arcadia', '23dbf3a3354c1a3ec91b796820e57130', 'Arcadia ', 'Aguilera', 'Sanchez', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`idconsulta`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`idrespuesta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `idconsulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `idrespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
