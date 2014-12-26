<?php
error_reporting(0);
include_once "ez_sql_core.php";
include_once "ez_sql_mysql.php";
$db = new ezSQL_mysql('web',
	'','test','localhost');
function injvar($a)
{
	global $db;
	//echo "select * from user where name='$a'";
	$r = $db->get_results("select * from user where name=$a");
	//var_dump($r);
	return $r;

}
?>