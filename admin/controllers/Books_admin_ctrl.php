<?php
class Books_admin_ctrl
{
	public function __construct()
    {
		
		
		$this->run();
	
	}
	
	public function run()
	{
		$objViewer = new Viewer_admin;
		if($_GET['action'] == 'add'){
			if(isset($_GET['form_key']))
			{
				$objBooksModel = new Books_admin_model;
				$result = $objBooksModel->validation();
					
				$objMysql = new MYSQL;
				//added to the main table of all the data and store ID, which is automatically created
				$objMysql->insertAlltoBook($result);
				$nash_id = mysql_insert_id();	
				//add as many entries in the binding table book_to_author, as how many authors were selected
				for ($i = 0; $i <= count ($result['author']) - 1; $i++) 
				{
					$objMysql->inserToBookAuthor($nash_id, $result['author'][$i]);
				}
				//add as many entries in the binding table book_to_genre, as how many genres were selected 
				for ($i = 0; $i <= count ($result['genre']) - 1; $i++) 
				{
					$objMysql->inserToBookGenre($nash_id, $result['genre'][$i]);
				}	
			}
			$objBooksModel = new Books_admin_model;
			$options = $objBooksModel->listInForma();
			
			$arrKeys = array
				(
					'###AUTHORS###' => $options['authors'],
					'###GENRES###' => $options['genres'],
				);
			$forma = $objViewer->myFncParseAndReplace2('templates/html/forma.html', $arrKeys);
		
			$arrKeys = array
				(
					'###ACTION###' => $forma,
				);
		}
		if($_GET['action'] == 'edit'){
			if(isset($_GET['bk_id']))
			{
				$bk_id = trim($_GET['bk_id']);
				$bk_id = strip_tags($bk_id);
				if(empty($bk_id) || !is_numeric($bk_id))
				{
					die('not valid id');
				}
				$objBooksModel = new Books_admin_model;
				$books_data = $objBooksModel->getInfoAboutBook($bk_id);
				$options = $objBooksModel->genresAndAuthorsFromBook($bk_id);
				$arrKeys = array(
					'###ID###' => $books_data[0]['id'],
					'###NAME###' => $books_data[0]['name'],
					'###DESCRIPTION###' => $books_data[0]['description'],
					'###PRICE###' => $books_data[0]['price'],
					'###YEAR###' => $books_data[0]['year'],
					'###IMAGE###' => $books_data[0]['image'],
					'###AUTHORS###' => $options['authors'],
					'###GENRES###' => $options['genres'],
				);
				$forma = $objViewer->myFncParseAndReplace2('templates/html/edit_book.html', $arrKeys);
				$arrKeys = array
				(
					'###ACTION###' => $forma,
				);
			}
			else
			{
				$objBookModel = new Books_admin_model;
				$books = $objBookModel->blockBooks();
				
				$arrKeys = array
				(
					'###ACTION###' => $books,
				);
			}
			//validate edited form and update info in base of edited book
			if(isset($_GET['form_key']))
			{
				$objBooksModel = new Books_admin_model;
				//validate new data. If fail error will be shown
				$result = $objBooksModel->validation();
			
				$objMysql = new MYSQL;
				//added to the main table of all the data and store ID, which is automatically created
				$objMysql->updateAlltoBook($result);
				
				//add as many entries in the binding table book_to_author, as how many authors were selected
				for ($i = 0; $i <= count ($result['author']) - 1; $i++) 
				{
					$objMysql->inserToBookAuthor($result['id'], $result['author'][$i]);
				}
				//add as many entries in the binding table book_to_genre, as how many genres were selected 
				for ($i = 0; $i <= count ($result['genre']) - 1; $i++) 
				{
					$objMysql->inserToBookGenre($result['id'], $result['genre'][$i]);
				}	

			}
		}
		if($_GET['action'] == 'delete'){
			$bk_id = trim($_GET['bk_id']);
				$bk_id = strip_tags($bk_id);
				if(empty($bk_id) || !is_numeric($bk_id))
				{
					die('not valid id');
				}
			$objMysql = new MYSQL;
			$result = $objMysql->bookDelete($bk_id);
			if($result)
			{
			
				$objBookModel = new Books_admin_model;
				$books = $objBookModel->blockBooks();
				
				$arrKeys = array
				(
					'###ACTION###' => $books,
				);
			}	
		}
			
			
		$objViewer->myFncParseAndReplace(HOME_TEMPLATE, $arrKeys);
	
	
	}
}
