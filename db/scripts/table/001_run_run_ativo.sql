ALTER TABLE `BDFormR`.`run` 
ADD COLUMN `run_ativo` CHAR(1) NOT NULL DEFAULT 'S' AFTER `run_descricao`;