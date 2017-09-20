/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100121
Source Host           : localhost:3306
Source Database       : fitness

Target Server Type    : MYSQL
Target Server Version : 100121
File Encoding         : 65001

Date: 2017-09-20 18:14:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for fitness_items
-- ----------------------------
DROP TABLE IF EXISTS `fitness_items`;
CREATE TABLE `fitness_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL COMMENT '锻炼项目ID',
  `name` varchar(255) NOT NULL COMMENT '项目名称',
  `series` int(11) DEFAULT '0' COMMENT '组',
  `number` int(11) DEFAULT '0' COMMENT '次数',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `weight` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '权重',
  `status` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fitness_items
-- ----------------------------
INSERT INTO `fitness_items` VALUES ('1', '0', '上肢锻炼', '0', '0', '', '60', '0');
INSERT INTO `fitness_items` VALUES ('2', '0', '腹部锻炼', '0', '0', '', '55', '0');
INSERT INTO `fitness_items` VALUES ('3', '1', '交替哑铃弯举', '3', '15', '', '100', '0');
INSERT INTO `fitness_items` VALUES ('4', '1', '哑铃集中弯举', '3', '15', '', '90', '0');
INSERT INTO `fitness_items` VALUES ('5', '1', '哑铃卧推', '3', '10', '', '80', '0');
INSERT INTO `fitness_items` VALUES ('6', '1', '仰卧飞鸟', '3', '10', '', '70', '0');
INSERT INTO `fitness_items` VALUES ('7', '1', '俯卧撑', '3', '20', '', '60', '0');
INSERT INTO `fitness_items` VALUES ('8', '2', '平躺卷腹(上腹)', '3', '20', '', '100', '0');
INSERT INTO `fitness_items` VALUES ('9', '2', '垂直举腿(下腹)', '3', '20', '', '90', '0');
INSERT INTO `fitness_items` VALUES ('10', '2', '交臂卷腹(上腹)', '3', '20', '', '80', '0');

-- ----------------------------
-- Table structure for fitness_record
-- ----------------------------
DROP TABLE IF EXISTS `fitness_record`;
CREATE TABLE `fitness_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `sign` int(5) unsigned DEFAULT '0' COMMENT '连续签到次数',
  `duration` int(10) unsigned DEFAULT '0' COMMENT '锻炼时长',
  `content` varchar(1500) DEFAULT '' COMMENT '锻炼内容',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `endtime` int(10) unsigned DEFAULT '0' COMMENT '结束时间',
  `updatetime` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  `status` int(5) unsigned DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fitness_record
-- ----------------------------
INSERT INTO `fitness_record` VALUES ('1', '1', '0', '39999', '', '1505206401', '0', '1505206475', '0');

-- ----------------------------
-- Table structure for fitness_user
-- ----------------------------
DROP TABLE IF EXISTS `fitness_user`;
CREATE TABLE `fitness_user` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `wx_openid` varchar(28) DEFAULT '' COMMENT '微信OPENID',
  `reg_time` int(11) DEFAULT '0' COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fitness_user
-- ----------------------------
INSERT INTO `fitness_user` VALUES ('1', 'o11MP0ZlsXhQm3fX9HXngjhxvEDc', '1504865903');
