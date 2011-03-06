<?php
/*
 * Created on Nov 14, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class adminevents implements IController {
	
	public function index() {
		$session = new SessionFactory();
		if (!$session->isLoggedInAsAdmin()){
			header( 'Location: /login/index/redirect/adminevents');											
		} else {
			$view = new View();
			$couchdb = new CouchDB('events');
			$response = $couchdb->send('_design/dipsplusmore/_view/get_all', 'get', null);
			$es = $response->getBody(true);
			$view->events = $es->rows;
			$result = $view->render('../views/adminevents.php');
			
			
			$fc = FrontController::getInstance();
			$fc->setBody($result);
		}
	}
	public function updateevent(){
		//ajax handler
		
		$values = $_POST;
		$stuff = 'var:  ';
		
		
		foreach($values as $key => $value){
			$stuff = $stuff . $key . '->' . $value . ', ';
		}
		
		$couchdb = new CouchDB('events');

		//now update the event
		$response = $couchdb->send($values['id'], 'get', null);
		$event = $response->getBody(true);
		if ($event != null && $event->_id != 0) {
			//update event
			foreach ($values as $key => $value){
				$event->$key = $value;
			}
			
			//now add the event
			
	
			$response = $couchdb->send($event->id, 'put', json_encode($event));
			$responseArray = $response->getBody(true);
			if ($responseArray->ok == 'true'){
				$result = 'Event updated. Reload Page to Confirm. ';
			} else {
				error_log('controller error updating event');
				$result = 'Problem updating event';
			}
		}
				
		
		$fc = FrontController::getInstance();
		$fc->setBody($result);
		
	}
	
	public function addevent(){
		//ajax handler
	
		$values = $_POST;
		$stuff = 'var:  ';
		
		foreach($values as $key => $value){
			$stuff = $stuff . $key . '->' . $value . ', ';
		}
		
		//now add the event
		$couchdb = new CouchDB('events');
		$id = $this->getUUID();
		
		//load up event
		foreach ($values as $key => $value){
			$event->$key = $value;
		}
		$response = $couchdb->send($id, 'put', json_encode($event));
		$responseArray = $response->getBody(true);
		if ($responseArray->ok == 'true'){
			$result = 'Event added. Reload Page to Confirm. ';
		} else {
			error_log('controller error adding event');
			$result = 'Problem adding event';
		}
		
		$fc = FrontController::getInstance();
		$fc->setBody($result);
		
	}
	
	public function deleteevent(){
		//ajax handler  $response = $couchdb->send($event2->_id . "?rev=" . $event2->_rev, 'delete', null);
		
		$values = $_POST;
		$stuff = 'var:  ';
		
		
		foreach($values as $key => $value){
			$stuff = $stuff . $key . '->' . $value . ', ';
		}
		
		$couchdb = new CouchDB('events');

		//now update the event
		$response = $couchdb->send($values['id'], 'get', null);
		$event = $response->getBody(true);
		if ($event != null && $event->_id != 0) {
			//update event
			foreach ($values as $key => $value){
				$event->$key = $value;
			}
			
			//now add the event
			
	
			$response = $couchdb->send($event->_id . "?rev=" . $event->_rev, 'delete', null);
			$responseArray = $response->getBody(true);
			if ($responseArray->ok == 'true'){
				$result = 'Event deleted. Reload Page to Confirm. ';
			} else {
				error_log('controller error deleting event');
				$result = 'Problem deleting event';
			}
		}
				
		
		$fc = FrontController::getInstance();
		$fc->setBody($result);
		
	}
	
	
	
	public function getUUID() {
		$couchdb = new CouchDB('_uuids');
		$response = $couchdb->send(null, 'get', null);
		$responseArray = $response->getBody(true);
		return $responseArray->uuids[0];
	}
}