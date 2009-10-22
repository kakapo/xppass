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
}
?>