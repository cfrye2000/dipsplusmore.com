<?php
/*
 * Created on Jan 11, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 class login implements IController {
 	
 	public function index() {
 		$fc = FrontController::getInstance();
 		$params = $fc->getParams();
		$redirect = $params['redirect'];
		
		$session = new SessionFactory();
		
		$view = new View();
		
		//get categories for menu
		$categories = $session->getCategories();
		$view->categories = $categories;
		
		
		

		$view->redirect = $redirect;
		$result = $view->render('../views/login.php');
		
		$fc = FrontController::getInstance();
		$fc->setBody($result);
		
	}
	
	public function post() {
	 	$fc = FrontController::getInstance();
 		$params = $fc->getParams();
		$redirect = str_replace(".","/",$params['redirect']);
		$values = $_POST;
		$session = new SessionFactory();
		$session->login($values['username'], $values['password']);
		header( 'Location: /'.$redirect);	
	}
		
 }
?>
