<?php
/*该代码请勿商用*/
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$op = array('classify','general','sale','price_high','price_low','classify_son');
$op = in_array($_GPC['op'],$op)  ?  $_GPC['op'] :  '';

$page=$_GPC['page'];
$pagelist = 8;
if($page==1){
    $index=$page-1;
}else{
    $index=($page-1)*$pagelist;

}

switch($op){
    case 'classify':
        $result=pdo_fetchall("select f_id,f_name,icon from " . tablename('shop_classification')."where uniacid='{$uniacid}' and is_show=1  and pcid=0 order by orderb asc ");
        foreach($result as $key=>$val){
            $result[$key]['f_id']=$val['f_id'];
            $result[$key]['f_name']=$val['f_name'];
            $result[$key]['icon']=tomedia($val['icon']);
        }
        $success = "请求成功";
        $error = "请求失败";
        if($result){
            return $this->result(1,$success,$result);
        }else {
            return $this->result(0,$error,false);
        }

        break;


    case 'general':

            $filter_data=pdo_getall('shop_goods',array('uniacid'=>$uniacid,'f_id'=>$_GPC['id'],'is_sale'=>2),array('id','sales','s_name','goods_price','y_price','img'),'','sales desc',array($index,$pagelist));
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

        $filter_data=pdo_getall('shop_goods',array('uniacid'=>$uniacid,'f_id'=>$_GPC['id'],'is_sale'=>2),array('id','sales','s_name','goods_price','y_price','img'),'','sales desc',array($index,$pagelist));
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
        $filter_data=pdo_getall('shop_goods',array('uniacid'=>$uniacid,'f_id'=>$_GPC['id'],'is_sale'=>2),array('id','sales','s_name','goods_price','y_price','img'),'','goods_price desc',array($index,$pagelist));
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
        $filter_data=pdo_getall('shop_goods',array('uniacid'=>$uniacid,'f_id'=>$_GPC['id'],'is_sale'=>2),array('id','sales','s_name','goods_price','y_price','img'),'','goods_price asc',array($index,$pagelist));
        foreach($filter_data as $key=>$val){
            $filter_data[$key]['img']=tomedia($val['img']);
        }
        if($filter_data){
            return $this->result(0,'价格筛选数据请求成功',$filter_data);
        }else{

            return $this->result(1,'价格筛选数据请求失败',$filter_data);
        }

        break;

    case 'classify_son':

        $class_son=pdo_getall('shop_classification',array('pcid'=>$_GPC['id'],'uniacid'=>$uniacid),array());

    if($class_son){
        foreach($class_son as $key=>$val){

            $class_son[$key]['icon']=tomedia($val['icon']);

        }
        return $this->result(0,'子分类数据接口请求成功',$class_son);

    }else{
        return $this->result(1,'子分类数据接口数据接口失败',false);



    }
        break;


}
