<?php


class Cabinetctrl {
    private $arrRes = array(

    );
    public function __construct()
    {
        $objSess = new SessionModel();
        $sesCheck = $objSess->read('BookshopLogin');
        if ( ! $sesCheck) {
            header('Location: /?page=registrationctrl');
            exit;
        } else {
			$user_id = $_SESSION[ 'BookshopID' ];
            $objModel = new CabinetModel();
            $head = $objModel->getHead($user_id);
            $this->arrRes = $head;
            DataContModel::getInstance()->setStartPage('cabinet.html')->setData($this->arrRes);
        }
    }
} 
