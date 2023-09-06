/*
 Navicat Premium Data Transfer

 Source Server         : Dev@MySQL8
 Source Server Type    : MySQL
 Source Server Version : 80032 (8.0.32)
 Source Host           : localhost:3306
 Source Schema         : fast_admin

 Target Server Type    : MySQL
 Target Server Version : 80032 (8.0.32)
 File Encoding         : 65001

 Date: 06/09/2023 13:37:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for casbin_rule
-- ----------------------------
DROP TABLE IF EXISTS `casbin_rule`;
CREATE TABLE `casbin_rule`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ptype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `v0` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `v1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `v2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `v3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `v4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `v5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sys_login_log
-- ----------------------------
DROP TABLE IF EXISTS `sys_login_log`;
CREATE TABLE `sys_login_log`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip` varchar(46) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '登录ip',
  `account` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '登录用户账号',
  `login_time` int UNSIGNED NOT NULL COMMENT '登录时间',
  `status` tinyint(1) NOT NULL COMMENT '登录状态：1-成功，2-失败',
  `status_msg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '状态对应的消息说明',
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '用户代理',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '系统登录日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int UNSIGNED NOT NULL COMMENT '上级菜单id',
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '菜单名称',
  `path` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '前端路径',
  `permission` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '权限',
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '菜单图标',
  `sort` int NOT NULL DEFAULT 0 COMMENT '排序字段：越大越靠前',
  `enabled` tinyint(1) NOT NULL DEFAULT 1 COMMENT '已启用：1-是，0-否',
  `create_time` int UNSIGNED NOT NULL COMMENT '创建时间',
  `creator_id` int UNSIGNED NOT NULL COMMENT '创建人id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '系统菜单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sys_operate_log
-- ----------------------------
DROP TABLE IF EXISTS `sys_operate_log`;
CREATE TABLE `sys_operate_log`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '标题',
  `type` tinyint(1) NOT NULL COMMENT '操作类型：1-新增，2-编辑，3-删除',
  `user_id` int UNSIGNED NOT NULL COMMENT '操作人id',
  `operate_time` int UNSIGNED NOT NULL COMMENT '操作时间',
  `ip` varchar(46) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '操作的客户端ip地址',
  `route` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '操作路由',
  `status` tinyint(1) NOT NULL COMMENT '操作状态：1-成功，2-失败',
  `status_msg` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '操作状态对应的消息说明',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '系统操作日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sys_operate_log_info
-- ----------------------------
DROP TABLE IF EXISTS `sys_operate_log_info`;
CREATE TABLE `sys_operate_log_info`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `operate_log_id` int UNSIGNED NOT NULL COMMENT '操作日志id',
  `request_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '请求url',
  `request_headers` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '请求头信息',
  `request_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '请求体',
  `cid` int UNSIGNED NOT NULL COMMENT '操作的表数据id',
  `old_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '旧数据',
  `new_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '新数据',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '系统操作日志详情表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sys_role
-- ----------------------------
DROP TABLE IF EXISTS `sys_role`;
CREATE TABLE `sys_role`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '角色名称',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '角色备注',
  `enabled` tinyint(1) NOT NULL DEFAULT 1 COMMENT '已启用：1-是，0-否',
  `create_time` int UNSIGNED NOT NULL COMMENT '创建时间',
  `creator_id` int UNSIGNED NOT NULL COMMENT '创建人id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '系统角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `account` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '账号',
  `nickname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '昵称',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '登录密码',
  `avatar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '头像',
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '邮箱号',
  `enabled` tinyint(1) NOT NULL DEFAULT 1 COMMENT '已启用：1-是，0-否',
  `last_login_ip` varchar(46) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `create_time` int UNSIGNED NOT NULL COMMENT '创建时间',
  `creator_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建人id，没有则为0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '系统用户表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
