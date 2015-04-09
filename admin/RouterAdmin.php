<?php
class RouterAdmin
{
	
    public function __construct()
    {
		
		if (!empty ( $_GET['page'] ))
        {
                $controllerNameinSmallLetters = $_GET['page'];
		}
		if(isset($controllerNameinSmallLetters))
			{
			    //after finding key "page" in array $_GET we assigns to $pageName value of key "page"
				//capitalizes the first letter of the value of the variable $pageName
				$pageName = ucfirst($controllerNameinSmallLetters);
				// create a path to the controller, for example C://bookshop/controllers/Book_ctrl.php
				$pagePass = realpath(__DIR__).'/controllers/'.$pageName.'.php';
				//check whether there is such a file
				if(file_exists($pagePass))		
				{
					//launching the controller
					$Controller = new $pageName;
					
					
				}
				else
				{
				echo "this page not exist";
//					$controller = new C_404;
				}
			}
			else
			{
				$objDefaultPage = new Home_admin_ctrl;
				$objDefaultPage->run();
			}
    }
  
}