<?php
/*
 * Created on Oct 24, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 require_once('PHPUnit/Framework.php');
 require_once(dirname(__FILE__). '/../models/Event.php');
 require_once(dirname(__FILE__). '/../models/EventDAO.php');
 require_once(dirname(__FILE__). '/../config.php');
 
 
 
 
 class EventTest extends PHPUnit_Framework_TestCase {
 	public function testDates() {
 		$event = new Event();
 		$event->setStartDatetime('12/25/2010');
 		$this->assertEquals('2010-12-25 00:00:00',$event->getStartDatetime());
 		
 		$event->setStartDatetime('12/25/2010 1:30PM');
 		$this->assertEquals('2010-12-25 13:30:00',$event->getStartDatetime());
 		
 		$event->setEndDatetime('12/25/2010');
 		$this->assertEquals('2010-12-25 00:00:00',$event->getEndDatetime());
 		
 		$event->setEndDatetime('12/25/2010 1:30PM');
 		$this->assertEquals('2010-12-25 13:30:00',$event->getEndDatetime());
 	}
 	
 	public function testAdd(){
 		$event = new Event();
 		$event->setName("Chris Event");
 		$event->setDescription("Chris Event Description");
 		$event->setStartDatetime('12/25/2010 1:30PM');
 		$events = new EventDAO();
 		$events->add($event); 
 		
 	}
 	
 	 public function testGetAll(){
 		$events = new EventDAO();
 		$results = $events->getAll();
 		$resultcount = count($results);
 		$cnt = 0;
 		$found = false;
 		foreach ($results as &$value) {
 			if ($value->getName() == 'Chris Event'){
 				$found = true;
 			}

		    $cnt++;
		}
		unset($value);
		$this->assertEquals(true,$found);
 	}
 	
 	public function testGetAllVisible(){
 		$events = new EventDAO();
 		$visibleResults = $events->getAllVisible();
 		$invisibleResults = $events->getAll();
 		
 		$visibleresultcount = count($visibleResults);
 		$invisibleresultcount = count($invisibleResults);

		$this->assertNotEquals($visibleresultcount, $invisibleresultcount);
 	}
 	
 	public function testGetAllVisibleByMonth(){
 		$events = new EventDAO();
 		
 		$visibleResults = $events->getAllVisibleByMonth();
 		
 		$visibleresultcount = count($visibleResults['December 2010']);

		$this->assertEquals(1, $visibleresultcount);
 	}
 	
 	public function testUpdate(){
 		$events = new EventDAO();
 		$results = $events->getAll();
 		$anEvent = $results[1];
 		$anEvent->setName('Updated Name');
 		$anEvent->setAddress('927 Hinman 3S');
 		$anEvent->setCity('Evanston');
 		$anEvent->setDescription('these pictures are doing a number on my brain right now. ' .
 				'The tools and the machine. This is the formula that took me cross country. ' .
 				'I also had oneof those cruz tool kits rolled up in' .
 				'my battery box and an extra 7/16,1/2,9/16,5/8, crescent wrench, and screw drivers in my ' .
				'jacket pockets. ');
		$anEvent->setEndDatetime('12/25/2010 8:30PM');
		$anEvent->setLocationName('Owen County Fairgrounds');
		$anEvent->setName('Owen County Fair');
		$anEvent->setPhone('312-953-0681');
		$anEvent->setStartDatetime('12/25/2010 11:30AM');
		$anEvent->setState('IN');
		$anEvent->setZipcode('60202');
 		$events->update($anEvent);
 		$anEvent2 = $events->get($anEvent->getId());
		$this->assertEquals('Owen County Fair',$anEvent2->getName());
		$events->delete($anEvent2);
 	}
 	
 }
?>
