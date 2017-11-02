<?php
/**
 * Created by PhpStorm.
 * User: Merlin
 * Date: 2017/10/28
 * Time: 16:58
 */


require '../framework/bootstrap.inc.php';
require '../web/common/bootstrap.sys.inc.php';
require 'common/core/CoreFactory.php';


load()->model('reply');
load()->classs('wesession');
$hash = $_GPC['hash'];


if (!empty($_GPC['appid'])) {
    $appid = ltrim($_GPC['appid'], '/');
    if ($appid == 'wx570bc396a51b8ff8') {
        $_W['account'] = array(
            'type' => '3',
            'key' => 'wx570bc396a51b8ff8',
            'level' => 4,
            'token' => 'platformtestaccount'
        );
    } else {
        $id = pdo_fetchcolumn("SELECT acid FROM " . tablename('account_wechats') . " WHERE `key` = :appid", array(':appid' => $appid));
    }
}

if (empty($id)) {
    $id = intval($_GPC['id']);
}
if (!empty($id)) {
    $uniacid = pdo_getcolumn('account', array('acid' => $id), 'uniacid');
    $_W['account'] = uni_fetch($uniacid);
}
//if (empty($_W['account'])) {
//    exit('initial error hash or id');
//}
//if (empty($_W['account']['token'])) {
//    exit('initial missing token');
//}
//var_dump($_W);die;
define('PDO_DEBUG', false);
$pdo = new DB();
$sql = 'SELECT `uid`, `uniacid`, `groupid`, `realname`, `nickname` card_name, `password`, `email`, `mobile`, gender as sex, birthyear, birthmonth, birthday, resideprovince, residecity, residedist, idcard, `credit1` as score, `credit2` as money, `createtime` FROM ims_mc_members ';
$params = [];
$list = $pdo->fetchall($sql, $params);



echo CoreFactory::formatSuccess($list);