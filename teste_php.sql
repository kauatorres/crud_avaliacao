-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/10/2023 às 01:23
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste_php`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_conta_pagar`
--

CREATE TABLE `tbl_conta_pagar` (
  `id_conta_pagar` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `valor_pago` decimal(10,2) DEFAULT 0.00,
  `data_pagar` date NOT NULL,
  `pago` tinyint(4) NOT NULL DEFAULT 0,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_conta_pagar`
--

INSERT INTO `tbl_conta_pagar` (`id_conta_pagar`, `valor`, `valor_pago`, `data_pagar`, `pago`, `id_empresa`) VALUES
(1, 1200.00, 950.00, '2023-11-08', 1, 1),
(2, 110.00, 12.10, '2023-09-01', 1, 2),
(3, 1001.00, 2707.50, '2023-10-03', 1, 3),
(10, 10.00, 10.00, '2023-10-03', 1, 2),
(11, 0.00, 0.00, '2000-02-10', 0, 1),
(12, 110.00, 0.00, '2023-10-03', 0, 1),
(13, 1.20, 0.00, '0001-02-10', 0, 2),
(14, 1200.00, 0.00, '2023-10-04', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_empresa`
--

CREATE TABLE `tbl_empresa` (
  `id_empresa` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_empresa`
--

INSERT INTO `tbl_empresa` (`id_empresa`, `nome`) VALUES
(1, 'Empresa A'),
(2, 'Empresa B'),
(3, 'Empresa C');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbl_conta_pagar`
--
ALTER TABLE `tbl_conta_pagar`
  ADD PRIMARY KEY (`id_conta_pagar`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Índices de tabela `tbl_empresa`
--
ALTER TABLE `tbl_empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbl_conta_pagar`
--
ALTER TABLE `tbl_conta_pagar`
  MODIFY `id_conta_pagar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `tbl_empresa`
--
ALTER TABLE `tbl_empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbl_conta_pagar`
--
ALTER TABLE `tbl_conta_pagar`
  ADD CONSTRAINT `tbl_conta_pagar_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `tbl_empresa` (`id_empresa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
