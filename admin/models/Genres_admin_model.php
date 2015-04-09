<?php
 
 class Genres_admin_model
{
	public function __construct(){
	
	}
	
	public function blockGenres(){ /* receiving list of genres to add in index file */
	
		$objMysql = new MYSQL;
		$listofGenres = $objMysql->listGenres();
		
		if (!empty($listofGenres)) 
		{
			
			foreach ($listofGenres as $genre ) 
			{			
					$genres .= "<p><a href = index.php?page=genres_admin_ctrl&action=edit&genre_id=".$genre["id"].">".$genre["name"]."</a>
			<a href = index.php?page=genres_admin_ctrl&action=delete&genre_id=".$genre["id"].">DELETE</a></p>";
							
			}
			
		}
		else 
		{
			echo "<p>list of Genres not received</p>";
			exit();
		}
		return $genres;
	
	
	}

	public function genreAdd(){

		$nameAdd = trim($_POST['nameAdd']);
		$nameAdd = strip_tags($nameAdd);
		if (strlen($nameAdd) > 2 && strlen($nameAdd) < 60 )
		{
			$objMysql = new MYSQL;
			$objMysql->saveGenre($nameAdd);
		}
		else
		{
			echo "genre is not valid";
			die();
		}
		return true;
	}
	
	public function validation()
	{
		$variablesArray = array(); 
		if (isset($_POST['genre_id']))
		{
			$variablesArray['id'] = $_POST['genre_id'];
			if (!is_numeric($variablesArray['id']))
			{
				die('you are a bad hacker!');
			}
		}
		$variablesArray['name'] = trim($_POST['nameEdit']);
		$variablesArray['name'] = strip_tags($variablesArray['name']);
		if (strlen($variablesArray['name']) < 2 || strlen($variablesArray['name']) > 60 )
		{
			die('name length must be more 2 and less then 60');
		}
		return $variablesArray;
	
	}

}	