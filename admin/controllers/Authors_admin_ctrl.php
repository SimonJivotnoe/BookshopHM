<?php
class Authors_admin_ctrl
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
				$objAuthorModel = new Authors_admin_model;
				$result = $objAuthorModel->authorAdd();
				if($result == true)
				{
					echo "Author successfully add!";
				}
			
			}
				$formAdd = "<form method='POST' action='index.php?page=authors_admin_ctrl&action=add'>
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
			if(isset($_GET['author_id']))
			{
				$author_id = trim($_GET['author_id']);
				$author_id = strip_tags($author_id);
				if(empty($author_id) || !is_numeric($author_id))
				{
					die('not valid id');
				}
				$objMysql = new Mysql;
				$author = $objMysql->infoOneAuthor($author_id);
				$forma = "<form method='POST' action='index.php?page=authors_admin_ctrl&action=edit&form_key=valid_value'>
							<input type='text' name='nameEdit' value='".$author[0]["name"]."'>
							<input type='hidden' name='author_id' value='".$author[0]["id"]."'>
							<input type='submit' name='edit' value='edit'>";
				$arrKeys = array
				(
					'###ACTION###' => $forma,
				);
				
			}
			else
			{
				$objGenres = new Authors_admin_model;
				$authors = $objGenres->blockAuthors();
				$arrKeys = array
				(
					'###ACTION###' => $authors,
				);
			}
			if(isset($_POST['edit']))
			{
				$objAuthorsModel = new Authors_admin_model;
				//validate new data. If fail error will be shown
				$idAndName = $objAuthorsModel->validation();
 				
				$objMysql = new MYSQL;
				$result = $objMysql->editAuthor($idAndName['name'], $idAndName['id']);
				if($result == true)
				{
					echo "Author successfully edit!";
				}
			}
		}
		/*** DELETE ***/
		elseif($_GET['action'] == 'delete'){
		
			$author_id = trim($_GET['author_id']);
			$author_id = strip_tags($author_id);
			if(empty($author_id) || !is_numeric($author_id))
			{
				die('not valid id');
			}
			
			$objMysql = new MYSQL;
			$result = $objMysql->deleteAuthor($author_id);
			
			$objGenres = new Authors_admin_model;
			$authors = $objGenres->blockAuthors();
			$arrKeys = array
			(
				'###ACTION###' => $authors,
			);
		}
		$objViewer = new Viewer_admin;	
		$objViewer->myFncParseAndReplace(HOME_TEMPLATE, $arrKeys);
		
	}
}