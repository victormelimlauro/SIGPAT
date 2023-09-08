-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 07-Set-2023 às 23:40
-- Versão do servidor: 8.0.28
-- versão do PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aula01tiagoas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

CREATE TABLE `itens` (
  `cod_item` int NOT NULL,
  `numpat_item` int NOT NULL,
  `cod_local` int DEFAULT NULL,
  `nome_item` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `preco_item` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `itens`
--

INSERT INTO `itens` (`cod_item`, `numpat_item`, `cod_local`, `nome_item`, `preco_item`) VALUES
(1, 55, 4, 'Cadeira', '1.00'),
(2, 55, 4, 'Mesa', '1.00'),
(3, 848, 1, 'Computador', '5000.00'),
(4, 408, 37, 'Notebook', '1500.00'),
(5, 660, 1, 'Balança', '100.00'),
(6, 501, 10, 'Cadeira Presidente', '500.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `locais`
--

CREATE TABLE `locais` (
  `cod_local` int NOT NULL,
  `nome_local` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `locais`
--

INSERT INTO `locais` (`cod_local`, `nome_local`) VALUES
(35, ' Art'),
(14, ' Compras  Deise'),
(17, ' Compras José'),
(15, ' Compras Marcia '),
(18, ' Compras Victor '),
(16, ' Contabilidade'),
(26, ' Escola'),
(30, ' Escola Senac'),
(37, ' Estimulação Precoce '),
(28, ' manuela zaglia franco '),
(1, 'Comercial'),
(12, 'Escola'),
(6, 'Faturamento'),
(4, 'Financeiro     '),
(32, 'Lab de informática  '),
(10, 'Marketing Metrocamp'),
(36, 'Recepçao'),
(27, 'Recepção  Metrocamp '),
(25, 'Serviço social'),
(33, 'Sthefany Sarah');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `cod_usuario` int NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `nome`, `username`, `senha`) VALUES
(1, 'Victor Melim Lauro', 'victor', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`cod_item`);

--
-- Índices para tabela `locais`
--
ALTER TABLE `locais`
  ADD PRIMARY KEY (`cod_local`),
  ADD UNIQUE KEY `idx_locais_cod_local` (`cod_local`),
  ADD UNIQUE KEY `nome_local_UNIQUE` (`nome_local`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `cod_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `locais`
--
ALTER TABLE `locais`
  MODIFY `cod_local` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `cod_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
