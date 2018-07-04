<?php
/*改代码仅供学习，不可用于商业用途
 *
 * */
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
	$uniacid=$_W['uniacid'];
	$op=array('select','save','delete');
	$op=in_array($_GPC['op'],$op) ? $_GPC['op'] : 'select';
	switch($op){
		case 'select':
			$result=pdo_getall('shop_order',array('zf_starts'=>0,'uniacid'=>$uniacid),array('id','address'));  //未支付订单
				foreach($result as $key=>$val){
					$result[$key]['id']=$val['id'];
					$result[$key]['address']=$val['address'];
				}
			

			if($result){
				$this->result(0,$suceess,$result);
			}else{
				$this->result(1,$error,false);
			}
		break;
		
		case 'save':
			$ordernumber=time().rand(1,9);
				$arr=array(
					'zf_starts'=>1
				);
			$result=pdo_update('shop_order',$arr,array('ordernumber'=>$ordernumber));

		break;
		
		case 'delete':
			$id=$_GPC['id'];
			$result=pdo_delete("shop_order",array('id'=>$id));
				if($result){
					$this->result(0,"成功",true);
				}else{
					$this->result(1,"失败",false);
				}
		break;
	}