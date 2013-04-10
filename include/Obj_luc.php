<?php

require_once 'config.php';
require_once '../obj/DB.php';

if (!isset($_POST['Q'])) {
    $tab_connection = array(
        "text" => "Erreur POST",
        "id_connection" => "1"
    );
} else if ($_POST["Q"] == "QnI") {
    query_bdd();
}

function query_bdd() {
    //$DB = new DB();
    
    $commentaire = $_POST['comm'];
    $etat = $_POST['etat'];
    $id_pers = $_POST['id_pers'];
    $id_note = $_POST ['id_note'];
    
    $chaine = $commentaire." -- ".$etat." -- ".$id_pers." -- ".$id_note;
    
    echo $chaine;
    //$DB->query($query);
}

?>
