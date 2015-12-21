-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-12-2015 a las 00:36:30
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_championship`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `encuentros`(in partido varchar(8))
begin
   
    create temporary table resumen(
        codequipo varchar(8) NOT NULL,
        idequipoenpartido int(4) NOT NULL,
        codpartido varchar(8) NOT NULL,
        nombreEquipo varchar(25) NOT NULL
        
    );
    -- inserto datos en la tabla resumen
    insert into resumen(codequipo ,idequipoenpartido, codpartido ,nombreEquipo )
        select O.codequipo,E.idequipoenpartido,P.codpartido, O.nombre
            from tequipoenpartido as E
            join tpartido as P on E.codpartidoo = P.codpartido
            join tequipo as O on E.codequipo = O.codequipo
            where P.codpartido=partido
            ;
 select * from resumen;
      drop table resumen;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listaequipo`(IN `idtorneo` INT(11))
begin
   
    create temporary table resumen(
        codequipo int(11) NOT NULL,
        nombre varchar(25) NOT NULL,
        logo varchar(100) NOT NULL
        
        
    );
    -- inserto datos en la tabla resumen
    insert into resumen(codequipo ,nombre, logo)
select E.codequipo,E.nombre, E.logo from tequipoxtorneo as p join ttorneo as O on P.idtorneo = O.idtorneo join tequipo as E on P.codequipo = E.codequipo;
 select * from resumen;
      drop table resumen;
 end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `resumen_asistente`(in pid_reunion int(4) )
begin
   
    create temporary table resumen(
        id_asistente int(4) NOT NULL,
        id_docente varchar(8) NOT NULL,
        id_reunion int(4) NOT NULL,
        nombre varchar(25) NOT NULL,
        apellidopaterno varchar(25) NOT NULL,
        apellidomaterno varchar(25) NOT NULL
        
    );
    -- inserto datos en la tabla resumen
    insert into resumen(id_asistente,id_docente ,id_reunion, nombre  ,apellidopaterno,apellidomaterno)
        select a.idasistente,d.coddocente ,r.idreunion, d.nombre  ,d.apellidopaterno,d.apellidomaterno
            from tasistente as a
            join tdocente as d on a.coddocente = d.coddocente
            join treunion as r on a.idreunion = r.idreunion
            where a.idreunion=pid_reunion;
      select * from resumen;
      drop table resumen;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `resumen_conclusion`(in pid_reunion int(4) )
