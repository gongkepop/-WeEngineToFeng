<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

global $_W,$_GPC;

$uid = mc_openid2uid($_W['openid']);
if (empty($uid)) 
{
	$uid=mc_oauth_userid($_W['openid']);
}




//查询基本配置
$sql="select * from ".tablename("super_card_config")." where weid={$_W['weid']}";
$config=pdo_fetch($sql);
$cardconfig=json_decode($config['level_config'],true);
if(!$cardconfig['is_buy']){
	message("对不起，暂未开通会员卡购买",  $this->createMobileUrl("index"),"error");
}


//查询分组
$sql="select * from ".tablename("super_card_group")." where weid={$_W['weid']} and fid=0";
$group= pdo_fetchall($sql);

if($_GPC['group1']){
	
	$sql="select * from ".tablename("super_card_group")." where weid={$_W['weid']} and fid={$_GPC['group1']}";
	$group2= pdo_fetchall($sql);
	
}


//查询已购买会员卡
$sql="select c.*,ct.group,ct.group_level from ".tablename("super_card")." c
	left join ". tablename("super_card_type")." ct on ct.id=c.tid
	where c.openid='{$_W['openid']}'";
$card=  pdo_fetchall($sql);

$levelid=array();
$where="";
$grouplevel=array();
foreach($card as $value){
	if($value['tid']){
		$levelid[]=$value['tid'];
	}
	//查询目前组内最大等级
	if($grouplevel[$value['group']]<$value['group_level']){
		$grouplevel[$value['group']]=$value['group_level'];
	}
}
if($levelid){
	$levelid=  implode(",", $levelid);
	$where.=" and ct.id not in ($levelid)";
}


//检测会员等级
$levelModel=  getlevelModel($this->config['level_type']);
$level=$levelModel->getMemberLevel();

if($_GPC['group2']&&$_GPC['group1']){
	$where.=" and ct.group={$_GPC['group2']}";
	if($grouplevel[$_GPC['group2']]){
		$where.=" and ct.group_level>={$grouplevel[$_GPC['group2']]}";
	}
}

if($_GPC['group1']){
	$where.=" and (ct.group={$_GPC['group1']} or cg1.id={$_GPC['group1']})";
}


//查询可购买的会员卡
$sql="select ct.* from ".tablename("super_card_type")." ct 
	left join ".tablename("super_card_group")." cg on ct.group=cg.id
		left join ".tablename("super_card_group")." cg1 on cg.fid=cg1.id

where ct.weid={$_W['weid']} and ct.isbuy=1 $where";

$cardlist=  pdo_fetchall($sql);

foreach($cardlist as $key=>$value){
  	//print_r($levelModel->getCardMaxLevel($value['id'])."***");
	if($level>$levelModel->getCardMaxLevel($value['levelid'])){
		unset($cardlist[$key]);
	}
}

if(!$cardlist&&(!$_GPC['group1']&&!$_GPC['group2'])){
	message("暂无可购买的会员卡",$this->createMobileUrl("index"),"success");
	die;
	
}



include $this->template('buy');