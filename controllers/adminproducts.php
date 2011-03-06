<?php
/*
 * Created on Nov 14, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class adminproducts implements IController {
	
	public function index() {
		$session = new SessionFactory();
		if (!$session->isLoggedInAsAdmin()){
			header( 'Location: /login/index/redirect/adminproducts');					
		} else {
			$view = new View();
			
			//get products
			$couchdb = new CouchDB('products');
			$response = $couchdb->send('_design/dipsplusmore/_view/get_all', 'get', null);
			$ps = $response->getBody(true);
			$view->products = $ps->rows;
			
			//get categories for category selection
			$couchdb = new CouchDB('categories');
			$response = $couchdb->send('_design/dipsplusmore/_view/get_all_visible', 'get', null);
			$cs = $response->getBody(true);
			$view->categories = $cs->rows;
			
			
			
			$result = $view->render('../views/adminproducts.php');
			
			$fc = FrontController::getInstance();
			$fc->setBody($result);
		}
	}
	public function updateproduct(){
		//ajax handler
		
		$values = $_POST;
		$stuff = 'var:  ';
		
		
		foreach($values as $key => $value){
			$stuff = $stuff . $key . '->' . $value . ', ';
		}
		
		$couchdb = new CouchDB('products');

		//now update the product
		$response = $couchdb->send($values['id'], 'get', null);
		$product = $response->getBody(true);
		if ($product != null && $product->_id != 0) {
			//update product
			foreach ($values as $key => $value){
				$product->$key = $value;
			}
			
			//now add the product
			
	
			$response = $couchdb->send($product->id, 'put', json_encode($product));
			$responseArray = $response->getBody(true);
			if ($responseArray->ok == 'true'){
				$result = 'product updated. Reload Page to Confirm. ';
			} else {
				error_log('controller error updating product');
				$result = 'Problem updating product';
			}
		}
				
		
		$fc = FrontController::getInstance();
		$fc->setBody($result);
		
	}
	
	public function addproduct(){
		//ajax handler
	
		$values = $_POST;
		$stuff = 'var:  ';
		
		foreach($values as $key => $value){
			$stuff = $stuff . $key . '->' . $value . ', ';
		}
		
		//now add the product
		$couchdb = new CouchDB('products');
		$id = $this->getUUID();
		
		//load up product
		foreach ($values as $key => $value){
			$product->$key = $value;
		}
		$response = $couchdb->send($id, 'put', json_encode($product));
		$responseArray = $response->getBody(true);
		if ($responseArray->ok == 'true'){
			$result = 'product added. Reload Page to Confirm. ';
		} else {
			error_log('controller error adding product');
			$result = 'Problem adding product';
		}
		
		$fc = FrontController::getInstance();
		$fc->setBody($result);
		
	}
	
	public function deleteproduct(){
		//ajax handler  $response = $couchdb->send($product2->_id . "?rev=" . $product2->_rev, 'delete', null);
		
		$values = $_POST;
		$stuff = 'var:  ';
		
		
		foreach($values as $key => $value){
			$stuff = $stuff . $key . '->' . $value . ', ';
		}
		
		$couchdb = new CouchDB('products');

		//now update the product
		$response = $couchdb->send($values['id'], 'get', null);
		$product = $response->getBody(true);
		if ($product != null && $product->_id != 0) {
			//update product
			foreach ($values as $key => $value){
				$product->$key = $value;
			}
			
			//now add the product
			
	
			$response = $couchdb->send($product->_id . "?rev=" . $product->_rev, 'delete', null);
			$responseArray = $response->getBody(true);
			if ($responseArray->ok == 'true'){
				$result = 'product deleted. Reload Page to Confirm. ';
			} else {
				error_log('controller error deleting product');
				$result = 'Problem deleting product';
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
