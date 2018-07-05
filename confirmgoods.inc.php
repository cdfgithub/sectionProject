<?php
/*该代码请勿商用*/
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$id=$_GPC['id'];
//确认收货接口
	$arr=array(
		'zf_starts'=>5,
		'fh_starts'=>3
	);
	$result=pdo_update("shop_order",$arr,array('id'=>$id));
	if($result){
		return $this->result(1,"已确认收货",true);
	}else{
		return $this->result(0,"为确认收货",false);
	}

?>
