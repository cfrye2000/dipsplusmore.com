<?php
/*
 * Created on Nov 14, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class cart implements IController {
	
	public function index() {
		$session = new SessionFactory();
		
		if (!$session->isLoggedIn()){
			header( 'Location: /login/index/redirect/cart');					
		} else {
			$view = new View();
			
			//get categories for menu
			$categories = $session->getCategories();
			$view->categories = $categories;
			
			//get user
			$user = $session->getUserFromSession();
			$view->user = $user;
			
			//get cart
			$cartFactory = new CartFactory();
			$cart = $cartFactory->getCart($user->_id);
			
			$view->cart = $cartFactory->getInflatedProducts($cart);
			
			
			$result = $view->render('../views/cart.php');
			
			
			
			$fc = FrontController::getInstance();
			$fc->setBody($result);
		}
	}
	
	public function add() {
		$fc = FrontController::getInstance();
		$params = $fc->getParams();
		$productid = $params['product'];
		$session = new SessionFactory();
		if (!$session->isLoggedIn()){
			header( 'Location: /login/index/redirect/cart.add.product.'.$productid);						
		} else {

			$view = new View();
			
			//get categories for menu
			$categories = $session->getCategories();
			$view->categories = $categories;
			
			//get user
			$user = $session->getUserFromSession();
			$view->user = $user;
			
			
			
			//get cart
			$cartFactory = new CartFactory();
			$cart = $cartFactory->getCart($user->_id);
			
			$cart = $cartFactory->addToCart($productid, $cart);
			
			$view->cart = $cartFactory->getInflatedProducts($cart);
			$result = $view->render('../views/cart.php');
			
			
			
			$fc = FrontController::getInstance();
			$fc->setBody($result);
		}
	}
	
	public function remove(){
		//ajax handler
		
		$values = $_POST;
		
		$productid = $values['productid'];
		
		$session = new SessionFactory();
		$user = $session->getUserFromSession();
		
		$cartFactory = new CartFactory();
		
		
		$cart = $cartFactory->getCart($user->_id);
		
		$cartFactory->removeFromCart($productid, $cart);
		
		$result = "Item Removed";
		
		error_log("about to return from cart remove");
		
		$fc = FrontController::getInstance();
		$fc->setBody($result);
	}
}