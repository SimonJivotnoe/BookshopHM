<?php
 
 class Books_admin_model
{
	public function __construct(){
	
	}
	
	public function blockBooks(){
		
		$objMysql = new MYSQL;
		$listofBooks = $objMysql->listBooks();
		if (!empty($listofBooks)) 
		{
			
			foreach ($listofBooks as $book ) 
			{
				$books .= "<p><a href = index.php?page=books_admin_ctrl&action=edit&bk_id=".$book["id"].">".$book["name"]."</a>
					<a href = index.php?page=books_admin_ctrl&action=delete&bk_id=".$book["id"].">DELETE</a></p>";
			}
			
		}
		else 
		{
			echo "<p>List of Books not received</p>";
			exit();
		}
		return $books;	
	}
	
	public function listInForma()
	{
		$objMysql = new MYSQL;
		$authorsArray = $objMysql->listAuthors();
		$options = array();
		foreach($authorsArray as $author)
		{
			$options['authors'] .= "<option value = '".$author['id']."'>".$author['name']."</option>";
			
		}
		$genresArray = $objMysql->listGenres();
		foreach($genresArray as $genre)
		{
			$options['genres'] .= "<option value = '".$genre['id']."'>".$genre['name']."</option>";
		}
		return $options;
	}
	
	public function genresAndAuthorsFromBook($bk_id)
	{
		$objMysql = new MYSQL;
		//$authorsArray = $objMysql->listAuthors();
		$books_data = $objMysql->editOneBook($bk_id);
		$genres_data = $objMysql->editOneBookGenres($bk_id);
		$authors_data = $objMysql->editOneBookAuthors($bk_id);
		$options = array();

		foreach($authors_data as $author)
		{
			if($author['book_id'] == $bk_id)
			{
				$options['authors'] .= "<option selected value = '".$author['id']."'>".$author['name']."</option>";
			}
			else
			{
				$options['authors'] .= "<option value = '".$author['id']."'>".$author['name']."</option>";
			}
		}
		//$genresArray = $objMysql->listGenres();
		foreach($genres_data as $genre)
		{
			if($genre['book_id'] == $bk_id)
			{
				$options['genres'] .= "<option selected value = '".$genre['id']."'>".$genre['name']."</option>";
			}
			else
			{
				$options['genres'] .= "<option value = '".$genre['id']."'>".$genre['name']."</option>";
			}
			
		}
		return $options;
	}
	
	public function blockAuthorBooks($author_id){
		
		$objMysql = new MYSQL;
		$listofAuthorBooks = $objMysql->listAuthorBooks($author_id);
		if (!empty($listofAuthorBooks)) 
		{
			
			foreach ($listofAuthorBooks as $author ) 
			{
				$authorbooks .= "<p><a href = index.php?page=books_ctrl&bk_id=".$author["id"].">".$author["name"]."</a></p>";
			}
			
		}
		else 
		{
			echo "<p>List of Books not received</p>";
			exit();
		}
		return $authorbooks;
	
	
	}
	
	public function blockGenresBooks($gr_id){
		
		$objMysql = new MYSQL;
		$listofGenresBooks = $objMysql->listGenresBooks($gr_id);
		if (!empty($listofGenresBooks)) 
		{
			
			foreach ($listofGenresBooks as $genre ) 
			{
				$genresbook .= "<p><a href = index.php?page=books_ctrl&bk_id=".$genre["id"].">".$genre["name"]."</a></p>";
			}
			
		}
		else 
		{
			echo "<p>List of Genres not received</p>";
			exit();
		}
		return $genresbook;
	
	
	}
	
	public function blockInfoBook($bk_id){
		$objMysql = new MYSQL;	
		$oneSingleBook = $objMysql->oneBook($bk_id);
		$book = $oneSingleBook[0]["name"].$oneSingleBook[0]["price"].$oneSingleBook[0]["description"].$oneSingleBook[0]["genre"].$oneSingleBook[0]["author"];
		return $book;
	
	}
	
	public function getInfoAboutBook($bk_id)
	{
		$objMysql = new MYSQL;
		$books_data = $objMysql->editOneBook($bk_id);
		return $books_data;
	
	}
	
	public function validation()
	{	$variablesArray = array(); 
		if (isset($_POST['id']))
		{
			$variablesArray['id'] = $_POST['id'];
			if (!is_numeric($variablesArray['id']))
			{
				die('you are a bad hacker!');
			}
		}
		$variablesArray['name'] = trim($_POST['name']);
		$variablesArray['name'] = strip_tags($variablesArray['name']);
		if (strlen($variablesArray['name']) < 2 || strlen($variablesArray['name']) > 60 )
		{
			die('name length must be more 2 and less then 60');
		}
		
		$variablesArray['description'] = trim($_POST['description']);
		$variablesArray['description'] = strip_tags($variablesArray['description']);
		if (strlen($variablesArray['description']) < 12 || strlen($variablesArray['description']) > 2000 )
		{
			die('description length must be more 12 and less then 2000');
		}
		else
		{
			$variablesArray['description'] = htmlspecialchars($variablesArray['description'], ENT_QUOTES);
		}
		
		$variablesArray['price'] = trim($_POST['price']);
		$variablesArray['price'] = strip_tags($variablesArray['price']);
		if (!is_numeric($variablesArray['price']))
		{
			die('price must be numeric more then 0 and less then 10 000');
		}
		
		$variablesArray['year'] = trim($_POST['year']);
		$variablesArray['year'] = strip_tags($variablesArray['year']);
		if (!is_numeric($variablesArray['year']))
		{
			die('year must be year');
		}
		
		$variablesArray['image'] = trim($_POST['image']);
		$variablesArray['image'] = strip_tags($variablesArray['image']);
		if (strlen($variablesArray['image']) < 1 || strlen($variablesArray['image']) > 255 )
		{
			die('image length must be more 0 and less then 255');
		}
		
		if(!isset($_POST['author']) || !isset($_POST['genre']))
		{
			die('select at list one author and one genre from the list');
		}
		foreach($_POST['author'] as $author)
		{
			$author = strip_tags($author);
			if (!is_numeric($author))
			{
				die('select author from the list');
			}
			else
			{
				$variablesArray['author'][] = $author;
			}
		}
		
		foreach($_POST['genre'] as $genre)
		{
			$genre = strip_tags($genre);
			if (!is_numeric($genre))
			{
				die('select genre from the list');
			}
			else
			{
				$variablesArray['genre'][] = $genre;
			}
		}
		
		
		return $variablesArray;
	
	}





}