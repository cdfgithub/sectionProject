<?php
/*该代码请勿商用*/
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
    $res=pdo_insert('shop_comments',array('g_id'=>$_GPC['g_id'],'o_id'=>$_GPC['o_id'],'content'=>$_GPC['content'],'score'=>$_GPC['score'],'uniacid'=>$_W['uniacid'],'openid'=>$_GPC['openid']));
    if($res){
        $res=pdo_update('shop_order',array('fh_starts'=>4),array('id'=>$_GPC['o_id']));

        return $this->result(0,'评论成功',true);
    }else{
        return $this->result(1,'评论失败',false);
    }
