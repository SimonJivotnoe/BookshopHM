<?php


/**
 * Class ThankyouPalette
 */
class ThankyouPalette {
    private $repArr = array();

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * @return array
     */
    public function getArr()
    {
        $obj = DataContModel::getInstance();
        $arr = $obj->getData();
		
        return $arr;
    }
} 
