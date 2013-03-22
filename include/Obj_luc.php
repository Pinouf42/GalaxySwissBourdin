<?php

include('config.php');
if (!isset($_POST['id'])) {
    $tab_connection = array(
        "text" => "Erreur POST",
        "id_connection" => "1"
    );
} else if ($_POST["id"] == "connection") {
    bdd_connection($host, $username, $password);
} else if ($_POST['id'] == "query_note") {
    bdd_query_note($host, $username, $password);
} else if ($_POST['id'] == "query_nbr_note") {
    query_nbr_note($host, $username, $password);
}

/* ¨Pour les test */
if(isset($_GET['id'])) {
    if ($_GET['id'] == 'test') {
        bdd_connection($host, $username, $password);
    }
}
/* Fin test */

function bdd_connection($pHost, $pUsername, $pPassword) {
    if (mssql_connect($pHost, $pUsername, $pPassword) != FALSE) {
        $tab_connection = array(
            "text" => "Connexion au serveur distant réussie",
            "id_connection" => "1"
        );
    } else {
        $tab_connection = array(
            "text" => "Echec de la connexion au serveur " . $pHost . "",
            "id_connection" => "0"
        );
    }

    MJson_connexion($tab_connection);
}

function bdd_query_note($pHost, $pUsername, $pPassword) {
    if (mssql_connect($pHost, $pUsername, $pPassword) != FALSE) {
        $tab_connection = array(
            "text" => "Connexion au serveur distant réussie",
            "id_connection" => "1"
        );
    } else {
        $tab_connection = array(
            "text" => "Echec de la connexion au serveur distant",
            "id_connection" => "0"
        );
    }
    mssql_select_db("GSB");
    $query = mssql_query("select id_note, nom_pers, prenom_pers, datesoumission_note
                            from note_frais, PERSONNEL
                            where note_frais.id_pers=personnel.id_pers
                            and personnel.id_pers=note_frais.id_pers");
    $i = 0;
    while ($tab_query_fetch = mssql_fetch_assoc($query)) {
        $tab_query[$i][0] = $tab_query_fetch['id_note'];
        $tab_query[$i][1] = $tab_query_fetch['nom_pers'];
        $tab_query[$i][2] = $tab_query_fetch['prenom_pers'];
        $tab_query[$i][3] = $tab_query_fetch['datesoumission_note'];
        $i++;
    }
    MJson_encode($tab_connection, $tab_query);
}

function query_nbr_note($pHost, $pUsername, $pPassword) {
    if (mssql_connect($pHost, $pUsername, $pPassword) != FALSE) {
        $tab_connection = array(
            "text" => "Connexion au serveur distant réussie",
            "id_connection" => "1"
        );
    } else {
        $tab_connection = array(
            "text" => "Echec de la connexion au serveur distant",
            "id_connection" => "0"
        );
    }
    mssql_select_db("GSB");
    $query = mssql_query("select COUNT(*) as nbr from note_frais");
    $tab_query_fetch = mssql_fetch_assoc($query);
    $result = $tab_query_fetch["nbr"];
    MJson_encode($tab_connection, $result);
}

function MJson_encode($tab_connection, $tab_query) {
    $tab = array(
        "tab_connection" => $tab_connection,
        "tab_query" => $tab_query
    );

    echo json_encode($tab);
}

function MJson_connexion($tab_connection) {
    $tab = array(
        "tab_connection" => $tab_connection,
    );

    echo json_encode($tab);
}

?>
