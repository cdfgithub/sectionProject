<?php
/*改代码仅供学习，不可用于商业用途
 *
 * */
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$attr_data=pdo_fetchall("select s.attr_value,p.attr_name from ".tablename('shop_attribute')." as p inner join ".tablename('shop_attr')."as s  on p.attr_id=s.attr_id and s.goods_id='{$_GPC['id']}'and s.uniacid='{$uniacid                             }'" );

    if($attr_data){

        return $this->result(0,'',$attr_data);
    }else{
        return $this->result(1,'',false);
    }