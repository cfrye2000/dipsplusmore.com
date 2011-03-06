<?php
/*
 * Created on Oct 24, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 require_once('PHPUnit/Framework.php');
 require_once(dirname(__FILE__). '/../models/Category.class.php');
 require_once(dirname(__FILE__). '/../models/CategoryDAO.class.php');
 require_once(dirname(__FILE__). '/../models/MySQLConnection.class.php');
  require_once(dirname(__FILE__). '/../models/PreparedStatement.class.php');
 
 require_once(dirname(__FILE__). '/../config.php');
 
 
 
 
 class CategoryTest extends PHPUnit_Framework_TestCase {

 	
 	public function testAdd(){
 		$category = new Category();
 		$category->name = 'Test Category';
 		$category->description = 'Test Category Description';
 		$category->isvisible = 0;
 		
 		$conn = $this->getConnection();
 		
 		$categories = new CategoryDAO($conn);
 		$categories->insert($category);
 		
 		$conn->close();
 		
 		
 	}
 	
 	 public function testGetAll(){
 		$conn = $this->getConnection();
 		
 		$categories = new CategoryDAO($conn);
 		$results = $categories->findAll('id', 0, 0);
 		$resultcount = count($results);
 		$cnt = 0;
 		$found = false;
 		foreach ($results as &$value) {
 			if ($value->name == 'Test Category'){
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
 		
 		$categories = new CategoryDAO($conn);
 		$visibleResults = $categories->findByIsvisible(1);
 		$invisibleResults = $categories->findAll();
 		
 		$visibleresultcount = count($visibleResults);
 		$invisibleresultcount = count($invisibleResults);

		$this->assertNotEquals($visibleresultcount, $invisibleresultcount);
		$conn->close();
 	}


 	public function testUpdate(){
 		$conn = $this->getConnection();
 		
 		$categories = new CategoryDAO($conn);
 		$results = $categories->findAll();
 		$category = $results[0];
 		$category->description = 'reTest Category Description';
 		$categories->update($category);
 		$categoryList = $categories->findById($category->id);
 		
		$this->assertEquals('reTest Category Description',$categoryList[0]->description);
		$categories->delete($categoryList[0]->id);
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
