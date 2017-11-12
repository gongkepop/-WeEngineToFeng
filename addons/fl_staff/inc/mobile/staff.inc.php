<?php

global $_W,$_GPC;
$task=$_GPC['task']?$_GPC['task']:"display";

//判断是否绑定过
if(!$_W['openid']){
	message("请在微信端登录");
	die;
}
if($task=="display"){
	$sql="select * from ".tablename("super_staff")." where openid='{$_W['openid']}' and weid={$_W['weid']} ";
	$res=pdo_fetch($sql);
	if($res){
		message("",$this->createMobileUrl('admin'));
	}
	include $this->template('staff');
}elseif($task=="onwork"){
	
	$where=Array(
		"id"=>$this->staff['id']
	);
	$data=Array(
		"onwork"=>1
	);
	pdo_update("super_staff",$data,$where);
	message("已切换到在班状态。",referer());
	
}elseif($task=="unwork"){
	
	$where=Array(
		"id"=>$this->staff['id']
	);
	$data=Array(
		"onwork"=>0
	);
	pdo_update("super_staff",$data,$where);
	message("已切换到下班状态。",referer());
	
}
