<?php

session_start();

//inclusion de l'objet
require_once 'obj/Table.php';
require_once 'obj/Page.php';


// Préparation du formulaire

$Table = new Table();

// Test du formulaire

$Page = new Page('static/table.php');

$table_note = $Table->Table_note();

$Page->addBalise('titre', 'Principale');
$Page->addBalise('content', $table_note);


// Affichage de la page
echo $Page->pageAffiche();
?>



