<?php


//inclusion de l'objet
require_once '../include/constantes.inc.php';
require_once '../obj/Liste.php';
require_once '../obj/Page.php';

// Préparation du formulaire
$Liste = new Liste();

// Test du formulaire

$Page = new Page(HTML.'detail.html');

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

$Info_justif = $Liste->Info_note_frais($_GET['id'], $_GET['nom_prenom'], $_GET['montant_tot'], $_GET['date'], $_GET["comm"], $sql);

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
$Page->addBalise('lbl_visiteur', 'Visiteur :');
$Page->addBalise('lbl_responsable', 'Responsable :');
$Page->addBalise('lbl_region', 'Région :');
$Page->addBalise('titre_detail_justif', 'Récapitulatif justificatif');
$Page->addBalise('lbl_lieu', 'Lieu :');
$Page->addBalise('lbl_commentaire', 'Commentaire :');
$Page->addBalise('lbl_num_justif', 'N° Justificatif :');
$Page->addBalise('lbl_date_soumission', 'Date soumission :');
$Page->addBalise('lbl_type_depense', 'Type dépense :');
$Page->addBalise('lbl_montant', 'Montant :');
$Page->addBalise('btn_valider', 'Valider');
$Page->addBalise('btn_refuser', 'Refuser');
$Page->addBalise('btn_annuler', 'Annuler');
$Page->addBalise('lbl_id_note', 'Id note :');
$Page->addBalise('lbl_commentaire_note', 'Commentaire note :');
$Page->addBalise('lbl_montant_total', 'Montant total :');
$Page->addBalise('id_note', $_GET['id']);
/* Fin Traduction */

// Affichage de la page
echo $Page->pageAffiche();
?>