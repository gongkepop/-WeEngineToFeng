<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
defined('IN_IA') or exit('Access Denied');

load()->model('welcome');
load()->model('cloud');
load()->func('communication');
load()->func('db');
load()->model('extension');
load()->model('module');
load()->model('system');
load()->model('user');

$dos = array('platform', 'add', 'add_view');

$do = in_array($do, $dos) ? $do : 'platform';
if ($do == 'platform' || $do == 'ext') {
    checkaccount();
}

if ($do == 'platform') {
    define('FRAME', 'account');

    $sql = "select id,`code`,`desc`,update_time from ims_wechat_template ;";
    $list = pdo_fetchall($sql);

    template('wechat/template');
} elseif ($do == 'add_view') {
    define('FRAME', 'account');
    template('wechat/add');
} elseif ($do == 'add') {
//    $sql = "INSERT INTO ims_wechat_template (`code`,`desc`,`create_time`,`update_time`) VALUES ( ".$wp['code'].",".$wp['desc']."".date('Y-m-d H:i:s')."".date('Y-m-d H:i:s').") ";
    $list = pdo_insert('wechat_template',['code' => $_GPC['code'], 'desc' => $_GPC['desc'], 'create_time' =>date('Y-m-d H:i:s'),'update_time' => date('Y-m-d H:i:s') ]);
    itoast('添加成功', url('wechat/member'), 'success');
}