<?php
error_reporting(0);
include_once "ez_sql_core.php";
include_once "ez_sql_mysql.php";
$db = new ezSQL_mysql('web',
	'','test','localhost');
function usercount()
{
	global $db;
	return $db->get_var("select count(*) from userlist");
}
function getalluser()
{
	global $db;
	return $db->get_results("select * from userlist");
}
function insertme($pron,$au,$inf)
{
	global $db;
	$pron=@$pron;
	$au=@$au;
	$inf=@$inf;
	$cmd="insert into userlist values('".$pron."','";
		$cmd=$cmd.$au."','";
		$cmd=$cmd.$inf."')";
	$db->query($cmd);
}
function delme($pro)
{
	global $db;
	$pro=@$pro;
	$cmd="delete from userlist where proname='$pro'";
	$db->query($cmd);
}
function getname($zu)
{
	$zu=intval($zu);
	$c=usercount();
	if($c==$zu-1)
		{return false;}
	global $db;
	$rlt=$db->get_results("select * from userlist");
	$r= $rlt[$zu-1]->proname;
	return base64_decode($r);
}
function gettik($name)
{
	global $db;
	$tik1=0;
	$name=@$name;
	$c=$db->get_var("select count(*) from teachtik where auth='$name' and id<>-1");
	$r=$db->get_results("select * from teachtik where auth='$name' and id<>-1");
	for($i=0;$i<$c;$i++){
		$rt=$r[$i];
		$tik1 += intval($rt->bj);
	}
	$tik1=$tik1/$c;
	$au = $db->get_var("select auth from userlist where proname='$name'");
	$tik2= $db->get_var("select count(*) from toulist where auth='$au'");
	$tik2=$tik2/10;
	return $tik1+$tik2;
}
function tou($t,$c,$adr)
{
	global $db;
	$c=@$c;
	$adr=@$adr;
	$rlt=$db->get_var("select mynum from numlist where mynum='$c'");
	if($rlt==null)
	{return -1;}//无此学号
	$rlt=$db->get_var("select num from toulist where num='$c'");
	if($rlt==$c)
	{return -2;}//投过
	$db->query("insert into toulist values('$t','$c','$adr',0)");
	return 0;
}
function teachtou($tid,$proname,$valu)
{
	global $db;
	$proname=@$proname;
	$valu=@$valu;
	$db->query("insert into teachtik values('$tid','$proname',$valu)");
}
function run()
{
	global $db;
	$relt=$db->get_var("select isrunning from datalist");
	if($relt==0){return false;}
	else{return true;}
}
function togglerun()
{
	global $db;
	$relt=$db->get_var("select isrunning from datalist");

	$relt=$relt==0?1:0;

	$relt=$db->query("update datalist set isrunning='$relt' where 1");
}
?>