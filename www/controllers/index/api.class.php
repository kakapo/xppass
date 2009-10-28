<?php
class api{
	private $_private_key;
	public function view_defaults(){
			
		$user = authenticate();
		print_r($user);
	
	}
	private function _createSign($text,$key)
	{	
		return hmac($key,$text,'sha1');
	}
	private function _verifySign($domain,$text,$sign){
		include_once(KFL_DIR.'/Libs/Cache.class.php');
		 $filename = $domain.".txt";
		 $cache = new Cache(86400*300,0); 
		 $cache->setCacheStore("file");// or memcache
		 $cache->setCacheDir(APP_TEMP_DIR);
		 $cache->setCacheFile($filename);
		 if($cache->isCached()){
		 	$client = unserialize($cache->fetch());
		 }else{
		 	require_once 'ClientModel.class.php';		
			$ClientModel = new ClientModel();
			$client = $ClientModel->getClientByName($domain);
			if($client){
		 		$cache->save(serialize($client));
			}else{
				return false;
			}
		 }
		
		$this->_private_key = $client['private_key'];
		if (hmac($this->_private_key,$text,'sha1')==$sign) {
			return true;	  
		}else{
			return false;
		}
	}
	private function _packTicket($ticket,$user){
		$t = $ticket.md5($ticket.$user).uniqid();
		$t .= md5($t);
		return $t;
	}
	private function _verifyTicket($ticket){
		$body = substr($ticket,0,-32);
		$checksum = substr($ticket,-32,32);
		if($checksum==md5($body)) 
			return true;
		else  
			return false;
	}
	private function _unpackTicket($ticket){
		return substr($ticket,0,32);
	}
	private function _encryptToken($data){
		return encrypt($data,$this->_private_key);
	}
	
	public function view_islogin(){
		$user = !empty($_GET['user'])?$_GET['user']:'';
		$sign = $_GET['sign'];
		$domain = $_GET['domain'];
		$redirect = isset($_GET['redirect'])?$_GET['redirect']:0;
		$return = isset($_GET['return'])?urldecode($_GET['return']):'';
		
		if($redirect){
			if($this->_verifySign($domain,md5($user.$domain),$sign)){
				$userinfo = authenticate();				
				if($userinfo){
					if(strpos($return,'?')!==false) {
						$return .= '&ticket='.$this->_packTicket($userinfo['ticket'],$user);
					}else{
						$return .= '?ticket='.$this->_packTicket($userinfo['ticket'],$user);
					}
					//echo $return;die;
					header("Location:".$return);
				}else{
					header("Location:".$GLOBALS ["gSiteInfo"]['www_site_url']."/index.php?action=passport&view=login&forward=".urlencode($return));
				}
				
			}else{
				die("Signature Invalid!");
			}
			
		}else{
						
			if($this->_verifySign($domain,md5($user.$domain),$sign)){	
				require_once 'PassportModel.class.php';
				$pass = new PassportModel();
				$ticket = $pass->getTicketByUser($user);
				
				if($ticket){
					$msg['s'] = 200; 
				    $msg['m'] = "success!"; 
				    $msg['d'] = $this->_packTicket($ticket,$user); 
				}else{
					 $msg['s'] = 300; 
					 $msg['m'] = "Not Login!"; 
			   		 $msg['d'] = $GLOBALS ["gSiteInfo"]['www_site_url']."/index.php?action=passport&view=login"; 
				}
				
			}else{
			   $msg['s'] = 400; 
			   $msg['m'] = "Signature Invalid!"; 
			   $msg['d'] = ''; 
			}
					
			json_output($msg);
		}
		
	}	
	public function view_getuser(){
		
		$ticket = 	$_GET['ticket'];
		$sign = $_GET['sign'];
		$domain = $_GET['domain'];
		$data = '';
		if($this->_verifySign($domain,md5($ticket.$domain),$sign)){
			
			if($this->_verifyTicket($_GET['ticket'])){
				$ticket = $this->_unpackTicket($_GET['ticket']);	
				require_once 'PassportModel.class.php';
				$pass = new PassportModel();
				$data = $pass->getDataByTicket($ticket);
			}
			
		
			if($data){
				$msg['s'] = 200; 
			    $msg['m'] = "success!"; 
			    $msg['d'] = $this->_encryptToken($data); 
			}else{
				$msg['s'] = 300; 
				$msg['m'] = "Please  Relogin!"; 
		   		$msg['d'] = $GLOBALS ["gSiteInfo"]['www_site_url']."/index.php?action=passport&view=login";
			}
			
		}else{
		   $msg['s'] = 400; 
		   $msg['m'] = "Signature Invalid!".$ticket; 
		   $msg['d'] = ''; 
		}
		
		json_output($msg);
	}
}

?>