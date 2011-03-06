<?php
/*
 * Created on Dec 28, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require_once(dirname(__FILE__). '/../couchdb/CouchDB.class.php');
 require_once(dirname(__FILE__). '/../couchdb/CouchDBException.class.php');
 require_once(dirname(__FILE__). '/../couchdb/CouchDBRequest.class.php');
 require_once(dirname(__FILE__). '/../couchdb/CouchDBResponse.class.php');
 
 require_once(dirname(__FILE__). '/../config.php');
 
 class EventUtility {
 	
 	public function getAllVisibleByMonth(){
 		$results = array();
 		$monthlyResults = array();
 		$couchdb = new CouchDB('events');
 		
		$response = $couchdb->send('_design/dipsplusmore/_view/get_all_visible_by_date', 'get', null);
		$responseArray = $response->getBody(true);
		
		    
		    
	    foreach ($responseArray->rows as $e){
	    	//get the Month
	    	$month = 'No Month';
	    	$month = $this->getStartMonth($e);
	    	$year = $this->getStartYear($e);
	    	$arrayKey = $month . ' ' . $year;
	    	//check to see if month exists - if not add it
	    	if (!array_key_exists($arrayKey, $monthlyResults)){
	    		$monthlyResults[$arrayKey] = array();
	    	}
	    	//add to month array
	    	$monthlyResults[$arrayKey][] = $e;
	    }
		    

	    return $monthlyResults;
 	}
 	
 	public function getStartMonth($e){
 		$phpDatetime = getdate(strtotime($e->value->startdatetime));	
		return $phpDatetime['month'];
 	}
 	public function getEndMonth($e){
 		$phpDatetime = getdate(strtotime($e->value->enddatetime));	
		return $phpDatetime['month'];
 	}
 	
 	public function getStartYear($e){
 		$phpDatetime = getdate(strtotime($e->value->startdatetime));	
		return $phpDatetime['year'];
 	}
 	public function getEndYear($e){
 		$phpDatetime = getdate(strtotime($e->value->enddatetime));	
		return $phpDatetime['year'];
 	}
 	
 }
?>
