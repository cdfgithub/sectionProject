<?php
/*改代码仅供学习，不可用于商业用途
 *
 * */
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$nickname=$_GPC['face'];
$openid=$_GPC['openid'];
$username=$_GPC['username'];
$is_login=pdo_get('shop_user',array('openid'=>$openid),array());
if(empty($is_login)&&!empty($nickname)&&!empty($openid)&&!empty($username)){
        $res=pdo_insert('shop_user',array('openid'=>$openid,'u_name'=>$username,'img'=>$nickname,'uniacid'=>$uniacid));
        if($res){
            return $this->result(0,'用户数据添加成功',true);
        }else{
            return $this->result(1,'用户数据添加失败',false);
        }
}
return $this->result(1,'用户数据已添加',false);