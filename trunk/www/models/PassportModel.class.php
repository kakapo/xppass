<?php
class PassportModel extends Model {
	public function __construct(){
		$this->db = parent::dbConnect($GLOBALS ["gDataBase"] ["db"]);
	}
	static public function encryptpwd($pwd,$user,$pwd_had_md5=0){
		if($pwd_had_md5) 
			return md5($pwd.$user);
		else
			return md5(md5($pwd).$user);
	}
	/**
	 *  获取所有禁词
	 * @access public
	 * @return array
	 **/
	private function _getBlockword() {
		$allblockwords = array ();
		
		$sql = "select v from setting where k='banusername'";
		$result = $this->db->getOne ( $sql,'', 3600 ,'banusername');
		$arr = explode ( "\n", $result );
		foreach ( $arr as $row ) {
			$allblockwords [] = trim($row);
		}		
		
		$sql = "select v From setting where k='banemail'";
		$result = $this->db->getOne ( $sql,'', 3600 ,'banemail');
		$arr = explode ( "\n", $result );
		foreach ( $arr as $row ) {
			$allblockwords [] = trim($row);
		}
		return $allblockwords;
	}

	private function _getTblPrefix($user){
		$tb_prefix = '';
		if(MULTI_TABLE==1) $tb_prefix = "_".substr(md5($user),0,2);
		return $tb_prefix;
	}

	public function checkUser($user) {	
		return $this->db->getOne ( "select user_id from user_index where user = '{$user}'" );
	}	
	
	public function checkNickname($nickname) {	
		$sql = "select v from setting where k='doublenick'";
		$result = $this->db->getOne ( $sql,'', 3600 ,'doublenick');
		if($result){
			return $this->db->getOne ( "select user_id from user_index where user_nickname = '{$nickname}'" );
		}else{
			return 0;
		}
	}

	public function updateUser($item,$user_id,$user){
		$tb_prefix = $this->_getTblPrefix($user);	
		if(isset($item['user_nickname']) && !empty($item['user_nickname'])) $this->db->execute("update user_index set user_nickname=? where user_id=?",array($item['user_nickname'],$user_id));
		$this->db->update($item,"user".$tb_prefix," user_id=".$user_id);
	}
	
	public function getUserById($user_id,$user){
		$tb_prefix = $this->_getTblPrefix($user);
		
		return $this->db->getRow("select * from user$tb_prefix where user_id='$user_id'");
	}
	public function getUser($user){
		return $this->db->getRow("select * from user_index where user='$user'");
	}
	
