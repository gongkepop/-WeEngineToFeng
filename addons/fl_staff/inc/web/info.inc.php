<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $_W,$_GPC;
$nav="info";
$task=$_GPC['task']?$_GPC['task']:"index";


if($task=="index"){
	
	
	
	
	
	include $this->template('info');
	
	
}else{
	
}

