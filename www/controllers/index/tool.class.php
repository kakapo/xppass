<?php
include("ToolModel.class.php");
class tool {
	function view_createtbls(){
		
		$ToolModel = new ToolModel();
		$ToolModel->createTbl(1);
		
	}
	
	function view_createclient(){
		
		$arr['domain'] = $_GET['domain'];
		
		$ToolModel = new ToolModel();
		
		$arr['key'] = $ToolModel->generateKey();
		
		$ToolModel->addNewClient($arr);
	}
	
	
}
?>