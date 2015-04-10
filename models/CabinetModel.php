<?php


/**
 * Class CabinetModel
 */
class CabinetModel {
    /**
     *
     */
    public function __construct() {

    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function getHead($user_id){
        $pdo = DataBaseModel::connect();
        //$user_id = $_SESSION[ 'BookshopID' ];
        $res = $pdo->select("date_time, price, order_status, order_id ")
            ->from("orders")
            ->where("user_id ='$user_id'")
            ->exec();
        return $res;
    }
}
