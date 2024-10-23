/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : 127.0.0.1:3309
Source Database       : system_ntti

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-10-23 19:03:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for class_schedule
-- ----------------------------
DROP TABLE IF EXISTS `class_schedule`;
CREATE TABLE `class_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_code` varchar(100) DEFAULT NULL,
  `session_year_code` varchar(100) DEFAULT NULL,
  `years` varchar(100) DEFAULT NULL,
  `semester` varchar(100) DEFAULT NULL,
  `sections_code` varchar(100) DEFAULT NULL,
  `skills_code` varchar(100) DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `department_code` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of class_schedule
-- ----------------------------
INSERT INTO `class_schedule` VALUES ('7', 'IT07B', '2024_2025', null, '1', 'N', 'IT', 'បរិញ្ញាបត្រ', '2024-10-23', '2024-10-23 11:25:54', '2024-10-23 11:25:54', 'D_IT');
