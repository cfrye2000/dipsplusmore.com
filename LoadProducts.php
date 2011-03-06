<?php
/*
 * Created on Jan 7, 2011
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require_once(dirname(__FILE__). '/couchdb/CouchDB.class.php');
 require_once(dirname(__FILE__). '/couchdb/CouchDBException.class.php');
 require_once(dirname(__FILE__). '/couchdb/CouchDBRequest.class.php');
 require_once(dirname(__FILE__). '/couchdb/CouchDBResponse.class.php');
 
 
 	$args = $_SERVER['argv'];
	
	foreach($args as $key => $value){
	 
	}
	
	if (($handle = fopen("products.csv", "r")) !== FALSE) {
	    while (($data = fgetcsv($handle, 1000, "|")) !== FALSE) {
			$product['image'] = $data[0];
			$product['name'] = $data[1];
			$product['ingredients'] = $data[2];
			$product['weight'] = $data[3];
			$product['price'] = $data[4];
			$product['sequence'] = $data[5];
			$product['category'] = $data[6];
			$product['isvisible'] = $data[7];
			//now add the product
			$couchdb = new CouchDB('products');
			$id = getUUID();
			
//			echo "\n ready to add product named ".$product['name'];
//			echo json_encode($product);
	
			$response = $couchdb->send($id, 'put', json_encode($product));
			$responseArray = $response->getBody(true);
			if ($responseArray->ok == 'true'){
				echo 'product '.$product['name'].' added.';
			} else {
				echo 'Problem adding product';
			}
			
	    }
	    fclose($handle);
	}
    
    function getUUID() {
		$couchdb = new CouchDB('_uuids');
		$response = $couchdb->send(null, 'get', null);
		$responseArray = $response->getBody(true);
		return $responseArray->uuids[0];
	}

?>
