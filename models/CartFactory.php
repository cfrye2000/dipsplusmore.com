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
 
 class CartFactory {
 	
 	public function add($productid, $cart) {			
			if ($productid != null && $this->isProductValid($productid)){
				$products = $cart->products;
				
				if ($products == null){
					$products = array();
				}
				
				$products[] = $productid;
				$cart->products = $products;
				
				$this->updateCart($cart);
			}
			
			return $cart;
	}
	
	public function updateCart($newcart){
		$couchdb = new CouchDB('carts');

		$cart = $this->getCart($newcart->user);
		if ($cart != null && $cart->_id != 0) {
			//update cart
			$couchdb = new CouchDB('carts');
			$response = $couchdb->send($cart->_id, 'put', json_encode($newcart));
			$responseArray = $response->getBody(true);
			if ($responseArray->ok == 'true'){
				//?
			} else {
				//?
			}
		}
		
		return $cart;
		
		
	}
	
	public function getUUID() {
		$couchdb = new CouchDB('_uuids');
		$response = $couchdb->send(null, 'get', null);
		$responseArray = $response->getBody(true);
		return $responseArray->uuids[0];
	}
	
	public function getCart($_id) {
		$couchdb = new CouchDB('carts');
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all?key="'.$_id.'"', 'get', null);
		$c = $response->getBody(true);
		if ($c->rows[0] == null){
			$cart = $this->addCart($_id);
		} else {
			$cart = $c->rows[0]->value;
			
		}
		
		return $cart;
	}
	
	public function addCart($_id) {
		$cart->user = $_id;
		$id = $this->getUUID();
		$couchdb = new CouchDB('carts');
		$response = $couchdb->send($id, 'put', json_encode($cart));
		$responseArray = $response->getBody(true);
		if ($responseArray->ok == 'true'){
			//?
		} else {
			//?
		}
		return $cart;
	}
	
	public function isProductValid($productId){
		
		//get product
		if (isset($productId)){
			$couchdb = new CouchDB('products');
			$response = $couchdb->send($productId, 'get', null);
			$p = $response->getBody(true);
			if ($p->_id != null){
				return true;
			} else {
				return false;
			}
		}
		return false;
	}
	
	public function getProduct($productId){
		
		//get product
		if (isset($productId)){
			$couchdb = new CouchDB('products');
			$response = $couchdb->send($productId, 'get', null);
			$p = $response->getBody(true);
			if ($p->_id != null){
				return $p;
			} else {
				return null;
			}
		}
		return null;
		
		
	}	
	
	public function getInflatedProducts($cart){
		$inflatedProducts = array();
			
		//populate items
		foreach($cart->products as $p){
			$product = $this->getProduct($p);
			if ($product != null){
				$inflatedProducts[] = $product;
			}
		}			
		$cart->inflatedProducts = $inflatedProducts;
		return $cart;
	}
	
	public function addToCart($productid, $cart){
		if ($productid != null && $this->isProductValid($productid)){
			$products = $cart->products;
			
			if ($products == null){
				$products = array();
			}
			
			$products[] = $productid;
			$cart->products = $products;
			
			$this->updateCart($cart);
		}
		return $cart;
	}
	
	public function removeFromCart($productid, $cart){
		if ($productid != null && $this->isProductValid($productid)){
			$products = $cart->products;
			
			if ($products == null){
				$products = array();
			}
			// remove the productid
			$products = array_diff($products, array($productid));
 
			// reindex the array
			$products = array_values($products);
			
			$cart->products = $products;
			
			$this->updateCart($cart);
		}
		return $cart;
	}
 }

