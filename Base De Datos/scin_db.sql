-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 21, 2026 at 08:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventario_fisico`
--

CREATE TABLE `inventario_fisico` (
  `id_fisico` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `id_salida` int(11) NOT NULL,
  `total_sistema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `linea`
--

CREATE TABLE `linea` (
  `idlinea` int(11) NOT NULL,
  `descripcion_linea` varchar(100) NOT NULL,
  `estatus_linea` varchar(20) DEFAULT 'ALTA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `linea`
--

INSERT INTO `linea` (`idlinea`, `descripcion_linea`, `estatus_linea`) VALUES
(1, 'Samsung', 'BAJA'),
(2, 'HP', 'ALTA'),
(3, 'Lenovo', 'ALTA'),
(4, 'Logitech', 'ALTA'),
(5, 'Kingston', 'ALTA'),
(6, 'Microsoft', 'ALTA'),
(7, 'ASUS', 'ALTA'),
(8, 'Acer', 'ALTA'),
(9, 'Epson', 'ALTA'),
(10, 'Dell', 'ALTA'),
(11, 'sol', 'ALTA');

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `precios`
--

CREATE TABLE `precios` (
  `idprod` int(11) NOT NULL,
  `precioventa` float NOT NULL DEFAULT 0,
  `preciocompra` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `precios`
--

INSERT INTO `precios` (`idprod`, `precioventa`, `preciocompra`) VALUES
(6, 30, 34),
(7, 23, 23),
(8, 35000, 25000),
(9, 145, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `idprod` int(11) NOT NULL,
  `claveprod` varchar(15) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `linea` int(11) NOT NULL,
  `idprov` int(11) NOT NULL,
  `estatus_prod` varchar(20) DEFAULT 'ALTA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`idprod`, `claveprod`, `descripcion`, `linea`, `idprov`, `estatus_prod`) VALUES
(6, '455', 'chetos amarillos', 11, 1, 'BAJA'),
(7, '256', 'khgcgh', 1, 2, 'BAJA'),
(8, '002', 'laptop', 2, 1, 'BAJA'),
(9, '156584', 'pruenba 1', 5, 1, 'ALTA');

-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
--

CREATE TABLE `proveedores` (
  `idprov` int(11) NOT NULL,
  `nombreprov` varchar(50) NOT NULL,
  `apaternoprov` varchar(50) NOT NULL,
  `amaternoprov` varchar(50) DEFAULT NULL,
  `telprov` varchar(15) DEFAULT NULL,
  `domprov` varchar(150) DEFAULT NULL,
  `mailprov` varchar(100) DEFAULT NULL,
  `estatusprov` varchar(20) DEFAULT 'ALTA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proveedores`
--

INSERT INTO `proveedores` (`idprov`, `nombreprov`, `apaternoprov`, `amaternoprov`, `telprov`, `domprov`, `mailprov`, `estatusprov`) VALUES
(1, 'brisi', 'ortiz', 'ruiz', '5544632589', 'calle:tepozanez #32', 'jajajaja@hastil.com', 'ALTA'),
(2, 'aimar', 'perez', 'liam', '6958125896', 'calle:insurgentes surnoreste #265', 'indu@hgfgf.com', 'ALTA'),
(3, 'carlos', 'willy', 'oliver', '5659611525', 'calle:Av paseo de reforma #456', 'acs@dasd.com', 'ALTA');

-- --------------------------------------------------------

--
-- Table structure for table `registro_entradas`
--

CREATE TABLE `registro_entradas` (
  `id_entrada` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_ent` int(11) NOT NULL,
  `id_concepto` varchar(255) NOT NULL,
  `hora_ent` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registro_entradas`
--

INSERT INTO `registro_entradas` (`id_entrada`, `id_producto`, `cantidad_ent`, `id_concepto`, `hora_ent`) VALUES
(1, 5256, 56, '2566', '2026-10-14 18:20:49'),
(2, 2555, 15, 'kjbjhcf', '2026-10-16 16:21:07'),
(3, 156584, 15, 'kjbjhcf', '2026-10-21 17:37:28'),
(4, 455, 156, 'chetos amarillos', '2026-10-21 17:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `registro_salidas`
--

CREATE TABLE `registro_salidas` (
  `id_salida` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_sal` int(11) NOT NULL,
  `id_concepto` varchar(255) NOT NULL,
  `hora_sal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registro_salidas`
--

INSERT INTO `registro_salidas` (`id_salida`, `id_producto`, `cantidad_sal`, `id_concepto`, `hora_sal`) VALUES
(1, 568, 23, 'laptop', '2026-10-14 18:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idprod` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idprod`, `stock`) VALUES
(6, 0),
(7, 5),
(8, 0),
(9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `descripusuario` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('ADMIN','USUARIO') NOT NULL DEFAULT 'USUARIO',
  `estatus_usuario` varchar(20) DEFAULT 'ALTA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `descripusuario`, `correo`, `password`, `rol`, `estatus_usuario`) VALUES
(1, 'Arez', 'admin@scn.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'ADMIN', 'ALTA'),
(2, 'a', 'ared@gnao.com', '$2y$10$92a8sH9JXtsLQV14RMrwzejERv1Q9nC9CNHr.eeoA286A.8MZokVC', 'USUARIO', 'ALTA'),
(3, 'Administrador', 'Arez@g.com', '$2y$10$9Ksx1UMwhaSxT9Kox6yQr.7X.IPn0RhQqr72Yueyajm/xi6iS4SAG', 'ADMIN', 'ALTA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventario_fisico`
--
ALTER TABLE `inventario_fisico`
  ADD PRIMARY KEY (`id_fisico`);

--
-- Indexes for table `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`idlinea`);

--
-- Indexes for table `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`idprod`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idprod`),
  ADD UNIQUE KEY `claveprod` (`claveprod`),
  ADD KEY `linea` (`linea`),
  ADD KEY `idprov` (`idprov`);

--
-- Indexes for table `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idprov`);

--
-- Indexes for table `registro_entradas`
--
ALTER TABLE `registro_entradas`
  ADD PRIMARY KEY (`id_entrada`);

--
-- Indexes for table `registro_salidas`
--
ALTER TABLE `registro_salidas`
  ADD PRIMARY KEY (`id_salida`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idprod`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventario_fisico`
--
ALTER TABLE `inventario_fisico`
  MODIFY `id_fisico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `linea`
--
ALTER TABLE `linea`
  MODIFY `idlinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `idprod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idprov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registro_entradas`
--
ALTER TABLE `registro_entradas`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registro_salidas`
--
ALTER TABLE `registro_salidas`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `precios`
--
ALTER TABLE `precios`
  ADD CONSTRAINT `precios_ibfk_1` FOREIGN KEY (`idprod`) REFERENCES `productos` (`idprod`) ON DELETE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`linea`) REFERENCES `linea` (`idlinea`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`idprov`) REFERENCES `proveedores` (`idprov`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`idprod`) REFERENCES `productos` (`idprod`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
