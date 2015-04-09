<?php


class Cabinetpaletteadminctrl {

    public function __construct()
    {
        $objModel = new Cabinetadminmodel();
        if (!empty($_POST['changeStatus'])) {
            $order_id = $_GET['order_id'];
           $order_status = $_POST['status'];
           $objModel->changeOrderStatus($order_id, $order_status);
       } else {

       }
        $objViewer = new Viewer_admin;

            $head = $objModel->getHead();
        $orders = $objModel->getArr($head);
        $objViewer->myFncParseAndReplace(HOME_TEMPLATE, $orders);
    }
} 