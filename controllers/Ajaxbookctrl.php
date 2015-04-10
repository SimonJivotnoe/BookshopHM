<?php


/*class Ajaxbookctrl {

    public function __construct() {
        $pdo = DataBaseModel::connect();
        $oneSingleBook = $pdo->select("b.id, b.name, b.description, b.price, b.year, b.image,
						GROUP_CONCAT(DISTINCT g.name) as genre,
						GROUP_CONCAT(DISTINCT a.name) as author")
            ->from("books b, genres g, authors a,
			book_to_genre bg, book_to_author ba")
            ->where("bg.book_id = b.id
			and ba.book_id = b.id
			and g.id = bg.genre_id
			and a.id = ba.author_id
			and b.id = ".$_GET['bk_id']."
			GROUP BY b.name")
            ->exec();
        DataContModel::getInstance()->setData($oneSingleBook);
     }
} */
/**
 * Class Ajaxbookctrl
 */
class Ajaxbookctrl {

    /**
     *
     */
    public function __construct() {
        $objModel = new AgentDBModel();
        $oneSingleBook = $objModel->getOneSingleBook($_GET['bk_id']);
        DataContModel::getInstance()->setData($oneSingleBook);
     }
} 
