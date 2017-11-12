<?php

global $_W,$_GPC;
$nav="shop";
$task=$_GPC['task']?$_GPC['task']:"index";
//查询商家配置



if($task=="edit"){
	$sql="select * from ".tablename("super_shops")." where id={$_GPC['id']}";
	$res=pdo_fetch($sql);
	$config=json_decode($res['config'],true);
	include $this->template("web/pay/add");
}elseif($task=="savepay"){
	$sql="select * from ".tablename("super_shops")." where id={$_GPC['id']}";
	$res=pdo_fetch($sql);
	$config=json_decode($res['config'],true);
	$config['pay']['status']=$_GPC['status'];
	$config['pay']['appid']=$_GPC['appid'];
	$config['pay']['appkey']=$_GPC['appkey'];
	
	$config= json_encode($config);
	$data=Array(
		"config"=>$config
	);
	$where=Array(
		"id"=>$_GPC['id']
	);
	pdo_update("super_shops",$data,$where);
	
	message("保存成功", referer(),"success");
	
}
