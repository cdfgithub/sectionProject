<?php
/*改代码仅供学习，不可用于商业用途
 *
 * */
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$busines_data=pdo_get('shop_business',array('uniacid'=>$uniacid),array());
//echo $_GPC['code'];exit;
$url="https://api.weixin.qq.com/sns/jscode2session?appid={$busines_data['appid']}&secret={$busines_data['appsecret']}&js_code={$_GPC['code']}&grant_type=authorization_code";

$ch = curl_init();
//设置选项，包括URL

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, false); //post提交方式
//执行并获取HTML文档内容
$session_key = curl_exec($ch);
//释放curl句柄
curl_close($ch);
//转换json数据

$openid=$session_key['openid'];
$session_key = json_decode($session_key,true);
echo json_encode($session_key);

$is_login=pdo_get('shop_user',array('openid'=>$openid),array());
if(empty($is_login)){

    pdo_insert('shop_user',array('openid'=>$openid));


}