	/**
	 *  判断是否为禁词
	 * @param string $newword
	 * @access public
	 * @return boolen
	 **/
	public function isBlockword($newword) {
		$allblockwords = $this->_getBlockword ();
		$n = 0;
		for($i = 0, $c = count ( $allblockwords ); $i < $c; $i ++) {
			//如果有*号表示要匹配查询
			if (empty ( $allblockwords [$i] ))
				break;
			$res = strpos ( $allblockwords [$i], "*" );
			$res1 = strpos ( $allblockwords [$i], "@" );
			if ($res !== false) {
				//$res = strripos($newword, $blockword);
				$blockword = str_replace ( "*", "(.*?)", $allblockwords [$i] );
				$pattern = "/^" . $blockword . "/i";

				if (preg_match ( $pattern, $newword )) {
					$n ++;
				}
			}elseif($res1 !== false){
				
				if (false!==strpos (  $newword ,$allblockwords [$i])) {
					$n ++;
				}
				
			} else {
				if ($newword == $allblockwords [$i]) {
					$n ++;
				}
			}
		}
		
		if ($n > 0)
			return true;
		else
			return false;
	}
	/**
	 * 注册新用户
	 *@param array $user
	 *@return boolen
	 */
	public function createNewUser($user) {
	
		$res = $this->db->execute("insert into user_index (`user`,`user_nickname`,`user_reg_time`) values ('{$user['user']}','{$user['user_nickname']}',UNIX_TIMESTAMP())");
		if(!$res) return false;

		$user_id = $this->db->getOne("select last_insert_id() from user_index");
		if(!$user_id) return false;
		
		$tb_prefix = $this->_getTblPrefix($user['user']);
	
		
		//user table
		$this->db->execute ( "insert into user$tb_prefix (user_id,user,user_password,user_email,user_nickname,user_sex,user_state,user_reg_time,user_reg_ip,user_lastlogin_time,user_lastlogin_ip,user_question,user_answer)
		values ('{$user_id}','{$user['user']}','" . $user ['user_password'] . "','{$user['user_email']}','{$user['user_nickname']}','{$user['user_sex']}',1,UNIX_TIMESTAMP(),'{$user['user_reg_ip']}',UNIX_TIMESTAMP(),'{$user['user_reg_ip']}','{$user['user_question']}','{$user['user_answer']}')" );
			
		return $user_id;
		

	}
	
	public function deleteUser($user){		
		$u = $this->getUser($user);
		if($u['user_id']==1) return false;
		if($u){
			$tb_prefix = $this->_getTblPrefix($user);
			
			$res = $this->db->execute("delete from user_index where user_id='{$u['user_id']}'");
			
			if($res) {
				return $this->db->execute("delete from user$tb_prefix where user_id='{$u['user_id']}'");
			}
		}
		return false;
		
		
	}
	public function addForgetPwd($user) {

		$validSec = 3600;
		
		$sql = "SELECT count(*) FROM `forget_pwd`  WHERE  `user` = '$user'  AND state=1 AND (UNIX_TIMESTAMP()-`start_ts`)< $validSec ";
		$count = $this->db->getOne ( $sql );
		if ($count > 1) {
			return 5; //
		}
		//将未及时重置密码的请求改为无效状态
		$sql = "delete from `forget_pwd`  WHERE  `user` ='$user' and `state`=0 ";
		$this->db->execute ( $sql );

		$code = md5(microtime().$user);
		$sql = "INSERT INTO `forget_pwd` ( `user` , `start_ts` , `code` , `state`  )
								VALUES (  '$user', UNIX_TIMESTAMP(), '$code', '1' );";

		if (false==$this->db->execute ( $sql )) {
			return 2;
		} else {
			return $code;
		}

	}

	/**
	 * 检查忘记密码是否存在于用户
	 *
	 * @param string $code
	 * @param string $username
	 * @return array
	 */
	public function checkForget($code) {
		if (empty ( $code ) ) {
			return 0;
		}
		$validSec = 3600;
		
		$sql = "SELECT * FROM `forget_pwd`  WHERE `code` = '$code' AND state=1 AND (UNIX_TIMESTAMP()-`start_ts`)< $validSec ";
		return $this->db->getRow ( $sql );

	}
	public function updatePassByUser($user,$pwd){
		$tb_prefix = $this->_getTblPrefix($user);
		$sql = "Update  `user$tb_prefix` set user_password='$pwd' WHERE user='$user' ";
		
		return $this->db->execute ( $sql );
	}
	public function updateForgetPwd($user){	
		$sq1 = "UPDATE `forget_pwd` SET state=0 WHERE user='$user'";
		$this->db->execute ( $sq1 );
	}

	//about ticket
	public function addTicket($arr){		
		return $this->db->execute("replace into onlineuser (`ticket`,`user`,`data`,`expiry`) values (?,?,?,(UNIX_TIMESTAMP()+1440))",array($arr['ticket'],$arr['user'],$arr['data']));
	}
	public function deleteExpiryTicket(){
		$this->db->execute("delete from onlineuser where expiry<UNIX_TIMESTAMP()");	
       	$this->db->execute('OPTIMIZE TABLE onlineuser');
	}
	public function deleteTicketById($ticket){
		return $this->db->execute("delete from onlineuser where ticket='$ticket'");
	}
	public function getTicketByUser($user){
//		/echo "select ticket from onlineuser where user='$user' and expiry>UNIX_TIMESTAMP()";
		return $this->db->getOne("select ticket from onlineuser where user='$user' and expiry>UNIX_TIMESTAMP()");
	}
	public function getDataByTicket($ticket){
		return $this->db->getOne("select data from onlineuser where ticket='$ticket' and expiry>UNIX_TIMESTAMP()");
	}	
	public static function packTicket($ticket,$user){
		$t = $ticket.md5($ticket.$user).uniqid();
		$t .= md5($t);
		return $t;
	}
}
?>