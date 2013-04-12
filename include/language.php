<?php

require_once 'constantes.inc.php';
session_start();
if(!isset($_SESSION['langue']))
{
    $_SESSION['langue'] = "fr_FR";
}
switch ($_SESSION['langue']){
        case "fr_FR": include(RACINE.'include/lang/fr_FR.php');
            break;
        default : include(RACINE.'include/lang/fr_FR.php');
}


function curPageURL() {
 
    return 'http://'.$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
}
?>