<?php
/*
 * Created on Jan 12, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  class logout implements IController {
 	
 	public function index() {
 		$session = new SessionFactory();
		$session->logout();
 		$fc = FrontController::getInstance();
 		$params = $fc->getParams();
		$redirect = str_replace(".","/",$params['redirect']);
		header( 'Location: /'.$redirect);
		
	}
 }
?>
