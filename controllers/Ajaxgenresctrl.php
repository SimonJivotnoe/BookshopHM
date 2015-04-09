<?php


class Ajaxgenresctrl {
    public function __construct(){
        $pdo = DataBaseModel::connect();
        $listOfGenresBooks = $pdo->select("b.id, b.name, b.price, b.image")
            ->from("books b, genres g,
			book_to_genre bg")
            ->where("bg.book_id = b.id
			and g.id = bg.genre_id
			and g.id = ".$_GET[gr_id]."
			GROUP BY b.name")
            ->exec();
        DataContModel::getInstance()->setData($listOfGenresBooks);
    }

} 
