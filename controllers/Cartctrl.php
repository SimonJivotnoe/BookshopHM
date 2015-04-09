<?php


class Cartctrl {
    public function __construct() {
            $objView = DataContModel::getInstance();
            $objView->setStartPage('cart.html');
    }
} 
