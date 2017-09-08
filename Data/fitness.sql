/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100121
Source Host           : localhost:3306
Source Database       : fitness

Target Server Type    : MYSQL
Target Server Version : 100121
File Encoding         : 65001

Date: 2017-09-08 16:22:42
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
  `group` int(11) NOT NULL DEFAULT '3' COMMENT '组',
  `number` int(11) NOT NULL DEFAULT '0' COMMENT '次数',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `weight` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '权重',
  `status` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fitness_items
-- ----------------------------

-- ----------------------------
-- Table structure for fitness_items_rule
-- ----------------------------
DROP TABLE IF EXISTS `fitness_items_rule`;
CREATE TABLE `fitness_items_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '锻炼项目',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `weight` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '权重',
  `status` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fitness_items_rule
-- ----------------------------

-- ----------------------------
-- Table structure for fitness_record
-- ----------------------------
DROP TABLE IF EXISTS `fitness_record`;
CREATE TABLE `fitness_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `sign` int(5) NOT NULL DEFAULT '0' COMMENT '连续签到次数',
  `content` varchar(1500) NOT NULL DEFAULT '' COMMENT '锻炼内容',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fitness_record
-- ----------------------------

-- ----------------------------
-- Table structure for fitness_user
-- ----------------------------
DROP TABLE IF EXISTS `fitness_user`;
CREATE TABLE `fitness_user` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `wx_openid` varchar(28) DEFAULT '' COMMENT '微信OPENID',
  `reg_time` int(11) DEFAULT '0' COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fitness_user
-- ----------------------------
