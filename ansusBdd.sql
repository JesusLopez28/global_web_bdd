-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-08-2023 a las 18:55:03
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ansus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_token`
--

CREATE TABLE `auth_token` (
  `ID` int(11) NOT NULL COMMENT 'ID Token',
  `user_id` int(11) DEFAULT NULL COMMENT 'ID Usuario',
  `token` varchar(255) DEFAULT NULL COMMENT 'Token',
  `creation_date` datetime DEFAULT current_timestamp() COMMENT 'Fecha'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auth_token`
--

INSERT INTO `auth_token` (`ID`, `user_id`, `token`, `creation_date`) VALUES
(1, 1, 'PswC4HWu5qWPTcxVpB4u0Je3jTp5wMEywwY4pRt48unCbKyUCBsv5Qa8LPXi', '2023-08-16 20:43:04'),
(2, 1, 'vLWlMxCKpuwBrMz7LsCVvYpVeHc25JXGgWuyerrI4cjC0PxLmWFy3rzaoj9k', '2023-08-16 23:39:40'),
(3, 1, 'Ksoq0bwyYR3bY10DUA4o69Cldcsn2j7YwaNH6SXrwFdbhLLFABd8vvtaPK5o', '2023-08-16 23:42:24'),
(4, 1, 'naal7e3ZdlO4rhuzwcvV9bC2kxVsKinz07bidXSoMd9N6K9abnriWBTqDpVl', '2023-08-16 23:43:31'),
(5, 1, '4eZzMT5xBwfBWshsVOtHnF7LjAPSnH1VPYuBg83rzTjoWnrfomuFnLsgCdEp', '2023-08-16 23:45:13'),
(6, 1, '8nbWE3L59hLe0yqCk1a5t47LESm3sAiZkZiLYMTXXVoaLOur5EGMCDf4Wdzv', '2023-08-16 23:47:40'),
(7, 1, '8qVraXazK9aZFUheXVPcZN4qJqHDbzdbY3eWR58eKrlkbH2tOMAUVuKa6Wvm', '2023-08-17 01:00:18'),
(8, 1, 'spZxFr5F1kP7PtFtDzIr7C514FmU3eJT3dA7TBFP6u54NgbEDEVvYdkFTCpM', '2023-08-17 01:02:20'),
(9, 2, 'CSXLj1pgB4xodvKZ3lIwqjCV3zokvLl3Wx1ftwfQ9qhxSoYJwDq8yBaRXZax', '2023-08-17 03:15:53'),
(10, 2, 'FPE4wGdxS7dAGhB0IcEId8MlmbXL5iINDhPi3hxsNbrSgqrLq8tHKvOXEigZ', '2023-08-17 03:19:14'),
(11, 1, 'YSx0DpQZ3f1M9SJn0rB17z7LQN1fgVGWo4voSjztn3FhqMHjhcK6R1mGGjzu', '2023-08-17 08:48:59'),
(12, 2, 'ovP7YGn1QnMj5xOpSNqNsYMfTEMqM60z8L1GSHibLWKie9ul8DVkHnfFeY5D', '2023-08-17 08:50:11'),
(13, 2, 'SlMGJYwhtKAJDX6kzRJnWLJJ6pFfYor2Z0XPEAbbLJVD8LBDcq7aRVPUdZ1O', '2023-08-17 09:44:05'),
(14, 2, 'lZgHJnKomOHjr7p9DmfmtfpVHiLkwjfieVzgQLqqvDtOaihAsg9ytCWVJefs', '2023-08-17 09:46:16'),
(15, 2, 'dQHBrE2S4D2hHgeY95jET5ePlhResyDLhpP8JN5EygEHMInM16g0UlYpM8y4', '2023-08-17 09:49:05'),
(16, 2, 'BWYkoLCVPsnVsOJvyCCi0wWu2PDqndK2fNljupn5SvEQY2szHyVkHnSXyRng', '2023-08-17 09:50:40'),
(17, 2, 'cqtBdUExKneg9YEcOZzU6mBmpieiaLXBpPnNcekknTow4eMcfdhteRE7KRuZ', '2023-08-17 09:51:58'),
(18, 2, 'rcEV9dnIC96LT4vv6R4RxiXuG55bA9lV4vwHXwoyyg2Z6xyhtr1f3mJuKwUJ', '2023-08-17 09:53:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `name` varchar(255) DEFAULT NULL COMMENT 'Categoria',
  `description` text DEFAULT NULL COMMENT 'Descripcion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Sofás', 'Categoría de muebles para sentarse y relajarse.'),
