USE BRFORMR;

ALTER TABLE `page`
ADD `texto_balao` VARCHAR(120) NOT NULL AFTER `id`,

ADD `qtd_exibicao_bl` INT NOT NULL DEFAULT '-1' AFTER `texto_balao`,

ADD `momento_exibicao_bl` INT NOT NULL DEFAULT '0' AFTER `qtd_exibicao_bl`,

ADD `dias_para_refazer` INT NOT NULL DEFAULT '0' AFTER `momento_exibicao_bl`;

