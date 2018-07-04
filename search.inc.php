<?php
/*改代码仅供学习，不可用于商业用途
 *
 * */
defined('IN_IA') or exit ('Access Denied');
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$op=array('general','sale','price_high','price_low');

$op=in_array($_GPC['op'],$op) ? $_GPC['op'] : '';
    $page=$_GPC['page'];
    $pagelist = 8;
    if($page==1){
        $index=$page-1;
    }else{
        $index=($page-1)*$pagelist;

    }

    $keyword=$_GPC['keyword'];
switch($op){

    case 'general':

        $filter_data=pdo_fetchall("select * from ".tablename('shop_goods'). " as g inner join  ".tablename('shop_classification')."as c  on g.f_id= c.f_id and g.uniacid='{$uniacid}' and g.s_name like '%{$keyword}%' or c.f_name like '%{$keyword}%' and g.is_sale=2 order by id desc limit {$index},{$pagelist}" );

        foreach($filter_data as $key=>$val){

            $filter_data[$key]['img']=tomedia($val['img']);

        }
        if($filter_data){
            return $this->result(0,'综合数据筛选请求成功',$filter_data);
        }else{

            return $this->result(1,'综合数据接口请求失败',$filter_data);
        }
        break;

    case 'sale':

        $filter_data=pdo_fetchall("select * from ".tablename('shop_goods'). " as g inner join  ".tablename('shop_classification')."as c  on g.f_id= c.f_id and g.uniacid='{$uniacid}' and g.s_name like '%{$keyword}%' or c.f_name like '%{$keyword}%' and g.is_sale=2  order by sales desc limit {$index},{$pagelist}");
        foreach($filter_data as $key=>$val){
            $filter_data[$key]['img']=tomedia($val['img']);
        }
        if($filter_data){
            return $this->result(0,'销量数据筛选请求成功',$filter_data);
        }else{

            return $this->result(1,'销量数据接口请求失败',$filter_data);
        }

        break;

    case 'price_high':
        $filter_data=pdo_fetchall("select * from ".tablename('shop_goods'). " as g inner join  ".tablename('shop_classification')."as c  on g.f_id= c.f_id and g.uniacid='{$uniacid}' and g.s_name like '%{$keyword}%' or c.f_name like '%{$keyword}%' and g.is_sale=2  order by goods_price desc limit {$index},{$pagelist}");

        foreach($filter_data as $key=>$val){
            $filter_data[$key]['img']=tomedia($val['img']);
        }
        if($filter_data){
            return $this->result(0,'价格筛选数据请求成功',$filter_data);
        }else{

            return $this->result(1,'价格筛选数据请求失败',$filter_data);
        }

        break;

    case'price_low':

        $filter_data=pdo_fetchall("select * from ".tablename('shop_goods'). " as g inner join  ".tablename('shop_classification')."as c  on g.f_id= c.f_id and g.uniacid='{$uniacid}' and g.s_name like '%{$keyword}%' or c.f_name like '%{$keyword}%' and g.is_sale=2  order by goods_price asc  limit {$index},{$pagelist}");

        foreach($filter_data as $key=>$val){
            $filter_data[$key]['img']=tomedia($val['img']);
        }
        if($filter_data){
            return $this->result(0,'价格筛选数据请求成功',$filter_data);
        }else{

            return $this->result(1,'价格筛选数据请求失败',$filter_data);
        }

        break;




}



