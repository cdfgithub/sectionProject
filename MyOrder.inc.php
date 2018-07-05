<?php
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$op=array('o_all','o_unpaid','o_unsend','o_ungather','o_unassess','o_assess','d_order','order_comment');
$op=in_array($_GPC['option'],$op) ? $_GPC['option'] :'';
    $page=$_GPC['page'];
    $pagelist = 10;
    if($page==1){
        $index=$page-1;
    }else{
        $index=($page-1)*$pagelist;
    }
switch($op){
    case'o_all':
        $order_data=pdo_fetchall("select o.*,g.s_name,g.img from ".tablename('shop_order')."as o inner join ".tablename('shop_goods')."as g on o.g_id=g.id and o.u_id ='{$_GPC['openid']}' and o.uniacid='{$uniacid}' limit {$index},{$pagelist}");
           foreach ($order_data as $key=>$val){
               $order_data[$key]['img']=tomedia($val['img']);
           }

            if($order_data){
                return $this->result(0,'全部订单数据请求成功',$order_data);

            }else{

                return $this->result(1,'全部订单数据请求成功',$order_data);

            }

        break;
    case 'o_unpaid':
        $order_data=pdo_fetchall("select o.*,g.s_name,g.img from ".tablename('shop_order')."as o inner join ".tablename('shop_goods')."as g on o.g_id=g.id and o.zf_starts =1 and o.u_id ='{$_GPC['openid']}' and o.uniacid='{$uniacid}' limit {$index},{$pagelist}");
        foreach ($order_data as $key=>$val){
            $order_data[$key]['img']=tomedia($val['img']);

        }

        if($order_data){
            return $this->result(0,'全部订单数据请求成功',$order_data);

        }else{

            return $this->result(1,'全部订单数据请求成功',$order_data);

        }

        break;
    case 'o_unsend':
        $order_data=pdo_fetchall("select o.*,g.s_name,g.img from ".tablename('shop_order')."as o inner join ".tablename('shop_goods')."as g on o.g_id=g.id and o.fh_starts =1 and  o.zf_starts=2 and  o.u_id ='{$_GPC['openid']}' and o.uniacid='{$uniacid}' limit {$index},{$pagelist}");
        foreach ($order_data as $key=>$val){
            $order_data[$key]['img']=tomedia($val['img']);

        }

        if($order_data){
            return $this->result(0,'全部订单数据请求成功',$order_data);

        }else{

            return $this->result(1,'全部订单数据请求成功',$order_data);

        }

        break;
    case 'o_ungather':
        $order_data=pdo_fetchall("select o.*,g.s_name,g.img from ".tablename('shop_order')."as o inner join ".tablename('shop_goods')."as g on o.g_id=g.id and o.fh_starts =2 and o.zf_starts=2 and o.u_id ='{$_GPC['openid']}'and o.uniacid='{$uniacid}' limit {$index},{$pagelist}");
        foreach ($order_data as $key=>$val){
            $order_data[$key]['img']=tomedia($val['img']);

        }

        if($order_data){
            return $this->result(0,'全部订单数据请求成功',$order_data);

        }else{

            return $this->result(1,'全部订单数据请求成功',$order_data);
        }

        break;
    case 'o_unassess':
        $order_data=pdo_fetchall("select o.*,g.s_name,g.img from ".tablename('shop_order')."as o inner join ".tablename('shop_goods')."as g on o.g_id=g.id and o.fh_starts =3 and o.u_id ='{$_GPC['openid']}' and o.uniacid='{$uniacid}'limit {$index},{$pagelist}");
        foreach ($order_data as $key=>$val){
            $order_data[$key]['img']=tomedia($val['img']);

        }

        if($order_data){
            return $this->result(0,'全部订单数据请求成功',$order_data);

        }else{

            return $this->result(1,'全部订单数据请求成功',$order_data);

        }
        break;


    case 'o_assess':
        $order_data=pdo_fetchall("select o.*,g.s_name,g.img from ".tablename('shop_order')."as o inner join ".tablename('shop_goods')."as g on o.g_id=g.id and o.fh_starts =4 and o.u_id ='{$_GPC['openid']}' and o.uniacid='{$uniacid}' limit {$index},{$pagelist}");
        foreach ($order_data as $key=>$val){
            $order_data[$key]['img']=tomedia($val['img']);

        }

        if($order_data){
            return $this->result(0,'全部订单数据请求成功',$order_data);

        }else{

            return $this->result(1,'全部订单数据请求成功',$order_data);

        }
        break;


    case 'd_order':
        $res=pdo_delete('shop_order',array('id'=>$_GPC['id']));
        if($res){
            return $this->result(0,'订单取消成功',true);
        }else{
            return $this->result(1,'订单取消失败',false);
        }

        break;

    case 'order_comment':
        $comment_data=pdo_get('shop_comments',array('o_id'=>$_GPC['o_id']),array());

        if($comment_data){
            return $this->result(0,'订单评论数据请求成功',$comment_data);

        }else{
            return $this->result(0,'订单评论数据请求失败',false);
        }

        break;
}



