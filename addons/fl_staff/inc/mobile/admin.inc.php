<?php

global $_W,$_GPC;
$task=$_GPC['task']?$_GPC['task']:"display";



if($task=="display"){
	
	include $this->template('admin/index');
}