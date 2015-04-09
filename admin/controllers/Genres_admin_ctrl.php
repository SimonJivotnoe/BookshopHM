<?php
class Genres_admin_ctrl
{
	public function __construct()
    {
		$this->run();
	}
	
	public function run()
	{
		/*** ADD ***/
		if($_GET['action'] == 'add'){
		
			if(isset($_POST['nameAdd']))
			{
				$objGenreModel = new Genres_admin_model;
				$result = $objGenreModel->genreAdd();
				if($result == true)
				{
					echo "Genre successfully add!";
				}
			
			}
				$formAdd = "<form method='POST' action='index.php?page=genres_admin_ctrl&action=add'>
									<input type='text' name='nameAdd'>
									<input type='submit' value='Add'>
								</form>";
				$arrKeys = array
				(
					'###ACTION###' => $formAdd,
				);
				
		}
		/*** EDIT ***/
		elseif($_GET['action'] == 'edit'){
			if(isset($_GET['genre_id']))
			{
				$genre_id = trim($_GET['genre_id']);
				$genre_id = strip_tags($genre_id);
				if(empty($genre_id) || !is_numeric($genre_id))
				{
					die('not valid id');
				}
				$objMysql = new Mysql;
				$genre = $objMysql->infoOneGenre($genre_id);
				$forma = "<form method='POST' action='index.php?page=genres_admin_ctrl&action=edit&form_key=valid_value'>
							<input type='text' name='nameEdit' value='".$genre[0]["name"]."'>
							<input type='hidden' name='genre_id' value='".$genre[0]["id"]."'>
							<input type='submit' name='edit' value='edit'>";
				$arrKeys = array
				(
					'###ACTION###' => $forma,
				);
				
			}
			else
			{
				$objGenres = new Genres_admin_model;
				$genres = $objGenres->blockGenres();
				$arrKeys = array
				(
					'###ACTION###' => $genres,
				);
			}
			if(isset($_POST['edit']))
			{
				$objGenresModel = new Genres_admin_model;
				//validate new data. If fail error will be shown
				$idAndName = $objGenresModel->validation();
 				
				$objMysql = new MYSQL;
				$result = $objMysql->editGenre($idAndName['name'], $idAndName['id']);
				if($result == true)
				{
					echo "Genre successfully edit!";
				}
			}
		}
		/*** DELETE ***/
		elseif($_GET['action'] == 'delete'){
		
			$genre_id = trim($_GET['genre_id']);
			$genre_id = strip_tags($genre_id);
			if(empty($genre_id) || !is_numeric($genre_id))
			{
				die('not valid id');
			}
			
			$objMysql = new MYSQL;
			$result = $objMysql->deleteGenre($genre_id);
			
			$objGenres = new Genres_admin_model;
			$genres = $objGenres->blockGenres();
			$arrKeys = array
			(
				'###ACTION###' => $genres,
			);
		}
		$objViewer = new Viewer_admin;	
		$objViewer->myFncParseAndReplace(HOME_TEMPLATE, $arrKeys);
		
	}
}