<?php

global $_W,$_GPC;
$nav="shop";
$task=$_GPC['task']?$_GPC['task']:"index";
//查询商家配置



if($task=="edit"){
	$sql="select * from ".tablename("super_shops")." where id={$_GPC['id']}";
	$data=pdo_fetch($sql);
	$config=json_decode($data['config'],true);
	include $this->template("web/account/add");
}elseif($task=="saveaccount"){

	
	//查询账号是否存在
	$sql="select * from ".tablename("super_shops")." where id!={$_GPC['id']} and weid={$_W['weid']} and account='{$_GPC['account']}'";
	$account=pdo_fetch($sql);
	
	if($account){
		message("账号已存在", referer());
		die;
	}
	
	
	$sql="select * from ".tablename("super_shops")." where id={$_GPC['id']}";
	$res=pdo_fetch($sql);
	$config=json_decode($res['config'],true);
	$config['staffnum']=$_GPC['staffnum'];
	
	$data=Array(
		"account"=>$_GPC['account'],
		"config"=> json_encode($config)
	);
	
	if($_GPC['password']!=""){
		$data['password']= getpass($_GPC['password']);
	}
	$where=Array(
		"id"=>$_GPC['id']
	);
	pdo_update("super_shops",$data,$where);
	
	message("保存成功", referer(),"success");
	
}
