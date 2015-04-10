<?php


/**
 * Class AgentDBModel
 */
class AgentDBModel
{
    /**
     *
     */
    public function __construct()
    {
        $pdo = DataBaseModel::connect();
    }

    /**
     * @param $author_id
     * @return mixed
     */
    public function getListOfAuthorBooks($author_id){
        $pdo = DataBaseModel::connect();
        $listOfAuthorBooks = $pdo->select("b.id, b.name, b.price, b.image")
            ->from("books b, authors a,
			book_to_author ba")
            ->where("ba.book_id = b.id
			and a.id = ba.author_id
			and a.id = ".$author_id."
			GROUP BY b.name")
            ->exec();
        return $listOfAuthorBooks;
    }

    /**
     * @param $genre_id
     * @return mixed
     */
    public function getListOfGenresBooks($genre_id){
        $pdo = DataBaseModel::connect();
        $listOfGenresBooks = $pdo->select("b.id, b.name, b.price, b.image")
            ->from("books b, genres g,
			book_to_genre bg")
            ->where("bg.book_id = b.id
			and g.id = bg.genre_id
			and g.id = ".$genre_id."
			GROUP BY b.name")
            ->exec();
        return $listOfGenresBooks;
    }

    /**
     * @param $book_id
     * @return mixed
     */
    public function getOneSingleBook($book_id){
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
			and b.id = ".$book_id."
			GROUP BY b.name")
            ->exec();
        return $oneSingleBook;
    }

    /**
     * @param $user_id
     * @param $book_id
     */
    public function deleteFromCart($user_id, $book_id){
        $pdo = DataBaseModel::connect();
        $pdo->delete("cart")
            ->where("user_id ='$user_id' AND book_id = '$book_id'")
            ->exec();
    }

    /**
     * @param $user_id
     * @param $book_id
     * @return mixed
     */
    public function getBookIDAndQuantity($user_id, $book_id){
        $pdo = DataBaseModel::connect();
        $resSel = $pdo->select("user_id, book_id, quantity")
            ->from("cart")
            ->where("user_id ='$user_id' AND book_id = '$book_id'")
            ->exec();
        return $resSel;
    }

    /**
     * @param $user_id
     * @param $book_id
     */
    public function insertBookToCart($user_id, $book_id){
    $pdo = DataBaseModel::connect();
    $pdo->insert("cart")
        ->fields("user_id, book_id, quantity")
        ->values("'$user_id', '$book_id', 1")
        ->execInsert();
    }

    /**
     * @param $user_id
     * @param $book_id
     * @param $quantity
     */
    public function updateBookToCart($user_id, $book_id, $quantity){
        $pdo = DataBaseModel::connect();
        $pdo->update("cart")
            ->set("quantity = quantity+'$quantity'")
            ->where("user_id ='$user_id' AND book_id = '$book_id'")
            ->execInsert();
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function allBooksInCart($user_id){
        $pdo = DataBaseModel::connect();
        $res = $pdo->select("b.price, b.id, c.quantity, b.name ")
            ->from("books b JOIN cart c ON c.book_id=b.id")
            ->where("c.user_id ='$user_id'")
            ->exec();
        return $res;
    }

    /**
     * @param $table
     * @return mixed
     */
    public function selectAll($table){
        $pdo = DataBaseModel::connect();
        $result= $pdo->select('* ')->from($table)->exec();
        return $result;
    }

    /**
     * @param $name
     * @return mixed
     */
    public static function checkLogin($name){
        $pdo = DataBaseModel::connect();
        $login = $pdo->select('user_login ')->from("users WHERE user_login = '$name'")->exec();
        return $login;
    }

    /**
     * @param $login
     * @param $pass
     * @return mixed
     */
    public function selectUser($login, $pass){
        $pdo = DataBaseModel::connect();
        $result= $pdo->select("user_login, user_id ")->from("users WHERE user_login = '$login' AND
                user_pass = '$pass'")->exec();
        return $result;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function selectUserOnReg($name){
        $pdo = DataBaseModel::connect();
        $result = $pdo->select("user_login")->from("users WHERE user_login = '$name'")->exec();
        return $result;
    }

    /**
     * @param $name
     * @param $pass
     * @param $email
     * @return mixed
     */
    public function selectAllUsers($name, $pass, $email){
        $pdo = DataBaseModel::connect();
        $res = $pdo->insert("users")
            ->fields("user_login, user_pass, user_email")
            ->values("'$name', '$pass', '$email'")
            ->execInsertWithLastID();
        return $res;
    }
} 
