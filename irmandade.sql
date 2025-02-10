-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/12/2024 às 01:00
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
-- Banco de dados: `irmandade`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `entrega`
--

CREATE TABLE `entrega` (
  `id_e` int(11) NOT NULL,
  `tel_e` decimal(9,0) NOT NULL,
  `cep_e` decimal(8,0) NOT NULL,
  `formpag_e` char(7) NOT NULL,
  `cd_u` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `nm_produto` varchar(100) NOT NULL,
  `vl_produto` decimal(5,2) NOT NULL,
  `ds_produto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `nm_u` varchar(120) NOT NULL,
  `email_u` varchar(120) NOT NULL,
  `senha_u` varchar(50) NOT NULL,
  `cd_u` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`nm_u`, `email_u`, `senha_u`, `cd_u`) VALUES
('lucas', 'lucas@fatec.com', 'ygor', 1),
('cwecwec', 'dcwdcwe@fatec.com', '$2y$10$dsVowBMVOz/A3/.XOa9B4emEFYD.VkRInJnTXVA7AI3', 2),
('cwecwec', 'dcwdcwe@fatec.com', '$2y$10$4snsvcZ3zz7p87OLjTiQPuCsPZffwmtwUyhbqQtZPSD', 3),
('cwecwec', 'dcwdcwe@fatec.com', '$2y$10$B7mgSYW57C0BrOHggXGvGO5mb.gTirDIYKNFACB9Sri', 4),
('cwecwec', 'dcwdcwe@fatec.com', '$2y$10$TUQv2clVjlnyql3bEhoHwOoE2iTkW8rpzEm5TCMc4Dv', 5),
('cwecwec', 'dcwdcwe@fatec.com', '$2y$10$TMsFEBRKpUbiiwx.v2xIv.QL3b2raD9sKrX4YZU2IX5', 6),
('cwecwec', 'dcwdcwe@fatec.com', '$2y$10$mbuiGidlz4Jz7mV0CMMBQOSGvUUFCYOtE.4NyWLFhHU', 7),
('cwecwec', 'dcwdcwe@fatec.com', '$2y$10$dkm60iSo0XKkwzcjMWEfnuWxsmGLPjSRlD.Wt.iu60h', 8),
('cwecwec', 'dcwdcwe@fatec.com', '$2y$10$KFBxL3qotGmtLfN57cxLS.WHHPjxFFSQrryIa0ZmeBM', 9),
('cwecwec', 'dcwdcwe@fatec.com', '$2y$10$TIj1ikrhZTH1RFKRT2.lNuB24q4s3odNKsl8j.nMPtD', 10),
('scxqsdq', 'gwef@gmail.com', '$2y$10$7.ZEHM3RRvpTAL/1frcmhOpzeX.I5HY7MAI.MkgmMMY', 11),
('scxqsdq', 'gwef@gmail.com', '$2y$10$pDN.AsNeqJA4Ga92IOEJP.nNc.F6RqirhMO7vCn5CyA', 12),
('scxqsdq', 'gwef@gmail.com', '$2y$10$sWhjBfC6SvEQhuFIJEoxVONZTfs769v9LZoCUj67qPN', 13),
('scxqsdq', 'gwef@gmail.com', '$2y$10$JCqEyed9hynFH7XzCOElpOr5WPTvm7F3xAv0thuF.ZT', 14),
('scxqsdq', 'gwef@gmail.com', '$2y$10$YMEDQgUVP3DsfBDsxk2WBuVVHt8CyvZVRA.t3eXgqNd', 15),
('scxqsdq', 'gwef@gmail.com', '$2y$10$FXxr0b8B0p8nSEHzJfJe3Ob2D1nI/y.uGav5PBWbOiP', 16),
('scxqsdq', 'gwef@gmail.com', '$2y$10$.Bg5jDSYbZr8c2HAgG5W8uRukMEkiUDGPsK4gcq9E1n', 17),
('scxqsdq', 'gwef@gmail.com', '$2y$10$L3fzSpd8KP7YwrYr6jqSpOWVzV3Q0vL9o.k.qir44Hc', 18),
('scxqsdq', 'gwef@gmail.com', '$2y$10$qP1dFqQu7mJ2tw82HPTfUOd2htwUGz2xbwj9hflhO.a', 19),
('sdsfwefw', 'ferfe@gmail.com', '$2y$10$beKWoufQEjW5k/5vpiDrLu5WddJc4j5iyM1Od.lhEX7', 20),
('sdsfwefw', 'ferfe@gmail.com', '$2y$10$m77gGspgsImqMmdr95t1sOMQ/oG0H5CRAoWA6yx6Nau', 21),
('sdsfwefw', 'ferfe@gmail.com', '$2y$10$C709cc0rYo4ySOf2o75cTO3BfUTVFh57zuGdQzdowi7', 22),
('sdsfwefw', 'ferfe@gmail.com', '$2y$10$6yWfxF3vWh9YpNMiIUBoju8xC1ZxByqJINqnfUxik9h', 23),
('sdsfwefw', 'ferfe@gmail.com', '$2y$10$e2EeDMbqmWiEcwBwMbLUlubGa3QaKIb8lNEoQk4jM2N', 24),
('sdsfwefw', 'ferfe@gmail.com', '$2y$10$wOEREudMmwcFsWzQsacSOuTg8J.fw7qtCeMn79t5LPc', 25),
('sdsfwefw', 'ferfe@gmail.com', '$2y$10$YOVq3tnCYsiPsKMqdZSZ8OdN4v7gLlU1LSoIh7OCoxO', 26),
('sdsfwefw', 'ferfe@gmail.com', '$2y$10$32RC8kfRRqNy/MWIqaID/uOElA.kIbQ6mOeqQKrIsj8', 27),
('sdsfwefw', 'ferfe@gmail.com', '$2y$10$jM7J789VW.ObigmZgjTCFORGfHKz6fALe7GXxB/jz4W', 28),
('sdsfwefw', 'ferfe@gmail.com', '$2y$10$nwmzvTRpDAt5EffQhlk5uetPj2aYjtSbLKDqJraJ7I7', 29),
('sdsfwefw', 'ferfe@gmail.com', '$2y$10$arSIKpQZPKGWURtYaXVR2Oc./GD9XxNsePAzB07JAiP', 30),
('sfwefwef', 'wefwef@gmail.com', '$2y$10$Wezzb0X.MJJKdse48ctWDufVLqIbjt7tRXCj8qx6V3V', 31),
('sfwefwef', 'wefwef@gmail.com', '$2y$10$B3xFIKziyHbEag4nu4xAJu68ULbUb.q.EpaNXuoJ5Om', 32),
('sfwefwef', 'wefwef@gmail.com', '$2y$10$AWaoZ08V.JpaqgB25Z1W4u2jv/uUFfB7n9RYh2E6IqQ', 33),
('sfwefwef', 'wefwef@gmail.com', '$2y$10$lm/rJlIHsegg1qkpddbNbOn8E1D/TlUrmWPXmFDiugp', 34),
('sfwefwef', 'wefwef@gmail.com', '$2y$10$1KJBFy1a1BSMcKnDXZRxYOowQagTd2V/Yq1DnMP2nbK', 35),
('sfwefwef', 'wefwef@gmail.com', '$2y$10$l96Ty/wsyH3XHrlp11GBdetsv5StuGFAEIoDICgM4tX', 36),
('sfwefwef', 'wefwef@gmail.com', '$2y$10$PKFMtQ6CHAxacipYNCRBIegVuiRTs5YnnU6iPhwlVPp', 37),
('sfwefwef', 'wefwef@gmail.com', '$2y$10$ahO/yZ.JEumNmz.5aY6K0.8K9BJJ0aSdLrZv/ibLVYc', 38),
('sfwefwef', 'wefwef@gmail.com', '$2y$10$YTuok.WGwl6XpYROg5i9Kuf4KqFg/pLjEUQ1pPffZGT', 39),
('sfwefwef', 'wefwef@gmail.com', '$2y$10$W26xNEeU4loQCi1lgaWs0.84abRKYiF8za7.6mmoc9G', 40),
('sfwefwef', 'wefwef@gmail.com', '$2y$10$.tx.wj8eh2xxpxcB/u.b8.IuRXaeQUgBfInE/wkshTh', 41),
('sfwefwef', 'wefwef@gmail.com', '$2y$10$eEenmspQ4pVEAICYipcpsemnxCgFilDBxtuZsrEE498', 42),
('tyhtyh', 'tyhty@gmail.com', '$2y$10$o6QCPfhZW6qBrXAteq1fnuWR84ktAoR84Y86JtJ47aH', 43),
('tyhtyh', 'tyhty@gmail.com', '$2y$10$h/gHwieP.lMgwN9h9u2XwOuTbl3NPRdhFAB1VulnOcO', 44),
('tyhtyh', 'tyhty@gmail.com', '$2y$10$KUuuHrQXaBXi1Dd/dohzh.MS58ash6Fs4JxBqh5qL6.', 45),
('tyhtyh', 'tyhty@gmail.com', '$2y$10$wgb/8R/eLxOy9gJE2uxK2.TTxsyhQbJBwWTWAucSVC3', 46),
('tyhtyh', 'tyhty@gmail.com', '$2y$10$c541IS2hj9K1e/cRoQEtU.ixXmzynRT4we4ou9bBUge', 47);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`id_e`),
  ADD KEY `cd_u` (`cd_u`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cd_u`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `entrega`
--
ALTER TABLE `entrega`
  MODIFY `id_e` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cd_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `entrega`
--
ALTER TABLE `entrega`
  ADD CONSTRAINT `entrega_ibfk_1` FOREIGN KEY (`cd_u`) REFERENCES `usuario` (`cd_u`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
