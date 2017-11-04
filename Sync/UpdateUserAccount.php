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
if (trim($_GPC['mobile'])) {
    $mobile = trim($_GPC['mobile']);
} else {
    echo CoreFactory::interrupt(-1, '手机号被不能为空');
    return false;
}
$user = pdo_get('mc_members', array('uniacid' => $uniacid, 'mobile' => $mobile));
if (empty($user)) {
    echo CoreFactory::interrupt(-1, '手机号不存在');
    return false;
}

$score = intval($_GPC['score']) ? intval($_GPC['score']) : 0;
$amount = intval($_GPC['amount']) ? intval($_GPC['amount']) : 0;
$user['credit1'] += $score;
$user['credit2'] += $amount;

$result = pdo_update('mc_members', $user, ['uid' => $user['uid']]);

if ($result) {
    echo CoreFactory::formatSuccess(['手机号' => $mobile], '更新成功');
} else {
    echo CoreFactory::interrupt();
}


