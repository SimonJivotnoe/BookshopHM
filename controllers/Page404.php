<?php


class Page404 {

    public function __construct() {
        DataContModel::getInstance()->setStartPage('Page404.html');
    }
} 