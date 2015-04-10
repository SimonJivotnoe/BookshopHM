<?php

/*
class Authorizationctrl {
    public function __construct() {
        $objView = DataContModel::getInstance();
        if (!empty($_POST['authorization'])) {
            $objValid = new ValidatorModel();
            $login = $objValid->mainHandling($_POST['loginAUTH']);
            $pass = $objValid->mainHandling($_POST['passAUTH']);
            if (!empty($login) && !empty($pass)) {
                $pass = md5($pass.SALT);
                $pdo = DataBaseModel::connect();
                $result= $pdo->select("user_login, user_id ")->from("users WHERE user_login = '$login' AND
                user_pass = '$pass'")->exec();
                if (!empty($result)) {
                    $objSess = new SessionModel();
                    $objSess->add('BookshopLogin', $result[0]['user_login']);
                    $objSess->add('BookshopID', $result[0]['user_id']);
                    $objView->setStartPage('index.html');
                } else {
                    header('Location: http:/');
                    exit;
                }
            } else {
                header('Location: http:/');
                exit;
            }
        } else {
            header('Location: http:/');
            exit;
        }
    }
} 
*/

/**
 * Class Authorizationctrl
 */
class Authorizationctrl {
    /**
     *
     */
    public function __construct() {
        $objView = DataContModel::getInstance();
        if (!empty($_POST['authorization'])) {
            $objValid = new ValidatorModel();
            $login = $objValid->mainHandling($_POST['loginAUTH']);
            $pass = $objValid->mainHandling($_POST['passAUTH']);
            if (!empty($login) && !empty($pass)) {
                $pass = md5($pass.SALT);
                $objModel = new AgentDBModel();
                $result = $objModel->selectUser($login, $pass);
                if (!empty($result)) {
                    $objSess = new SessionModel();
                    $objSess->add('BookshopLogin', $result[0]['user_login']);
                    $objSess->add('BookshopID', $result[0]['user_id']);
                    $objView->setStartPage('index.html');
                } else {
                    header('Location: http:/');
                    exit;
                }
            } else {
                header('Location: http:/');
                exit;
            }
        } else {
            header('Location: http:/');
            exit;
        }
    }
} 
