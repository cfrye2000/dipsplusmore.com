<?php
/*
 * Created on Nov 14, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class admincategories implements IController {
	
	public function index() {
		$session = new SessionFactory();
		if (!$session->isLoggedInAsAdmin()){
			header( 'Location: /login/index/redirect/admincategories');						
		} else {
			$view = new View();
			$couchdb = new CouchDB('categories');
			$response = $couchdb->send('_design/dipsplusmore/_view/get_all', 'get', null);
			$cs = $response->getBody(true);
			$view->categories = $cs->rows;
			$result = $view->render('../views/admincategories.php');
			
			
			$fc = FrontController::getInstance();
			$fc->setBody($result);
		}
	}
	public function updatecategory(){
		//ajax handler
		
		$values = $_POST;
		$stuff = 'var:  ';
		
		
		foreach($values as $key => $value){
			$stuff = $stuff . $key . '->' . $value . ', ';
		}
		
		$couchdb = new CouchDB('categories');

		//now update the category
		$response = $couchdb->send($values['id'], 'get', null);
		$category = $response->getBody(true);
		if ($category != null && $category->_id != 0) {
			//update category
			foreach ($values as $key => $value){
				$category->$key = $value;
			}
			
			//now add the category
			
	
			$response = $couchdb->send($category->id, 'put', json_encode($category));
			$responseArray = $response->getBody(true);
			if ($responseArray->ok == 'true'){
				$result = 'category updated. Reload Page to Confirm. ';
			} else {
				error_log('controller error updating category');
				$result = 'error updating category';
			}
		}
				
		
		$fc = FrontController::getInstance();
		$fc->setBody($result);
		
	}
	
	public function addcategory(){
		//ajax handler
	
		$values = $_POST;
		$stuff = 'var:  ';
		
		foreach($values as $key => $value){
			$stuff = $stuff . $key . '->' . $value . ', ';
		}
		
		//now add the category
		$couchdb = new CouchDB('categories');
		$id = $this->getUUID();
		
		//load up category
		foreach ($values as $key => $value){
			$category->$key = $value;
		}
		$response = $couchdb->send($id, 'put', json_encode($category));
		$responseArray = $response->getBody(true);
		if ($responseArray->ok == 'true'){
			$result = 'category added. Reload Page to Confirm. ';
		} else {
			error_log('controller error adding category');
			$result = 'error adding category';
		}
		
		$fc = FrontController::getInstance();
		$fc->setBody($result);
		
	}
	
	public function deletecategory(){
		//ajax handler  $response = $couchdb->send($category2->_id . "?rev=" . $category2->_rev, 'delete', null);
		
		$values = $_POST;
		$stuff = 'var:  ';
		
		
		foreach($values as $key => $value){
			$stuff = $stuff . $key . '->' . $value . ', ';
		}
		
		$couchdb = new CouchDB('categories');

		//now update the category
		$response = $couchdb->send($values['id'], 'get', null);
		$category = $response->getBody(true);
		if ($category != null && $category->_id != 0) {
			//update category
			foreach ($values as $key => $value){
				$category->$key = $value;
			}
			
			//now add the category
			
	
			$response = $couchdb->send($category->_id . "?rev=" . $category->_rev, 'delete', null);
			$responseArray = $response->getBody(true);
			if ($responseArray->ok == 'true'){
				$result = 'category deleted. Reload Page to Confirm. ';
			} else {
				error_log('controller error deleting category');
				$result = 'error deleting category';
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
}