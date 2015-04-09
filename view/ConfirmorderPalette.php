<?php


class ConfirmorderPalette {
    private $quantity = 0;
    private $price = 0;
    private $discount = 0;
    private $payment = '';
    private $repArr = array(
    '%QUANTITY%'  => '',  
    '%PRICE%' => '',
    '%PAYMENT%' => '',        
    '%DISCOUNT%' => '',        
    '%FINALPRICE%' => '',        
    );
    public function __construct()
    {

    }

    public function getArr()
    {
        $obj = DataContModel::getInstance();
        $arr = $obj->getData();
        foreach ($arr['quantityAndPrice'] as $key => $val){
            $this->quantity += (int)$val['quantity'];
            $this->price += (int)$val['quantity'] * (int)$val['price'];
        }
        foreach ($arr['discount'] as $key => $val){
            $this->discount += (int)$val['user_discount'];

        }
        foreach ($arr['payment'] as $key => $val){
            $this->payment .= "<input type='radio' name='payment' value='".$val['payment_id']."'required>".$val['payment_name'];
        }
        if ($this->discount > 0) {
            $this->price = $this->price - $this->price / $this->discount;
        }
        $this->repArr['%QUANTITY%']=$this->quantity;
        $this->repArr['%PRICE%']=$this->price;
        $this->repArr['%PAYMENT%']=$this->payment;
        $this->repArr['%DISCOUNT%']=$this->discount;
        $this->repArr['%FINALPRICE%']=$this->price;
        return $this->repArr;
    }
} 
