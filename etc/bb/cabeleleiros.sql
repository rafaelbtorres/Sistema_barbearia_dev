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

 Date: 27/03/2023 19:10:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cabeleleiros
-- ----------------------------
DROP TABLE IF EXISTS `cabeleleiros`;
CREATE TABLE `cabeleleiros`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Do funcionario',
  `nome` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Nome do funcionario',
  `data_criacao` datetime NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de criação',
  `status` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'A' COMMENT '[A]tivo, [I]nativo',
  `filiais` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Ids das filiais em que o funcionario esta.',
  `barbearia` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cabeleleiros
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
