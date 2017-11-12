<?php
					$sql="
	CREATE TABLE if not EXISTS ". tablename("super_card_form")." (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '表单名称',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '表单内容,json格式',
  `weid` int(11) DEFAULT NULL COMMENT '公众号id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='万能表单表';

CREATE TABLE if not EXISTS `ims_super_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `openid` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'openid',
  `status` int(11) NOT NULL COMMENT '状态0禁用1正常',
  `weid` int(11) NOT NULL COMMENT '所属公众号',
  `tel` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` int(1) DEFAULT NULL,
  `truename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='会员表';

CREATE  TABLE IF NOT EXISTS `ims_super_pay_order` (
 `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `openid` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '创建者openid',
  `money` decimal(9,2) NOT NULL COMMENT '金额',
  `status` int(1) NOT NULL COMMENT '支付状态0未支付1已支付',
  `paytime` int(11) DEFAULT NULL COMMENT '支付时间',
  `staff_id` int(11) NOT NULL COMMENT '收款人',
  `weid` int(11) NOT NULL COMMENT '公众号',
  `ordersn` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '订单编号',
  `cardmoney` decimal(9,2) DEFAULT NULL COMMENT '会员卡支付金额',
  `paymoney` decimal(9,2) DEFAULT NULL COMMENT '其他支付金额',
  `paystatus` int(1) DEFAULT NULL COMMENT '支付方式1会员卡2微信3微信+会员卡',
  `paysn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '支付返回订单编号',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '备注',
  `payplace` int(11) DEFAULT NULL COMMENT '支付来源1线下扫码支付',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='超级会员卡支付订单';


	CREATE TABLE if not exists `ims_super_card_staff_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '验证码',
  `openid` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'openid',
  `weid` int(11) NOT NULL COMMENT '公众号id',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `status` int(11) NOT NULL COMMENT '1扫码2授权3拒绝授权',
  `checktime` int(11) NOT NULL COMMENT '授权/拒绝授权时间',
  `staff_id` int(11) NOT NULL COMMENT '员工编号',
  `shop_id` int(11) NOT NULL COMMENT '店铺编号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='员工登录记录表';

CREATE TABLE  if not exists  `ims_super_card_credit_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `card` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '卡号',
  `openid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'openid',
  `types` int(11) NOT NULL COMMENT '1积分2余额3次数',
  `num` float(9,2) NOT NULL COMMENT '修改金额',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `staff_id` int(11) NOT NULL COMMENT '店员id',
  `shop_id` int(11) NOT NULL COMMENT '店铺id',
  `weid` int(11) NOT NULL COMMENT '公众号id',
  `place` int(11) NOT NULL COMMENT '来源1独立后台',
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '备注',
  `card_id` int(11) NOT NULL COMMENT '卡id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='卡操作记录表';

CREATE TABLE  if not exists `ims_super_card_type_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cardid` int(11) NOT NULL COMMENT '卡id',
  `oldtid` int(11) NOT NULL COMMENT '修改之前卡类型',
  `newtid` int(11) NOT NULL COMMENT '修改之后卡类型',
  `createtime` int(11) NOT NULL COMMENT '修改时间',
  `staff_id` int(11) DEFAULT NULL COMMENT '操作员工',
  `shop_id` int(11) DEFAULT NULL COMMENT '操作店铺',
  `openid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户openid',
  `place` int(11) NOT NULL COMMENT '来源1独立后台',
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '备注',
  `weid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='卡类型修改表';

CREATE TABLE if not exists  `ims_super_card_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `weid` int(11) NOT NULL COMMENT '公众号id',
  `createtime` int(11) NOT NULL COMMENT '修改时间',
  `cardid` int(11) NOT NULL COMMENT '卡编号',
  `staff_id` int(11) NOT NULL COMMENT '员工id',
  `shop_id` int(11) NOT NULL COMMENT '店铺id',
  `old_field` text COLLATE utf8_unicode_ci NOT NULL COMMENT '原始数据',
  `new_field` text COLLATE utf8_unicode_ci NOT NULL COMMENT '新数据',
  `place` int(11) NOT NULL COMMENT '来源',
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='卡编辑表';

CREATE TABLE if not exists `ims_super_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '内容',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `weid` int(11) NOT NULL COMMENT '公众号id',
  `status` int(11) DEFAULT NULL COMMENT '状态0关闭1显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户消息表';
CREATE TABLE  if not exists `ims_super_card_offline_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '菜单名称',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '地址',
  `icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '图标编号',
  `color` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '颜色',
  `status` int(11) DEFAULT '0' COMMENT '状态0禁用1启用',
  `weid` int(11) NOT NULL COMMENT '公众号id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='独立后台菜单表';

CREATE TABLE if not exists `ims_super_card_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '分组名称',
  `fid` int(11) NOT NULL COMMENT '父id，0为1级',
  `status` int(11) NOT NULL COMMENT '状态0关闭1启用',
  `weid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='会员卡分组';

CREATE TABLE if not exists `ims_super_card_type_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '套餐名',
  `price` decimal(9,2) NOT NULL COMMENT '售价',
  `number` int(11) NOT NULL COMMENT '次数',
  `tid` int(11) NOT NULL COMMENT '卡类型id',
  `status` int(1) NOT NULL COMMENT '状态1开启0关闭',
  `config` text COLLATE utf8_unicode_ci NOT NULL COMMENT '套餐配置',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='会员卡套餐表';

CREATE TABLE if not exists `ims_super_card_create_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `weid` int(11) NOT NULL COMMENT '公众号id',
  `staff_id` int(11) NOT NULL COMMENT '开卡员工id',
  `shop_id` int(11) NOT NULL COMMENT '开卡店铺id',
  `card_id` int(11) NOT NULL COMMENT '卡id',
  `tid` int(11) NOT NULL COMMENT '卡类型id',
  `createtime` int(11) NOT NULL COMMENT '开卡时间',
  `price` decimal(9,2) NOT NULL COMMENT '当前卡售价',
  `re_count` int(11) NOT NULL COMMENT '返还次数',
  `re_credit1` decimal(9,2) NOT NULL COMMENT '返还积分',
  `re_credit2` decimal(9,2) NOT NULL COMMENT '返还余额',
  `place` int(11) NOT NULL COMMENT '渠道',
  `card_num` int(11) NOT NULL COMMENT '卡号',
  `package` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '套餐名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='开卡记录表';

CREATE TABLE if not exists `ims_super_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `weid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

";
pdo_query($sql);



//20170124001
if(!pdo_fieldexists('super_card_type', 'wecard')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")."  ADD COLUMN `wecard`  int(1) NULL DEFAULT 0 COMMENT '是否同步到微信会员卡' AFTER `models`;");
}

if(!pdo_fieldexists('super_card_type', 'wecard_config')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")."  ADD COLUMN `wecard_config`  text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL COMMENT '微信会员卡配置项,json格式' AFTER `wecard`;");
}

if(!pdo_fieldexists('super_card_config', 'service_phone')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_config")."  ADD COLUMN `service_phone`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL COMMENT '服务电话' AFTER `sms_number`;");
}

if(!pdo_fieldexists('super_card_type', 'time_type')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")."  ADD COLUMN `time_type`  int(1) NULL DEFAULT 0 COMMENT '有效期0永久有效1按天2按月3按年' AFTER `wecard_config`;");
}

if(!pdo_fieldexists('super_card_type', 'wecard_id')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")."  ADD COLUMN `wecard_id`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL COMMENT '微信会员卡返回id' AFTER `time_type`;");
}


if(!pdo_fieldexists('super_card_type', 'wecard_status')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")."  ADD COLUMN `wecard_status`  int(1) NULL DEFAULT 0 COMMENT '卡包审核状态' AFTER `wecard_id`;");
}

if(!pdo_fieldexists('super_card_config', 'logo')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_config")."  ADD COLUMN `logo`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL COMMENT '商户logo' AFTER `name`;");
}


//20170209001
if(!pdo_fieldexists('super_card_type', 're_credit1')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")." ADD COLUMN `re_credit1`  decimal(9,2) NULL DEFAULT 0 COMMENT '返还积分' AFTER `wecard_status`;");
}
if(!pdo_fieldexists('super_card_type', 're_credit2')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")." ADD COLUMN `re_credit2`  decimal(9,2) NULL DEFAULT 0 COMMENT '返还余额' AFTER `re_credit1`;");
}


if(!pdo_fieldexists('super_card', 'diyform')) {
	pdo_run("ALTER TABLE ".  tablename("super_card")." ADD COLUMN `diyform`   text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER `default`;");
}

//20170303001
if(!pdo_fieldexists('super_card_config', 'text_config')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_config")." ADD COLUMN `text_config`  text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL COMMENT '文字设定' AFTER `level_config`;");
}

//20170303002
$sql="
	ALTER TABLE ". tablename("super_card_config")."
MODIFY COLUMN `level_config`  text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL COMMENT '等级配置，json格式储存' AFTER `level_type`;
	";

pdo_query($sql);




$sql="select * from ".tablename("modules_bindings")." where module='fl_card' and entry='cover' and do='staff'";
$cover= pdo_fetch($sql);
if(!$cover){
	
	$sql="
	INSERT INTO  ".tablename("modules_bindings")." (
	`eid` ,`module` ,`entry` ,`call` ,`title` ,`do` ,`state` ,`direct` ,`url` ,`icon` ,`displayorder`)
	VALUES (
	NULL ,  'fl_card',  'cover',  '',  '员工入口',  'staff',  '',  '0',  '',  '',  '0'
	);	
	";
	pdo_query($sql);
}




//20170425
if(!pdo_fieldexists('super_card_type', 're_count')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")."  ADD COLUMN `re_count`  int(11) NULL DEFAULT 0 COMMENT '返还次数' AFTER `re_credit2`;");
}

if(!pdo_fieldexists('super_card_type', 'iscount')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")."  ADD COLUMN `iscount`  int(1) NULL DEFAULT 0 COMMENT '是否开启次数功能' AFTER `re_count`;");
}

if(!pdo_fieldexists('super_card', 'card_count')) {
	pdo_run("ALTER TABLE ".  tablename("super_card")."  ADD COLUMN `card_count`  int NULL DEFAULT 0 COMMENT '会员卡剩余使用次数' AFTER `diyform`;");
}


//20170427
if(!pdo_fieldexists('super_card', 'bindtime')) {
	pdo_run("ALTER TABLE ".  tablename("super_card")."  ADD COLUMN `bindtime`  int NULL AFTER `card_count`;");
}

//20170525
if(!pdo_fieldexists('super_card', 'password')) {
	pdo_run("ALTER TABLE ".  tablename("super_card")."  ADD COLUMN `password`  varchar(20) NULL COMMENT '卡密码' AFTER `bindtime`;");
}

//20170601
if(!pdo_fieldexists('super_card_type', 'group')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")."  ADD COLUMN `group`  int(11) NULL DEFAULT 0 COMMENT '卡分组' AFTER `iscount`;");
}

if(!pdo_fieldexists('super_card_type', 'group_level')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")."  ADD COLUMN `group_level`  int(11) NULL DEFAULT 0 COMMENT '分组等级' AFTER `group`;");
}

if(!pdo_fieldexists('super_card_type', 'info')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")."  ADD COLUMN `info`  text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL COMMENT '卡说明' AFTER `group_level`;");
}




if(!pdo_fieldexists('super_card_group', 'weid')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_group")."  ADD COLUMN `weid` int(11) NOT NULL AFTER `status`;");
}




if(!pdo_fieldexists('super_card_order', 'card_num')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_order")."  ADD COLUMN `card_num`  int(11) NOT NULL DEFAULT 0 COMMENT '卡次数' AFTER `paytype`;");
}


//20170803
if(!pdo_fieldexists('super_card', 'info')) {
	pdo_run("ALTER TABLE ".  tablename("super_card")."  ADD COLUMN `info`  text NULL AFTER `password`;");
}

if(!pdo_fieldexists('super_card', 'idcard')) {
	pdo_run("ALTER TABLE ".  tablename("super_card")."  ADD COLUMN `idcard`  varchar(255) NULL COMMENT '身份证' AFTER `info`;");
}


//20170815
if(!pdo_fieldexists('super_card_create_log', 'content')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_create_log")."  ADD COLUMN `content`  text COLLATE utf8_unicode_ci COMMENT '备注' AFTER `package`;");
}




//20170904
if(!pdo_fieldexists('super_card_type', 'discount')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")."  ADD COLUMN `discount`  decimal(9,2) NULL DEFAULT 0 COMMENT '折扣' AFTER `info`;");
}


if(!pdo_fieldexists('super_card_type', 'credit_discount')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")." ADD COLUMN `credit_discount`  decimal(9,2) NULL DEFAULT 1 COMMENT '积分倍数' AFTER `discount`;");
}

if(!pdo_fieldexists('super_pay_order', 'discountmoney')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")." ADD COLUMN `discountmoney`  decimal(9,2) NULL DEFAULT 0 COMMENT '优惠金额' AFTER `paymoney`;");
}

//20171011
if(!pdo_fieldexists('super_card_type', 'up_credit')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type")." ADD COLUMN `up_credit`  int(11) NULL DEFAULT 0 COMMENT '升级条件' AFTER `credit_discount`;");
}


//20171026
if(!pdo_fieldexists('super_member', 'birth_year')) {
	pdo_run("ALTER TABLE ".  tablename("super_member")." ADD COLUMN `birth_year`  int(4) NULL AFTER `paypass`;");
}

if(!pdo_fieldexists('super_member', 'birth_month')) {
	pdo_run("ALTER TABLE ".  tablename("super_member")." ADD COLUMN `birth_month`  tinyint(2) NULL AFTER `birth_year`;");
}
if(!pdo_fieldexists('super_member', 'birth_day')) {
	pdo_run("ALTER TABLE ".  tablename("super_member")." ADD COLUMN `birth_day`  tinyint(2) NULL AFTER `birth_month`;");
}

if(!pdo_fieldexists('super_card', 'birth_year')) {
	pdo_run("ALTER TABLE ".  tablename("super_card")." ADD COLUMN `birth_year`  int(4) NULL AFTER `idcard`;");
}
if(!pdo_fieldexists('super_card', 'birth_month')) {
	pdo_run("ALTER TABLE ".  tablename("super_card")." ADD COLUMN `birth_month`  tinyint(2) NULL AFTER `birth_year`;");
}
if(!pdo_fieldexists('super_card', 'birth_day')) {
	pdo_run("ALTER TABLE ".  tablename("super_card")." ADD COLUMN `birth_day`  tinyint(2) NULL AFTER `birth_month`;");
}

if(!pdo_fieldexists('super_card_type_package', 'credit')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_type_package")." ADD COLUMN `credit`  int(11) NULL AFTER `price`;");
}


if(!pdo_fieldexists('super_card_order', 'credit')) {
	pdo_run("ALTER TABLE ".  tablename("super_card_order")." ADD COLUMN `credit`  int(11) NULL COMMENT '获赠积分' AFTER `card`;");
}
				?>
				