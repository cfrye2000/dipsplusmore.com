<?php
/*
 * Created on Oct 24, 2010
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
 
 
 
 
 class CategoryCouchDBTest extends PHPUnit_Framework_TestCase {

  	public function testAdd(){
 		$id = $this->getUUID();
 		$category["name"] = "Test Category";
 		$category["description"] = "Test Category Description";
 		$category["isvisible"] = "false";
 		
 		$couchdb = new CouchDB('categories');
 		
		$response = $couchdb->send($id, 'put', json_encode($category));
		$responseArray = $response->getBody(true);
		$this->assertEquals(true, $responseArray->ok);
 		
 	}	
 
 	
 	 public function testGetAll(){
 		$couchdb = new CouchDB('categories');
 		
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all', 'get', null);
		$responseArray = $response->getBody(true);	
		
 		$resultcount = $responseArray->total_rows;
 		$cnt = 0;
 		$found = false;
 		foreach ($responseArray->rows as $cat) {
 	
 			if ($cat->value->name == 'Test Category'){
 				$found = true;
 			}
		    $cnt++;
		}
		$this->assertEquals(true,$found);
 	}
 	
 	public function testGetAllVisible(){
 	
 		$couchdb = new CouchDB('categories');
 		
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all', 'get', null);
		$responseAll = $response->getBody(true);	
 		$allcount = $responseAll->total_rows;

 		
 		$response = $couchdb->send('_design/dipsplusmore/_view/get_all_visible', 'get', null);
		$responseVisible = $response->getBody(true);	
 		$visiblecount = $responseVisible->total_rows;

 		

		$this->assertNotEquals($visiblecount, $allcount);

 	}


 	public function testUpdate(){
 		$couchdb = new CouchDB('categories');
 		
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all', 'get', null);
		$responseArray = $response->getBody(true);
		
		$i = $responseArray->total_rows - 1;
		
 		$category = $responseArray->rows[$i];
 		$category->value->description = 'reTest Category Description';
 		
 		$response = $couchdb->send($category->id, 'put', json_encode($category->value));
 		
 		
 		$response = $couchdb->send($category->id, 'get', null);
		$cat2 = $response->getBody(true);
 		
		$this->assertEquals('reTest Category Description',$cat2->description);
		
		
		$response = $couchdb->send($cat2->_id . "?rev=" . $cat2->_rev, 'delete', null);
		$responseArray = $response->getBody(true);
		$this->assertEquals(true, $responseArray->ok);
		
	
 	}



	public function getUUID() {
		$couchdb = new CouchDB('_uuids');
		$response = $couchdb->send(null, 'get', null);
		$responseArray = $response->getBody(true);
		return $responseArray->uuids[0];
	}
	
 	
 }
?>
