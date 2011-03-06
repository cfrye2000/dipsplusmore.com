<?php
/*
 * Created on Dec 27, 2010
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
 
 
 
 
 class CouchdbTest extends PHPUnit_Framework_TestCase {

 	
 	public function testAdd(){
 		$test["id"] = time();
 		$test["description"] = "test data";
 		
 		$couchdb = new CouchDB('test');
 		
		$response = $couchdb->send($test['id'], 'put', json_encode($test));
		$responseArray = $response->getBody(true);
		$this->assertEquals(true, $responseArray->ok);
 		
 	}
 	
 }
?>
