<?
class Viewer_admin
{
	
	public function __construct()
    {	
	}
	
    public function myFncParseAndReplace($temp, $arr)
    {
			$nashIndexphp = file_get_contents($temp);
			$result =  strtr($nashIndexphp, $arr);
			echo $result;
    }
	
	public function myFncParseAndReplace2($temp, $arr)
    {
			$nashIndexphp = file_get_contents($temp);
			$result =  strtr($nashIndexphp, $arr);
			return $result;
    }
	
}
