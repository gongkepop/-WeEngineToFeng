<?php
/**
 * ![CDATA[微社区-商业版]]
 *
 * @author 疯狼工作组
 * 
 */
defined('IN_IA') or exit('Access Denied');

require IA_ROOT.'/addons/fl_update/require.php';
require IA_ROOT.'/addons/fl_update/model.php';



class fl_staffModuleSite extends WeModuleSite {
	var $config;	//系统配置
    var $urls;
	var $config_level;
	var $config_text;
    var $debug=0;
	var $staff;
	public function __construct() {
		global $_W,$_GPC;
		
		$sql="select s.*,sh.name as shop_name from ".tablename("super_staff")." s
			left join ".tablename("super_shops")." sh on sh.id=s.sid
			where s.openid='{$_W['openid']}' and s.weid={$_W['weid']} ";
		$this->staff=pdo_fetch($sql);
		
		
		$sql="select * from ".tablename("modules_bindings")." where module='fl_staff' and entry='cover'";
		$this->cover=  pdo_fetchall($sql);
		
	}
	
	
	
}


function getpass($pass){
	return md5(md5($pass));
}