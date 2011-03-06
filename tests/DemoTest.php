<?php
/*
 * Created on Oct 24, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require_once('PHPUnit/Framework.php');
 require_once(dirname(__FILE__). '/../code/Demo.php');
 
 class DemoTest extends PHPUnit_Framework_TestCase {
 	public function testSum() {
 		$demo = new Demo();
 		$this->assertEquals(4,$demo->sum(2,2));
 		$this->assertEquals(4,$demo->subtract(8,4));
 	}
 	
 }
?>
