<?php
/*改代码仅供学习，不可用于商业用途
 *
 * */
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$sid=$_GPC['id'];
$openid=$_GPC['openid'];
$op=array('ginsert','gdelete','zf');
$op=in_array($_GPC['op'],$op)?$_GPC['op']:'ginsert';
	switch($op){
		case 'ginsert':
		    $is_add_cart=pdo_get('shop_shoppingcart',array('s_id'=>$sid,'openid'=>$openid,'uniacid'=>$uniacid),array('number'));
		    if(!empty($is_add_cart)){
                $num=$is_add_cart['number']+1;
                $result=pdo_update("shop_shoppingcart",array( 'number'=>$num),array('s_id'=>$sid,'openid'=>$openid,'uniacid'=>$uniacid));
                if($result){
                    return $this->result(0,'商品增加成功',true);
                }else{
                    return $this->result(1,'商品增加失败',false);
                }
            }else{
                $arr=array(
                    's_id'=>$sid,
                    'number'=>1,
                    'openid'=>"$openid",
                    'uniacid'=>$uniacid

                );
                $result=pdo_insert("shop_shoppingcart",$arr);
                if($result){
                    return $this->result(0,'商品增加成功',true);
                }else{
                    return $this->result(1,'商品增加失败',false);
                }

            }
		break;
		
		case 'gdelete':
			//查出用户所有订单
			$u_order=pdo_getall('shop_shoppingcart',array('openid'=>$openid,'uniacid'=>$uniacid),array('id','s_id','openid'));
				foreach($u_order as $key=>$val){
					$gid=intval($val['id']);
					$gsid=intval($val['s_id']);
					$guid=intval($val['openid']);
						if($gsid==$sid && $guid==$uid){
							$rel=pdo_delete('shop_shoppingcart',array('id'=>$gid,'uniacid'=>$uniacid));
								if($rel){
									return $this->result(0,'商品删除成功',true);
								}else{
									return $this->result(1,'商品删除失败',false);
								}
						}
				}
		break;
	}