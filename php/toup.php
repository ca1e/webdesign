<?php
error_reporting(0);
session_start();
require_once "php/dbset.php";
require "/php/template.php";
$tpl = new Template("templates","keep");
$tpl->set_file("toupiao","toupiao.html");

$OK=run();
if($OK){
	$tpl->set_var("rltclass");
}else{
	$tpl->set_var("rltclass","disabled");
}
$r= "";
if(isset($_POST['celnum']))
{
	$tpl->set_var("ishidden");
	if(isset($_SESSION['tou']))
	{
		$r = "对不起，你已经投过票了，请与管理员联系。";
	}else{
		$c=tou($_POST['theplay'],
			$_POST['celnum'],
	      $_SERVER["REMOTE_ADDR"]);

		switch($c)
		{
			case 0:
			$_SESSION['tou']=1;
			$r= "投票成功，谢谢参与。";
			break;
			case -2:
			$r= "对不起，你已经投过票了，请与管理员联系。";
			break;
			case -1:
			$r= "对不起，暂时无法投票。";
			break;
		}
	}
}else
{
	$tpl->set_var("ishidden","hidden");
}
$tpl->set_var("rltresult",$r);

$count = usercount();
$rlt = getalluser();
$tpl->set_block("toupiao", "list", "lists");
for($i=0;$i<$count;$i++){
	$c=$rlt[$i];
	$tpl->set_var("proname",
		base64_decode($c->proname));
	$tpl->set_var("auth",
		base64_decode($c->auth));
	$tpl->set_var("deauth",$c->auth);
	$tpl->set_var("info",
		base64_decode($c->inf));
	$tpl->parse("lists", "list", true); 
}

if(isset($_POST['toua']))
{
	$tpl->set_var("finaldata",$_POST['toua']);
	$tpl->set_var("alertmsg","$('#touModal').modal()");
}else
{
	$tpl->set_var("finaldata");
	$tpl->set_var("alertmsg");
}

$tpl->parse("output","toupiao");
$tpl->p("output");
?>