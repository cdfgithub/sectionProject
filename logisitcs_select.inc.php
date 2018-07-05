<?php
/*该代码请勿商用*/
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
    $deliver_num=trim($_GPC['deliver_num']);

$url="https://way.jd.com/showapi/order_path";
$param="com=auto&nu={$deliver_num}&appkey=qrqwr1242342343245";
$ispost=false;
$isimage=false;

$res=wx_http_request($url,$param,'',$ispost,$isimage);
$res=json_decode($res);
$deliver_data=$res->result->showapi_res_body->data;
$data=array();
foreach($deliver_data as $key=>$val){
    $data[$key]=$val->context;
    $data['company']= $res->result->showapi_res_body->expTextName;
}
echo json_encode($data);
