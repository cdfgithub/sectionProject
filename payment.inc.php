<?php
/*该代码请勿商用*/
defined('IN_IA') or exit ('Access Denied');
global  $_GPC,$_W;
$uniacid=$_W['uniacid'];
require_once 'wxpay.class.php';
     $business_data=pdo_get('shop_business',array('uniacid'=>$uniacid),array());
    $appid=$business_data['shop_appid'];
    $openid=$_GPC['shop_openid'];
    $mch_id=$business_data['shop_business_num'];
    $key=$business_data['key'];
    $total_fee=floatval($_GPC['fee']*100);
    $body="购买商品支付";
    $out_trade_no=time().rand(0,100)*66;
    $notify_url= MODULE_URL."recive.inc.php";
    if(!empty($openid)){
    $weixinpay = new WeixinPay($appid,$openid,$mch_id,$key,$out_trade_no,$body,$total_fee,$notify_url);
    $return=$weixinpay->pay();
    return $this->result(0,'支付接口请求成功',$return);

    }else{
     return $this->result(1,'支付接口请求失败',false);
    }
