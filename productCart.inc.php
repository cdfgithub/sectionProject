<?php
/*该代码请勿商用*/
defined('IN_IA') or exit ('Access Denied');
global  $_GPC,$_W;
$uniacid=$_W['uniacid'];
$op=array('cartlist','c_delete_all','c_delete_one','add_num','reduce_num');

$op=in_array($_GPC['option'],$op) ? $_GPC['option'] :'';
    $page=$_GPC['page'];
    $pagelist = 10;
    if($page==1){
    $index=$page-1;
    }else{
    $index=($page-1)*$pagelist;
    }
switch($op){
    case 'cartlist':

        $cart_data=pdo_fetchall("select c.id as cid,c.s_id, c.number,c.price, c.openid ,g.* from ".tablename('shop_shoppingcart')."as c inner join ".tablename('shop_goods')."as g on  c.s_id=g.id and c.uniacid='{$uniacid}' limit {$index},{$pagelist}");
        foreach($cart_data as $key=>$val){
            $cart_data[$key]['checked']=false;
            $cart_data[$key]['price']=$val['goods_price'];
            $cart_data[$key]['img']=tomedia($val['img']);
        }
        if($cart_data){
            return $this->result(0,'购物车数据请求成功',$cart_data);

        }else{
            return $this->result(1,'购物车数据请求成功',$cart_data);
        }
        break;

    case 'c_delete_all':
        $res=pdo_delete('shop_shoppingcart',array('openid'=>$_GPC['openid'],'uniacid'=>$uniacid));
        if($res){
            return $this->result(0,'删除购物车数据成功',$res);
        }else{
            return $this->result(1,'删除购物车数据失败',$res);
        }

        break;

    case 'c_delete_one':
        $res=pdo_delete('shop_shoppingcart',array('id'=>$_GPC['cid']));
        if($res){
            return $this->result(0,'删除购物车数据成功',$res);
        }else{
            return $this->result(1,'删除购物车数据失败',$res);

        }
        break;
    case 'add_num':
        $res=pdo_update('shop_shoppingcart',array('number'=>'`number`+1'),array('id'=>$_GPC['cid']));
        if($res){
            return $this->result(0,'购物车数量添加成功',true);

        }else{
            return $this->result(1,'购物车数量添加失败',false);
        }
        break;
    case 'reduce_num':
        $res=pdo_update('shop_shoppingcart',array('number'=>'`number`-1'),array('id'=>$_GPC['cid']));
        if($res){
            return $this->result(0,'购物车数量减少成功',true);
        }else{
            return $this->result(1,'购物车减少失败',false);

        }
        break;
}

