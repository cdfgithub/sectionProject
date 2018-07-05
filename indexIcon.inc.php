<?php
/*该代码请勿商用*/
defined('IN_IA') or exit('Access Denied') ;
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$index_data=pdo_getall('shop_navigation',array('uniacid'=>$uniacid,'is_show'=>1),array(),'',array('sort asc'),array(0,3));
    if($index_data){
        foreach($index_data as $key=>$val){
            $index_data[$key]['icon']=tomedia($val['icon']);
              $goods_data=pdo_fetchall("select id,img,sales,y_price,goods_price,s_name,n_id from ".tablename('shop_goods')."where is_sale=2 and n_id='{$val['id']}' and inventory > 0 and uniacid='{$uniacid}' order by id asc limit 2 ");
                foreach($goods_data as $key2=>$val2){
                    $goods_data[$key2]['img']=tomedia($val2['img']);
                }
            $index_data[$key]['goods']=$goods_data;
        }
        return $this->result(0,'首页导航数据请求成功',$index_data);
    }else{
       return $this->result(1,'首页导航数据请求失败',false);

    }



