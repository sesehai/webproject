/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : yii2advanced

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2014-12-24 14:25:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `auth_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('admin', '1', null);

-- ----------------------------
-- Table structure for `auth_item`
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('admin', '1', '管理员', 'admin_rule', '', null, null);
INSERT INTO `auth_item` VALUES ('backend_order_index', '2', '订单列表', null, '', null, null);

-- ----------------------------
-- Table structure for `auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('admin', 'backend_order_index');

-- ----------------------------
-- Table structure for `auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------
INSERT INTO `auth_rule` VALUES ('admin_rule', 'O:14:\"base\\AdminRule\":3:{s:4:\"name\";N;s:9:\"createdAt\";N;s:9:\"updatedAt\";N;}', null, null);

-- ----------------------------
-- Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1417768027');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1417768040');
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', '1418973304');

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(200) DEFAULT NULL COMMENT '客户姓名',
  `customer_phone` varchar(200) DEFAULT NULL COMMENT '客户电话',
  `customer_address` varchar(500) DEFAULT NULL COMMENT '客户信息地址',
  `customer_province` smallint(5) DEFAULT NULL COMMENT '客户所在省',
  `customer_city` smallint(5) DEFAULT NULL COMMENT '客户所在市',
  `customer_district` smallint(5) DEFAULT NULL COMMENT '客户所在县(区)',
  `car_plate_type` varchar(100) DEFAULT NULL COMMENT '车牌类型',
  `car_plate_number` varchar(100) DEFAULT NULL COMMENT '车牌号码',
  `car_register_time` datetime DEFAULT NULL COMMENT '车辆注册时间',
  `car_engine_vin` varchar(100) DEFAULT NULL COMMENT 'VIN',
  `car_engine_number` varchar(100) DEFAULT NULL COMMENT '发动机编号',
  `car_mileage` decimal(10,2) DEFAULT NULL COMMENT '汽车里程数',
  `service_time` varchar(200) DEFAULT NULL COMMENT '服务时间',
  `total_price` decimal(10,2) DEFAULT NULL COMMENT '总价',
  `pay_type` char(1) DEFAULT NULL COMMENT '付款方式',
  `invoice_title` varchar(500) DEFAULT NULL COMMENT '发票抬头',
  `remark` varchar(800) DEFAULT NULL COMMENT '备注',
  `addtime` datetime DEFAULT NULL COMMENT '提交时间',
  `updatetime` datetime DEFAULT NULL COMMENT '更新时间',
  `status` smallint(5) DEFAULT NULL COMMENT '订单状态',
  `maintance_type` smallint(5) DEFAULT NULL COMMENT '保养类型:1-小保养，2-大保养',
  `car_model_id` int(10) DEFAULT NULL COMMENT '汽车ID',
  `car_model_name` varchar(100) DEFAULT NULL COMMENT '汽车型号名称',
  `diy` tinyint(1) DEFAULT NULL,
  `source` varchar(64) DEFAULT NULL,
  `service_car_id` int(10) DEFAULT NULL COMMENT '服务车辆id',
  `service_car_plate_number` varchar(100) DEFAULT NULL COMMENT '服务车辆车牌号',
  `service_begin_time` datetime DEFAULT NULL COMMENT '服务车辆开始时间',
  `service_end_time` datetime DEFAULT NULL COMMENT '服务车辆结束时间',
  `activity` varchar(1024) DEFAULT NULL,
  `service_time_day` date DEFAULT NULL,
  `service_time_span` varchar(255) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL COMMENT '经度',
  `latitude` varchar(100) DEFAULT NULL COMMENT '纬度',
  `product_is_sale` char(1) DEFAULT NULL COMMENT '确认是否出货:0-否，1-是',
  PRIMARY KEY (`id`),
  KEY `car_plate_number` (`car_plate_number`) USING BTREE,
  KEY `customer_name` (`customer_name`) USING BTREE,
  KEY `customer_phone` (`customer_phone`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=879 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('1', '张三', '1399999991', '北京市朝阳区姚家园路105号宏城鑫泰大厦10层', '2', '52', '503', '京', 'K1254', '2013-12-29 00:00:00', '5254589652', 'JJKKJK7845124', null, '2014-07-10 8:00-12:00', '416.00', '1', '个人', '请早上来，来前打电话', '2014-07-09 17:49:39', '2014-07-09 17:49:39', '9', null, null, null, null, null, null, null, null, null, null, '2014-07-10', '上午', null, null, null);
INSERT INTO `order` VALUES ('2', '李四', '1399999992', '北京市海淀区将课件发松岛枫', '2', '52', '502', '京', 'K19033', '2014-06-29 00:00:00', 'JFLDFJE21313131313', '235235245235243523', null, '2014-07-10 17:00-20:00', '242.00', '1', '个人', '提前电话通知', '2014-07-09 22:36:38', '2014-07-09 22:36:38', '9', null, null, null, null, null, null, null, null, null, null, '2014-07-10', '晚间', null, null, null);
INSERT INTO `order` VALUES ('3', '王五', '1399999993', '北京市海淀区将课件发松岛枫', '2', '52', '502', '京', 'K19033', '2014-06-30 00:00:00', 'JFLDFJE21313131313', '235235245235243523', null, '2014-07-14 8:00-12:00', '442.00', '2', '个人', '发到付订单', '2014-07-13 12:57:31', '2014-07-13 12:57:31', '9', null, null, null, null, null, null, null, null, null, null, '2014-07-14', '上午', null, null, null);

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'sesehai', 'kERi2ZaY68jBiMtl8pN1TYGOHEXSYxIl', '$2y$13$M0ocjc0ozjKPDjCRUNG/fOaPDco098gt5qF213gXPM9qFTUEi0xeq', null, 'sesehai@qq.com', '10', '10', '1417768116', '1417768116');
