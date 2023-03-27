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

 Date: 27/03/2023 19:10:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for filial
-- ----------------------------
DROP TABLE IF EXISTS `filial`;
CREATE TABLE `filial`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id automático',
  `barbearia` int(255) NULL DEFAULT NULL COMMENT 'Qual barbearia pertence',
  `nome` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Nome da filial',
  `rua` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cep` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bairro` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `numero` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cidade` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `estado` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'A' COMMENT '[A]tiva, [I]nativa, [E]xcluída',
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `telefone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Telefone para contato da filial',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of filial
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
