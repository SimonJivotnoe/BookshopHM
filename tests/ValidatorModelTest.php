<?php
include dirname(__FILE__). '/../models/ValidatorModel.php';
include dirname(__FILE__). '/../models/DataBaseModel.php';
include dirname(__FILE__). '/../config.php';
class ValidatorModelTest extends PHPUnit_Framework_TestCase {
	public function testvalidateInputs(){
		$obj = new ValidatorModel();
		$name = 'test';
		$pass = 1111;
		$email = 'test@mail.ru';
		$obj = new ValidatorModel();
		$this->assertTrue($obj->validateInputs($name, $pass, $email));
		$this->assertTrue(is_array($obj->validateInputs('', $pass, $email)));
	}
	public function testinputLength(){
		$obj = new ValidatorModel();
		$input1 = 'ttttt';
		$input2 = 'ttt';
		$name = 'pass';
		$this->assertEquals($input1, $obj->inputLength($input1, $name));
		$this->assertEmpty($obj->inputLength($input2, $name));
		
	}
	public function testemailCheck(){
		$obj = new ValidatorModel();
		$input = 'test@gmail.com';
		$name = 'pass';
		$this->assertEquals($input, $obj->emailCheck($input, $name));
		
	}


}
