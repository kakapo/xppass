<?php
class index{
	function __construct(){
		global $tpl;	
		$user = authenticate();	
		if(isset($user['user']) && $user['user_id']==1){
			$tpl->assign('user',$user);
		}else{
			redirect(BASE_URL);
		}
		
	}
    function view_defaults(){
		
    }   
     function view_menu(){
		global $tpl;	
		

    }    
    function view_main(){
		global $tpl;	
		

    }

}
?>