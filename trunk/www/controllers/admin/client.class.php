<?php
class client{
	function __construct(){
		global $tpl;
		$this->tpl = $tpl;
	}
	function view_defaults(){
		$cur_sort = !empty($_GET['sort'])?$_GET['sort']:'client_id';
		$domain = !empty($_GET['domain'])?$_GET['domain']:'';
		
		
		include_once("ClientModel.class.php");
		$clientModel = new ClientModel();
		
		$con['order'] = $cur_sort;
		$con['domain'] = $domain;
		
		$items = $clientModel->getItems($con,10);

		$this->tpl->assign('clients',$items);
		$this->tpl->assign('con',$con);
	}
	
	function op_addclient(){
		$arr['domain'] = $_POST['adddomain'];
		$pattern = "/([\w]+\.[\w]+)/i";
		if(!preg_match($pattern,$arr['domain'])){
			$msg = array('s'=> 400,'m'=>lang('invaliddomain'),'d'=>'');				
			exit(json_output($msg));
		}
		include_once("ClientModel.class.php");
		$clientModel = new ClientModel();
		
		if($row = $clientModel->getClientByName($arr['domain'])){
			$msg = array('s'=> 400,'m'=>lang('domainexist'),'d'=>'');				
			exit(json_output($msg));
		}
		
		$arr['key'] = $clientModel->generateKey();
		
		$r = $clientModel->addNewClient($arr);
		
		if($r){
			$msg = array('s'=> 200,'m'=>lang('success'),'d'=>$GLOBALS ['gSiteInfo'] ['www_site_url']."/admin.php/client/defaults");				
			exit(json_output($msg));
		}else{
			$msg = array('s'=> 400,'m'=>lang('failed'),'d'=>'');				
			exit(json_output($msg));
		}
		
	}
	function op_delclient(){
		$t = true;
    	if(isset($_POST['delete']) && is_array($_POST['delete'])){
    		include_once("ClientModel.class.php");
    		$clientModel = new ClientModel();
    		foreach ($_POST['delete'] as $u){
    			$t *= $clientModel->deleteClient($u);
    		}
    		if($t) show_message_goback(lang('success'));
    	}
    	show_message(lang('selectone'));
    	goback();
	}
}
?>