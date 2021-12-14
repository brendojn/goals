-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.27-0ubuntu0.20.04.1 - (Ubuntu)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para goals
CREATE DATABASE IF NOT EXISTS `goals` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `goals`;

-- Copiando estrutura para tabela goals.complexities
CREATE TABLE IF NOT EXISTS `complexities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fibonacci` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela goals.complexities: ~6 rows (aproximadamente)
DELETE FROM `complexities`;
/*!40000 ALTER TABLE `complexities` DISABLE KEYS */;
INSERT INTO `complexities` (`id`, `fibonacci`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 5),
	(5, 8),
	(6, 13);
/*!40000 ALTER TABLE `complexities` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.configuration
CREATE TABLE IF NOT EXISTS `configuration` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `config_squad` int DEFAULT '0',
  `config_chapter` int DEFAULT '0',
  `config_skill` int DEFAULT '0',
  `config_average` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela goals.configuration: ~1 rows (aproximadamente)
DELETE FROM `configuration`;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` (`id`, `config_squad`, `config_chapter`, `config_skill`, `config_average`) VALUES
	(1, 60, 20, 20, 65);
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fk_user_id` int unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `qtd_recovery` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`fk_user_id`),
  CONSTRAINT `fk_user_iddd` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela goals.employees: ~11 rows (aproximadamente)
DELETE FROM `employees`;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`id`, `fk_user_id`, `name`, `qtd_recovery`) VALUES
	(4, 2, 'Brendo Oliveira', 0),
	(10, NULL, 'Aline Correa', 0),
	(11, NULL, 'Leonardo Padilha', 0),
	(12, NULL, 'Paola Pereira', 0),
	(13, NULL, 'Marina Rocha', 0),
	(14, NULL, 'Gabriela Nascimento', 0),
	(15, NULL, 'Livia Freitas', 0),
	(16, NULL, 'Sheila Braz', 0),
	(20, NULL, 'Tiago Correia', 0),
	(22, NULL, 'Izabella Cordova', 0),
	(23, NULL, 'Lucas Teofilo', 0);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.evaluates
CREATE TABLE IF NOT EXISTS `evaluates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fk_user_id` int unsigned NOT NULL,
  `fk_task_id` int unsigned DEFAULT NULL,
  `fk_project_id` int unsigned DEFAULT NULL,
  `squad` int DEFAULT NULL,
  `chapter` int DEFAULT NULL,
  `skill` int DEFAULT NULL,
  `justification` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_task_id` (`fk_task_id`),
  KEY `fk_project_id` (`fk_project_id`),
  CONSTRAINT `fk_project_id` FOREIGN KEY (`fk_project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_task_id` FOREIGN KEY (`fk_task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela goals.evaluates: ~3 rows (aproximadamente)
DELETE FROM `evaluates`;
/*!40000 ALTER TABLE `evaluates` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluates` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.evaluate_chapter
CREATE TABLE IF NOT EXISTS `evaluate_chapter` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fk_evaluate_id` int unsigned DEFAULT NULL,
  `risks` int DEFAULT '0',
  `documentation` int DEFAULT '0',
  `bugs` int DEFAULT '0',
  `participation` int DEFAULT '0',
  `ambition` int DEFAULT '0',
  `training` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_evaluate_id` (`fk_evaluate_id`),
  CONSTRAINT `fkk_evaluate_id` FOREIGN KEY (`fk_evaluate_id`) REFERENCES `evaluates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela goals.evaluate_chapter: ~2 rows (aproximadamente)
DELETE FROM `evaluate_chapter`;
/*!40000 ALTER TABLE `evaluate_chapter` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluate_chapter` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.evaluate_skill
CREATE TABLE IF NOT EXISTS `evaluate_skill` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fk_evaluate_id` int unsigned DEFAULT NULL,
  `performance` int DEFAULT '0',
  `safety` int DEFAULT '0',
  `usability` int DEFAULT '0',
  `git` int DEFAULT '0',
  `story` int DEFAULT '0',
  `api` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_evaluate_id` (`fk_evaluate_id`),
  CONSTRAINT `fk_evaluate_idd` FOREIGN KEY (`fk_evaluate_id`) REFERENCES `evaluates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela goals.evaluate_skill: ~0 rows (aproximadamente)
DELETE FROM `evaluate_skill`;
/*!40000 ALTER TABLE `evaluate_skill` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluate_skill` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.evaluate_squad
CREATE TABLE IF NOT EXISTS `evaluate_squad` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fk_evaluate_id` int unsigned DEFAULT NULL,
  `collaboration` int DEFAULT '0',
  `qa_in_squad` int DEFAULT '0',
  `communication` int DEFAULT '0',
  `respect` int DEFAULT '0',
  `automation` int DEFAULT '0',
  `business` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_evaluate_id` (`fk_evaluate_id`),
  CONSTRAINT `fk_evaluate_id` FOREIGN KEY (`fk_evaluate_id`) REFERENCES `evaluates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela goals.evaluate_squad: ~1 rows (aproximadamente)
DELETE FROM `evaluate_squad`;
/*!40000 ALTER TABLE `evaluate_squad` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluate_squad` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fk_employee_id` int unsigned NOT NULL,
  `week` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `grade` double DEFAULT NULL,
  `evaluate` int DEFAULT '0',
  `fk_type_evaluate_id` int unsigned DEFAULT NULL COMMENT 'A = Ambos(Squad e Chapter), C = Chapter, S = Squad ',
  PRIMARY KEY (`id`),
  KEY `fk_employee_id` (`fk_employee_id`),
  KEY `fk_type_evaluate_id` (`fk_type_evaluate_id`) USING BTREE,
  CONSTRAINT `fk_employee_idd` FOREIGN KEY (`fk_employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_type_evaluate_id` FOREIGN KEY (`fk_type_evaluate_id`) REFERENCES `type_evaluate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela goals.projects: ~5 rows (aproximadamente)
DELETE FROM `projects`;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.recoveries
CREATE TABLE IF NOT EXISTS `recoveries` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fk_employee_id` int unsigned DEFAULT NULL,
  `fk_project_id` int unsigned DEFAULT NULL,
  `grade_plan` double unsigned DEFAULT NULL,
  `subtract_plan` double unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_employee_id` (`fk_employee_id`),
  KEY `fk_project_id` (`fk_project_id`),
  CONSTRAINT `fk_employee_iddd` FOREIGN KEY (`fk_employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_project_idd` FOREIGN KEY (`fk_project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela goals.recoveries: ~1 rows (aproximadamente)
DELETE FROM `recoveries`;
/*!40000 ALTER TABLE `recoveries` DISABLE KEYS */;
/*!40000 ALTER TABLE `recoveries` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.studies_plan
CREATE TABLE IF NOT EXISTS `studies_plan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `fk_recovery_id` int unsigned DEFAULT NULL,
  `title` varchar(60) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `skill` varchar(60) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recovery_id` (`fk_recovery_id`),
  CONSTRAINT `fk_recovery_id` FOREIGN KEY (`fk_recovery_id`) REFERENCES `recoveries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela goals.studies_plan: ~0 rows (aproximadamente)
DELETE FROM `studies_plan`;
/*!40000 ALTER TABLE `studies_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `studies_plan` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.type_evaluate
CREATE TABLE IF NOT EXISTS `type_evaluate` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `character` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela goals.type_evaluate: ~2 rows (aproximadamente)
DELETE FROM `type_evaluate`;
/*!40000 ALTER TABLE `type_evaluate` DISABLE KEYS */;
INSERT INTO `type_evaluate` (`id`, `name`, `character`) VALUES
	(2, 'Chapter', 'C'),
	(3, 'Squad', 'S'),
	(4, 'Skills', 'K');
/*!40000 ALTER TABLE `type_evaluate` ENABLE KEYS */;

-- Copiando estrutura para tabela goals.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(60) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela goals.users: ~4 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `user`, `password`) VALUES
	(2, 'Brendo', 'e10adc3949ba59abbe56e057f20f883e'),
	(3, 'leonardo', 'e10adc3949ba59abbe56e057f20f883e'),
	(4, 'paola', 'e10adc3949ba59abbe56e057f20f883e'),
	(5, 'nivaldo', 'e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
