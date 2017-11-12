<?php
					$sql="
	
CREATE TABLE if not exists `ims_super_staff_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `weid` int(11) NOT NULL COMMENT '公众号',
  `config` text COLLATE utf8_unicode_ci NOT NULL COMMENT '配置',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='多商户配置表';

CREATE TABLE  if not exists  `ims_super_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '角色名称',
  `config` text COLLATE utf8_unicode_ci COMMENT '角色配置',
  `weid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='角色表';


";
pdo_query($sql);

if(!pdo_fieldexists('super_staff', 'onwork')) {
	pdo_run("ALTER TABLE ".  tablename("super_staff")."  ADD COLUMN `onwork`  int(1) NULL DEFAULT 0 COMMENT '在班状态1在班0不在' AFTER `code`;");
}

if(!pdo_fieldexists('super_staff', 'rid')) {
	pdo_run("ALTER TABLE ".  tablename("super_staff")."  ADD COLUMN `rid`  int NULL COMMENT '角色' AFTER `onwork`;");
}
				?>
				