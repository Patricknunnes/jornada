-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `gif_regiao`:
--   `id_page`
--       `pages` -> `id`
--   `id_user`
--       `users` -> `id`
--
-- --------------------------------------------------------

--
-- Índices para tabela `gif_regiao`
--
ALTER TABLE `gif_regiao`
  ADD KEY `IX_gif_regiao_id_user` (`id_user`),
  ADD KEY `IX_gif_regiao_id_page` (`id_page`);

-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `graficos`:
--   `pesquisa`
--       `page` -> `id`
--   `regiao`
--       `pages` -> `id`
--   `usu_id`
--       `users` -> `id`
--
-- --------------------------------------------------------

--
-- Índices para tabela `graficos`
--
ALTER TABLE `graficos`
  ADD KEY `IX_Graficos_usu_id` (`usu_id`),
  ADD KEY `IX_Graficos_regiao` (`regiao`),
  ADD KEY `IX_Graficos_pesquisa` (`pesquisa`);

-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `orderregiao`:
--   `tipo`
--       `pages` -> `id`
--   `use_id`
--       `users` -> `id`
--
-- --------------------------------------------------------

--
-- Índices para tabela `orderregiao`
--
ALTER TABLE `orderregiao`
  ADD KEY `IX_Orderregiao` (`use_id`),
  ADD KEY `IX_Orderregiao_tipo` (`tipo`);

-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `page`:
--   `pag_id`
--       `pages` -> `id`
--
-- --------------------------------------------------------

--
-- Índices para tabela `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX_Page_pag_id` (`pag_id`);

-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `pages`:
--
-- --------------------------------------------------------

--
-- Índices para tabela `pages`
--
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `questionnaires`:
--
-- --------------------------------------------------------

--
-- Índices para tabela `questionnaires`
--
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `run`:
--   `run_id`
--       `page` -> `id`
--
-- --------------------------------------------------------

--
-- Índices para tabela `run`
--
ALTER TABLE `run`
  ADD PRIMARY KEY (`run_id`);
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `run_report`:
--   `run_id`
--       `run` -> `run_id`
--
-- --------------------------------------------------------

--
-- Índices para tabela `run_report`
--
ALTER TABLE `run_report`
  ADD KEY `IX_Run_report_run_id` (`run_id`);
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `run_report_user`:
--   `run_id`
--       `run` -> `run_id`
--   `use_id`
--       `users` -> `id`
--
-- --------------------------------------------------------

--
-- Índices para tabela `run_report_user`
--
ALTER TABLE `run_report_user`
  ADD KEY `IX_Run_report_user_run_id` (`run_id`),
  ADD KEY `IX_Run_report_user_use_id` (`use_id`) USING BTREE;
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `session_formr`:
--
-- --------------------------------------------------------


-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `survey_studies`:
--   `id_page`
--       `pages` -> `id`
--   `use_id`
--       `users` -> `id`
--
-- --------------------------------------------------------

--
-- Índices para tabela `survey_studies`
--
ALTER TABLE `survey_studies`
  ADD KEY `IX_Survey_studies_use_id` (`use_id`),
  ADD KEY `IX_Survey_studies_id_page` (`id_page`);
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `survey_unit_sessions`:
--   `use_id`
--       `users` -> `id`
--
-- --------------------------------------------------------

--
-- Índices para tabela `survey_unit_sessions`
--
ALTER TABLE `survey_unit_sessions`
  ADD KEY `IX_Survey_Unit_sessions_use_id` (`use_id`),
  ADD KEY `IX_Survey_Unit_sessions_session_id` (`session_id`);
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `termos`:
--   `id_user`
--       `users` -> `id`
--
-- --------------------------------------------------------

--
-- Índices para tabela `termos`
--
ALTER TABLE `termos`
  ADD KEY `IX_Termos_id_user` (`id`),
  ADD KEY `IX_termos_Users_id_users` (`id_user`);
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- RELACIONAMENTOS PARA TABELAS `users`:
--
-- --------------------------------------------------------

-- --------------------------------------------------------
CRIAÇÃO DOS RELACIONAMENTOS
-- --------------------------------------------------------

--
-- Limitadores para a tabela `gif_regiao`
--
ALTER TABLE `gif_regiao`
  ADD CONSTRAINT `FK_Gif_regiao_Pages_id_Page` FOREIGN KEY (`id_page`) REFERENCES `pages` (`id`),
  ADD CONSTRAINT `FK_Gif_regiao_Users_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `graficos`
--
ALTER TABLE `graficos`
  ADD CONSTRAINT `FK_Graficos_Page_pesquisa` FOREIGN KEY (`pesquisa`) REFERENCES `page` (`id`),
  ADD CONSTRAINT `FK_Graficos_Pages_regiao` FOREIGN KEY (`regiao`) REFERENCES `pages` (`id`),
  ADD CONSTRAINT `FK_Graficos_Users_usu_id` FOREIGN KEY (`usu_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `orderregiao`
--
ALTER TABLE `orderregiao`
  ADD CONSTRAINT `FK_Orderregiao_Pages_tipo` FOREIGN KEY (`tipo`) REFERENCES `pages` (`id`),
  ADD CONSTRAINT `FK_Orderregiao_Users_use_id` FOREIGN KEY (`use_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `FK_Page_Pages_pag_id` FOREIGN KEY (`pag_id`) REFERENCES `pages` (`id`);

--
-- Limitadores para a tabela `run`
--
-- Ocorre antes- Verificar.
/*
ALTER TABLE `run`
  ADD CONSTRAINT `FK_Run_Page_rn_id` FOREIGN KEY (`run_id`) REFERENCES `page` (`id`);
*/


--
-- Limitadores para a tabela `run_report`
--
ALTER TABLE `run_report`
  ADD CONSTRAINT `FK_Run_report_Run_run_id` FOREIGN KEY (`run_id`) REFERENCES `run` (`run_id`);

--
-- Limitadores para a tabela `run_report_user`
--
ALTER TABLE `run_report_user`
  ADD CONSTRAINT `FK_Run_report_user_Run_run_id` FOREIGN KEY (`run_id`) REFERENCES `run` (`run_id`),
  ADD CONSTRAINT `FK_Run_report_user_User_use_id` FOREIGN KEY (`use_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `survey_studies`
--
ALTER TABLE `survey_studies`
  ADD CONSTRAINT `FK_Survey_studies_Pages_id_page` FOREIGN KEY (`id_page`) REFERENCES `page` (`id`),
  ADD CONSTRAINT `FK_Survey_studies_Users_usu_id` FOREIGN KEY (`use_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `survey_unit_sessions`
--
ALTER TABLE `survey_unit_sessions`
  ADD CONSTRAINT `FB_Survey_unit_session_Users_use_id` FOREIGN KEY (`use_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `termos`
--
ALTER TABLE `termos`
  ADD CONSTRAINT `IX_termos_Users_id_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;



