<?php


class RegistrationPalette {


    public function __construct() {
       
    }

    public function getArr(){
         return DataContModel::getInstance()->getData();
    }
} 