begin
   
    create temporary table resumen(
        id_conclusion int(4) NOT NULL ,
        id_agenda int(4) NOT NULL,
        id_reunion int(4) NOT NULL,
        conclusion varchar(120) NOT NULL,
        fecha date NOT NULL
    
    );
    -- inserto datos en la tabla resumen
    insert into resumen(id_conclusion,id_agenda ,id_reunion , conclusion ,fecha  )
            
            select c.nroconclusion,a.nroagenda ,r.idreunion , c.conclusion ,r.fecha 
            from tconclusion as c
            join tagenda as a on c.nroagenda = a.nroagenda
            join treunion as r on a.idreunion = r.idreunion
            where r.idreunion=pid_reunion;
      select * from resumen;
      drop table resumen;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fixtureaux`
--

CREATE TABLE IF NOT EXISTS `fixtureaux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nropartido` int(11) NOT NULL,
  `equipo1` int(11) DEFAULT NULL,
  `equipo2` int(11) DEFAULT NULL,
  `idfecha` int(11) NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

--
-- Volcado de datos para la tabla `fixtureaux`
--

INSERT INTO `fixtureaux` (`id`, `nropartido`, `equipo1`, `equipo2`, `idfecha`, `hora`) VALUES
(14, 2, 0, 1, 1, '00:00:00'),
(16, 4, 3, 0, 2, '00:00:00'),
(17, 5, 2, 0, 3, '00:00:00'),
(19, 2, 0, 2, 1, '00:00:00'),
(21, 4, 1, 0, 2, '00:00:00'),
(22, 5, 3, 0, 3, '00:00:00'),
(25, 2, 0, 2, 1, '00:00:00'),
(27, 4, 3, 0, 2, '00:00:00'),
(28, 5, 1, 0, 3, '00:00:00'),
(31, 2, 0, 3, 1, '00:00:00'),
(33, 4, 1, 0, 2, '00:00:00'),
(34, 5, 2, 0, 3, '00:00:00'),
(36, 2, 0, 1, 1, '00:00:00'),
(38, 4, 3, 0, 2, '00:00:00'),
(39, 5, 2, 0, 3, '00:00:00'),
(42, 2, 0, 3, 1, '00:00:00'),
(44, 4, 1, 0, 2, '00:00:00'),
(45, 5, 2, 0, 3, '00:00:00'),
(48, 2, 0, 2, 1, '00:00:00'),
(50, 4, 1, 0, 2, '00:00:00'),
(51, 5, 3, 0, 3, '00:00:00'),
(53, 1, 1, 0, 1, '00:00:00'),
(54, 1, 1, 0, 1, '00:00:00'),
(55, 1, 1, 0, 1, '00:00:00'),
(56, 1, 1, 0, 1, '00:00:00'),
(57, 1, 1, 0, 1, '00:00:00'),
(58, 1, 1, 0, 1, '00:00:00'),
(59, 1, 1, 0, 1, '00:00:00'),
(60, 1, 1, 0, 1, '00:00:00'),
(61, 1, 1, 0, 1, '00:00:00'),
(62, 1, 1, 0, 1, '00:00:00'),
(63, 1, 1, 0, 1, '00:00:00'),
(64, 1, 1, 0, 1, '00:00:00'),
(65, 1, 1, 0, 1, '00:00:00'),
(66, 1, 1, 0, 1, '00:00:00'),
(67, 1, 1, 0, 1, '00:00:00'),
(68, 1, 1, 0, 1, '00:00:00'),
(69, 1, 1, 0, 1, '00:00:00'),
(70, 1, 1, 0, 1, '00:00:00'),
(71, 1, 1, 0, 1, '00:00:00'),
(72, 1, 1, 0, 1, '00:00:00'),
(73, 1, 1, 0, 1, '00:00:00'),
(74, 1, 1, 0, 1, '00:00:00'),
(75, 1, 1, 0, 1, '00:00:00'),
(76, 1, 1, 0, 1, '00:00:00'),
(77, 1, 1, 0, 1, '00:00:00'),
(78, 1, 1, 0, 1, '00:00:00'),
(79, 1, 1, 0, 1, '00:00:00'),
(80, 1, 1, 0, 1, '00:00:00'),
(81, 1, 1, 0, 1, '00:00:00'),
(82, 1, 1, 0, 1, '00:00:00'),
(83, 1, 1, 0, 1, '00:00:00'),
(84, 1, 1, 0, 1, '00:00:00'),
(85, 1, 1, 0, 1, '00:00:00'),
(86, 1, 1, 0, 1, '00:00:00'),
(87, 1, 1, 0, 1, '00:00:00'),
(88, 1, 1, 0, 1, '00:00:00'),
(89, 1, 1, 0, 1, '00:00:00'),
(90, 1, 1, 0, 1, '00:00:00'),
(91, 1, 1, 0, 1, '00:00:00'),
(92, 1, 1, 0, 1, '00:00:00'),
(93, 1, 1, 0, 1, '00:00:00'),
(94, 1, 1, 0, 1, '00:00:00'),
(95, 1, 1, 0, 1, '00:00:00'),
(96, 1, 1, 0, 1, '00:00:00'),
(97, 1, 1, 0, 1, '00:00:00'),
(98, 1, 1, 0, 1, '00:00:00'),
(99, 1, 1, 0, 1, '00:00:00'),
(100, 1, 1, 0, 1, '00:00:00'),
(101, 1, 1, 0, 1, '00:00:00'),
(102, 1, 1, 0, 1, '00:00:00'),
(103, 1, 1, 0, 1, '00:00:00'),
(104, 1, 1, 0, 1, '00:00:00'),
(105, 1, 1, 0, 1, '00:00:00'),
(106, 1, 1, 0, 1, '00:00:00'),
(107, 1, 1, 0, 1, '00:00:00'),
(108, 1, 1, 0, 1, '00:00:00'),
(109, 1, 1, 0, 1, '00:00:00'),
(110, 1, 1, 0, 1, '00:00:00'),
(111, 1, 1, 0, 1, '00:00:00'),
(112, 1, 1, 0, 1, '00:00:00'),
(113, 1, 1, 0, 1, '00:00:00'),
(114, 1, 1, 0, 1, '00:00:00'),
(115, 1, 1, 0, 1, '00:00:00'),
(116, 1, 1, 0, 1, '00:00:00'),
(117, 1, 1, 0, 1, '00:00:00'),
(118, 1, 1, 0, 1, '00:00:00'),
(119, 1, 1, 0, 1, '00:00:00'),
(120, 1, 1, 0, 1, '00:00:00'),
(121, 1, 1, 0, 1, '00:00:00'),
(122, 1, 1, 0, 1, '00:00:00'),
(123, 1, 1, 0, 1, '00:00:00'),
(124, 1, 1, 0, 1, '00:00:00'),
(125, 1, 1, 0, 1, '00:00:00'),
(126, 1, 1, 0, 1, '00:00:00'),
(127, 1, 1, 0, 1, '00:00:00'),
(128, 1, 1, 0, 1, '00:00:00'),
(129, 1, 1, 0, 1, '00:00:00'),
(130, 1, 1, 0, 1, '00:00:00'),
(131, 1, 1, 0, 1, '00:00:00'),
(132, 1, 1, 0, 1, '00:00:00'),
(133, 1, 1, 0, 1, '00:00:00'),
(134, 1, 1, 0, 1, '00:00:00'),
(135, 1, 1, 0, 1, '00:00:00'),
(136, 1, 1, 0, 1, '00:00:00'),
(137, 1, 1, 0, 1, '00:00:00'),
(138, 1, 1, 0, 1, '00:00:00'),
(139, 1, 1, 0, 1, '00:00:00'),
(140, 1, 1, 0, 1, '00:00:00'),
(141, 1, 1, 0, 1, '00:00:00'),
(142, 1, 1, 0, 1, '00:00:00'),
(143, 1, 1, 0, 1, '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tactividad`
--

