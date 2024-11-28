/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : 127.0.0.1:3309
Source Database       : system_ntti

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-11-29 00:26:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for qualification
-- ----------------------------
DROP TABLE IF EXISTS `qualification`;
CREATE TABLE `qualification` (
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `name_2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of qualification
-- ----------------------------
INSERT INTO `qualification` VALUES ('បរិញ្ញាបត្រ', 'Bachelor Degree', 'បរិញ្ញាបត្រ');
INSERT INTO `qualification` VALUES ('បរិញ្ញាបត្ររង', 'Associate Degree', 'បរិញ្ញាបត្ររង');
INSERT INTO `qualification` VALUES ('អនុបណ្ឌិត', 'Master', 'អនុបណ្ឌិត');
INSERT INTO `qualification` VALUES ('សញ្ញាបត្រC1', 'C1 degree', 'សញ្ញាបត្រC1');
INSERT INTO `qualification` VALUES ('សញ្ញាបត្រC2', 'C2 degree', 'សញ្ញាបត្រC2');
INSERT INTO `qualification` VALUES ('សញ្ញាបត្រC3', 'C3 degree', 'សញ្ញាបត្រC3');
INSERT INTO `qualification` VALUES ('បន្តបរិញ្ញាបត្របច្ចេកវីទ្យា', 'Bachelor of Technology', 'បន្តបរិញ្ញាបត្របច្ចេកវីទ្យា');
