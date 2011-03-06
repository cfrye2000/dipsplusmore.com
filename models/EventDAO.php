<?php
/*
 * Created on Oct 24, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  require_once('Event.php');
  
 
 class EventDAO {
 	 public function get($eventId){
 		$mydb = $this->getDB();
 		$sql = "SELECT * FROM events WHERE eventid={$eventId}";
 		error_log($sql);
 		if ($result = $mydb->query($sql)) { 
	        while($obj = $result->fetch_object()){ 
	        	$event = new Event();
	            $event = $this->fillEvent($obj, $event);
	           
	        }
	        $result->close(); 
		    unset($obj); 
		    unset($sql); 
		    unset($mydb);
	    } else {
	    	error_log($mydb->error);
	    	throw new Exception("Event GET exception");
	    }
	    return $event;
 	}
 	public function add($event){
  		$mydb = $this->getDB();
  		$eventArray = array();
  		$eventArray = $this->fillArray($eventArray, $event);
 		$sql = "INSERT INTO events (name, address, city, description, enddatetime, locationname, phone, startdatetime, state, isvisible, zipcode) " .
 				"VALUES ('{$eventArray['name']}', " .
 				"'{$eventArray['address']}', " .
 				"'{$eventArray['city']}', " .
 				"'{$eventArray['description']}', " .
 				"'{$eventArray['enddatetime']}', " .
 				"'{$eventArray['locationname']}', " .
 				"'{$eventArray['phone']}', " .
 				"'{$eventArray['startdatetime']}', " .
 				"'{$eventArray['state']}', " .
 				"{$eventArray['isvisible']}, " .
 				"'{$eventArray['zipcode']}')";
 
 		error_log($sql);
 		if ($mydb->query($sql) != TRUE) {
 			error_log($mydb->error);
 			throw new Exception("Event ADD exception");
 		}
 		unset($sql); 
 		unset($mydb);
 	}
 	public function update($event){
 		$mydb = $this->getDB();
 		$eventArray = array();
 		$eventArray = $this->fillArray($eventArray, $event);
 		$sql = "UPDATE events SET " .
 				"name='{$eventArray['name']}', " .
 				"address='{$eventArray['address']}', " .
 				"city='{$eventArray['city']}', " .
 				"description='{$eventArray['description']}', " .
 				"enddatetime='{$eventArray['enddatetime']}', " .
 				"locationname='{$eventArray['locationname']}', " .
 				"phone='{$eventArray['phone']}', " .
 				"startdatetime='{$eventArray['startdatetime']}', " .
 				"state='{$eventArray['state']}', " .
 				"isvisible='{$eventArray['isvisible']}', " .
 				"zipcode='{$eventArray['zipcode']}' " .
 				"WHERE eventid={$event->getId()}";
 		error_log($sql);

 		if ($mydb->query($sql) != TRUE) {
 			error_log($mydb->error);
 			throw new Exception("Event UPDATE exception");
 		}
 		unset($sql); 
 		unset($mydb);
 	}
 	public function delete($event){
 		$mydb = $this->getDB();
 		$sql = "DELETE FROM events WHERE eventid={$event->getId()}";
 		error_log($sql);

 		if ($mydb->query($sql) != TRUE) {
 			error_log($mydb->error);
 			throw new Exception("Event DELETE exception");
 		}
 		unset($sql); 
 		unset($mydb);
 	}
 	public function getAll(){
 		$mydb = $this->getDB();
 		$results = array();
 		$sql = "SELECT * FROM events order by startdatetime ASC";
 		if ($result = $mydb->query($sql)) { 
	        while($obj = $result->fetch_object()){ 
	        	$event = new Event();
	            $results[] = $this->fillEvent($obj, $event);
	        }
	        $result->close(); 
		    unset($obj); 
		    unset($sql); 
		    unset($mydb);
	    } else {
	    	error_log($mydb->error);
	    	throw new Exception("Event GETALL exception");
	    }
	    return $results;
 	}
 	
 	public function getAllVisible(){
 		$mydb = $this->getDB();
 		$results = array();
 		$sql = "SELECT * FROM events WHERE isvisible = 1";
 		if ($result = $mydb->query($sql)) { 
	        while($obj = $result->fetch_object()){ 
	        	$event = new Event();
	            $results[] = $this->fillEvent($obj, $event);
	        }
	        $result->close(); 
		    unset($obj); 
		    unset($sql); 
		    unset($mydb);
	    } else {
	    	error_log($mydb->error);
	    	throw new Exception("Event GETALLVISIBLE exception");
	    }
	    return $results;
 	}
 	
 	 public function getAllVisibleByMonth(){
 		$mydb = $this->getDB();
 		$results = array();
 		$monthlyResults = array();
 		$sql = "SELECT * FROM events WHERE isvisible = 1 order by startdatetime ASC";
 		if ($result = $mydb->query($sql)) { 
	        while($obj = $result->fetch_object()){ 
	        	$event = new Event();
	            $results[] = $this->fillEvent($obj, $event);
	        }
		    unset($obj); 
		    unset($sql); 
		    unset($mydb);
		    
		    
		    foreach ($results as &$e){
		    	//get the Month
		    	$month = 'No Month';
		    	$month = $e->getStartMonth();
		    	$year = $e->getStartYear();
		    	$arrayKey = $month . ' ' . $year;
		    	//check to see if month exists - if not add it
		    	if (!array_key_exists($arrayKey, $monthlyResults)){
		    		$monthlyResults[$arrayKey] = array();
		    	}
		    	//add to month array
		    	$monthlyResults[$arrayKey][] = $e;
		    }
		    
	    } else {
	    	error_log($mydb->error);
	    	throw new Exception("Event GETALLBYMONTH exception");
	    }
	    return $monthlyResults;
 	}
 	
 	private function fillEvent($resultObj, $event) {
	    $event->setId($resultObj->eventid); 
        $event->setAddress(stripslashes($resultObj->address));
        $event->setCity(stripslashes($resultObj->city));
        $event->setDescription(stripslashes($resultObj->description));
        $event->setEndDatetime(stripslashes($resultObj->enddatetime));
        $event->setLocationName(stripslashes($resultObj->locationname));
        $event->setName(stripslashes($resultObj->name));
        $event->setPhone(stripslashes($resultObj->phone));
        $event->setStartDatetime(stripslashes($resultObj->startdatetime));
        $event->setState(stripslashes($resultObj->state));
        $event->setZipcode(stripslashes($resultObj->zipcode));
        $event->setVisible($resultObj->isvisible);
        return $event;
 	}
 	
 	private function fillArray($a, $event) {
        $a['address'] = addslashes($event->getAddress());
        $a['city'] = addslashes($event->getCity());
        $a['description'] = addslashes($event->getDescription());
        $a['enddatetime'] = addslashes($event->getEndDatetimeForMysql());
        $a['locationname'] = addslashes($event->getLocationName());
        $a['name'] = addslashes($event->getName());
        $a['phone'] = addslashes($event->getPhone());
        $a['startdatetime'] = addslashes($event->getStartDatetimeForMysql());
        $a['state'] = addslashes($event->getState());
        $a['zipcode'] = addslashes($event->getZipcode());
        $a['isvisible'] = $event->getVisible();
        return $a;
 	}
 	
    private function getDB() {
    	$hostname = Config::$CONFIG_HOSTNAME;
    	$username = Config::$CONFIG_USERNAME;
    	$password = Config::$CONFIG_PASSWORD;
    	$databasename = Config::$CONFIG_DATABASENAME;
    	$dbObj = new mysqli($hostname, $username, $password, $databasename);
    	return $dbObj;
    }
 }
?>
