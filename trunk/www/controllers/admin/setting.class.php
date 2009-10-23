<?php
class setting{
	function __construct(){
		global $tpl;	
		$this->tpl = $tpl;
		$user = authenticate();	
		if(isset($user['user']) && $user['user_id']==1){
			$this->tpl->assign('user',$user);
		}else{
			redirect(BASE_URL);
		}
		
		
	}
    function view_basicset(){
    	include_once("SettingModel.class.php");
		$settingModel = new SettingModel();
		$sets = $settingModel->getAllSettings();
		foreach ($sets as $k=>$v){
			$$v['k'] = $v['v'];			
		}
		
		$timezoneset = isset($timezone)?$timezone:date_default_timezone_get();
    	
    	$this->tpl->assign('timezoneset',$timezoneset);
    	$this->tpl->assign('ssomode',SSO_MODE);
    	$this->tpl->assign('app_status',APP_STATUS);
    	$this->tpl->assign('timezonelist',timezone_identifiers_list());
    }
    function op_basicset(){
    	
    	$config = "<?php \r\ndefine('SSO_MODE', '{$_POST['ssomode']}');\r\n";
		$config .= "define('MULTI_TABLE', '".MULTI_TABLE."');\r\n";
		$config .= '$GLOBALS ["gDataBase"] ["db"] = array (
	  "dbname" => "'.$GLOBALS ["gDataBase"] ["db"]['dbname'].'",
	  "type" => "'.$GLOBALS ["gDataBase"] ["db"]['type'].'",
	  "host" => "'.$GLOBALS ["gDataBase"] ["db"]['host'].'",
	  "port" => "'.$GLOBALS ["gDataBase"] ["db"]['port'].'",
	  "user" => "'.$GLOBALS ["gDataBase"] ["db"]['user'].'",
	  "passwd" => "'.$GLOBALS ["gDataBase"] ["db"]['passwd'].'",
	  "charset"=> "'.$GLOBALS ["gDataBase"] ["db"]['charset'].'",
	);
	?>';
		$r1 = write_file($config,APP_DIR.'/config/install.ini.php');
		
		if(isset($_POST['app_status'])) $upate['app_status'] = $_POST['app_status'];
    	if(isset($_POST['timezone'])) $upate['timezone'] = $_POST['timezone'];
    	if(isset($_POST['ssomode'])) $upate['ssomode'] = $_POST['ssomode'];
    	include_once("SettingModel.class.php");
		$settingModel = new SettingModel();
		$r2 = $settingModel->updateSettings($upate);
		
		
		$config_content = file_get_contents(APP_DIR."/config/config.ini.php");
		$config_content= preg_replace('/("APP_STATUS"\s*,\s*)(.*?)(\);)/ism','\\1"'.$_POST['app_status'].'"\\3',$config_content);
		$config_content= preg_replace('/(date_default_timezone_set\()(.*?)(\);)/ism','\\1"'.$_POST['timezone'].'"\\3',$config_content);
		$r3 = write_file($config_content,APP_DIR."/config/config.ini.php");
	
		
		if($r1 && $r2 && $r3)
			show_message_goback(lang('success'));
		else 
			show_message_goback(lang('failed'));
		
    }
	
    function view_regset(){
    	include_once("SettingModel.class.php");
		$settingModel = new SettingModel();
		$sets = $settingModel->getAllSettings();
		foreach ($sets as $k=>$v){
			$$v['k'] = $v['v'];
			$this->tpl->assign($v['k'],$$v['k']);
		}
		
    }
    function op_regset(){
    	
    	if(isset($_POST['doublenick'])) $upate['doublenick'] = $_POST['doublenick'];
    	if(isset($_POST['banemail'])) $upate['banemail'] = $_POST['banemail'];
    	if(isset($_POST['banusername'])) $upate['banusername'] = $_POST['banusername'];
    	include_once("SettingModel.class.php");
		$settingModel = new SettingModel();
		$r = $settingModel->updateSettings($upate);
		$settingModel->clearCache();
		if($r) 
			show_message_goback(lang('success'));
		else 
			show_message_goback(lang('failed'));
    }
    
    function view_emailset(){
    	$smtp_host = isset($GLOBALS ["gEmail"] ["smtp_host"])?$GLOBALS ["gEmail"] ["smtp_host"]:'';
    	$smtp_port = isset($GLOBALS ["gEmail"] ["smtp_port"])?$GLOBALS ["gEmail"] ["smtp_port"]:'';
    	$smtp_account = isset($GLOBALS ["gEmail"] ["smtp_account"])?$GLOBALS ["gEmail"] ["smtp_account"]:'';
    	$smtp_pass = isset($GLOBALS ["gEmail"] ["smtp_pass"])?$GLOBALS ["gEmail"] ["smtp_pass"]:'';
    	$smtp_from = isset($GLOBALS ["gEmail"] ["smtp_from"])?$GLOBALS ["gEmail"] ["smtp_from"]:'';
    	
    	$this->tpl->assign('smtp_host',$smtp_host);
    	$this->tpl->assign('smtp_port',$smtp_port);
    	$this->tpl->assign('smtp_account',$smtp_account);
    	$this->tpl->assign('smtp_pass',$smtp_pass);
    	$this->tpl->assign('smtp_from',$smtp_from);
    }
    function op_emailset(){
    	if(isset($_POST['smtp_host'])) $upate['smtp_host'] = $_POST['smtp_host'];
    	if(isset($_POST['smtp_port'])) $upate['smtp_port'] = $_POST['smtp_port'];
    	if(isset($_POST['smtp_account'])) $upate['smtp_account'] = $_POST['smtp_account'];
    	if(isset($_POST['smtp_pass'])) $upate['smtp_pass'] = $_POST['smtp_pass'];
    	if(isset($_POST['smtp_from'])) $upate['smtp_from'] = $_POST['smtp_from'];
    	include_once("SettingModel.class.php");
		$settingModel = new SettingModel();
		$r = $settingModel->updateSettings($upate);
		
		$config_content = file_get_contents(APP_DIR."/config/config.ini.php");
		$config_content= preg_replace('/(\["smtp_host"\]\s*=\s*)(.*?)(;)/ism','\\1"'.$upate['smtp_host'].'"\\3',$config_content);
		$config_content= preg_replace('/(\["smtp_port"\]\s*=\s*)(.*?)(;)/ism','\\1"'.$upate['smtp_port'].'"\\3',$config_content);
		$config_content= preg_replace('/(\["smtp_account"\]\s*=\s*)(.*?)(;)/ism','\\1"'.$upate['smtp_account'].'"\\3',$config_content);
		$config_content= preg_replace('/(\["smtp_pass"\]\s*=\s*)(.*?)(;)/ism','\\1"'.$upate['smtp_pass'].'"\\3',$config_content);
		$config_content= preg_replace('/(\["smtp_from"\]\s*=\s*)(.*?)(;)/ism','\\1"'.$upate['smtp_from'].'"\\3',$config_content);
		$r1 = write_file($config_content,APP_DIR."/config/config.ini.php");
		
		if($r && $r1) 
			show_message_goback(lang('success'));
		else 
			show_message_goback(lang('failed'));
    }
}
?>