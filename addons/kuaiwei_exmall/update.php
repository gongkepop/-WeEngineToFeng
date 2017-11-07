<?php

if(!pdo_fieldexists('kuaiwei_exmall_base', 'title')) {
	pdo_query("ALTER TABLE ".tablename('kuaiwei_exmall_base')." ADD `title` varchar(255) DEFAULT '' COMMENT '商城标题';");
}
