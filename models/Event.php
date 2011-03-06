<?php
/*
 * Created on Oct 24, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 class Event {
 	public $id;
 	public $name;
 	public $description;
 	public $startDatetime;
 	public $endDatetime;
 	public $locationName;
 	public $address;
 	public $city;
 	public $state;
 	public $zipcode;
 	public $phone;
 	public $isVisible;
 	
 	public static function CreateEvent($array) {
 		
 		$event = new Event();
 		
 		foreach($array as $key => $value){
 			$event->$key = $value;
 		}
 		
 		return $event;
 	}
 	
 	public function getId() {
 		return $this->id;
 	}
 	
 	public function getName() {
 		return $this->name;
 	}
 	
 	public function getDescription() {
 		return $this->description;
 	}
 	
 	public function getStartDatetime(){
 		$datetime = strtotime($this->startDatetime);
		return date("m/d/y g:i A", $datetime); 	
	}
	
	public function getStartDatetimeForMysql(){
		$phpDatetime = strtotime($this->startDatetime);
 		return date('Y-m-d H:i:s', $phpDatetime );
	}
 	
 	public function getStartYear(){
 		$phpDatetime = getdate(strtotime($this->getStartDatetime()));	
		return $phpDatetime['year'];
 	}
 	
 	public function getStartMonth(){
 		$phpDatetime = getdate(strtotime($this->getStartDatetime()));	
		return $phpDatetime['month'];
 	}
 	
 	public function getStartDate(){
 		$phpDatetime = getdate(strtotime($this->getStartDatetime()));	
		return $phpDatetime['mday'];
 	}
 	
 	public function getStartWeekday(){
 		$phpDatetime = getdate(strtotime($this->getStartDatetime()));	
		return $phpDatetime['weekday'];
 	}
 	
 	public function getEndYear(){
 		$phpDatetime = getdate(strtotime($this->getEndDatetime()));	
		return $phpDatetime['year'];
 	}
 	
 	public function getEndMonth(){
 		$phpDatetime = getdate(strtotime($this->getEndDatetime()));	
		return $phpDatetime['month'];
 	}
 	
 	public function getEndDate(){
 		$phpDatetime = getdate(strtotime($this->getEndDatetime()));	
		return $phpDatetime['mday'];
 	}
 	
 	public function getEndWeekday(){
 		$phpDatetime = getdate(strtotime($this->getEndDatetime()));	
		return $phpDatetime['weekday'];
 	}
 	
 	public function getEndDatetime(){
 		$datetime = strtotime($this->endDatetime);
		return date("m/d/y g:i A", $datetime);
	}
	
	public function getEndDatetimeForMysql(){
		$phpDatetime = strtotime($this->endDatetime);
 		return date('Y-m-d H:i:s', $phpDatetime );
	}
 	
 	public function getLocationName(){
 		return $this->locationName;
 	}
 	
 	public function getAddress(){
 		return $this->address;
 	}
 	 	
 	public function getCity(){
 		return $this->city;
 	}
 	 	
 	public function getState(){
 		return $this->state;
 	}
 	 	
 	public function getZipcode(){
 		return $this->zipcode;
 	}
 	 	
 	public function getPhone(){
 		return $this->phone;
 	}
 	
 	public function getVisible(){
 		if ($this->isVisible == NULL){
 			$this->isVisible = 0;
 		}
 		return $this->isVisible;
 	}
 	
 	public function setId($id){
 		$this->id = $id;
 	}
 	
 	public function setName($name){
 		$this->name = $name;
 	}
 	 	
 	public function setDescription($description){
 		$this->description = $description;
 	}
 	 	
 	public function setStartDatetime($startDatetime){
 		$phpDatetime = strtotime($startDatetime);
 		$mysqlDatetime = date('Y-m-d H:i:s', $phpDatetime );
 		$this->startDatetime = $mysqlDatetime;
 	}
 	 	
 	public function setEndDatetime($endDatetime){
 		$phpDatetime = strtotime($endDatetime);
 		$mysqlDatetime = date('Y-m-d H:i:s', $phpDatetime );
 		$this->endDatetime = $mysqlDatetime;
 	}
 	 	
 	public function setLocationName($locationName){
 		$this->locationName = $locationName;
 	}
 	 	
 	public function setAddress($address){
 		$this->address = $address;
 	}
 	 	
 	public function setCity($city){
 		$this->city = $city;
 	}
 	 	
 	public function setState($state){
 		$this->state = $state;
 	}
 	 	
 	public function setZipcode($zipcode){
 		$this->zipcode = $zipcode;
 	}
 	 	
 	public function setPhone($phone){
 		$this->phone = $phone;
 	}
 	
 	public function setVisible($visible){
 		$this->isVisible = $visible;
 	}

 	
 }
 
?>
