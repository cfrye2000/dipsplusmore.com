<?php
/*
 * Created on Dec 28, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require_once(dirname(__FILE__). '/../couchdb/CouchDB.class.php');
 require_once(dirname(__FILE__). '/../couchdb/CouchDBException.class.php');
 require_once(dirname(__FILE__). '/../couchdb/CouchDBRequest.class.php');
 require_once(dirname(__FILE__). '/../couchdb/CouchDBResponse.class.php');
 
 require_once(dirname(__FILE__). '/../config.php');
 
 class SessionFactory {
 	
 	public function isLoggedIn(){
		session_start();
		if (isset($_SESSION['user'])){
			return true;
		}
		return false;
	}
	
	public function logout(){
		//ajax handler
		
		session_start();

		unset($_SESSION['user']);
	}
	
	public function isLoggedInAs($user){
		session_start();
		if (isset($_SESSION['user']) && $_SESSION['user'] == $user){
			return true;
		}
		return false;
	}
	
	public function isLoggedInAsAdmin(){
		session_start();
		if (isset($_SESSION['user']) && $_SESSION['user'] == Config::$CONFIG_ADMINUSERNAME){
			return true;
		}
		return false;
	}
	
	public function login($userid, $password){
		//ajax handler
		
		session_start();
	
	
		if ($userid == null){
			return false;
		} else {
			$user = $this->getUser($userid);
			if ($user != null &&
				$user->userid == $userid &&
			    $user->password == $password) {
			    $_SESSION['user'] = $user->_id;
				return true;
			} else {
				return $this->adminLogin($userid, $password);				
			}
		}		
	}
	public function adminLogin($userid, $password){
		//ajax handler
		
		session_start();
		
		$values = $_POST;
	
	
		if ($userid == null){
			return false;
		} else {
			if ($userid == Config::$CONFIG_ADMINUSERNAME &&
			    $password == Config::$CONFIG_ADMINPASSWORD) {
			    $_SESSION['user'] = $userid;
				return true;
			} else {
				return false;			
			}
		}		
	}
	
	public function getUser($userid){
		$couchdb = new CouchDB('users');
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all?key="'.$userid.'"', 'get', null);
		$u = $response->getBody(true);
		if ($u->error != null){
			$user = null;
		} else {
			$user = $u->rows[0]->value;
		}
		return $user;
	
	
	}
	
	public function getUserFromSession(){
		session_start();
		if (isset($_SESSION['user'])){
			$couchdb = new CouchDB('users');
			$response = $couchdb->send($_SESSION['user'], 'get', null);
			$u = $response->getBody(true);
			return $u;
		}
		return null;
	}
	
	public function getCartFromSession(){
		$user = $this->getUserFromSession();
		if ($user == null){
			return null;
		} else {
			$couchdb = new CouchDB('carts');
			$response = $couchdb->send('_design/dipsplusmore/_view/get_all?key="'.$user->_id.'"', 'get', null);
			$c = $response->getBody(true);
			if ($c->rows[0] == null){
				$cart = null;
			} else {
				$cart = $c->rows[0]->value;
			}
			return $cart;
		}
	}
	
	public function getCart($user){
		if ($user == null){
			return null;
		} else {
			$couchdb = new CouchDB('carts');
			$response = $couchdb->send('_design/dipsplusmore/_view/get_all?key="'.$user->_id.'"', 'get', null);
			$c = $response->getBody(true);
			if ($c->rows[0] == null){
				$cart = null;
			} else {
				$cart = $c->rows[0]->value;
			}
			return $cart;
		}
	}
	
	public function getCategories(){
		$couchdb = new CouchDB('categories');
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all', 'get', null);
		$cs = $response->getBody(true);
		return $cs->rows;
	} 	
 }
