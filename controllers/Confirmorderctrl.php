<?php


class Confirmorderctrl {
    private $arr = array();
    public function __construct() {
        $objSess = new SessionModel();
        $sesCheck = $objSess->read('BookshopLogin');
        if ( ! $sesCheck) {
            header('Location: /index.php?page=registrationctrl');
            exit;
        } else {
				$user_id = $_SESSION[ 'BookshopID' ];
            if (empty($_POST['payment'])) {
                $objView = DataContModel::getInstance();
                $objModel = new ConfirmOrderModel();
                $quantityAndPrice=$objModel->getQuantityAndPrice($user_id);
                $discount=$objModel->getDiscount($user_id);
                $payment=$objModel->getPayment();
                $this->arr['quantityAndPrice'] = $quantityAndPrice;
                $this->arr['discount'] = $discount;
                $this->arr['payment'] = $payment;
                $objView->setStartPage('confirmorder.html')->setData($this->arr);
            } else {
                $objModel = new ConfirmOrderModel();
                $quantityAndPrice=$objModel->getQuantityAndPrice($user_id);
                $discount=$objModel->getDiscount($user_id);
                $paymentId=$_POST['payment'];
                $res = $objModel->setOrder($_SESSION[ 'BookshopID' ], $quantityAndPrice, $paymentId, $discount);
			//	if($res) {					
                $objView = DataContModel::getInstance();
				$resArr = $objModel->getArray();
                $objView->setStartPage('thankyou.html')->setData($resArr);
			//	}
            }

        }
    }
} 
