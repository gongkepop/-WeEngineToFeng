<?php

global $_W,$_GPC;

$task=$_GPC['task']?$_GPC['task']:"display";
if($task=="socket"){
	
	require_once IA_ROOT.'/addons/fl_update/socket/config.php';
	$config=Array(
		"webpath"=>$socketconfig['webpath'],
		"port"=>$socketconfig['port']
	);

	echo json_encode($config);
	
	
}elseif($task=="login"){
	$account=$_GPC['username'];
	$password= getpass($_GPC['password']);
	$sql="select * from ".tablename("super_shops")." where weid={$_W['weid']} and account='{$account}' and password='{$password}'";
	$res=pdo_fetch($sql);
	if(!$res){
		$return['status']=-1;
		$return['message']="账户有误";
	}else{
		$return['status']=1;
		$return['message']="登录成功";
		$return['sid']=$res['id'];
		$_SESSION['sid']=$res['id'];
	}
	echo json_encode($return);
	
}

