<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
@set_time_limit(1000);
set_magic_quotes_runtime(0);
define('LANG', 'zh-cn');
define('ROOT_PATH', dirname(__FILE__).'/');
define('CONFIG', ROOT_PATH.'/config/config.ini.php');
$view_off  = isset($_POST['view_off'])?$_POST['view_off']:'';
define('VIEW_OFF', $view_off ? TRUE : FALSE);
include_once(ROOT_PATH.'/langs/'.LANG.'/globals.php');
$sqlfile = ROOT_PATH.'./xppass.sql';

$allow_method = array('show_license', 'env_check', 'set_params', 'db_init', 'ext_info', 'install_check', 'tablepre_check');

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
$form_app_reg_items = array
(
	'siteinfo' => array
	(
		'sitename' => array('type' => 'text', 'required' => 1, 'reg' => '/^.*$/', 'value' => array('type' => 'constant', 'var' => 'SOFT_NAME')),
		'siteurl' => array('type' => 'text', 'required' => 1, 'reg' => '/^https?:\/\//', 'value' => array('type' => 'var', 'var' => 'default_appurl'))
	)
);



function show_setting($setname, $varname = '', $value = '', $type = 'text|password|checkbox', $error = '') {
	if($setname == 'start') {
		echo "<form method=\"post\" action=\"install.php\">\n";
		return;
	} elseif($setname == 'end') {
		echo "\n</table>\n</form>\n";
		return;
	} elseif($setname == 'hidden') {
		echo "<input type=\"hidden\" name=\"$varname\" value=\"$value\">\n";
		return;
	}

	echo "\n".'<tr><th class="tbopt'.($error ? ' red' : '').'">&nbsp;'.(empty($setname) ? '' : lang($setname).':')."</th>\n<td>";
	if($type == 'text' || $type == 'password') {
		$value = htmlspecialchars($value);
		echo "<input type=\"$type\" name=\"$varname\" value=\"$value\" size=\"35\" class=\"txt\">";
	} elseif($type == 'submit') {
		$value = empty($value) ? 'next_step' : $value;
		echo "<input type=\"submit\" name=\"$varname\" value=\"".lang($value)."\" class=\"btn\">\n";
	} elseif($type == 'checkbox') {
		if(!is_array($varname) && !is_array($value)) {
			echo'<label><input type="checkbox" name="'.$varname.'" value="'.$value."\" style=\"border: 0\">".lang($setname.'_check_label')."</label>\n";
		}
	} else {
		echo $value;
	}

	echo "</td>\n<td>&nbsp;";
	if($error) {
		$comment = '<span class="red">'.(is_string($error) ? lang($error) : lang($setname.'_error')).'</span>';
	} else {
		$comment = lang($setname.'_comment', false);
	}
	echo "$comment</td>\n</tr>\n";
	return true;
}
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
	
	echo "<form action=\"install.php\" method=\"post\">\n";
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
function show_step($step) {

	global $method;

	$laststep = 5;

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
		<form method="get" action="install.php">
		<input type="hidden" name="step" value="$next">
		<input type="submit" name="submit" value="{$lang_agreement_yes}" style="padding: 2px">&nbsp;
		<input type="button" name="exit" value="{$lang_agreement_no}" style="padding: 2px" onclick="javascript: window.close(); return false;">
		</form>
	</div>
EOT;

	

	}
}
function set_params(){
	global $form_app_reg_items;
	$submit = true;
	$error_msg = array();
	$PHP_SELF = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	$bbserver = 'http://'.preg_replace("/\:\d+/", '', $_SERVER['HTTP_HOST']).($_SERVER['SERVER_PORT'] && $_SERVER['SERVER_PORT'] != 80 ? ':'.$_SERVER['SERVER_PORT'] : '');
	$default_appurl = $bbserver.substr($PHP_SELF, 0, strpos($PHP_SELF, 'install/') - 1);
	if(isset($form_app_reg_items) && is_array($form_app_reg_items)) {
		foreach($form_app_reg_items as $key => $items) {
			$$key = getgpc($key, 'p');
			if(!isset($$key) || !is_array($$key)) {
				$submit = false;
				break;
			}
			foreach($items as $k => $v) {
				$tmp = $$key;
				$$k = $tmp[$k];
				if(empty($$k) || !preg_match($v['reg'], $$k)) {
					if(empty($$k) && !$v['required']) {
						continue;
					}
					$submit = false;
					VIEW_OFF or $error_msg[$key][$k] = 1;
				}
			}
		}
	} else {
		$submit = false;
	}

	show_form($form_app_reg_items, $error_msg);
}

function show_form(&$form_items, $error_msg) {

	global $step, $uchidden;

	if(empty($form_items) || !is_array($form_items)) {
		return;
	}

	
	show_setting('start');
	show_setting('hidden', 'step', $step);
	$is_first = 1;
	if(!empty($uchidden)) {
		$uc_info_transfer = unserialize(urldecode($uchidden));
	}
	foreach($form_items as $key => $items) {
		global ${'error_'.$key};
		if($is_first == 0) {
			echo '</table>';
		}

		if(!${'error_'.$key}) {
			show_tips('tips_'.$key);
		} else {
			show_error('tips_admin_config', ${'error_'.$key});
		}

		echo '<table class="tb2">';

		foreach($items as $k => $v) {
			global $$k;
			if(!empty($error_msg)) {
				$value = isset($_POST[$key][$k]) ? $_POST[$key][$k] : '';
			} else {
				if(isset($v['value']) && is_array($v['value'])) {
					if($v['value']['type'] == 'constant') {
						$value = defined($v['value']['var']) ? constant($v['value']['var']) : '';
					} else {
						$value = $GLOBALS[$v['value']['var']];
					}
				} else {
					$value = '';
				}
			}
			if($v['type'] == 'checkbox') {
				$value = '1';
			}

			if($k == 'ucurl' && isset($uc_info_transfer['ucapi'])) {
				$value = $uc_info_transfer['ucapi'];
			} elseif($k == 'ucpw' && isset($uc_info_transfer['ucfounderpw'])) {
				$value = $uc_info_transfer['ucfounderpw'];
			}

			show_setting($k, $key.'['.$k.']', $value, $v['type'], isset($error_msg[$key][$k]) ? $key.'_'.$k.'_invalid' : '');
		}

		if($is_first) {
			$is_first = 0;
		}
	}
	show_setting('', 'submitname', 'new_step', 'submit');
	show_setting('end');
	
}
function show_tips($tip, $title = '', $comment = '', $style = 1) {
	global $lang;
	$title = empty($title) ? lang($tip) : $title;
	$comment = empty($comment) ? lang($tip.'_comment', FALSE) : $comment;
	if($style) {
		echo "<div class=\"desc\"><b>$title</b>";
	} else {
		echo "</div><div class=\"main\" style=\"margin-top: -123px;\">$title<div class=\"desc1 marginbot\"><ul>";
	}
	$comment && print('<br>'.$comment);
	echo "</div>";
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
		addadmin();
		break;
	case 5:
		ok();
	
}


?>
<form action="install.php" method="POST">
<table>
	<tr>
		<td>
		
		</td>
	</tr>
</table>
</form>

<p>&nbsp;</p>
<div id="footer">Powered by <a href="http://kfl.googlecode.com" target="_blank">KFL Framework</a> <br>Since 2009.10</div>
</body>
</html>