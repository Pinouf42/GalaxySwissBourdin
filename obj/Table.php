<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Objet générant des tableau
 *
 * @author imhotep
 */
class Table {

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
    public function Table_note($sql) {
        $this->tabulation++;

        // Préparation du tableau des notes de frais
        $table = '<table id="table_note">
						<caption>Tableau de validation des note de frais</caption>
						<thead><tr  class="entete" >
						<th scope="col">N° note</th>
						<th scope="col">Nom visiteur</th>
						<th scope="col">Prénom visiteur</th>
						<th scope="col">Date soumission</th>
                                                <th scope="col">Commentaire</th>
						<th scope="col">A valider</th></tr></thead>
						<tfoot><tr><th scope="row"></th><td colspan="6"></td>
						</tr>
						</tfoot><tbody>';

        for ($i = 0; $i < $sql['nblig']; $i++) {
            setlocale(LC_TIME, 'fr_FR.UTF8');
            $date = strftime("%A %d %B %Y", strtotime($sql[$i]["datesoumission_note"]));
            $nom_pers = $sql[$i]["prenom_pers"];
            $prenom_pers = $sql[$i]["nom_pers"];
            $id_note = $sql[$i]["id_note"];
            $commentaire = $sql[$i]["commentaire_note"];

            $commentaire_trunque =$this->trunque($commentaire, "20");

            $table .= '<tr class="tr_justificatif">
                        <td>' . $id_note . '</td>
                        <td>' . $prenom_pers . '</td>
                        <td>' . $nom_pers . '</td>
                        <td>' . $date . '</td>
                        <td>' . $commentaire_trunque . '</td>
                        <td id="open_file" onclick="$.pageslide({direction: \'left\', href: \'detail_justif.php?id=' . $id_note . '&nom=' . $nom_pers . '&prenom=' . $prenom_pers . '&date=' . $date .'&comm=' . $commentaire . '\', iframe: \'false\'});"></td>
                        </tr> ';
        }

        $table .='</table>';


        return $table;
    }

    /*     * ****
     * 
     *  Ajout de laurent
     * 
     * **** */

    public function trunque($str, $nb) {
        if (strlen($str) > $nb) {
            $str = substr($str, 0, $nb);
            $position_espace = strrpos($str, " ");
            $texte = substr($str, 0, $position_espace);
            $str = $texte . "...";
        }
        return $str;
    }

    public function tableDeb($attribut = '', $caption = '') {
        return '<table ' . $attribut . '><caption>' . $caption . '</caption>';
    }

    public function tableFin() {
        return '</table>';
    }

    /**
     *
     * @param type $tab tableau de valeur attribut/valeur 
     */
    public function tableCreeLigneTH($tab, $classTR) {
        $return = '<tr>';
        foreach ($tab as $line) {
            $return .='<th ' . $line['attribut'] . '>' . $line['valeur'] . '</th>';
        }
        return $return . '</tr>';
    }

    /**
     *
     * @param type $tab tableau de valeur attribut/valeur 
     */
    public function tableCreeLigneTD($tab) {
        $return = '<tr>';
        foreach ($tab as $line) {
            $return .='<td ' . $line['attribut'] . '>' . $line['valeur'] . '</td>';
        }
        return $return . '</tr>';
    }

}

?>
