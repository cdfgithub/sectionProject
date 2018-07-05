<?php
/*该代码请勿商用*/
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$phone_data=pdo_get('shop_business',array('uniacid'=>$uniacid),array('merchantphone'));
if($phone_data){
    return $this->result(0,'商家电话数据接口请求成功',$phone_data);
}else{
    return $this->result(1,'商家电话数据接口请求失败',false);
}
