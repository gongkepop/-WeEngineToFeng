<?php

global $_W,$_GPC;
$nav="adminconfig";
$task=$_GPC['task']?$_GPC['task']:"index";
//查询商家配置
$sql="select * from ".tablename("super_staff_config")." where weid={$_W['weid']}";
$res=pdo_fetch($sql);
if($res){
	$config=json_decode($res['config'],true);
}


if($task=="index"){
	
	
	
	include $this->template("web/adminconfig/index");
}elseif($task=="save"){
	
	$config['shopnum']=$_GPC['shopnum'];
	
	$data=Array(
		"config"=> json_encode($config)
	);
	
	if($res){
		$where=Array(
			"weid"=>$_W['weid']
		);
		pdo_update("super_staff_config",$data,$where);
		
	}else{
		$data['weid']=$_W['weid'];
		pdo_insert("super_staff_config",$data);
	}
	
	
	message("保存成功", referer(),"success");
	
}
