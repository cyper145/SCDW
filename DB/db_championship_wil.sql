-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2015 a las 22:02:59
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_championship_wil`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tadministrador`
--

CREATE TABLE IF NOT EXISTS `tadministrador` (
  `idadministrador` int(11) NOT NULL,
  `coddocente` varchar(5) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idadministrador`),
  KEY `fk_tadministrador_tdocente1_idx` (`coddocente`),
  KEY `fk_tadministrador_tusuarios1_idx` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tadministrador`
--

INSERT INTO `tadministrador` (`idadministrador`, `coddocente`, `idusuario`) VALUES
(0, '16563', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tagenda`
--

CREATE TABLE IF NOT EXISTS `tagenda` (
  `nroagenda` int(4) NOT NULL AUTO_INCREMENT,
  `tema` varchar(80) NOT NULL,
  `idreunion` int(4) NOT NULL,
  PRIMARY KEY (`nroagenda`,`idreunion`),
  KEY `idreunion` (`idreunion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarbitro`
--

CREATE TABLE IF NOT EXISTS `tarbitro` (
  `dni` varchar(8) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `Apellidos` varchar(60) NOT NULL,
  `edad` int(2) NOT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarbitro`
--

INSERT INTO `tarbitro` (`dni`, `nombre`, `Apellidos`, `edad`) VALUES
('19375893', 'Ramiro', 'lucas de la Cruz', 33),
('25463758', 'Roberto', 'Lopez Mengano', 33),
('39238749', 'Jhon', 'Casas Lopez', 0),
('39578375', 'Pedro', 'Torres Nina', 32),
('76543825', 'Juan', 'Peres Cruz', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarbitroxpartido`
--

CREATE TABLE IF NOT EXISTS `tarbitroxpartido` (
  `idarbitroporpartido` int(4) NOT NULL AUTO_INCREMENT,
  `principal` varchar(8) NOT NULL,
  `asistente1` varchar(8) NOT NULL,
  `asistente2` varchar(8) NOT NULL,
  PRIMARY KEY (`idarbitroporpartido`,`principal`,`asistente1`,`asistente2`),
  KEY `principal` (`principal`),
  KEY `asistente1` (`asistente1`),
  KEY `asistente2` (`asistente2`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tarbitroxpartido`
--

INSERT INTO `tarbitroxpartido` (`idarbitroporpartido`, `principal`, `asistente1`, `asistente2`) VALUES
(1, '19375893', '39238749', '39238749'),
(2, '39578375', '39578375', '76543825');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasistente`
--

CREATE TABLE IF NOT EXISTS `tasistente` (
  `idasistente` int(4) NOT NULL AUTO_INCREMENT,
  `coddocente` varchar(8) NOT NULL,
  `idreunion` int(4) NOT NULL,
  PRIMARY KEY (`idasistente`,`coddocente`,`idreunion`),
  KEY `coddocente` (`coddocente`),
  KEY `idreunion` (`idreunion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcampeonato`
--

CREATE TABLE IF NOT EXISTS `tcampeonato` (
  `codcampeonato` varchar(8) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `anioacademico` varchar(7) NOT NULL,
  `fechacreacion` date NOT NULL,
  `reglamento` varchar(100) DEFAULT NULL,
  `estado` enum('habilitado','desabilitado') NOT NULL DEFAULT 'habilitado',
  `idcom_orgdor` int(11) NOT NULL,
  PRIMARY KEY (`codcampeonato`,`idcom_orgdor`),
  KEY `fk_tcampeonato_tcom_orgdor1_idx` (`idcom_orgdor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tcampeonato`
--

INSERT INTO `tcampeonato` (`codcampeonato`, `nombre`, `anioacademico`, `fechacreacion`, `reglamento`, `estado`, `idcom_orgdor`) VALUES
('C001', 'InterDocentes 2015-II', '2015-II', '0000-00-00', 'no hay reglamento\r\n', 'habilitado', 1),
('camp01', 'campionato apertura', '2015', '2015-11-02', 'no hay reglamento', 'habilitado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcom_orgdor`
--

CREATE TABLE IF NOT EXISTS `tcom_orgdor` (
  `idcom_orgdor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`idcom_orgdor`,`idusuario`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tcom_orgdor`
--

INSERT INTO `tcom_orgdor` (`idcom_orgdor`, `nombre`, `idusuario`) VALUES
(1, 'Departamento academico de informatico', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tconclusion`
--

CREATE TABLE IF NOT EXISTS `tconclusion` (
  `nroconclusion` int(4) NOT NULL AUTO_INCREMENT,
  `conclusion` varchar(120) NOT NULL,
  `nroagenda` int(4) NOT NULL,
  PRIMARY KEY (`nroconclusion`,`nroagenda`),
  KEY `nroagenda` (`nroagenda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcronograma`
--

CREATE TABLE IF NOT EXISTS `tcronograma` (
  `nroactividad` int(4) NOT NULL AUTO_INCREMENT,
  `actividad` varchar(80) NOT NULL,
  `fechainicio` datetime NOT NULL,
  `fechafin` datetime NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `codcampeonato` varchar(8) NOT NULL,
  PRIMARY KEY (`nroactividad`,`codcampeonato`),
  KEY `codcampeonato` (`codcampeonato`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdocente`
--

CREATE TABLE IF NOT EXISTS `tdocente` (
  `coddocente` varchar(5) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellidopaterno` varchar(25) NOT NULL,
  `apellidomaterno` varchar(25) NOT NULL,
  `categoria` enum('nombrado','contratado') NOT NULL DEFAULT 'nombrado',
  `dni` int(8) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `email` varchar(45) NOT NULL,
  `edad` int(2) NOT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `coddptoacademico` varchar(10) NOT NULL,
  PRIMARY KEY (`coddocente`,`coddptoacademico`),
  KEY `coddptoacademico` (`coddptoacademico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tdocente`
--

INSERT INTO `tdocente` (`coddocente`, `nombre`, `apellidopaterno`, `apellidomaterno`, `categoria`, `dni`, `direccion`, `email`, `edad`, `telefono`, `coddptoacademico`) VALUES
('14769', 'Roberto', 'Alzamora', 'Paredes', 'nombrado', 45678391, 'Av. los incas 245', 'alzamora@gmail.com', 31, '276548', 'DAI'),
('14995', 'Rony', 'Villafuerte', 'Serna', 'nombrado', 48234567, 'A. El Sol 204', 'rony@gmail.com', 32, '275469', 'DAI'),
('16563', 'Luis Beltran', 'Palma', 'Ttito', 'nombrado', 48325673, 'Av. La Cultura 1045', 'palma@hotmail.com', 35, '273546', 'DAI'),
('28308', 'Lino', 'Presiliano', 'Duran', 'nombrado', 48652375, 'AV. la Cultura', 'lino@hotmail.com', 40, '973123513', 'DAI'),
('99999', 'William', 'Zamalloa', 'Paro', 'nombrado', 23845764, 'PJ. Miraflores San Jeronimo', 'william.zamalloa@unsaac.edu.pe', 35, '293485793', 'DAI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdptoacademico`
--

CREATE TABLE IF NOT EXISTS `tdptoacademico` (
  `coddptoacademico` varchar(10) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `carrera` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`coddptoacademico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tdptoacademico`
--

INSERT INTO `tdptoacademico` (`coddptoacademico`, `nombre`, `carrera`) VALUES
('ADM', 'Departamento Academico de Administracion', 'Ciencias Administrativas y Financieras'),
('DAI', 'Departamento academico de infromatica', 'escuela profesional de infromatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tegreso`
--

CREATE TABLE IF NOT EXISTS `tegreso` (
  `idegreso` int(4) NOT NULL AUTO_INCREMENT,
  `nromovimiento` int(4) NOT NULL,
  PRIMARY KEY (`idegreso`,`nromovimiento`),
  KEY `nromovimiento` (`nromovimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tequipo`
--

CREATE TABLE IF NOT EXISTS `tequipo` (
  `codequipo` varchar(8) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `fotouniforme` varchar(100) NOT NULL,
  `estado` enum('habilitado','desabilitado') NOT NULL,
  `codcampeonato` varchar(8) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`codequipo`,`codcampeonato`,`idusuario`),
  KEY `codcampeonato` (`codcampeonato`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tequipo`
--

INSERT INTO `tequipo` (`codequipo`, `nombre`, `logo`, `fotouniforme`, `estado`, `codcampeonato`, `idusuario`) VALUES
('E0002', 'LOS Adoberos', 'no hay logo', 'NOhay uniforme ', 'habilitado', 'camp01', 5),
('E1', 'Seleccion Info Corazon', 'direccion foto', 'direccion uniforme', '', 'camp01', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tequipoenpartido`
--

CREATE TABLE IF NOT EXISTS `tequipoenpartido` (
  `idequipoenpartido` int(4) NOT NULL AUTO_INCREMENT,
  `puntaje` tinyint(4) NOT NULL,
  `observacion` varchar(120) NOT NULL,
  `reclamo` varchar(120) NOT NULL,
  `codequipo` varchar(8) NOT NULL,
  `codpartido` varchar(8) NOT NULL,
  PRIMARY KEY (`idequipoenpartido`,`codequipo`,`codpartido`),
  KEY `codequipo` (`codequipo`),
  KEY `codpartido` (`codpartido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfecha`
--

CREATE TABLE IF NOT EXISTS `tfecha` (
  `nrofecha` int(4) NOT NULL AUTO_INCREMENT,
  `diadefecha` date NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `codrueda` varchar(8) NOT NULL,
  PRIMARY KEY (`nrofecha`,`codrueda`),
  KEY `codrueda` (`codrueda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tfecha`
--

INSERT INTO `tfecha` (`nrofecha`, `diadefecha`, `observaciones`, `codrueda`) VALUES
(1, '2015-11-24', 'no hay observacion', 'R0002'),
(2, '2015-11-27', 'no hay observaciones', 'R0002');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tincidencias`
--

CREATE TABLE IF NOT EXISTS `tincidencias` (
  `codincidencias` varchar(8) NOT NULL,
  `incidencias` varchar(40) NOT NULL,
  `minuto` varchar(5) NOT NULL COMMENT '00:00',
  `tipo` enum('faul','tiro libre','penal','lateral','cambio','gol','tarjeta') DEFAULT NULL,
  `detalle` varchar(80) DEFAULT NULL,
  `tipotarjeta` enum('roja','amarilla') DEFAULT NULL,
  `idjugadorenjuego1` int(4) NOT NULL,
  `idjugadorenjuego2` int(4) NOT NULL,
  PRIMARY KEY (`codincidencias`,`idjugadorenjuego1`,`idjugadorenjuego2`),
  KEY `fk_tincidencias_tjugadorenjuego1_idx` (`idjugadorenjuego1`),
  KEY `fk_tincidencias_tjugadorenjuego2_idx` (`idjugadorenjuego2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tingreso`
--

CREATE TABLE IF NOT EXISTS `tingreso` (
  `idingreso` int(4) NOT NULL AUTO_INCREMENT,
  `codequipo` varchar(8) NOT NULL,
  `nromovimiento` int(4) NOT NULL,
  PRIMARY KEY (`idingreso`,`codequipo`,`nromovimiento`),
  KEY `nromovimiento` (`nromovimiento`),
  KEY `codequipo` (`codequipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tintegrantes_c_orgdor`
--

CREATE TABLE IF NOT EXISTS `tintegrantes_c_orgdor` (
  `idtrepresentantexcomorgan` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) NOT NULL,
  `idcom_orgdor` int(11) NOT NULL,
  `coddocente` varchar(8) NOT NULL,
  PRIMARY KEY (`idtrepresentantexcomorgan`,`idcom_orgdor`,`coddocente`),
  KEY `fk_tintegrantes_c_orgdor_tcom_orgdor1_idx` (`idcom_orgdor`),
  KEY `fk_tintegrantes_c_orgdor_tdocente1_idx` (`coddocente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tintegrantes_c_orgdor`
--

INSERT INTO `tintegrantes_c_orgdor` (`idtrepresentantexcomorgan`, `rol`, `idcom_orgdor`, `coddocente`) VALUES
(1, 'presidente', 1, '14769'),
(2, 'presidente', 1, '16563'),
(3, 'secretario', 1, '14769');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tjugador`
--

CREATE TABLE IF NOT EXISTS `tjugador` (
  `dni` varchar(8) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `estado` enum('habilitado','desabilitado') NOT NULL,
  `codequipo` varchar(8) NOT NULL,
  `coddocente` varchar(8) NOT NULL,
  PRIMARY KEY (`dni`,`codequipo`,`coddocente`),
  KEY `codequipo` (`codequipo`),
  KEY `coddocente` (`coddocente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tjugador`
--

INSERT INTO `tjugador` (`dni`, `foto`, `estado`, `codequipo`, `coddocente`) VALUES
('11111112', 'sin_foto', 'habilitado', 'E1', '14769'),
('12345678', 'no hay foto', 'habilitado', 'E1', '14769'),
('87654321', 'no hay foto', 'desabilitado', 'E1', '14995'),
('87654345', 'no hay foto', 'habilitado', 'E1', '14769');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tjugadorenjuego`
--

CREATE TABLE IF NOT EXISTS `tjugadorenjuego` (
  `idjugadorenjuego` int(4) NOT NULL AUTO_INCREMENT,
  `nrocamiseta` varchar(2) NOT NULL,
  `condicionenpartido` varchar(30) NOT NULL,
  `escapitan` enum('no','si') NOT NULL DEFAULT 'no',
  `dni` varchar(8) NOT NULL,
  `codpartido` varchar(8) NOT NULL,
  PRIMARY KEY (`idjugadorenjuego`,`dni`,`codpartido`),
  KEY `fk_tjugadorenjuego_tjugador1_idx` (`dni`),
  KEY `fk_tjugadorenjuego_tpartido1_idx` (`codpartido`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tjugadorenjuego`
--

INSERT INTO `tjugadorenjuego` (`idjugadorenjuego`, `nrocamiseta`, `condicionenpartido`, `escapitan`, `dni`, `codpartido`) VALUES
(4, '20', 'defensa', 'no', '12345678', 'P001'),
(9, '32', 'delantero', 'no', '11111112', 'P001'),
(10, '3', 'medio campo', 'si', '12345678', 'P001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmiembrocomjusticia`
--

CREATE TABLE IF NOT EXISTS `tmiembrocomjusticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(20) NOT NULL,
  `codcampeonato` varchar(8) NOT NULL,
  `coddocente` varchar(5) NOT NULL,
  PRIMARY KEY (`id`,`codcampeonato`,`coddocente`),
  KEY `fk_tmiembrocomjusticia_tcampeonato1` (`codcampeonato`),
  KEY `fk_tmiembrocomjusticia_tdocente1` (`coddocente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12345682 ;

--
-- Volcado de datos para la tabla `tmiembrocomjusticia`
--

INSERT INTO `tmiembrocomjusticia` (`id`, `rol`, `codcampeonato`, `coddocente`) VALUES
(12345678, 'presidente', 'C001', '16563'),
(12345679, 'secretario', 'camp01', '16563'),
(12345680, 'vocal', 'camp01', '14995'),
(12345681, 'Presitente', 'C001', '99999');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmovimiento`
--

CREATE TABLE IF NOT EXISTS `tmovimiento` (
  `nromovimiento` int(4) NOT NULL AUTO_INCREMENT,
  `tipo` enum('ingreso','egreso') NOT NULL COMMENT 'ingreso/egreso',
  `montototal` float NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL,
  `idcom_orgdor` int(11) NOT NULL,
  PRIMARY KEY (`nromovimiento`,`idcom_orgdor`),
  KEY `fk_tmovimiento_tcom_orgdor1_idx` (`idcom_orgdor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpartido`
--

CREATE TABLE IF NOT EXISTS `tpartido` (
  `codpartido` varchar(8) NOT NULL,
  `horainicio` varchar(5) NOT NULL COMMENT '00:00',
  `horafin` varchar(5) NOT NULL COMMENT '00:00',
  `tipopartido` varchar(20) NOT NULL,
  `observacion` varchar(50) NOT NULL,
  `codprogramacion` varchar(8) NOT NULL,
  `idarbitroporpartido` int(4) NOT NULL,
  PRIMARY KEY (`codpartido`,`idarbitroporpartido`,`codprogramacion`),
  KEY `idarbitroporpartido` (`idarbitroporpartido`),
  KEY `codprogramacion` (`codprogramacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tpartido`
--

INSERT INTO `tpartido` (`codpartido`, `horainicio`, `horafin`, `tipopartido`, `observacion`, `codprogramacion`, `idarbitroporpartido`) VALUES
('P001', '7:00 ', '9:00 ', 'aminstoso', 'no hay observaciones', 'Pro001', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tprogramacionpartido`
--

CREATE TABLE IF NOT EXISTS `tprogramacionpartido` (
  `codprogramacion` varchar(8) NOT NULL,
  `diadepartido` date NOT NULL,
  `nropartido` varchar(2) NOT NULL,
  `nrofecha` int(4) NOT NULL,
  `lugar` varchar(45) NOT NULL,
  `equipo1` varchar(8) NOT NULL,
  `equipo2` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`codprogramacion`,`nrofecha`),
  KEY `nrofecha` (`nrofecha`),
  KEY `equipo1` (`equipo1`),
  KEY `equipo2` (`equipo2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tprogramacionpartido`
--

INSERT INTO `tprogramacionpartido` (`codprogramacion`, `diadepartido`, `nropartido`, `nrofecha`, `lugar`, `equipo1`, `equipo2`) VALUES
('Pro001', '2015-11-28', '1', 2, 'estadio univesitario', 'E1', 'E0002');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `treunion`
--

CREATE TABLE IF NOT EXISTS `treunion` (
  `idreunion` int(4) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `nrofecha` int(4) NOT NULL,
  PRIMARY KEY (`idreunion`,`nrofecha`),
  KEY `nrofecha` (`nrofecha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trueda`
--

CREATE TABLE IF NOT EXISTS `trueda` (
  `codrueda` varchar(8) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fechacreacion` date NOT NULL,
  `codcampeonato` varchar(8) NOT NULL,
  PRIMARY KEY (`codrueda`,`codcampeonato`),
  KEY `codcampeonato` (`codcampeonato`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trueda`
--

INSERT INTO `trueda` (`codrueda`, `nombre`, `fechacreacion`, `codcampeonato`) VALUES
('R0002', 'Primera Rueda', '2015-11-21', 'camp01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsancion`
--

CREATE TABLE IF NOT EXISTS `tsancion` (
  `idsancion` int(4) NOT NULL AUTO_INCREMENT,
  `tiposancion` varchar(30) NOT NULL COMMENT 'perdida puntos/multa',
  `nroconclusion` int(4) NOT NULL,
  `idjugadorenjuego` int(4) NOT NULL,
  `idequipoenpartido` int(4) NOT NULL,
  PRIMARY KEY (`idsancion`,`idequipoenpartido`,`nroconclusion`,`idjugadorenjuego`),
  KEY `nroconclusion` (`nroconclusion`),
  KEY `idjugadorenjuego` (`idjugadorenjuego`),
  KEY `idequipoenpartido` (`idequipoenpartido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuarios`
--

CREATE TABLE IF NOT EXISTS `tusuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` enum('administrador','comision_organizadora','equipo') NOT NULL,
  `estado` enum('activo','desactivo','bloqueado') NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `tusuarios`
--

INSERT INTO `tusuarios` (`idusuario`, `username`, `password`, `tipo`, `estado`) VALUES
(5, 'EquipoCivil', '$2y$10$YHG3LeO.nI79Bq2mZC.Riev0pGn3w3cDHlPua8x94NA.P6cOhkosq', 'equipo', 'activo'),
(23, 'admin', '$2y$10$ZJWGFU0fGoG2qNjeLCggMOPRbRW5WFPtiPgZ3OKmgo1eKmTVl8O/G', 'administrador', 'activo'),
(24, 'equipo', '$2y$10$wmuGVVsMqgOf2ZDIdHwjduIOG9CZ3lrkwhUuZu1hIgUXTsvqeRgYK', 'equipo', 'activo');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tadministrador`
--
ALTER TABLE `tadministrador`
  ADD CONSTRAINT `fk_tadministrador_tdocente1` FOREIGN KEY (`coddocente`) REFERENCES `tdocente` (`coddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tadministrador_tusuarios1` FOREIGN KEY (`idusuario`) REFERENCES `tusuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tagenda`
--
ALTER TABLE `tagenda`
  ADD CONSTRAINT `tagenda_ibfk_1` FOREIGN KEY (`idreunion`) REFERENCES `treunion` (`idreunion`);

--
-- Filtros para la tabla `tarbitroxpartido`
--
ALTER TABLE `tarbitroxpartido`
  ADD CONSTRAINT `asistente1` FOREIGN KEY (`asistente1`) REFERENCES `tarbitro` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `asistente2` FOREIGN KEY (`asistente2`) REFERENCES `tarbitro` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `principal` FOREIGN KEY (`principal`) REFERENCES `tarbitro` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tasistente`
--
ALTER TABLE `tasistente`
  ADD CONSTRAINT `tasistente_ibfk_1` FOREIGN KEY (`coddocente`) REFERENCES `tdocente` (`coddocente`),
  ADD CONSTRAINT `tasistente_ibfk_2` FOREIGN KEY (`idreunion`) REFERENCES `treunion` (`idreunion`);

--
-- Filtros para la tabla `tcampeonato`
--
ALTER TABLE `tcampeonato`
  ADD CONSTRAINT `fk_tcampeonato_tcom_orgdor1` FOREIGN KEY (`idcom_orgdor`) REFERENCES `tcom_orgdor` (`idcom_orgdor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tcom_orgdor`
--
ALTER TABLE `tcom_orgdor`
  ADD CONSTRAINT `idusuario` FOREIGN KEY (`idusuario`) REFERENCES `tusuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tconclusion`
--
ALTER TABLE `tconclusion`
  ADD CONSTRAINT `tconclusion_ibfk_1` FOREIGN KEY (`nroagenda`) REFERENCES `tagenda` (`nroagenda`);

--
-- Filtros para la tabla `tcronograma`
--
ALTER TABLE `tcronograma`
  ADD CONSTRAINT `tcronograma_ibfk_1` FOREIGN KEY (`codcampeonato`) REFERENCES `tcampeonato` (`codcampeonato`);

--
-- Filtros para la tabla `tdocente`
--
ALTER TABLE `tdocente`
  ADD CONSTRAINT `coddptoacademico` FOREIGN KEY (`coddptoacademico`) REFERENCES `tdptoacademico` (`coddptoacademico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tegreso`
--
ALTER TABLE `tegreso`
  ADD CONSTRAINT `tegreso_ibfk_1` FOREIGN KEY (`nromovimiento`) REFERENCES `tmovimiento` (`nromovimiento`);

--
-- Filtros para la tabla `tequipo`
--
ALTER TABLE `tequipo`
  ADD CONSTRAINT `fk_tequipo_tusuarios1` FOREIGN KEY (`idusuario`) REFERENCES `tusuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tequipo_ibfk_1` FOREIGN KEY (`codcampeonato`) REFERENCES `tcampeonato` (`codcampeonato`);

--
-- Filtros para la tabla `tequipoenpartido`
--
ALTER TABLE `tequipoenpartido`
  ADD CONSTRAINT `tequipoenpartido_ibfk_1` FOREIGN KEY (`codequipo`) REFERENCES `tequipo` (`codequipo`),
  ADD CONSTRAINT `tequipoenpartido_ibfk_2` FOREIGN KEY (`codpartido`) REFERENCES `tpartido` (`codpartido`);

--
-- Filtros para la tabla `tfecha`
--
ALTER TABLE `tfecha`
  ADD CONSTRAINT `tfecha_ibfk_1` FOREIGN KEY (`codrueda`) REFERENCES `trueda` (`codrueda`);

--
-- Filtros para la tabla `tincidencias`
--
ALTER TABLE `tincidencias`
  ADD CONSTRAINT `fk_tincidencias_tjugadorenjuego1` FOREIGN KEY (`idjugadorenjuego1`) REFERENCES `tjugadorenjuego` (`idjugadorenjuego`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tincidencias_tjugadorenjuego2` FOREIGN KEY (`idjugadorenjuego2`) REFERENCES `tjugadorenjuego` (`idjugadorenjuego`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tingreso`
--
ALTER TABLE `tingreso`
  ADD CONSTRAINT `tingreso_ibfk_1` FOREIGN KEY (`nromovimiento`) REFERENCES `tmovimiento` (`nromovimiento`),
  ADD CONSTRAINT `tingreso_ibfk_2` FOREIGN KEY (`codequipo`) REFERENCES `tequipo` (`codequipo`);

--
-- Filtros para la tabla `tintegrantes_c_orgdor`
--
ALTER TABLE `tintegrantes_c_orgdor`
  ADD CONSTRAINT `fk_tintegrantes_c_orgdor_tcom_orgdor1` FOREIGN KEY (`idcom_orgdor`) REFERENCES `tcom_orgdor` (`idcom_orgdor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tintegrantes_c_orgdor_tdocente1` FOREIGN KEY (`coddocente`) REFERENCES `tdocente` (`coddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tjugador`
--
ALTER TABLE `tjugador`
  ADD CONSTRAINT `tjugador_ibfk_1` FOREIGN KEY (`codequipo`) REFERENCES `tequipo` (`codequipo`),
  ADD CONSTRAINT `tjugador_ibfk_2` FOREIGN KEY (`coddocente`) REFERENCES `tdocente` (`coddocente`);

--
-- Filtros para la tabla `tjugadorenjuego`
--
ALTER TABLE `tjugadorenjuego`
  ADD CONSTRAINT `fk_tjugadorenjuego_tjugador1` FOREIGN KEY (`dni`) REFERENCES `tjugador` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tjugadorenjuego_tpartido1` FOREIGN KEY (`codpartido`) REFERENCES `tpartido` (`codpartido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tmiembrocomjusticia`
--
ALTER TABLE `tmiembrocomjusticia`
  ADD CONSTRAINT `fk_tmiembrocomjusticia_tcampeonato1` FOREIGN KEY (`codcampeonato`) REFERENCES `tcampeonato` (`codcampeonato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tmiembrocomjusticia_tdocente1` FOREIGN KEY (`coddocente`) REFERENCES `tdocente` (`coddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tmovimiento`
--
ALTER TABLE `tmovimiento`
  ADD CONSTRAINT `fk_tmovimiento_tcom_orgdor1` FOREIGN KEY (`idcom_orgdor`) REFERENCES `tcom_orgdor` (`idcom_orgdor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tpartido`
--
ALTER TABLE `tpartido`
  ADD CONSTRAINT `codprogramacion` FOREIGN KEY (`codprogramacion`) REFERENCES `tprogramacionpartido` (`codprogramacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tpartido_ibfk_1` FOREIGN KEY (`idarbitroporpartido`) REFERENCES `tarbitroxpartido` (`idarbitroporpartido`);

--
-- Filtros para la tabla `tprogramacionpartido`
--
ALTER TABLE `tprogramacionpartido`
  ADD CONSTRAINT `equipo1` FOREIGN KEY (`equipo1`) REFERENCES `tequipo` (`codequipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `equipo2` FOREIGN KEY (`equipo2`) REFERENCES `tequipo` (`codequipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `nrofecha` FOREIGN KEY (`nrofecha`) REFERENCES `tfecha` (`nrofecha`);

--
-- Filtros para la tabla `treunion`
--
ALTER TABLE `treunion`
  ADD CONSTRAINT `treunion_ibfk_1` FOREIGN KEY (`nrofecha`) REFERENCES `tfecha` (`nrofecha`);

--
-- Filtros para la tabla `trueda`
--
ALTER TABLE `trueda`
  ADD CONSTRAINT `trueda_ibfk_1` FOREIGN KEY (`codcampeonato`) REFERENCES `tcampeonato` (`codcampeonato`);

--
-- Filtros para la tabla `tsancion`
--
ALTER TABLE `tsancion`
  ADD CONSTRAINT `tsancion_ibfk_1` FOREIGN KEY (`nroconclusion`) REFERENCES `tconclusion` (`nroconclusion`),
  ADD CONSTRAINT `tsancion_ibfk_2` FOREIGN KEY (`idjugadorenjuego`) REFERENCES `tjugadorenjuego` (`idjugadorenjuego`),
  ADD CONSTRAINT `tsancion_ibfk_3` FOREIGN KEY (`idequipoenpartido`) REFERENCES `tequipoenpartido` (`idequipoenpartido`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
