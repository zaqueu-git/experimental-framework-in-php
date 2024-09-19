SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tests
-- ----------------------------
DROP TABLE IF EXISTS `tests`;
CREATE TABLE `tests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of tests
-- ----------------------------
INSERT INTO `tests` VALUES ('1', 'A');
INSERT INTO `tests` VALUES ('2', 'B');
INSERT INTO `tests` VALUES ('3', 'C');
INSERT INTO `tests` VALUES ('4', 'D');
INSERT INTO `tests` VALUES ('5', 'E');
INSERT INTO `tests` VALUES ('6', 'F');
INSERT INTO `tests` VALUES ('7', 'G');
INSERT INTO `tests` VALUES ('8', 'H');
INSERT INTO `tests` VALUES ('9', 'I');
INSERT INTO `tests` VALUES ('15', 'J');
INSERT INTO `tests` VALUES ('14', 'K');