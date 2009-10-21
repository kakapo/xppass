<?php
class index{
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
    function view_defaults(){
		
    }   
    function view_menu(){
		
    }    
    function view_main(){
		$this->db = Model::dbConnect($GLOBALS ["gDataBase"] ["db"]);
		
		$serverinfo = PHP_OS.' / PHP v'.PHP_VERSION;
		$serverinfo .= @ini_get('safe_mode') ? ' Safe Mode' : NULL;
		$dbversion = $this->db->getOne("SELECT VERSION()");
		$fileupload = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : '<font color="red">'.$lang['no'].'</font>';
		$dbsize = 0;
	
		$query = $tables = $this->db->getAll("SHOW TABLE STATUS");
		foreach($tables as $table) {
			$dbsize += $table['Data_length'] + $table['Index_length'];
		}
		$dbsize = $dbsize ? size_unit_convert($dbsize) : $lang['unknown'];
		$dbversion = $this->db->getOne("SELECT VERSION()");
		$magic_quote_gpc = get_magic_quotes_gpc() ? 'On' : 'Off';
		$allow_url_fopen = ini_get('allow_url_fopen') ? 'On' : 'Off';
		$this->tpl->assign('serverinfo', $serverinfo);
		$this->tpl->assign('fileupload', $fileupload);
		$this->tpl->assign('dbsize', $dbsize);
		$this->tpl->assign('dbversion', $dbversion);
		$this->tpl->assign('magic_quote_gpc', $magic_quote_gpc);
		$this->tpl->assign('allow_url_fopen', $allow_url_fopen);
    }

    function view_setting(){
    	$this->tpl->assign('ssomode',SSO_MODE);
    }
    function op_updatesetting(){
    	
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
		try{
			$fp = fopen(APP_DIR.'/config/install.ini.php', 'w');
			fwrite($fp, $config);
			fclose($fp);
			show_message_goback(lang('success'));
		}catch (Exception $e){
			
		}
		
    }
	
    function view_regreset(){
    	
    }
}
?>