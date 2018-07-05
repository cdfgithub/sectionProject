<?php
/*该代码请勿商用*/
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$result=pdo_getall("shop_announcement",array('uniacid'=>$uniacid),array('announcement'),'','id asc',array(0,3));
$arr=array();
	foreach($result as $key=>$val){
		$arr[]=$val['announcement'];
	}
$suceess="成功";
$error="失败";
	if($result){
		return $this->result(0,$suceess,$arr);
	}else{
		return $this->result(1,$error,false);
	}
