<?php
class ClientModel extends Model {
	function __construct(){
		$this->db = parent::dbConnect($GLOBALS ["gDataBase"] ["db"]);
	}
	function getItems($con,$pageCount){
		$select =$this->db->select();
		$select->from ( " client ","*");
		
		//
		if(isset($con['order'])) $select->order ( $con['order']." desc" );
		if(isset($con['domain']) && !empty($con['domain'])) $select->where ( " domain like '%".$con['domain']."%'" );
		
		$list = array();
		$offset = '';
		
		$total = $select->count (); 
		include_once("Pager.class.php");
	    $list ['page'] = new Pager ( $total, $pageCount ); 
		$offset = $list ['page']->offset ();               
		//$pagerStyle = array ('firstPage' => '', 'prePage' => 'gray4_12b none', 'nextPage' => 'gray4_12b none', 'totalPage' => '', 'numBar' => 'yellowf3_12b none', 'numBarMain' => 'gray4_12 none' ); 
		//$list ['page']->setLinkStyle ( $pagerStyle );
		//$list ['page']->setLinkScript("gotopage(@PAGE@)");
		$label = array('first_page'=>lang('first_page'),'last_page'=>lang('last_page'),'next_page'=>lang('next_page'),'pre_page'=>lang('pre_page'),'next_group'=>lang('next_group'),'pre_group'=>lang('pre_group'));	
		$list ['page']->setLabelName($label);
		$list ['page_array'] ['pagebar'] = $list ['page']->wholeNumBar();
		
		$select->limit ( $list['page']->offset(), $pageCount );
		$rs = $select->query();
	
		if ($rs) {
			foreach ( $rs as $key => $record ) {
				$list ['records'] [$key] = $record;
			}
		}
		return (array) $list;
	}
	
	public function generateKey(){
		$tmp = array_merge(range(0, 9), range('A', 'Z'));
	    $key = '';
	    for ($i = 0; $i < 16; $i++) {
	        $key .= $tmp[mt_rand(0, 35)];
	    }
	    return md5($key);    
	}
	
	public function addNewClient($arr){
		$sql = "insert into `client` (`domain`, `private_key`) values (?,?)";
		return $this->db->execute($sql,array($arr['domain'],$arr['key']));
	}
	
	public function getClientByName($domain){
		return $this->db->getRow("select * from client where domain='{$domain}'");
	}
	public function deleteClient($client_id){
		$sql = "delete from client where client_id=?";
		return $this->db->execute($sql,array($client_id));
	}
}

?>