<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BaseController{
	public $login;
	public $base;
	public $staff;
	public $card_config;
	public $remark;
	public $cashier;
	public function __construct() {
		global $_W;
		//判断是否登录
		$this->base=$parame;
		$this->login=$this->checklogin();
		//如果登录，查询用户信息
		if($this->login){
			$sql="select s.*,sh.name as shop_name,r.config as role from ".tablename("super_staff")." s
				left join ". tablename("super_shops")." sh on sh.id=s.sid
				left join ".tablename("super_role")." r on r.id=s.rid		
				where s.id={$this->login}";
			$this->staff=pdo_fetch($sql);
			$this->role=json_decode($this->staff['role'],true);
			$this->role['offline']=$this->role['offline']?$this->role['offline']:array();
			$this->role['cashier']=$this->role['cashier']?$this->role['cashier']:array();
		}
		
		//获得配置信息
		$sql="select * from ".tablename("super_cashier_config")." where weid={$_W['weid']}";
        $config=pdo_fetch($sql);
		
		$this->config=json_decode($config['config'],true);
		
		//获取会员卡配置
		if(basefun()->getplugin("fl_card","mobile")){
			$sql="select * from ".tablename("super_card_config")." where weid={$_W['weid']}";
			$card_config=pdo_fetch($sql);
			//获得基础配置信息
			$this->card_config=json_decode($card_config['level_config'],true);
			
			
			//模板消息追加文字
			if($this->card_config['temp_text']){
				$this->remark=$this->card_config['temp_text'];
			}else{
				$this->remark="";
			}
			
		}else{
			$this->card_config=array();
		}
		
		$sql="select * from ".tablename("super_cashier_config")." where weid={$_W['weid']}";
		$config=pdo_fetch($sql);
		$this->cashier=json_decode($config['config'],true);
		//获得配置信息
//		$sql="select * from ".tablename("super_card_config")." where weid={$_W['weid']}";
//        $card_config=pdo_fetch($sql);
//		//获得基础配置信息
//		$this->config_level=json_decode($card_config['level_config'],true);
		
	}
	
	
	
	
	private function checklogin(){
		if($_SESSION['card_sid']>0){
			return $_SESSION['card_sid'];
		}else{
			return false;
		}
	}
	
	//判断是否登录，如果未登录，禁止访问
	protected function tologin(){
		if(!$this->login){
			exit("请登录后访问");
		}
	}




	protected function template($filename){
		global $_W;
		$name = "fl_cashier";
		$defineDir = IA_ROOT."/addons/fl_cashier/template/mobile/admin/";

		$compile = IA_ROOT . "/data/tpl/app/{$_W['template']}/{$name}/admin/{$filename}.tpl.php";

		if(!is_file($source)) {
			$source = $defineDir . "{$filename}.html";
		}
		if(!is_file($source)) {
			$source = IA_ROOT . "/app/themes/{$_W['template']}/{$filename}.html";
		}
		
		if(!is_file($source)) {
			exit("Error: template source '{$filename}' is not exist!");
		}
		$paths = pathinfo($compile);
		$compile = str_replace($paths['filename'], $_W['uniacid'] . '_' . $paths['filename'], $compile);
		if (DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile)) {
			template_compile($source, $compile, true);
		}
		return $compile;
	}
	
	
	protected function createMobileUrl($do, $query = array(), $noredirect = true) {
		global $_W;
		$query['do'] = $do;
		$query['m'] = "fl_cashier";
		return murl('entry', $query, $noredirect);
	}
	
	public function message($msg,$url='',$refresh=true){
		
		
		include $this->template("base/message");
		die;
	}
}