<?php
 
 class Authors_admin_model
{
	public function __construct(){
	
	}
	
	public function blockAuthors(){ /* receiving list of authors to add in index file */
	
		$objMysql = new MYSQL;
		$listofAuthors = $objMysql->listAuthors();
		
		if (!empty($listofAuthors)) 
		{
			
			foreach ($listofAuthors as $author ) 
			{			
					$authors .= "<p><a href = index.php?page=authors_admin_ctrl&action=edit&author_id=".$author["id"].">".$author["name"]."</a>
			<a href = index.php?page=authors_admin_ctrl&action=delete&author_id=".$author["id"].">DELETE</a></p>";
							
			}
			
		}
		else 
		{
			echo "<p>list of Authors not received</p>";
			exit();
		}
		return $authors;
	
	
	}

	public function authorAdd(){

		$nameAdd = trim($_POST['nameAdd']);
		$nameAdd = strip_tags($nameAdd);
		if (strlen($nameAdd) > 2 && strlen($nameAdd) < 60 )
		{
			$objMysql = new MYSQL;
			$objMysql->saveAuthor($nameAdd);
		}
		else
		{
			echo "author is not valid";
			die();
		}
		return true;
	}
	
	public function validation()
	{
		$variablesArray = array(); 
		if (isset($_POST['author_id']))
		{
			$variablesArray['id'] = $_POST['author_id'];
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
