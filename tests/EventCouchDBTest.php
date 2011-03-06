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
 require_once(dirname(__FILE__). '/../models/EventUtility.php');
 
 require_once(dirname(__FILE__). '/../config.php');
 
 
 
 
 class ProductCouchDBTest extends PHPUnit_Framework_TestCase {

  	public function testAdd(){
  		
 		$id = $this->getUUID();
 		$event["name"] = "Test Event";
 		$event["description"] = "Test Event Description";
 		$event["startdatetime"] = "2010/12/30 9:00 AM";
 		$event["enddatetime"] = "2010/12/31 4:00 PM";
 		$event["locationname"] = "Women's Club of Evantson";
 		$event["address"] = "123 Main Street";
 		$event["city"] = "Evanston";
 		$event["state"] = "IL";
 		$event["zipcode"] = "60202";
 		$event["phone"] = "123-456-7890";
  		$event["isvisible"] = "true";		
 		
 		$couchdb = new CouchDB('events');
 		
		$response = $couchdb->send($id, 'put', json_encode($event));
		$responseArray = $response->getBody(true);
		$this->assertEquals(true, $responseArray->ok);
 		
 	}	
 
 	
 	 public function testGetAll(){
 		$couchdb = new CouchDB('events');
 		
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all', 'get', null);
		$responseArray = $response->getBody(true);	
		
 		$resultcount = $responseArray->total_rows;
 		$cnt = 0;
 		$found = false;
 		foreach ($responseArray->rows as $cat) {
 	
 			if ($cat->value->name == 'Test Event'){
 				$found = true;
 			}
		    $cnt++;
		}
		$this->assertEquals(true,$found);
 	}
 	
 	public function testGetAllVisible(){
 	
 		$couchdb = new CouchDB('events');
 		
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all', 'get', null);
		$responseAll = $response->getBody(true);	
 		$allcount = $responseAll->total_rows;

 		
 		$response = $couchdb->send('_design/dipsplusmore/_view/get_all_visible', 'get', null);
		$responseVisible = $response->getBody(true);	
 		$visiblecount = $responseVisible->total_rows;

 		

		$this->assertNotEquals($visiblecount, $allcount);

 	}
 	
 	public function testGetAllVisibleByMonth(){
 		$events = new EventUtility();
 		
 		$visibleResults = $events->getAllVisibleByMonth();
 		
 		$visibleresultcount = count($visibleResults['January 2010']);

		$this->assertEquals(1, $visibleresultcount);
 	}


 	public function testUpdate(){
 		$couchdb = new CouchDB('events');
 		
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all', 'get', null);
		$responseArray = $response->getBody(true);
		
		$i = $responseArray->total_rows - 1;
		
 		$event = $responseArray->rows[$i];
 		$event->value->description = 'Test Event Description 2';
 		
 		$response = $couchdb->send($event->id, 'put', json_encode($event->value));
 		
 		
 		$response = $couchdb->send($event->id, 'get', null);
		$event2 = $response->getBody(true);
 		
		$this->assertEquals('Test Event Description 2',$event2->description);
		
		
		$response = $couchdb->send($event2->_id . "?rev=" . $event2->_rev, 'delete', null);
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
