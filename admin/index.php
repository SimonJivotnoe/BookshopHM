<?php
include 'config.php';
include 'RouterAdmin.php';

function __autoload($class)
{
   $directorys = array(
            '/controllers/',
            '/models/',
            '/view/'
        );
		//foreach directory
        foreach($directorys as $directory)
        {
            //see if the file exsists
            if(file_exists(dirname(__FILE__).$directory.$class.'.php'))
            {
                require_once(dirname(__FILE__).$directory.$class.'.php');
                //only require the class once, so quit after to save effort (if you got more, then name them something else 
                return;
            }            
        }
}
$router = new RouterAdmin();