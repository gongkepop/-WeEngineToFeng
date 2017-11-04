<?php
/**
 * Created by PhpStorm.
 * User: Merlin
 * Date: 2017/10/29
 * Time: 2:02
 */

require '../framework/bootstrap.inc.php';
require '../web/common/bootstrap.sys.inc.php';
require 'common/core/CoreFactory.php';

$uniacid = isset($_W['uniacid']) ?: 1;

//$realname = trim($_GPC['realname']) ? trim($_GPC['realname']) : itoast('姓名不能为空', '', '');
if( trim($_GPC['mobile']) ){
    $mobile = trim($_GPC['mobile']);
} else{
    echo CoreFactory::interrupt(-1, '手机号被不能为空');
    return false;
}
$user = pdo_get('mc_members', array('uniacid' => $uniacid, 'mobile' => $mobile));
if (!empty($user)) {
    echo CoreFactory::interrupt(-1, '手机号被占用');
    return false;
}

$salt = random(8);
$data = array(
    'uniacid' => $uniacid,
    'realname' => $realname,
    'mobile' => $mobile,
    'email' => $email,
    'salt' => $salt,
    'password' => md5(trim($_GPC['password']) . $salt . $_W['config']['setting']['authkey']),
    'credit1' => intval($_GPC['score']),
    'credit2' => intval($_GPC['amount']),
    'groupid' => intval($_GPC['groupid']),
    'createtime' => TIMESTAMP,
);
pdo_insert('mc_members', $data);
$uid = pdo_insertid();
if ($uid > 0) {
    echo CoreFactory::formatSuccess(['uid' => $uid], '导入用户成功');
} else {
    echo CoreFactory::interrupt();
}


