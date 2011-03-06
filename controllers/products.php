<?php
/*
 * Created on Nov 6, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class products implements IController {
	public function index() {
		$fc = FrontController::getInstance();
		$view = new View();
		
		//get user
		$session = new SessionFactory();
		$user = $session->getUserFromSession();
		$view->user = $user;
		
		//get cart
		$cartFactory = new CartFactory();
		$cart = $cartFactory->getCart($user->_id);
		$view->cart = $cart;
		
		//get categories for menu
		$categories = $session->getCategories();
		$view->categories = $categories;
		
		//get category
		$params = $fc->getParams();
		$category = $params['cat'];
		$couchdb = new CouchDB('categories');
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all?key="'.$category.'"', 'get', null);
		$c = $response->getBody(true);
		$view->category = $c->rows[0]->value;
		$view->catparam = $category;
		
		// now get the products
		$couchdb = new CouchDB('products');
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all_visible_by_category?startkey="'.$category.'0"&endkey="'.$category.'ZZZZZ"', 'get', null);
		$ps = $response->getBody(true);
		$view->products = $ps->rows;
		
		$result = $view->render('../views/products.php');
		
		
		$fc->setBody($result);
	}
}