<?php
class user{
	function __construct(){
		global $tpl;	
		$this->tpl = $tpl;
		$user = authenticate();	
		if(isset($user['user']) && $user['user_id']==1){
			$tpl->assign('user',$user);
		}else{
			redirect(BASE_URL);
		}
		
	}
    function view_defaults(){
		$cur_sort = !empty($_GET['sort'])?$_GET['sort']:'user_id';
		$user = !empty($_GET['user'])?$_GET['user']:'';
		$user_id = !empty($_GET['user_id'])?$_GET['user_id']:'';
		$user_nickname = !empty($_GET['user_nickname'])?$_GET['user_nickname']:'';
		$user_reg_time = !empty($_GET['user_reg_time'])?$_GET['user_reg_time']:'';
		$user_reg_time1 = !empty($_GET['user_reg_time1'])?$_GET['user_reg_time1']:'';
		
		
		include_once("UserModel.class.php");
		$userModel = new UserModel();
		
		$con['order'] = $cur_sort;
		$con['user'] = $user;
		$con['user_id'] = $user_id;
		$con['user_nickname'] = $user_nickname;
		$con['user_reg_time'] = $user_reg_time;
		$con['user_reg_time1'] = $user_reg_time1;
		
		$users = $userModel->getItems($con,10);
		$this->tpl->assign('total',$users['page']->total);
		$this->tpl->assign('users',$users);
		$this->tpl->assign('con',$con);
    }   
    function view_menu(){
		global $tpl;	
		

    }    
    function view_main(){
		global $tpl;	
		

    }

    function op_adduser(){
    	$msg = '';
		$reg_type = !empty($_POST['reg_type'])?$_POST['reg_type']:'';
		$_POST ['sex'] = (isset($_POST ['sex']))?$_POST ['sex']:0;		
		
		$pattern = "/^[a-zA-Z][a-zA-Z0-9_]{1,13}[a-zA-Z0-9]$/i";
		$pattern2 = "/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/";
		if($reg_type=='email'){
			if (empty ( $_POST ['email'] ) || ! preg_match ( $pattern2, $_POST ['email'] )) {
				$msg = array('s'=> 400,'m'=>lang('insertemail'),'d'=>'');				
				exit(json_output($msg));
			}
		}
		if (strlen($_POST ['password']) <6) {
			$msg = array('s'=> 400,'m'=>lang('pwdrule'),'d'=>'');				
			exit(json_output($msg));
		}
		$_POST ['nickname'] = trim ( $_POST ['nickname'] );
		$nickname_len = mb_strlen ( $_POST ['nickname'], "UTF-8");
		if (empty ( $_POST ['nickname'] ) || $nickname_len < 2 || $nickname_len > 16) {
			$msg = array('s'=> 400,'m'=>lang('nicknamerule'),'d'=>'');				
			exit(json_output($msg));
		}
		$_POST ['sex'] = intval($_POST ['sex']);
		if (empty($_POST ['sex'])) {
			$msg = array('s'=> 400,'m'=>lang('sexrule'),'d'=>'');				
			exit(json_output($msg));
		}


		include_once("PassportModel.class.php");
		$passmod = new PassportModel();
	
		if($passmod->checkNickname($_POST ['nickname'])){
			$msg = array('s'=> 400,'m'=>lang('nicknameexist'),'d'=>'');				
			exit(json_output($msg));
		}
		
		if($reg_type=='email'){
			 if($passmod->checkUser ( $_POST ['email'] ) || $passmod->isBlockword($_POST ['email'])) {
				$msg = lang('userexist');
				$msg = array('s'=> 400,'m'=>lang('userexist'),'d'=>'');				
				exit(json_output($msg));
			}
			$user['user_email'] = $_POST ['email'];
			$user['user'] = $_POST ['email'];
			$user['user_question'] = '';
			$user['user_answer'] = '';
		}
		

		$user['user_password'] = PassportModel::encryptpwd($_POST ['password'],$user['user']);
		$user['user_nickname'] = htmlspecialchars ( $_POST ['nickname'] );
		$user['user_sex'] = $_POST ['sex'];
		$user['user_reg_ip'] = getip();
		
		// 1. create db user
		$row = $passmod->createNewUser ( $user );
		if ($row !== false) {

			$msg = array('s'=> 200,'m'=>'ok','d'=>$GLOBALS ['gSiteInfo'] ['www_site_url']."/admin.php/user/defaults");				
			exit(json_output($msg));
								
		}
    }
    
