<?php


/*class Ajaxauthorsctrl {

    public function __construct(){
        $pdo = DataBaseModel::connect();
        $listOfAuthorBooks = $pdo->select("b.id, b.name, b.price, b.image")
            ->from("books b, authors a,
			book_to_author ba")
            ->where("ba.book_id = b.id
			and a.id = ba.author_id
			and a.id = ".$_GET['author_id']."
			GROUP BY b.name")
            ->exec();
        DataContModel::getInstance()->setData($listOfAuthorBooks);
    }

} */
/**
 * Class Ajaxauthorsctrl
 */
class Ajaxauthorsctrl {

    /**
     *
     */
    public function __construct(){
        $objModel = new AgentDBModel();
        $listOfAuthorBooks = $objModel->getListOfAuthorBooks($_GET['author_id']);
        DataContModel::getInstance()->setData($listOfAuthorBooks);
    }

} 
