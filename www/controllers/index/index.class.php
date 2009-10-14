<?php
class index{

    function view_defaults(){
		global $tpl;	
		
		$user = authenticate();	
		$msg = '';	
		if($user){
			$msg = "Welcome ".$user['user_nickname']."  <a href='/index.php/passport/logout'>Logout</a>";
			
		}
		$tpl->assign('user',$user);
		$tpl->assign("name","It's a demo.");
		$tpl->assign("msg",$msg);
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