<?php

//人人商城函数

class ewei_shop2Model extends fl_cardModuleSite {
	private $levelTable="ewei_shop_member_level";
	private $memberLevelTable="ewei_shop_member";
	private $memberLevelColumn="level";
	public  $levelName="人人商城v2";


	public function __construct() {
		parent::__construct();
	}


	//获取等级列表
	public function getLevelList(){
		global $_W;
		$sql="select id,levelname as name,level,discount,ordermoney as upnumber,enabled as status from ".tablename($this->levelTable)." where uniacid={$_W['uniacid']}";
		$data=pdo_fetchall($sql);
		$title=Array(
			"等级编号","等级名称","等级","折扣","升级数值",array("title"=>"状态","value"=>array("禁用","启用"))
		);
		$return=Array(
			"list"=>$data,
			"title"=>$title
		);
		return $return;
	}

	//获取按钮地址
	public function getMenuUrl(){
		$return=Array(
			"edit"=> murl("site/entry",array("m"=>"ewei_shopv2","do"=>"web",'r'=>'member.level.edit')),
			"add"=>murl("site/entry",array("m"=>"ewei_shopv2","do"=>"web",'r'=>'member.level.add')),


		);



		return $return;


	}

	//设定等级
	public function setLevel($openid,$level_id){
		global $_W;
		//查询会员是否存在
		$sql="select * from ".tablename($this->memberLevelTable)." where openid='{$openid}'";
		$member=pdo_fetch($sql);
//		if(!$member){
//			//如果会员不存在，则创建会员
//			$sql="select f.*,m.avatar,m.gender as sex from ".tablename("mc_mapping_fans")." f
//					left join ".  tablename("mc_members")." m on m.uid=f.uid
//					where f.openid='{$openid}'";
//			$fans=  pdo_fetch($sql);
//			$data=Array(
//				"uniacid"=>$fans['uniacid'],
//				"uid"=>$fans['uid'],
//				"openid"=>$fans['openid'],
//				"avatar"=>$fans['avatar'],
//				"nickname"=>$fans['nickname'],
//				"sex"=>$fans['sex'],
//				"addtime"=>time(),
//				"level_id"=>$level_id,
//			);
//			pdo_insert($this->memberLevelTable,$data);
//
//		}else{
			$where=Array(
				"id"=>$member['id']
			);
			$data=Array(
				"{$this->memberLevelColumn}"=>$level_id
			);
			pdo_update($this->memberLevelTable, $data, $where);
//		}

		return true;


	}

	//获取用户等级
	public function getMemberLevel(){
		global $_W;
		$sql="select m.*,l.level as reallevel from ".tablename($this->memberLevelTable)." m
				left join ".  tablename($this->levelTable)." l on l.id=m.level
				where m.openid='{$_W['openid']}'";
		$member=  pdo_fetch($sql);
		//如果没有会员信息 则同步信息
		if(!$member){
			$sql="select * from ".tablename("mc_members")." where uid={$_W['member']['uid']}";
			$mc_member=pdo_fetch($sql);
			$data=Array(
				"uniacid"=>$_W['uniacid'],
				"uid"=>$_W['member']['uid'],
				"openid"=>$_W['openid'],
				"realname"=>$mc_member['realname'],
				"mobile"=>$mc_member['mobile'],
				"createtime"=>time(),
			);
			pdo_insert($this->memberLevelTable,$data);
			$member['reallevel']=0;
		}


		return $member['reallevel'];
	}

	//获取当前会员卡最高等级
	public function getCardMaxLevel($levelid){
		if($levelid){
			if(is_array($levelid)){
				$levelid=  implode(",", $levelid);
			}
			$sql="select * from ".tablename("ewei_shop_member_level")." where id in ($levelid) order by level desc";
			$level=pdo_fetch($sql);
			$max=$level['level'];
		}else{
			$max=0;
		}

		return $max;

	}

	//获取相应会员等级levelid\
	public function getLevelId($level){
		global $_W;
		$sql="select * from ".tablename($this->levelTable)." where level={$level} and uniacid={$_W['uniacid']}";
		$level=pdo_fetch($sql);
		return $level['id'];
	}



}
