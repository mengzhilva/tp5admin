/*
Navicat MySQL Data Transfer

Source Server         : lll
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : tp

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2019-04-03 11:23:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for settings_module
-- ----------------------------
DROP TABLE IF EXISTS `settings_module`;
CREATE TABLE `settings_module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(128) NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '1',
  `desc` varchar(255) DEFAULT NULL,
  `icon` varchar(32) DEFAULT 'icon-th' COMMENT '菜单模块图标',
  `online` int(11) NOT NULL DEFAULT '1' COMMENT '模块是否在线',
  `groups` tinyint(4) DEFAULT '0' COMMENT '分组，0基础，1crm，2订单，3工厂',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='菜单模块';

-- ----------------------------
-- Records of settings_module
-- ----------------------------
INSERT INTO `settings_module` VALUES ('1', '系统设置', '', '5', '', 'fa fa-fw fa-asterisk', '1', '0');
INSERT INTO `settings_module` VALUES ('33', '管理员管理', '', '6', '                    sdfsdf', 'fa fa-fw fa-user-secret', '1', '0');

-- ----------------------------
-- Table structure for settings_url
-- ----------------------------
DROP TABLE IF EXISTS `settings_url`;
CREATE TABLE `settings_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `module_id` int(11) NOT NULL,
  `is_show` tinyint(4) NOT NULL COMMENT '是否在sidebar里出现',
  `online` int(11) NOT NULL DEFAULT '1' COMMENT '在线状态，还是下线状态，即可用，不可用。',
  `desc` varchar(255) DEFAULT NULL,
  `father_menu` int(11) NOT NULL DEFAULT '0' COMMENT '上一级菜单',
  `icon` varchar(64) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `issj` tinyint(2) DEFAULT '0' COMMENT '是否创建数据权限1是',
  `sjtype` tinyint(4) DEFAULT '1' COMMENT '数据权限，1私有，2公开',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=262 DEFAULT CHARSET=utf8 COMMENT='功能链接（菜单链接）';

-- ----------------------------
-- Records of settings_url
-- ----------------------------
INSERT INTO `settings_url` VALUES ('1', '管理员列表', '/admin/users/lists', '33', '1', '1', '', '0', 'fa fa-fw fa-user-secret', '1', '0', '1');
INSERT INTO `settings_url` VALUES ('260', '模块列表', '/admin/Setting/modulelist/', '1', '1', '1', '', '0', 'fa fa-fw fa-archive', '1', '0', '1');
INSERT INTO `settings_url` VALUES ('261', '应用列表', '/admin/Setting/urllist/', '1', '1', '1', '', '0', 'fa fa-fw fa-medium', '3', '0', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `lastlogintime` datetime DEFAULT NULL,
  `registertime` datetime DEFAULT NULL,
  `realname` varchar(200) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `role_id` tinyint(4) DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `found_id` int(11) DEFAULT '0' COMMENT '创建人id',
  `sex` int(11) DEFAULT '0' COMMENT '创建人id',
  `telephone` varchar(32) DEFAULT NULL COMMENT '手机号',
  `city` int(11) DEFAULT NULL COMMENT '市',
  `country` int(11) DEFAULT NULL COMMENT '区',
  `province` int(11) DEFAULT NULL COMMENT '省',
  `address` varchar(200) DEFAULT NULL COMMENT '详细地址',
  `emergency_people` varchar(200) DEFAULT NULL COMMENT '紧急联系人',
  `emergency_telephone` varchar(32) DEFAULT NULL COMMENT '紧急联系人电话',
  `idnumber` varchar(11) DEFAULT NULL COMMENT '身份证号',
  `company_id` int(11) DEFAULT NULL COMMENT '公司id',
  `customer_id` int(11) DEFAULT '0' COMMENT '前台用户id',
  `department_id` int(11) DEFAULT '0' COMMENT '部门id',
  `creater_name` varchar(50) DEFAULT NULL COMMENT '创建人名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('132', 'admin', '21232f297a57a5a743894a0e4a801fc3', null, null, 'admin', null, '1', '1', '0', '0', '137012933333', null, null, null, null, null, null, null, null, '0', '0', null);
