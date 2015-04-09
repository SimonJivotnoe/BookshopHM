<?php


class ThankyouPalette {
    private $repArr = array();
    public function __construct()
    {

    }

    public function getArr()
    {
        $obj = DataContModel::getInstance();
        $arr = $obj->getData();
		
        return $arr;
    }
} 
