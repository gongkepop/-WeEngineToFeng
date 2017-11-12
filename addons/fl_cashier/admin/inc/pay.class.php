<?php

class PayController extends BaseController{
	public function __construct() {
		parent::__construct();
		$this->tologin();
	}
	
	public function cash(){
		global $_W,$_GPC;
		$staff=$this->staff;
		
		//查询会员卡是否存在
		if($_GPC['cardnum']){
			
			//查询会员卡
//			$wecardModel=D("wecard");
//			$c=$wecardModel->getcardbycode($_GPC['cardnum']);

			
			
			$sql="select * from ".tablename("super_card")." where card='{$_GPC['cardnum']}' and weid={$_W['weid']}";
			$card=pdo_fetch($sql);
			if($card){
				$cardnum=$_GPC['cardnum'];
			}else{
				$return['status']=0;
				$return['msg']="会员卡不存在";
				echo json_encode($return);
				return ;
			}
			
			if($this->config['sale_credit']&&in_array('cash',$this->cashier['sale_credit_type']?$this->cashier['sale_credit_type']:array())){
                                $backs=3333;
				//活动
				$activeModel=D("active");
				$activeModel->startActive($card['id'],$_GPC['price'],1,Array(
					"staff"=>$staff,
					"place"=>5
				));
			}
			
		}
		
		
		//记录收款信息
		$data=Array(
			"price"=>$_GPC['price'],
			"createtime"=>time(),
			"status"=>1,
			"card_num"=>$cardnum?$cardnum:0,
			"shop_id"=>$staff['sid'],
			"staff_id"=>$staff['id'],
			"pay_status"=>1,
			"weid"=>$_W['weid'],
			"ordersn"=>"C".time().$this->staff['id']
		);
		
		pdo_insert("super_cashier_log",$data);
		$id= pdo_insertid();
		
		$res=Array(
			"status"=>1,
			"id"=>$id,
                      	"back"=>$this->cashier['sale_credit_type']
		);
		
		if($card['openid']){
			$acc = WeAccount::create();
			//支付成功发送模板消息
			//发送给用户
			$post_data=array(
                        'first' => array(
                            'value' => "您好，您的会员卡{$card['card']}发生交易，本次交易明细如下",
                            "color" => "#4a5077"
                        ),
                        'keyword1' => array(
                            'value' => "收银台付款",
                            "color" => "#4a5077"
                        ),
                        'keyword2' => array(
                            'value' => "现金",
                            "color" => "#4a5077"
                        ),
						'keyword3' => array(
								'value' =>$_GPC['price']."元",
								"color" => "#4a5077"
						),
						'keyword4' => array(
								'value' => date("Y年m月d日 H:i:s"),
								"color" => "#4a5077"
						),
                        'remark' => array(
                            'value' => "操作店铺：{$this->staff['shop_name']}。{$this->remark}",
                            "color" => "#09BB07"
                        )
			);
		  $tempcode=$this->card_config['admin_senduser_temp'];
		  $url="";
		  if($this->card_config['temp_url']){
				$url=$this->card_config['temp_url'];
			}
		  $sendResult=$acc->sendTplNotice($card['openid'],$tempcode,$post_data,$url);
		}
		
		echo json_encode($res);
	}
	
