/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : 127.0.0.1:3309
Source Database       : system_ntti

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-11-30 14:35:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for classes
-- ----------------------------
DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes` (
  `code` varchar(11) NOT NULL DEFAULT '',
  `name` varchar(11) DEFAULT '',
  `school_year_code` varchar(50) DEFAULT '',
  `skills_code` varchar(20) DEFAULT NULL,
  `sections_code` varchar(50) DEFAULT NULL,
  `department_code` varchar(110) DEFAULT NULL,
  `level` varchar(100) DEFAULT NULL,
  `name_2` varchar(11) DEFAULT '',
  `is_active` varchar(255) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- ----------------------------
-- Records of classes
-- ----------------------------
INSERT INTO `classes` VALUES ('EE.024A', 'EE.024a', '2024_2025', 'ET', 'M', 'D_EL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:12:36', '2024-11-28');
INSERT INTO `classes` VALUES ('EE.024B', 'EE.024b', '2024_2025', 'ET', 'M', 'D_EL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:12:58', '2024-11-28');
INSERT INTO `classes` VALUES ('EE.013EA1', 'EE.013Ea1', '2024_2025', 'ET', 'N', 'D_EL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:13:33', '2024-11-28');
INSERT INTO `classes` VALUES ('EE.013EA2', 'EE.013Ea2', '2024_2025', 'ET', 'N', 'D_EL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:13:54', '2024-11-28');
INSERT INTO `classes` VALUES ('CE.025A', 'CE.025a', '2024_2025', 'CL', 'M', 'D_CL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:14:22', '2024-11-28');
INSERT INTO `classes` VALUES ('CE.025B', 'CE.025B', '2024_2025', 'CL', 'M', 'D_CL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:14:45', '2024-11-28');
INSERT INTO `classes` VALUES ('CE.013EA1', 'CE.013EA1', '2024_2025', 'CL', 'N', 'D_CL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:15:08', '2024-11-28');
INSERT INTO `classes` VALUES ('CE.013EA2', 'CE.013EA2', '2024_2025', 'CL', 'N', 'D_CL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:15:36', '2024-11-28');
INSERT INTO `classes` VALUES ('NE.05A1', 'NE.05A1', '2024_2025', 'EL', 'M', 'D_EL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:16:05', '2024-11-28');
INSERT INTO `classes` VALUES ('NE.05A2', 'NE.05A2', '2024_2025', 'EL', 'M', 'D_EL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:16:26', '2024-11-28');
INSERT INTO `classes` VALUES ('NE.05B1', 'NE.05B1', '2024_2025', 'EL', 'N', 'D_EL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:16:51', '2024-11-28');
INSERT INTO `classes` VALUES ('NE.05B2', 'NE.05B2', '2024_2025', 'EL', 'N', 'D_EL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:17:13', '2024-11-28');
INSERT INTO `classes` VALUES ('IT.011A1', 'IT.011A1', '2024_2025', 'IT', 'M', 'D_IT', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:19:24', '2024-11-28');
INSERT INTO `classes` VALUES ('IT.011A2', 'IT.011a2', '2024_2025', 'IT', 'M', 'D_IT', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:19:47', '2024-11-28');
INSERT INTO `classes` VALUES ('IT.011B1', 'IT.011B1', '2024_2025', 'IT', 'N', 'D_IT', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:20:07', '2024-11-28');
INSERT INTO `classes` VALUES ('IT.011B2', 'IT.011B2', '2024_2025', 'IT', 'N', 'D_IT', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:20:29', '2024-11-28');
INSERT INTO `classes` VALUES ('AHR.014A', 'AHR.014A', '2024_2025', 'AC', 'M', 'D_CL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:21:16', '2024-11-28');
INSERT INTO `classes` VALUES ('AHR.014B', 'AHR.014B', '2024_2025', 'AC', 'M', 'D_CL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-28 18:22:02', '2024-11-28');
INSERT INTO `classes` VALUES ('ED.022M1', 'ED.022M1', '2024_2025', 'ET', 'M', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:22:48', '2024-11-28');
INSERT INTO `classes` VALUES ('ED.022A1', 'ED.022A1', '2024_2025', 'ET', 'A', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:23:18', '2024-11-28');
INSERT INTO `classes` VALUES ('ED.022B1', 'ED.022B1', '2024_2025', 'ET', 'N', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:23:45', '2024-11-28');
INSERT INTO `classes` VALUES ('CD.022M1', 'CD.022M1', '2024_2025', 'CL', 'M', 'D_CL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:24:24', '2024-11-28');
INSERT INTO `classes` VALUES ('CD.022A1', 'CD.022A1', '2024_2025', 'CL', 'A', 'D_CL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:24:46', '2024-11-28');
INSERT INTO `classes` VALUES ('CD.022B1', 'CD.022B1', '2024_2025', 'CL', 'N', 'D_CL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:25:04', '2024-11-28');
INSERT INTO `classes` VALUES ('ND.02A1', 'ND.02A1', '2024_2025', 'EL', 'A', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:25:29', '2024-11-28');
INSERT INTO `classes` VALUES ('ND.02B1', 'ND.02B1', '2024_2025', 'EL', 'N', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:25:47', '2024-11-28');
INSERT INTO `classes` VALUES ('ITD.09M1', 'ITD.09M1', '2024_2025', 'IT', 'M', 'D_IT', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:26:12', '2024-11-28');
INSERT INTO `classes` VALUES ('ITD.09A1', 'ITD.09A1', '2024_2025', 'IT', 'A', 'D_IT', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:26:31', '2024-11-28');
INSERT INTO `classes` VALUES ('ITD.09B1', 'ITD.09B1', '2024_2025', 'IT', 'N', 'D_IT', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:26:54', '2024-11-28');
INSERT INTO `classes` VALUES ('DA.09M', 'DA.09M', '2024_2025', 'AIR', 'M', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:27:31', '2024-11-28');
INSERT INTO `classes` VALUES ('DA.09A', 'DA.09A', '2024_2025', 'AIR', 'A', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:27:49', '2024-11-28');
INSERT INTO `classes` VALUES ('DA.09B', 'DA.09B', '2024_2025', 'AIR', 'N', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:28:13', '2024-11-28');
INSERT INTO `classes` VALUES ('MD.02M1', 'MD.02M1', '2024_2025', 'MEL', 'M', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:28:38', '2024-11-28');
INSERT INTO `classes` VALUES ('MD.02A1', 'MD.02A1', '2024_2025', 'MEL', 'A', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:28:59', '2024-11-28');
INSERT INTO `classes` VALUES ('MD.02B1', 'MD.02B1', '2024_2025', 'MEL', 'N', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-28 18:29:18', '2024-11-28');
INSERT INTO `classes` VALUES ('EE024C', 'EE024C', '2024_2025', 'ET', 'M', 'D_EL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-30 14:18:45', '2024-11-30');
INSERT INTO `classes` VALUES ('EE.024D', 'EE.024D', '2024_2025', 'ET', 'M', 'D_EL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-30 14:19:12', '2024-11-30');
INSERT INTO `classes` VALUES ('EE.024E', 'EE.024E', '2024_2025', 'ET', 'M', 'D_EL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-30 14:19:55', '2024-11-30');
INSERT INTO `classes` VALUES ('EE.013EA3', 'EE.013Ea3', '2024_2025', 'ET', 'N', 'D_EL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-30 14:20:56', '2024-11-30');
INSERT INTO `classes` VALUES ('EE.013EA4', 'EE.013EA4', '2024_2025', 'ET', 'N', 'D_EL', 'បរិញ្ញាបត្រ', '', 'yes', '2024-11-30 14:21:20', '2024-11-30');
INSERT INTO `classes` VALUES ('ED.022M2', 'ED.022M2', '2024_2025', 'ET', 'M', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-30 14:21:58', '2024-11-30');
INSERT INTO `classes` VALUES ('ED.022A2', 'ED.022A2', '2024_2025', 'ET', 'A', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-30 14:22:44', '2024-11-30');
INSERT INTO `classes` VALUES ('ED.022A3', 'ED.022A3', '2024_2025', 'ET', 'A', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-30 14:23:06', '2024-11-30');
INSERT INTO `classes` VALUES ('ED.022B2', 'ED.022B2', '2024_2025', 'ET', 'N', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-30 14:23:51', '2024-11-30');
INSERT INTO `classes` VALUES ('ED.022B3', 'ED.022B3', '2024_2025', 'ET', 'N', 'D_EL', 'បរិញ្ញាបត្ររង', '', 'yes', '2024-11-30 14:24:17', '2024-11-30');
