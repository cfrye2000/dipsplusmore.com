<?php
/*
 * Created on Oct 30, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 // Required Components
 require_once('../application/config.php'); 
 require_once('../application/models/Front.php');
 require_once('../application/models/view.php');
 require_once('../application/models/icontroller.php');
 require_once('../application/models/EventUtility.php');
 require_once('../application/models/SessionFactory.php');
 require_once('../application/models/CartFactory.php');
 
 // Required Controllers
 require_once('../application/controllers/events.php');
 require_once('../application/controllers/products.php');
 require_once('../application/controllers/adminevents.php');
 require_once('../application/controllers/adminproducts.php');
 require_once('../application/controllers/admincategories.php');
 require_once('../application/controllers/cart.php');
 require_once('../application/controllers/login.php');
 require_once('../application/controllers/logout.php');
 require_once('../application/controllers/account.php');
 
 //Initialize the FrontController
 
 
 $front = FrontController::getInstance();
 $front->route();
  
 echo $front->getBody();
 
 

