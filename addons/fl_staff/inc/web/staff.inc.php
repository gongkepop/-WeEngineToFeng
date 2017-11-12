<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $_W,$_GPC;
$nav="staff";
$task=$_GPC['task']?$_GPC['task']:"index";

//判断用户是否配置角色
$sql="select * from ".tablename("super_role")." where weid={$_W['weid']}";
$role=pdo_fetchall($sql);
if(!$role){
	message("请先配置角色。",$this->createWebUrl("role"));
	die;
}

//查询店铺
$sql="select * from ".tablename("super_shops")." where weid={$_W['weid']}";
$shop=pdo_fetchall($sql);
if(!$shop){
	message("请先配置店铺。",$this->createWebUrl('index'));
	die;
}

if($task=="index"){
	
	$sql="select s.*,sh.name as sname,mf.nickname,r.name as rname from ".tablename("super_staff")." s
		left join ". tablename("super_shops")." sh on sh.id=s.sid
		left join ". tablename("mc_mapping_fans")." mf on mf.openid=s.openid and uniacid={$_W['weid']}	
		left join ".tablename('super_role')." r on r.id=s.rid	
		where s.weid={$_W['weid']}";
	$list= pdo_fetchall($sql);
	
	
	include $this->template('web/staff/lists');
	
	
} elseif ($task=="add") {
	
	
	
	
	include $this->template('web/staff/add');
	
} elseif ($task=="edit") {
	
	//查询店铺
	$sql="select * from ".tablename("super_shops")." where weid={$_W['weid']}";
	$shop=pdo_fetchall($sql);
	
	$sql="select * from ".tablename("super_staff")." where id={$_GPC['id']} and weid={$_W['weid']}";
	$res= pdo_fetch($sql);
	if(!$res){
		message("用户不存在",$this->createWebUrl("staff"),"error");
		die;
	}
	
	
	include $this->template('web/staff/add');
} elseif($task=="save"){
	
	$data=Array(
		"name"=>$_GPC['name'],
		"sid"=>$_GPC['sid'],
		"status"=>$_GPC['status'],
		"tel"=>$_GPC['tel'],
		"staff_num"=>$_GPC['staff_num'],
		"openid"=>$_GPC['openid'],
		"rid"=>$_GPC['rid']
	);
	if($_GPC['id']){
		$where=Array(
			"id"=>$_GPC['id'],
			"weid"=>$_W['weid']
		);
		$res=pdo_update("super_staff",$data,$where);
	}else{
		$data["code"]= rand(100000, 999999);
		$data['weid']=$_W['weid'];
		$res=pdo_insert("super_staff",$data);
		
	}
	if($res===FALSE){
		message("保存员工失败",$this->createWebUrl("staff"),"success");
	}else{
		message("保存员工成功",$this->createWebUrl("staff"),"success");
	}
	
	
} elseif ($task=="del") {
	$id=$_GPC['id'];
	$sql="select * from ".tablename("super_staff")." where id={$_GPC['id']} and weid={$_W['weid']}";
	$res= pdo_fetch($sql);
	if(!$res){
		message("店铺不存在", referer(),"error");
		die;
	}
	$where=Array(
		"id"=>$id,
		"weid"=>$_W['weid']
	);
	pdo_delete("super_staff", $where);
	message("删除成功", referer(),"success");
}else{
	
}

