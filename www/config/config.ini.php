<?php
	if(file_exists(dirname(__FILE__).'/install.ini.php')) include_once('install.ini.php'); else header("location: install/index.php");
//////////////////////////////////////////////////////
//					Application	Settings			//
//////////////////////////////////////////////////////
	define("APP_STATUS", "dev");
	define("APP_LANG", "zh-cn");
	define("KFL_DIR", APP_DIR."/../KFL");
	define("APP_TEMP_DIR", APP_DIR."/tmp/");

	
//////////////////////////////////////////////////////
//				Website Settings	                //
//////////////////////////////////////////////////////
		
	$GLOBALS ["gSiteInfo"] ["web_charset"] =  "UTF-8";
	$GLOBALS ["gSiteInfo"] ["web_keyword"] =  "Xppass";
	$GLOBALS ["gSiteInfo"] ["web_description"] =  "PHP开源 SSO系统--Xppass";
	$GLOBALS ["gSiteInfo"] ["web_title"] =  "欢迎使用&quot;Xppass&quot;单点登录系统";
	
//////////////////////////////////////////////////////
//				Email   Settings	                //
//////////////////////////////////////////////////////		
		
	$GLOBALS ["gEmail"] ["smtp_host"] =  "smtp.163.com";
	$GLOBALS ["gEmail"] ["smtp_port"] =  "25";
	$GLOBALS ["gEmail"] ["smtp_account"] =  "xppass@163.com";
	$GLOBALS ["gEmail"] ["smtp_pass"] =  "111111";
	$GLOBALS ["gEmail"] ["smtp_from"] =  "xppass@163.com";
	$GLOBALS ["gEmail"] ["pop3_host"] =  "pop3.163.com";
	
//////////////////////////////////////////////////////
//				TimeZone   Settings	                //
//////////////////////////////////////////////////////		
		
	date_default_timezone_set("Asia/Shanghai");
	
//////////////////////////////////////////////////////
//				Log   Settings	                //
//////////////////////////////////////////////////////		
		
	$GLOBALS ["gLog"] ["sendemail"] =  "1";
	$GLOBALS ["gLog"] ["subject"] =  "应用错误报告";
	$GLOBALS ["gLog"] ["receiver"] =  "kakapowu@gmail.com";
	$GLOBALS ["gLog"] ["maxExecTime"] =  "2";
	$GLOBALS ["gLog"] ["maxMemUsed"] =  "1048576";
		
//////////////////////////////////////////////////////
//				Session   Settings	                //
//////////////////////////////////////////////////////		
		
	$GLOBALS ["gSession"] ["sessionHandle"] =  "file"; // file or database or memcache
	$GLOBALS ["gSession"] ["lifeTime"] =  1440;
	//if use database, uncomment this
	//$GLOBALS ["gSession"] ["database"] =  $GLOBALS ["gDataBase"]["db_setting.db3"];
	// if use memcache, uncomment this
	//$GLOBALS ["gSession"] ["memcached"] =  array($GLOBALS ["gMemcacheServer"]["192.168.1.5:11212"],$GLOBALS ["gMemcacheServer"]["192.168.1.5:11213"]);;
	

//////////////////////////////////////////////////////
//				Memcached  Settings	                //
//////////////////////////////////////////////////////		
		
	$GLOBALS ["gMemcacheServer"] ["192.168.1.5:11212"] = array (
  'mmhost' => '192.168.1.5',
  'mmport' => '11212',
);
	$GLOBALS ["gMemcacheServer"] ["192.168.1.5:11211"] = array (
  'mmhost' => '192.168.1.5',
  'mmport' => '11211',
);
	$GLOBALS ["gMemcacheServer"] ["192.168.1.5:11213"] = array (
  'mmhost' => '192.168.1.5',
  'mmport' => '11213',
);
	
//////////////////////////////////////////////////////
//				Packet   Settings	                //
//////////////////////////////////////////////////////		
		
	$GLOBALS ["gPacket"] ["cacheOpen"] =  1;
	$GLOBALS ["gPacket"] ["cacheStore"] =  "file"; // file or memcache
	$GLOBALS ["gPacket"] ["cacheTime"] =  3600;
	$GLOBALS ["gPacket"] ["cacheDir"] =  APP_TEMP_DIR;
	// if use memcache, uncomment this
	//$GLOBALS ["gPacket"] ["cacheServer"] =  array($GLOBALS ["gMemcacheServer"]["192.168.1.5:11213"]);
	
//////////////////////////////////////////////////////
//				PageCache  Settings	                //
//////////////////////////////////////////////////////		
		
	$GLOBALS ["gPageCache"] ["index"] ["rulename"]=  "index";
	$GLOBALS ["gPageCache"] ["index"] ["cachestore"]=  "file"; // file or memcache
	$GLOBALS ["gPageCache"] ["index"] ["cachedir"]=  APP_TEMP_DIR;
	$GLOBALS ["gPageCache"] ["index"] ["cachetime"]=  60;
	$GLOBALS ["gPageCache"] ["index"] ["compressed"]=  1;
	$GLOBALS ["gPageCache"] ["index"] ["action"]=  "index";
	$GLOBALS ["gPageCache"] ["index"] ["view"]=  "help";
	// if use memcache, uncomment this
	//$GLOBALS ["gPageCache"] ["index"] ["cacheserver"]=  array($GLOBALS ["gMemcacheServer"]["192.168.1.5:11211"]);;
	
	$GLOBALS ["gDataBase"] ["db_setting.db3"] = array (
	  "dbname" => "setting.sqlite",
	  "path"=>APP_DIR."/config/Admin/config",
	  "type" => "sqlite"
	);
?>