    function op_deluser(){
    	$t = true;
    	if(isset($_POST['delete']) && is_array($_POST['delete'])){
    		include_once("PassportModel.class.php");
    		$passport = new PassportModel();
    		foreach ($_POST['delete'] as $u){
    			
    			$t *= $passport->deleteUser($u);
    			
    		}
    		
    		if($t) show_message_goback(lang('success'));
    	}
    	show_message(lang('selectone'));
    	goback();
    }
    function view_detail(){
    	$user = $_GET['user'];
    	$user_id = $_GET['user_id'];
    	
    	include_once("PassportModel.class.php");
    	$passport = new PassportModel();
    	$userinfo = $passport->getUserById($user_id,$user);
    	if($userinfo){
    		$userinfo['user_lastlogin_time'] = date("y-m-d H:i:s",$userinfo['user_lastlogin_time']);
    		if($userinfo['user_sex']==1) $userinfo['user_sex'] = lang('boy');
    		if($userinfo['user_sex']==2) $userinfo['user_sex'] = lang('girl');
    		$msg = array('s'=> 200,'m'=>'','d'=>$userinfo);				
			exit(json_output($msg));
    	}else{
    		$msg = array('s'=> 400,'m'=>lang('usernotexist'),'d'=>'');				
			exit(json_output($msg));
    	}
    }
    
    function view_edit(){
    	$user = $_GET['user'];
    	$user_id = $_GET['user_id'];
    	include_once("PassportModel.class.php");
    	$passport = new PassportModel();
    	$userinfo = $passport->getUserById($user_id,$user);
    	$this->tpl->assign('userinfo',$userinfo);
    }
    function op_updateuser(){
    	$msg = '';
		$reg_type = !empty($_POST['reg_type'])?$_POST['reg_type']:'';
		$_POST ['sex'] = (isset($_POST ['sex']))?$_POST ['sex']:0;		
		
		$pattern2 = "/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/";
		if($reg_type=='email'){
			if (empty ( $_POST ['email'] ) || ! preg_match ( $pattern2, $_POST ['email'] )) {
				$msg = array('s'=> 400,'m'=>lang('insertemail'),'d'=>'');				
				exit(json_output($msg));
			}
		}
		if (!empty($_POST ['password']) && strlen($_POST ['password']) <6) {
			$msg = array('s'=> 400,'m'=>lang('pwdrule'),'d'=>'');				
			exit(json_output($msg));
		}
		$_POST ['nickname'] = trim ( $_POST ['nickname'] );
		$nickname_len = mb_strlen ( $_POST ['nickname'], "UTF-8");
		if (empty ( $_POST ['nickname'] ) || $nickname_len < 2 || $nickname_len > 16) {
			$msg = array('s'=> 400,'m'=>lang('nicknamerule'),'d'=>'');				
			exit(json_output($msg));
		}
		
		$_POST ['sex'] = intval($_POST ['sex']);
		if (empty($_POST ['sex'])) {
			$msg = array('s'=> 400,'m'=>lang('sexrule'),'d'=>'');				
			exit(json_output($msg));
		}

		$user = $_POST['user'];
		$user_id = $_POST['user_id'];

		include_once("PassportModel.class.php");
		$passmod = new PassportModel();
	
		$updates['user_email'] = $_POST ['email'];
		if($_POST ['password']!='') $updates['user_password'] = PassportModel::encryptpwd($_POST ['password'],$user);
		$updates['user_nickname'] = htmlspecialchars ( $_POST ['nickname'] );
		$updates['user_sex'] = $_POST ['sex'];
		
		
		// 1. update db user
		$row = $passmod->updateUser( $updates, $user_id,$user);
		if ($row !== false) {

			$msg = array('s'=> 200,'m'=>lang('success'),'d'=>'');				
			exit(json_output($msg));
								
		}else{
			$msg = array('s'=> 400,'m'=>lang('failed'),'d'=>'');				
			exit(json_output($msg));
		}
    }
    
    function view_online(){
    	if(SSO_MODE!='ticket') {
    		show_message(lang('module_ban'));
    		die;
    	}
    	$cur_sort = !empty($_GET['sort'])?$_GET['sort']:'ticket';
		$user = !empty($_GET['user'])?$_GET['user']:'';
		
		
		include_once("UserModel.class.php");
		$userModel = new UserModel();
		
		$con['order'] = $cur_sort;
		$con['user'] = $user;
		
		$items = $userModel->getOnlineUsers($con,10);

		$this->tpl->assign('users',$items);
		$this->tpl->assign('total',$items['page']->total);
		$this->tpl->assign('con',$con);
    }
    function op_delonlineuser(){
    	if(SSO_MODE!='ticket') {
    		show_message(lang('module_ban'));
    		die;
    	}
    	$t = true;
    	if(isset($_POST['delete']) && is_array($_POST['delete'])){
    		
    		include_once("PassportModel.class.php");
    		$passport = new PassportModel();
    		foreach ($_POST['delete'] as $ticket){
    			$t *= $passport->deleteTicketById($ticket);
    		}
    		
    		if($t) show_message_goback(lang('success'));
    	}
    	show_message(lang('selectone'));
    	goback();
    }
}
?>