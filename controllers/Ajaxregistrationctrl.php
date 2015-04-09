<?php


class Ajaxregistrationctrl {
    public function __construct() {
        $pdo = DataBaseModel::connect();
        $name = $_GET['login'];
        $login = $pdo->select('user_login ')->from("users WHERE user_login = '$name'")->exec();
        DataContModel::getInstance()->setData($login);
    }
} 
