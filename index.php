<?php
/*
 * Created on Oct 30, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 // Required Components
 require_once('./config.php'); 
 require_once('./models/Front.php');
 require_once('./models/view.php');
 require_once('./models/icontroller.php');
 require_once('./models/EventUtility.php');
 require_once('./models/SessionFactory.php');
 require_once('./models/CartFactory.php');
 
 // Required Controllers
 require_once('./controllers/events.php');
 require_once('./controllers/products.php');
 require_once('./controllers/adminevents.php');
 require_once('./controllers/adminproducts.php');
 require_once('./controllers/admincategories.php');
 require_once('./controllers/cart.php');
 require_once('./controllers/login.php');
 require_once('./controllers/logout.php');
 require_once('./controllers/account.php');
 
 //Initialize the FrontController
 
 
 $front = FrontController::getInstance();
 $front->route();
  
 echo $front->getBody();
 
 

