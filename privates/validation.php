<?php

session_start();



//inclusion de l'objet
require_once '../include/constantes.inc.php';
require_once '../obj/Table.php';
require_once '../obj/Page.php';
require_once '../include/menu.inc.php';
require_once '../include/language.php';



$Mchaine="";
$count = count($menu);
for ($i = 0; $i < $count; $i++) {
    $item = explode("|", $menu[$i]);
    $Mchaine.='<a href="' . $item[1] . '"><div id="menu_item">' . $item[0] . '</div></a>';
}



// Préparation du formulaire

$Table = new Table();

// Test du formulaire

$Page = new Page(HTML.'table.php');

$sql = $Page->DB->query("select id_note, nom_pers, prenom_pers, datesoumission_note
                            from note_frais, PERSONNEL
                            where note_frais.id_pers=personnel.id_pers
                            and id_note not in(select id_note from validation)
                            and clos_note=1");

$table_note = $Table->Table_note($sql);

$Page->addBalise('titre', 'Principale');
$Page->addBalise('content', $table_note);
$Page->addBalise('menu_2_items', $Mchaine);
$Page->addBalise('se_deco', $lang['se_deconnecter']);


// Affichage de la page
echo $Page->pageAffiche();
?>



