<?php

/*************/
/* KFL entrance
/* portal of the application
/*
/*************/
define("APP_DIR", dirname(__FILE__));
if (!file_exists(APP_DIR."/tmp/install.lock")) {
	header("location: install/index.php");
}
include_once (APP_DIR. "/config/config.ini.php");
include_once (KFL_DIR . "/KFL.php");
$kfl = new KFL ( );
$kfl->setDefController ( 'index' );
$kfl->setDefView ( 'admin' );
$kfl->run ();
?>