	//会员卡支付
	public function card(){
		global $_W,$_GPC;
		$staff=$this->staff;
		
		//查询会员卡是否存在
		if($_GPC['cardnum']){
			$sql="select * from ".tablename("super_card")." where card='{$_GPC['cardnum']}' and weid={$_W['weid']}";
			$card=pdo_fetch($sql);
			if($card){
				$cardnum=$_GPC['cardnum'];
				//查询会员卡余额
				if($card['openid']){
					//查询微信会员
					$sql="select * from ".tablename("mc_mapping_fans")." f 
						left join ".tablename("mc_members")." m on m.uid=f.uid
						where f.openid='{$card['openid']}'	
						";
					$member= pdo_fetch($sql);
					$credit2=$member['credit2'];
				}else{
					$credit2=$card['credit2'];
				}
				
				if($credit2<$_GPC['price']){
					$return['status']=0;
					$return['msg']="会员卡{$cardnum}余额不足";
					echo json_encode($return);
					return ;
				}
				
				
				
				
				
			}else{
				$return['status']=0;
				$return['msg']="会员卡不存在";
				echo json_encode($return);
				return ;
			}
		}else{
			$return['status']=0;
			$return['msg']="会员卡不存在";
			echo json_encode($return);
			return ;
		}
		
		
		//判断会员卡密码是否正确
		if($this->card_config['paypass']==1){
			
			if($member){
				$memberModel=D("member");
				$smember=$memberModel->getmember($member['openid']);
				
				if($smember['paypass']){
					if($smember['paypass']!=$memberModel->getpaypass($_GPC['paypass'])){
						$return['status']=0;
						$return['msg']="支付密码错误，扣款失败。";
						echo json_encode($return);
						return ;
					}
				}else{
					//未设置密码，密码为手机号后6位
					$pass= substr($card['tel'], -6);
					if($pass!=$_GPC['paypass']){
						$return['status']=0;
						$return['msg']="支付密码错误，扣款失败。";
						echo json_encode($return);
						return ;
					}
					
				}
			
			
			}else{
				//未注册微信端，密码为手机号后6位
				$pass= substr($card['tel'], -6);
				if($pass!=$_GPC['paypass']){
					$return['status']=0;
					$return['msg']="支付密码错误，扣款失败。";
					echo json_encode($return);
					return ;
				}
			}
		}
		
		
		//记录收款信息
		$data=Array(
			"price"=>$_GPC['price'],
			"createtime"=>time(),
			"status"=>1,
			"card_num"=>$cardnum?$cardnum:0,
			"shop_id"=>$staff['sid'],
			"staff_id"=>$staff['id'],
			"pay_status"=>4,
			"weid"=>$_W['weid']
		);
		
		pdo_insert("super_cashier_log",$data);
		$id= pdo_insertid();
		
		//扣款
		if($member){
			mc_credit_update($member['uid'], "credit2", -$_GPC['price'], array($member['uid'],'PC收银台支付'));
		}else{
			$data=Array(
				"credit2"=>$credit2-$_GPC['price']
			);
			$where=Array(
				"id"=>$card['id']
			);
			pdo_update("super_card",$data,$where);
		}
		$cardModel=D("card");
		$setlog=$cardModel->setcreditlog($card['id'],"credit2",-$_GPC['price'],array(
				"staff_id"=> $this->staff['id'],
				"shop_id"=> $this->staff['sid'],
				"weid"=>$_W['weid'],
				"place"=>5
			),"收银台收款。");
		
		
		if($this->config['sale_credit']&&in_array('card',$this->cashier['sale_credit_type']?$this->cashier['sale_credit_type']:array())){
			//活动
			$activeModel=D("active");
			$activeModel->startActive($card['id'],$_GPC['price'],1,Array(
				"staff"=>$this->staff,
				"place"=>5
			));
		}
		
		
		
		$acc = WeAccount::create();
			//支付成功发送模板消息
			//发送给用户
			$post_data=array(
                        'first' => array(
                            'value' => "您好，您的会员卡{$card['card']}发生交易，本次交易明细如下",
                            "color" => "#4a5077"
                        ),
                        'keyword1' => array(
                            'value' => "收银台付款",
                            "color" => "#4a5077"
                        ),
                        'keyword2' => array(
                            'value' => "会员卡余额",
                            "color" => "#4a5077"
                        ),
						'keyword3' => array(
								'value' =>$_GPC['price']."元",
								"color" => "#4a5077"
						),
						'keyword4' => array(
								'value' => date("Y年m月d日 H:i:s"),
								"color" => "#4a5077"
						),
                        'remark' => array(
                            'value' => "操作店铺：{$this->staff['shop_name']}。{$this->remark}",
                            "color" => "#09BB07"
                        )
          );
		$tempcode=$this->card_config['admin_senduser_temp'];
		$url="";
		 if($this->card_config['temp_url']){
				$url=$this->card_config['temp_url'];
			}
		$sendResult=$acc->sendTplNotice($card['openid'],$tempcode,$post_data,$url);
		
		
		
		
		$res=Array(
			"status"=>1,
			"id"=>$id
		);
		echo json_encode($res);
		
		
	}






