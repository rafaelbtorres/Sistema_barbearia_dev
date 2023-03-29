/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50651
 Source Host           : localhost:3306
 Source Schema         : barbearia

 Target Server Type    : MySQL
 Target Server Version : 50651
 File Encoding         : 65001

 Date: 27/03/2023 19:10:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for agendamento
-- ----------------------------
DROP TABLE IF EXISTS `agendamento`;
CREATE TABLE `agendamento`  (
  `id_agendamento` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `barbearia` int(11) NOT NULL,
  `data_agendamento` date NOT NULL,
  `horario_agendamento` time NOT NULL,
  `valor_total` decimal(10, 0) NOT NULL,
  `status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'P' COMMENT 'F - finalizado | P - pendente | C - Cancelado',
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `filial` int(11) NULL DEFAULT NULL,
  `cabeleleiro` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_agendamento`) USING BTREE,
  INDEX `fk_user_id`(`usuario`) USING BTREE,
  INDEX `fk_barbearia_id`(`barbearia`) USING BTREE,
  CONSTRAINT `fk_barbearia_id` FOREIGN KEY (`barbearia`) REFERENCES `barbearia` (`barbearia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`usuario`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of agendamento
-- ----------------------------
INSERT INTO `agendamento` VALUES (12, 3, 8, '2020-11-26', '18:00:00', 18, 'F', '2020-11-26 16:26:34', NULL, NULL);
INSERT INTO `agendamento` VALUES (13, 3, 8, '2020-11-27', '10:00:00', 28, 'F', '2020-11-26 23:05:00', NULL, NULL);
INSERT INTO `agendamento` VALUES (14, 3, 8, '2020-11-27', '12:30:00', 10, 'F', '2020-11-26 23:05:14', NULL, NULL);
INSERT INTO `agendamento` VALUES (15, 3, 8, '2020-11-27', '13:30:00', 10, 'F', '2020-11-26 23:12:40', NULL, NULL);
INSERT INTO `agendamento` VALUES (16, 4, 8, '2020-12-07', '13:00:00', 18, 'F', '2020-12-04 12:16:25', NULL, NULL);
INSERT INTO `agendamento` VALUES (19, 5, 8, '2020-12-07', '17:30:00', 25, 'F', '2020-12-07 15:21:22', NULL, NULL);
INSERT INTO `agendamento` VALUES (20, 3, 8, '2020-12-08', '18:00:00', 34, 'P', '2020-12-08 09:59:19', NULL, NULL);
INSERT INTO `agendamento` VALUES (21, 6, 8, '2023-03-18', '14:30:00', 18, 'P', '2023-03-18 13:57:00', NULL, NULL);
INSERT INTO `agendamento` VALUES (22, 6, 20, '2023-03-18', '23:30:00', 250, 'P', '2023-03-18 19:57:09', NULL, NULL);
INSERT INTO `agendamento` VALUES (23, 7, 23, '2023-03-29', '12:01:00', 15, 'P', '2023-03-27 18:33:29', 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
