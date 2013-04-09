<?php
require_once 'include/language.php';
require_once 'obj/DB.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Objet générant des tableau
 *
 * @author imhotep
 */
class Liste {

    /**
     * Numéro de tabulation
     * @var int
     */
    private $tabulation;
    private $DB;

    /**
     * Constructeur 
     */
    public function __construct() {
        $this->tabulation = 0;
        $this->DB = new DB();
    }

    /**
     * Destructeur 
     */
    function __destruct() {
        ;
    }

    /**
     * Champ texte HTML
     * @param string $name Nom du champ
     * @return string code HTML
     */
    public function Liste_justificatif($id_note) {
        $this->tabulation++;

        $sql = $this->DB->query("select id_note, montant, lib_dep ,url_photo_justif, id_justif, lieu, commentaire
                                 from JUSTIFICATIF, TYPE_DEPENSE
                                 where JUSTIFICATIF.id_dep=TYPE_DEPENSE.id_dep
                                 and id_note=$id_note");


if ($sql['nblig'] == 1) {


$Liste = '<div id="banner-fade" style="height: 180px; max-width: 280px; position: relative;">
    <!-- start Basic Jquery Slider -->
    <div class="bjqs-wrapper" style="width: 280px; height: 180px; overflow: hidden; position: relative;">
        <ul class="bjqs" style="height: 180px; width: 280px; float: left; position: relative; display: list-item;">';

            for ($i = 0; $i < $sql['nblig']; $i++) {


            $lib_dep = $sql[$i]["lib_dep"];
            $montant = $sql[$i]["montant"];
            $url_photo_justif = $sql[$i]["url_photo_justif"];
            $id_justif = $sql[$i]["id_justif"];
            $lieu = $sql[$i]["lieu"];
            $commentaire = $sql[$i]["commentaire"];


            $Liste .= '<li onclick="show_ticket(\'' . $id_justif . '\',\'' . $lib_dep . '\',\'' . $montant . '\',\'' . $lieu . '\',\'' . $commentaire . '\',\'' . $url_photo_justif . '\')" style="height: 180px; width: 280px; float: left; position: relative; display: list-item;">
                <img style="height: 180px; width: 280px;" src = "http://www.whpinouf.com/gsb/upload/'.$url_photo_justif.'" title = "' . $lib_dep . ' : ' . $montant . '€ - ' . $url_photo_justif . '"/>
                <p class="bjqs-caption">' . $lib_dep . ' : ' . $montant . '€ - ' . $url_photo_justif . '</p></li>';
            }

            $Liste .= '</ul><!-- end Basic jQuery Slider --></div></div>';
} else if ($sql['nblig'] > 0) {
$Liste = '<div id="banner-fade"><!-- start Basic Jquery Slider --><ul class="bjqs">';

        for ($i = 0; $i < $sql['nblig']; $i++) {


        $lib_dep = $sql[$i]["lib_dep"];
        $montant = $sql[$i]["montant"];
        $url_photo_justif = $sql[$i]["url_photo_justif"];
        $id_justif = $sql[$i]["id_justif"];
        $lieu = $sql[$i]["lieu"];
        $commentaire = $sql[$i]["commentaire"];



        $Liste .= '<li>
            <img onclick ="show_ticket(\'' . $id_justif . '\',\'' . $lib_dep . '\',\'' . $montant . '\',\'' . $lieu . '\',\'' . $commentaire . '\')" src = "../images/ticket.png" title = "' . $lib_dep . ' : ' . $montant . '€ - ' . $url_photo_justif . '" / ></li>';
        }
        $Liste .= "</ul><!-- end Basic jQuery Slider -->
    <script class=\"secret-source\">
        jQuery(document).ready(function($) {
            $('#banner-fade').bjqs({
                height : 180,
                width : 280,
                responsive : true
            });
        });
    </script>
</div>";
} else {
$Liste = '  <script>
    popup_show("info","Il n\'y à aucun justificatif pour cette note de frais");
</script>';
}


return $Liste;
}

public function Info_justif($id, $nom, $prenom, $date) {
$Info;


$sql = $this->DB->query('select  lib_reg, nom_pers, prenom_pers
from VISITEUR, REGION, SECTEUR,PERSONNEL,NOTE_FRAIS
where VISITEUR.id_reg= REGION.id_reg
and REGION.id_sect= SECTEUR.id_sect
and SECTEUR.id_resp=PERSONNEL.id_pers
and NOTE_FRAIS.id_pers=VISITEUR.id_vis
and id_note=' . $id);


if (isset($sql[0])) {

$nom_pers = $sql[0]['nom_pers'];
$prenom_pers = $sql[0]['prenom_pers'];
$lib_reg = utf8_encode($sql[0]["lib_reg"]);

$Info = '<table id="justif_info">
    <tr><td class="title_lbl_detail_justif"><b>#lbl_visiteur#</b></td><td>' . $nom . ' ' . $prenom . '</td></tr>
    <tr><td class="title_lbl_detail_justif"><b>#lbl_responsable#</b></td><td>' . $nom_pers . ' ' . $prenom_pers . '</td></tr>
    <tr><td class="title_lbl_detail_justif"><b>#lbl_region#</b></td><td>' . $lib_reg . '</td></tr>
    <tr><td class="title_lbl_detail_justif"><b>#lbl_date_soumission#</b></td><td>' . $date . '</td></tr>
    <tr><td class="title_lbl_detail_justif"><b>Id_note :</b></td><td>#id_note#</td></tr>
</table>';
} else {
$Info = '<table id="justif_info">
    <tr><td class="title_lbl_detail_justif"><b>#lbl_visiteur#</b></td><td>' . $nom . ' ' . $prenom . '</td></tr>
    <tr><td class="title_lbl_detail_justif"><b>#lbl_responsable#</b></td><td>A dévelloper function info_justif()</td></tr>
    <tr><td class="title_lbl_detail_justif"><b>#lbl_region#</b></td><td>A dévelloper function info_justif()</td></tr>
    <tr><td class="title_lbl_detail_justif"><b>#lbl_date_soumission#</b></td><td>' . $date . '</td></tr>
    <tr><td class="title_lbl_detail_justif"><b>Id_note :</b></td><td>#id_note#</td></tr>
</table>';
}
return $Info;
}

public function Detail_justif($id_note) {
$Info;


$sql = $this->DB->query('select  lib_reg, nom_pers, prenom_pers
from VISITEUR, REGION, SECTEUR,PERSONNEL,NOTE_FRAIS
where VISITEUR.id_reg= REGION.id_reg
and REGION.id_sect= SECTEUR.id_sect
and SECTEUR.id_resp=PERSONNEL.id_pers
and NOTE_FRAIS.id_pers=VISITEUR.id_vis
and id_note=' . $id);

$nom_pers = $sql[0]['nom_pers'];
$prenom_pers = $sql[0]['prenom_pers'];
$lib_reg = utf8_encode($sql[0]["lib_reg"]);



if (isset($sql[0])) {
$Info = '<table id="justif">
    <tr><td class="title_lbl_detail_justif"><b>#lbl_visiteur#</b></td><td>' . $nom . ' ' . $prenom . '</td></tr>
    <tr><td class="title_lbl_detail_justif"><b>#lbl_responsable#</b></td><td>' . $nom_pers . ' ' . $prenom_pers . '</td></tr>
    <tr><td class="title_lbl_detail_justif"><b>#lbl_region#</b></td><td>' . $lib_reg . '</td></tr>
</table>';
} else {
$Info = '<table id="justif">
    <tr><td class="title_lbl_detail_justif"><b>#lbl_visiteur#</b></td><td>' . $nom . ' ' . $prenom . '</td></tr>
    <tr><td class="title_lbl_detail_justif"><b>#lbl_responsable#</b></td><td>A dévelloper function info_justif()</td></tr>
    <tr><td class="title_lbl_detail_justif"><b>#lbl_region#</b></td><td>A dévelloper function info_justif()</td></tr>
</table>';
}
return $Info;
}

}

?>