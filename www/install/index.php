<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@set_time_limit(1000);
set_magic_quotes_runtime(0);

define('LANG', 'zh-cn');
define('ROOT_PATH', dirname(__FILE__).'/../');
define('CONFIG', ROOT_PATH.'/config/install.ini.php');
$view_off  = isset($_POST['view_off'])?$_POST['view_off']:'';
define('VIEW_OFF', $view_off ? TRUE : FALSE);
include_once(ROOT_PATH.'/langs/'.LANG.'/globals.php');
include_once(ROOT_PATH.'/install/db.class.php');
$sqlfile = ROOT_PATH.'./install/xppass.sql';

$allow_method = array('show_license', 'env_check', 'set_params', 'db_init');

if(!ini_get('short_open_tag')) {
	show_msg('short_open_tag_invalid', '', 0);
} elseif(file_exists($lockfile)) {
	show_msg('install_locked', '', 0);
} elseif(!class_exists('dbstuff')) {
	show_msg('database_nonexistence', '', 0);
}

define('ENV_CHECK_RIGHT', 0);
define('ERROR_CONFIG_VARS', 1);
define('SHORT_OPEN_TAG_INVALID', 2);
define('INSTALL_LOCKED', 3);
define('DATABASE_NONEXISTENCE', 4);
define('PHP_VERSION_TOO_LOW', 5);
define('MYSQL_VERSION_TOO_LOW', 6);
define('UC_URL_INVALID', 7);
define('UC_DNS_ERROR', 8);
define('UC_URL_UNREACHABLE', 9);
define('UC_VERSION_INCORRECT', 10);
define('UC_DBCHARSET_INCORRECT', 11);
define('UC_API_ADD_APP_ERROR', 12);
define('UC_ADMIN_INVALID', 13);
define('UC_DATA_INVALID', 14);
define('DBNAME_INVALID', 15);
define('DATABASE_ERRNO_2003', 16);
define('DATABASE_ERRNO_1044', 17);
define('DATABASE_ERRNO_1045', 18);
define('DATABASE_CONNECT_ERROR', 19);
define('TABLEPRE_INVALID', 20);
define('CONFIG_UNWRITEABLE', 21);
define('ADMIN_USERNAME_INVALID', 22);
define('ADMIN_EMAIL_INVALID', 25);
define('ADMIN_EXIST_PASSWORD_ERROR', 26);
define('ADMININFO_INVALID', 27);
define('LOCKFILE_NO_EXISTS', 28);
define('TABLEPRE_EXISTS', 29);
define('ERROR_UNKNOW_TYPE', 30);
define('ENV_CHECK_ERROR', 31);
define('UNDEFINE_FUNC', 32);
define('MISSING_PARAMETER', 33);
define('LOCK_FILE_NOT_TOUCH', 34);
$func_items = array( 'fopen','fsockopen', 'file_put_contents', 'file_get_contents', 'pdo','pdo_mysql','json','mbstring','memcache');

$env_items = array
(
	'os' => array('c' => 'PHP_OS', 'r' => 'notset', 'b' => 'unix'),
	'php' => array('c' => 'PHP_VERSION', 'r' => '5.0', 'b' => '5.2'),
	'gdversion' => array('r' => '1.0', 'b' => '2.0'),
	'diskspace' => array('r' => '10M', 'b' => 'notset'),
);

$dirfile_items = array
(
	'config' => array('type' => 'file', 'path' => './config/config.inc.php'),
	'tmp' => array('type' => 'dir', 'path' => './tmp')
);




