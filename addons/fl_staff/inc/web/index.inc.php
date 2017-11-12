<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $_W,$_GPC;
$nav="shop";
$task=$_GPC['task']?$_GPC['task']:"index";
$sql="select * from ".tablename("super_staff_config")." where weid={$_W['weid']}";
$res= pdo_fetch($sql);
if($res){
	$config=json_decode($res['config'],true);
}

if($task=="index"){
	
	$sql="select * from ".tablename("super_shops")." where weid={$_W['weid']}";
	$list= pdo_fetchall($sql);
	
	
	include $this->template('index');
	
	
} elseif ($task=="add") {
	
	if($config['shopnum']>0){
		$sql="select count(*) from ".tablename("super_shops")." where weid={$_W['weid']}";
		$count=pdo_fetchcolumn($sql);
		if($count>=$config['shopnum']){
			message("您最多只能添加{$config['shopnum']}个商户。", referer());
			die;
		}
	}
	
	
	
	include $this->template('shop_add');
	
} elseif ($task=="edit") {
	
	$sql="select * from ".tablename("super_shops")." where id={$_GPC['id']} and weid={$_W['weid']}";
	$res= pdo_fetch($sql);
	if(!$res){
		message("店铺不存在",$this->createWebUrl("index"),"error");
		die;
	}
	
	
	include $this->template('shop_add');
} elseif($task=="save"){
	
	$data=Array(
		"name"=>$_GPC['name'],
		
		"status"=>$_GPC['status'],
		"logo"=>$_GPC['logo'],
		"tel"=>$_GPC['tel'],
		"address"=>$_GPC['address'],
	);
	if($_GPC['id']){
		$where=Array(
			"id"=>$_GPC['id'],
			"weid"=>$_W['weid']
		);
		$res=pdo_update("super_shops",$data,$where);
	}else{
		if($config['shopnum']>0){
			$sql="select count(*) from ".tablename("super_shops")." where weid={$_W['weid']}";
			$count=pdo_fetchcolumn($sql);
			if($count>=$config['shopnum']){
				message("您最多只能添加{$config['shopnum']}个商户。", referer());
				die;
			}
		}
		$data["createtime"]=time();
		$data['weid']=$_W['weid'];
		$res=pdo_insert("super_shops",$data);
		
	}
	if($res===FALSE){
		message("保存商户失败",$this->createWebUrl("index"),"success");
	}else{
		message("保存商户成功",$this->createWebUrl("index"),"success");
	}
	
	
} elseif ($task=="del") {
	$id=$_GPC['id'];
	$sql="select * from ".tablename("super_shops")." where id={$_GPC['id']} and weid={$_W['weid']}";
	$res= pdo_fetch($sql);
	if(!$res){
		message("店铺不存在", referer(),"error");
		die;
	}
	$where=Array(
		"id"=>$id,
		"weid"=>$_W['weid']
	);
	pdo_delete("super_shops", $where);
	message("删除成功", referer(),"success");
}else{
	
}

