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
    	$keyword = $_GET['view'];
		$cur_sort = !empty($_GET['sort'])?$_GET['sort']:'user_id';
		
		
		include_once("UserModel.class.php");
		$userModel = new UserModel();
		
		$con['order'] = $cur_sort;
		
		
		$users = $userModel->getItems($con,16);

		$this->tpl->assign('users',$users);
		$this->tpl->assign('con',$con);
    }   
    function view_menu(){
		global $tpl;	
		

    }    
    function view_main(){
		global $tpl;	
		

    }

}
?>