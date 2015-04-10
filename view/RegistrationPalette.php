<?php


/**
 * Class RegistrationPalette
 */
class RegistrationPalette {


    /**
     *
     */
    public function __construct() {
       
    }

    /**
     * @return array
     */
    public function getArr(){
         return DataContModel::getInstance()->getData();
    }
} 
