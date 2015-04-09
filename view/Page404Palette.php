<?php


class Page404Palette {

   // private $arr = array();
    public function __construct() {

    }

    public function getArr(){
        $arr = array(''=>'');
        return DataContModel::getInstance()->getData();
    }
}