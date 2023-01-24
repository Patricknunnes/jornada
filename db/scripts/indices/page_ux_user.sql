-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Out-2022 às 02:11
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de dados: `bdformr`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `page_ux_user`
--

CREATE TABLE `page_ux_user` (
  `id_page` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cont_exibicao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONAMENTOS PARA TABELAS `page_ux_user`:
--   `id_page`
--       `page` -> `id`
--   `id_user`
--       `users` -> `id`
--

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `page_ux_user`
--
ALTER TABLE `page_ux_user`
  ADD UNIQUE KEY `IX_page_ux_user_UNIQUE` (`id_page`,`id_user`),
  ADD KEY `IX_Page_Ux_User_id_page` (`id_page`),
  ADD KEY `IX_page_ux_user_id_user` (`id_user`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `page_ux_user`
--
ALTER TABLE `page_ux_user`
  ADD CONSTRAINT `FK_page_ux_user_id_page` FOREIGN KEY (`id_page`) REFERENCES `page` (`id`),
  ADD CONSTRAINT `FK_page_ux_user_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;
