<?php

class Registrationctrl
{
    private $check = false;
    private $localStorageData;
    public function __construct()
    {
        $objSess = new SessionModel();
        $sesCheck = $objSess->read('BookshopLogin');
        if ( $sesCheck) {
            header('Location: /~user1/PHP/Bookshop/index.php');
            exit;
        } else {
            $objView = DataContModel::getInstance();
            $pdo = DataBaseModel::connect();
            $objValidation = new ValidatorModel();
            if ( ! empty($_POST[ 'registration' ])) {               
				$postName = $_POST['nameReg'];
				$postPass = $_POST['passReg'];
				$postEmail = $_POST['mailReg'];
                $result = $objValidation->validateInputs($postName, $postPass, $postEmail);
                $name = $objValidation->getName();
                $pass = md5($objValidation->getPass() . SALT);
                $email = $objValidation->getEmail();
                if ($result === true) {
                    $arr = $objValidation->getResult();
                    $result = $pdo->select("user_login")->from("users WHERE user_login = '$name'")->exec();
                    if ( ! empty($result)) {
                        $arr[ '%LOGIN%' ] = 'this login already exist';
                        $objView->setData($arr)->setStartPage('registration.html');
                    } else {
                        $res = $pdo->insert("users")
                            ->fields("user_login, user_pass, user_email")
                            ->values("'$name', '$pass', '$email'")
                            ->execInsertWithLastID();
                        if ($res > 0) {
                            $objView->setInfoFlag('newcomer');
                            /*$json = $objView->getData();

                            if ($check) {

                            }*/
                            header('Location: /~user1/PHP/Bookshop/index.php');
                            exit;
                            //$objView->setStartPage('index.html')->setInfoFlag('newcomer');
                            /*$objSession = new SessionModel();
                            $objSession->add($name,'bookshop');*/
                        } else {

                        }
                    }
                } else {
                    $objView->setData($result)->setStartPage('registration.html');
                }
            } else {
                $objView->setStartPage('registration.html')->setData($objValidation->getResult());
            }

        }
    }
}
