<?php

session_start();
require_once('../include/config.php');
require_once '../include/constantes.inc.php';

if (!isset($_SESSION['mode']) || $_SESSION['mode']='0' )
{
    header('Location: '.RACINE_SITE.'index.php');
}
?>