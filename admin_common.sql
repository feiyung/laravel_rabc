/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : admin_common

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-04-01 10:55:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `route` varchar(100) DEFAULT NULL COMMENT '路由名',
  `permission_name` varchar(20) NOT NULL COMMENT '权限名',
  `is_menu` tinyint(1) DEFAULT '0' COMMENT '1菜单，0非菜单',
  `menu_url` varchar(100) DEFAULT '' COMMENT '菜单链接',
  `menu_icon` varchar(100) DEFAULT '' COMMENT '菜单图标',
  `pid` int(11) DEFAULT '0' COMMENT '层级关系',
  `level` tinyint(4) DEFAULT '1' COMMENT '权限等级',
  `sort` smallint(6) DEFAULT '0' COMMENT '排序权重',
  `status` tinyint(1) DEFAULT '1' COMMENT '1开启，0关闭',
  `remark` varchar(150) DEFAULT NULL COMMENT '说明',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`permission_name`) USING BTREE,
  UNIQUE KEY `route` (`route`) USING BTREE,
  KEY `pid` (`pid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='后台权限表';

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES ('2', 'admin.home', '首页', '1', '', '<i class=\"fa fa-home\"></i>', '0', '1', '2', '1', null, '2019-03-19 16:51:26', '2019-03-22 15:45:14', null);
INSERT INTO `admin_permissions` VALUES ('3', '#', '系统管理', '1', '', '<i class=\"fa fa-laptop\"></i>', '0', '1', '1', '1', null, '2019-03-19 17:13:41', '2019-03-22 15:45:15', null);
INSERT INTO `admin_permissions` VALUES ('4', 'adminer.index', '管理员', '1', '', null, '3', '2', '1', '1', null, '2019-03-19 17:19:16', '2019-03-22 16:43:43', null);
INSERT INTO `admin_permissions` VALUES ('5', 'adminer.create', '新增管理员页面', '0', '', null, '4', '3', '1', '1', null, '2019-03-19 17:25:17', '2019-03-19 17:25:17', null);
INSERT INTO `admin_permissions` VALUES ('6', 'adminer.store', '新增管理员', '0', '', null, '4', '3', '1', '1', null, '2019-03-20 11:31:12', '2019-03-20 11:31:12', null);
INSERT INTO `admin_permissions` VALUES ('7', 'adminer.edit', '编辑管理员页面', '0', '', null, '4', '3', '1', '1', null, '2019-03-20 11:34:22', '2019-03-20 11:34:22', null);
INSERT INTO `admin_permissions` VALUES ('8', 'adminer.update', '编辑管理员-保存', '0', '', null, '4', '3', '1', '1', null, '2019-03-20 11:35:21', '2019-03-20 11:35:21', null);
INSERT INTO `admin_permissions` VALUES ('9', 'adminer.update.status', '设置管理员状态', '0', '', null, '4', '3', '1', '1', null, '2019-03-20 11:38:31', '2019-03-20 11:38:31', null);
INSERT INTO `admin_permissions` VALUES ('10', 'adminer.destroy', '删除管理员', '0', '', null, '4', '3', '1', '1', null, '2019-03-20 14:00:55', '2019-03-20 14:00:55', null);
INSERT INTO `admin_permissions` VALUES ('11', 'role.index', '角色管理', '1', '', null, '3', '2', '1', '1', null, '2019-03-20 14:03:17', '2019-03-20 14:03:17', null);
INSERT INTO `admin_permissions` VALUES ('12', 'role.create', '新增角色-页面', '0', '', null, '11', '3', '1', '1', null, '2019-03-20 14:06:46', '2019-03-20 15:40:46', null);
INSERT INTO `admin_permissions` VALUES ('13', 'role.store', '新增角色-保存', '0', '', null, '11', '3', '1', '1', null, '2019-03-20 14:07:25', '2019-03-20 14:07:25', null);
INSERT INTO `admin_permissions` VALUES ('14', 'role.edit', '编辑角色-页面', '0', '', null, '11', '3', '1', '1', null, '2019-03-20 14:08:24', '2019-03-20 14:08:24', null);
INSERT INTO `admin_permissions` VALUES ('15', 'role.update', '编辑角色-保存', '0', '', null, '11', '3', '1', '1', null, '2019-03-20 14:08:53', '2019-03-20 14:08:53', null);
INSERT INTO `admin_permissions` VALUES ('16', 'role.update.status', '设置角色状态', '0', '', null, '11', '3', '1', '1', null, '2019-03-20 14:09:33', '2019-03-20 14:09:33', null);
INSERT INTO `admin_permissions` VALUES ('17', 'permission.index', '权限管理', '1', '', null, '3', '2', '1', '1', null, '2019-03-20 14:11:33', '2019-03-20 14:11:33', null);
INSERT INTO `admin_permissions` VALUES ('18', 'permission.create', '新增权限-页面', '0', '', null, '17', '3', '1', '1', null, '2019-03-20 14:12:22', '2019-03-20 14:12:22', null);
INSERT INTO `admin_permissions` VALUES ('19', 'permission.store', '新增权限-保存', '0', '', null, '17', '3', '1', '1', null, '2019-03-20 14:12:45', '2019-03-20 14:12:45', null);
INSERT INTO `admin_permissions` VALUES ('20', 'permission.edit', '编辑权限-页面', '0', '', null, '17', '3', '1', '1', null, '2019-03-20 14:13:08', '2019-03-20 14:13:08', null);
INSERT INTO `admin_permissions` VALUES ('21', 'permission.update', '编辑权限-保存', '0', '', null, '17', '3', '1', '1', null, '2019-03-20 14:13:37', '2019-03-20 14:13:37', null);
INSERT INTO `admin_permissions` VALUES ('22', 'permission.update.status', '设置权限状态', '0', '', null, '17', '3', '1', '1', null, '2019-03-20 14:14:34', '2019-03-20 14:14:34', null);

-- ----------------------------
-- Table structure for admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(15) NOT NULL,
  `sort` smallint(6) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolename` (`role_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='后台角色表';

-- ----------------------------
-- Records of admin_roles
-- ----------------------------
INSERT INTO `admin_roles` VALUES ('1', '超级管理员', '3', '1', '2019-03-19 15:09:32', '2019-03-21 16:15:29', null);
INSERT INTO `admin_roles` VALUES ('2', '测试', '1', '1', '2019-03-19 15:13:33', '2019-03-22 15:44:46', null);

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(15) NOT NULL,
  `nickname` varchar(15) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(30) DEFAULT NULL COMMENT '最后登录ip地址',
  `status` tinyint(1) DEFAULT '1' COMMENT '0禁用，1启用',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`) USING BTREE,
  UNIQUE KEY `mobile` (`mobile`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='后台用户表';

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES ('1', 'admin', '超级管理员', '$2y$10$XcSlEbDU0yL2teZCxSuPie5SFvwBBcwAoYF2XDQOjwfIjub9gKdVa', '15223408633', '2019-04-01 09:47:31', '127.0.0.1', '1', '2019-03-18 01:54:38', '2019-04-01 09:47:31', null);
INSERT INTO `admin_users` VALUES ('3', 'test', '测试', '$2y$10$sBGRCs2oc1kJWzPzJZa9AOuBpw0CXwJIXW2XqEc43PNjsxjdMvh1q', '15023776923', '2019-03-25 10:38:21', '127.0.0.1', '1', '2019-03-18 06:19:47', '2019-03-25 10:38:21', null);
INSERT INTO `admin_users` VALUES ('4', 'pm', '经理', '$2y$10$CI6zZcNr98WYIrcoNq92zu2L5HuUj100tfvdoLEFd7Qy.Ahu5Sd12', '18223585065', null, null, '1', '2019-03-21 10:40:22', '2019-03-21 10:40:22', null);
INSERT INTO `admin_users` VALUES ('5', 'hh', '哈哈', '$2y$10$H.TJPbFfkfezUbQ2d/f.p.2O9nZaku6Zaxx1oeaezi8LEkVc0OzVe', '15555555555', null, null, '1', '2019-03-21 11:00:03', '2019-03-21 11:00:03', null);
INSERT INTO `admin_users` VALUES ('7', 'hhh', '哈哈', '$2y$10$fMXwbQdIFl..go644LlCreLsO6ovImVQFJQJSpxSOChN0vENk5DeO', '15555555556', null, null, '1', '2019-03-21 11:12:15', '2019-03-21 11:32:34', null);

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `permisson_id` (`permission_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='角色权限关联表';

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES ('1', '2', '2019-03-21 16:05:56', '2019-03-21 16:05:56');
INSERT INTO `permission_role` VALUES ('1', '3', '2019-03-21 16:11:14', '2019-03-21 16:11:14');
INSERT INTO `permission_role` VALUES ('1', '4', '2019-03-21 16:11:14', '2019-03-21 16:11:14');
INSERT INTO `permission_role` VALUES ('1', '11', '2019-03-21 16:11:14', '2019-03-21 16:11:14');
INSERT INTO `permission_role` VALUES ('1', '17', '2019-03-21 16:11:14', '2019-03-21 16:11:14');
INSERT INTO `permission_role` VALUES ('1', '5', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '6', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '7', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '8', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '9', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '10', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '12', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '13', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '14', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '15', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '16', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '18', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '19', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '20', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '21', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('1', '22', '2019-03-21 16:15:29', '2019-03-21 16:15:29');
INSERT INTO `permission_role` VALUES ('2', '2', '2019-03-21 16:19:01', '2019-03-21 16:19:01');
INSERT INTO `permission_role` VALUES ('2', '3', '2019-03-21 17:12:34', '2019-03-21 17:12:34');
INSERT INTO `permission_role` VALUES ('2', '4', '2019-03-21 17:12:34', '2019-03-21 17:12:34');
INSERT INTO `permission_role` VALUES ('2', '11', '2019-03-21 17:12:35', '2019-03-21 17:12:35');
INSERT INTO `permission_role` VALUES ('2', '22', '2019-03-22 15:44:27', '2019-03-22 15:44:27');
INSERT INTO `permission_role` VALUES ('2', '17', '2019-03-22 15:44:46', '2019-03-22 15:44:46');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='用户角色关联表';

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '4', null, null);
INSERT INTO `role_user` VALUES ('2', '4', null, null);
INSERT INTO `role_user` VALUES ('2', '7', '2019-03-21 11:32:19', '2019-03-21 11:32:19');
INSERT INTO `role_user` VALUES ('1', '1', '2019-03-21 16:26:24', '2019-03-21 16:26:24');
INSERT INTO `role_user` VALUES ('2', '1', '2019-03-21 16:29:36', '2019-03-21 16:29:36');
INSERT INTO `role_user` VALUES ('2', '3', '2019-03-21 16:45:55', '2019-03-21 16:45:55');
