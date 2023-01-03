-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-01-2023 a las 22:49:51
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_sitiokeops`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` bigint NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `portada` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ruta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `portada`, `datecreated`, `ruta`, `status`) VALUES
(1, 'Hombre', 'Artículos de moda', 'img_b18d875a0e0910f1b658a6310cbe5932.jpg', '2022-12-23 19:30:30', 'Hombre', 1),
(2, 'Audio y video', 'Lo mejor de la tecnología', 'img_9ef25afeebc94ccc5a92d5583b083f91.jpg', '2022-12-23 19:31:35', 'Audio-y-video', 1),
(3, 'Dama', 'Las mejores prendas para dama', 'img_9f8f088969b58d39b5079edcd5674e37.jpg', '2022-12-23 19:32:19', 'Dama', 1),
(4, 'Bolsos', 'Las mejores marcas', 'img_004ebcdc21e4bc6929cddda3c008feb2.jpg', '2022-12-23 19:33:57', 'Bolsos', 1),
(5, 'Reloj', 'Los mejores calzados', 'img_3b2585ca2492891f23032dcb67d5911a.jpg', '2022-12-23 19:34:54', 'Reloj', 1),
(6, 'Gorras', 'Ideal para ti', 'img_bad7a3b1aab2e210dab7494987804cf4.jpg', '2022-12-23 19:35:13', 'Gorras', 1),
(7, 'Tecnologías', 'L a mejor tecnología está en keops', 'img_84d73601acab923a47a576be944646aa.jpg', '2023-01-01 13:52:34', 'Tecnologias', 1),
(8, 'Papelería', 'Servicios de papelería en general', 'img_81d21cde5bc5202d3633bc126f6dc034.jpg', '2023-01-01 13:53:42', 'Papeleria', 1),
(9, 'Internet', 'Servicios de internet con fibra óptica.', 'img_979068c019cacb84c41359a97f5b79a7.jpg', '2023-01-01 13:55:00', 'Internet', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` bigint NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `mensaje` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `dispositivo` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `useragent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id` bigint NOT NULL,
  `pedidoid` bigint NOT NULL,
  `productoid` bigint NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `USD` decimal(11,2) NOT NULL,
  `cantidad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `id` bigint NOT NULL,
  `personaid` bigint NOT NULL,
  `productoid` bigint NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `USD` decimal(11,2) NOT NULL,
  `cantidad` int NOT NULL,
  `transaccionid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int NOT NULL,
  `empresa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `direccion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `whatsapp` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `email_empresa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `email_pedido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `email_suscripcion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `email_contacto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `email_remitente` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `web_empresa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `remitente` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombre_tienda` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `costo_evio` decimal(11,2) NOT NULL,
  `costo_envioP` decimal(11,2) NOT NULL,
  `urlpaypal` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `idcliente_paypal` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `secret_paypal` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `facebook` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `instagram` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `linkedin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `twitter` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `logo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `empresa`, `direccion`, `telefono`, `whatsapp`, `email_empresa`, `email_pedido`, `email_suscripcion`, `email_contacto`, `email_remitente`, `web_empresa`, `remitente`, `descripcion`, `nombre_tienda`, `costo_evio`, `costo_envioP`, `urlpaypal`, `idcliente_paypal`, `secret_paypal`, `facebook`, `instagram`, `linkedin`, `twitter`, `logo`) VALUES
(1, 'Papelería Keops', 'Carrera 7 # 27 - 43', '+(57)3155555555', '+3155555555', 'prueba@outlook.com', 'prueba@outlook.com', 'prueba@gmail.com', 'prueba@hotmail.com', 'no-reply@prueba.com', 'www.prueba.com', 'Tienda Virtual', 'La mejor tienda en línea con artículos de artesanía.', 'TiendaVirtual', '10.00', '47342.52', 'https://api-m.paypal.com', 'AZJW8oTwEax_6DzMF3Sb_LX-Yb6xEIVpGTt_-eFrHMGKLP5vE96BSJYNuWsAPv7lkeestaXOQ-2qH0wJ', 'EMJ-Gc3MM3FHqoINWsFk3xwPf_QvpY3qkCgc4DFus4o78W7krUagRkG87vEIEHxGqgCGGmQka2mGkMqc', 'https://www.facebook.com/THE.BEAUTIFULL.PRETTY', 'https://www.instagram.com', 'https://www.facebook.com', 'https://www.facebook.com', 'img_396bf50de81fdb248f76d18531aaf6dd.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` bigint NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`id`, `descripcion`, `img`) VALUES
(1, 'Sala', 'img_d6d3870d2a4571892c12a13f785d186c.jpg'),
(2, 'Sala', 'img_dbc24c4c30f27fc02527450f231affe7.jpg'),
(3, 'Papelería', 'img_259b459d2f6ffe9e5f1fe2484330e5ac.jpg'),
(4, 'Calzados a la venta', 'img_99a2227a58c38281d25183ad14d218fb.jpg'),
(5, 'Calzados a la venta', 'img_326e653f328c1f1c6f58455c699320e4.jpg'),
(6, 'Papelería', 'img_d70113ea29cc7c50087e4c452cbe3d1b.jpg'),
(7, 'Tecnología', 'img_86f80d8174e773fc6b8846cf7214e5ff.jpg'),
(8, 'Papeleria', 'img_ffddf081e7357783b70cf78908265f55.jpg'),
(9, 'Papelería', 'img_cc3afd675a35624749997002af16748b.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` bigint NOT NULL,
  `productoid` bigint NOT NULL,
  `img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `productoid`, `img`) VALUES
(2, 1, 'pro_004ebcdc21e4bc6929cddda3c008feb2.jpg'),
(3, 1, 'pro_fd848c3419b8581c72c5c1cc6eb42b76.jpg'),
(4, 1, 'pro_3746551c9edb79441ba8024fc90933fa.jpg'),
(5, 2, 'pro_9ef25afeebc94ccc5a92d5583b083f91.jpg'),
(6, 2, 'pro_9129362a57c51203ce2bfc391a2b09ed.jpg'),
(7, 2, 'pro_4af1d310b620c99da69b5737a79477fa.jpg'),
(8, 3, 'pro_9f8f088969b58d39b5079edcd5674e37.jpg'),
(9, 3, 'pro_054a07b367d15fd5cedb1ac4fa54b5e1.jpg'),
(10, 4, 'pro_58a57b67af2994c4c09aa55fe8d0bba4.jpg'),
(11, 4, 'pro_259f3f5229b8ace862c31c5fe3e887ba.jpg'),
(12, 4, 'pro_3b2585ca2492891f23032dcb67d5911a.jpg'),
(13, 4, 'pro_a94168269ff5b7815afe720621120ead.jpg'),
(15, 6, 'pro_75a31e94d3af3082288aa6d756fc69cd.jpg'),
(16, 7, 'pro_850b3a4700f397fbf5fdba64dd0f3330.jpg'),
(17, 8, 'pro_7ba6e9fb7ac48d9067ac0537908a0d05.jpg'),
(18, 9, 'pro_d1df2e24ec14be3560f6c97327a635a7.jpg'),
(19, 9, 'pro_9650ce23c5c1dafd9288c8e535939d5d.jpg'),
(20, 9, 'pro_993b7f341c0db9f68e5174bf45fc1f66.jpg'),
(21, 10, 'pro_e038dae4c3fc2443a9008c851637e950.jpg'),
(22, 10, 'pro_fc6739f797e72f306873200e9483cee2.jpg'),
(23, 5, 'pro_7202221c008905d1a65c1d9ef3e2724c.jpg'),
(24, 5, 'pro_df6bd4cf7ac5160517a81686af70618b.jpg'),
(26, 6, 'pro_d453373d85e4c80b7d770e0f4476a661.jpg'),
(27, 7, 'pro_824f240f76faf13bb996dc7b6b9034ca.jpg'),
(28, 8, 'pro_ba2b7e0a06e70b9d4814f1d033c98a31.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` bigint NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del sistema', 1),
(3, 'Clientes', 'Clientes de tienda', 1),
(4, 'Productos', 'Todos los productos', 1),
(5, 'Pedidos', 'Pedidos', 1),
(6, 'Caterogías', 'Caterogías Productos', 1),
(7, 'Suscriptores', 'Suscriptores del sitio web', 1),
(8, 'Contactos', 'Mensajes del formulario contacto', 1),
(9, 'Páginas', 'Páginas del sitio web', 1),
(10, 'Configuracion', 'Configuracion', 1),
(11, 'Fotos', 'Fotos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` bigint NOT NULL,
  `referenciacobro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `idtransaccionpaypal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `datospaypal` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci,
  `personaid` bigint NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `costo_envio` decimal(11,2) NOT NULL DEFAULT '0.00',
  `costo_envioP` decimal(11,2) NOT NULL DEFAULT '0.00',
  `monto` decimal(11,2) DEFAULT NULL,
  `tipopagoid` bigint NOT NULL,
  `direccion_envio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `USD` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` bigint NOT NULL,
  `rolid` bigint NOT NULL,
  `moduloid` bigint NOT NULL,
  `r` int NOT NULL DEFAULT '0',
  `w` int NOT NULL DEFAULT '0',
  `u` int NOT NULL DEFAULT '0',
  `d` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(2, 1, 2, 1, 1, 1, 1),
(3, 1, 3, 1, 1, 1, 1),
(4, 1, 4, 1, 1, 1, 1),
(5, 1, 5, 1, 1, 1, 1),
(6, 1, 6, 1, 1, 1, 1),
(7, 1, 7, 1, 1, 1, 1),
(8, 1, 8, 1, 1, 1, 1),
(9, 1, 9, 1, 1, 1, 1),
(10, 1, 10, 1, 1, 1, 1),
(11, 2, 1, 1, 1, 1, 1),
(12, 2, 2, 0, 0, 0, 0),
(13, 2, 3, 1, 1, 1, 0),
(14, 2, 4, 0, 0, 0, 0),
(15, 2, 5, 1, 1, 1, 0),
(16, 2, 6, 0, 0, 0, 0),
(17, 2, 7, 1, 0, 0, 0),
(18, 2, 8, 1, 0, 0, 0),
(19, 2, 9, 1, 1, 1, 1),
(20, 3, 1, 1, 0, 0, 0),
(21, 3, 2, 0, 0, 0, 0),
(22, 3, 3, 0, 0, 0, 0),
(23, 3, 4, 0, 0, 0, 0),
(24, 3, 5, 1, 1, 0, 0),
(25, 3, 6, 0, 0, 0, 0),
(26, 3, 7, 0, 0, 0, 0),
(27, 3, 8, 0, 0, 0, 0),
(28, 3, 9, 0, 0, 0, 0),
(29, 4, 1, 1, 0, 0, 0),
(30, 4, 2, 0, 0, 0, 0),
(31, 4, 3, 1, 1, 1, 0),
(32, 4, 4, 1, 0, 0, 0),
(33, 4, 5, 1, 0, 1, 0),
(34, 4, 6, 0, 0, 0, 0),
(35, 4, 7, 1, 0, 0, 0),
(36, 4, 8, 1, 0, 0, 0),
(37, 4, 9, 0, 0, 0, 0),
(38, 2, 10, 0, 0, 0, 0),
(39, 3, 10, 0, 0, 0, 0),
(40, 4, 10, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` bigint NOT NULL,
  `identificacion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `nombres` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `apellidos` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `telefono` bigint NOT NULL,
  `email_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `password` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `nit` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `nombrefiscal` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `direccionfiscal` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `rolid` bigint NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `identificacion`, `nombres`, `apellidos`, `telefono`, `email_user`, `password`, `nit`, `nombrefiscal`, `direccionfiscal`, `token`, `rolid`, `datecreated`, `status`) VALUES
(1, '1077458266', 'Admin', 'Admin', 3155555555, 'prueba@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL, NULL, 'e4142d7420fc55a77fac-46e159442a771efcc217-d3f131729569936a6639-1044b70bbd9bb3d16dcf', 1, '2022-10-23 10:36:08', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `idpost` bigint NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `contenido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `portada` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `datecreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ruta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`idpost`, `titulo`, `contenido`, `portada`, `datecreate`, `ruta`, `status`) VALUES
(1, 'Inicio', '<div class=\"p-t-80\"> <h3 class=\"ltext-103 cl5\">Nuestras marcas</h3> </div> <div> <p>Trabajamos con las mejores marcas del mundo ...</p> </div> <div class=\"row\"> <div class=\"col-md-3\"><img src=\"data:image/png;base64,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\" alt=\"\" width=\"110\" height=\"110\"></div> <div class=\"col-md-3\"><img src=\"https://static.vecteezy.com/system/resources/previews/010/994/431/original/puma-logo-black-symbol-with-name-clothes-design-icon-abstract-football-illustration-with-white-background-free-vector.jpg\" alt=\"\" width=\"110\" height=\"110\"></div> <div class=\"col-md-3\"><img src=\"https://www.brandemia.org/wp-content/uploads/2011/09/logo_nike_principal.jpg\" alt=\"\" width=\"110\" height=\"110\"></div> <div class=\"col-md-3\"><img src=\"https://thumbs.dreamstime.com/b/s%C3%ADmbolo-del-logo-adidas-dise%C3%B1o-de-ropa-icono-abstracto-%C3%ADcono-ropas-ilustraci%C3%B3n-vector-f%C3%BAtbol-253161227.jpg\" alt=\"\" width=\"110\" height=\"110\"></div> <div class=\"col-md-3\">&nbsp;</div> </div>', '', '2021-07-20 02:40:15', 'inicio', 1),
(2, 'Nosotros', '<section class=\"bg0 p-t-75 p-b-120\"> <div class=\"container\"> <div class=\"row p-b-148\"> <div class=\"col-md-7 col-lg-8\"> <div class=\"p-t-7 p-r-85 p-r-15-lg p-r-0-md\"> <h3 class=\"mtext-111 cl2 p-b-16\"><span style=\"color: rgb(224, 62, 45);\">Historia</span></h3> <p class=\"stext-113 cl6 p-b-26\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat consequat enim, non auctor massa ultrices non. Morbi sed odio massa. Quisque at vehicula tellus, sed tincidunt augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas varius egestas diam, eu sodales metus scelerisque congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas gravida justo eu arcu egestas convallis. Nullam eu erat bibendum, tempus ipsum eget, dictum enim. Donec non neque ut enim dapibus tincidunt vitae nec augue. Suspendisse potenti. Proin ut est diam. Donec condimentum euismod tortor, eget facilisis diam faucibus et. Morbi a tempor elit.</p> <p class=\"stext-113 cl6 p-b-26\">Donec gravida lorem elit, quis condimentum ex semper sit amet. Fusce eget ligula magna. Aliquam aliquam imperdiet sodales. Ut fringilla turpis in vehicula vehicula. Pellentesque congue ac orci ut gravida. Aliquam erat volutpat. Donec iaculis lectus a arcu facilisis, eu sodales lectus sagittis. Etiam pellentesque, magna vel dictum rutrum, neque justo eleifend elit, vel tincidunt erat arcu ut sem. Sed rutrum, turpis ut commodo efficitur, quam velit convallis ipsum, et maximus enim ligula ac ligula.</p> <p class=\"stext-113 cl6 p-b-26\">Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879</p> </div> </div> <div class=\"col-11 col-md-5 col-lg-4 m-lr-auto\"> <div class=\"how-bor1 \"> <div class=\"hov-img0\"><img src=\"https://cdn.pixabay.com/photo/2015/07/17/22/43/student-849825_1280.jpg\" alt=\"IMG\" width=\"500\" height=\"333\"></div> </div> </div> </div> <div class=\"row\"> <div class=\"order-md-2 col-md-7 col-lg-8 p-b-30\"> <div class=\"p-t-7 p-l-85 p-l-15-lg p-l-0-md\"> <h2 class=\"mtext-111 cl2 p-b-16\"><span style=\"color: rgb(224, 62, 45); background-color: rgb(255, 255, 255);\">Nuestra Misi&oacute;n</span></h2> <p class=\"stext-113 cl6 p-b-26\">Mauris non lacinia magna. Sed nec lobortis dolor. Vestibulum rhoncus dignissim risus, sed consectetur erat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam maximus mauris sit amet odio convallis, in pharetra magna gravida. Praesent sed nunc fermentum mi molestie tempor. Morbi vitae viverra odio. Pellentesque ac velit egestas, luctus arcu non, laoreet mauris. Sed in ipsum tempor, consequat odio in, porttitor ante. Ut mauris ligula, volutpat in sodales in, porta non odio. Pellentesque tempor urna vitae mi vestibulum, nec venenatis nulla lobortis. Proin at gravida ante. Mauris auctor purus at lacus maximus euismod. Pellentesque vulputate massa ut nisl hendrerit, eget elementum libero iaculis.</p> <div class=\"bor16 p-l-29 p-b-9 m-t-22\"> <p class=\"stext-114 cl6 p-r-40 p-b-11\">Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn\'t really do it, they just saw something. It seemed obvious to them after a while.</p> <span class=\"stext-111 cl8\"> - Steve Job&rsquo;s </span></div> </div> </div> <div class=\"order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30\"> <div class=\"how-bor2\"> <div class=\"hov-img0\"><img src=\"https://cdn.pixabay.com/photo/2015/07/17/22/43/student-849822_1280.jpg\" alt=\"IMG\" width=\"500\" height=\"333\"></div> </div> </div> </div> </div> </section>', 'img_14baeecd1a1ae2db97ffa205c41c601b.jpg', '2021-08-09 03:09:44', 'nosotros', 1),
(3, 'Contacto', '<p><iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7940.244924528484!2d-76.65323309501001!3d5.695440827785409!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e488f7096c3e221%3A0xf5b4bfc5f5fe5b68!2sParque%20San%20Judas%20Tadeo!5e0!3m2!1ses!2sco!4v1671402928411!5m2!1ses!2sco\" width=\"100%\" height=\"600\" allowfullscreen=\"allowfullscreen\" loading=\"lazy\"></iframe></p>', 'img_d7ae5f0ec7041afb6751b7ec8516be49.jpg', '2021-08-09 03:11:08', 'contacto', 1),
(4, 'Preguntas frecuentes', '<ol> <li><strong>&iquest;Cu&aacute;l es el tiempo de entrega de los producto? </strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt! Quae doloribus deserunt qui fugit illo nobis ipsum, accusamus eius perferendis beatae culpa molestias!</li> <li><strong>&iquest;C&oacute;mo es la forma de env&iacute;o de los productos?</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur.</li> <li><strong>&iquest;Cu&aacute;l es el tiempo m&aacute;ximo para solicitar un reembolso?</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt!</li> </ol> <div> <div style=\"text-align: left;\">Otras preguntas</div> <div> <ul> <li><strong>&iquest;Qu&eacute; forma de pago aceptan? </strong></li> </ul> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt!</div> <div>&nbsp;</div> <div> <ul> <li><strong>&iquest;Qu&eacute; forma de pago aceptan? </strong></li> </ul> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt!</div> <div>&nbsp;</div> <div> <ul> <li><strong>&iquest;Qu&eacute; forma de pago aceptan? </strong></li> </ul> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt!</div> <div>&nbsp;</div> <div>&nbsp;</div> <div>&nbsp;</div> </div>', 'img_b64d0a27fce55e3fa2ad8f47dcba5762.jpg', '2021-08-11 01:24:19', 'preguntas-frecuentes', 1),
(5, 'Términos y Condiciones', '<p>A continuaci&oacute;n se describen los t&eacute;rmino y condiciones de la Tienda Virtual!</p> <ol> <li>Pol&iacute;tica uno</li> </ol> <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt! Quae doloribus deserunt qui fugit illo nobis ipsum, accusamus eius perferendis beatae culpa molestias!</p> <ol> <li>Termino dos</li> </ol> <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt! Quae doloribus deserunt qui fugit illo nobis ipsum, accusamus eius perferendis beatae culpa molestias!</p> <ol> <li>Condici&oacute;n tres</li> </ol> <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt! Quae doloribus deserunt qui fugit illo nobis ipsum, accusamus eius perferendis beatae culpa molestias!</p>', '', '2021-08-11 01:51:06', 'terminos-y-condiciones', 1),
(6, 'Sucursales', '<section class=\"py-5 text-center\"> <div class=\"container\"> <p>Visitanos y obten los mejores precios del mercado, cualquier art&iacute;culo que necestas para vivir mejor</p> <a class=\"btn btn-info\" href=\"../../Raices-Chocoanas/tienda\">VER PRODUCTOS</a></div> </section> <div class=\"py-5 bg-light\"> <div class=\"container\"> <div class=\"row\"> <div class=\"col-md-4\"> <div class=\"card mb-4 box-shadow hov-img0\"><img src=\"https://abelosh.com/tienda_virtual/Assets/images/s1.jpg\" alt=\"Tienda Uno\" width=\"100%\" height=\"100%\"> <div class=\"card-body\"> <p class=\"card-text\">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p> <p>Direcci&oacute;n: Antigua Gautemala <br>Tel&eacute;fono: 4654645 <br>Correo: info@abelosh.com</p> </div> </div> </div> <div class=\"col-md-4\"> <div class=\"card mb-4 box-shadow hov-img0\"><img src=\"https://abelosh.com/tienda_virtual/Assets/images/s2.jpg\" alt=\"Sucural dos\" width=\"100%\" height=\"100%\"> <div class=\"card-body\"> <p class=\"card-text\">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p> <p>Direcci&oacute;n: Antigua Gautemala <br>Tel&eacute;fono: 4654645 <br>Correo: info@abelosh.com</p> </div> </div> </div> <div class=\"col-md-4\"> <div class=\"card mb-4 box-shadow hov-img0\"><img src=\"https://abelosh.com/tienda_virtual/Assets/images/s3.jpg\" alt=\"Sucural tres\" width=\"100%\" height=\"100%\"> <div class=\"card-body\"> <p class=\"card-text\">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p> <p>Direcci&oacute;n: Antigua Gautemala <br>Tel&eacute;fono: 4654645 <br>Correo: info@abelosh.com</p> </div> </div> </div> </div> </div> </div>', 'img_24093a706dda067bd8667d4a1bffa970.jpg', '2021-08-11 02:26:45', 'sucursales', 1),
(7, 'Not Found', '<h1>Error 404: P&aacute;gina no encontrada</h1> <p>No se encuentra la p&aacute;gina que ha solicitado.</p>', '', '2021-08-12 02:30:49', 'not-found', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` bigint NOT NULL,
  `categoriaid` bigint NOT NULL,
  `codigo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `stock` int NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ruta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `USD` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `categoriaid`, `codigo`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `datecreated`, `ruta`, `status`, `USD`) VALUES
(1, 1, '1452548', 'Chaquetas para hombres', '<table style=\"border-collapse: collapse; width: 99.8041%; height: 44.7916px;\" border=\"1\"><colgroup><col style=\"width: 50.0088%;\"><col style=\"width: 50.0088%;\"></colgroup> <tbody> <tr style=\"height: 22.3958px;\"> <td style=\"height: 22.3958px;\">Color</td> <td style=\"height: 22.3958px;\">Talla</td> </tr> <tr style=\"height: 22.3958px;\"> <td style=\"height: 22.3958px;\">Azul</td> <td style=\"height: 22.3958px;\">S, M, L</td> </tr> <tr> <td>Blanco</td> <td>L,&nbsp;</td> </tr> </tbody> </table>', '150000.00', 10, NULL, '2022-12-23 19:41:14', 'Chaquetas-para-hombres', 1, '31.71'),
(2, 3, '458526', 'Blusas', '<p style=\"text-align: center;\">Blusas talla &uacute;nica para mujeres</p>', '45000.00', 10, NULL, '2022-12-23 19:52:54', 'Blusas', 1, '9.52'),
(3, 1, '4856245', 'camisas', '<p>Camisas para caballeros</p>', '78000.00', 15, NULL, '2022-12-23 19:55:21', 'camisas', 1, '16.44'),
(4, 5, '485675', 'Reloj', '<p>Las mejores marcas de relojes para caballeros</p>', '110000.00', 5, NULL, '2022-12-23 19:57:18', 'Reloj', 1, '23.18'),
(5, 8, '45265', 'Cuadernos cosidos', '<p style=\"text-align: left;\">&nbsp;Esclusivamente para mujeres</p> <table style=\"border-collapse: collapse; width: 39.6527%;\" border=\"1\"><colgroup><col style=\"width: 50.0024%;\"><col style=\"width: 50.0024%;\"></colgroup> <tbody> <tr> <td style=\"text-align: left;\">Tipo</td> <td style=\"text-align: left;\">Cantidad</td> </tr> <tr> <td>Rayado</td> <td>50 hojas</td> </tr> </tbody> </table>', '10500.00', 5, NULL, '2023-01-01 14:23:21', 'Cuadernos-cosidos', 1, '2.22'),
(6, 8, '548869', 'Cuaderno argollado', '<p>&nbsp;</p> <table style=\"border-collapse: collapse; width: 72.7931%; height: 44.7812px;\" border=\"1\"><colgroup><col style=\"width: 33.4029%;\"><col style=\"width: 33.4029%;\"><col style=\"width: 33.1942%;\"></colgroup> <tbody> <tr style=\"height: 22.3906px;\"> <td style=\"height: 22.3906px;\">Marca</td> <td style=\"height: 22.3906px;\">Cantidad de materias</td> <td style=\"height: 22.3906px;\">Tama&ntilde;o</td> </tr> <tr style=\"height: 22.3906px;\"> <td style=\"height: 22.3906px;\">Primavera</td> <td style=\"height: 22.3906px;\">5 y 7</td> <td style=\"height: 22.3906px;\">Grande</td> </tr> </tbody> </table> <p>&nbsp;</p>', '24990.00', 6, NULL, '2023-01-01 14:27:44', 'Cuaderno-argollado', 1, '5.28'),
(7, 8, '45869', 'lapiceros', '<p>Marca bic-cristal</p>', '1500.00', 10, NULL, '2023-01-01 14:39:04', 'lapiceros', 1, '0.32'),
(8, 8, '48652', 'lapiceros telaviv', '<p>Marca telaviv-touch</p>', '1800.00', 10, NULL, '2023-01-01 14:40:02', 'lapiceros-telaviv', 1, '0.38'),
(9, 7, '98562', 'Portatil', '<p style=\"text-align: center;\">Juega, graba y transmite simult&aacute;neamente sin limitaciones gracias procesadores hasta Intel&reg; Core&trade; i7 de 11va generaci&oacute;n: optimizados para rendir al m&aacute;ximo. Juega la mayor&iacute;a de juegos triple A en Full HD. Experimenta velocidades Gigabit WiFi ultrarr&aacute;pidas y conexiones confiables con WiFi 6.</p>', '2700000.00', 5, NULL, '2023-01-01 14:42:52', 'Portatil', 1, '570.90'),
(10, 9, '85624', 'Servicio de Internet', '<p style=\"text-align: center;\">Valor tiempo de uso para nuestros clientes.</p> <table style=\"border-collapse: collapse; width: 100%;\" border=\"1\"><colgroup><col style=\"width: 25.0725%;\"><col style=\"width: 25.0725%;\"><col style=\"width: 25.0725%;\"><col style=\"width: 24.7826%;\"></colgroup> <tbody> <tr> <td>15 minutos</td> <td>30 minutos</td> <td>45 minutos</td> <td>60 minutos</td> </tr> <tr> <td>$500</td> <td>$1.000</td> <td>$1.500</td> <td>$2.000</td> </tr> </tbody> </table> <p>&nbsp;</p> <p style=\"text-align: center;\">Te invitamos a que nos visites.</p>', '500.00', 1, NULL, '2023-01-01 14:49:13', 'Servicio-de-Internet', 1, '0.11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reembolso`
--

CREATE TABLE `reembolso` (
  `id` bigint NOT NULL,
  `pedidoid` bigint NOT NULL,
  `idtransaccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `datosreembolso` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `observacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint NOT NULL,
  `nombrerol` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(1, 'Administrador', 'Acceso a todo el sistema', 1),
(2, 'Supervisor', 'Supervisor de tiendas', 1),
(3, 'Cliente', 'Clientes en general', 1),
(4, 'Vendedor', 'Operador de tienda', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripciones`
--

CREATE TABLE `suscripciones` (
  `idsuscripcion` bigint NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

CREATE TABLE `tipopago` (
  `idtipopago` bigint NOT NULL,
  `tipopago` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `tipopago`
--

INSERT INTO `tipopago` (`idtipopago`, `tipopago`, `status`) VALUES
(1, 'PayPal', 1),
(2, 'Efectivo', 1),
(3, 'Tarjeta', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidoid` (`pedidoid`),
  ADD KEY `productoid` (`productoid`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productoid` (`productoid`),
  ADD KEY `personaid` (`personaid`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productoid` (`productoid`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `personaid` (`personaid`),
  ADD KEY `tipopagoid` (`tipopagoid`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `rolid` (`rolid`),
  ADD KEY `moduloid` (`moduloid`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD KEY `rolid` (`rolid`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idpost`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `categoriaid` (`categoriaid`);

--
-- Indices de la tabla `reembolso`
--
ALTER TABLE `reembolso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidoid` (`pedidoid`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  ADD PRIMARY KEY (`idsuscripcion`);

--
-- Indices de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  ADD PRIMARY KEY (`idtipopago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `idpost` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `reembolso`
--
ALTER TABLE `reembolso`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  MODIFY `idsuscripcion` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  MODIFY `idtipopago` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedidoid`) REFERENCES `pedido` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
