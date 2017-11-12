<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//发送短信验证码
function sendcardsms($tel,$content,$name){
	global $_W,$_GPC;
	require 'sdk/sms/TopSdk.php';
	$c = new TopClient;
	
	//查询基本配置
	$sql="select * from ".tablename("super_card_config")." where weid={$_W['weid']}";
	$config=pdo_fetch($sql);
	$config['sms']=  json_decode($config['sms_config'],true);
	
	$c->appkey = $config['sms']['appkey'];
	$c->secretKey = $config['sms']['secretKey'];
	$c->format="json";
	$req = new AlibabaAliqinFcSmsNumSendRequest;
	$req->setExtend($content);
	$req->setSmsType("normal");
	$req->setSmsFreeSignName($config['sms']['smsname']);
	$req->setSmsParam("{\"code\":\"{$content}\",\"name\":\"{$name}\"}");
	$req->setRecNum($tel);
	$req->setSmsTemplateCode($config['sms']['smstemp']);
	$resp = $c->execute($req);
	return $resp;
}


include_once(IA_ROOT . '/framework/library/phpexcel/PHPExcel.php');
//读取excel信息
class PHPExcelReadFilter implements PHPExcel_Reader_IReadFilter {
 
    public $startRow = 1;
    public $endRow;
 
    public function readCell($column, $row, $worksheetName = '') {
        //如果endRow没有设置表示读取全部
        if (!$this->endRow) {
            return true;
        }
        //只读取指定的行
        if ($row >= $this->startRow && $row <= $this->endRow) {
            return true;
        }
 
        return false;
    }
 
}