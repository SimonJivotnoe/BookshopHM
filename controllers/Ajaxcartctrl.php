<?php

/*
class Ajaxcartctrl
{
    public function __construct()
    {
        $pdo = DataBaseModel::connect();
        $user_id = $_SESSION[ 'BookshopID' ];
        $book_id = $_GET[ 'bk_id' ];
        $quantity = $_GET[ 'quantity' ];
        $delete = $_GET['delete'];
        if (!empty($delete)) {
            $pdo->delete("cart")
                ->where("user_id ='$user_id' AND book_id = '$book_id'")
                ->exec();
            DataContModel::getInstance()->setData(array());
        } else {
        if (!empty($book_id)) {
            $resSel = $pdo->select("user_id, book_id, quantity")
                           ->from("cart")
                           ->where("user_id ='$user_id' AND book_id = '$book_id'")
                            ->exec();
            if (count($resSel) == 0 && $user_id != 0) {
                $pdo->insert("cart")
                    ->fields("user_id, book_id, quantity")
                    ->values("'$user_id', '$book_id', 1")
                    ->execInsert();
            } else {
                   $pdo->update("cart")
                       ->set("quantity = quantity+'$quantity'")
                       ->where("user_id ='$user_id' AND book_id = '$book_id'")
                       ->execInsert();
            }
        }
            $res = $pdo->select("b.price, b.id, c.quantity, b.name ")
                ->from("books b JOIN cart c ON c.book_id=b.id")
                ->where("c.user_id ='$user_id'")
                ->exec();
            DataContModel::getInstance()->setData($res);
    }}
} */
/**
 * Class AjaxCartCtrl
 */

class Ajaxcartctrl
{
    /**
     *
     */
    public function __construct()
    {
        $pdo = DataBaseModel::connect();
        $objModel = new AgentDBModel();
        $user_id = $_SESSION[ 'BookshopID' ];
        $book_id = $_GET[ 'bk_id' ];
        $quantity = $_GET[ 'quantity' ];
        $delete = $_GET['delete'];
        if (!empty($delete)) {
            $objModel->deleteFromCart($user_id, $book_id);
            DataContModel::getInstance()->setData(array());
        } else {
        if (!empty($book_id)) {
            $resSel = $objModel->getBookIDAndQuantity($user_id, $book_id);
            if (count($resSel) == 0 && $user_id != 0) {
                $objModel->insertBookToCart($user_id, $book_id);
            } else {
                $objModel->updateBookToCart($user_id, $book_id, $quantity);
            }
        }
            $res = $objModel->allBooksInCart($user_id);
            DataContModel::getInstance()->setData($res);
    }}
} 
