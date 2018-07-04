<?php

/*改代码仅供学习，不可用于商业用途
 *
 * */
//京东物流接口
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
$deliver_num=trim($_GPC['deliver_num']);



$url="https://way.jd.com/showapi/order_path";
$param="com=auto&nu={$deliver_num}&appkey=werwerwer234234";
$ispost=false;
$isimage=false;

$res=wx_http_request($url,$param,'',$ispost,$isimage);
$res=json_decode($res);
 $res=$res->result->showapi_res_body->data;
 foreach($res as $key=>$val){
     $str.=$val->context.'<br/>'.$val->time.'<br/>';

 }
echo $str;