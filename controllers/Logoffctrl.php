<?php


class Logoffctrl {
    public function __construct() {
        $objSess = new SessionModel();
        $res = $objSess->remove('BookshopLogin');
        if ($res) {
            header('Location: /~user1/PHP/Bookshop/index.php');
            exit;
        }
    }
} 