function dir_writeable($dir) {
	$writeable = 0;
	if(!is_dir($dir)) {
		@mkdir($dir, 0777);
	}
	if(is_dir($dir)) {
		if($fp = @fopen("$dir/test.txt", 'w')) {
			@fclose($fp);
			@unlink("$dir/test.txt");
			$writeable = 1;
		} else {
			$writeable = 0;
		}
	}
	return $writeable;
}
function dirfile_check(&$dirfile_items) {
	foreach($dirfile_items as $key => $item) {
		$item_path = $item['path'];
		if($item['type'] == 'dir') {
			if(!dir_writeable(ROOT_PATH.$item_path)) {
				if(is_dir(ROOT_PATH.$item_path)) {
					$dirfile_items[$key]['status'] = 0;
					$dirfile_items[$key]['current'] = '+r';
				} else {
					$dirfile_items[$key]['status'] = -1;
					$dirfile_items[$key]['current'] = 'nodir';
				}
			} else {
				$dirfile_items[$key]['status'] = 1;
				$dirfile_items[$key]['current'] = '+r+w';
			}
		} else {
			if(file_exists(ROOT_PATH.$item_path)) {
				if(is_writable(ROOT_PATH.$item_path)) {
					$dirfile_items[$key]['status'] = 1;
					$dirfile_items[$key]['current'] = '+r+w';
				} else {
					$dirfile_items[$key]['status'] = 0;
					$dirfile_items[$key]['current'] = '+r';
				}
			} else {
				if(dir_writeable(dirname(ROOT_PATH.$item_path))) {
					$dirfile_items[$key]['status'] = 1;
					$dirfile_items[$key]['current'] = '+r+w';
				} else {
					$dirfile_items[$key]['status'] = -1;
					$dirfile_items[$key]['current'] = 'nofile';
				}
			}
		}
	}
}
function env_check(&$env_items) {
	foreach($env_items as $key => $item) {
		if($key == 'php') {
			$env_items[$key]['current'] = PHP_VERSION;
		} elseif($key == 'gdversion') {
			$tmp = function_exists('gd_info') ? gd_info() : array();
			$env_items[$key]['current'] = empty($tmp['GD Version']) ? 'noext' : $tmp['GD Version'];
			unset($tmp);
		} elseif($key == 'diskspace') {
			if(function_exists('disk_free_space')) {
				$env_items[$key]['current'] = floor(disk_free_space(ROOT_PATH) / (1024*1024)).'M';
			} else {
				$env_items[$key]['current'] = 'unknow';
			}
		} elseif(isset($item['c'])) {
			$env_items[$key]['current'] = constant($item['c']);
		}

		$env_items[$key]['status'] = 1;
		if($item['r'] != 'notset' && strcmp($env_items[$key]['current'], $item['r']) < 0) {
			$env_items[$key]['status'] = 0;
		}
	}
}
function function_check(&$func_items) {
	$extensions =get_loaded_extensions();

	foreach ($extensions as $k=>$v){
		$extensions[$k] = strtolower($v);
	}

	foreach($func_items as $item) {
	
		if(function_exists($item) || in_array($item,$extensions)){
			
		}else {
		 show_msg('undefine_func', $item, 0);
		}
	}
}
function lang($lang_key, $force = true) {
	return isset($GLOBALS['gLang']['lang_install'][$lang_key]) ? $GLOBALS['gLang']['lang_install'][$lang_key] : ($force ? $lang_key : '');
}
function show_next_step($step, $error_code) {
	
	echo "<form action=\"index.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"step\" value=\"$step\" />";
	
	if($error_code == 0) {
		$nextstep = "<input type=\"button\" onclick=\"history.back();\" value=\"".lang('old_step')."\"><input type=\"submit\" value=\"".lang('new_step')."\">\n";
	} else {
		$nextstep = "<input type=\"button\" disabled=\"disabled\" value=\"".lang('not_continue')."\">\n";
	}
	echo "<div class=\"btnbox marginbot\">".$nextstep."</div>\n";
	echo "</form>\n";
}
function getgpc($k, $t='GP') {
	$t = strtoupper($t);
	switch($t) {
		case 'GP' : isset($_POST[$k]) ? $var = &$_POST : $var = &$_GET; break;
		case 'G': $var = &$_GET; break;
		case 'P': $var = &$_POST; break;
		case 'C': $var = &$_COOKIE; break;
		case 'R': $var = &$_REQUEST; break;
	}
	return isset($var[$k]) ? $var[$k] : '';
}
function show_env_result(&$env_items, &$dirfile_items, &$func_items) {
	$extensions = get_loaded_extensions();
	foreach ($extensions as $k=>$v){
		$extensions[$k] = strtolower($v);
	}
	$env_str = $file_str = $dir_str = $func_str = '';
	$error_code = 0;

	foreach($env_items as $key => $item) {
		if($key == 'php' && strcmp($item['current'], $item['r']) < 0) {
			show_msg('php_version_too_low', $item['current'], 0);
		}
		$status = 1;
		if($item['r'] != 'notset') {
			if(intval($item['current']) && intval($item['r'])) {
				if(intval($item['current']) < intval($item['r'])) {
					$status = 0;
					$error_code = ENV_CHECK_ERROR;
				}
			} else {
				if(strcmp($item['current'], $item['r']) < 0) {
					$status = 0;
					$error_code = ENV_CHECK_ERROR;
				}
			}
		}
		if(VIEW_OFF) {
			$env_str .= "\t\t<runCondition name=\"$key\" status=\"$status\" Require=\"$item[r]\" Best=\"$item[b]\" Current=\"$item[current]\"/>\n";
		} else {
			$env_str .= "<tr>\n";
			$env_str .= "<td>".lang($key)."</td>\n";
			$env_str .= "<td class=\"padleft\">".lang($item['r'])."</td>\n";
			$env_str .= "<td class=\"padleft\">".lang($item['b'])."</td>\n";
			$env_str .= ($status ? "<td class=\"w pdleft1\">" : "<td class=\"nw pdleft1\">").$item['current']."</td>\n";
			$env_str .= "</tr>\n";
		}
	}

	foreach($dirfile_items as $key => $item) {
		$tagname = $item['type'] == 'file' ? 'File' : 'Dir';
		$variable = $item['type'].'_str';

		if(VIEW_OFF) {
			if($item['status'] == 0) {
				$error_code = ENV_CHECK_ERROR;
			}
			$$variable .= "\t\t\t<File name=\"$item[path]\" status=\"$item[status]\" requirePermisson=\"+r+w\" currentPermisson=\"$item[current]\" />\n";
		} else {
			$$variable .= "<tr>\n";
			$$variable .= "<td>$item[path]</td><td class=\"w pdleft1\">".lang('writeable')."</td>\n";
			if($item['status'] == 1) {
				$$variable .= "<td class=\"w pdleft1\">".lang('writeable')."</td>\n";
			} elseif($item['status'] == -1) {
				$error_code = ENV_CHECK_ERROR;
				$$variable .= "<td class=\"nw pdleft1\">".lang('nodir')."</td>\n";
			} else {
				$error_code = ENV_CHECK_ERROR;
				$$variable .= "<td class=\"nw pdleft1\">".lang('unwriteable')."</td>\n";
			}
			$$variable .= "</tr>\n";
		}
	}

	if(VIEW_OFF) {

		$str = "<root>\n";
		$str .= "\t<runConditions>\n";
		$str .= $env_str;
		$str .= "\t</runConditions>\n";
		$str .= "\t<FileDirs>\n";
		$str .= "\t\t<Dirs>\n";
		$str .= $dir_str;
		$str .= "\t\t</Dirs>\n";
		$str .= "\t\t<Files>\n";
		$str .= $file_str;
		$str .= "\t\t</Files>\n";
		$str .= "\t</FileDirs>\n";
		$str .= "\t<error errorCode=\"$error_code\" errorMessage=\"\" />\n";
		$str .= "</root>";
		echo $str;
		exit;

	} else {

		//show_header();

		echo "<h2 class=\"title\">".lang('env_check')."</h2>\n";
		echo "<table class=\"tb\" style=\"margin:20px 50px;\">\n";
		echo "<tr>\n";
		echo "\t<th>".lang('project')."</th>\n";
		echo "\t<th class=\"padleft\">".lang('ucenter_required')."</th>\n";
		echo "\t<th class=\"padleft\">".lang('ucenter_best')."</th>\n";
		echo "\t<th class=\"padleft\">".lang('curr_server')."</th>\n";
		echo "</tr>\n";
		echo $env_str;
		echo "</table>\n";

		echo "<h2 class=\"title\">".lang('priv_check')."</h2>\n";
		echo "<table class=\"tb\" style=\"margin:20px 50px;\">\n";
		echo "\t<tr>\n";
		echo "\t<th>".lang('step1_file')."</th>\n";
		echo "\t<th class=\"padleft\">".lang('step1_need_status')."</th>\n";
		echo "\t<th class=\"padleft\">".lang('step1_status')."</th>\n";
		echo "</tr>\n";
		echo $file_str;
		echo $dir_str;
		echo "</table>\n";
		$exts =get_loaded_extensions();
		foreach($func_items as $item) {
			if(function_exists($item) || in_array($item,$extensions)){
				$status = true;
			}else{
				$status = false;
			}
			//$status = function_exists($item);
			$func_str .= "<tr>\n";
			$func_str .= "<td>$item</td>\n";
			if($status) {
				$func_str .= "<td class=\"w pdleft1\">".lang('supportted')."</td>\n";
				$func_str .= "<td class=\"padleft\">".lang('none')."</td>\n";
			} else {
				$error_code = ENV_CHECK_ERROR;
				$func_str .= "<td class=\"nw pdleft1\">".lang('unsupportted')."</td>\n";
				$func_str .= "<td><font color=\"red\">".lang('advice_'.$item)."</font></td>\n";
			}
		}
		echo "<h2 class=\"title\">".lang('func_depend')."</h2>\n";
		echo "<table class=\"tb\" style=\"margin:20px 50px;\">\n";
		echo "<tr>\n";
		echo "\t<th>".lang('func_name')."</th>\n";
		echo "\t<th class=\"padleft\">".lang('check_result')."</th>\n";
		echo "\t<th class=\"padleft\">".lang('suggestion')."</th>\n";
		echo "</tr>\n";
		echo $func_str;
		echo "</table>\n";


		show_next_step(2, $error_code);

		//show_footer();

	}

}
function show_msg($error_no, $error_msg = 'ok', $success = 1, $quit = TRUE) {
	if(VIEW_OFF) {
		$error_code = $success ? 0 : constant(strtoupper($error_no));
		$error_msg = empty($error_msg) ? $error_no : $error_msg;
		$error_msg = str_replace('"', '\"', $error_msg);
		$str = "<root>\n";
		$str .= "\t<error errorCode=\"$error_code\" errorMessage=\"$error_msg\" />\n";
		$str .= "</root>";
		echo $str;
		exit;
	} else {
		//show_header();
		global $step;

		$title = lang($error_no);
		$comment = lang($error_no.'_comment', false);
		$errormsg = '';

		if($error_msg) {
			if(!empty($error_msg)) {
				foreach ((array)$error_msg as $k => $v) {
					if(is_numeric($k)) {
						$comment .= "<li><em class=\"red\">".lang($v)."</em></li>";
					}
				}
			}
		}

		if($step > 0) {
			echo "<div class=\"desc\"><b>$title</b><ul>$comment</ul>";
		} else {
			echo "</div><div class=\"main\" style=\"margin-top: -123px;\"><b>$title</b><ul style=\"line-height: 200%; margin-left: 30px;\">$comment</ul>";
		}

		if($quit) {
			echo '<br /><span class="red">'.lang('error_quit_msg').'</span><br /><br /><br />';
		}

		echo '<input type="button" onclick="history.back()" value="'.lang('click_to_back').'" /><br /><br /><br />';

		echo '</div>';

		$quit;
	}
}
function runquery($sql) {
	global $lang, $db,$multitable;

	if(!isset($sql) || empty($sql)) return;

	$sql = str_replace("\r", "\n", $sql);
	$ret = array();
	$num = 0;
	foreach(explode(";\n", trim($sql)) as $query) {
		$ret[$num] = '';
		$queries = explode("\n", trim($query));
		foreach($queries as $query) {
			$ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
		}
		$num++;
	}
	unset($sql);

	foreach($ret as $query) {
		$query = trim($query);
		if($query) {

			if(substr($query, 0, 12) == 'CREATE TABLE') {
				if(false!==strpos($query,'__tblname__')){
					$prefixs = array('00');
					if($multitable>0) $prefixs = genPrefix();
					foreach ($prefixs as $v){
						$name = "user_".$v;
						$new_sql = str_replace("__tblname__",$name,$query);		
						showjsmessage(lang('create_table').' '.$name.' ... '.lang('succeed'));
						$db->query("DROP TABLE IF EXISTS `$name`;");
						$db->query(createtable($new_sql));
					}
				}else{
					$name = preg_replace("/CREATE TABLE IF NOT EXISTS ([`a-z0-9_]+) .*/is", "\\1", $query);
					showjsmessage(lang('create_table').' '.$name.' ... '.lang('succeed'));
					$db->query(createtable($query));
				}
			} else {
				$db->query($query);
			}

		}
	}

}
function genPrefix(){
		$str = '0123456789abcdef';
		$tbl_prefix = array();
		$len = strlen($str);
		for($i=0;$i<$len;$i++){
			for($j=0;$j<$len;$j++){
				$tbl_prefix[] = $str[$i].$str[$j];
			}
		}
		return $tbl_prefix;
}
function createtable($sql) {
	$type = strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU", "\\2", $sql));
	$type = in_array($type, array('MYISAM', 'HEAP')) ? $type : 'MYISAM';
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $sql).
	(mysql_get_server_info() > '4.1' ? " ENGINE=$type DEFAULT CHARSET=UTF8" : " TYPE=$type");
}
function showjsmessage($message) {
	if(VIEW_OFF) return;
	echo '<script type="text/javascript">showmessage(\''.addslashes($message).' \');</script>'."\r\n";
	flush();
	ob_flush();
}
function show_step($step) {

	global $method;

	$laststep = 4;

	$title = lang('step_'.$method.'_title');
	$comment = lang('step_'.$method.'_desc');

	$stepclass = array();
	for($i = 1; $i <= $laststep; $i++) {
		$stepclass[$i] = $i == $step ? 'current' : ($i < $step ? '' : 'unactivated');
	}
	$stepclass[$laststep] .= ' last';
    $cur = $step/$laststep * 500;
	echo <<<EOT

	<div class="setup">
		<h2>$step. $title</h2>
		<p>$comment</p>
	
	<table style="margin:10px 10px;width:500px" border="1"><tr><td>
	<table style="border:0"><tr><td style="width:{$cur}px;height:10px;" bgcolor="#ccc"></td></tr></table>
	</td></tr></table>
	</div>
EOT;

}
function show_license() {
	global $self, $uchidden, $step;
	$next = $step + 1;
	if(VIEW_OFF) {

		show_msg('license_contents', lang('license'), 1);

	} else {



		$license = str_replace('  ', '&nbsp; ', lang('license'));
		$lang_agreement_yes = lang('agreement_yes');
		$lang_agreement_no = lang('agreement_no');
		echo <<<EOT

<div class="main">
	<div class="licenseblock">$license</div>
	<div class="btnbox marginbot">
		<form method="get" action="index.php">
		<input type="hidden" name="step" value="$next">
		<input type="submit" name="submit" value="{$lang_agreement_yes}" style="padding: 2px">&nbsp;
		<input type="button" name="exit" value="{$lang_agreement_no}" style="padding: 2px" onclick="javascript: window.close(); return false;">
		</form>
	</div>
EOT;

	

	}
}
function set_params(){
	$error_msg = array();
	$submit = getgpc('submitname','p');
	if($submit){
		
		$ssomode = getgpc('ssomode','p');
		if(!$ssomode) $error_msg[] = lang('ssomode_invalid');
		$multitable = getgpc('multitable','p');
		$multitable = empty($multitable)?0:$multitable;
		$dbinfo = getgpc('dbinfo');
		$admininfo = getgpc('admininfo');
		if(!$dbinfo['dbhost']) $error_msg[] = lang('dbinfo_dbhost_invalid');
		if(!$dbinfo['dbname']) $error_msg[] = lang('dbinfo_dbname_invalid');
		if(!$dbinfo['dbuser']) $error_msg[] = lang('dbinfo_dbuser_invalid');

		if(!$admininfo['founderpw']) $error_msg[] = lang('admininfo_founderpw_invalid');
		if($admininfo['founderpw']!=$admininfo['founderpw2']) $error_msg[] = lang('admininfo_founderpw2_invalid');
		if(!$error_msg){
			$step = $step + 1;
			$dbname =$dbinfo['dbname'];
			if(!@mysql_connect($dbinfo['dbhost'], $dbinfo['dbuser'], $dbinfo['dbpw'])) {
				$errno = mysql_errno();
				$error = mysql_error();
				if($errno == 1045) {
					show_msg('database_errno_1045', $error, 0);
				} elseif($errno == 2003) {
					show_msg('database_errno_2003', $error, 0);
				} else {
					show_msg('database_connect_error', $error, 0);
				}
			}
			if(mysql_get_server_info() > '4.1') {
				mysql_query("CREATE DATABASE IF NOT EXISTS `$dbname` DEFAULT CHARACTER SET UTF8");
			} else {
				mysql_query("CREATE DATABASE IF NOT EXISTS `$dbname`");
			}

			if(mysql_errno()) {
				show_msg('database_errno_1044', mysql_error(), 0);
			}
			mysql_close();
			
			$_SESSION['sso_mode'] = $ssomode;
			$_SESSION['multitable'] = $multitable;
			$_SESSION['dbinfo'] = $dbinfo;
			$_SESSION['adminpwd'] = $admininfo['founderpw'];
			
			echo("<script language=\"JavaScript\" type=\"text/javascript\"> window.location.href = \"index.php?step=3\"; </script>");
			die;
			
		}else{
			show_msg('',$error_msg);
		}
		
	}
	
	
	
}
function getTblPrefix($user){
	$tb_prefix = '00';
	if(isset($multi_tbl) && $multi_tbl==true) $tb_prefix = substr(md5($user),0,2);
	return $tb_prefix;
}
function createNewUser($user) {
		global $db;
		$res = $db->query("insert into user_index (`user`) values ('{$user['user']}')");
		if(!$res) return false;

		$user_id = $db->insert_id();
		if(!$user_id) return false;
		
		$tb_prefix = getTblPrefix($user['user']);
	
		
		//user table
		$db->query ( "insert into user_$tb_prefix (user_id,user,user_password,user_email,user_nickname,user_sex,user_state,user_reg_time,user_reg_ip,user_lastlogin_time,user_lastlogin_ip,user_question,user_answer)
		values ('{$user_id}','{$user['user']}','" . $user ['user_password'] . "','{$user['user_email']}','{$user['user_nickname']}','{$user['user_sex']}',1,UNIX_TIMESTAMP(),'{$user['user_reg_ip']}',UNIX_TIMESTAMP(),'{$user['user_reg_ip']}','{$user['user_question']}','{$user['user_answer']}')" );
			
		return $user_id;
		

	}
function db_init(){
	global $sqlfile,$db,$multitable;;
	if(!isset($_SESSION['dbinfo'])) header("location: index.php?step=2");
	$dbname = $_SESSION['dbinfo']['dbname'];
	$dbinfo = $_SESSION['dbinfo'];
	$adminpwd = $_SESSION['adminpwd'];
	$multitable = $_SESSION['multitable'];
	$config = "<?php \r\ndefine('SSO_MODE', '{$_SESSION['sso_mode']}');\r\n";
	$config .= "define('MULTI_TABLE', '{$_SESSION['multitable']}');\r\n";
	$config .= '$GLOBALS ["gDataBase"] ["'.$dbname.'"] = array (
  "dbname" => "'.$dbname.'",
  "type" => "mysql",
  "host" => "'.$dbinfo['dbhost'].'",
  "port" => 3306,
  "user" => "'.$dbinfo['dbuser'].'",
  "passwd" => "'.$dbinfo['dbpw'].'",
  "charset"=> "utf8",
);
?>';
		$fp = fopen(CONFIG, 'w');
		fwrite($fp, $config);
		fclose($fp);

		$db = new dbstuff;
		$db->connect($dbinfo['dbhost'], $dbinfo['dbuser'], $dbinfo['dbpw'], $dbname, 'UTF8');

		$sql = file_get_contents($sqlfile);
		$sql = str_replace("\r\n", "\n", $sql);

		if(!VIEW_OFF) {			
			show_install();
		}

		runquery($sql);
		
		$user['user'] = 'admin';
		$user['user_email'] = '';
		$user['user_question'] = '';
		$user['user_answer'] = '';
		$user['user_password'] = md5(md5($adminpwd).$user['user']);
		$user['user_nickname'] = 'administrator';
		$user['user_sex'] = 1;
		$user['user_reg_ip'] = '127.0.0.1';
		createNewUser($user);
		
		VIEW_OFF && show_msg('initdbresult_succ');

		if(!VIEW_OFF) {
			echo '<script type="text/javascript">document.getElementById("laststep").disabled=false;document.getElementById("laststep").value = \''.lang('install_succeed').'\';</script>'."\r\n";
			
		}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Xppass <?=lang('install_wizard')?></title>

<LINK href="/install/style.css" type=text/css rel=stylesheet>

</head>
<body>
<div id="header">
<img src="/public/images/xppass.png"><span style="font-size:16px"><b><?=lang('install_wizard')?></b></span> 

</div>

<?php
$step = intval(getgpc('step', 'R')) ? intval(getgpc('step', 'R')) : 0;
$method = getgpc('method');

if(empty($method) || !in_array($method, $allow_method)) {
	$method = isset($allow_method[$step]) ? $allow_method[$step] : '';
}

if(empty($method)) {
	show_msg('method_undefined', $method, 0);
}

$step > 0 && show_step($step);
?>

<?php


switch ($step){
	case 0:
		show_license();
		break;
	case 1:
		dirfile_check($dirfile_items);
		env_check($env_items);
		function_check($func_items);
		show_env_result($env_items, $dirfile_items, $func_items);
		
		break;
	case 2:		
		set_params();
		break;
	case 3:
		db_init();
		break;
	case 4:
		ok();
	
}


?>

<?php if($step==2){?>
<form action="index.php" method="POST">
<input type="hidden" name="step" value="<?=$step?>">
<div class="desc"><b>系统选项</b></div>

<table class="tb2">
	<tr>
		<th class="tbopt">
		<?=lang('sso_mode')?>:
		</th>
		<td>
		<label><input type="radio" name="ssomode" value="cookie"> Cookie</label>
		<label><input type="radio" name="ssomode" value="session"> Session</label>
		<label><input type="radio" name="ssomode" value="ticket"> Ticket</label>
		</td>
		<td>
		<?=lang('ssomode_label')?>
		</td>
	</tr>
	<tr>
		<th class="tbopt">
		<?=lang('multitable')?>:
		</th>
		<td>
		<label><input type="checkbox" name="multitable" value="1"> </label>
		</td>
		<td>
		<?=lang('multitable_label')?>
		</td>
	</tr>
</table>
<table class="tb2">
<input type="hidden" name="step" value="2">
<div class="desc"><b><?=lang('tips_dbinfo')?></b></div>
<tr><th class="tbopt">&nbsp;<?=lang('dbhost')?>:</th>
<td><input type="text" name="dbinfo[dbhost]" value="localhost" size="35" class="txt"></td>
<td>&nbsp;<?=lang('dbhost_comment')?></td>
</tr>

<tr><th class="tbopt">&nbsp;<?=lang('dbname')?>:</th>
<td><input type="text" name="dbinfo[dbname]" value="xppass" size="35" class="txt"></td>
<td>&nbsp;</td>
</tr>

<tr><th class="tbopt">&nbsp;<?=lang('dbuser')?>:</th>
<td><input type="text" name="dbinfo[dbuser]" value="root" size="35" class="txt"></td>
<td>&nbsp;</td>
</tr>

<tr><th class="tbopt">&nbsp;<?=lang('dbpw')?>:</th>
<td><input type="password" name="dbinfo[dbpw]" value="" size="35" class="txt"></td>
<td>&nbsp;</td>
</tr>

</tr>
</table>
<div class="desc"><b><?=lang('tips_admininfo')?></b></div>
<table class="tb2">
<tr><th class="tbopt">&nbsp;<?=lang('founderpw')?>:</th>
<td><input type="password" name="admininfo[founderpw]" value="" size="35" class="txt"></td>
<td>&nbsp;</td>
</tr>

<tr><th class="tbopt">&nbsp;<?=lang('founderpw2')?>:</th>
<td><input type="password" name="admininfo[founderpw2]" value="" size="35" class="txt"></td>
<td>&nbsp;</td>
</tr>

<tr><th class="tbopt">&nbsp;</th>
<td><input type="submit" name="submitname" value="<?=lang('new_step')?>" class="btn">
</td>
<td>&nbsp;</td>
</tr>
</table>
</form>
<? }?>
<?php
function show_install() {
	if(VIEW_OFF) return;
?>
<script type="text/javascript">
function showmessage(message) {
	document.getElementById('notice').value += message + "\r\n";
}
function initinput() {
	window.location='<?php echo 'index.php?step='.($GLOBALS['step']);?>';
}
</script>
	<div class="main">
		<div class="btnbox"><textarea name="notice" style="width: 80%;"  readonly="readonly" id="notice"></textarea></div>
		<div class="btnbox marginbot">
	<input type="button" name="submit" value="<?=lang('install_in_processed')?>" disabled style="height: 25" id="laststep" onclick="initinput()">
	</div>
<?php
}?>
<p>&nbsp;</p>
<div id="footer">Powered by <a href="http://kfl.googlecode.com" target="_blank">KFL Framework</a> <br>Since 2009.10</div>
</body>
</html>