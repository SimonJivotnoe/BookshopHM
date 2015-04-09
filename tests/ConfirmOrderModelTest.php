<?php
include dirname(__FILE__). '/../models/ConfirmOrderModel.php';
include dirname(__FILE__). '/../models/DataBaseModel.php';
include dirname(__FILE__). '/../config.php';
class ConfirmOrderModelTest extends PHPUnit_Framework_TestCase {

	public function testgetQuantityAndPrice(){
		$obj = new ConfirmOrderModel();
		$user_id = 31;
		$quantity = $obj->getQuantityAndPrice($user_id); 
		$this->assertTrue(is_array($quantity));

		return $quantity;
	}
	/**
	* @depends testgetQuantityAndPrice
	*/
	public function testgetDiscount(){
		$obj = new ConfirmOrderModel();
		$user_id = 31;
		$discount =array(2);// $obj->getDiscount($user_id);
		$this->assertTrue(is_array($discount));
		return $discount;
	}
	/**
	* @depends testgetDiscount
	*/
	public function testgetPayment(){
		$obj = new ConfirmOrderModel();
		$payment = $obj->getPayment();
		$this->assertTrue(is_array($payment));
		return $payment;
	}
	/**
	* @depends testgetPayment
	*/
	public function testsetOrder($quantity, $discount, $payment){
		$obj = new ConfirmOrderModel();
		$user_id = 31;
		$this->assertTrue($obj->setOrder($user_id, $quantity, $discount, $payment));
	}

}

