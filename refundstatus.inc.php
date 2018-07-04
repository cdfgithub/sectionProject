<?php
/*改代码仅供学习，不可用于商业用途
 *
 * */
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
	$refund_code=$_GPC['refund_code'];
	$ordernumber=$_GPC['ordernumber'];
		$arr=array(
			'refund_code'=>$refund_code,
			'zf_starts'=>3
		);
	$result=pdo_update("shop_order",$arr,array('ordernumber'=>$ordernumber));
	if($result){
		return $this->result(1,"申请成功",true);
	}else{
		return $this->result(0,"申请失败",false);
	}
?>