(2, 'Mesas', 'Categoría de muebles planos con superficie.'),
(3, 'Sillas', 'Categoría de asientos individuales.'),
(4, 'Camas', 'Categoría de muebles para dormir.'),
(5, 'Escritorios', 'Categoría de superficies de trabajo.'),
(6, 'Colchones', 'Categoría de superficies para dormir.'),
(7, 'Cómodas', 'Categoría de muebles con cajones para almacenamiento.'),
(8, 'Comedores', 'Categoría de muebles para comer y reuniones.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `user_id` int(11) DEFAULT NULL COMMENT 'ID Usuario',
  `order_date` datetime DEFAULT current_timestamp() COMMENT 'Fecha',
  `status` enum('confirmado','cancelado') DEFAULT 'confirmado' COMMENT 'Estatus',
  `total` decimal(10,2) DEFAULT NULL COMMENT 'Total'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `status`, `total`) VALUES
(1, 1, '2023-08-17 02:23:34', 'confirmado', 100.00),
(2, 2, '2023-08-17 02:23:54', 'confirmado', 100.00),
(3, 2, '2023-08-17 02:24:25', 'cancelado', 100.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `oreder_id` int(11) DEFAULT NULL COMMENT 'ID Pedido',
  `product_id` int(11) DEFAULT NULL COMMENT 'ID Producto',
  `quantity` int(11) DEFAULT NULL COMMENT 'Cantidad',
  `subtotal` decimal(10,2) DEFAULT NULL COMMENT 'Subtotal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `name` varchar(255) DEFAULT NULL COMMENT 'Producto',
  `price` decimal(10,2) DEFAULT NULL COMMENT 'Precio',
  `category_id` int(11) DEFAULT NULL COMMENT 'ID Categoria',
  `stock` int(11) DEFAULT NULL COMMENT 'Stock',
  `image` varchar(255) DEFAULT NULL COMMENT 'Imagen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category_id`, `stock`, `image`) VALUES
(1, 'Sofá café', 4200.00, 1, 100, 'sofaCafe.png'),
(2, 'Mesa de madera', 3100.00, 2, 75, 'mesaMadera.png'),
(3, 'Silla acolchonada', 1500.00, 3, 50, 'sillaAcolchonada.png'),
(4, 'Cama Tapizada', 6000.00, 4, 200, 'camaTapizada.png'),
(5, 'Escritorio de Oficina', 4800.00, 5, 30, 'escritorioOficina.png'),
(6, 'Colchon Matrimonial', 59000.00, 6, 150, 'colchonMatrimonial.png'),
(7, 'Comoda de Madera', 1500.00, 7, 80, 'comodaMadera.png'),
(8, 'Comedor Pequeño', 8200.00, 8, 60, 'comedorPeque.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `user_id` int(11) DEFAULT NULL COMMENT 'ID Usuario',
  `product_id` int(11) DEFAULT NULL COMMENT 'ID Producto',
  `quantity` int(11) DEFAULT NULL COMMENT 'Cantidad',
  `subtotal` decimal(10,2) DEFAULT NULL COMMENT 'Subtotal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `shopping_cart`
--

INSERT INTO `shopping_cart` (`id`, `user_id`, `product_id`, `quantity`, `subtotal`) VALUES
(1, NULL, 1, 1, 4200.00),
(2, 2, 1, 20, 4200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL COMMENT 'ID Usuario',
  `name` varchar(255) DEFAULT NULL COMMENT 'Nombre',
  `last_name` varchar(255) DEFAULT NULL COMMENT 'Apellido',
  `email` varchar(255) DEFAULT NULL COMMENT 'Correo',
  `phone` varchar(255) NOT NULL COMMENT 'Telefono',
  `password` varchar(255) DEFAULT NULL COMMENT 'Contrasena',
  `role` enum('cliente','administrador') DEFAULT 'cliente' COMMENT 'Rol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID`, `name`, `last_name`, `email`, `phone`, `password`, `role`) VALUES
(1, 'Jesus', 'Lopez', 'administrador@ansus.com', '3336013722', 'Admin123#', 'administrador'),
(2, 'Alejandro', 'Lopez', 'jesale.lopro@gmai.com', '3334610109', 'Chuy123#', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth_token`
--
ALTER TABLE `auth_token`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oreder_id` (`oreder_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auth_token`
--
ALTER TABLE `auth_token`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Token', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Usuario', AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_token`
--
ALTER TABLE `auth_token`
  ADD CONSTRAINT `auth_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Filtros para la tabla `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`oreder_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Filtros para la tabla `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
