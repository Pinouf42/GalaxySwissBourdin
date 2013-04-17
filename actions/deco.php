<?php

require_once '../include/constantes.inc.php';

session_unset();
session_destroy();

header('Location: '.RACINE_SITE.'index.php');
?>
