<?php
/*改代码仅供学习，不可用于商业用途
 *
 * */
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;

$res=pdo_update('shop_order',array('id'=>$_GPC['id'],'fh_starts'=>4));
if($res){
    return $this->result(0,'确认收货成功',true);
}else{
    return $this->result(1,'确认收货失败',false);

}
