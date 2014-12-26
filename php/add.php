<?php
error_reporting(0);
include_once "dbset.php";
require "template.php";
$tpl = new Template("../templates","keep");
$tpl->set_file("add","add.html");

$count = usercount();
$rlt = getalluser();
$tpl->set_block("add", "list", "lists");
for($i=0;$i<$count;$i++)
{
	$c=$rlt[$i];
	$tpl->set_var("name",base64_decode($c->proname));
	$tpl->set_var("auth",base64_decode($c->auth));
	$tpl->parse("lists", "list", true); 
}
$tpl->set_var("arerun",run());
if(isset($_POST['isrun']))
{
	togglerun();
}
if(isset($_POST['delname']))
{
	$d=base64_encode($_POST['delname']);
	delme($d);
	echo $d;
	echo 'OK';
}
if(isset($_POST['thename']))
{
	$n=base64_encode($_POST['thename']);
	$a=base64_encode($_POST['theauth']);
	$i=base64_encode($_POST['theinf']);
	insertme($n,$a,$i);
	echo 'Success!';
}
$tpl->parse("output","add");
$tpl->p("output");
?>