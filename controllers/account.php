<?php
/*
 * Created on Nov 14, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class account implements IController {
	
	public function index() {
		$session = new SessionFactory();
		if (!$session->isLoggedIn()){
			header( 'Location: /login/index/redirect/account');					
		} else {
			$view = new View();
			//get categories for menu
			$categories = $session->getCategories();
			$view->categories = $categories;
			
			//get user
			$user = $session->getUserFromSession();
			$view->user = $user;
			
			$cartFactory = new CartFactory();
			
			//get cart
			$cart = $cartFactory->getCart($user->_id);
			$view->cart = $cart;
			
			$result = $view->render('../views/account.php');
			
			
			
			$fc = FrontController::getInstance();
			$fc->setBody($result);
		}
	}
	
	public function updateUser(){
		//ajax handler
		
		$values = $_POST;
		$couchdb = new CouchDB('users');

		$user = $this->getUser($values['id']);
		if ($user != null && $user->_id != 0) {
			//update user
			foreach ($values as $key => $value){
				$user->$key = $value;
			}
			$couchdb = new CouchDB('users');
			$response = $couchdb->send($user->_id, 'put', json_encode($user));
			$responseArray = $response->getBody(true);
			if ($responseArray->ok == 'true'){
				$result = 'Account updated';
			} else {
				error_log('controller error updating category');
				$result = 'error updating account '.$response->getBody();
			}
		}
		$fc = FrontController::getInstance();
		$fc->setBody($result);
		
	}
	
	public function updatePassword(){
		//ajax handler
		
		$values = $_POST;
		$couchdb = new CouchDB('users');
		
		//check to make sure new one is valid
		
		if ((empty($values['confirmpassword']) ||
			(empty($values['newpassword'])) ||
		    ($values['confirmpassword'] != $values['newpassword']))) {
			$result = 'error:  New Password does not match Comfirm New Password ';
		} else {

			$user = $this->getUser($values['id']);
			if ($user != null && $user->_id != 0) {
				//update user
				if ($values['oldpassword'] != $user->password){
					$result = 'error:  Old Password does not match current password';
				} else {
					$user->password = $values['newpassword'];
					$couchdb = new CouchDB('users');
					$response = $couchdb->send($user->_id, 'put', json_encode($user));
					$responseArray = $response->getBody(true);
					if ($responseArray->ok == 'true'){
						$result = 'Account updated';
					} else {
						$result = 'error updating account '.$response->getBody();
					}
				}
			}
		}
		$fc = FrontController::getInstance();
		$fc->setBody($result);
		
	}
	
	public function getUUID() {
		$couchdb = new CouchDB('_uuids');
		$response = $couchdb->send(null, 'get', null);
		$responseArray = $response->getBody(true);
		return $responseArray->uuids[0];
	}
	
	public function getUser($userid) {
		$couchdb = new CouchDB('users');
		$response = $couchdb->send($userid, 'get', null);
		$u = $response->getBody(true);
		return $u;
	}
	
	public function addUser() {
		//ajax handler
		
		$values = $_POST;
		$userid = $values['userid'];
		$newpassword = $values['newpassword'];
		$confirmpassword = $values['confirmpassword'];
		
		if (empty($userid) || empty($newpassword) || empty($confirmpassword)){
			$result = "error: account not created: userid or password empty";
		
		} else {
			if ($confirmpassword != $newpassword) {
			$result = 'error: New Password does not match Comfirm New Password ';
			} else {
				$session = new SessionFactory();
				$olduser = $session->getUser($userid);
				if ($olduser != null && $olduser->_id != null){
					$result = "error:  userid already taken please choose another";
				} else {

					$user->userid = $userid;
					$user->password = $newpassword;
					$id = $this->getUUID();
					$couchdb = new CouchDB('users');
					$response = $couchdb->send($id, 'put', json_encode($user));
					$responseArray = $response->getBody(true);
					if ($responseArray->ok == 'true'){
						$result = "account added.  Use it to login";
					} else {
						$result = "error adding account ". $response->getBody(false);
					}
				}
		    }
		}
		$fc = FrontController::getInstance();
		$fc->setBody($result);
	}
}