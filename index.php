<?php
/*
 * Created on Oct 30, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 // Required Components
 require_once('../dipsplusmore.com/config.php'); 
 require_once('../dipsplusmore.com/models/Front.php');
 require_once('../dipsplusmore.com/models/view.php');
 require_once('../dipsplusmore.com/models/icontroller.php');
 require_once('../dipsplusmore.com/models/EventUtility.php');
 require_once('../dipsplusmore.com/models/SessionFactory.php');
 require_once('../dipsplusmore.com/models/CartFactory.php');
 
 // Required Controllers
 require_once('../dipsplusmore.com/controllers/events.php');
 require_once('../dipsplusmore.com/controllers/products.php');
 require_once('../dipsplusmore.com/controllers/adminevents.php');
 require_once('../dipsplusmore.com/controllers/adminproducts.php');
 require_once('../dipsplusmore.com/controllers/admincategories.php');
 require_once('../dipsplusmore.com/controllers/cart.php');
 require_once('../dipsplusmore.com/controllers/login.php');
 require_once('../dipsplusmore.com/controllers/logout.php');
 require_once('../dipsplusmore.com/controllers/account.php');
 
 //Initialize the FrontController
 
 
 $front = FrontController::getInstance();
 $front->route();
  
 echo $front->getBody();
 
 

