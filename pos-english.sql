-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2025 a las 09:04:11
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
-- Base de datos: `pos-english`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prorateo_type` enum('Equitativo','Asignado') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `prorateo_type`, `created_at`) VALUES
(1, 'Luz', 'Pago de electricidad común', 'Equitativo', '2025-02-05 07:12:20'),
(2, 'Agua', 'Pago del consumo de agua', 'Equitativo', '2025-02-05 07:12:20'),
(3, 'Mantenimiento', 'Reparaciones y mantenimiento del edificio', 'Asignado', '2025-02-05 07:12:20'),
(4, 'Otros', 'Gastos misceláneos', 'Asignado', '2025-02-05 07:12:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `idDocument` int(11) NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `birthdate` date NOT NULL,
  `purchases` int(11) NOT NULL,
  `lastPurchase` datetime NOT NULL,
  `registerDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `name`, `idDocument`, `email`, `phone`, `address`, `birthdate`, `purchases`, `lastPurchase`, `registerDate`) VALUES
(2, 'Jane Doe', 123456785, 'jane@gmail.com', '(555) 789-9045', 'Carlfield 55', '1983-06-22', 4, '2018-12-02 11:54:08', '2018-12-02 16:54:08'),
(3, 'Juan Villegas', 12344321, 'juan@gmail.com', '(305) 455-6677', 'Main Street 45', '1976-04-12', 5, '2018-12-11 08:44:50', '2018-12-11 13:44:50'),
(4, 'Andrew Wallace', 256548520, 'andrew@gmail.com', '(305) 256-6541', 'Abbey Road 45', '1989-08-15', 0, '0000-00-00 00:00:00', '2018-12-11 13:48:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `number` varchar(10) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `area` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`id`, `number`, `owner_id`, `area`, `created_at`) VALUES
(1, '101', 1, 80.00, '2025-02-05 07:13:53'),
(2, '102', 2, 95.00, '2025-02-05 07:13:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expences`
--

CREATE TABLE `expences` (
  `id` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `code` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `stock` int(11) NOT NULL,
  `buyingPrice` float NOT NULL,
  `sellingPrice` float NOT NULL,
  `sales` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `expense_date` date NOT NULL,
  `period_id` int(11) NOT NULL,
  `category` enum('Luz','Agua','Mantenimiento','Otros') NOT NULL,
  `prorateo_type` enum('Equitativo','Asignado') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expense_shares`
--

CREATE TABLE `expense_shares` (
  `id` int(11) NOT NULL,
  `expense_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `share` decimal(10,2) NOT NULL,
  `prorateo_type` enum('Equitativo','Asignado') NOT NULL,
  `period` varchar(7) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periods`
--

CREATE TABLE `periods` (
  `id` int(11) NOT NULL,
  `period` varchar(7) NOT NULL,
  `start_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `status` enum('Abierto','Cerrado','Vencido') DEFAULT 'Abierto',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periods`
--

INSERT INTO `periods` (`id`, `period`, `start_date`, `expiration_date`, `status`, `created_at`) VALUES
(20, '2022-01', '2022-01-01', '2022-02-10', 'Cerrado', '2025-02-05 07:59:30'),
(21, '2022-02', '2022-02-01', '2022-03-10', 'Cerrado', '2025-02-05 07:59:30'),
(22, '2023-01', '2023-01-01', '2023-02-10', 'Cerrado', '2025-02-05 07:59:30'),
(23, '2023-02', '2023-02-01', '2023-03-10', 'Cerrado', '2025-02-05 07:59:30'),
(24, '2024-01', '2024-01-01', '2024-02-10', 'Abierto', '2025-02-05 07:59:30'),
(25, '2024-02', '2024-02-01', '2024-03-10', 'Abierto', '2025-02-05 07:59:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `code` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `stock` int(11) NOT NULL,
  `buyingPrice` float NOT NULL,
  `sellingPrice` float NOT NULL,
  `sales` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `idCategory`, `code`, `description`, `image`, `stock`, `buyingPrice`, `sellingPrice`, `sales`, `date`) VALUES
(1, 1, '101', 'Industrial vacuum cleaner', 'views/img/products/101/622.png', 9, 1500, 2100, 1, '2018-12-02 16:54:08'),
(2, 1, '102', 'Floating Plate for Palletizer', 'views/img/products/102/495.jpg', 14, 4500, 6300, 1, '2018-12-02 16:54:08'),
(3, 1, '103', 'Air Compressor for painting', 'views/img/products/103/712.jpg', 18, 3000, 4200, 2, '2018-12-02 16:54:08'),
(4, 1, '104', 'Brick Cutter without Disk', 'views/img/products/104/188.jpg', 20, 4000, 5600, 5, '2018-12-03 05:01:21'),
(5, 1, '105', 'Floor Cutter without Disk', 'views/img/products/105/970.jpg', 15, 1540, 2156, 15, '2018-12-11 13:44:50'),
(6, 1, '106', 'Diamond Tip Disk', 'views/img/products/106/129.jpg', 20, 1100, 1540, 0, '2018-12-03 04:05:28'),
(7, 1, '107', 'Air extractor', 'views/img/products/107/871.jpg', 20, 1540, 2156, 0, '2018-11-08 22:00:22'),
(8, 1, '108', 'Mower', 'views/img/products/108/484.jpg', 20, 1540, 2156, 0, '2018-11-08 22:00:38'),
(9, 1, '109', 'Electric Water Washer', 'views/img/products/109/332.jpg', 19, 2600, 3640, 1, '2018-12-11 13:50:16'),
(10, 1, '110', 'Petrol pressure washer', 'views/img/products/110/424.jpg', 20, 2210, 3094, 0, '2018-11-08 22:01:01'),
(11, 1, '111', 'Gasoline motor pump', 'views/img/products/default/anonymous.png', 20, 2860, 4004, 0, '2018-11-08 21:27:44'),
(12, 1, '112', 'Electric motor pump', 'views/img/products/default/anonymous.png', 20, 2400, 3360, 0, '2018-11-08 21:27:44'),
(13, 1, '113', 'Circular saw', 'views/img/products/default/anonymous.png', 20, 1100, 1540, 0, '2018-11-08 21:27:44'),
(14, 1, '114', 'Tungsten disc for circular saw', 'views/img/products/default/anonymous.png', 20, 4500, 6300, 0, '2018-11-08 21:27:44'),
(15, 1, '115', 'Electric welder', 'views/img/products/default/anonymous.png', 20, 1980, 2772, 0, '2018-11-08 21:27:44'),
(16, 1, '116', 'Welders face', 'views/img/products/default/anonymous.png', 20, 4200, 5880, 0, '2018-11-08 21:27:44'),
(17, 1, '117', 'Illumination tower', 'views/img/products/default/anonymous.png', 20, 1800, 2520, 0, '2018-11-08 21:27:44'),
(18, 2, '201', 'Floor Demolishing Hammer 110V', 'views/img/products/default/anonymous.png', 20, 5600, 7840, 0, '2018-11-08 21:27:44'),
(19, 2, '202', 'Muela or chisel hammer demolishing floor', 'views/img/products/default/anonymous.png', 20, 9600, 13440, 0, '2018-11-08 21:27:44'),
(20, 2, '203', 'Wall Wrecking Drill 110V', 'views/img/products/default/anonymous.png', 20, 3850, 5390, 0, '2018-11-08 21:27:44'),
(21, 2, '204', 'Muela or chisel hammer demolition wall', 'views/img/products/default/anonymous.png', 20, 9600, 13440, 0, '2018-11-08 21:27:44'),
(22, 2, '205', '1/2 Hammer Drill Wood and Metal', 'views/img/products/default/anonymous.png', 20, 8000, 11200, 0, '2018-11-08 21:27:44'),
(23, 2, '206', 'Drill Percussion SDS Plus 110V', 'views/img/products/default/anonymous.png', 20, 3900, 5460, 0, '2018-11-08 21:27:44'),
(24, 2, '207', 'Drill Percussion SDS Max 110V (Mining)', 'views/img/products/default/anonymous.png', 20, 4600, 6440, 0, '2018-11-08 21:27:44'),
(25, 3, '301', 'Hanging scaffolding', 'views/img/products/default/anonymous.png', 20, 1440, 2016, 0, '2018-11-08 21:27:44'),
(26, 3, '302', 'Scaffolding hanging spacer', 'views/img/products/default/anonymous.png', 20, 1600, 2240, 0, '2018-11-08 21:27:44'),
(27, 3, '303', 'Modular scaffolding frame', 'views/img/products/default/anonymous.png', 20, 900, 1260, 0, '2018-11-08 21:27:44'),
(28, 3, '304', 'Frame scaffolding scissors', 'views/img/products/default/anonymous.png', 20, 100, 140, 0, '2018-11-08 21:27:44'),
(29, 3, '305', 'Scaffolding scissors', 'views/img/products/default/anonymous.png', 20, 162, 226, 0, '2018-11-08 21:27:44'),
(30, 3, '306', 'Internal ladder for scaffolding', 'views/img/products/default/anonymous.png', 20, 270, 378, 0, '2018-11-08 21:27:44'),
(31, 3, '307', 'Security handrails', 'views/img/products/default/anonymous.png', 20, 75, 105, 0, '2018-11-08 21:27:44'),
(32, 3, '308', 'Rotating wheel for scaffolding', 'views/img/products/default/anonymous.png', 20, 168, 235, 0, '2018-11-08 21:27:44'),
(33, 3, '309', 'safety harness', 'views/img/products/default/anonymous.png', 20, 1750, 2450, 0, '2018-11-08 21:27:44'),
(34, 3, '310', 'Sling for harness', 'views/img/products/default/anonymous.png', 20, 175, 245, 0, '2018-11-08 21:27:44'),
(35, 3, '311', 'Metallic Platform', 'views/img/products/default/anonymous.png', 20, 420, 588, 0, '2018-11-08 21:27:44'),
(36, 4, '401', '6 Kva Diesel Power Plant', 'views/img/products/default/anonymous.png', 20, 3500, 4900, 0, '2018-11-08 21:27:44'),
(37, 4, '402', '10 Kva Diesel Power Plant', 'views/img/products/default/anonymous.png', 20, 3550, 4970, 0, '2018-11-08 21:27:44'),
(38, 4, '403', '20 Kva Diesel Power Plant', 'views/img/products/default/anonymous.png', 20, 3600, 5040, 0, '2018-11-08 21:27:44'),
(39, 4, '404', '30 Kva Diesel Power Plant', 'views/img/products/default/anonymous.png', 20, 3650, 5110, 0, '2018-11-08 21:27:44'),
(40, 4, '405', '60 Kva Diesel Power Plant', 'views/img/products/default/anonymous.png', 20, 3700, 5180, 0, '2018-11-08 21:27:44'),
(41, 4, '406', '75 Kva Diesel Power Plant', 'views/img/products/default/anonymous.png', 20, 3750, 5250, 0, '2018-11-08 21:27:44'),
(42, 4, '407', '100 Kva Diesel Power Plant', 'views/img/products/default/anonymous.png', 20, 3800, 5320, 0, '2018-11-08 21:27:44'),
(43, 4, '408', '120 Kva Diesel Power Plant', 'views/img/products/default/anonymous.png', 20, 3850, 5390, 0, '2018-11-08 21:27:44'),
(44, 5, '501', 'Aluminum Scissor Ladder', 'views/img/products/default/anonymous.png', 20, 350, 490, 0, '2018-11-08 21:27:44'),
(45, 5, '502', 'Electric extension', 'views/img/products/default/anonymous.png', 20, 370, 518, 0, '2018-11-08 21:27:44'),
(46, 5, '503', 'Tensioner cat', 'views/img/products/default/anonymous.png', 20, 380, 532, 0, '2018-11-08 21:27:44'),
(47, 5, '504', 'Lamina Covers Gap', 'views/img/products/default/anonymous.png', 20, 380, 532, 0, '2018-11-08 21:27:44'),
(48, 5, '505', 'Pipe wrench', 'views/img/products/default/anonymous.png', 20, 480, 672, 0, '2018-11-08 21:27:44'),
(49, 5, '506', 'Manila by Metro', 'views/img/products/default/anonymous.png', 20, 600, 840, 0, '2018-11-08 21:27:44'),
(50, 5, '507', '2-channel pulley', 'views/img/products/default/anonymous.png', 20, 900, 1260, 0, '2018-11-08 21:27:44'),
(51, 5, '508', 'Tensor', 'views/img/products/default/anonymous.png', 20, 100, 140, 0, '2018-11-08 21:27:44'),
(52, 5, '509', 'Weighing machine', 'views/img/products/default/anonymous.png', 20, 130, 182, 0, '2018-11-08 21:27:44'),
(53, 5, '510', 'Hydrostatic pump', 'views/img/products/default/anonymous.png', 20, 770, 1078, 0, '2018-11-08 21:27:44'),
(54, 5, '511', 'Chapeta', 'views/img/products/default/anonymous.png', 20, 660, 924, 0, '2018-11-08 21:27:44'),
(55, 5, '512', 'Concrete sample cylinder', 'views/img/products/default/anonymous.png', 20, 400, 560, 0, '2018-11-08 21:27:44'),
(56, 5, '513', 'Lever Shear', 'views/img/products/default/anonymous.png', 20, 450, 630, 0, '2018-11-08 21:27:44'),
(57, 5, '514', 'Scissor Shear', 'views/img/products/default/anonymous.png', 20, 580, 812, 0, '2018-11-08 21:27:44'),
(58, 5, '515', 'Pneumatic tire car', 'views/img/products/default/anonymous.png', 20, 420, 588, 0, '2018-11-08 21:27:44'),
(59, 5, '516', 'Cone slump', 'views/img/products/default/anonymous.png', 20, 140, 196, 0, '2018-11-08 21:27:44'),
(60, 5, '517', 'Baldosin cutter', 'views/img/products/default/anonymous.png', 20, 930, 1302, 0, '2018-11-08 21:27:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `phone_number`, `address`, `created_at`, `updated_at`) VALUES
(2, 4, 'Felipe', 'Diaz', '+56964293579', 'Padre Rene Pienovi 755 depto 403', '2025-02-05 05:41:13', '2025-02-05 05:42:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Usuario con acceso completo al sistema.', '2025-02-05 05:38:40', '2025-02-05 05:38:40'),
(2, 'Editor', 'Puede crear, editar y eliminar contenido.', '2025-02-05 05:38:40', '2025-02-05 05:38:40'),
(3, 'Viewer', 'Solo puede visualizar el contenido.', '2025-02-05 05:38:40', '2025-02-05 05:38:40'),
(4, 'Moderator', 'Responsable de moderar interacciones.', '2025-02-05 05:38:40', '2025-02-05 05:38:40'),
(5, 'Customer', 'Usuario cliente con acceso limitado.', '2025-02-05 05:38:40', '2025-02-05 05:38:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `idSeller` int(11) NOT NULL,
  `products` text NOT NULL,
  `tax` int(11) NOT NULL,
  `netPrice` float NOT NULL,
  `totalPrice` float NOT NULL,
  `paymentMethod` text NOT NULL,
  `saledate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` (`id`, `code`, `idCustomer`, `idSeller`, `products`, `tax`, `netPrice`, `totalPrice`, `paymentMethod`, `saledate`) VALUES
(9, 10001, 2, 2, '[{\"id\":\"1\",\"description\":\"Industrial vacuum cleaner\",\"quantity\":\"1\",\"stock\":\"9\",\"price\":\"2100\",\"totalPrice\":\"2100\"},{\"id\":\"2\",\"description\":\"Floating Plate for Palletizer\",\"quantity\":\"1\",\"stock\":\"14\",\"price\":\"6300\",\"totalPrice\":\"6300\"},{\"id\":\"3\",\"description\":\"Air Compressor for painting\",\"quantity\":\"2\",\"stock\":\"18\",\"price\":\"4200\",\"totalPrice\":\"8400\"}]', 3192, 16800, 19992, 'CC-321321321', '2018-11-02 16:54:08'),
(11, 10002, 1, 1, '[{\"id\":\"4\",\"description\":\"Brick Cutter without Disk\",\"quantity\":\"5\",\"stock\":\"20\",\"price\":\"5600\",\"totalPrice\":\"28000\"},{\"id\":\"5\",\"description\":\"Floor Cutter without Disk\",\"quantity\":\"10\",\"stock\":\"20\",\"price\":\"2156\",\"totalPrice\":\"21560\"}]', 9416, 49560, 58976, 'DC-1234512345', '2018-12-04 00:53:28'),
(12, 10003, 3, 1, '[{\"id\":\"5\",\"description\":\"Floor Cutter without Disk\",\"quantity\":\"5\",\"stock\":\"15\",\"price\":\"2156\",\"totalPrice\":\"10780\"}]', 2048, 10780, 12828, 'cash', '2018-12-11 13:44:50'),
(13, 10004, 5, 2, '[{\"id\":\"9\",\"description\":\"Electric Water Washer\",\"quantity\":\"1\",\"stock\":\"19\",\"price\":\"3640\",\"totalPrice\":\"3640\"}]', 692, 3640, 4332, 'CC-1265489251', '2018-12-11 13:50:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `user` text NOT NULL,
  `password` text NOT NULL,
  `profile` text NOT NULL,
  `photo` text NOT NULL,
  `status` int(1) NOT NULL,
  `lastLogin` datetime NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `user`, `password`, `profile`, `photo`, `status`, `lastLogin`, `date`) VALUES
(4, 'Felipe Diaz', 'devtechnical', '$2a$07$asxx54ahjppf45sd87a5auIpMs39PqncHxzLqRBDqf0NYTyh4XBD.', 'Administrator', '', 1, '2025-02-05 02:23:22', '2025-02-05 05:23:22'),
(5, 'Angelica Ulloa', 'angeulloa', '$2a$07$asxx54ahjppf45sd87a5auIpMs39PqncHxzLqRBDqf0NYTyh4XBD.', 'Sostenedor', '', 1, '2025-02-05 04:50:52', '2025-02-05 07:50:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`, `assigned_at`) VALUES
(4, 1, '2025-02-05 05:48:27'),
(4, 2, '2025-02-05 05:48:27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Indices de la tabla `expences`
--
ALTER TABLE `expences`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_id` (`period_id`);

--
-- Indices de la tabla `expense_shares`
--
ALTER TABLE `expense_shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_id` (`expense_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indices de la tabla `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `period` (`period`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `expences`
--
ALTER TABLE `expences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `expense_shares`
--
ALTER TABLE `expense_shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `periods`
--
ALTER TABLE `periods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `expense_shares`
--
ALTER TABLE `expense_shares`
  ADD CONSTRAINT `expense_shares_ibfk_1` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expense_shares_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
