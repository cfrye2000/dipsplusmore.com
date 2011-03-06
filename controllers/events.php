<?php
/*
 * Created on Nov 6, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class events implements IController {
	public function index() {
		$session = new SessionFactory();
		
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
		$view->cart = $cart;
		
		$events = new EventUtility();
 		$es = $events->getAllVisibleByMonth();
		$view->events = $es;
		$result = $view->render('../views/shows.php');
		
		
		$fc = FrontController::getInstance();
		$fc->setBody($result);
	}
}
