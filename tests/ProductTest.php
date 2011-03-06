<?php
/*
 * Created on Oct 24, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 require_once('PHPUnit/Framework.php');
 require_once(dirname(__FILE__). '/../models/Products.class.php');
 require_once(dirname(__FILE__). '/../models/ProductsDAO.class.php');
 require_once(dirname(__FILE__). '/../models/MySQLConnection.class.php');
  require_once(dirname(__FILE__). '/../models/PreparedStatement.class.php');
 
 require_once(dirname(__FILE__). '/../config.php');
 
 
 
 
 class ProductTest extends PHPUnit_Framework_TestCase {

 	
 	public function testAdd(){
 		$product = new Products();
 		$product->name = 'Test Product';
 		$product->description = 'Test Product Description';
 		$product->ingredients = 'Test ingredients';
 		$product->productid = '123';
 		$product->price = 5.99;
 		$product->weight = '10 fl oz';
 		$product->isvisible = 1;
 		
 		$conn = $this->getConnection();
 		
 		$products = new ProductsDAO($conn);
 		$products->insert($product);
 		
 		$conn->close();
 		
 		
 	}
 	
 	 public function testGetAll(){
 		$conn = $this->getConnection();
 		
 		$products = new ProductsDAO($conn);
 		$results = $products->findAll('id', 0, 0);
 		$resultcount = count($results);
 		$cnt = 0;
 		$found = false;
 		foreach ($results as &$value) {
 			if ($value->name == 'Test Product'){
 				$found = true;
 			}

		    $cnt++;
		}
		unset($value);
		$this->assertEquals(true,$found);
		$conn->close();
 	}
 	
 	public function testGetAllVisible(){
  		$conn = $this->getConnection();
 		
 		$products = new ProductsDAO($conn);
 		$visibleResults = $products->findByIsvisible(1);
 		$invisibleResults = $products->findAll();
 		
 		$visibleresultcount = count($visibleResults);
 		$invisibleresultcount = count($invisibleResults);

		$this->assertNotEquals($visibleresultcount, $invisibleresultcount);
		$conn->close();
 	}


 	public function testUpdate(){
 		$conn = $this->getConnection();
 		
 		$products = new ProductsDAO($conn);
 		$results = $products->findAll();
 		$product = $results[0];
 		$product->description = 'reTest Product Description';
 		$products->update($product);
 		$productList = $products->findById($product->id);
 		
		$this->assertEquals('reTest Product Description',$productList[0]->description);
		$products->delete($productList[0]->id);
 	}

	private function getConnection() {
		$hostname = Config::$CONFIG_HOSTNAME;
    	$username = Config::$CONFIG_USERNAME;
    	$password = Config::$CONFIG_PASSWORD;
    	$databasename = Config::$CONFIG_DATABASENAME;
 		
 		$conn = new MySQLConnection($hostname, $username, $password, $databasename);
 		
 		return $conn;
	}
 	
 }
?>
