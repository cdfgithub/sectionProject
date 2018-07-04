<?php
/*改代码仅供学习，不可用于商业用途
 *
 * */
defined('IN_IA') or exit ('Access Denied');
global  $_GPC,$_W;
$uniacid=$_W['uniacid'];
$op=array('pay_success','pay_fail','pay_num','cart_pay_success','cart_pay_fail','success_change_status','fail_change_status');
$op=in_array($_GPC['op'],$op) ? $_GPC['op']: '';
switch($op) {
    case 'pay_success':
        $order_num = time() . rand(0, 9);
        $res = pdo_insert('shop_order', array( 'u_id' =>$_GPC['u_id'], 'goods_price' => $_GPC['price'], 'ordernumber' => $order_num, 'send_starts' => 1, 'zf_starts' => 2,  'g_id' => $_GPC['g_id'], 'order_sum' => $_GPC['count'], 'address' => $_GPC['address'], 'reciver' => $_GPC['reciver'], 'r_phone' => $_GPC['r_phone'],'uniacid'=>$uniacid,'remarks'=>$_GPC['remarks']));
        if ($res) {
            return $this->result(0, '订单生产成功', true);
        } else {
            return $this->result(1, '订单生产失败', false);
        }
        break;
    case 'pay_fail':

        $order_num = time() . rand(0, 9);
        $res = pdo_insert('shop_order', array( 'u_id' =>$_GPC['u_id'], 'goods_price' => $_GPC['price'], 'ordernumber' => $order_num, 'fh_starts' => 0, 'zf_starts' => 1,  'g_id' => $_GPC['g_id'], 'order_sum' => $_GPC['count'], 'address' => $_GPC['address'], 'reciver' => $_GPC['reciver'], 'r_phone' => $_GPC['r_phone'],'uniacid'=>$uniacid,'remarks'=>$_GPC['remarks']));
        if ($res) {
            return $this->result(0, '订单生产成功', true);
        } else {
            return $this->result(1, '订单生产失败', false);
        }
        break;
    case 'cart_pay_success':
        $addrres_data = htmlspecialchars_decode($_GPC['address']);
        $addrres_data = json_decode($addrres_data, true);
        $reciver = $addrres_data['reciver'];
        $addrres = $addrres_data['address'];
        $r_phone = $addrres_data['r_phone'];
        $order_num = time() . rand(0, 80);
        $shop_data = htmlspecialchars_decode($_GPC['shop']);
        $shop_data = json_decode($shop_data, true);
        foreach ($shop_data as $key => $val) {

            $res = pdo_insert('shop_order', array('u_id' =>$val['useropenid'], 'goods_price' => ($val['price'] * $val['number']), 'ordernumber' => $order_num, 'zf_starts' => 2, 'fh_starts' => 1, 'g_id' => $val['s_id'], 'order_sum' => $val['number'], 'address' => $addrres,  'reciver' => $reciver, 'r_phone' => $r_phone,'uniacid'=>$uniacid));

        }
        if ($res) {
            return $this->result(0, '订单生成成功', true);
        } else {
            return $this->result(1, '订单生成失败', false);

        }

        break;

    case 'cart_pay_fail':

        $addrres_data = htmlspecialchars_decode($_GPC['address']);
        $addrres_data = json_decode($addrres_data, true);
        $reciver = $addrres_data['reciver'];
        $addrres = $addrres_data['address'];
        $openid=$_GPC['openid'];
        $r_phone = $addrres_data['r_phone'];
        $order_num = time() . rand(0, 80);
        $shop_data = htmlspecialchars_decode($_GPC['shop']);
        $shop_data = json_decode($shop_data, true);
//        echo json_encode($shop_data);exit;
        foreach ($shop_data as $key => $val) {
            $res = pdo_insert('shop_order', array( 'u_id' => $val['useropenid'], 'price' => ($val['price'] * $val['number']), 'ordernumber ' => $order_num, 'zf_starts ' => 1, 'fh_starts' =>0, 'g_id' => $val['s_id'], 'order_sum' => $val['number'], 'address' => $addrres, 'reciver' => $reciver, 'r_phone' => $r_phone,'uniacid'=>$uniacid));
        }
        if ($res) {
            return $this->result(0, '订单生成成功', true);
        } else {
            return $this->result(1, '订单生成失败', false);

        }
        break;

    case 'success_change_status':
        $res = pdo_update('shop_order', array('pay_starts' => 2,'send_starts'=>1), array('id' => $_GPC['o_id']));
        if ($res) {
            return $this->result(0, '订单生成成功', true);
        } else {
            return $this->result(1, '订单生产失败', false);
        }
        break;

}