	public function log(){
		global $_W;
		//查询收银记录
		
		$sql="select * from ".tablename("super_cashier_log")." where staff_id={$this->staff['id']} order by id desc limit 10";
		$paylog=pdo_fetchall($sql);
		
		include $this->template("log/pay");
		
	}
	
	//数据统计
	public function getmoney(){
		global $_W,$_GPC;
		$begin= mktime(0, 0, 0, date("m"), date("d"), date("Y"));
		$end=mktime(0, 0, 0, date("m"), date("d")+1, date("Y"));
		$sql="select pay_status,sum(price) as price from ".tablename("super_cashier_log")." where staff_id={$this->staff['id']} and status=1 and weid={$_W['weid']}
			and createtime between {$begin} and {$end} group by pay_status
			";
		$res=pdo_fetchall($sql);
		foreach($res as $value){
			switch($value['pay_status']){
				case "1":
					$reback['cash']=$value['price'];
					break;
				case "2":
					$reback['alipay']=$value['price'];
					break;
				case "3":
					$reback['wechart']=$value['price'];
					break;
				case "4":
					$reback['card']=$value['price'];
					break;
			}
		}
		$reback['online']=$reback['alipay']+$reback['wechart'];
		$reback['online']=sprintf("%.02f",$reback['online']);
		echo json_encode($reback);
		
	}
	
