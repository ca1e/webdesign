<?php
error_reporting(0);
if(isset($_GET['ping']))
{
	switch ($_GET['ping']) {
		case 'tou':
			include("php/pingfen.php"); 
			exit;
		break;
	}
}
else
{
	$act=$_GET['id']==''?'43':$_GET['id'];
	switch ($act) {
		case '43':
			include("php/toup.php");
			break;
		case '26':
			include("php/result.php"); 
			break;
		default:
			include("php/err.php"); 
			break;
		}

}

?>