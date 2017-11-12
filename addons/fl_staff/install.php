<?php

$sql="
CREATE TABLE if not exists `ims_super_shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `weid` int(11) NOT NULL COMMENT '公众号id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '店铺名称',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `status` int(1) NOT NULL COMMENT '开启状态0关闭1开启',
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '店铺logo',
  `tel` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '店铺电话',
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '店铺地址',
  `address_x` float(9,2) DEFAULT NULL COMMENT '坐标x',
  `address_y` float(9,2) DEFAULT NULL COMMENT '坐标y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='超级商户表';

CREATE TABLE  if not exists  `ims_super_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `weid` int(11) NOT NULL COMMENT '公众号id',
  `sid` int(11) NOT NULL COMMENT '商户id',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '员工姓名',
  `tel` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '联系电话',
  `birth` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '生日',
  `staff_num` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '工号',
  `status` int(1) NOT NULL COMMENT '状态0禁用1启用',
  `openid` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '绑定的openid',
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '绑定码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='超级员工表';

	

";

pdo_query($sql);