	//线上支付
	public function online(){
		global $_W,$_GPC;
		$payModel=D("xfpay","",array("shop"=>$this->staff['sid']));
		
		//查询会员卡是否存在
		if($_GPC['cardnum']){
			$sql="select * from ".tablename("super_card")." where card='{$_GPC['cardnum']}' and weid={$_W['weid']}";
			$card=pdo_fetch($sql);
			if($card){
				$cardnum=$_GPC['cardnum'];
			}else{
				$return['status']=0;
				$return['msg']="会员卡不存在";
				echo json_encode($return);
				return ;
			}
		}
		
		
		//查询支付方式
		$paytype=$payModel->getpaytype($_GPC['code']);
		switch ($paytype) {
			case "wx":
				$type=3;
				$paytype_text="微信";
				break;
			case "zfb":
				$type=2;
				$paytype_text="支付宝";
				break;
			default:
				break;
		}
		
		if(!$type){
			$return['status']=0;
			$return['msg']="扫码错误，请重试";
			echo json_encode($return);
			return ;
		}
		$ordersn="C".$paytype.time(). $this->staff['id'];
		//生成订单
		$data=Array(
			"price"=>$_GPC['price'],
			"createtime"=>time(),
			"status"=>0,
			"shop_id"=>$this->staff['sid'],
			"staff_id"=>$this->staff['id'],
			"pay_status"=>$type,
			"weid"=>$_W['weid'],
			"ordersn"=>$ordersn,
			"card_num"=>$cardnum
		);
		
		pdo_insert("super_cashier_log",$data);
		$oid=pdo_insertid();
		$paystatus=0;
		
		
		
		//发送扫码数据
		//判断是否为原生支付
		if($this->config['pay_palce']==0&&$type==3){
			//原生支付
			load()->classs('pay');
			$pay = Pay::create();
			$params = array(
				'tid' => $oid,
				'module' => 'fl_cashier',
				'type' => 'wechat',
				'fee' => $data['price'],
				'body' => "收银台扫码收款",
				'auth_code' => $_GPC['code'],
			);
			$pid = $pay->buildPayLog($params);
			if(is_error($pid)) {
				message($pid,  '', 'ajax');
			}
			$log = pdo_get('core_paylog', array('plid' => $pid));
//			pdo_update('paycenter_order', array('pid' => $pid, 'uniontid' => $log['uniontid']), array('id' => $id));
			$data = array(
				'out_trade_no' => $log['uniontid'],
				'body' => "收银台扫码收款",
				'total_fee' => $data['price'] * 100,
				'auth_code' => $_GPC['code'],
				'uniontid' => $log['uniontid']
			);
			$result = $pay->buildMicroOrder($data);
//			print_r($result);die;
//			if(is_error($result)) {
//				message($result,  '', 'ajax');
//			} else {
//				$status = $pay->NoticeMicroSuccessOrder($result);
//				if(is_error($status)) {
//					message($status, '', 'ajax');
//				}
//				message(error(0, '支付成功'), '', 'ajax');
//			}
			//out_trade_no
			//查询订单信息
			$updata=Array(
				"onlinesn"=>$result['uniontid']?$result['uniontid']:$result['out_trade_no']
			);

			$where=Array(
				"id"=>$oid
			);
			pdo_update("super_cashier_log", $updata, $where);
			//查询订单信息
			if($result['return_code']=="SUCCESS"){
				$updata=Array(
					"status"=>1,
					"paytime"=> time()
				);

				$where=Array(
					"id"=>$oid
				);
				pdo_update("super_cashier_log", $updata, $where);
				$paystatus=1;
				//活动
				if($card){
					if($this->config['sale_credit']&&in_array('online',$this->cashier['sale_credit_type']?$this->cashier['sale_credit_type']:array())){
						$activeModel=D("active");
						$activeModel->startActive($card['id'],$_GPC['price'],1,Array(
							"staff"=>$this->staff,
							"place"=>5
						));
					}
				
					
					
				}

			}
		}else{
			//专有支付
			$res=$payModel->payentry(Array(
				"ordersn"=>$ordersn,
				"price"=>$data['price'],
				"title"=>"收银台收款",
				"content"=>"收银台扫码收款",
				"code"=>$_GPC['code']
			));
			//查询订单信息
			$updata=Array(
				"onlinesn"=>$res['outtradeno']
			);

			$where=Array(
				"id"=>$oid
			);
			pdo_update("super_cashier_log", $updata, $where);
			//查询订单信息
			$order=$payModel->order($ordersn,$paytype);
			if($order['tradestate']=="TRADE_SUCCESS"){
				$updata=Array(
					"status"=>1,
					"paytime"=> strtotime($order['paydate'])
				);

				$where=Array(
					"id"=>$oid
				);
				pdo_update("super_cashier_log", $updata, $where);
				$paystatus=1;
				//活动
				if($card){
					if($this->config['sale_credit']&&in_array('online',$this->cashier['sale_credit_type']?$this->cashier['sale_credit_type']:array())){
						$activeModel=D("active");
						$activeModel->startActive($card['id'],$_GPC['price'],1,Array(
							"staff"=>$this->staff,
							"place"=>5
						));
					}
				}

			}
		}
		
	
		
		
		
		$return['status']=1;
		$return['id']=$oid;
		$return['paystatus']=$paystatus;
		if($card['openid']){
			$acc = WeAccount::create();
			//支付成功发送模板消息
			//发送给用户
			$post_data=array(
                        'first' => array(
                            'value' => "您好，您的会员卡{$card['card']}发生交易，本次交易明细如下",
                            "color" => "#4a5077"
                        ),
                        'keyword1' => array(
                            'value' => "收银台付款",
                            "color" => "#4a5077"
                        ),
                        'keyword2' => array(
                            'value' => $paytype_text,
                            "color" => "#4a5077"
                        ),
						'keyword3' => array(
								'value' =>$_GPC['price']."元",
								"color" => "#4a5077"
						),
						'keyword4' => array(
								'value' => date("Y年m月d日 H:i:s"),
								"color" => "#4a5077"
						),
                        'remark' => array(
                            'value' => "操作店铺：{$this->staff['shop_name']}。{$this->remark}",
                            "color" => "#09BB07"
                        )
			);
		  $tempcode=$this->card_config['admin_senduser_temp'];
		  $url="";
		   if($this->card_config['temp_url']){
				$url=$this->card_config['temp_url'];
			}
		  $sendResult=$acc->sendTplNotice($card['openid'],$tempcode,$post_data,$url);
		}
		echo json_encode($return);
	}
	
	
}
