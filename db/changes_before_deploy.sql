ALTER TABLE `construlista02`.`clientes`
ADD COLUMN `last_name` VARCHAR(45) NULL DEFAULT NULL AFTER `nome`;

ALTER TABLE `construlista02`.`clientes`
CHANGE COLUMN `created` `created` DATETIME NULL DEFAULT NULL AFTER `token`,
ADD COLUMN `gender` TINYINT(2) NULL DEFAULT 1 AFTER `data_nascimento`,
ADD COLUMN `modified` DATETIME NULL DEFAULT NULL AFTER `created`;

ALTER TABLE `construlista02`.`clientes`
ADD COLUMN `occupation` VARCHAR(45) NULL DEFAULT NULL AFTER `gender`;

ALTER TABLE `construlista02`.`clientes`
ADD COLUMN `complemento` VARCHAR(45) NULL DEFAULT NULL AFTER `numero`;
