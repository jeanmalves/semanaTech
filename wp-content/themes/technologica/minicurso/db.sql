CREATE TABLE minicurso (
	`minicurso_id` INT(5) NOT NULL auto_increment,
	`minicurso_nome` VARCHAR(120) NOT NULL,
	`minicurso_desc` TEXT NOT NULL,
	`qtd_vagas` INT(5) NOT NULL,
	`dt_inicio` DATETIME NOT NULL,
	`dt_fim` DATETIME NOT NULL,
	primary key(`minicurso_id`)
);

CREATE TABLE participante (
	`participante_doc` INT(12) NOT NULL,
	`participante_nome` VARCHAR(45) NOT NULL,
	`participante_email` VARCHAR(60) NOT NULL,
	`participante_aluno` INT(5) NOT NULL,
	`participante_fone` VARCHAR(15) NOT NULL,
	primary key (`participante_doc`) 
);

CREATE TABLE inscricao (
	`minicurso_id` INT(5) NOT NULL,
	`participante_doc` INT(12) NOT NULL,
	FOREIGN KEY(`minicurso_id`) REFERENCES minicurso(`minicurso_id`),
	FOREIGN KEY(`participante_doc`) REFERENCES participante(`participante_doc`)
);
