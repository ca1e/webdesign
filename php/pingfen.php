<?php
error_reporting(0);
require_once "php/dbset.php";
require "/php/template.php";

		$arr=["mg-bj","sc-dp",
    	"wy-xg","js-dm",
    	"nr-zt","nr-nr",
    	"nr-xy","lc-d",
    	"jj-td","xx-d"
    	];

$tpl = new Template("templates","keep");
$tpl->set_file("pingfen","pingfen.html");

if(isset($_POST['zubie']))
{
	$zu=intval($_POST['zubie']);
	$sum=0;
	if(isset($_POST['mg-bj']))
	{
		for($i=0;$i<12;$i++){
			$sum += $_POST[$arr[$i]];
		}
		teachtou(TID,
			base64_encode(getname($zu)),
			$sum);
	}
  $zu += 1;
}else{
  $zu=1;
}

if(getname($zu))
{
	$tpl->set_var("posinfo",
		"您当前评分的是".$zu."号选手，作品名称是".getname($zu));
	$tpl->set_var("posval"," name='zubie' value='$zu'");

}else{
	$tpl->set_var("posinfo",
		"啊哦，已经没有选手要投票了哦");
	$tpl->set_var("posval"," name='zubie' value=200");
}

$tpl->parse("output","pingfen");
$tpl->p("output");


?>