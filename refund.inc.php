<?php
/*改代码仅供学习，不可用于商业用途
 *
 * */
global $_GPC,$_W;
        $uniacid=$_W['uniacid'];
		$orderid=$_GPC['id'];
		$refund_code=$_GET['refund_code'];            //退款用单号
		$pay_fee=$_GET['pay_fee'];					  //总金额
		require_once 'refundfunction.php';
		$business_data=pdo_get('shop_business',array('uniacid'=>$uniacid),array());
		$appid=$business_data['appid'];
		$mch_id=$business_data['business_num'];
		$key=$business_data['pay_key'];
		$total_fee=floatval($_GET['pay_fee']*100);    //付款金额
		$refund_fee=floatval($_GET['pay_fee']*100);	  //退款金额
		$noce_str=time().'ringwerwe';				  //单号
		$noce_str = md5($noce_str);					  //加密
		$out_refund_no=time().rand(0,100)*66;		 
		$out_trade_no= $refund_code;//支付订单号
		$res=Home_index($appid,$mch_id,$noce_str,$out_refund_no,$out_trade_no,$refund_fee,$total_fee,$key);
			if(!empty($res)){
				pdo_update("shop_order",array('zf_starts'=>4),array('id'=>$orderid));
				echo '退款成功';

			}else{
                echo '退款失败';
			}


 


