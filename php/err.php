<?php
require_once "php/dbset1.php";
require "/php/template.php";
$tpl = new Template("templates","keep");
$tpl->set_file("injehack","injehack.html");

$_AppPath = str_replace($_SERVER['DOCUMENT_ROOT'], '', __FILE__);
$_UrlPath = $_SERVER['REQUEST_URI'];
$_AppPathArr = explode(DIRECTORY_SEPARATOR, $_AppPath);
for ($i = 0; $i < count($_AppPathArr); $i++) {
    $p = $_AppPathArr[$i];
    if ($p) {
        $_UrlPath = preg_replace('/^\/'.$p.'\//', '/', $_UrlPath, 1);
    }
}
$_UrlPath = preg_replace('/^\//', '', $_UrlPath, 1);

$a=explode("?",$_UrlPath);
$a= $a[1];
$a=explode("=",$a);
$a= $a[1];

$a= str_replace("%20"," ",$a);
$b= injvar($a);
$b=$b[0];
$tpl->set_var("err",$b->name);
$tpl->set_var("err1",$b->password);
$tpl->set_var("err2",$b->c);

$tpl->parse("output","injehack");
$tpl->p("output");
?>