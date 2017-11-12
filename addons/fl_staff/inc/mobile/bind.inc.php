<?php

global $_W,$_GPC;


$tel=$_GPC['tel'];
$code=$_GPC['code'];


$sql="select * from ".tablename("super_staff")." where weid={$_W['weid']} and tel='{$tel}' and code={$code}";
$res= pdo_fetch($sql);

if(!$res){

	$return['msg']="对不起，绑定信息错误";
	$return['status']=-1;
	echo json_encode($return);die;
}

//判断用户是否已经绑定过
if($res['openid']!=""){

	$return['msg']="对不起，该员工已被绑定，请联系管理员解绑后重新绑定。";
	$return['status']=-1;
	echo json_encode($return);die;
}

$data=Array(
	"openid"=>$_W['openid']
);
$where=Array(
	"id"=>$res['id']
);

$up=pdo_update("super_staff",$data,$where);

$return['status']=1;
$return['msg']="绑定成功";
echo json_encode($return);die;