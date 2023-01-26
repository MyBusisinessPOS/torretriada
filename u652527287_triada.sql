-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 25-01-2023 a las 22:59:15
-- Versión del servidor: 10.5.12-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u652527287_triada`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE `blog` (
  `id_blog` int(10) NOT NULL,
  `id_categoria` int(7) NOT NULL,
  `ruta` char(150) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `orden` int(10) DEFAULT NULL,
  `rutaR` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `blog`
--

INSERT INTO `blog` (`id_blog`, `id_categoria`, `ruta`, `fecha_creacion`, `fecha_modificacion`, `status`, `orden`, `rutaR`) VALUES
(19, 0, 'triada-1f729c6b.jpg', '2021-08-10', '2021-08-10', 1, 19, 'triada-12becf66.jpg'),
(20, 0, 'triada-45ffa79d.jpg', '2021-08-10', NULL, 1, 20, 'triada-f3abbb33.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `idCatalogo` tinyint(1) NOT NULL,
  `ruta` char(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`idCatalogo`, `ruta`) VALUES
(1, 'quesnel-2001e7d7.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(7) NOT NULL,
  `tituloEs` char(250) NOT NULL,
  `tituloEn` varchar(150) NOT NULL,
  `urlAmigableEs` char(250) NOT NULL,
  `urlAmigableEn` char(250) NOT NULL,
  `rutaImg` varchar(250) NOT NULL,
  `rutaImg2` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `orden` int(7) NOT NULL,
  `tipo` tinyint(1) NOT NULL COMMENT '1:Familias(Prod),2:años,3:Blog,4:Proyectos,5:categorias(prod),6:subcat(Prod)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_x_categoria`
--

