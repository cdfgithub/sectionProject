<?php
/*改代码仅供学习，不可用于商业用途
 *
 * */
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
$uniacid=$_W['uniacid'];
$gid=$_GPC['gid'];
$sql="select a.*,b.openid,b.u_name,b.img from `ims_shop_comments` as a left join  `ims_shop_user` as b on a.openid=b.openid where a.g_id={$gid} and a.uniacid={$uniacid}";
$result=pdo_fetchall($sql);
	foreach($result as $key=>$val){
		$result[$key]['a']=$val['content'];            //评论内容
		$result[$key]['b']=$val['score'];              //评分
		$result[$key]['c']=$val['u_name'];             //用户名
		$result[$key]['d']=tomedia($val['img']);       //图片
	}
            if($result){
                return $this->result(0,'请求成功',$result);

            }else{

                return $this->result(1,'请求成功',$result);

            }