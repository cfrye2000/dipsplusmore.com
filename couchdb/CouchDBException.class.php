<?php

class CouchDBException extends Exception {
	private $errorMessage = '';
	
    function CouchDBException($errorMessage) {
    	$this->errorMessage = $errorMessage;
    }
    
    function errorMessage(){
    	return $this->errorMessage;
    }
}
?>