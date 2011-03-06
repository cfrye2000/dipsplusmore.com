<?php
/*
 * Created on Dec 28, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

 
 require_once('PHPUnit/Framework.php');
 require_once(dirname(__FILE__). '/../couchdb/CouchDB.class.php');
 require_once(dirname(__FILE__). '/../couchdb/CouchDBException.class.php');
 require_once(dirname(__FILE__). '/../couchdb/CouchDBRequest.class.php');
 require_once(dirname(__FILE__). '/../couchdb/CouchDBResponse.class.php');
 
 require_once(dirname(__FILE__). '/../config.php');
 
 
 
 
 class ProductCouchDBTest extends PHPUnit_Framework_TestCase {

  	public function testAdd(){
 		$id = $this->getUUID();
 		$product["productid"] = "Item1234";
 		$product["name"] = "Cajun Surprise";
 		$product["description"] = "Cajun Surprise Description";
 		$product["ingredients"] = "Dried Onions, Cajun Spices and Salt.";
 		$product["price"] = "5.00";
 		$product["weight"] = "28G 1oz";
 		$product["category"] = "6f2c45bc77261bc0e2b8f420b5019072";
 		$product["isvisible"] = "true";
 		
 		
 		$couchdb = new CouchDB('products');
 		
		$response = $couchdb->send($id, 'put', json_encode($product));
		$responseArray = $response->getBody(true);
		$this->assertEquals(true, $responseArray->ok);
 		
 	}	
 
 	
 	 public function testGetAll(){
 		$couchdb = new CouchDB('products');
 		
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all', 'get', null);
		$responseArray = $response->getBody(true);	
		
 		$resultcount = $responseArray->total_rows;
 		$cnt = 0;
 		$found = false;
 		foreach ($responseArray->rows as $cat) {
 	
 			if ($cat->value->name == 'Cajun Surprise'){
 				$found = true;
 			}
		    $cnt++;
		}
		$this->assertEquals(true,$found);
 	}
 	
 	public function testGetAllVisible(){
 	
 		$couchdb = new CouchDB('products');
 		
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all', 'get', null);
		$responseAll = $response->getBody(true);	
 		$allcount = $responseAll->total_rows;

 		
 		$response = $couchdb->send('_design/dipsplusmore/_view/get_all_visible', 'get', null);
		$responseVisible = $response->getBody(true);	
 		$visiblecount = $responseVisible->total_rows;

 		

		$this->assertNotEquals($visiblecount, $allcount);

 	}


 	public function testUpdate(){
 		$couchdb = new CouchDB('products');
 		
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all', 'get', null);
		$responseArray = $response->getBody(true);
		
		$i = $responseArray->total_rows - 1;
		
 		$product = $responseArray->rows[$i];
 		$product->value->description = 'Cajun Surprise Description 2';
 		
 		$response = $couchdb->send($product->id, 'put', json_encode($product->value));
 		
 		
 		$response = $couchdb->send($product->id, 'get', null);
		$prod2 = $response->getBody(true);
 		
		$this->assertEquals('Cajun Surprise Description 2',$prod2->description);
		
		
//		$response = $couchdb->send($prod2->_id . "?rev=" . $prod2->_rev, 'delete', null);
//		$responseArray = $response->getBody(true);
//		$this->assertEquals(true, $responseArray->ok);
		
	
 	}



	public function getUUID() {
		$couchdb = new CouchDB('_uuids');
		$response = $couchdb->send(null, 'get', null);
		$responseArray = $response->getBody(true);
		return $responseArray->uuids[0];
	}
	
 	
 }
?>
