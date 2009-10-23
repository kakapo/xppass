<?php
class SettingModel extends Model {
	function __construct(){
		$this->db = parent::dbConnect($GLOBALS ["gDataBase"] ["db"]);
	}
	function getAllSettings(){
		return $this->db->getAll("select k,v from setting");
	}
	function updateSettings($sets){
		$res= true;
		foreach ($sets as $k=>$v){
			$r = $this->db->execute("delete from setting where k='$k'");
			if($r) $res *= $this->db->execute("insert into setting (k,v) values ('{$k}','$v')");
		}
		
		return $res;
	}
	function clearCache(){
		$this->db->cleanCache('banusername');
		$this->db->cleanCache('banemail');
		$this->db->cleanCache('doublenick');
	}
}

?>