CREATE TABLE `categorias_x_categoria` (
  `idCategoria` int(11) NOT NULL,
  `idSubcategoria` int(11) NOT NULL,
  `tipo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `idcontacto` tinyint(1) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `emisor` text NOT NULL,
  `latitud` varchar(20) NOT NULL,
  `longitud` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`idcontacto`, `correo`, `emisor`, `latitud`, `longitud`) VALUES
(1, 'webmaster@sloganpublicidad.com', 'noreply@sloganpublicidad.com', '21.043556', '-89.600496');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido_blog`
--

CREATE TABLE `contenido_blog` (
  `id_contenido_blog` int(10) NOT NULL,
  `id_blog` int(10) NOT NULL,
  `descripcion_es` text DEFAULT NULL,
  `descripcion_en` text DEFAULT NULL,
  `descripcion_fr` text DEFAULT NULL,
  `titulo_es` char(150) DEFAULT NULL,
  `titulo_en` char(150) DEFAULT NULL,
  `titulo_fr` char(150) DEFAULT NULL,
  `imagen` char(150) DEFAULT NULL,
  `url` char(250) DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL,
  `orden` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `contenido_blog`
--

INSERT INTO `contenido_blog` (`id_contenido_blog`, `id_blog`, `descripcion_es`, `descripcion_en`, `descripcion_fr`, `titulo_es`, `titulo_en`, `titulo_fr`, `imagen`, `url`, `tipo`, `orden`) VALUES
(25, 19, '&lt;p&gt;Vivimos tiempos in&eacute;ditos y en ellos, sentirnos seguros, c&oacute;modos y cercanos al centro donde transcurre nuestra vida, m&aacute;s que un deseo, se ha vuelto una prioridad. Los principales retos de las grandes urbes, son proporcionar a sus habitantes vivienda, movilidad y condiciones favorables para que puedan satisfacer sus necesidades buscando el beneficio de los centros urbanos. &lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;Todo en uno  &lt;/span&gt;&lt;/p&gt;&lt;p&gt;El sue&ntilde;o de muchos es poder encontrar un lugar en donde vivir, divertirse, convivir e incluso trabajar sin necesidad de tener que trasladarse de un lado al otro. &lt;/p&gt;&lt;p&gt;Las nuevas propuestas inmobiliarias brindan hoy la posibilidad de encontrar este tipo de lugares en uno solo. Los edificios mixtos son una tendencia que lleg&oacute; para quedarse en el mercado inmobiliario, al ser una combinaci&oacute;n de inmuebles para distintos usos en un solo lugar. Los ejecutivos inmobiliarios han encontrado en estos edificios una nueva alternativa para responder a las necesidades especificas derivadas del natural crecimiento de la zona urbana.  &lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;Lo pr&aacute;ctico de tenerlo todo cerca &lt;/span&gt;&lt;/p&gt;&lt;p&gt;La implementaci&oacute;n de proyectos de edificios con vocaci&oacute;n mixta nos brinda un perfecto balance de uso. La calidad de vida mejora significativamente en este tipo de edificios, ya que, permiten a los residentes vivir en un lugar donde se combinan viviendas con m&uacute;ltiples servicios y esto contribuye a reducir la cada vez creciente densidad residencial. &lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;Conoce Triada Urban Mix  &lt;/span&gt;&lt;/p&gt;&lt;p&gt;Seguramente te hace sentido la idea de tener todo lo que necesitas en un solo lugar y te preguntas &iquest;existe un lugar as&iacute; en M&eacute;rida? La respuesta es s&iacute;.  &lt;/p&gt;&lt;p&gt;Torre Triada es un proyecto de vertical de usos mixtos in&eacute;dito en la ciudad; ubicado en la Av. L&iacute;bano, la arteria principal de la tradicional colonia M&eacute;xico y una placida &aacute;rea residencial en el coraz&oacute;n de la capital yucateca.  &lt;/p&gt;&lt;p&gt;Adem&aacute;s de tener todas las comodidades a tu alcance y servicios de primer nivel, contar&aacute;s con una privilegiada conexi&oacute;n hacia las principales zonas del norte como el fraccionamiento Montebello y la prolongaci&oacute;n del famoso Paseo Montejo.&lt;/p&gt;&lt;p&gt; &lt;/p&gt;&lt;p&gt; &lt;/p&gt;&lt;p&gt; &lt;/p&gt;', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', NULL, NULL, NULL, NULL, NULL, 1, 25),
(26, 19, NULL, NULL, NULL, NULL, NULL, NULL, 'triada-48bfa556.jpg', NULL, 2, 26),
(27, 19, '&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;En Torre Triada podr&aacute;s encontrar 4 distintas vocaciones que se fusionan entre si para vivir cada d&iacute;a una experiencia integral: &lt;/p&gt;&lt;p&gt;- Locales comerciales &lt;/p&gt;&lt;p&gt;- Oficinas &lt;/p&gt;&lt;p&gt;- Departamentos &lt;/p&gt;&lt;p&gt;- Suites hoteleras &lt;/p&gt;&lt;p&gt;Sin duda alguna, Torre Triada es la mejor opci&oacute;n para disfrutar de un estilo de vida diferente e innovador. No pierdas la oportunidad de conocerla y aprovechar, en preventa, una oportunidad &uacute;nica de inversi&oacute;n. &lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt; &lt;/p&gt;', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', NULL, NULL, NULL, NULL, NULL, 1, 27),
(28, 20, '&lt;p&gt;Invertir en un inmueble es una decisi&oacute;n f&aacute;cil. Debe analizarse cada una de las opciones disponibles en el mercado, conocer a detalle la zona en donde el desarrollo se ubica, cuales son sus caracter&iacute;sticas diferenciales y lo m&aacute;s importante, cu&aacute;les son los beneficios que ofrece como instrumento de inversi&oacute;n &lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;&iquest;Por qu&eacute; M&eacute;rida? &lt;/span&gt;&lt;/p&gt;&lt;p&gt;En el coraz&oacute;n del sureste de M&eacute;xico, destaca una ciudad por su atractivo tur&iacute;stico, tranquilidad y sobre todo los &iacute;ndices que la convierten en la segunda urbe m&aacute;s segura del pa&iacute;s. M&eacute;rida, tambi&eacute;n conocida como la Ciudad Blanca es considerada una de las mejores ciudades para vivir en todo M&eacute;xico, gracias a la calidad de vida que sus habitantes poseen.  &lt;/p&gt;&lt;p&gt;M&eacute;rida vive hoy un crecimiento in&eacute;dito y esto se refleja en las innumerables opciones inmobiliarias que brinda. Adem&aacute;s, el mercado inmobiliario con vocaci&oacute;n patrimonial en Yucat&aacute;n es hoy muy estable gracias a una atractiva estrategia de financiamiento promovida por organismos p&uacute;blicos, la banca y otras entidades financieras. &lt;/p&gt;&lt;p&gt;Ahora bien, entre todas las alternativas inmobiliarias, por su vocaci&oacute;n y posibilidades&hellip; &iquest;Cu&aacute;l representa la mejor opci&oacute;n para invertir? &lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;Torre Triada, un gran proyecto para una gran ciudad. &lt;/span&gt;&lt;/p&gt;&lt;p&gt;Torre Triada es el m&aacute;s innovador desarrollo de usos mixtos creado en la ciudad de M&eacute;rida. Ubicado en la Av. L&iacute;bano, cerca de Montebello y la Prolongaci&oacute;n del Paseo Montejo, se erige en una de las zonas con mayor plusval&iacute;a y crecimiento de toda la ciudad. Aqu&iacute;, las propiedades han aumentado exponencialmente su valor y es por ello que atrae a muchos inversionistas interesados en asegurar su futuro en M&eacute;rida. Como medio de inversi&oacute;n, Torre Triada ofrece la versatilidad de poder elegir entre cuatro diferentes vocaciones: Departamentos, oficinas, locales comerciales y suites hoteleras.&lt;/p&gt;&lt;p&gt; &lt;/p&gt;&lt;p&gt; &lt;/p&gt;&lt;p&gt; &lt;/p&gt;&lt;p&gt; &lt;/p&gt;', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', NULL, NULL, NULL, NULL, NULL, 1, 28),
(29, 20, NULL, NULL, NULL, NULL, NULL, NULL, 'triada-16d3f6fe.jpg', NULL, 2, 29),
(30, 20, '&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Invierte hoy en un producto &uacute;nico y aprovecha atractivas condiciones de preventa desde s&oacute;lo $1.6 MDP. Torre Triada, una propuesta de vida integral creada para las necesidades espec&iacute;ficas de los mercados de hoy.&lt;br&gt;&lt;/p&gt;', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', NULL, NULL, NULL, NULL, NULL, 1, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosmanual`
--

CREATE TABLE `datosmanual` (
  `idManual` int(7) NOT NULL,
  `titulo` char(250) NOT NULL,
  `descripcion` text NOT NULL,
  `link` varchar(250) NOT NULL,
  `lang` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosPortafolio`
--

CREATE TABLE `datosPortafolio` (
  `idPortafolio` int(7) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `marca` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  `urlAmigable` varchar(250) NOT NULL,
  `lang` char(5) NOT NULL,
  `descripcion2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datosPortafolio`
--

INSERT INTO `datosPortafolio` (`idPortafolio`, `titulo`, `marca`, `descripcion`, `urlAmigable`, `lang`, `descripcion2`) VALUES
(7, 'TAMARA', 'https://goo.gl/maps/nD2cdVeif6p', '&lt;p&gt;MÃ¡s que un desarrollo de vivienda, Tamara es una comunidad residencial en la que cada detalle ha sido diseÃ±ado para crear una experiencia Ãºnica, caracterizada por el lujo, la tranquilidad y en espÃ­ritu genuinamente natural. A Tamara la definen sus exclusivos servicios amenidades: 5 parques temÃ¡ticos, Casa Club, Town Center, un impresionante diseÃ±o paisajÃ­stico y una arquitectura sustentable en la que la mÃ¡s avanzada tecnologÃ­a se orienta hacia un profundo respeto por el entorno.&lt;/p&gt;', 'tamara', 'es', '&lt;p&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;CategorÃ­a:&lt;/span&gt; Usos mixtos. &lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;UbicaciÃ³n:&lt;/span&gt; Carretera MÃ©rida-Progreso, Km. &lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;Estatus:&lt;/span&gt; Preventa.&lt;/p&gt;'),
(7, '', '', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', 'en', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosSlide`
--

CREATE TABLE `datosSlide` (
  `idSlide` int(7) NOT NULL,
  `titulo` char(250) NOT NULL,
  `subtitulo` char(250) NOT NULL,
  `subtitulo2` char(250) NOT NULL,
  `subtitulo3` char(250) NOT NULL,
  `link` char(250) NOT NULL,
  `linkVideo` varchar(250) NOT NULL,
  `lang` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datosSlide`
--

INSERT INTO `datosSlide` (`idSlide`, `titulo`, `subtitulo`, `subtitulo2`, `subtitulo3`, `link`, `linkVideo`, `lang`) VALUES
(4, 'Desarrollando productos inmobiliarios sustentables y de la mÃ¡s alta rentabilidad.', '', '', '', '', '', 'es'),
(4, '', '', '', '', '', '', 'en'),
(5, 'Desarrollando productos inmobiliarios sustentables y de la mÃ¡s alta rentabilidad.', '', '', '', '', '', 'es'),
(5, '', '', '', '', '', '', 'en'),
(6, 'Desarrollando productos inmobiliarios sustentables y de la mÃ¡s alta rentabilidad.', '', '', '', '', '', 'es'),
(6, '', '', '', '', '', '', 'en');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datossucursal`
--

CREATE TABLE `datossucursal` (
  `idDatosSucursal` int(11) NOT NULL,
  `idSucursal` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `lang` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosusuario`
--

CREATE TABLE `datosusuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datosusuario`
--

INSERT INTO `datosusuario` (`idusuario`, `nombre`, `email`, `telefono`, `token`) VALUES
(1, 'Administrador', 'webmaster@sloganpublicidad.com', '', '747b281f50792a15e8ed7251015fed9f'),
(1, 'Administrador', 'webmaster@sloganpublicidad.com', '', '747b281f50792a15e8ed7251015fed9f');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_blog`
--

CREATE TABLE `datos_blog` (
  `id_blog` int(10) NOT NULL,
  `titulo` char(150) DEFAULT NULL,
  `subtitulo` char(150) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `tags` char(50) DEFAULT NULL,
  `tags_amigables` char(50) DEFAULT NULL,
  `url_amigable` char(150) DEFAULT NULL,
  `lang` char(2) DEFAULT NULL COMMENT 'es = Español\nen = Ingles\nfr = Frances'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos_blog`
--

INSERT INTO `datos_blog` (`id_blog`, `titulo`, `subtitulo`, `descripcion`, `tags`, `tags_amigables`, `url_amigable`, `lang`) VALUES
(19, 'Edificios de uso mixto, una nueva forma de vida', 'Admin', '&lt;p&gt;Vivimos tiempos in&eacute;ditos y en ellos, sentirnos seguros, c&oacute;modos y cercanos al centro donde transcurre nuestra vida, m&aacute;s que un deseo, se ha vuelto una prioridad.&lt;/p&gt;', '', '', 'edificios-de-uso-mixto-una-nueva-forma-de-vida', 'es'),
(20, '', '', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', '', '', 'en'),
(20, '', '', '', '', '', '', 'fr'),
(19, '', '', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '', '', '', 'en'),
(19, '', '', '', '', '', '', 'fr'),
(20, 'M&eacute;rida, el mejor destino para la inversi&oacute;n inmobiliaria', 'Admin', '&lt;p&gt;Invertir en un inmueble es una decisi&oacute;n f&aacute;cil. Debe analizarse cada una de las opciones disponibles en el mercado, conocer a detalle la zona en donde el desarrollo se ubica...&lt;/p&gt;', '', '', 'merida-el-mejor-destino-para-la-inversion-inmobiliaria', 'es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_vendido`
--

CREATE TABLE `datos_vendido` (
  `id_datos_vendido` int(11) NOT NULL,
  `id_vendido` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `subtitulo` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `lang` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idEquipo` int(7) NOT NULL,
  `titulo` char(250) NOT NULL,
  `puestoEs` char(150) NOT NULL,
  `puestoEn` char(150) NOT NULL,
  `descripcion` char(250) NOT NULL,
  `imgPortada` char(150) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `orden` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE `galeria` (
  `id_galeria` int(7) NOT NULL,
  `id_contenido_blog` int(10) NOT NULL,
  `id_atraccion` int(10) NOT NULL,
  `img` char(150) DEFAULT NULL,
  `img_movil` char(150) DEFAULT NULL,
  `url_video` char(150) DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL COMMENT '1 = Slide\n2 = Atraccion\n3 = Contenido Blog\n',
  `status` tinyint(1) DEFAULT NULL,
  `orden` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imgconfig`
--

CREATE TABLE `imgconfig` (
  `idconfiguracion` int(3) NOT NULL,
  `alto` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ancho` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `calidad` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `prefijo` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `imgconfig`
--

INSERT INTO `imgconfig` (`idconfiguracion`, `alto`, `ancho`, `calidad`, `prefijo`) VALUES
(1, '1080', '1920', '95', 'triada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imgnosotros`
--

CREATE TABLE `imgnosotros` (
  `idimgNosotros` int(1) NOT NULL,
  `ruta` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imgSeo`
--

CREATE TABLE `imgSeo` (
  `idimgSeo` int(2) NOT NULL,
  `idseo` int(1) NOT NULL,
  `titulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ruta` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `imgSeo`
--

INSERT INTO `imgSeo` (`idimgSeo`, `idseo`, `titulo`, `ruta`) VALUES
(1, 1, 'triada-b07f4e3b.ico', 'triada-b07f4e3b.ico'),
(2, 1, '', ''),
(3, 1, 'triada-f0cce20c.jpg', 'triada-f0cce20c.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `idlote` int(11) NOT NULL,
  `lote` varchar(30) NOT NULL,
  `metrosCuadrados` varchar(15) NOT NULL,
  `precio` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'DISPONIBLE',
  `ruta` varchar(150) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `enganche` varchar(30) NOT NULL,
  `mensualidad` varchar(30) NOT NULL,
  `saldo_entrega` varchar(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `meses` int(11) DEFAULT 12
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`idlote`, `lote`, `metrosCuadrados`, `precio`, `status`, `ruta`, `tipo`, `enganche`, `mensualidad`, `saldo_entrega`, `nombre`, `meses`) VALUES
(1, 'LC-01', '110', '4374562.50', '1', 'l1.svg', 'lc', '583275', '49500', '', 'Local Comercial 01', 20),
(2, 'LC-02', '139.3', '5382075.38', '1', 'l1.svg', 'lc', '717610.05', '63000', '', 'Local Comercial 02', 20),
(3, 'LC-03', '211.64', '7990655.4', '1', 'l1.svg', 'lc', '1065420.72', '95000', '', 'Local Comercial 03', 20),
(4, 'LC-04', '284.23', '13191942.04', '1', 'l1.svg', 'lc', '1758925.61', '128000', '', 'Local Comercial 04', 20),
(5, 'LC-05', '195.94', '9472575.38', '1', 'l1.svg', 'lc', '1263010.05', '89000', '', 'Local Comercial 05', 20),
(6, 'LC-06', '392.99', '16103616.75', '1', 'l1.svg', 'lc', '2147148.9', '177000', '', 'Local Comercial 06', 20),
(7, 'CO-01', '551.4', '23331796.88', '2', 'l1.svg', '', '', '', '', '', 12),
(9, 'S-601', '81.84', '', '3', 'l1.svg', 'suite', '', '', '', 'Suite Hotelera 601', 12),
(10, 'S-602', '62.54', '2191884.03', '1', 'l1.svg', 'suite', '500000', '19900', '1321205.881', 'Suite Hotelera 602', 13),
(11, 'S-603', '62.54', '', '3', 'l1.svg', 'suite', '', '', '', 'Suite Hotelera 603', 12),
(12, 'S-604', '62.54', '', '3', 'l1.svg', 'suite', '', '', '', 'Suite Hotelera 604', 12),
(13, 'S-605', '62.54', '2191884.03', '1', 'l1.svg', 'suite', '500000', '19900', '1321205.881', 'Suite Hotelera 605', 13),
(14, 'S-606', '62.54', '2191884.03', '1', 'l1.svg', 'suite', '500000', '19900', '1321205.881', 'Suite Hotelera 606', 13),
(15, 'S-607', '62.54', '2191884.03', '1', 'l1.svg', 'suite', '500000', '19900', '1321205.881', 'Suite Hotelera 607', 13),
(16, 'S-608', '62.54', '0', '3', 'l1.svg', 'suite', '400000', '25000', '1321205.881', 'Suite Hotelera 608', 12),
(17, 'S-609', '62.54', '0', '3', 'l1.svg', 'suite', '400000', '25000', '1321205.881', 'Suite Hotelera 609', 12),
(18, 'S-610', '62.54', '', '3', 'l1.svg', 'suite', '', '', '', 'Suite Hotelera 610', 12),
(19, 'S-611', '62.54', '', '3', 'l1.svg', 'suite', '', '', '', 'Suite Hotelera 611', 12),
(20, 'S-612', '62.54', '', '3', 'l1.svg', 'suite', '', '', '', 'Suite Hotelera 612', 12),
(21, 'S-613', '66.99', '', '3', 'l1.svg', 'suite', '', '', '', 'Suite Hotelera 613', 12),
(22, 'S-614', '78.33', '', '3', 'l1.svg', 'suite', '', '', '', 'Suite Hotelera 614', 12),
(23, 'S-615', '58.36', '0', '3', 'l1.svg', 'suite', '', '', '', 'Suite Hotelera 615', 12),
(24, 'S-616', '58.36', '2019862.75', '1', 'l1.svg', 'suite', '500000', '19900', '1150807.445', 'Suite Hotelera 616', 13),
(25, 'S-617', '58.36', '2019862.75', '1', 'l1.svg', 'suite', '500000', '19900', '1150807.445', 'Suite Hotelera 617', 13),
(26, 'S-618', '58.36', '2019862.75', '1', 'l1.svg', 'suite', '500000', '19900', '1150807.445', 'Suite Hotelera 618', 13),
(27, 'S-619', '58.36', '2019862.75', '1', 'l1.svg', 'suite', '500000', '19900', '1150807.445', 'Suite Hotelera 619', 13),
(28, 'S-620', '58.36', '2019862.75', '1', 'l1.svg', 'suite', '500000', '19900', '1150807.445', 'Suite Hotelera 620', 13),
(29, 'S-621', '58.36', '2019862.75', '1', 'l1.svg', 'suite', '500000', '19900', '1150807.445', 'Suite Hotelera 621', 13),
(30, 'S-622', '58.36', '2019862.75', '1', 'l1.svg', 'suite', '500000', '19900', '1150807.445', 'Suite Hotelera 622', 13),
(31, 'S-623', '58.36', '2019862.75', '1', 'l1.svg', 'suite', '500000', '19900', '1150807.445', 'Suite Hotelera 623', 13),
(32, 'S-624', '58.36', '2019862.75', '1', 'l1.svg', 'suite', '500000', '19900', '1150807.445', 'Suite Hotelera 624', 13),
(33, 'S-625', '58.36', '', '3', 'l1.svg', 'suite', '', '', '', 'Suite Hotelera 625', 12),
(34, 'S-626', '58.36', '', '3', 'l1.svg', 'suite', '', '', '', 'Suite Hotelera 626', 12),
(35, 'S-627', '60.8', '2053157.2', '1', 'l1.svg', 'suite', '500000', '19900', '1183787.788', 'Suite Hotelera 627', 13),
(36, 'S-628', '60.8', '2053157.20', '1', 'l1.svg', 'suite', '500000', '19900', '1183787.788', 'Suite Hotelera 628', 13),
(37, 'S-629', '55.8', '', '3', 'l1.svg', 'suite', '', '', '', 'Suite Hotelera 629', 12),
(38, 'S-630', '55.8', '', '3', 'l1.svg', 'suite', '', '', '', 'Suite Hotelera 630', 12),
(39, 'D901', '129.04', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 901', 12),
(40, 'D902', '125.93', '3710000', '1', 'l1.svg', 'depto2', '742000', '39900', '2355000', 'Departamento 902', 13),
(41, 'D903', '125.93', '3675000', '3', 'l1.svg', 'depto2', '600000', '40000', '2355000', 'Departamento 903', 12),
(42, 'D904', '157.81', '4717000', '1', 'l1.svg', 'depto2', '943400', '39900', '', 'Departamento 904', 13),
(43, 'D905', '98.93', '3180000', '1', 'l1.svg', 'depto1', '636000', '39900', '1830000', 'Departamento 905', 13),
(44, 'D906', '73.99', '', '3', 'l1.svg', 'depto1', '', '', '', 'Departamento 906', 12),
(45, 'D907', '73.99', '2310000', '3', 'l1.svg', 'depto1', '350000', '25000', '1510000', 'Departamento 907', 12),
(46, 'D908', '63.25', '', '3', 'l1.svg', 'depto1', '', '', '', 'Departamento 908', 12),
(47, 'D909', '63.25', '', '3', 'l1.svg', 'depto1', '', '', '', 'Departamento 909', 12),
(48, 'D910', '73.99', '', '2', 'l1.svg', 'depto1', '', '', '', 'Departamento 910', 12),
(49, 'D911', '73.99', '', '3', 'l1.svg', 'depto1', '', '', '', 'Departamento 911', 12),
(50, 'D912', '77.38', '', '3', 'l1.svg', 'depto1', '', '', '', 'Departamento 912', 12),
(51, 'D-1001', '128.62', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1001', 12),
(52, 'D-1002', '129.79', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1002', 12),
(53, 'D-1003', '132.12', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1003', 12),
(54, 'D-1004', '135.47', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1004', 12),
(55, 'D-1005', '115.07', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1005', 12),
(56, 'D-1101', '128.62', '3820463.16', '1', 'l1.svg', 'depto2', '764092.63', '39900', '2464421.053', 'Departamento 1101', 13),
(57, 'D-1102', '129.79', '3880157.89', '1', 'l1.svg', 'depto2', '776031.58', '39900', '2523552.632', 'Departamento 1102', 13),
(58, 'D-1103', '132.12', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1103', 12),
(59, 'D-1104', '135.47', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1104', 12),
(60, 'D-1105', '115.07', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1105', 12),
(61, 'D-1201', '128.62', '3867205.263', '3', 'l1.svg', 'depto2', '600000', '40000', '2547205.263', 'Departamento 1201', 12),
(62, 'D-1202', '129.79', '3904035.79', '1', 'l1.svg', 'depto2', '780807.16', '39900', '2547205.263', 'Departamento 1202', 13),
(63, 'D-1203', '132.12', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1203', 12),
(64, 'D-1204', '135.47', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1204', 12),
(65, 'D-1205', '115.07', '3462294.74', '1', 'l1.svg', 'depto2', '692458.95', '39900', '2109631.579', 'Departamento 1205', 13),
(66, 'D-1401', '128.62', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1401', 12),
(67, 'D-1402', '129.79', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1402', 12),
(68, 'D-1403', '132.12', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1403', 12),
(69, 'D-1404', '135.47', '', '3', 'l1.svg', 'depto2', '', '', '', 'Departamento 1404', 12),
(70, 'D-1405', '115.07', '3581684.21', '1', 'l1.svg', 'depto2', '716336.84', '39900', '2227894.737', 'Departamento 1405', 13),
(71, 'O-1001', '79.6', '', '2', 'l1.svg', 'oficb', '', '', '', 'Oficina 1001', 12),
(72, 'O-1002', '75.5', '2574142.7', '1', 'l1.svg', 'oficb', '572031.71', '9900', '1698656.141', 'Oficina 1002', 13),
(73, 'O-1003', '79.02', '', '3', 'l1.svg', 'oficb', '', '', '', 'Oficina 1003', 12),
(74, 'O-1005', '79.6', '', '3', 'l1.svg', 'oficb', '', '', '', 'Oficina 1005', 12),
(75, 'O-1006', '53.73', '', '3', 'l1.svg', 'oficb', '', '', '', 'Oficina 1006', 12),
(76, 'O-1007', '123.95', '', '3', 'l1.svg', 'oficb', '', '', '', 'Oficina 1007', 12),
(77, 'O-1008', '72.5', '', '3', 'l1.svg', 'oficb', '', '', '', 'Oficina 1008', 12),
(78, 'O-1009', '52.9', '1825053.56', '1', 'l1.svg', 'oficb', '456263.39', '9900', '1182856.684', 'Oficina 1009', 13),
(79, 'O-1010', '49.55', '', '3', 'l1.svg', 'oficb', '', '', '', 'Oficina 1010', 12),
(80, 'O-1011', '43.42', '1389219.87', '1', 'l1.svg', 'ofica', '347304.97', '9900', '837398.3711', 'Oficina 1011', 13),
(81, 'O-1101', '79.6', '2506043.69', '1', 'l1.svg', 'oficb', '626510.92', '9900', '1941385.297', 'Oficina 1101', 13),
(82, 'O-1102', '62.99', '2342606.06', '1', 'l1.svg', 'oficb', '585651.51', '9900', '1759338.43', 'Oficina 1102', 13),
(83, 'O-1103', '51.25', '', '3', 'l1.svg', 'oficb', '', '', '', 'Oficina 1103', 12),
(84, 'O-1104', '47.73', '', '3', 'l1.svg', 'oficb', '', '', '', 'Oficina 1104', 12),
(85, 'O-1105', '47.73', '1634376.32', '1', 'l1.svg', 'ofica', '408594.08', '9900', '1110468.672', 'Oficina 1105', 13),
(86, 'O-1106', '54.71', '', '3', 'l1.svg', 'oficb', '', '', '', 'Oficina 1106', 12),
(87, 'O-1107', '129.7', '', '3', 'l1.svg', 'oficb', '', '', '', 'Oficina 1107', 12),
(88, 'O-1108', '60', '', '3', 'l1.svg', 'oficb', '', '', '', 'Oficina 1108', 12),
(89, 'O-1109', '52.9', '1852293.16', '1', 'l1.svg', 'oficb', '408594.08', '9900', '1213197.828', 'Oficina 1109', 13),
(90, 'O-1110', '49.55', '', '3', 'l1.svg', 'oficb', '', '', '', 'Oficina 1110', 12),
(91, 'O-1111', '43.42', '1593516.91', '1', 'l1.svg', 'ofica', '354114.87', '9900', '867739.5156', 'Oficina 1111', 13),
(92, 'O-1201', '79.6', '2941877.37', '1', 'l1.svg', 'oficb', '653750.53', '9900', '', 'Oficina 1201', 13),
(93, 'O-1202', '75.5', '2696720.93', '1', 'l1.svg', 'oficb', '599271.32', '9900', '', 'Oficina 1202', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manual`
--

CREATE TABLE `manual` (
  `idManual` int(7) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `imgPortada` char(150) NOT NULL,
  `manualEs` char(150) NOT NULL,
  `manualEn` char(150) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `orden` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `newsletter`
--

CREATE TABLE `newsletter` (
  `idNewsletter` int(7) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `orden` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `newsletter`
--

INSERT INTO `newsletter` (`idNewsletter`, `correo`, `fechaCreacion`, `status`, `orden`) VALUES
(1, 'webmaster@sloganpublicidad.com', '2018-08-22', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nompermiso` varchar(255) NOT NULL,
  `clavepermiso` varchar(255) NOT NULL,
  `idSeccionPermiso` int(3) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nompermiso`, `clavepermiso`, `idSeccionPermiso`, `status`) VALUES
(1, 'Agregar Usuario', 'AgrUser', 7, 0),
(2, 'Modificar Usuario', 'ModUser', 7, 1),
(3, 'Eliminar Usuario', 'ElimUser', 7, 1),
(4, 'Activar/Desactivar Usuario', 'AcDcUser', 7, 1),
(5, 'Agregar Tipo Usuario', 'AgrTipoUser', 7, 1),
(6, 'Modificar Tipo Usuario', 'ModTipoUser', 7, 1),
(7, 'Eliminar Tipo Usuario', 'ElimTipoUser', 7, 1),
(8, 'Activar/Desactivar Tipo Usuario', 'AcDcTipoUser', 7, 1),
(9, 'ConfiguraciÃ³n', 'Conf', 6, 1),
(10, 'Seleccionar Tipo Usuario', 'SelecTipo', 6, 1),
(17, 'Agregar Slide', 'p_add_slide', 1, 1),
(18, 'Modificar Slide', 'p_mod_slide', 1, 1),
(19, 'Eliminar Slide', 'p_del_slide', 1, 1),
(20, 'Activar/Desactivar Slide', 'p_acdc_slide', 1, 1),
(21, 'Ordenar Slide', 'p_sort_slide', 1, 0),
(28, 'Ver Menu Slide', 'p_ver_slide', 1, 1),
(29, 'Eliminar Newsletter', 'p_del_newsletter', 0, 1),
(30, 'Activar/Desactivar Newsletter', 'p_acdc_newsletter', 0, 1),
(31, 'Descargar Reporte', 'p_download_newsletter', 0, 1),
(32, 'Ver Menu Newsletter', 'p_ver_newsletter', 0, 1),
(33, 'Eliminar Categoria', 'p_del_categoria', 2, 1),
(34, 'Activar/Desactivar Catogoria', 'p_acdc_categoria', 2, 1),
(35, 'Ordenar Categoria', 'p_sort_categoria', 2, 1),
(36, 'Ver Menu Categoria', 'p_ver_categoria', 2, 1),
(37, 'Agregar Categoria', 'p_add_categoria', 2, 1),
(38, 'Modificar Categoria', 'p_mod_categoria', 2, 1),
(39, 'Agregar Producto', 'p_add_portafolio', 4, 1),
(40, 'Modificar Producto', 'p_mod_portafolio', 4, 1),
(41, 'Eliminar Producto', 'p_del_portafolio', 4, 1),
(42, 'Activar/Desactivar Producto', 'p_acdc_portafolio', 4, 1),
(43, 'Ordenar Producto', 'p_sort_portafolio', 4, 1),
(44, 'Ver Menu Producto', 'p_ver_portafolio', 4, 1),
(48, 'Agregar Categoria Servicio', 'p_add_categoria_proyecto', 5, 1),
(49, 'Modificar Categoria Proyecto', 'p_mod_categoria_proyecto', 5, 1),
(50, 'Eliminar Categoria Proyecto', 'p_del_categoria_proyecto', 5, 1),
(51, 'Activar/Desactivar Categoria Proyecto', 'p_acdc_categoria_proyecto', 5, 1),
(52, 'Ordenar Categoria Proyecto', 'p_sort_categoria_proyecto', 5, 1),
(53, 'Ver MenÃº Categoria Proyecto', 'p_ver_categoria_proyecto', 5, 1),
(54, 'Agregar Proyecto', 'p_add_proyecto', 8, 1),
(55, 'Modificar Proyecto', 'p_mod_proyecto', 8, 1),
(56, 'Eliminar Proyecto', 'p_del_proyecto', 8, 1),
(57, 'Activar/Desactivar Proyecto', 'p_acdc_proyecto', 8, 1),
(58, 'Ordenar Proyecto', 'p_sort_proyecto', 8, 1),
(59, 'Ordenar Galeria Proyecto', 'p_sort_galeria_proyecto', 8, 1),
(60, 'Ver Menu Proyecto', 'p_ver_proyecto', 8, 1),
(61, 'Agregar Manual', 'p_add_manual', 9, 1),
(62, 'Modificar Manual', 'p_mod_manual', 9, 1),
(63, 'Eliminar Manual', 'p_del_manual', 9, 1),
(64, 'Activar/Desactivar Manual', 'p_acdc_manual', 9, 1),
(65, 'Ordenar Manual', 'p_sort_manual', 9, 1),
(66, 'Ver Menu Manual', 'p_ver_manual', 9, 1),
(67, 'Agregar Instalacion', 'p_add_instalacion', 10, 1),
(68, 'Modificar Instalacion', 'p_mod_instalacion', 10, 1),
(69, 'Eliminar Instalacion', 'p_del_instalacion', 10, 1),
(70, 'Activar/Desactivar Instalacion', 'p_acdc_instalacion', 10, 1),
(71, 'Ordenar Instalacion', 'p_sort_instalacion', 10, 1),
(72, 'Ver Menu Instalacion', 'p_ver_instalacion', 10, 1),
(73, 'Agregar Categoria Blog', 'p_add_categoria_blog', 11, 1),
(74, 'Modificar Categoria Blog', 'p_mod_categoria_blog', 11, 1),
(75, 'Eliminar Categoria Blog', 'p_del_categoria_blog', 11, 1),
(76, 'Activar/Desactivar Categoria Blog', 'p_acdc_categoria_blog', 11, 1),
(77, 'Ordenar Categoria Blog', 'p_sort_categoria_blog', 11, 1),
(78, 'Ver Menu Categoria Blog', 'p_ver_categoria_blog', 11, 1),
(79, 'Agregar Blog', 'p_add_blog', 12, 1),
(80, 'Modificar Blog', 'p_mod_blog', 12, 1),
(81, 'Eliminar Blog', 'p_del_blog', 12, 1),
(82, 'Activar/Desactivar Blog', 'p_acdc_blog', 12, 1),
(83, 'Ordenar Blog', 'p_sort_blog', 12, 1),
(84, 'Ver Menu Blog', 'p_ver_blog', 12, 1),
(85, 'Ordenar Galeria Producto', 'p_sort_galeria_producto', 4, 1),
(86, 'Ver Contacto', 'p_ver_sucursal', 14, 1),
(87, 'Agregar Sucursal', 'p_add_sucursal', 14, 1),
(88, 'Modificar Sucursal', 'p_mod_sucursal', 14, 1),
(89, 'Eliminar Sucursal', 'p_del_sucursal', 14, 1),
(90, 'Activar/Desactivar Sucursal', 'p_acdc_sucursal', 14, 1),
(91, 'Ordenar Sucursales', 'p_sort_sucursal', 14, 1),
(92, 'Ver Newsletter', 'p_ver_newsletter', 15, 1),
(93, 'Eliminar Newsletter', 'p_del_newsletter', 15, 1),
(94, 'Activar/Desactivar Newsletter', 'p_acdc_newsletter', 15, 1),
(95, 'Ordenar Newsletter', 'p_sort_newsletter', 15, 1),
(96, 'Descargar Newsletter', 'p_download_newsletter', 15, 1),
(97, 'Ver Finalizados', 'p_ver_proyectos_vendidos', 16, 1),
(98, 'Agregar Finalizado', 'p_add_vendido', 16, 1),
(99, 'Modificar Finalizado', 'p_mod_vendido', 16, 1),
(100, 'Eliminar Finalizado', 'p_del_vendido', 16, 1),
(101, 'Activar/Desactivar Finalizado', 'p_acdc_vendido', 16, 1),
(102, 'Ordenar Finalizados', 'p_sort_vendido', 16, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portafolio`
--

CREATE TABLE `portafolio` (
  `idPortafolio` int(7) NOT NULL,
  `idAnio` int(11) NOT NULL,
  `imgPortada` char(150) NOT NULL,
  `imgMini` varchar(250) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `destacado` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `orden` int(7) NOT NULL,
  `fichaTecnicaEs` char(150) NOT NULL,
  `fichaTecnicaEn` char(150) NOT NULL,
  `archivoEs` varchar(250) NOT NULL,
  `archivoEn` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `portafolio`
--

INSERT INTO `portafolio` (`idPortafolio`, `idAnio`, `imgPortada`, `imgMini`, `tipo`, `destacado`, `status`, `orden`, `fichaTecnicaEs`, `fichaTecnicaEn`, `archivoEs`, `archivoEn`) VALUES
(7, 0, 'viveabitare-660e7561.jpg', '', 2, 0, 1, 7, '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portafolioxcategoria`
--

CREATE TABLE `portafolioxcategoria` (
  `idPortafolio` int(7) NOT NULL,
  `idPadre` int(11) NOT NULL,
  `idCategoria` int(7) NOT NULL,
  `idSubcategoria` int(11) NOT NULL,
  `tipo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulante`
--

CREATE TABLE `postulante` (
  `idPostulante` int(7) NOT NULL,
  `nombre` char(250) NOT NULL,
  `correo` char(100) NOT NULL,
  `telefono` char(20) NOT NULL,
  `especialidad` char(250) NOT NULL,
  `estado` char(50) NOT NULL,
  `ciudad` char(50) NOT NULL,
  `mensaje` text NOT NULL,
  `curriculum` char(150) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `orden` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redSocial`
--

CREATE TABLE `redSocial` (
  `idRedSocial` int(3) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `url` varchar(200) NOT NULL,
  `icono` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `redSocial`
--

INSERT INTO `redSocial` (`idRedSocial`, `titulo`, `url`, `icono`) VALUES
(1, 'Facebook', 'https://www.facebook.com', 'fa-facebook'),
(2, 'Twitter', 'https://twitter.com', 'fa-twitter'),
(3, 'Instagram', 'https://www.instagram.com', 'fa-instagram');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccionPermiso`
--

CREATE TABLE `seccionPermiso` (
  `idSeccionPermiso` int(3) NOT NULL,
  `nombreSeccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seccionPermiso`
--

INSERT INTO `seccionPermiso` (`idSeccionPermiso`, `nombreSeccion`) VALUES
(1, 'Slide'),
(6, 'Configuraciones Panel'),
(7, 'Usuarios Panel'),
(12, 'Blog'),
(15, 'Newsletter');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seo`
--

CREATE TABLE `seo` (
  `idseo` int(11) NOT NULL,
  `metaDescription` text COLLATE utf8_unicode_ci NOT NULL,
  `metaKeywords` text COLLATE utf8_unicode_ci NOT NULL,
  `metaAuthor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `metaOgTitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `metaOgUrl` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `metaOgType` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `metaOgDescription` text COLLATE utf8_unicode_ci NOT NULL,
  `metaOgLocale` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `metaOgSiteName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idAnalitics` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sitenameAnalitics` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `conversionFacebook` text COLLATE utf8_unicode_ci NOT NULL,
  `conversionGoogle` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `seo`
--

INSERT INTO `seo` (`idseo`, `metaDescription`, `metaKeywords`, `metaAuthor`, `metaOgTitle`, `metaOgUrl`, `metaOgType`, `metaOgDescription`, `metaOgLocale`, `metaOgSiteName`, `idAnalitics`, `sitenameAnalitics`, `conversionFacebook`, `conversionGoogle`) VALUES
(1, 'Conoce el proyecto de usos mixtos que transformará el norte de Mérida ofreciendo el más rentable modelo de inversión.', 'Torre Triada', 'Torre Triada', 'Torre Triada', 'https://torretriada.com/', 'website', 'Conoce el proyecto de usos mixtos que transformará el norte de Mérida ofreciendo el más rentable modelo de inversión.', 'es_MX', 'Torre Triada', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settingsEmail`
--

CREATE TABLE `settingsEmail` (
  `idsettingsEmail` int(1) NOT NULL,
  `host` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `port` int(5) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `noReply` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fromname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `addCC` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `settingsEmail`
--

INSERT INTO `settingsEmail` (`idsettingsEmail`, `host`, `port`, `username`, `password`, `noReply`, `fromname`, `addCC`) VALUES
(1, 'gator3301.hostgator.com', 26, 'correotest@tanaris.com.mx', 'locker07', 'correotest@tanaris.com.mx', 'CorredurÃ­a 6 y 9', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slide`
--

CREATE TABLE `slide` (
  `idSlide` int(7) NOT NULL,
  `imgPortada` char(150) NOT NULL,
  `imgMovil` char(250) NOT NULL,
  `tipo` tinyint(1) NOT NULL COMMENT '1:home,2:productos,3:beneficios,4:proyectos,5:descargas,6:blog,7:faqs,8:contacto',
  `status` tinyint(1) NOT NULL,
  `orden` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `slide`
--

INSERT INTO `slide` (`idSlide`, `imgPortada`, `imgMovil`, `tipo`, `status`, `orden`) VALUES
(4, 'viveabitare-bbd30467.jpg', '', 1, 1, 2),
(5, 'viveabitare-bdadf0ae.jpg', '', 1, 1, 1),
(6, 'viveabitare-c99ff1a7.jpg', '', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `idSucursal` int(11) NOT NULL,
  `imgPortada` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `telMovil` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `ubicacion` varchar(250) NOT NULL,
  `destacado` tinyint(1) NOT NULL COMMENT '5=Mapa de Contacto',
  `status` tinyint(1) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposusuario`
--

CREATE TABLE `tiposusuario` (
  `idtipousuario` int(11) NOT NULL,
  `nomtipousuario` varchar(255) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiposusuario`
--

INSERT INTO `tiposusuario` (`idtipousuario`, `nomtipousuario`, `status`) VALUES
(1, 'Administrador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuarioxpermiso`
--

CREATE TABLE `tipousuarioxpermiso` (
  `idtipousuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipousuarioxpermiso`
--

INSERT INTO `tipousuarioxpermiso` (`idtipousuario`, `idpermiso`) VALUES
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 28),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 85),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 9),
(1, 10),
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 84),
(1, 86),
(1, 87),
(1, 88),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100),
(1, 101),
(1, 102);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nomusuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(5) NOT NULL,
  `idtipousuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nomusuario`, `password`, `status`, `idtipousuario`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendido`
--

CREATE TABLE `vendido` (
  `id_vendido` int(11) NOT NULL,
  `destacado` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_blog`),
  ADD KEY `fk_blog_categoria1_idx` (`id_categoria`);

--
-- Indices de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`idCatalogo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`idcontacto`);

--
-- Indices de la tabla `contenido_blog`
--
ALTER TABLE `contenido_blog`
  ADD PRIMARY KEY (`id_contenido_blog`),
  ADD KEY `fk_contenido_blog_blog1_idx` (`id_blog`);

--
-- Indices de la tabla `datossucursal`
--
ALTER TABLE `datossucursal`
  ADD PRIMARY KEY (`idDatosSucursal`);

--
-- Indices de la tabla `datos_blog`
--
ALTER TABLE `datos_blog`
  ADD KEY `fk_datos_blog_blog1_idx` (`id_blog`);

--
-- Indices de la tabla `datos_vendido`
--
ALTER TABLE `datos_vendido`
  ADD PRIMARY KEY (`id_datos_vendido`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idEquipo`);

--
-- Indices de la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id_galeria`);

--
-- Indices de la tabla `imgconfig`
--
ALTER TABLE `imgconfig`
  ADD PRIMARY KEY (`idconfiguracion`);

--
-- Indices de la tabla `imgnosotros`
--
ALTER TABLE `imgnosotros`
  ADD PRIMARY KEY (`idimgNosotros`);

--
-- Indices de la tabla `imgSeo`
--
ALTER TABLE `imgSeo`
  ADD PRIMARY KEY (`idimgSeo`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`idlote`);

--
-- Indices de la tabla `manual`
--
ALTER TABLE `manual`
  ADD PRIMARY KEY (`idManual`);

--
-- Indices de la tabla `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`idNewsletter`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `portafolio`
--
ALTER TABLE `portafolio`
  ADD PRIMARY KEY (`idPortafolio`);

--
-- Indices de la tabla `postulante`
--
ALTER TABLE `postulante`
  ADD PRIMARY KEY (`idPostulante`);

--
-- Indices de la tabla `redSocial`
--
ALTER TABLE `redSocial`
  ADD PRIMARY KEY (`idRedSocial`);

--
-- Indices de la tabla `seccionPermiso`
--
ALTER TABLE `seccionPermiso`
  ADD PRIMARY KEY (`idSeccionPermiso`);

--
-- Indices de la tabla `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`idseo`);

--
-- Indices de la tabla `settingsEmail`
--
ALTER TABLE `settingsEmail`
  ADD PRIMARY KEY (`idsettingsEmail`);

--
-- Indices de la tabla `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`idSlide`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`idSucursal`);

--
-- Indices de la tabla `tiposusuario`
--
ALTER TABLE `tiposusuario`
  ADD PRIMARY KEY (`idtipousuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `vendido`
--
ALTER TABLE `vendido`
  ADD PRIMARY KEY (`id_vendido`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blog`
--
ALTER TABLE `blog`
  MODIFY `id_blog` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `idcontacto` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contenido_blog`
--
ALTER TABLE `contenido_blog`
  MODIFY `id_contenido_blog` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `datossucursal`
--
ALTER TABLE `datossucursal`
  MODIFY `idDatosSucursal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datos_vendido`
--
ALTER TABLE `datos_vendido`
  MODIFY `id_datos_vendido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idEquipo` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id_galeria` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imgconfig`
--
ALTER TABLE `imgconfig`
  MODIFY `idconfiguracion` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `imgnosotros`
--
ALTER TABLE `imgnosotros`
  MODIFY `idimgNosotros` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imgSeo`
--
ALTER TABLE `imgSeo`
  MODIFY `idimgSeo` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `idlote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `manual`
--
ALTER TABLE `manual`
  MODIFY `idManual` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `idNewsletter` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `portafolio`
--
ALTER TABLE `portafolio`
  MODIFY `idPortafolio` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `postulante`
--
ALTER TABLE `postulante`
  MODIFY `idPostulante` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `redSocial`
--
ALTER TABLE `redSocial`
  MODIFY `idRedSocial` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `seccionPermiso`
--
ALTER TABLE `seccionPermiso`
  MODIFY `idSeccionPermiso` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `seo`
--
ALTER TABLE `seo`
  MODIFY `idseo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `settingsEmail`
--
ALTER TABLE `settingsEmail`
  MODIFY `idsettingsEmail` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `slide`
--
ALTER TABLE `slide`
  MODIFY `idSlide` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `idSucursal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposusuario`
--
ALTER TABLE `tiposusuario`
  MODIFY `idtipousuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vendido`
--
ALTER TABLE `vendido`
  MODIFY `id_vendido` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
