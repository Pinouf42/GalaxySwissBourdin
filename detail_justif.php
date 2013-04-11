<?php

session_start();

//inclusion de l'objet

require_once 'obj/Liste.php';
require_once 'obj/Page.php';
require_once 'include/language.php';

// Préparation du formulaire
$Liste = new Liste();

// Test du formulaire

$Page = new Page('html/detail.php');

$sql = $Page->DB->query('select id_note, montant, lib_dep ,url_photo_justif, id_justif, lieu, commentaire
                                 from JUSTIFICATIF, TYPE_DEPENSE
                                 where JUSTIFICATIF.id_dep=TYPE_DEPENSE.id_dep
                                 and id_note='.$_GET["id"].'');

$Liste_justificatif = $Liste->Liste_justificatif($_GET['id'], $sql);

$sql = $Page->DB->query('select lib_reg, nom_pers, prenom_pers
                                from VISITEUR, REGION, SECTEUR,PERSONNEL,NOTE_FRAIS
                                where VISITEUR.id_reg= REGION.id_reg
                                and REGION.id_sect= SECTEUR.id_sect
                                and SECTEUR.id_resp=PERSONNEL.id_pers
                                and NOTE_FRAIS.id_pers=VISITEUR.id_vis
                                and id_note=' . $_GET['id'].'');

$Info_justif = $Liste->Info_note_frais($_GET['id'], $_GET['nom'], $_GET['prenom'], $_GET['date'], $sql);

$sql = $Page->DB->query('select id_pers from NOTE_FRAIS where id_note=' . $_GET['id'].'');

$confirm_buton_justif = $Liste->validation_confirm_box($_GET['id'], $sql);

/*
  echo $Info_justif;
  echo "-- -- -- -- -- --";
  echo $confirm_buton_justif;

 */
$Page->addBalise('titre', 'Principale');
$Page->addBalise('content', $Liste_justificatif);
$Page->addBalise('info_justif', $Info_justif);
$Page->addBalise('confirm_buton_note', $confirm_buton_justif);


/* Début Traduction */
$Page->addBalise('lbl_visiteur', $lang['lbl_visiteur']);
$Page->addBalise('lbl_responsable', $lang['lbl_responsable']);
$Page->addBalise('lbl_region', $lang['lbl_region']);
$Page->addBalise('titre_detail_justif', $lang['titre_detail_justif']);
$Page->addBalise('lbl_lieu', $lang['lbl_lieu']);
$Page->addBalise('lbl_commentaire', $lang['lbl_commentaire']);
$Page->addBalise('lbl_num_justif', $lang['lbl_num_justif']);
$Page->addBalise('lbl_date_soumission', $lang['lbl_date_soumission']);
$Page->addBalise('lbl_type_depense', $lang['lbl_type_depense']);
$Page->addBalise('lbl_montant', $lang['lbl_montant']);
$Page->addBalise('btn_valider', $lang['btn_valider']);
$Page->addBalise('btn_refuser', $lang['btn_refuser']);
$Page->addBalise('btn_annuler', $lang['btn_annuler']);
$Page->addBalise('id_note', $_GET['id']);
/* Fin Traduction */

// Affichage de la page
echo $Page->pageAffiche();
?>