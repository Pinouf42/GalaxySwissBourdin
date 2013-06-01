<?php

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
    
    $DB = new DB();
    
        
    $commentaire = base64_encode($_POST['comm']);
    $etat = $_POST['etat'];
    $id_pers = $_POST['id_pers'];
    $id_note = $_POST ['id_note'];
    $date_validation = date("m/d/Y");
    
    //$chaine = $commentaire." -- ".$etat." -- ".$id_pers." -- ".$id_note." -- ".$date_validation;
    $sql ="INSERT INTO VALIDATION values ('".$id_note."','".$commentaire."','".$id_pers."','".$etat."','".$date_validation."')";
    $chaine =$DB->query($sql);
    
    echo json_encode($chaine);
    
}

?>