CREATE TABLE IF NOT EXISTS `tactividad` (
  `nroactividad` int(4) NOT NULL AUTO_INCREMENT,
  `actividad` varchar(80) NOT NULL,
  `fechainicio` datetime NOT NULL,
  `fechafin` datetime NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  `codcampeonato` varchar(8) NOT NULL,
  PRIMARY KEY (`nroactividad`,`codcampeonato`),
  KEY `codcampeonato` (`codcampeonato`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tactividad`
--

INSERT INTO `tactividad` (`nroactividad`, `actividad`, `fechainicio`, `fechafin`, `observaciones`, `codcampeonato`) VALUES
(1, 'inicio del campeonato', '2015-12-21 00:00:00', '2015-12-22 00:00:00', 'no hay obs', '1'),
(2, 'test de wilson', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'no hay obserbacines ', '1'),
(3, 'limite inscriones', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pasada esta fecha no habra mas inscripciones', '1'),
(4, 'tentativa de apertura', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '1'),
(5, 'tentativa de clausura', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '1');

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
(0, '09318', 4);

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
('29348750', 'carlos ', 'rodrigues calvo', 29),
('49872903', 'jose', 'ramos espinoza', 31);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tarbitroxpartido`
--

INSERT INTO `tarbitroxpartido` (`idarbitroporpartido`, `principal`, `asistente1`, `asistente2`) VALUES
(1, '29348750', '29348750', '49872903'),
(2, '29348750', '29348750', '49872903'),
(6, '29348750', '29348750', '29348750'),
(9, '29348750', '29348750', '29348750'),
(10, '29348750', '49872903', '29348750'),
(5, '49872903', '29348750', '29348750'),
(7, '49872903', '49872903', '49872903'),
(8, '49872903', '49872903', '49872903');

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
-- Estructura de tabla para la tabla `tcambio`
--

CREATE TABLE IF NOT EXISTS `tcambio` (
  `idcambio` int(11) NOT NULL AUTO_INCREMENT,
  `minuto` int(2) DEFAULT NULL,
  `idjugadorenjuegosaliente` int(4) NOT NULL,
  `idjugadorenjuegoentrante` int(4) NOT NULL,
  PRIMARY KEY (`idcambio`,`idjugadorenjuegosaliente`,`idjugadorenjuegoentrante`),
  KEY `idjugadorenjuegosaliente` (`idjugadorenjuegosaliente`),
  KEY `idjugadorenjuegoentrante` (`idjugadorenjuegoentrante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcampeonato`
--

CREATE TABLE IF NOT EXISTS `tcampeonato` (
  `codcampeonato` varchar(8) NOT NULL,
  `nombre` varchar(150) NOT NULL,
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
('1', 'I CAMPEONATO DE FUTBOL INTERDOCENTES UNSAAC-2015', '2015-II', '2015-12-09', 'no hay todavia', 'habilitado', 1);

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
(1, 'Facultad de Ingenieria Electrica y Electronic', 5);

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
-- Estructura de tabla para la tabla `tconfiguracion`
--

CREATE TABLE IF NOT EXISTS `tconfiguracion` (
  `idconfiguracion` int(4) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `valor` int(4) NOT NULL,
  `codcampeonato` varchar(8) NOT NULL,
  PRIMARY KEY (`idconfiguracion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `tconfiguracion`
--

INSERT INTO `tconfiguracion` (`idconfiguracion`, `descripcion`, `valor`, `codcampeonato`) VALUES
(2, 'nro de ruedas', 2, '1'),
(3, 'maximo nro de dptacademicos por equipo', 2, '1'),
(4, 'maximo nro de lugadores libres', 2, '1'),
(5, 'duracion de tiempos', 30, '1'),
(6, 'tiempo de descanso', 5, '1'),
(7, 'maximo de juagadores menores de 25 años', 2, '1'),
(8, 'nro de ruedas', 44, '1'),
(9, 'maximo nro de dptacademicos por equipo', 44, '1'),
(10, 'maximo nro de lugadores libres', 44, '1'),
(11, 'duracion de tiempos', 44, '1'),
(12, 'tiempo de descanso', 44, '1'),
(13, 'maximo de juagadores menores de 25 años', 44, '1');

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
('09318', 'Wilson', 'Rimache', 'Suarez', 'nombrado', 48762334, 'Av. Tomas tuyrutupa 4-A San Sebastian', 'wiliko-rs@hotmail.com', 24, '992348529', 'DAI'),
('13428', 'Edwin', 'Carrasco', 'Poblete', 'nombrado', 24748759, 'Av. los nogales 447', 'carrasco@gmail.com', 39, '993487235', 'DAI'),
('14769', 'Robert', 'Alzamora', 'Paredes', 'nombrado', 25987454, 'Av. Miguel Grau 345', 'alzamora@gmail.com', 38, '923456834', 'DAI'),
('16563', 'Luis Beltran', 'Palma', 'Ttito', 'nombrado', 24879078, 'Av. ejercito 376', 'palma@unsaac.edu.pe', 39, '923845278', 'DAI'),
('16573', 'William', 'Zamalloa', 'Paro', 'contratado', 25923485, 'Av. El Sol 234', 'zamalloa@gmail.com', 34, '934875283', 'DAI');

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
('DAI', 'Departamento Academico de Informatica', 'Escuela Profesional de Ingenieria Informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tegreso`
--

CREATE TABLE IF NOT EXISTS `tegreso` (
  `idegreso` int(4) NOT NULL AUTO_INCREMENT,
  `nromovimiento` int(4) NOT NULL,
  PRIMARY KEY (`idegreso`,`nromovimiento`),
  KEY `nromovimiento` (`nromovimiento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `tegreso`
--

INSERT INTO `tegreso` (`idegreso`, `nromovimiento`) VALUES
(6, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tequipo`
--

CREATE TABLE IF NOT EXISTS `tequipo` (
  `codequipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `fotouniforme` varchar(100) NOT NULL,
  `estado` enum('habilitado','desabilitado') NOT NULL,
  `codcampeonato` varchar(8) NOT NULL,
  `idusuario` int(11) NOT NULL,
  PRIMARY KEY (`codequipo`,`codcampeonato`,`idusuario`),
  KEY `codcampeonato` (`codcampeonato`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tequipo`
--

INSERT INTO `tequipo` (`codequipo`, `nombre`, `logo`, `fotouniforme`, `estado`, `codcampeonato`, `idusuario`) VALUES
(1, 'ANDINA', '1ANDINA1.png', '1ANDINA1.jpg', 'habilitado', '1', 6),
(2, 'INFORMATICA', '2INFORMATICA1.png', '2INFORMATICA1.jpg', 'habilitado', '1', 7),
(3, 'CIVIL', '', '', 'habilitado', '1', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tequipoenpartido`
--

CREATE TABLE IF NOT EXISTS `tequipoenpartido` (
  `idequipoenpartido` int(4) NOT NULL AUTO_INCREMENT,
  `puntaje` int(4) NOT NULL,
  `observacion` varchar(120) NOT NULL,
  `reclamo` varchar(120) NOT NULL,
  `codequipo` int(11) NOT NULL,
  `codpartido` int(11) NOT NULL,
  PRIMARY KEY (`idequipoenpartido`,`codequipo`,`codpartido`),
  KEY `codequipo` (`codequipo`),
  KEY `codpartido` (`codpartido`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tequipoxtorneo`
--

CREATE TABLE IF NOT EXISTS `tequipoxtorneo` (
  `idequipoxtorneo` int(11) NOT NULL AUTO_INCREMENT,
  `codequipo` int(11) NOT NULL,
  `idtorneo` int(11) NOT NULL,
  PRIMARY KEY (`idequipoxtorneo`,`codequipo`,`idtorneo`),
  KEY `codequipo` (`codequipo`),
  KEY `idtorneo` (`idtorneo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tequipoxtorneo`
--

INSERT INTO `tequipoxtorneo` (`idequipoxtorneo`, `codequipo`, `idtorneo`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfechas`
--

CREATE TABLE IF NOT EXISTS `tfechas` (
  `idfecha` int(11) NOT NULL,
  `diafecha` date DEFAULT NULL,
  `nrofecha` int(2) DEFAULT NULL,
  `lugar` varchar(70) DEFAULT NULL,
  `idtorneo` int(11) NOT NULL,
  PRIMARY KEY (`idfecha`,`idtorneo`),
  KEY `idtorneo` (`idtorneo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tfechas`
--

INSERT INTO `tfechas` (`idfecha`, `diafecha`, `nrofecha`, `lugar`, `idtorneo`) VALUES
(1, '2015-12-18', 1, 'Estadio universitario', 1),
(1101, '0000-00-00', 1, 'nose', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfixture`
--

CREATE TABLE IF NOT EXISTS `tfixture` (
  `idfixture` int(11) NOT NULL AUTO_INCREMENT,
  `nropartido` varchar(2) NOT NULL,
  `hora` time DEFAULT NULL,
  `equipo1` int(11) NOT NULL,
  `equipo2` int(11) DEFAULT NULL,
  `idfecha` int(11) NOT NULL,
  PRIMARY KEY (`idfixture`,`idfecha`),
  KEY `equipo1` (`equipo1`),
  KEY `equipo2` (`equipo2`),
  KEY `idfecha` (`idfecha`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tfixture`
--

INSERT INTO `tfixture` (`idfixture`, `nropartido`, `hora`, `equipo1`, `equipo2`, `idfecha`) VALUES
(1, '1', '08:30:00', 1, 2, 1),
(2, '2', '10:00:00', 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tgol`
--

CREATE TABLE IF NOT EXISTS `tgol` (
  `idgol` int(11) NOT NULL AUTO_INCREMENT,
  `minuto` int(2) NOT NULL,
  `idjugadorenjuego` int(4) NOT NULL,
  PRIMARY KEY (`idgol`,`idjugadorenjuego`),
  KEY `fk_tgol_tjugadorenjuego1_idx` (`idjugadorenjuego`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tgol`
--

INSERT INTO `tgol` (`idgol`, `minuto`, `idjugadorenjuego`) VALUES
(2, 12, 1),
(3, 4, 1),
(4, 2, 11),
(5, 90, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tingreso`
--

CREATE TABLE IF NOT EXISTS `tingreso` (
  `idingreso` int(4) NOT NULL AUTO_INCREMENT,
  `codequipo` int(11) NOT NULL,
  `nromovimiento` int(4) NOT NULL,
  PRIMARY KEY (`idingreso`,`codequipo`,`nromovimiento`),
  KEY `nromovimiento` (`nromovimiento`),
  KEY `codequipo` (`codequipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tingreso`
--

INSERT INTO `tingreso` (`idingreso`, `codequipo`, `nromovimiento`) VALUES
(5, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tintegrantes_c_orgdor`
--

CREATE TABLE IF NOT EXISTS `tintegrantes_c_orgdor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` enum('presidente','secretario','otros') NOT NULL,
  `idcom_orgdor` int(11) NOT NULL,
  `coddocente` varchar(8) NOT NULL,
  PRIMARY KEY (`id`,`idcom_orgdor`,`coddocente`),
  KEY `fk_tintegrantes_c_orgdor_tcom_orgdor1_idx` (`idcom_orgdor`),
  KEY `fk_tintegrantes_c_orgdor_tdocente1_idx` (`coddocente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tjugador`
--

CREATE TABLE IF NOT EXISTS `tjugador` (
  `idjugador` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(100) NOT NULL,
  `estado` enum('habilitado','desabilitado') NOT NULL,
  `codequipo` int(11) NOT NULL,
  `coddocente` varchar(8) NOT NULL,
  PRIMARY KEY (`idjugador`,`codequipo`,`coddocente`),
  KEY `codequipo` (`codequipo`),
  KEY `coddocente` (`coddocente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87654334 ;

--
-- Volcado de datos para la tabla `tjugador`
--

INSERT INTO `tjugador` (`idjugador`, `foto`, `estado`, `codequipo`, `coddocente`) VALUES
(5, 'Zamalloa Paro William.png', 'habilitado', 1, '16573'),
(87654321, 'William Zamalloa Paro.png', 'habilitado', 2, '16573'),
(87654330, 'Palma Ttito Luis Beltran.png', 'habilitado', 2, '16563'),
(87654331, 'Carrasco Poblete Edwin.png', 'habilitado', 2, '13428'),
(87654332, 'Rimache Suarez Wilson.jpg', 'habilitado', 2, '09318'),
(87654333, 'Rimache Suarez Wilson.jpg', 'habilitado', 1, '09318');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tjugadorenjuego`
--

CREATE TABLE IF NOT EXISTS `tjugadorenjuego` (
  `idjugadorenjuego` int(4) NOT NULL AUTO_INCREMENT,
  `nrocamiseta` varchar(2) NOT NULL,
  `condicionenpartido` enum('delantero','mediocampista','defensa','guardameta','suplente') NOT NULL,
  `escapitan` enum('no','si') NOT NULL DEFAULT 'no',
  `idjugador` int(11) NOT NULL,
  `codpartido` int(11) NOT NULL,
  PRIMARY KEY (`idjugadorenjuego`,`idjugador`,`codpartido`),
  KEY `fk_tjugadorenjuego_tjugador1_idx` (`idjugador`),
  KEY `fk_tjugadorenjuego_tpartido1_idx` (`codpartido`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `tjugadorenjuego`
--

INSERT INTO `tjugadorenjuego` (`idjugadorenjuego`, `nrocamiseta`, `condicionenpartido`, `escapitan`, `idjugador`, `codpartido`) VALUES
(1, '21', 'delantero', 'no', 5, 1),
(3, '1', 'guardameta', 'no', 5, 1),
(5, '7', 'mediocampista', 'no', 5, 1),
(6, '8', 'defensa', 'no', 5, 1),
(7, '11', 'defensa', 'no', 5, 1),
(10, '33', 'suplente', 'no', 5, 1),
(11, '34', 'delantero', 'si', 5, 1),
(13, '4', 'suplente', 'si', 87654333, 1),
(14, '67', 'delantero', 'no', 87654333, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `tmovimiento`
--

INSERT INTO `tmovimiento` (`nromovimiento`, `tipo`, `montototal`, `descripcion`, `fecha`, `idcom_orgdor`) VALUES
(10, 'ingreso', 200, 'Inscripcion', '2015-12-19 08:38:27', 1),
(11, 'egreso', 3, 'pago al arbitro', '2015-12-19 08:38:58', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `totrasincidencias`
--

CREATE TABLE IF NOT EXISTS `totrasincidencias` (
  `idincidencias` int(11) NOT NULL,
  `minuto` varchar(5) NOT NULL COMMENT '00:00',
  `tipo` enum('faul','tiro libre','penal','lateral') NOT NULL,
  `detalle` varchar(80) DEFAULT NULL,
  `idjugadorenjuego` int(4) NOT NULL,
  PRIMARY KEY (`idincidencias`,`idjugadorenjuego`),
  KEY `fk_tincidencias_tjugadorenjuego1_idx` (`idjugadorenjuego`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpartido`
--

CREATE TABLE IF NOT EXISTS `tpartido` (
  `codpartido` int(11) NOT NULL AUTO_INCREMENT,
  `horainicio` time DEFAULT NULL COMMENT '00:00',
  `horafin` time DEFAULT NULL COMMENT '00:00',
  `tipopartido` enum('reprogramado','walk over','suspendido','normal') DEFAULT NULL,
  `observacion` varchar(50) NOT NULL,
  `idfixture` int(11) NOT NULL,
  `idarbitroporpartido` int(4) DEFAULT NULL,
  PRIMARY KEY (`codpartido`,`idfixture`),
  KEY `idarbitroporpartido` (`idarbitroporpartido`),
  KEY `codprogramacion` (`idfixture`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tpartido`
--

INSERT INTO `tpartido` (`codpartido`, `horainicio`, `horafin`, `tipopartido`, `observacion`, `idfixture`, `idarbitroporpartido`) VALUES
(1, '09:00:00', '10:00:00', 'normal', 'no hay observaciones', 1, 2),
(4, NULL, NULL, NULL, '', 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `treunion`
--

CREATE TABLE IF NOT EXISTS `treunion` (
  `idreunion` int(4) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  PRIMARY KEY (`idreunion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Estructura de tabla para la tabla `ttarjeta`
--

CREATE TABLE IF NOT EXISTS `ttarjeta` (
  `idtarjeta` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('roja','amarilla') NOT NULL,
  `minuto` int(2) NOT NULL,
  `idjugadorenjuego` int(4) NOT NULL,
  PRIMARY KEY (`idtarjeta`,`idjugadorenjuego`),
  KEY `fk_ttarjeta_tjugadorenjuego1_idx` (`idjugadorenjuego`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttorneo`
--

CREATE TABLE IF NOT EXISTS `ttorneo` (
  `idtorneo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('apertura','clausura','play off') NOT NULL,
  `diainicio` date NOT NULL,
  `nrofechas` int(11) DEFAULT NULL,
  `codcampeonato` varchar(8) NOT NULL,
  PRIMARY KEY (`idtorneo`),
  KEY `codcampeonato` (`codcampeonato`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `ttorneo`
--

INSERT INTO `ttorneo` (`idtorneo`, `tipo`, `diainicio`, `nrofechas`, `codcampeonato`) VALUES
(1, 'apertura', '2015-12-16', 0, '1'),
(10, 'clausura', '0000-00-00', 0, '1'),
(12, 'play off', '2015-12-25', 0, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuarios`
--

CREATE TABLE IF NOT EXISTS `tusuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` enum('administrador','comision organizadora','equipo') NOT NULL,
  `estado` enum('activo','desactivo','bloqueado') NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tusuarios`
--

INSERT INTO `tusuarios` (`idusuario`, `username`, `password`, `tipo`, `estado`) VALUES
(4, 'wilson', '$2y$10$vv2vozwSL2Wwtnf6Wn6Dnu3D4bCkUj3zqKFn5ThTgB8plAPoW0gmy', 'administrador', 'activo'),
(5, 'comision', '$2y$10$fLUN43Hh3AxABjrsxcsc4ev.pQ/mjKnI12/b2yIuo.dfkBVBEqiQe', 'comision organizadora', 'activo'),
(6, 'andina', '$2y$10$X0QV8fY/zkpPErH3r5oIueyuRkD.9FcUU8IAAx/FGyqqhfE.QbFAS', 'equipo', 'activo'),
(7, 'informatica', '$2y$10$Aq5e3ujZ46hdCysxgnwjNOra3esXDPVO3su/QQYQ40QMg5nzJkj12', 'equipo', 'activo'),
(8, 'civil', '$2y$10$xGaeeCBtOqfwnire8DyEm.lVAjaotOOJW0AshGL2I0FN0dXlLDOU.', 'equipo', 'bloqueado');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tactividad`
--
ALTER TABLE `tactividad`
  ADD CONSTRAINT `tcronograma_ibfk_1` FOREIGN KEY (`codcampeonato`) REFERENCES `tcampeonato` (`codcampeonato`);

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
-- Filtros para la tabla `tcambio`
--
ALTER TABLE `tcambio`
  ADD CONSTRAINT `fk_tcambio_tjugadorenjuego1` FOREIGN KEY (`idjugadorenjuegosaliente`) REFERENCES `tjugadorenjuego` (`idjugadorenjuego`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tcambio_tjugadorenjuego2` FOREIGN KEY (`idjugadorenjuegoentrante`) REFERENCES `tjugadorenjuego` (`idjugadorenjuego`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `tdocente`
--
ALTER TABLE `tdocente`
  ADD CONSTRAINT `coddptoacademico` FOREIGN KEY (`coddptoacademico`) REFERENCES `tdptoacademico` (`coddptoacademico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tegreso`
--
ALTER TABLE `tegreso`
  ADD CONSTRAINT `nromovimiento` FOREIGN KEY (`nromovimiento`) REFERENCES `tmovimiento` (`nromovimiento`);

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
-- Filtros para la tabla `tequipoxtorneo`
--
ALTER TABLE `tequipoxtorneo`
  ADD CONSTRAINT `codequipo` FOREIGN KEY (`codequipo`) REFERENCES `tequipo` (`codequipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tequipoxtorneo_ttorneo1` FOREIGN KEY (`idtorneo`) REFERENCES `ttorneo` (`idtorneo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tfechas`
--
ALTER TABLE `tfechas`
  ADD CONSTRAINT `idtorneo` FOREIGN KEY (`idtorneo`) REFERENCES `ttorneo` (`idtorneo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tfixture`
--
ALTER TABLE `tfixture`
  ADD CONSTRAINT `equipo1` FOREIGN KEY (`equipo1`) REFERENCES `tequipo` (`codequipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `equipo2` FOREIGN KEY (`equipo2`) REFERENCES `tequipo` (`codequipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idfecha` FOREIGN KEY (`idfecha`) REFERENCES `tfechas` (`idfecha`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tgol`
--
ALTER TABLE `tgol`
  ADD CONSTRAINT `fk_tgol_tjugadorenjuego1` FOREIGN KEY (`idjugadorenjuego`) REFERENCES `tjugadorenjuego` (`idjugadorenjuego`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tjugadorenjuego_tjugador1` FOREIGN KEY (`idjugador`) REFERENCES `tjugador` (`idjugador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
-- Filtros para la tabla `totrasincidencias`
--
ALTER TABLE `totrasincidencias`
  ADD CONSTRAINT `fk_tincidencias_tjugadorenjuego1` FOREIGN KEY (`idjugadorenjuego`) REFERENCES `tjugadorenjuego` (`idjugadorenjuego`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tpartido`
--
ALTER TABLE `tpartido`
  ADD CONSTRAINT `codprogramacion` FOREIGN KEY (`idfixture`) REFERENCES `tfixture` (`idfixture`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tpartido_ibfk_1` FOREIGN KEY (`idarbitroporpartido`) REFERENCES `tarbitroxpartido` (`idarbitroporpartido`);

--
-- Filtros para la tabla `tsancion`
--
ALTER TABLE `tsancion`
  ADD CONSTRAINT `tsancion_ibfk_1` FOREIGN KEY (`nroconclusion`) REFERENCES `tconclusion` (`nroconclusion`),
  ADD CONSTRAINT `tsancion_ibfk_2` FOREIGN KEY (`idjugadorenjuego`) REFERENCES `tjugadorenjuego` (`idjugadorenjuego`),
  ADD CONSTRAINT `tsancion_ibfk_3` FOREIGN KEY (`idequipoenpartido`) REFERENCES `tequipoenpartido` (`idequipoenpartido`);

--
-- Filtros para la tabla `ttarjeta`
--
ALTER TABLE `ttarjeta`
  ADD CONSTRAINT `fk_ttarjeta_tjugadorenjuego1` FOREIGN KEY (`idjugadorenjuego`) REFERENCES `tjugadorenjuego` (`idjugadorenjuego`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ttorneo`
--
ALTER TABLE `ttorneo`
  ADD CONSTRAINT `codcampeonato` FOREIGN KEY (`codcampeonato`) REFERENCES `tcampeonato` (`codcampeonato`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
