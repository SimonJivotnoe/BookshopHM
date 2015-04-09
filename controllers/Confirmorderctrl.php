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
            if (empty($_POST['payment'])) {
                $objView = DataContModel::getInstance();
                $objModel = new ConfirmOrderModel();
                $quantityAndPrice=$objModel->getQuantityAndPrice();
                $discount=$objModel->getDiscount();
                $payment=$objModel->getPayment();
                $this->arr['quantityAndPrice'] = $quantityAndPrice;
                $this->arr['discount'] = $discount;
                $this->arr['payment'] = $payment;
                $objView->setStartPage('confirmorder.html')->setData($this->arr);
            } else {
                $objModel = new ConfirmOrderModel();
                $quantityAndPrice=$objModel->getQuantityAndPrice();
                $discount=$objModel->getDiscount();
                $paymentId=$_POST['payment'];
                $objModel->setOrder($_SESSION[ 'BookshopID' ], $quantityAndPrice, $paymentId, $discount);
                $objView = DataContModel::getInstance();
				$resArr = $objModel->getArray();
                $objView->setStartPage('thankyou.html')->setData($resArr);
            }

        }
    }
} 
