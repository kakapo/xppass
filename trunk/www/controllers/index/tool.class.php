<?php
include("ToolModel.class.php");
class tool {
	function view_createtbls(){
		
		$ToolModel = new ToolModel();
		$ToolModel->createTbl(1);
		
	}
	
}
?>