<?php
class HomeCtrl
{
	public function __construct()
    {
        DataContModel::getInstance()->setStartPage('index.html');
	}
}
