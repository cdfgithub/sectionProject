<?php
/*该代码请勿商用*/
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$ad_data=pdo_fetchall("select * from ".tablename('shop_ad')."where uniacid='{$uniacid}' and public_status=1");
$data=array();
foreach($ad_data as $key=>$val){
    $data[$key]=tomedia($val['img']);
}
if($ad_data){

        return $this->result(0,'广告接口请求成功',$data);
}else{

    return $this->resutl(1,'广告接口请求成功',false);
}

