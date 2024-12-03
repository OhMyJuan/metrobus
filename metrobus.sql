
--
-- Estructura de tabla para la tabla `tarjetas`
--

CREATE TABLE `tarjetas` (
  `id` int(11) UNSIGNED NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `saldo` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tipo` enum('normal','estudiantil','jubilado') NOT NULL DEFAULT 'normal',
  `cid_usuario` varchar(20) NOT NULL DEFAULT 'anónimo',
  `estado` enum('habilitada','deshabilitada') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `id` int(11) UNSIGNED NOT NULL,
  `codigo_tarjeta` varchar(255) NOT NULL,
  `id_operador` int(11) UNSIGNED NOT NULL,
  `tipo_transaccion` enum('recarga','uso') NOT NULL,
  `monto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

ALTER TABLE `users`
ADD COLUMN `nombre` varchar(255) NOT NULL,
ADD COLUMN `cid` varchar(255) NOT NULL,
ADD COLUMN `rol` enum('admin', 'operador') NOT NULL;
