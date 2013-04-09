<?php

session_start();

//inclusion de l'objet
require_once 'obj/Table.php';
require_once 'obj/Page.php';
require_once 'include/menu.inc.php';
require_once 'include/language.php';


$Mchaine="";
$count = count($menu);
for ($i = 0; $i < $count; $i++) {
    $item = explode("|", $menu[$i]);
    $Mchaine.='<a href="' . $item[1] . '"><div id="menu_item">' . $item[0] . '</div></a>';
}



// Préparation du formulaire

$Table = new Table();

// Test du formulaire

$Page = new Page('static/table.php');

$table_note = $Table->Table_note();

$Page->addBalise('titre', 'Principale');
$Page->addBalise('content', $table_note);
$Page->addBalise('menu_2_items', $Mchaine);
$Page->addBalise('se_deco', $lang['se_deconnecter']);


// Affichage de la page
echo $Page->pageAffiche();
?>



