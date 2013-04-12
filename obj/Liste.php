<?php

require_once '../include/language.php';
require_once '../obj/DB.php';
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
    //private $DB;

    /**
     * Constructeur 
     */
    public function __construct() {
        $this->tabulation = 0;
        //$this->DB = new DB();
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
    public function Liste_justificatif($id_note,$sql) {
        $this->tabulation++;

        if ($sql['nblig'] == 1) {


            $Liste = '<div id="banner-fade" style="height: 180px; max-width: 280px; position: relative;">
                        <!-- start Basic Jquery Slider -->
                        <div class="bjqs-wrapper" style="width: 280px; height: 180px; overflow: hidden; position: relative;">
                        <ul class="bjqs" style="height: 180px; width: 280px; float: left; position: relative; display: list-item;">';

            for ($i = 0; $i < $sql['nblig']; $i++) {


                $lib_dep = $sql[$i]["lib_dep"];
                $lib_lieu = $sql[$i]["lieu"];
                $montant = $sql[$i]["montant"];
                $url_photo_justif = $sql[$i]["url_photo_justif"];
                $id_justif = $sql[$i]["id_justif"];
                $lieu = $sql[$i]["lieu"];
                $commentaire = $sql[$i]["commentaire"];


                $Liste .= '<li onclick="show_ticket(\'' . $id_justif . '\',\'' . $lib_dep . '\',\'' . $montant . '\',\'' . $lieu . '\',\'' . $commentaire . '\',\'' . $url_photo_justif . '\')" style="height: 180px; width: 280px; float: left; position: relative; display: list-item;">
                            <img style="height: 180px; width: 280px;" src = "http://www.whpinouf.com/GalaxySwissBourdin/upload/' . $url_photo_justif . '" title = "' . $lib_dep . ' : ' . $montant . '€ - Lieu : ' . $lieu . '"/>
                            <p class="bjqs-caption">' . $lib_dep . ' : ' . $montant . '€ -  Lieu : ' . $lieu . '</p></li>';
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



                $Liste .= '<li onclick ="show_ticket(\'' . $id_justif . '\',\'' . $lib_dep . '\',\'' . $montant . '\',\'' . $lieu . '\',\'' . $commentaire . '\',\'' . $url_photo_justif . '\')">
                            <img  src = "http://www.whpinouf.com/GalaxySwissBourdin/upload/' . $url_photo_justif . '" title = "' . $lib_dep . ' : ' . $montant . '€ - Lieu : ' . $lieu . '" / ></li>';
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

    public function Info_note_frais($id, $nom, $prenom, $date,$commentaire, $sql) {
        $Info;

        if (isset($sql[0])) {

            $nom_pers = $sql[0]['nom_pers'];
            $prenom_pers = $sql[0]['prenom_pers'];
            $lib_reg = utf8_encode($sql[0]["lib_reg"]);             

            $Info = '<table id="justif_info">
                    <tr><td class="title_lbl_detail_justif"><b>#lbl_visiteur#</b></td><td>' . $nom . ' ' . $prenom . '</td></tr>
                    <tr><td class="title_lbl_detail_justif"><b>#lbl_responsable#</b></td><td>' . $nom_pers . ' ' . $prenom_pers . '</td></tr>
                    <tr><td class="title_lbl_detail_justif"><b>#lbl_region#</b></td><td>' . $lib_reg . '</td></tr>
                    <tr><td class="title_lbl_detail_justif"><b>#lbl_date_soumission#</b></td><td>' . $date . '</td></tr>
                    <tr><td class="title_lbl_detail_justif"><b>#lbl_commentaire_note#</b></td><td>' . $commentaire . '</td></tr>
                    <tr><td class="title_lbl_detail_justif"><b>#lbl_id_note#</b></td><td>#id_note#</td></tr>
                    </table>';
        } else {
            $Info = '<table id="justif_info">
                    <tr><td class="title_lbl_detail_justif"><b>#lbl_visiteur#</b></td><td>' . $nom . ' ' . $prenom . '</td></tr>
                    <tr><td class="title_lbl_detail_justif"><b>#lbl_responsable#</b></td><td>A dévelloper function info_justif()</td></tr>
                    <tr><td class="title_lbl_detail_justif"><b>#lbl_region#</b></td><td>A dévelloper function info_justif()</td></tr>
                    <tr><td class="title_lbl_detail_justif"><b>#lbl_date_soumission#</b></td><td>' . $date . '</td></tr>
                    <tr><td class="title_lbl_detail_justif"><b>#lbl_commentaire_note#</b></td><td>' . $commentaire . '</td></tr>
                    <tr><td class="title_lbl_detail_justif"><b>#lbl_id_note#</b></td><td>#id_note#</td></tr>
                    </table>';
        }
        return $Info;
    }

    public function validation_confirm_box($id, $sql) {
        $Info;      
        

        $Info = '<div id="confirm_buton">                
                <input id="buton" class="btn_submit" type="button" onclick="validation(0,this.value,'.$id.','.$sql[0]['id_pers'].');" value="#btn_valider#"/>
                <input id="buton" class="btn_submit" type="button" onclick="validation(0,this.value,'.$id.','.$sql[0]['id_pers'].');" value="#btn_refuser#"/>
                <input id="buton_annuler" class="btn_submit" type="button" onclick="" value="#btn_annuler#"/>
                </div>';
        
        return $Info;
    }

}

?>
