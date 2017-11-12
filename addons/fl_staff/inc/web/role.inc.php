<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $_W,$_GPC;
$nav="role";
$task=$_GPC['task']?$_GPC['task']:"index";



if($task=="index"){
	
	$sql="select * from ". tablename("super_role")." where weid={$_W['weid']}";
	$list= pdo_fetchall($sql);
	foreach($list as $key=>$value){
		$config=json_decode($value['config'],true);
		$list[$key]['config']=$config;
	}
	
	include $this->template('web/role/lists');
	
	
} elseif ($task=="add") {
	if(!$data['config']['offline']){
		$data['config']['offline']=array();
	}
	if(!$data['config']['cashier']){
		$data['config']['cashier']=array();
	}
	
	
	include $this->template('web/role/add');
	
} elseif ($task=="edit") {
	
	//查询角色
	$sql="select * from ".tablename("super_role")." where id={$_GPC['id']}";
	$data=pdo_fetch($sql);
	$data['config']=json_decode($data['config'],true);
	if(!$data['config']['offline']){
		$data['config']['offline']=array();
	}
	if(!$data['config']['cashier']){
		$data['config']['cashier']=array();
	}
	
	include $this->template('web/role/add');
} elseif($task=="save"){
	
	
	$data=Array(
		"name"=>$_GPC['name'],
		"config"=> json_encode($_GPC['role'])
	);
	if($_GPC['id']){
		$where=Array(
			"id"=>$_GPC['id']
		);
		$res=pdo_update("super_role",$data,$where);
	}else{
		$data['weid']=$_W['weid'];
		$res=pdo_insert("super_role",$data);
	}
	
	if($res===FALSE){
		
	}else{
		message("保存成功", $this->createWeburl("role"),"success");
	}
	
	
	
} elseif ($task=="del") {
	$id=$_GPC['id'];
	
	pdo_delete("super_role", $where);
	message("删除成功", referer(),"success");
}else{
	
}
