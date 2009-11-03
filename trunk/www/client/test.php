<?php
// Ticket Solution Client Demo
// 2009-11-03 kakapowu@gmail.com

include("config.php");
include("XPassClient.class.php");
$xpc = new XPassClient($private_key);

// return array('s'=>code,'m'=>'message','d'=>data);
// if s==200, return ticket
// if s==300, relogin
// if s==400, signature invalid.
$res = $xpc->isLogin();

// another api to determine the special user is online? $xpc->isUserLogin('reroot'), return true or false;

if($res['s']==200){
	$ticket = $res['d'];
	
// return array('s'=>code,'m'=>'message','d'=>data);
// if s==200, return userdata
// if s==300, relogin
// if s==400, signature invalid.
	$res = $xpc->getLoginUser($ticket);
	if($res['s']==200) {
		echo "<pre>";
		print_r(json_decode($res['d'],true));
	}
	if($res['s']==300) header("location:".$res['d']);
	if($res['s']==400) echo $res['m'];
	
}elseif($res['s']==300){
	header("location:".$res['d']);
}else{
	echo $res['m'];
}

?>