<?php


class ConfirmOrderModel {
	private $resArr =array();

    public function __construct() {

    }
	
	public function getArray(){
		return $this->resArr;
		}

    public function getQuantityAndPrice($user_id){
        $pdo = DataBaseModel::connect();
        //$user_id = $_SESSION[ 'BookshopID' ];
        $res = $pdo->select("b.price, b.id, c.quantity, b.name, b.image ")
            ->from("books b JOIN cart c ON c.book_id=b.id")
            ->where("c.user_id ='$user_id'")
            ->exec();
        return $res;
    }
    public function getDiscount($user_id){
        $pdo = DataBaseModel::connect();
        //$user_id = $_SESSION[ 'BookshopID' ];
        $res = $pdo->select("user_discount ")
            ->from("users")
            ->where("user_id ='$user_id'")
            ->exec();
        return $res;
    }
    public function getPayment(){
        $pdo = DataBaseModel::connect();
        $res = $pdo->select("payment_id, payment_name ")
            ->from("payment")
            ->exec();
        return $res;
    }

    public function setOrder($user_id, $priceF, $payment_id, $discountF){
        $quantity = 0;
        $price = 0;
        $discount = 0;
        foreach ($priceF as $key => $val){
            $quantity += (int)$val['quantity'];
            $price += (int)$val['quantity'] * (int)$val['price'];
        }
        foreach ($discountF as $key => $val){
            $discount += (int)$val['user_discount'];

        }
        if ($discount > 0) {
            $price = $price - $price / $discount;
        }
        $pdo = DataBaseModel::connect();
        $resOrder = $pdo->insert("orders")
            ->fields("user_id, price, payment_id")
            ->values("'$user_id', '$price', '$payment_id'")
            ->execInsertWithLastID();
		$this->resArr['%ORDER%'] = $resOrder;

        if(!empty($resOrder)){
            foreach ($priceF as $key => $val){
                $bk_id = $val['id'];
                $quan = $val['quantity'];
                $pdo->insert("book_to_order")
                    ->fields("book_id, order_id, quantity")
                    ->values("'$bk_id', '$resOrder', '$quan'")
                    ->execInsert();
            }
                $pdo->delete("cart")
                    ->whereD("user_id = '$user_id'")
                    ->execInsert();
					return true;
        }
    }
} 
