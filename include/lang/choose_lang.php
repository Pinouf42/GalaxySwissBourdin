<?php
session_start();
if($_GET['lang'] == "fr_FR")
{
	$_SESSION['langue'] = "fr_FR";
}
else
{
	$_SESSION['langue'] = "fr_FR";
}
header('Location: '.$_GET['url']);
?>