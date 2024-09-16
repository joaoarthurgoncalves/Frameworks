-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/09/2024 às 03:10
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `prd_categoria`
--

CREATE TABLE `prd_categoria` (
  `id_categoria` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `prd_departamento`
--

CREATE TABLE `prd_departamento` (
  `id_departamento` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `prd_marca`
--

CREATE TABLE `prd_marca` (
  `id_marca` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `prd_preco_venda`
--

CREATE TABLE `prd_preco_venda` (
  `id_preco_venda` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `preco_venda` decimal(10,2) DEFAULT NULL,
  `data_validade_inicial` date DEFAULT NULL,
  `data_validade_final` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `prd_produto`
--

CREATE TABLE `prd_produto` (
  `id_produto` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `id_subcategoria` int(11) DEFAULT NULL,
  `id_unidade_medida` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `especificacao_tecnica` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `peso_bruto` decimal(10,2) DEFAULT NULL,
  `peso_liquido` decimal(10,2) DEFAULT NULL,
  `qtd_min` int(11) DEFAULT NULL,
  `cod_barra` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `prd_produto_similar`
--

CREATE TABLE `prd_produto_similar` (
  `id_produto` int(11) NOT NULL,
  `id_produto_similar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `prd_subcategoria`
--

CREATE TABLE `prd_subcategoria` (
  `id_subcategoria` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `prd_unidade_medida`
--

CREATE TABLE `prd_unidade_medida` (
  `id_unidade_medida` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `prd_categoria`
--
ALTER TABLE `prd_categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Índices de tabela `prd_departamento`
--
ALTER TABLE `prd_departamento`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Índices de tabela `prd_marca`
--
ALTER TABLE `prd_marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Índices de tabela `prd_preco_venda`
--
ALTER TABLE `prd_preco_venda`
  ADD PRIMARY KEY (`id_preco_venda`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `prd_produto`
--
ALTER TABLE `prd_produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `id_subcategoria` (`id_subcategoria`),
  ADD KEY `id_unidade_medida` (`id_unidade_medida`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Índices de tabela `prd_produto_similar`
--
ALTER TABLE `prd_produto_similar`
  ADD PRIMARY KEY (`id_produto`,`id_produto_similar`),
  ADD KEY `id_produto_similar` (`id_produto_similar`);

--
-- Índices de tabela `prd_subcategoria`
--
ALTER TABLE `prd_subcategoria`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices de tabela `prd_unidade_medida`
--
ALTER TABLE `prd_unidade_medida`
  ADD PRIMARY KEY (`id_unidade_medida`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `prd_categoria`
--
ALTER TABLE `prd_categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `prd_departamento`
--
ALTER TABLE `prd_departamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `prd_marca`
--
ALTER TABLE `prd_marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `prd_preco_venda`
--
ALTER TABLE `prd_preco_venda`
  MODIFY `id_preco_venda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `prd_produto`
--
ALTER TABLE `prd_produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `prd_subcategoria`
--
ALTER TABLE `prd_subcategoria`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `prd_unidade_medida`
--
ALTER TABLE `prd_unidade_medida`
  MODIFY `id_unidade_medida` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `prd_categoria`
--
ALTER TABLE `prd_categoria`
  ADD CONSTRAINT `prd_categoria_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `prd_departamento` (`id_departamento`);

--
-- Restrições para tabelas `prd_preco_venda`
--
ALTER TABLE `prd_preco_venda`
  ADD CONSTRAINT `prd_preco_venda_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `prd_produto` (`id_produto`);

--
-- Restrições para tabelas `prd_produto`
--
ALTER TABLE `prd_produto`
  ADD CONSTRAINT `prd_produto_ibfk_1` FOREIGN KEY (`id_subcategoria`) REFERENCES `prd_subcategoria` (`id_subcategoria`),
  ADD CONSTRAINT `prd_produto_ibfk_2` FOREIGN KEY (`id_unidade_medida`) REFERENCES `prd_unidade_medida` (`id_unidade_medida`),
  ADD CONSTRAINT `prd_produto_ibfk_3` FOREIGN KEY (`id_marca`) REFERENCES `prd_marca` (`id_marca`);

--
-- Restrições para tabelas `prd_produto_similar`
--
ALTER TABLE `prd_produto_similar`
  ADD CONSTRAINT `prd_produto_similar_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `prd_produto` (`id_produto`),
  ADD CONSTRAINT `prd_produto_similar_ibfk_2` FOREIGN KEY (`id_produto_similar`) REFERENCES `prd_produto` (`id_produto`);

--
-- Restrições para tabelas `prd_subcategoria`
--
ALTER TABLE `prd_subcategoria`
  ADD CONSTRAINT `prd_subcategoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `prd_categoria` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
