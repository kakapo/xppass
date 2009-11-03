<?php
class index{

    function view_defaults(){
		global $tpl;	
		
		$user = authenticate();	
		$msg = '';	
		if($user){
			$msg = "Welcome ".$user['user_nickname']."";
		}
		$tpl->assign('user',$user);
		$tpl->assign("name","It's a demo.");
		$tpl->assign("msg",$msg);
    }
    function view_help(){
    	global $tpl;	
    	$test_file = APP_DIR. "/client/test.php";
    	$code = '';
    	if (file_exists($test_file)) {
    		$code = highlight_file($test_file,true);
    	}
    	$tpl->assign('code',$code);
    	
    }
    function view_setlang(){
    	$select = $_GET['setlang'];
    	setcookie("_Selected_Language",$select,time()+3600*24*365,"/");
    	goback(0);
    }
}
?>