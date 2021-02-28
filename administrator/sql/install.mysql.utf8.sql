DROP TABLE IF EXISTS `#__grupayer_config`;
DROP TABLE IF EXISTS `#__grupayer_form_config`;

CREATE TABLE `#__grupayer_form_config` (
	`id`          INT(11)          NOT NULL AUTO_INCREMENT,
    `asset_id`    INT(10)          NOT NULL DEFAULT '0',
	`description` VARCHAR(255)     NOT NULL,
	`name`        VARCHAR(255)     NOT NULL,
	`type`        VARCHAR(255)     NOT NULL,
	`disabled`    tinyint(4)       NOT NULL,
	`required`    tinyint(4)       NOT NULL,
	`published`   tinyint(4)       NOT NULL,
	`mask`        VARCHAR(255),
	`validator`   VARCHAR(255),
	`default`     VARCHAR(255),
	PRIMARY KEY (`id`)
)
	ENGINE =InnoDB
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8mb4
    DEFAULT COLLATE=utf8mb4_unicode_ci;

INSERT INTO `#__grupayer_form_config` (`description`, `name`, `type`, `disabled`,`required`,`published`, `validator`, `mask`) VALUES
('Código de serviço','codigoServico', 'services', 0, 1, 1, '', ''),
('Número de referência', 'referencia','text', 0, 0, 1, '', ''),
('Competência', 'competencia','date', 0, 0, 1, 'monthYearDate', 'monthYearDate'),
('Vencimento', 'vencimento','date', 0, 0, 1, 'fullDate', 'fullDate'),
('CNPJ/CPF', 'cnpjCpf','text', 0, 0, 1, 'cnpjCpf', 'cnpjCpf'),
('Nome do contribuinte', 'nomeContribuinte','text', 0, 0, 1, '', ''),
('Valor principal', 'valorPrincipal','text', 0, 1, 1, 'currency', 'currency'),
('Valor de descontos', 'valorDescontos','text', 0, 0, 1, 'currency', 'currency'),
('Valor de outras deduções', 'valorOutrasDeducoes','text', 0, 0, 1, 'currency', 'currency'),
('Valor de multa', 'valorMulta','text', 0, 0, 1, 'currency', 'currency'),
('Valor de juros', 'valorJuros','text', 0, 0, 1, 'currency', 'currency'),
('Valor de outros acréscimos', 'valorOutrosAcrescimos','text', 0, 0, 1, 'currency', 'currency');

CREATE TABLE `#__grupayer_services` (
	`id`          INT(11)          NOT NULL AUTO_INCREMENT,
    `asset_id`    INT(10)          NOT NULL DEFAULT '0',
	`code`        INT(11)          NOT NULL,
	`description` VARCHAR(255)     NOT NULL,
	`published`   tinyint(4)       NOT NULL,
	PRIMARY KEY (`id`)
)
	ENGINE =InnoDB
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8mb4
    DEFAULT COLLATE=utf8mb4_unicode_ci;