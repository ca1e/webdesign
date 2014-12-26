<?php
error_reporting(0);
require_once "php/dbset.php";
require "/php/template.php";

        $arr=["","progress-bar-warning",
        "progress-bar-success",
        "progress-bar-info",
        "progress-bar-danger"];

$tpl = new Template("templates","keep");
$tpl->set_file("result","result.html");

$count = usercount();
$rlt = getalluser();
$tpl->set_block("result", "list", "lists");
for($i=0;$i<$count;$i++)
{
	$c=$rlt[$i];
	$tpl->set_var("proname",base64_decode($c->proname));
	$tpl->set_var("thevalue",gettik($c->proname));
	$tpl->parse("lists", "list", true); 
}

$tpl->parse("output","result");
$tpl->p("output");
?>