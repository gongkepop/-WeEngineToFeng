<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getlevelModel(){
	global $_W,$_GPC;
	$sql="select * from ".tablename("super_card_config")." where weid={$_W['weid']}";
	$config=pdo_fetch($sql);
	$modelName=  getmodel();
	$array=$modelName['en'];
	require 'plugin/level/model/'.$array[$config['level_type']].".php";
	$modelName=$array[$config['level_type']]."Model";
	return new $modelName();
}

function getmodel(){
	return Array(
		"en"=>array(
			"card","ewei_shop2","wmall","j_money"
		),
		"ch"=>array(
			"自有等级","商城等级","微点餐等级","收银台"
		)
	);
}