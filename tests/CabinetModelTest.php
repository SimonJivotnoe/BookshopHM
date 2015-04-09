<?php
include dirname(__FILE__). '/../models/CabinetModel.php';
include dirname(__FILE__). '/../models/DataBaseModel.php';
include dirname(__FILE__). '/../config.php';

class CabinetModelTest extends PHPUnit_Framework_TestCase {

	public function testgetHead(){
		$id = 2; 
		$obj = new CabinetModel();
		$this->assertTrue(is_array($obj->getHead($id)));
	}
		
}

