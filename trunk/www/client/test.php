<?php
include("config.php");
include("XPassClient.class.php");
$xpc = new XPassClient($private_key);
$res = $xpc->isLogin();
//var_dump($xpc->isUserLogin('reroot'));
if($res['s']==200){
	$ticket = $res['d'];
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