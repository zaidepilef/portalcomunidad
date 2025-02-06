-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-02-2025 a las 05:36:09
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
-- Base de datos: `pos-communities`
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
(1, 'Luz', 'Pago de electricidad común', 'Equitativo', '2025-02-05 15:27:36'),
(2, 'Agua', 'Pago del consumo de agua', 'Equitativo', '2025-02-05 15:27:36'),
(3, 'Mantenimiento', 'Reparaciones y mantenimiento del edificio', 'Asignado', '2025-02-05 15:27:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidades`
--

CREATE TABLE `comunidades` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comunidades`
--

INSERT INTO `comunidades` (`id`, `name`, `empresa_id`, `address`, `created_at`) VALUES
(1, 'Comunidad Los Robles', 1, 'Calle de Los Robles 50', '2025-02-05 15:27:36'),
(2, 'Comunidad Las Palmas', 2, 'Avenida Las Palmas 300', '2025-02-05 15:27:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `comunidad_id` int(11) NOT NULL,
  `number` varchar(10) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `area` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`id`, `comunidad_id`, `number`, `owner_id`, `area`, `created_at`) VALUES
(1, 1, '101', 2, 80.00, '2025-02-05 15:27:36'),
(2, 1, '102', 3, 95.00, '2025-02-05 15:27:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `name`, `contact_email`, `phone`, `address`, `created_at`) VALUES
(1, 'Empresa ABC', 'contacto@empresaabc.com', '123456789', 'Calle 123, Ciudad', '2025-02-05 15:27:36'),
(2, 'Empresa XYZ', 'info@empresaxyz.com', '987654321', 'Avenida Principal 456', '2025-02-05 15:27:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `comunidad_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `expense_date` date NOT NULL,
  `period_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `expenses`
--

INSERT INTO `expenses` (`id`, `comunidad_id`, `description`, `amount`, `expense_date`, `period_id`, `category_id`, `created_at`) VALUES
(1, 1, 'Pago de luz 2023', 450.00, '2023-01-05', 1, 1, '2025-02-05 15:27:36'),
(2, 1, 'Mantenimiento ascensores 2024', 900.00, '2024-01-20', 2, 3, '2025-02-05 15:27:36');

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
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comunidad_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `period_id` int(11) NOT NULL,
  `status` enum('Pendiente','Pagado','Vencido') DEFAULT 'Pendiente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `comunidad_id`, `amount`, `payment_date`, `period_id`, `status`, `created_at`) VALUES
(1, 2, 1, 450.00, '2023-01-10', 1, 'Pagado', '2025-02-05 15:27:36'),
(2, 3, 1, 900.00, '2024-01-22', 2, 'Pendiente', '2025-02-05 15:27:36');

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
(1, '2023-01', '2023-01-01', '2023-02-10', 'Cerrado', '2025-02-05 15:27:36'),
(2, '2024-01', '2024-01-01', '2024-02-10', 'Abierto', '2025-02-05 15:27:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `run` varchar(16) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(1024) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `run`, `first_name`, `last_name`, `phone_number`, `address`, `photo`, `created_at`, `updated_at`) VALUES
(1, 1, '1-9', 'Ougt', 'Malakias', '123456789', 'Calle Admin 1', '', '2025-02-05 15:27:36', '2025-02-05 23:21:52'),
(2, 2, '12156756-3', 'Juan', 'Pérez', '987654321', 'Calle 456, Ciudad', '', '2025-02-05 15:27:36', '2025-02-05 23:22:09'),
(3, 3, '16200587-K', 'Ana', 'Gómez', '456123789', 'Avenida 789, Ciudad', '', '2025-02-05 15:27:36', '2025-02-05 23:22:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'Admin', 'Administrador del sistema'),
(2, 'Residente', 'Residente del condominio'),
(3, 'Presidente', 'Presidente Representante de comudidad'),
(4, 'Tesorero', 'Tesorero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ougt.malakias@gmail.com', '$2a$07$asxx54ahjppf45sd87a5aunF6iyRqslKKao6rgTKU6iJYh6cBg8sW', 1, '2025-02-05 15:27:36', '2025-02-05 17:02:18'),
(2, 'juan', 'juan@correo.com', '$2a$07$asxx54ahjppf45sd87a5aunF6iyRqslKKao6rgTKU6iJYh6cBg8sW', 0, '2025-02-05 15:27:36', '2025-02-05 19:45:42'),
(3, 'ana', 'ana@correo.com', '$2a$07$asxx54ahjppf45sd87a5aunF6iyRqslKKao6rgTKU6iJYh6cBg8sW', 2, '2025-02-05 15:27:36', '2025-02-05 19:45:54'),
(10, 'metrois', 'metrois@miscanti.cl', '$2a$07$asxx54ahjppf45sd87a5auKJz9Hy9GgYPNtJTb5r0CqBG.crAIW.G', 0, '2025-02-05 23:15:06', '2025-02-05 23:15:06'),
(11, 'FelipeDiaz', 'ougt@gmail.com', '$2a$07$asxx54ahjppf45sd87a5auKJz9Hy9GgYPNtJTb5r0CqBG.crAIW.G', 0, '2025-02-05 23:23:45', '2025-02-05 23:23:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `action`, `log_date`) VALUES
(1, 1, 'Inicio de sesión', '2025-02-05 19:02:46'),
(2, 2, 'Realizó un pago', '2025-02-05 19:02:46'),
(3, 3, 'Actualizó su perfil', '2025-02-05 19:02:46'),
(4, 1, 'Usuario válido ingresa a sistema.', '2025-02-05 19:22:24'),
(5, 1, 'Usuario o password incorrectos', '2025-02-05 19:36:55'),
(6, 1, 'Usuario válido ingresa a sistema.', '2025-02-05 19:39:33'),
(7, 2, 'Usuario o password incorrectos', '2025-02-05 19:40:01'),
(8, 2, 'Usuario o password incorrectos', '2025-02-05 19:42:58'),
(9, 1, 'Usuario o password incorrectos', '2025-02-05 19:43:55'),
(10, 1, 'Usuario válido ingresa a sistema.', '2025-02-05 19:44:10'),
(11, 2, 'Usuario no activo intenta ingresar', '2025-02-05 19:46:12'),
(12, 1, 'Usuario o password incorrectos', '2025-02-05 20:01:55'),
(13, 3, 'Usuario o password incorrectos', '2025-02-05 20:02:59'),
(14, 2, 'Usuario o password incorrectos', '2025-02-05 20:03:36'),
(15, 2, 'Usuario no activo intenta ingresar', '2025-02-05 20:06:30'),
(16, 2, 'Usuario no activo intenta ingresar', '2025-02-05 20:09:11'),
(17, 1, 'Usuario válido ingresa a sistema.', '2025-02-05 20:13:18'),
(18, 1, 'Usuario o password incorrectos', '2025-02-05 20:13:33'),
(19, 1, 'Usuario válido ingresa a sistema.', '2025-02-05 20:13:51'),
(20, 1, 'Usuario válido ingresa a sistema.', '2025-02-05 20:22:16'),
(21, 1, 'Usuario o password incorrectos', '2025-02-05 21:17:03'),
(22, 1, 'Usuario o password incorrectos', '2025-02-05 21:17:11'),
(23, 1, 'Usuario o password incorrectos', '2025-02-05 22:32:19'),
(24, 1, 'Usuario o password incorrectos', '2025-02-05 22:32:32'),
(25, 1, 'Usuario o password incorrectos', '2025-02-05 22:32:46'),
(26, 1, 'Usuario o password incorrectos', '2025-02-05 22:32:54');

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
(1, 1, '2025-02-05 15:27:36'),
(1, 3, '2025-02-05 17:20:45'),
(2, 2, '2025-02-05 15:27:36'),
(3, 2, '2025-02-05 15:27:36'),
(3, 4, '2025-02-05 17:20:45');

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
-- Indices de la tabla `comunidades`
--
ALTER TABLE `comunidades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `empresa_id` (`empresa_id`);

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `comunidad_id` (`comunidad_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comunidad_id` (`comunidad_id`),
  ADD KEY `period_id` (`period_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `expense_shares`
--
ALTER TABLE `expense_shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_id` (`expense_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comunidad_id` (`comunidad_id`),
  ADD KEY `period_id` (`period_id`);

--
-- Indices de la tabla `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `period` (`period`);

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
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `comunidades`
--
ALTER TABLE `comunidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `expense_shares`
--
ALTER TABLE `expense_shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `periods`
--
ALTER TABLE `periods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comunidades`
--
ALTER TABLE `comunidades`
  ADD CONSTRAINT `comunidades_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`comunidad_id`) REFERENCES `comunidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `departments_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`comunidad_id`) REFERENCES `comunidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_ibfk_2` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expenses_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `expense_shares`
--
ALTER TABLE `expense_shares`
  ADD CONSTRAINT `expense_shares_ibfk_1` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expense_shares_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`comunidad_id`) REFERENCES `comunidades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
