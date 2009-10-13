<?php
class index{

    function view_defaults(){
		global $tpl;	
		
		$user = authenticate();		
		if($user){
			$msg = "<h1>欢迎！ ".$user['user_nickname']."  <a href='/index.php/passport/logout'>安全退出</a>";
			echo $msg;
		}
		$tpl->assign("name","It's a demo.");
    }
    function view_help(){
    	
    }
    function view_setlang(){
    	$select = $_GET['setlang'];
    	setcookie("_Selected_Language",$select,time()+3600*24*365,"/");
    	goback(0);
    }
}
?>