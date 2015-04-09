<?php
class Home_admin_ctrl
{
	public function __construct()
    {
	}
	
	public function run()
	{
		
		$arrKeys = array
		(
			'###ACTION###' => '',
		);
				
		$objViewer = new Viewer_admin;	
		$objViewer->myFncParseAndReplace(HOME_TEMPLATE, $arrKeys);
		
	}
}
